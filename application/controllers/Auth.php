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
            if ($pass === $user->password) {
                if ($user->status == 'admin') {
                    $data = [
                        'id' => $user->IDNumber,
                        'fname' => $user->FirstName,
                        'lname' => $user->LastName,
                        'status' => $user->status,
                        'photo' => $user->Photo,
                        'jobdesc' => $user->JobDesc,
                        'homeroom' => $user->Homeroom,
                        'subjteach' => $user->SubjectTeach,
                        'studyfocus' => $user->StudyFocus
                    ];

                    $this->session->set_userdata($data);

                    redirect('Admin/index');
                } elseif ($user->status == 'teacher' || $user->status == 'staff') {
                    $data = [
                        'id' => $user->IDNumber,
                        'fname' => $user->FirstName,
                        'lname' => $user->LastName,
                        'status' => $user->status,
                        'photo' => $user->Photo,
                        'jobdesc' => $user->JobDesc,
                        'homeroom' => $user->Homeroom,
                        'subjteach' => $user->SubjectTeach,
                        'studyfocus' => $user->StudyFocus
                    ];

                    $this->session->set_userdata($data);

                    redirect('Teacher/index');
                } elseif ($user->status == 'student') {
                    $data = [
                        'id' => $user->IDNumber,
                        'fname' => $user->FirstName,
                        'lname' => $user->LastName,
                        'status' => $user->status,
                        'cls' => $user->Kelas,
                        'room' => $user->Ruangan,
                        'photo' => $user->Photo
                    ];

                    $this->session->set_userdata($data);

                    redirect('Student/index');
                } else {
                    redirect('auth/index');
                }
            } else {
                redirect('auth/index');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('Auth/index');
    }
}
