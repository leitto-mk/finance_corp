<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_personal extends CI_Model
{
   public function get_general_ledger(){
      return $this->db->query(
            "SELECT 
               trans.IDNumber,
               hr.FullName,
               acc.Acc_Name,
               trans.DocNo,
               trans.TransType, 
               DATE_FORMAT(trans.TransDate, '%d-%m-%Y') AS TransDate, 
               trans.Branch,
               trans.AccNo,
               trans.Remarks,
               trans.Debit, 
               trans.Credit, 
               trans.Balance,
               (SELECT BalanceBranch 
                FROM tbl_fa_transaction 
                WHERE AccNo = trans.AccNo 
                AND Branch = trans.Branch
                AND TransDate < CURDATE()
                ORDER BY CtrlNo DESC LIMIT 1) AS beg_balance,
               trans.EntryDate 
            FROM tbl_fa_transaction AS trans
            INNER JOIN tbl_fa_account_no AS acc
               ON trans.AccNo = acc.Acc_No
            INNER JOIN tbl_hr_append as hr
               ON trans.IDNumber = hr.IDNumber
            WHERE trans.PostedStatus = 1
            ORDER BY trans.IDNumber, trans.CtrlNo ASC"
      )->result_array();
   }
}
