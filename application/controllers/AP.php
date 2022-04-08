<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
        
class AP extends CI_Controller {

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
    const AP = 'AP';

    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');

        $this->load->helper([
            'response',
            'validate'
        ]);

        $this->load->model('Mdl_corp_ap');
        $this->load->model('Mdl_corp_common');
        $this->load->model('Mdl_corp_entry');
    }

    //* AP Payment
    public function view_ap_payment()
    {
        $data = [
            'title' => 'List AP Payment',
            'script' => 'apPayment'
        ];

        $this->load->view('financecorp/ap/v_index_ap_payment', $data);
    }

    public function ajax_get_ranged_ap_payment()
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

        $query = $this->Mdl_corp_ap->get_ranged_ap(self::AP, $datatable);

        $result = [
            'draw' => $this->input->post('draw'),
            'data' => $query
        ];

        return set_success_response($result);
    }

    public function add_ap_payment()
    {
        $data = [
            'title' => 'Form AP Payment',

            'supplier' => $this->Mdl_corp_ap->get_supplier(),
            'docno' => $this->Mdl_corp_ap->get_new_treasury_docno(self::AP),
            'accno' => $this->Mdl_corp_ap->get_mas_acc(),
            'branch' => $this->Mdl_corp_ap->get_branch(),
            'employee' => $this->Mdl_corp_ap->get_employee(),
            'department' => $this->Mdl_corp_ap->get_department(),
            'costcenter' => $this->Mdl_corp_ap->get_costcenter(),
            'currency' => $this->Mdl_corp_ap->get_currency(),

            'script' => 'apPayment'
        ];

        $this->load->view('financecorp/ap/v_add_ap_payment', $data);
    }

    public function edit_ap_payment()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');

        $result = $this->Mdl_corp_ap->get_docno_details($docno);

        $data = [
            'title' => 'Form AP Payment',

            //DocNo Master
            'supplier' => $result[0]['IDNumber'],
            'docno' => $docno,
            'refno' => $result[0]['RefNo'],
            'transdate' => $result[0]['TransDate'],
            'journalgroup' => $result[0]['JournalGroup'],
            'remark' => $result[0]['Remarks'],
            'accno' => $result[0]['AccNo'],
            'branch' => $result[0]['Branch'],
            'total' =>  $result[0]['Amount'],
            'giro' =>  $result[0]['Giro'],

            //List
            'list' => $result,

            //Multiple
            'suppliers' => $this->Mdl_corp_ap->get_supplier(),
            'accnos' => $this->Mdl_corp_ap->get_mas_acc(),
            'branches' => $this->Mdl_corp_ap->get_branch(),
            'department' => $this->Mdl_corp_ap->get_department(),
            'costcenter' => $this->Mdl_corp_ap->get_costcenter(),
            'currency' => $this->Mdl_corp_ap->get_currency(),

            'script' => 'apPayment'
        ];

        $this->load->view('financecorp/ap/v_edit_ap_payment', $data);
    }

    public function ajax_delete_ap_payment()
    {
        $validation = validate($this->input->post());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->post('docno');
        $branch = $this->input->post('branch');
        $cur_date = $this->input->post('transdate');
        $last_date = $this->Mdl_corp_ap->get_last_trans_date();

        if (strtotime($cur_date) < strtotime($last_date)) {
            $start = $cur_date;
            $finish = $last_date;
        } else {
            $start = $last_date;
            $finish = $cur_date;
        }

        $acc_no = $this->Mdl_corp_ap->get_docno_accnos($docno);
        $accnos = [];

        for ($i = 0; $i < count($acc_no); $i++) {
            array_push($accnos, $acc_no[$i]['AccNo']);
        }

        $this->Mdl_corp_ap->delete_existed_docno($this->input->post('docno'));

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

    public function ajax_submit_ap_payment()
    {
        $validation = validate(
            $this->input->post(),
            [ //Specific Case
                'date' => ['transdate'],
                'number' => ['itemno', 'unit', 'rate', 'amount', 'totalamount']
            ],
            [ //Ignore
                'supplier',
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
        $last_date = $this->Mdl_corp_ap->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $this->input->post('accno')])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_ap->get_branch_last_balance($this->input->post('branch'), $this->input->post('accno'), $this->input->post('transdate'));

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
            'TransType' => self::AP,
            'JournalGroup' => $this->input->post('journalgroup'),
            'Branch' => $this->input->post('branch'),
            'Department' => '',
            'CostCenter' => '',
            'Giro' => $this->input->post('giro'),
            'ItemNo' => $itemno,
            'AccNo' => $this->input->post('accno'),
            'AccType' => $acctype,
            'IDNumber' => $this->input->post('supplier'),
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
            'IDNumber' => $this->input->post('supplier'),
            'SubmitBy' => '',
            'TransType' => self::AP,
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
                'IDNumber' => $this->input->post('supplier'),
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
                $branch_beg_bal = $this->Mdl_corp_ap->get_branch_last_balance($this->input->post('branch'), $this->input->post('accnos')[$i], $this->input->post('transdate'));

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
                'TransType' => self::AP,
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
        $this->Mdl_corp_ap->delete_existed_docno($this->input->post('docno'));

        //SUBMIT CURRENT DOCNO DATA
        $submit = $this->Mdl_corp_ap->submit_treasury($master, $details, $trans, $branch, $cur_date);

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

    public function view_reps_ap_payment()
    {
        $validation = validate($this->input->get());

        if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_ap->get_ap_report(self::AP, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];

        $this->load->view('financecorp/ap/v_reps_ap_payment', $data);
    }
}