<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_cashdisbursement extends CI_Model
{
    public function select($query) {
        $sql = $this->db->query($query);
        return $sql->result();
    }
    
    // public function insert($table, $data) {
    //     $this->db->insert($table, $data);
    // }

    function insert($table, $data) {
        $query = $this->db->insert($table, $data);
        // print_r($this->db->last_query());
        // die();
        if ($query) {
            # code...
            return true;
        }else{ 
            return false;
        }
    }
    
    public function update($table, $data, $where) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    
    public function delete($table, $where) {
        $this->db->where($where); 
        $this->db->delete($table);
    }

    function get_cur_user(){
        $idn = $this->session->userdata('IDNumber');
        $data = $this->db->query("SELECT IDNumber  FROM tbl_credentials where IDNumber = '$idn'");
        if ($user->num_rows() > 0) {
            return $user->result();
        }else{
            return null;
        }
    }

    //Get Increment ID
   function getidcashauto(){
        $this->db->select('CashCode');
        $this->db->from('tbl_cash_voucher_mas');
        $this->db->limit(1);
        $this->db->order_by('CashCode','DESC');
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->result();
        }else{
            return null;
        }
    } 

    //Start Master Form
    function get_all_school_dropdown(){
        $this->db->select('SchoolID ,SchoolName');
        $this->db->from('tbl_02_school');
        $this->db->order_by('SchoolID','ASC');
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->result();
        }else{
            return null;
        }
    }
    function get_data_school_save($id){
        $data = $this->db->query("SELECT a.Branch,b.SchoolName FROM tbl_cash_voucher_mas a LEFT JOIN tbl_02_school b ON b.SchoolID = a.Branch WHERE a.CashCode = '$id' AND a.StatusPost = 'Save'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_all_costcenter_dropdown(){
        $this->db->select('CostCenter ,CCDes');
        $this->db->from('abase_04_cost_center');
        $this->db->order_by('CostCenter','ASC');
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->result();
        }else{
            return null;
        }
    }
    function get_data_costcenter_save($id){
        $data = $this->db->query("SELECT a.CostCenterCode,b.CCDes FROM tbl_cash_voucher_mas a LEFT JOIN abase_04_cost_center b ON b.CostCenter = a.CostCenterCode WHERE a.CashCode = '$id' AND a.StatusPost = 'Save'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_all_personal_teacher_staff_dropdown(){
        $this->db->select('IDNumber, FirstName, MiddleName, LastName');
        $this->db->from('tbl_07_personal_bio');
        $this->db->where("status in ('teacher','staff')");
        $this->db->order_by('IDNumber','ASC');
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->result();
        }else{
            return null;
        }
    }
    function get_data_teacher_staff_save($id){
        $data = $this->db->query("SELECT a.PaidTo,b.FirstName,b.MiddleName,b.LastName FROM tbl_cash_voucher_mas a LEFT JOIN tbl_07_personal_bio b ON b.IDNumber = a.PaidTo WHERE a.CashCode = '$id' AND a.StatusPost = 'Save'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_last_cashcode(){
        $this->db->select('CashCode');
        $this->db->from('tbl_cash_voucher_mas');
        $this->db->order_by('CashCode','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->row();
        }else{
            return null;
        }
    }//End Master From

    //Start Update Master Cashvoucher
    public function update_master_cashvoucher($id, $data_mas_cashvoucher)
    {
        $this->db->where('CashCode', $id);
        $this->db->update('tbl_cash_voucher_mas', $data_mas_cashvoucher);
      
    }
    //End Update Master Cashvoucher

    //Start Delete Detail Cashvoucher
    function delete_det_cashvoucher($idcv){
        if ($this->db->delete('tbl_cash_voucher_det', array('CashCode' => $idcv))) {
            return "success";
        }
        
    }
    //End Delete Detail Cashvoucher

    //Start Addrow
    function get_data_accno(){
        $data = $this->db->query("SELECT Acc_No,Acc_Name FROM tbl_fa_mas_account WHERE Acc_Group = 'E' OR Acc_Group = 'E2' ORDER BY Acc_No");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }
    //End Addrow

    //Start Data Save
    function get_data_master_cash_voucher_save($id){
        $this->db->select('*');
        $this->db->from('tbl_cash_voucher_mas');
        $this->db->where('CashCode',$id);
        $this->db->where('StatusPost','Save');
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->result();
        }else{
            return null;
        }
    }

    function get_data_detail_cash_voucher_save($id){
        $this->db->select('a.CashCode,a.StatusPost,b.CashDetNo,b.CashCode as CCode,b.Description,b.AccountNo,b.Qty,b.Price,b.Amount,c.Acc_Name');
        $this->db->from('tbl_cash_voucher_mas a');
        $this->db->join('tbl_cash_voucher_det b','b.CashCode = a.CashCode');
        $this->db->join('tbl_fa_mas_account c','c.Acc_No = b.AccountNo','left');
        $this->db->where('a.CashCode',$id);
        $this->db->where('a.StatusPost','Save');
        $this->db->order_by('b.CashDetNo');
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->result();
        }else{
            return null;
        }
    }
    //End Data Save

    //Start Delete Row Save
    function delete_row_cash_voucher($cash_det_no){
        $this->db->where('CashDetNo', $cash_det_no);
        $this->db->delete('tbl_cash_voucher_det');
    }
    //End Delete Row Save


}
