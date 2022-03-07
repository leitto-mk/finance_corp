<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_PurchaseOrder extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ABC/PurchaseOrder_Model', 'po');
		$this->load->model('ABC/SalesOrder_Model', 'so');
		$this->load->model('ABC/DirectSales_Model', 'ds');
		auth_admin();
	}

	public function index()
	{
		$where_condition = [
			// 'Disc' => '0',
			'PaymentType' => 'PO',
			'master.BranchCode' => $this->session->userdata('branch'),
		];

		$where_condition['POStatus'] = 'Order';
		$order = $this->po->M_get_purchase_order($where_condition)->num_rows();

		$where_condition['POStatus'] = 'OnProcess';
		$process = $this->po->M_get_purchase_order($where_condition)->num_rows();

		$where_condition['POStatus'] = 'Completed';
		$completed = $this->po->M_get_purchase_order($where_condition)->num_rows();

		$where_condition['POStatus'] = 'Canceled';
		$cancelled = $this->po->M_get_purchase_order($where_condition)->num_rows();

		$title = 'Purchase Order';
		$script = '<script src="' . base_url('js/abc/purchase_order/view_purchase_order.js') . '" type="text/javascript"></script>';
		$data_view = [
			'title' => 'Purchase Order',
			'order' => $order,
			'process' => $process,
			'completed' => $completed,
			'cancelled' => $cancelled
		];
		$content = $this->load->view('abc/content/purchase_order', $data_view, true);

		$data = [
			'title' => $title,
			'content' => $content,
			'script' => $script
		];
		$this->load->view('abc/layout/main', $data);
	}

	public function get_doc_no()
	{
		return 'PO-' . date('ym') . '-' . random_word(4);
	}

	public function get_purchase_order()
	{
		$data = $this->po->M_get_purchase_order([
			// 'Disc' => '0',
			'PaymentType' => 'PO',
			'master.BranchCode' => $this->session->userdata('branch'),
			// 'POStatus' => 'Order',
			'ApprovedStatus' => 'NotApproved'
		])->result_array();

		echo json_encode($data);
	}

	public function get_number_of_purchase_order()
	{
		$where_condition = [
			// 'Disc' => '0',
			'PaymentType' => 'PO',
			'master.BranchCode' => $this->session->userdata('branch'),
		];

		$where_condition['POStatus'] = 'Order';
		$order = $this->po->M_get_purchase_order($where_condition)->num_rows();

		$where_condition['POStatus'] = 'OnProcess';
		$process = $this->po->M_get_purchase_order($where_condition)->num_rows();

		$where_condition['POStatus'] = 'Completed';
		$completed = $this->po->M_get_purchase_order($where_condition)->num_rows();

		$where_condition['POStatus'] = 'Canceled';
		$cancelled = $this->po->M_get_purchase_order($where_condition)->num_rows();

		$result = [
			'order' => $order,
			'process' => $process,
			'completed' => $completed,
			'cancelled' => $cancelled
		];

		echo json_encode($result);
	}

	public function get_purchase_order_by_status($data_status)
	{
		switch ($data_status) {
			case 'process':
				$status = 'OnProcess';
				break;

			case 'order':
				$status = 'Order';
				break;

			case 'completed':
				$status = 'Completed';
				break;

			case 'cancelled':
				$status = 'Canceled';
				break;

			default:
				return "Opps";
				break;
		}

		$where_condition = [
			// 'Disc' => '0',
			'PaymentType' => 'PO',
			'master.BranchCode' => $this->session->userdata('branch'),
			'POStatus' => $status
		];

		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');

		isset($start_date) ? $where_condition['master.RaiseDate >='] = date('Y-m-d', strtotime($start_date)) : false;
		isset($end_date) ? $where_condition['master.RaiseDate <='] = date('Y-m-d', strtotime($end_date)) : false;

		$data = $this->po->M_get_purchase_order($where_condition)->result_array();

		echo json_encode($data);
	}

	public function approve_multi_purchase_order()
	{
		$id = $this->input->post('id', true);
		if ($id) {
			$approve_date = Date('Y-m-d H:i:s');
			$data_update_po = [];
			foreach ($id as $row => $value) {
				array_push($data_update_po, [
					'CtrlNo' => $value,
					'ApprovedStatus' => 'Approved',
					'ApprovedBy' => $this->session->userdata('uid'),
					'ApprovedDate' => $approve_date
				]);
			}

			$data = [
				'po' => $data_update_po
			];
			$query_update = $this->po->M_approve_multi_po($data);
		}
		// $query_update = 'success';
		$result = [
			'success' => true,
			'status' => $query_update,
			'message' => 'PO Approved!'
		];

		echo json_encode($result);
	}

	public function get_purchase_order_form()
	{
		$title = 'Purchase Order';
		$script = '<script src="' . base_url('js/abc/purchase_order/new_purchase_order.js') . '" type="module"></script>';
		$data_view = [
			'title' => 'New Purchase Order',
			'type' => 'create',
			'po_no' => $this->get_doc_no()
		];
		$content = $this->load->view('abc/content/purchase_order_form', $data_view, true);

		$data = [
			'title' => $title,
			'content' => $content,
			'script' => $script,
			'no_sidebar' => true
		];
		$this->load->view('abc/layout/main', $data);
	}

	public function ajax_get_doc_no()
	{
		echo $this->get_doc_no();
	}

	public function create_purchase_order()
	{
		//TODO : Add Contact and check Tax
		$result = null;

		$doc_no = $this->input->post('po_no', true);
		$supplier = $this->input->post('po_supplier', true);
		$quote_ref_no = $this->input->post('po_no_ref', true);
		$remarks = $this->input->post('po_remarks', true);

		$bill_to = $this->input->post('po_bill_to', true);
		$ship_to = $this->input->post('po_ship_to', true);
		$storage = $ship_to;
		$cost_center = $this->input->post('po_cost_center', true);
		$account_code = $this->input->post('po_acc_code', true);
		$freight = $this->input->post('po_freight', true);
		$shipment = $this->input->post('po_shipment', true);
		$freight_remarks = $this->input->post('po_freight_remarks', true);

		$raised_by = $this->session->userdata('uid');
		$raised_date = $this->input->post('po_raised_date', true);
		$term_days = $this->input->post('po_term_days', true);
		$due_date = $this->input->post('po_due_date', true);

		$stockcode = $this->input->post('po_stockcode', true);
		$currency = $this->input->post('po_currency', true);
		$qty = $this->input->post('po_qty', true);
		$price = $this->input->post('po_price', true);
		$discount = $this->input->post('po_discount', true);

		$calc_sub_total = 0;
		$payment_discount = $this->input->post('po_payment_discount', true);
		$payment_tax = $this->input->post('po_payment_tax', true);
		$payment_freight_cost = $this->input->post('po_payment_freight_cost', true);

		$data_detail = [];
		$data_master = [];
		$data_update_stockreg = [];

		$config_validation = [
			[
				'field' => 'po_no',
				'label' => 'Document Number',
				'rules' => ['required', 'is_unique[tbl_mat_po_v2.PurchaseOrderID]'],
				'errors' => [
					'is_unique' => 'This %s is already taken.<a id="action-regenerate-id">Re-Generate</a>'
				]
			],
			[
				'field' => 'po_supplier',
				'label' => 'Supplier',
				'rules' => 'required'
			],
			[
				'field' => 'po_bill_to',
				'label' => 'Bill To',
				'rules' => 'required'
			],
			[
				'field' => 'po_ship_to',
				'label' => 'Ship To',
				'rules' => 'required'
			],
			[
				'field' => 'po_raised_date',
				'label' => 'Raised Date',
				'rules' => 'required'
			],
			[
				'field' => 'po_payment_discount',
				'label' => 'Discount',
				'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
				'errors' => [
					'less_than_equal_to' => '%s cannot be more than 100',
					'greater_than_equal_to' => '%s must be more than 0'
				]
			],
			[
				'field' => 'po_payment_tax',
				'label' => 'Tax',
				'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
				'errors' => [
					'less_than_equal_to' => '%s cannot be more than 100',
					'greater_than_equal_to' => '%s must be more than 0'
				]
			],
			[
				'field' => 'po_payment_freight_cost',
				'label' => 'Freight Cost',
				'rules' => ['numeric', 'greater_than_equal_to[0]'],
				'erros' => [
					'greater_than_equal_to' => '%s must be more than 0'
				]
			]
		];

		foreach ($stockcode as $row => $value) {
			array_push($config_validation, [
				'field' => 'po_stockcode[' . $row . ']',
				'label' => 'Stockcode',
				'rules' => 'required'
			]);
		}

		foreach ($currency as $row => $value) {
			array_push($config_validation, [
				'field' => 'po_currency[' . $row . ']',
				'label' => 'Currency',
				'rules' => 'required'
			]);
		}

		foreach ($qty as $row => $value) {
			array_push($config_validation, [
				'field' => 'po_qty[' . $row . ']',
				'label' => 'Qty',
				'rules' => ['required', 'numeric', 'greater_than[0]'],
				'errors' => [
					'greater_than' => '%s must be more than 0'
				]
			]);
		}

		foreach ($price as $row => $value) {
			array_push($config_validation, [
				'field' => 'po_price[' . $row . ']',
				'label' => 'Price',
				'rules' => ['required', 'numeric', 'greater_than[0]'],
				'errors' => [
					'greater_than' => '%s must be more than 0'
				]
			]);
		}

		foreach ($discount as $row => $value) {
			array_push($config_validation, [
				'field' => 'po_discount[' . $row . ']',
				'label' => 'Discount',
				'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
				'errors' => [
					'less_than_equal_to' => '%s cannot be more than 100',
					'greater_than_equal_to' => '%s must be more than 0'
				]
			]);
		}

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($config_validation);

		if ($this->form_validation->run() == FALSE) {
			foreach ($config_validation as $row => $value) {
				$message[] = [
					'field' => $value['field'],
					'error_message' => form_error($value['field'])
				];
			}

			$result = [
				'error' => true,
				'status' => 'validation_error',
				'message' => $message
			];
		} else {
			foreach ($stockcode as $row => $value) {
				$stockcode_data = $this->so->M_get_stockcode_data([
					'stockreg.Storage' => $storage,
					'stockreg.Stockcode' => $value
				])->row_array();

				$stockreg_data = $this->ds->M_get_stockreg_data([
					'Stockcode' => $value,
					'Storage' => $storage
				])->row_array();

				$calc_total = $price[$row] * $qty[$row];
				$calc_disc_amount = ($calc_total * $discount[$row]) / 100;
				$calc_item_total = $calc_total - $calc_disc_amount;

				// * Data detail
				array_push($data_detail, [
					'ItemNo' => $row + 1,
					'PurchaseOrderID' => $doc_no,
					'SalesNo' => '',
					'Stockcode' => $value,
					'StockDesc' => $stockcode_data['StockDescription'],
					'UOM' => $stockcode_data['UOM'],
					'Qty' => $qty[$row],
					'QtyOutstanding' => $qty[$row],
					'Currency' => $currency[$row],
					'CurrRate' => 1,
					'ItemPrice' => $price[$row],
					'Discount' => $discount[$row],
					'DiscAmount' => $calc_disc_amount,
					'Tax' => 0,
					'TaxAmount' => 0,
					'TotalAmount' => $calc_item_total,
					'Status' => '',
					'StatusChangeBy' => '',
					'StatusChangeDate' => null
				]);

				// * Data Stock Reg
				array_push($data_update_stockreg, [
					'CtrlNo' => $stockreg_data['CtrlNo'],
					'SOO' => $stockreg_data['SOO'] + $qty[$row],
					'CombineStock' => $stockreg_data['CombineStock'] + $qty[$row]
				]);

				$calc_sub_total += $calc_item_total;
			}

			$discount_amount = $calc_sub_total * ($payment_discount / 100);
			$tax_amount = $calc_sub_total * ($payment_tax / 100);
			$grand_total = $calc_sub_total - $discount_amount + $tax_amount + $payment_freight_cost;

			$data_master = [
				'DocNo' => '',
				'PurchaseReqNo' => '',
				'PurchaseOrderID' => $doc_no,
				'QuoteRefNo' => $quote_ref_no,
				'VAT' => '-',
				'SupplierID' => $supplier,
				'SupContactID' => '', //TODO: Add This
				'SupInvoiceNo' => '',
				'RaiseBy' => $raised_by,
				'RaiseDate' => $raised_date,
				'Term' => $term_days,
				'DueDate' => $due_date,
				'BillTo' => $bill_to,
				'ShipTo' => $ship_to,
				'Storage' => $storage,
				'BranchCode' => $this->session->userdata('branch'),
				'FreightService' => $freight,
				'DeliveryNo' => '-',
				'DeliveryMethod' => $shipment,
				'FreightInfo' => $freight_remarks,
				'PaymentType' => 'PO',
				'SubTotal' => $calc_sub_total,
				'Discount' => $payment_discount,
				'DiscAmount' => $discount_amount,
				'Tax' => $payment_tax,
				'TaxAmount' => $tax_amount,
				'TaxStatus' => '', //TODO: Check Again
				'FreightCost' => $payment_freight_cost,
				'GrandTotal' => $grand_total,
				// ? for what
				'Current_pay' => 0,
				'Mast_cur_pay' => 0,
				'Det_cur_pay' => 0,
				'Total_N_payment' => 0,
				// ? end
				'PORemarks' => $remarks,
				'POStatus' => 'Order',
				'POStatusPayment' => 'Order',
				'POEntry' => 'Append',
				// 'POCompletedDate' => '', // TODO: Check Again
				'PaymentStatus' => 'UnPaid',
				// 'PaymentDate' => '' // TODO : Check Again
				'ApprovedStatus' => 'NotApproved',
				'ApprovedDate' => '',
				'SubmittedBy' => $raised_by,
				'SubmittedDate' => date('Y-m-d H:i:s'),
				'payment' => null,
				'card_no' => null,
				'bank_code' => null,
				'sale_remark' => null,
				'assembly_type' => null,
				'AccNo' => $account_code,
				'CostCenter' => $cost_center
			];

			$data = [
				'detail' => $data_detail,
				'master' => $data_master,
				'data_update_stockreg' => $data_update_stockreg
			];

			$query_insert = $this->po->M_insert_purchase_order($data);
			// $query_insert = 'success';

			if ($query_insert == 'success') {
				$result = [
					'success' => true,
					'status' => $query_insert,
					'message' => 'Data Recorded!'
				];
			} else {
				$result = [
					'error' => true,
					'status' => 'error',
					'message' => 'Please Contact Administrator'
				];
			}
		}

		echo json_encode($result);
	}

	public function view_purchase_order_detail($id)
	{
		$title = 'Purchase Order';
		$script = '<script src="' . base_url('js/abc/purchase_order/detail_purchase_order.js') . '" type="module"></script>';
		$branch_session = $this->session->userdata('branch');

		$master_data = $this->po->M_get_purchase_order_master([
			'master.CtrlNo' => $id,
			'master.PaymentType' => 'PO',
			'master.BranchCode' => $branch_session
		])->row_array();

		$detail_data = $this->po->M_get_purchase_order_detail([
			'PurchaseOrderID' => $master_data['DocNo']
		])->result_array();

		if ($master_data) {
			$data_view = [
				'title' => 'Purchase Order Detail',
				'master' => $master_data,
				'detail' => $detail_data
			];
			$content = $this->load->view('abc/content/purchase_order_detail', $data_view, true);

			$data = [
				'title' => $title,
				'content' => $content,
				'script' => $script
			];
			$this->load->view('abc/layout/main', $data);
		} else {
			redirect('abc/purchase/purchase_order');
		}
	}
}
