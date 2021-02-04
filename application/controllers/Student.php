<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

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

    public function index()
    {
        $id = $this->session->userdata('id');
        $room = $this->session->userdata('room');
        $semester = $this->session->userdata('semester');
        $period = $this->session->userdata('period');

        $detail = $this->Mdl_student->get_school_detail($room);

        extract($detail);

        $data = [
            'title' => 'Student Information',
            'id' => $this->session->userdata('id'),
            'active' => $isActive,
            'semester' => $semester,
            'schyear' => $period,
            'room' => $room,
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'prof' => $this->Mdl_student->get_full_profile($id),

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
        ];

        $this->load->view('student/home', $data);
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

    //Start - Student New Build
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

        $data = [
            'title' => 'Student Information',
            'id' => $this->session->userdata('id'),
            'semester' => $semester,
            'schyear' => $period,
            'room' => $room,
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'prof' => $this->Mdl_student->get_full_profile($id),

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
    //End - Student New Build


    //Finance Student Start
    function get_po_customer()
    {
        $cuscode = $this->input->post('id');
        $mdocno = $this->input->post('mdocno');
        $sup = $this->Mdl_student->get_list_class_desc($cuscode);
        $data2 = $this->Mdl_student->get_inv_details_stu_add($cuscode);
        if (empty($data2)) {
            $beg_bal = 0;
        } else {
            $beg_bal = $data2->end_balance;
        }
        $data = array(
            'Address' => $sup->Ruangan,
            'Contact' => $sup->FirstName . ' - ' . $sup->LastName,
            'Email' => $sup->PersonalID,
            'beg_bal' => $beg_bal
        );
        $value = '';
        // $data2 = $this->Mdl_student->get_inv_details_cus($cuscode);
        $paid_data = $this->Mdl_student->get_inv_details_stu_pay($cuscode);
        $paid_data_charges = $this->Mdl_student->get_details_stu_pay_charges($cuscode);
        $cek_nis_bb = $this->Mdl_student->getaccno_nis_bb($cuscode);
        if ($data2) {
            $ddcn = 'ada';
            $due = date('d-M-Y', strtotime($data2->sale_date));
            $beg_bal = $data2->remain_value;
            $value .= '<tr>';
            $value .= '<td>' . $due . '</td>';
            $value .= '<input type="hidden" name="due[]" value="' . $data2->sale_date . '">';
            $value .= '<td>' . $data2->sale_doc_no . '</td>';
            $value .= '<td></td>';
            $value .= '<input type="hidden" name="pono[]" value="' . $data2->sale_doc_no . '">';
            $value .= '<td class="sbold">Beginning Balance</td>';
            $value .= '<td></td>';
            // $value .= '<td>' . number_format(0, 2, ".", ",") . '</td>';
            // $value .= '<td>' . number_format(0, 2, ".", ",") . '</td>';
            $value .= '<td class="sbold" align="right">' . number_format($data2->end_balance, 2, ".", ",") . '</td>';
            $value .= '<input type="hidden" name="amt[]" value="' . $data2->end_balance . '">';
            $value .= '</tr>';

            if ($paid_data_charges) {
                foreach ($paid_data_charges as $rows) {
                    $accname = $this->Mdl_student->get_acc_name_ar($rows->AccNo);
                    $s = $rows->remain_value;
                    $due = date('d-M-Y', strtotime($rows->submit_date));
                    $debit = 0;
                    $value .= '<tr id="d_ar_data" ar_data="' . $bal_ . '">';
                    $value .= '<td>' . $due . '</td>';
                    $value .= '<td>' . $rows->sale_doc_no . '</td>';
                    $value .= '<td>' . $accname . '</td>';
                    $value .= '<td>' . number_format($rows->total_sale, 2, ".", ",") . '</td>';
                    $value .= '<td>' . $debit . '</td>';
                    if ($rows->Total_N_payment != 0) {
                        if($bal_ < 0){
                            $value .= '<td class="sbold" align="right">(' . number_format(abs($bal_), 2, ".", ",") . ')</td>';
                        }else{
                            $value .= '<td class="sbold" align="right">' . number_format($bal_, 2, ".", ",") . '</td>';
                        }
                        $value .= '<input type="hidden" name="amt[]" value="' . $bal_ . '">';
                    }
                    if ($rows->Total_N_payment == 0) {
                        if($bal_ < 0){
                            $value .= '<td class="sbold" align="right">(' . number_format(abs($bal_), 2, ".", ",") . ')</td>';
                        }else{
                            $value .= '<td class="sbold" align="right">' . number_format($bal_, 2, ".", ",") . '</td>';
                        }
                        $value .= '<input type="hidden" name="amt[]" value="' . $bal_ . '">';
                    }
                    $value .= '</tr>';
                }
            }
            if ($paid_data) {
                foreach ($paid_data as $rowss) {
                    $accname = $this->Mdl_student->get_acc_name_ar($rowss->AccNo);
                    $bal =  $beg_bal + $rowss->total_sale;
                    $due = date('d-M-Y', strtotime($rowss->submit_date));
                    $debit = 0;
                    $value .= '<tr id="d_ar_data" ar_data="' . $bal . '">';
                    $value .= '<td>' . $due . '</td>';
                    $value .= '<td>' . $rowss->sale_doc_no . '</td>';
                    $value .= '<td>' . $accname . '</td>';
                    $value .= '<td>' . $debit . '</td>';
                    $value .= '<td>' . number_format($rowss->total_sale, 2, ".", ",") . '</td>';
                    if($rowss->remain_value < 0){
                            $value .= '<td class="sbold" align="right">(' . number_format(abs($bal), 2, ".", ",") . ')</td>';
                    }else{
                            $value .= '<td class="sbold" align="right">' . number_format($bal, 2, ".", ",") . '</td>';
                    }
                    $value .= '<input type="hidden" name="amt[]" value="' . $bal . '">';
                    $value .= '</tr>';
                }
            }
        } else {        
            $hari_ini = date("Y-m-d"); 
            if($cek_nis_bb != false){
                $ddcn = $mdocno;
                if ($cek_nis_bb->Debit != 0) {
                    $val = $cek_nis_bb->Debit;
                }
                if ($cek_nis_bb->Credit != 0) {
                    $val = $cek_nis_bb->Credit;
                }
                $beg_bal = $val;
                $value .= '<tr>';
                $value .= '<td>' . $hari_ini . '</td>';
                $value .= '<input type="hidden" name="due[]" value="' . $hari_ini . '">';
                $value .= '<td>' . $ddcn . '</td>';
                $value .= '<td></td>';
                $value .= '<input type="hidden" name="pono[]" value="' . $ddcn . '">';
                $value .= '<td class="sbold">Beginning Balance</td>';
                $value .= '<td></td>';
                $value .= '<td class="sbold" align="right">' . number_format($val, 2, ".", ",") . '</td>';
                $value .= '<input type="hidden" name="amt[]" value="' . $val . '">';
                $value .= '</tr>';
                if ($paid_data_charges) {
                    foreach ($paid_data_charges as $rows) {
                        $accname = $this->Mdl_student->get_acc_name_ar($rows->AccNo);
                        $bal_ =  $beg_bal + $rows->remain_value;
                        $ddcn_ = $rows->remain_value;
                        $due = date('d-M-Y', strtotime($rows->submit_date));
                        $debit = 0;
                        $value .= '<tr id="d_ar_data" ar_data="' . $bal_ . '">';
                        $value .= '<td>' . $due . '</td>';
                        $value .= '<td>' . $rows->sale_doc_no . '</td>';
                        $value .= '<td>' . $accname . '</td>';
                        $value .= '<td>' . number_format($rows->total_sale, 2, ".", ",") . '</td>';
                        $value .= '<td>' . $debit . '</td>';
                        if ($rows->Total_N_payment != 0) {
                            if($bal_<1){
                                $value .= '<td class="sbold" align="right">(' . number_format(abs($bal_), 2, ".", ",") . ')</td>';
                            }else{
                                $value .= '<td class="sbold" align="right">' . number_format($bal_, 2, ".", ",") . '</td>';
                            }
                            $value .= '<input type="hidden" name="amt[]" value="' . $bal_ . '">';
                        }
                        if ($rows->Total_N_payment == 0) {
                            if ($bal_ < 1) {
                                $value .= '<td class="sbold" align="right">(' . number_format(abs($bal_), 2, ".", ",") . ')</td>';
                            } else {
                                $value .= '<td class="sbold" align="right">' . number_format($bal_, 2, ".", ",") . '</td>';
                            }
                            $value .= '<input type="hidden" name="amt[]" value="' . $bal_ . '">';
                        }
                        $value .= '</tr>';
                    }
                }
                if ($paid_data) {
                    foreach ($paid_data as $rowss) {
                        $accname = $this->Mdl_student->get_acc_name_ar($rowss->AccNo);
                        $bal =  $beg_bal + $rowss->total_sale;
                        $ddcn_ =  $beg_bal + $rowss->total_sale;
                        $due = date('d-M-Y', strtotime($rowss->submit_date));
                        $debit = 0;
                        $value .= '<tr id="d_ar_data" ar_data="' . $bal . '">';
                        $value .= '<td>' . $due . '</td>';
                        $value .= '<td>' . $rowss->sale_doc_no . '</td>';
                        $value .= '<td>' . $accname . '</td>';
                        $value .= '<td>' . $debit . '</td>';
                        $value .= '<td>' . number_format($rowss->total_sale, 2, ".", ",") . '</td>';
                        if($rowss->remain_value < 0){
                                $value .= '<td class="sbold" align="right">(' . number_format(abs($bal), 2, ".", ",") . ')</td>';
                        }else{
                                $value .= '<td class="sbold" align="right">' . number_format($bal, 2, ".", ",") . '</td>';
                        }
                        $value .= '<input type="hidden" name="amt[]" value="' . $bal . '">';
                        $value .= '</tr>';
                    }
                }
            }else{
                $ddcn = '';
                $ddcn_ = '';
                $hari_ini = date("Y-m-d"); 
                $value .= '<tr>';
                 $value .= '<td>' . $hari_ini . '</td>';
                $value .= '<input type="hidden" name="due[]" value="' . $hari_ini . '">';
                $value .= '<td>' . $ddcn . '</td>';
                $value .= '<td></td>';
                $value .= '<input type="hidden" name="pono[]" value="' . $ddcn . '">';
                $value .= '<td class="sbold">Beginning Balance</td>';
                $value .= '<td></td>';
                // $value .= '<td>' . number_format(0, 2, ".", ",") . '</td>';
                // $value .= '<td>' . number_format(0, 2, ".", ",") . '</td>';
                $value .= '<td class="sbold" align="right">' . number_format(0, 2, ".", ",") . '</td>';
                $value .= '<input type="hidden" name="amt1[]" value="' . 0 . '">';
                $value .= '<input type="hidden" name="amt2[]" value="' . 0 . '">';
                $value .= '<input type="hidden" name="amt[]" value="' . 0 . '">';
                $value .= '</tr>';
            }
        }
        echo json_encode(array($data, $value, $ddcn));
    }
    //Finance Student End


}
