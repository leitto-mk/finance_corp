<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_personal extends CI_Model
{
   public function get_general_ledger(){
      return $this->db->query(
          "SELECT 
               bio.IDNumber,
               CONCAT(bio.FirstName, ' ', bio.LastName) AS FullName,
               acc.Acc_Name,
               trans.DocNo,
               trans.TransType, 
               DATE_FORMAT(trans.TransDate, '%d-%m-%Y') AS TransDate, 
               trans.Branch,
               trans.Year,
               trans.Month,
               trans.AccNo,
               trans.Remarks,
               trans.Debit, 
               trans.Credit, 
               trans.Balance,
               trans.BalanceBranch,
               trans.BalanceGL,
               trans.EntryDate
           FROM tbl_07_personal_bio AS bio
           INNER JOIN tbl_12_fin_transaction AS trans
              ON bio.IDNumber = trans.IDNumber
           INNER JOIN tbl_12_fin_account_no AS acc
              ON trans.AccNo = acc.Acc_No
           ORDER BY FullName, trans.EntryDate"
      )->result_array();
  }
}
