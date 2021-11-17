<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class Acc_pay extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    //Corporation Finance
     function index2(){
        $data = [
            'title' => 'Account Payable',
            'h1' => 'Account',
            'h2' => 'Payable',
            'h3' => '',
        ];
        
        $this->load->view('finance_corp/payable/v_acc_pay_corp', $data);
    }

    function view_payment_po(){
        $data = [
            'title' => 'Payment PO',
            'h1' => 'Account',
            'h2' => 'Payable',
            'h3' => '',
            'h4' => ''
        ];
        
        $this->load->view('finance_corp/payable/v_payment_po', $data);
    }

    function add_payment_po(){
        $data = [
            'title' => 'Form Payment PO',
        
            'script' => 'add/fincorp_add_receipt'
        ];
        
        $this->load->view('finance_corp/payable/v_add_payment_po', $data);
    }


    function ap_aging_summary(){
        $data = [
            'title' => 'Aging Report Summary',
            'h1' => 'Account',
            'h2' => 'Payable',
            'h3' => 'Aging',
            'h4' => 'Summary'
        ];
        
        $this->load->view('finance_corp/payable/v_ap_aging_sum', $data);
    }

    function ap_aging_detail(){
        $data = [
            'title' => 'Aging Report Detail',
            'h1' => 'Account',
            'h2' => 'Payable',
            'h3' => 'Aging',
            'h4' => 'Details'
        ];
        
        $this->load->view('finance_corp/payable/v_ap_aging_det', $data);
    }

}


  