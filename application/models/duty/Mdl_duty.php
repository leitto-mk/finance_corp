<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_duty extends CI_Model
{
    function get_incid_duty(){
        $this->db->select('CtrlNo');
        $this->db->from('tbl_duty');
        $this->db->limit(1);
        $this->db->order_by('CtrlNo','DESC');
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->result();
        }else{
            return null;
        }
    }

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

    //News & Assigments
    function get_school(){
        $data = $this->db->query("SELECT SchoolID,SchoolName,School_Desc FROM tbl_02_school");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_school_dropdown(){
        $query = $this->db->query("SELECT SchoolID,SchoolName,School_Desc FROM tbl_02_school");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }        
    }

    function get_list_sch_by_school($schcode){
        $query = $this->db->query("SELECT a.ClassID, a.ClassDesc FROM tbl_03_class a LEFT JOIN tbl_02_school b ON b.SchoolID = a.SchoolID WHERE a.SchoolID= '$schcode' ORDER BY a.ClassNumeric");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_category_status(){
        $data = $this->db->query("SELECT status FROM tbl_07_personal_bio WHERE status != 'admin' GROUP BY status");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_list_room_by_class($clscodesid){
        $query = $this->db->query("SELECT RoomID,RoomDesc FROM tbl_04_class_rooms WHERE ClassID = '$clscodesid' ORDER BY RoomDesc ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_data_by_room($rmcodes){
        $query = $this->db->query("SELECT a.NIS,a.NISN,b.FirstName,b.LastName FROM tbl_08_job_info_std a LEFT JOIN tbl_07_personal_bio b ON b.IDNumber = a.NIS WHERE a.Ruangan = '$rmcodes' ORDER BY a.Ruangan ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_data_by_category($cstatuscodes){
        $query = $this->db->query("SELECT a.IDNumber,b.FirstName,b.LastName FROM tbl_08_job_info a LEFT JOIN tbl_07_personal_bio b ON b.IDNumber = a.IDNumber WHERE a.occupation = '$cstatuscodes'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_data_duty_all(){
        $data = $this->db->query("SELECT * FROM tbl_duty ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return false;
        }
    }

    function get_list_data_duty_all_by_date($curdate){
        $data = $this->db->query("SELECT * FROM tbl_duty WHERE SubmitDate = '$curdate' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return false;
        }
    }

    function get_data_detail_news_assigments($idctrlno){
        $query = $this->db->query("SELECT a.*,b.SchoolName FROM tbl_duty a LEFT JOIN tbl_02_school b ON b.SchoolID = a.TypeSchool WHERE a.CtrlNo ='$idctrlno'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_data_duty($school,$status,$cls,$room,$id){
        if($status == 'student'){
            $result = $this->db->query(
                "SELECT * FROM tbl_duty
                 WHERE SubmitTo IN('All', '$status')
                 AND TypeSchool IN('All', '$school')
                 AND Class IN('All', '$cls')
                 AND Room IN('All', '$room')
                 AND IDNumber IN('All', '$id') ORDER BY CtrlNo DESC"
            );
        }elseif($status == 'teacher' || $status == 'staff'){
            $result = $this->db->query(
                "SELECT * FROM tbl_duty
                 WHERE SubmitTo IN('All', '$status')
                 AND IDNumber IN('All', '$id') ORDER BY CtrlNo DESC"
            );
        }

        return $result->result();
    }

}
