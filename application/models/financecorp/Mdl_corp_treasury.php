<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_treasury extends CI_Model
{
    function get_annual_treasury($type, $docno, $start, $end){
        if($docno){
            $docno_condition = "DocNo LIKE '$docno%'";
        }else{
            $docno_condition = "DocNo IS NOT NULL";
        }

        // return $this->db->where("TransDate BETWEEN '$start' AND '$end'")
        //                 ->where($docno_condition)
        //                 ->where('TransType', $type)
        //                 ->order_by('TransDate','DESC')
        //                 ->get('tbl_fa_treasury_mas')
        //                 ->result_array();

        $query = $this->db->query(
            "SELECT
                t1.IDNumber,
                t1.TransDate,
                t1.DocNo,
                t1.TransType,
                t1.Branch,
                t2.BranchName,
                t1.Remarks,
                t1.TotalAmount
             FROM tbl_fa_treasury_mas AS t1
             LEFT JOIN abase_02_branch AS t2
                ON t1.Branch = t2.BranchCode
             WHERE t1.TransDate BETWEEN '$start' AND '$end'
             AND t1.TransType = '$type'
             AND t1.$docno_condition
             ORDER BY TransDate DESC"
        )->result_array();

        return $query;
    }

    function get_new_treasury_docno($type){
        $iteration = date('Y') . '-' . $type . date('m');
        $docno = $this->db->select('DocNo')
                          ->get_where('tbl_fa_treasury_mas', "DocNo LIKE '$iteration%'")
                          ->num_rows() + 1;

        $docno = $iteration . str_pad($docno, 3, 0, STR_PAD_LEFT);

        return $docno;
    }

    function get_docno_details($docno){
        return $this->db->select("t1.*, t2.IDNumber AS PaidTo, t2.Giro")
                        ->join('tbl_fa_treasury_mas AS t2', 't1.DocNo = t2.DocNo', 'LEFT')
                        ->order_by('t1.CtrlNo', 'ASC')
                        ->get_where('tbl_fa_transaction AS t1', ['t1.DocNo' => $docno])->result_array();
    }

    function get_docno_accnos($docno){
        return $this->db->group_by('AccNo')
                        ->select('AccNo')
                        ->get_where('tbl_fa_transaction', ['DocNo' => $docno])
                        ->result_array();
    }

    function get_branch(){
        return $this->db->select('BranchCode, BranchName')
                        ->get('abase_02_branch')->result();
    }

    function get_employee(){
        return $this->db->select('IDNumber, FullName, DeptCode, Branch, CostCenter')
                        ->get('tbl_fa_hr_append')->result_array();
    }

    function get_mas_acc(){
        $query = $this->db
                ->order_by('Acc_No', 'ASC')
                ->select('Acc_No, Acc_Name, Acc_Type, TransGroup')
                ->where_not_in('TransGroup', ['H1','H2','H3'])
                ->get('tbl_fa_account_no')->result_array();

        return $query;
    }

    function get_last_trans_date(){
        $query = $this->db->select('TransDate')
                        ->group_by('TransDate')
                        ->order_by('TransDate','DESC')
                        ->limit(1)
                        ->get('tbl_fa_transaction')->row();

        return $query ? $query->TransDate : date('Y-m-d');
    }

    function get_currency(){
        return $this->db->get('tbl_fa_mas_cur')->result();
    }

    function get_accno_last_balance($accno){
        $query = $this->db->select('Balance')
                      ->limit(1)
                      ->order_by('CtrlNo', 'DESC')
                      ->get_where('tbl_fa_transaction', [
                         'AccNo' => $accno
                      ])->row();

        return ($query ? $query->Balance : 0);
    }
    
    function get_branch_last_balance($branch, $accno, $transdate){
        //Get AccNo Type
        $acc_type = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $accno])->row()->Acc_Type;

        $query = $this->db->select('BalanceBranch')->limit(1)->order_by('EntryDate DESC, CtrlNo DESC');
        
        //IF AccType either R/E, don't get running balance from Last Year,
        //ELSE is permitable
        if($acc_type == 'R' || $acc_type == 'E'){
            $query = $this->db->where("YEAR(TransDate) = YEAR('$transdate')");
        }else{
            $query = $this->db->where("TransDate <= '$transdate'");
        }

        $query = $this->db->get_where('tbl_fa_transaction', [
                                        'Branch' => $branch,
                                        'AccNo' => $accno
                                    ])->row();

        return ($query ? $query->BalanceBranch : 0);
    }

    function delete_existed_docno($docno){
        $this->db->query(
            "DELETE t1, t2, t3
             FROM tbl_fa_treasury_mas AS t1
             LEFT JOIN tbl_fa_treasury_det AS t2
                 USING(DocNo)
             LEFT JOIN tbl_fa_transaction AS t3
                  USING(DocNo)
             WHERE t1.DocNo = '$docno'"
        );
    }

    function submit_treasury($master, $details, $trans){
        $this->db->trans_begin();
        
        $this->db->insert_batch('tbl_fa_treasury_mas', $master);
        $this->db->insert_batch('tbl_fa_treasury_det', $details);
        $this->db->insert_batch('tbl_fa_transaction', $trans);

        $this->db->trans_complete();

        return ($this->db->trans_status() ? 'success' : $this->db->error());
    }

    function calculate_balance($branch, $accno, $date_start, $date_finish){
        if($branch == 'All' || $branch == ''){
            $branch_condition = "trans.Branch IS NOT NULL";
        }else{
            $branch_condition = "trans.Branch = '$branch'";
        }

        $start = $finish = '';
        if(strtotime($date_start) < strtotime($date_finish)){
            $start = $date_start;
            $finish = $date_finish;
        }else{
            $start = $date_finish;
            $finish = $date_start;
        }
     
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
                          AND TransDate < '$start'
                          ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1) < YEAR('$start')
                        AND (trans.AccType = 'R' OR trans.AccType = 'E') THEN
                        0
                    ELSE
                        (SELECT BalanceBranch
                          FROM tbl_fa_transaction 
                          WHERE AccNo = acc.Acc_No 
                          AND Branch = trans.Branch
                          AND TransDate < '$start'
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
             AND trans.AccNo IN ($accno)
             AND trans.TransDate BETWEEN '$start' AND '$finish'
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
            if($i > 0 && date('Y', strtotime($query[$i-1]['TransDate']) !== date('Y', strtotime($query[$i]['TransDate']))) && ($query[$i]['AccType'] == 'R' || $query[$i]['AccType'] == 'E')){
                $lastBalance = 0;
            }
        
            if($debit > 0 && $query[$i]['AccType'] == 'A' || $query[$i]['AccType'] == 'E' || $query[$i]['AccType'] == 'E1'){
               $query[$i]['BalanceBranch'] = $debit + $lastBalance;
            }elseif($credit > 0 && $query[$i]['AccType'] == 'A' || $query[$i]['AccType'] == 'E' || $query[$i]['AccType'] == 'E1'){
               $query[$i]['BalanceBranch'] = $lastBalance - $credit;
            }elseif($credit > 0 && $query[$i]['AccType'] == 'L' || $query[$i]['AccType'] == 'C' || $query[$i]['AccType'] == 'R' || $query[$i]['AccType'] == 'A1' || $query[$i]['AccType'] == 'R1' || $query[$i]['AccType'] == 'C1' || $query[$i]['AccType'] == 'C2'){
               $query[$i]['BalanceBranch'] = $credit + $lastBalance;
            }else{
               $query[$i]['BalanceBranch'] = $lastBalance - $debit;
            }
        
            /*
            * IF NEXT INDEX ACCNO IS DIFFERENT THAN CURRENT INDEX'S,
            * SET THE `lastBalance` TO NEXT INDEX'S BEGINNING BALANCE
            */
            if($i+1 < count($query)){
                if($query[$i]['AccNo'] !== $query[$i+1]['AccNo'] || $query[$i]['Branch'] !== $query[$i+1]['Branch']){
                    if($query[$i]['beg_balance'] !== '' || is_null($query[$i]['beg_balance']) == false){
                        $lastBalance = (int)$query[$i]['beg_balance'];
                    }else{
                        $lastBalance = 0;
                    }
                }else{
                    $lastBalance = $query[$i]['BalanceBranch'];
                }
            }
        
            //REMOVE UNNECESSARY 'KEY' TO PREVENT UPDATE_BATCH FROM CRASHING
            unset($query[$i]['Acc_Name']);
            unset($query[$i]['beg_balance']);
        }
    
        $this->db->update_batch('tbl_fa_transaction', $query, 'CtrlNo');
        
        return ($this->db->trans_status() ? 'success' : $this->db->error());
    }

    //GENERATE TREASURY REPORTS
    function get_treasury_report($type, $docno, $branch, $transdate){
        $query =  $this->db->query(
            "SELECT 
                trans.*,
                acc.Acc_Name
             FROM tbl_fa_transaction AS trans
             JOIN tbl_fa_account_no AS acc
                ON trans.AccNo = acc.Acc_No
             WHERE trans.Docno = '$docno'
             AND trans.Branch = '$branch'
             AND trans.TransDate = '$transdate'
             AND trans.TransType = '$type'
             ORDER BY ItemNo ASC"
        )->result_array();

        return $query;
    }
}