<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sign extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth/M_confirm_student');
    }

    public function index()
    {
        $data = [
            'schools' => $this->M_confirm_student->get_active_school()
        ];

        $this->load->view('sign/v_sign_in', $data);
    }

    public function ajax_submit_data(){
        $data = [
            'FirstName' => $_POST['firstname'],
            'LastName' => $_POST['lastname'],
            'DateofBirth' => $_POST['dateofbirth'],
            'Email' => $_POST['email'],
            'Registration' => $_POST['student_type'],
            'Applying' => $_POST['school'],
            'previousschool' => $_POST['previousschool']
        ];

        $checkMail = $this->db->get_where('tbl_11_enrollment', ['Email' => $data['Email']])->num_rows();

        if($checkMail > 0){
            $response = [
                'result' => 'EMAIL_REGISTERED'
            ];
        }else{
            $result = $this->M_confirm_student->confirm($data);
    
            $response = [
                'result' => $result,
                'email' => $_POST['email']
            ];
        }

        echo json_encode($response);
    }
}
