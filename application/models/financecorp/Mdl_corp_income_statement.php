<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_income_statement extends CI_Model
{
   function get_report(){
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
               IF(trans.Amount IS NOT NULL, trans.Amount, 0) AS Amount
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT AccNo, AccType, SUM(Amount) AS Amount FROM tbl_fa_transaction GROUP BY AccNo) AS trans
            ON acc.Acc_No = trans.AccNo
         WHERE acc.Acc_No BETWEEN 40000 AND 49999"
      )->result_array();

      $operational = $this->db->query(
         "SELECT
            acc.Acc_No,
            acc.Acc_Name,
            acc.Acc_Type,
            IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
            IF(trans.Amount IS NOT NULL, trans.Amount, 0) AS Amount
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT AccNo, AccType, SUM(Amount) AS Amount FROM tbl_fa_transaction GROUP BY AccNo) AS trans
            ON acc.Acc_No = trans.AccNo
         WHERE acc.Acc_No BETWEEN 50000 AND 59999"
      )->result_array();

      $other_rev = $this->db->query(
         "SELECT
            acc.Acc_No,
            acc.Acc_Name,
            acc.Acc_Type,
            IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
            IF(trans.Amount IS NOT NULL, trans.Amount, 0) AS Amount
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT AccNo, AccType, SUM(Amount) AS Amount FROM tbl_fa_transaction GROUP BY AccNo) AS trans
            ON acc.Acc_No = trans.AccNo
         WHERE acc.Acc_No BETWEEN 60000 AND 69999"
      )->result_array();

      $other_expense = $this->db->query(
         "SELECT
            acc.Acc_No,
            acc.Acc_Name,
            acc.Acc_Type,
            IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
            IF(trans.Amount IS NOT NULL, trans.Amount, 0) AS Amount
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT AccNo, AccType, SUM(Amount) AS Amount FROM tbl_fa_transaction GROUP BY AccNo) AS trans
            ON acc.Acc_No = trans.AccNo
         WHERE acc.Acc_No BETWEEN 70000 AND 79999"
      )->result_array();

      return [$company, $revenue, $operational, $other_rev, $other_expense];
   }
}
