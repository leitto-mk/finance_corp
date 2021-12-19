<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class Cash_adv extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('financecorp/Mdl_corp_treasury');
    }

    //Corporation Finance
    function index(){
        $data = [
            'title' => 'Cash Advance',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => '',
        ];
        
        $this->load->view('finance_corp/cashadvance/v_cash_advance_corp', $data);
    }

    function view_ca_statement(){
        $data = [
            'title' => 'Cash Advance Statement',
            'h1' => 'Personal',
            'h2' => 'Statement',
            'h3' => '',

            //List
            'employees' => $this->Mdl_corp_treasury->get_ca_employees(),

            //SCRIPT
            'script' => 'cash_advance/ca_statement'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_ca_statement', $data);
    }

    function ajax_get_emp_details(){
        $id = $_POST['id'];

        echo json_encode($this->Mdl_corp_treasury->get_ca_registered_ids($id));
    }

    function ca_outstanding_report(){
        $data = [
            'title' => 'Cash Advance Outstanding Report',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => 'Outstanding',
            'h4' => 'Report'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_ca_outstanding_report', $data);
    }

    function ca_transaction_details(){
        $data = [
            'title' => 'Cash Advance Transaction Details',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => 'Transaction',
            'h4' => 'Details'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_ca_transaction_details', $data);
    }

    function ca_request_report(){
        $data = [
            'title' => 'Cash Advance Request Report',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => 'Request',
            'h4' => 'Report'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_ca_request_report', $data);
    }
}


  