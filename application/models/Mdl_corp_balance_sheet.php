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
               WHERE YEAR(TransDate) = YEAR('$date')
               AND MONTH(TransDate) <= MONTH('$date')
               AND TransDate = (
                  SELECT TransDate
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND YEAR(TransDate) = YEAR('$date')
                  AND MONTH(TransDate) <= MONTH('$date')
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND CtrlNo = (
                  SELECT CtrlNo
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND YEAR(TransDate) = YEAR('$date')
                  AND MONTH(TransDate) <= MONTH('$date')
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND $branch
            ) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type = 'A'
            GROUP BY acc.Acc_No
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
               WHERE YEAR(TransDate) = YEAR('$date')
               AND MONTH(TransDate) <= MONTH('$date')
               AND TransDate = (
                  SELECT TransDate
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND YEAR(TransDate) = YEAR('$date')
                  AND MONTH(TransDate) <= MONTH('$date')
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND CtrlNo = (
                  SELECT CtrlNo
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND YEAR(TransDate) = YEAR('$date')
                  AND MONTH(TransDate) <= MONTH('$date')
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND $branch
            ) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type = 'L'
            GROUP BY acc.Acc_No
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
               WHERE YEAR(TransDate) = YEAR('$date')
               AND MONTH(TransDate) <= MONTH('$date')
               AND TransDate = (
                  SELECT TransDate
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND YEAR(TransDate) = YEAR('$date')
                  AND MONTH(TransDate) <= MONTH('$date')
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND CtrlNo = (
                  SELECT CtrlNo
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND YEAR(TransDate) = YEAR('$date')
                  AND MONTH(TransDate) <= MONTH('$date')
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND $branch
            ) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type IN ('C','CX', 'C1')
            GROUP BY acc.Acc_No
            ORDER BY acc.Acc_No ASC"
      )->result_array();

      return [$company, $asset, $liabilities, $capital];
   }

   function get_current_earning($branch, $year, $month){

      $revenue = $this->db->query(
         "SELECT SUM(Amount) AS Revenue FROM tbl_fa_transaction
          WHERE Branch = '$branch'
          AND YEAR(TransDate) = $year AND MONTH(TransDate) <= $month
          AND AccType IN ('R', 'R1')"
      )->row()->Revenue;

      $expense = $this->db->query(
         "SELECT SUM(Amount) AS Expense FROM tbl_fa_transaction
          WHERE Branch = '$branch'
          AND YEAR(TransDate) = $year AND MONTH(TransDate) <= $month
          AND AccType IN ('E', 'E1')"
      )->row()->Expense;

      $CurrentEarning = ($revenue - $expense);

      return $CurrentEarning;
   }

   function get_retaining_earning($branch, $year, $month){

      $this->db->trans_begin();

      $cur_year = $this->db->query(
         "SELECT IFNULL(RetainingSum, 0) AS RetainingSum
          FROM tbl_fa_retaining_earning
          WHERE Branch = '$branch'
          AND Year = $year
          ORDER BY CtrlNo DESC LIMIT 1"
      )->row();

      $pre_year = $this->db->query(
         "SELECT IFNULL(RetainingSum, 0) AS RetainingSum
          FROM tbl_fa_retaining_earning
          WHERE Branch = '$branch'
          AND Year = ($year-1)
          ORDER BY CtrlNo DESC LIMIT 1"
      )->row();

      $cur_year = is_null($cur_year) ? 0 : $cur_year->RetainingSum;
      $pre_year = is_null($pre_year) ? 0 : $pre_year->RetainingSum;

      $RetainingEarning = ($cur_year - $pre_year);
     
      $this->db->trans_complete();

      return $RetainingEarning;
   }
}
