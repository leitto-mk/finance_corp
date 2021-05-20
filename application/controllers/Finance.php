<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class Finance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('finance/Mdl_std_charge');
        $this->load->model('finance/Mdl_std_receipt');
        $this->load->model('finance/Mdl_matrix');

        if ($this->session->userdata('status') != 'admin') {
            redirect('Fin_Login/index');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $this->load->view('finance/v_home_n', $data);
    }

    //TRANSACTION - STUDENT CHARGE
    public function view_student_charge()
    {
        $data = [
            'title' => 'List Student Charge',
            'user' => $this->session->userdata('id'),
            'script' => 'fin_charges',

            'table' => $this->Mdl_std_charge->get_charge_overview()
        ];

        $this->load->view('finance/v_student_charge', $data);
    }

    public function view_add_std_charge()
    {
        $iteration = date('Y') . '-' . date('m');
        $docno_iteration = $this->db->select('DocNo')->get_where('tbl_12_fin_std_charge_mas', "DocNo LIKE '$iteration%'")->num_rows();

        $data = [
            //MASTER
            'title' => 'List Student Charge',
            'user' => $this->session->userdata('id'),
            'script' => 'fin_new_charge',

            //PARAMETER
            'docno' => $iteration . str_pad($docno_iteration+1, 2, 0, STR_PAD_LEFT),
            'accno' => $this->Mdl_std_charge->get_mas_acc(),
            'chargetype' => $this->Mdl_std_charge->get_mas_acc_charge_type(),
            'school' => $this->Mdl_std_charge->get_school(),
            'cls' => $this->Mdl_std_charge->get_cls(''),
            'room' => $this->Mdl_std_charge->get_room('')
        ];

        $this->load->view('finance/v_add_std_charge', $data);
    }

    public function ajax_get_cls_list(){
        $sch = $_POST['sch'];

        $cls = $this->Mdl_std_charge->get_cls($sch);
        $std = $this->Mdl_std_charge->get_std($sch, '', '');

        $result = [
            'cls' => $cls,
            'std' => $std
        ];

        echo json_encode($result);
    }
    
    public function ajax_get_room_list(){
        $sch = $_POST['sch'];
        $cls = $_POST['cls'];

        $room = $this->Mdl_std_charge->get_room($cls);
        $std = $this->Mdl_std_charge->get_std($sch, $cls, '');

        $result = [
            'room' => $room,
            'std' => $std
        ];

        echo json_encode($result);
    }

    public function ajax_get_std_list(){
        $sch = $_POST['sch'];
        $cls = $_POST['cls'];
        $room = $_POST['room'];

        $result = $this->Mdl_std_charge->get_std($sch, $cls, $room);

        echo json_encode($result);
    }

    public function ajax_get_charge_type_matrix(){
        $charge = $_POST['charge'];
        $std = $_POST['std'];

        $result = $this->Mdl_std_charge->get_charge_type_matrix($charge, $std);

        echo json_encode($result);
    }

    public function ajax_submit_std_charge(){
        $master = [
            'DocNo' => $_GET['docno'],
            'YearCharge' => $_GET['year'],
            'MonthChargeStart' => $_GET['monthstart'],
            'MonthChargeFinish' => $_GET['monthfinish'],
            'SubmitBy' => $_GET['submitby'],
            'TransDate' => $_GET['transdate'],
            'AccGroupMas' => $_GET['accno'],
            'AccGroupReg' => $_GET['chargetype'],
            'Remarks' => $_GET['remarks'],
            'SchoolType' => $_GET['school'],
            'Class' => $_GET['cls'],
            'Room' => $_GET['room']
        ];

        $details = $trans = [];

        $nis = $_POST['nis'];
        $debit = 0;
        $credit = $_POST['amount'];
        $cur_nis = '';
        $last_balance = 0;

        for($i = 0; $i < count($nis); $i++){
            //GET CURRENT RECORD IF EXIST
            $cur_record = $this->db->get_where('tbl_12_fin_std_charge_det', [
                'YearCharge' => $_GET['year'],
                'MonthCharge' => $_POST['month'][$i],
                'NIS' => $nis[$i],
                'AccGroupReg' => $_GET['chargetype']
            ])->num_rows();

            //IF CURRENT RECORD EXISTED, JUMP TO NEXT LOOP
            if($cur_record > 0){
                continue;
            }

            array_push($details, [
                'DocNo' => $_GET['docno'],
                'TransDate' => $_GET['transdate'],
                'YearCharge' => $_GET['year'],
                'MonthCharge' => $_POST['month'][$i],
                'NIS' => $nis[$i],
                'FullName' => $_POST['fullname'][$i],
                'Room' => $_POST['room'][$i],
                'AccGroupReg' => $_GET['chargetype'],
                'Amount' => $credit[$i]
            ]);

            if($cur_nis !== $nis[$i]){
                $cur_nis = $nis[$i];
                
                $last_balance = $this->Mdl_std_charge->get_std_last_balance($cur_nis);

                $balance = ($last_balance + $credit[$i]) -  $debit;
            }else{
                $balance = ($balance + $credit[$i]) -  $debit;

                //SET CURRENT LOOP BALANCE AS LAST_BALANCE FOR NEXT LOOP
                $last_balance = $balance;
            }

            array_push($trans, [
                'DocNo' => $_GET['docno'],
                'TransDate' => $_GET['transdate'],
                'Month' => $_POST['month'][$i],
                'Year' => $_GET['year'],
                'TransType' => 'SCHARGE',
                'Branch' => $_GET['school'],
                'Department' => $_GET['cls'],
                'AccNo' => $_GET['chargetype'],
                'AccType' => $this->db->select('Acc_Type')->get_where('tbl_12_fin_account_no', ['Acc_No' => $_GET['chargetype']])->row()->Acc_Type,
                'IDNumber' => $nis[$i],
                'Amount' => $_POST['amount'][$i],
                'Debit' => 0,
                'Credit' => $credit[$i],
                'Balance' => $balance,
                'BalanceBranch' => 0,
                'Remarks' => $_GET['remarks'],
                'EntryBy' => $_GET['submitby'],
                'EntryDate' => date('Y-m-d h:m:s')
            ]);
        }

        if($master && $details && $trans){
            $result = $this->Mdl_std_charge->submit_std_charge($master, $details, $trans);
        }else{
            $result = 'DATA_DUPLICATE';
        }

        echo $result;
    }


    //TRANSACTION - RECEIPT VOUCHER
    public function view_receipt_voucher()
    {
        $data = [
            'title' => 'List Receipt Voucher',
            'script' => 'fin_receipt',

            'receive_docno' => $this->Mdl_std_receipt->get_new_receive_docno(),
            'table' => $this->Mdl_std_receipt->get_receipt_overview()
        ];

        $this->load->view('finance/v_receipt_voucher', $data);
    }

    public function view_add_rec_voucher()
    {   
        $data = [
            'title' => 'Form Receipt Voucher',
            'script' => 'fin_new_receipt',

            'accno' => $this->Mdl_std_charge->get_mas_acc_charge_type(),
            'currency' => $this->Mdl_std_receipt->get_currency()
        ];

        $this->load->view('finance/v_add_rec_voucher', $data);
    }

    public function ajax_get_cur_balance(){
        $nis = $_POST['nis'];

        $result = $this->Mdl_std_receipt->get_std_last_balance($nis);

        echo $result;
    }

    public function ajax_get_group_charge(){
        $nis = $_POST['nis'];
        $accno = $_POST['accno'];

        $result = $this->Mdl_std_receipt->get_group_charge($nis, $accno);

        echo json_encode($result);
    }

    public function ajax_submit_receipt(){
        $nis = $_POST['nis'];
        $balance = $credit = 0;

        $last_balance = $this->Mdl_std_charge->get_std_last_balance($nis);

        $detail = [];

        for($i = 0; $i < count($_POST['month']); $i++){
            
            $debit = $_POST['amount'][$i];
            
            $balance = ($last_balance + $credit) -  $debit;

            array_push($detail, [
                    //MASTER
                    'DocNo' => $_POST['docno'],
                    'TransDate' => $_POST['transdate'],
                    'IDNumber' => $_POST['nis'],
                    'AccNo' => $_POST['accno'],
                    'Branch' => $_POST['school'],

                    //DETAILS
                    'Remarks' => $_POST['remark_detail'][$i],
                    'Month' => (isset($_POST['month']) ? $_POST['month'][$i] : '-'),
                    'Year' => (isset($_POST['year']) ? $_POST['year'][$i] : '-'),
                    'TransType' => 'SRECEIPT',
                    'is_completed' => 1,
                    'Department' => $this->db->select('Kelas')->get_where('tbl_08_job_info_std', ['NIS' => $_POST['nis']])->row()->Kelas,
                    'AccType' => $this->db->select('Acc_Type')->get_where('tbl_12_fin_account_no', ['Acc_No' => $_POST['accno']])->row()->Acc_Type,
                    'Currency' => $_POST['currency'][$i],
                    'Amount' => $_POST['amount'][$i],
                    'Debit' => $_POST['amount'][$i],
                    'Credit' => 0,
                    'Balance' => $balance,
                    'BalanceBranch' => 0,
                    'EntryBy' => $this->session->userdata('id'),
                    // '' => $_POST['totalamount'],
                    // '' => $_POST['remarks']
            ]);

            $last_balance = $balance;
        }

        $result = $this->Mdl_std_receipt->submit_receipt($detail);

        echo $result;
    }

    //TRANSACTION - AGED DUE CONTROL
    public function view_ar_aging_control()
    {
        $data['title'] = 'Aged Due Control';

        $this->load->view('finance/v_ar_aging_control', $data);
    }

    //MASTER - STUDENT MATRIX
    public function view_student_matrix()
    {
        $data['title'] = 'List Student Matrix';

        $this->load->view('finance/v_student_matrix', $data);
    }

    function posted_edit_delete_mast_matrix()
    {   
        $query['title'] = 'Matrix Master';
        $now = date('ym');
        $user = $this->session->userdata('id');
        $sesdocno = $this->session->userdata('sdoc_no');
        $ldocn = $this->Mdl_matrix->get_last_docn();
        $cdate = substr($ldocn, 0, -6);
        
        if ($cdate == $now) {
            $last = substr($ldocn, 5);
            $cur = $last + 1;
            $ddcn = $now . '-' . str_pad($cur, 5, '0', STR_PAD_LEFT);
        } else {
            $ddcn = $now . '-00001';
        }
        
        $query = [
            'title' => 'Add Matrix',
            'docno' => $ddcn,
            'bankdatajgrp' => $this->Mdl_matrix->getalljgrp(),
            'branch' => $this->Mdl_matrix->getallbranch()
        ];
        
        $temp = array(
            'IDtemp'   => $ddcn,
            'IDNumber' => $user,
            'TransType' => 'JP',
        );
        
        $this->Mdl_matrix->insert('tbl_fa_trans_temp', $temp);
        $this->session->set_userdata('sdoc_no', $ddcn);
        $this->load->view('finance/v_add_matrix', $query);

    }

    function load_last_tday_matris_student()
    {
        $value = '';

        $data_matriks = $this->Mdl_matrix->get_tday_mat_std();
        $data_matriks = $this->Mdl_matrix->get_last_tday_mat_std();
        if ($data_matriks != false) {
            foreach ($data_matriks as $accno_head) {
            $count_docno = $this->Mdl_matrix->get_last_tday_matrix_student($accno_head->accno_type);
            $last = $count_docno['count'];
            $value .= '<div class="table-responsive">';
            $value .= '<table class="table table-hover">';
            $value .= '<thead>';
            $value .= '<th width="10%" class="text-left"><b> '.$accno_head->Type_pay.'</b> </th>';
            $value .= '<th width="10%" class="text-left"><b>Total Matrix Set&emsp;:&emsp;</b> ' . $count_docno['count'] . ' </th>';
            $value .= '</thead>';
            $value .= '</table>';
            $value .= '</div>';
            $value .= '<div class="table-responsive">';
            $value .= '<table class="table table-striped table-bordered table-hover" id="table_not_post_journal">';
            $value .= '<thead>';
            $value .= '<tr>';
            $value .= '<th width="3%"> No </th>';
            $value .= '<th width="3%" class="text-center"> Doc No. </th>';
            $value .= '<th width="4%" class="text-left"> Paid To </th>';
            $value .= '<th width="7%" class="text-center"> Trans. Date </th>';
            $value .= '<th width="10%"> Amount </th>';
            $value .= '<th width="8%"> Type Pay </th>';
            $value .= '<th width="10%" class="text-right"> Account No of Type </th>';
            $value .= '<th width="4%" class="text-center"> Action </th>';
            $value .= '</tr>';
            $value .= '</thead>';
            $value .= '<tbody>';
            $data_matriks_det = $this->Mdl_matrix->get_last_tday_mat_std_det($accno_head->accno_type);
                $no = 1;
                foreach ($data_matriks_det as $data_std) {  
                        $value .= '<tr>';
                        $value .= '<td> ' . $no . ' </td>';
                        $value .= '<td> ' . $data_std->DocNo . ' </td>';
                        $value .= '<td align="center"> ' . $data_std->PaidTo . ' </td>';
                        $value .= '<td align="left"> ' . $data_std->TransDate . ' </td>';
                        $value .= '<td align="center"> ' . $data_std->Amount . ' </td>';
                        $value .= '<td> ' . $data_std->Type_pay . ' </td>';
                        $value .= '<td> ' . $data_std->accno_type . ' </td>';
                        if( $data_std->itemno == $last){
                        $value .= '<td align="center">';
                        $value .= '<a class="btn btn-transparent yellow btn-outline btn-circle btn-sm" id="edit_acc_no_mat" doc_no_mat="' . $data_std->DocNo . '" item_no_mat="' . $data_std->itemno . '" accno_type_mat="' . $data_std->accno_type . '" amount_type_mat="' . $data_std->Amount . '"  amount_type_mat_for="' . number_format($data_std->Amount, 2, ",", ".") . '" nis_mat_for="' . $data_std->PaidTo . '">';
                        $value .= '<i class="fa fa-edit"></i> Edit ';
                        $value .= '</a>';
                        $value .= '</td>';
                        }else{
                        $value .= '<td>  </td>';
                        }
                        $value .= '</tr>';
                    $no++;
                }
            $value .= '</tbody>';
            $value .= '</table>';
            $value .= '</div>';
            }
           
         
        } else {
            $value .= '<div class="table-responsive">';
            $value .= '<table class="table table-hover">';
            $value .= '<thead>';
            $value .= '<th width="10%" class="text-left"><b>Total Student Set&emsp;:&emsp;</b> 0 </th>';
            $value .= '</thead>';
            $value .= '</table>';
            $value .= '</div>';
            $value .= '<div class="text-center">';
            $value .= '<h3>No Transaction<h3>';
            $value .= '</div>';
        }
        echo json_encode($value);
    }

    function add_new_matrix_student(){
        $hari_ini = date("Y-m-d"); 
        $docno = $this->input->post('m_docno');
        $accno_type = $this->input->post('m_accno_type');
        $nis = $this->input->post('m_emp');
        $amount = $this->input->post('m_amount');
        $acname = $this->Mdl_matrix->get_accname_by_accno($accno_type);
        $item  =  $this->Mdl_matrix->get_itemno_pay_std($nis,$accno_type);
        if($item == false){
            $i = 1;
        }
        if($item != false){
            $i =  $item->itemno + 1;
        }
        $data_matrix_std=array(
            'DocNo' =>$docno,
            'PaidTo' =>$nis,
            'Amount' =>$amount,
            'accno_type' =>$accno_type,
            'TransDate' =>$hari_ini,
            'Type_pay' => $acname,
            'itemno' => $i,
            );
        $in = $this->Mdl_matrix->insert('tbl_fa_cash_app_std',$data_matrix_std);
        
        if($in != false){
            echo json_encode(array('rstatus' => true, 'issueno' => 'Success'));
        }else{
            echo json_encode(array('rstatus' => false, 'issueno' => 'Failed'));

        }

    }

    function get_list_account_student()
    {
        $cstatus = $this->input->post('cstatus');
        $value = '';
        $pay='70000';

        $listaccno = $this->m_pay->get_list_account_no_eq_rec();
        if ($cstatus == 0) {
            foreach ($listaccno as $row) {
                $value .= '<tr id="d_accno_std" account_no="' . $row->Acc_No . '" account_desc="' . $row->Acc_Name . '" account_mon="' . $pay . '">';
                $value .= '<td title="click to select" style="cursor: pointer;" width="20%" align="center">' . $row->Acc_No . '</td>';
                $value .= '<td title="click to select" style="cursor: pointer;">' . $row->Acc_Name . '</td>';
                $value .= '<td title="click to select" style="cursor: pointer;">' . $row->AccType . '</td>';
                $value .= '<td title="click to select" style="cursor: pointer;" hidden>' . $pay . '</td>';
                $value .= '</tr>';
            }
        } else if ($cstatus == 1) {
            $no = $this->input->post('iteration');
            foreach ($listaccno as $row) {
                $value .= '<tr id="d_accno_std' . $no . '" account_no="' . $row->Acc_No . '" account_desc="' . $row->Acc_Name . '">';
                $value .= '<td title="click to select" style="cursor: pointer;" width="20%" align="center">' . $row->Acc_No . '</td>';
                $value .= '<td title="click to select" style="cursor: pointer;">' . $row->Acc_Name . '</td>';
                $value .= '<td title="click to select" style="cursor: pointer;">' . $row->AccType . '</td>';
                $value .= '<td title="click to select" style="cursor: pointer;" hidden>' . $pay . '</td>';
                $value .= '</tr>';
            }
        }

        $value = [
            'pay' => $pay,
            'row' => $value
        ];

        echo json_encode($value);
    }

    function get_list_emp_nis()
    {
        $cstatus = $this->input->post('cstatus');
        $value = '';

        $listofferer = $this->Mdl_matrix->get_list_nis();
        if ($cstatus == 0) {
            foreach ($listofferer as $row) {
                $value .= '<tr id="d_emp" account_no="' . $row->NIS . '" account_desc="' . $row->AddtionalName . '">';
                $value .= '<td title="click to select" style="cursor: pointer;" width="20%">' . $row->NIS . '</td>';
                $value .= '<td title="click to select" style="cursor: pointer;">' . $row->AddtionalName . '</td>';
                $value .= '</tr>';
            }
        } else if ($cstatus == 1) {
            $no = $this->input->post('iteration');
            foreach ($listofferer as $row) {
                $value .= '<tr id="d_emp_' . $no . '" account_no="' . $row->NIS . '" account_desc="' . $row->AddtionalName . '">';
                $value .= '<td title="click to select" style="cursor: pointer;" width="20%">' . $row->NIS . '</td>';
                $value .= '<td title="click to select" style="cursor: pointer;">' . $row->AddtionalName . '</td>';
                $value .= '</tr>';
            }
        }

        echo json_encode($value);
    }
}


  