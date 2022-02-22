<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class FinanceCorp extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $data['title'] = 'Dashboard';
        
        $this->load->view('financecorp/dashboard/v_home_2', $data);
    }

    public function not_found(){
        $this->load->view('financecorp/dashboard/404');
    }
}