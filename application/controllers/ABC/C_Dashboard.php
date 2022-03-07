<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'ABC/SalesOrder_Model' => 'so',
            'ABC/PurchaseOrder_Model' => 'po',
            'ABC/BackOrder_Model' => 'bo',
            'IPH/MaterialRequest_Model' => 'mr',
        ]);
        auth_admin();
    }

    public function index()
    {
        $title = 'ABC Management';
        $script = '<script src="' . base_url('js/abc/dashboard/dashboard.js') . '" type="module"></script>';

        $so_data = $this->so->M_get_sales_order([
            // 'master.Disc' => '0',
            'PaymentType' => 'SO',
            'master.BranchCode' => $this->session->userdata('branch'),
            'POStatus' => 'Order'
        ])->num_rows();

        $data_view = [
            'title' => 'Dashboard',
            'so' => $so_data
        ];
        $content = $this->load->view('abc/content/dashboard', $data_view, true);

        $data = [
            'title' => $title,
            'content' => $content,
            'script' => $script,
        ];
        $this->load->view('abc/layout/main', $data);
    }

    public function get_approval()
    {
        $data = [];

        // * Sales
        // * Sales Order
        $so = $this->so->M_get_sales_order([
            // 'master.Disc' => '0',
            'PaymentType' => 'SO',
            'master.BranchCode' => $this->session->userdata('branch'),
            'ApprovedStatus' => 'NotApproved',
            'POStatus <>' => 'Canceled'
        ])->result_array();

        foreach ($so as $row => $value) {
            array_push($data, [
                'Type' => 'SO',
                'TypeDescription' => 'Sales Order',
                'ID' => $value['CtrlNo'],
                'DocNo' => $value['DocNo'],
                'RaisedBy' => $value['RaisedBy'],
                'Amount' => $value['Amount']
            ]);
        }

        // * Purchase
        // * Purchase Order
        $po = $this->po->M_get_purchase_order([
            // 'Disc' => '0',
            'PaymentType' => 'PO',
            'master.BranchCode' => $this->session->userdata('branch'),
            'ApprovedStatus' => 'NotApproved',
            'POStatus <>' => 'Canceled'
        ])->result_array();

        foreach ($po as $row => $value) {
            array_push($data, [
                'Type' => 'PO',
                'TypeDescription' => 'Purchase Order',
                'ID' => $value['CtrlNo'],
                'DocNo' => $value['DocNo'],
                'RaisedBy' => $value['RaisedBy'],
                'Amount' => $value['Amount']
            ]);
        }

        // * Back Order
        $bo = $this->bo->M_get_back_order_master([
            'master.BranchCode' => $this->session->userdata('branch'),
            'master.ApprovedBy' => NULL
        ])->result_array();

        foreach ($bo as $row => $value) {
            array_push($data, [
                'Type' => 'BO',
                'TypeDescription' => 'Back Order',
                'ID' => $value['CtrlNo'],
                'DocNo' => $value['DocNo'],
                'RaisedBy' => $value['RegName'],
                'Amount' => 0
            ]);
        }

        // * Material Request
        $mr = $this->mr->M_get_material_request([
            'StatusRemarks' => 'Process',
            'TransStatus' => 'Raised',
            'storage.BranchCode' => $this->session->userdata('branch')
        ])->result_array();

        foreach ($mr as $row => $value) {
            array_push($data, [
                'Type' => 'MR',
                'TypeDescription' => 'Material Request',
                'ID' => $value['ID'],
                'DocNo' => $value['DocNo'],
                'RaisedBy' => $value['RaisedBy'],
                'Amount' => $value['Amount']
            ]);
        }

        echo json_encode($data);
    }
}
