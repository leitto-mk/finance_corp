<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Duty extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('duty/Mdl_duty');

        //If there is no known user and role is wrong
        //redirect back to login page
        if ($this->session->userdata('status') != 'admin') {
            redirect('Auth/index');
        }
    }

    public function index()
    {   
        $query['title'] = 'News & Assignments';
        $query['headertitle'] = 'Create News & Assignments';
        $query['submit_by'] = $this->session->userdata('fname');
        $query['getauto'] = $this->Mdl_duty->get_incid_duty();
        if ($query['getauto'] == '') {
          $increment = 0;
        }else{
        $increment=$query['getauto'][0]->CtrlNo;
        }
        $query['autoidnum'] = $increment + 1;
        $query['date'] = date('Y-m-d');
        $query['schooltype'] = $this->Mdl_duty->get_school();
        $query['cstatus'] = $this->Mdl_duty->get_category_status();
        $query['data_duty_all'] = $this->Mdl_duty->get_list_data_duty_all();
        $this->load->view('duty/v_new_duty',$query);
    }

    //News & Assigments
    function get_list_school(){
        $data = $this->Mdl_duty->get_school_dropdown();
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));
        }
    }

    function get_list_class_by_school(){
        $schcode =  $this->input->post('id_sch');
        $data = $this->Mdl_duty->get_list_sch_by_school($schcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }
     
    function get_data_list_room_by_class(){
        $clscodesid =  $this->input->post('cls_codes_id');
        $data = $this->Mdl_duty->get_list_room_by_class($clscodesid);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_data_list_data_by_room(){
        $rmcodes =  $this->input->post('rm_codes');
        $data = $this->Mdl_duty->get_list_data_by_room($rmcodes);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_data_list_data_by_category(){
        $cstatuscodes =  $this->input->post('cstatus_codes');
        $data = $this->Mdl_duty->get_list_data_by_category($cstatuscodes);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_detail_data_news_assigments(){
        $idctrlno =  $this->input->post('id_ctrlno');
        $data_duty_detail = $this->Mdl_duty->get_data_detail_news_assigments($idctrlno);
        
        $value = '';
        if ($data_duty_detail != false){
            foreach ($data_duty_detail as $dda){            
                $value.='<div class="col-md-9" style="margin-top: -10px">';
                $value.='<div class="col-md-12">';
                $value.='<div class="portlet-body">';
                $value.='<div class="form-body">';
                $value.='<div class="form-group">';
                $value.='<label class="col-md-2 control-label"><b>Document No<span><font color="red">*</font>:</span></b></label>';
                $value.='<div class="col-md-3">';
                $value.='<input  class="form-control" value='.$dda->CtrlNo.' readonly>';                                            
                $value.='</div>';
                $value.='<label class="col-md-2 control-label"><b>Due Date<span><font color="red">*</font>:</span></b></label>';
                $value.='<div class="col-md-3">';
                $value.='<input class="form-control font-red bold" value="'.date('d-M-Y', strtotime($dda->DueDate)).'" readonly>';                                      
                $value.='</div>';
                $value.='</div>';
                $value.='</div>';                                                                                               
                $value.='</div>';
                $value.='</div>';
                $value.='<div class="portlet light" style="background-color: #f6f6f6">';
                $value.='<div class="row">';
                $value.='<div class="portlet-title">';
                $value.='<div class="caption">';
                $value.='<span class="caption-subject font-dark sbold uppercase" ><i class="fa fa-warning"></i>  Description</span>';
                $value.='<p style="border: solid 1px;color: #555; margin-top: 5px"></p>';
                $value.='</div>';
                $value.='</div>';
                $value.='<div class="col-md-12" style="margin-top: -15px">';
                $value.='<div class="portlet-body">';
                $value.='<div class="form-body">';
                $value.='<div class="form-group">';
                $value.='<label class="col-md-2 control-label"><b>Type<span><font color="red">*</font>:</span></b></label>';
                $value.='<div class="col-md-3">';
                $value.='<input  class="form-control" style="background-color: white" value="'.$dda->AssignmentType.'" readonly>';                           
                $value.='</div>';                                                                   
                $value.='</div>';                                                    
                $value.='</div>';
                $value.='</div>';
                $value.='</div>';                                         
                $value.='</div>';
                $value.='</div>';
                $value.='<div class="portlet light" style="background-color: #f6f6f6">';
                $value.='<div class="row">';
                $value.='<div class="col-md-12" style="margin-top: -55px">';
                $value.='<div class="portlet-body">';
                $value.='<div class="form-body">';
                $value.='<div class="form-group">';
                $value.='<label class="col-md-2 control-label"><b>Title<span><font color="red">*</font>:</span></b></label>';
                $value.='<div class="col-md-10">';
                $value.='<input  class="form-control" rows="2" style="background-color: white" value="'.$dda->AssignmentTitle.'" readonly>';                               
                $value.='</div>';                                                                 
                $value.='</div>';                                                      
                $value.='</div>';
                $value.='</div>';
                $value.='</div>';                                           
                $value.='</div>';
                $value.='</div>';
                $value.='<div class="portlet light" style="background-color: #f6f6f6">';
                $value.='<div class="row">';
                $value.='<div class="col-md-12" style="margin-top: -55px">';
                $value.='<div class="portlet-body">';
                $value.='<div class="form-body">';
                $value.='<div class="form-group">';
                $value.='<label class="col-md-2 control-label"><b>Details <span><font color="red">*</font>:</span></b></label>';
                $value.='<div class="col-md-10 bold">"'.$dda->AssignmentDetail.'"</div>';
                $value.='</div>';                                                    
                $value.='</div>';
                $value.='</div>';
                $value.='</div>';
                $value.='</div>';
                $value.='</div>';
                $value.='</div>';                                          
                $value.='<div class="col-md-3" style="border-left: solid; border-width: 1px; border-color: white; height: 400px">';
                $value.='<div class="col-md-12 col-sm-12 col-xs-12 invoice-payment" style="background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa">';
                $value.='<h3>Submited Status:</h3>';
                $value.='<ul class="list-unstyled">';
                $value.='<li>';
                $value.='<strong>Category <b style="margin-left: 7px">:</b></strong> '.$dda->SubmitTo.' </li>';
                if ($dda->TypeSchool != 'All') {
                $value.='<li>';
                $value.='<strong>School <b style="margin-left: 20px">:</b></strong> '.$dda->SchoolName.' </li>';
                }else{
                $value.='<li>';
                $value.='<strong>School <b style="margin-left: 20px">:</b></strong> All </li>';  
                }
                $value.='<li>';
                $value.='<strong>Class <b style="margin-left: 28px">:</b></strong> '.$dda->Class.' </li>';
                $value.='<li>';
                $value.='<strong>Room <b style="margin-left: 26px">:</b></strong> '.$dda->Room.' </li>';
                $value.='<li>';
                $value.='<strong>To <b style="margin-left: 49px">:</b></strong> '.$dda->IDNumber.' </li>';
                $value.='</ul>';
                $value.='</div>';
                $value.='<div class="col-md-12 col-sm-12 col-xs-12 invoice-payment" style="margin-top: 30px; background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa">';
                $value .='<h3>Submited:</h3>';
                $value .='<ul class="list-unstyled">';
                $value .='<li>';
                $value .='<strong>By <b style="margin-left: 49px">:</b></strong> '.$dda->SubmitBy.'</li>';
                $value .='<li>';
                $value .='<strong>Date <b style="margin-left: 35px">:</b></strong>';
                $value .='<input type="date" name="submitdate" class="form-control hidden" value="'.$date.'" required> '.date('d-M-Y', strtotime($dda->SubmitDate)).'';
                $value .='</li>';
                $value .='</ul>';
                $value .='</div>';
                $value .='</div>';
            } 
        } else { 
            $value .='<h2 align="center"  class="font-red bold">No Data News & Assignment!</h2>';
        }
        echo $value;
    }

    function transfer_newduty(){
        $idnumber = $this->session->userdata('id');
        if ($this->input->post('submitduty')) {
            //Master Manpower
            $query['Midn'] = $idn_ = $this->input->post('idn');
            $query['Msubmitdate'] = $submitdate_ = $this->input->post('submitdate');
            $query['Mcatstatus'] = $catstatus_ = $this->input->post('catstatus');
            $query['Msch'] = $sch_ = ($this->input->post('sch') ? $this->input->post('sch') : 'All');
            $query['Mcls'] = $cls_ = ($this->input->post('cls') ? $this->input->post('cls') : 'All');
            $query['Mrm'] = $rm_ = ($this->input->post('rm') ? $this->input->post('rm') : 'All');
            $query['Midnum'] = $idnum_ = $this->input->post('idnum');
            $query['Mtype'] = $type_ = $this->input->post('type');
            $query['Mtitle'] = $title_ = $this->input->post('title');
            $query['Mdetail'] = $detail_ = $this->input->post('detail');
            $query['Mduedate'] = $duedate_ = $this->input->post('duedate');
          
            $dataDuty=array(
                'CtrlNo' =>$idn_,
                'SubmitBy' => $idnumber,
                'SubmitDate' => $submitdate_,
                'SubmitTo' =>$catstatus_,
                'TypeSchool' =>$sch_,
                'Class' =>$cls_,
                'Room' =>$rm_,
                'IDNumber' =>$idnum_,
                'AssignmentType' =>$type_,
                'AssignmentTitle' =>$title_,
                'AssignmentDetail' =>$detail_,
                'DueDate' =>$duedate_
                );
            $query_insert = $this->Mdl_duty->insert('tbl_duty', $dataDuty);
            if($query_insert){
                $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success !</strong> data submitted</center> </div>');
                    redirect('Duty');
            }else{
                $this->session->set_flashdata('error_msg_added', '<div class="alert alert-danger alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Failed to submit data!</strong></center> </div>');
                 redirect('Duty');
            }     
        }else{
            $this->session->set_flashdata('error_msg_added', '<div class="alert alert-danger alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Failed to submit data!</strong></center> </div>');
             redirect('Duty');
        }              
    }
}
