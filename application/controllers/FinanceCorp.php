<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class FinanceCorp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // function view_dashboard()
    // {
    //     $data['title'] = 'Dashboard';
    //     $this->load->view('student_finance_n/v_home_n', $data);
    // }

    // function view_student_charge()
    // {
    //     $data['title'] = 'List Student Charge';
    //     $this->load->view('student_finance_n/v_student_charge', $data);
    // }

    // function view_receipt_voucher()
    // {
    //     $data['title'] = 'List Receipt Voucher';
    //     $this->load->view('student_finance_n/v_receipt_voucher', $data);
    // }

    // function view_ar_aging_control()
    // {
    //     $data['title'] = 'Aged Due Control';
    //     $this->load->view('student_finance_n/v_ar_aging_control', $data);
    // }

    // function view_student_matrix()
    // {
    //     $data['title'] = 'List Student Matrix';
    //     $this->load->view('student_finance_n/v_student_matrix', $data);
    // }

    // function view_add_std_charge()
    // {
    //     $data['title'] = 'Form Student Charge';
    //     $this->load->view('student_finance_n/v_add_std_charge', $data);
    // }

    // function view_add_rec_voucher()
    // {
    //     $data['title'] = 'Form Receipt Voucher';
    //     $this->load->view('student_finance_n/v_add_rec_voucher', $data);
    // }



    //For Finance Corporate
    function index()
    {
        $data['title'] = 'Dashboard';
        
        $this->load->view('finance_corp/dashboard/v_home', $data);
    }

    function view_receipt_voucher()
    {
        $data['title'] = 'List Receipt Voucher';
        
        $this->load->view('finance_corp/v_receipt_voucher', $data);
    }

    function add_payment_voucher()
    {
        $data['title'] = 'Form Payment Voucher';
        
        $this->load->view('finance_corp/v_add_payment_voucher', $data);
    }

    function view_payment_voucher()
    {
        $data['title'] = 'List Payment Voucher';
        
        $this->load->view('finance_corp/v_payment_voucher', $data);
    }

    function add_receipt_voucher()
    {
        $data['title'] = 'Form Receipt Voucher';
        
        $this->load->view('finance_corp/v_add_receipt_voucher', $data);
    }

    function view_overbook_voucher()
    {
        $data['title'] = 'List Overbook Voucher';
        
        $this->load->view('finance_corp/v_overbook_voucher', $data);
    }

    function add_overbook_voucher()
    {
        $data['title'] = 'Form Overbook Voucher';
        
        $this->load->view('finance_corp/v_add_overbook_voucher', $data);
    }

    function view_general_journal()
    {
        $data['title'] = 'List General Journal';
        
        $this->load->view('finance_corp/v_general_journal', $data);
    }

    function add_general_journal()
    {
        $data['title'] = 'Form General Journal';
        
        $this->load->view('finance_corp/v_add_general_journal', $data);
    }

    function add_ca_withdrawl()
    {
        $data['title'] = 'Form Cash Advance Withdrawl';
        
        $this->load->view('finance_corp/v_add_ca_withdrawl', $data);
    }

    function add_ca_receipt()
    {
        $data['title'] = 'Form Cash Advance Receipt';
        
        $this->load->view('finance_corp/v_add_ca_receipt', $data);
    }

    function view_gl()
    {
        $data['title'] = 'General Ledger';
        $data['h1'] = 'General';
        $data['h2'] = 'Ledger';
        $data['h3'] = '(All)';
        
        $this->load->view('finance_corp/v_gl', $data);
    }

    function view_gl_branch()
    {
        $data['title'] = 'General Ledger';
        $data['h1'] = 'General';
        $data['h2'] = 'Ledger';
        $data['h3'] = '(Branch)';
        
        $this->load->view('finance_corp/v_gl_branch', $data);
    }

    function view_gl_personal()
    {
        $data['title'] = 'Sub Ledger';
        $data['h1'] = 'Sub';
        $data['h2'] = 'Ledger';
        $data['h3'] = '(Personal)';
        
        $this->load->view('finance_corp/v_gl_personal', $data);
    }

}


  