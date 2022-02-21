<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Reports extends CI_Controller 
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

    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');

        $this->load->helper([
            'response',
            'validate'
        ]);

        $this->load->model('Mdl_corp_branch');
        $this->load->model('Mdl_corp_balance_sheet');
        $this->load->model('Mdl_corp_income_statement');
        $this->load->model('Mdl_corp_reports');
    }

    //* GENERAL LEDGER
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
            'script' => 'generalLedger'
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

    // ------------ Re-Calculate ------------ \\
    public function ajax_recalculate_balance(){
        $validation = validate($this->input->post());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $branch = $this->input->post('branch');
        $accno_start = $this->input->post('accno_start');
        $accno_finish = $this->input->post('accno_finish');
        $date_start = $this->input->post('date_start');

        $date_finish = $this->Mdl_corp_reports->get_last_trans_date();

        $result = $this->Mdl_corp_branch->recalculate_balance($branch, $accno_start, $accno_finish, $date_start, $date_finish);

        return set_success_response($result);
    }

    //* BALANCE SHEET
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

            'script' => 'balanceSheet'
        ];
        
        $this->load->view('finance_corp/reports/v_reps_balance_sheet', $data);
    }

    //* TRIAL BALANCE
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

    //* RECEIPT VOUCHER
    public function view_reps_receipt_voucher(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_reports->get_treasury_report(self::REC, $docno, $branch, $transdate);

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

    //* PAYMENT VOUCHER
    public function view_reps_payment_voucher(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_reports->get_treasury_report(self::PAY, $docno, $branch, $transdate);

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

    //* OVERBOOK
    public function view_reps_overbook_voucher(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_reports->get_treasury_report(self::OVB, $docno, $branch, $transdate);

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'company' => $this->db->select('ComName')->get('abase_01_com')->row()->ComName,
            'report' => $report
        ];
        
        $this->load->view('finance_corp/reports/v_reps_overbook_voucher', $data);
    }

    //* GENERAL JOURNAL
    public function view_reps_general_journal(){
        $validation = validate($this->input->get());
        
        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $docno = $this->input->get('docno');
        $branch = $this->input->get('branch');
        $transdate = $this->input->get('transdate');
        $report = $this->Mdl_corp_reports->get_treasury_report(self::GNJ, $docno, $branch, $transdate);

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

    //* INCOME STATEMENT
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

            'script' => 'incomeStatement'
        ];

        $this->load->view('finance_corp/reports/v_reps_income_statement', $data);
    }

    //* INCOME STATEMENT COLUMNAR
    public function view_income_statement_columnar(){
        $validation = validate($this->input->get(), null, null);

        if(!$validation){
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

        $branch = $this->input->get('branch') ?? null;
        $year =  $this->input->get('year') ?? date('Y');

        [$company, $revenue, $operational, $other_rev, $other_expense] = $this->Mdl_corp_income_statement->get_columnar_report($branch, $year);

        $data = [
            'title' => 'Report Journal Transaction',
            'h1' => 'Report',
            'h2' => 'Journal',
            'h3' => 'Transaction',
            'h4' => '',

            'company' => $company->ComName,
            'branch' => $this->db->select('BranchCode, BranchName')->get('abase_02_branch')->result(),
            'year' => $year,
            'revenue' => $revenue,
            'operational' => $operational,
            'other_revenue' => $other_rev,
            'other_expenses' => $other_expense,

            'script' => 'incomeStatementColumnar'
        ];

        $this->load->view('finance_corp/reports/v_reps_income_statement_columnar', $data);
    }
 
    //* JOURNAL TRANSACTION
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