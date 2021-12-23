<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_income_statement extends CI_Model
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

      $revenue = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(mTrans.Balance IS NOT NULL, mTrans.Balance, 0) AS Monthly,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-$month-01' AS DATETIME) AND LAST_DAY('$year-$month-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS mTrans
            ON acc.Acc_No = mTrans.AccNo
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$date')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 40000 AND 49999"
      )->result_array();

      $operational = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(mTrans.Balance IS NOT NULL, mTrans.Balance, 0) AS Monthly,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-$month-01' AS DATETIME) AND LAST_DAY('$year-$month-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS mTrans
            ON acc.Acc_No = mTrans.AccNo
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$date')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 50000 AND 59999"
      )->result_array();

      $other_rev = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(mTrans.Balance IS NOT NULL, mTrans.Balance, 0) AS Monthly,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-$month-01' AS DATETIME) AND LAST_DAY('$year-$month-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS mTrans
            ON acc.Acc_No = mTrans.AccNo
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$date')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 60000 AND 69999"
      )->result_array();

      $other_expense = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(mTrans.Balance IS NOT NULL, mTrans.Balance, 0) AS Monthly,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-$month-01' AS DATETIME) AND LAST_DAY('$year-$month-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS mTrans
            ON acc.Acc_No = mTrans.AccNo
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$date')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 70000 AND 79999"
      )->result_array();

      return [$company, $revenue, $operational, $other_rev, $other_expense];
   }
}
