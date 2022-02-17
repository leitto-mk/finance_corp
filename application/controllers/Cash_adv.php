<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class Cash_adv extends CI_Controller
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
    const CAW = 'CW';
    const CAR = 'CR';

    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');

        $this->load->helper([
            'response',
            'validate'
        ]);

        $this->load->model('Mdl_corp_cash_advance');
        $this->load->model('Mdl_corp_branch');
    }

    //Corporation Finance
    public function index(){
        $data = [
            'title' => 'Cash Advance',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => '',
        ];
        
        $this->load->view('finance_corp/cashadvance/v_cash_advance_corp', $data);
    }

    //PERSONAL STATEMENT
    public function view_ca_statement(){
        $data = [
            'title' => 'Cash Advance Statement',
            'h1' => 'Personal',
            'h2' => 'Statement',
            'h3' => '',

            //List
            'employees' => $this->Mdl_corp_cash_advance->get_ca_employees(),

            //SCRIPT
            'script' => 'list/ListPersonalStatement'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_ca_statement', $data);
    }

    public function ajax_get_emp_details(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $id = $this->input->post('id');

        $result = $this->Mdl_corp_cash_advance->get_ca_registered_ids($id);

        return set_success_response($result);
    }

    //TRANSACTION DETAILS - CASH ADVANCE WITHDRAW
    public function view_ca_withdraw(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'Cash Advance Withdraw',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => '',
            'h4' => '',
            
            'list' => $this->Mdl_corp_cash_advance->get_ranged_treasury(self::CAW, $docno, $start, $end),
            'script' => 'list/ListCAWithdraw'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_ca_withdraw', $data);
    }

    public function ajax_get_annual_ca_withdraw(){
        $validation = validate($this->input->post(), null, ['docno']);
        
        if(!$validation){
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $docno = $this->input->post('docno');
        $start = $this->input->post('start');
        $end = $this->input->post('end');

        $result = $this->Mdl_corp_cash_advance->get_ranged_treasury(self::CAW, $docno, $start, $end);

        return set_success_response($result);
    }

    public function edit_ca_withdraw(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $docno = $this->input->get('docno');

        $result = $this->Mdl_corp_cash_advance->get_docno_details($docno);

        $data = [
            'title' => 'Form Cash Withdraw',
            
            //DocNo Master
            'docno' => $docno,
            'refno' => $result[0]['RefNo'],
            'transdate' => $result[0]['TransDate'],
            'id' => $result[0]['IDNumber'],
            'journalgroup' => $result[0]['JournalGroup'],
            'remark' => $result[0]['Remarks'],
            'accno' => $result[0]['AccNo'],
            'branch' => $result[0]['Branch'],
            'outstanding' => $result[0]['Outstanding'],
            'paidto' => $result[0]['PaidTo'],
            'total' =>  $result[0]['Amount'],
            'giro' =>  $result[0]['Giro'],

            //List
            'list' => $result,
            
            //Multiple
            'accnos' => $this->Mdl_corp_cash_advance->get_mas_acc(),
            'employees' => $this->Mdl_corp_cash_advance->get_employee(),
            'branches' => $this->Mdl_corp_cash_advance->get_branch(),
            'department' => $this->Mdl_corp_cash_advance->get_department(),
            'costcenter' => $this->Mdl_corp_cash_advance->get_costcenter(),
            'currency' => $this->Mdl_corp_cash_advance->get_currency(),

            'script' => 'form/FormCAWithdraw'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_add_ca_withdraw_edit', $data);
    }

    public function ajax_delete_ca_withdraw(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }
        
        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_cash_advance->get_last_trans_date();

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        $acc_no = $this->Mdl_corp_cash_advance->get_docno_accnos($docno);
        $accnos = [];

        for($i = 0; $i < count($acc_no); $i++){
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_cash_advance->delete_existed_docno($_POST['docno']);

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }
        
        return set_success_response($result);
    }

    public function add_ca_withdraw(){
        $data = [
            'title' => 'Form Cash Advance Withdraw',
            
            'docno' => $this->Mdl_corp_cash_advance->get_new_treasury_docno(self::CAW),
            'accno' => $this->Mdl_corp_cash_advance->get_mas_acc(),
            'branch' => $this->Mdl_corp_cash_advance->get_branch(),
            'employee' => $this->Mdl_corp_cash_advance->get_employee(),
            'department' => $this->Mdl_corp_cash_advance->get_department(),
            'costcenter' => $this->Mdl_corp_cash_advance->get_costcenter(),
            'currency' => $this->Mdl_corp_cash_advance->get_currency(),

            'script' => 'form/FormCAWithdraw'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_add_ca_withdraw', $data);
    }

    public function ajax_submit_ca_withdraw(){
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
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_cash_advance->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_cash_advance->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal - 0) + $_POST['totalamount'];
        }

        //LAST BALANCE (OUTSTANDING) EMPLOYEE
        $emp_beg_bal = $this->Mdl_corp_cash_advance->get_emp_last_balance($branch, $_POST['emp_master_id']);

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
            'RefNo' => $_POST['refno'],
            'TransDate' => $_POST['transdate'],
            'TransType' => self::CAW,
            'JournalGroup' => $_POST['journalgroup'],
            'Branch' => $_POST['branch'],
            'Department' => '',
            'CostCenter' => '',
            'Giro' => $_POST['giro'],
            'ItemNo' => $itemno,
            'AccNo' => $_POST['accno'],
            'AccType' => $acctype,
            'IDNumber' => $_POST['emp_master_id'],
            'Currency' => 'IDR',
            'Rate' => 1,
            'Unit' => $_POST['totalamount'],
            'Amount' => $_POST['totalamount'],
            'Debit' => 0,
            'Credit' => $_POST['totalamount'],
            'Balance' => ($emp_beg_bal - $_POST['totalamount']),
            'BalanceBranch' => $counter_balance,
            'Remarks' => $_POST['remark'],
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $_POST['docno'],
            'RefNo' => $_POST['refno'],
            'IDNumber' => $_POST['emp_master_id'],
            'SubmitBy' => '',
            'TransType' => self::CAW,
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
                $branch_beg_bal = $this->Mdl_corp_cash_advance->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
                
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
                'TransType' => self::CAW,
                'JournalGroup' => $_POST['journalgroup'],
                'Branch' => $_POST['branch'],
                'Department' => $_POST['departments'][$i],
                'CostCenter' => $_POST['costcenters'][$i],
                'Giro' => $_POST['giro'],
                'ItemNo' => $itemno,
                'AccNo' => $_POST['accnos'][$i],
                'AccType' => $acctypes,
                'IDNumber' => ($itemno == 0 ? $_POST['emp_master_id'] : ''),
                'Currency' => $_POST['currency'][$i],
                'Rate' => $_POST['rate'][$i],
                'Unit' => $_POST['unit'][$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => $_POST['amount'][$i],
                'Credit' => 0,
                'Balance' => ($emp_beg_bal - $_POST['totalamount']),
                'BalanceBranch' => $branch_bal,
                'Remarks' => $_POST['remarks'][$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$_POST['accnos'][$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_cash_advance->delete_existed_docno($_POST['docno']);

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_cash_advance->submit_treasury($master, $details, $trans, $branch, $cur_date);

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

    //TRANSACTION DETAILS - CASH ADVANCE RECEIPT
    public function view_ca_receipt(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'Cash Advance Receipt',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => '',
            'h4' => '',
            
            'list' => $this->Mdl_corp_cash_advance->get_ranged_treasury(self::CAR, $docno, $start, $end),
            'script' => 'list/ListCAReceipt'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_ca_receipt', $data);
    }

    public function ajax_get_annual_ca_receipt(){
        $validation = validate($this->input->post(), null, ['docno']);
        
        if(!$validation){
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $docno = $this->input->post('docno');
        $start = $this->input->post('start');
        $end = $this->input->post('end');

        $result = $this->Mdl_corp_cash_advance->get_ranged_treasury(self::CAR, $docno, $start, $end);

        return set_success_response($result);
    }

    public function edit_ca_receipt(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $docno = $this->input->get('docno');

        $result = $this->Mdl_corp_cash_advance->get_docno_details($docno);

        $data = [
            'title' => 'Form Receipt Voucher',
            
            //DocNo Master
            'docno' => $docno,
            'refno' => $result[0]['RefNo'],
            'transdate' => $result[0]['TransDate'],
            'id' => $result[0]['IDNumber'],
            'journalgroup' => $result[0]['JournalGroup'],
            'remark' => $result[0]['Remarks'],
            'accno' => $result[0]['AccNo'],
            'branch' => $result[0]['Branch'],
            'outstanding' => $result[0]['Outstanding'],
            'paidto' => $result[0]['PaidTo'],
            'total' =>  $result[0]['Amount'],
            'giro' =>  $result[0]['Giro'],

            //List
            'list' => $result,
            
            //Multiple
            'accnos' => $this->Mdl_corp_cash_advance->get_mas_acc(),
            'employees' => $this->Mdl_corp_cash_advance->get_employee(),
            'branches' => $this->Mdl_corp_cash_advance->get_branch(),
            'department' => $this->Mdl_corp_cash_advance->get_department(),
            'costcenter' => $this->Mdl_corp_cash_advance->get_costcenter(),
            'currency' => $this->Mdl_corp_cash_advance->get_currency(),

            'script' => 'form/FormCAReceipt'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_add_ca_receipt_edit', $data);
    }

    public function ajax_delete_ca_receipt(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_cash_advance->get_last_trans_date();

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
         }else{
            $start = $last_date;
            $finish = $cur_date;
         }

        $acc_no = $this->Mdl_corp_cash_advance->get_docno_accnos($docno);
        $accnos = [];

        for($i = 0; $i < count($acc_no); $i++){
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_cash_advance->delete_existed_docno($_POST['docno']);

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $result = $this->Mdl_corp_branch->recalculate_balance($branch, min($accnos), max($accnos), $start, $finish);

        if($result !== 'success'){
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }
        
        return set_success_response($result);
    }

    public function add_ca_receipt(){
        $data = [
            'title' => 'Form Cash Advance Receipt',
            
            'docno' => $this->Mdl_corp_cash_advance->get_new_treasury_docno(self::CAR),
            'accno' => $this->Mdl_corp_cash_advance->get_mas_acc(),
            'branch' => $this->Mdl_corp_cash_advance->get_branch(),
            'employee' => $this->Mdl_corp_cash_advance->get_employee(),
            'department' => $this->Mdl_corp_cash_advance->get_department(),
            'costcenter' => $this->Mdl_corp_cash_advance->get_costcenter(),
            'currency' => $this->Mdl_corp_cash_advance->get_currency(),

            'script' => 'form/FormCAReceipt'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_add_ca_receipt', $data);
    }

    public function ajax_submit_ca_receipt(){
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
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_cash_advance->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_cash_advance->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + $_POST['totalamount']) -  0;
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
        }

        //LAST BALANCE (OUTSTANDING) EMPLOYEE
        $emp_beg_bal = $this->Mdl_corp_cash_advance->get_emp_last_balance($branch, $_POST['emp_master_id']);

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
            'RefNo' => $_POST['refno'],
            'TransDate' => $_POST['transdate'],
            'TransType' => self::CAR,
            'JournalGroup' => '',
            'Branch' => $_POST['branch'],
            'Department' => '',
            'CostCenter' => '',
            'Giro' => $_POST['giro'],
            'ItemNo' => $itemno,
            'AccNo' => $_POST['accno'],
            'AccType' => $acctype,
            'IDNumber' => $_POST['emp_master_id'],
            'Currency' => 'IDR',
            'Rate' => 1,
            'Unit' => $_POST['totalamount'],
            'Amount' => $_POST['totalamount'],
            'Debit' => 0,
            'Credit' => $_POST['totalamount'],
            'Balance' => ($emp_beg_bal + $_POST['totalamount']),
            'BalanceBranch' => $counter_balance,
            'Remarks' => $_POST['remark'],
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $_POST['docno'],
            'RefNo' => $_POST['refno'],
            'IDNumber' => $_POST['emp_master_id'],
            'SubmitBy' => '',
            'TransType' => self::CAR,
            'TransDate' => $_POST['transdate'],
            'JournalGroup' => '',
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

            // $emp_beg_bal = $this->Mdl_corp_cash_advance->get_emp_last_balance($_POST['emp'][$i]);
            if(isset($cur_accno_bal[$_POST['accnos'][$i]])){
                $branch_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_cash_advance->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
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
                'TransType' => self::CAR,
                'JournalGroup' => '',
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
                'Balance' => ($emp_beg_bal + $_POST['totalamount']),
                'BalanceBranch' => $branch_bal,
                'Remarks' => $_POST['remarks'][$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$_POST['accnos'][$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_cash_advance->delete_existed_docno($_POST['docno']);

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_cash_advance->submit_treasury($master, $details, $trans, $branch, $cur_date);

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

    //REPORT MANAGEMENT
    public function view_reps_cash_withdraw(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_cash_advance->get_treasury_report(self::CAW, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];
        
        $this->load->view('finance_corp/cashadvance/v_reps_cash_withdraw', $data);
    }

    public function view_reps_cash_receipt(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_cash_advance->get_treasury_report(self::CAR, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];
        
        $this->load->view('finance_corp/cashadvance/v_reps_cash_receipt', $data);
    }

    public function ca_outstanding_report(){
        $data = [
            'title' => 'Cash Advance Outstanding Report',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => 'Outstanding',
            'h4' => 'Report'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_ca_outstanding_report', $data);
    }

    public function ca_transaction_details(){
        $data = [
            'title' => 'Cash Advance Transaction Details',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => 'Transaction',
            'h4' => 'Details'
        ];
        
        $this->load->view('finance_corp/cashadvance/v_ca_transaction_details', $data);
    }

    public function ca_request_report(){
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