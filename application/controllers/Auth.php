<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    //Constructor to load premises permanently (ex, validation, form_validation)
    public function __construct()
    {
        parent::__construct();

        $this->load->model('auth/M_check_cred');
    }

    //Controller for Authentication index
    public function index()
    {
        $data['title'] = 'User Login Panel';

        $this->load->view('auth/login', $data);
    }

    public function enroll()
    {
        $data['title'] = 'Form Registration';

        $this->load->view('auth/new_std_enroll', $data);
    }

    public function login()
    {
        $id = $this->input->post('username');
        $pwd =  $this->input->post('password');
        $pass = md5($pwd);
        
        $user = $this->M_check_cred->check_login($id);

        if (empty($user) || $user == 'empty'){
            redirect('auth/index');
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
                        'homeroom' => $user->Homeroom,
                        'subjteach' => $user->SubjectTeach,
                        'studyfocus' => $user->StudyFocus
                    ];

                    $this->session->set_userdata($data);

                    redirect('Admin/home');
                } elseif ($user->status == 'board') {
                    $data = [
                        'id' => $user->IDNumber,
                        'fname' => $user->FirstName,
                        'lname' => $user->LastName,
                        'status' => $user->status,
                        'period' => $schYear,
                        'semester' => $semester,
                        'photo' => $user->Photo,
                        'jobdesc' => $user->JobDesc,
                        'homeroom' => $user->Homeroom,
                        'subjteach' => $user->SubjectTeach,
                        'studyfocus' => $user->StudyFocus
                    ];

                    $this->session->set_userdata($data);

                    redirect('Board/home');
                } elseif ($user->status == 'teacher' || $user->status == 'staff') {
                    $data = [
                        'id' => $user->IDNumber,
                        'fname' => $user->FirstName,
                        'lname' => $user->LastName,
                        'status' => $user->status,
                        'period' => $schYear,
                        'semester' => $semester,
                        'photo' => $user->Photo,
                        'jobdesc' => $user->JobDesc,
                        'homeroom' => $user->Homeroom,
                        'subjteach' => $user->SubjectTeach,
                        'studyfocus' => $user->StudyFocus
                    ];

                    $this->session->set_userdata($data);

                    redirect('Teacher/home');
                } elseif ($user->status == 'student') {
                    $data = [
                        'id' => $user->IDNumber,
                        'fname' => $user->FirstName,
                        'lname' => $user->LastName,
                        'status' => $user->status,
                        'period' => $schYear,
                        'semester' => $semester,
                        'cls' => $user->Kelas,
                        'room' => $user->Ruangan,
                        'photo' => $user->Photo
                    ];

                    $this->session->set_userdata($data);

                    redirect('Student/home');
                } else {
                    redirect('Auth/index');
                }
            } else {
                redirect('Auth/index');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('Auth/index');
    }
}
