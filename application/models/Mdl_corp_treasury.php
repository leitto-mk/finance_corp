<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_treasury extends CI_Model
{
    function get_ranged_treasury($type, $docno, $start, $end){
        if($docno){
            $docno_condition = "DocNo LIKE '$docno%'";
        }else{
            $docno_condition = "DocNo IS NOT NULL";
        }

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
             ORDER BY TransDate DESC, DocNo DESC"
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
        return $this->db->order_by('AccNo', 'ASC')
                        ->group_by('AccNo')
                        ->select('AccNo')
                        ->get_where('tbl_fa_transaction', ['DocNo' => $docno])
                        ->result_array();
    }

    function get_branch(){
        return $this->db->select('BranchCode, BranchName')
                        ->get('abase_02_branch')->result();
    }

    function get_employee(){
        $query = $this->db->query(
            "SELECT
                emp.IDNumber,
                emp.FullName,
                emp.DeptCode,
                emp.Branch,
                emp.CostCenter,
                IF(trans.Balance IS NULL, 0, trans.Balance) AS Balance
             FROM tbl_fa_hr_append AS emp
             LEFT JOIN (SELECT Branch, IDNumber, Balance FROM tbl_fa_transaction ORDER BY CtrlNo DESC LIMIT 1) AS trans
                ON emp.IDNumber = trans.IDNumber AND emp.Branch = trans.Branch"
        )->result_array();
        
        return $query;
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

    function get_emp_last_balance($branch, $id){
        $query = $this->db->select('Balance')
                      ->limit(1)
                      ->order_by('CtrlNo', 'DESC')
                      ->get_where('tbl_fa_transaction', [
                            'Branch' => $branch,
                            'IDNumber' => $id
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

    function submit_treasury($master, $details, $trans, $branch, $cur_date){
        $this->db->trans_begin();
        
        $this->db->insert_batch('tbl_fa_treasury_mas', $master);
        $this->db->insert_batch('tbl_fa_treasury_det', $details);
        $this->db->insert_batch('tbl_fa_transaction', $trans);

        //Calculate Monthly Retaining Earning
        $is_retaining_curmonth_exist = $this->db->query(
            "SELECT COUNT(Month) AS Total FROM tbl_fa_retaining_earning
               WHERE Branch = '$branch'
               AND Month = YEAR('$cur_date')
               AND Year = MONTH('$cur_date')"
         )->row()->Total;
   
         $year = date('Y', strtotime($cur_date));
         $month = date('m', strtotime($cur_date));
   
         if($is_retaining_curmonth_exist > 0){
            $this->db->query("CALL retaining_earnings_update('$branch',$year,$month)");
         }else{
            $this->db->query("CALL retaining_earnings_insert('$branch',$year,$month)");
         }

        $this->db->trans_complete();

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

    //CASH ADVANCE REPORT
    function get_ca_employees(){
        $query = $this->db->select('
            IDNumber,
            FullName
        ')->order_by('IDNumber ASC')->get_where('tbl_fa_hr_append')->result_array();

        return $query;
    }

    function get_ca_registered_ids($id){
        $query = $this->db->query(
            "SELECT
                emp.IDNumber,
                emp.FullName,
                emp.JobTitle,
                emp.JobTitleDes,
                emp.Supervisor,
                emp.SupervisorName,
                trans.DocNo,
                trans.TransDate,
                trans.Branch,
                trans.Department,
                trans.CostCenter,
                trans.Remarks,
                trans.AccNo,
                trans.AccType,
                trans.Debit,
                trans.Credit,
                trans.Balance
             FROM tbl_fa_hr_append AS emp
             LEFT JOIN tbl_fa_transaction AS trans
                ON emp.IDNumber = trans.IDNumber
            WHERE emp.IDNumber = ?
            ORDER BY trans.TransDate DESC, trans.CtrlNo DESC"
        , $id)->result_array();

        return $query;
    }
}