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

      $start = $finish = '';
      if(strtotime($datestart) < strtotime($datefinish)){
         $start = $datestart;
         $finish = $datefinish;
      }else{
         $start = $datefinish;
         $finish = $datestart;
      }

      $last_retainingsum = $this->db->select('RetainingSum')
                                    ->where($branch_condition)
                                    ->where("Year = YEAR(DATE_SUB('$finish', INTERVAL 1 YEAR))")
                                    ->where("Month = 12")
                                    ->get('tbl_fa_retaining_earning AS trans')->row()->RetainingSum ?? 0;

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
            trans.Balance,
            CASE 
               WHEN trans.AccType = 'C1' THEN
                  trans.BalanceBranch + $last_retainingsum
               ELSE
                  trans.BalanceBranch
            END AS BalanceBranch,
            CASE
               WHEN (SELECT YEAR(TransDate) 
                     FROM tbl_fa_transaction 
                     WHERE AccNo = acc.Acc_No 
                     AND Branch = trans.Branch
                     AND TransDate < '$start'
                     ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1) < YEAR('$start')
                  AND (trans.AccType = 'R' OR trans.AccType = 'E') THEN
                  0
               WHEN trans.AccType = 'C1' THEN
                  (SELECT BalanceBranch
                   FROM tbl_fa_transaction 
                   WHERE AccNo = acc.Acc_No 
                   AND Branch = trans.Branch
                   AND TransDate < '$start'
                   ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1)
                   + $last_retainingsum 
               ELSE
                  (SELECT BalanceBranch
                     FROM tbl_fa_transaction 
                     WHERE AccNo = acc.Acc_No 
                     AND Branch = trans.Branch
                     AND TransDate < '$start'
                     ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1)
            END AS beg_balance,
            trans.EntryDate
          FROM tbl_fa_transaction AS trans
          LEFT JOIN tbl_fa_account_no AS acc
            ON trans.AccNo = acc.Acc_No
          LEFT JOIN abase_01_com AS company
            ON trans.Branch = company.ComCode
          WHERE $branch_condition
          AND trans.TransDate BETWEEN '$start' AND '$finish'
          AND trans.AccNo BETWEEN $accno_start AND $accno_finish
          AND trans.PostedStatus = 1
          ORDER BY AccNo, Branch, TransDate, CtrlNo, DocNo ASC"
      )->result_array();

      //GET RUNNING BALANCE OF EACH EXCLUDED ACCNO IN SELECTED DATE RANGE
      $other_accno_result = $this->db->query(
         "SELECT 
            company.ComCode,
            company.ComName,
            CONCAT(company.Address,', ',company.City,', ',company.Province,', ',company.PostalCode) AS Address,
            CONCAT(company.PhoneNo,'/',company.ContactNo) AS Contact,
            company.Email,
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
            CASE 
               WHEN trans.AccType = 'C1' THEN
                  trans.BalanceBranch + $last_retainingsum
               ELSE
                  trans.BalanceBranch
            END AS BalanceBranch,
            CASE
                  WHEN (SELECT YEAR(TransDate) 
                        FROM tbl_fa_transaction 
                        WHERE AccNo = acc.Acc_No 
                        AND Branch = trans.Branch
                        AND TransDate < ?
                        ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1) < YEAR(?)
                     AND (trans.AccType = 'R' OR trans.AccType = 'E') THEN
                     0
                  WHEN trans.AccType = 'C1' THEN
                     (SELECT BalanceBranch
                     FROM tbl_fa_transaction 
                     WHERE AccNo = acc.Acc_No 
                     AND Branch = trans.Branch
                     AND TransDate < ?
                     ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1)
                     + $last_retainingsum
                  ELSE
                     (SELECT BalanceBranch
                        FROM tbl_fa_transaction 
                        WHERE AccNo = acc.Acc_No 
                        AND Branch = trans.Branch
                        AND TransDate < ?
                        ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1)
            END AS beg_balance
          FROM tbl_fa_transaction AS trans
          LEFT JOIN tbl_fa_account_no AS acc
            ON trans.AccNo = acc.Acc_No
          LEFT JOIN abase_01_com AS company
            ON trans.Branch = company.ComCode
          WHERE AccNo NOT IN (
             SELECT AccNo 
             FROM tbl_fa_transaction 
             WHERE TransDate 
             BETWEEN ? AND ?
             GROUP BY AccNo
          )
          AND AccNo BETWEEN ? AND ?
          AND TransDate IN (
             SELECT MAX(TransDate) 
             FROM tbl_fa_transaction 
             WHERE AccNo = trans.AccNo
             AND TransDate < ?
          )
          ORDER BY trans.TransDate DESC, trans.CtrlNo DESC"
      ,[
         $datestart, $datestart, $datestart, $datestart, $datestart, $datefinish, $accno_start, $accno_finish, $datestart
      ])->result_array();

      $result = array_merge($ondate_selected_result, $other_accno_result);
      
      usort($result, function ($item, $compare){
         return $item['AccNo'] > $compare['AccNo'] ? 1 : -1;
      });

      return $result;
   }

   function recalculate_balance($branch, $accno_start, $accno_finish, $date_start, $date_finish){

      if($branch == 'All' || $branch == ''){
         $branch_condition = "Branch IS NOT NULL";
      }else{
         $branch_condition = "Branch = '$branch'";
      }

      $this->db->trans_begin();

      //SUBSTRACT `date_start` by one month
      $date_start = new DateTime($date_start);
      $date_start->modify("-1 month");
      $date_start = $date_start->format('Y-m-d');

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
                    WHEN YEAR(trans.TransDate) < YEAR('$date_finish') AND trans.AccType IN('R','E') THEN
                        0
                    ELSE
                        (SELECT BalanceBranch
                          FROM tbl_fa_transaction 
                          WHERE AccNo = acc.Acc_No 
                          AND Branch = trans.Branch
                          AND TransDate < '$date_start'
                          AND CtrlNo < trans.CtrlNo
                          ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1)
               END AS beg_balance,
               trans.Balance,
               trans.BalanceBranch,
               trans.EntryDate,
               trans.EntryBy
             FROM tbl_fa_transaction AS trans
             LEFT JOIN tbl_fa_account_no AS acc
               ON trans.AccNo = acc.Acc_No
             WHERE trans.$branch_condition
             AND trans.AccNo BETWEEN CAST('$accno_start' AS DECIMAL) AND CAST('$accno_finish' AS DECIMAL)
             AND acc.TransGroup NOT IN('H1','H2','H3')
             AND trans.TransDate BETWEEN '$date_start' AND '$date_finish'
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

         /*
         * IF CURRENT INDEX'S YEAR NOT EQUAL TO PREVIOUS INDEX'S AND ACCTYPE EITHER 'R' OR 'E',
         * SET BEGINNING BALANCE TO 0  
         */ 
         if($i > 0 && date('Y', strtotime($query[$i-1]['TransDate'])) !== date('Y', strtotime($query[$i]['TransDate'])) && ($query[$i]['AccType'] == 'R' || $query[$i]['AccType'] == 'E')){
            $lastBalance = 0;
         }

         if($debit > 0 && ($query[$i]['AccType'] == 'A' || $query[$i]['AccType'] == 'E' || $query[$i]['AccType'] == 'E1')){
            $query[$i]['BalanceBranch'] = $debit + $lastBalance;
         }elseif($credit > 0 && ($query[$i]['AccType'] == 'A' || $query[$i]['AccType'] == 'E' || $query[$i]['AccType'] == 'E1')){
            $query[$i]['BalanceBranch'] = $lastBalance - $credit;
         }elseif($credit > 0 && ($query[$i]['AccType'] == 'L' || $query[$i]['AccType'] == 'C' || $query[$i]['AccType'] == 'R' || $query[$i]['AccType'] == 'A1' || $query[$i]['AccType'] == 'R1' || $query[$i]['AccType'] == 'C1' || $query[$i]['AccType'] == 'C2')){
            $query[$i]['BalanceBranch'] = $credit + $lastBalance;
         }elseif($debit > 0 && ($query[$i]['AccType'] == 'L' || $query[$i]['AccType'] == 'C' || $query[$i]['AccType'] == 'R' || $query[$i]['AccType'] == 'A1' || $query[$i]['AccType'] == 'R1' || $query[$i]['AccType'] == 'C1' || $query[$i]['AccType'] == 'C2')){
            $query[$i]['BalanceBranch'] = $lastBalance - $debit;
         }

         if($i+1 < count($query)){
            /*
            * IF NEXT INDEX ACCNO IS DIFFERENT THAN CURRENT INDEX'S,
            * SET THE `lastBalance` TO NEXT INDEX'S BEGINNING BALANCE
            */
            if($query[$i]['AccNo'] !== $query[$i+1]['AccNo'] || $query[$i]['Branch'] !== $query[$i+1]['Branch']){
               if($query[$i]['beg_balance'] !== '' || is_null($query[$i]['beg_balance']) == false){
                  $query[$i+1]['beg_balance'] = (is_null($query[$i+1]['beg_balance']) ? 0 : $query[$i+1]['beg_balance']);
               
                  $lastBalance = (int) $query[$i+1]['beg_balance'];
               }else{
                  $lastBalance = 0;
               }
            }else{
               $lastBalance = $query[$i]['BalanceBranch'];
            }
         }

         //Remove Unnecessary 'Key'
         unset($query[$i]['Acc_Name']);
         unset($query[$i]['beg_balance']);
      }

      $this->db->update_batch('tbl_fa_transaction', $query, 'CtrlNo');
      
      $this->db->trans_complete();
      
      return ($this->db->trans_status() ? 'success' : $this->db->error());
   }
}
