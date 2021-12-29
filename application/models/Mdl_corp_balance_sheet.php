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
               CASE
                  WHEN acc.Acc_No = '31201' THEN
                     (SELECT IFNULL(RetainingSum, 0)
                      FROM tbl_fa_retaining_earning
                      WHERE Branch = '0101'
                      AND Year = YEAR('$date')
                      AND Month = MONTH('$date')
                      ORDER BY CtrlNo DESC LIMIT 1)
                  WHEN acc.Acc_No = '31202' THEN
                     (SELECT IFNULL(RetainingSum, 0)
                      FROM tbl_fa_retaining_earning
                      WHERE Branch = '0101'
                      AND Year = YEAR(DATE_SUB('$date', INTERVAL 1 YEAR))
                      ORDER BY Month DESC, CtrlNo DESC LIMIT 1)
                  WHEN  acc.TransGroup IN('H1','H2','H3') THEN
                     NULL
                  ELSE
                     IFNULL(trans.BalanceBranch, 0)
               END AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (
               SELECT Branch, AccNo, AccType, BalanceBranch, TransDate, EntryDate 
               FROM tbl_fa_transaction AS parent
               WHERE $branch
               AND 
                  CASE WHEN parent.AccType IN('R','E') THEN
                     YEAR(TransDate) = YEAR('$date')
                  ELSE
                     YEAR(TransDate) <= YEAR('$date')
                  END
               -- AND MONTH(TransDate) <= MONTH('$date')
               AND TransDate = (
                  SELECT TransDate
                  FROM tbl_fa_transaction
                  WHERE AccNo = parent.AccNo 
                  AND 
                     CASE WHEN parent.AccType IN('R','E') THEN
                        YEAR(TransDate) = YEAR('$date')
                     ELSE
                        YEAR(TransDate) <= YEAR('$date')
                     END
                  -- AND MONTH(TransDate) <= MONTH('$date')
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND CtrlNo = (
                  SELECT CtrlNo
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND 
                     CASE WHEN parent.AccType IN('R','E') THEN
                        YEAR(TransDate) = YEAR('$date')
                     ELSE
                        YEAR(TransDate) <= YEAR('$date')
                     END
                  -- AND MONTH(TransDate) <= MONTH('$date')
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
            ) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type IN ('C','CX', 'C1')
            GROUP BY acc.Acc_No
            ORDER BY acc.Acc_No ASC"
      )->result_array();

      return [$company, $asset, $liabilities, $capital];
   }

   //! Currently Unused
   function get_current_earning($branch, $year, $month){
      
      $current_earning = $this->db->query(
         "SELECT IFNULL(RetainingSum, 0) AS CurrentEarning
          FROM tbl_fa_retaining_earning
          WHERE Branch = '$branch'
          AND Year = $year
          AND Month = $month
          ORDER BY CtrlNo DESC LIMIT 1"
      )->row()->CurrentEarning;

      return ($current_earning ?: 0);
   }

   //! Currently Unused
   function get_retaining_earning($branch, $year){

      $retaining_earning = $this->db->query(
         "SELECT IFNULL(RetainingSum, 0) AS RetainingEarning
          FROM tbl_fa_retaining_earning
          WHERE Branch = '$branch'
          AND Year = ($year-1)
          ORDER BY Month DESC, CtrlNo DESC LIMIT 1"
      )->row()->RetainingEarning;

      return ($retaining_earning ?: 0);
   }
}
