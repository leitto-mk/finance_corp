<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_branch extends CI_Model
{
   function get_branch(){
      return $this->db->select('BranchCode, BranchName')
                      ->get('abase_02_branch')->result();
   }

   function get_account_no(){
      return $this->db->select('Acc_No, Acc_Name')
                      ->order_by('Acc_No', 'ASC')
                      ->get_where('tbl_fa_account_no', [
                        'Acc_Type !=' => 'H'
                      ])   
                      ->result();
   }

   function get_general_ledger($branch, $accno_start, $accno_finish, $datestart, $datefinish){

      if($branch == 'All' || $branch == ''){
         $branch_condition = "trans.Branch IS NOT NULL";
      }else{
         $branch_condition = "trans.Branch = '$branch'";
      }

      $date = date('Y-01-01');

      $result = $this->db->query(
         "SELECT 
            trans.CtrlNo,
            trans.DocNo,
            acc.Acc_Name,
            acc.Acc_Type,
            trans.TransType, 
            trans.TransDate, 
            trans.Branch,
            trans.Department,
            trans.CostCenter,
            trans.AccNo,
            trans.Remarks,
            trans.Debit,
            trans.Credit, 
            trans.Currency,
            (SELECT BalanceBranch 
             FROM tbl_fa_transaction 
             WHERE AccNo = trans.AccNo 
             AND Branch = trans.Branch
             AND TransDate < '$datestart'
             ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1) AS beg_balance,
            trans.Balance,
            trans.BalanceBranch,
            trans.EntryDate
          FROM tbl_fa_transaction AS trans
          LEFT JOIN tbl_fa_account_no AS acc
            ON trans.AccNo = acc.Acc_No
          WHERE $branch_condition
          AND trans.AccNo BETWEEN $accno_start AND $accno_finish
          AND trans.TransDate BETWEEN '$datestart' AND '$datefinish'
          AND trans.PostedStatus = 1
          ORDER BY AccNo, Branch, TransDate, DocNo, CtrlNo ASC"
      )->result_array();

      return $result;
   }
}
