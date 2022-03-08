<?php defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model([
      'Mdl_corp_invoice' => 'invoice'
    ]);
  }

  public function index()
  {
    $title = 'Invoice Module';
    $script = '<script src="' . base_url('js/invoice/dashboard/dashboard.js') . '" type="module"></script>';

    $data_view = [
      'title' => 'Dashboard'
    ];
    $content = $this->load->view('financecorp/invoice/content/dashboard', $data_view, true);

    $data = [
      'title' => $title,
      'content' => $content,
      'script' => $script,
    ];
    $this->load->view('financecorp/invoice/layout/main', $data);
  }

  public function view_create_invoice()
  {
    $title = 'Create Invoice';
    $script = '';

    $data_view = [
      'title' => 'Create New Invoice'
    ];
    $content = $this->load->view('financecorp/invoice/content/create_invoice', $data_view, true);

    $data = [
      'title' => $title,
      'content' => $content,
      'script' => $script,
      'no_sidebar' => true
    ];
    $this->load->view('financecorp/invoice/layout/main', $data);
  }

  public function get_approval()
  {
    $data = $this->invoice->M_get_invoice_approval();

    echo json_encode($data);
  }
}
