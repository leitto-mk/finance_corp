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

   function get_columnar_report($branch, $year){
      if($branch){
         $branch = "Branch = '$branch'";
      }else{
         $branch = "Branch IS NOT NULL";
      }
      
      $company = $this->db->select(
         "ComCode,
          ComName,
          CONCAT(Address,', ',City,', ',Province,', ',PostalCode) AS Address,
          CONCAT(PhoneNo,'/',ContactNo) AS Contact"
      )->get('abase_01_com')->row();

      $query = "LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$year-01-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS jan
               ON acc.Acc_No = jan.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-02-01' AS DATETIME) AND LAST_DAY('$year-02-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS feb
               ON acc.Acc_No = feb.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-03-01' AS DATETIME) AND LAST_DAY('$year-03-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS mar
               ON acc.Acc_No = mar.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-04-01' AS DATETIME) AND LAST_DAY('$year-04-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS apr
               ON acc.Acc_No = apr.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-05-01' AS DATETIME) AND LAST_DAY('$year-05-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS may
               ON acc.Acc_No = may.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-06-01' AS DATETIME) AND LAST_DAY('$year-06-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS jun
               ON acc.Acc_No = jun.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-07-01' AS DATETIME) AND LAST_DAY('$year-07-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS jul
               ON acc.Acc_No = jul.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-08-01' AS DATETIME) AND LAST_DAY('$year-08-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS aug
               ON acc.Acc_No = aug.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-09-01' AS DATETIME) AND LAST_DAY('$year-09-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS sep
               ON acc.Acc_No = sep.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-10-01' AS DATETIME) AND LAST_DAY('$year-10-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS oct
               ON acc.Acc_No = oct.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-11-01' AS DATETIME) AND LAST_DAY('$year-11-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS nov
               ON acc.Acc_No = nov.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-12-01' AS DATETIME) AND LAST_DAY('$year-12-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS des
               ON acc.Acc_No = des.AccNo";

      $revenue = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(jan.Balance IS NOT NULL, jan.Balance, 0) AS Jan,
               IF(feb.Balance IS NOT NULL, feb.Balance, 0) AS Feb,
               IF(mar.Balance IS NOT NULL, mar.Balance, 0) AS Mar,
               IF(apr.Balance IS NOT NULL, apr.Balance, 0) AS Apr,
               IF(may.Balance IS NOT NULL, may.Balance, 0) AS May,
               IF(jun.Balance IS NOT NULL, jun.Balance, 0) AS Jun,
               IF(jul.Balance IS NOT NULL, jul.Balance, 0) AS Jul,
               IF(aug.Balance IS NOT NULL, aug.Balance, 0) AS Aug,
               IF(sep.Balance IS NOT NULL, sep.Balance, 0) AS Sep,
               IF(oct.Balance IS NOT NULL, oct.Balance, 0) AS Oct,
               IF(nov.Balance IS NOT NULL, nov.Balance, 0) AS Nov,
               IF(des.Balance IS NOT NULL, des.Balance, 0) AS Des,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         $query
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$year-12-31')
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
               IF(jan.Balance IS NOT NULL, jan.Balance, 0) AS Jan,
               IF(feb.Balance IS NOT NULL, feb.Balance, 0) AS Feb,
               IF(mar.Balance IS NOT NULL, mar.Balance, 0) AS Mar,
               IF(apr.Balance IS NOT NULL, apr.Balance, 0) AS Apr,
               IF(may.Balance IS NOT NULL, may.Balance, 0) AS May,
               IF(jun.Balance IS NOT NULL, jun.Balance, 0) AS Jun,
               IF(jul.Balance IS NOT NULL, jul.Balance, 0) AS Jul,
               IF(aug.Balance IS NOT NULL, aug.Balance, 0) AS Aug,
               IF(sep.Balance IS NOT NULL, sep.Balance, 0) AS Sep,
               IF(oct.Balance IS NOT NULL, oct.Balance, 0) AS Oct,
               IF(nov.Balance IS NOT NULL, nov.Balance, 0) AS Nov,
               IF(des.Balance IS NOT NULL, des.Balance, 0) AS Des,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         $query
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$year-12-01')
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
               IF(jan.Balance IS NOT NULL, jan.Balance, 0) AS Jan,
               IF(feb.Balance IS NOT NULL, feb.Balance, 0) AS Feb,
               IF(mar.Balance IS NOT NULL, mar.Balance, 0) AS Mar,
               IF(apr.Balance IS NOT NULL, apr.Balance, 0) AS Apr,
               IF(may.Balance IS NOT NULL, may.Balance, 0) AS May,
               IF(jun.Balance IS NOT NULL, jun.Balance, 0) AS Jun,
               IF(jul.Balance IS NOT NULL, jul.Balance, 0) AS Jul,
               IF(aug.Balance IS NOT NULL, aug.Balance, 0) AS Aug,
               IF(sep.Balance IS NOT NULL, sep.Balance, 0) AS Sep,
               IF(oct.Balance IS NOT NULL, oct.Balance, 0) AS Oct,
               IF(nov.Balance IS NOT NULL, nov.Balance, 0) AS Nov,
               IF(des.Balance IS NOT NULL, des.Balance, 0) AS Des,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         $query
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$year-12-01')
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
               IF(jan.Balance IS NOT NULL, jan.Balance, 0) AS Jan,
               IF(feb.Balance IS NOT NULL, feb.Balance, 0) AS Feb,
               IF(mar.Balance IS NOT NULL, mar.Balance, 0) AS Mar,
               IF(apr.Balance IS NOT NULL, apr.Balance, 0) AS Apr,
               IF(may.Balance IS NOT NULL, may.Balance, 0) AS May,
               IF(jun.Balance IS NOT NULL, jun.Balance, 0) AS Jun,
               IF(jul.Balance IS NOT NULL, jul.Balance, 0) AS Jul,
               IF(aug.Balance IS NOT NULL, aug.Balance, 0) AS Aug,
               IF(sep.Balance IS NOT NULL, sep.Balance, 0) AS Sep,
               IF(oct.Balance IS NOT NULL, oct.Balance, 0) AS Oct,
               IF(nov.Balance IS NOT NULL, nov.Balance, 0) AS Nov,
               IF(des.Balance IS NOT NULL, des.Balance, 0) AS Des,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         $query
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$year-12-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 70000 AND 79999"
      )->result_array();

      return [$company, $revenue, $operational, $other_rev, $other_expense];
   }
}
