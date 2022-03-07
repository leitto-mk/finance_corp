<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_BackOrder extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ABC/BackOrder_Model', 'bo');
		$this->load->model('ABC/DirectSales_Model', 'ds');
		$this->load->model('ABC/DirectPurchase_Model', 'dp');
		auth_admin();
	}

	public function index()
	{
		$title = 'Back Order';
		$script = '<script src="' . base_url('js/abc/back_order/backorder.js') . '" type="module"></script>';

		$data_view = [
			'title' => 'Back Order',
		];
		$content = $this->load->view('abc/content/back_order', $data_view, true);

		$data = [
			'title' => $title,
			'content' => $content,
			'script' => $script,
		];
		$this->load->view('abc/layout/main', $data);
	}

	public function get_back_order()
	{
		$data = $this->bo->M_get_back_order([
			'BranchCode' => $this->session->userdata('branch')
		])->result_array();

		echo json_encode($data);
	}

	public function view_back_order_detail()
	{
		$id  = $this->input->get('id', true);

		$master_data = $this->bo->M_get_back_order_master([
			'master.CtrlNo' => $id,
			'master.BranchCode' => $this->session->userdata('branch')
		])->row_array();

		$detail_data = $this->bo->M_get_back_order_detail([
			'BONo' => $master_data['DocNo']
		])->result_array();

		$received_data = $this->bo->M_get_back_order_received([
			'detail.BONo' => $master_data['DocNo']
		])->result_array();

		$sales_order_data = $this->bo->M_get_sales_order_data([
			'QuoteRefNo' => $master_data['DocNo'],
		])->row_array();

		$transferred_data = $this->bo->M_get_back_order_transfered([
			'po.QuoteRefNo' => $master_data['DocNo'],
			'po.ApprovedStatus' => 'Approved'
		])->result_array();

		$received = false;
		if ($sales_order_data && $sales_order_data['ApprovedStatus'] == 'Approved') {
			$received = true;
		}

		$transferred_qty = 0;
		$received_qty = 0;
		foreach ($transferred_data as $row => $value) {
			$transferred_qty += $value['Transferred'];
			$received_qty += $value['Received'];
		}


		if ($transferred_qty - $received_qty == 0) {
			$received = false;
		} else {
			$received = true;
		}

		// * Testing
		// $ordered = 0;
		// foreach ($detail_data as $row => $value) {
		//   $ordered += $value['Ordered'];
		// }

		// $received = 0;
		// foreach ($transferred_data as $row => $value) {
		//   $received += $value['Received'];
		// }
		// var_dump($ordered - $received);
		// die;
		// * End Testing


		$data = [
			'master' => $master_data,
			'detail' => $detail_data,
			'received' => $received_data,
			'received_btn' => $received,
			'transferred' => $transferred_data
		];

		$this->load->view('abc/content/back_order_detail', $data);
	}

	public function get_back_order_progress()
	{
		$branch = $this->session->userdata('branch');
		$data = $this->bo->M_get_back_order_progress([
			'backorder.BranchCode' => $branch,
			'backorder.Status' => 'Process'
		], $branch)->result_array();

		echo json_encode($data);
	}

	public function get_book()
	{
		$data = $this->bo->M_get_book_data(
			[
				'stockcode.Disc' => '0',
				'stockcode.Row' => 'No',
			],
			['10500-00', '10600-00'],
			$this->session->userdata('branch')
		)->result_array();

		// print_r($data);
		// die;

		echo json_encode($data);
	}

	public function get_book_select2()
	{
		$data = $this->bo->M_get_book([
			'stockcode.Disc' => '0',
			'stockcode.Row' => 'No'
		], ['10500-00', '10600-00'])->result_array();

		echo json_encode($data);
	}

	public function get_back_order_form()
	{
		$data = ['bo_no' => $this->generate_bo_id()];
		$this->load->view('abc/content/back_order_form', $data);
	}

	public function get_receive_back_order_form()
	{
		$id = $this->input->get('id', true);

		$master_data = $this->bo->M_get_back_order_master([
			'master.CtrlNo' => $id,
			'master.BranchCode' => $this->session->userdata('branch')
		])->row_array();

		$detail_data = $this->bo->M_get_back_order_received([
			'BONo' => $master_data['DocNo']
		])->result_array();

		$transferred_data = $this->bo->M_get_back_order_transfered([
			'QuoteRefNo' => $master_data['DocNo']
		])->result_array();

		$data = [
			'id' => $id,
			'bo_receive_no' => $this->generate_receive_bo_id(),
			'bo_ref_no' => $master_data['DocNo'],
			'detail' => $detail_data,
			'transferred' => $transferred_data
		];
		$this->load->view('abc/content/back_order_receive_form', $data);
	}

	public function receive_back_order()
	{
		$branch = $this->session->userdata('branch');
		$pos_trans_id = $this->ds->M_get_trans_id();

		$doc_no = $this->input->post('bo_receive_doc_no', true);
		$ref_no = $this->input->post('bo_receive_ref_no', true);
		$storage = $this->input->post('bo_receive_storage', true);
		$received_by = $this->session->userdata('uid');
		$received_date = $this->input->post('bo_receive_reg_date', true);
		$remarks = $this->input->post('bo_receive_master_remarks', true);

		$item_no = $this->input->post('bo_receive_item_no', true);
		$stockcode = $this->input->post('bo_receive_stockcode', true);
		$stock_description = $this->input->post('bo_receive_stockdescription', true);
		$uom = $this->input->post('bo_receive_uom', true);
		$ordered = $this->input->post('bo_receive_ordered', true);
		$qty = $this->input->post('bo_receive_qty', true);

		$payment_discount = 0;
		$payment_tax = 0;
		$payment_freight_cost = 0;

		$data_insert_receive = [];
		$data_insert_stock_trans = [];
		$data_update_stock = [];
		$data_update_stockreg = [];
		$data_price = [];
		$data_update_price = [];

		$qty_received = 0;
		$calc_sub_total = 0;

		$config_validation = [
			[
				'field' => 'bo_receive_doc_no',
				'label' => 'Document Number',
				'rules' => 'required',
			],
			[
				'field' => 'bo_receive_ref_no',
				'label' => 'Reference Number',
				'rules' => 'required'
			],
			[
				'field' => 'bo_receive_storage',
				'label' => 'Storage',
				'rules' => 'required'
			]
		];

		foreach ($qty as $row => $value) {
			$data_transferred = $this->bo->M_get_back_order_transfered([
				'det.StockCode' => $stockcode[$row],
				'po.QuoteRefNo' => $ref_no
			])->row_array();

			if ($data_transferred['Outstanding'] == 0) {
				$max = $data_transferred['Ordered'];
			} else {
				$max = $data_transferred['Outstanding'];
			}

			array_push($config_validation, [
				'field' => 'bo_receive_qty[' . $row . ']',
				'label' => 'Qty',
				'rules' => ['required', 'numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[' . $max . ']'],
				'errors' => [
					'greater_than_equal_to' => '%s must be more than or equal to 0',
					'less_than_equal_to' => '%s cannot be more than ' . $max
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
				// * Condition if there are received qty
				if ($qty[$row] > 0) {
					$data_sales_order = $this->bo->M_get_sales_order([
						'master.QuoteRefNo' => $ref_no,
						'detail.Stockcode' => $value
					])->row_array();

					$data_receive = $this->bo->M_get_received([
						'Stockcode' => $value,
						'PONo' => $ref_no
					])->row_array();

					$price = $data_sales_order['ItemPrice'];

					if ($data_receive) {
						$qty_outstanding = $data_receive['QtyOutstanding'] - $qty[$row];
						$qty_received = $data_receive['QtyReceived'] + $qty[$row];
					} else {
						$qty_outstanding = $ordered[$row] - $qty[$row];
						$qty_received = $qty[$row];
					}

					// * Calculation 
					$calc_total = $price * $qty_received;
					$calc_disc_amount = ($calc_total * 0) / 100; //TODO: Check again
					$calc_item_total = $calc_total - $calc_disc_amount;
					$calc_sub_total += $calc_item_total;

					// * Check Stockreg Data
					// * Begining balance can be get from here
					$stockreg_data = $this->ds->M_get_stockreg_data([
						'Stockcode' => $value,
						'Storage' => $storage
					])->row_array();

					// * Check stocktrans data
					$stocktrans_data = $this->ds->M_get_stock_trans_data([
						'stock_code' => $value,
						'storage' => $storage
					])->row_array();

					// * Check Stock data
					$stock_data = $this->ds->M_get_stock_data([
						'Stockcode' => $value,
					])->row_array();

					$total_amount_transaction = $qty[$row] * $price;
					$tot_bal_left = $total_amount_transaction;

					if ($stocktrans_data) {
						// * Count Ending Balance
						$qty_reg = $stocktrans_data['qty_reg'] + $qty[$row];
						$tot_bal_right = $stocktrans_data['tot_bal_right'] + ($qty[$row] * $price);
						$totamount_trans_fifo = $stockreg_data['SOH'] + $qty[$row];
						$qty_bal = $qty[$row] + $stocktrans_data['qty_bal'];
						$com_val = $qty_bal == $totamount_trans_fifo ? $stocktrans_data['item_no_trans'] : 0;
						$id_fifo = $stocktrans_data['fifo_id'] + 1;
						$no_trans = $stocktrans_data['item_no_trans'] + 1;
						$total_amount_tbv = $total_amount_transaction + $stocktrans_data['total_amount_tbv'];
						$cost_price_type = $stocktrans_data['cost_price_type'];
					} else {
						// * Count Ending Balance
						$com_val = 0;
						$tot_bal_right = $qty[$row] * $price;
						$qty_reg = $stockreg_data['SOH'] + $qty[$row];
						$totamount_trans_fifo = $qty[$row];
						$qty_bal = $qty[$row] + $stockreg_data['BB_SOH'];
						$id_fifo = 1;
						$no_trans = 1;
						$total_amount_tbv = $total_amount_transaction;
						$cost_price_type = $stockreg_data['CostPriceType'];
					}

					$switch_co = $totamount_trans_fifo < 1 ? 0 : 1;
					$cost_price_right = $tot_bal_right / $qty_bal;

					array_push($data_insert_stock_trans, [
						'company_code' => $branch,
						'trans_id' => $pos_trans_id,
						'trans_date' => $received_date,
						'trans_type' => 'Receive',
						'trans_type_no' => $doc_no,
						'item_no' => $item_no[$row],
						'item_no_trans' => $no_trans,
						'total_amount_stand' => $total_amount_transaction,
						'total_amount_tbv' => $total_amount_tbv,
						'stock_code' => $value,
						'qty' => $qty[$row],
						'qty_in' => $qty[$row],
						'qty_out' => 0,
						'cost_price_stand' => $price,
						'storage' => $storage,
						'qty_bal' => $qty_bal,
						'transdate' => date('Y-m-d'),
						'tot_bal_left' => $tot_bal_left,
						'tot_bal_right' => $tot_bal_right,
						'cost_price_set' => $cost_price_right,
						'cost_price_type' => $cost_price_type,
						'switch_cost' => $switch_co,
						'cost_price_native' => $price,
						'fifo_id' => $id_fifo,
						'cost_compare' => $price,
						'cost_val' => $com_val,
						'qty_reg' => $qty_reg,
						'remain_fifo_i' => 1,
						'remain_fifo' => $totamount_trans_fifo
					]);

					// * Data Receive
					array_push($data_insert_receive, [
						'ReceiveNo' => $doc_no,
						'PONo' => $ref_no,
						'Supplier' => '',
						'SupplierDescription' => '',
						'ItemPrice' => $price,
						'Currency' => '',
						'Rate' => 0,
						'Storage' => '',
						'Bin' => '',
						'AccountCode' => 0,
						'WorkOrder' => '',
						'SupplierCode' => '', //TODO: Check Again
						'StorageCode' => $storage,
						'ItemNo' => $row + 1,
						'Stockcode' => $value,
						'StockDescription' => $stock_description[$row],
						'OrderQty' => $ordered[$row],
						'UOM' => $uom[$row],
						'QtyOutstanding' => $qty_outstanding,
						'QtyReceived' => $qty_received,
						'QtyToReceived' => $qty[$row],
						'ReceivedPrice' => $price,
						'ReceivedBy' => $received_by,
						'ReceivedDate' => $received_date,
						'ReceivedRemarks' => $remarks,
						'MRSubmitDate' => date('Y-m-d H:i:s'),
						'Receive_Status' => ''
					]);

					// * Increase Stockreg
					array_push($data_update_stockreg, [
						'CtrlNo' => $stockreg_data['CtrlNo'],
						'SOH' => $stockreg_data['SOH'] + $qty[$row],
						'SAV' => $stockreg_data['SAV'] + $qty[$row],
						'SOO' => $stockreg_data['SOO'] - $qty[$row],
						'CombineStock' => $stockreg_data['CombineStock'] + $qty[$row],
						'CostPrice' => $price
					]);

					// * Increase Stock
					array_push($data_update_stock, [
						'CtrlNo' => $stock_data['CtrlNo'],
						'SOH' => $stock_data['SOH'] + $qty[$row]
					]);
				}
			}

			$data = [
				'data_insert_receive' => $data_insert_receive,
				'data_stockreg' => $data_update_stockreg,
				'data_stock' => $data_update_stock,
				'data_stock_trans' => $data_insert_stock_trans
			];

			$result = [
				'error' => true,
				'status' => 'error',
				'message' => 'Please Contact Administrator'
			];

			$query_insert = $this->bo->M_create_receive_back_order($data);

			if ($query_insert == 'success') {
				$detail_bo_data = $this->bo->M_get_back_order_detail([
					'BONo' => $ref_no
				])->result_array();

				$transferred_data = $this->bo->M_get_back_order_transfered([
					'po.QuoteRefNo' => $ref_no,
					'po.ApprovedStatus' => 'Approved'
				])->result_array();

				$ordered = 0;
				foreach ($detail_bo_data as $row => $value) {
					$ordered += $value['Ordered'];
				}

				$received = 0;
				foreach ($transferred_data as $row => $value) {
					$received += $value['Received'];
				}

				if ($ordered - $received == 0) {
					$data_update_bo[] = [
						'BONo' => $ref_no,
						'Status' => 'Complete'
					];
					$this->bo->M_update_bo($data_update_bo);
				}

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

					$data_for_price = [
						'data_update_price' => $data_update_price,
						'data_price' => $data_price
					];
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

	public function create_back_order()
	{
		$result = null;
		$doc_no = $this->generate_bo_id();
		$reg_by = $this->session->userdata('uid');
		$branch_code = $this->session->userdata('branch');
		$reg_date = $this->input->post('bo_reg_date', true);
		$master_remarks = $this->input->post('bo_master_remarks', true);

		$book = $this->input->post('bo_book', true);
		$qty = $this->input->post('bo_qty', true);
		$detail_remarks = $this->input->post('bo_remarks', true);

		$config_validation = [
			[
				'field' => 'bo_doc_no',
				'label' => 'Document Number',
				'rules' => ['required', 'is_unique[tbl_mat_backorder.BONo]'],
				'errors' => [
					'is_unique' => 'This %s is already taken <a id="action-regenerate-id">Re-Generate</a>'
				]
			],
			[
				'field' => 'bo_reg_date',
				'label' => 'Registered Date',
				'rules' => 'required'
			]
		];

		$data_detail = [];
		$data_master = [];
		$data_update_stockreg = [];
		$data_error_stockreg = [];

		foreach ($book as $row => $value) {
			array_push($config_validation, [
				'field' => 'bo_book[' . $row . ']',
				'label' => 'Book',
				'rules' => 'required'
			]);
		}

		foreach ($qty as $row => $value) {
			array_push($config_validation, [
				'field' => 'bo_qty[' . $row . ']',
				'label' => 'Qty',
				'rules' => ['required', 'numeric', 'greater_than[0]'],
				'errors' => [
					'greater_than' => '%s must be more than 0'
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
			$data_master = [
				'BONo' => $doc_no,
				'Status' => 'Order',
				'BranchCode' => $branch_code,
				'RegDate' => $reg_date,
				'RegBy' => $reg_by,
				'Remarks' => $master_remarks
			];

			foreach ($book as $row => $value) {
				array_push($data_detail, [
					'CustomerCode' => '',
					'BONo' => $doc_no,
					'Stockcode' => $value,
					'Qty' => $qty[$row],
					'InvoiceQty' => 0,
					'OutstandingQty' => $qty[$row],
					'Status' => 'Order',
					'ApprovedBy' => null,
					'ApprovedDate' => null,
					'Remarks' => $detail_remarks[$row],
					'BranchCode' => $branch_code
				]);

				$data_stockreg = $this->bo->M_get_stockcode_data([
					'stockcode.Stockcode' => $value,
					'BranchCode' => $branch_code
				])->row_array();

				$data_stockcode = $this->bo->M_get_mat_stockcode_data([
					'Stockcode' => $value,
				])->row_array();

				if ($data_stockreg) {
					array_push($data_update_stockreg, [
						'CtrlNo' => $data_stockreg['CtrlNo'],
						'SOO' => $data_stockreg['SOO'] + $qty[$row],
						'CombineStock' => $data_stockreg['CombineStock'] + $qty[$row]
					]);
				} else {
					array_push($data_error_stockreg, [
						'Stockcode' => $data_stockcode['StockDescription'],
					]);
				}
			}

			if ($data_error_stockreg) {
				$message = '';

				foreach ($data_error_stockreg as $row => $value) {
					$message .= '<strong>' . $value['Stockcode'] . '</strong><br>';
				}
				$message .= 'These Stockcode are not registered! Please contact Administrator.';

				$result = [
					'error' => true,
					'status' => 'error',
					'message' => $message
				];
			} else {
				$data = [
					'master' => $data_master,
					'detail' => $data_detail,
					'update_stockreg' => $data_update_stockreg
				];

				$query_insert = $this->bo->M_insert_back_order($data);

				if ($query_insert == 'success') {
					$result = [
						'success' => true,
						'status' => 'success',
						'message' => 'Data Recorded!'
					];
				} else {
					$result = [
						'error' => true,
						'status' => 'error',
						'message' => 'Something went wrong! Please Contact Administrator'
					];
				}
			}
		}

		echo json_encode($result);
	}

	private function generate_bo_id()
	{
		$total = $this->bo->M_count_bo()->num_rows();
		$total++;

		// $last_digit = sprintf('%03d', $total);
		$last_digit = random_word(4);
		$doc_no = 'BO-' . date('ym') . '-' . $last_digit;

		return $doc_no;
	}

	private function generate_receive_bo_id()
	{
		$last_digit = random_word(4);
		$doc_no = 'MR-' . date('ym') . '-' . $last_digit;

		return $doc_no;
	}

	public function regenerate_bo_id()
	{
		echo $this->generate_bo_id();
	}
}
