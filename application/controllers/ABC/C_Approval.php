<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_Approval extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model([
      'ABC/Approval_Model' => 'approval',
      'IPH/MaterialRequest_Model' => 'mr'
    ]);
  }

  public function index()
  {
  }

  public function dashboard_approval()
  {
    $id = $this->input->post('id', true);
    $type = $this->input->post('type', true);

    if ($id) {
      $approved_by = $this->session->userdata('uid');
      $approve_date = Date('Y-m-d H:i:s');
      $data_update_so = [];
      $data_update_bo = [];
      $data_update_mr = [];
      $data_update_stockreg = [];
      $mr_id = [];

      foreach ($id as $row => $value) {
        switch ($type[$row]) {
          case 'SO':
            array_push($data_update_so, [
              'CtrlNo' => $value,
              'ApprovedStatus' => 'Approved',
              'POStatus' => 'OnProcess',
              'ApprovedBy' => $approved_by,
              'ApprovedDate' => $approve_date
            ]);
            break;

          case 'PO':
            array_push($data_update_so, [
              'CtrlNo' => $value,
              'ApprovedStatus' => 'Approved',
              'ApprovedBy' => $approved_by,
              'ApprovedDate' => $approve_date
            ]);
            break;

          case 'BO':
            array_push($data_update_bo, [
              'CtrlNo' => $value,
              'Status' => 'Process',
              'ApprovedBy' => $approved_by,
              'ApprovedDate' => Date('Y-m-d')
            ]);
            break;

          case 'MR':
            array_push($data_update_mr, [
              'CtrlNo' => $value,
              'ApprovedBy' => $approved_by,
              'ApprovedDate' => Date('Y-m-d'),
              'TransStatus' => 'Approved'
            ]);
            array_push($mr_id, $value);
            break;

          default:
            break;
        }
      }

      $detail_mr = $this->mr->M_get_material_request_detail([
        'TransStatus' => 'Raised'
      ], $id)->result_array();

      foreach ($detail_mr as $mr_row => $mr_value) {
        if (array_key_exists($mr_value['Stockcode'], $data_update_stockreg)) {
          $data_update_stockreg[$mr_value['Stockcode']]['SAV'] -= $mr_value['QtyRequest'];
          $data_update_stockreg[$mr_value['Stockcode']]['SOR'] += $mr_value['QtyRequest'];
          $data_update_stockreg[$mr_value['Stockcode']]['CombineStock'] -= $mr_value['QtyRequest'];
        } else {
          $data_update_stockreg[$mr_value['Stockcode']] = [
            'CtrlNo' => $mr_value['StockregID'],
            'SOH' => $mr_value['SOH'],
            'SAV' => $mr_value['SAV'] - $mr_value['QtyRequest'],
            'SOR' => $mr_value['SOR'] + $mr_value['QtyRequest'],
            'SOO' => $mr_value['SOO'],
            'CombineStock' => $mr_value['CombineStock'] - $mr_value['QtyRequest']
          ];
        }
      }

      $data = [
        'data_so' => $data_update_so,
        'data_bo' => $data_update_bo,
        'data_mr' => $data_update_mr,
        'data_stockreg' => $data_update_stockreg
      ];

      $query_update = $this->approval->M_dashboard_approval($data);

      if ($query_update = 'success') {
        $result = [
          'success' => true,
          'status' => $query_update,
          'message' => 'Request Approved!'
        ];
      } else {
        $result = [
          'error' => true,
          'message' => 'Something went wrong!'
        ];
      }

      echo json_encode($result);
    }
  }

  public function dashboard_cancelation()
  {
    $id = $this->input->post('id', true);
    $type = $this->input->post('type', true);

    if ($id) {
      $approve_date = Date('Y-m-d H:i:s');
      $data_update_so = [];
      $data_update_bo = [];

      foreach ($id as $row => $value) {
        switch ($type[$row]) {
          case 'SO':
            array_push($data_update_so, [
              'CtrlNo' => $value,
              'POStatus' => 'Canceled',
              'ApprovedBy' => $this->session->userdata('uid'),
              'ApprovedDate' => $approve_date
            ]);
            break;

          case 'PO':
            array_push($data_update_so, [
              'CtrlNo' => $value,
              'ApprovedStatus' => 'Canceled',
              'ApprovedBy' => $this->session->userdata('uid'),
              'ApprovedDate' => $approve_date
            ]);
            break;

          case 'BO':
            array_push($data_update_bo, [
              'CtrlNo' => $value,
              'Status' => 'Cancelled',
              'ApprovedBy' => $this->session->userdata('uid'),
              'ApprovedDate' => Date('Y-m-d')
            ]);
            break;

          default:
            break;
        }
      }

      $data = [
        'data_so' => $data_update_so,
        'data_bo' => $data_update_bo
      ];

      $query_update = $this->approval->M_dashboard_approval($data);

      if ($query_update = 'success') {
        $result = [
          'success' => true,
          'status' => $query_update,
          'message' => 'Request Cancelled!'
        ];
      } else {
        $result = [
          'error' => true,
          'message' => 'Something went wrong!'
        ];
      }

      echo json_encode($result);
    }
  }

  public function bo_approval()
  {
  }
}
