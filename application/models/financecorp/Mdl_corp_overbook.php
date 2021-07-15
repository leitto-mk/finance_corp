<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_overbook extends CI_Model
{
    public function get_new_overbook_docno(){
        $iteration = date('Y') . '-' . date('m');
        $docno = $this->db->select('DocNo')
                            ->get_where('tbl_fa_treasury_mas', "DocNo LIKE '$iteration%'")
                            ->num_rows() + 1;

        $docno = $iteration . str_pad($docno, 3, 0, STR_PAD_LEFT);

        return $docno;
    }

    function get_branch(){
        return $this->db->select('BranchCode, BranchName')
                        ->get('abase_02_branch')->result();
    }

    function get_employee(){
        return $this->db->select('IDNumber, FullName, DeptCode, CostCenter')
                        ->get('tbl_fa_hr_append')->result();
    }

    public function get_mas_acc(){
        return $this->db
                ->order_by('Acc_No', 'ASC')
                ->select('Acc_No, Acc_Name, Acc_Type')
                ->where("Acc_No BETWEEN 11100 AND 11299")
                ->where('Acc_No !=', '11100')
                ->where('Acc_No !=', '11200')
                ->get('tbl_fa_account_no')
                ->result();
    }

    public function get_currency(){
        return $this->db->get('tbl_fa_mas_cur')->result();
    }

    public function get_emp_last_balance($nis){
        $query = $this->db->select('Balance')
                      ->limit(1)
                      ->order_by('CtrlNo', 'DESC')
                      ->get_where('tbl_fa_transaction', [
                         'IDNumber' => $nis
                      ])->row();

        return ($query ? $query->Balance : 0);
    }

    public function get_branch_last_balance($branch, $accno, $transdate){
        $query = $this->db->select('BalanceBranch')
                      ->limit(1)
                      ->order_by('TransDate DESC, CtrlNo DESC')
                      ->get_where('tbl_fa_transaction', [
                        'Branch' => $branch,
                        'AccNo' => $accno,
                        'TransDate <=' => $transdate
                      ])->row();

        return ($query ? $query->BalanceBranch : 0);
    }

    public function submit_overbook($master, $details, $trans, $branch, $transdate, $accno_list){
        $this->db->trans_begin();
        
        $this->db->insert_batch('tbl_fa_treasury_mas', $master);
        $this->db->insert_batch('tbl_fa_treasury_det', $details);
        $this->db->insert_batch('tbl_fa_transaction', $trans);

        for($i = 0; $i < count($accno_list); $i++){
            $cur_accno = array_keys($accno_list)[$i];
            $cur_acctype = $this->db->select('AccType')->get_where('tbl_fa_transaction', ['AccNo' => $cur_accno])->row()->AccType;
            $cur_doc_sum = 0;
            
            $cur_doc_debit_sum = $this->db->select('SUM(Debit) AS Debit')->get_where('tbl_fa_transaction', [
                'DocNo' => $_POST['docno'], 
                'Branch' => $branch, 
                'AccNo' => $cur_accno])->row()->Debit;
            $cur_doc_credit_sum = $this->db->select('SUM(Credit) AS Credit')->get_where('tbl_fa_transaction', [
                'DocNo' => $_POST['docno'], 
                'Branch' => $branch, 
                'AccNo' => $cur_accno])->row()->Credit;

            $cur_doc_sum = $cur_doc_debit_sum + $cur_doc_credit_sum;

            if($cur_doc_debit_sum > 0 && ($cur_acctype == 'A' || $cur_acctype == 'E' || $cur_acctype == 'E1')){
                $balance_branch = "trans.BalanceBranch + $cur_doc_sum";
            }elseif($cur_doc_debit_sum > 0 && ($cur_acctype == 'A1' || $cur_acctype == 'L' || $cur_acctype == 'C' || $cur_acctype == 'C1' || $cur_acctype == 'C2' || $cur_acctype == 'R' || $cur_acctype == 'R1')){
                $balance_branch = "trans.BalanceBranch - $cur_doc_sum";
            }elseif($cur_doc_credit_sum > 0 && ($cur_acctype == 'A' || $cur_acctype == 'E' || $cur_acctype == 'E1')){
                $balance_branch = "trans.BalanceBranch - $cur_doc_sum";
            }elseif($cur_doc_credit_sum > 0 && ($cur_acctype == 'A1' || $cur_acctype == 'L' || $cur_acctype == 'C' || $cur_acctype == 'C1' || $cur_acctype == 'C2' || $cur_acctype == 'R' || $cur_acctype == 'R1')){
                $balance_branch = "trans.BalanceBranch + $cur_doc_sum";
            }
        
            $this->db->query(
                "UPDATE tbl_fa_transaction AS trans
                    SET trans.BalanceBranch = $balance_branch
                    WHERE trans.Branch = '$branch'
                    AND trans.AccNo = '$cur_accno'
                    AND trans.TransDate > '$transdate'"
            );
        }

        $this->db->trans_complete();

        return ($this->db->trans_status() ? 'success' : this->db->error());
    }
}