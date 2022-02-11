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

      //? Get last day of selected `year` and ``month``
      $date = date('Y-m-t', strtotime("$year-$month-01"));

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
               WHERE TransDate <= CAST('$date' AS Date)
               AND TransDate = (
                  SELECT TransDate
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND CtrlNo = (
                  SELECT CtrlNo
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
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
               WHERE TransDate <= CAST('$date' AS Date)
               AND TransDate = (
                  SELECT TransDate
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND CtrlNo = (
                  SELECT CtrlNo
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
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
                  -- IF acc.Acc_No refers to `31201` (Current Earning - CX) OR `31202` (Retaining Earning - C1) --
                  -- THEN GET TOTAL FROM tbl_fa_retaining_earning --
                  -- ELSE, GET LAST `trans.BalanceBranch` --
                  WHEN acc.Acc_No = '31201' THEN
                     (SELECT
                        COALESCE(
                           (SELECT IFNULL(RetainingSum, 0) AS RetainingEarning
                            FROM tbl_fa_retaining_earning
                            WHERE $branch
                            AND Year = YEAR('$date')
                            AND Month <= MONTH('$date')
                            AND (Retaining IS NOT NULL OR RetainingSum IS NOT NULL)
                            ORDER BY Month DESC, CtrlNo DESC LIMIT 1)
                        ,0)
                     )
                  WHEN acc.Acc_No = '31202' THEN
                     (SELECT
                        COALESCE(
                           (SELECT IFNULL(RetainingSum, 0) AS LastYearEarning
                           FROM tbl_fa_retaining_earning
                           WHERE $branch
                           AND YEAR = YEAR(DATE_SUB('$date', INTERVAL 1 YEAR))
                           ORDER BY Month DESC, CtrlNo DESC LIMIT 1)
                        ,0)
                        +
                        COALESCE(
                           (SELECT IFNULL((SUM(Credit)-SUM(Debit)),0) AS GeneralJournalRE
                           FROM tbl_fa_transaction
                           WHERE $branch
                           AND YEAR(TransDate) <= YEAR('$date')
                           AND AccType IN ('C1'))
                        ,0)
                     )
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
               AND TransDate <= CAST('$date' AS Date)
               AND TransDate = (
                  SELECT TransDate
                  FROM tbl_fa_transaction
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND CtrlNo = (
                  SELECT CtrlNo
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
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
}