<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_DirectPurchase extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ABC/DirectPurchase_Model', 'dp');
		$this->load->model('ABC/PurchaseOrder_Model', 'po');
		$this->load->model('ABC/SalesOrder_Model', 'so');
		$this->load->model('ABC/DirectSales_Model', 'ds');
		// auth_admin();
	}

	public function index()
	{
		$title = 'Direct Purchase';
		$script = '<script src="' . base_url('js/abc/direct_purchase/view_direct_purchase.js') . '" type="text/javascript"></script>';
		$data_view = [
			'title' => 'Direct Purchase'
		];
		$content = $this->load->view('abc/content/direct_purchase', $data_view, true);

		$data = [
			'title' => $title,
			'content' => $content,
			'script' => $script
		];
		$this->load->view('abc/layout/main', $data);
	}

	public function get_doc_no()
	{
		return 'DP-' . date('ym') . '-' . random_word(4);
	}

	public function ajax_get_doc_no()
	{
		echo $this->get_doc_no();
	}

	public function get_direct_purchase()
	{
		$data = $this->po->M_get_purchase_order([
			'PaymentType' => 'DP',
			// 'master.BranchCode' => $this->session->userdata('branch'),
			'master.BranchCode' => '0101',
		])->result_array();

		echo json_encode($data);
	}

	public function get_direct_purchase_form()
	{
		$title = 'Direct Purchase';
		$script = '<script src="' . base_url('js/abc/direct_purchase/new_direct_purchase.js') . '" type="module"></script>';
		$data_view = [
			'title' => 'New Direct Purchase',
			'type' => 'create',
			'dp_no' => $this->get_doc_no()
		];
		$content = $this->load->view('abc/content/direct_purchase_form', $data_view, true);

		$data = [
			'title' => $title,
			'content' => $content,
			'script' => $script,
			'no_sidebar' => true
		];
		$this->load->view('abc/layout/main', $data);
	}

	public function get_supplier_select2()
	{
		$data = $this->dp->M_get_supplier([
			'Disc' => '0',
			// 'Branch' => $this->session->userdata('branch')
			'Branch' => '0101'
		])->result_array();

		echo json_encode($data);
	}

	public function get_stockcode_select2()
	{
		$data = $this->so->M_get_stockcode([
			// 'stockcode.Row' => 'Yes',
			'stockreg.Disc' => '0',
			// 'stockreg.BranchCode' => $this->session->userdata('branch'),
			'stockreg.BranchCode' => '0101',
		])->result_array();

		echo json_encode($data);
	}

	public function create_direct_purchase()
	{
		// TODO: Add Update Sale Price Margin. Reference in PurchaseOrder.php file
		$result = null;

		$pos_trans_id = $this->ds->M_get_trans_id();
		$branch = $this->session->userdata('branch');

		$doc_no = $this->input->post('dp_no', true);
		$requisition_no = $this->input->post('dp_requisition', true);
		$invoice_no = $this->input->post('dp_invoice', true);
		$supplier = $this->input->post('dp_supplier', true);
		$quote_ref_no = $this->input->post('dp_no_ref', true);
		$remarks = $this->input->post('dp_remarks', true);

		$bill_to = $this->input->post('dp_bill_to', true);
		$ship_to = $this->input->post('dp_ship_to', true);
		$storage = $ship_to;
		$cost_center = $this->input->post('dp_cost_center', true);
		$account_code = $this->input->post('dp_acc_code', true);
		$freight = $this->input->post('dp_freight_remarks', true);
		$shipment = $this->input->post('dp_shipment', true);
		$freight_remarks = $this->input->post('dp_freight_remarks', true);

		$raised_by = $this->session->userdata('uid');
		$raised_date = $this->input->post('dp_raised_date', true);
		$term_days = $this->input->post('dp_term_days', true);
		$due_date = $this->input->post('dp_due_date', true);

		$stockcode = $this->input->post('dp_stockcode', true);
		$currency = $this->input->post('dp_currency', true);
		$qty = $this->input->post('dp_qty', true);
		$price = $this->input->post('dp_price', true);
		$discount = $this->input->post('dp_discount', true);

		$calc_sub_total = 0;
		$payment_discount = $this->input->post('dp_payment_discount', true);
		$payment_tax = $this->input->post('dp_payment_tax', true);
		$payment_freight_cost = $this->input->post('dp_payment_freight_cost', true);

		$payment = $this->input->post('dp_payment_total_paid', true);
		$payment_type = $this->input->post('dp_payment_type', true);
		$card_number = $this->input->post('dp_payment_card_number', true);
		$bank = $this->input->post('dp_payment_bank', true);

		$data_detail = [];
		$data_master = [];
		$data_received = [];
		$data_trans = [];
		$data_pos_trans = [];
		$data_price = [];
		$data_update_price = [];
		$data_update_stock = [];
		$data_update_stockreg = [];

		$config_validation = [
			[
				'field' => 'dp_no',
				'label' => 'Document Number',
				'rules' => ['required', 'is_unique[tbl_mat_po_v2.PurchaseOrderID]'],
				'errors' => [
					'is_unique' => 'This %s is already taken. <a id="action-regenerate-id">Re-Generate</a>'
				]
			],
			[
				'field' => 'dp_requisition',
				'label' => 'Requisition Number',
				'rules' => 'required'
			],
			[
				'field' => 'dp_invoice',
				'label' => 'Invoice Number',
				'rules' => 'required'
			],
			[
				'field' => 'dp_supplier',
				'label' => 'Supplier',
				'rules' => 'required'
			],
			[
				'field' => 'dp_bill_to',
				'label' => 'Bill To',
				'rules' => 'required'
			],
			[
				'field' => 'dp_ship_to',
				'label' => 'Ship To',
				'rules' => 'required'
			],
			[
				'field' => 'dp_cost_center',
				'label' => 'Cost Center',
				'rules' => 'required'
			],
			[
				'field' => 'dp_acc_code',
				'label' => 'Account Code',
				'rules' => 'required'
			],
			[
				'field' => 'dp_shipment',
				'label' => 'Shipment',
				'rules' => 'required'
			],
			[
				'field' => 'dp_payment_discount',
				'label' => 'Discount',
				'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
				'errors' => [
					'less_than_equal_to' => '%s cannot be more than 100',
					'greater_than_equal_to' => '%s must be more than 0'
				]
			],
			[
				'field' => 'dp_payment_tax',
				'label' => 'Tax',
				'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
				'errors' => [
					'less_than_equal_to' => '%s cannot be more than 100',
					'greater_than_equal_to' => '%s must be more than 0'
				]
			],
			[
				'field' => 'so_payment_freight_cost',
				'label' => 'Freight Cost',
				'rules' => ['numeric', 'greater_than_equal_to[0]'],
				'erros' => [
					'greater_than_equal_to' => '%s must be more than 0'
				]
			]
		];

		foreach ($stockcode as $row => $value) {
			array_push($config_validation, [
				'field' => 'dp_stockcode[' . $row . ']',
				'label' => 'Stockcode',
				'rules' => 'required'
			]);
		}

		foreach ($currency as $row => $value) {
			array_push($config_validation, [
				'field' => 'dp_currency[' . $row . ']',
				'label' => 'Currency',
				'rules' => 'required'
			]);
		}

		foreach ($qty as $row => $value) {
			array_push($config_validation, [
				'field' => 'dp_qty[' . $row . ']',
				'label' => 'Qty',
				'rules' => ['required', 'numeric', 'greater_than[0]'],
				'errors' => [
					'greater_than' => '%s must be more than 0'
				]
			]);
		}

		foreach ($price as $row => $value) {
			array_push($config_validation, [
				'field' => 'dp_price[' . $row . ']',
				'label' => 'Price',
				'rules' => ['required', 'numeric', 'greater_than[0]'],
				'errors' => [
					'greater_than' => '%s must be more than 0'
				]
			]);
		}

		foreach ($discount as $row => $value) {
			array_push($config_validation, [
				'field' => 'dp_discount[' . $row . ']',
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

				// * Calculation
				$calc_total = $price[$row] * $qty[$row];
				$calc_disc_amount = ($calc_total * $discount[$row]) / 100;
				$calc_item_total = $calc_total - $calc_disc_amount;
				$calc_sub_total += $calc_item_total;

				// * Check SOH by last balance in stock trans
				$stocktrans_data = $this->ds->M_get_stock_trans_data([
					'stock_code' => $value,
					'storage' => $storage
				])->row_array();

				// * Check Stockreg data
				$stockreg_data = $this->ds->M_get_stockreg_data([
					'Stockcode' => $value,
					'Storage' => $storage
				])->row_array();

				// * Check Stock data
				$stock_data = $this->ds->M_get_stock_data([
					'Stockcode' => $value,
				])->row_array();

				$totamount_trans = $qty[$row] * $price[$row];
				$tot_bal_left = $totamount_trans;

				// * Count Ending Balance
				if ($stocktrans_data) {
					$totamount_trans_fifo = $stockreg_data['SOH'] + $qty[$row];
					$qty_reg = $stocktrans_data['qty_reg'] + $qty[$row];
					$tot_bal_right = $stocktrans_data['tot_bal_right'] + ($qty[$row] * $price[$row]);
					$totamount_trans_fifo = $qty[$row];
					$qty_bal = $qty[$row] + $stocktrans_data['qty_bal'];
					$com_val = $qty_bal == $totamount_trans_fifo ? $stocktrans_data['item_no_trans'] : 0;
					$id_fifo = $stocktrans_data['fifo_id'] + 1;
					$no_trans = $stocktrans_data['item_no_trans'] + 1;
					$total_amount_tbv = $stocktrans_data['total_amount_tbv'] + $totamount_trans;
				} else {
					$com_val = 0;
					$tot_bal_right = $qty[$row] * $price[$row];
					$qty_reg = $stockreg_data['SOH'] + $qty[$row];
					$totamount_trans_fifo = $stockreg_data['SOH'] + $qty[$row];
					$qty_bal = $qty[$row] + $stockreg_data['SOH'];
					$id_fifo = 1;
					$no_trans = 1;
					$total_amount_tbv = $totamount_trans;
				}

				$switch_co = $totamount_trans_fifo < 1 ? 0 : 1;
				$cost_price_right = $tot_bal_right / $qty_bal;

				// * Data detail
				array_push($data_detail, [
					'PurchaseOrderID' => $doc_no,
					'SalesNo' => '',
					'ItemNo' => $row + 1,
					'StockCode' => $value,
					'StockDesc' => $stockcode_data['StockDescription'],
					'UOM' => $stockcode_data['UOM'],
					'Qty' => $qty[$row],
					'QtyOutstanding' => 0,
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

				// * Data Received
				array_push($data_received, [
					'ReceiveNo' => $doc_no,
					'PONo' => $doc_no,
					'Supplier' => '',
					'SupplierDescription' => '',
					'ItemPrice' => '',
					'Currency' => '',
					'Rate' => 0,
					'Storage' => '',
					'Bin' => '',
					'AccountCode' => '',
					'WorkOrder' => '',
					'SupplierCode' =>  $supplier,
					'StorageCode' => $storage,
					'ItemNo' => $row + 1,
					'Stockcode' => $value,
					'StockDescription' => $stockcode_data['StockDescription'],
					'OrderQty' => $qty[$row],
					'UOM' => $stockcode_data['UOM'],
					'QtyOutstanding' => 0,
					'QtyReceived' => $qty[$row],
					'QtyToReceived' => $qty[$row],
					'ReceivedPrice' => $price[$row],
					'ReceivedBy' => $this->session->userdata('uid'),
					'ReceivedDate' => $raised_date,
					'ReceivedRemarks' => $remarks,
					'MRSubmitDate' => date("Y-m-d H:i:s"),
					'Receive_Status' => ''
				]);

				// * Data Trans
				array_push($data_trans, [
					'company_code' => $branch,
					'trans_id' => $pos_trans_id,
					'trans_date' => $raised_date,
					'trans_type' => 'Receive',
					'trans_type_no' => $doc_no,
					'item_no' => $row + 1,
					'item_no_trans' => $no_trans,
					'total_amount_stand' => $totamount_trans,
					'total_amount_tbv' => $total_amount_tbv,
					'stock_code' => $value,
					'qty' => $qty[$row],
					'qty_in' => $qty[$row],
					'qty_out' => 0,
					'cost_price_stand' => $price[$row],
					'storage' => $storage,
					'qty_bal' => $qty_bal,
					'transdate' => date('Y-m-d'),
					'tot_bal_left' => $tot_bal_left,
					'tot_bal_right' => $tot_bal_right,
					'cost_price_set' => $cost_price_right,
					'cost_price_type' => $stocktrans_data['cost_price_type'] ?? $stockreg_data['CostPriceType'],
					'switch_cost' => $switch_co,
					'cost_price_native' => $price[$row],
					'fifo_id' => $id_fifo,
					'cost_compare' => $price[$row],
					'cost_val' => $com_val,
					'qty_reg' => $qty_reg,
					'remain_fifo_i' => 1,
					'remain_fifo' => $totamount_trans_fifo
				]);

				// * Increase Stock Reg
				array_push($data_update_stockreg, [
					'CtrlNo' => $stockreg_data['CtrlNo'],
					'SOH' => $stockreg_data['SOH'] + $qty[$row],
					'SAV' => $stockreg_data['SAV'] + $qty[$row],
					'CombineStock' => $stockreg_data['CombineStock'] + $qty[$row],
					'CostPrice' => $price[$row]
				]);

				// * Increase Stock
				array_push($data_update_stock, [
					'CtrlNo' => $stock_data['CtrlNo'],
					'SOH' => $stock_data['SOH'] + $qty[$row]
				]);
			}

			// * Grand Total Calculation
			$discount_amount = $calc_sub_total * ($payment_discount / 100);
			$tax_amount = $calc_sub_total * ($payment_tax / 100);
			$grand_total = $calc_sub_total - $discount_amount + $tax_amount + $payment_freight_cost;

			// * Data Mat PO
			$data_master = [
				'DocNo' => '',
				'PurchaseReqNo' => $requisition_no,
				'PurchaseOrderID' => $doc_no,
				'QuoteRefNo' => $quote_ref_no,
				'VAT' => '-',
				'SupplierID' => $supplier,
				'SupContactID' => '',
				'SupInvoiceNo' => $invoice_no,
				'RaiseBy' => $raised_by,
				'RaiseDate' => $raised_date,
				'Term' => $term_days,
				'DueDate' => $due_date,
				'BillTo' => $bill_to,
				'ShipTo' => $ship_to,
				'Storage' => '',
				'BranchCode' => $branch,
				'FreightService' => $freight,
				'DeliveryNo' => '-',
				'DeliveryMethod' => $shipment,
				'FreightInfo' => $freight_remarks,
				'PaymentType' => 'DP',
				'PaymentMethod' => $payment_type,
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
				'POStatus' => 'Completed',
				'POStatusPayment' => 'OnProcess',
				'POEntry' => 'Append',
				// 'POCompletedDate' => '', // TODO: Check Again
				'PaymentStatus' => 'Paid',
				// 'PaymentDate' => '' // TODO : Check Again
				'ApprovedBy' => $raised_by,
				'ApprovedStatus' => 'Approved',
				'ApprovedDate' => $raised_date,
				'SubmittedBy' => $raised_by,
				'SubmittedDate' => date('Y-m-d H:i:s'),
				'payment' => $payment,
				'card_no' => $card_number,
				'bank_code' => $bank,
				'sale_remark' => null,
				'assembly_type' => null,
				'AccNo' => $account_code,
				'CostCenter' => $cost_center
			];

			// * Data POS Trans
			$data_pos_trans = [
				'trans_id' => $pos_trans_id,
				'trans_qty_items' => count($stockcode),
				'sale_doc_no' => null,
				'po_no' => $doc_no,
				'trans_date' => $raised_date,
				'trans_type' => 'Receive',
				'payment_type' => $payment_type,
				'trans_remarks' => $remarks,
				'trans_disc' => 'no'
			];

			$data = [
				'data_mat_po' => $data_master,
				'data_mat_po_det' => $data_detail,
				'data_received' => $data_received,
				'data_stock_trans' => $data_trans,
				'data_pos_trans' => $data_pos_trans,
				'data_stockreg' => $data_update_stockreg,
				'data_stock' => $data_update_stock,
			];

			$data_for_price = [
				'data_update_price' => $data_update_price,
				'data_price' => $data_price
			];

			$result = [
				'error' => true,
				'status' => 'error',
				'message' => 'Please Contact Administrator'
			];

			$query_result = $this->dp->M_create_direct_purchase($data);

			// * Pricing will be set when all data recorded
			if ($query_result == 'success') {
				foreach ($stockcode as $row => $value) {
					// * Check Price data
					$price_data = $this->dp->M_get_price_data([
						'StorageCode' => $storage,
						'Stockcode' => $value,
						'BranchCode' => $branch
					])->row_array();

					// * Check Price TBV 
					$price_tbv_data = $this->dp->M_get_price_tbv_data([
						'StorageCode' => $storage,
						'Stockcode' => $value
					]);

					// * Price Data
					if ($price_data) {
						array_push($data_update_price, [
							'CtrlNo' => $price_data['CtrlNo'],
							'PriceAverage' => $price_tbv_data['avg'],
							'PriceFIFO' => $price_tbv_data['fifo'],
							'PriceLIFO' => $price_tbv_data['lifo'],
							'LastUpdate' => date('Y-m-d H:i:s'),
							'Disc' => '0'
						]);
					} else {
						array_push($data_price, [
							'BranchCode' => $branch,
							'StorageCode' => $storage,
							'StockCode' => $value,
							'PriceAverage' => $price_tbv_data['avg'],
							'PriceFIFO' => $price_tbv_data['fifo'],
							'PriceLIFO' => $price_tbv_data['lifo'],
							'LastUpdate' => date('Y-m-d H:i:s'),
						]);
					}
				}

				$query_result_price = $this->dp->M_update_price($data_for_price);

				if ($query_result_price == 'success') {
					$result = [
						'success' => true,
						'status' => $query_result_price,
						'message' => 'Data Recorded!'
					];
				}
			}
		}

		echo json_encode($result);
	}

	public function view_direct_purchase_detail($id)
	{
		$title = 'Direct Purchase';
		$script = '';

		// $branch_session = $this->session->userdata('branch');
		$branch_session = '0101';

		$master_data = $this->dp->M_get_direct_purchase_master([
			'master.CtrlNo' => $id,
			'master.PaymentType' => 'DP',
			'master.BranchCode' => $branch_session
		])->row_array();

		if ($master_data) {
			$detail_data = $this->dp->M_get_direct_purchase_detail([
				'PurchaseOrderID' => $master_data['DocNo']
			])->result_array();

			$data_view = [
				'title' => 'Sales Order Detail',
				// 'branch' => $branch_data,
				'master' => $master_data,
				'detail' => $detail_data
			];
			$content = $this->load->view('abc/content/direct_purchase_detail', $data_view, true);

			$data = [
				'title' => $title,
				'content' => $content,
				'script' => $script
			];
			$this->load->view('abc/layout/main', $data);
		} else {
			redirect('purchase/direct_purchase');
		}
	}

	// TODO: Check if it used
	public function get_cost_center_select2()
	{
		$data = $this->dp->M_get_cost_center([
			'Disc' => '0'
		])->result_array();

		echo json_encode($data);
	}

	// TODO: Check if it used
	public function get_account_code_select2()
	{
		$data = $this->dp->M_get_account_code([
			'Disc' => '0'
		])->result_array();

		echo json_encode($data);
	}
}
