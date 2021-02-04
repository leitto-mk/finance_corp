<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Board extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('teacher/Mdl_nonstudent');
        $this->load->model('duty/Mdl_duty');
        $this->load->model('admin/Mdl_grade');

        //If there is no known user and role is wrong
        if ($this->session->userdata('status') == 'student' || !$this->session->userdata('status')) {
            redirect('Auth/index');
        }
    }

    public function index()
    {
        $id = $this->session->userdata('id');

        //Destructuring 'array' return from model_get_taught_subject as seperate var
        [$taught, $schedule] = $this->Mdl_nonstudent->model_get_taught_subject($this->session->userdata('id'));

        $data = [
            'title' => 'Student Information',
            'id' => $id,
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'semester' => $this->session->userdata('semester'),
            'schyear' => $this->session->userdata('period'),
            'photo' => $this->session->userdata('photo'),
            'jobdesc' => $this->session->userdata('jobdesc'),
            'homeroom' => $this->session->userdata('homeroom'),
            'subject' => $this->session->userdata('subject'),
            'degree' => $this->session->userdata('degree'),
            'schedule' => $schedule,

            //FOR MODAL PROFILE
            'profile' => $this->Mdl_nonstudent->get_all_info($id),

            //MODAL AKADEMIK
            'period' => $this->Mdl_nonstudent->get_period($id),
            'rooms' => $this->Mdl_nonstudent->get_active_room($id)->result(),
            'voc_rooms' => $this->Mdl_nonstudent->get_active_voc_only_room(),
            'taught' => $taught
        ];

        $this->load->view('board/index', $data);
    }

    public function get_taught_subject()
    {
        $id = $this->session->userdata('id');
        $semester = $_POST['semester'];
        $period = $_POST['period'];
        $room = $_POST['room'];

        $result = $this->Mdl_nonstudent->model_get_taught_subject($id, $semester, $period, $room);

        $subj = '   <select class="form-control selected_subj" id="form_control_1">';
        if (!empty($result)) {
            foreach ($result as $row) {
                $subj .= '      <option value="' . $row->SubjName . '"> ' . $row->SubjName . ' </option>';
            }
        } else {
            $subj .= '          <option value=""> No Subject Taught </option>';
        }
        $subj .= '  </select>';

        echo $subj;
    }

    public function get_full_acd_details()
    {
        $id = $this->session->userdata('id');
        $semester = $_POST['semester'];
        $period = $_POST['period'];

        $room = $this->session->userdata('homeroom');

        //===================================== SCHEDULE ==============================================\\
        $sch_room = $this->Mdl_nonstudent->get_teaching_room($id, $semester, $period);

        $i = 1;
        $sch = '';
        foreach ($sch_room as $row) {
            $room = $row->RoomDesc;
            $sch .= '<tr>';
            $sch .= '    <td colspan="5" class="sbold uppercase" style="background-color: #FAFAFA; padding-left: 15px"> ' . $row->RoomDesc . ' </td>';
            $sch .= '</tr>';

            $sch_full = $this->Mdl_nonstudent->get_teaching_schedule($id, $semester, $period, $room);

            foreach ($sch_full as $dat) {
                if ($dat->Days == 'Senin') {
                    $color = '#12cad6';
                } elseif ($dat->Days == 'Selasa') {
                    $color = '#21bf73';
                } elseif ($dat->Days == 'Rabu') {
                    $color = '#5f6caf';
                } elseif ($dat->Days == 'Kamis') {
                    $color = '#ff6f5e';
                } elseif ($dat->Days == 'Jumat') {
                    $color = '#ee8972';
                } elseif ($dat->Days == 'Sabtu') {
                    $color = '#e25822';
                }

                $sch .= '<tr>';
                $sch .= '    <td padding: 5px> ' . $i . ' </td>';
                $sch .= '    <td padding: 5px> ' . $dat->SubjName . ' </td>';
                $sch .= '    <td class=" sbold" style="color: ' . $color . '; padding: 5px"> ' . $dat->Days . ' </td>';
                $sch .= '    <td class=" sbold"> ' . $dat->Hour . ' </td>';
                $sch .= '    <td padding: 5px> ' . $dat->Note . ' </td>';
                $sch .= '</tr>';

                $i++;
            }
            $i = 1;
        }

        //===================================== ATTENDANCE ==============================================\\

        $attd_full = $this->Mdl_nonstudent->modal_get_full_attendance($semester, $period, $room);

        $data = [
            //SCHEDULE
            'schedule' => $sch,

            //ABSENT
            'attendance' => $attd_full
        ];

        echo json_encode($data);
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

                        $result = $this->Mdl_nonstudent->sv_pass($id, $newpass);

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

    public function get_student_compact()
    {
        $room = $_POST['room'];

        $result = $this->Mdl_nonstudent->modal_get_student_compact($room);

        echo json_encode($result);
    }

    public function get_kd_details()
    {
        $id = $_POST['id'];
        $room = $_POST['room'];
        $subj = $_POST['subj'];

        $result = $this->Mdl_nonstudent->model_get_kd_details($room, $subj);

        echo json_encode($result);
    }

    public function ajx_datatable_get_student_reports()
    {
        //FROM DATATABLE REQUEST HEADER
        $header = [
            'id' => $this->session->userdata('id'),
            'limit' => $_GET['length'],
            'start' => $_GET['start'],
            'order' => $_GET['order'],
            'search' => $_GET['search']['value'],
            'order_by' => $_GET['order'][0]['column'],
            'order_dir' => $_GET['order'][0]['dir']
        ];

        //DESTRUCTURING
        [$query, $total] = $this->Mdl_nonstudent->model_get_student_reports($header);

        $result = [
            'draw' => $_GET['draw'],
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $query->result()
        ];

        echo json_encode($result);
    }

    public function ajax_get_nonregular_info()
    {
        $type = $_POST['type'];

        [$schedule, $subjects] = $this->Mdl_nonstudent->get_nonregular_info($type);

        $v_sch = '<option value="">Select Day</option>';
        $v_subj = '<option value="">Select Subject</option>';

        foreach($schedule as $sch){
            $v_sch .= '<option value="'.$sch->Days.'" data-hour="'.$sch->Hour.'"> '. $sch->Days .' </option>';
        }

        foreach($subjects as $subj){
            $v_subj .= '<option value="'.$subj->SubjName.'"> '. $subj->SubjName .' </option>';
        }

        $result = [
            'schedule' => $v_sch,
            'subjects' => $v_subj
        ];

        echo json_encode($result);
    }

    public function ajax_get_hour_of_day(){
        $room = $_POST['room'];
        $type = $_POST['type'];
        $day = $_POST['day'];

        $result = $this->Mdl_nonstudent->get_hour_of_day($room, $type, $day);

        $v_hour = '<option value=""> Select Hour </option>';
        foreach($result as $row){
            $v_hour .= '<option value="'.$row->Hour.'"> '.$row->Hour.' </option>';
        }

        echo $v_hour;
    }

    public function ajax_get_nonregular_subjects(){
        $room = $_POST['room'];
        $type = $_POST['type'];
        $day = $_POST['day'];
        $hour = date('H:i',strtotime($_POST['hour']));

        $v_subj = '<option value=""> Select Subject </option>';

        $subjects = $this->Mdl_nonstudent->get_nonregular_subjects($room, $type, $day, $hour);

        foreach($subjects as $subj){
            $v_subj .= '<option value="'.$subj->SubjName.'"> '. $subj->SubjName .' </option>';
        }

        echo $v_subj;
    }

    public function ajax_add_nonregular(){
        $data = [
            'NIS' => $_POST['id'],
            'Class' => $_POST['cls'],
            'Room' => $_POST['room'],
            'Type' => $_POST['assign_type'],
            'Day' => $_POST['assign_day'],
            'SubjName' => $_POST['assign_subject'],
            'Hour' => $_POST['assign_hour']
        ];
        
        $result = $this->Mdl_nonstudent->add_nonregular($data);

        echo $result;
    }

    public function display_report_print()
    {
        $nis = $this->input->get('nis');
        $cls = $this->input->get('cls');
        $subj = $this->input->get('subj');
        $semester = $this->input->get('semester');
        $report_type = 'full';

        $data = [
            'info' => $this->Mdl_grade->get_report_print_info($nis, $cls, $subj, $semester, $report_type),
            'kd' => $this->Mdl_grade->get_std_kd_det($nis, $subj, $semester),
            'exam' => $this->Mdl_grade->get_std_exam_det($nis, $cls, $subj, $semester),
            'rep' => $this->Mdl_grade->get_std_report_det($nis, $cls, $subj, $semester),
            'sick' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'Sick'),
            'permit' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'On Permit'),
            'absent' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'Absent'),
        ];

        $this->load->view('grade_report_print', $data);
    }

    public function display_report_mid_print()
    {
        $nis = $this->input->get('nis');
        $cls = $this->input->get('cls');
        $subj = $this->input->get('subj');
        $semester = $this->input->get('semester');
        $report_type = 'mid';

        [$query, $score, $average] = $this->Mdl_grade->get_report_mid_grade($nis, $cls, $semester);

        $data = [
            'info' => $this->Mdl_grade->get_report_print_info($nis, $cls, $subj, $semester, $report_type),
            'subjects' => $query,
            'score' => $score,
            'average' => $average,
            'sick' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'Sick'),
            'permit' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'On Permit'),
            'absent' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'Absent')
        ];

        $this->load->view('grade_report_mid_print', $data);
    }

    public function ajax_get_class_full_mid_recap(){
        $homeroom = $this->session->userdata('homeroom');
        $semester = $this->session->userdata('semester');
        $period = $this->session->userdata('period');

        [$head, $result] = $this->Mdl_nonstudent->model_get_class_full_mid_recap($homeroom, $semester, $period);
        
        $data = [
            'header' => $head,
            'pivot' => $result
        ];

        echo json_encode($data);
    }

    public function print_recap_mid(){
        $homeroom = $this->session->userdata('homeroom');
        $semester = $this->session->userdata('semester');
        $period = $this->session->userdata('period');

        [$head, $result] = $this->Mdl_nonstudent->model_get_class_full_mid_recap($homeroom, $semester, $period);

        // LOAD PLUGIN
        include APPPATH.'third_party\PHPExcel.php';

        $excel = new PHPExcel();

        $filename = 'MID RECAP ' .$homeroom . ' - ' .date('F-Y').'.xlsx';

        $excel->setActiveSheetIndex(0)->setCellValue('A2', 'No');
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
        // $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->setActiveSheetIndex(0)->setCellValue('B2', 'NIS');
        $excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(TRUE);
        // $excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->setActiveSheetIndex(0)->setCellValue('C2', 'NAMA');
        $excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(TRUE);
        // $excel->getActiveSheet()->getStyle('C2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $alp = 'D';
        $i = 1;
        
        foreach($result as $row){
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($i+2), $i);
            $excel->getActiveSheet()->getStyle('A' . ($i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($i+2), $row->NIS);
            $excel->getActiveSheet()->getStyle('B' . ($i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($i+2), '  ' . $row->FullName);

            foreach($head as $row2){
                $cur_subj = str_replace(' ','_', $row2->SubjName);
                $excel->setActiveSheetIndex(0)->setCellValue($alp . '2', $row2->SubjName);
                $excel->getActiveSheet()->getStyle($alp . '2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $excel->getActiveSheet()->getColumnDimension($alp)->setWidth(strlen($row2->SubjName)+4);    
                
                $excel->setActiveSheetIndex(0)->setCellValue($alp . ($i+2), $row->{$cur_subj});
                $excel->getActiveSheet()->getStyle($alp . ($i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                ++$alp;
            }

            $alp = 'D';
            ++$i;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
    
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    
        $excel->getActiveSheet(0)->setTitle('MID RECAP - ' . $homeroom);
        $excel->setActiveSheetIndex(0);
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function ajax_get_class_attendance_recap(){
        $homeroom = $this->session->userdata('homeroom');
        $semester = $this->session->userdata('semester');
        $period = $this->session->userdata('period');

        [$month_days, $pivot] = $this->Mdl_nonstudent->get_class_attendance_recap($homeroom, $semester, $period);

        $data = [
            'header' => $month_days,
            'pivot' => $pivot
        ];

        echo json_encode($data);
    }

    public function print_attendance_recap(){
        $homeroom = $this->session->userdata('homeroom');
        $semester = $this->session->userdata('semester');
        $period = $this->session->userdata('period');

        [$month_days, $pivot] = $this->Mdl_nonstudent->get_class_attendance_recap($homeroom, $semester, $period);

        // LOAD PLUGIN
        include APPPATH.'third_party\PHPExcel.php';

        $excel = new PHPExcel();

        $filename = 'ATTENDANCE RECAP ' .$homeroom . ' - ' .strtoupper(date('F Y')).'.xlsx';

        $excel->setActiveSheetIndex(0)->setCellValue('A2', 'No');
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
        // $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->setActiveSheetIndex(0)->setCellValue('B2', 'NIS');
        $excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(TRUE);
        // $excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->setActiveSheetIndex(0)->setCellValue('C2', 'NAMA');
        $excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(TRUE);
        // $excel->getActiveSheet()->getStyle('C2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $alph = 'A';
        $alp = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH'];

        $date_alias = [
            'zero','one','two','three','four','five','six','seven','eight','nine','ten',
            'eleven','twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty',
            'twentyone','twentytwo','twentythree','twentyfour','twentyfive','twentysix','twentyseven','twentyeight','twentynine','thirty','thirtyone'
        ];

        $sick = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['argb' => 'F4D03F']
            ]
        ];

        $on_permit = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['argb' => '8E44AD']
            ]
        ];

        $absent = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['argb' => 'e7505a']
            ]
        ];

        $default = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['argb' => 'e1e5ec']
            ]
        ];

        $index = 1;
        
        foreach($pivot as $row){
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+2), $index);
            $excel->getActiveSheet()->getStyle('A' . ($index+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+2), $row->NIS);
            $excel->getActiveSheet()->getStyle('B' . ($index+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+2), '  ' . $row->FullName);

            for($i = 3; $i <= $month_days+2; $i++){
                $excel->setActiveSheetIndex(0)->setCellValue($alp[$i] . '2', $i-2);
                $excel->getActiveSheet()->getStyle($alp[$i] . '2')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle($alp[$i] . '2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                if($row->{$date_alias[$i-2]} == 'Sick'){
                    $attd = 'S';
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->getFont()->setBold(TRUE);
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->applyFromArray($sick);
                }else if($row->{$date_alias[$i-2]} == 'On Permit'){
                    $attd = 'I';
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->getFont()->setBold(TRUE);
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->applyFromArray($on_permit);
                }else if($row->{$date_alias[$i-2]} == 'Absent'){
                    $attd = 'A';
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->getFont()->setBold(TRUE);
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->applyFromArray($absent);
                }else{
                    $attd = '-';
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->applyFromArray($default);
                }
                
                $excel->setActiveSheetIndex(0)->setCellValue($alp[$i] . ($index+2), $attd);
                $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            }

            ++$index;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
    
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    
        $excel->getActiveSheet(0)->setTitle('MID RECAP - ' . $homeroom);
        $excel->setActiveSheetIndex(0);
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    /* 
    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
                                MODAL
    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
    */
    public function get_full_table_grading_cognitive()
    {
        $cls = $_POST['cls'];
        $year = $_POST['period'];
        $semester = $_POST['semester'];
        $subj = $_POST['subj'];
        $type = $_POST['type'];

        $head_details = $this->Mdl_grade->model_get_full_kd_details($cls, $semester, $subj, $type);
        $full_query = $this->Mdl_grade->model_get_person_full_details($cls, $year, $semester, $subj);

        $kd_multi = $head_details->num_rows() * 3;
        $total_kd = $head_details->num_rows();

        $full = '';
        $full .= '<thead>
                        <tr>
                            <td colspan="2" class="text-center"><b>NOMOR</b></td>
                            <td style="border-bottom-color:white"></td>
                            <td rowspan="3"> <b> KD </b> </td>
                            <td colspan="' . $kd_multi . '" class="text-center"><b> PENGETAHUAN </b></td>
                            <td colspan="2" rowspan="2" class="text-center"><b> Hasil Penilaian Tengah Semester</b></td>
                            <td colspan="2" rowspan="2" class="text-center"><b> Hasil Penilaian Akhir Semester</b></td>           
                        </tr>
                        
                        <tr>
                            <td rowspan="4" class="text-center"><b> URT </b></td>
                            <td rowspan="4" class="text-center"><b> INDUK </b></td>
                            <td rowspan="4" class="text-center"><b> NAMA </b></td>';
        for ($i = 1; $i <= $head_details->num_rows(); $i++) {
            $full .= '                             
                            <td colspan="3" class="text-center"><b> HPH&nbsp; ' . $i . ' </b> </td>';
        }
        $full .= '      </tr>
                        <tr>';

        foreach ($head_details->result() as $row) {
            $full .= '     <td colspan="3" class="text-center"><b> ' . $row->Code . ' </b> </td>';
        }

        $full .= '         <td colspan="2" class="text-center"><b> HPTS </b></td>
                            <td colspan="2" class="text-center"><b> HPAS </b></td>
                        </tr>
                                            
                        <tr>
                            <td><b> % </b></td>';
        foreach ($head_details->result() as $row) {
            if ($row->Weight1 != NULL) {
                $full .= '  <td contenteditable="true" class="table_head" data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight1"> ' . $row->Weight1 . '%</td>';
            } else {
                $full .= '  <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight1" contenteditable="true" class="table_head" width="3%"></td>';
            }

            if ($row->Weight2 != NULL) {
                $full .= '  <td contenteditable="true" class="table_head" data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight2"> ' . $row->Weight2 . '%</td>';
            } else {
                $full .= '  <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight2" contenteditable="true" class="table_head" width="3%"></td>';
            }

            if ($row->Weight3 != NULL) {
                $full .= '  <td contenteditable="true" class="table_head" data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight3"> ' . $row->Weight3 . '%</td>';
            } else {
                $full .= '  <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight3" contenteditable="true" class="table_head" width="3%"></td>';
            }
        }
        $full .= '          <td colspan="2"></td>
                            <td colspan="2"></td>                                    
                        </tr>
                        <tr>
                            <td><b> KET </b></td>';
        foreach ($head_details->result() as $row) {
            $full .= '      <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight1_Desc" contenteditable="true" class="table_head"> ' . $row->Weight1_Desc . ' </td>';
            $full .= '      <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight2_Desc" contenteditable="true" class="table_head"> ' . $row->Weight2_Desc . ' </td>';
            $full .= '      <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight3_Desc" contenteditable="true" class="table_head"> ' . $row->Weight3_Desc . ' </td>';
        }
        $full .= '          <td class="text-center"><b> NILAI</b></td>
                            <td class="text-center"><b> REMIDI</b></td>
                            <td class="text-center"><b> NILAI</b></td>
                            <td class="text-center"><b> REMIDI</b></td>
                        </tr>
                    </thead>';
        $full .= '  <tbody> ';
        $j = 1;
        foreach ($full_query->result() as $row) {
            $full .= '      <tr data-class="' . $row->Class . '" data-room="' . $row->Room . '">';
            $full .= '          <td> ' . $j . ' </td>';
            $full .= '          <td>' . $row->NIS . '</td>';
            $full .= '          <td colspan="2">' . $row->FullName . '</td>';
            foreach ($head_details->result() as $row2) {
                //Eliminate posible white space
                $codes = preg_replace('/\s+/', '', $row2->Code);

                $data = [
                    'nis' => $row->NIS,
                    'smstr' => $semester,
                    'subj' => $subj,
                    'room' => $row->Room,
                    'type' => $type,
                    'code' => $codes
                ];

                $kd_grade = $this->Mdl_grade->get_std_kd_grade($data);

                $full .= '      <td class="table_body" contenteditable="true" data-row="kd" data-field="Grade1" data-code="' . $codes . '">' . $kd_grade['Grade1'] . '</td>';
                $full .= '      <td class="table_body" contenteditable="true" data-row="kd" data-field="Grade2" data-code="' . $codes . '">' . $kd_grade['Grade2'] . '</td>';
                $full .= '      <td class="table_body" contenteditable="true" data-row="kd" data-field="Grade3" data-code="' . $codes . '">' . $kd_grade['Grade3'] . '</td>';
            }
            $full .= '          <td class="table_body" contenteditable="true" data-row="exams" data-field="MidTest"> ' . $row->MidTest . ' </td>';
            $full .= '          <td class="table_body" contenteditable="true" data-row="exams" data-field="MidRemedial"> ' . $row->MidRemedial . ' </td>';
            $full .= '          <td class="table_body" contenteditable="true" data-row="exams" data-field="Final"> ' . $row->Final . ' </td>';
            $full .= '          <td class="table_body" contenteditable="true" data-row="exams" data-field="FinalRemedial"> ' . $row->FinalRemedial . ' </td>';
            $full .= '      </tr>';
            $j++;
        }
        $full .= '  </tbody>';

        $recap = '';
        $recap .= ' <thead>
                        <tr>
                            <td colspan="2" class="text-center" width="1%"> <b> NOMOR </b> </td>
                            <td rowspan="5" class="text-center"> <b> NAMA </b> </td>
                            <td rowspan="3"> <b> KD </b> </td>
                            <td colspan="' . $total_kd . '" class="text-center"><b>REKAP&nbsp;HPH </b></td>
                            <td rowspan="5" width="2%"><b> Rata-Rata HPH </b></td>
                            <td colspan="1" rowspan="2" class="text-center" width="3%"><b> Hasil Penilaian Tengah Semester</b></td>
                            <td colspan="1" rowspan="2" class="text-center" width="3%"><b> Hasil Penilaian Akhir Semester</b></td>
                            <td rowspan="3" class="text-center"><b> Absent </b></td>
                        </tr>
                        <tr>
                            <td rowspan="5"> <b> URUT </b> </td>
                            <td rowspan="5"> <b> INDUK </b> </td>';
        for ($i2 = 1; $i2 <= $head_details->num_rows(); $i2++) {
            $recap .= '     <td colspan="1" class="text-center"><b> HPH ' . $i2 . ' </b> </td>';
        }
        $recap .= '     </tr>
                        <tr>';
        foreach ($head_details->result() as $row) {
            $recap .= '     <td colspan="1" class="text-center"><b> ' . $row->Code . ' </b></td>';
        }

        $recap_query = $this->Mdl_grade->get_recap_weight($cls, $subj);

        $recap .= '         <td colspan="1" class="text-center"><b> HPTS </b></td>
                            <td colspan="1" class="text-center"><b> HPAS </b></td> 
                        </tr>
                        <tr>
                            <td><b> % </b></td>
                            <td colspan="' . $total_kd . '" class="text-center" data-class="' . $recap_query->Class . '" data-subj="' . $recap_query->SubjName . '" data-field="KDWeight" contenteditable="true"> ' . $recap_query->KDWeight . '% </td>
                            <td colspan="1" class="text-center" data-class="' . $recap_query->Class . '" data-subj="' . $recap_query->SubjName . '" data-field="MidWeight" contenteditable="true"> ' . $recap_query->MidWeight . '% </td>
                            <td colspan="1" class="text-center" data-class="' . $recap_query->Class . '" data-subj="' . $recap_query->SubjName . '" data-field="FinalWeight" contenteditable="true"> ' . $recap_query->FinalWeight . '% </td>
                            <td colspan="1" class="text-center" data-class="' . $recap_query->Class . '" data-subj="' . $recap_query->SubjName . '" data-field="Absent" contenteditable="true"> ' . $recap_query->Absent . '% </td>
                        </tr>
                        <tr>
                            <td><b> KET </b></td>';
        foreach ($head_details->result() as $row) {
            $w1desc = ($row->Weight1_Desc != '' ? "$row->Weight1_Desc, " : '- ,');
            $w2desc = ($row->Weight2_Desc != '' ? "$row->Weight2_Desc, " : ' - ,');
            $w3desc = ($row->Weight3_Desc != '' ? "$row->Weight3_Desc" : ' -');

            $recap .= "     <td class=\"text-center\" colspan=\"1\">{$w1desc}{$w2desc}{$w3desc}</td>";
        }
        $recap .= '         <td colspan="1"><b> NILAI </b></td>
                            <td colspan="1"><b> NILAI </b></td>
                            <td colspan="1"><b> NILAI </b></td>
                        </tr>
                    </thead>';
        $recap .= '  <tbody> ';

        $k = 1;
        foreach ($full_query->result() as $row) {
            $recap .= '      <tr data-class="' . $row->Class . '" data-room="' . $row->Room . '">';
            $recap .= '          <td> ' . $k . ' </td>';
            $recap .= '          <td>' . $row->NIS . '</td>';
            $recap .= '          <td colspan="2" width="15%">' . $row->FullName . '</td>';
            foreach ($head_details->result() as $row2) {
                //Eliminate posible white space
                $codes = preg_replace('/\s+/', '', $row2->Code);

                $data = [
                    'nis' => $row->NIS,
                    'smstr' => $semester,
                    'subj' => $subj,
                    'room' => $row->Room,
                    'type' => $type,
                    'code' => $codes
                ];

                $kd_grade = $this->Mdl_grade->get_std_kd_grade($data);

                $recap .= '      <td data-row="kd" data-field="KDAvg" data-code="' . $codes . '">' . $kd_grade['KDAvg'] . '</td>';
            }
            $recap .= '          <td class="text-center sbold"> ' . $row->KDRecapAvg . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->MidRecap . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->FinalRecap . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->Absent . ' </td>';
            $recap .= '      </tr>';

            $k++;
        }
        $recap .= '  </tbody>';

        $summary = '';
        $summary .= '<thead>
                        <tr>
                            <td colspan="2" class="text-center"><b>SISWA</b></td>
                            <td colspan="3" class="text-center"><b>NILAI&nbsp;AKHIR&nbsp;PENGETAHUAN</b></td>
                        </tr>
                        <tr>
                            <td class="text-center"><b>URUT</b></td>
                            <td class="text-center"><b>NAMA</b></td>
                            <td class="text-center"><b> NILAI AKHIR</b></td>
                            <td class="text-center"><b> PREDIKAT </b></td>
                            <td width="35%" class="text-center"><b> DESKRIPSI</b></td>
                        </tr>
                    </thead>';
        $summary .= ' <tbody>';
        $l = 1;
        foreach ($full_query->result() as $smry) {

            if ($smry->Predicate == 'A') {
                $color = '#5edfff';
            } elseif ($smry->Predicate == 'B') {
                $color = '#71a95a';
            } elseif ($smry->Predicate == 'C') {
                $color = '#fbe555';
            } elseif ($smry->Predicate == 'D') {
                $color = '#fb5b5a';
            } else {
                $color = 'black';
            }

            $summary .= '   <tr>';
            $summary .= '       <td> ' . $l . ' </td>';
            $summary .= '       <td> ' . $smry->FullName . ' </td>';
            $summary .= '       <td class="text-center sbold" style="color: ' . $color . '"> ' . $smry->Report . ' </td>';
            $summary .= '       <td class="text-center sbold" style="color: ' . $color . '"> ' . $smry->Predicate . ' </td>';
            $summary .= '       <td> ' . $smry->Description . ' </td>';
            $summary .= '   </tr>';

            $l++;
        }
        $summary .= ' </tbody>';

        $response = [
            'full' => $full,
            'recap' => $recap,
            'summary' => $summary
        ];

        echo json_encode($response);
    }

    public function get_full_table_grading_skills()
    {
        $cls = $_POST['cls'];
        $year = $_POST['period'];
        $semester = $_POST['semester'];
        $subj = $_POST['subj'];
        $type = $_POST['type'];

        $head_details = $this->Mdl_grade->model_get_full_kd_details($cls, $semester, $subj, $type);
        $full_query = $this->Mdl_grade->model_get_person_full_details($cls, $year, $semester, $subj);

        $total_kd = $head_details->num_rows();

        $recap = '';
        $recap .= ' <thead>
                        <tr>
                            <td colspan="2" class="text-center" width="1%"> <b> NOMOR </b> </td>
                            <td rowspan="5" class="text-center"> <b> NAMA </b> </td>
                            <td rowspan="3"> <b> KD </b> </td>
                            <td colspan="' . $total_kd . '" class="text-center"><b>REKAP&nbsp;HPH </b></td>
                            <td rowspan="5" width="2%"><b> Rata-Rata HPH </b></td>
                            <td colspan="1" rowspan="2" class="text-center" width="3%"><b> Hasil Penilaian Tengah Semester</b></td>
                            <td colspan="1" rowspan="2" class="text-center" width="3%"><b> Hasil Penilaian Akhir Semester</b></td>
                            <td rowspan="4" class="text-center"><b> Absent </b></td>
                        </tr>
                        <tr>
                            <td rowspan="5"> <b> URUT </b> </td>
                            <td rowspan="5"> <b> INDUK </b> </td>';
        $i = 1;
        for ($i; $i <= $head_details->num_rows(); $i++) {
            $recap .= '     <td colspan="1" class="text-center"><b> HPH ' . $i . ' </b> </td>';
        }
        $recap .= '     </tr>
                        <tr>';
        foreach ($head_details->result() as $row) {
            $recap .= '     <td colspan="1" class="text-center"><b> ' . $row->Code . ' </b></td>';
        }

        $recap_query = $this->Mdl_grade->get_recap_weight($cls, $subj);

        $recap .= '         <td colspan="1" rowspan="2" class="text-center"><b> (HPTS) </b></td>
                            <td colspan="1" rowspan="2" class="text-center"><b> (HPAS) </b></td> 
                        </tr>
                        <tr>
                            <td><b> % </b></td>
                            <td colspan="' . $total_kd . '" class="text-center" data-class="' . $recap_query->Class . '" data-subj="' . $recap_query->SubjName . '" data-field="KDWeight_SK" contenteditable="true"> ' . $recap_query->KDWeight_SK . '% </td>
                        </tr>
                        <tr>
                            <td><b> KET </b></td>';
        foreach ($head_details->result() as $row) {
            $recap .= "     <td class=\"text-center kd_desc_sk\" colspan=\"1\" contenteditable=\"true\" data-type=\"skills\" data-subj=\"$row->SubjName\" data-code=\"$row->Code\" data-field=\"Weight1_Desc\"> $row->Weight1_Desc </td>";
        }
        $recap .= '         <td colspan="1"><b> NILAI </b></td>
                            <td colspan="1"><b> NILAI </b></td>
                            <td colspan="1"><b> NILAI </b></td>
                        </tr>
                    </thead>';
        $recap .= '  <tbody> ';

        $j = 1;
        foreach ($full_query->result() as $row) {
            $recap .= '      <tr data-class="' . $row->Class . '" data-room="' . $row->Room . '">';
            $recap .= '          <td> ' . $j . ' </td>';
            $recap .= '          <td>' . $row->NIS . '</td>';
            $recap .= '          <td colspan="2" width="15%">' . $row->FullName . '</td>';
            foreach ($head_details->result() as $row2) {
                //Eliminate posible white space
                $codes = preg_replace('/\s+/', '', $row2->Code);

                $data = [
                    'nis' => $row->NIS,
                    'smstr' => $semester,
                    'subj' => $subj,
                    'room' => $row->Room,
                    'type' => $type,
                    'code' => $codes
                ];

                $kd_grade = $this->Mdl_grade->get_std_kd_grade($data);

                $recap .= '      <td class="table_body" data-row="kd" data-field="Grade1" data-code="' . $codes . '" contenteditable="true">' . $kd_grade['KDAvg'] . '</td>';
            }
            $recap .= '          <td class="text-center sbold"> ' . $row->KDRecapAvg_SK . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->MidRecap . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->FinalRecap . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->Absent . ' </td>';
            $recap .= '      </tr>';
            $j++;
        }
        $recap .= '  </tbody>';

        $summary = '';
        $summary .= '<thead>
                        <tr>
                            <td colspan="2" class="text-center"><b>SISWA</b></td>
                            <td colspan="3" class="text-center"><b>NILAI&nbsp;AKHIR&nbsp;PENGETAHUAN</b></td>
                        </tr>
                        <tr>
                            <td class="text-center"><b>URUT</b></td>
                            <td class="text-center"><b>NAMA</b></td>
                            <td class="text-center"><b> NILAI AKHIR</b></td>
                            <td class="text-center"><b> PREDIKAT </b></td>
                            <td width="35%" class="text-center"><b> DESKRIPSI</b></td>
                        </tr>
                    </thead>';
        $summary .= ' <tbody>';

        $k = 1;
        foreach ($full_query->result() as $smry) {

            $col = '';
            if ($smry->Predicate_SK == 'A') {
                $col = '#5edfff';
            } elseif ($smry->Predicate_SK == 'B') {
                $col = '#71a95a';
            } elseif ($smry->Predicate_SK == 'C') {
                $col = '#fbe555';
            } elseif ($smry->Predicate_SK == 'D') {
                $col = '#fb5b5a';
            } else {
                $col = 'black';
            }

            $summary .= '   <tr>';
            $summary .= '       <td> ' . $k . ' </td>';
            $summary .= '       <td> ' . $smry->FullName . ' </td>';
            $summary .= '       <td class="text-center sbold" style="color: ' . $col . '"> ' . $smry->Report_SK . ' </td>';
            $summary .= '       <td class="text-center sbold" style="color: ' . $col . '"> ' . $smry->Predicate_SK . ' </td>';
            $summary .= '       <td> ' . $smry->Description_SK . ' </td>';
            $summary .= '   </tr>';

            $k++;
        }
        $summary .= ' </tbody>';

        $response = [
            'recap' => $recap,
            'summary' => $summary
        ];

        echo json_encode($response);
    }

    public function get_full_table_grading_voc(){
        $semester = $_POST['semester'];
        $period = $_POST['period'];
        $room = $_POST['room'];
        $subj = $_POST['subj'];

        $result = $this->Mdl_nonstudent->get_full_table_voc($semester, $period, $room, $subj);

        $html = '';
        $i = 1;
        foreach($result as $row){
            $html .= '<tr>';
            $html .= '   <td width="1%">'.$i.'</td>';
            $html .= '   <td class="text-center sbold" width="1%">'.$row->NIS.'</td>';
            $html .= '   <td class="sbold" width="15%">'.$row->FullName.'</td>';
            $html .= '   <td class="text-center voc_grade_row" contenteditable="true" width="5%">'.$row->Report.'</td>';
            $html .= '   <td class="text-center sbold "width="5%">'.$row->Predicate.'</td>';
            $html .= '   <td width="25%">'.$row->Description.'</td>';
            $html .= '</td>';
        }

        echo $html;
    }

    public function get_full_table_grading_character()
    {
        $room = $_POST['cls'];
        $year = $_POST['period'];
        $semester = $_POST['semester'];
        $subj = $_POST['subj'];

        $soc_desc = $this->Mdl_grade->get_social_desc();
        $spirit_desc = $this->Mdl_grade->get_spirit_desc();

        $full_query = $this->Mdl_grade->model_get_person_full_details($room, $year, $semester, $subj);

        $i = 1;
        $social = '';
        foreach ($full_query->result() as $row) {
            if ($row->Predicate_SOC == 'A') {
                $color = '#5edfff';
            } elseif ($row->Predicate_SOC == 'B') {
                $color = '#71a95a';
            } elseif ($row->Predicate_SOC == 'C') {
                $color = '#fbe555';
            } elseif ($row->Predicate_SOC == 'D') {
                $color = '#fb5b5a';
            } else {
                $color = 'black';
            }

            $social .= '<tr data-room="' . $row->Room . '">';
            $social .= '    <td> ' . $i . ' </td>';
            $social .= '    <td> ' . $row->NIS . ' </td>';
            $social .= '    <td>' . $row->FullName . '</td>';
            foreach ($soc_desc as $soc) {
                $data = [
                    'nis' => $row->NIS,
                    'subj' => $subj,
                    'semester' => $semester,
                    'room' => $room,
                    'type' => $soc->Type,
                    'desc' => $soc->Description
                ];

                $char_grade = $this->Mdl_grade->model_get_character_grade($data);

                $social .= '<td class="text-center data_soc_char" data-type="' . $soc->Type . '" data-desc="' . $soc->Description . '" contenteditable="true"> ' . $char_grade['Point'] . ' </td>';
            }
            $social .= '    <td class="text-center sbold"> ' . $row->Report_SOC . ' </td>';
            $social .= '    <td class="text-center sbold" style="color: ' . $color . '"> ' . $row->Predicate_SOC . ' </td>';
            $social .= '    <td> ' . $row->Description_SOC . ' </td>';
            $social .= '</tr>';

            $i++;
        }

        $k = 1;
        $spirit = '';
        foreach ($full_query->result() as $row) {
            if ($row->Predicate_SPR == 'A') {
                $color = '#5edfff';
            } elseif ($row->Predicate_SPR == 'B') {
                $color = '#71a95a';
            } elseif ($row->Predicate_SPR == 'C') {
                $color = '#fbe555';
            } elseif ($row->Predicate_SPR == 'D') {
                $color = '#fb5b5a';
            } else {
                $color = 'black';
            }

            $spirit .= '<tr data-room="' . $row->Room . '">';
            $spirit .= '    <td> ' . $k . ' </td>';
            $spirit .= '    <td> ' . $row->NIS . ' </td>';
            $spirit .= '    <td>' . $row->FullName . '</td>';
            foreach ($spirit_desc as $spr) {
                $data = [
                    'nis' => $row->NIS,
                    'subj' => $subj,
                    'semester' => $semester,
                    'room' => $room,
                    'type' => $spr->Type,
                    'desc' => $spr->Description
                ];

                $char_grade = $this->Mdl_grade->model_get_character_grade($data);

                $spirit .= '<td class="text-center data_spr_char" data-type="' . $spr->Type . '" data-desc="' . $spr->Description . '" contenteditable="true"> ' . $char_grade['Point'] . ' </td>';
            }
            $spirit .= '    <td class="text-center sbold"> ' . $row->Report_SPR . ' </td>';
            $spirit .= '    <td class="text-center sbold" style="color: ' . $color . '"> ' . $row->Predicate_SPR . ' </td>';
            $spirit .= '    <td> ' . $row->Description_SPR . ' </td>';
            $spirit .= '</tr>';

            $k++;
        }

        $response = [
            'SOC' => $social,
            'SPR' => $spirit
        ];

        echo json_encode($response);
    }

    public function update_kd_weight()
    {
        $room = $_POST['room'];
        $semester = $_POST['semester'];
        $type = $_POST['type'];
        $subj = $_POST['subj'];
        $code = $_POST['code'];
        $field = $_POST['field'];
        $value = $_POST['value'];

        $result = $this->Mdl_grade->model_update_kd_weight($room, $semester, $type, $subj, $code, $field, $value);

        echo $result;
    }

    public function update_recap_weight()
    {
        $semester = $_POST['semester'];
        $room = $_POST['room'];
        $subj = $_POST['subj'];
        $field = $_POST['field'];
        $value = $_POST['value'];

        $result = $this->Mdl_grade->model_update_recap_weight($semester, $room, $subj, $field, $value);

        echo $result;
    }

    public function sv_std_kd_grades()
    {
        $data = [
            'nis' => $_POST['nis'],
            'fullname' => $_POST['fullname'],
            'semester' => $_POST['semester'],
            'cls' => $_POST['cls'],
            'room' => $_POST['room'],
            'subj' => $_POST['subj'],
            'type' => $_POST['type'],
            'code' => $_POST['code'],
            'field' => $_POST['field'],
            'value' => $_POST['val']
        ];

        $result = $this->Mdl_grade->model_sv_kd_grades($data);

        echo $result;
    }

    public function sv_std_exam_grades()
    {
        $data = [
            'nis' => $_POST['nis'],
            'cls' => $_POST['cls'],
            'semester' => $_POST['semester'],
            'room' => $_POST['room'],
            'subj' => $_POST['subj'],
            'type' => $_POST['type'],
            'field' => $_POST['field'],
            'value' => $_POST['val']
        ];

        $result = $this->Mdl_grade->model_sv_exam_grades($data);

        echo $result;
    }

    public function sv_std_voc_grades(){
        $nis = $_POST['nis'];
        $semester = $_POST['semester'];
        $year = $_POST['period'];
        $room = $_POST['room'];
        $subj = $_POST['subj'];
        $value = $_POST['val'];

        $current_period = $this->session->userdata('period');
        $current_semester = $this->session->userdata('semester');

        if($year == $current_period && $semester == $current_semester){
            $result = $this->Mdl_grade->model_sv_std_voc_grades($nis, $year, $semester, $subj, $room, $value);
        }else{
            $result = 'INVALID_PERIOD';
        }

        echo $result;
    }

    public function sv_std_char_grades()
    {
        $nis = $_POST['nis'];
        $name = $_POST['name'];
        $semester = $_POST['semester'];
        $subj = $_POST['subj'];
        $room = $_POST['room'];
        $type = $_POST['type'];
        $desc = $_POST['desc'];
        $value = $_POST['value'];

        $result = $this->Mdl_grade->model_sv_std_char_grades($nis, $name, $semester, $subj, $room, $type, $desc, $value);

        echo $result;
    }

    public function ajax_change_room(){
        $room = $_POST['room'];
        $semester = $this->session->userdata('semester');
        $period = $this->session->userdata('period');

        $result = $this->Mdl_nonstudent->modal_get_full_attendance($semester, $period, $room);

        echo json_encode($result);
    }

    public function add_absent_std()
    {
        $checked = $_POST['checked'];

        //CONVERT CHECKED LIST INTO STRING
        $list = (count($checked) > 1 ? implode(',', $checked) : $checked[0]);

        $data = [
            'NIS' => $list,
            'Semester' => $_POST['semester'],
            'Period' => $_POST['period'],
            'Room' => $_POST['room'],
            'Reason' => $_POST['reason'],
            'Subj' => (($_POST['subj'] !== '') ? $_POST['subj'] : NULL),
            'Time' => (($_POST['time'] !== '') ? $_POST['time'] : NULL),
            'Date' => $_POST['date']
        ];

        $result = $this->Mdl_nonstudent->model_add_absent_std($data);

        echo json_encode($result);
    }

    public function delete_absn()
    {

        $data = [
            'NIS' => $_POST['id'],
            'Absent' => date('Y-m-d', strtotime($_POST['date'])),
            'Ket' => $_POST['reason'],
            'SubjDesc' => (is_null($_POST['subj']) ? NULL : $_POST['subj']),
            'Hour' => (is_null($_POST['hour']) ? NULL : $_POST['hour']),
            'Semester' => $_POST['semester'],
            'schoolyear' => $_POST['period'],
            'Ruang' => $_POST['room']
        ];

        $result = $this->Mdl_nonstudent->model_delete_absn($data);

        echo $result;
    }

    public function get_absn_det()
    {
        $id = $_POST['id'];
        $semester = $_POST['semester'];
        $period = $_POST['period'];
        $room = $_POST['room'];

        $result = $this->Mdl_nonstudent->model_get_absn_det($id, $semester, $period, $room);

        echo json_encode($result);
    }

    public function ajax_promote_student(){
        $id = $_POST['id'];
        $cls = $_POST['cls'];
        $room = $_POST['room'];

        echo $this->Mdl_nonstudent->promote_student($id, $cls, $room);
    }

    public function ajax_get_school_event(){
        $start = date('Y-01-01');
        $end = date('Y-12-31');

        $result = $this->db->query(
            "SELECT Title, DateStart, DateEnd, Color FROM tbl_13_calendar
             WHERE DateStart >= '$start'
             AND DateEnd <= '$end'"
        )->result();

        echo json_encode($result);
    }

     //Start - Teacher Portal New Build
    public function home()
    {
        $id = $this->session->userdata('id');
        $status = $this->session->userdata('status');
        //Destructuring 'array' return from model_get_taught_subject as seperate var
        [$taught, $schedule] = $this->Mdl_nonstudent->model_get_taught_subject($this->session->userdata('id'));

        $data = [
            'title' => 'Board Information',
            'id' => $this->session->userdata('id'),
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'semester' => $this->session->userdata('semester'),
            'schyear' => $this->session->userdata('period'),
            'photo' => $this->session->userdata('photo'),
            'jobdesc' => $this->session->userdata('jobdesc'),
            'homeroom' => $this->session->userdata('homeroom'),
            'subject' => $this->session->userdata('subject'),
            'degree' => $this->session->userdata('degree'),
            'schedule' => $schedule,

            //FOR MODAL PROFILE
            'profile' => $this->Mdl_nonstudent->get_all_info($this->session->userdata('id')),

            //MODAL AKADEMIK
            'period' => $this->Mdl_nonstudent->get_period($this->session->userdata('id')),
            'rooms' => $this->Mdl_nonstudent->get_active_room()->result(),
            'voc_rooms' => $this->Mdl_nonstudent->get_active_voc_only_room(),
            'taught' => $taught,

            //Duty
            //'data_duty' => $this->Mdl_duty->get_list_data_duty('',$status,'','',$id)

        ];
       
        $this->load->view('board/home', $data);
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
    //End - Teacher Portal New Build
}
