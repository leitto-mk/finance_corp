<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('upload');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('student/Mdl_student');
        $this->load->model('duty/Mdl_duty');

        //If there is no known user and role is wrong
        if ($this->session->userdata('status') != 'student') {
            echo "<script> console.log('Wrong Role, redirect to Auth'); </script>";
            redirect('Auth/index');
        }
    }
    
    public function get_full_acd_detail()
    {
        $id = $_POST['id'];
        $semester = $_POST['semester'];
        $period = $_POST['period'];

        $schedule = $this->Mdl_student->get_schedule_full($id, $semester, $period);
        [$grades, $voc] = $this->Mdl_student->model_get_full_acd_detail($id, $semester, $period);
        $absent = $this->Mdl_student->get_absence_full($id, $semester, $period);

        $sch = '';
        foreach ($schedule as $row) {
            $sch .= '   <tr>
                            <td style="border-bottom: 0px;" class="text-center sbold">
                                ' . $row->Start . ' ' . $row->Finish . '
                            </td>
                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center uppercase sbold">' . $row->Mon . '</td>
                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center uppercase sbold">' . $row->Tue . '</td>
                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center uppercase sbold">' . $row->Wed . '</td>
                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center uppercase sbold">' . $row->Thu . '</td>
                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center uppercase sbold">' . $row->Fri . '</td>
                        </tr>';
        }

        $cog = '';
        $i = $j = $k = $l = $m = $n = 1;

        foreach ($grades as $row) {
            $cog .= '   <tr>
                            <td class="sbold uppercase"> ' . $i . ' </td>
                            <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                            <td class="sbold uppercase"> ' . $row->MidRecap . ' </td>
                            <td class="sbold uppercase"> ' . $row->Report . ' </td>
                            <td class="sbold uppercase"> ' . $row->Predicate . ' </td>
                            <td class="sbold"> ' . $row->Description . ' </td>
                        </tr>';

            $i++;
        }

        $sk = '';
        foreach ($grades as $row) {
            $sk .= '   <tr>
                            <td class="sbold uppercase"> ' . $j . ' </td>
                            <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                            <td class="sbold uppercase"> ' . $row->Report_SK . ' </td>
                            <td class="sbold uppercase"> ' . $row->Predicate_SK . ' </td>
                            <td class="sbold"> ' . $row->Description_SK . ' </td>
                        </tr>';

            $j++;
        }

        $soc = '';
        $soc .= '<tr class="sbold"><td colspan="5">Social</td></tr>';
        foreach ($grades as $row) {
            $soc .= '   <tr>
                            <td class="sbold uppercase"> ' . $k . ' </td>
                            <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                            <td class="sbold uppercase"> ' . $row->Report_SOC . ' </td>
                            <td class="sbold uppercase"> ' . $row->Predicate_SOC . ' </td>
                            <td class="sbold"> ' . $row->Description_SOC . ' </td>
                        </tr>';

            $k++;
        }

        $spr = '';
        $spr .= '<tr class="sbold"><td colspan="5">Spiritual</td></tr>';
        foreach ($grades as $row) {
            $spr .= '   <tr>
                            <td class="sbold uppercase"> ' . $l . ' </td>
                            <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                            <td class="sbold uppercase"> ' . $row->Report_SPR . ' </td>
                            <td class="sbold uppercase"> ' . $row->Predicate_SPR . ' </td>
                            <td class="sbold"> ' . $row->Description_SPR . ' </td>
                        </tr>';

            $l++;
        }

        $voc_row = '';
        foreach ($voc as $row) {
            $voc_row .= '   <tr>
                            <td class="sbold uppercase"> ' . $n . ' </td>
                            <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                            <td class="sbold uppercase"> ' . $row->Report . ' </td>
                            <td class="sbold uppercase"> ' . $row->Predicate . ' </td>
                            <td class="sbold"> ' . $row->Description . ' </td>
                        </tr>';

            $n++;
        }

        $abs = '';
        foreach ($absent as $row) {
            $abs .= '   <tr>';
            $abs .= '       <td class="sbold"> ' . $m . ' </td>';
            $abs .= '       <td class="sbold"> ' . $row->Absent . ' </td>';
            if ($row->Ket == 'Sick') {
                $abs .= '   <td> <span class="label label-warning label-sm uppercase">' . $row->Ket . '</span></td>';
            } elseif ($row->Ket == 'On Permit') {
                $abs .= '   <td> <span class="label label-success label-sm uppercase">' . $row->Ket . '</span></td>';
            } elseif ($row->Ket == 'Absent') {
                $abs .= '   <td> <span class="label label-danger label-sm uppercase">' . $row->Ket . '</span></td>';
            } elseif ($row->Ket == 'Truant') {
                $abs .= '   <td> <span class="label label-primary label-sm uppercase">' . $row->Ket . '</span></td>';
            } elseif ($row->Ket == 'Late') {
                $abs .= '   <td> <span class="label label-info label-sm uppercase">' . $row->Ket . '</span></td>';
            }
            $abs .= '   </tr>';

            $m++;
        }

        $response = [
            //SCHEDULE
            'SCH' => $sch,

            //GRADES
            'COG' => $cog,
            'SK' => $sk,
            'SOC' => $soc,
            'SPR' => $spr,
            'VOC' => $voc_row,

            //ABSENT
            'ABS' => $abs
        ];

        echo json_encode($response);
    }

    public function chg_pass()
    {
        $id = $this->session->userdata('id');
        $sesspass = $this->db->get_where('tbl_credentials', ['IDNumber' => $id])->row()->password;
        $curpass = $_POST['oldpass'];
        $curpass = md5($curpass);
        $newpass = $_POST['newpass'];
        $renewpass = $_POST['renewpass'];

        if ($curpass == '' || $newpass == '' || $renewpass == '') {
            $data = [
                'type' => 'error',
                'title' => 'UPDATE FAILED',
                'text' => 'PLEASE FILL ALL THE FORM!',
                'code' => 'empty'
            ];
        } else {
            if ($curpass !== $sesspass) {
                $data = [
                    'type' => 'error',
                    'title' => 'UPDATE FAILED',
                    'text' => 'CURRENT PASSWORD IS INCORRECT!',
                    'code' => 'incorrect'
                ];
            } else {
                if ($curpass === md5($newpass)) {
                    $data = [
                        'type' => 'error',
                        'title' => 'UPDATE FAILED',
                        'text' => 'NEW PASSWORD IS IDENTICAL WITH CURRENT PASSWORD!',
                        'code' => 'identical'
                    ];
                } else {
                    if ($newpass !== $renewpass) {
                        $data = [
                            'type' => 'error',
                            'title' => 'UPDATE FAILED',
                            'text' => 'PLEASE MATCH NEW PASSWORD WITH RE-CONFIRMATION FIELD!',
                            'code' => 'reconfirm'
                        ];
                    } else {
                        $newpass = md5($newpass);

                        $result = $this->Mdl_student->sv_pass($id, $newpass);

                        if ($result == 'success') {
                            $data = [
                                'type' => 'success',
                                'title' => 'UPDATE SUCCESS',
                                'text' => 'YOUR PASSWORD HAS BEEN UPDATED',
                                'code' => 'success'
                            ];
                        } else {
                            $data = [
                                'type' => 'error',
                                'title' => 'UPDATE FAILED',
                                'text' => 'Update password failed due to server problem !',
                                'code' => 'server'
                            ];
                        }
                    }
                }
            }
        }

        echo json_encode($data);
    }

    public function get_nonregular_subjects()
    {
        $type = $this->uri->segment(3);
        $subj = strtoupper($type);

        $query = $this->db->query(
            "SELECT SubjName FROM tbl_05_subject
             WHERE Type = '$type'
             AND SubjName != '$subj'"
        )->result();

        echo json_encode($query);
    }

    public function ajax_get_school_event(){
        $result = $this->db->query(
            "SELECT Title, DateStart, DateEnd, Color FROM tbl_13_calendar"
        )->result();

        echo json_encode($result);
    }

    //NEW PORTAL
    public function home()
    {
        $id = $this->session->userdata('id');
        $status = $this->session->userdata('status');
        $cls = $this->session->userdata('cls');
        $room = $this->session->userdata('room');
        $school = $this->session->userdata('school');
        $semester = $this->session->userdata('semester');
        $period = $this->session->userdata('period');
        
        $detail = $this->Mdl_student->get_school_detail($room);

        extract($detail);

        $newstudentstatus = $this->db
            ->select('is_enrolled, is_approved, Phone,
                        is_approved_diploma, is_approved_birthcert, is_approved_kk, is_approved_photo, is_approved_spp,
                        unapproved_birthcert_msg, unapproved_kk_msg, unapproved_photo_msg, unapproved_spp_msg, unapproved_diploma_msg')
            ->get_where('tbl_11_enrollment', [
                'CtrlNo' => $this->session->userdata('ctrlno'),
                'FirstName' => $this->session->userdata('fname'),
                'LastName' => $this->session->userdata('lname'),
            ])->row();

        if($newstudentstatus){
            $data = [
                'title' => 'Student Information',
                'id' => $this->session->userdata('id'),
                'schoolapplied' => $this->session->userdata('schoolapplied'),
                'birth' => $this->session->userdata('birth'),
                'semester' => $semester,
                'schyear' => $period,
                'room' => $room,
                'fname' => $this->session->userdata('fname'),
                'lname' => $this->session->userdata('lname'),
                'status' => $this->session->userdata('status'),
                'phone' => $newstudentstatus->Phone,
                'photo' => $this->session->userdata('photo'),
                'prof' => $this->Mdl_student->get_full_profile($id),
                'active' => 0,

                //NEW STUDENT DATA
                'is_enrolled' => ($newstudentstatus->is_enrolled ?: 0),
                'is_approved' => ($newstudentstatus->is_approved ?: 0),
                'schoolappliedname' => $this->db->select('SchoolName')->get_where('tbl_02_school', ['School_Desc' => $this->session->userdata('schoolapplied')])->row()->SchoolName,
                'is_approved_diploma' => $newstudentstatus->is_approved_diploma,
                'is_approved_birthcert' => $newstudentstatus->is_approved_birthcert,
                'is_approved_kk' => $newstudentstatus->is_approved_kk,
                'is_approved_photo' => $newstudentstatus->is_approved_photo,
                'is_approved_spp' => $newstudentstatus->is_approved_spp,
                'unapproved_diploma_msg' => $newstudentstatus->unapproved_diploma_msg,
                'unapproved_birthcert_msg' => $newstudentstatus->unapproved_birthcert_msg,
                'unapproved_kk_msg' => $newstudentstatus->unapproved_kk_msg,
                'unapproved_photo_msg' => $newstudentstatus->unapproved_photo_msg,
                'unapproved_spp_msg' => $newstudentstatus->unapproved_spp_msg,
    
                //MODAL AKADEMIK
                'period' => $this->Mdl_student->get_period($id),
    
                //SCHEDULE
                'mon' => $this->Mdl_student->get_schedule($id, 'Senin', $room),
                'tue' => $this->Mdl_student->get_schedule($id, 'Selasa', $room),
                'wed' => $this->Mdl_student->get_schedule($id, 'Rabu', $room),
                'thu' => $this->Mdl_student->get_schedule($id, 'Kamis', $room),
                'fri' => $this->Mdl_student->get_schedule($id, 'Jumat', $room),
    
                //SCHOOL DETAILS
                'homeroom' => $homeroom,
                'total' => $total,
    
                //ABSENCE
                'absn' => $this->Mdl_student->get_absent($id, $room, 'Absent'),
                'permit' => $this->Mdl_student->get_absent($id, $room, 'On Permit'),
                'sick' => $this->Mdl_student->get_absent($id, $room, 'Sick'),
                'truant' => $this->Mdl_student->get_absent($id, $room, 'Truant'),
                'late' => $this->Mdl_student->get_absent($id, $room, 'Late'),
    
                //Duty
                'data_duty' => $this->Mdl_duty->get_list_data_duty($school,$status,$cls,$room,$id)
            ];
        }else{
            $data = [
                'title' => 'Student Information',
                'id' => $this->session->userdata('id'),
                'schoolapplied' => $this->session->userdata('schoolapplied'),
                'birth' => $this->session->userdata('birth'),
                'semester' => $semester,
                'schyear' => $period,
                'room' => $room,
                'fname' => $this->session->userdata('fname'),
                'lname' => $this->session->userdata('lname'),
                'status' => $this->session->userdata('status'),
                'photo' => $this->session->userdata('photo'),
                'prof' => $this->Mdl_student->get_full_profile($id),
                
                //NEW STUDENT DATA
                'active' => 1,
                'is_enrolled' => 1,
                'is_approved' => 1,
                'schoolappliedname' => '',
                'is_approved_diploma' => 1,
                'is_approved_birthcert' => 1,
                'is_approved_kk' => 1,
                'is_approved_photo' => 1,
                'is_approved_spp' => 1,
                'unapproved_diploma_msg' => 1,
                'unapproved_birthcert_msg' => 1,
                'unapproved_kk_msg' => 1,
                'unapproved_photo_msg' => 1,
                'unapproved_spp_msg' => 1,
    
                //MODAL AKADEMIK
                'period' => $this->Mdl_student->get_period($id),
    
                //SCHEDULE
                'mon' => $this->Mdl_student->get_schedule($id, 'Senin', $room),
                'tue' => $this->Mdl_student->get_schedule($id, 'Selasa', $room),
                'wed' => $this->Mdl_student->get_schedule($id, 'Rabu', $room),
                'thu' => $this->Mdl_student->get_schedule($id, 'Kamis', $room),
                'fri' => $this->Mdl_student->get_schedule($id, 'Jumat', $room),
    
                //SCHOOL DETAILS
                'homeroom' => $homeroom,
                'total' => $total,
    
                //ABSENCE
                'absn' => $this->Mdl_student->get_absent($id, $room, 'Absent'),
                'permit' => $this->Mdl_student->get_absent($id, $room, 'On Permit'),
                'sick' => $this->Mdl_student->get_absent($id, $room, 'Sick'),
                'truant' => $this->Mdl_student->get_absent($id, $room, 'Truant'),
                'late' => $this->Mdl_student->get_absent($id, $room, 'Late'),
    
                //Duty
                'data_duty' => $this->Mdl_duty->get_list_data_duty($school,$status,$cls,$room,$id)
            ];
        }

        $this->load->view('student/home', $data);
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

    public function ajax_submit_tuition(){
        $filename = strtolower($_POST['fname'] . '_' . $_POST['lname']) . '_' . date('Ymdhms');

        $spp = '';

        //CHECK IF DATA ALREADY EXSIST
        $checkData = $this->db->select('SPP')->get_where('tbl_11_enrollment', [
            'Email' => $_POST['id'],
            'FirstName' => $_POST['fname'],
            'LastName' => $_POST['lname']
        ])->row();

        $compress['image_library'] = 'gd2';
        $compress['create_thumb'] = FALSE;
        $compress['maintain_ratio'] = FALSE;
        $compress['quality'] = '60%';
        $compress['width'] = 800;
        $compress['height'] = 800;

        if($_FILES['file']['name'] !== ''){
            $spp = "spp_$filename";
            $sppext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); //GET FILE EXTENTION
            
            //If there's image for ID already, delete the old one
            if($checkData){
                if (is_file('./assets/photos/student/' . $checkData->SPP)) {
                    unlink('./assets/photos/student/' . $checkData->SPP);
                }
            }
        
            $this->upload->initialize([
                'upload_path' => './assets/photos/student/',
                'allowed_types' => 'gif|jpg|jpeg|png',
                'file_name' => $spp
            ]);

            $this->upload->do_upload('file');
            
            //Compress uploaded image
            $compress['source_image'] = './assets/photos/student/' . $spp . '.' . $sppext;
            $compress['new_image'] = './assets/photos/student/' . $spp . '.' . $sppext;
            $this->load->library('image_lib', $compress);
            $this->image_lib->resize();

            $result = $this->Mdl_student->upload_tuition($_POST['id'], $_POST['fname'], $_POST['lname'], $spp . '.' . $sppext);

            echo $result;
        }
    }

    //FINANCE STUDENT
    function ajax_get_std_account(){
        $nis = $this->session->userdata('id');

        $result = $this->db->query(
            "SELECT 
                DATE_FORMAT(t1.TransDate, '%d-%m-%Y') AS TransDate, 
                t1.AccGroupReg,
                t2.Acc_Name,
                t1.DocNo,
                (SELECT SUM(t1.Amount) FROM tbl_12_fin_std_charge_det WHERE NIS = '$nis' GROUP BY NIS) AS Amount
             FROM tbl_12_fin_std_charge_det AS t1
             LEFT JOIN tbl_fa_mas_account AS t2
                ON t1.AccGroupReg = t2.Acc_No
             WHERE t1.NIS = '$nis'
             GROUP BY t1.DocNo"
        )->row();

        echo json_encode($result);
    }
}
