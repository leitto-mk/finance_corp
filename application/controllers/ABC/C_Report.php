<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_Report extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf_report');
		$this->load->model('ABC/Report_Model', 'report');
		auth_admin();
	}

	public function index()
	{
	}

	public function view_sales_le_report()
	{
		$script = '<script src="' . base_url('js/abc/report/le_monthly.js') . '" type="module"></script>';
		$data = [
			'title' => 'HHES LE Sales Report',
			'content' => $this->load->view('abc/report/le_sales_report', null, true),
			'script' => $script
		];
		$this->load->view('abc/layout/main', $data);
	}

	public function get_assistance()
	{
		$branch = $this->session->userdata('branch');
		$data = $this->report->M_get_assistance([
			'Branch' => $branch,
			'JobTitle' => '10029'
		])->result_array();

		echo json_encode($data);
	}

	public function get_employee()
	{
		$branch = $this->session->userdata('branch');
		$data = $this->report->M_get_assistance([
			'Branch' => $branch,
			'JobTitle' => '10030'
		])->result_array();

		echo json_encode($data);
	}

	public function get_hr_data()
	{
		$assistance = $this->input->get('assistance', true);
		$data = $this->report->M_get_hr_data([
			'hr.Supervisor' => $assistance,
		])->result_array();

		echo json_encode($data);
	}

	public function get_le_sales()
	{
		$branch = $this->session->userdata('branch');
		$date_start = $this->input->get('date_start');
		$date_end = $this->input->get('date_end');
		$employee = $this->input->get('employee');
		// $data = $this->report->M_get_hr_data([
		//   'Branch' => $branch,
		//   'JobTitle' => '10030',
		// ], $branch)->result_array();
		$data = $this->report->M_get_le_sales_data($employee, $branch, $date_start, $date_end);

		echo json_encode($data);
	}

	public function get_le_sales_detail()
	{
		$branch = $this->session->userdata('branch');
		$date_start = $this->input->get('date_start');
		$date_end = $this->input->get('date_end');
		$employee = $this->input->get('employee');
		$data = $this->report->M_get_le_sales_detail_data($employee, $branch, $date_start, $date_end);

		echo json_encode($data);
	}

	public function view_stockcard_report()
	{

		$data = [
			'title' => 'Stockcard Report',
			'content' => $this->load->view('abc/report/stockcard_report', null, true),
			'script' => '<script src="' . base_url('js/abc/report/stockcard.js') . '" type="module"></script>'
		];
		$this->load->view('abc/layout/main', $data);
	}

	public function get_stockcard()
	{
		$branch_data = $this->session->userdata('branch');
		$data = $this->report->M_get_stockcard_report([
			// 'storage.BranchCode' => $branch_data,
			'stockcode.Row' => 'No'
		], $branch_data)->result_array();

		echo json_encode($data);
	}

	public function view_detail_sales_le_report()
	{
		$script = '<script src="' . base_url('js/abc/report/le_detail.js') . '" type="module"></script>';
		$data = [
			'title' => 'HHES LE Sales Report Detail',
			'content' => $this->load->view('abc/report/le_sales_report_detail', null, true),
			'script' => $script
		];
		$this->load->view('abc/layout/main', $data);
	}

	public function view_invoice_sales($id)
	{
		$head = '<!doctype html><html lang="en"><head></head><body>';
		$foot = '</body></html>';

		// * Data for view
		$branch_session = $this->session->userdata('branch');
		$branch_data = $this->report->M_get_branch_data([
			'storage.BranchCode' => $branch_session
		])->row_array();

		$sales_master_data = $this->report->M_get_sales_data([
			'ctrl_no' => $id
		])->row_array();

		$sales_detail_data = $this->report->M_get_sales_detail_data([
			'sale_doc_no' => $sales_master_data['DocNo']
		])->result_array();
		// * End Data for view

		$data_content = [
			'detail' => $sales_detail_data,
			'master' => $sales_master_data
		];

		$content = $this->load->view('abc/pdf/component/direct_sales', ['data' => $data_content], true);
		$html = $head . $this->load->view('abc/pdf/invoice_direct_sales', [
			'content' => $content,
			'master_sales' => $sales_master_data
		], true) . $foot;

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetTitle('Invoice Direct Sales');
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->AddPage('P', 'A4');
		$pdf->setCellPaddings($left = '2', $top = '2', $right = '2', $bottom = '2');
		$pdf->SetFontSize('8');
		$pdf->writeHTMLCell(0, 0, '', '', '<h1>' . $branch_data['StorageName'] . '</h1>', 0, 1, 0, true, 'C', false);
		$pdf->writeHTMLCell(0, 0, '', '', '<h3>' . $branch_data['Address'] . '</h3>', 0, 1, 0, true, 'C', false);
		$pdf->writeHTMLCell(0, 0, '', '', '<h2  style="font-weight: 0;">Kwitansi Resmi Pembelian</h2>', 0, 1, 0, true, 'C', false);
		$pdf->writeHTMLCell(0, 0, '', '', '', 0, 1, 0, true, 'C', false);
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('direct_sales' . date('dmy') . '.pdf', 'I');
	}
}
