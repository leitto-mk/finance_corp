<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class FinanceCorp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('financecorp/Mdl_corp_receipt');
        $this->load->model('financecorp/Mdl_corp_payment');
        $this->load->model('financecorp/Mdl_corp_overbook');
        $this->load->model('financecorp/Mdl_corp_branch');
        $this->load->model('financecorp/Mdl_corp_personal');
    }

    //DASHBOARD
    function index()
    {
        $data['title'] = 'Dashboard';
        
        $this->load->view('finance_corp/dashboard/v_home', $data);
    }

    //RECEIPT VOUCHER
    function view_receipt_voucher()
    {
        $data['title'] = 'List Receipt Voucher';
        
        $this->load->view('finance_corp/v_receipt_voucher', $data);
    }

    function add_receipt_voucher()
    {
        $data = [
            'title' => 'Form Receipt Voucher',
            
            'docno' => $this->Mdl_corp_receipt->get_new_receipt_docno(),
            'accno' => $this->Mdl_corp_receipt->get_mas_acc(),
            'branch' => $this->Mdl_corp_receipt->get_branch(),
            'employee' => $this->Mdl_corp_receipt->get_employee(),
            'currency' => $this->Mdl_corp_receipt->get_currency(),

            'script' => 'fincorp_add_receipt'
        ];
        
        $this->load->view('finance_corp/v_add_receipt_voucher', $data);
    }

    public function ajax_submit_receipt(){
        $master = $details = $trans = [];

        $cur_nis = '';
        $cur_branch = '';
        $itemno = 0;

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_receipt->get_branch_last_balance($_POST['branch'], $_POST['accno']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E'){
            $counter_balance = ($counter_beg_bal + $_POST['totalamount']) -  0;
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];    
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
            'TransDate' => $_POST['transdate'],
            'TransType' => 'RECEIPT',
            'JournalGroup' => $_POST['journalgroup'],
            'Branch' => $_POST['branch'],
            'Department' => '',
            'CostCenter' => '',
            'Giro' => $_POST['giro'],
            'ItemNo' => $itemno,
            'AccNo' => $_POST['accno'],
            'AccType' => $acctype,
            'IDNumber' => $_POST['paidto'],
            'Currency' => 'IDR',
            'Rate' => 1,
            'Unit' => $_POST['totalamount'],
            'Amount' => $_POST['totalamount'],
            'Debit' => $_POST['totalamount'],
            'Credit' => 0,
            'Balance' => 0,
            'BalanceBranch' => $counter_balance,
            'Remarks' => $_POST['remark'],
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $_POST['docno'],
            'IDNumber' => $_POST['paidto'],
            'SubmitBy' => '',
            'TransType' => 'RECEIPT',
            'TransDate' => $_POST['transdate'],
            'JournalGroup' => $_POST['journalgroup'],
            'AccNo' => $_POST['accno'],
            'Giro' => $_POST['giro'],
            'Remarks' => $_POST['remark'],
            'Branch' => $_POST['branch'],
            'TotalAmount' => $_POST['totalamount'],
            'Department' => '',
            'CostCenter' => ''
        ]);
        
        $cur_emp_bal = 0;
        $cur_branch_bal = 0;
        for($i = 0; $i < count($_POST['itemno']); $i++){
            $itemno += 1;
            $debit = $_POST['amount'][$i];
            $credit = 0;

            //DETAIL ACCTYPE
            $acctypes = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accnos'][$i]])->row()->Acc_Type;

            array_push($details, [
                'DocNo' => $_POST['docno'],
                'IDNumber' => $_POST['emp'][$i],
                'FullName' => $this->db->select('FullName')->get_where('tbl_fa_hr_append', ['IDNumber' => $_POST['emp'][$i]])->row()->FullName,
                'AccNo' => $_POST['accnos'][$i],
                'Department' => $_POST['departments'][$i],
                'CostCenter' => $_POST['costcenters'][$i],
                'Remarks' => $_POST['remarks'][$i],
                'Currency' => $_POST['currency'][$i],
                'Rate' => $_POST['rate'][$i],
                'Unit' => $_POST['unit'][$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => 0,
                'Credit' => $_POST['amount'][$i]
            ]);

            $branch_beg_bal = $this->Mdl_corp_receipt->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i]);
            $emp_beg_bal = $this->Mdl_corp_receipt->get_emp_last_balance($_POST['emp'][$i]);

            if($acctypes == 'A' || $acctypes == 'E'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['amount'][$i]) -  0;
                $emp_bal = ($emp_beg_bal + $_POST['amount'][$i]) - 0;
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - 0) + $_POST['amount'][$i];
                $emp_bal = ($emp_beg_bal + 0) - $_POST['amount'][$i];
            }

            //EMPLOYEE BALANCE
            array_push($trans, [
                'DocNo' => $_POST['docno'],
                'TransDate' => $_POST['transdate'],
                'TransType' => 'RECEIPT',
                'JournalGroup' => $_POST['journalgroup'],
                'Branch' => $_POST['branch'],
                'Department' => $_POST['departments'][$i],
                'CostCenter' => $_POST['costcenters'][$i],
                'Giro' => $_POST['giro'],
                'ItemNo' => $itemno,
                'AccNo' => $_POST['accnos'][$i],
                'AccType' => $acctypes,
                'IDNumber' => $_POST['emp'][$i],
                'Currency' => $_POST['currency'][$i],
                'Rate' => $_POST['rate'][$i],
                'Unit' => $_POST['unit'][$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => 0,
                'Credit' => $_POST['amount'][$i],
                'Balance' => $emp_bal,
                'BalanceBranch' => $cur_branch_bal + $branch_bal,
                'Remarks' => $_POST['remarks'][$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_branch_bal += $branch_bal;
        }

        $result = $this->Mdl_corp_receipt->submit_receipt($master, $details, $trans);

        echo $result;
    }

    //PAYMENT VOUCHER
    function view_payment_voucher()
    {
        $data['title'] = 'List Payment Voucher';
        
        $this->load->view('finance_corp/v_payment_voucher', $data);
    }

    function add_payment_voucher()
    {
        $data = [
            'title' => 'Form payment Voucher',
            
            'docno' => $this->Mdl_corp_payment->get_new_payment_docno(),
            'accno' => $this->Mdl_corp_payment->get_mas_acc(),
            'branch' => $this->Mdl_corp_payment->get_branch(),
            'employee' => $this->Mdl_corp_payment->get_employee(),
            'currency' => $this->Mdl_corp_payment->get_currency(),

            'script' => 'fincorp_add_payment'
        ];

        $this->load->view('finance_corp/v_add_payment_voucher', $data);
    }

    public function ajax_submit_payment(){
        $master = $details = $trans = [];

        $cur_nis = '';
        $cur_branch = '';
        $itemno = 0;

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_payment->get_branch_last_balance($_POST['branch'], $_POST['accno']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1'){
            $counter_balance = ($counter_beg_bal - 0) + $_POST['totalamount'];    
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
            'TransDate' => $_POST['transdate'],
            'TransType' => 'PAYMENT',
            'JournalGroup' => $_POST['journalgroup'],
            'Branch' => $_POST['branch'],
            'Department' => '',
            'CostCenter' => '',
            'Giro' => $_POST['giro'],
            'ItemNo' => $itemno,
            'AccNo' => $_POST['accno'],
            'AccType' => $acctype,
            'IDNumber' => $_POST['paidto'],
            'Currency' => 'IDR',
            'Rate' => 1,
            'Unit' => $_POST['totalamount'],
            'Amount' => $_POST['totalamount'],
            'Debit' => 0,
            'Credit' => $_POST['totalamount'],
            'Balance' => 0,
            'BalanceBranch' => $counter_balance,
            'Remarks' => $_POST['remark'],
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $_POST['docno'],
            'IDNumber' => $_POST['paidto'],
            'SubmitBy' => '',
            'TransType' => 'RECEIPT',
            'TransDate' => $_POST['transdate'],
            'JournalGroup' => $_POST['journalgroup'],
            'AccNo' => $_POST['accno'],
            'Giro' => $_POST['giro'],
            'Remarks' => $_POST['remark'],
            'Branch' => $_POST['branch'],
            'TotalAmount' => $_POST['totalamount'],
            'Department' => '',
            'CostCenter' => ''
        ]);
        
        $cur_emp_bal = 0;
        $cur_branch_bal = 0;
        for($i = 0; $i < count($_POST['itemno']); $i++){
            $itemno += 1;
            $debit = $_POST['amount'][$i];
            $credit = 0;

            //DETAIL ACCTYPE
            $acctypes = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accnos'][$i]])->row()->Acc_Type;

            array_push($details, [
                'DocNo' => $_POST['docno'],
                'IDNumber' => $_POST['emp'][$i],
                'FullName' => $this->db->select('FullName')->get_where('tbl_fa_hr_append', ['IDNumber' => $_POST['emp'][$i]])->row()->FullName,
                'AccNo' => $_POST['accnos'][$i],
                'Department' => $_POST['departments'][$i],
                'CostCenter' => $_POST['costcenters'][$i],
                'Remarks' => $_POST['remarks'][$i],
                'Currency' => $_POST['currency'][$i],
                'Rate' => $_POST['rate'][$i],
                'Unit' => $_POST['unit'][$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => 0,
                'Credit' => $_POST['amount'][$i]
            ]);

            $branch_beg_bal = $this->Mdl_corp_payment->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i]);
            $emp_beg_bal = $this->Mdl_corp_payment->get_emp_last_balance($_POST['emp'][$i]);

            if($acctypes == 'A' || $acctypes == 'E'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['amount'][$i]) - 0;
                $emp_bal = ($emp_beg_bal + $_POST['amount'][$i]) - 0;
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - $_POST['amount'][$i]) + 0;
                $emp_bal = ($emp_beg_bal + 0) - $_POST['amount'][$i];
            }

            //EMPLOYEE BALANCE
            array_push($trans, [
                'DocNo' => $_POST['docno'],
                'TransDate' => $_POST['transdate'],
                'TransType' => 'PAYMENT',
                'JournalGroup' => $_POST['journalgroup'],
                'Branch' => $_POST['branch'],
                'Department' => $_POST['departments'][$i],
                'CostCenter' => $_POST['costcenters'][$i],
                'Giro' => $_POST['giro'],
                'ItemNo' => $itemno,
                'AccNo' => $_POST['accnos'][$i],
                'AccType' => $acctypes,
                'IDNumber' => $_POST['emp'][$i],
                'Currency' => $_POST['currency'][$i],
                'Rate' => $_POST['rate'][$i],
                'Unit' => $_POST['unit'][$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => $_POST['amount'][$i],
                'Credit' => 0,
                'Balance' => $emp_bal,
                'BalanceBranch' => $cur_branch_bal + $branch_bal,
                'Remarks' => $_POST['remarks'][$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_branch_bal += $branch_bal;
        }

        $result = $this->Mdl_corp_payment->submit_payment($master, $details, $trans);

        echo $result;
    }

    //OVERBOOK VOUCHER
    function view_overbook_voucher()
    {
        $data['title'] = 'List Overbook Voucher';
        
        $this->load->view('finance_corp/v_overbook_voucher', $data);
    }

    function add_overbook_voucher()
    {
        $data = [
            'title' => 'Form Overbook Voucher',
            
            'docno' => $this->Mdl_corp_overbook->get_new_overbook_docno(),
            'accno' => $this->Mdl_corp_overbook->get_mas_acc(),
            'branch' => $this->Mdl_corp_overbook->get_branch(),
            'employee' => $this->Mdl_corp_overbook->get_employee(),
            'currency' => $this->Mdl_corp_overbook->get_currency(),

            'script' => 'fincorp_add_overbook'
        ];
        
        $this->load->view('finance_corp/v_add_receipt_voucher', $data);
    }

    //GENERAL JOURNAL
    function view_general_journal()
    {
        $data['title'] = 'List General Journal';
        
        $this->load->view('finance_corp/v_general_journal', $data);
    }

    function add_general_journal()
    {
        $data = [
            'title' => 'Form General Journal',
            
            'docno' => $this->Mdl_corp_payment->get_new_payment_docno(),
            'accno' => $this->Mdl_corp_payment->get_mas_acc(),
            'branch' => $this->Mdl_corp_payment->get_branch(),
            'employee' => $this->Mdl_corp_payment->get_employee(),
            'currency' => $this->Mdl_corp_payment->get_currency(),

            'script' => 'fincorp_add_general'
        ];
        
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

    //GL REPORT
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
        $accno_start = $this->db->select('Acc_No')->order_by('Acc_No','ASC')->limit(1)->get('tbl_fa_account_no')->row()->Acc_No;
        $accno_finish = $this->db->select('Acc_No')->order_by('Acc_No','DESC')->limit(1)->get('tbl_fa_account_no')->row()->Acc_No;
        $datestart = date('Y-01-01');
        $datefinish = date('Y-m-d');

        $data = [
            //HEADER
            'title' => 'General Ledger',
            'h1' => 'General',
            'h2' => 'Ledger',
            'h3' => '(Branch)',

            //LEDGER TABLE
            'branch' => $this->Mdl_corp_branch->get_branch(),
            'account_no' => $this->Mdl_corp_branch->get_account_no(),
            'ledger' => $this->Mdl_corp_branch->get_general_ledger($branch, $accno_start, $accno_finish, $datestart, $datefinish),

            //SCRIPT
            'script' => 'fincorp_gl_branch'
        ];
        
        $this->load->view('finance_corp/v_gl_branch', $data);
    }

    function view_gl_branch_report(){
        $branch = isset($_GET['branch']) ? $_GET['branch'] : 'All';
        $accno_start = isset($_GET['accno_start']) ? $_GET['accno_start'] : '10000';
        $accno_finish = isset($_GET['accno_finish']) ? $_GET['accno_finish'] : '90000';
        $date_start = isset($_GET['date_start']) ? $_GET['date_start'] :date('Y-01-01');
        $date_finish = isset($_GET['date_finish']) ? $_GET['date_finish'] : date('Y-m-d');

        $data = [
            //HEADER
            'title' => 'General Ledger',
            'h1' => 'General',
            'h2' => 'Ledger',
            'h3' => '(Branch)',

            //LEDGER TABLE
            'ledger' => $this->Mdl_corp_branch->get_general_ledger($branch, $accno_start, $accno_finish, $date_start, $date_finish),

            //SCRIPT
            'script' => 'fincorp_gl_branch'
        ];
        
        $this->load->view('finance_corp/v_reps_gl', $data);
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