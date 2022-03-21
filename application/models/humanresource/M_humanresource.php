<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_humanresource extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function select($query) {
        $sql = $this->db->query($query);
        return $sql->result();
    }
    
    // public function insert($table, $data) {
    //     $this->db->insert($table, $data);
    // }
    function insert($table, $data) {
        $data = $this->db->insert($table, $data);
        if ($data) {
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

    // function get_cur_user(){
    //     $idn = $this->session->userdata('IDNumber');
    //     $users = $this->load->database('users', true);
    //     $user = $users->query("SELECT IDNumber, UName AS username FROM tbl_users where IDNumber = '$idn'");
    //     if ($user->num_rows() > 0) {
    //         return $user->result();
    //     }else{
    //         return null;
    //     }
    // }

    // function get_cur_user(){
    //     $idn = $this->session->userdata('IDNumber');
    //     $users = $this->load->database('abase_users', true);
    //     $user = $users->query("SELECT IDNumber, u_name AS username FROM tbl_users where IDNumber = '$idn'");
    //     if ($user->num_rows() > 0) {
    //         return $user->result();
    //     }else{
    //         return null;
    //     }
    // }


    // function get_data_sum_employee_by_gender(){
    //      $data = $this->db->query("SELECT sub.GMale,sub.GFemale,sub.Total FROM (SELECT Gender,SUM(IF(tb1.Gender = 'Male',1,0)) AS GMale, SUM(IF(tb1.Gender = 'Female',1,0)) AS GFemale, COUNT(tb1.IDNumber) AS Total FROM(SELECT CtrlNo,IDNumber ,Gender FROM tbl_hr_append)tb1)sub");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_data_sum_employee_by_gender($branch){
         $data = $this->db->query("SELECT sub.GMale,sub.GFemale,sub.Total FROM (SELECT Gender,SUM(IF(tb1.Gender = 'Male',1,0)) AS GMale, SUM(IF(tb1.Gender = 'Female',1,0)) AS GFemale, COUNT(tb1.IDNumber) AS Total FROM(SELECT CtrlNo,IDNumber ,Gender FROM tbl_hr_append WHERE Branch = '$branch' AND Status='Active')tb1)sub");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }



    //Employee Register
    // function get_data_sum_employee_by_employeetype(){
    //      $data = $this->db->query("SELECT sub.EStaff,sub.ENonStaff,sub.EExpat,sub.Total FROM (SELECT EmployeeType,SUM(IF(tb1.EmployeeType = '10',1,0)) AS EStaff, SUM(IF(tb1.EmployeeType = '20',1,0)) AS ENonStaff,SUM(IF(tb1.EmployeeType = '30',1,0)) AS EExpat, COUNT(tb1.IDNumber) AS Total FROM(SELECT CtrlNo,IDNumber ,EmployeeType FROM tbl_hr_append)tb1)sub");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_data_sum_employee_by_employeetype($branch){
         $data = $this->db->query("SELECT sub.EStaff,sub.ENonStaff,sub.EExpat,sub.Total FROM (SELECT EmployeeType,SUM(IF(tb1.EmployeeType = '10',1,0)) AS EStaff, SUM(IF(tb1.EmployeeType = '20',1,0)) AS ENonStaff,SUM(IF(tb1.EmployeeType = '30',1,0)) AS EExpat, COUNT(tb1.IDNumber) AS Total FROM(SELECT CtrlNo,IDNumber ,EmployeeType FROM tbl_hr_append WHERE Branch = '$branch' AND Status='Active')tb1)sub");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_all_department(){
        $data = $this->db->query("SELECT DeptCode,DeptDes FROM abase_03_dept");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_all_data_structure_dept(){
        $data = $this->db->query("SELECT a.DeptCode, a.DeptDes, b.BUCode,b.BUDes,c.DivCode,c.DivDes,d.BranchCode,d.BranchName,d.BranchDes,e.ComCode,e.ComName,e.ComDes FROM abase_03_dept a LEFT JOIN abase_03_dept_bu b ON b.BUCode = a.BUCode LEFT JOIN abase_03_dept_div c ON c.DivCode = b.DivCode LEFT JOIN abase_02_branch d ON d.BranchCode = a.Branch LEFT JOIN abase_01_com e ON e.ComCode = d.ComCode");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    // function get_data_personaldata_list(){
    //     $data = $this->db->query("SELECT * FROM tbl_hr_append");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_data_personaldata_list($branch){
        $data = $this->db->query("SELECT * FROM tbl_hr_append WHERE Branch = '$branch'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_personaldata($id){
        $data = $this->db->query("SELECT * FROM tbl_hr_append WHERE IDNumber = '$id'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function edit_emp_data_byid($idnumber_, $personaldata)
    {
        $this->db->where('IDNumber', $idnumber_);
        $this->db->update('tbl_emp_per_data', $personaldata);
      
    }

    function edit_emp_job_data_byid($idnumber_, $jobinformation)
    {
        $this->db->where('IDNumber', $idnumber_);
        $this->db->update('tbl_emp_per_job', $jobinformation);
      
    }

    function edit_emp_app_data_byid($idnumber_, $employeeappend)
    {
        $this->db->where('IDNumber', $idnumber_);
        $this->db->update('tbl_hr_append', $employeeappend);
      
    }

    function edit_persphoto_data_byid($idn, $datapersphoto)
    {
        $this->db->where('IDNumber', $idn);
        $this->db->update('tbl_emp_per_data', $datapersphoto);
      
    }

    function edit_persphoto_app_data_byid($idn, $datapersphoto)
    {
        $this->db->where('IDNumber', $idn);
        $this->db->update('tbl_hr_append', $datapersphoto);
      
    }

    function edit_ktp_data_byid($id, $datafilektp)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_data', $datafilektp);
      
    }

    function edit_ktp_app_data_byid($id, $datafilektp)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $datafilektp);
      
    }

    function get_data_dependent_byid($id){
        $data = $this->db->query("SELECT * FROM tbl_emp_per_dep WHERE IDNumber = '$id'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_dependent_byctrlno($cno){
        $data = $this->db->query("SELECT * FROM tbl_emp_per_dep WHERE CtrlNo = '$cno'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    public function update_dep_data_byid($iddep_, $data_dep)
    {
        $this->db->where('IDNumberDependent', $iddep_);
        $this->db->update('tbl_emp_per_dep', $data_dep);
      
    }

    public function edit_depphoto_data_byid($idp, $datadepphoto)
    {
        $this->db->where('IDNumberDependent', $idp);
        $this->db->update('tbl_emp_per_dep', $datadepphoto);
      
    }

    function get_data_kin_byid($id){
        $data = $this->db->query("SELECT * FROM tbl_emp_data_kin WHERE IDNumber = '$id'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_kin_byctrlno($cno){
        $data = $this->db->query("SELECT * FROM tbl_emp_data_kin WHERE CtrlNo = '$cno'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    public function update_kin_data_byid($idnumberkin_, $data_kin)
    {
        $this->db->where('IDNumberKin', $idnumberkin_);
        $this->db->update('tbl_emp_data_kin', $data_kin);
      
    }

    function get_data_experience_byid($id){
        $data = $this->db->query("SELECT * FROM tbl_emp_cd_career_experience WHERE IDNumber = '$id'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    public function edit_data_experience($ctrlno, $data_edit_experience)
    {
        $this->db->where('ControlNo', $ctrlno);
        $this->db->update('tbl_emp_cd_career_experience', $data_edit_experience);
      
    }

    public function delete_data_experience($id,$cno){
        $idnum = $id;
        $ctrlno = $cno;
        $tables = array('tbl_emp_cd_career_experience');
        $this->db->where('IDNumber',$idnum);
        $this->db->where('ControlNo',$ctrlno);
        $this->db->delete($tables);
    }

    function get_data_formal_byid($id){
        $data = $this->db->query("SELECT * FROM tbl_emp_cd_career_formal WHERE IDNumber = '$id'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    public function edit_data_education($ctrlno, $data_edit_education)
    {
        $this->db->where('ControlNo', $ctrlno);
        $this->db->update('tbl_emp_cd_career_formal', $data_edit_education);
      
    }

    public function delete_data_education($id,$cno){
        $idnum = $id;
        $ctrlno = $cno;
        $tables = array('tbl_emp_cd_career_formal');
        $this->db->where('IDNumber',$idnum);
        $this->db->where('ControlNo',$ctrlno);
        $this->db->delete($tables);
    }

    function get_data_training_byid($id){
        $data = $this->db->query("SELECT * FROM tbl_emp_cd_career_train WHERE RequestBy = '$id'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    public function edit_data_training($ctrlno, $data_edit_training)
    {
        $this->db->where('IDRequest', $ctrlno);
        $this->db->update('tbl_emp_cd_career_train', $data_edit_training);
      
    }

    public function delete_data_training($id,$cno){
        $idnum = $id;
        $ctrlno = $cno;
        $tables = array('tbl_emp_cd_career_train');
        $this->db->where('RequestBy',$idnum);
        $this->db->where('IDRequest',$ctrlno);
        $this->db->delete($tables);
    }

    function get_data_language_byid($id){
        $data = $this->db->query("SELECT * FROM tbl_emp_cd_career_language WHERE IDNumber = '$id'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    public function edit_data_language($ctrlno, $data_edit_language)
    {
        $this->db->where('ControlNo', $ctrlno);
        $this->db->update('tbl_emp_cd_career_language', $data_edit_language);
      
    }

    public function delete_data_language($id,$cno){
        $idnum = $id;
        $ctrlno = $cno;
        $tables = array('tbl_emp_cd_career_language');
        $this->db->where('IDNumber',$idnum);
        $this->db->where('ControlNo',$ctrlno);
        $this->db->delete($tables);
    }

    function get_data_hobby_byid($id){
        $data = $this->db->query("SELECT * FROM tbl_emp_cd_career_hobby WHERE IDNumber = '$id'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    public function edit_data_hobby($ctrlno, $data_edit_hobby)
    {
        $this->db->where('ControlNo', $ctrlno);
        $this->db->update('tbl_emp_cd_career_hobby', $data_edit_hobby);
      
    }

     public function delete_data_hobby($id,$cno){
        $idnum = $id;
        $ctrlno = $cno;
        $tables = array('tbl_emp_cd_career_hobby');
        $this->db->where('IDNumber',$idnum);
        $this->db->where('ControlNo',$ctrlno);
        $this->db->delete($tables);
    }


    function get_company_his($id){
        $data = $this->db->query("SELECT * FROM tbl_emp_per_job_his_com WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_branch_his($id){
        $data = $this->db->query("SELECT * FROM tbl_emp_per_job_his_branch WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_dept_his($id){
        $data = $this->db->query("SELECT * FROM tbl_emp_per_job_his_dept WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_costcenter_his($id){
        $data = $this->db->query("SELECT * FROM tbl_emp_per_job_his_costcenter WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }


    public function update_marital_data_byid_append($id, $data_marital)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_marital);
      
    }
    public function update_marital_data_byid($id, $data_marital1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_data', $data_marital1);
      
    }

    public function update_employeetype_data_byid_append($id, $data_employeetype)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_employeetype);
      
    }
    public function update_employeetype_data_byid($id, $data_employeetype1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_employeetype1);
      
    }

    public function update_employmenttype_data_byid_append($id, $data_employmenttype)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_employmenttype);
      
    }
    public function update_employmenttype_data_byid($id, $data_employmenttype1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_employmenttype1);
      
    }

    public function update_jobtitle_data_byid_append($id, $data_jobtitle)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_jobtitle);
      
    }
    public function update_jobtitle_data_byid($id, $data_jobtitle1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_jobtitle1);
      
    }

    public function update_positiontitle_data_byid_append($id, $data_positiontitle)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_positiontitle);
      
    }
    public function update_positiontitle_data_byid($id, $data_positiontitle1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_positiontitle1);
      
    }

    public function update_workfunction_data_byid_append($id, $data_workfunction)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_workfunction);
      
    }
    public function update_workfunction_data_byid($id, $data_workfunction1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_workfunction1);
      
    }

    public function update_workgroup_data_byid_append($id, $data_workgroup)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_workgroup);
      
    }
    public function update_workgroup_data_byid($id, $data_workgroup1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_workgroup1);
      
    }

    public function update_onsitemarital_data_byid_append($id, $data_onsitemarital)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_onsitemarital);
      
    }
    public function update_onsitemarital_data_byid($id, $data_onsitemarital1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_onsitemarital1);
      
    }

    public function update_maritalbenefit_data_byid_append($id, $data_maritalbenefit)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_maritalbenefit);
      
    }
    public function update_maritalbenefit_data_byid($id, $data_maritalbenefit1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_maritalbenefit1);
      
    }

    public function update_probationdate_data_byid_append($id, $data_probationdate)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_probationdate);
      
    }
    public function update_probationdate_data_byid($id, $data_probationdate1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_probationdate1);
      
    }

    public function update_hiredate_data_byid_append($id, $data_hiredate)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_hiredate);
      
    }
    public function update_hiredate_data_byid($id, $data_hiredate1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_hiredate1);
      
    }

    public function update_servicedate_data_byid_append($id, $data_servicedate)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_servicedate);
      
    }
    public function update_servicedate_data_byid($id, $data_servicedate1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_servicedate1);
      
    }

    public function update_pointofhire_data_byid_append($id, $data_pointofhire)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_pointofhire);
      
    }
    public function update_pointofhire_data_byid($id, $data_pointofhire1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_pointofhire1);
      
    }

    public function update_pointofleave_data_byid_append($id, $data_pointofleave)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_pointofleave);
      
    }
    public function update_pointofleave_data_byid($id, $data_pointofleave1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_pointofleave1);
      
    }

    public function update_pointoftravel_data_byid_append($id, $data_pointoftravel)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_pointoftravel);
      
    }
    public function update_pointoftravel_data_byid($id, $data_pointoftravel1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_pointoftravel1);
      
    }

    public function update_worklocation_data_byid_append($id, $data_worklocation)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_worklocation);
      
    }
    public function update_worklocation_data_byid($id, $data_worklocation1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_worklocation1);
      
    }

    public function update_supervisor_data_byid_append($id, $data_supervisor)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_supervisor);
      
    }
    public function update_supervisor_data_byid($id, $data_supervisor1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_supervisor1);
      
    }

    public function update_workinsurance_data_byid_append($id, $data_workinsurance)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_workinsurance);
      
    }
    public function update_workinsurance_data_byid($id, $data_workinsurance1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_workinsurance1);
      
    }

    public function update_medicalinsurance_data_byid_append($id, $data_medicalinsurance)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_medicalinsurance);
      
    }
    public function update_medicalinsurance_data_byid($id, $data_medicalinsurance1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_medicalinsurance1);
      
    }

    public function update_workday_data_byid_append($id, $data_workday)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_workday);
      
    }
    public function update_workday_data_byid($id, $data_workday1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_workday1);
      
    }

    public function update_leavetype_data_byid_append($id, $data_leavetype)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_leavetype);
      
    }
    public function update_leavetype_data_byid($id, $data_leavetype1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_leavetype1);
      
    }

    public function update_empcompany_data_byid_append($id, $data_empcompany)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_empcompany);
      
    }
    public function update_empcompany_data_byid($id, $data_empcompany1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_empcompany1);
      
    }

    public function update_bankaccount1_data_byid_append($id, $data_bankaccount1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_bankaccount1);
      
    }
    public function update_bankaccount1_data_byid($id, $data_bankaccount11)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_bankaccount11);
      
    }

    public function update_bankaccount2_data_byid_append($id, $data_bankaccount2)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_bankaccount2);
      
    }
    public function update_bankaccount2_data_byid($id, $data_bankaccount21)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_bankaccount21);
      
    }

    public function update_uniformtshirt_data_byid_append($id, $data_uniformtshirt)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_uniformtshirt);
      
    }
    public function update_uniformtshirt_data_byid($id, $data_uniformtshirt1)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_uniformtshirt1);
      
    }

    public function update_dept_data_byid_append($id, $data_upt_app)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_upt_app);
      
    }
    public function update_dept_data_byid($id, $data_upt_job)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_upt_job);
      
    }

    public function update_grade_level_data_byid_append($id, $data_upt_app_grade)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_upt_app_grade);
      
    }
    public function update_grade_level_data_byid($id, $data_upt_job_grade)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_upt_job_grade);
      
    }

    public function update_level_data_byid_append($id, $data_upt_app_level)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_hr_append', $data_upt_app_level);
      
    }
    public function update_level_data_byid($id, $data_upt_job_level)
    {
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_emp_per_job', $data_upt_job_level);
      
    }
   

    function cek_idnumber($id){
        $this->db->select("IDNumber");
        $this->db->from("tbl_emp_per_data");
        $this->db->where("IDNumber",$id);
        $user = $this->db->get();
        if($user->num_rows() > 0){
            return true;
        }else{
            return null;
        }
    }

    function get_last_idnumber(){
        $query = $this->db->query("SELECT IDNumber FROM tbl_emp_per_data WHERE IDNumberIdentifier='inc' ORDER BY CtrlNo DESC Limit 1");
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data->IDNumber;
        } else {
            return false;
        }     
    }

    function get_last_iddep(){
        $query = $this->db->query("SELECT IDNumberDependent FROM tbl_emp_per_dep ORDER BY CtrlNo DESC Limit 1");
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data->IDNumberDependent;
        } else {
            return false;
        }     
    }

    function get_last_iddep_byid($id){
        $query = $this->db->query("SELECT IDNumber,IDNumberDependent FROM tbl_emp_per_dep WHERE IDNumber = '$id' ORDER BY CtrlNo DESC Limit 1");
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data->IDNumberDependent;
        } else {
            return false;
        }     
    }

    function get_last_idkin_byid($id){
        $query = $this->db->query("SELECT IDNumber,IDNumberKin FROM tbl_emp_data_kin WHERE IDNumber = '$id' ORDER BY CtrlNo DESC Limit 1");
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data->IDNumberKin;
        } else {
            return false;
        }     
    }

    function get_data_company(){
        $data = $this->db->query("SELECT ComCode,ComName,ComShortName,ComDes,CompType FROM abase_01_com");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_individuuallevel_list($levelcode){
        $data = $this->db->query("SELECT CtrlNo,LevelCode, Level, Level, LevelDescription, ManagementType, ManagementGroup FROM tbl_emp_plan_mas_c_level WHERE Level='$levelcode' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_branch_list($companycode){
        $data = $this->db->query("SELECT CtrlNo,BranchCode, BranchName, BranchDes, BranchType, ComCode FROM abase_02_branch WHERE ComCode='$companycode' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    // function get_branch_list($companycode){
    //     $data = $this->db->query("SELECT a.CtrlNo,a.BranchCode, a.BranchName, a.BranchDes, a.BranchType, a.ComCode, b.DeptCode,b.DeptDes FROM abase_02_branch a JOIN abase_03_dept b ON b.Branch = a.BranchCode WHERE ComCode='$companycode' ORDER BY CtrlNo DESC");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_department_list($branchcode){
        $data = $this->db->query("SELECT a.DeptCode, a.DeptDes, a.Branch, b.BUCode,b.BUDes,c.DivCode,c.DivDes FROM abase_03_dept a LEFT JOIN abase_03_dept_bu b ON b.BUCode = a.BUCode LEFT JOIN abase_03_dept_div c ON c.DivCode = b.DivCode WHERE a.Branch ='$branchcode'");
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return false;
        }
    }

    function get_data_marital(){
        $data = $this->db->query("SELECT Marital,MaritalDes FROM tbl_emp_job_mas_marital");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_marital_history($id){
        $data = $this->db->query("SELECT Marital,MaritalDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_marital WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_onsitemarital(){
        $data = $this->db->query("SELECT OnsiteMarital,OnsiteMaritalDes FROM tbl_emp_job_mas_marital_onsite");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_onsitemarital_history($id){
        $data = $this->db->query("SELECT OnsiteMarital,OnsiteMaritalDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_onsitemarital WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_maritalbenefit(){
        $data = $this->db->query("SELECT MaritalBenefitCode,MaritalBenefitDes FROM tbl_emp_cb_mas_marital");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_maritalbenefit_history($id){
        $data = $this->db->query("SELECT MaritalBenefit,MaritalBenefitDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_maritalbenefit WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_probationdate_history($id){
        $data = $this->db->query("SELECT ProbationDate,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_probationdate WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_hiredate_history($id){
        $data = $this->db->query("SELECT HireDate,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_hiredate WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_servicedate_history($id){
        $data = $this->db->query("SELECT ServiceDate,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_servicedate WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_pointofhire_history($id){
        $data = $this->db->query("SELECT PointOfHire,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_pointofhire WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_pointofleave_history($id){
        $data = $this->db->query("SELECT PointOfLeave,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_pointofleave WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_pointoftravel_history($id){
        $data = $this->db->query("SELECT PointOfTravel,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_pointoftravel WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_worklocation_history($id){
        $data = $this->db->query("SELECT WorkLocation,WorkLocationDes,Branch,BranchDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_location WHERE IDNumber = '$id'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_ethnic(){
        $data = $this->db->query("SELECT Ethnic,EthnicGroup,EthnicClass,Country FROM tbl_emp_data_mas_ethnic");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_employeeclass(){
        $data = $this->db->query("SELECT EmployeeClass,EmployeeClassDes FROM tbl_emp_job_mas_class");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_employeetype(){
        $data = $this->db->query("SELECT EmployeeType,EmployeeTypeDes FROM tbl_emp_plan_mas_employeetype");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_employeetype_history($id){
        $data = $this->db->query("SELECT EmployeeType,EmployeeTypeDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_employeetype WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_employmenttype(){
        $data = $this->db->query("SELECT EmploymentType,EmploymentTypeDes FROM tbl_emp_job_mas_employment");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_employmenttype_history($id){
        $data = $this->db->query("SELECT EmploymentType,EmploymentTypeDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_employmenttype WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_individualgrade(){
        $data = $this->db->query("SELECT GradeCode,Grade,GradeDegree,GradeDes FROM tbl_emp_plan_mas_d_grade");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_point(){
        $data = $this->db->query("SELECT * FROM tbl_emp_plan_mas_point AS parent
                WHERE RegDate = (SELECT 
                                    MAX(RegDate) AS RegDate 
                                 FROM tbl_emp_plan_mas_point
                                 WHERE PointCode = parent.PointCode
                                 GROUP BY PointCode
                                )  
                ORDER BY `parent`.`PointCode` ASC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_level(){
        $data = $this->db->query("SELECT LevelCode,Level,LevelDescription,ManagementType,ManagementGroup FROM tbl_emp_plan_mas_c_level");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_title(){
        $data = $this->db->query("SELECT JobTitleCode,JobTitle FROM tbl_emp_plan_mas_postitle");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_jobtitle_history($id){
        $data = $this->db->query("SELECT JobTitle,JobTitleDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_jobtitle WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_position_history($id){
        $data = $this->db->query("SELECT JobPosition,JobPositionDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_jobposition WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    // function get_all_data_structure_grade(){
    //     $data = $this->db->query("SELECT a.Grade,a.GradeDes,b.LevelCode,b.Level,b.LevelDescription,b.ManagementType,b.ManagementGroup,b.Reason FROM tbl_emp_plan_mas_d_grade a LEFT JOIN tbl_emp_plan_mas_c_level b ON b.Level = a.Level");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_all_data_structure_grade(){
        $data = $this->db->query("SELECT GradeCode,Grade,GradeDegree,GradeDes FROM tbl_emp_plan_mas_d_grade");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_grade_level_history($id){
        $data = $this->db->query("SELECT b.LevelCode,b.LevelDescription,a.EmployeeLevel,a.EmployeeLevelDes,a.Reason,a.RegBy,a.RegDate FROM tbl_emp_per_job_his_employeelevel a LEFT JOIN tbl_emp_plan_mas_c_level b ON b.LevelCode = a.EmployeeLevel WHERE a.IDNumber = '$id' ORDER BY a.CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_workfunction(){
        $data = $this->db->query("SELECT WorkFunction,WorkFunctionDes,WorkGroup,WorkGroupDes FROM tbl_emp_plan_mas_b_function");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_workfunction_history($id){
        $data = $this->db->query("SELECT WorkFunction,WorkFunctionDes,WorkGroup,WorkGroupDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_jobworkfunction WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_workgroup(){
        $data = $this->db->query("SELECT Crew,CrewName FROM tbl_emp_mgt_workforce_mas_crew");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_workgroup_history($id){
        $data = $this->db->query("SELECT Crew,CrewDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_crew WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }


    function get_data_supervisor(){
        $data = $this->db->query("SELECT IDNumber,FirstName,LastName,PositionTitle,PositionTitleDes FROM tbl_hr_append");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_supervisor_history($id){
        $data = $this->db->query("SELECT Supervisor,SupervisorName,SupervisorTitle,SupervisorTitleDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_supervisor WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_workinsurance_history($id){
        $data = $this->db->query("SELECT InsuranceBPJS,InsuranceBPJSDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_insurancebpjs WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_medicalinsurance_history($id){
        $data = $this->db->query("SELECT InsuranceMedical,InsuranceMedicalDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_insurancemedical WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_workday(){
        $data = $this->db->query("SELECT WorkDayCode,WorkDayDes,WorkDays,OffDays,Justification FROM tbl_emp_per_job_his_workday_mas");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_workday_history($id){
        $data = $this->db->query("SELECT WorkDay,WorkDayDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_workday WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }


    function get_data_leavetype(){
        $data = $this->db->query("SELECT LeaveType,LeaveTypeDes,Justification FROM tbl_emp_per_job_his_leavetype_mas");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_leavetype_history($id){
        $data = $this->db->query("SELECT LeaveType,LeaveTypeDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_leavetype WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_bankaccount1_history($id){
        $data = $this->db->query("SELECT BankAccount1,BankAccount1Des,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_bankaccount1 WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_bankaccount2_history($id){
        $data = $this->db->query("SELECT BankAccount2,BankAccount2Des,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_bankaccount2 WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_uniformtshirt_history($id){
        $data = $this->db->query("SELECT UniformTshirt,UniformTshirtDes,Reason,RegBy,RegDate FROM tbl_emp_per_job_his_uniform_tshirt WHERE IDNumber = '$id' ORDER BY CtrlNo DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_list_country(){
        $query = $this->db->query("SELECT CountryCode, CountryName FROM abase_03_country ORDER BY CtrlNo ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }        
    }

    function get_list_province_by_country($countrycode){
        $query = $this->db->query("SELECT CtrlNo AS ProvinceID, ProvinceCode, ProvinceDes FROM abase_03_province WHERE CountryCode = '$countrycode' ORDER BY ProvinceDes ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_onsiteprovince_by_onsitecountry($ocountrycode){
        $query = $this->db->query("SELECT CtrlNo AS ProvinceID, ProvinceCode, ProvinceDes FROM abase_03_province WHERE CountryCode = '$ocountrycode' ORDER BY ProvinceDes ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_provincedep_by_countrydep($countrydepcode){
        $query = $this->db->query("SELECT CtrlNo AS ProvinceID, ProvinceCode, ProvinceDes FROM abase_03_province WHERE CountryCode = '$countrydepcode' ORDER BY ProvinceDes ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_provincekin_by_countrykin($countrykincode){
        $query = $this->db->query("SELECT CtrlNo AS ProvinceID, ProvinceCode, ProvinceDes FROM abase_03_province WHERE CountryCode = '$countrykincode' ORDER BY ProvinceDes ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_region_by_province($provincecode){
        $query = $this->db->query("SELECT RegionCode,RegionDes FROM abase_03_region WHERE ProvinceCode = '$provincecode' ORDER BY RegionDes ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_onsiteregion_by_onsiteprovince($oprovincecode){
        $query = $this->db->query("SELECT RegionCode,RegionDes FROM abase_03_region WHERE ProvinceCode = '$oprovincecode' ORDER BY RegionDes ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_regiondep_by_provincedep($provincedepcode){
        $query = $this->db->query("SELECT RegionCode,RegionDes FROM abase_03_region WHERE ProvinceCode = '$provincedepcode' ORDER BY RegionDes ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

     function get_list_regionkin_by_provincekin($provincekincode){
        $query = $this->db->query("SELECT RegionCode,RegionDes FROM abase_03_region WHERE ProvinceCode = '$provincekincode' ORDER BY RegionDes ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_city_by_province($provincecode){
        $query = $this->db->query("SELECT K_BSNI, City, CapitalCity FROM abase_03_city WHERE ProvinceID = '$provincecode' ORDER BY City ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_city_by_region($regioncode){
        $query = $this->db->query("SELECT RegionCityCode, RegionCity FROM abase_03_region WHERE RegionCode = '$regioncode' ORDER BY RegionCity ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_onsitecity_by_onsiteprovince($oprovincecode){
        $query = $this->db->query("SELECT K_BSNI, City, CapitalCity FROM abase_03_city WHERE ProvinceID = '$oprovincecode' ORDER BY City ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }


    function get_list_onsitecity_by_onsiteregion($oregioncode){
        $query = $this->db->query("SELECT RegionCityCode, RegionCity FROM abase_03_region WHERE RegionCode = '$oregioncode' ORDER BY RegionCity ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_citydep_by_regiondep($regiondepcode){
        $query = $this->db->query("SELECT RegionCityCode, RegionCity FROM abase_03_region WHERE RegionCode = '$regiondepcode' ORDER BY RegionCity ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_citykin_by_regionkin($regionkincode){
        $query = $this->db->query("SELECT RegionCityCode, RegionCity FROM abase_03_region WHERE RegionCode = '$regionkincode' ORDER BY RegionCity ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_district_by_region($regioncode){
        $query = $this->db->query("SELECT RegionCode,DistrictCode,DistrictDes FROM abase_03_district WHERE RegionCode = '$regioncode' ORDER BY DistrictCode ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_onsitedistrict_by_onsiteregion($oregioncode){
        $query = $this->db->query("SELECT RegionCode,DistrictCode,DistrictDes FROM abase_03_district WHERE RegionCode = '$oregioncode' ORDER BY DistrictCode ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_districtdep_by_regiondep($regiondepcode){
        $query = $this->db->query("SELECT RegionCode,DistrictCode,DistrictDes FROM abase_03_district WHERE RegionCode = '$regiondepcode' ORDER BY DistrictCode ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_districtkin_by_regionkin($regionkincode){
        $query = $this->db->query("SELECT RegionCode,DistrictCode,DistrictDes FROM abase_03_district WHERE RegionCode = '$regionkincode' ORDER BY DistrictCode ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_subdistrict_by_district($districtcode){
        $query = $this->db->query("SELECT DistrictCode,SubDistrictCode,SubDistrictDes,PostalCode FROM abase_03_subdistrict WHERE DistrictCode = '$districtcode' ORDER BY SubDistrictCode ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_onsitesubdistrict_by_onsitedistrict($odistrictcode){
        $query = $this->db->query("SELECT DistrictCode,SubDistrictCode,SubDistrictDes,PostalCode FROM abase_03_subdistrict WHERE DistrictCode = '$odistrictcode' ORDER BY SubDistrictCode ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_subdistrictdep_by_districtdep($districtdepcode){
        $query = $this->db->query("SELECT DistrictCode,SubDistrictCode,SubDistrictDes,PostalCode FROM abase_03_subdistrict WHERE DistrictCode = '$districtdepcode' ORDER BY SubDistrictCode ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_subdistrictkin_by_districtkin($districtkincode){
        $query = $this->db->query("SELECT DistrictCode,SubDistrictCode,SubDistrictDes,PostalCode FROM abase_03_subdistrict WHERE DistrictCode = '$districtkincode' ORDER BY SubDistrictCode ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    public function delete_data_dependent($id,$cno){
        $idnum = $id;
        $ctrlno = $cno;
        $tables = array('tbl_emp_per_dep');
        $this->db->where('IDNumber',$idnum);
        $this->db->where('CtrlNo',$ctrlno);
        $this->db->delete($tables);
    }

    public function delete_data_kin($id,$cno){
        $idnum = $id;
        $ctrlno = $cno;
        $tables = array('tbl_emp_data_kin');
        $this->db->where('IDNumber',$idnum);
        $this->db->where('CtrlNo',$ctrlno);
        $this->db->delete($tables);
    }

    function get_data_country(){
        $data = $this->db->query("SELECT Ethnic,EthnicGroup,EthnicClass,Country FROM tbl_emp_data_mas_ethnic");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }


    //Manpower Plan
    function getmanplannoauto(){
        $this->db->select('ManPlanNo');
        $this->db->from('tbl_emp_plan');
        $this->db->limit(1);
        $this->db->order_by('ManPlanNo','DESC');
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->result();
        }else{
            return null;
        }
    }

    function cek_manplanno($id){
        $this->db->select("ManPlanNo");
        $this->db->from("tbl_emp_plan");
        $this->db->where("ManPlanNo",$id);
        $user = $this->db->get();
        if($user->num_rows() > 0){
            return true;
        }else{
            return null;
        }
    }

    function get_last_manplanno(){
        $this->db->select('ManPlanNo');
        $this->db->from('tbl_emp_plan');
        $this->db->order_by('ManPlanNo','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->row();
        }else{
            return null;
        }
    }

    function get_data_manplanno(){
        $data = $this->db->query("SELECT a.ManPlanNo,a.DeptDes,a.PlanYear FROM tbl_emp_plan a JOIN tbl_emp_plan_det b ON b.ManPlanNo = a.ManPlanNo GROUP BY a.ManPlanNo");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_year(){
        $data = $this->db->query("SELECT PlanYear FROM tbl_emp_plan GROUP BY PlanYear");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_department(){
        $data = $this->db->query("SELECT a.DeptCode,a.DeptDes,b.PlanYear FROM abase_03_dept a JOIN tbl_emp_plan b ON b.DepartCode = a.DeptCode GROUP BY a.DeptCode");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_plan(){
        $data = $this->db->query("SELECT a.*,b.* FROM tbl_emp_plan a JOIN tbl_emp_plan_det b ON b.ManPlanNo = a.ManPlanNo");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_empl(){
         $data = $this->db->query("SELECT IDNumber,FirstName,MiddleName,LastName,FullName FROM tbl_emp_per_data");
         if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_jobtitle(){
        $data = $this->db->query("SELECT JobTitleCode,JobTitle FROM tbl_emp_plan_mas_postitle ORDER BY CtrlNo");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_postitionlevel(){
        $data = $this->db->query("SELECT WorkFunction,WorkFunctionDes FROM tbl_emp_plan_mas_b_function ORDER BY CtrlNo");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_emplyoyeetype(){
        $data = $this->db->query("SELECT EmployeeType,EmployeeTypeDes FROM tbl_emp_plan_mas_employeetype ORDER BY CtrlNo");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_companytype(){
        $data = $this->db->query("SELECT CompanyType,CompanyTypeDes FROM tbl_emp_plan_mas_companytype ORDER BY CtrlNo");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }



    function get_company(){
        $data = $this->db->query("SELECT ComCode,ComName,ComShortName,ComDes FROM abase_01_com");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_branch(){
        $data = $this->db->query("SELECT BranchCode,BranchName,BranchDes FROM abase_02_branch");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_department(){
        $data = $this->db->query("SELECT DeptCode,DeptDes FROM abase_03_dept");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    // function get_costcenter(){
    //     $data = $this->db->query("SELECT CostCenter,CCDes FROM abase_04_sectioncc");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_costcenter(){
        $data = $this->db->query("SELECT CostCenter,CCDes FROM abase_04_cost_center");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    public function edit_jobpost_byjobpostno($id, $data_manpower)
    {
        $this->db->where('JobPostNo', $id);
        $this->db->update('tbl_emp_plan_post', $data_manpower);
      
    }

    //Recruitment & Selection
    function cek_applicantno($id){
        $this->db->select("ApplicantNo");
        $this->db->from("tbl_emp_recruit");
        $this->db->where("ApplicantNo",$id);
        $user = $this->db->get();
        if($user->num_rows() > 0){
            return true;
        }else{
            return null;
        }
    }
    function get_last_applicantno(){
        $this->db->select('ApplicantNo');
        $this->db->from('tbl_emp_recruit');
        $this->db->order_by('ApplicantNo','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->row();
        }else{
            return null;
        }
    }

    function getpapplicantnoauto(){
        $this->db->select('ApplicantNo');
        $this->db->from('tbl_emp_recruit');
        $this->db->limit(1);
        $this->db->order_by('ApplicantNo','DESC');
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->result();
        }else{
            return null;
        }
    }

    function get_education_req(){
        $data = $this->db->query("SELECT EduCode,EduDescription,Seq FROM tbl_emp_plan_mas_01_education ORDER BY Seq");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_fieldstudy_req(){
        $data = $this->db->query("SELECT FieldStudyCode,FieldStudyDescription,Discipline FROM tbl_emp_plan_mas_02_fieldstudy");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_yearexp_req(){
        $data = $this->db->query("SELECT YearExpCode,YearExpDescription FROM tbl_emp_plan_mas_03_yearexp ORDER BY Seq");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_age_req(){
        $data = $this->db->query("SELECT AgeCode,AgeDescription FROM tbl_emp_plan_mas_04_age");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_english_req(){
        $data = $this->db->query("SELECT EnglishCode,EnglishDescription FROM tbl_emp_plan_mas_05_english ORDER BY Seq");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_recruit(){
        $data = $this->db->query("SELECT a.*,b.JobTitleCode,b.JobTitle FROM tbl_emp_recruit a LEFT JOIN tbl_emp_plan_mas_postitle b ON b.JobTitleCode = a.PositionNo ORDER BY a.AppliedDate DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_recruit_byid($applicantno){
        $data = $this->db->query("SELECT a.*,b.JobTitleCode,b.JobTitle FROM tbl_emp_recruit a LEFT JOIN tbl_emp_plan_mas_postitle b ON b.JobTitleCode = a.PositionNo WHERE a.ApplicantNo='$applicantno' ORDER BY a.AppliedDate DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }


    function get_data_selection_by_priority_edexist_fsexist($jobpostno,$educationseq,$fieldstudy){
        $data = $this->db->query("SELECT a.*,c.JobTitle FROM tbl_emp_recruit a JOIN tbl_emp_plan_post b ON b.JobPostNo = a.JobPostNo LEFT JOIN tbl_emp_plan_mas_postitle c ON c.JobTitleCode = a.PositionNo WHERE a.JobPostNo = '$jobpostno' AND a.EducationSeq >= '$educationseq' AND a.FieldStudyReq = '$fieldstudy'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    } 

    function get_data_selection_by_priority_edexist_fsnotexist($jobpostno,$educationseq,$fieldstudy){
        $data = $this->db->query("SELECT a.*,c.JobTitle FROM tbl_emp_recruit a JOIN tbl_emp_plan_post b ON b.JobPostNo = a.JobPostNo LEFT JOIN tbl_emp_plan_mas_postitle c ON c.JobTitleCode = a.PositionNo WHERE a.JobPostNo = '$jobpostno' AND a.EducationSeq >= '$educationseq' AND a.FieldStudyReq != '$fieldstudy'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }   

    function get_data_selection_by_priority_ednotexist_fsexist($jobpostno,$educationseq,$fieldstudy){
        $data = $this->db->query("SELECT a.*,c.JobTitle FROM tbl_emp_recruit a JOIN tbl_emp_plan_post b ON b.JobPostNo = a.JobPostNo LEFT JOIN tbl_emp_plan_mas_postitle c ON c.JobTitleCode = a.PositionNo WHERE a.JobPostNo = '$jobpostno' AND a.EducationSeq < '$educationseq' AND a.FieldStudyReq = '$fieldstudy'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }   

    function get_data_selection_by_priority_ednotexist_fsnotexist($jobpostno,$educationseq,$fieldstudy){
        $data = $this->db->query("SELECT a.*,c.JobTitle FROM tbl_emp_recruit a JOIN tbl_emp_plan_post b ON b.JobPostNo = a.JobPostNo LEFT JOIN tbl_emp_plan_mas_postitle c ON c.JobTitleCode = a.PositionNo WHERE a.JobPostNo = '$jobpostno' AND a.EducationSeq < '$educationseq' AND a.FieldStudyReq != '$fieldstudy'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }   


    // function get_data_selection_by_priority5($jobpostno,$educationseq,$fieldstudy,$agemin,$experience,$englishseq){
    //     $data = $this->db->query("SELECT a.*,c.JobTitle FROM tbl_emp_recruit a JOIN tbl_emp_plan_post b ON b.JobPostNo = a.JobPostNo LEFT JOIN tbl_emp_plan_mas_postitle c ON c.JobTitleCode = a.PositionNo WHERE a.JobPostNo = '$jobpostno' AND a.EducationSeq >= '$educationseq' AND a.FieldStudyReq= '$fieldstudy' AND a.AgeReq = '$agemin' AND a.YearExpReq = '$experience' AND a.EnglishSeq <= '$englishseq'");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }   

    //Job Post
    function get_post_list(){
        $data = $this->db->query("SELECT * FROM tbl_emp_plan_post ORDER BY PostDate DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_post_list_not_expire($currentdate){
        $data = $this->db->query("SELECT * FROM tbl_emp_plan_post WHERE PostExpireDate >= '$currentdate' ORDER BY PostDate DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

     function get_post_list_byjobpostno($jobpostno){
        $data = $this->db->query("SELECT * FROM tbl_emp_plan_post WHERE JobPostNo ='$jobpostno' ORDER BY PostDate DESC");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_post_list_by_postno($jobpostno){
        $data = $this->db->query("SELECT * FROM tbl_emp_plan_post WHERE JobPostNo = '$jobpostno'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_count_applied(){
        $data = $this->db->query("SELECT JobPostNo, COUNT(JobPostNo) as count FROM tbl_emp_recruit  GROUP BY JobPostNo");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_detail_post($ctrlno,$positionno){
        $data = $this->db->query("SELECT * FROM tbl_emp_plan_det WHERE CtrlNo='$ctrlno' AND  PositionNo = '$positionno'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

     function get_position_byjobpostno($jobpostno){
        $data = $this->db->query("SELECT * FROM tbl_emp_plan_post WHERE JobPostNo = '$jobpostno'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function cek_posting($postdate_,$ctrlnoposition_,$positionno_,$candidatetype_){
        $this->db->select("*");
        $this->db->from("tbl_emp_plan_post");
        $this->db->where("PostDate = '$postdate_' AND CtrlNoPosition = '$ctrlnoposition_' AND PositionNo ='$positionno_' AND CandidateType='$candidatetype_'");
        $user = $this->db->get();
        if($user->num_rows() > 0){
            return true;
        }else{
            return null;
        }
    }

    public function delete_data_manpower_post($uid){
        $id = $uid;
        $tables = array('tbl_emp_plan_post');
        $this->db->where('JobPostNo',$id);
        $this->db->delete($tables);
    }

    function get_count_expire_internal($currentdate){
        $data = $this->db->query("SELECT PostExpireDate, COUNT(PostExpireDate) AS TotalExpire FROM `tbl_emp_plan_post` WHERE PostExpireDate < '$currentdate' AND CandidateType = 'Internal'");
        if ($data->num_rows() > 0) {
            # code...
            $data_ = $data->row();
            return $data_->TotalExpire;
        } else {
            return 0;
        }
    }

    function get_count_expire_internal_data($currentdate){
        $data = $this->db->query("SELECT JobPostNo,PostDate,PostExpireDate,CandidateType,PositionTitle,WorkLocation FROM `tbl_emp_plan_post` WHERE PostExpireDate < '$currentdate' AND CandidateType = 'Internal'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_count_expire_external($currentdate){
        $data = $this->db->query("SELECT PostExpireDate, COUNT(PostExpireDate) AS TotalExpire FROM `tbl_emp_plan_post` WHERE PostExpireDate < '$currentdate' AND CandidateType = 'External'");
        if ($data->num_rows() > 0) {
            # code...
            $data_ = $data->row();
            return $data_->TotalExpire;
        } else {
            return 0;
        }
    }

    function get_count_expire_external_data($currentdate){
        $data = $this->db->query("SELECT JobPostNo,PostDate,PostExpireDate,CandidateType,PositionTitle,WorkLocation FROM `tbl_emp_plan_post` WHERE PostExpireDate < '$currentdate' AND CandidateType = 'External'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_count_expire($currentdate){
        $data = $this->db->query("SELECT PostExpireDate, COUNT(PostExpireDate) AS TotalExpire FROM `tbl_emp_plan_post` WHERE PostExpireDate < '$currentdate'");
        if ($data->num_rows() > 0) {
            # code...
            $data_ = $data->row();
            return $data_->TotalExpire;
        } else {
            return 0;
        }
    }

    function get_count_expire_data($currentdate){
        $data = $this->db->query("SELECT JobPostNo,PostDate,PostExpireDate,CandidateType,PositionTitle,WorkLocation FROM `tbl_emp_plan_post` WHERE PostExpireDate < '$currentdate'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_count_outstanding($currentdate){
        $data = $this->db->query("SELECT PostExpireDate, COUNT(PostExpireDate) AS TotalOutstanding FROM `tbl_emp_plan_post` WHERE PostExpireDate >= '$currentdate'");
        if ($data->num_rows() > 0) {
            # code...
            $data_ = $data->row();
            return $data_->TotalOutstanding;
        } else {
            return 0;
        }
    }

    function get_count_outstanding_data($currentdate){
        $data = $this->db->query("SELECT JobPostNo,PostDate,PostExpireDate,CandidateType,PositionTitle,WorkLocation FROM `tbl_emp_plan_post` WHERE PostExpireDate >= '$currentdate'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }


   

    //Chart

    // $bar = $this->db->query(
    //     "SELECT DISTINCT 
    //         Semester, 
    //         schoolyear, 
    //         (SELECT COUNT(DISTINCT(NIS)) 
    //          FROM tbl_09_det_grades 
    //          WHERE Semester = t1.Semester 
    //          AND schoolyear = t1.schoolyear
    //         ) AS Total
    //      FROM tbl_09_det_grades t1"
    // )->result();

    // return [$pie, $bar];

    // public function model_get_chart()
    // {
    //     $pie = $this->db->query(
    //         "SELECT DeptDes, COUNT(IDNumber) AS Total 
    //          FROM tbl_hr_append 
    //          GROUP BY DeptCode"
    //     )->result();

    //     $bar = $this->db->query(
    //          "SELECT WorkFunctionDes, COUNT(IDNumber) AS Total 
    //          FROM tbl_hr_append 
    //          GROUP BY WorkFunction"
    //     )->result();
    //     return [$pie, $bar];
    // }

    public function model_get_chart($branch)
    {
        $pie = $this->db->query(
            "SELECT DeptDes, COUNT(IDNumber) AS Total 
             FROM tbl_hr_append 
             WHERE Branch = $branch 
             GROUP BY DeptCode"
        )->result();

        $bar = $this->db->query(
             "SELECT WorkFunctionDes, COUNT(IDNumber) AS Total 
             FROM tbl_hr_append 
             WHERE Branch = $branch 
             GROUP BY WorkFunction"
        )->result();
        return [$pie, $bar];
    }

    //Report Dashboard
    // function get_list_department_from_hr_append(){
    //     $data = $this->db->query("SELECT DeptCode,DeptDes FROM tbl_hr_append WHERE Status='Active' GROUP BY DeptCode");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_list_department_from_hr_append($branch){
        $data = $this->db->query("SELECT DeptCode,DeptDes FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY DeptCode");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    //Function
    // function get_function(){
    //     $data = $this->db->query("SELECT WorkFunction,WorkFunctionDes FROM tbl_hr_append WHERE Status='Active' GROUP BY WorkFunction");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_function($branch){
        $data = $this->db->query("SELECT WorkFunction,WorkFunctionDes FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY WorkFunction");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    // function get_data_report_by_dept_function(){
    //     $data = $this->db->query(" SELECT WorkFunction,WorkFunctionDes,DeptCode, DeptDes, COUNT(IDNumber) as ttl FROM tbl_hr_append WHERE Status='Active' GROUP BY WorkFunction,DeptCode");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_data_report_by_dept_function($branch){
        $data = $this->db->query(" SELECT WorkFunction,WorkFunctionDes,DeptCode, DeptDes, COUNT(IDNumber) as ttl FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY WorkFunction,DeptCode");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }


    //Level
    // function get_level(){
    //     $data = $this->db->query("SELECT IndividualLevelCode,IndividualLevel,IndividualLevelDes FROM tbl_hr_append WHERE Status='Active' GROUP BY IndividualLevel");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_level($branch){
        $data = $this->db->query("SELECT IndividualLevelCode,IndividualLevel,IndividualLevelDes FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY IndividualLevel");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    // function get_data_report_by_dept_level(){
    //     $data = $this->db->query(" SELECT IndividualLevel,IndividualLevelDes,DeptCode, DeptDes, COUNT(IDNumber) as ttl FROM tbl_hr_append WHERE Status='Active' GROUP BY IndividualLevel,DeptCode");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }    

    function get_data_report_by_dept_level($branch){
        $data = $this->db->query(" SELECT IndividualLevel,IndividualLevelDes,DeptCode, DeptDes, COUNT(IDNumber) as ttl FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY IndividualLevel,DeptCode");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }     

    //Employee Type
    // function get_employeetype(){
    //     $data = $this->db->query("SELECT EmployeeType,EmployeeTypeDes FROM tbl_emp_plan_mas_employeetype");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    // function get_employeetype(){
    //     $data = $this->db->query("SELECT EmployeeType,EmployeeTypeDes FROM tbl_hr_append WHERE Status='Active' GROUP BY EmployeeType");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_employeetype($branch){
        $data = $this->db->query("SELECT EmployeeType,EmployeeTypeDes FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY EmployeeType");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    // function get_data_report_by_dept_employeetype(){
    //     $data = $this->db->query("SELECT DeptCode, EmployeeType, COUNT(IDNumber) AS count FROM tbl_hr_append WHERE Status='Active' GROUP BY DeptCode,EmployeeType");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_data_report_by_dept_employeetype($branch){
        $data = $this->db->query("SELECT DeptCode, EmployeeType, COUNT(IDNumber) AS count FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY DeptCode,EmployeeType");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    // function get_report_emp_etype_gtotals(){
    //     $this->db->select('DeptCode,EmployeeType, COUNT(IDNumber) AS count');
    //     $this->db->from('tbl_hr_append');
    //     $this->db->where("Status = 'Active'");
    //     $this->db->group_by('EmployeeType');
    //     $data = $this->db->get();
    //     if ($data->num_rows() > 0) {
    //         return $data->result();
    //     } else {
    //         return NULL;
    //     }
    // }

    function get_report_emp_etype_gtotals($branch){
        $this->db->select('DeptCode,EmployeeType, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'");
        $this->db->where("Branch = '$branch'");
        $this->db->group_by('EmployeeType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    //Employment Type
    // function get_employmenttype(){
    //     $data = $this->db->query("SELECT EmploymentType,EmploymentTypeDes FROM tbl_emp_job_mas_employment");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }
    // function get_employmenttype(){
    //     $data = $this->db->query("SELECT EmploymentType,EmploymentTypeDes FROM tbl_hr_append WHERE Status='Active' GROUP BY EmploymentType");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_employmenttype($branch){
        $data = $this->db->query("SELECT EmploymentType,EmploymentTypeDes FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY EmploymentType");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    // function get_data_report_by_dept_employmenttype(){
    //     $data = $this->db->query("SELECT DeptCode, EmploymentType, COUNT(IDNumber) AS count FROM tbl_hr_append WHERE Status='Active' GROUP BY DeptCode,EmploymentType");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_data_report_by_dept_employmenttype($branch){
        $data = $this->db->query("SELECT DeptCode, EmploymentType, COUNT(IDNumber) AS count FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY DeptCode,EmploymentType");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    // function get_report_emp_employmenttype_gtotals(){
    //     $this->db->select('DeptCode,EmploymentType, COUNT(IDNumber) AS count');
    //     $this->db->from('tbl_hr_append');
    //     $this->db->where("Status = 'Active'");
    //     $this->db->group_by('EmploymentType');
    //     $data = $this->db->get();
    //     if ($data->num_rows() > 0) {
    //         return $data->result();
    //     } else {
    //         return NULL;
    //     }
    // }

    function get_report_emp_employmenttype_gtotals($branch){
        $this->db->select('DeptCode,EmploymentType, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'");
        $this->db->where("Branch = '$branch'");
        $this->db->group_by('EmploymentType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    //Report With Parameter
    function get_last_data_company(){
        $data = $this->db->query("SELECT ComCode,ComName,ComShortName,ComDes FROM abase_01_com ORDER BY CtrlNo LIMIT 1");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_branch(){
        $data = $this->db->query("SELECT BranchCode,BranchName,BranchDes FROM abase_02_branch");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    /*For Ajax Start*/
    function get_dept_from_branch($branch){
        $data = $this->db->query("SELECT DeptCode, DeptDes FROM abase_03_dept WHERE Branch='$branch'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_dept_from_branch_all(){
        $data = $this->db->query("SELECT DeptCode, DeptDes FROM abase_03_dept");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_dept_from_bu($bus){
        $data = $this->db->query("SELECT DeptCode, DeptDes FROM abase_03_dept WHERE BUCode='$bus'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_buss_from_comp($dept){
        $branch = $this->session->userdata('branch');
        $data = $this->db->query("SELECT a.BUCode, a.BUDes FROM abase_03_dept_bu a LEFT JOIN abase_03_dept b ON b.BUCode = a.BUCode WHERE b.Branch='$branch' AND b.DeptCode ='$dept' GROUP BY a.BUCode");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_buss_from_comp_all(){
        $branch = $this->session->userdata('branch');
        $data = $this->db->query("SELECT a.BUCode, a.BUDes FROM abase_03_dept_bu a LEFT JOIN abase_03_dept b ON b.BUCode = a.BUCode WHERE b.Branch='$branch' GROUP BY a.BUCode");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }
    /*For Ajax End*/


   


    function get_list_businessunit_by_branch($branchcode){
        $query = $this->db->query("SELECT a.BUCode, a.BUDes FROM abase_03_dept_bu a LEFT JOIN abase_03_dept b ON b.BUCode = a.BUCode WHERE b.Branch= '$branchcode' GROUP BY a.BUCode");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_department_by_businessunit($branchcode,$businesscode){
        $query = $this->db->query("SELECT DeptCode,DeptDes FROM abase_03_dept  WHERE Branch= '$branchcode' AND BUCode= '$businesscode' GROUP BY DeptCode");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_department_by_branch($branchcode){
        $query = $this->db->query("SELECT DeptCode,DeptDes FROM abase_03_dept WHERE Branch = '$branchcode' ORDER BY DeptCode");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    // function get_list_costcenter_by_branch($branchcode){
    //     $query = $this->db->query("SELECT a.CostCenter, a.CCDes FROM abase_04_sectioncc a LEFT JOIN abase_03_dept b ON b.DeptCode = a.DeptCode WHERE b.Branch= '$branchcode' GROUP BY a.CostCenter");
    //     if ($query->num_rows() > 0) {
    //         return $query->result();
    //     } else {
    //         return false;
    //     }  
    // }

    function get_list_costcenter_by_branch($branchcode){
        $query = $this->db->query("SELECT a.CostCenter, a.CCDes FROM abase_04_cost_center a LEFT JOIN abase_03_dept b ON b.DeptCode = a.DeptCode WHERE b.Branch= '$branchcode' GROUP BY a.CostCenter");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    // function get_list_costcenter_by_department($branchcode,$businesscode,$departmentcode){
    //     $query = $this->db->query("SELECT a.CostCenter,a.CCDes FROM abase_04_sectioncc a LEFT JOIN abase_03_dept b ON b.DeptCode = a.DeptCode WHERE b.Branch= '$branchcode' AND b.BUCode= '$businesscode' AND b.DeptCode = '$departmentcode' GROUP BY a.CostCenter");

    //     if ($query->num_rows() > 0) {
    //         return $query->result();
    //     } else {
    //         return false;
    //     }  
    // }

    function get_list_costcenter_by_department($branchcode,$businesscode,$departmentcode){
        $query = $this->db->query("SELECT a.CostCenter,a.CCDes FROM abase_04_cost_center a LEFT JOIN abase_03_dept b ON b.DeptCode = a.DeptCode WHERE b.Branch= '$branchcode' AND b.BUCode= '$businesscode' AND b.DeptCode = '$departmentcode' GROUP BY a.CostCenter");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }


    //Employee Report

    //Employee Type
    //Summary
    function get_count_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmployeeType,EmployeeTypeDes, COUNT(EmployeeType) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmployeeType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_etype_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Company');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function get_report_emp_etype_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function get_report_emp_etype_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_etype_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_etype_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_etype($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('EmployeeType,EmployeeTypeDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmployeeType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }  

    function get_report_emp_etype_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes, EmployeeType, EmployeeTypeDes, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter, EmployeeType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_etype_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('EmployeeType,EmployeeTypeDes, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmployeeType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }



    //Detail
    function get_report_emp_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmployeeType,EmployeeTypeDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmployeeType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_){ 
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmployeeType,EmployeeTypeDes,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_employeetype_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$etype){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($etype == 'All') {
            # code...
            $etp = '';
        } else {
            $etp = " AND EmployeeType='" . $etype . "'";
        }

        $this->db->select('EmployeeType,EmployeeTypeDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $etp);
        $this->db->group_by('EmployeeType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

     function get_report_data_by_employeetype_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$etype){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($etype == 'All') {
            # code...
            $etp = '';
        } else {
            $etp = " AND EmployeeType='" . $etype . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmployeeType,EmployeeTypeDes,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $etp);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

     function get_report_data_by_employeetype_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$etype){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($etype == 'All') {
            # code...
            $etp = '';
        } else {
            $etp = " AND EmployeeType='" . $etype . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $etp);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }


    //Employee Class
    //Summary
    function get_count_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmployeeClass,EmployeeClassDes, COUNT(EmployeeClass) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmployeeClass');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }


    function get_report_emp_empclass_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Company');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

     function get_report_emp_empclass_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function get_report_emp_empclass_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_empclass_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_eclass_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('EmployeeClass,EmployeeClassDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmployeeClass');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }  

    function get_report_emp_empclass_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes, EmployeeClass, EmployeeClassDes, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter,  EmployeeClass');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_empclass_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('EmployeeClass,EmployeeClassDes, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmployeeClass');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }



    //Detail
    function get_report_emp_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmployeeClass,EmployeeClassDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmployeeClass');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_){ 
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmployeeClass,EmployeeClassDes,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_empclass_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empclass){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($empclass == 'All') {
            # code...
            $eclass = '';
        } else {
            $eclass = " AND EmployeeClass='" . $empclass . "'";
        }

        $this->db->select('EmployeeClass,EmployeeClassDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $eclass);
        $this->db->group_by('EmployeeClass');

        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

     function get_report_data_by_empclass_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empclass){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($empclass == 'All') {
            # code...
            $eclass = '';
        } else {
            $eclass = " AND EmployeeClass='" . $empclass . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmployeeClass,EmployeeClassDes,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $eclass);
        $data = $this->db->get();

        // print_r($this->db->last_query());
        // die();

        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }



    }

     function get_report_data_by_empclass_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empclass){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($empclass == 'All') {
            # code...
            $eclass = '';
        } else {
            $eclass = " AND EmployeeClass='" . $empclass . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $eclass);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }


    //Employment Type
    //Summary
    function get_count_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmploymentType,EmploymentTypeDes, COUNT(EmploymentType) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmploymentType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }


    function get_report_emp_employment_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Company');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

     function get_report_emp_employmenttype_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function get_report_emp_employmenttype_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_employmenttype_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_employmenttype_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('EmploymentType,EmploymentTypeDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmploymentType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }  

    function get_report_emp_employmenttype_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes, EmploymentType, EmploymentTypeDes, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter, EmploymentType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_employmenttype_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('EmploymentType,EmploymentTypeDes, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmploymentType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }



    //Detail
    function get_report_emp_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmploymentType,EmploymentTypeDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmploymentType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_){ 
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmploymentType,EmploymentTypeDes,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_employmenttype_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empltype){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($empltype == 'All') {
            # code...
            $empltp = '';
        } else {
            $empltp = " AND EmploymentType='" . $empltype . "'";
        }

        $this->db->select('EmploymentType,EmploymentTypeDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $empltp);
        $this->db->group_by('EmploymentType');

        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

     function get_report_data_by_employmenttype_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empltype){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($empltype == 'All') {
            # code...
            $empltp = '';
        } else {
            $empltp = " AND EmploymentType='" . $empltype . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmploymentType,EmploymentTypeDes,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $empltp);
        $data = $this->db->get();

        // print_r($this->db->last_query());
        // die();

        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }



    }

     function get_report_data_by_employmenttype_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empltype){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($empltype == 'All') {
            # code...
            $empltp = '';
        } else {
            $empltp = " AND EmploymentType='" . $empltype . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $empltp);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }


    //Employee Function
    function get_count_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('WorkFunction,WorkFunctionDes, COUNT(WorkFunction) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('WorkFunction');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,WorkFunction,WorkFunctionDes, COUNT(IDNumber) as ttl');
        $this->db->from('tbl_hr_append');  
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('WorkFunction');
        $this->db->group_by('CostCenter');
        $this->db->group_by('DeptCode');
        $this->db->group_by('BusinessUnit');
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_by_employeefunction_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empfunction_all_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($empfunction_all_ == 'All') {
            # code...
            $efunct = '';
        } else {
            $efunct = " AND WorkFunction='" . $empfunction_all_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,WorkFunction,WorkFunctionDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $efunct);
        $this->db->group_by('WorkFunction');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_employeefunction_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empfunction_all_){
        $this->db->select('IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation,BusinessUnit,BUDes,CostCenterDes,DeptCode,DeptDes,WorkFunction,WorkFunctionDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active' AND CostCenter = '$costcenter_' AND DeptCode = '$deptcode_'  AND BusinessUnit = '$bucode_' AND Branch = '$branch_' AND WorkFunction = '$empfunction_all_'");
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_employeefunction_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empfunction_all_){
        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active' AND CostCenter = '$costcenter_' AND DeptCode = '$deptcode_'  AND BusinessUnit = '$bucode_' AND Branch = '$branch_' AND WorkFunction = '$empfunction_all_'");
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,WorkFunction,WorkFunctionDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('WorkFunction');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation,BusinessUnit,CostCenterDes,BUDes,DeptCode,DeptDes,WorkFunction,WorkFunctionDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_employeefunction_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    //Employee Individual Grade
    function get_count_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IndividualGrade,IndividualGradeDes, COUNT(IndividualGrade) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('IndividualGrade');
        $this->db->order_by('IndividualLevelCode');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,IndividualGrade,IndividualGradeDes, COUNT(IDNumber) as ttl');
        $this->db->from('tbl_hr_append');  
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('IndividualGrade');
        $this->db->group_by('CostCenter');
        $this->db->group_by('DeptCode');
        $this->db->group_by('BusinessUnit');
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,IndividualGrade,IndividualGradeDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('IndividualGrade');
        $this->db->order_by('IndividualLevelCode');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation,BusinessUnit,CostCenterDes,BUDes,DeptCode,DeptDes,IndividualGrade,IndividualGradeDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_employeegrade_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    //Employee Individual Level
    function get_count_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IndividualLevelCode,IndividualLevelDes, COUNT(IndividualGrade) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('IndividualLevelCode');
        $this->db->order_by('IndividualLevelCode');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,IndividualLevelCode,IndividualLevelDes, COUNT(IDNumber) as ttl');
        $this->db->from('tbl_hr_append');  
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('IndividualLevelCode');
        $this->db->group_by('CostCenter');
        $this->db->group_by('DeptCode');
        $this->db->group_by('BusinessUnit');
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,IndividualLevelCode,IndividualLevelDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('IndividualLevelCode');
        $this->db->order_by('IndividualLevelCode ASC');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation,BusinessUnit,CostCenterDes,BUDes,DeptCode,DeptDes,IndividualLevelCode,IndividualLevelDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_employeelevel_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }


    //Gender
    //Summary
    function get_count_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,Gender, COUNT(Gender) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Gender');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_gender_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Company');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function get_report_emp_gender_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function get_report_emp_gender_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_gender_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_gender_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Gender');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Gender');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }  

    function get_report_emp_gender_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes, Gender, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter, Gender');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_gender_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Gender, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Gender');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }



    //Detail
    function get_report_emp_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,Gender');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Gender');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_){ 
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,Gender,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_gender_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$gender){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($gender == 'All') {
            # code...
            $gen = '';
        } else {
            $gen = " AND Gender='" . $gender . "'";
        }

        $this->db->select('Gender');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $gen);
        $this->db->group_by('Gender');

        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_gender_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$gender){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($gender == 'All') {
            # code...
            $gen = '';
        } else {
            $gen = " AND Gender='" . $gender . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,Gender,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $gen);
        $data = $this->db->get();

        // print_r($this->db->last_query());
        // die();

        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }



    }

    function get_report_data_by_gender_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$gender){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($gender == 'All') {
            # code...
            $gen = '';
        } else {
            $gen = " AND Gender='" . $gender . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $gen);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }



    //Marital
    //Summary
    function get_count_by_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,MaritalStatus,MaritalStatusDes, COUNT(MaritalStatus) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('MaritalStatus');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_marital_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Company');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function get_report_emp_marital_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function get_report_emp_marital_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_marital_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_marital_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('MaritalStatus,MaritalStatusDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('MaritalStatus');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }  

    function get_report_emp_marital_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes, MaritalStatus,MaritalStatusDes, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter, MaritalStatus');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_marital_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('MaritalStatus,MaritalStatusDes, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('MaritalStatus');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }



    //Detail
    function get_report_emp_by_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,MaritalStatus,MaritalStatusDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('MaritalStatus');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_){ 
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,MaritalStatus,MaritalStatusDes,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_marital_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$marital){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($marital == 'All') {
            # code...
            $mar = '';
        } else {
            $mar = " AND MaritalStatus='" . $marital . "'";
        }

        $this->db->select('MaritalStatus,MaritalStatusDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $mar);
        $this->db->group_by('MaritalStatus');

        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_marital_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$marital){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($marital == 'All') {
            # code...
            $mar = '';
        } else {
            $mar = " AND MaritalStatus='" . $marital . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,MaritalStatus,MaritalStatusDes,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $mar);
        $data = $this->db->get();

        // print_r($this->db->last_query());
        // die();

        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }



    }

    function get_report_data_by_marital_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$marital){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($marital == 'All') {
            # code...
            $mar = '';
        } else {
            $mar = " AND MaritalStatus='" . $marital . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $mar);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }




     //Religion
    //Summary
    function get_count_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,Religion, COUNT(MaritalStatus) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Religion');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_religion_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Company');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function get_report_emp_religion_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function get_report_emp_religion_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_religion_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_religion_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_){

        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Religion');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Religion');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }  

    function get_report_emp_religion_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes, Religion, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Branch, BusinessUnit, DeptCode, CostCenter, Religion');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_religion_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }
        $this->db->select('Religion, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Religion');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }



    //Detail
    function get_report_emp_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,Religion');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Religion');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_){ 
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,Religion,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_religion_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$religion){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($religion == 'All') {
            # code...
            $rel = '';
        } else {
            $rel = " AND Religion='" . $religion . "'";
        }

        $this->db->select('Religion');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $rel);
        $this->db->group_by('Religion');

        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_religion_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$religion){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($religion == 'All') {
            # code...
            $rel = '';
        } else {
            $rel = " AND Religion='" . $religion . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,Religion,
            IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $rel);
        $data = $this->db->get();

        // print_r($this->db->last_query());
        // die();

        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }



    }

    function get_report_data_by_religion_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$religion){
        
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        if ($religion == 'All') {
            # code...
            $rel = '';
        } else {
            $rel = " AND Religion='" . $religion . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter . $rel);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }


    //Ethnic
    function get_count_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Ethnic, COUNT(Ethnic) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Ethnic');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,Ethnic, COUNT(IDNumber) as ttl');
        $this->db->from('tbl_hr_append');  
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Ethnic');
        $this->db->group_by('CostCenter');
        $this->db->group_by('DeptCode');
        $this->db->group_by('BusinessUnit');
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,WorkFunction,Ethnic');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Ethnic');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation,BusinessUnit,CostCenterDes,BUDes,DeptCode,DeptDes,Ethnic');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_ethnic_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }


    //Company
    function get_count_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('EmpCompany,EmpCompanyDes, COUNT(EmpCompany) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmpCompany');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,EmpCompany,EmpCompanyDes, COUNT(IDNumber) as ttl');
        $this->db->from('tbl_hr_append');  
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmpCompany');
        $this->db->group_by('CostCenter');
        $this->db->group_by('DeptCode');
        $this->db->group_by('BusinessUnit');
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }
    
    function get_report_emp_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,WorkFunction,EmpCompany,EmpCompanyDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('EmpCompany');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation,BusinessUnit,CostCenterDes,BUDes,DeptCode,DeptDes,EmpCompany,EmpCompanyDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_company_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    //Department
    function get_count_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('DeptCode,DeptDes, COUNT(DeptCode) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('DeptCode');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,DeptDes, COUNT(IDNumber) as ttl');
        $this->db->from('tbl_hr_append');  
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('DeptCode');
        $this->db->group_by('CostCenter');
        $this->db->group_by('DeptCode');
        $this->db->group_by('BusinessUnit');
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,WorkFunction');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('DeptCode');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation,BusinessUnit,CostCenterDes,BUDes,DeptCode,DeptDes');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_department_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    //Location
    function get_count_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('WorkLocation, COUNT(WorkLocation) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('WorkLocation');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,WorkLocation, COUNT(IDNumber) as ttl');
        $this->db->from('tbl_hr_append');  
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('WorkLocation');
        $this->db->group_by('CostCenter');
        $this->db->group_by('DeptCode');
        $this->db->group_by('BusinessUnit');
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,WorkFunction,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('WorkLocation');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation,BusinessUnit,CostCenterDes,BUDes,DeptCode,DeptDes,WorkLocation');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_location_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    //Supervisor
    function get_count_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Supervisor,SupervisorName, COUNT(Supervisor) total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Supervisor');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,Supervisor,SupervisorName, COUNT(IDNumber) as ttl');
        $this->db->from('tbl_hr_append');  
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Supervisor');
        $this->db->group_by('CostCenter');
        $this->db->group_by('DeptCode');
        $this->db->group_by('BusinessUnit');
        $this->db->group_by('Branch');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_emp_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('Company,ComDes,Branch,BranchDes,BusinessUnit,BUDes,DeptCode,DeptDes,CostCenter,CostCenterDes,WorkFunction,Supervisor,SupervisorName');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $this->db->group_by('Supervisor');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,FirstName,LastName,JobTitle,JobTitleDes,Crew,CrewDes,WorkLocation,BusinessUnit,CostCenterDes,BUDes,DeptCode,DeptDes,Supervisor,SupervisorName');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    function get_report_data_by_supervisor_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_){
        if ($company_ == 'All') {
            # code...
            $company = '';
        } else {
            $company = " AND Company='" . $company_ . "'";
        }

        if ($branch_ == 'All') {
            # code...
            $branch = '';
        } else {
            $branch = " AND Branch='" . $branch_ . "'";
        }

        if ($bucode_ == 'All') {
            # code...
            $bucode = '';
        } else {
            $bucode = " AND BusinessUnit='" . $bucode_ . "'";
        }

        if ($deptcode_ == 'All') {
            # code...
            $deptcode = '';
        } else {
            $deptcode = " AND DeptCode='" . $deptcode_ . "'";
        }

        if ($costcenter_ == 'All') {
            # code...
            $costcenter = '';
        } else {
            $costcenter = " AND CostCenter='" . $costcenter_ . "'";
        }

        $this->db->select('IDNumber,Count(IDNumber) as total');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'" . $company . $branch . $bucode . $deptcode . $costcenter);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return NULL;
        }
    }

    //Start - 01Feb2021
    // function get_emp_dept() {
    //     $this->db->select('a.DeptCode, b.DeptDes');
    //     $this->db->from('tbl_hr_append a ');
    //     $this->db->join('abase_03_dept b ' , 'b.DeptCode = a.DeptCode' , 'LEFT');
    //     $this->db->group_by('a.DeptCode');
    //     $data = $this->db->get();
    //     return $data->result();
    // } 

    function get_emp_dept($branch) {
        $this->db->select('a.DeptCode, b.DeptDes');
        $this->db->from('tbl_hr_append a ');
        $this->db->join('abase_03_dept b ' , 'b.DeptCode = a.DeptCode' , 'LEFT');
        $this->db->where('a.Branch', $branch);
        $this->db->group_by('a.DeptCode');
        $data = $this->db->get();
        return $data->result();
    } 

    // function get_all_employee() {
    //     $data = $this->db->query("SELECT * FROM tbl_hr_append");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_all_employee($branch) {
        $data = $this->db->query("SELECT * FROM tbl_hr_append WHERE Branch = '$branch'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    // public function M_search_data($query)
    // {
    //     $this->db->select('a.*');
    //     $this->db->from('tbl_hr_append a');
    //     if ($query != '') {
    //         $this->db->like('a.IDNumber', $query);
    //         $this->db->or_like('a.FirstName', $query);
    //         $this->db->or_like('a.MiddleName', $query);
    //         $this->db->or_like('a.LastName', $query);
    //         $this->db->or_like('a.Gender', $query);
    //         $this->db->or_like('a.Address', $query);
    //     }
    //     $this->db->order_by('a.IDNumber', 'ASC');
    //     return $this->db->get();
    // }

    public function M_search_data($branch, $query)
    {
        return $this->db->query(
            "SELECT `a`.* FROM `tbl_hr_append` `a` 
             WHERE `a`.`Branch` = '$branch' 
             AND 
                (a.IDNumber LIKE '%$query%' OR 
                 a.FirstName LIKE '%$query%' OR 
                 a.MiddleName LIKE '%$query%' OR 
                 a.LastName LIKE '%$query%' OR 
                 a.Gender LIKE '%$query%' OR          
                 a.Address LIKE '%$query%') 
             ORDER BY `a`.`IDNumber` ASC"
        );
    }
    //End - 01Feb2021


    //Start - 26Mei2021
    function get_data_current_manpower_emptype_by_dept(){
        $data = $this->db->query("SELECT DeptCode, IndividualLevel, EmployeeType, CostCenter, CostCenterDes, IndividualLevelCode, IndividualLevelDes, COUNT(IDNumber) AS count FROM tbl_hr_append WHERE Status='Active' GROUP BY DeptCode,IndividualLevelCode,EmployeeType");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }
    //End - 26Mei2021

    //Start - 27Mei2021
    //Level
    function get_level_manpower(){
        $data = $this->db->query("SELECT IndividualLevelCode,IndividualLevel,IndividualLevelDes,DeptCode,CostCenter,CostCenterDes,EmployeeType FROM tbl_hr_append WHERE Status='Active' GROUP BY DeptCode,IndividualLevelCode");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_report_emp_etype_subtotals(){
        $data = $this->db->query("SELECT DeptCode,IndividualLevelCode,EmployeeType, COUNT(IDNumber) AS count FROM tbl_hr_append WHERE Status='Active' GROUP BY DeptCode,EmployeeType");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }
    //End - 27Mei2021


    //Start - 07Juni2021
    //Current Manpower Detail
    function get_data_manpower_detail(){
        $data = $this->db->query("SELECT IDNumber,FirstName,LastName,DeptCode,EmployeeType,EmployeeTypeDes,JobLevelCode,JobLevelDes,JobLevel,JobTitle,JobTitleDes,PositionTitle,PositionTitleDes,CostCenter,CostCenterDes FROM tbl_hr_append WHERE Status='Active' GROUP BY DeptCode,IDNumber");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }
    //End - 07Juni2021

    //Start - 04Juni2021
    // function get_data_emp_con_det(){
    //     $data = $this->db->query("SELECT a.IDNumber,a.ContractNo,a.NoOfContract,a.CommenceDate,a.CompletionDate,a.ReportTo,a.Status,b.PositionTitle,b.PositionTitleDes,b.FirstName,b.LastName,b.DeptCode,b.DeptDes FROM tbl_emp_contract a LEFT JOIN tbl_hr_append b ON b.ContractNo = a.ContractNo WHERE a.Status='Active' GROUP BY b.DeptCode,a.ContractNo");
    //     if ($data) {
    //         return $data->result();
    //     }else{
    //         return null;
    //     }
    // }

    function get_data_emp_con_det(){
        $data = $this->db->query("SELECT  a.IDNumber,a.ContractNo,a.NoOfContract,a.CommenceDate,a.CompletionDate,b.FirstName,b.LastName,b.DeptCode,b.DeptDes,COUNT(a.IDNumber) as total FROM tbl_emp_contract a LEFT JOIN tbl_hr_append b ON b.ContractNo = a.ContractNo WHERE a.Status='Active' GROUP BY b.DeptCode, a.ContractNo");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }
    //End - 07Juni2021

    //Start - 18Oct2021
    function get_data_comp()
    {
        $query = $this->db->query("SELECT *
                        FROM 
                            abase_01_com
                        WHERE 
                           ComCode = '0101'
                  ");
        if ($query->num_rows() > 0) {
              return $query->result();
        } else {
              return false;
        }
    }
    //End - 18Oct2021

    //Start - 30Nov2021
    function get_data_asset_byid($id){
        $data = $this->db->query("SELECT a.*, b.AssetName, b.Model, b.YearManufacture, c.DeptDes  FROM tbl_fa_asset_reg_user_his a LEFT JOIN tbl_fa_asset_fleet_reg_app b ON b.RegisterNo = a.RegisterNo LEFT JOIN abase_03_dept c ON c.DeptCode = a.Department WHERE a.FormerUser = '$id'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }
    //End - 30Nov2021















    //Start - Function ABC//
    //25October2021
    //Personal Register Modul
    function get_data_sum_employee_by_employeetype_abc($branch){
         $data = $this->db->query("SELECT sub.EStaff,sub.ENonStaff,sub.EExpat,sub.Total FROM (SELECT EmployeeType,SUM(IF(tb1.EmployeeType = '10',1,0)) AS EStaff, SUM(IF(tb1.EmployeeType = '20',1,0)) AS ENonStaff,SUM(IF(tb1.EmployeeType = '30',1,0)) AS EExpat, COUNT(tb1.IDNumber) AS Total FROM(SELECT CtrlNo,IDNumber ,EmployeeType FROM tbl_hr_append WHERE Branch = '$branch')tb1)sub");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_list_department_from_hr_append_abc($branch){
        $data = $this->db->query("SELECT DeptCode,DeptDes FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY DeptCode");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_function_abc($branch){
        $data = $this->db->query("SELECT WorkFunction,WorkFunctionDes FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY WorkFunction");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_report_by_dept_function_abc($branch){
        $data = $this->db->query(" SELECT WorkFunction,WorkFunctionDes,DeptCode, DeptDes, COUNT(IDNumber) as ttl FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY WorkFunction,DeptCode");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_employeetype_abc($branch){
        $data = $this->db->query("SELECT EmployeeType,EmployeeTypeDes FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY EmployeeType");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_report_by_dept_employeetype_abc($branch){
        $data = $this->db->query("SELECT DeptCode, EmployeeType, COUNT(IDNumber) AS count FROM tbl_hr_append WHERE Status='Active' AND Branch = '$branch' GROUP BY DeptCode,EmployeeType");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_report_emp_etype_gtotals_abc($branch){
        $this->db->select('DeptCode,EmployeeType, COUNT(IDNumber) AS count');
        $this->db->from('tbl_hr_append');
        $this->db->where("Status = 'Active'");
        $this->db->where('Branch', $branch);
        $this->db->group_by('EmployeeType');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return NULL;
        }
    }


    function get_data_company_abc(){
        $data = $this->db->query("SELECT ComCode,ComName,ComShortName,ComDes,CompType FROM abase_01_com");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_branch_abc($branch){
        $data = $this->db->query("SELECT BranchCode,BranchDes FROM abase_02_branch WHERE BranchCode = '$branch'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_data_supervisor_abc($branch){
        $data = $this->db->query("SELECT IDNumber,FirstName,LastName,PositionTitle,PositionTitleDes FROM tbl_hr_append WHERE Branch='$branch'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_emp_dept_abc($branch) {
        $this->db->select('a.DeptCode, b.DeptDes');
        $this->db->from('tbl_hr_append a ');
        $this->db->join('abase_03_dept b ' , 'b.DeptCode = a.DeptCode' , 'LEFT');
        $this->db->where('a.Branch', $branch);
        $this->db->group_by('a.DeptCode');
        $data = $this->db->get();
        return $data->result();
    } 

    function get_all_employee_abc($branch) {
        $data = $this->db->query("SELECT * FROM tbl_hr_append WHERE Branch = '$branch'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    public function M_search_data_abc($branch, $query)
    {
        return $this->db->query(
            "SELECT `a`.* FROM `tbl_hr_append` `a` 
             WHERE `a`.`Branch` = '$branch' 
             AND 
                (a.IDNumber LIKE '%$query%' OR 
                 a.FirstName LIKE '%$query%' OR 
                 a.MiddleName LIKE '%$query%' OR 
                 a.LastName LIKE '%$query%' OR 
                 a.Gender LIKE '%$query%' OR          
                 a.Address LIKE '%$query%') 
             ORDER BY `a`.`IDNumber` ASC"
        );
    }

    function get_all_data_structure_dept_abc($branch){
        $data = $this->db->query("SELECT a.DeptCode, a.DeptDes, b.BUCode,b.BUDes,c.DivCode,c.DivDes,d.BranchCode,d.BranchName,d.BranchDes,e.ComCode,e.ComName,e.ComDes FROM abase_03_dept a LEFT JOIN abase_03_dept_bu b ON b.BUCode = a.BUCode LEFT JOIN abase_03_dept_div c ON c.DivCode = b.DivCode LEFT JOIN abase_02_branch d ON d.BranchCode = a.Branch LEFT JOIN abase_01_com e ON e.ComCode = d.ComCode WHERE a.Branch = '$branch'");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    //End - Function ABC//


}   
