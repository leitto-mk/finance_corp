<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_payment extends CI_Model
{
    public function get_new_payment_docno(){
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
                // ->where_in('Acc_Type', ['A','E'])
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

    public function get_branch_last_balance($branch, $accno){
        $query = $this->db->select('BalanceBranch')
                      ->limit(1)
                      ->order_by('CtrlNo', 'DESC')
                      ->get_where('tbl_fa_transaction', [
                         'Branch' => $branch,
                         'AccNo' => $accno
                      ])->row();

        return ($query ? $query->BalanceBranch : 0);
    }

    // public function get_beg_balance($branch, $accno, $transdate, $docno, $amount){
    //     $query = $this->db->select('Balance')
    //                      ->limit(1)
    //                      ->order_by('CtrlNo', 'DESC')
    //                      ->get_where('tbl_fa_transaction_last_bal', [
    //                          'BranchCode' => $branch,
    //                          'Acc_No' => $accno
    //                      ]);

    //     if($query->num_rows() == 0){
    //         $this->db->insert('tbl_fa_transaction_last_bal', [
    //             'BranchCode' => $branch,
    //             'BranchName' => $this->db->select('BranchName')->get_where('abase_02_branch', ['BranchCode' => $branch])->row()->BranchName,
    //             'Acc_No' => $accno,
    //             'Acc_Name' => $this->db->select('Acc_Name')->get_where('tbl_fa_account_no', ['Acc_No' => $accno])->row()->Acc_Name,
    //             'TransDate' => $transdate,
    //             'DocNo' => $docno,
    //             'Balance' => $amount
    //         ]);

    //         $balance = 0;
    //     }else{
    //         $last_bal = $query->row()->Balance;
            
    //         $this->db->update('tbl_fa_transaction_last_bal', [
    //             'TransDate' => $transdate,
    //             'DocNo' => $docno,
    //             'Balance' => $last_bal + $amount
    //         ], [
    //             'BranchCode' => $branch,
    //             'Acc_No' => $accno
    //         ]);

    //         $balance = $last_bal;
    //     }

    //     return $balance;
    // }

    public function submit_payment($master, $details, $trans){
        $this->db->trans_begin();
        
        $this->db->insert_batch('tbl_fa_treasury_mas', $master);
        $this->db->insert_batch('tbl_fa_treasury_det', $details);
        $this->db->insert_batch('tbl_fa_transaction', $trans);
        
        $this->db->trans_complete();
        
        return ($this->db->trans_status() ? 'success' : this->db->error());
    }
}