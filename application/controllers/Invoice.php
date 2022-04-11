<?php defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Makassar');

class Invoice extends CI_Controller
{
	/**
     * Common HTTP status codes and their respective description.
     *
     * @link http://www.restapitutorial.com/httpstatuscodes.html
     */
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_INTERNAL_ERROR = 500;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper([
            'response',
            'validate'
        ]);

		$this->load->model('Mdl_corp_invoice');
		$this->load->model('Mdl_corp_common');
		$this->load->model('Mdl_corp_entry');
		$this->load->model('Mdl_corp_cash_advance');
	}

	protected function _calculate_payment($formData){
		$subtotal = 0;

		for($i = 0; $i < count($formData['stockcode']); $i++){
			$qty = (float) $formData['qty'][$i];
			$price = (float) $formData['price'][$i];
			$discount = (float) $formData['discount'][$i] / 100;
			$total = $qty * $price;
			$total = $total - ($total * $discount);

			$formData['total'][$i] = (float) $total;

			$subtotal += $total;
		}

		$formData['payment_sub_total'] = (float) $subtotal;
		$payment_discount = (float) $formData['payment_discount'];
		$formData['payment_net_subtotal'] = (float) $subtotal - ($subtotal * $payment_discount);
		$net_subtotal = (float) $formData['payment_net_subtotal'];
		$vat = $net_subtotal * ($formData['payment_vat'] / 100);
		$pph = $net_subtotal * ($formData['payment_pph'] / 100);
		$freight = (float) $formData['payment_freight'];
		$formData['payment_total_amount'] = (float) ($net_subtotal + $vat - $pph + $freight);
	}

	protected function _set_ledger_data($data, $payment_type, $cur_accno, &$trans){
		$cur_accno = str_replace("'", '', $cur_accno);
		$cur_accno = str_replace("\\", '', $cur_accno);
		$debit = 0;
		$credit = 0;
		$branch_beg_bal = 0;
		$branch_bal = 0;

		$cur_acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $cur_accno]);
		if($cur_acctype->num_rows() == 0){
			return;
		}

		$cur_acctype = $cur_acctype->row()->Acc_Type;

		switch ($payment_type) {
			case 'payment_sub_total':
				$credit = (float) $data->post('payment_sub_total');
				break;
			case 'payment_discount':
				$debit = (float) ($data->post('payment_discount') / 100);
				$debit = (float) ($data->post('payment_sub_total') * $debit);
				$debit = (float) ($data->post('payment_sub_total') - $debit);
				break;
			case 'payment_vat':
				$credit = (float) ($data->post('payment_vat') / 100);
				$credit = (float) ($data->post('payment_net_subtotal') * $credit);
				$credit = (float) ($data->post('payment_net_subtotal') - $credit);
				break;
			case 'payment_pph':
				$debit = (float) ($data->post('payment_pph') / 100);
				$debit = (float) ($data->post('payment_net_subtotal') * $debit);
				$debit = (float) ($data->post('payment_net_subtotal') - $debit);
				break;
			case 'payment_freight':
				$credit = (float) $data->post('payment_freight');
				break;
			case 'payment_total_amount':
				$debit = (float) $data->post('payment_total_amount');
				break;
		}
			
		$branch_beg_bal = (float) $this->Mdl_corp_entry->get_branch_last_balance($data->post('branch'), $cur_accno, $data->post('raised_date'));

		if ($cur_acctype == 'A' || $cur_acctype == 'E' || $cur_acctype == 'E1') {
			/**
			 * (BEGINNING BALANCE + DEBIT) - CREDIT
			 */
			$branch_bal = ($branch_beg_bal + $debit) - $credit;
		} elseif ($cur_acctype == 'L' || $cur_acctype == 'C' || $cur_acctype == 'R' || $cur_acctype == 'A1' || $cur_acctype == 'R1' || $cur_acctype == 'C1' || $cur_acctype == 'C2' || $cur_acctype == 'CX') {
			/**
			 * (BEGINNING BALANCE - DEBIT) + CREDIT
			 */
			$branch_bal = ($branch_beg_bal - $debit) + $credit;
		}
		
		array_push($trans, [
			'DocNo' => $data->post('invoice_no'),
			'RefNo' => ($data->post('reference_no') == '' ? $data->post('invoice_no') : $data->post('reference_no')),
			'TransDate' => $data->post('raised_date'),
			'TransType' => 'INV',
			'Branch' => $data->post('branch'),
			'ItemNo' => 0,
			'AccNo' => $cur_accno,
			'AccType' => $cur_acctype,
			'IDNumber' => $data->post('customer'),
			'Currency' => 'IDR',
			'Rate' => 1,
			'Unit' => $data->post('payment_total_amount'),
			'Amount' => $data->post('payment_total_amount'),
			'Debit' => $debit,
			'Credit' => $credit,
			'Balance' => 0,
			'BalanceBranch' => $branch_bal,
			'Remarks' => $data->post('remark'),
			'EntryBy' => '',
			'EntryDate' => date('Y-m-d h:m:s')
		]);
	}

	public function index(){
		$title = 'Invoice Module';

		$component_data = [
			'title' => 'Dashboard',

			//Cards
			'waiting' => $this->db->select()->get_where('tbl_fa_invoice_mas', ['ApprovedStatus' => 0])->num_rows(),
			'approved' => $this->db->select()->get_where('tbl_fa_invoice_mas', ['ApprovedStatus' => 1])->num_rows(),
			'paid' => $this->db->select()->get_where('tbl_fa_invoice_mas', ['PaymentStatus' => 1])->num_rows(),
			'unpaid' => $this->db->select()->get_where('tbl_fa_invoice_mas', ['PaymentStatus' => 0])->num_rows(),
		];

		$content = $this->load->view('financecorp/ar/invoice/content/dashboard', $component_data, true);

		$data = [
			'title' => $title,
			'content' => $content,
			'script' => 'invoice',
		];

		$this->load->view('financecorp/ar/invoice/layout/main', $data);
	}

	public function new(){
		try{
			$content_data = [
				'title' => 'Create Invoice',
	
				//Master
				'invoice_no' => $this->Mdl_corp_invoice->generate_invoice(),
				'customer' => $this->Mdl_corp_common->get_customer(),
				'storage' => $this->Mdl_corp_common->get_storage(),
				'raised_by' => 'ABASE-ADMIN',
	
				//List
				'stockcode' => $this->Mdl_corp_common->get_stockcode(),
				'currency' => $this->Mdl_corp_common->get_currency(),
	
				//Payment Detail
				'branch' => $this->Mdl_corp_common->get_branch(),
				'accno' => $this->Mdl_corp_common->get_mas_acc()
			];
		}catch(Exception $e){
			return $this->load->view('errors/html/error_general', ['url' => base_url('Invoice')]);
		}

		$content = $this->load->view('financecorp/ar/invoice/content/new_invoice', $content_data, TRUE);

		$data = [
			'form' => $content,
			'script' => 'invoice'
		];

		$this->load->view('financecorp/ar/invoice/layout/header_footer_form', $data);
	}
	
	public function edit($invoice){
		try {
			$invoice_data = $this->Mdl_corp_invoice->get_invoice($invoice);
		}catch(Exception $e){
			return $this->load->view('errors/html/error_general', ['url' => base_url('Invoice')]);
		}

		$component_data = [
			'title' => "INVOICE $invoice",

			//Master
			'customers' => $this->Mdl_corp_common->get_customer(),
			'storages' => $this->Mdl_corp_common->get_storage(),
			'branches' => $this->Mdl_corp_common->get_branch(),

			//List
			'stockcodes' => $this->Mdl_corp_common->get_stockcode(),
			'currencies' => $this->Mdl_corp_common->get_currency(),

			//Invoice Data
			'data' => $invoice_data,
		];

		$component = $this->load->view('financecorp/ar/invoice/content/edit_invoice', $component_data, TRUE);

		$data = [
			'form' => $component,
			'script' => 'invoice'
		];

		$this->load->view('financecorp/ar/invoice/layout/header_footer_form', $data);
	}

	public function list(){

		$data_view = [
			'title' => 'List Invoice',

			'customer' => $this->Mdl_corp_common->get_customer()
		];

		$content = $this->load->view('financecorp/ar/invoice/content/v_invoice_list', $data_view, true);

		$data = [
			'title' => 'Invoice List',
			'content' => $content,
			'script' => 'invoice'
		];

		$this->load->view('financecorp/ar/invoice/layout/main', $data);
	}

	public function aging(){
		$data = [
			'title' => 'Invoice Aging',
			'h1' => 'Invoice',
			'h2' => 'Aging',
			'h3' => '',
			'h4' => '',
			
			'company' => $this->Mdl_corp_cash_advance->get_company(),
			'branch' => $this->Mdl_corp_common->get_branch(),
			'customer' => $this->Mdl_corp_common->get_customer(),

			'script' => 'invoice'
		];
        
        $this->load->view('financecorp/ar/invoice/content/v_invoice_aging', $data);
    }

	public function get(){
		$input = $this->input;

		$customer = $input->get('customer') ?? null;
		$start = $input->get('date_start') ?? null;
		$finish = $input->get('date_finish') ?? null;
		$limit = $input->get('length');
		$offset = $input->get('start');

		try {
			$result = $this->Mdl_corp_invoice->get_invoices($customer, $start, $finish, $limit, $offset);
		} catch (Exception $e) {
			return set_error_response(self::HTTP_INTERNAL_ERROR, $e->getMessage());
		}

		return set_success_response($result);
	}

	public function get_accno(){
		try{
			$result = $this->Mdl_corp_common->get_mas_acc();
		}catch(Exception $e){
			return set_error_response(self::HTTP_INTERNAL_ERROR, $e->getMessage());
		}

		return set_success_response($result);
	}

	public function submit(){
		$input = $this->input;

		$validation = validate(
            $input->post(),
            [ //Specific Case
                'date' => ['raised_date', 'due_date'],
                'number' => ['qty', 'price', 'total', 'payment_sub_total', 'payment_net_subtotal', 'payment_total_amount']
            ],
            [ //Ignore
                'remark',
                'freight_info',
				'sales_resp',
				'payment_discount_accno',
				'payment_vat_accno',
				'payment_vat_inclusive',
				'payment_pph_accno',
				'payment_freight_accno',
				'dp_payment_card_text',
				'dp_payment_total',
				'payment_total'
            ]
        );

		if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

		//Re-Calculate Row Total & Payment Detail
		$formData = $input->post();
		$this->_calculate_payment($formData);

		$mas = $det = $trans = [];
		
		//INVOICE MASTER
		$mas = [
			//Detail
			'InvoiceNo' => $input->post('invoice_no'),
			'CustomerCode' => $input->post('customer'),
			'QuoteRefNo' => ($input->post('reference_no') == '' ? $input->post('invoice_no') : $input->post('reference_no')),
			'Remark' => $input->post('remark'),

			//Bill & Shipping
			'BillTo' => $input->post('bill_to'),
			'ShipTo' => $input->post('ship_to'),
			'Storage' => $input->post('storage'),
			'Freight' => $input->post('freight'),
			'FreightInfo' => $input->post('freight_info'),
			'Ship_Via_Air' => $input->post('ship_via_air') == 'on' ? 1 : 0,
			'Ship_Via_Sea' => $input->post('ship_via_sea') == 'on' ? 1 : 0,
			'Ship_Via_Land' => $input->post('ship_via_land') == 'on' ? 1 : 0,

			//Branch
			'Branch' => $input->post('branch'),
			'RefDocNo' => $input->post('ref_docno'),
			'RaisedBy' => 'ADMIN',
			'RaisedDate' => $input->post('raised_date'),
			'DueDate' => $input->post('due_date'),
			'TermsOfDays' => $input->post('term_days'),
			'ContractNo' => $input->post('contract_no'),
			'SalesResp' => $input->post('sales_resp'),

			//Payment Details
			'SubTotal' => $input->post('payment_sub_total'),
			'SubTotalAcc' => $input->post('payment_sub_total_accno'),
			'TotalDiscount' => $input->post('payment_discount'),
			'TotalDiscountAcc' => $input->post('payment_discount_accno'),
			'NetSubTotal' => $input->post('payment_net_subtotal'),
			'VATInclusive' => $input->post('payment_vat_inclusive') == 'on' ? 1 : 0,
			'VAT' => $input->post('payment_vat'),
			'VATAcc' => $input->post('payment_vat_accno'),
			'PPH' => $input->post('payment_pph'),
			'PPHAcc' => $input->post('payment_pph_accno'),
			'FreightCost' => $input->post('payment_freight'),
			'FreightCostAcc' => $input->post('payment_freight_accno'),
			'TotalAmount' => $input->post('payment_total_amount'),
			'TotalAmountAcc' => $input->post('payment_total_amount_accno'),
			'PaymentType' => $input->post('dp_payment_type'),
			'CardNo' => $input->post('dp_payment_card_text'),
			'BankCode' => $input->post('dp_payment_bank'),
			'Payment' => $input->post('payment_total'),
			'PaymentStatus' => ($input->post('payment_total') === $input->post('payment_total_amount') ? 1 : 0),
			'Balance' => ((float)$input->post('payment_total_amount') - (float) $input->post('payment_total'))
		];

		//INVOICE DETAIL
		for($i = 0; $i < count($input->post('stockcode')); $i++){
			array_push($det, [
				'InvoiceNo' => $input->post('invoice_no'),
				'StockCode' => $input->post('stockcode')[$i],
				'OrderRemark' => $input->post('order_remark')[$i],
				'UOM' => $input->post('uom')[$i],
				'Currency' => $input->post('currency')[$i],
				'Qty' => $input->post('qty')[$i],
				'Price' => $input->post('price')[$i],
				'Discount' => $input->post('discount')[$i],
				'Total' => $input->post('total')[$i]
			]);
		}

		//TRANSACTION (LEDGER)
		$this->_set_ledger_data($input, 'payment_sub_total', $input->post('payment_sub_total_accno'), $trans);
		$this->_set_ledger_data($input, 'payment_discount', $input->post('payment_discount_accno'), $trans);
		$this->_set_ledger_data($input, 'payment_vat', $input->post('payment_vat_accno'), $trans);
		$this->_set_ledger_data($input, 'payment_pph', $input->post('payment_pph_accno'), $trans);
		$this->_set_ledger_data($input, 'payment_freight', $input->post('payment_freight_accno'), $trans);
		$this->_set_ledger_data($input, 'payment_total_amount', $input->post('payment_total_amount_accno'), $trans);

		//DELETE OLD DATA IF EXIST
		$error = $this->Mdl_corp_invoice->delete_invoice($input->post('invoice_no'));
		if(!is_null($error)){
			return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
		}

		//SUBMIT INVOICE MASTER, INVOICE DETAIL, TRANSACTION LEDGER
		try {
			$this->Mdl_corp_invoice->submit_invoice($mas, $det, $trans);
		} catch (Exception $e) {
			return set_error_response(self::HTTP_INTERNAL_ERROR, $e->getMessage());
		}
		
		$invoice_date = $input->post('raised_date');
		$last_transaction = $this->Mdl_corp_common->get_last_trans_date();
		if (strtotime($invoice_date) < strtotime($last_transaction)) {
            $start = $invoice_date;
            $finish = $last_transaction;
        } else {
            $start = $last_transaction;
            $finish = $invoice_date;
        }

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        [$result, $error] = $this->Mdl_corp_entry->recalculate_branch($input->post('branch'), $input->post('accno'), $input->post('accno'), $start, $finish);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

		//CALCULATE EMPLOYEE BALANCE ABOVE TRANSDATE
        $error = $this->Mdl_corp_cash_advance->update_emp_balance($invoice_date, $input->post('customer'));
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING
        $error = $this->Mdl_corp_common->calculate_retaining_earnings($input->post('branch'), $invoice_date);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
	}

	public function delete(){
		$validation = validate($this->input->post(),null,null);
		
		if(!$validation) {
			return set_error_response(self::HTTP_BAD_REQUEST, $validation);
		}

		$invoice = $this->input->post('invoice');

		try{
			$this->Mdl_corp_invoice->delete_invoice($invoice);
		}catch(Exception $e){
			return set_error_response(self::HTTP_INTERNAL_ERROR, $e->getMessage());
		}

		return set_success_response("$invoice has been deleted");
	}

	public function get_aging(){
		$validation = validate($this->input->post(),[
			[ //Specific Case
				'date' => ['date_start'],
				'number' => [],
			],
			[ //Ignore
				'branch',
				'customer'
			]
		]);

		if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

		$input = $this->input;

		$branch = $input->post('branch');
		$customer = $input->post('customer');
		$ageby = $input->post('ageby') == 'raised_date' ? 'RaisedDate' : 'DueDate';
		$start = $input->post('date_start');

		try {
			[$summary, $q1, $q2, $q3, $q4] = $this->Mdl_corp_invoice->get_invoice_aging($branch, $customer, $ageby, $start);
			
			$result = [
				'summary' => $summary,
				'q1' => $q1,
				'q1' => $q2,
				'q1' => $q3,
				'q1' => $q4
			];
	
			return set_success_response($result);
		} catch (Exception $e) {
			return set_error_response(self::HTTP_INTERNAL_ERROR, $e->getMessage());
		}

	}
}