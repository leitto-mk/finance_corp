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

    //TransType for Cash Advance
    const CAW = 'CW';
    const CAR = 'CR';

    public function __construct()
    {
        parent::__construct();

        $this->load->library(['form_validation']);

        $this->load->helper([
            'response',
            'validate'
        ]);

        //CodeIgniter model
        $this->load->model('Mdl_corp_cash_advance');
        $this->load->model('Mdl_corp_reports');
        $this->load->model('Mdl_corp_common');
        $this->load->model('Mdl_corp_entry');
    }

    protected function _calculate_total_amount($formData){
        $totalAmount = 0;
        for($i=0; $i < count($formData->post('itemno')); $i++){
            $curAmount = (float) ($formData->post('rate')[$i] * $formData->post('unit')[$i]);
            $_POST['amount'][$i] = $curAmount;

            $totalAmount += $curAmount;
        }

        $_POST['totalamount'] = $totalAmount;
    }

    //* CASH ADVANCE DASHBOARD
    public function index()
    {
        [$outstanding, $error] = $this->Mdl_corp_cash_advance->get_outstanding_bal();

        $data = [
            'title' => 'Cash Advance',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => '',

            'ca_request' => null,
            'cur_outstanding_bal' => ($error == null ? $outstanding : ''),
        ];

        $this->load->view('financecorp/cashadvance/v_index_ca', $data);
    }

    //* PERSONAL STATEMENT
    public function view_ca_statement()
    {
        $data = [
            'title' => 'Cash Advance Statement',
            'h1' => 'Personal',
            'h2' => 'Statement',
            'h3' => '',

            //List
            'employees' => $this->Mdl_corp_cash_advance->get_ca_employees(),

            //SCRIPT
            'script' => 'cashPersonalStatement'
        ];

        $this->load->view('financecorp/cashadvance/v_index_ca_statement', $data);
    }

    public function ajax_get_emp_details()
    {
        $validation = validate($this->input->post());

        if (!$validation) {
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $id = $this->input->post('id');

        $result = $this->Mdl_corp_cash_advance->get_ca_registered_ids($id);

        return set_success_response($result);
    }

    //* CASH ADVANCE WITHDRAW
    public function view_ca_withdraw()
    {
        $data = [
            'title' => 'Cash Advance Withdraw',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => '',
            'h4' => '',

            'script' => 'cashWithdraw'
        ];

        $this->load->view('financecorp/cashadvance/v_index_ca_withdraw', $data);
    }

    public function ajax_get_ranged_ca_withdraw()
    {
        $validation = validate($this->input->post(), null, ['docno']);

        if (!$validation) {
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $datatable = [
            'docno' => $this->input->post('docno'),
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end'),

            'limit' => $this->input->post('length'),
            'start' => $this->input->post('start')
        ];

        $query = $this->Mdl_corp_cash_advance->get_ranged_ca(self::CAW, $datatable);

        $result = [
            'draw' => $this->input->post('draw'),
            'data' => $query
        ];

        return set_success_response($result);
    }

    public function add_ca_withdraw()
    {
        $data = [
            'title' => 'Form Cash Advance Withdraw',

            'docno' => $this->Mdl_corp_cash_advance->get_new_treasury_docno(self::CAW),
            'accno' => $this->Mdl_corp_cash_advance->get_mas_acc(),
            'branch' => $this->Mdl_corp_cash_advance->get_branch(),
            'employee' => $this->Mdl_corp_cash_advance->get_employee(),
            'department' => $this->Mdl_corp_cash_advance->get_department(),
            'costcenter' => $this->Mdl_corp_cash_advance->get_costcenter(),
            'currency' => $this->Mdl_corp_cash_advance->get_currency(),

            'script' => 'cashWithdraw'
        ];

        $this->load->view('financecorp/cashadvance/v_add_ca_withdraw', $data);
    }

    public function edit_ca_withdraw()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
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

            'script' => 'cashWithdraw'
        ];

        $this->load->view('financecorp/cashadvance/v_edit_ca_withdraw', $data);
    }

    public function ajax_delete_ca_withdraw()
    {
        $validation = validate($this->input->post());

        if (!$validation) {
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_cash_advance->get_last_trans_date();

        if (strtotime($cur_date) < strtotime($last_date)) {
            $start = $cur_date;
            $finish = $last_date;
        } else {
            $start = $last_date;
            $finish = $cur_date;
        }

        $acc_no = $this->Mdl_corp_cash_advance->get_docno_accnos($docno);
        $accnos = [];

        for ($i = 0; $i < count($acc_no); $i++) {
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_cash_advance->delete_existed_docno($this->input->post('docno'));

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        [$result, $error] = $this->Mdl_corp_entry->recalculate_branch($branch, min($accnos), max($accnos), $start, $finish);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING
        $error = $this->Mdl_corp_common->calculate_retaining_earnings($branch, $cur_date);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
    }

    public function ajax_submit_ca_withdraw()
    {
        $validation = validate(
            $this->input->post(),
            [ //Specific Case
                'date' => ['transdate'],
                'number' => ['itemno', 'unit', 'rate', 'amount', 'totalamount']
            ],
            [ //Ignore
                'paidto',
                'remark',
                'remarks',
                'giro'
            ]
        );

        if (!$validation) {
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_cash_advance->get_last_trans_date();

        //Calculate Amount & Total Amount
        $this->_calculate_total_amount($this->input);

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $this->input->post('accno')])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_cash_advance->get_branch_last_balance($this->input->post('branch'), $this->input->post('accno'), $this->input->post('transdate'));

        //COUNTER BALANCE
        if ($acctype == 'A' || $acctype == 'E' || $acctype == 'E1') {
            $counter_balance = ($counter_beg_bal + 0) - $this->input->post('totalamount');
        } elseif ($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2') {
            $counter_balance = ($counter_beg_bal - 0) + $this->input->post('totalamount');
        }

        //UPDATE EMPLOYEE BALANCE
        $balance = 0;

        $is_docno_exist = $this->Mdl_corp_cash_advance->check_docno_exist($this->input->post('docno'));
        $cur_docno_amount = $this->Mdl_corp_cash_advance->check_docno_amount($this->input->post('docno'));

        if (!$is_docno_exist) {
            $balance = $this->input->post('totalamount');
        } elseif ($is_docno_exist && $cur_docno_amount !== $this->input->post('totalamount')) {
            $emp_beg_bal = $this->Mdl_corp_cash_advance->get_emp_last_balance($branch, $cur_date, $this->input->post('emp_master_id'));

            //DIFFERENCE BETWEEN CURRENT AMOUNT AND PREVIOUS AMOUNT
            $difference = ($this->input->post('totalamount') - $emp_beg_bal);

            $balance = ($emp_beg_bal + $difference);
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $this->input->post('docno'),
            'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
            'TransDate' => $this->input->post('transdate'),
            'TransType' => self::CAW,
            'JournalGroup' => $this->input->post('journalgroup'),
            'Branch' => $this->input->post('branch'),
            'Department' => '',
            'CostCenter' => '',
            'Giro' => $this->input->post('giro'),
            'ItemNo' => $itemno,
            'AccNo' => $this->input->post('accno'),
            'AccType' => $acctype,
            'IDNumber' => $this->input->post('emp_master_id'),
            'Currency' => 'IDR',
            'Rate' => 1,
            'Unit' => $this->input->post('totalamount'),
            'Amount' => $this->input->post('totalamount'),
            'Debit' => 0,
            'Credit' => $this->input->post('totalamount'),
            'Balance' => $balance,
            'BalanceBranch' => $counter_balance,
            'Remarks' => $this->input->post('remark'),
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $this->input->post('docno'),
            'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
            'IDNumber' => $this->input->post('emp_master_id'),
            'SubmitBy' => '',
            'TransType' => self::CAW,
            'TransDate' => $this->input->post('transdate'),
            'JournalGroup' => $this->input->post('journalgroup'),
            'AccNo' => $this->input->post('accno'),
            'Giro' => $this->input->post('giro'),
            'Remarks' => $this->input->post('remark'),
            'Branch' => $this->input->post('branch'),
            'TotalAmount' => $this->input->post('totalamount'),
            'Department' => '',
            'CostCenter' => ''
        ]);

        $cur_accno_bal = [$this->input->post('accno') => $counter_balance];
        for ($i = 0; $i < count($this->input->post('itemno')); $i++) {
            $itemno += 1;

            //DETAIL ACCTYPE
            $acctypes = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $this->input->post('accnos')[$i]])->row()->Acc_Type;

            array_push($details, [
                'DocNo' => $this->input->post('docno'),
                'IDNumber' => '',
                // 'FullName' => $this->db->select('FullName')->get_where('tbl_hr_append', ['IDNumber' => $this->input->post('emp')[$i]])->row()->FullName,
                'AccNo' => $this->input->post('accnos')[$i],
                'Department' => $this->input->post('departments')[$i],
                'CostCenter' => $this->input->post('costcenters')[$i],
                'Remarks' => $this->input->post('remarks')[$i],
                'Currency' => $this->input->post('currency')[$i],
                'Rate' => $this->input->post('rate')[$i],
                'Unit' => $this->input->post('unit')[$i],
                'Amount' => $this->input->post('amount')[$i],
                'Debit' => 0,
                'Credit' => $this->input->post('amount')[$i]
            ]);

            if (isset($cur_accno_bal[$this->input->post('accnos')[$i]])) {
                $branch_beg_bal = $cur_accno_bal[$this->input->post('accnos')[$i]];
            } else {
                $branch_beg_bal = $this->Mdl_corp_cash_advance->get_branch_last_balance($this->input->post('branch'), $this->input->post('accnos')[$i], $this->input->post('transdate'));

                $cur_accno_bal[$this->input->post('accnos')[$i]] = $branch_beg_bal;
            }

            if ($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1') {
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $this->input->post('amount')[$i]) - 0;
            } elseif ($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2' || $acctypes == 'CX') {
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - $this->input->post('amount')[$i]) + 0;
            }

            //DETAIL BALANCE
            array_push($trans, [
                'DocNo' => $this->input->post('docno'),
                'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
                'TransDate' => $this->input->post('transdate'),
                'TransType' => self::CAW,
                'JournalGroup' => $this->input->post('journalgroup'),
                'Branch' => $this->input->post('branch'),
                'Department' => $this->input->post('departments')[$i],
                'CostCenter' => $this->input->post('costcenters')[$i],
                'Giro' => $this->input->post('giro'),
                'ItemNo' => $itemno,
                'AccNo' => $this->input->post('accnos')[$i],
                'AccType' => $acctypes,
                'IDNumber' => ($itemno == 0 ? $this->input->post('emp_master_id') : ''),
                'Currency' => $this->input->post('currency')[$i],
                'Rate' => $this->input->post('rate')[$i],
                'Unit' => $this->input->post('unit')[$i],
                'Amount' => $this->input->post('amount')[$i],
                'Debit' => $this->input->post('amount')[$i],
                'Credit' => 0,
                'Balance' => $balance,
                'BalanceBranch' => $branch_bal,
                'Remarks' => $this->input->post('remarks')[$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$this->input->post('accnos')[$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_cash_advance->delete_existed_docno($this->input->post('docno'));

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_cash_advance->submit_cash_advance($master, $details, $trans, $branch, $cur_date);

        if ($submit !== 'success') {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $submit);
        }

        $result = '';
        $accnos = [];
        if ($submit == 'success') {
            //PUSH ALL UNIQUE ACCOUNT NUMBERS
            for ($i = 0; $i < count($cur_accno_bal); $i++) {
                $cur_accno = array_keys($cur_accno_bal)[$i];

                array_push($accnos, $cur_accno);
            }
        }

        if (strtotime($cur_date) < strtotime($last_date)) {
            $start = $cur_date;
            $finish = $last_date;
        } else {
            $start = $last_date;
            $finish = $cur_date;
        }

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        [$result, $error] = $this->Mdl_corp_entry->recalculate_branch($branch, min($accnos), max($accnos), $start, $finish);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }

        //CALCULATE EMPLOYEE BALANCE ABOVE TRANSDATE
        [$result, $error] = $this->Mdl_corp_cash_advance->update_emp_balance($cur_date, $this->input->post('emp_master_id'));
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING
        $error = $this->Mdl_corp_common->calculate_retaining_earnings($branch, $cur_date);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
    }

    public function view_reps_cash_withdraw()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_cash_advance->get_ca_report(self::CAW, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];

        $this->load->view('financecorp/cashadvance/v_reps_cash_withdraw', $data);
    }

    //* CASH ADVANCE RECEIPT
    public function view_ca_receipt()
    {
        $data = [
            'title' => 'Cash Advance Receipt',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => '',
            'h4' => '',

            'script' => 'cashReceipt'
        ];

        $this->load->view('financecorp/cashadvance/v_index_ca_receipt', $data);
    }

    public function ajax_get_ranged_ca_receipt()
    {
        $validation = validate($this->input->post(), null, ['docno']);

        if (!$validation) {
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $datatable = [
            'docno' => $this->input->post('docno'),
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end'),

            'limit' => $this->input->post('length'),
            'start' => $this->input->post('start')
        ];

        $query = $this->Mdl_corp_cash_advance->get_ranged_ca(self::CAR, $datatable);

        $result = [
            'draw' => $this->input->post('draw'),
            'data' => $query
        ];

        return set_success_response($result);
    }

    public function add_ca_receipt()
    {
        $data = [
            'title' => 'Form Cash Advance Receipt',

            'docno' => $this->Mdl_corp_cash_advance->get_new_treasury_docno(self::CAR),
            'accno' => $this->Mdl_corp_cash_advance->get_mas_acc(),
            'branch' => $this->Mdl_corp_cash_advance->get_branch(),
            'employee' => $this->Mdl_corp_cash_advance->get_employee(),
            'department' => $this->Mdl_corp_cash_advance->get_department(),
            'costcenter' => $this->Mdl_corp_cash_advance->get_costcenter(),
            'currency' => $this->Mdl_corp_cash_advance->get_currency(),

            'script' => 'cashReceipt'
        ];

        $this->load->view('financecorp/cashadvance/v_add_ca_receipt', $data);
    }

    public function edit_ca_receipt()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
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

            'script' => 'cashReceipt'
        ];

        $this->load->view('financecorp/cashadvance/v_edit_ca_receipt', $data);
    }

    public function ajax_delete_ca_receipt()
    {
        $validation = validate($this->input->post());

        if (!$validation) {
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_cash_advance->get_last_trans_date();

        if (strtotime($cur_date) < strtotime($last_date)) {
            $start = $cur_date;
            $finish = $last_date;
        } else {
            $start = $last_date;
            $finish = $cur_date;
        }

        $acc_no = $this->Mdl_corp_cash_advance->get_docno_accnos($docno);
        $accnos = [];

        for ($i = 0; $i < count($acc_no); $i++) {
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_cash_advance->delete_existed_docno($this->input->post('docno'));

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        [$result, $error] = $this->Mdl_corp_entry->recalculate_branch($branch, min($accnos), max($accnos), $start, $finish);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING
        $error = $this->Mdl_corp_common->calculate_retaining_earnings($branch, $cur_date);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
    }

    public function ajax_submit_ca_receipt()
    {
        $validation = validate(
            $this->input->post(),
            [ //Specific Case
                'date' => ['transdate'],
                'number' => ['itemno', 'unit', 'rate', 'amount', 'totalamount']
            ],
            [ //Ignore
                'paidto',
                'remark',
                'remarks',
                'giro'
            ]
        );

        if (!$validation) {
            set_error_response(self::HTTP_BAD_REQUEST, $validation);
            return;
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_cash_advance->get_last_trans_date();

        //Calculate Amount & Total Amount
        $this->_calculate_total_amount($this->input);

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $this->input->post('accno')])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_cash_advance->get_branch_last_balance($this->input->post('branch'), $this->input->post('accno'), $this->input->post('transdate'));

        //COUNTER BALANCE
        if ($acctype == 'A' || $acctype == 'E' || $acctype == 'E1') {
            $counter_balance = ($counter_beg_bal + $this->input->post('totalamount')) -  0;
        } elseif ($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2') {
            $counter_balance = ($counter_beg_bal + 0) - $this->input->post('totalamount');
        }

        //UPDATE EMPLOYEE BALANCE
        $balance = 0;

        $is_docno_exist = $this->Mdl_corp_cash_advance->check_docno_exist($this->input->post('docno'));
        $cur_docno_amount = $this->Mdl_corp_cash_advance->check_docno_amount($this->input->post('docno'));

        if (!$is_docno_exist) {
            $balance = $this->input->post('totalamount');
        } elseif ($is_docno_exist && $cur_docno_amount !== $this->input->post('totalamount')) {
            $emp_beg_bal = $this->Mdl_corp_cash_advance->get_emp_last_balance($branch, $cur_date, $this->input->post('emp_master_id'));

            //DIFFERENCE BETWEEN CURRENT AMOUNT AND PREVIOUS AMOUNT
            $difference = ($this->input->post('totalamount') - $emp_beg_bal);

            $balance = ($emp_beg_bal + $difference);
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $this->input->post('docno'),
            'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
            'TransDate' => $this->input->post('transdate'),
            'TransType' => self::CAR,
            'JournalGroup' => '',
            'Branch' => $this->input->post('branch'),
            'Department' => '',
            'CostCenter' => '',
            'Giro' => $this->input->post('giro'),
            'ItemNo' => $itemno,
            'AccNo' => $this->input->post('accno'),
            'AccType' => $acctype,
            'IDNumber' => $this->input->post('emp_master_id'),
            'Currency' => 'IDR',
            'Rate' => 1,
            'Unit' => $this->input->post('totalamount'),
            'Amount' => $this->input->post('totalamount'),
            'Debit' => 0,
            'Credit' => $this->input->post('totalamount'),
            'Balance' => $balance,
            'BalanceBranch' => $counter_balance,
            'Remarks' => $this->input->post('remark'),
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $this->input->post('docno'),
            'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
            'IDNumber' => $this->input->post('emp_master_id'),
            'SubmitBy' => '',
            'TransType' => self::CAR,
            'TransDate' => $this->input->post('transdate'),
            'JournalGroup' => '',
            'AccNo' => $this->input->post('accno'),
            'Giro' => $this->input->post('giro'),
            'Remarks' => $this->input->post('remark'),
            'Branch' => $this->input->post('branch'),
            'TotalAmount' => $this->input->post('totalamount'),
            'Department' => '',
            'CostCenter' => ''
        ]);

        $cur_accno_bal = [$this->input->post('accno') => $counter_balance];
        for ($i = 0; $i < count($this->input->post('itemno')); $i++) {
            $itemno += 1;

            //DETAIL ACCTYPE
            $acctypes = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $this->input->post('accnos')[$i]])->row()->Acc_Type;

            array_push($details, [
                'DocNo' => $this->input->post('docno'),
                'IDNumber' => '',
                // 'FullName' => $this->db->select('FullName')->get_where('tbl_hr_append', ['IDNumber' => $this->input->post('emp')[$i]])->row()->FullName,
                'AccNo' => $this->input->post('accnos')[$i],
                'Department' => $this->input->post('departments')[$i],
                'CostCenter' => $this->input->post('costcenters')[$i],
                'Remarks' => $this->input->post('remarks')[$i],
                'Currency' => $this->input->post('currency')[$i],
                'Rate' => $this->input->post('rate')[$i],
                'Unit' => $this->input->post('unit')[$i],
                'Amount' => $this->input->post('amount')[$i],
                'Debit' => 0,
                'Credit' => $this->input->post('amount')[$i]
            ]);

            if (isset($cur_accno_bal[$this->input->post('accnos')[$i]])) {
                $branch_beg_bal = $cur_accno_bal[$this->input->post('accnos')[$i]];
            } else {
                $branch_beg_bal = $this->Mdl_corp_cash_advance->get_branch_last_balance($this->input->post('branch'), $this->input->post('accnos')[$i], $this->input->post('transdate'));
                $cur_accno_bal[$this->input->post('accnos')[$i]] = $branch_beg_bal;
            }

            if ($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1') {
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $this->input->post('amount')[$i]) -  0;
            } elseif ($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2' || $acctypes == 'CX') {
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - 0) + $this->input->post('amount')[$i];
            }

            //DETAIL BALANCE
            array_push($trans, [
                'DocNo' => $this->input->post('docno'),
                'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
                'TransDate' => $this->input->post('transdate'),
                'TransType' => self::CAR,
                'JournalGroup' => '',
                'Branch' => $this->input->post('branch'),
                'Department' => $this->input->post('departments')[$i],
                'CostCenter' => $this->input->post('costcenters')[$i],
                'Giro' => $this->input->post('giro'),
                'ItemNo' => $itemno,
                'AccNo' => $this->input->post('accnos')[$i],
                'AccType' => $acctypes,
                'IDNumber' => '',
                'Currency' => $this->input->post('currency')[$i],
                'Rate' => $this->input->post('rate')[$i],
                'Unit' => $this->input->post('unit')[$i],
                'Amount' => $this->input->post('amount')[$i],
                'Debit' => $this->input->post('amount')[$i],
                'Credit' => 0,
                'Balance' => $balance,
                'BalanceBranch' => $branch_bal,
                'Remarks' => $this->input->post('remarks')[$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$this->input->post('accnos')[$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_cash_advance->delete_existed_docno($this->input->post('docno'));

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_cash_advance->submit_cash_advance($master, $details, $trans, $branch, $cur_date);

        if ($submit !== 'success') {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $submit);
        }

        $result = '';
        $accnos = [];
        if ($submit == 'success') {
            //PUSH ALL UNIQUE ACCOUNT NUMBERS
            for ($i = 0; $i < count($cur_accno_bal); $i++) {
                $cur_accno = array_keys($cur_accno_bal)[$i];

                array_push($accnos, $cur_accno);
            }
        }

        if (strtotime($cur_date) < strtotime($last_date)) {
            $start = $cur_date;
            $finish = $last_date;
        } else {
            $start = $last_date;
            $finish = $cur_date;
        }

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        $error = $this->Mdl_corp_entry->recalculate_branch($branch, min($accnos), max($accnos), $start, $finish);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $result);
        }

        //CALCULATE EMPLOYEE BALANCE ABOVE TRANSDATE
        $error = $this->Mdl_corp_cash_advance->update_emp_balance($cur_date, $this->input->post('emp_master_id'));
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING
        $error = $this->Mdl_corp_common->calculate_retaining_earnings($branch, $cur_date);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
    }

    public function view_reps_cash_receipt()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_cash_advance->get_ca_report(self::CAR, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];

        $this->load->view('financecorp/cashadvance/v_reps_cash_receipt', $data);
    }

    //* CASH OUTSTANDING REPORT
    public function ca_outstanding_report()
    {
        $data = [
            'title' => 'Cash Advance Outstanding Report',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => 'Outstanding',
            'h4' => 'Report',

            'company' => $this->Mdl_corp_cash_advance->get_company(),
            'branch' => $this->Mdl_corp_cash_advance->get_branches(),
            'department' => $this->Mdl_corp_cash_advance->get_department(),
            'costcenter' => $this->Mdl_corp_cash_advance->get_costcenter(),

            'script' => 'outstandingReport'
        ];

        $this->load->view('financecorp/cashadvance/v_index_ca_outstanding_report', $data);
    }

    public function ajax_get_outsanding_report()
    {
        $validation = validate($this->input->post());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $branch = $this->input->post('branch');
        $dept = $this->input->post('dept');
        $costcenter = $this->input->post('costcenter');
        $date_start = $this->input->post('date_start');
        $date_finish = $this->input->post('date_finish');

        [$result, $error] = $this->Mdl_corp_cash_advance->get_outstanding_report($branch, $dept, $costcenter, $date_start, $date_finish);

        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
    }

    //* CASH TRANSACTION DETAILS
    public function ca_transaction_details()
    {
        $data = [
            'title' => 'Cash Advance Transaction Details',
            'h1' => 'Cash',
            'h2' => 'Advance',
            'h3' => 'Transaction',
            'h4' => 'Details',

            'company' => $this->Mdl_corp_cash_advance->get_company(),
            'branch' => $this->Mdl_corp_cash_advance->get_branches(),
            'department' => $this->Mdl_corp_cash_advance->get_department(),
            'costcenter' => $this->Mdl_corp_cash_advance->get_costcenter(),

            'script' => 'cashTransactionDetail'
        ];

        $this->load->view('financecorp/cashadvance/v_index_ca_transaction_details', $data);
    }

    public function ajax_get_cash_transaction_detail()
    {
        $validation = validate($this->input->post(), [
            'date' => ['date_start', 'date_finish']
        ]);

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $branch = $this->input->post('branch');
        $dept = $this->input->post('dept');
        $costcenter = $this->input->post('costcenter');
        $date_start = $this->input->post('date_start');
        $date_finish = $this->input->post('date_finish');

        [$result, $error] = $this->Mdl_corp_cash_advance->get_cash_transaction($branch, $dept, $costcenter, $date_start, $date_finish);

        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
    }

    //* CASH REQUEST REPORT
    // public function ca_request_report(){
    //     $data = [
    //         'title' => 'Cash Advance Request Report',
    //         'h1' => 'Cash',
    //         'h2' => 'Advance',
    //         'h3' => 'Request',
    //         'h4' => 'Report'
    //     ];

    //     $this->load->view('financecorp/cashadvance/v_index_ca_request_report', $data);
    // }
}
