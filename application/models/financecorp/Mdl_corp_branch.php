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

   function recalculate_balance($branch, $accno_start, $accno_finish, $date_start, $date_finish){

      if($branch == 'All' || $branch == ''){
         $branch_condition = "trans.Branch IS NOT NULL";
      }else{
         $branch_condition = "trans.Branch = '$branch'";
      }

      $date = date('Y-01-01');

      $query = $this->db->query(
         "SELECT 
            trans.CtrlNo,
            trans.DocNo,
            acc.Acc_Name,
            trans.AccType,
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
             AND TransDate < '$date_start'
             ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1) AS beg_balance,
            trans.Balance,
            trans.BalanceBranch,
            trans.EntryDate
          FROM tbl_fa_transaction AS trans
          LEFT JOIN tbl_fa_account_no AS acc
            ON trans.AccNo = acc.Acc_No
          WHERE $branch_condition
          AND trans.AccNo BETWEEN $accno_start AND $accno_finish
          AND trans.TransDate BETWEEN '$date_start' AND '$date_finish'
          AND trans.PostedStatus = 1
          ORDER BY AccNo, Branch, TransDate, DocNo, CtrlNo ASC"
      )->result_array();

      // print("<pre>".print_r($query,true)."</pre>");
      // die();

      $lastBalance = (int)(is_null($query[0]['beg_balance']) ? 0 : $query[0]['beg_balance']);

      for($i = 0; $i < count($query); $i++){

         $debit = (int)$query[$i]['Debit'];
         $credit = (int)$query[$i]['Credit'];

         $typedeb = gettype($debit);
         $typecre = gettype($credit);

         if($debit > 0 && $query[$i]['AccType'] == 'A' || $query[$i]['AccType'] == 'E' || $query[$i]['AccType'] == 'E1'){
            $query[$i]['BalanceBranch'] = $debit + $lastBalance;
         }elseif($credit > 0 && $query[$i]['AccType'] == 'A' || $query[$i]['AccType'] == 'E' || $query[$i]['AccType'] == 'E1'){
            $query[$i]['BalanceBranch'] = $lastBalance - $credit;
         }elseif($credit > 0 && $query[$i]['AccType'] == 'L' || $query[$i]['AccType'] == 'C' || $query[$i]['AccType'] == 'R' || $query[$i]['AccType'] == 'A1' || $query[$i]['AccType'] == 'R1' || $query[$i]['AccType'] == 'C1' || $query[$i]['AccType'] == 'C2'){
            $query[$i]['BalanceBranch'] = $credit + $lastBalance;
         }else{
            $query[$i]['BalanceBranch'] = $lastBalance - $debit;
         }

         $lastBalance = $query[$i]['BalanceBranch'];

         if($i < (count($query)-1)){
            if($query[$i]['AccNo'] !== $query[$i+1]['AccNo'] || $query[$i]['Branch'] !== $query[$i+1]['Branch']){
               $lastBalance = (int)$query[$i+1]['beg_balance'];
            }
         }

         //Remove Unnecessary 'Key'
         unset($query[$i]['Acc_Name']);
         unset($query[$i]['beg_balance']);
      }

      $this->db->trans_begin();
      
      $this->db->delete('tbl_fa_transaction', [
            'TransDate >=' => $date_start,
            'Branch' => $branch
      ]);

      $this->db->update_batch('tbl_fa_transaction', $query, 'CtrlNo');
      
      $this->db->trans_complete();
      
      return ($this->db->trans_status() ? 'success' : this->db->error());
   }
}
