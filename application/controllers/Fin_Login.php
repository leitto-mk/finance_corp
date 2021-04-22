<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fin_Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('auth/M_check_cred');
    }

    // public function index(){
    //     $dataval = $this->M_fin_auth->get_validate();                
    //     foreach ($dataval as $row) {
    //         $date = $row->trial;
    //         $dates = date_create($date);
    //         $due_date = date_format($dates, 'Y-m-d');
    //         $this->session->set_userdata('dueDate', $due_date);
    //         $comparisonDate = date('Y-m-d', strtotime('-15 days', strtotime($row->trial)));
    //         $comparisonDate2 = date('Y-m-d', strtotime('30 days', strtotime($row->trial)));            
    //         //Future date
    //         $future = strtotime($due_date); 
    //         $timefromdb = strtotime(date("Y-m-d"));
    //         $timeleft = $future-$timefromdb;
    //         $daysleft = round((($timeleft/24)/60)/60);

    //         $data['daysleft'] = $daysleft;

    //         if (date("Y-m-d") < $comparisonDate) {
    //             $data['rem'] = "false";
    //             $this->load->view('login_metro/v_login', $data);
    //         }else if((date("Y-m-d") >= $comparisonDate) && (date("Y-m-d") < $due_date)){
    //             $data['rem'] = "true";
    //             #view login warning 15 days to expire
    //             $this->load->view('login_metro/v_login', $data);
    //         }else if((date('Y-m-d') >= $due_date) && (date('Y-m-d') <= $comparisonDate2)){
    //             #view login read only mode
    //             $this->load->view('login_metro/v_login_read_only', $data);
    //         }else {
    //             #system lock
    //             $this->load->view('login_metro/v_login_system_lock', $data);
    //         }
    //     }
    // }

    // function validate_license(){  
    //     $license = $this->input->post('license');
    //     $ab = 'ab';
    //     $md5pass = md5($license);
    //     $cek = sha1($md5pass);        

    //     $data['cek'] = $this->M_fin_auth->ceklicense();

    //     foreach ($data['cek'] as $row) {            
    //         $kode = $row->kode;
    //         if ($kode == $cek) {                
    //             $query['data'] = $this->M_fin_auth->getDurasi($cek);
    //             foreach ($query['data'] as $baris) {
    //                 $durasi = $baris->durasi;
    //                 $max = $baris->max;
    //                 $query['update'] = $this->M_fin_auth->updatedate($kode, $durasi, $max);
    //                 if ($query['update'] == true) {                        
    //                     redirect('Login');
    //                 } else {
    //                     $this->session->set_flashdata('notif', '<div class="alert alert-warning"><center><font color="red">Invalid License</font></center></div>');
    //                     redirect('Login');
    //                 }
    //             }
    //         } else {
    //             $this->session->set_flashdata('notif', '<div class="alert alert-warning"><center><font color="red">Invalid License</font></center></div>');
    //             redirect('Login');
    //         }
    //     } 
    // }

    // function get_browser_and_ip(){
    //     // Get Browser
    //     $browser = '';
    //     $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
    //     if (preg_match('~(?:msie ?|trident.+?; ?rv: ?)(\d+)~', $ua, $matches)) $browser = 'ie ie'.$matches[1];
    //     elseif (preg_match('~(safari|chrome|firefox)~', $ua, $matches)) $browser = $matches[1];
    //     // get Ip Address
    //     $localIP = gethostbyname(trim(exec("hostname")));
    //     return array('ip' => $localIP, 'browser' => $browser);
    // }

    function index(){
        $this->load->view('auth/fin_login');
    }

    function verify_user(){
        $id = $_POST['uname'];
        $pwd =  $_POST['upass'];
        $pass = md5($pwd);
        
        $user = $this->M_check_cred->check_login($id);

        if (empty($user) || $user == 'empty'){
            redirect('auth/fin_login');
        } else {
            $schYear = '';
            $semester = '';

            $time = date('d-m-Y');
            $year = date('Y');

            if (date('n', strtotime($time)) <= 6) {
                $schYear = ($year - 1) . '/' . $year;
                $semester = 2;
            } else {
                $schYear = $year . '/' . ($year + 1);
                $semester = 1;
            }

            if ($pass === $user->password) {
                if ($user->status == 'admin') {
                    $data = [
                        'id' => $user->IDNumber,
                        'fname' => $user->FirstName,
                        'lname' => $user->LastName,
                        'status' => $user->status,
                        'period' => $schYear,
                        'semester' => $semester,
                        'photo' => $user->Photo,
                        'jobdesc' => $user->JobDesc,
                        'homeroom' => $user->Homeroom
                    ];

                    $this->session->set_userdata($data);
                 
                    redirect('Finance');
                }
            } else {
                redirect('Fin_Login');
            }
        }      
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('Auth/index');
    }
}
