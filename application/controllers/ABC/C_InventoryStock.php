<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_InventoryStock extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ABC/InventoryStock_Model', 'is');
    auth_admin();
  }

  public function index()
  {
    $title = 'Inventory Stock';
    $script = '<script src="' . base_url('js/abc/inventory_stock/view_inventory_stock.js') . '" type="text/javascript"></script>';
    $data_view = [
      'title' => 'Inventory Stock',
    ];
    $content = $this->load->view('abc/content/inventory_stock', $data_view, true);

    $data = [
      'title' => $title,
      'content' => $content,
      'script' => $script
    ];
    $this->load->view('abc/layout/main', $data);
  }

  public function get_stock()
  {
    $data = $this->is->M_get_stock([
      'BranchCode' => $this->session->userdata('branch'),
      'stockreg.Disc' => '0'
    ])->result_array();

    echo json_encode($data);
  }

  public function get_stock_detail()
  {
    $id = $this->input->get('id', true);

    $stockcode = $this->is->M_get_stock([
      'stockreg.CtrlNo' => $id
    ])->row_array();

    $master = $this->is->M_get_stock_detail([
      'stockcode.Stockcode' => $stockcode['Stockcode']
    ])->row_array();

    $storage = $this->is->M_get_stockreg([
      'stockreg.Stockcode' => $stockcode['Stockcode'],
      'stockreg.BranchCode' => $this->session->userdata('branch')
    ])->result_array();

    $history = $this->is->M_get_history([
      'Stockcode' => $master['Stockcode'],
      'Storage' => array_column($storage, 'Storage')
    ]);

    $data_view = [
      'master' => $master,
      'storage' => $storage,
      'history' => $history
    ];

    $this->load->view('abc/component/modal_stock_detail', $data_view);
  }
}
