<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class Acc_rec extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    //Student Finance
    public function index(){
        $data = [
            'title' => 'Student Account Receivable',
            'h1' => 'Student',
            'h2' => 'Account',
            'h3' => 'Receivable',
        ];
        
        $this->load->view('finance/receivable/v_std_acc_rec', $data);
    }

    public function ar_aging_ctrl(){
        $data = [
            'title' => 'AR Aging Control',
            'h1' => 'Account',
            'h2' => 'Receivable',
            'h3' => 'Aging',
            'h4' => 'Control'
        ];
        $this->load->view('finance/receivable/v_ar_aging_ctrl', $data);
    }

    public function ar_aging_sum(){
        $data = [
            'title' => 'AR Aging Summary',
            'h1' => 'Account',
            'h2' => 'Receivable',
            'h3' => 'Aging',
            'h4' => 'Summary'
        ];
        $this->load->view('finance/receivable/v_ar_aging_sum', $data);
    }

    public function ar_aging_det(){
        $data = [
            'title' => 'AR Aging Details',
            'h1' => 'Accounts',
            'h2' => 'Receivable',
            'h3' => 'Aging',
            'h4' => 'Details'
        ];
        $this->load->view('finance/receivable/v_ar_aging_det', $data);
    }


    //Corporation Finance
    public function index2(){
        $data = [
            'title' => 'Account Recevable',
            'h1' => 'Account',
            'h2' => 'Receivable',
            'h3' => '',
        ];
        
        $this->load->view('financecorp/receivable/v_acc_rec_corp', $data);
    }

    public function view_receipt_payment(){
        $data = [
            'title' => 'Receipt Payment',
            'h1' => 'Account',
            'h2' => 'Receivable',
            'h3' => '',
            'h4' => ''
        ];
        
        $this->load->view('financecorp/receivable/v_receipt_payment', $data);
    }

    public function add_receipt_payment(){
        $data = [
            'title' => 'Form Receipt Payment',
        
            'script' => 'add/fincorp_add_receipt'
        ];
        
        $this->load->view('financecorp/receivable/v_add_receipt_payment', $data);
    }

    public function ar_aging_summary(){
        $data = [
            'title' => 'Aging Report Summary',
            'h1' => 'Account',
            'h2' => 'Receivable',
            'h3' => 'Aging',
            'h4' => 'Summary'
        ];
        
        $this->load->view('financecorp/receivable/v_ar_aging_sum', $data);
    }

    public function ar_aging_detail(){
        $data = [
            'title' => 'Aging Report Detail',
            'h1' => 'Account',
            'h2' => 'Receivable',
            'h3' => 'Aging',
            'h4' => 'Details'
        ];
        
        $this->load->view('financecorp/receivable/v_ar_aging_det', $data);
    }

    public function ar_aging(){
        $data = [
            'title' => 'Aging Report Receivable',
            'h1' => 'Account',
            'h2' => 'Receivable',
            'h3' => 'Aging',
            'h4' => ''
        ];
        
        $this->load->view('financecorp/receivable/v_ar_aging', $data);
    }

}


  