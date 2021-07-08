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

    public function get_branch_last_balance($branch, $accno, $docno, $transdate){
        $query = $this->db->select('BalanceBranch')
                      ->limit(1)
                      ->order_by('DocNo', 'DESC')
                      ->get_where('tbl_fa_transaction', [
                        'Branch' => $branch,
                        'AccNo' => $accno,
                        'DocNo <=' => $docno,
                        'TransDate <=' => $transdate
                      ])->row();

        return ($query ? $query->BalanceBranch : 0);
    }

    public function submit_overbook($master, $details, $trans, $branch, $transdate, $accno_list){
        $this->db->trans_begin();
        
        $this->db->insert_batch('tbl_fa_treasury_mas', $master);
        $this->db->insert_batch('tbl_fa_treasury_det', $details);
        $this->db->insert_batch('tbl_fa_transaction', $trans);

        //IF DOCNO TRANSDATE BELOW CURRENT DATE DO ENTIRE CALCULATION
        $transdate = date('Y-m-d', strtotime($transdate));
        $curdate = date('Y-m-d');
        if($transdate < $curdate){
            for($i = 0; $i < count($accno_list); $i++){
                $cur_accno = array_keys($accno_list)[$i];
                $cur_bal = $accno_list[$cur_accno];

                $this->db->query("
                    UPDATE tbl_fa_transaction
                    SET BalanceBranch = (BalanceBranch + $cur_bal)
                    WHERE Branch = '$branch'
                    AND AccNo = '$cur_accno'
                    AND TransDate > '$transdate'"
                );
            }
        }
        
        $this->db->trans_complete();
        
        return ($this->db->trans_status() ? 'success' : this->db->error());
    }
}