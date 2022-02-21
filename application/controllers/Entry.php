<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class Entry extends CI_Controller
{
    /**
     * Common HTTP status codes and their respective description.
     *
     * @link http://www.restapitutorial.com/httpstatuscodes.html
     */
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_INTERNAL_ERROR = 500;

    //TransType
    const REC = 'RE';
    const PAY = 'PA';
    const OVB = 'OB';
    const GNJ = 'GJ';

    public function __construct(){
        parent::__construct();

        $this->load->library('form_validation');

        $this->load->helper([
            'response',
            'validate'
        ]);

        $this->load->model('Mdl_corp_entry');
        $this->load->model('Mdl_corp_branch');
    }

    //* RECEIPT VOUCHER
    public function view_receipt_voucher(){
        $data = [
            'title' => 'List Receipt Voucher',
            'script' => 'receipt'
        ];
        
        $this->load->view('entry/treasuries/v_receipt_voucher', $data);
    }

    public function ajax_get_ranged_receipt(){
        $validation = validate($this->input->post(), null, ['docno']);
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $datatable = [
            'docno' => $this->input->post('docno'),
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end'),

            'limit' => $this->input->post('length'),
            'start' => $this->input->post('start')
        ];

        $query = $this->Mdl_corp_entry->get_ranged_entry(self::REC, $datatable);

        $result = [
            'draw' => $this->input->post('draw'),
            'data' => $query
        ];

        return set_success_response($result);
    }

    public function add_receipt_voucher(){
        $data = [
            'title' => 'Form Receipt Voucher',
            
            'docno' => $this->Mdl_corp_entry->get_new_treasury_docno(self::REC),
            'accno' => $this->Mdl_corp_entry->get_mas_acc(),
            'branch' => $this->Mdl_corp_entry->get_branch(),
            'employee' => $this->Mdl_corp_entry->get_employee(),
            'department' => $this->Mdl_corp_entry->get_department(),
            'costcenter' => $this->Mdl_corp_entry->get_costcenter(),
            'currency' => $this->Mdl_corp_entry->get_currency(),

            'script' => 'receipt'
        ];
        
        $this->load->view('entry/addview/v_add_receipt_voucher', $data);
    }

    public function edit_receipt(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');

        $result = $this->Mdl_corp_entry->get_docno_details($docno);

        $data = [
            'title' => 'Form Receipt Voucher',
            
            //DocNo Master
            'docno' => $docno,
            'refno' => $result[0]['RefNo'],
            'transdate' => $result[0]['TransDate'],
            'journalgroup' => $result[0]['JournalGroup'],
            'remark' => $result[0]['Remarks'],
            'accno' => $result[0]['AccNo'],
            'branch' => $result[0]['Branch'],
            'paidto' => $result[0]['PaidTo'],
            'total' =>  $result[0]['Amount'],
            'giro' =>  $result[0]['Giro'],

            //List
            'list' => $result,
            
            //Multiple
            'accnos' => $this->Mdl_corp_entry->get_mas_acc(),
            'branches' => $this->Mdl_corp_entry->get_branch(),
            'department' => $this->Mdl_corp_entry->get_department(),
            'costcenter' => $this->Mdl_corp_entry->get_costcenter(),
            'currency' => $this->Mdl_corp_entry->get_currency(),

            'script' => 'receipt'
        ];
        
        $this->load->view('entry/editview/v_add_receipt_voucher_edit', $data);
    }

    public function ajax_delete_receipt(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        $acc_no = $this->Mdl_corp_entry->get_docno_accnos($docno);
        $accnos = [];

        for($i = 0; $i < count($acc_no); $i++){
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_entry->delete_existed_docno($_POST['docno']);

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }
        
        return set_success_response($result);
    }

    public function ajax_submit_receipt(){
        $validation = validate($this->input->post(), 
            [ //Specific Case
                'date' => ['transdate'],
                'number' => ['itemno','unit','rate','amount','totalamount']
            ], 
            [ //Ignore
                'paidto',
                'remark',
                'remarks',
                'giro'
            ]
        );
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + $_POST['totalamount']) -  0;
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
            'RefNo' => $_POST['refno'],
            'TransDate' => $_POST['transdate'],
            'TransType' => self::REC,
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
            'RefNo' => $_POST['refno'],
            'IDNumber' => $_POST['paidto'],
            'SubmitBy' => '',
            'TransType' => self::REC,
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
        
        $cur_accno_bal = [$_POST['accno'] => $counter_balance];
        for($i = 0; $i < count($_POST['itemno']); $i++){
            $itemno += 1;

            //DETAIL ACCTYPE
            $acctypes = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accnos'][$i]])->row()->Acc_Type;

            array_push($details, [
                'DocNo' => $_POST['docno'],
                'IDNumber' => '',
                // 'FullName' => $this->db->select('FullName')->get_where('tbl_fa_hr_append', ['IDNumber' => $_POST['emp'][$i]])->row()->FullName,
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

            if(isset($cur_accno_bal[$_POST['accnos'][$i]])){
                $branch_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
                
                $cur_accno_bal[$_POST['accnos'][$i]] = $branch_beg_bal;
            }

            if($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['amount'][$i]) -  0;
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2' || $acctypes == 'CX'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - 0) + $_POST['amount'][$i];
            }

            //EMPLOYEE BALANCE
            array_push($trans, [
                'DocNo' => $_POST['docno'],
                'RefNo' => $_POST['refno'],
                'TransDate' => $_POST['transdate'],
                'TransType' => self::REC,
                'JournalGroup' => $_POST['journalgroup'],
                'Branch' => $_POST['branch'],
                'Department' => $_POST['departments'][$i],
                'CostCenter' => $_POST['costcenters'][$i],
                'Giro' => $_POST['giro'],
                'ItemNo' => $itemno,
                'AccNo' => $_POST['accnos'][$i],
                'AccType' => $acctypes,
                'IDNumber' => '',
                'Currency' => $_POST['currency'][$i],
                'Rate' => $_POST['rate'][$i],
                'Unit' => $_POST['unit'][$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => 0,
                'Credit' => $_POST['amount'][$i],
                'Balance' => 0,
                'BalanceBranch' => $branch_bal,
                'Remarks' => $_POST['remarks'][$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$_POST['accnos'][$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_entry->delete_existed_docno($_POST['docno']);

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_entry->submit_treasury($master, $details, $trans, $branch, $cur_date);

        if($submit !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $submit);
        }
        
        $result = '';
        $accnos = [];
        if($submit == 'success'){
            //PUSH ALL UNIQUE ACCOUNT NUMBERS
            for($i = 0; $i < count($cur_accno_bal); $i++){
                $cur_accno = array_keys($cur_accno_bal)[$i];

                array_push($accnos, $cur_accno);
            }
        }

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }
        
        return set_success_response($result);
    }

    public function view_reps_receipt_voucher(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_entry->get_entry_report(self::REC, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];
        
        $this->load->view('entry/reports/v_reps_receipt_voucher', $data);
    }

    //* PAYMENT VOUCHER
    public function view_payment_voucher(){
        $data = [
            'title' => 'List Payment Voucher',
            'script' => 'payment'
        ];
        
        $this->load->view('entry/treasuries/v_payment_voucher', $data);
    }

    public function ajax_get_ranged_payment(){
        
        $validation = validate($this->input->post(), null, ['docno']);
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $datatable = [
            'docno' => $this->input->post('docno'),
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end'),

            'limit' => $this->input->post('length'),
            'start' => $this->input->post('start')
        ];

        $query = $this->Mdl_corp_entry->get_ranged_entry(self::PAY, $datatable);

        $result = [
            'draw' => $this->input->post('draw'),
            'data' => $query
        ];

        return set_success_response($result);
    }

    public function add_payment_voucher(){
        $data = [
            'title' => 'Form Payment Voucher',
            
            'docno' => $this->Mdl_corp_entry->get_new_treasury_docno(self::PAY),
            'accno' => $this->Mdl_corp_entry->get_mas_acc(),
            'branch' => $this->Mdl_corp_entry->get_branch(),
            'employee' => $this->Mdl_corp_entry->get_employee(),
            'department' => $this->Mdl_corp_entry->get_department(),
            'costcenter' => $this->Mdl_corp_entry->get_costcenter(),
            'currency' => $this->Mdl_corp_entry->get_currency(),

            'script' => 'payment'
        ];

        $this->load->view('entry/addview/v_add_payment_voucher', $data);
    }

    public function edit_payment(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');

        $result = $this->Mdl_corp_entry->get_docno_details($docno);

        $data = [
            'title' => 'Form Payment Voucher',
            
            //DocNo Master
            'docno' => $docno,
            'refno' => $result[0]['RefNo'],
            'transdate' => $result[0]['TransDate'],
            'journalgroup' => $result[0]['JournalGroup'],
            'remark' => $result[0]['Remarks'],
            'accno' => $result[0]['AccNo'],
            'branch' => $result[0]['Branch'],
            'paidto' => $result[0]['PaidTo'],
            'total' =>  $result[0]['Amount'],
            'giro' =>  $result[0]['Giro'],

            //List
            'list' => $result,
            
            //Multiple
            'accnos' => $this->Mdl_corp_entry->get_mas_acc(),
            'branches' => $this->Mdl_corp_entry->get_branch(),
            'department' => $this->Mdl_corp_entry->get_department(),
            'costcenter' => $this->Mdl_corp_entry->get_costcenter(),
            'currency' => $this->Mdl_corp_entry->get_currency(),

            'script' => 'payment'
        ];
        
        $this->load->view('entry/editview/v_add_payment_voucher_edit', $data);
    }

    public function ajax_delete_payment(){ 
        $validation = validate($this->input->post());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        $acc_no = $this->Mdl_corp_entry->get_docno_accnos($docno);
        $accnos = [];

        for($i = 0; $i < count($acc_no); $i++){
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_entry->delete_existed_docno($_POST['docno']);

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }
    
        return set_success_response($result);
    }

    public function ajax_submit_payment(){
        $validation = validate($this->input->post(), 
            [ //Specific Case
                'date' => ['transdate'],
                'number' => ['itemno','unit','rate','amount','totalamount']
            ], 
            [ //Ignore
                'paidto',
                'remark',
                'remarks',
                'giro'
            ]
        );
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal - 0) + $_POST['totalamount'];
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
            'RefNo' => $_POST['refno'],
            'TransDate' => $_POST['transdate'],
            'TransType' => self::PAY,
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
            'RefNo' => $_POST['refno'],
            'IDNumber' => $_POST['paidto'],
            'SubmitBy' => '',
            'TransType' => self::PAY,
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
        
        $cur_accno_bal = [$_POST['accno'] => $counter_balance];
        for($i = 0; $i < count($_POST['itemno']); $i++){
            $itemno += 1;

            //DETAIL ACCTYPE
            $acctypes = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accnos'][$i]])->row()->Acc_Type;

            array_push($details, [
                'DocNo' => $_POST['docno'],
                'IDNumber' => '',
                // 'FullName' => $this->db->select('FullName')->get_where('tbl_fa_hr_append', ['IDNumber' => $_POST['emp'][$i]])->row()->FullName,
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

            if(isset($cur_accno_bal[$_POST['accnos'][$i]])){
                $branch_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);

                $cur_accno_bal[$_POST['accnos'][$i]] = $branch_beg_bal;
            }

            if($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['amount'][$i]) - 0;
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2' || $acctypes == 'CX'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - $_POST['amount'][$i]) + 0;
            }

            //EMPLOYEE BALANCE
            array_push($trans, [
                'DocNo' => $_POST['docno'],
                'RefNo' => $_POST['refno'],
                'TransDate' => $_POST['transdate'],
                'TransType' => self::PAY,
                'JournalGroup' => $_POST['journalgroup'],
                'Branch' => $_POST['branch'],
                'Department' => $_POST['departments'][$i],
                'CostCenter' => $_POST['costcenters'][$i],
                'Giro' => $_POST['giro'],
                'ItemNo' => $itemno,
                'AccNo' => $_POST['accnos'][$i],
                'AccType' => $acctypes,
                'IDNumber' => '',
                'Currency' => $_POST['currency'][$i],
                'Rate' => $_POST['rate'][$i],
                'Unit' => $_POST['unit'][$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => $_POST['amount'][$i],
                'Credit' => 0,
                'Balance' => 0,
                'BalanceBranch' => $branch_bal,
                'Remarks' => $_POST['remarks'][$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$_POST['accnos'][$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_entry->delete_existed_docno($_POST['docno']);

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_entry->submit_treasury($master, $details, $trans, $branch, $cur_date);

        if($submit !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $submit);
        }
        
        $result = '';
        $accnos = [];
        if($submit == 'success'){
            //PUSH ALL UNIQUE ACCOUNT NUMBERS
            for($i = 0; $i < count($cur_accno_bal); $i++){
                $cur_accno = array_keys($cur_accno_bal)[$i];

                array_push($accnos, $cur_accno);
            }
        }

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }

        return set_success_response($result);
    }

    public function view_reps_payment_voucher(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_entry->get_entry_report(self::PAY, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];
        
        $this->load->view('entry/reports/v_reps_payment_voucher', $data);
    }

    //* OVERBOOK VOUCHER
    public function view_overbook_voucher(){
        $data = [
            'title' => 'List Overbook Voucher',
            'script' => 'overbook'
        ];
        
        $this->load->view('entry/treasuries/v_overbook_voucher', $data);
    }

    public function ajax_get_ranged_overbook(){
        
        $validation = validate($this->input->post(), null, ['docno']);
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $datatable = [
            'docno' => $this->input->post('docno'),
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end'),

            'limit' => $this->input->post('length'),
            'start' => $this->input->post('start')
        ];

        $query = $this->Mdl_corp_entry->get_ranged_entry(self::OVB, $datatable);

        $result = [
            'draw' => $this->input->post('draw'),
            'data' => $query
        ];

        return set_success_response($result);
    }

    public function add_overbook_voucher(){
        $data = [
            'title' => 'Form Overbook Voucher',
            
            'docno' => $this->Mdl_corp_entry->get_new_treasury_docno(self::OVB),
            'accno' => $this->Mdl_corp_entry->get_mas_acc(),
            'branch' => $this->Mdl_corp_entry->get_branch(),
            'employee' => $this->Mdl_corp_entry->get_employee(),
            'department' => $this->Mdl_corp_entry->get_department(),
            'costcenter' => $this->Mdl_corp_entry->get_costcenter(),
            'currency' => $this->Mdl_corp_entry->get_currency(),

            'script' => 'overbook'
        ];
        
        $this->load->view('entry/addview/v_add_overbook_voucher', $data);
    }

    public function edit_overbook(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');;

        $result = $this->Mdl_corp_entry->get_docno_details($docno);

        $data = [
            'title' => 'Form Overbook Voucher',
            
            //DocNo Master
            'docno' => $docno,
            'refno' => $result[0]['RefNo'],
            'transdate' => $result[0]['TransDate'],
            'journalgroup' => $result[0]['JournalGroup'],
            'remark' => $result[0]['Remarks'],
            'accno' => $result[0]['AccNo'],
            'branch' => $result[0]['Branch'],
            'paidto' => $result[0]['PaidTo'],
            'total' =>  $result[0]['Amount'],
            'giro' =>  $result[0]['Giro'],

            //List
            'list' => $result,
            
            //Multiple
            'accnos' => $this->Mdl_corp_entry->get_mas_acc(),
            'branches' => $this->Mdl_corp_entry->get_branch(),
            'department' => $this->Mdl_corp_entry->get_department(),
            'costcenter' => $this->Mdl_corp_entry->get_costcenter(),
            'currency' => $this->Mdl_corp_entry->get_currency(),

            'script' => 'overbook'
        ];
        
        $this->load->view('entry/editview/v_add_overbook_voucher_edit', $data);
    }

    public function ajax_delete_overbook(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        $acc_no = $this->Mdl_corp_entry->get_docno_accnos($docno);
        $accnos = [];

        for($i = 0; $i < count($acc_no); $i++){
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_entry->delete_existed_docno($_POST['docno']);

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }
    
        return set_success_response($result);
    }

    public function ajax_submit_overbook(){
        $validation = validate($this->input->post(), 
            [ //Specific Case
                'date' => ['transdate'],
                'number' => ['itemno','unit','rate','amount','totalamount']
            ], 
            [ //Ignore
                'paidto',
                'remark',
                'remarks',
                'giro'
            ]
        );
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal - 0) + $_POST['totalamount'];
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
            'RefNo' => $_POST['refno'],
            'TransDate' => $_POST['transdate'],
            'TransType' => self::OVB,
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
            'RefNo' => $_POST['refno'],
            'IDNumber' => $_POST['paidto'],
            'SubmitBy' => '',
            'TransType' => self::OVB,
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
        
        $cur_accno_bal = [$_POST['accno'] => $counter_balance];
        for($i = 0; $i < count($_POST['itemno']); $i++){
            $itemno += 1;

            //DETAIL ACCTYPE
            $acctypes = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accnos'][$i]])->row()->Acc_Type;

            array_push($details, [
                'DocNo' => $_POST['docno'],
                'IDNumber' => '',
                // 'FullName' => $this->db->select('FullName')->get_where('tbl_fa_hr_append', ['IDNumber' => $_POST['emp'][$i]])->row()->FullName,
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

            // $emp_beg_bal = $this->Mdl_corp_entry->get_emp_last_balance($_POST['emp'][$i]);
            if(isset($cur_accno_bal[$_POST['accnos'][$i]])){
                $branch_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
                
                $cur_accno_bal[$_POST['accnos'][$i]] = $branch_beg_bal;
            }

            if($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['amount'][$i]) - 0;
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2' || $acctypes == 'CX'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - $_POST['amount'][$i]) + 0;
            }

            //EMPLOYEE BALANCE
            array_push($trans, [
                'DocNo' => $_POST['docno'],
                'RefNo' => $_POST['refno'],
                'TransDate' => $_POST['transdate'],
                'TransType' => self::OVB,
                'JournalGroup' => $_POST['journalgroup'],
                'Branch' => $_POST['branch'],
                'Department' => $_POST['departments'][$i],
                'CostCenter' => $_POST['costcenters'][$i],
                'Giro' => $_POST['giro'],
                'ItemNo' => $itemno,
                'AccNo' => $_POST['accnos'][$i],
                'AccType' => $acctypes,
                'IDNumber' => '',
                'Currency' => $_POST['currency'][$i],
                'Rate' => $_POST['rate'][$i],
                'Unit' => $_POST['unit'][$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => $_POST['amount'][$i],
                'Credit' => 0,
                'Balance' => 0,
                'BalanceBranch' => $branch_bal,
                'Remarks' => $_POST['remarks'][$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$_POST['accnos'][$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_entry->delete_existed_docno($_POST['docno']);

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_entry->submit_treasury($master, $details, $trans, $branch, $cur_date);

        if($submit !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $submit);
        }
        
        $result = '';
        $accnos = [];
        if($submit == 'success'){
            //PUSH ALL UNIQUE ACCOUNT NUMBERS
            for($i = 0; $i < count($cur_accno_bal); $i++){
                $cur_accno = array_keys($cur_accno_bal)[$i];

                array_push($accnos, $cur_accno);
            }
        }

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }

        return set_success_response($result);
    }

    public function view_reps_overbook_voucher(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_entry->get_entry_report(self::OVB, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];
        
        $this->load->view('entry/reports/v_reps_overbook_voucher', $data);
    }

    //* GENERAL JOURNAL
    public function view_general_journal(){
        $data = [
            'title' => 'List General Journal',
            'script' => 'generalJournal'
        ];
        
        $this->load->view('entry/treasuries/v_general_journal', $data);
    }

    public function ajax_get_ranged_general_journal(){
        $validation = validate($this->input->post(), null, ['docno']);
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $datatable = [
            'docno' => $this->input->post('docno'),
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end'),

            'limit' => $this->input->post('length'),
            'start' => $this->input->post('start')
        ];

        $query = $this->Mdl_corp_entry->get_ranged_entry(self::GNJ, $datatable);

        $result = [
            'draw' => $this->input->post('draw'),
            'data' => $query
        ];

        return set_success_response($result);
    }

    public function add_general_journal(){
        $data = [
            'title' => 'Form General Journal',
            
            'docno' => $this->Mdl_corp_entry->get_new_treasury_docno(self::GNJ),
            'branch' => $this->Mdl_corp_entry->get_branch(),
            'accno' => $this->Mdl_corp_entry->get_mas_acc(),
            'employee' => $this->Mdl_corp_entry->get_employee(),
            'department' => $this->Mdl_corp_entry->get_department(),
            'costcenter' => $this->Mdl_corp_entry->get_costcenter(),
            'currency' => $this->Mdl_corp_entry->get_currency(),

            'script' => 'generalJournal'
        ];
        
        $this->load->view('entry/addview/v_add_general_journal', $data);
    }

    public function edit_general_journal(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');;

        $result = $this->Mdl_corp_entry->get_docno_details($docno);

        $data = [
            'title' => 'Form General Journal',
            
            //DocNo Master
            'docno' => $docno,
            'refno' => $result[0]['RefNo'],
            'transdate' => $result[0]['TransDate'],
            'journalgroup' => $result[0]['JournalGroup'],
            'remark' => $result[0]['Remarks'],
            'accno' => $result[0]['AccNo'],
            'branch' => $result[0]['Branch'],
            'paidto' => $result[0]['PaidTo'],
            'total' =>  $result[0]['Amount'],
            'giro' =>  $result[0]['Giro'],

            //List
            'list' => $result,
            
            //Multiple
            'accnos' => $this->Mdl_corp_entry->get_mas_acc(),
            'branches' => $this->Mdl_corp_entry->get_branch(),
            'department' => $this->Mdl_corp_entry->get_department(),
            'costcenter' => $this->Mdl_corp_entry->get_costcenter(),
            'currency' => $this->Mdl_corp_entry->get_currency(),

            'script' => 'generalJournal'
        ];
        
        $this->load->view('entry/editview/v_add_general_journal_edit', $data);
    }

    public function ajax_delete_general_journal(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        $acc_no = $this->Mdl_corp_entry->get_docno_accnos($docno);
        $accnos = [];

        for($i = 0; $i < count($acc_no); $i++){
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_entry->delete_existed_docno($_POST['docno']);

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }
    
        return set_success_response($result);
    }

    public function ajax_submit_general_journal(){
        $validation = validate($this->input->post(), 
            [ //Specific Case
                'date' => ['transdate'],
                'number' => ['itemno','debit','credit']
            ], 
            [ //Ignore
                'paidto',
                'remark',
                'remarks',
                'giro'
            ]
        );
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        array_push($master, [
            'DocNo' => $_POST['docno'],
            'RefNo' => $_POST['refno'],
            'IDNumber' => $_POST['paidto'],
            'SubmitBy' => '',
            'TransType' => self::GNJ,
            'TransDate' => $_POST['transdate'],
            'JournalGroup' => '',
            'AccNo' => '',
            'Giro' => '',
            'Remarks' => $_POST['remark'],
            'Branch' => $_POST['branch'],
            'TotalAmount' => 0,
            'Department' => '',
            'CostCenter' => ''
        ]);
        
        $cur_accno_bal = [];
        for($i = 0; $i < count($_POST['itemno']); $i++){
            $itemno += 1;

            //DETAIL ACCTYPE
            $acctypes = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accnos'][$i]])->row()->Acc_Type;

            array_push($details, [
                'DocNo' => $_POST['docno'],
                'IDNumber' => '',
                // 'FullName' => $this->db->select('FullName')->get_where('tbl_fa_hr_append', ['IDNumber' => $_POST['emp'][$i]])->row()->FullName,
                'AccNo' => $_POST['accnos'][$i],
                'Department' => $_POST['departments'][$i],
                'CostCenter' => $_POST['costcenters'][$i],
                'Remarks' => $_POST['remarks'][$i],
                'Currency' => $_POST['currency'][$i],
                'Rate' => 1,
                'Unit' => $_POST['debit'][$i] + $_POST['credit'][$i],
                'Amount' => $_POST['debit'][$i] + $_POST['credit'][$i],
                'Debit' => $_POST['debit'][$i],
                'Credit' => $_POST['credit'][$i]
            ]);

            // $emp_beg_bal = $this->Mdl_corp_general->get_emp_last_balance($_POST['emp'][$i]);
            if(isset($cur_accno_bal[$_POST['accnos'][$i]])){
                $branch_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);

                $cur_accno_bal[$_POST['accnos'][$i]] = $branch_beg_bal;
            }

            if($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['debit'][$i]) - $_POST['credit'][$i];
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2' || $acctypes == 'CX'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - $_POST['debit'][$i]) + $_POST['credit'][$i];
            }

            $amount = $_POST['debit'][$i] + $_POST['credit'][$i];
            
            //SET AMOUNT TO MINUS OR PLUS FOR CURRENT/RETAINING EARNINGS IF IT'S DEBIT
            if($_POST['debit'][$i] > 0 && ($_POST['accnos'][$i] == '31201' || $_POST['accnos'][$i] == '31202')) {
                $amount = -1 * ($_POST['debit'][$i] + $_POST['credit'][$i]);
            }

            //EMPLOYEE BALANCE
            array_push($trans, [
                'DocNo' => $_POST['docno'],
                'RefNo' => $_POST['refno'],
                'TransDate' => $_POST['transdate'],
                'TransType' => self::GNJ,
                'JournalGroup' => '',
                'Branch' => $_POST['branch'],
                'Department' => $_POST['departments'][$i],
                'CostCenter' => $_POST['costcenters'][$i],
                'Giro' => '',
                'ItemNo' => $itemno,
                'AccNo' => $_POST['accnos'][$i],
                'AccType' => $acctypes,
                'IDNumber' => '',
                'Currency' => $_POST['currency'][$i],
                'Rate' => 1,
                'Unit' => $_POST['debit'][$i] + $_POST['credit'][$i],
                'Amount' => $amount,
                'Debit' => $_POST['debit'][$i],
                'Credit' => $_POST['credit'][$i],
                'Balance' => 0,
                'BalanceBranch' => $branch_bal,
                'Remarks' => $_POST['remarks'][$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$_POST['accnos'][$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_entry->delete_existed_docno($_POST['docno']);

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_entry->submit_treasury($master, $details, $trans, $branch, $cur_date);

        if($submit !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $submit);
        }
        
        $result = '';
        $accnos = [];
        if($submit == 'success'){
            //PUSH ALL UNIQUE ACCOUNT NUMBERS
            for($i = 0; $i < count($cur_accno_bal); $i++){
                $cur_accno = array_keys($cur_accno_bal)[$i];

                array_push($accnos, $cur_accno);
            }
        }

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }

        return set_success_response($result);
    }

    public function view_reps_general_journal(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_entry->get_entry_report(self::GNJ, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];
        
        $this->load->view('entry/reports/v_reps_general_journal', $data);
    }
}