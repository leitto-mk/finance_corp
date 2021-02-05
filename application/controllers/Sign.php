<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sign extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('sign/v_sign_in');
    }


}
