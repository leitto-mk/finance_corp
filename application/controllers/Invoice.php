<?php defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class Invoice extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_corp_invoice');
	}

	public function index()
	{
		$title = 'Invoice Module';

		$data_view = [
			'title' => 'Dashboard'
		];

		$content = $this->load->view('financecorp/invoice/content/dashboard', $data_view, true);

		$data = [
			'title' => $title,
			'content' => $content,
			'script' => 'invoice',
		];

		$this->load->view('financecorp/invoice/layout/main', $data);
	}

	public function create_invoice()
	{
		$content_data = [
			'title' => 'Create Invoice',
		];

		$content = $this->load->view('financecorp/invoice/content/new_invoice', $content_data, TRUE);

		$data = [
			'form' => $content,
			'script' => 'invoice'
		];

		$this->load->view('financecorp/invoice/layout/header_footer_form', $data);
	}

	public function get_approval()
	{
		$data = $this->Mdl_corp_invoice->get_approval();

		echo json_encode($data);
	}

	public function view_invoice_list(){

		$title = 'Invoice Module';
		$data_view = [
			'title' => 'List Invoice'
		];
		$content = $this->load->view('financecorp/invoice/content/v_invoice_list', $data_view, true);

		$data = [
			'title' => $title,
			'content' => $content,
			
		];
		$this->load->view('financecorp/invoice/layout/main', $data);
	}

	public function view_invoice_aging(){
        $data = [
            'title' => 'Invoice Aging',
            'h1' => 'Invoice',
            'h2' => 'Aging',
            'h3' => '',
            'h4' => ''
        ];
        
        $this->load->view('financecorp/invoice/content/v_invoice_aging', $data);
    }
}
