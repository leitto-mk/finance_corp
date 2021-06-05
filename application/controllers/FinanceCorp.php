<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class FinanceCorp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('financecorp/Mdl_corp_branch');
        $this->load->model('financecorp/Mdl_corp_personal');
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
        $branch = 'All';
        $accno_start = $this->db->select('Acc_No')->order_by('Acc_No','ASC')->limit(1)->get('tbl_12_fin_account_no')->row()->Acc_No;
        $accno_finish = $this->db->select('Acc_No')->order_by('Acc_No','DESC')->limit(1)->get('tbl_12_fin_account_no')->row()->Acc_No;
        $datestart = date('Y-01-01');
        $datefinish = date('Y-m-d');

        $data = [
            //HEADER
            'title' => 'General Ledger',
            'h1' => 'General',
            'h2' => 'Ledger',
            'h3' => '(Branch)',

            //FILTER
            'active_school' => $this->Mdl_corp_branch->get_active_school(),
            'account_no' => $this->Mdl_corp_branch->get_account_no(),

            //LEDGER TABLE
            'ledger' => $this->Mdl_corp_branch->get_general_ledger($branch, $accno_start, $accno_finish, $datestart, $datefinish),

            //SCRIPT
            'script' => 'fincorp_gl_branch'
        ];
        
        $this->load->view('finance_corp/v_gl_branch', $data);
    }

    function ajax_get_general_ledger(){
        $branch = $_POST['branch'];
        $accno_start = $_POST['accno_start'];
        $accno_finish = $_POST['accno_finish'];
        $date_start = $_POST['date_start'];
        $date_finish = $_POST['date_finish'];

        $result = $this->Mdl_corp_branch->get_general_ledger($branch, $accno_start, $accno_finish, $date_start, $date_finish);

        echo json_encode($result);
    }

    function view_gl_personal()
    {
        $data = [
            'title' => 'Sub Ledger',
            'h1' => 'Sub',
            'h2' => 'Ledger',
            'h3' => '(Personal)',

            'ledger' => $this->Mdl_corp_personal->get_general_ledger()
        ];
        
        $this->load->view('finance_corp/v_gl_personal', $data);
    }

}