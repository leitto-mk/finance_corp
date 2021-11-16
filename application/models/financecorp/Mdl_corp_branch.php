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
                      ->where_not_in('TransGroup',['H1','H2','H3'])
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

      $year = date('Y', strtotime($datestart));

      //GET RESULT IN SELECTED DATE RANGE
      $ondate_selected_result = $this->db->query(
         "SELECT 
            company.ComCode,
            company.ComName,
            CONCAT(company.Address,', ',company.City,', ',company.Province,', ',company.PostalCode) AS Address,
            CONCAT(company.PhoneNo,'/',company.ContactNo) AS Contact,
            company.Email,
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
             WHERE AccNo = acc.Acc_No 
             AND Branch = trans.Branch
             AND IF(
               AccType IN('R','E'),
               TransDate >= '$year-01-01' AND TransDate < '$datestart',
               TransDate < '$datestart'
             )
             ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1) AS beg_balance,
            trans.Balance,
            trans.BalanceBranch,
            trans.EntryDate
          FROM tbl_fa_transaction AS trans
          LEFT JOIN tbl_fa_account_no AS acc
            ON trans.AccNo = acc.Acc_No
          LEFT JOIN abase_01_com AS company
            ON trans.Branch = company.ComCode
          WHERE $branch_condition
          AND trans.TransDate BETWEEN '$datestart' AND '$datefinish'
          AND trans.AccNo BETWEEN $accno_start AND $accno_finish
          AND trans.PostedStatus = 1
          ORDER BY AccNo, Branch, TransDate, CtrlNo, DocNo ASC"
      )->result_array();

      //GET RUNNING BALANCE OF EACH EXCLUDED ACCNO IN SELECTED DATE RANGE
      $other_accno_result = $this->db->query(
         "SELECT 
            trans.AccNo,
            acc.Acc_Name,
            acc.Acc_Type,
            trans.TransDate,
            trans.Branch,
            trans.Remarks,
            trans.DocNo,
            trans.TransType,
            trans.Department,
            trans.CostCenter,
            trans.Currency,
            trans.Debit,
            trans.Credit,
            trans.BalanceBranch,
            trans.BalanceBranch AS beg_balance
          FROM tbl_fa_transaction AS trans
          LEFT JOIN tbl_fa_account_no AS acc
            ON trans.AccNo = acc.Acc_No
          WHERE AccNo NOT IN (
             SELECT AccNo 
             FROM tbl_fa_transaction 
             WHERE TransDate 
             BETWEEN ? AND ?
             GROUP BY AccNo
          )
          AND TransDate < ?
          AND CtrlNo IN (SELECT MAX(CtrlNo) FROM tbl_fa_transaction WHERE AccNo = trans.AccNo)
          ORDER BY TransDate DESC, CtrlNo DESC"
      ,[
         $datestart, $datefinish, $datestart
      ])->result_array();

      $result = array_merge($ondate_selected_result, $other_accno_result);
      
      usort($result, function ($item, $compare){
         return $item['AccNo'] > $compare['AccNo'] ? 1 : -1;
      });

      return $result;
   }

   function recalculate_balance($branch, $accno_start, $accno_finish, $date_start, $date_finish){

      if($branch == 'All' || $branch == ''){
         $branch_condition = "trans.Branch IS NOT NULL";
      }else{
         $branch_condition = "trans.Branch = '$branch'";
      }

      $year = date('Y', strtotime($date_start));

      $query = $this->db->query(
            "SELECT 
               trans.CtrlNo,
               trans.DocNo,
               acc.Acc_Name,
               trans.AccType,
               trans.TransDate, 
               trans.TransType, 
               trans.JournalGroup,
               trans.Branch,
               trans.Department,
               trans.CostCenter,
               trans.AccNo,
               trans.IDNumber,
               trans.Remarks,
               trans.Debit,
               trans.Credit, 
               trans.Currency,
               CASE
                    WHEN (SELECT YEAR(TransDate) 
                          FROM tbl_fa_transaction 
                          WHERE AccNo = acc.Acc_No 
                          AND Branch = trans.Branch
                          AND TransDate < '$date_start'
                          ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1) < YEAR('$date_start')
                        AND trans.AccType IN('R','E') THEN
                        0
                    ELSE
                        (SELECT BalanceBranch
                          FROM tbl_fa_transaction 
                          WHERE AccNo = acc.Acc_No 
                          AND Branch = trans.Branch
                          AND TransDate < '$date_start'
                          ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1)
               END AS beg_balance,
               trans.Balance,
               trans.BalanceBranch,
               trans.EntryDate,
               trans.EntryBy
             FROM tbl_fa_transaction AS trans
             LEFT JOIN tbl_fa_account_no AS acc
               ON trans.AccNo = acc.Acc_No
             WHERE $branch_condition
             AND trans.AccNo BETWEEN CAST('$accno_start' AS DECIMAL) AND CAST('$accno_finish' AS DECIMAL)
             AND acc.TransGroup NOT IN('H1','H2','H3')
             AND IF(
               acc.Acc_Type IN('R','E'),
               trans.TransDate >= '$year-01-01' AND TransDate < '$date_finish',
               trans.TransDate BETWEEN '$date_start' AND '$date_finish'
             )
             AND trans.PostedStatus = 1
             ORDER BY AccNo, Branch, TransDate, CtrlNo, DocNo ASC"
      )->result_array();

      $lastBalance = 0;
      if(!empty($query)){
         if($query[0]['beg_balance'] !== '' || is_null($query[0]['beg_balance']) == false){
               $lastBalance = (int)$query[0]['beg_balance'];
         }
      }

      for($i = 0; $i < count($query); $i++){

         $debit = (int)$query[$i]['Debit'];
         $credit = (int)$query[$i]['Credit'];

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
      
      // $this->db->delete('tbl_fa_transaction', [
      //       'TransDate >=' => $date_start,
      //       'Branch' => $branch
      // ]);

      $this->db->update_batch('tbl_fa_transaction', $query, 'CtrlNo');
      
      $this->db->trans_complete();
      
      return ($this->db->trans_status() ? 'success' : $this->db->error());
   }
}
