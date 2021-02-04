<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('report/Mdl_report');

        //If there is no known user and role is wrong
        //redirect back to login page
        if ($this->session->userdata('status') != 'admin') {
            redirect('Auth/index');
        }
    }

    public function view_report()
    {   
        $this->load->view('report/v_report');
    }

    public function view_report_student()
    {
        $this->load->view('report/v_report_student');
    }

    function get_list_class_by_school(){
        $schcode =  $this->input->post('id_sch');
        $data = $this->Mdl_report->get_list_sch_by_school($schcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_data_list_room_by_class(){
        $clscodesid =  $this->input->post('cls_codes_id');
        $data = $this->Mdl_report->get_list_room_by_class($clscodesid);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_data_report_student(){
        $idschool =  $this->input->post('sch');
        $idclass =  $this->input->post('cls');
        $idroom =  $this->input->post('rm');

        if ($idclass == 'All') {
            $get_school = $this->Mdl_report->get_data_school($idschool);
            $get_class = $this->Mdl_report->get_data_class_all();
            $data_report_student = $this->Mdl_report->get_data_report_student_by_class_all($idschool);
            
            $value = '';
            foreach ($get_school as $sc){
            $value.='<tr>';
            $value.='<td colspan="7"><u><h4 class="bold">'.$sc->SchoolName.'</h4></u></td>';
            $value.='</tr>';
                foreach ($get_class as $cl){
                    if ($cl->SchoolID == $sc->SchoolID) {
                        $value.='<tr>';
                        $value.='<td colspan="7" style="background-color : #f6f6f6" class="sbold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$cl->ClassDesc.'</td>';
                        $value.='</tr>';
                            if ($data_report_student != false){
                                $no=1; foreach ($data_report_student as $rs){
                                     if ($rs->SchoolID ==  $cl->SchoolID AND $rs->ClassDesc == $cl->ClassDesc) {
                                        $value.='<tr>';
                                        $value.='<td align="center">'.$no.'</td>';
                                        $value.='<td>'.$rs->NIS.'</td>';
                                        $value.='<td class="sbold">'.$rs->FirstName.'.'.$rs->MiddleName.'.'.$rs->LastName.'</td>';
                                        $value.='<td>'.$rs->RoomDesc.'</td>';
                                        $value.='<td>'.$rs->Phone.'</td>';
                                        $value.='</tr>'; 
                                    $no++;} 
                                }                                        
                            } else { 
                                $value .='<h2 align="center"  class="font-red bold">No Data News & Assignment!</h2>';
                            }
                        }
                }
            }      
            echo $value; 
        }else if($idroom == 'All'){
            $get_school = $this->Mdl_report->get_data_school($idschool);
            $get_class = $this->Mdl_report->get_data_class($idclass);
            $data_report_student = $this->Mdl_report->get_data_report_student_by_room_all($idschool,$idclass);
            
            $value = '';
            foreach ($get_school as $sc){
            $value.='<tr>';
            $value.='<td colspan="7"><u><h4 class="bold">'.$sc->SchoolName.'</h4></u></td>';
            $value.='</tr>';
                foreach ($get_class as $cl){
                    $value.='<tr>';
                    $value.='<td colspan="7" style="background-color : #f6f6f6" class="sbold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$cl->ClassDesc.'</td>';
                    $value.='</tr>';
                        if ($data_report_student != false){
                            $no=1; foreach ($data_report_student as $rs){
                                $value.='<tr>';
                                $value.='<td align="center">'.$no.'</td>';
                                $value.='<td>'.$rs->NIS.'</td>';
                                $value.='<td class="sbold">'.$rs->FirstName.'.'.$rs->MiddleName.'.'.$rs->LastName.'</td>';
                                $value.='<td>'.$rs->RoomDesc.'</td>';
                                $value.='<td>'.$rs->Phone.'</td>';
                                $value.='</tr>'; 
                            $no++;}                                     
                        } else { 
                            $value .='<h2 align="center"  class="font-red bold">No Data News & Assignment!</h2>';
                        }
                }
            }      
            echo $value;
        }else{
            $get_school = $this->Mdl_report->get_data_school($idschool);
            $get_class = $this->Mdl_report->get_data_class($idclass);
            $data_report_student = $this->Mdl_report->get_data_report_student_by_room($idschool,$idclass,$idroom);
            
            $value = '';
            foreach ($get_school as $sc){
            $value.='<tr>';
            $value.='<td colspan="7"><u><h4 class="bold">'.$sc->SchoolName.'</h4></u></td>';
            $value.='</tr>';
                foreach ($get_class as $cl){
                    $value.='<tr>';
                    $value.='<td colspan="7" style="background-color : #f6f6f6" class="sbold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$cl->ClassDesc.'</td>';
                    $value.='</tr>';
                        if ($data_report_student != false){
                            $no=1; foreach ($data_report_student as $rs){
                                    $value.='<tr>';
                                    $value.='<td align="center">'.$no.'</td>';
                                    $value.='<td>'.$rs->NIS.'</td>';
                                    $value.='<td class="sbold">'.$rs->FirstName.'.'.$rs->MiddleName.'.'.$rs->LastName.'</td>';
                                    $value.='<td>'.$rs->RoomDesc.'</td>';
                                    $value.='<td>'.$rs->Phone.'</td>';
                                    $value.='</tr>'; 
                            $no++;} 
                        } else { 
                            $value .='<h2 align="center"  class="font-red bold">No Data News & Assignment!</h2>';
                        }
                }
            }      
            echo $value;
        }  
    }

    function excel_report_student_nohp() {
        $idschool =  $this->input->post('sch');
        $idclass =  $this->input->post('cls');
        $idroom =  $this->input->post('rm');
        $query['get_school'] = $this->Mdl_report->get_data_school($idschool);
        $query['get_class'] = $this->Mdl_report->get_data_class($idclass);
        $query['data_report_student'] = $this->Mdl_report->get_data_report_student_by_room($idschool,$idclass,$idroom);


        $this->load->view('report/v_excel_report_student_nohp',$query);
    }


}
