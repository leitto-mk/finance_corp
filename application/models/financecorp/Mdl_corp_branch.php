<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_branch extends CI_Model
{
   function get_active_school(){
      return $this->db->select('School_Desc, SchoolName')
                      ->get_where('tbl_02_school', ['isActive' => 1])->result();
   }

   function get_account_no(){
      return $this->db->select('Acc_No, Acc_Name')
                      ->order_by('Acc_No', 'ASC')   
                      ->get('tbl_12_fin_account_no')->result();
   }

   function get_general_ledger($branch, $accno_start, $accno_finish, $datestart, $datefinish){

      if($branch == 'All' || $branch == ''){
         $branch_condition = "trans.Branch IS NOT NULL";
      }else{
         $branch_condition = "trans.Branch = '$branch'";
      }

      $result = $this->db->query(
         "SELECT 
            trans.CtrlNo,
            trans.DocNo,
            acc.Acc_Name,
            trans.TransType, 
            DATE_FORMAT(trans.TransDate, '%d-%m-%Y') AS TransDate, 
            trans.Branch,
            trans.Department,
            trans.CostCenter,
            trans.AccNo,
            trans.Remarks,
            trans.Debit, 
            trans.Credit, 
            trans.Balance,
            trans.BalanceBranch,
            trans.BalanceGL,
            trans.EntryDate
          FROM tbl_12_fin_transaction AS trans
          LEFT JOIN tbl_12_fin_account_no AS acc
            ON trans.AccNo = acc.Acc_No
          WHERE $branch_condition
          AND trans.AccNo BETWEEN '$accno_start' AND '$accno_finish'
          AND trans.TransDate BETWEEN '$datestart' AND '$datefinish'
          ORDER BY Branch, CtrlNo"
      )->result_array();

      return $result;
   }
}
