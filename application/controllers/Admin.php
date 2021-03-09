<?php 
defined('BASEPATH') or exit('No direct script access allowed');

include APPPATH.'third_party\phpspreadsheet\vendor\autoload.php';
include APPPATH.'third_party\phpmailer\vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Admin extends CI_Controller
{

    // =============================== CONSTRUCTOR =============================== //
    public function __construct()
    {
        //SET CONSTRUCTOR FOR THIS FUNCTION
        parent::__construct();

        //LIBRARIES
        $this->load->library('form_validation');
        $this->load->library('pagination');

        //MODEL
        $this->load->model('admin/Mdl_index');
        $this->load->model('admin/Mdl_profile');
        $this->load->model('admin/Mdl_schedule');
        $this->load->model('admin/Mdl_finance');
        $this->load->model('admin/Mdl_grade');
        $this->load->model('admin/Mdl_absent');
        $this->load->model('admin/Mdl_enroll');
        $this->load->model('duty/Mdl_duty');
        //If there is no known user and role is wrong
        //redirect back to login page
        if ($this->session->userdata('status') != 'admin') {
            redirect('Auth/index');
        }
    }

    public function new_id(){
        $id = $_GET['id'];
        $newid = $id - 2000;

        $data = $this->db->query("SELECT IDNumber FROM tbl_07_personal_bio WHERE IDNumber LIKE CONCAT('$id','%')")->result_array();

        $this->db->trans_begin();

        for($i = 0; $i <= count($data); $i++){
            $row = $data[$i]['IDNumber'];
            $val = $i + 1;

            $this->db->query("
                UPDATE tbl_07_personal_bio AS t1
                LEFT JOIN tbl_08_job_info_std AS t2 ON t1.IDNumber = t2.NIS AND t1.IDNumber = '$row'
                LEFT JOIN tbl_09_det_character AS t3 ON t1.IDNumber = t3.NIS AND t1.IDNumber = '$row'
                LEFT JOIN tbl_09_det_grades AS t4 ON t1.IDNumber = t4.NIS AND t1.IDNumber = '$row'
                LEFT JOIN tbl_09_det_kd AS t5 ON t1.IDNumber = t5.NIS AND t1.IDNumber = '$row'
                LEFT JOIN tbl_09_det_voc_grades AS t6 ON t1.IDNumber = t6.NIS AND t1.IDNumber = '$row'
                LEFT JOIN tbl_10_absent_std AS t7 ON t1.IDNumber = t7.NIS AND t1.IDNumber = '$row'
                LEFT JOIN tbl_credentials AS t8 ON t1.IDNumber = t8.IDNumber AND t1.IDNumber = '$row'
                SET 
                    t1.IDNumber = CONCAT('$newid', LPAD($val, 3, 0)),
                    t2.NIS = CONCAT('$newid', LPAD($val, 3, 0)),
                    t3.NIS = CONCAT('$newid', LPAD($val, 3, 0)),
                    t4.NIS = CONCAT('$newid', LPAD($val, 3, 0)),
                    t5.NIS = CONCAT('$newid', LPAD($val, 3, 0)),
                    t6.NIS = CONCAT('$newid', LPAD($val, 3, 0)),
                    t7.NIS = CONCAT('$newid', LPAD($val, 3, 0)),
                    t8.IDNumber = CONCAT('$newid', LPAD($val, 3, 0))
                WHERE t1.status = 'student'
                AND t1.IDNumber = '$row'
            ");
        }

        $this->db->trans_complete();
        
        echo $this->db->trans_status() ? 'success' : $this->db->error();
    }

    // ==================================================================================================================== \\
    // ==============================                    PUBLIC CONTROLLER                   ============================== \\
    // ==================================================================================================================== \\
    public function change_password()
    {
        $id = $this->uri->segment(3);
        $result = $this->Mdl_profile->get_credentials($id);

        $db = $result['password'];
        $new = $this->input->post('newpass');
        $confirm = $this->input->post('renew');

        if ($new == '' || $confirm == '') {
            $this->session->set_flashdata('pass', '<div class="alert alert-danger" role="alert"> Please fill all the form </div>');

            if ($result['status'] == 'admin') {
                redirect('Admin/load_prof_adm' . '#tab_4');
            } elseif ($result['status'] == 'teacher' || $result['status'] == 'staff') {
                redirect('Admin/load_prof_tch_update/' . $id . '#tab_1_3');
            } elseif ($result['status'] == 'student') {
                redirect('Admin/load_prof_std_update/' . $id . '#tab_1_3');
            }
        } else {
            if ($new !== $confirm) {
                $this->session->set_flashdata('pass', '<div class="alert alert-danger" role="alert"> New Password and Confirm Password does not match </div>');

                if ($result['status'] == 'admin') {
                    redirect('admin/load_prof_adm' . '#tab_4');
                } elseif ($result['status'] == 'teacher' || $result['status'] == 'staff') {
                    redirect('admin/load_prof_tch_update/' . $id . '#tab_1_3');
                } elseif ($result['status'] == 'student') {
                    redirect('admin/load_prof_std_update/' . $id . '#tab_1_3');
                }
            } else {
                $pass = md5($new);

                $this->Mdl_profile->update_pass($id, $pass);

                $this->session->set_flashdata('pass', '<div class="alert alert-success" role="alert"> Your password has been updated </div>');

                if ($result['status'] == 'admin') {
                    redirect('admin/load_prof_adm' . '#tab_3');
                } elseif ($result['status'] == 'teacher' || $result['status'] == 'staff') {
                    redirect('admin/load_prof_tch_update/' . $id . '#tab_1_3');
                } elseif ($result['status'] == 'student') {
                    redirect('admin/load_prof_std_update/' . $id . '#tab_1_3');
                }
            }
        }
    }

    //AJAX CALLBACK FOR SEARCH PROFILE (STUDENT / NON-STUDENT)
    public function get_person_name()
    {
        $output = $_POST['output'];
        $emp = $_POST['emp'];

        $result = $this->Mdl_profile->model_get_person_name($output, $emp);

        $value = '';
        $i = 1;
        foreach ($result as $row) {
            if ($emp == 'student') {
                $value .= ' <tr>
                                <td class="hiddex-xs"> ' . $i . '</td>
                                <td class="hiddex-xs">
                                    <a href=" ' . base_url('Admin/load_prof_std/') . $row->IDNumber . '">
                                        ' . $row->IDNumber . '
                                    </a>
                                </td>
                                <td class="hiddex-xs">' . $row->FirstName . $row->LastName . '</td>
                                <td class="hiddex-xs">' . $row->NickName . '</td>
                                <td class="hiddex-xs">' . $row->Gender . '</td>
                                <td class="hiddex-xs">' . $row->DateofBirth . '</td>
                                <td class="hiddex-xs">' . ucfirst($row->status) . '</td>
                                <td class="hiddex-xs">' . $row->Kelas . '</td>
                                <td class="hiddex-xs">' . $row->Ruangan . '</td>
                                <td>
                                    <a class="btn btn-xs font-white bg-blue text-center" data-toggle="modal" href=" ' . base_url('Admin/load_prof_std/') . $row->IDNumber . '">
                                        Profile
                                    </a>
                                    <a class="btn btn-xs font-white bg-green text-center" data-toggle="modal" href=" ' . base_url('Admin/load_prof_std_update/') . $row->IDNumber . '">
                                        Edit
                                    </a>
                                    <a class="btn btn-xs font-white bg-red text-center" data-toggle="modal" href="' . base_url('Admin/delete/') . $row->IDNumber . ';">
                                        Del
                                    </a>
                                </td>
                            </tr>';
                            //<td class="hiddex-xs">' . $row->SubjectTeach . '</td>
            } else {
                $value .= ' <tr data-id=" ' . $row->IDNumber . '">
                                <td class="hiddex-xs">' . $i . '</td>
                                <td class="hiddex-xs">
                                    <a href=" ' . base_url('Admin/load_prof_tch/') . $row->IDNumber  . '">
                                        ' . $row->IDNumber . '
                                    </a>
                                </td>

                                <td class="hiddex-xs">' . $row->FirstName . ' ' . $row->LastName . '</td>
                                <td class="hiddex-xs">' . $row->Gender . '</td>
                                <td class="hiddex-xs">' . $row->DateofBirth . '</td>
                                <td class="hiddex-xs">' . ucfirst($row->status) . '</td>
                                <td class="hiddex-xs">' . $row->JobDesc . '</td>
                                <td class="hiddex-xs">' . $row->Honorer . '</td>
                                <td class="hiddex-xs">' . $row->Emp_Type . '</td>
                                <td class="hiddex-xs">' . $row->Homeroom . '</td>

                                <td>
                                    <a class="btn btn-xs font-white bg-blue text-center" data-toggle="modal" href=" ' . base_url('Admin/load_prof_tch/') . $row->IDNumber . '">
                                        Profile
                                    </a>
                                    <a class="btn btn-xs font-white bg-green text-center" data-toggle="modal" href=" ' . base_url('Admin/load_prof_tch_update/') . $row->IDNumber . '">
                                        Edit
                                    </a>
                                    <a class="btn btn-xs font-white bg-red text-center" data-toggle="modal" href=" ' . base_url('Admin/delete/') . $row->IDNumber . '">
                                        Del
                                    </a>
                                </td>
                            </tr>';
            }

            $i++;
        }

        echo $value;
    }

    //AJAX CALLBACK FOR SEARCH PROFILE BY SELECTED
    public function get_active_room_students()
    {
        $room = $_POST['room'];

        $result = $this->Mdl_profile->model_get_active_room_students($room);

        $value = '';
        $i = 1;
        if ($result) {
            foreach ($result as $row) {

                $value .= ' <tr>
                                <td> ' . $i . '</td>
                                <td>
                                    <a href=" ' . base_url('Admin/load_prof_std/') . $row->IDNumber . '">
                                        ' . $row->IDNumber . '
                                    </a>
                                </td>
                                <td>' . $row->FirstName . $row->LastName . '</td>
                                <td>' . $row->NickName . '</td>
                                <td>' . $row->Gender . '</td>
                                <td>' . $row->DateofBirth . '</td>
                                <td>' . ucfirst($row->status) . '</td>
                                <td>' . $row->Kelas . '</td>
                                <td>' . $row->Ruangan . '</td>
                                <td>
                                    <a class="btn font-white bg-blue text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href=" ' . base_url('Admin/load_prof_std/') . $row->IDNumber . '">
                                        &nbsp;&nbsp;Profile&nbsp;&nbsp;
                                    </a>
                                    <a class="btn btn-primary text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href=" ' . base_url('Admin/load_prof_std_update/') . $row->IDNumber . '">
                                        &nbsp;&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;
                                    </a>
                                    <a class="btn btn-danger text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href="' . base_url('Admin/delete/') . $row->IDNumber . ';">
                                        &nbsp;Delete&nbsp;
                                    </a>
                                </td>
                            </tr>';

                $i++;
            }
        } else {
            $value .= ' <tr> 
                                <td colspan="8" class="text-center"> NO STUDENT LISTED IN THIS CLASS </td> 
                            </tr>';
        }

        echo $value;
    }

    public function getChart()
    {
        [$pie, $bar] = $this->Mdl_index->model_get_chart();

        $data = [
            'pie' => $pie,
            'bar' => $bar
        ];

        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->uri->segment(3);

        //Check status ID, for successfull redirection
        $result = $this->db->query("SELECT * FROM tbl_07_personal_bio WHERE IDNumber = '$id'")->row();

        if ($result->status == 'teacher') {
            $path = './assets/photos/teachers/';
        } elseif ($result->status == 'student') {
            $path = './assets/photos/student/';
        } elseif ($result->status == 'staff') {
            $path = './assets/photos/staff/';
        } else {
            $path = './assets/photos/adm/';
        }
        
        $diploma_name = $result->DiplomaFile;
        $birthcert_name = $result->BirthcertFile;
        $kk_name = $result->KKFile;
        $img_name = $result->Photo;
        $spp_name = $result->SPP;

        $this->Mdl_profile->model_delete($id);
        
        //DELETE FILES/PICTURES
        if($result->DiplomaFile){
            unlink($path . $diploma_name);
        }elseif($result->BirthcertFile){
            unlink($path . $birthcert_name);
        }elseif($result->KKFile){
            unlink($path . $kk_name);
        }elseif($result->Photo){
            unlink($path . $img_name);
        }elseif($result->SPP){
            unlink($path . $spp_name);
        }

        $this->session->set_flashdata('delmsg', '<div class="delete-success"></div>');

        if ($result->status == 'teacher' || $result->status == 'staff') {
            redirect('Admin/load_prof_tch_edit');
        } else {
            redirect('Admin/load_prof_std_edit');
        }
    }

    public function ajax_get_school_event(){

        $result = $this->Mdl_index->get_school_event();

        echo json_encode($result);
    }

    public function ajax_sv_school_event(){
        $title = $_POST['title'];
        $date_start = $_POST['date_start'];
        $date_end = $_POST['date_end'];
        $color = $_POST['color'];

        $result = $this->Mdl_index->sv_school_event($title, $date_start, $date_end, $color);

        echo $result;
    }

    public function ajax_update_school_event(){
        $event = $_POST['eventchange'];
        $title = $_POST['title'];
        $new_title = $_POST['newtitle'];
        $date_start = $_POST['start'];
        $date_end = $_POST['end'];
        $new_date_start = isset($_POST['newstart']) ? $_POST['newstart'] : '';
        $new_date_end = isset($_POST['newend']) ? $_POST['newend'] : '';
        $new_color = $_POST['newcolor'];

        $result = $this->Mdl_index->update_school_event($event, $title, $new_title, $date_start, $date_end, $new_date_start, $new_date_end, $new_color);

        print_r($result);
        die();
        echo $result;
    }

    public function ajax_save_report(){
        $field = $_POST['field'];
        $value = $_POST['val'];

        echo $result = $this->Mdl_index->Mdl_save_report($field, $value);
    }

    public function export_closing_report(){
        $degree = $this->input->get('degree');

        $excel = new Spreadsheet();

        $overall = $this->db->get_where('tbl_02_school', ['isActive' => 1, 'School_Desc' => $degree])->first_row();
        $other_school = $this->db->where("isActive = 1 AND School_Desc != '$degree'")->get('tbl_02_school')->row();
        $period = (date('Y')-1) . '-' . date('Y');
        $filename = "CLOSING REPORT $degree - $period.xlsx";
        
        $excel->setActiveSheetIndex(0)->setCellValue('B1', "LAPORAN PENDIDIKAN $period: " . $overall->ConferenceZone);
        $excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $excel->getActiveSheet()->mergeCells('B1:I1');
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);

        $excel->setActiveSheetIndex(0)->setCellValue('A2', "I. Informasi Umum");
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $excel->getActiveSheet()->mergeCells('A2:B2');

        $excel->setActiveSheetIndex(0)->setCellValue('B3', 'Nama Daerah');
        $excel->setActiveSheetIndex(0)->setCellValue('C3', $overall->ConferenceZone);
        $excel->setActiveSheetIndex(0)->setCellValue('B4', 'Nama Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('C4', $overall->DegreeName);
        $excel->setActiveSheetIndex(0)->setCellValue('B5', 'Nama-nama Sekolah yg selokasi');
        $excel->setActiveSheetIndex(0)->setCellValue('C5', $other_school->DegreeName);
        $excel->setActiveSheetIndex(0)->setCellValue('B6', 'Thn Akreditasi Gereja');
        $excel->setActiveSheetIndex(0)->setCellValue('C6', '');
        $excel->setActiveSheetIndex(0)->setCellValue('B7', 'Thn Akreditasi Pemerintah');
        $excel->setActiveSheetIndex(0)->setCellValue('C7', '');
        $excel->setActiveSheetIndex(0)->setCellValue('B8', 'Alamat Surat Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('C8', $overall->Address .' '. $overall->District);
        $excel->setActiveSheetIndex(0)->setCellValue('B9', 'Email Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('C9', $overall->Email);
        $excel->setActiveSheetIndex(0)->setCellValue('B10', 'No Telpon Sekolah/No HP Sek');
        $excel->setActiveSheetIndex(0)->setCellValue('C10', $overall->Phone);
        $excel->setActiveSheetIndex(0)->setCellValue('B11', 'No Fax Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('C11', '');
        $excel->setActiveSheetIndex(0)->setCellValue('B12', 'Kepala Sekolah/ Administrator');
        $excel->setActiveSheetIndex(0)->setCellValue('C12', '');
        $excel->setActiveSheetIndex(0)->setCellValue('B13', 'Hp dan Email Kepala Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('C13', '');
        $excel->setActiveSheetIndex(0)->setCellValue('B14', 'No Sertifikat Tanah');
        $excel->setActiveSheetIndex(0)->setCellValue('C14', $overall->SchoolConstructionCertificate);

        $excel->getActiveSheet()->mergeCells('C3:J3');
        $excel->getActiveSheet()->mergeCells('C4:J4');
        $excel->getActiveSheet()->mergeCells('C5:J5');
        $excel->getActiveSheet()->mergeCells('C6:J6');
        $excel->getActiveSheet()->mergeCells('C7:J7');
        $excel->getActiveSheet()->mergeCells('C8:J8');
        $excel->getActiveSheet()->mergeCells('C9:J9');
        $excel->getActiveSheet()->mergeCells('C10:J10');
        $excel->getActiveSheet()->mergeCells('C11:J11');
        $excel->getActiveSheet()->mergeCells('C12:J12');
        $excel->getActiveSheet()->mergeCells('C13:J13');
        $excel->getActiveSheet()->mergeCells('C14:J14');
        
        $excel->setActiveSheetIndex(0)->setCellValue('A16', "II. Database Guru");
        $excel->getActiveSheet()->getStyle('A16')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A16')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A16')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        
        $excel->setActiveSheetIndex(0)->setCellValue('A17', "No");
        $excel->getActiveSheet()->mergeCells('A17:A19');
        $excel->setActiveSheetIndex(0)->setCellValue('B17', "Nama Sekolah");
        $excel->getActiveSheet()->mergeCells('B17:B19');
        $excel->setActiveSheetIndex(0)->setCellValue('C17', "1");
        $excel->setActiveSheetIndex(0)->setCellValue('C18', "Jumlah");
        $excel->setActiveSheetIndex(0)->setCellValue('C19', "Guru");
        $excel->setActiveSheetIndex(0)->setCellValue('D17', "2");
        $excel->setActiveSheetIndex(0)->setCellValue('D18', "Jumlah");
        $excel->setActiveSheetIndex(0)->setCellValue('D19', "Non-Guru");
        $excel->setActiveSheetIndex(0)->setCellValue('E17', "3");
        $excel->setActiveSheetIndex(0)->setCellValue('E18', "Guru/Ijazah Terakhir");
        $excel->setActiveSheetIndex(0)->setCellValue('E19', 'SMA');
        $excel->setActiveSheetIndex(0)->setCellValue('F17', "4");
        $excel->setActiveSheetIndex(0)->setCellValue('F18', "Guru/Ijazah Terakhir");
        $excel->setActiveSheetIndex(0)->setCellValue('F19', 'D1/SPG');
        $excel->setActiveSheetIndex(0)->setCellValue('G17', "5");
        $excel->setActiveSheetIndex(0)->setCellValue('G18', "Guru/Ijazah Terakhir");
        $excel->setActiveSheetIndex(0)->setCellValue('G19', 'D2');
        $excel->setActiveSheetIndex(0)->setCellValue('H17', "6");
        $excel->setActiveSheetIndex(0)->setCellValue('H18', "Guru/Ijazah Terakhir");
        $excel->setActiveSheetIndex(0)->setCellValue('H19', 'D3');
        $excel->setActiveSheetIndex(0)->setCellValue('I17', "7");
        $excel->setActiveSheetIndex(0)->setCellValue('I18', "Guru/Ijazah Terakhir");
        $excel->setActiveSheetIndex(0)->setCellValue('I19', 'S1');
        $excel->setActiveSheetIndex(0)->setCellValue('J17', "8");
        $excel->setActiveSheetIndex(0)->setCellValue('J18', "Guru/Ijazah Terakhir");
        $excel->setActiveSheetIndex(0)->setCellValue('J19', 'S2');
        $excel->setActiveSheetIndex(0)->setCellValue('K17', "9");
        $excel->setActiveSheetIndex(0)->setCellValue('K18', "Jumlah");
        $excel->setActiveSheetIndex(0)->setCellValue('K19', 'Non-Gelar');
        $excel->setActiveSheetIndex(0)->setCellValue('L17', "10");
        $excel->setActiveSheetIndex(0)->setCellValue('L18', "Jumlah Siswa");
        $excel->getActiveSheet()->mergeCells('L18:N18');
        $excel->setActiveSheetIndex(0)->setCellValue('L19', 'Lk');
        $excel->setActiveSheetIndex(0)->setCellValue('M17', "11");
        $excel->setActiveSheetIndex(0)->setCellValue('M18', "");
        $excel->setActiveSheetIndex(0)->setCellValue('M19', 'Pr');
        $excel->setActiveSheetIndex(0)->setCellValue('N17', "12");
        $excel->setActiveSheetIndex(0)->setCellValue('N18', "");
        $excel->setActiveSheetIndex(0)->setCellValue('N19', 'Total');
        $excel->setActiveSheetIndex(0)->setCellValue('O17', "13");
        $excel->setActiveSheetIndex(0)->setCellValue('O18', "Total");
        $excel->setActiveSheetIndex(0)->setCellValue('O19', 'Guru & Non-Guru');
        $excel->setActiveSheetIndex(0)->setCellValue('P17', "14");
        $excel->setActiveSheetIndex(0)->setCellValue('P18', "Jlh Index & Non-Index");
        $excel->getActiveSheet()->mergeCells('P18:R18');
        $excel->setActiveSheetIndex(0)->setCellValue('P19', 'Index');
        $excel->setActiveSheetIndex(0)->setCellValue('Q17', "15");
        $excel->setActiveSheetIndex(0)->setCellValue('Q18', "Jlh Index & Non-Index");
        $excel->setActiveSheetIndex(0)->setCellValue('Q19', 'Non-Index');
        $excel->setActiveSheetIndex(0)->setCellValue('R17', "16");
        $excel->setActiveSheetIndex(0)->setCellValue('R18', "Jlh Index & Non-Index");
        $excel->setActiveSheetIndex(0)->setCellValue('R19', 'TTL');
        $excel->setActiveSheetIndex(0)->setCellValue('S17', "17");
        $excel->setActiveSheetIndex(0)->setCellValue('S18', "PNS");
        $excel->getActiveSheet()->mergeCells('S18:T18');
        $excel->setActiveSheetIndex(0)->setCellValue('S19', 'Advent');
        $excel->setActiveSheetIndex(0)->setCellValue('T17', "18");
        $excel->setActiveSheetIndex(0)->setCellValue('T18', "PNS");
        $excel->setActiveSheetIndex(0)->setCellValue('T19', 'Non');
        $excel->setActiveSheetIndex(0)->setCellValue('U17', "19");
        $excel->getActiveSheet()->mergeCells('U18:V18');
        $excel->setActiveSheetIndex(0)->setCellValue('U18', "Index");
        $excel->setActiveSheetIndex(0)->setCellValue('U19', 'Advent');
        $excel->setActiveSheetIndex(0)->setCellValue('V17', "20");
        $excel->setActiveSheetIndex(0)->setCellValue('V18', "Index");
        $excel->setActiveSheetIndex(0)->setCellValue('V19', 'Non');
        $excel->setActiveSheetIndex(0)->setCellValue('W17', "21");
        $excel->getActiveSheet()->mergeCells('W18:X18');
        $excel->setActiveSheetIndex(0)->setCellValue('W18', "Honor");
        $excel->setActiveSheetIndex(0)->setCellValue('W19', 'Advent');
        $excel->setActiveSheetIndex(0)->setCellValue('X17', "22");
        $excel->setActiveSheetIndex(0)->setCellValue('X18', "Honor");
        $excel->setActiveSheetIndex(0)->setCellValue('X19', 'Non');
        $excel->setActiveSheetIndex(0)->setCellValue('Y17', "23");
        $excel->setActiveSheetIndex(0)->setCellValue('Y18', "Total Advent/Non-Advent");
        $excel->getActiveSheet()->mergeCells('Y18:Y19');

        $teacher = $this->Mdl_index->get_closing_report();

        $excel->getActiveSheet()->setCellValue('A20', "1");
        $excel->getActiveSheet()->setCellValue('B20', $overall->DegreeName);
        $excel->getActiveSheet()->setCellValue('C20', $teacher->teacher);
        $excel->getActiveSheet()->setCellValue('D20', $teacher->nonteacher);
        $excel->getActiveSheet()->setCellValue('E20', $teacher->sma);
        $excel->getActiveSheet()->setCellValue('F20', $teacher->d1);
        $excel->getActiveSheet()->setCellValue('G20', $teacher->d2);
        $excel->getActiveSheet()->setCellValue('H20', $teacher->d3);
        $excel->getActiveSheet()->setCellValue('I20', $teacher->s1);
        $excel->getActiveSheet()->setCellValue('J20', $teacher->s2);
        $excel->getActiveSheet()->setCellValue('K20', $teacher->nondegree);
        $excel->getActiveSheet()->setCellValue('L20', $teacher->male);
        $excel->getActiveSheet()->setCellValue('M20', $teacher->female);
        $excel->getActiveSheet()->setCellValue('N20', $teacher->std_total);
        $excel->getActiveSheet()->setCellValue('O20', $teacher->non_std_total);
        $excel->getActiveSheet()->setCellValue('P20', $teacher->idx);
        $excel->getActiveSheet()->setCellValue('Q20', $teacher->nonidx);
        $excel->getActiveSheet()->setCellValue('R20', $teacher->total_idx);
        $excel->getActiveSheet()->setCellValue('S20', $teacher->advent_pns);
        $excel->getActiveSheet()->setCellValue('T20', $teacher->non_advent_pns);
        $excel->getActiveSheet()->setCellValue('U20', $teacher->advent_idx);
        $excel->getActiveSheet()->setCellValue('V20', $teacher->non_advent_idx);
        $excel->getActiveSheet()->setCellValue('W20', $teacher->advent_honor);
        $excel->getActiveSheet()->setCellValue('X20', $teacher->non_advent_honor);
        $excel->getActiveSheet()->setCellValue('Y20', $teacher->religion_total);

        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('N')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('R')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('S')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('V')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('W')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('X')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('Y')->setWidth(25);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    
        $excel->getActiveSheet(0)->setTitle("CLOSING REPORT $degree");
        $excel->setActiveSheetIndex(0);
    
        $writer = new Xlsx($excel);
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function export_labul(){

        $excel = new Spreadsheet();

        $data = $this->Mdl_index->Mdl_get_report();
        $filename = 'LABUL-'.date('F-Y').'.xlsx';
        
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "ITEM");
        $excel->setActiveSheetIndex(0)->setCellValue('B1', "VALUE");
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A2', 'Nama Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('A3', 'Alamat');
        $excel->setActiveSheetIndex(0)->setCellValue('A4', 'Kota/Kabupaten');
        $excel->setActiveSheetIndex(0)->setCellValue('A5', 'Provinsi');
        $excel->setActiveSheetIndex(0)->setCellValue('A6', 'NSS/NSPN');
        $excel->setActiveSheetIndex(0)->setCellValue('A7', 'No. Telp Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('A8', 'Email Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('A9', 'No. Kode Pos');
        $excel->setActiveSheetIndex(0)->setCellValue('A10', 'Pemerintah');
        $excel->setActiveSheetIndex(0)->setCellValue('A11', 'Yayasan/Organisasi');
        $excel->setActiveSheetIndex(0)->setCellValue('A12', 'Bentuk Gedung Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('A13', 'Tanah');
        $excel->setActiveSheetIndex(0)->setCellValue('A14', 'Akte No. (Jika Miliki Sendiri)');
        $excel->setActiveSheetIndex(0)->setCellValue('A15', 'Gedung Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('A16', 'Nama Badan Penyelanggara');
        $excel->setActiveSheetIndex(0)->setCellValue('A17', 'Waktu Penyelenggara');
        $excel->setActiveSheetIndex(0)->setCellValue('A18', 'Jumlah Hari Efektif Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('A19', 'No. Akte Pendirian Sekolah');
        $excel->setActiveSheetIndex(0)->setCellValue('A20', 'No. Ijin Operasional Sekolah');

        $excel->setActiveSheetIndex(0)->setCellValue('B2', $data->SchoolName);
        $excel->setActiveSheetIndex(0)->setCellValue('B3', $data->Address);
        $excel->setActiveSheetIndex(0)->setCellValue('B4', $data->Region);
        $excel->setActiveSheetIndex(0)->setCellValue('B5', $data->Province);
        $excel->setActiveSheetIndex(0)->setCellValue('B6', $data->NSS_NSPN);
        $excel->setActiveSheetIndex(0)->setCellValue('B7', $data->Phone);
        $excel->setActiveSheetIndex(0)->setCellValue('B8', $data->Email);
        $excel->setActiveSheetIndex(0)->setCellValue('B9', $data->PostCode);
        $excel->setActiveSheetIndex(0)->setCellValue('B10', $data->GovtCertificate);
        $excel->setActiveSheetIndex(0)->setCellValue('B11', $data->BoardCertificate);
        $excel->setActiveSheetIndex(0)->setCellValue('B12', $data->BuildingType);
        $excel->setActiveSheetIndex(0)->setCellValue('B13', $data->LandOwnership);
        $excel->setActiveSheetIndex(0)->setCellValue('B14', $data->OwnershipCertificate);
        $excel->setActiveSheetIndex(0)->setCellValue('B15', $data->BuildingOwnership);
        $excel->setActiveSheetIndex(0)->setCellValue('B16', $data->FoundationName);
        $excel->setActiveSheetIndex(0)->setCellValue('B17', $data->ConferenceZone);
        $excel->setActiveSheetIndex(0)->setCellValue('B18', $data->SchoolActiveDays);
        $excel->setActiveSheetIndex(0)->setCellValue('B19', $data->SchoolConstructionCertificate);
        $excel->setActiveSheetIndex(0)->setCellValue('B20', $data->NoOperation);

        $alp = 'E';
        $index = 1;
        
        $report_school = $this->Mdl_index->get_report_school();

        foreach($report_school as $school){
            $sch = $school->School_Desc;
            
            $room = $this->Mdl_index->get_report_class($sch);

            $excel->setActiveSheetIndex(0)->setCellValue('D' . $index, $sch);
            $excel->getActiveSheet()
                ->getStyle('D' . $index)->getFont()->setBold(TRUE);
            $excel->getActiveSheet()
                ->getStyle('D' . $index)->getFont()->setSize(12);
            $excel->getActiveSheet()
                ->getStyle('D' . $index)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            foreach($room as $room){
                $excel->setActiveSheetIndex(0)->setCellValue('D'.($index+1), 'ITEM');
                $excel->setActiveSheetIndex(0)->setCellValue($alp. ($index+1), $room->ClassDesc);
                $excel->setActiveSheetIndex(0)->setCellValue('D'.($index+2), 'ROMBEL');
                $excel->setActiveSheetIndex(0)->setCellValue($alp. ($index+2), $room->Total);
                $excel->setActiveSheetIndex(0)->setCellValue('D'.($index+3), 'JAM/MINGGU');
                $excel->setActiveSheetIndex(0)->setCellValue($alp. ($index+3), $room->Hour);
                
                $excel->getActiveSheet()->getColumnDimension($alp)->setWidth(15);

                ++$alp;
            }

            $excel->getActiveSheet()->mergeCells('D' . $index . ':' . (--$alp) . $index);
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);

            $alp = 'E';
            $index += 5;
        }
    
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
    
        $excel->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    
        $excel->getActiveSheet(0)->setTitle('LABUL - ' . date('F Y'));
        $excel->setActiveSheetIndex(0);
    
        $writer = new Xlsx($excel);
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function export_labul_student(){

        $excel = new Spreadsheet();

        $data = $this->Mdl_index->Mdl_get_report();
        $filename = 'LABUL - '.date('F-Y').' [STUDENT].xlsx';

        $index = 1;

        $sch = $this->Mdl_index->get_report_school();       
        
        foreach($sch as $sch){
            $school = $sch->School_Desc;
            
            [$all_std, $adventist, $non_adventist, $attendance, $sick, $on_permit, $absent] = $this->Mdl_index->get_report_student($school);

            $excel->setActiveSheetIndex(0)->setCellValue('A' . $index, $school);
            $excel->getActiveSheet()->mergeCells('A' . $index . ':' . 'D' . $index);
            $excel->getActiveSheet()->getStyle('A' . $index)->getFont()->setBold(TRUE);
            $excel->getActiveSheet()->getStyle('A' . $index)->getFont()->setSize(15);
            $excel->getActiveSheet()->getStyle('A' . $index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $excel->getActiveSheet()->getStyle('B' . $index)->getFont()->setBold(TRUE);
            
            $excel->setActiveSheetIndex(0)->setCellValue('A'.($index+1), "ITEM");
            $excel->setActiveSheetIndex(0)->setCellValue('B'.($index+1), "LAKI-LAKI");
            $excel->setActiveSheetIndex(0)->setCellValue('C'.($index+1), "PEREMPUAN");
            $excel->setActiveSheetIndex(0)->setCellValue('D'.($index+1), "TOTAL");
            $excel->getActiveSheet()->getStyle('A' . ($index+1))->getFont()->setBold(TRUE);
            $excel->getActiveSheet()->getStyle('A' . ($index+1))->getFont()->setSize(15);
            $excel->getActiveSheet()->getStyle('A' . ($index+1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $excel->getActiveSheet()->getStyle('B' . ($index+1))->getFont()->setBold(TRUE);
            $excel->getActiveSheet()->getStyle('B' . ($index+1))->getFont()->setSize(15);
            $excel->getActiveSheet()->getStyle('B' . ($index+1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $excel->getActiveSheet()->getStyle('C' . ($index+1))->getFont()->setBold(TRUE);
            $excel->getActiveSheet()->getStyle('C' . ($index+1))->getFont()->setSize(15);
            $excel->getActiveSheet()->getStyle('C' . ($index+1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $excel->getActiveSheet()->getStyle('D' . ($index+1))->getFont()->setBold(TRUE);
            $excel->getActiveSheet()->getStyle('D' . ($index+1))->getFont()->setSize(15);
            $excel->getActiveSheet()->getStyle('D' . ($index+1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+2),"Jumlah Siswa Seluruhnya");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+2),$all_std->Male);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+2),$all_std->Female);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+2),$all_std->Total);
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+3),"Advent");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+3),$adventist->Male);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+3),$adventist->Female);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+3),$adventist->Total);
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+4),"Non-Adventist");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+4),$non_adventist->Male);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+4),$non_adventist->Female);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+4),$non_adventist->Total);
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+5),"Jumlah Absen Bulan Ini");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+5),$attendance->Male);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+5),$attendance->Female);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+5),$attendance->Total);
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+6),"Sakit");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+6),$sick->Male);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+6),$sick->Female);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+6),$sick->Total);
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+7),"Izin");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+7),$on_permit->Male);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+7),$on_permit->Female);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+7),$on_permit->Total);
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+8),"Alpa");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+8),$absent->Male);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+8),$absent->Female);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+8),$absent->Total);
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+9),"Jumlah Siswa Mutasi/DO");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+9),'');
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+9),'');
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+9),'');
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+10),"Masuk");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+10),'');
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+10),'');
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+10),'');
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+11),"Keluar/Pindah");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+11),'');
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+11),'');
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+11),'');
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+12),"Jumlah Siswa yang sudah dibaptis");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+12),'');
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+12),'');
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+12),'');
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+13),"Jumlah Siswa yang sudah dibaptis sampai bulan ini");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+13),'');
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+13),'');
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+13),'');
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+14),"Jumlah Siswa yang belum dibaptis (Usia Baptis mengikuti Bible Study)");
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+14),'');
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+14),'');
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+54),'');

            $index += 16;
        }

        [$overall_all_std, $overall_adventist, $overall_non_adventist, $overall_attendance, $overall_sick, $overall_on_permit, $overall_absent] = $this->Mdl_index->get_report_student_overall();

        $excel->setActiveSheetIndex(0)->setCellValue('F1', 'ALL');
        $excel->getActiveSheet()->mergeCells('F1:I1');
        $excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $excel->setActiveSheetIndex(0)->setCellValue('F2', "ITEM");
        $excel->setActiveSheetIndex(0)->setCellValue('G2', "LAKI-LAKI");
        $excel->setActiveSheetIndex(0)->setCellValue('H2', "PEREMPUAN");
        $excel->setActiveSheetIndex(0)->setCellValue('I2', "TOTAL");
        $excel->getActiveSheet()->getStyle('F2')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('F2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('H2')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('H2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('I2')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('I2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('I2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $excel->setActiveSheetIndex(0)->setCellValue('F2', "Jumlah Siswa Seluruhnya");
        $excel->setActiveSheetIndex(0)->setCellValue('G2',$overall_all_std->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('H2',$overall_all_std->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('I2',$overall_all_std->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Advent");
        $excel->setActiveSheetIndex(0)->setCellValue('G3',$overall_adventist->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('H3',$overall_adventist->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('I3',$overall_adventist->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('F4', "Non-Adventist");
        $excel->setActiveSheetIndex(0)->setCellValue('G4',$overall_non_adventist->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('H4',$overall_non_adventist->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('I4',$overall_non_adventist->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('F5', "Jumlah Absen Bulan Ini");
        $excel->setActiveSheetIndex(0)->setCellValue('G5',$overall_attendance->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('H5',$overall_attendance->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('I5',$overall_attendance->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('F6', "Sakit");
        $excel->setActiveSheetIndex(0)->setCellValue('G6',$overall_sick->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('H6',$overall_sick->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('I6',$overall_sick->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('F7', "Izin");
        $excel->setActiveSheetIndex(0)->setCellValue('G7',$overall_on_permit->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('H7',$overall_on_permit->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('I7',$overall_on_permit->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('F8', "Alpa");
        $excel->setActiveSheetIndex(0)->setCellValue('G8',$overall_absent->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('H8',$overall_absent->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('I8',$overall_absent->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('F9', "Jumlah Siswa Mutasi/DO");
        $excel->setActiveSheetIndex(0)->setCellValue('G9','');
        $excel->setActiveSheetIndex(0)->setCellValue('H9','');
        $excel->setActiveSheetIndex(0)->setCellValue('I9','');
        $excel->setActiveSheetIndex(0)->setCellValue('F10',"Masuk");
        $excel->setActiveSheetIndex(0)->setCellValue('G10','');
        $excel->setActiveSheetIndex(0)->setCellValue('H10','');
        $excel->setActiveSheetIndex(0)->setCellValue('I10','');
        $excel->setActiveSheetIndex(0)->setCellValue('F11',"Keluar/Pindah");
        $excel->setActiveSheetIndex(0)->setCellValue('G11','');
        $excel->setActiveSheetIndex(0)->setCellValue('H11','');
        $excel->setActiveSheetIndex(0)->setCellValue('I11','');
        $excel->setActiveSheetIndex(0)->setCellValue('F12',"Jumlah Siswa yang sudah dibaptis");
        $excel->setActiveSheetIndex(0)->setCellValue('G12','');
        $excel->setActiveSheetIndex(0)->setCellValue('H12','');
        $excel->setActiveSheetIndex(0)->setCellValue('I12','');
        $excel->setActiveSheetIndex(0)->setCellValue('F13',"Jumlah Siswa yang sudah dibaptis sampai bulan ini");
        $excel->setActiveSheetIndex(0)->setCellValue('G13','');
        $excel->setActiveSheetIndex(0)->setCellValue('H13','');
        $excel->setActiveSheetIndex(0)->setCellValue('I13','');
        $excel->setActiveSheetIndex(0)->setCellValue('F14',"Jumlah Siswa yang belum dibaptis (Usia Baptis mengikuti Bible Study)");
        $excel->setActiveSheetIndex(0)->setCellValue('G14','');
        $excel->setActiveSheetIndex(0)->setCellValue('H14','');
        $excel->setActiveSheetIndex(0)->setCellValue('I14','');
    
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(60);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
    
        $excel->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    
        $excel->getActiveSheet(0)->setTitle('STUDENT');
        $excel->setActiveSheetIndex(0);
    
        $writer = new Xlsx($excel);
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function export_labul_teacher(){

        $excel = new Spreadsheet();

        $data = $this->Mdl_index->Mdl_get_report();
        $filename = 'LABUL - '.date('F Y').' [TEACHER].xlsx';
        
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "ITEM");
        $excel->setActiveSheetIndex(0)->setCellValue('B1', "LAKI-LAKI");
        $excel->setActiveSheetIndex(0)->setCellValue('C1', "PEREMPUAN");
        $excel->setActiveSheetIndex(0)->setCellValue('D1', "TOTAL");
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        [$nonstd, $gty, $asn, $gtt, $nontch, $acc, $adm, $others, $adv, $nonadv, $nonstrat, $strat1, $strat2, $attd, $sck, $onpermit, $abs] = $this->Mdl_index->get_report_nonstudent();    

        $excel->setActiveSheetIndex(0)->setCellValue('A2', "Jumlah Guru/Pegawai Seluruhnya");
        $excel->setActiveSheetIndex(0)->setCellValue('B2', $nonstd->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C2', $nonstd->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D2', $nonstd->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "Index (GTY)");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', $gty->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C3', $gty->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D3', $gty->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A4', "Aparat Sipil Negara (ASN)");
        $excel->setActiveSheetIndex(0)->setCellValue('B4', $asn->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C4', $asn->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D4', $asn->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A5', "Jumlah Staff Non-Guru");
        $excel->setActiveSheetIndex(0)->setCellValue('B5', $nontch->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C5', $nontch->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D5', $nontch->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A6', "Keuangan");
        $excel->setActiveSheetIndex(0)->setCellValue('B6', $acc->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C6', $acc->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D6', $acc->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A7', "Tata Usaha / Administrasi");
        $excel->setActiveSheetIndex(0)->setCellValue('B7', $adm->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C7', $adm->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D7', $adm->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A8', "Satpam, DLL");
        $excel->setActiveSheetIndex(0)->setCellValue('B8', $others->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C8', $others->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D8', $others->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A9', "Jumlah Guru/Pegawai Menurut Agama");
        $excel->setActiveSheetIndex(0)->setCellValue('B9', $nonstd->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C9', $nonstd->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D9', $nonstd->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A10', "Advent");
        $excel->setActiveSheetIndex(0)->setCellValue('B10', $adv->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C10', $adv->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D10', $adv->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A11', "Non-Advent");
        $excel->setActiveSheetIndex(0)->setCellValue('B11', $nonadv->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C11', $nonadv->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D11', $nonadv->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A12', "Jumlah Guru Menurut Jenjang");
        $excel->setActiveSheetIndex(0)->setCellValue('B12', $nonstd->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C12', $nonstd->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D12', $nonstd->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A13', "SMA/SPG/PGSLP/D1/D2/D3");
        $excel->setActiveSheetIndex(0)->setCellValue('B13', $nonstrat->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C13', $nonstrat->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D13', $nonstrat->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A14', "Strata 1 (S1)");
        $excel->setActiveSheetIndex(0)->setCellValue('B14', $strat1->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C14', $strat1->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D14', $strat1->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A15', "Strata 2 (S2)");
        $excel->setActiveSheetIndex(0)->setCellValue('B15', $strat2->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C15', $strat2->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D15', $strat2->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A16', "Guru/Pegawai yang tamat Perguruan Tinggi");
        $excel->setActiveSheetIndex(0)->setCellValue('B16', '');
        $excel->setActiveSheetIndex(0)->setCellValue('C16', '');
        $excel->setActiveSheetIndex(0)->setCellValue('D16', '');
        $excel->setActiveSheetIndex(0)->setCellValue('A17', "Perguruan Tinggi Advent");
        $excel->setActiveSheetIndex(0)->setCellValue('B17', '');
        $excel->setActiveSheetIndex(0)->setCellValue('C17', '');
        $excel->setActiveSheetIndex(0)->setCellValue('D17', '');
        $excel->setActiveSheetIndex(0)->setCellValue('A18', "Perguruan Tinggi Non-Advent");
        $excel->setActiveSheetIndex(0)->setCellValue('B18', '');
        $excel->setActiveSheetIndex(0)->setCellValue('C18', '');
        $excel->setActiveSheetIndex(0)->setCellValue('D18', '');
        $excel->setActiveSheetIndex(0)->setCellValue('A19', "Jumlah Guru Tersertifikasi Gereja (Yayasan)");
        $excel->setActiveSheetIndex(0)->setCellValue('B19', '');
        $excel->setActiveSheetIndex(0)->setCellValue('C19', '');
        $excel->setActiveSheetIndex(0)->setCellValue('D19', '');
        $excel->setActiveSheetIndex(0)->setCellValue('A20', "Pemerintah");
        $excel->setActiveSheetIndex(0)->setCellValue('B20', '');
        $excel->setActiveSheetIndex(0)->setCellValue('C20', '');
        $excel->setActiveSheetIndex(0)->setCellValue('D20', '');
        $excel->setActiveSheetIndex(0)->setCellValue('A21', "Jumlah Absent Guru dan Pegawai");
        $excel->setActiveSheetIndex(0)->setCellValue('B21', $attd->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C21', $attd->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D21', $attd->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A22', "Sakit");
        $excel->setActiveSheetIndex(0)->setCellValue('B22', $sck->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C22', $sck->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D22', $sck->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A23', "Izin");
        $excel->setActiveSheetIndex(0)->setCellValue('B23', $onpermit->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C23', $onpermit->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D23', $onpermit->Total);
        $excel->setActiveSheetIndex(0)->setCellValue('A24', "Alpa");
        $excel->setActiveSheetIndex(0)->setCellValue('B24', $abs->Male);
        $excel->setActiveSheetIndex(0)->setCellValue('C24', $abs->Female);
        $excel->setActiveSheetIndex(0)->setCellValue('D24', $abs->Total);
    
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(70);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    
        $excel->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    
        $excel->getActiveSheet(0)->setTitle('TEACHER');
        $excel->setActiveSheetIndex(0);
    
        $writer = new Xlsx($excel);
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function export_labul_staff(){

        $excel = new Spreadsheet();

        $data = $this->Mdl_index->Mdl_get_report();
        $filename = 'LABUL - '.date('F Y').' [NOMINATIF].xlsx';
        
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B1', "NAMA/NIP");
        $excel->setActiveSheetIndex(0)->setCellValue('C1', "L/P");
        $excel->setActiveSheetIndex(0)->setCellValue('D1', "GTY/PNS | PTY/GTT/PTT");
        $excel->setActiveSheetIndex(0)->setCellValue('E1', "TTL");
        $excel->setActiveSheetIndex(0)->setCellValue('F1', "Ijazah Terakhir");
        $excel->setActiveSheetIndex(0)->setCellValue('G1', "Tahun Tamat");
        $excel->setActiveSheetIndex(0)->setCellValue('H1', "Jabatan");
        $excel->setActiveSheetIndex(0)->setCellValue('I1', "Mulai Kerja (TMT)");
        $excel->setActiveSheetIndex(0)->setCellValue('J1', "Masa dinas di Yayasan");
        $excel->setActiveSheetIndex(0)->setCellValue('K1', "Alamat");
        $excel->setActiveSheetIndex(0)->setCellValue('L1', "sertifikasi Pemerintah");
        $excel->setActiveSheetIndex(0)->setCellValue('M1', "Sertifikas Yayasan");
        
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('J1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('K1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('L1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('M1')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('M1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        [$teacher, $nonteacher] = $this->Mdl_index->get_report_full_nonstudent();

        $i = 1;
        $index = 2;
        foreach($teacher as $tch){
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $index, $i);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $index, $tch->FullName . ', ' . $tch->IDNumber);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $index, $tch->Gender);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $index, $tch->Emp_Type);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $index, $tch->Birth);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $index, '');
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $index, '');
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $index, $tch->JobDesc);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $index, $tch->YearStarts);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $index, '');
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $index, $tch->Address);
            $excel->setActiveSheetIndex(0)->setCellValue('L' . $index, $tch->Govt_Cert);
            $excel->setActiveSheetIndex(0)->setCellValue('M' . $index, $tch->Institute_Cert);

            $i++;
            $index += 1;
        }

        $excel->setActiveSheetIndex(0)->setCellValue('A' . $index , "ADMINISTRASI");
        $excel->getActiveSheet()->getStyle('A' . $index)->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A' . $index)->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A' . $index)->getFont()->setSize(10);
        $excel->getActiveSheet()->getStyle('A' . $index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->mergeCells('A' . $index . ':' . 'M' . $index);

        foreach($nonteacher as $nontch){
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+1), $i);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+1), $nontch->FullName . ', ' . $nontch->IDNumber);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+1), $nontch->Gender);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($index+1), $nontch->Emp_Type);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . ($index+1), $nontch->Birth);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . ($index+1), '');
            $excel->setActiveSheetIndex(0)->setCellValue('G' . ($index+1), '');
            $excel->setActiveSheetIndex(0)->setCellValue('H' . ($index+1), $nontch->JobDesc);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . ($index+1), $nontch->YearStarts);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . ($index+1), '');
            $excel->setActiveSheetIndex(0)->setCellValue('K' . ($index+1), $nontch->Address);
            $excel->setActiveSheetIndex(0)->setCellValue('L' . ($index+1), $nontch->Govt_Cert);
            $excel->setActiveSheetIndex(0)->setCellValue('M' . ($index+1), $nontch->Institute_Cert);

            $i++;
            $index +=1;
        }
        
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(45);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
    
        $excel->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    
        $excel->getActiveSheet(0)->setTitle('NOMINATIF PEGAWAI');
        $excel->setActiveSheetIndex(0);
    
        $writer = new Xlsx($excel);
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    // ==================================================================================================================== \\
    // ==============================                     CONTROL PANEL CONTROLLER           ============================== \\
    // ==================================================================================================================== \\
    public function index()
    {
        $tch = 'teacher';
        $std = 'student';
        $stf = 'staff';
        $report = '';
        $report_student = '';

        $report_school = $this->Mdl_index->get_report_school();

        //REPORT
        foreach($report_school as $school){
            $sch = $school->School_Desc;
            
            //LABUL
            $report_class = $this->Mdl_index->get_report_class($sch);

            $report .= '<div class="col-md-12">';
            $report .= '  <div class="portlet light portlet-fit bordered">';
            $report .= '      <div class="portlet-title">';
            $report .= '          <div class="caption">';
            $report .= '              <i class="icon-bubble font-dark"></i>';
            $report .= '              <span class="caption-subject font-dark bold uppercase">'.$school->School_Desc.'</span>';
            $report .= '          </div>';
            $report .= '      </div>';
            $report .= '      <div class="portlet-body">';
            $report .= '          <div class="table-scrollable">';
            $report .= '              <table class="table table-bordered table-hover">';
            $report .= '                  <thead>';
            $report .= '                      <tr>';
            $report .= '                          <th> Item </th>';
            foreach($report_class as $cls){
                $report .= '                          <th> '.$cls->ClassDesc.' </th>';
            }
            $report .= '                      </tr>';
            $report .= '                  </thead>';
            $report .= '                  <tbody>';
            $report .= '                      <tr>';
            $report .= '                          <td width="15%"> ROMBEL </td>';
            foreach($report_class as $room){
                $report .= '                      <td> '.$room->Total.' </td>';
            }
            $report .= '                      </tr>';
            $report .= '                      <tr>';
            $report .= '                          <td width="15%"> Jam/Minggu </td>';
            foreach($report_class as $hour){
                $report .= '                      <td> '.$hour->Hour.' </td>';
            }
            $report .= '                      </tr>';
            $report .= '                  </tbody>';
            $report .= '              </table>';
            $report .= '          </div>';
            $report .= '      </div>';
            $report .= '  </div>';
            $report .= '</div>';

            //STUDENT 
            //BY SCHOOL
            [$all_std, $adventist, $non_adventist, $attendance, $sick, $on_permit, $absent] = $this->Mdl_index->get_report_student($sch);

            $report_student .= '<div class="col-md-12">';
            $report_student .= '    <div class="portlet light portlet-fit bordered">';
            $report_student .= '        <div class="portlet-title">';
            $report_student .= '            <div class="caption">';
            $report_student .= '                <i class="icon-settings font-dark"></i>';
            $report_student .= '                <span class="caption-subject font-dark bold uppercase">KEADAAN MURID '.$sch.' - '.date('F Y').'</span>';
            $report_student .= '            </div>';
            $report_student .= '        </div>';
            $report_student .= '        <div class="portlet-body">';
            $report_student .= '            <div class="table-scrollable">';
            $report_student .= '            <table class="table table-striped table-hover">';
            $report_student .= '                <thead>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <th> Item </th>';
            $report_student .= '                        <th> Laki-Laki </th>';
            $report_student .= '                        <th> Perempuan </th>';
            $report_student .= '                        <th> Jumlah </th>';
            $report_student .= '                    </tr>';
            $report_student .= '                </thead>';
            $report_student .= '                <tbody>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Jumlah Siswa Seluruhnya </td>';
            $report_student .= '                        <td> '.$all_std->Male.' </td>';
            $report_student .= '                        <td> '.$all_std->Female.' </td>';
            $report_student .= '                        <td> '.$all_std->Total.' </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Advent </td>';
            $report_student .= '                        <td> '.$adventist->Male.' </td>';
            $report_student .= '                        <td> '.$adventist->Female.' </td>';
            $report_student .= '                        <td> '.$adventist->Total.' </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Non-Adventist </td>';
            $report_student .= '                        <td> '.$non_adventist->Male.' </td>';
            $report_student .= '                        <td> '.$non_adventist->Female.' </td>';
            $report_student .= '                        <td> '.$non_adventist->Total.' </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Jumlah Absen Bulan Ini </td>';
            $report_student .= '                        <td> '.$attendance->Male.' </td>';
            $report_student .= '                        <td> '.$attendance->Female.' </td>';
            $report_student .= '                        <td> '.$attendance->Total.' </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Sakit </td>';
            $report_student .= '                        <td> '.$sick->Male.' </td>';
            $report_student .= '                        <td> '.$sick->Female.' </td>';
            $report_student .= '                        <td> '.$sick->Total.' </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Izin </td>';
            $report_student .= '                        <td> '.$on_permit->Male.' </td>';
            $report_student .= '                        <td> '.$on_permit->Female.' </td>';
            $report_student .= '                        <td> '.$on_permit->Total.' </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Alpa </td>';
            $report_student .= '                        <td> '.$absent->Male.' </td>';
            $report_student .= '                        <td> '.$absent->Female.' </td>';
            $report_student .= '                        <td> '.$absent->Total.' </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Jumlah Siswa Mutasi/DO </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Masuk </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Keluar/Pindah </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                        <td> Drop Out (DO) </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Jumlah Siswa yang sudah dibaptis </td>';
            $report_student .= '                        <td contenteditable="0"> 0 </td>';
            $report_student .= '                        <td contenteditable="0"> 0 </td>';
            $report_student .= '                        <td contenteditable="0"> 0 </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Jumlah Siswa yang sudah dibaptis sampai bulan ini </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                    <tr>';
            $report_student .= '                        <td> Jumlah Siswa yang belum dibaptis <br> (Usia Baptis mengikuti Bible Study) </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                        <td contenteditable="true"> 0 </td>';
            $report_student .= '                    </tr>';
            $report_student .= '                </tbody>';
            $report_student .= '            </table>';
            $report_student .= '        </div>';
            $report_student .= '        </div>';
            $report_student .= '    </div>';
            $report_student .= '</div>';
        }

        //STUDENT
        //BY OVERALL
        [$overall_all_std, $overall_adventist, $overall_non_adventist, $overall_attendance, $overall_sick, $overall_on_permit, $overall_absent] = $this->Mdl_index->get_report_student_overall();

        //NON-STUDENT
        [$nonstd, $gty, $asn, $gtt, $nontch, $acc, $adm, $others, $adv, $nonadv, $nonstrat, $strat1, $strat2, $attd, $sck, $onpermit, $abs] = $this->Mdl_index->get_report_nonstudent();

        //NOMINATIVE
        [$teacher, $nonteacher] = $this->Mdl_index->get_report_full_nonstudent();

        $data = [
            //MAIN
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'tch' => $this->Mdl_index->count_specific($tch),
            'std' => $this->Mdl_index->count_specific($std),
            'stf' => $this->Mdl_index->count_specific($stf),
            'count' => $this->Mdl_index->count_total(),
            'tch_t' => $this->Mdl_index->get_teachers($tch),
            'std_t' => $this->Mdl_index->get_student($std),
            'stf_t' => $this->Mdl_index->get_staff($stf),
            'degree_active' => $this->db->select('School_Desc')->where('isActive', 1)->get('tbl_02_school')->result(),

            /* REPORT */
                //LABUL
                'report_input' => $this->Mdl_index->Mdl_get_report(),
                'report' => $report,

                //STUDENT
                'report_std' => $report_student,
                'report_overall' => $overall_all_std,
                'report_adventist' => $overall_adventist,
                'report_non_adventist' => $overall_non_adventist,
                'report_attendance' => $overall_attendance,
                'report_sick' => $overall_sick,
                'report_on_permit' => $overall_on_permit,
                'report_absent' => $overall_absent,

                //NON-STUDENT
                'overall' => $nonstd,
                'gty' => $gty,
                'asn' => $asn,
                'gtt' => $gtt,
                'nontch' => $nontch,
                'acc' => $acc,
                'adm' => $adm,
                'other' => $others,
                'adv' => $adv,
                'nonadv' => $nonadv,
                'nonstrat' => $nonstrat,
                'strat1' => $strat1,
                'strat2' => $strat2,
                'attd' => $attd,
                'sick' => $sck,
                'onpermit' => $onpermit,
                'abs' => $abs,

                //NOMINATIVE
                'nom_t' => $teacher,
                'nom_s' => $nonteacher,

            //MID-RECAP
            'active_rooms' => $this->Mdl_grade->get_active_rooms()
        ];
        
        $this->load->view('admin/index', $data);
    }

    public function get_active_degree()
    {
        $result = $this->Mdl_index->model_get_active_degree();

        extract($result);

        $data = [
            'SD' => $SD->isActive,
            'SMP' => $SMP->isActive,
            'SMA' => $SMA->isActive,
            'SMK' => $SMK->isActive
        ];

        echo json_encode($data);
    }

    public function get_state()
    {
        $degree = $_POST['degree'];

        $result = $this->Mdl_index->model_get_state($degree);

        echo $result;
    }

    public function toggle_degree()
    {
        $degree = $_POST['degree'];
        $state = $_POST['active'];

        $this->Mdl_index->model_toggle_degree($degree, $state);
    }

    public function get_class_list()
    {
        $degree = $_POST['degree'];

        $result = $this->Mdl_index->model_get_class_list($degree);

        $value = '';
        if ($degree == 'SD' || $degree == 'SMP') {
            $value .= ' <thead>
                            <tr class="uppercase">';
            $i = 1;
            foreach ($result as $row) {
                $value .= '     <th data-class="' . $row['ClassID'] . '" data-class-num="' . $row['ClassNumeric'] . '"> ' . $row['ClassDesc'] . ' 
                                    <span style="float: right; padding-right: 50px"> 
                                        <a href="javascript:;" class="sbold new_room">
                                            <i class="fa fa-plus" style="font-size: 1.1em"></i>
                                        </a>
                                    </span> 
                                </th>';
                $i++;
            }
            $value .= '    </tr>
                        </thead>
                        <tbody>
                            <tr>';
            for ($i = 1; $i <= count($result); $i++) {
                $rooms = $this->Mdl_index->model_get_rooms($degree, $i);

                $value .= '     <td width="1%">';
                foreach ($rooms as $row) {
                    $value .= '     <a href="javascript:;" class="btn btn-md blue remove_room" data-room="' . $row->RoomID . '" style="padding-right: 5px;"> ' . $row->RoomDesc . '
                                        &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>
                                    </a><br><br>';
                }
                $value .= '     </td>';
            }
            $value .= '     </tr>
                        </tbody>';
        } elseif ($degree == 'SMA') {
            $value .= ' <thead>
                            <tr>
                                <th colspan="3" class="text-center sbold"> X </th>
                                <th colspan="3" class="text-center sbold"> XI </th>
                                <th colspan="3" class="text-center sbold"> XII </th>
                            </tr>
                            <tr>';
            for ($i = 1; $i <= 3; $i++) {
                $value .= '     <th data-class="SMAC' . $i . 'BHS" data-class-num="' . ($i + 9) . '"> Literature 
                                    <span style="float: right; padding-right: 50px"> 
                                        <a href="javascript:;" class="sbold new_room">
                                            <i class="fa fa-plus" style="font-size: 1.1em"></i>
                                        </a> 
                                    </span> 
                                </th>
                                <th data-class="SMAC' . $i . 'IPA" data-class-num="' . ($i + 9) . '"> Science 
                                    <span style="float: right; padding-right: 50px"> 
                                        <a href="javascript:;" class="sbold new_room">
                                            <i class="fa fa-plus" style="font-size: 1.1em"></i>
                                        </a> 
                                    </span> 
                                </th>
                                <th data-class="SMAC' . $i . 'IPS" data-class-num="' . ($i + 9) . '"> Social 
                                    <span style="float: right; padding-right: 50px"> 
                                        <a href="javascript:;" class="sbold new_room">
                                            <i class="fa fa-plus" style="font-size: 1.1em"></i>
                                        </a> 
                                    </span> 
                                </th>';
            }
            $value .= '     </tr>
                        </thead>
                        <tbody>
                            <tr>';
            for ($i = 10; $i <= 12; $i++) {
                $sma = $this->Mdl_index->model_get_rooms($degree, $i);

                extract($sma);

                $value .= '<td width="1%">';
                foreach ($Lit as $sma) {
                    $value .= ' <a href="javascript:;" class="btn btn-md blue remove_room" data-room="' . $sma['RoomID'] . '" style="padding-right: 5px;"> ' . $sma['Simplified'] . '
                                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i> 
                                </a><br><br>';
                }
                $value .= '</td>';

                $value .= '<td width="1%">';
                foreach ($Scn as $sma) {
                    $value .= ' <a href="javascript:;" class="btn btn-md blue remove_room" data-room="' . $sma['RoomID'] . '" style="padding-right: 5px;"> ' . $sma['Simplified'] . '
                                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i> 
                                </a><br><br>';
                }
                $value .= '</td>';

                $value .= '<td width="1%">';
                foreach ($Soc as $sma) {
                    $value .= ' <a href="javascript:;" class="btn btn-md blue remove_room" data-room="' . $sma['RoomID'] . '" style="padding-right: 5px;"> ' . $sma['Simplified'] . '
                                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i> 
                                </a><br><br>';
                }
                $value .= '</td>';
            }
            $value .= '     </tr>
                        </tbody>';
        } elseif ($degree == 'SMK') {
            [$count, $program] = $this->Mdl_index->model_get_smk_list();

            //HEAD
            $value .= '<thead>';
            $value .= '     <tr>';
            $value .= '         <td width="15%" align="center" class="sbold"> Program </td>';
            $value .= '         <td width="15%" align="center" class="sbold"> SubProgram </td>';
            $value .= '         <td width="20%" align="center" class="sbold"> X </td>';
            $value .= '         <td width="20%" align="center" class="sbold"> XI </td>';
            $value .= '         <td width="20%" align="center" class="sbold"> XII </td>';
            $value .= '     </tr>';
            $value .= '</thead>';

            //BODY
            $value .= '<tbody>';
            foreach($program as $program){
                [$x, $xi, $xii] = $this->Mdl_index->model_get_smk_rooms($program->SubProgramID);

                $value .= '     <tr>';
                $value .= '         <td> '.$program->Program.' </td>';
                $value .= '         <td> '.$program->SubProgram.' </td>';
                $value .= '         <td>';
                $value .= '             <span style="padding-left: 1px"> 
                                            <a href="javascript:;" class="sbold new_smk_room" data-class="X" data-subprogram="'.$program->SubProgramID.'" data-numeric="10">
                                                <i class="fa fa-plus font-green-seagreen" style="font-size: 0.8em"></i>
                                            </a> 
                                        </span>&nbsp;';
                                        if(!empty($x)){
                                            foreach($x as $x){
                                                $value .= '<span>';
                                                $value .= ' <a href="javascript:;" class="btn btn-md blue remove_smk_room" data-room="'.$x->RoomDesc.'" style="padding-right: 5px;"> '.substr($x->RoomDesc, -3).'
                                                                &nbsp;&nbsp;<i class="fa fa-times"></i> 
                                                            </a>';
                                                $value .= '</span>';
                                            }
                                        }
                $value .= '          </td>';
                $value .= '         <td>';
                $value .= '             <span style="padding-left: 1px"> 
                                            <a href="javascript:;" class="sbold new_smk_room" data-class="XI" data-subprogram="'.$program->SubProgramID.'" data-numeric="11">
                                                <i class="fa fa-plus font-green-seagreen" style="font-size: 0.8em"></i>
                                            </a>
                                        </span>&nbsp;';
                                        if(!empty($xi)){
                                            foreach($xi as $xi){
                                                $value .= '<span>';
                                                $value .= ' <a href="javascript:;" class="btn btn-md blue remove_smk_room" data-room="'.$xi->RoomDesc.'" style="padding-right: 5px;"> '.substr($xi->RoomDesc, -3).'
                                                                &nbsp;&nbsp;<i class="fa fa-times"></i> 
                                                            </a>';
                                                $value .= '</span>';
                                            }
                                        }
                $value .= '          </td>';
                $value .= '         <td>';
                $value .= '             <span style="padding-left: 1px"> 
                                            <a href="javascript:;" class="sbold new_smk_room" data-class="XII" data-subprogram="'.$program->SubProgramID.'" data-numeric="12">
                                                <i class="fa fa-plus font-green-seagreen" style="font-size: 0.8em"></i>
                                            </a> 
                                        </span>&nbsp;';
                                        if(!empty($xii)){
                                            foreach($xii as $xii){
                                                $value .= '<span>';
                                                $value .= ' <a href="javascript:;" class="btn btn-md blue remove_smk_room" data-room="'.$xii->RoomDesc.'" style="padding-right: 5px;"> '.substr($xii->RoomDesc, -3).'
                                                                &nbsp;&nbsp;<i class="fa fa-times"></i> 
                                                            </a>';
                                                $value .= '</span>';
                                            }
                                        }
                $value .= '          </td>';
            }
            $value .= '</tbody>';
        }

        echo $value;
    }

    public function add_room()
    {
        $degree = $_POST['degree'];
        $cls = $_POST['cls'];
        $num = $_POST['num'];

        $result = $this->Mdl_index->model_add_room($degree, $cls, $num);

        echo $result;
    }

    public function delete_room()
    {
        $room = $_POST['room'];

        if (substr($room, 0, 2) == 'SD' || substr($room, 0, 3) == 'SMP') {
            echo 'abort';
        } else {
            $result = $this->Mdl_index->model_delete_room($room);

            echo $result;
        }
    }

    public function add_smk_room(){
        $cls = $_POST['cls'];
        $subprogram = $_POST['subprogram'];
        $numeric = $_POST['cls_numeric'];

        $result = $this->Mdl_index->model_add_smk_room($cls, $subprogram, $numeric);

        echo $result;
    }

    public function delete_smk_room(){
        $room = $_POST['room'];

        $result = $this->Mdl_index->model_remove_smk_room($room);

        echo $result;
    }

    public function ajax_get_class_full_mid_recap(){
        $room = $_GET['room'];
        $semester = $this->session->userdata('semester');
        $period = $this->session->userdata('period');

        [$head, $result] = $this->Mdl_index->model_get_class_full_mid_recap($room, $semester, $period);
        
        $data = [
            'header' => $head,
            'pivot' => $result
        ];

        echo json_encode($data);
    }

    public function print_recap_mid(){
        $room = $_GET['room'];
        $semester = $this->session->userdata('semester');
        $period = $this->session->userdata('period');

        [$head, $result] = $this->Mdl_index->model_get_class_full_mid_recap($room, $semester, $period);


        $excel = new Spreadsheet();

        $filename = 'MID RECAP ' .$room . ' - ' .date('F-Y').'.xlsx';

        $excel->setActiveSheetIndex(0)->setCellValue('A2', 'No');
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->setActiveSheetIndex(0)->setCellValue('B2', 'NIS');
        $excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $excel->setActiveSheetIndex(0)->setCellValue('C2', 'NAMA');
        $excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('C2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $alp = 'D';
        $i = 1;
        
        foreach($result as $row){
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($i+2), $i);
            $excel->getActiveSheet()->getStyle('A' . ($i+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($i+2), $row->NIS);
            $excel->getActiveSheet()->getStyle('B' . ($i+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($i+2), '  ' . $row->FullName);

            foreach($head as $row2){
                $cur_subj = str_replace(' ','_', $row2->SubjName);
                $excel->setActiveSheetIndex(0)->setCellValue($alp . '2', $row2->SubjName);
                $excel->getActiveSheet()->getStyle($alp . '2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $excel->getActiveSheet()->getColumnDimension($alp)->setWidth(strlen($row2->SubjName)+4);    
                
                $excel->setActiveSheetIndex(0)->setCellValue($alp . ($i+2), $row->{$cur_subj});
                $excel->getActiveSheet()->getStyle($alp . ($i+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                ++$alp;
            }

            $alp = 'D';
            ++$i;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);

        $writer = new Xlsx($excel);
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function ajax_get_class_attendance_recap(){
        $room = $_GET['room'];
        $month = $_GET['month'];
        $semester = $this->session->userdata('semester');
        $period = $this->session->userdata('period');

        [$month_days, $pivot] = $this->Mdl_index->get_class_attendance_recap($room, $month, $semester, $period);

        $data = [
            'header' => $month_days,
            'pivot' => $pivot
        ];

        echo json_encode($data);
    }

    public function print_attendance_recap(){
        $room = $_GET['room'];
        $month = $_GET['month'];
        $semester = $this->session->userdata('semester');
        $period = $this->session->userdata('period');

        [$month_days, $pivot] = $this->Mdl_index->get_class_attendance_recap($room, $month, $semester, $period);

        $alp_month = DateTime::createFromFormat('m', $month)->format('F');


        $excel = new Spreadsheet();

        $filename = 'ATTENDANCE RECAP ' .$room . ' - '. $alp_month .' '.date('Y').'.xlsx';

        $excel->setActiveSheetIndex(0)->setCellValue('A2', 'No');
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
        $excel->setActiveSheetIndex(0)->setCellValue('B2', 'NIS');
        $excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(TRUE);
        $excel->setActiveSheetIndex(0)->setCellValue('C2', 'NAMA');
        $excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(TRUE);

        $alph = 'A';
        $alp = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH'];

        $date_alias = [
            'zero','one','two','three','four','five','six','seven','eight','nine','ten',
            'eleven','twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty',
            'twentyone','twentytwo','twentythree','twentyfour','twentyfive','twentysix','twentyseven','twentyeight','twentynine','thirty','thirtyone'
        ];

        $index = 1;
        
        foreach($pivot as $row){
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($index+2), $index);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($index+2), $row->NIS);
            $excel->getActiveSheet()->getStyle('B' . ($index+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($index+2), '  ' . $row->FullName);

            for($i = 3; $i <= $month_days+2; $i++){
                $excel->setActiveSheetIndex(0)->setCellValue($alp[$i] . '2', $i-2);
                $excel->getActiveSheet()->getStyle($alp[$i] . '2')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle($alp[$i] . '2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                if($row->{$date_alias[$i-2]} == 'Sick'){
                    $attd = 'S';
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->getFont()->setBold(TRUE);
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))
                                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                            ->getStartColor()->setARGB('F4D03F');
                    
                }else if($row->{$date_alias[$i-2]} == 'On Permit'){
                    $attd = 'I';
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->getFont()->setBold(TRUE);
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))
                                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                            ->getStartColor()->setARGB('8E44AD');
                    
                }else if($row->{$date_alias[$i-2]} == 'Absent'){
                    $attd = 'A';
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->getFont()->setBold(TRUE);
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))
                                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                            ->getStartColor()->setARGB('e7505a');
                    
                }else{
                    // $attd = '✓';
                    $attd = '-';
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $excel->getActiveSheet()->getStyle($alp[$i] . ($index+2))
                                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                            ->getStartColor()->setARGB('e1e5ec');
                }
                
                $excel->setActiveSheetIndex(0)->setCellValue($alp[$i] . ($index+2), $attd);

            }

            ++$index;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);


        $writer = new Xlsx($excel);
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    // ==================================================================================================================== \\
    // ==============================                     PROFILE ADMIN CONTROLLER           ============================== \\
    // ==================================================================================================================== \\
    public function load_prof_adm()
    {
        $id = $this->session->userdata('id');

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'table' => $this->Mdl_profile->get_full_info($id)
        ];

        $this->load->view('admin/adm_prof_adm', $data);
    }

    public function update_img_adm()
    {
        $id = $this->uri->segment(3);

        $img_def = 'default.png';
        $img_name = 'img-' . $id . '-adm.jpg';

        $config = [
            'upload_path' => './assets/photos/adm/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'file_name' => $img_name
        ];

        $this->load->library('upload', $config);

        //If there's image for ID already, delete the old one
        if (is_file('./assets/photos/adm/' . $img_name)) {
            unlink('./assets/photos/adm/' . $img_name);
        }

        //If Image has different extension, or no pic uploaded, set to default picture
        //If exist, upload the new picture to the destination
        if (!$this->upload->do_upload('image')) {
            $error_msg = $this->upload->display_errors();

            $this->Mdl_profile->model_upload_img_std($id, $img_def);

            $this->session->set_flashdata('disp_err', $error_msg);

            redirect('Admin/load_prof_adm/' . '#tab_1_2', 'refresh');
        } else {
            // $this->upload->data(); //Upload data to upload_path

            //Compress uploaded image
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/photos/adm/' . $img_name;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 800;
            $config['height'] = 800;
            $config['new_image'] = './assets/photos/adm/' . $img_name;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $this->Mdl_profile->model_upload_img_std($id, $img_name);

            redirect('Admin/load_prof_adm/' . '#tab_1_2', 'refresh');
        }
    }

    // ==================================================================================================================== \\
    // ==============================                     SCHEDULE CONTROLLER                ============================== \\
    // ==================================================================================================================== \\
    public function load_acd_sche()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo')
        ];

        $this->load->view('admin/adm_acd_sch', $data);
    }

    public function get_degrees()
    {
        $result = $this->Mdl_schedule->model_get_degrees();

        $value = '';
        foreach ($result as $result) {
            $color = '';
            switch ($result->School_Desc) {
                case 'SD':
                    $color = 'red';
                    break;
                case 'SMP':
                    $color = 'blue-steel';
                    break;
                case 'SMA':
                    $color = 'grey-silver';
                    break;
                case 'SMK':
                    $color = 'red-haze';
                    break;
            }

            $value .= ' <div class="portlet box ' . $color . '">
                            <div class="portlet-title" style="padding: 1% 5%;">
                                <div class="caption">
                                    ' . $result->School_Desc . ' </div>
                                <div class="tools">
                                    <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body sch_' . strtolower($result->School_Desc) . '_classes" style="display: none; padding: 0px 0px 0px 0px;">
                                <!-- AJAX GOES HERE -->
                            </div>
                        </div>';
        }

        echo $value;
    }

    public function load_acd_sch_edit()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            //Get Data for Every School Level
            'sd_t' => $this->Mdl_schedule->get_sd(),
            'smp_t' => $this->Mdl_schedule->get_smp(),
            'sma_t' => $this->Mdl_schedule->get_sma(),

            'sch_t' => $this->Mdl_schedule->get_sch_info(),

            //Get Dropdown for Modal ADD SCHEDULE
            'class' => $this->Mdl_schedule->get_dropdown_class(),
            'subj' => $this->Mdl_schedule->get_dropdown_subject(null),
            'tch' => $this->Mdl_schedule->get_dropdown_teachers()
        ];

        $this->load->view('admin/adm_acd_sch_edit', $data);
    }

    public function load_classes_sch_sd()
    {
        $sd = $this->Mdl_schedule->get_sd();

        $value = '';

        foreach ($sd as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default detail_sche" data-room="' . $row->RoomDesc . '">CLASS ' . $row->RoomDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_classes_sch_smp()
    {
        $smp = $this->Mdl_schedule->get_smp();

        $value = '';

        foreach ($smp as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default detail_sche" data-room="' . $row->RoomDesc . '">CLASS ' . $row->RoomDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_classes_sch_sma()
    {
        $sma = $this->Mdl_schedule->get_sma();

        $value = '';

        foreach ($sma as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default detail_sche" data-room="' . $row->RoomDesc . '">CLASS ' . $row->RoomDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_classes_sch_smk(){
        $sma = $this->Mdl_schedule->get_smk();

        $value = '';

        foreach ($sma as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default detail_sche" data-room="' . $row->RoomDesc . '">CLASS ' . $row->RoomDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_sche_details()
    {
        //Get Room 
        $room = $this->input->post('room');

        $query = $this->Mdl_schedule->get_schedule_full($room)->result();

        $level = $this->Mdl_schedule->model_get_room_level($room);

        //For checking if Schedule is empty, show clear button
        $schedule = $this->Mdl_schedule->get_sche_roominfo($room);

        //Additional info besides Schedule's Table
        $count = $this->Mdl_schedule->get_class_info($room);
        $chief = $this->Mdl_schedule->get_sche_chief($room);
        $homeroom = $this->Mdl_schedule->get_homeroom($room);

        if ($query) {
            $value = '';
            $value .= '<div class="row">';
            $value .= '     <div class="col-sm-9">';
            $value .= '         <div class="portlet light portlet-fit" style="margin-bottom: 0px;padding-left: 0px;">';
            $value .= '             <div class="portlet-title" style="padding-left: 40px;padding-top: 0px;border-bottom: 0px;margin-bottom: 0px;">';
            $value .= '                 <div class="caption">';
            $value .= '                     <i class="fa fa-calendar font-red font-red"></i>';
            $value .= '                     <span class="caption-subject font-red sbold uppercase" data-degree="' . $level . '" data-room="' . $room . '">&nbsp;SCHEDULE CLASS: ' . $room . '</span>';
            $value .= '                 </div>';
            $value .= '                 <div style="float: right">';
            $value .= '                     <button type="button" class="btn green-jungle btn-circle text-center add_sche" data-toggle="tooltip" data-placement="bottom" title="Add new subject" data-room="' . $room . '" data-toggle="modal" href="new-sch">
                                                <icon class="fa fa-plus"/>
                                            </button>';
            if (!empty($schedule->RoomDesc)) {
                $value .= '                 <button type="button" class="btn btn-circle btn-danger text-center delete_sche" data-toggle="tooltip" data-placement="bottom" title="Clear Schedule" data-room="' . $room . '">
                                                <icon class="fa fa-times"/>
                                            </button>';
            }
            $value .= '                 </div>';
            $value .= '             </div>';
            $value .= '             <div class="portlet-body" style="padding-top: 0px;padding-bottom: 0px;">';
            $value .= '                 <div class="table-responsive">';
            $value .= '                     <table class="table table-light">';
            $value .= '                         <thead>';
            $value .= '                             <tr class="uppercase text-justify">';
            $value .= '                                 <th class="text-center" style="min-width: 20px; border-bottom: 0"> Hour </th>';
            $value .= '                                 <th class="text-center" style="max-width: 80px; border-bottom: 0"> Monday </th>';
            $value .= '                                 <th class="text-center" style="max-width: 80px; border-bottom: 0"> Tuesday </th>';
            $value .= '                                 <th class="text-center" style="max-width: 80px; border-bottom: 0"> Wednesday </th>';
            $value .= '                                 <th class="text-center" style="max-width: 80px; border-bottom: 0"> Thursday </th>';
            $value .= '                                 <th class="text-center" style="max-width: 80px; border-bottom: 0"> Friday </th>';
            $value .= '                             </tr>';
            $value .= '                         </thead>';
            $value .= '                         <tbody>';
            foreach ($query as $row) {
                $value .= '                         <tr>';
                if ($row->Start != NULL && $row->Finish != NULL) {
                    $value .= '                         <td style="border-bottom: 0px;" class="text-center"> 
                                                            <a class="btn_edit_hour" data-toggle="tooltip" title="Edit Hour" style="font-size: 100%;" data-start="' . $row->Start . '" data-finish="' . $row->Finish . '" data-room="' . $room . '">
                                                                ' . $row->Start . ' - ' . $row->Finish . ' 
                                                            </a>
                                                        </td>';
                }
                if ($row->Mon != NULL) {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"> <a class="btn_edit_sch" data-day="Senin" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Mon . '"> ' . $row->Mon . ' </a>';
                        if(strtolower($row->Mon) == 'elective' || strtolower($row->Mon) == 'excul'){
                            $value .=                        '<button class="btn btn-xs btn_edit_nonregular" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Senin" data-room="' . $room . '" data-hour="' . $row->Start . '" data-type="'.$row->Mon.'">
                                                                <i class="glyphicon glyphicon-edit"/>
                                                            </button';
                        }
                    $value .= '                         </td>';
                } else {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"></td>';
                }
                if ($row->Tue != NULL) {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"> <a class="btn_edit_sch" data-day="Selasa" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Tue . '"> ' . $row->Tue . ' </a>';
                        if(strtolower($row->Tue) == 'elective' || strtolower($row->Tue) == 'excul'){
                            $value .=                        '<button class="btn btn-xs btn_edit_nonregular" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Selasa" data-room="' . $room . '" data-hour="' . $row->Start . '" data-type="'.$row->Tue.'">
                                                                <i class="glyphicon glyphicon-edit"/> 
                                                            </button>';
                        }
                    $value .= '                         </td>';
                } else {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"></td>';
                }
                if ($row->Wed != NULL) {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"> <a class="btn_edit_sch" data-day="Rabu" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Wed . '"> ' . $row->Wed . ' </a>';
                        if(strtolower($row->Wed) == 'elective' || strtolower($row->Wed) == 'excul'){
                            $value .=                        '<button class="btn btn-xs btn_edit_nonregular" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Rabu" data-room="' . $room . '" data-hour="' . $row->Start . '" data-type="'.$row->Wed.'">
                                                                <i class="glyphicon glyphicon-edit"/> 
                                                            </button>';
                        }
                    $value .= '                         </td>';
                } else {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"></td>';
                }
                if ($row->Thu != NULL) {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"> <a class="btn_edit_sch" data-day="Kamis" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Thu . '"> ' . $row->Thu . ' </a>';
                        if(strtolower($row->Thu) == 'elective' || strtolower($row->Thu) == 'excul'){
                            $value .=                        '<button class="btn btn-xs btn_edit_nonregular" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Kamis" data-room="' . $room . '" data-hour="' . $row->Start . '" data-type="'.$row->Thu.'">
                                                                <i class="glyphicon glyphicon-edit"/> 
                                                            </button>';
                        }
                    $value .= '                         </td>';
                } else {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"></td>';
                }
                if ($row->Fri != NULL) {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"> <a class="btn_edit_sch" data-day="Jumat" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Fri . '"> ' . $row->Fri . ' </a>';
                        if(strtolower($row->Fri) == 'elective' || strtolower($row->Fri) == 'excul'){
                            $value .=                        '<button class="btn btn-xs btn_edit_nonregular" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Jumat" data-room="' . $room . '" data-hour="' . $row->Start . '" data-type="'.$row->Fri.'">
                                                                <i class="glyphicon glyphicon-edit"/> 
                                                            </button>';
                        }
                    $value .= '                         </td>';
                } else {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"></td>';
                }
                // if ($row->Sat != NULL) {
                //     $value .= '                         <td style="border-bottom: 0px; max-width: 45px; padding-left: 0px;" class="text-center"> ' . $row->Sat . '
                //                                             <button class="btn btn-xs btn_edit_sch" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Sabtu" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Sat . '">
                //                                                 <i class="glyphicon glyphicon-edit"/>
                //                                             </button> 
                //                                         </td>';
                // } else {
                //     $value .= '                         <td style="border-bottom: 0px; max-width: 45px; padding-left: 0px;" class="text-center"></td>';
                // }
                $value .= '                         <td style="border-bottom: 0px; max-width: 45px; padding-left: 0px;" class="text-center"></td>';
                $value .= '                         </tr>';
            }
            $value .= '                         </tbody>';
            $value .= '                     </table>';
            $value .= '                 </div>';
            $value .= '             </div>';
            $value .= '         </div>';
            $value .= '     </div>';
        } else {
            $value  = '';
            $value .= ' <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">';
            $value .= '     <div class="row">';
            $value .= '         <div class="col-sm-7">
                                    <div class="portlet light portlet-fit">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-calendar font-red font-red"></i>
                                                <span class="caption-subject font-red sbold uppercase">&nbsp;SCHEDULE CLASS: ' . $room . '</span>
                                            </div>';
            if (!empty($schedule->RoomDesc)) {
                $value .= '                 <button type="button" class="btn btn-success text-center add_sche" style="max-height: 50px; min-width: 80px;" data-room="' . $room . '" data-toggle="modal" href="new-sch">
                                                Add
                                            </button>';
                $value .=  '                <button type="button" class="btn btn-danger text-center delete_sche" style="max-height: 50px; min-width: 80px;" data-room="' . $room . '">
                                                Clear
                                            </button>';
            }
            $value .= '                 </div>
                                        <div class="portlet-body">
                                            <div class="table-responsive">
                                                <table class="table table-light">
                                                    <thead>
                                                        <tr class="uppercase text-center">
                                                            <th class="text-center" style="min-width: 20px; border-bottom: 0"> Hour </th>
                                                            <th style="min-width: 20px; border-bottom: 0"> Monday </th>
                                                            <th style="min-width: 20px; border-bottom: 0"> Tuesday </th>
                                                            <th style="min-width: 20px; border-bottom: 0"> Wednesday </th>
                                                            <th style="min-width: 20px; border-bottom: 0"> Thursday </th>
                                                            <th style="min-width: 20px; border-bottom: 0"> Friday </th>
                                                        </tr>
                                                        <td class="text-center" colspan="7">
                                                            <p class="font font-weight-bold"> PLEASE SET THE HOUR BEFORE ADDING A NEW SCHEDULE </p>
                                                        </td>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
        }
        $value .= '             <div class="col-sm-3">
                                    <div class="row">
                                        <div class="portlet light portlet-fit">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-user font-red font-red"></i>
                                                    <span class="caption-subject font-red sbold uppercase">Class Detail: ' . $room . '</span>
                                                 </div>
                                            </div>
                                            <div class="portlet-body">
                                                <table class="table table-hover table-light" style="padding-left: 20%; padding-right: 20%;;">
                                                    <thead>';
        $value .= '                                     <tr>
                                                            <th class="uppercase" style="width: 35%; border-bottom: 0px;"> Total Students </th>
                                                            <td style="border-top: 0px;"> ' . $count->Total . ' </td>
                                                        </tr>';
        if (!empty($chief)) {
            $value .= '                                 <tr>
                                                            <th class="uppercase" style="border-bottom: 0px;"> Class Leader </th>
                                                            <td style="border-top: 0px;"> ' . $chief->Student . ' </td>
                                                            </tr>';
        } else {
            $value .= '                                 <tr>
                                                            <th class="uppercase" style="border-bottom: 0px"> Class Leader </th>
                                                            <td style="border-top: 0px;"> None </td>
                                                        </tr>';
        }
        if (!empty($homeroom)) {
            $value .= '                                 <tr>
                                                            <th class="uppercase" style="border-bottom: 0px"> Homeroom Teacher </th>
                                                            <td style="border-top: 0px;"> ' . $homeroom->Teacher . ' </td>
                                                        </tr>';
        } else {
            $value .= '                                 <tr>
                                                            <th class="uppercase" style="border-bottom: 0px"> Homeroom Teacher </th>
                                                            <td style="border-top: 0px;"> None </td>
                                                        </tr>';
        }
        $value .= '                                 </thead>
                                                </table>
                                            </div>
                                        </div>';
        $value .= '                 </div>
                                </div>';
        $value .= '         </div>';

        echo $value;
    }

    public function sv_hour_config()
    {
        $hlevel = $_POST['hlevel'];

        $hstart = $_POST['hstart'];
        $brief = date('H:i', strtotime("+15 minutes", strtotime($hstart)));

        $afterbrief = $brief;
        $numclass = $_POST['hourperday'] - 4;
        $hinterval = $_POST['hinterval'];

        $preset = $_POST['preset'];


        $break1 = $_POST['break1'] + 1;
        $break1interval = $_POST['break1interval'];
        $caregroup = $_POST['caregroup'];
        $caregroupinterval = $_POST['caregroupinterval'];
        $break2 = $_POST['break2'] + 1;
        $break2interval = $_POST['break2interval'];
        $exculinterval = $_POST['exculinterval'];

        $hours = [date('H:i:s', strtotime($hstart)), date('H:i:s', strtotime($afterbrief))];

        for ($i = 1; $i <= $numclass; $i++) {
            if ($preset == 'ON') {
                if ($i == $break1 && $caregroup == 'after') {
                    $break = date('H:i:s', strtotime("+$break1interval minutes", strtotime($afterbrief)));
                    $care = date('H:i:s', strtotime("+$caregroupinterval minutes", strtotime($break)));

                    array_push($hours, $break, $care);
                    $afterbrief = $care;
                } elseif ($i == $break1 && $caregroup == 'before') {
                    $care = date('H:i:s', strtotime("+$caregroupinterval minutes", strtotime($afterbrief)));
                    $break = date('H:i:s', strtotime("+$break1interval minutes", strtotime($care)));

                    array_push($hours, $care, $break);
                    $afterbrief = $break;
                }

                if ($i == $break2) {
                    $afterbrief = date('H:i:s', strtotime("+$break2interval minutes", strtotime($afterbrief)));

                    array_push($hours, $afterbrief);
                }
            }

            $afterbrief = date('H:i:s', strtotime("+$hinterval minutes", strtotime($afterbrief)));

            $hours[] = $afterbrief;
        }

        $hours[] = date('H:i:s', strtotime("+$exculinterval minutes", strtotime($afterbrief)));

        $query = $this->Mdl_schedule->modal_sv_hconfig($hlevel, $hours);

        if ($query == 'false') {
            echo 'false';
        } else {
            echo json_encode($hours);
        }
    }

    public function get_decrease_minute()
    {
        $start = strtotime($_POST['current']);
        $finish = strtotime($_POST['finish']);

        $interval = ($start - $finish) / 60;

        $total = abs($interval) - 5;

        $value = '';
        $value .= '<select class="form-control edited interval" id="form_control_1">';
        $value .= '<option value="" selected>by...</option>';
        for ($i = 5; $i <= $total; $i += 5) {
            $value .= '<option value="' . $i . '"> ' . $i . ' Minutes </option>';
        }
        $value .= '</select>';

        echo $value;
    }

    public function sv_new_curhour()
    {
        $data = [
            'room' => $_POST['room'],
            'current' => $_POST['cur'],
            'type' => $_POST['type'],
            'interval' => $_POST['interval'],
        ];

        $this->Mdl_schedule->model_sv_new_curhour($data);

        echo json_encode($data['current']);
    }

    public function reset_hcon()
    {
        $level = $_POST['level'];

        $result = $this->Mdl_schedule->model_reset_hcon($level);

        echo $result;
    }

    public function get_full_tbl_session()
    {
        $result = $this->Mdl_schedule->modal_get_full_tbl_session();

        extract($result);

        $i = 1;
        $j = 1;
        $k = 1;
        $l = 1;

        $regular = '';
        foreach ($reg as $row) {
            $regular .= '<tr>
                            <td> ' . $i . ' </th>
                            <td name="code" contenteditable="true" data-field="SubjID" data-cur="' . $row->SubjID . '">' . $row->SubjID . '</th>
                            <td name="subj" contenteditable="true" data-field="SubjName" data-cur="' . $row->SubjName . '">' . $row->SubjName . '</th>
                            <td name="degree" contenteditable="true" data-subj="'.$row->SubjID.'" data-field="Degree" data-cur="' . $row->Degree . '">' . $row->Degree . '</th>
                            <td>
                                <a href="javascript:;" data-subj="' . $row->SubjName . '" class="btn btn-icon-only red del_sess">
                                    <i class="fa fa-times"></i>
                                </a> 
                            </td>
                         </tr>';

            $i++;
        }

        $elective = '';
        foreach ($elc as $row) {
            $elective .= '<tr>
                            <td> ' . $j . ' </th>
                            <td name="code" contenteditable="true" data-field="SubjID" data-cur="' . $row->SubjID . '">' . $row->SubjID . '</th>
                            <td name="subj" contenteditable="true" data-field="SubjName" data-cur="' . $row->SubjName . '">' . $row->SubjName . '</th>
                            <td name="degree" contenteditable="true" data-subj="'.$row->SubjID.'" data-field="Degree" data-cur="' . $row->Degree . '">' . $row->Degree . '</th>
                            <td>
                                <a href="javascript:;" data-subj="' . $row->SubjName . '" class="btn btn-icon-only red del_sess">
                                    <i class="fa fa-times"></i>
                                </a> 
                            </td>
                          </tr>';

            $j++;
        }

        $excul = '';
        foreach ($exc as $row) {
            $excul .= ' <tr>
                            <td> ' . $k . ' </th>
                            <td name="code" contenteditable="true" data-field="SubjID" data-cur="' . $row->SubjID . '">' . $row->SubjID . '</th>
                            <td name="subj" contenteditable="true" data-field="SubjName" data-cur="' . $row->SubjName . '">' . $row->SubjName . '</th>
                            <td name="degree" contenteditable="true" data-subj="'.$row->SubjID.'" data-field="Degree" data-cur="' . $row->Degree . '">' . $row->Degree . '</th>
                            <td>
                                <a href="javascript:;" data-subj="' . $row->SubjName . '" class="btn btn-icon-only red del_sess">
                                    <i class="fa fa-times"></i>
                                </a> 
                            </td>
                        </tr>';

            $k++;
        }

        $nonsubj = '';
        foreach ($non as $row) {
            $nonsubj .= '<tr>
                            <td> ' . $l . ' </th>
                            <td name="code" contenteditable="true" data-field="SubjID" data-cur="' . $row->SubjID . '">' . $row->SubjID . '</th>
                            <td name="subj" contenteditable="true" data-field="SubjName" data-cur="' . $row->SubjName . '">' . $row->SubjName . '</th>
                            <td name="degree" contenteditable="true" data-subj="'.$row->SubjID.'" data-field="Degree" data-cur="' . $row->Degree . '">' . $row->Degree . '</th>
                            <td>
                                <a href="javascript:;" data-subj="' . $row->SubjName . '" class="btn btn-icon-only red del_sess">
                                    <i class="fa fa-times"></i>
                                </a> 
                            </td>
                         </tr>';

            $l++;
        }

        $response = [
            'reg' => $regular,
            'elc' => $elective,
            'exc' => $excul,
            'non' => $nonsubj
        ];

        echo JSON_ENCODE($response);
    }

    public function sv_new_session()
    {
        $type = $_POST['type'];
        $code = $_POST['code'];
        $name = $_POST['name'];
        $degree = $_POST['degree'];

        $result = $this->Mdl_schedule->model_sv_new_session($type, $code, $name, $degree);

        echo $result;
    }

    public function edit_session()
    {
        $field = $_POST['field'];
        $old = $_POST['old'];
        $new = $_POST['newv'];
        $subj = $_POST['subj'];

        $result = $this->Mdl_schedule->model_edit_session($field, $old, $new, $subj);

        echo $result;
    }

    public function det_session()
    {
        $subj = $_POST['subjname'];

        $result = $this->Mdl_schedule->model_det_session($subj);

        echo $result;
    }

    public function load_add_sch()
    {
        //Get Dropdown for Modal ADD SCHEDULE
        $room = $_POST['room'];

        $query = $this->Mdl_schedule->check_students($room);
        $subj = $this->Mdl_schedule->get_dropdown_subject($room);
        $tch = $this->Mdl_schedule->get_dropdown_teachers();

        $h = $this->Mdl_schedule->get_dropdown_hour($room);

        if ($query > 0) {
            $value = '';
            $value = '<div class="row" style="padding-top: 20px; padding-bottom: 20px;">
                      <div class="col-sm-12">';
            $value .= '<div class="form-group">
                                <label class="control-label col-md-3">Class<span style="color: red">*</span></label>
                                <div class="col-md-9">
                                    <select name="room" class="form-control" readonly>';
            $value .=                  '<option id="room" value="' . $room . '">' . $room . '</option>';
            $value .= '             </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-md-3">Day<span style="color: red">*</span></label>
                                <div class="col-md-9">
                                    <select name="day" class="form-control">
                                        <option value=""> -- Choose -- </option>
                                        <option id="day" value="Senin"> Monday </option>
                                        <option id="day" value="Selasa"> Tuesday </option>
                                        <option id="day" value="Rabu"> Wednesday </option>
                                        <option id="day" value="Kamis"> Thursday </option>
                                        <option id="day" value="Jumat"> Friday </option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-md-3">Hour<span style="color: red">*</span></label>
                                <div class="col-md-9">
                                    <select name="hour" class="form-control">';
            foreach ($h as $hrow) {
                $value .= '             <option id="hour" value="' . $hrow->Hour . '"> ' . date('H:i', strtotime($hrow->Hour)) . ' </option>';
            }

            $value .= '             </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-md-3">Subject<span style="color: red">*</span></label>
                                <div class="col-md-4">
                                    <select name="type" class="form-control">
                                        <option value="Regular"> Regular </option>
                                        <option value="Elective"> Elective </option>
                                        <option value="Excul"> Excul </option>
                                        <option value="Non-Subject"> Non Subject </option>
                                    </select>
                                </div>
                                <div class="col-md-5 dd_subj">
                                    <select name="subj" class="form-control">';
            foreach ($subj as $row) {
                $value .=   '           <option id="subj" value="' . $row->SubjName . '">' . $row->SubjName . '</option>';
            }
            $value .=   '           </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group teacher">
                                <label class="control-label col-md-3">Teacher<span style="color: red">*</span></label>
                                <div class="col-md-9">
                                    <select name="teacher" class="form-control">';
            if ($tch) {
                foreach ($tch as $row) {
                    $value .=    '          <option id="teacher" data-name="' . $row->FullName . '" value="' . $row->IDNumber . '">' . $row->FullName . '</option>';
                }
            } else {
                $value .=    '          <option id="teacher" selected="selected"> No Teacher in Database </option>';
            }

            $value .=   '           </select>
                                </div>
                            </div>
                            <br class="teacher">
                            <br class="teacher">
                            <div class="form-group">
                                <label class="control-label col-md-3">Note</label>
                                <div class="col-md-9">
                                    <textarea id="note" name="note" class="form-control" style="max-width: 125%; min-width: 92%;" rows="3" placeholder="Catatan" value="-"></textarea>
                                </div>
                            </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn green bg-green submit_new_sche" style="min-width: 85px;">Add</button>
                                <button type="button" class="btn danger" data-dismiss="modal" style="min-width: 85px;">Cancel</button>
                            </div>';
        } else {
            $value = '';
            $value .= 'no_students';
            // $value .= '<div class="modal-body">
            //             <div class="col-sm-12">';
            // $value .= '      <h2 class="text-center display-5"> THIS CLASS HAS NO STUDENTS YET </h2>';
            // $value .= '  </div>
            //           </div>';
            // $value .= '<div class="modal-footer">
            //             <button type="button" class="btn danger" data-dismiss="modal" style="min-width: 85px; margin-top: 35px;"> Close </button>
            //           </div>';
        }


        echo $value;
    }

    public function load_unpicked_hour()
    {
        $room = $_POST['room'];
        $day = $_POST['day'];

        $hour = $this->Mdl_schedule->getNonCollideDate($room, $day);
        $last = $hour->last_row();

        $value = '';
        $value .= '<select name="hour" class="form-control">';

        //Show time only when it's unoccupied and exclude the last one
        foreach ($hour->result() as $row) {
            if ($row->Hour != $last->Hour) {
                $value .= '<option id="hour" value="' . $row->Hour . '"> ' . date('H:i', strtotime($row->Hour)) . ' </option>';
            } elseif (empty($hour)) {
                $value .= '<option id="hour" value="' . $row->Hour . '"> No Session Available </option>';
            }
        }

        echo $value;
    }

    public function get_session_type()
    {
        $type = $_POST['type'];

        $query = $this->Mdl_schedule->modal_get_session_type($type);

        $value = '';

        if ($query->num_rows() < 1) {
            $value .= ' <select name="subj" class="form-control">
                            <option> - </option>
                        </select>';
        } elseif ($type == '') {
            $value .= ' <select name="subj" class="form-control">
                            <option value="-"> --Choose-- </option>
                        </select>';
        } else {
            $value .= '<select name="subj" class="form-control">';
            $value .= '         <option id="subj" value="-"> - </option>';
            foreach ($query->result() as $row) {
                $value .= '     <option id="subj" value="' . $row->SubjName . '"> ' . $row->SubjName . ' </option>';
            }
            $value .= '</select>';
        }

        echo $value;
    }

    public function check_teacher_avail()
    {
        $day = $_POST['day'];
        $hour = $_POST['hour'];
        $teacher = $_POST['teacher'];

        $query = $this->Mdl_schedule->modal_check_teacher_avail($day, $hour, $teacher);

        if ($query == 'proceed') {
            echo $query;
        }

        //echo $day . ' ' . $hour . ' ' . $teacher;
    }

    public function save_add_sch()
    {
        $new = [
            'room' => $_POST['room'],
            'day' => $_POST['day'],
            'hour' => $_POST['hour'],
            'type' => $_POST['type'],
            'subj' => $_POST['subj'],
            'teacher' => $_POST['teacher'],
            'note' => $_POST['note']
        ];

        $result = $this->Mdl_schedule->model_add_sch($new);

        echo $result;
    }

    //LOAD AJAXK FOR DISPLAYING EDIT MENU (MODAL)
    public function load_edit_sch()
    {
        $room = $_POST['room'];
        $day = $_POST['day'];
        $hour = date('H:i:s', strtotime($_POST['hour']));

        //GET SELECTED SCHEDULE DATA
        $data = $this->Mdl_schedule->get_sche_data($day, $room, $hour);

        $type = $data->Type;

        //GET DROPDOWN FOR MODAL ADD SCHEDULE
        $session = $this->Mdl_schedule->get_dropdown_session();
        $subj = $this->Mdl_schedule->get_dropdown_edit_subject($type);
        $tch = $this->Mdl_schedule->get_dropdown_teachers();

        $value = '';
        $value .= '<div class="form-group">
                        <label class="control-label col-md-3">Room<span style="color: red">*</span></label>
                            <div class="col-md-9">
                                <select name="room" class="form-control" readonly>';
        $value .=                  '<option id="room" value="' . $room . '">' . $room . '</option>';
        $value .= '             </select>
                                <!-- <span class="help-block"> This is inline help </span> -->
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3">Day<span style="color: red">*</span></label>
                            <div class="col-md-9">
                                <select name="day" class="form-control" readonly>
                                    <option> ' . $day . ' </option>
                                </select>
                                <!-- <span class="help-block"> This is inline help </span> -->
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3">Hour<span style="color: red">*</span></label>
                            <div class="col-md-9">
                                <select name="hour" class="form-control" readonly>
                                    <option> ' . date('H:i', strtotime($hour)) . ' </option>
                                </select>
                                <!-- <span class="help-block"> This is inline help </span> -->
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3">Subject<span style="color: red">*</span></label>
                            <div class="col-md-4">
                                    <select name="type" class="form-control">';
        foreach ($session as $row) {
            if ($row->Type == $data->Type) {
                $value .=   '           <option id="type" value="' . $row->Type . '" selected>' . $row->Type . '</option>';
            } else {
                $value .=   '           <option id="type" value="' . $row->Type . '">' . $row->Type . '</option>';
            }
        }
        $value .= '                  </select>
                                </div>
                            <div class="col-md-5">
                                <select name="subj" class="form-control">';
        foreach ($subj as $row) {
            if ($row->SubjName == $data->SubjName) {
                $value .=   '       <option id="subj" value="' . $row->SubjName . '" selected>' . $row->SubjName . '</option>';
            } else {
                $value .=   '       <option id="subj" value="' . $row->SubjName . '">' . $row->SubjName . '</option>';
            }
        }
        $value .=   '           </select>
                            </div>
                        </div>
                        <br>
                        <br>';

        if ($data->Type == 'Regular') {
            $value .= '     <div class="form-group teacher">
                                <label class="control-label col-md-3">Teacher<span style="color: red">*</span></label>
                                    <div class="col-md-9">
                                        <select name="teacher" class="form-control">';
            if ($tch) {
                foreach ($tch as $row) {
                    if ($row->FullName == $data->TeacherName) {
                        $value .= '         <option id="teacher" value="' . $row->IDNumber . '" selected>' . $row->FullName . '</option>';
                    } else {
                        $value .= '         <option id="teacher" value="' . $row->IDNumber . '">' . $row->FullName . '</option>';
                    }
                }
            } else {
                $value .=    '              <option id="teacher" selected> No Teacher in Database </option>';
            }
            $value .=   '               </select>
                                    <!-- <span class="help-block"> This is inline help </span> -->
                                </div>
                            </div>
                            <br class="teacher">
                            <br class="teacher">';
        } else {
            $value .= '     <div class="form-group teacher" style="display: none">
                                <label class="control-label col-md-3">Teacher<span style="color: red">*</span></label>
                                    <div class="col-md-9">
                                        <select name="teacher" class="form-control">';
            if ($tch) {
                foreach ($tch as $row) {
                    if ($row->FullName == $data->TeacherName) {
                        $value .= '         <option id="teacher" value="' . $row->IDNumber . '" selected>' . $row->FullName . '</option>';
                    } else {
                        $value .= '         <option id="teacher" value="' . $row->IDNumber . '">' . $row->FullName . '</option>';
                    }
                }
            } else {
                $value .=    '              <option id="teacher" selected> No Teacher in Database </option>';
            }
            $value .=   '               </select>
                                    <!-- <span class="help-block"> This is inline help </span> -->
                                </div>
                            </div>
                            <br class="teacher" style="display: none">
                            <br class="teacher" style="display: none">';
        }
        $value .= '     <div class="form-group">
                            <label class="control-label col-md-3">Note</label>
                            <div class="col-md-9">
                                <textarea id="note" name="note" class="form-control" style="max-width: 125%; min-width: 92%;" rows="3">' . $data->Note . '</textarea>
                            </div>
                        </div>';

        echo $value;
    }

    public function save_sche_update()
    {
        $ref = [
            'room' => $_POST['upd_room'],
            'day' => $_POST['upd_day'],
            'hour' => date('H:i:s', strtotime($_POST['upd_hour'])),
            'type' => $_POST['upd_type'],
            'subj' => $_POST['upd_subj'],
            'teacher' => $_POST['upd_teacher'],
            'note' => $_POST['upd_note'],
        ];

        $result = $this->Mdl_schedule->model_upd_sch($ref);

        if ($result == 'success') {
            echo $result;
        } elseif ($result == 'unproceed') {
            echo $result;
        } else {
            echo 'error';
        }
    }

    public function delete_sche()
    {
        $room = $this->input->post('room');

        $result = $this->Mdl_schedule->model_delete_sche($room);

        if ($result) {
            echo "DELETED";
        } else {
            echo "SOMETHING'S WRONG";
        }
    }

    //AJAX NON-REGULAR 
    public function ajax_get_nonregular_subject(){
        $room = $_POST['room'];
        $type = $_POST['type'];
        $day = $_POST['day'];
        $hour = $_POST['hour'];

        [$subjects, $teacher, $list] = $this->Mdl_schedule->get_nonregular_subject($room, $type, $day, $hour);
             
        $v_list = '';
        $v_subj = '<option value=""> Select Subject </option>';
        $v_teacher = '<option value=""> Select Teacher </option>';

        if($list){
            foreach($list as $list){
                $v_list .= '<div data-repeater-list="group-c">';
                $v_list .= '    <div data-repeater-item class="mt-repeater-item">';
                $v_list .= '        <div class="row mt-repeater-row">';
                $v_list .= '            <label class="col-md-4 control-label"></label>';
                $v_list .= '            <div class="col-md-8">';
                $v_list .= '                <div class="col-md-5" style="padding-right: 0px">';
                $v_list .= '                    <label class="control-label">Subject</label>';
                $v_list .= '                    <select type="text" name="assign_subject" class="form-control subject_repeater" required> ';
                $v_list .= '                        <option value="'.$list->SubjName.'" selected>'.$list->SubjName.'</option>';
                $v_list .= '                    </select>';
                $v_list .= '                </div>';
                $v_list .= '                <div class="col-md-5" style="padding-right: 0px">';
                $v_list .= '                    <label class="control-label">Teacher</label>';
                $v_list .= '                    <select type="text" name="assign_teacher" class="form-control teacher_repeater" required> ';
                $v_list .= '                        <option value="'.$list->IDNumber.'" selected>'.$list->TeacherName.'</option>';
                $v_list .= '                    </select>';
                $v_list .= '                </div>';
                $v_list .= '                <div class="col-md-1">';
                $v_list .= '                    <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete listed_subj" 
                                                    data-subj="'.$list->SubjName.'"
                                                    data-id="'.$list->IDNumber.'"
                                                    data-semester="'.$list->semester.'"
                                                    data-period="'.$list->schoolyear.'"
                                                    data-room="'.$list->RoomDesc.'" 
                                                    data-hour="'.$list->Hour.'"
                                                    data-day="'.$list->Days.'"
                                                    data->';
                $v_list .= '                        <i class="fa fa-close"></i>';
                $v_list .= '                    </a>';
                $v_list .= '                </div>';
                $v_list .= '            </div>';
                $v_list .= '        </div>';
                $v_list .= '    </div>';
                $v_list .= '</div>';
            }
        }

        foreach($subjects as $subj){
            $v_subj .= '<option value="'.$subj->SubjName.'"> '. $subj->SubjName .' </option>';
        }

        foreach($teacher as $teach){
            $v_teacher .= '<option value="'.$teach->IDNumber.'"> '. $teach->FullName .' </option>';
        }

        $data = [
            'subj' => $v_subj,
            'teacher' => $v_teacher,
            'list' => $v_list
        ];

        echo json_encode($data);
    }

    public function ajax_submit_nonregular(){
        $assign_room = $_POST['assign_room'];
        $assign_type = $_POST['assign_type'];
        $assign_day = $_POST['assign_day'];
        $assign_hour = $_POST['assign_hour'];
        $subjects = $_POST['group-c'];

        $result = $this->Mdl_schedule->submit_nonregular($assign_room, $assign_type, $assign_day, $assign_hour, $subjects);

        echo $result;
    }

    public function ajax_delete_nonregular(){
        $subj = $_POST['subj'];
        $room = $_POST['room'];
        $semester = $_POST['semester'];
        $period = $_POST['period'];
        $hour = $_POST['hour'];
        $day = $_POST['day'];

        $result = $this->Mdl_schedule->delete_nonregular($subj, $room, $semester, $period, $hour, $day);

        echo $result;
    }

    // ==================================================================================================================== \\
    // ==============================                     STUDENT GRADES CONTROLLER          ============================== \\
    // ==================================================================================================================== \\
    public function load_acd_grde()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'rooms' => $this->Mdl_grade->get_active_rooms(),
            'rooms_voc' => $this->Mdl_grade->get_active_rooms_voc(),

            //Period (Semester List) for all Modal
            'period' => $this->Mdl_grade->get_period(),

            //For Modal Material (KD)
            'class' => $this->Mdl_grade->get_active_classes(),
            'subject' => $this->Mdl_grade->get_dd_subjects(),

            //For Modal Grade Option
            'degree' => $this->Mdl_grade->get_active_degree(),

            //For Character Table
            'social' => $this->Mdl_grade->get_social_desc(),
            'spirit' => $this->Mdl_grade->get_spirit_desc()
        ];

        $this->load->view('admin/adm_acd_grde', $data);
    }

    public function get_active_degrees_grade()
    {
        $result = $this->Mdl_grade->model_get_degrees();

        $value = '';
        foreach ($result as $result) {
            $color = '';
            switch ($result->School_Desc) {
                case 'SD':
                    $color = 'red';
                    break;
                case 'SMP':
                    $color = 'blue-steel';
                    break;
                case 'SMA':
                    $color = 'grey-silver';
                    break;
                case 'SMK':
                    $color = 'red-haze';
                    break;
            }

            $value .= ' <div class="portlet box ' . $color . '">
                            <div class="portlet-title" style="padding: 1% 5%;">
                                <div class="caption">
                                ' . $result->School_Desc . ' </div>
                                <div class="tools">
                                    <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body ' . strtolower($result->School_Desc) . '_classes" style="display: none; padding: 0px 0px 0px 0px;">
                                <!-- AJAX GOES HERE -->
                            </div>
                        </div>';
        }

        echo $value;
    }

    public function get_table_by_subjects()
    {
        $result = $this->Mdl_grade->model_get_table_by_subjects();

        $value = '';
        $value .= ' <div class="portlet-title" style="border-bottom: 0px;">
                        <div class="caption font-red-sunglo">
                            <i class="icon-share font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase port-title">&nbsp;DETAIL BY SUBJECTS </span>
                            <!-- <span class="caption-helper">monthly stats...</span> -->
                        </div>
                    </div>';
        $value .= ' <div class="portlet-body portlet_subcls">
                        <div class="table-responsive table-hover tbl_cls">
                            <table class="table table_subject_kd">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> CODE </th>
                                        <th> Subject </th>
                                        <th> Subject Type </th>
                                        <th> Degree </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                </tbody>';
        $index = 1;
        foreach ($result as $row) {
            $value .= '             <tr>';
            $value .= '                 <td> ' . $index . ' </td>';
            $value .= '                 <td> ' . $row->SubjID . ' </td>';
            $value .= '                 <td> ' . $row->SubjName . ' </td>';
            $value .= '                 <td> ' . $row->Type . ' </td>';
            $value .= '                 <td> ' . $row->Degree . ' </td>';
            $value .= '                 <td> 
                                            <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_grade" data-degree="'.$row->Degree.'" data-subject="' . $row->SubjName . '" data-type="cognitive" style="min-width: 100px"> 
                                                <i class="fa fa-edit"></i> Cognitive
                                            </a>
                                            <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_grade" data-degree="'.$row->Degree.'" data-subject="' . $row->SubjName . '" data-type="skills" style="min-width: 100px"> 
                                                <i class="fa fa-edit"></i> Skill
                                            </a>
                                            <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_grade" data-degree="'.$row->Degree.'" data-subject="' . $row->SubjName . '" data-type="character" style="min-width: 100px"> 
                                                <i class="fa fa-edit"></i> Character
                                            </a>';
            if($row->Degree == 'SMK'){
                $value .= '                     <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_grade" data-degree="'.$row->Degree.'" data-subject="' . $row->SubjName . '" data-type="voc" style="min-width: 100px"> 
                                                    <i class="fa fa-edit"></i> Prakerin/UKK
                                                </a>';
            }
            $value .= '                 </td>';
            $value .= '             </tr>';

            $index++;
        }
        $value .= '             </tbody>
                            </table>
                        </div>
                    </div>';

        echo $value;
    }

    public function get_kd_by_subject()
    {
        $type = $_POST['type'];
        $cls = $_POST['cls'];
        $subj = $_POST['subj'];

        $result1 = $this->Mdl_grade->model_get_kd_by_subject($type, $cls, $subj, 1);
        $result2 = $this->Mdl_grade->model_get_kd_by_subject($type, $cls, $subj, 2);

        $i = 1;
        $j = 1;

        $semester1 = '';
        if ($result1) {
            foreach ($result1 as $row) {
                $semester1 .= ' <tr data-code="' . $row->Code . '" data-semester="1" data-subj="' . $row->SubjName . '">
                                    <td contenteditable="true"> ' . $i . ' </td>
                                    <td contenteditable="true" data-field="KD"> ' . $row->KD . ' </td>
                                    <td contenteditable="true" data-field="Code"> ' . $row->Code . ' </td>
                                    <td contenteditable="true" data-field="Adjust"> ' . $row->Adjust . ' </td>
                                    <td contenteditable="true" data-field="KKM"> ' . $row->KKM . ' </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-icon-only red delete_kd">
                                            <i class="fa fa-times"></i>
                                        </a> 
                                    </td>
                                </tr>';

                $i++;
            }
        } else {
            $semester1 .= '<tr>
                                <td colspan="6" class="text-center"> NONE LISTED </td>
                            </tr>';
        }

        $semester2 = '';
        if ($result2) {
            foreach ($result2 as $row) {
                $semester2 .= ' <tr data-code="' . $row->Code . '" data-semester="2" data-subj="' . $row->SubjName . '">
                                    <td contenteditable="true"> ' . $j . ' </td>
                                    <td contenteditable="true" data-field="KD"> ' . $row->KD . ' </td>
                                    <td contenteditable="true" data-field="Code"> ' . $row->Code . ' </td>
                                    <td contenteditable="true" data-field="Adjust"> ' . $row->Adjust . ' </td>
                                    <td contenteditable="true" data-field="KKM"> ' . $row->KKM . ' </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-icon-only red delete_kd">
                                            <i class="fa fa-times"></i>
                                        </a> 
                                    </td>
                                </tr>';

                $j++;
            }
        } else {
            $semester2 .= '<tr>
                                <td colspan="6" class="text-center"> NONE LISTED </td>
                            </tr>';
        }

        $response = [
            'Semester1' => $semester1,
            'Semester2' => $semester2
        ];

        echo json_encode($response);
    }

    public function save_new_kd()
    {
        $type = $_POST['type'];
        $cls = $_POST['cls'];
        $subj = $_POST['subj'];
        $semester = $_POST['semester'];

        $material = $_POST['material'];
        $code = $_POST['code'];
        $adjust = $_POST['adjust'];

        if ($material != '' && $code != '') {
            $this->Mdl_grade->model_save_new_kd($type, $cls, $subj, $semester, $material, $code, $adjust);
        } else {
            echo 'abort';
        }

        echo 'success';
    }

    public function edit_kd()
    {
        $type = $_POST['type'];
        $field = $_POST['field'];
        $newval = $_POST['newval'];

        $code = $_POST['code'];
        $sem = $_POST['semester'];
        $subj = $_POST['subj'];

        $this->Mdl_grade->model_edit_kd($type, $field, $newval, $code, $sem, $subj);
    }

    public function delete_kd()
    {
        $type = $_POST['type'];
        $code = $_POST['code'];
        $sem = $_POST['semester'];
        $subj = $_POST['subj'];

        $this->Mdl_grade->model_delete_kd($type, $code, $sem, $subj);
    }

    public function get_kkm()
    {
        $degree = $_POST['degree'];

        $result = $this->Mdl_grade->modal_get_kkm($degree);

        echo $result->KKM;
    }

    public function save_new_kkm()
    {
        $lvl = $_POST['lvl'];
        $kkm = $_POST['kkm'];

        $result = $this->Mdl_grade->modal_save_new_kkm($lvl, $kkm);

        echo $result;
    }

    public function load_classes_sd()
    {
        $sd = $this->Mdl_grade->get_sd();

        $value = '';

        foreach ($sd as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default cls_grade" data-room="' . $row->ClassDesc . '">CLASS ' . $row->ClassDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_classes_smp()
    {
        $smp = $this->Mdl_grade->get_smp();

        $value = '';

        foreach ($smp as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default cls_grade" data-room="' . $row->ClassDesc . '">CLASS ' . $row->ClassDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_classes_sma()
    {
        $sma = $this->Mdl_grade->get_sma();

        $value = '';

        foreach ($sma as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default cls_grade" data-room="' . $row->ClassDesc . '">CLASS ' . $row->ClassDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_classes_smk()
    {
        $sma = $this->Mdl_grade->get_smk();

        $value = '';

        foreach ($sma as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default cls_grade" data-room="' . $row->ClassDesc . '">CLASS ' . $row->ClassDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_sub_class_grade()
    {
        $room = $this->input->post('room');

        $query = $this->Mdl_grade->model_sub_classes_grade($room);

        $value = '';
        if ($query) {
            $value .= ' <div class="portlet-body portlet_subcls">
                            <div class="table-responsive tbl_cls">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> NIS </th>
                                            <th> Full Name </th>
                                            <th> Room </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>';
            $i = 1;
            foreach ($query as $row) {
                $value .= '         <tr>
                                        <td> ' . $i . ' </td>
                                        <td> ' . $row->NIS . ' </td>
                                        <td> ' . $row->FullName . ' </td>
                                        <td> ' . $row->Room . ' </td>
                                        <td>';
                // $value .= '                 <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_alter" data-nis="' . $row->NIS . '" data-class="' . $row->Class . '"> 
                //                                 <i class="fa fa-edit"></i> Grades
                //                             </a>';
                $value .= '                 <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_detail" data-nis="' . $row->NIS . '" data-class="' . $row->Class . '"> 
                                                <i class="fa fa-list-ul"></i> Full Report
                                            </a>
                                            <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_detail_compact" data-nis="' . $row->NIS . '" data-class="' . $row->Class . '"> 
                                                <i class="fa fa-list-ul"></i> Summary
                                            </a>
                                        </td>
                                    </tr>';
                $i++;
            }
            $value .= '         </tbody>
                            </table>
                        </div>
                    </div>';
        } else {
            $value .= ' <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> NIS </th>
                                            <th> Nama Siswa </th>
                                            <th> Ruang Kelas </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5"> NO SCHEDULE ARRANGED FOR THIS CLASS YET </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>';
        }

        echo $value;
    }

    public function load_spec_class_grade()
    {
        //GET DATA FOR TABLES (AJAX)
        $cls = $this->input->post('cls');

        $clss = $this->Mdl_grade->model_get_sub_classes($cls);
        $query = $this->Mdl_grade->model_classes_grade($cls);

        $value = '';
        if (empty($query)) {
            $value .= ' <div class="portlet-title" style="border-bottom: 0px;">
                            <div class="caption font-red-sunglo">
                                <i class="icon-share font-red-sunglo"></i>
                                <span class="caption-subject bold uppercase port-title">&nbsp;STUDENTS CLASS: ' . $cls . ' </span>
                                <!-- <span class="caption-helper">monthly stats...</span> -->
                            </div>
                            <div class="actions">';
            foreach ($clss as $row) {
                $value .= '   <button type="button" class="btn btn-lg btn-circle grey-mint btn-outline sbold uppercase sub_class" data-class="' . $cls . '" data-room="' . $row->RoomDesc . '">' . $row->RoomDesc . '</button>';
            }
            $value .= '     </div>
                        </div>
                        <div class="portlet-body portlet_subcls">
                            <div class="table-responsive tbl_cls">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> NIS </th>
                                            <th> Full Name </th>
                                            <th> Room </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5"> NO SCHEDULE ARRANGED FOR THIS CLASS YET </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>';
        } else {
            $value .= '<div class="portlet-title" style="border-bottom: 0px;">
                        <div class="caption font-red-sunglo">
                            <i class="icon-share font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase port-title">&nbsp;STUDENTS CLASS: ' . $cls . ' </span>
                            <!-- <span class="caption-helper">monthly stats...</span> -->
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">';
            foreach ($clss as $row) {
                $value .= '   <button type="button" class="btn btn-circle grey-mint btn-outline sbold uppercase sub_class" data-class="' . $cls . '" data-room="' . $row->RoomDesc . '">' . $row->RoomDesc . '</button>';
            }
            $value .= '     </div>
                        </div>
                    </div>
                    <div class="portlet-body portlet_subcls">
                        <div class="table-responsive tbl_cls">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> NIS </th>
                                        <th> Full Name </th>
                                        <th> Room </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>';
            $i = 1;
            foreach ($query as $row) {
                $value .= '         <tr>
                                        <td> ' . $i . ' </td>
                                        <td> ' . $row->NIS . ' </td>
                                        <td> ' . $row->FullName . ' </td>
                                        <td> ' . $row->Room . ' </td>
                                        <td>';
                // $value .=                   '<a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_alter" data-nis="' . $row->NIS . '" data-class="' . $cls . '"> 
                //                                 <i class="fa fa-edit"></i> Grades
                //                             </a>';
                $value .= '                 <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_detail" data-nis="' . $row->NIS . '" data-class="' . $cls . '"> 
                                                <i class="fa fa-list-ul"></i> Full Report
                                            </a>
                                            <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_detail_compact" data-nis="' . $row->NIS . '" data-class="' . $cls . '"> 
                                                <i class="fa fa-list-ul"></i> Summary
                                            </a>
                                        </td>
                                    </tr>';
                $i++;
            }
            $value .= '         </tbody>
                            </table>
                        </div>
                    </div>';
        }

        echo $value;
    }

    public function get_full_table_details_cognitive()
    {
        $cls = $_POST['cls'];
        $year = $_POST['year'];
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

    public function get_full_table_details_skills()
    {
        $cls = $_POST['cls'];
        $year = $_POST['year'];
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

    public function get_full_table_details_character()
    {
        $room = $_POST['cls'];
        $year = $_POST['year'];
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
            $spirit .= '    <td>' . $k . ' </td>';
            $spirit .= '    <td>' . $row->NIS . ' </td>';
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

    //PRAKERIN (XI) / UKK (XII)
    public function get_full_table_details_voc(){
        $cls = $_POST['cls'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $subj = $_POST['subj'];

        $result = $this->Mdl_grade->model_get_person_voc_details($cls, $year, $semester, $subj);

        $i = 1;
        $value = '';
        if($result){
            foreach($result as $row){
                if ($row->Predicate == 'A') {
                    $color = '#5edfff';
                } elseif ($row->Predicate == 'B') {
                    $color = '#71a95a';
                } elseif ($row->Predicate == 'C') {
                    $color = '#fbe555';
                } elseif ($row->Predicate == 'D') {
                    $color = '#fb5b5a';
                } else {
                    $color = 'black';
                }

                $value .= '<tr>';
                $value .= '<td class="text-center" width="1%">'.$i.'</td>';
                $value .= '<td class="text-center sbold" width="1%">'.$row->NIS.'</td>';
                $value .= '<td class="text-center" width="10%">'.$row->FullName.'</td>';
                $value .= '<td class="text-center sbold voc_grade" width="1%" contenteditable="true" data-nis="'.$row->NIS.'" data-semester="'.$semester.'" data-period="'.$year.'" data-room="'.$row->Room.'" data-subjname="'.$subj.'">'.$row->Report.'</td>';
                $value .= '<td class="text-center sbold" width="1%" style="color: '.$color.'">'.$row->Predicate.'</td>';
                $value .= '<td class="text-center" width="10%">'.$row->Description.'</td>';
                $value .= '</tr>';

                $i++;
            }
        }

        $data = [
            'voc' => $value
        ];

        echo json_encode($data);
    }

    public function update_kd_weight()
    {
        $room = $_POST['room'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $type = $_POST['type'];
        $subj = $_POST['subj'];
        $code = $_POST['code'];
        $field = $_POST['field'];
        $value = $_POST['value'];

        $current_period = $this->session->userdata('period');
        $current_semester = $this->session->userdata('semester');

        if($year == $current_period && $semester == $current_semester){
            $result = $this->Mdl_grade->model_update_kd_weight($room, $year, $semester, $type, $subj, $code, $field, $value);
        }else{
            $result = 'INVALID_PERIOD';
        }

        echo $result;
    }

    public function update_recap_weight()
    {
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $room = $_POST['room'];
        $subj = $_POST['subj'];
        $field = $_POST['field'];
        $value = $_POST['value'];

        $current_period = $this->session->userdata('period');
        $current_semester = $this->session->userdata('semester');

        if($year == $current_period && $semester == $current_semester){
            $result = $this->Mdl_grade->model_update_recap_weight($semester, $room, $subj, $field, $value);
        }else{
            $result = 'INVALID_PERIOD';
        }

        echo $result;
    }

    public function get_active_days()
    {
        $degree = $_POST['degree'];

        $result = $this->Mdl_grade->model_get_active_days($degree);

        echo $result;
    }

    public function sv_active_days()
    {
        $degree = $_POST['degree'];
        $value = $_POST['value'];

        $result = $this->Mdl_grade->model_sv_active_days($degree, $value);

        echo $result;
    }

    public function sv_std_kd_grades()
    {
        $data = [
            'nis' => $_POST['nis'],
            'fullname' => $_POST['fullname'],
            'year' => $_POST['year'],
            'semester' => $_POST['semester'],
            'cls' => $_POST['cls'],
            'room' => $_POST['room'],
            'subj' => $_POST['subj'],
            'type' => $_POST['type'],
            'code' => $_POST['code'],
            'field' => $_POST['field'],
            'value' => $_POST['val']
        ];

        $current_period = $this->session->userdata('period');
        $current_semester = $this->session->userdata('semester');

        if($data['year'] == $current_period && $data['semester'] == $current_semester){
            $result = $this->Mdl_grade->model_sv_kd_grades($data);
        }else{
            $result = 'INVALID_PERIOD';
        }

        echo $result;
    }

    public function sv_std_exam_grades()
    {
        $data = [
            'nis' => $_POST['nis'],
            'cls' => $_POST['cls'],
            'year' => $_POST['year'],
            'semester' => $_POST['semester'],
            'room' => $_POST['room'],
            'subj' => $_POST['subj'],
            'type' => $_POST['type'],
            'field' => $_POST['field'],
            'value' => $_POST['val']
        ];

        $current_period = $this->session->userdata('period');
        $current_semester = $this->session->userdata('semester');

        if($data['year'] == $current_period && $data['semester'] == $current_semester){
            $result = $this->Mdl_grade->model_sv_exam_grades($data);
        }else{
            $result = 'INVALID_PERIOD';
        }


        echo $result;
    }

    public function sv_std_char_grades()
    {
        $nis = $_POST['nis'];
        $name = $_POST['name'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $subj = $_POST['subj'];
        $room = $_POST['room'];
        $type = $_POST['type'];
        $desc = $_POST['desc'];
        $value = $_POST['value'];

        $current_period = $this->session->userdata('period');
        $current_semester = $this->session->userdata('semester');

        if($year == $current_period && $semester == $current_semester){
            $result = $this->Mdl_grade->model_sv_std_char_grades($nis, $name, $semester, $subj, $room, $type, $desc, $value);
        }else{
            $result = 'INVALID_PERIOD';
        }

        echo $result;
    }

    public function sv_std_voc_grades(){
        $nis = $_POST['nis'];
        $semester = $_POST['semester'];
        $year = $_POST['period'];
        $room = $_POST['room'];
        $subj = $_POST['subj'];
        $value = $_POST['value'];

        $current_period = $this->session->userdata('period');
        $current_semester = $this->session->userdata('semester');

        if($year == $current_period && $semester == $current_semester){
            $result = $this->Mdl_grade->model_sv_std_voc_grades($nis, $year, $semester, $subj, $room, $value);
        }else{
            $result = 'INVALID_PERIOD';
        }

        echo $result;
    }

    public function load_std_grades_dt()
    {
        $nis = $this->input->post('nis');

        $query = $this->Mdl_grade->model_get_std_grades($nis);

        echo json_encode($query);
    }

    public function get_grade_weight()
    {
        $lvl = $_POST['degree'];

        $result = $this->Mdl_grade->model_get_grade_weight($lvl)->row();

        echo json_encode($result);
    }

    public function get_grade_weight_nat()
    {
        $degree = $_POST['degree'];

        $result = $this->Mdl_grade->model_get_grade_weight_nat($degree)->result();

        echo json_encode($result);
    }

    public function save_grade_weight()
    {
        $data = [
            'degree' => $_POST['lvl'],
            'field' => $_POST['field'],
            'value' => $_POST['value']
        ];

        $result = $this->Mdl_grade->model_sv_grade_weight($data);

        echo $result;
    }

    public function save_nat_weight()
    {
        $degree = $_POST['degree'];
        $type = $_POST['type'];
        $field = $_POST['field'];
        $val = $_POST['val'];

        $this->Mdl_grade->modal_save_nat_weight($degree, $type, $field, $val);
    }

    public function load_predicate()
    {
        $spectrum = $this->Mdl_grade->get_spectrum_asc();

        $val = '';
        foreach ($spectrum as $row) {
            $val .= '<tr data-prd="' . $row->Predicate . '">
                        <td class="sbold"> ' . $row->Predicate . ' </td>
                        <td contenteditable="true" data-prd="max"> ' . $row->Maximum . ' </td>
                        <td contenteditable="true" data-prd="min"> ' . $row->Minimum . ' </td>
                     </tr>';
        }

        echo $val;
    }

    public function post_predicate()
    {
        $predicate = $_POST['predicate'];
        $max = $_POST['max'];
        $min = $_POST['min'];

        $this->Mdl_grade->model_post_predicate($predicate, $max, $min);
    }

    public function get_grade_report()
    {
        $nis = $_POST['nis'];
        $cls = $_POST['cls'];
        $subj = $_POST['subj'];
        $period = $_POST['period'];
        $semester = $_POST['semester'];

        $result_kd = $this->Mdl_grade->get_std_kd_det($nis, $subj, $period, $semester);

        $kd_cog = '';
        $kd_sk = '';
        $l = 1;
        $m = 1;
        foreach ($result_kd as $row) {

            $color = '';
            if ($row->KDAvg < $row->KKM) {
                $color = '#fb5b5a';
            } else {
                $color = '#71a95a';
            }

            if ($row->Type == 'cognitive') {
                $kd_cog .= '<tr>';
                $kd_cog .= '    <td>' . $l . '</td>';
                $kd_cog .= '    <td>' . $row->KD . '</td>';
                $kd_cog .= '    <td>' . $row->Code . '</td>';
                $kd_cog .= '    <td class="sbold">' . $row->KKM . '</td>';
                $kd_cog .= '    <td class="sbold" style="color: ' . $color . '">' . $row->KDAvg . '</td>';
                $kd_cog .= '</tr>';

                $l++;
            } elseif ($row->Type == 'skills') {
                $kd_sk .= '<tr>';
                $kd_sk .= '    <td>' . $m . '</td>';
                $kd_sk .= '    <td>' . $row->KD . '</td>';
                $kd_sk .= '    <td>' . $row->Code . '</td>';
                $kd_sk .= '    <td class="sbold">' . $row->KKM . '</td>';
                $kd_sk .= '    <td class="sbold" style="color: ' . $color . '">' . $row->KDAvg . '</td>';
                $kd_sk .= '</tr>';

                $m++;
            }
        }

        $result_exam = $this->Mdl_grade->get_std_exam_det($nis, $cls, $subj, $period, $semester);

        $exam = '';
        $exam .= '<tr>';
        $exam .= '    <td colspan="4" class="text-center"> <b> Mid Test </b> </td>';
        $exam .= '    <td colspan="1" class="sbold">' . $result_exam->MidRecap . '</td>';
        $exam .= '</tr>';
        $exam .= '<tr>';
        $exam .= '    <td colspan="4" class="text-center"> <b> Final </b> </td>';
        $exam .= '    <td colspan="1" class="sbold">' . $result_exam->FinalRecap . '</td>';
        $exam .= '</tr>';

        $result_voc = $this->Mdl_grade->get_std_voc_det($nis, $cls, $subj, $period, $semester);

        $voc = '';
        if($result_voc->num_rows() > 0){
            $result_voc = $result_voc->row();

            if ($result_voc->Predicate == 'A') {
                $col_voc = '#5edfff';
            } elseif ($result_voc->Predicate == 'B') {
                $col_voc = '#71a95a';
            } elseif ($result_voc->Predicate == 'C') {
                $col_voc = '#fbe555';
            } elseif ($result_voc->Predicate == 'D') {
                $col_voc = '#fb5b5a';
            }

            $voc .= '<tr>';
            $voc .= '    <th class="text-center" rowspan="2">PRAKERIN/UKK</th>';
            $voc .= '    <th class="text-center"> NILAI</th>';
            $voc .= '    <th class="text-center"> PREDIKAT</th>';
            $voc .= '    <th class="text-center"> DESKRIPSI</th>';
            $voc .= '</tr>';
            $voc .= '<tr>';
            $voc .= '    <td class="text-center sbold">'.$result_voc->Report.'</td>';
            $voc .= '    <td class="text-center sbold" style="color: '.$col_voc.'">'.$result_voc->Predicate.'</td>';
            $voc .= '    <td class="text-center">'.$result_voc->Description.'</td>';
            $voc .= '</tr>';
        }

        $result_report = $this->Mdl_grade->get_std_report_det($nis, $cls, $subj, $period, $semester);

        $col = '';
        if ($result_report->Predicate == 'A') {
            $col = '#5edfff';
        } elseif ($result_report->Predicate == 'B') {
            $col = '#71a95a';
        } elseif ($result_report->Predicate == 'C') {
            $col = '#fbe555';
        } elseif ($result_report->Predicate == 'D') {
            $col = '#fb5b5a';
        }

        $col_SK = '';
        if ($result_report->Predicate_SK == 'A') {
            $col_SK = '#5edfff';
        } elseif ($result_report->Predicate_SK == 'B') {
            $col_SK = '#71a95a';
        } elseif ($result_report->Predicate_SK == 'C') {
            $col_SK = '#fbe555';
        } elseif ($result_report->Predicate_SK == 'D') {
            $col_SK = '#fb5b5a';
        }

        $report = '';
        $report .= '<tr>';
        $report .= '    <td colspan="4" class="text-center">' . $result_report->Report . '</td>';
        $report .= '    <td colspan="1" class="sbold" style="color: ' . $col . '">' . $result_report->Predicate . '</td>';
        $report .= '</tr>';

        $report_sk = '';
        $report_sk .= '<tr>';
        $report_sk .= '    <td colspan="4" class="text-center">' . $result_report->Report_SK . '</td>';
        $report_sk .= '    <td colspan="1" class="sbold" style="color: ' . $col_SK . '">' . $result_report->Predicate_SK . '</td>';
        $report_sk .= '</tr>';

        $desc_cog = '<tr> 
                        <td colspan="5" style="padding: 25px"> ' . $result_report->Description . ' </td>
                     </tr>';
        $desc_sk = '<tr> 
                        <td colspan="5" style="padding: 25px"> ' . $result_report->Description_SK . ' </td>
                     </tr>';



        $soc = '';
        $soc = '<tr>
                    <td class="text-center"> ' . $result_report->Description_SOC . ' </td>
                    <td class="text-center sbold" style="color: #4B77BE"> ' . $result_report->Report_SOC . ' </td>
                    <td class="text-center sbold" style="color: #BF55EC"> ' . $result_report->Predicate_SOC . ' </td>
                </tr>';

        $spr = '';
        $spr = '<tr>
                    <td class="text-center"> ' . $result_report->Description_SPR . ' </td>
                    <td class="text-center sbold" style="color: #4B77BE"> ' . $result_report->Report_SPR . ' </td>
                    <td class="text-center sbold" style="color: #BF55EC"> ' . $result_report->Predicate_SPR . ' </td>
                </tr>';

        $data = [
            'KDCog' => $kd_cog,
            'KDSK' => $kd_sk,
            'EXM' => $exam,
            'VOC' => $voc,
            'REPCog' => $report,
            'REPSK' => $report_sk,
            'DESCCog' => $desc_cog,
            'DESCSK' => $desc_sk,
            'SOC' => $soc,
            'SPR' => $spr,
        ];

        echo json_encode($data);
    }

    public function get_grade_report_compact()
    {
        $nis = $_POST['nis'];
        $cls = $_POST['cls'];
        $period = $_POST['period'];
        
        $default_semester = '';
        $time = date('d-m-Y');
        $year = date('Y');
        
        if (date('n', strtotime($time)) <= 6) {
            $default_semester = 2;
        } else {
            $default_semester = 1;
        }

        $semester = (isset($_POST['semester']) ? $_POST['semester'] : $default_semester);

        $row = $this->Mdl_grade->model_get_grade_report($nis, $cls, $period, $semester)->result();
        $matrix = $this->Mdl_grade->get_spectrum();
        $character = $this->Mdl_grade->model_get_character_grade_compact($nis, $period, $semester);
        $voc = $this->Mdl_grade->model_get_voc_grade_compact($nis, $cls, $period, $semester);
        $absence = $this->Mdl_grade->get_absent($nis, $cls, $period, $semester);

        $cognitive = '';
        $skills = '';
        $i = 1;
        
        if (!empty($row)) {
            foreach ($row as $compact) {
                $cognitive .= ' <tr>    
                                <td> ' . $i . ' </td>
                                <td> ' . $compact->SubjName . ' </td>
                                <td> ' . $compact->Report . ' </td>';
                $skills .= ' <tr>    
                                <td> ' . $i . ' </td>
                                <td> ' . $compact->SubjName . ' </td>
                                <td> ' . $compact->Report_SK . ' </td>';
                if ($compact->Predicate == 'A') {
                    $cognitive .= '     <td class="sbold" style="color: #5edfff; padding-left: 3%"> ' . $compact->Predicate . ' </td>';
                } elseif ($compact->Predicate == 'B') {
                    $cognitive .= '     <td class="sbold" style="color: #71a95a; padding-left: 3%"> ' . $compact->Predicate . ' </td>';
                } elseif ($compact->Predicate == 'C') {
                    $cognitive .= '     <td class="sbold" style="color: #fbe555; padding-left: 3%"> ' . $compact->Predicate . ' </td>';
                } elseif ($compact->Predicate == 'D') {
                    $cognitive .= '     <td class="sbold" style="color: #fb5b5a; padding-left: 3%"> ' . $compact->Predicate . ' </td>';
                }

                if ($compact->Predicate_SK == 'A') {
                    $skills .= '        <td class="sbold" style="color: #5edfff; padding-left: 3%"> ' . $compact->Predicate_SK . ' </td>';
                } elseif ($compact->Predicate_SK == 'B') {
                    $skills .= '        <td class="sbold" style="color: #71a95a; padding-left: 3%"> ' . $compact->Predicate_SK . ' </td>';
                } elseif ($compact->Predicate_SK == 'C') {
                    $skills .= '        <td class="sbold" style="color: #fbe555; padding-left: 3%"> ' . $compact->Predicate_SK . ' </td>';
                } elseif ($compact->Predicate_SK == 'D') {
                    $skills .= '        <td class="sbold" style="color: #fb5b5a; padding-left: 3%"> ' . $compact->Predicate_SK . ' </td>';
                }

                $cognitive .= '         <td>
                                            ' . $compact->Description . '
                                        </td>
                                    </tr>';
                $skills .= '            <td>
                                            ' . $compact->Description_SK . '
                                        </td>
                                    </tr>';

                $i++;
            }
            // $cognitive .= ' <tr> 
            //                 <td colspan="5" class="sbold" style="padding-left: 10px"> Elective </td>
            //             <tr>';
        } else {
            $cognitive .= '<tr><td colspan="5"> No Subjects has been assigned yet </td></tr>';
            $skills .= '<tr><td colspan="5"> No Subjects has been assigned yet </td></tr>';
        }

        $spectrum = '';
        $spectrum .= '  <tr>';
        foreach ($matrix as $row) {
            $spectrum .= '<td class="sbold text-center"> ' . $row->Minimum . ' - ' . $row->Maximum . ' </td>';
        }
        $spectrum .= '  </tr>';


        $k = 1;
        $soc = '';
        $soc .= '<tr class="sbold"><td colspan="5">Social</td></tr>';
        if (!empty($character)) {
            foreach ($character as $row) {
                if ($row->Predicate_SOC == 'A') {
                    $col1 = '#5edfff';
                } elseif ($row->Predicate_SOC == 'B') {
                    $col1 = '#71a95a';
                } elseif ($row->Predicate_SOC == 'C') {
                    $col1 = '#fbe555';
                } else {
                    $col1 = '#fb5b5a';
                }

                $soc .= '   <tr>
                                <td class="sbold uppercase"> ' . $k . ' </td>
                                <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                                <td class="sbold uppercase"> ' . $row->Report_SOC . ' </td>
                                <td class="sbold uppercase" style="color: ' . $col1 . '"> ' . $row->Predicate_SOC . ' </td>
                                <td class="sbold"> ' . $row->Description_SOC . ' </td>
                            </tr>';

                $k++;
            }
        } else {
            $soc .= '       <tr>
                                <td colspan="5" class="text-center sbold"> Social Grades is still empty </td>
                            </tr>';
        }

        $l = 1;
        $spr = '';
        $spr .= '<tr class="sbold"><td colspan="5">Spiritual</td></tr>';
        if (!empty($character)) {
            foreach ($character as $row) {
                if ($row->Predicate_SPR == 'A') {
                    $col2 = '#5edfff';
                } elseif ($row->Predicate_SPR == 'B') {
                    $col2 = '#71a95a';
                } elseif ($row->Predicate_SPR == 'C') {
                    $col2 = '#fbe555';
                } else {
                    $col2 = '#fb5b5a';
                }

                $spr .= '   <tr>
                                <td class="sbold uppercase"> ' . $l . ' </td>
                                <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                                <td class="sbold uppercase"> ' . $row->Report_SPR . ' </td>
                                <td class="sbold uppercase" style="color: ' . $col2 . '"> ' . $row->Predicate_SPR . ' </td>
                                <td class="sbold"> ' . $row->Description_SPR . ' </td>
                            </tr>';

                $l++;
            }
        } else {
            $spr .= '       <tr>
                                <td colspan="5" class="text-center sbold"> Spiritual Grades is still empty </td>
                            </tr>';
        }

        $voc_result = '';
        if($voc){
            if ($voc->Predicate == 'A') {
                $col_voc = '#5edfff';
            } elseif ($voc->Predicate == 'B') {
                $col_voc = '#71a95a';
            } elseif ($voc->Predicate == 'C') {
                $col_voc = '#fbe555';
            } elseif ($voc->Predicate == 'D') {
                $col_voc = '#fb5b5a';
            }

            $voc_result .= '<tr>';
            $voc_result .= '    <td class="text-center sbold">'.$voc->Report.'</td>';
            $voc_result .= '    <td class="text-center sbold" style="color: '.$col_voc.'">'.$voc->Predicate.'</td>';
            $voc_result .= '    <td>'.$voc->Description.'</td>';
            $voc_result .= '</tr>';
        }

        $absent = '';
        if ($absence->num_rows() != 0) {
            foreach ($absence->result() as $row) {
                if ($row->Ket != NULL) {
                    $absent .= '<tr>';
                    $absent .= '    <td width="25%"> ' . $row->Ket . ' </td>';
                    $absent .= '    <td> ' . $row->Total . '</td>
                                </tr>';
                }
            }
        } else {
            $absent .= '<tr> 
                            <td colspan="2"> This Student has no absent </td> 
                        </tr>';
        }

        $data = [
            'COG' => $cognitive,
            'SK' => $skills,
            'Spectrum' => $spectrum,
            'SOC' => $soc,
            'SPR' => $spr,
            'VOC' => $voc_result,
            'Absent' => $absent
        ];

        echo json_encode($data);
    }

    public function get_std_subject_list()
    {
        $default_semester = 0;

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $default_semester = 2;
        } else {
            $default_semester = 1;
        }

        $nis = $_POST['nis'];
        $cls = $_POST['cls'];
        $period = $_POST['rep_period'];
        $semester = (isset($_POST['rep_semester']) ? $_POST['rep_semester'] : $default_semester);

        $subj = isset($_POST['subj']) ? $_POST['subj'] : '';

        $result = $this->Mdl_grade->model_get_subject_list($nis, $cls, $period, $semester);

        $dd_list_subj = '';
        $dd_list_subj .= '   <div class="form-group form-md-line-input has-info">';
        $dd_list_subj .= '       <select class="form-control avail_subj" id="form_control_1">';
        foreach ($result as $row) {
            if ($row->SubjName == $subj) {
                $dd_list_subj .= '           <option value="' . $row->SubjName . '" selected>' . $row->SubjName . '</option>';
            } else {
                $dd_list_subj .= '           <option value="' . $row->SubjName . '">' . $row->SubjName . '</option>';
            }
        }
        $dd_list_subj .= '       </select>';
        $dd_list_subj .= '   <label for="form_control_1">Select Subject</label>';
        $dd_list_subj .= '   </div>';


        echo $dd_list_subj;
    }

    public function display_report_print_a()
    {
        $nis = $_GET['nis'];
        $cls = $_GET['cls'];
        $subj = $_GET['subj'];
        $period = $_GET['period'];
        $semester = $_GET['semester'];
        $report_type = 'full';

        $data = [
            'info' => $this->Mdl_grade->get_report_print_info($nis, $cls, $subj, $period, $semester, $report_type),
            'kd' => $this->Mdl_grade->get_std_kd_det($nis, $subj, $period, $semester),
            'exam' => $this->Mdl_grade->get_std_exam_det($nis, $cls, $subj, $period, $semester),
            'voc' => $this->Mdl_grade->get_std_voc_det($nis, $cls, $subj, $period, $semester),
            'rep' => $this->Mdl_grade->get_std_report_det($nis, $cls, $subj, $period, $semester),
            'sick' => $this->Mdl_grade->get_print_absent($nis, $cls, $period, $semester, 'Sick'),
            'permit' => $this->Mdl_grade->get_print_absent($nis, $cls, $period, $semester, 'On Permit'),
            'absent' => $this->Mdl_grade->get_print_absent($nis, $cls, $period, $semester, 'Absent'),
        ];

        $this->load->view('grade_report_print_a', $data);
    }

    public function display_report_print_b()
    {
        $nis = $_GET['nis'];
        $cls = $_GET['cls'];
        $period = $_GET['period'];
        $semester = $_GET['semester'];
        $report_type = 'full';

        [$info, $characters, $grade] = $this->Mdl_grade->get_report_print_b($nis, $cls, $period, $semester, $report_type);

        $data = [
            'info' => $info,
            'char' => $char,
            'grade' => $grade,
        ];

        $this->load->view('grade_report_print_b', $data);
    }

    public function display_report_mid_print()
    {
        $nis = $_GET['nis'];
        $cls = $_GET['cls'];
        $subj = $_GET['subj'];
        $period = $_GET['period'];
        $semester = $_GET['semester'];
        $report_type = 'mid';

        [$query, $score, $average] = $this->Mdl_grade->get_report_mid_grade($nis, $cls, $semester);

        $data = [
            'info' => $this->Mdl_grade->get_report_print_info($nis, $cls, $subj, $period, $semester, $report_type),
            'subjects' => $query,
            'score' => $score,
            'average' => $average,
            'sick' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'Sick'),
            'permit' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'On Permit'),
            'absent' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'Absent')
        ];

        $this->load->view('grade_report_mid_print', $data);
    }


    // ==================================================================================================================== \\
    // ==============================                    ABSENT CONTROLLER                   ============================== \\
    // ==================================================================================================================== \\
    public function load_acd_absn()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            'type' => $this->Mdl_absent->get_absent_type()
        ];

        $this->load->view('admin/adm_acd_absn', $data);
    }

    public function get_classes()
    {
        $query = $this->Mdl_absent->model_get_classes();

        $value = '';
        $value .= '<select name="rooms" class="form-control" id="class_dd" style="margin-left: 5px;">';
        $value .= '<option> -- Select Class -- </option>';
        foreach ($query as $row) {
            $value .= '<option id="room" value="' . $row->RoomDesc . '"> ' . $row->RoomDesc . ' </option>';
        }
        $value .= '</select>';

        echo $value;
    }

    public function get_tbl_byclass()
    {
        $room = $this->input->post('room');

        $query = $this->Mdl_absent->modal_tbl_search_std($room);

        $value = '';
        if (!empty($query)) {
            foreach ($query as $row) {
                $value .= '<tr class="gradeX odd" role="row">
                                <td><input class="form-check-input" name="std-checkbox" type="checkbox" data-name="' . $row->FullName . '" value="' . $row->IDNumber . '"></td>
                                <td> <a href="#" class="nis" data-status="student" data-id="' . $row->IDNumber . '"> ' . $row->IDNumber . ' </a> </td>
                                <td> ' . $row->FullName . ' </td>
                            </tr>';
            }
        } else {
            $value .= '<tr class="gradeX odd" role="row">
                            <td colspan="2"> NO STUDENT IN THIS CLASS </td>
                        </tr>';
        }


        echo $value;
    }

    public function get_tbl_personal()
    {
        $data = $this->input->post('search');
        $status = $this->input->post('status');

        $query = $this->Mdl_absent->modal_tbl_search_personal($data, $status);

        $value = '';
        if (!empty($query)) {
            foreach ($query as $row) {
                $value .= '<tr class="gradeX odd" role="row">
                                <td><input class="form-check-input" type="checkbox" data-name="' . $row->FullName . '" value="' . $row->IDNumber . '"></td>';
                if ($status == 'student') {
                    $value .= '     <td> <a href="#" class="nis" data-status="student" data-id="' . $row->IDNumber . '"> ' . $row->IDNumber . ' </a> </td>';
                } else {
                    $value .= '     <td> <a href="#" class="nis" data-status="teacher" data-id="' . $row->IDNumber . '"> ' . $row->IDNumber . ' </a> </td>';
                }

                $value .= '         <td> ' . $row->FullName . ' </td>
                            </tr>';
            }
        } else {
            $value .= '<tr class="gradeX odd" role="row">
                            <td colspan="2"> NO STUDENT IN THIS CLASS </td>
                        </tr>';
        }

        echo $value;
    }

    public function get_ids_cur_subject()
    {
        $room = $_POST['room'];

        $result = $this->Mdl_absent->model_get_cur_subject($room);

        echo json_encode($result);
    }

    public function add_absent_std()
    {
        $id = $_POST['selected'];
        $type = $_POST['type'];
        $date = $_POST['new_date'];
        $subj = (($_POST['subj'] !== '') ? $_POST['subj'] : NULL);
        $hour = (($_POST['time'] !== '') ? $_POST['time'] : NULL);
        $status = $_POST['status'];

        $id = (count($id) > 1 ? implode(',', $id) : $id[0]);

        $this->Mdl_absent->model_insert_absent($id, $type, $date, $subj, $hour, $status);
    }

    public function get_absn_det()
    {

        $data = $this->input->post('id');
        $status = $this->input->post('status');

        $query = $this->Mdl_absent->get_absn_det($data, $status);
        $total_absn = $this->Mdl_absent->model_total_absn($data, $status);

        $value = '';
        $value .= '<thead>
                        <tr>
                            <th> ID </th>
                            <th> Fullname </th>
                            <th> Absence Date </th>
                            <th> Absence Type </th>';
        $value .= '     </tr>
                    </thead>';
        if (!empty($query->result())) {
            $value .= ' <tbody>';
            $i = 1;
            foreach ($query->result() as $row) {
                $value .= '     <tr>';
                if ($i == 1) {
                    if ($status == 'student') {
                        $value .= ' <td> ' . $row->NIS . ' </td>';
                    } else {
                        $value .= ' <td> ' . $row->IDNumber . ' </td>';
                    }
                    $value .= '     <td> ' . $row->FullName . ' </td>';
                    $value .= '     <td> ' . date('d-m-Y', strtotime($row->Absent)) . ' </td>';
                    if ($row->Ket == 'Sick') {
                        $value .= '     <td> <span class="label label-warning label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'On Permit') {
                        $value .= '     <td> <span class="label label-success label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Absent') {
                        $value .= '     <td> <span class="label label-danger label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Truant') {
                        $value .= '     <td> <span class="label label-primary label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Late') {
                        $value .= '     <td> <span class="label label-info label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    }
                } else {
                    $value .= '     <td></td>';
                    $value .= '     <td></td>';
                    $value .= '     <td> ' . date('d-m-Y', strtotime($row->Absent)) . ' </td>';
                    if ($row->Ket == 'Sick') {
                        $value .= '     <td> <span class="label label-warning label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'On Permit') {
                        $value .= '     <td> <span class="label label-success label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Absent') {
                        $value .= '     <td> <span class="label label-danger label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Truant') {
                        $value .= '     <td> <span class="label label-primary label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Late') {
                        $value .= '     <td> <span class="label label-info label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    }
                }
                $value .= '     </tr>';

                $i++;
            }
            $value .= ' </tbody>';
            $value .= ' <thead> 
                            <tr> 
                                <th>
                                    <td class="sbold"> Total Absent </td>';
            $value .= '             <td class="sbold"> ' . $total_absn . ' </td>';
            $value .= '         </th> 
                            </tr> 
                        </thead>';
        } else {
            $value .= ' <tbody>';
            $value .= '     <tr>';
            if ($status == 'student') {
                $value .= '         <td colspan="6"> STUDENT ' . $data . ' HAS NO ABSENT ON RECORD <td>';
            } else {
                $value .= '         <td colspan="6"> ID ' . $data . ' HAS NO ABSENT ON RECORD <td>';
            }
            $value .= '     </tr>';
            $value .= ' </tbody>';
        }

        echo $value;
    }

    // =============================================================================================================================== \\
    // ==============================                     PROFILE TEACHER / STAFF CONTROLLER            ============================== \\
    // =============================================================================================================================== \\
    public function load_prof_tch_edit()
    {
        $tch = 'teacher';

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'tch_t' => $this->Mdl_profile->get_teachers($tch)
        ];

        $this->load->view('admin/adm_prof_tch_edit', $data);
    }

    public function load_prof_tch()
    {
        $id = $this->uri->segment(3);

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'tch_t' => $this->Mdl_profile->get_full_info($id)

        ];

        $this->load->view('admin/adm_prof_tch', $data);
    }

    public function load_prof_tch_add()
    {
        $status = 'teacher';

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            //Dropdown
            'room' => $this->Mdl_profile->get_classrooms(),
            'subj' => $this->Mdl_profile->get_dropdown_subject(null)
        ];

        $this->load->view('admin/adm_prof_tch_add', $data);
    }

    //Page loads only when accessed through Edit Page
    //No Direct access through NAVBAR
    public function load_prof_tch_update()
    {
        $selected_id = $this->uri->segment(3);

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            //Dropdown
            'room' => $this->Mdl_profile->get_classrooms(),
            'subj' => $this->Mdl_profile->get_dropdown_subject(null),

            //Get data from ID that will be editted
            'datatoedit' => $this->Mdl_profile->get_full_info($selected_id)
        ];

        $this->load->view('admin/adm_prof_tch_update', $data);

        return $selected_id;
    }

    public function get_homeroom_availability()
    {
        $room = $_POST['room'];

        $result = $this->Mdl_profile->model_get_homeroom_availability($room);

        echo json_encode($result);
    }

    public function add_tch()
    {
        $id = $_POST['newid'];
        $img = $_FILES['image']['name'];
        $img_name = 'img-' . $id . '-tch.jpg';

        $config = [
            'upload_path' => './assets/photos/teachers/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'file_name' => $img_name
        ];

        $this->load->library('upload', $config);

        if ($img == '') {
            $img_name = 'default.png';
        }

        if ($institute == '') {
            $institute = 'no';
        }

        $status = $_POST['status'];

        $table1 = [
            'IDNumber' => $id,
            'PersonalID' => $_POST['newktp'],
            'FirstName' => $_POST['newfname'],
            'LastName' => $_POST['newlname'],
            'status' => $status,
            'Gender' => $_POST['gender'],
            'Religion' => $_POST['Religion'],
            'DateofBirth' => date("Y-m-d", strtotime($_POST['newtgllhr'])),
            'PointofBirth' => $_POST['newtmplhr'],
            'Address' => $_POST['newaddr'],
            'District' => $_POST['newdis'],
            'Region' => $_POST['newreg'],
            'City' => $_POST['newcity'],
            'Province' => $_POST['newprov'],
            'Country' => $_POST['newnat'],
            'Photo' => $img_name
        ];

        $table2 = [
            'IDNumber' => $id,
            'Occupation' => $_POST['status'],
            'Honorer' => $_POST['honorer'],
            'Emp_Type' => $_POST['emp'],
            'Homeroom' => $_POST['homeroom'],
            'JobDesc' => $_POST['jobdesc'],
            'SubjectTeach' => $_POST['subjteach'],
            'LastEducation' => $_POST['education'],
            'StudyFocus' => $_POST['diploma'],
            'Govt_Cert' => $_POST['govt'],
            'Institute_Cert' => $_POST['institute'],
            'YearStarts' => $_POST['starts'],
            'MaritalStatus' => $_POST['marital'],
            'Email' => $_POST['newmail'],
            'Phone' => $_POST['newtelp']
        ];

        $result = $this->Mdl_profile->new_tch($id, $status, $table1, $table2);

        if ($result == 'success') {
            // $this->upload->data(); //Upload data to upload_path
            if (!$this->upload->do_upload('image')) {
                $error_msg = $this->upload->display_errors();

                $this->session->set_flashdata('disp_err', "<div class=\"alert alert-success text-center text-uppercase\" role=\"alert\"> $errormsg </div>");
            } else {
                $this->session->set_flashdata('addmsg', '<div class="alert alert-success text-center text-uppercase" role="alert"> New Teacher Added!!! </div>');
            }

            redirect('Admin/load_prof_tch_edit');
        } else {
            $this->session->set_flashdata('addmsg', '<div class="alert alert-danger text-center text-uppercase" role="alert"> ID already Existed!!! </div>');
            redirect('Admin/load_prof_tch_edit');
        }
    }

    public function update_tch()
    {
        $selected_id = $this->uri->segment(3);

        $institute = (isset($_POST['inst']) ? $_POST['inst'] : '');

        if ($institute == '') {
            $institute = 'no';
        }

        $table1 = [
            'PersonalID' => $_POST['newktp'],
            'FirstName' => $_POST['newfname'],
            'LastName' => $_POST['newlname'],
            'status' => $_POST['status'],
            'Gender' => $_POST['gender'],
            'Religion' => $_POST['Religion'],
            'DateofBirth' => date("Y-m-d", strtotime($_POST['newtgllhr'])),
            'PointofBirth' => $_POST['newtmplhr'],
            'Address' => $_POST['newaddr'],
            'District' => $_POST['newdis'],
            'Region' => $_POST['newreg'],
            'City' => $_POST['newcity'],
            'Province' => $_POST['newprov'],
            'Country' => $_POST['newnat'],
        ];

        $table2 = [
            'Occupation' => $_POST['status'],
            'Honorer' => $_POST['honorer'],
            'Emp_Type' => $_POST['emp'],
            'Homeroom' => $_POST['homeroom'],
            'JobDesc' => $_POST['jobdesc'],
            'SubjectTeach' => $_POST['subjteach'],
            'LastEducation' => $_POST['education'],
            'StudyFocus' => $_POST['diploma'],
            'Govt_Cert' => $_POST['govt'],
            'Institute_Cert' => $institute,
            'YearStarts' => $_POST['starts'],
            'MaritalStatus' => $_POST['marital'],
            'Email' => $_POST['newmail'],
            'Phone' => $_POST['newtelp']
        ];

        $update = $this->Mdl_profile->model_update_tch($selected_id, $table1, $table2);

        if ($update == TRUE) {
            $this->session->set_flashdata('updmsg', '<div class="alert alert-success text-center text-uppercase" role="alert"> Profile Updated </div>');
            redirect('Admin/load_prof_tch_edit');
        } else {
            $this->session->set_flashdata('updmsg', '<div class="alert alert-success text-center text-uppercase" role="alert"> No data updated! </div>');
            redirect('Admin/load_prof_tch_edit');
        }
    }

    public function update_img_tch()
    {
        $id = $this->uri->segment(3);

        $img_def = 'default.png';
        $img_name = 'img-' . $id . '-nonstd.jpg';

        $config = [
            'upload_path' => './assets/photos/teachers/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'file_name' => $img_name
        ];

        $this->load->library('upload', $config);

        //If there's image for ID already, delete the old one
        if (is_file('./assets/photos/teachers/' . $img_name)) {
            unlink('./assets/photos/teachers/' . $img_name);
        }

        //If Image has different extension, or no pic uploaded, set to default picture
        //If exist, upload the new picture to the destination
        if (!$this->upload->do_upload('image')) {
            $error_msg = $this->upload->display_errors();

            $this->Mdl_profile->model_upload_img_std($id, $img_def);

            $this->session->set_flashdata('disp_err', $error_msg);

            redirect('Admin/load_prof_tch_update/' . $id . '#tab_1_2', 'refresh');
        } else {
            // $this->upload->data(); //Upload data to upload_path

            //Compress uploaded image
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/photos/teachers/' . $img_name;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 800;
            $config['height'] = 800;
            $config['new_image'] = './assets/photos/teachers/' . $img_name;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $this->Mdl_profile->model_upload_img_std($id, $img_name);

            redirect('Admin/load_prof_tch_update/' . $id . '#tab_1_2', 'refresh');
        }
    }

    // ==================================================================================================================== \\
    // ==============================                     PROFILE STUDENT CONTROLLER         ============================== \\
    // ==================================================================================================================== \\
    public function load_prof_std_edit()
    {
        $std = 'student';

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'active_room' => $this->Mdl_profile->model_get_dropdown_active_rooms(),
        ];

        $this->load->view('admin/adm_prof_std_edit', $data);
    }

    public function ajax_get_students(){
        //FROM DATATABLE REQUEST HEADER
        $header = [
            'room' => $_POST['room'],
            'limit' => $_POST['length'],
            'start' => $_POST['start'],
            'order' => $_POST['order'],
            'search' => $_POST['search']['value'],
            'order_by' => $_POST['order'][0]['column'],
            'order_dir' => $_POST['order'][0]['dir']
        ];

        //DESTRUCTURING
        [$query, $total] = $this->Mdl_profile->get_student($header);

        $result = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $query->result()
        ];

        echo json_encode($result);
    }

    public function load_prof_std()
    {
        $id = $this->uri->segment(3);

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'std_t' => $this->Mdl_profile->get_full_info_std($id)

        ];

        $this->load->view('admin/adm_prof_std', $data);
    }

    //Page loads only when accessed through Edit Page
    //No Direct access from NAVBAR
    public function load_prof_std_add()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            //Dropdown
            'class' => $this->Mdl_profile->get_dropdown_class(),
            //'room' => $this->Mdl_profile->get_dropdown_room()
        ];

        $this->load->view('admin/adm_prof_std_add', $data);
    }

    public function get_room_from_selected_class()
    {
        $cls = $_POST['cls'];

        $query = $this->Mdl_profile->model_get_room_from_selected_class($cls);

        $value = '';
        foreach ($query as $row) {
            $value .= '<option value="' . $row->RoomDesc . '">' . $row->RoomDesc . '</option>';
        }

        echo $value;
    }

    public function load_prof_std_update()
    {
        $selected_id = $this->uri->segment(3);

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            //Dropdown for Subject
            'class' => $this->Mdl_profile->get_dropdown_class(),

            //Get data from ID that will be editted
            'datatoedit' => $this->Mdl_profile->get_full_info_std($selected_id)
        ];

        $this->load->view('admin/adm_prof_std_update', $data);

        return $selected_id;
    }

    //Called upon when load_prof_std_add pressed the button Save
    public function add_std()
    {
        $id = $this->Mdl_profile->get_new_std_id($_POST['classes']);

        $img = $_FILES['image']['name'];
        $img_name = 'img-' . $id . '-std.jpg';

        $config = [
            'upload_path' => './assets/photos/student/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'file_name' => $img_name
        ];

        $this->load->library('upload', $config);

        //If Image has different extension, or no pic uploaded, set to default picture
        //If exist, upload the new picture to the destination
        if ($img == '') {
            $img_name = 'default.png';
        }

        $Birth =  date('Y-m-d', strtotime(strtr($_POST['tgllhr'], '-', '/')));
        $keepkip = (isset($_POST['keepkip']) ? $_POST['keepkip'] : '');
        $ach = (isset($_POST['achievement']) ? $_POST['achievement'] : '');
        $achlvl = (isset($_POST['achievementlevel']) ? $_POST['achievementlevel'] : '');
        $scholar = (isset($_POST['scholarship']) ? $_POST['scholarship'] : '');

        $table1 = [
            //TAB 1
            'IDNumber' => $id,
            'FirstName' => ucfirst(strtolower($_POST['fname'])),
            'MiddleName' => ucfirst(strtolower($_POST['mname'])),
            'LastName' => ucfirst(strtolower($_POST['lname'])),
            'NickName' => ucfirst(strtolower($_POST['nname'])),
            'status' => 'student',
            'Gender' => $_POST['gender'],
            'PersonalID' => $_POST['nik'],
            'KK' => $_POST['kk'],
            'DateofBirth' => $Birth,
            'PointofBirth' => $_POST['tmplhr'],
            'BirthCertificate' => $_POST['akta'],
            'Religion' => $_POST['religion'],
            'Country' => $_POST['country'],
            'Disability' => $_POST['disabled'],
            'Address' => $_POST['address'],
            'RT' => $_POST['rt'],
            'RW' => $_POST['rw'],
            'Dusun' => $_POST['dusun'],
            'Village' => $_POST['village'],
            'District' => $_POST['district'],
            'Region' => $_POST['region'],
            'Postal' => $_POST['postal'],
            'Height' => $_POST['height'],
            'Weight' => $_POST['weight'],
            'HeadDiameter' => $_POST['headdiameter'],
            'Photo' => $img_name,
            'RegDate' => date('Y-m-d')
        ];

        $table2 = [
            'NIS' => $id,
            'NISN' => $_POST['nisn'],
            'Kelas' => $_POST['classes'],
            'Ruangan' => $_POST['room'],
            'Position' => '-',
            'Email' => $_POST['email'],
            'Phone' => $_POST['handheldnumber'],
            'HousePhone' => $_POST['housephone'],
            'LiveWith' => $_POST['livewith'],
            'AnakKe' => $_POST['child'],
            'Saudara' => $_POST['siblings'],
            'Father' => $_POST['father'],
            'FatherNIK' => $_POST['fathernik'],
            'FatherBorn' => $_POST['fatheryear'],
            'FatherDegree' => $_POST['fatherdegree'],
            'FatherJob' => $_POST['fatherjob'],
            'FatherIncome' => $_POST['fatherincome'],
            'FatherDisability' => $_POST['fatherdisabled'],
            'Mother' => $_POST['mother'],
            'MotherNIK' => $_POST['mothernik'],
            'MotherBorn' => $_POST['motheryear'],
            'MotherDegree' => $_POST['motherdegree'],
            'MotherJob' => $_POST['motherjob'],
            'MotherIncome' => $_POST['motherincome'],
            'MotherDisability' => $_POST['motherdisabled'],
            'Guardian' => $_POST['guardian'],
            'GuardianNIK' => $_POST['guardiannik'],
            'GuardianBorn' => $_POST['guardianyear'],
            'GuardianDegree' => $_POST['guardiandegree'],
            'GuardianJob' => $_POST['guardianjob'],
            'GuardianIncome' => $_POST['guardianincome'],
            'GuardianDisability' => $_POST['guardiandisabled'],
            'Transportation' => $_POST['transport'],
            'Range' => $_POST['range'],
            'ExactRange' => $_POST['exactrange'],
            'TimeRange' => $_POST['timerange'],
            'Latitude' => $_POST['lintang'],
            'Longitude' => $_POST['bujur'],
            'KIP' => $_POST['kip'],
            'Stayed_KIP' => $keepkip,
            'Refuse_PIP' => $_POST['refusepip'],
            'Achievement' => $ach,
            'AchievementLVL' => $achlvl,
            'AchievementName' => $_POST['ach_name'],
            'AchievementYear' => $_POST['ach_year'],
            'Sponsor' => $_POST['sponsor'],
            'AchievementRank' => $_POST['ach_rank'],
            'Scholarship' => $scholar,
            'ScholarDesc' => $_POST['scholardesc'],
            'ScholarStart' => $_POST['scholarstart'],
            'ScholarFinish' => $_POST['scholarfinish'],
            'Prosperity' => $_POST['prosperity'],
            'ProsperNumber' => $_POST['prospernumber'],
            'ProsperNameTag' => $_POST['prospernametag'],
            'Competition' => $_POST['competition'],
            'Registration' => $_POST['registration'],
            'PreviousSchool' => $_POST['previousschool'],
            'UNNumber' => $_POST['unnumber'],
            'Diploma' => $_POST['diploma'],
            'SKHUN' => $_POST['skhun']
        ];

        //Check if new ID already existed, to prevent collision
        $result = $this->db->query("SELECT IDNUmber FROM tbl_07_personal_bio WHERE IDNumber = '$id'")->row();

        if (empty($result)) {
            $result = $this->Mdl_profile->new_std($table1, $table2);

            if ($result == 'success') {
                // $this->upload->data(); //Upload data to upload_path
                if (!$this->upload->do_upload('image')) {
                    $error_msg = $this->upload->display_errors();

                    $this->session->set_flashdata('disp_err', "<div class=\"alert alert-success text-center text-uppercase\" role=\"alert\"> $errormsg </div>");
                } else {
                    $this->session->set_flashdata('addmsg', '<div class="alert alert-success text-center text-uppercase" role="alert"> New Teacher Added!!! </div>');
                }

                $this->session->set_flashdata('addmsg', '<div class="saved-success" data-id="' . $id . '"></div>');
                redirect('Admin/load_prof_std_edit');
            } else {
                $this->session->set_flashdata('errormsg', '<div class="error-alert"></div>');
                redirect('Admin/load_prof_std_edit');
            }
        } else {

            $this->session->set_flashdata('regismsg', '<div class="regis-alert" data-id="' . $id . '"></div>');
            redirect('Admin/load_prof_std_edit');
        }
    }

    public function update_std()
    {
        $selected_id = $this->uri->segment(3);

        //Get Date for DB Formatting
        $room = $_POST['room'];
        $Birth =  date('Y-m-d', strtotime(strtr($_POST['tgllhr'], '-', '/')));

        $keepkip = (isset($_POST['keepkip']) ? $_POST['keepkip'] : '-');
        $ach = (isset($_POST['achievement']) ? $_POST['achievement'] : '-');
        $achlvl = (isset($_POST['achievementlevel']) ? $_POST['achievementlevel'] : '-');
        $scholar = (isset($_POST['scholarship']) ? $_POST['scholarship'] : '-');

        $table1 = [
            //TAB 1
            'IDNumber' => $selected_id,
            'FirstName' => ucfirst(strtolower($_POST['fname'])),
            'MiddleName' => ucfirst(strtolower($_POST['mname'])),
            'LastName' => ucfirst(strtolower($_POST['lname'])),
            'NickName' => ucfirst(strtolower($_POST['nname'])),
            'status' => 'student',
            'Gender' => $_POST['gender'],
            'PersonalID' => $_POST['nik'],
            'KK' => $_POST['kk'],
            'DateofBirth' => $Birth,
            'PointofBirth' => $_POST['tmplhr'],
            'BirthCertificate' => $_POST['akta'],
            'Religion' => $_POST['religion'],
            'Country' => $_POST['country'],
            'Disability' => $_POST['disabled'],
            'Address' => $_POST['address'],
            'RT' => $_POST['rt'],
            'RW' => $_POST['rw'],
            'Dusun' => $_POST['dusun'],
            'Village' => $_POST['village'],
            'District' => $_POST['district'],
            'Region' => $_POST['region'],
            'Postal' => $_POST['postal'],
            'Height' => $_POST['height'],
            'Weight' => $_POST['weight'],
            'HeadDiameter' => $_POST['headdiameter']
        ];

        $table2 = [
            'NIS' => $selected_id,
            'NISN' => $_POST['nisn'],
            'Kelas' => $_POST['classes'],
            'Ruangan' => $_POST['room'],
            'Position' => '-',
            'Email' => $_POST['email'],
            'Phone' => $_POST['handheldnumber'],
            'HousePhone' => $_POST['housephone'],
            'LiveWith' => $_POST['livewith'],
            'AnakKe' => $_POST['child'],
            'Saudara' => $_POST['siblings'],
            'Father' => $_POST['father'],
            'FatherNIK' => $_POST['fathernik'],
            'FatherBorn' => $_POST['fatheryear'],
            'FatherDegree' => $_POST['fatherdegree'],
            'FatherJob' => $_POST['fatherjob'],
            'FatherIncome' => $_POST['fatherincome'],
            'FatherDisability' => $_POST['fatherdisabled'],
            'Mother' => $_POST['mother'],
            'MotherNIK' => $_POST['mothernik'],
            'MotherBorn' => $_POST['motheryear'],
            'MotherDegree' => $_POST['motherdegree'],
            'MotherJob' => $_POST['motherjob'],
            'MotherIncome' => $_POST['motherincome'],
            'MotherDisability' => $_POST['motherdisabled'],
            'Guardian' => $_POST['guardian'],
            'GuardianNIK' => $_POST['guardiannik'],
            'GuardianBorn' => $_POST['guardianyear'],
            'GuardianDegree' => $_POST['guardiandegree'],
            'GuardianJob' => $_POST['guardianjob'],
            'GuardianIncome' => $_POST['guardianincome'],
            'GuardianDisability' => $_POST['guardiandisabled'],
            'Transportation' => $_POST['transport'],
            'Range' => $_POST['range'],
            'ExactRange' => $_POST['exactrange'],
            'TimeRange' => $_POST['timerange'],
            'Latitude' => $_POST['lintang'],
            'Longitude' => $_POST['bujur'],
            'KIP' => $_POST['kip'],
            'Stayed_KIP' => $keepkip,
            'Refuse_PIP' => $_POST['refusepip'],
            'Achievement' => $ach,
            'AchievementLVL' => $achlvl,
            'AchievementName' => $_POST['ach_name'],
            'AchievementYear' => $_POST['ach_year'],
            'Sponsor' => $_POST['sponsor'],
            'AchievementRank' => $_POST['ach_rank'],
            'Scholarship' => $scholar,
            'ScholarDesc' => $_POST['scholardesc'],
            'ScholarStart' => $_POST['scholarstart'],
            'ScholarFinish' => $_POST['scholarfinish'],
            'Prosperity' => $_POST['prosperity'],
            'ProsperNumber' => $_POST['prospernumber'],
            'ProsperNameTag' => $_POST['prospernametag'],
            'PreviousSchool' => $_POST['previousschool'],
            'UNNumber' => $_POST['unnumber'],
            'Diploma' => $_POST['diploma'],
            'SKHUN' => $_POST['skhun']
        ];

        $update = $this->Mdl_profile->model_update_std($selected_id, $table1, $table2, $room);

        if ($update == 'success') {
            $this->session->set_flashdata('updmsg', '<div class="upd-success" data-id="' . $selected_id . '"> </div>');
            redirect('Admin/load_prof_std_update/' . $selected_id);
        } else {
            $this->session->set_flashdata('updmsg', '<div class="alert-upd" data-id="' . $selected_id . '"> </div>');
            redirect('Admin/load_prof_std_update/' . $selected_id);
        }
    }

    public function update_img_std()
    {
        $id = $this->uri->segment(3);

        $img_def = 'default.png';
        $img_name = 'img-' . $id . '-std.jpg';

        $config = [
            'upload_path' => './assets/photos/student/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'file_name' => $img_name
        ];

        $this->load->library('upload', $config);

        //If there's image for ID already, delete the old one
        if (is_file('./assets/photos/student/' . $img_name)) {
            unlink('./assets/photos/student/' . $img_name);
        }

        //If Image has different extension, or no pic uploaded, set to default picture
        //If exist, upload the new picture to the destination
        if (!$this->upload->do_upload('image')) {
            $error_msg = $this->upload->display_errors();

            $this->Mdl_profile->model_upload_img_std($id, $img_def);

            $this->session->set_flashdata('disp_err', $error_msg);

            redirect('Admin/load_prof_std_update/' . $id . '#tab_1_2', 'refresh');
        } else {
            // $this->upload->data(); //Upload data to upload_path

            //Compress uploaded image
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/photos/student/' . $img_name;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 800;
            $config['height'] = 800;
            $config['new_image'] = './assets/photos/student/' . $img_name;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $this->Mdl_profile->model_upload_img_std($id, $img_name);

            redirect('Admin/load_prof_std_update/' . $id . '#tab_1_2', 'refresh');
        }
    }

    // ==================================================================================================================== \\
    // ==============================                    ENROLLMENT CONTROLLER               ============================== \\
    // ==================================================================================================================== \\
    public function load_enroll()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            'total' => $this->Mdl_enroll->count_total(),
            'page' => $this->pagination->create_links()
        ];

        $this->load->view('admin/adm_enroll', $data);
    }

    //POST FROM ENROLLMENT FORM PAGE
    public function enroll_proceed()
    {
        $idrand = $this->input->post('fname') . date('h:m:s');

        $data = [
            'ListID' => md5($idrand),
            'FirstName' => $this->input->post('fname'),
            'MiddleName' => $this->input->post('mname'),
            'LastName' => $this->input->post('lname'),
            'NickName' => $this->input->post('nname'),
            'Gender' => $this->input->post('gender'),
            'DateofBirth' => $this->input->post('tgllhr'),
            'PointofBirth' => $this->input->post('tmplhr'),
            'Race' => $this->input->post('race'),
            'Religion' => $this->input->post('religion'),
            'Bloodtype' => $this->input->post('blood'),
            'Height' => $this->input->post('height'),
            'Weight' => $this->input->post('weight'),
            'Apply' => $this->input->post('level'),
            'PreviousSchool' => $this->input->post('prevsch'),
            'Address' => $this->input->post('address'),
            'District' => $this->input->post('district'),
            'Region' => $this->input->post('region'),
            'City' => $this->input->post('city'),
            'Province' => $this->input->post('prov'),
            'Country' => $this->input->post('country'),
            'Email' => $this->input->post('mail'),
            'Phone' => $this->input->post('phone'),
            'Parental' => $this->input->post('parental'),
            'Father' => $this->input->post('father'),
            'Mother' => $this->input->post('mother'),
            'FatherAddr' => $this->input->post('fatheraddr'),
            'MotherAddr' => $this->input->post('motheraddr'),
            'FatherJob' => $this->input->post('fatherjob'),
            'MotherJob' => $this->input->post('motherjob'),
            'FatherAge' => $this->input->post('fatherage'),
            'MotherAge' => $this->input->post('motherage'),
            'FatherEmail' => $this->input->post('fathermail'),
            'MotherEmail' => $this->input->post('mothermail'),
            'FatherPhone' => $this->input->post('fatherphone'),
            'MotherPhone' => $this->input->post('motherphone'),
            'Child' => $this->input->post('child'),
            'Sibling' => $this->input->post('sibling'),
            'Step' => $this->input->post('step'),
            'Foster' => $this->input->post('foster'),
            'RegDate' => date('Y-m-d')
        ];

        $this->Mdl_enroll->model_insert_enrolled($data);

        redirect('auth/enroll');
    }

    public function new_student_details()
    {
        $ctrlno = $_POST['ctrlno'];

        $result = $this->Mdl_enroll->model_student_details($ctrlno);

        echo json_encode($result);
    }

    public function get_list_enroll()
    {
        $rows = 30;

        $config = [
            'base_url' => base_url('admin/load_enroll'),
            'use_page_numbers' => TRUE,
            'total_rows' => $this->Mdl_enroll->count_total(),
            'per_page' => $rows,
            'uri_segment' => 3,
            'num_links' => 5,
            'attributes' => [
                'class' => 'pagin',
            ],

            'full_tag_open' => '<div class="pagging"><nav><ul class="pagination pagination-lg">',
            'full_tag_close' => '</ul></nav></div>',

            'num_tag_open' => '<li class="page-item"><span class="page-link">',
            'num_tag_close' => '</span></li>',

            'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close' => '<span class="sr-only">(current)</span></span></li>',

            'next_tag_open' => '<li class="page-item"><span class="page-link">',
            'next_tag_close' => '<span aria-hidden="true"></span></span></li>',

            'prev_tag_open' => '<li class="page-item"><span class="page-link">',
            'prev_tag_close' => '</span></li>',

            'first_tag_open' => '<li class="page-item"><span class="page-link">',
            'first_tag_close' => '</span></li>',

            'last_tag_open' => '<li class="page-item"><span class="page-link">',
            'last_tag_close' => '</span></li>'
        ];

        $this->pagination->initialize($config);

        $index = $this->uri->segment(3);
        $start = ($index - 1) * $rows;

        $page = $this->pagination->create_links();

        $record = $this->Mdl_enroll->get_enrollment($start, $rows)->result();

        $today = date('Y-m-d');

        $index = 1;
        $value = '';
        foreach ($record as $row) {
            if ($row->Gender == 'Laki-Laki') {
                $gender = 'Male';
            } elseif($row->Gender == 'Perempuan') {
                $gender = 'Female';
            }else{
                $gender = '';
            }

            $agecount = date_diff(date_create($row->DateofBirth), date_create($today));
            $value .= ' <tr data-list="' . $row->CtrlNo . '">
                            <td> ' . $index . ' </td>
                            <td> <a href="#" data-id="' . $row->CtrlNo . '"> ' . $row->FirstName . ' ' . $row->LastName . ' </a> </td>
                            <td> ' . $row->DateofBirth . ' </td>
                            <td> ' . $agecount->format('%y') . ' </td>
                            <td> ' . $gender . ' </td>
                            <td> ' . $row->PreviousSchool . ' </td>
                            <td> ' . $row->Address . ' </td>
                            <td> ' . $row->Applying . ' </td>
                            <td> ' . date('d-m-Y', strtotime($row->RegDate)) . ' </td>
                            <td>
                                <div class="btn-group btn-group-solid">
                                    <button type="button" class="btn green detail" data-id="' . $row->CtrlNo . '" style="min-width: 80px; margin-right: 6px; margin-bottom: 5px">Details</button>';
            if($row->is_approved){
                $value .= '         <button type="button" class="btn blue approve" data-email="'.$row->Email.'" data-apply="'.$row->Applying.'" style="min-width: 80px; margin-right: 6px; margin-bottom: 5px">Approve</button>';
                $value .= '         <button type="button" class="btn yellow-saffron approve_enroll" data-id="' . $row->CtrlNo . '" style="min-width: 80px; margin-right: 6px; margin-bottom: 5px">Evaluate</button>';
            }else{
                $value .= '         <button type="button" class="btn yellow-saffron approve_enroll" data-id="' . $row->CtrlNo . '" style="min-width: 80px; margin-right: 6px; margin-bottom: 5px">Evaluate</button>';
            }
            $value .= '             <button type="button" class="btn red cancel" style="min-width: 80px;"> Delete </button>
                                </div>
                            </td>
                        </tr>';
            $index++;
        }

        $data = array(
            'page' => $page,
            'value' => $value
        );

        $JSON = json_encode($data);

        echo $JSON;
    }

    public function get_dropdown_apply()
    {
        $email = $_POST['email'];
        $apply = $_POST['apply'];

        $query = $this->Mdl_enroll->model_get_dropdown_apply($apply, $email);

        $value = '';
        $value .= '<div class="form-group form-md-line-input has-info" style="width: 60%;">
                        <select class="form-control" name="room" id="form_control_1">';
        foreach ($query as $row) {
            $value .= '         <option value="' . $row->RoomDesc . '">' . $row->RoomDesc . '</option>';
        }
        $value .= '      </select>
                    </div>';

        echo $value;
    }

    public function ajax_get_target_files(){
        $id = $_POST['unique'];

        $result = $this->db->select(
            'DiplomaFile, BirthcertFile, KKFile, Photo, SPP, 
             is_approved_diploma, is_approved_birthcert, is_approved_kk, is_approved_photo, is_approved_spp,
             unapproved_diploma_msg, unapproved_birthcert_msg, unapproved_kk_msg, unapproved_photo_msg, unapproved_spp_msg')->get_where('tbl_11_enrollment', ['CtrlNo' => $id])->row();

        $data = [
            'data' => $result
        ];

        echo json_encode($data);
    }

    public function evaluate_data(){
        $id = $_GET['id'];
        
        $data = [
            'is_approved_diploma' => (isset($_POST['checkdiploma']) ? 1 : 0),
            'is_approved_birthcert' => (isset($_POST['checkbirthcert']) ? 1 : 0),
            'is_approved_kk' => (isset($_POST['checkkk']) ? 1 : 0),
            'is_approved_photo' => (isset($_POST['checkphoto']) ? 1 : 0),
            'is_approved_spp' => (isset($_POST['checkspp']) ? 1 : 0),
            'unapproved_diploma_msg' => (isset($_POST['notediploma']) ? $_POST['notediploma'] : ''),
            'unapproved_birthcert_msg' => (isset($_POST['notebirthcert']) ? $_POST['notebirthcert'] : ''),
            'unapproved_kk_msg' => (isset($_POST['notekk']) ? $_POST['notekk'] : ''),
            'unapproved_photo_msg' => (isset($_POST['notephoto']) ? $_POST['notephoto'] : ''),
            'unapproved_spp_msg' => (isset($_POST['notespp']) ? $_POST['notespp'] : ''),
        ];

        $result = $this->Mdl_enroll->set_evaluation($id, $data);

        echo $result;
    }

    public function approve_list()
    {
        $data = [
            'uniq' => $_POST['uniq'],
            'room' => $_POST['room']
        ];

        [$ID, $email, $school] = $this->Mdl_enroll->set_approve($data);

        $total = $this->Mdl_enroll->count_total();

        // $mail = new PHPMailer(TRUE);
            
        //Server settings
        // $mail->SMTPDebug  = SMTP::DEBUG_SERVER;                  //Enable verbose debug output
        // $mail->isSMTP();                                            //Send using SMTP
        // $mail->Host       = 'smtp.googlemail.com';                  //Set the SMTP server to send through
        // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        // $mail->Username   = 'leitto.ibtj@gmail.com';                //SMTP username
        // $mail->Password   = '172304200124';                         //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged [FOR LOCALHOST TEST USE THIS]
        // // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //PHPMailer::ENCRYPTION_SMTPS is encouraged
        // $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        // $mail->isHTML(true);                                        //Set Body format to HTML

        // //Recipients
        // $mail->setFrom('kaaenrollmentabase@kaa.sch.id', 'KAA Registration');
        // $mail->addAddress($email, $_POST['firstname'] . ' ' . $_POST['lastname']);     //Add a recipient

        // //Content
        // $mail->Subject = "$school | ACTIVE STUDENT CREDENTIALS";
        // $mail->Body    = "<strong style=\"text-style:italic;color:green;\">Congratulations! you are now an active student.</strong> 
        //                   <br>
        //                   You can now login to KAA Academic with the provided IDNumber and Password:
        //                   <br><br>
        //                   <strong> Username:  $ID </strong>
        //                   <br>
        //                   <strong> Password:  123456 </strong>
        //                   <br><br>
        //                   <strong style=\"text-style:italic;color:red;\">You are no longer able to sign-in using your email</strong>
        //                   <br><br>
        //                   For more information, contact the school administration. 
        //                   <br>
        //                   <span style=\"text-style:italic;color:#008CBA;\">
        //                       This is an automatic notification which will not be responded to any further replies
        //                   </span>.";

        // $mail->send();

        echo $total;
    }

    public function cancel_list()
    {
        $uniq = $_POST['uniq'];

        $this->Mdl_enroll->remove_list($uniq);

        $total = $this->Mdl_enroll->count_total();

        echo $total;
    }

    //Start - Admin New Build
    public function home()
    {
        $data = [
            'title' => 'Main Dashboard',
            'currentdate' => date('Y-m-d'),
            'data_duty_all_by_date' => $this->Mdl_duty->get_list_data_duty_all_by_date(date('Y-m-d')),
            'tch' => $this->Mdl_index->count_specific('teacher'),
            'std' => $this->Mdl_index->count_specific('student'),
            'stf' => $this->Mdl_index->count_specific('staff'),
            'count' => $this->Mdl_index->count_total(),
            'tch_t' => $this->Mdl_index->get_teachers('teacher'),
            'std_t' => $this->Mdl_index->get_student('student'),
            'stf_t' => $this->Mdl_index->get_staff('staff'),
            'degree_active' => $this->db->select('School_Desc')->where('isActive', 1)->get('tbl_02_school')->result()
        ];

        $this->load->view('admin/home', $data);
    }
    //End - Admin New Build
}
