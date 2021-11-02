<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_balance_sheet extends CI_Model
{
   function get_report($branch, $year, $month){
      if($branch){
         $branch = "Branch = '$branch'";
      }else{
         $branch = "Branch IS NOT NULL";
      }

      $date = "$year-$month-" . date('d');

      $company = $this->db->select(
         "ComCode,
          ComName,
          CONCAT(Address,', ',City,', ',Province,', ',PostalCode) AS Address,
          CONCAT(PhoneNo,'/',ContactNo) AS Contact"
      )->get('abase_01_com')->row();

      $asset = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(trans.BalanceBranch IS NOT NULL, trans.BalanceBranch, 0) AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (SELECT Branch, AccNo, AccType, BalanceBranch, TransDate, EntryDate 
                        FROM tbl_fa_transaction
                        WHERE TransDate <= '$date'
                        AND $branch 
                        GROUP BY AccNo
                        ORDER BY EntryDate DESC LIMIT 1) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type = 'A'"
      )->result_array();

      $liabilities = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(trans.BalanceBranch IS NOT NULL, trans.BalanceBranch, 0) AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (SELECT Branch, AccNo, AccType, BalanceBranch, TransDate, EntryDate 
                        FROM tbl_fa_transaction
                        WHERE TransDate <= '$date'
                        AND $branch 
                        GROUP BY AccNo
                        ORDER BY EntryDate DESC LIMIT 1) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type = 'L'"
      )->result_array();

      $capital = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(trans.BalanceBranch IS NOT NULL, trans.BalanceBranch, 0) AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (SELECT Branch, AccNo, AccType, BalanceBranch, TransDate, EntryDate 
                        FROM tbl_fa_transaction
                        WHERE TransDate <= '$date'
                        AND $branch 
                        GROUP BY AccNo
                        ORDER BY EntryDate DESC LIMIT 1) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type IN ('C','CX','C1')"
      )->result_array();

      return [$company, $asset, $liabilities, $capital];
   }

   function get_retaining_earning($branch, $year){
      if($branch){
         $branch = "Branch = '$branch'";
      }else{
         $branch = "Branch IS NOT NULL";
      }

      $query = $this->db->query(
         "SELECT 
            (
               (
                  SELECT SUM(BalanceBranch) FROM tbl_fa_transaction
                  WHERE $branch
                  AND TransDate < '$year-01-01'
                  AND Itemno != 0
                  AND AccType IN ('R', 'R1')
               ) 
               -
               (
                  SELECT SUM(BalanceBranch) FROM tbl_fa_transaction
                  WHERE $branch
                  AND TransDate < '$year-01-01'
                  AND Itemno != 0
                  AND AccType IN ('R', 'R1')
               )
            ) AS RetainingEarning
          FROM tbl_fa_transaction
          WHERE $branch
          AND TransDate < '$year-01-01'
          AND Itemno != 0"
      )->row()->RetainingEarning;

      return ($query > 1 ? $query : 0);
   }

   function get_current_earning($branch, $year){
      if($branch){
         $branch = "Branch = '$branch'";
      }else{
         $branch = "Branch IS NOT NULL";
      }

      $query = $this->db->query(
         "SELECT SUM(BalanceBranch) AS CurrentEarning
          FROM tbl_fa_transaction
          WHERE $branch
          AND TransDate BETWEEN '$year-01-01' AND CURDATE()
          AND Itemno != 0"
      )->row()->CurrentEarning;

      return ($query > 1 ? $query : 0);
   }
}
