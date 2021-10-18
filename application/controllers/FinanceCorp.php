<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class FinanceCorp extends CI_Controller
{
    public function __construct(){
        parent::__construct();

        $this->load->model('financecorp/Mdl_corp_treasury');
        $this->load->model('financecorp/Mdl_corp_branch');
        $this->load->model('financecorp/Mdl_corp_personal');
        $this->load->model('financecorp/Mdl_corp_balance_sheet');
        $this->load->model('financecorp/Mdl_corp_income_statement');
    }

    //DASHBOARD
    function index(){
        $data['title'] = 'Dashboard';
        
        $this->load->view('finance_corp/dashboard/v_home', $data);
    }

    //RECEIPT VOUCHER
    function view_receipt_voucher(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'List Receipt Voucher',
            
            'list' => $this->Mdl_corp_treasury->get_annual_treasury('RECEIPT', $docno, $start, $end),
            'script' => 'treasuries/receipt'
        ];
        
        $this->load->view('finance_corp/treasuries/v_receipt_voucher', $data);
    }

    function ajax_get_annual_receipt(){
        $result = $this->Mdl_corp_treasury->get_annual_treasury('RECEIPT', $_POST['docno'],$_POST['start'], $_POST['end']);

        echo json_encode($result);
    }

    function edit_receipt(){
        $docno = $_GET['docno'];

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
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_receipt'
        ];
        
        $this->load->view('finance_corp/editview/v_add_receipt_voucher_edit', $data);
    }

    function ajax_delete_receipt(){
        $docno = $_POST['docno'];
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();
        $acc_no = $this->Mdl_corp_treasury->get_docno_accnos($_POST['docno']);
        $accnos = '';

        for($i = 0; $i < count($acc_no); $i++){
            $cur_accno = $acc_no[$i]['AccNo'];

            if($i < count($acc_no)-1){
                $accnos .= "'$cur_accno'," ;
            }else{
                $accnos .= "'$cur_accno'" ;
            }
        }

        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);
        
        echo $result;
    }

    function add_receipt_voucher(){
        $data = [
            'title' => 'Form Receipt Voucher',
            
            'docno' => $this->Mdl_corp_treasury->get_new_treasury_docno('REC'),
            'accno' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branch' => $this->Mdl_corp_treasury->get_branch(),
            'employee' => $this->Mdl_corp_treasury->get_employee(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_receipt'
        ];
        
        $this->load->view('finance_corp/addview/v_add_receipt_voucher', $data);
    }

    public function ajax_submit_receipt(){
        $master = $details = $trans = [];

        $cur_nis = '';
        $cur_branch = '';
        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);
        $counter_accno_beg_bal = $this->Mdl_corp_treasury->get_accno_last_balance($_POST['accno']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + $_POST['totalamount']) -  0;
            $counter_accno_balance = ($counter_accno_beg_bal + $_POST['totalamount']) -  0;
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
            $counter_accno_balance = ($counter_accno_beg_bal + 0) - $_POST['totalamount'];
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
            'Balance' => $counter_accno_balance,
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
                $accno_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
                $accno_beg_bal = $this->Mdl_corp_treasury->get_accno_last_balance($_POST['accnos'][$i]);
                
                $cur_accno_bal[$_POST['accnos'][$i]] = $branch_beg_bal;
            }

            if($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['amount'][$i]) -  0;
                $accno_bal = ($accno_beg_bal + $_POST['amount'][$i]) -  0;
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - 0) + $_POST['amount'][$i];
                $accno_bal = ($accno_beg_bal - 0) + $_POST['amount'][$i];
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
                'IDNumber' => '',
                'Currency' => $_POST['currency'][$i],
                'Rate' => $_POST['rate'][$i],
                'Unit' => $_POST['unit'][$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => 0,
                'Credit' => $_POST['amount'][$i],
                'Balance' => $accno_bal,
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
        $submit = $this->Mdl_corp_treasury->submit_treasury($master, $details, $trans);
        
        $result = '';
        $accnos = '';
        if($submit == 'success'){

            //INSERT STRING ACCNO FOR `WHERE_IN` CONDITION
            for($i = 0; $i < count($cur_accno_bal); $i++){
                $cur_accno = array_keys($cur_accno_bal)[$i];

                if($i < count($cur_accno_bal)-1){
                    $accnos .= "'$cur_accno'," ;
                }else{
                    $accnos .= "'$cur_accno'" ;
                }
            }
        }

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);

        echo $result;
    }

    //PAYMENT VOUCHER
    function view_payment_voucher(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'List Payment Voucher',
            
            'list' => $this->Mdl_corp_treasury->get_annual_treasury('PAYMENT', $docno, $start, $end),
            'script' => 'treasuries/payment'
        ];
        
        $this->load->view('finance_corp/treasuries/v_payment_voucher', $data);
    }

    function ajax_get_annual_payment(){
        $result = $this->Mdl_corp_treasury->get_annual_treasury('PAYMENT', $_POST['docno'],$_POST['start'], $_POST['end']);

        echo json_encode($result);
    }

    function edit_payment(){
        $docno = $_GET['docno'];

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
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_payment'
        ];
        
        $this->load->view('finance_corp/editview/v_add_payment_voucher_edit', $data);
    }

    function ajax_delete_payment(){
        $docno = $_POST['docno'];
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();
        $acc_no = $this->Mdl_corp_treasury->get_docno_accnos($_POST['docno']);
        $accnos = '';

        for($i = 0; $i < count($acc_no); $i++){
            $cur_accno = $acc_no[$i]['AccNo'];

            if($i < count($acc_no)-1){
                $accnos .= "'$cur_accno'," ;
            }else{
                $accnos .= "'$cur_accno'" ;
            }
        }

        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);
        
        echo $result;
    }

    function add_payment_voucher(){
        $data = [
            'title' => 'Form payment Voucher',
            
            'docno' => $this->Mdl_corp_treasury->get_new_treasury_docno('PAY'),
            'accno' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branch' => $this->Mdl_corp_treasury->get_branch(),
            'employee' => $this->Mdl_corp_treasury->get_employee(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_payment'
        ];

        $this->load->view('finance_corp/addview/v_add_payment_voucher', $data);
    }

    public function ajax_submit_payment(){
        $master = $details = $trans = [];

        $cur_nis = '';
        $cur_branch = '';
        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);
        $counter_accno_beg_bal = $this->Mdl_corp_treasury->get_accno_last_balance($_POST['accno']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
            $counter_accno_balance = ($counter_accno_beg_bal + 0) - $_POST['totalamount'];
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal - 0) + $_POST['totalamount'];    
            $counter_accno_balance = ($counter_accno_beg_bal - 0) + $_POST['totalamount'];    
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
            'Balance' => $counter_accno_balance,
            'BalanceBranch' => $counter_balance,
            'Remarks' => $_POST['remark'],
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $_POST['docno'],
            'IDNumber' => $_POST['paidto'],
            'SubmitBy' => '',
            'TransType' => 'PAYMENT',
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
                $accno_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
                $accno_beg_bal = $this->Mdl_corp_treasury->get_accno_last_balance($_POST['accnos'][$i]);

                $cur_accno_bal[$_POST['accnos'][$i]] = $branch_beg_bal;
            }

            if($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['amount'][$i]) - 0;
                $accno_bal = ($accno_beg_bal + $_POST['amount'][$i]) - 0;
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - $_POST['amount'][$i]) + 0;
                $accno_bal = ($accno_beg_bal - $_POST['amount'][$i]) + 0;
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
                'IDNumber' => '',
                'Currency' => $_POST['currency'][$i],
                'Rate' => $_POST['rate'][$i],
                'Unit' => $_POST['unit'][$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => $_POST['amount'][$i],
                'Credit' => 0,
                'Balance' => $accno_bal,
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
        $submit = $this->Mdl_corp_treasury->submit_treasury($master, $details, $trans);
        
        $result = '';
        $accnos = '';
        if($submit == 'success'){

            //INSERT STRING ACCNO FOR `WHERE_IN` CONDITION
            for($i = 0; $i < count($cur_accno_bal); $i++){
                $cur_accno = array_keys($cur_accno_bal)[$i];

                if($i < count($cur_accno_bal)-1){
                    $accnos .= "'$cur_accno'," ;
                }else{
                    $accnos .= "'$cur_accno'" ;
                }
            }
        }

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);

        echo $result;
    }

    //OVERBOOK VOUCHER
    function view_overbook_voucher(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'List Overbook Voucher',
            
            'list' => $this->Mdl_corp_treasury->get_annual_treasury('OVERBOOK', $docno, $start, $end),
            'script' => 'treasuries/overbook'
        ];
        
        $this->load->view('finance_corp/treasuries/v_overbook_voucher', $data);
    }

    function ajax_get_annual_overbook(){
        $result = $this->Mdl_corp_treasury->get_annual_treasury('OVERBOOK', $_POST['docno'],$_POST['start'], $_POST['end']);

        echo json_encode($result);
    }

    function edit_overbook(){
        $docno = $_GET['docno'];

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
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_overbook'
        ];
        
        $this->load->view('finance_corp/editview/v_add_overbook_voucher_edit', $data);
    }

    function ajax_delete_overbook(){
        $docno = $_POST['docno'];
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();
        $acc_no = $this->Mdl_corp_treasury->get_docno_accnos($_POST['docno']);
        $accnos = '';

        for($i = 0; $i < count($acc_no); $i++){
            $cur_accno = $acc_no[$i]['AccNo'];

            if($i < count($acc_no)-1){
                $accnos .= "'$cur_accno'," ;
            }else{
                $accnos .= "'$cur_accno'" ;
            }
        }

        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);
        
        echo $result;
    }

    function add_overbook_voucher(){
        $data = [
            'title' => 'Form Overbook Voucher',
            
            'docno' => $this->Mdl_corp_treasury->get_new_treasury_docno('OVB'),
            'accno' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branch' => $this->Mdl_corp_treasury->get_branch(),
            'employee' => $this->Mdl_corp_treasury->get_employee(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_overbook'
        ];
        
        $this->load->view('finance_corp/addview/v_add_overbook_voucher', $data);
    }

    public function ajax_submit_overbook(){
        $master = $details = $trans = [];

        $cur_nis = '';
        $cur_branch = '';
        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);
        $counter_accno_beg_bal = $this->Mdl_corp_treasury->get_accno_last_balance($_POST['accno']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
            $counter_accno_balance = ($counter_accno_beg_bal + 0) - $_POST['totalamount'];
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal - 0) + $_POST['totalamount'];    
            $counter_accno_balance = ($counter_accno_beg_bal - 0) + $_POST['totalamount'];    
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
            'TransDate' => $_POST['transdate'],
            'TransType' => 'OVERBOOK',
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
            'Balance' => $counter_accno_balance,
            'BalanceBranch' => $counter_balance,
            'Remarks' => $_POST['remark'],
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $_POST['docno'],
            'IDNumber' => $_POST['paidto'],
            'SubmitBy' => '',
            'TransType' => 'OVERBOOK',
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
        $cur_accno_bal = [$_POST['accno'] => $counter_balance];
        for($i = 0; $i < count($_POST['itemno']); $i++){
            $itemno += 1;
            $debit = $_POST['amount'][$i];
            $credit = 0;

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
                $accno_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
                $accno_beg_bal = $this->Mdl_corp_treasury->get_accno_last_balance($_POST['accnos'][$i]);
                
                $cur_accno_bal[$_POST['accnos'][$i]] = $branch_beg_bal;
            }

            if($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['amount'][$i]) - 0;
                $accno_bal = ($accno_beg_bal + $_POST['amount'][$i]) - 0;
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - $_POST['amount'][$i]) + 0;
                $accno_bal = ($accno_beg_bal - $_POST['amount'][$i]) + 0;
            }

            //EMPLOYEE BALANCE
            array_push($trans, [
                'DocNo' => $_POST['docno'],
                'TransDate' => $_POST['transdate'],
                'TransType' => 'OVERBOOK',
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
                'Balance' => $accno_bal,
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
        $submit = $this->Mdl_corp_treasury->submit_treasury($master, $details, $trans);
        
        $result = '';
        $accnos = '';
        if($submit == 'success'){

            //INSERT STRING ACCNO FOR `WHERE_IN` CONDITION
            for($i = 0; $i < count($cur_accno_bal); $i++){
                $cur_accno = array_keys($cur_accno_bal)[$i];

                if($i < count($cur_accno_bal)-1){
                    $accnos .= "'$cur_accno'," ;
                }else{
                    $accnos .= "'$cur_accno'" ;
                }
            }
        }

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);

        echo $result;
    }

    //GENERAL JOURNAL
    function view_general_journal(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'List General Journal',
            
            'list' => $this->Mdl_corp_treasury->get_annual_treasury('GENERAL', $docno, $start, $end),
            'script' => 'treasuries/gl'
        ];
        
        $this->load->view('finance_corp/treasuries/v_general_journal', $data);
    }

    function ajax_get_annual_general_journal(){
        $result = $this->Mdl_corp_treasury->get_annual_treasury('GENERAL', $_POST['docno'],$_POST['start'], $_POST['end']);

        echo json_encode($result);
    }

    function edit_general_journal(){
        $docno = $_GET['docno'];

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
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_general'
        ];
        
        $this->load->view('finance_corp/editview/v_add_general_journal_edit', $data);
    }

    function ajax_delete_general_journal(){
        $docno = $_POST['docno'];
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();
        $acc_no = $this->Mdl_corp_treasury->get_docno_accnos($_POST['docno']);
        $accnos = '';

        for($i = 0; $i < count($acc_no); $i++){
            $cur_accno = $acc_no[$i]['AccNo'];

            if($i < count($acc_no)-1){
                $accnos .= "'$cur_accno'," ;
            }else{
                $accnos .= "'$cur_accno'" ;
            }
        }

        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);
        
        echo $result;
    }

    function add_general_journal(){
        $data = [
            'title' => 'Form General Journal',
            
            'docno' => $this->Mdl_corp_treasury->get_new_treasury_docno('GNR'),
            'branch' => $this->Mdl_corp_treasury->get_branch(),
            'accno' => $this->Mdl_corp_treasury->get_mas_acc(),
            'employee' => $this->Mdl_corp_treasury->get_employee(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_general'
        ];
        
        $this->load->view('finance_corp/addview/v_add_general_journal', $data);
    }

    function ajax_submit_general_journal(){
        $master = $details = $trans = [];

        $cur_nis = '';
        $cur_branch = '';
        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        array_push($master, [
            'DocNo' => $_POST['docno'],
            'IDNumber' => $_POST['paidto'],
            'SubmitBy' => '',
            'TransType' => 'GENERAL',
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
        
        $cur_emp_bal = 0;
        $cur_branch_bal = 0;
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
                $accno_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_general->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
                $accno_beg_bal = $this->Mdl_corp_general->$this->Mdl_corp_treasury->get_accno_last_balance($_POST['accnos'][$i]);

                $cur_accno_bal[$_POST['accnos'][$i]] = $branch_beg_bal;
            }

            if($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['debit'][$i]) - $_POST['credit'][$i];
                $accno_bal = ($accno_beg_bal + $_POST['debit'][$i]) - $_POST['credit'][$i];
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - $_POST['debit'][$i]) + $_POST['credit'][$i];
                $accno_bal = ($accno_beg_bal - $_POST['debit'][$i]) + $_POST['credit'][$i];
            }

            //EMPLOYEE BALANCE
            array_push($trans, [
                'DocNo' => $_POST['docno'],
                'TransDate' => $_POST['transdate'],
                'TransType' => 'GENERAL',
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
                'Amount' => $_POST['debit'][$i] + $_POST['credit'][$i],
                'Debit' => $_POST['debit'][$i],
                'Credit' => $_POST['credit'][$i],
                'Balance' => $accno_bal,
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
        $submit = $this->Mdl_corp_treasury->submit_treasury($master, $details, $trans);
        
        $result = '';
        $accnos = '';
        if($submit == 'success'){

            //INSERT STRING ACCNO FOR `WHERE_IN` CONDITION
            for($i = 0; $i < count($cur_accno_bal); $i++){
                $cur_accno = array_keys($cur_accno_bal)[$i];

                if($i < count($cur_accno_bal)-1){
                    $accnos .= "'$cur_accno'," ;
                }else{
                    $accnos .= "'$cur_accno'" ;
                }
            }
        }

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);

        echo $result;
    }

    //CASH ADVANCE WITHDRAW
    function view_ca_withdraw(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'List CA Withdraw',
            
            'list' => $this->Mdl_corp_treasury->get_annual_treasury('CA-WITHDRAW', $docno, $start, $end),
            'script' => 'treasuries/ca_withdraw'
        ];
        
        $this->load->view('finance_corp/treasuries/v_ca_withdraw', $data);
    }

    function ajax_get_annual_ca_withdraw(){
        $result = $this->Mdl_corp_treasury->get_annual_treasury('CA-WITHDRAW', $_POST['docno'],$_POST['start'], $_POST['end']);

        echo json_encode($result);
    }

    function edit_ca_withdraw(){
        $docno = $_GET['docno'];

        $result = $this->Mdl_corp_treasury->get_docno_details($docno);

        $data = [
            'title' => 'Form Receipt Voucher',
            
            //DocNo Master
            'docno' => $docno,
            'transdate' => $result[0]['TransDate'],
            'id' => $result[0]['IDNumber'],
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
            'employees' => $this->Mdl_corp_treasury->get_employee(),
            'branches' => $this->Mdl_corp_treasury->get_branch(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_receipt'
        ];
        
        $this->load->view('finance_corp/editview/v_add_ca_withdraw_edit', $data);
    }

    function ajax_delete_ca_withdraw(){
        $docno = $_POST['docno'];
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();
        $acc_no = $this->Mdl_corp_treasury->get_docno_accnos($_POST['docno']);
        $accnos = '';

        for($i = 0; $i < count($acc_no); $i++){
            $cur_accno = $acc_no[$i]['AccNo'];

            if($i < count($acc_no)-1){
                $accnos .= "'$cur_accno'," ;
            }else{
                $accnos .= "'$cur_accno'" ;
            }
        }

        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);
        
        echo $result;
    }

    function add_ca_withdraw(){
        $data = [
            'title' => 'Form Cash Advance Withdraw',
            
            'docno' => $this->Mdl_corp_treasury->get_new_treasury_docno('CAW'),
            'accno' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branch' => $this->Mdl_corp_treasury->get_branch(),
            'employee' => $this->Mdl_corp_treasury->get_employee(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_ca_withdraw'
        ];
        
        $this->load->view('finance_corp/addview/v_add_ca_withdraw', $data);
    }

    public function ajax_submit_ca_withdraw(){
        $master = $details = $trans = [];

        $cur_nis = '';
        $cur_branch = '';
        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);
        $counter_accno_beg_bal = $this->Mdl_corp_treasury->get_accno_last_balance($_POST['accno']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
            $counter_accno_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal - 0) + $_POST['totalamount'];    
            $counter_accno_balance = ($counter_beg_bal - 0) + $_POST['totalamount'];    
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
            'TransDate' => $_POST['transdate'],
            'TransType' => 'CA-WITHDRAW',
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
            'Balance' => $counter_accno_balance,
            'BalanceBranch' => $counter_balance,
            'Remarks' => $_POST['remark'],
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $_POST['docno'],
            'IDNumber' => $_POST['emp_master_id'],
            'SubmitBy' => '',
            'TransType' => 'CA-WITHDRAW',
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
                $accno_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
                $accno_beg_bal = $this->Mdl_corp_treasury->get_accno_last_balance($_POST['accnos'][$i]);
                
                $cur_accno_bal[$_POST['accnos'][$i]] = $branch_beg_bal;
            }

            if($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['amount'][$i]) - 0;
                $accno_bal = ($accno_beg_bal + $_POST['amount'][$i]) - 0;
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - $_POST['amount'][$i]) + 0;
                $accno_bal = ($accno_beg_bal - $_POST['amount'][$i]) + 0;
            }

            //EMPLOYEE BALANCE
            array_push($trans, [
                'DocNo' => $_POST['docno'],
                'TransDate' => $_POST['transdate'],
                'TransType' => 'CA-WITHDRAW',
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
                'Balance' => $accno_bal,
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
        $submit = $this->Mdl_corp_treasury->submit_treasury($master, $details, $trans);
        
        $result = '';
        $accnos = '';
        if($submit == 'success'){

            //INSERT STRING ACCNO FOR `WHERE_IN` CONDITION
            for($i = 0; $i < count($cur_accno_bal); $i++){
                $cur_accno = array_keys($cur_accno_bal)[$i];

                if($i < count($cur_accno_bal)-1){
                    $accnos .= "'$cur_accno'," ;
                }else{
                    $accnos .= "'$cur_accno'" ;
                }
            }
        }

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);

        echo $result;
    }

    //CASH ADVANCE RECEIPT
    function view_ca_receipt(){
        $docno = '';
        $start = date('Y-01-01');
        $end = date('Y-m-d');

        $data = [
            'title' => 'List CA Receipt',
            
            'list' => $this->Mdl_corp_treasury->get_annual_treasury('CA-RECEIPT', $docno, $start, $end),
            'script' => 'treasuries/ca_receipt'
        ];
        
        $this->load->view('finance_corp/treasuries/v_ca_receipt', $data);
    }

    function ajax_get_annual_ca_receipt(){
        $result = $this->Mdl_corp_treasury->get_annual_treasury('CA-RECEIPT', $_POST['docno'],$_POST['start'], $_POST['end']);

        echo json_encode($result);
    }

    function edit_ca_receipt(){
        $docno = $_GET['docno'];

        $result = $this->Mdl_corp_treasury->get_docno_details($docno);

        $data = [
            'title' => 'Form Receipt Voucher',
            
            //DocNo Master
            'docno' => $docno,
            'transdate' => $result[0]['TransDate'],
            'id' => $result[0]['IDNumber'],
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
            'employees' => $this->Mdl_corp_treasury->get_employee(),
            'branches' => $this->Mdl_corp_treasury->get_branch(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_receipt'
        ];
        
        $this->load->view('finance_corp/editview/v_add_ca_receipt_edit', $data);
    }

    function ajax_delete_ca_receipt(){
        $docno = $_POST['docno'];
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();
        $acc_no = $this->Mdl_corp_treasury->get_docno_accnos($_POST['docno']);
        $accnos = '';

        for($i = 0; $i < count($acc_no); $i++){
            $cur_accno = $acc_no[$i]['AccNo'];

            if($i < count($acc_no)-1){
                $accnos .= "'$cur_accno'," ;
            }else{
                $accnos .= "'$cur_accno'" ;
            }
        }

        $this->Mdl_corp_treasury->delete_existed_docno($_POST['docno']);

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);
        
        echo $result;
    }

    function add_ca_receipt(){
        $data = [
            'title' => 'Form Cash Advance Receipt',
            
            'docno' => $this->Mdl_corp_treasury->get_new_treasury_docno('CAR'),
            'accno' => $this->Mdl_corp_treasury->get_mas_acc(),
            'branch' => $this->Mdl_corp_treasury->get_branch(),
            'employee' => $this->Mdl_corp_treasury->get_employee(),
            'currency' => $this->Mdl_corp_treasury->get_currency(),

            'script' => 'add/fincorp_add_ca_receipt'
        ];
        
        $this->load->view('finance_corp/addview/v_add_ca_receipt', $data);
    }

    public function ajax_submit_ca_receipt(){
        $master = $details = $trans = [];

        $cur_nis = '';
        $cur_branch = '';
        $itemno = 0;
        $branch = $_POST['branch'];
        $cur_date = $_POST['transdate'];
        $last_date = $this->Mdl_corp_treasury->get_last_trans_date();

        //COUNTER BALANCE ACCTYPE
        $acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type;

        //SET BEGINNING BALANCE
        $counter_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accno'], $_POST['transdate']);
        $counter_accno_beg_bal = $this->Mdl_corp_treasury->get_accno_last_balance($_POST['accno']);

        //COUNTER BALANCE
        if($acctype == 'A' || $acctype == 'E' || $acctype == 'E1'){
            $counter_balance = ($counter_beg_bal + $_POST['totalamount']) -  0;
            $counter_accno_balance = ($counter_beg_bal + $_POST['totalamount']) -  0;
        }elseif($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2'){
            $counter_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];    
            $counter_accno_balance = ($counter_beg_bal + 0) - $_POST['totalamount'];    
        }

        //COUNTER-BALANCE
        array_push($trans, [
            'DocNo' => $_POST['docno'],
            'TransDate' => $_POST['transdate'],
            'TransType' => 'CA-RECEIPT',
            'JournalGroup' => $_POST['journalgroup'],
            'Branch' => $_POST['branch'],
            'Department' => '',
            'CostCenter' => '',
            'Giro' => $_POST['giro'],
            'ItemNo' => $itemno,
            'AccNo' => $_POST['accno'],
            'AccType' => $acctype,
            // 'IDNumber' => $_POST['paidto'],
            'Currency' => 'IDR',
            'Rate' => 1,
            'Unit' => $_POST['totalamount'],
            'Amount' => $_POST['totalamount'],
            'Debit' => $_POST['totalamount'],
            'Credit' => 0,
            'Balance' => $counter_accno_balance,
            'BalanceBranch' => $counter_balance,
            'Remarks' => $_POST['remark'],
            'EntryBy' => '',
            'EntryDate' => date('Y-m-d h:m:s')
        ]);

        array_push($master, [
            'DocNo' => $_POST['docno'],
            // 'IDNumber' => $_POST['paidto'],
            'SubmitBy' => '',
            'TransType' => 'CA-RECEIPT',
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
                $accno_beg_bal = $cur_accno_bal[$_POST['accnos'][$i]];
            }else{
                $branch_beg_bal = $this->Mdl_corp_treasury->get_branch_last_balance($_POST['branch'], $_POST['accnos'][$i], $_POST['transdate']);
                $accno_beg_bal = $this->Mdl_corp_treasury->get_accno_last_balance($_POST['accnos'][$i]);
                $cur_accno_bal[$_POST['accnos'][$i]] = $branch_beg_bal;
            }

            if($acctypes == 'A' || $acctypes == 'E' || $acctypes == 'E1'){
                /**
                 * (BEGINNING BALANCE + DEBIT) - CREDIT
                 */
                $branch_bal = ($branch_beg_bal + $_POST['amount'][$i]) -  0;
                $accno_bal = ($accno_beg_bal + $_POST['amount'][$i]) -  0;
            }elseif($acctypes == 'L' || $acctypes == 'C' || $acctypes == 'R' || $acctypes == 'A1' || $acctypes == 'R1' || $acctypes == 'C1' || $acctypes == 'C2'){
                /**
                 * (BEGINNING BALANCE - DEBIT) + CREDIT
                 */
                $branch_bal = ($branch_beg_bal - 0) + $_POST['amount'][$i];
                $accno_bal = ($accno_beg_bal - 0) + $_POST['amount'][$i];
            }

            //EMPLOYEE BALANCE
            array_push($trans, [
                'DocNo' => $_POST['docno'],
                'TransDate' => $_POST['transdate'],
                'TransType' => 'CA-RECEIPT',
                'JournalGroup' => $_POST['journalgroup'],
                'Branch' => $_POST['branch'],
                'Department' => $_POST['departments'][$i],
                'CostCenter' => $_POST['costcenters'][$i],
                'Giro' => $_POST['giro'],
                'ItemNo' => $itemno,
                'AccNo' => $_POST['accnos'][$i],
                'AccType' => $acctypes,
                // 'IDNumber' => '',
                'Currency' => $_POST['currency'][$i],
                'Rate' => $_POST['rate'][$i],
                'Unit' => $_POST['unit'][$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => 0,
                'Credit' => $_POST['amount'][$i],
                'Balance' => $accno_bal,
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
        $submit = $this->Mdl_corp_treasury->submit_treasury($master, $details, $trans);
        
        $result = '';
        $accnos = '';
        if($submit == 'success'){

            //INSERT STRING ACCNO FOR `WHERE_IN` CONDITION
            for($i = 0; $i < count($cur_accno_bal); $i++){
                $cur_accno = array_keys($cur_accno_bal)[$i];

                if($i < count($cur_accno_bal)-1){
                    $accnos .= "'$cur_accno'," ;
                }else{
                    $accnos .= "'$cur_accno'" ;
                }
            }
        }

        $result = $this->Mdl_corp_treasury->calculate_balance($branch, $accnos, $cur_date, $last_date);

        echo $result;
    }

    //GL REPORT
    function view_gl(){
        $data['title'] = 'General Ledger';
        $data['h1'] = 'General';
        $data['h2'] = 'Ledger';
        $data['h3'] = '(All)';
        
        $this->load->view('finance_corp/reports/v_gl', $data);
    }

    function view_gl_branch(){
        
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
            'script' => 'report/fincorp_gl_branch'
        ];
        
        $this->load->view('finance_corp/reports/v_gl_branch', $data);
    }

    function view_gl_branch_report(){
        $branch = isset($_GET['branch']) ? $_GET['branch'] : 'All';
        $accno_start = isset($_GET['accno_start']) ? $_GET['accno_start'] : '10000';
        $accno_finish = isset($_GET['accno_finish']) ? $_GET['accno_finish'] : '90000';
        $date_start = isset($_GET['date_start']) ? $_GET['date_start'] : date('Y-01-01');
        $date_finish = isset($_GET['date_finish']) ? $_GET['date_finish'] : date('Y-m-d');

        $data = [
            //HEADER
            'title' => 'General Ledger',
            'h1' => 'General',
            'h2' => 'Ledger',
            'h3' => '(Branch)',

            //LEDGER TABLE
            'date_start' => date('d-M-Y', strtotime($date_start)),
            'date_end' => date('d-M-Y', strtotime($date_finish)),
            'ledger' => $this->Mdl_corp_branch->get_general_ledger($branch, $accno_start, $accno_finish, $date_start, $date_finish),

            //SCRIPT
            'script' => 'report/fincorp_gl_branch'
        ];
        
        $this->load->view('finance_corp/reports/v_reps_gl', $data);
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

    function view_balance_sheet(){

        list($company, $asset, $liabilities, $capital) = $this->Mdl_corp_balance_sheet->get_report();

        $data = [
            'title' => 'Balance Sheet',
            'h1' => 'Balance',
            'h2' => 'Sheet',
            'h3' => '',

            'company' => $company->ComName,
            'asset' => $asset,
            'liabilities' => $liabilities,
            'capital' => $capital
        ];
        
        $this->load->view('finance_corp/reports/v_reps_balance_sheet', $data);
    }

    function view_incomestatement(){
        $data = [
            //HEADER
            'title' => 'Income Statement',
            'h1' => 'Income',
            'h2' => 'Statement',
            'h3' => '',
        ];

        $this->load->view('finance_corp/reports/v_income_statement', $data);
    }

    function view_trial_balance(){
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
    function ajax_recalculate_balance(){
        $branch = $_POST['branch'];
        $accno_start = $_POST['accno_start'];
        $accno_finish = $_POST['accno_finish'];
        $date_start = $_POST['date_start'];
        $date_finish = $this->Mdl_corp_treasury->get_last_trans_date();

        $result = $this->Mdl_corp_branch->recalculate_balance($branch, $accno_start, $accno_finish, $date_start, $date_finish);

        echo $result;
    }

    //Reports Rugi - Laba
    function view_reps_rl(){
        $docno = $_GET['docno'];
        $branch = $_GET['branch'];
        $transdate = $_GET['transdate'];
        $idnumber = $_GET['idnumber'];

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            // 'report' => $this->Mdl_corp_treasury->get_treasury_report('RECEIPT',$docno, $branch, $transdate)
        ];
        
        $this->load->view('finance_corp/reports/v_reps_rl', $data);
    }

    //Reports Balance Sheet
    function view_reps_balance_sheet(){
        $docno = $_GET['docno'];
        $branch = $_GET['branch'];
        $transdate = $_GET['transdate'];
        $idnumber = $_GET['idnumber'];

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            // 'report' => $this->Mdl_corp_treasury->get_treasury_report('',$docno, $branch, $transdate)
        ];
        
        $this->load->view('finance_corp/reports/v_reps_balance_sheet', $data);
    }

    //Reports Receipt Voucher
    function view_reps_receipt_voucher(){
        $docno = $_GET['docno'];
        $branch = $_GET['branch'];
        $transdate = $_GET['transdate'];
        // $idnumber = $_GET['idnumber'];

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'report' => $this->Mdl_corp_treasury->get_treasury_report('RECEIPT',$docno, $branch, $transdate)
        ];
        
        $this->load->view('finance_corp/reports/v_reps_receipt_voucher', $data);
    }

    //Reports Payment Voucher
    function view_reps_payment_voucher(){
        $docno = $_GET['docno'];
        $branch = $_GET['branch'];
        $transdate = $_GET['transdate'];
        // $idnumber = $_GET['idnumber'];

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'report' => $this->Mdl_corp_treasury->get_treasury_report('PAYMENT',$docno, $branch, $transdate)
        ];
        
        $this->load->view('finance_corp/reports/v_reps_payment_voucher', $data);
    }

    //Reports General Journal
    function view_reps_general_journal(){
        $docno = $_GET['docno'];
        $branch = $_GET['branch'];
        $transdate = $_GET['transdate'];
        // $idnumber = $_GET['idnumber'];

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'report' => $this->Mdl_corp_treasury->get_treasury_report('GENERAL',$docno, $branch, $transdate)
        ];
        
        $this->load->view('finance_corp/reports/v_reps_general_journal', $data);
    }

    //Reports Cash Withdraw
    function view_reps_cash_withdraw(){
        $docno = $_GET['docno'];
        $branch = $_GET['branch'];
        $transdate = $_GET['transdate'];
        // $idnumber = $_GET['idnumber'];

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'report' => $this->Mdl_corp_treasury->get_treasury_report('CA-WITHDRAW',$docno, $branch, $transdate)
        ];
        
        $this->load->view('finance_corp/reports/v_reps_cash_withdraw', $data);
    }

    //Reports Cash Receipt
    function view_reps_cash_receipt(){
        $docno = $_GET['docno'];
        $branch = $_GET['branch'];
        $transdate = $_GET['transdate'];
        // $idnumber = $_GET['idnumber'];

        $data = [
            'title' => 'Reports',
            'h1' => '',
            'h2' => '',
            'h3' => '',

            'report' => $this->Mdl_corp_treasury->get_treasury_report('CA-RECEIPT',$docno, $branch, $transdate)
        ];
        
        $this->load->view('finance_corp/reports/v_reps_cash_receipt', $data);
    }

    //Reports Income Statement
    function view_income_statement(){
        list($company, $revenue, $operational, $other_rev, $other_expense) = $this->Mdl_corp_income_statement->get_report();

        $data = [
            'title' => 'Income Statement',
            'h1' => 'Income',
            'h2' => 'Statement',
            'h3' => '',

            'company' => $company->ComName,
            'revenue' => $revenue,
            'operational' => $operational,
            'other_revenue' => $other_rev,
            'other_expenses' => $other_expense
        ];

        $this->load->view('finance_corp/reports/v_reps_income_statement', $data);
    }
}