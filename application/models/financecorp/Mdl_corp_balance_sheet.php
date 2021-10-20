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
               IF(trans.Balance IS NOT NULL, trans.Balance, 0) AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Balance) AS Balance, TransDate, EntryDate 
                        FROM tbl_fa_transaction
                        WHERE TransDate <= '$date'
                        AND $branch GROUP BY AccNo) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type = 'A'"
      )->result_array();

      $liabilities = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(trans.Balance IS NOT NULL, trans.Balance, 0) AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Balance) AS Balance, TransDate, EntryDate 
                        FROM tbl_fa_transaction
                        WHERE TransDate <= '$date'
                        AND $branch GROUP BY AccNo) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type = 'L'"
      )->result_array();

      $capital = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(trans.Balance IS NOT NULL, trans.Balance, 0) AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Balance) AS Balance, TransDate, EntryDate 
                        FROM tbl_fa_transaction
                        WHERE TransDate <= '$date'
                        AND $branch GROUP BY AccNo) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type = 'C'"
      )->result_array();

      return [$company, $asset, $liabilities, $capital];
   }
}
