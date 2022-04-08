<?php

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

    //TransType for Entries
    const REC = 'RE';
    const PAY = 'PA';
    const OVB = 'OB';
    const GNJ = 'GJ';

    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');

        $this->load->helper([
            'response',
            'validate'
        ]);

        $this->load->model('Mdl_corp_entry');
        $this->load->model('Mdl_corp_reports');
        $this->load->model('Mdl_corp_common');
    }

    //* RECEIPT VOUCHER
    public function view_receipt_voucher()
    {
        $data = [
            'title' => 'List Receipt Voucher',
            'script' => 'receipt'
        ];

        $this->load->view('financecorp/entry/v_index_receipt_voucher', $data);
    }

    public function ajax_get_ranged_receipt()
    {
        $validation = validate($this->input->post(), null, ['docno']);

        if (!$validation) {
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

    public function add_receipt_voucher()
    {
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

        $this->load->view('financecorp/entry/v_add_receipt_voucher', $data);
    }

    public function edit_receipt()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
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

        $this->load->view('financecorp/entry/v_edit_receipt_voucher', $data);
    }

    public function ajax_delete_receipt()
    {
        $validation = validate($this->input->post());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        if (strtotime($cur_date) < strtotime($last_date)) {
            $start = $cur_date;
            $finish = $last_date;
        } else {
            $start = $last_date;
            $finish = $cur_date;
        }

        $acc_no = $this->Mdl_corp_entry->get_docno_accnos($docno);
        $accnos = [];

        for ($i = 0; $i < count($acc_no); $i++) {
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_entry->delete_existed_docno($this->input->post('docno'));

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

    public function ajax_submit_receipt()
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
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $this->input->post('accno')])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($this->input->post('branch'), $this->input->post('accno'), $this->input->post('transdate'));

        //COUNTER BALANCE
        if ($acctype == 'A' || $acctype == 'E' || $acctype == 'E1') {
            $counter_balance = ($counter_beg_bal + $this->input->post('totalamount')) -  0;
        } elseif ($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2') {
            $counter_balance = ($counter_beg_bal + 0) - $this->input->post('totalamount');
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $this->input->post('docno'),
            'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
            'TransDate' => $this->input->post('transdate'),
            'TransType' => self::REC,
            'JournalGroup' => $this->input->post('journalgroup'),
            'Branch' => $this->input->post('branch'),
            'Department' => '',
            'CostCenter' => '',
            'Giro' => $this->input->post('giro'),
            'ItemNo' => $itemno,
            'AccNo' => $this->input->post('accno'),
            'AccType' => $acctype,
            'IDNumber' => $this->input->post('paidto'),
            'Currency' => 'IDR',
            'Rate' => 1,
            'Unit' => $this->input->post('totalamount'),
            'Amount' => $this->input->post('totalamount'),
            'Debit' => $this->input->post('totalamount'),
            'Credit' => 0,
            'Balance' => 0,
            'BalanceBranch' => $counter_balance,
            'Remarks' => $this->input->post('remark'),
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $this->input->post('docno'),
            'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
            'IDNumber' => $this->input->post('paidto'),
            'SubmitBy' => '',
            'TransType' => self::REC,
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
                $branch_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($this->input->post('branch'), $this->input->post('accnos')[$i], $this->input->post('transdate'));

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
                'TransType' => self::REC,
                'JournalGroup' => $this->input->post('journalgroup'),
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
                'Debit' => 0,
                'Credit' => $this->input->post('amount')[$i],
                'Balance' => 0,
                'BalanceBranch' => $branch_bal,
                'Remarks' => $this->input->post('remarks')[$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$this->input->post('accnos')[$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_entry->delete_existed_docno($this->input->post('docno'));

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_entry->submit_treasury($master, $details, $trans, $branch, $cur_date);

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
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING
        $error = $this->Mdl_corp_common->calculate_retaining_earnings($branch, $cur_date);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
    }

    public function view_reps_receipt_voucher()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
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

        $this->load->view('financecorp/entry/v_reps_receipt_voucher', $data);
    }

    //* PAYMENT VOUCHER
    public function view_payment_voucher()
    {
        $data = [
            'title' => 'List Payment Voucher',
            'script' => 'payment'
        ];

        $this->load->view('financecorp/entry/v_index_payment_voucher', $data);
    }

    public function ajax_get_ranged_payment()
    {

        $validation = validate($this->input->post(), null, ['docno']);

        if (!$validation) {
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

    public function add_payment_voucher()
    {
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

        $this->load->view('financecorp/entry/v_add_payment_voucher', $data);
    }

    public function edit_payment()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
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

        $this->load->view('financecorp/entry/v_edit_payment_voucher', $data);
    }

    public function ajax_delete_payment()
    {
        $validation = validate($this->input->post());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        if (strtotime($cur_date) < strtotime($last_date)) {
            $start = $cur_date;
            $finish = $last_date;
        } else {
            $start = $last_date;
            $finish = $cur_date;
        }

        $acc_no = $this->Mdl_corp_entry->get_docno_accnos($docno);
        $accnos = [];

        for ($i = 0; $i < count($acc_no); $i++) {
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_entry->delete_existed_docno($this->input->post('docno'));

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

    public function ajax_submit_payment()
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
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $this->input->post('accno')])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($this->input->post('branch'), $this->input->post('accno'), $this->input->post('transdate'));

        //COUNTER BALANCE
        if ($acctype == 'A' || $acctype == 'E' || $acctype == 'E1') {
            $counter_balance = ($counter_beg_bal + 0) - $this->input->post('totalamount');
        } elseif ($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2') {
            $counter_balance = ($counter_beg_bal - 0) + $this->input->post('totalamount');
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $this->input->post('docno'),
            'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
            'TransDate' => $this->input->post('transdate'),
            'TransType' => self::PAY,
            'JournalGroup' => $this->input->post('journalgroup'),
            'Branch' => $this->input->post('branch'),
            'Department' => '',
            'CostCenter' => '',
            'Giro' => $this->input->post('giro'),
            'ItemNo' => $itemno,
            'AccNo' => $this->input->post('accno'),
            'AccType' => $acctype,
            'IDNumber' => $this->input->post('paidto'),
            'Currency' => 'IDR',
            'Rate' => 1,
            'Unit' => $this->input->post('totalamount'),
            'Amount' => $this->input->post('totalamount'),
            'Debit' => 0,
            'Credit' => $this->input->post('totalamount'),
            'Balance' => 0,
            'BalanceBranch' => $counter_balance,
            'Remarks' => $this->input->post('remark'),
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $this->input->post('docno'),
            'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
            'IDNumber' => $this->input->post('paidto'),
            'SubmitBy' => '',
            'TransType' => self::PAY,
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
                $branch_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($this->input->post('branch'), $this->input->post('accnos')[$i], $this->input->post('transdate'));

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
                'TransType' => self::PAY,
                'JournalGroup' => $this->input->post('journalgroup'),
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
                'Balance' => 0,
                'BalanceBranch' => $branch_bal,
                'Remarks' => $this->input->post('remarks')[$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$this->input->post('accnos')[$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_entry->delete_existed_docno($this->input->post('docno'));

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_entry->submit_treasury($master, $details, $trans, $branch, $cur_date);

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
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING
        $error = $this->Mdl_corp_common->calculate_retaining_earnings($branch, $cur_date);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
    }

    public function view_reps_payment_voucher()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
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

        $this->load->view('financecorp/entry/v_reps_payment_voucher', $data);
    }

    //* OVERBOOK VOUCHER
    public function view_overbook_voucher()
    {
        $data = [
            'title' => 'List Overbook Voucher',
            'script' => 'overbook'
        ];

        $this->load->view('financecorp/entry/v_index_overbook_voucher', $data);
    }

    public function ajax_get_ranged_overbook()
    {

        $validation = validate($this->input->post(), null, ['docno']);

        if (!$validation) {
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

    public function add_overbook_voucher()
    {
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

        $this->load->view('financecorp/entry/v_add_overbook_voucher', $data);
    }

    public function edit_overbook()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
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

        $this->load->view('financecorp/entry/v_edit_overbook_voucher', $data);
    }

    public function ajax_delete_overbook()
    {
        $validation = validate($this->input->post());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        if (strtotime($cur_date) < strtotime($last_date)) {
            $start = $cur_date;
            $finish = $last_date;
        } else {
            $start = $last_date;
            $finish = $cur_date;
        }

        $acc_no = $this->Mdl_corp_entry->get_docno_accnos($docno);
        $accnos = [];

        for ($i = 0; $i < count($acc_no); $i++) {
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_entry->delete_existed_docno($this->input->post('docno'));

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

    public function ajax_submit_overbook()
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
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $this->input->post('accno')])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($this->input->post('branch'), $this->input->post('accno'), $this->input->post('transdate'));

        //COUNTER BALANCE
        if ($acctype == 'A' || $acctype == 'E' || $acctype == 'E1') {
            $counter_balance = ($counter_beg_bal + 0) - $this->input->post('totalamount');
        } elseif ($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2') {
            $counter_balance = ($counter_beg_bal - 0) + $this->input->post('totalamount');
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $this->input->post('docno'),
            'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
            'TransDate' => $this->input->post('transdate'),
            'TransType' => self::OVB,
            'JournalGroup' => $this->input->post('journalgroup'),
            'Branch' => $this->input->post('branch'),
            'Department' => '',
            'CostCenter' => '',
            'Giro' => $this->input->post('giro'),
            'ItemNo' => $itemno,
            'AccNo' => $this->input->post('accno'),
            'AccType' => $acctype,
            'IDNumber' => $this->input->post('paidto'),
            'Currency' => 'IDR',
            'Rate' => 1,
            'Unit' => $this->input->post('totalamount'),
            'Amount' => $this->input->post('totalamount'),
            'Debit' => 0,
            'Credit' => $this->input->post('totalamount'),
            'Balance' => 0,
            'BalanceBranch' => $counter_balance,
            'Remarks' => $this->input->post('remark'),
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $this->input->post('docno'),
            'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
            'IDNumber' => $this->input->post('paidto'),
            'SubmitBy' => '',
            'TransType' => self::OVB,
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

            // $emp_beg_bal = $this->Mdl_corp_entry->get_emp_last_balance($this->input->post('emp')[$i]);
            if (isset($cur_accno_bal[$this->input->post('accnos')[$i]])) {
                $branch_beg_bal = $cur_accno_bal[$this->input->post('accnos')[$i]];
            } else {
                $branch_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($this->input->post('branch'), $this->input->post('accnos')[$i], $this->input->post('transdate'));

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
                'TransType' => self::OVB,
                'JournalGroup' => $this->input->post('journalgroup'),
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
                'Balance' => 0,
                'BalanceBranch' => $branch_bal,
                'Remarks' => $this->input->post('remarks')[$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$this->input->post('accnos')[$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_entry->delete_existed_docno($this->input->post('docno'));

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_entry->submit_treasury($master, $details, $trans, $branch, $cur_date);

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
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING
        $error = $this->Mdl_corp_common->calculate_retaining_earnings($branch, $cur_date);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
    }

    public function view_reps_overbook_voucher()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
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

        $this->load->view('financecorp/entry/v_reps_overbook_voucher', $data);
    }

    //* GENERAL JOURNAL
    public function view_general_journal()
    {
        $data = [
            'title' => 'List General Journal',
            'script' => 'generalJournal'
        ];

        $this->load->view('financecorp/entry/v_index_general_journal', $data);
    }

    public function ajax_get_ranged_general_journal()
    {
        $validation = validate($this->input->post(), null, ['docno']);

        if (!$validation) {
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

    public function add_general_journal()
    {
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

        $this->load->view('financecorp/entry/v_add_general_journal', $data);
    }

    public function edit_general_journal()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
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

        $this->load->view('financecorp/entry/v_edit_general_journal', $data);
    }

    public function ajax_delete_general_journal()
    {
        $validation = validate($this->input->post());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        if (strtotime($cur_date) < strtotime($last_date)) {
            $start = $cur_date;
            $finish = $last_date;
        } else {
            $start = $last_date;
            $finish = $cur_date;
        }

        $acc_no = $this->Mdl_corp_entry->get_docno_accnos($docno);
        $accnos = [];

        for ($i = 0; $i < count($acc_no); $i++) {
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_entry->delete_existed_docno($this->input->post('docno'));

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

    public function ajax_submit_general_journal()
    {
        $validation = validate(
            $this->input->post(),
            [ //Specific Case
                'date' => ['transdate'],
                'number' => ['itemno', 'debit', 'credit']
            ],
            [ //Ignore
                'paidto',
                'remark',
                'remarks',
                'giro'
            ]
        );

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $master = $details = $trans = [];

        $itemno = 0;
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_entry->get_last_trans_date();

        array_push($master, [
            'DocNo' => $this->input->post('docno'),
            'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
            'IDNumber' => $this->input->post('paidto'),
            'SubmitBy' => '',
            'TransType' => self::GNJ,
            'TransDate' => $this->input->post('transdate'),
            'JournalGroup' => '',
            'AccNo' => '',
            'Giro' => '',
            'Remarks' => $this->input->post('remark'),
            'Branch' => $this->input->post('branch'),
            'TotalAmount' => 0,
            'Department' => '',
            'CostCenter' => ''
        ]);

        $cur_accno_bal = [];
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
                'Rate' => 1,
                'Unit' => $this->input->post('debit')[$i] + $this->input->post('credit')[$i],
                'Amount' => $this->input->post('debit')[$i] + $this->input->post('credit')[$i],
                'Debit' => $this->input->post('debit')[$i],
                'Credit' => $this->input->post('credit')[$i]
            ]);

            // $emp_beg_bal = $this->Mdl_corp_general->get_emp_last_balance($this->input->post('emp')[$i]);
            if (isset($cur_accno_bal[$this->input->post('accnos')[$i]])) {
                $branch_beg_bal = $cur_accno_bal[$this->input->post('accnos')[$i]];
            } else {
                $branch_beg_bal = $this->Mdl_corp_entry->get_branch_last_balance($this->input->post('branch'), $this->input->post('accnos')[$i], $this->input->post('transdate'));

                $cur_accno_bal[$this->input->post('accnos')[$i]] = $branch_beg_bal;
            }

            if ($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1') {
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $this->input->post('debit')[$i]) - $this->input->post('credit')[$i];
            } elseif ($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2' || $acctypes == 'CX') {
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - $this->input->post('debit')[$i]) + $this->input->post('credit')[$i];
            }

            $amount = $this->input->post('debit')[$i] + $this->input->post('credit')[$i];

            //SET AMOUNT TO MINUS OR PLUS FOR CURRENT/RETAINING EARNINGS IF IT'S DEBIT
            if ($this->input->post('debit')[$i] > 0 && ($acctypes == 'CX' || $acctypes == 'C1')) {
                $amount = -1 * ($this->input->post('debit')[$i] + $this->input->post('credit')[$i]);
            }

            //DETAIL BALANCE
            array_push($trans, [
                'DocNo' => $this->input->post('docno'),
                'RefNo' => ($this->input->post('refno') == '' ? $this->input->post('docno') : $this->input->post('refno')),
                'TransDate' => $this->input->post('transdate'),
                'TransType' => self::GNJ,
                'JournalGroup' => '',
                'Branch' => $this->input->post('branch'),
                'Department' => $this->input->post('departments')[$i],
                'CostCenter' => $this->input->post('costcenters')[$i],
                'Giro' => '',
                'ItemNo' => $itemno,
                'AccNo' => $this->input->post('accnos')[$i],
                'AccType' => $acctypes,
                'IDNumber' => '',
                'Currency' => $this->input->post('currency')[$i],
                'Rate' => 1,
                'Unit' => $this->input->post('debit')[$i] + $this->input->post('credit')[$i],
                'Amount' => $amount,
                'Debit' => $this->input->post('debit')[$i],
                'Credit' => $this->input->post('credit')[$i],
                'Balance' => 0,
                'BalanceBranch' => $branch_bal,
                'Remarks' => $this->input->post('remarks')[$i],
                'EntryBy' => '',
                'EntryDate' => date('Y-m-d h:m:s')
            ]);

            $cur_accno_bal[$this->input->post('accnos')[$i]] = $branch_bal;
        }

        //DELETE OLD DOCNO DATA FIRST IF EXISTS
        $this->Mdl_corp_entry->delete_existed_docno($this->input->post('docno'));

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_entry->submit_treasury($master, $details, $trans, $branch, $cur_date);

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
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING
        $error = $this->Mdl_corp_common->calculate_retaining_earnings($branch, $cur_date);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
    }

    public function view_reps_general_journal()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
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

        $this->load->view('financecorp/entry/v_reps_general_journal', $data);
    }

    //* RECALCULATE BALANCE
    public function view_recalculate_balance()
    {
        $data = [
            'title' => 'Recalculate Balance',

            //Branch Parameters
            'branch' => $this->Mdl_corp_reports->get_branch(),
            'account_no' => $this->Mdl_corp_reports->get_account_no(),

            //Employee Parameter
            'employee' => $this->Mdl_corp_entry->get_employee(),

            'script' => 'recalculateBalance'
        ];

        $this->load->view('financecorp/entry/v_index_recalculate_balance', $data);
    }

    public function ajax_recalculate_branch()
    {
        $validation = validate($this->input->post());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $branch = $this->input->post('branch');
        $accno_start = $this->input->post('accno_start');
        $accno_finish = $this->input->post('accno_finish');
        $date_start = $this->input->post('date_start') ?? date('Y-m-d');
        $date_finish = $this->Mdl_corp_reports->get_last_trans_date();

        [$result, $error] = $this->Mdl_corp_entry->recalculate_branch($branch, $accno_start, $accno_finish, $date_start, $date_finish);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING EACH MONTH FROM DATE START
        $cur_month = strtotime($date_start);
        $end_month = strtotime($date_finish);
        while($cur_month <= $end_month){
            $error = $this->Mdl_corp_common->calculate_retaining_earnings($branch, date("Y-m-d", $cur_month));
            if(!is_null($error)){
                return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
            }

            $cur_month = strtotime("+1 month", $cur_month);
        }

        return set_success_response($result);
    }

    public function ajax_recalculate_employee()
    {
        $validation = validate($this->input->post());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $employee = $this->input->post('employee');
        $date_start = $this->input->post('date_start');

        [$result, $error] = $this->Mdl_corp_entry->recalculate_employee($employee, $date_start);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING EACH MONTH FROM DATE START
        $cur_month = $date_start;
        $date_finish = date('Y-m-d');
        $branch = $this->db->select('Branch')->get_where('tbl_hr_append', ['IDNumber' => $employee])->row()->Branch;

        while(strtotime($cur_month) <= strtotime($date_finish)){
            $error = $this->Mdl_corp_common->calculate_retaining_earnings($branch, $cur_month);
            if(!is_null($error)){
                return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
            }

            $cur_month = strtotime("+1 month",$cur_month);
        }

        return set_success_response($result);
    }
}
