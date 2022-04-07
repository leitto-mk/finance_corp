<?php

defined('BASEPATH') or exit('No direct script access allowed');

class FinanceCorp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_corp_master', 'master');
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'h2' => 'Master & Settings',
            'company' => $this->master->M_get_company(),
            'storagecode' => $this->master->get_last_storagecode(),

            'script' => 'master'
        ];
       
        $this->load->view('financecorp/dashboard/v_home_3', $data);
    }

    public function not_found()
    {
        $this->load->view('financecorp/dashboard/404');
    }
}
