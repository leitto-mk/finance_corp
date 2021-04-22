<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class Finance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('finance/Mdl_std_charge');

        if ($this->session->userdata('status') != 'admin') {
            redirect('Fin_Login/index');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $this->load->view('finance/v_home_n', $data);
    }

    public function view_student_charge()
    {
        $data = [
            'title' => 'List Student Charge',
            'user' => $this->session->userdata('id'),

            'table' => $this->Mdl_std_charge->get_charge_overview()
        ];

        $this->load->view('finance/v_student_charge', $data);
    }

    public function view_receipt_voucher()
    {
        $data['title'] = 'List Receipt Voucher';

        $this->load->view('finance/v_receipt_voucher', $data);
    }

    public function view_ar_aging_control()
    {
        $data['title'] = 'Aged Due Control';

        $this->load->view('finance/v_ar_aging_control', $data);
    }

    public function view_student_matrix()
    {
        $data['title'] = 'List Student Matrix';

        $this->load->view('finance/v_student_matrix', $data);
    }

    //STUDENT CHARGE APPEND
    public function view_add_std_charge()
    {
        $iteration = date('Y') . '-' . date('m');
        $docno_iteration = $this->db->select('DocNo')->get_where('tbl_12_fin_std_charge_mas', "DocNo LIKE '$iteration%'")->num_rows();

        $data = [
            //MASTER
            'title' => 'List Student Charge',
            'user' => $this->session->userdata('id'),

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

        $result = $this->Mdl_std_charge->get_charge_type_matrix($charge);

        echo $result;
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

        $details = [];
        for($i = 0; $i < count($_POST['nis']); $i++){
            array_push($details, [
                'DocNo' => $_GET['docno'],
                'TransDate' => $_GET['transdate'],
                'YearCharge' => $_GET['year'],
                'MonthCharge' => $_POST['month'][$i],
                'NIS' => $_POST['nis'][$i],
                'FullName' => $_POST['fullname'][$i],
                'Room' => $_POST['room'][$i],
                'AccGroupReg' => $_GET['chargetype'],
                'Amount' => $_POST['amount'][$i]
            ]);
        }

        $result = $this->Mdl_std_charge->submit_std_charge($master, $details);

        echo $result;
    }
}


  