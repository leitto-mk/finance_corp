<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class FinanceCorp extends CI_Controller
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
    const REC = 'RECEIPT';
    const PAY = 'PAYMENT';
    const OVB = 'OVERBOOK';
    const GNJ = 'GENERAL';

    public function __construct(){
        parent::__construct();

        $this->load->library('form_validation');

        $this->load->helper([
            'response',
            'validate'
        ]);

        $this->load->model('Mdl_corp_treasury');
        $this->load->model('Mdl_corp_branch');
        $this->load->model('Mdl_corp_personal');
        $this->load->model('Mdl_corp_balance_sheet');
        $this->load->model('Mdl_corp_income_statement');
    }

    //* DASHBOARD
    public function index(){
        $data['title'] = 'Dashboard';
    
        $this->load->view('finance_corp/dashboard/v_home', $data);
    }

    //* RECEIPT VOUCHER
    public function view_receipt_voucher(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'List Receipt Voucher',
            
            'list' => $this->Mdl_corp_treasury->get_ranged_treasury(self::REC, $docno, $start, $end),
            'script' => 'list/ListReceipt'
        ];
        
        $this->load->view('finance_corp/treasuries/v_receipt_voucher', $data);
    }

    public function ajax_get_annual_receipt(){
        $validation = validate($this->input->post(), null, ['docno']);
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $start = $this->input->post('start');
        $end = $this->input->post('end');

        $result = $this->Mdl_corp_treasury->get_ranged_treasury(self::REC, $docno, $start, $end);

        return set_success_response($result);
    }

    public function edit_receipt(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');

        $result = $this->Mdl_corp_treasury->get_docno_details($docno);

        $data = [
            'title' => 'Form Receipt Voucher',
            
            //DocNo Master
            'docno' => $docno,
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
            'accnos' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branches' => $this->Mdl_corp_treasury->get_branch(),
            'department' => $this->Mdl_corp_treasury->get_department(),
            'costcenter' => $this->Mdl_corp_treasury->get_costcenter(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'form/FormReceipt'
        ];
        
        $this->load->view('finance_corp/editview/v_add_receipt_voucher_edit', $data);
    }

    public function ajax_delete_receipt(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        $acc_no = $this->Mdl_corp_treasury->get_docno_accnos($docno);
        $accnos = [];

        for($i = 0; $i < count($acc_no); $i++){
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }
        
        return set_success_response($result);
    }

    public function add_receipt_voucher(){
        $data = [
            'title' => 'Form Receipt Voucher',
            
            'docno' => $this->Mdl_corp_treasury->get_new_treasury_docno('RE'),
            'accno' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branch' => $this->Mdl_corp_treasury->get_branch(),
            'employee' => $this->Mdl_corp_treasury->get_employee(),
            'department' => $this->Mdl_corp_treasury->get_department(),
            'costcenter' => $this->Mdl_corp_treasury->get_costcenter(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'form/FormReceipt'
        ];
        
        $this->load->view('finance_corp/addview/v_add_receipt_voucher', $data);
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
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + $_POST['totalamount']) -  0;
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
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
                $branch_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
                
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
        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_treasury->submit_treasury($master, $details, $trans, $branch, $cur_date);

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

    //* PAYMENT VOUCHER
    public function view_payment_voucher(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'List Payment Voucher',
            
            'list' => $this->Mdl_corp_treasury->get_ranged_treasury(self::PAY, $docno, $start, $end),
            'script' => 'list/ListPayment'
        ];
        
        $this->load->view('finance_corp/treasuries/v_payment_voucher', $data);
    }

    public function ajax_get_annual_payment(){
        
        $validation = validate($this->input->post(), null, ['docno']);
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        
        $result = $this->Mdl_corp_treasury->get_ranged_treasury(self::PAY, $docno, $start, $end);

        return set_success_response($result);
    }

    public function edit_payment(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');

        $result = $this->Mdl_corp_treasury->get_docno_details($docno);

        $data = [
            'title' => 'Form Receipt Voucher',
            
            //DocNo Master
            'docno' => $docno,
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
            'accnos' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branches' => $this->Mdl_corp_treasury->get_branch(),
            'department' => $this->Mdl_corp_treasury->get_department(),
            'costcenter' => $this->Mdl_corp_treasury->get_costcenter(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'form/FormPayment'
        ];
        
        $this->load->view('finance_corp/editview/v_add_payment_voucher_edit', $data);
    }

    public function ajax_delete_payment(){ 
        $validation = validate($this->input->post());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        $acc_no = $this->Mdl_corp_treasury->get_docno_accnos($docno);
        $accnos = [];

        for($i = 0; $i < count($acc_no); $i++){
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }
    
        return set_success_response($result);
    }

    public function add_payment_voucher(){
        $data = [
            'title' => 'Form payment Voucher',
            
            'docno' => $this->Mdl_corp_treasury->get_new_treasury_docno('PA'),
            'accno' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branch' => $this->Mdl_corp_treasury->get_branch(),
            'employee' => $this->Mdl_corp_treasury->get_employee(),
            'department' => $this->Mdl_corp_treasury->get_department(),
            'costcenter' => $this->Mdl_corp_treasury->get_costcenter(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'form/FormPayment'
        ];

        $this->load->view('finance_corp/addview/v_add_payment_voucher', $data);
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
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal - 0) + $_POST['totalamount'];
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
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
                $branch_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);

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
        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_treasury->submit_treasury($master, $details, $trans, $branch, $cur_date);

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

    //* OVERBOOK VOUCHER
    public function view_overbook_voucher(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'List Overbook Voucher',
            
            'list' => $this->Mdl_corp_treasury->get_ranged_treasury(self::OVB, $docno, $start, $end),
            'script' => 'list/ListOverbook'
        ];
        
        $this->load->view('finance_corp/treasuries/v_overbook_voucher', $data);
    }

    public function ajax_get_annual_overbook(){
        
        $validation = validate($this->input->post(), null, ['docno']);
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        
        $result = $this->Mdl_corp_treasury->get_ranged_treasury(self::OVB, $docno, $start, $end);

        return set_success_response($result);
    }

    public function edit_overbook(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');;

        $result = $this->Mdl_corp_treasury->get_docno_details($docno);

        $data = [
            'title' => 'Form Receipt Voucher',
            
            //DocNo Master
            'docno' => $docno,
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
            'accnos' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branches' => $this->Mdl_corp_treasury->get_branch(),
            'department' => $this->Mdl_corp_treasury->get_department(),
            'costcenter' => $this->Mdl_corp_treasury->get_costcenter(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'form/FormOverbook'
        ];
        
        $this->load->view('finance_corp/editview/v_add_overbook_voucher_edit', $data);
    }

    public function ajax_delete_overbook(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        $acc_no = $this->Mdl_corp_treasury->get_docno_accnos($docno);
        $accnos = [];

        for($i = 0; $i < count($acc_no); $i++){
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }
    
        return set_success_response($result);
    }

    public function add_overbook_voucher(){
        $data = [
            'title' => 'Form Overbook Voucher',
            
            'docno' => $this->Mdl_corp_treasury->get_new_treasury_docno('OB'),
            'accno' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branch' => $this->Mdl_corp_treasury->get_branch(),
            'employee' => $this->Mdl_corp_treasury->get_employee(),
            'department' => $this->Mdl_corp_treasury->get_department(),
            'costcenter' => $this->Mdl_corp_treasury->get_costcenter(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'form/FormOverbook'
        ];
        
        $this->load->view('finance_corp/addview/v_add_overbook_voucher', $data);
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
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal - 0) + $_POST['totalamount'];
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
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

            // $emp_beg_bal = $this->Mdl_corp_treasury->get_emp_last_balance($_POST['emp'][$i]);
            if(isset($cur_accno_bal[$_POST['accnos'][$i]])){
                $branch_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
                
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
        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_treasury->submit_treasury($master, $details, $trans, $branch, $cur_date);

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

    //* GENERAL JOURNAL
    public function view_general_journal(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'List General Journal',
            
            'list' => $this->Mdl_corp_treasury->get_ranged_treasury(self::GNJ, $docno, $start, $end),
            'script' => 'list/ListGeneralJournal'
        ];
        
        $this->load->view('finance_corp/treasuries/v_general_journal', $data);
    }

    public function ajax_get_annual_general_journal(){
        $validation = validate($this->input->post(), null, ['docno']);
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        
        $result = $this->Mdl_corp_treasury->get_ranged_treasury(self::GNJ, $docno, $start, $end);

        return set_success_response($result);
    }

    public function edit_general_journal(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');;

        $result = $this->Mdl_corp_treasury->get_docno_details($docno);

        $data = [
            'title' => 'Form General Journal Voucher',
            
            //DocNo Master
            'docno' => $docno,
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
            'accnos' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branches' => $this->Mdl_corp_treasury->get_branch(),
            'department' => $this->Mdl_corp_treasury->get_department(),
            'costcenter' => $this->Mdl_corp_treasury->get_costcenter(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'form/FormGeneralJournal'
        ];
        
        $this->load->view('finance_corp/editview/v_add_general_journal_edit', $data);
    }

    public function ajax_delete_general_journal(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        $acc_no = $this->Mdl_corp_treasury->get_docno_accnos($docno);
        $accnos = [];

        for($i = 0; $i < count($acc_no); $i++){
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }
    
        return set_success_response($result);
    }

    public function add_general_journal(){
        $data = [
            'title' => 'Form General Journal',
            
            'docno' => $this->Mdl_corp_treasury->get_new_treasury_docno('GJ'),
            'branch' => $this->Mdl_corp_treasury->get_branch(),
            'accno' => $this->Mdl_corp_treasury->get_mas_acc(),
            'employee' => $this->Mdl_corp_treasury->get_employee(),
            'department' => $this->Mdl_corp_treasury->get_department(),
            'costcenter' => $this->Mdl_corp_treasury->get_costcenter(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'form/FormGeneralJournal'
        ];
        
        $this->load->view('finance_corp/addview/v_add_general_journal', $data);
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
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        array_push($master, [
            'DocNo' => $_POST['docno'],
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
                $branch_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);

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
        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_treasury->submit_treasury($master, $details, $trans, $branch, $cur_date);

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

    //* GL REPORT
    public function view_gl(){
        $data['title'] = 'General Ledger';
        $data['h1'] = 'General';
        $data['h2'] = 'Ledger';
        $data['h3'] = '(All)';
        
        $this->load->view('finance_corp/reports/v_gl', $data);
    }

    public function view_gl_branch(){
        
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
            'script' => 'report/ReportGeneralLedger'
        ];
        
        $this->load->view('finance_corp/reports/v_gl_branch', $data);
    }

    public function view_gl_branch_report(){
        $validation = validate($this->input->get(), ['date' => ['date_start', 'date_finish']], null);
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $branch = $this->input->get('branch');
        $accno_start = $this->input->get('accno_start');
        $accno_finish = $this->input->get('accno_finish');
        $date_start = $this->input->get('date_start');
        $date_finish = $this->input->get('date_finish');

        $data = [
            //HEADER
            'title' => 'General Ledger',
            'h1' => 'General',
            'h2' => 'Ledger',
            'h3' => '(Branch)',

            //LEDGER TABLE
            'date_start' => date('d-M-Y', strtotime($date_start)),
            'date_end' => date('d-M-Y', strtotime($date_finish)),
            'ledger' => $this->Mdl_corp_branch->get_general_ledger($branch, $accno_start, $accno_finish, $date_start, $date_finish)
        ];
        
        $this->load->view('finance_corp/reports/v_reps_gl', $data);
    }

    public function ajax_get_general_ledger(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $branch = $this->input->post('branch');
        $accno_start = $this->input->post('accno_start');
        $accno_finish = $this->input->post('accno_finish');
        $date_start = $this->input->post('date_start');
        $date_finish = $this->input->post('date_finish');

        $result = $this->Mdl_corp_branch->get_general_ledger($branch, $accno_start, $accno_finish, $date_start, $date_finish);

        return set_success_response($result);
    }

    public function view_balance_sheet(){
        $branch = $this->input->get('branch') ?? null;
        $year =  $this->input->get('year') ?? date('Y');
        $month = $this->input->get('month') ?? date('m');

        list($company, $asset, $liabilities, $capital) = $this->Mdl_corp_balance_sheet->get_report($branch, $year, $month);

        $data = [
            'title' => 'Balance Sheet',
            'h1' => 'Balance',
            'h2' => 'Sheet',
            'h3' => '',

            'company' => $company->ComName,
            'branch' => $this->db->select('BranchCode, BranchName')->get('abase_02_branch')->result(),
            'asset' => $asset,
            'liabilities' => $liabilities,
            'capital' => $capital,

            'script' => 'report/ReportBalanceSheet'
        ];
        
        $this->load->view('finance_corp/reports/v_reps_balance_sheet', $data);
    }

    public function view_trial_balance(){
        $data = [
            //HEADER
            'title' => 'Trial Balance',
            'h1' => 'Trial',
            'h2' => 'Balance',
            'h3' => '',
        ];

        $this->load->view('finance_corp/reports/v_reps_trial_balance', $data);
    }

    //Re-Calculate
    public function ajax_recalculate_balance(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $branch = $this->input->post('branch');
        $accno_start = $this->input->post('accno_start');
        $accno_finish = $this->input->post('accno_finish');
        $date_start = $this->input->post('date_start');

        $date_finish = $this->Mdl_corp_treasury->get_last_trans_date();

        $result = $this->Mdl_corp_branch->recalculate_balance($branch, $accno_start, $accno_finish, $date_start, $date_finish);

        return set_success_response($result);
    }

    //Report Receipt Voucher
    public function view_reps_receipt_voucher(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_treasury->get_treasury_report(self::REC, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];
        
        $this->load->view('finance_corp/reports/v_reps_receipt_voucher', $data);
    }

    //Report Payment Voucher
    public function view_reps_payment_voucher(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_treasury->get_treasury_report(self::PAY, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];
        
        $this->load->view('finance_corp/reports/v_reps_payment_voucher', $data);
    }

    //Report Overbook
    public function view_reps_overbook(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_treasury->get_treasury_report(self::OVB, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];
        
        $this->load->view('finance_corp/reports/v_reps_payment_voucher', $data);
    }

    //Report General Journal
    public function view_reps_general_journal(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_treasury->get_treasury_report(self::GNJ, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];
        
        $this->load->view('finance_corp/reports/v_reps_general_journal', $data);
    }

    //Reports Income Statement
    public function view_income_statement(){
        $validation = validate($this->input->get(), null, null);
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }
        
        $branch = $this->input->get('branch') ?? null;
        $year =  $this->input->get('year') ?? date('Y');
        $month = $this->input->get('month') ?? date('m');

        list($company, $revenue, $operational, $other_rev, $other_expense) = $this->Mdl_corp_income_statement->get_report($branch, $year, $month);

        $data = [
            'title' => 'Income Statement',
            'h1' => 'Income',
            'h2' => 'Statement',
            'h3' => '',

            'company' => $company->ComName,
            'branch' => $this->db->select('BranchCode, BranchName')->get('abase_02_branch')->result(),
            'revenue' => $revenue,
            'operational' => $operational,
            'other_revenue' => $other_rev,
            'other_expenses' => $other_expense,

            'script' => 'report/ReportIncomeStatement'
        ];

        $this->load->view('finance_corp/reports/v_reps_income_statement', $data);
    }

    //Reports Income Statement Columnar
    public function view_income_statement_columnar(){
        $validation = validate($this->input->get(), null, null);
         
         if(!$validation){
             return set_error_response(self::HTTP_BAD_REQUEST, $validation);
         }
         
         $branch = $this->input->get('branch') ?? null;
         $year =  $this->input->get('year') ?? date('Y');
         $month = $this->input->get('month') ?? date('m');
 
         list($company, $revenue, $operational, $other_rev, $other_expense) = $this->Mdl_corp_income_statement->get_report($branch, $year, $month);
 
         $data = [
             'title' => 'Income Statement Columnar',
             'h1' => 'Income',
             'h2' => 'Statement',
             'h3' => 'Columnar',
 
             'company' => $company->ComName,
             'branch' => $this->db->select('BranchCode, BranchName')->get('abase_02_branch')->result(),
             'revenue' => $revenue,
             'operational' => $operational,
             'other_revenue' => $other_rev,
             'other_expenses' => $other_expense,
 
             'script' => 'report/ReportIncomeStatement'
         ];
 
         $this->load->view('finance_corp/reports/v_reps_income_statement_columnar', $data);
     }
 
     //Reports Journal Transaction
     public function view_report_journal_transaction(){
         $data = [
             'title' => 'Report Journal Transaction',
             'h1' => 'Report',
             'h2' => 'Journal',
             'h3' => 'Transaction',
             'h4' => '',
         ];
         $this->load->view('finance_corp/reports/v_reps_journal_transaction', $data);
     }
}