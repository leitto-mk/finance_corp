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
            LEFT JOIN (
               SELECT Branch, AccNo, AccType, BalanceBranch, TransDate, EntryDate 
               FROM tbl_fa_transaction AS parent
               WHERE MONTH(TransDate) = MONTH('$date')
               AND TransDate = (
                  SELECT MAX(TransDate) 
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND MONTH(TransDate) = MONTH('$date')
               )
               AND $branch
               ORDER BY TransDate DESC
            ) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type = 'A'
            ORDER BY acc.Acc_No ASC"
      )->result_array();

      $liabilities = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(trans.BalanceBranch IS NOT NULL, trans.BalanceBranch, 0) AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (
               SELECT Branch, AccNo, AccType, BalanceBranch, TransDate, EntryDate 
               FROM tbl_fa_transaction AS parent
               WHERE MONTH(TransDate) = MONTH('$date')
               AND TransDate = (
                  SELECT MAX(TransDate) 
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND MONTH(TransDate) = MONTH('$date')
               )
               AND $branch
               ORDER BY TransDate DESC
            ) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type = 'L'
            ORDER BY acc.Acc_No ASC"
      )->result_array();

      $capital = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(trans.BalanceBranch IS NOT NULL, trans.BalanceBranch, 0) AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (
               SELECT Branch, AccNo, AccType, BalanceBranch, TransDate, EntryDate 
               FROM tbl_fa_transaction AS parent
               WHERE MONTH(TransDate) = MONTH('$date')
               AND TransDate = (
                  SELECT MAX(TransDate) 
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND MONTH(TransDate) = MONTH('$date')
               )
               AND $branch
               ORDER BY TransDate DESC
            ) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type IN ('C','C
            ORDER BY acc.Acc_No ASCX','C1')"
      )->result_array();

      return [$company, $asset, $liabilities, $capital];
   }

   function get_retaining_earning($branch, $year, $month){
      if($branch){
         $branch = "Branch = '$branch'";
      }else{
         $branch = "Branch IS NOT NULL";
      }

      $query = $this->db->query(
         "SELECT 
            (
               (
                  SELECT SUM(Amount) FROM tbl_fa_transaction
                  WHERE $branch
                  AND YEAR(TransDate) = $year AND MONTH(TransDate) <= $month
                  AND AccType IN ('R', 'R1')
               ) 
               -
               (
                  SELECT SUM(Amount) FROM tbl_fa_transaction
                  WHERE $branch
                  AND YEAR(TransDate) = $year AND MONTH(TransDate) <= $month
                  AND AccType IN ('E', 'E1')
               )
            ) AS RetainingEarning"
      )->row();

      return !empty($query) ? $query->RetainingEarning : 0;
   }

   function get_current_earning($branch, $year, $month){
      if($branch){
         $branch = "Branch = '$branch'";
      }else{
         $branch = "Branch IS NOT NULL";
      }

      $query = $this->db->query(
         "SELECT SUM(Amount) AS CurrentEarning
          FROM tbl_fa_transaction
          WHERE $branch
          AND YEAR(TransDate) = $year AND MONTH(TransDate) = $month
          AND Itemno != 0"
      )->row();

      return !empty($query) ? $query->CurrentEarning : 0;
   }
}
