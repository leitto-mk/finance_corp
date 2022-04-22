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

	/******************************************************************************
	 ** PAGE
	 *****************************************************************************/
	public function index(){
		$title = 'Invoice Module';

		$component_data = [
			'title' => 'Dashboard',

			//Cards
			'approved' => $this->db->select()->get_where('tbl_fa_invoice_mas', ['ApprovedStatus' => 1])->num_rows(),
			'declined' => $this->db->select()->get_where('tbl_fa_invoice_mas', ['ApprovedStatus' => -1])->num_rows(),
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

			//Master select options
			'customers' => $this->Mdl_corp_common->get_customer(),
			'storages' => $this->Mdl_corp_common->get_storage(),
			'branches' => $this->Mdl_corp_common->get_branch(),

			//List select options
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

	/******************************************************************************
	 ** API
	 *****************************************************************************/
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

		//Append only AccNo with intended TransGroup
		$trans_group = $this->input->get('transgroup');
		$invoice_acc = [];
		for($i = 0; $i < count($result); $i++){
			if(strtolower($result[$i]['TransGroup']) === strtolower($trans_group)){
				array_push($invoice_acc, $result[$i]);
			}
		}

		return set_success_response($invoice_acc);
	}

	public function submit(){
		$formData = $this->input->post();

		$validation = validate(
            $formData,
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

		$mas = $det = $trans = [];
		$vat_amount = $inventory_amount = $service_amount = 0;

		//Re-Calculate Row Total & Payment Detail
		$this->_calculate_payment($formData);

		//INVOICE MASTER
		$mas = [
			//Detail
			'InvoiceNo' => $formData['invoice_no'],
			'CustomerCode' => $formData['customer'],
			'QuoteRefNo' => ($formData['reference_no'] == '' ? $formData['invoice_no'] : $formData['reference_no']),
			'Remark' => $formData['remark'],

			//Bill & Shipping
			'BillTo' => $formData['bill_to'],
			'ShipTo' => $formData['ship_to'],
			'Storage' => $formData['storage'],
			'Freight' => $formData['freight'],
			'FreightInfo' => $formData['freight_info'],
			'Ship_Via_Air' => isset($formData['ship_via_air']) ? ($formData['ship_via_air'] == 'on' ? 1 : 0) : 0,
			'Ship_Via_Sea' => isset($formData['ship_via_sea']) ? ($formData['ship_via_sea'] == 'on' ? 1 : 0) : 0,
			'Ship_Via_Land' => isset($formData['ship_via_land']) ? ($formData['ship_via_land'] == 'on' ? 1 : 0) : 0,

			//Branch
			'Branch' => $formData['branch'],
			'RefDocNo' => $formData['ref_docno'],
			'RaisedBy' => 'ADMIN',
			'RaisedDate' => $formData['raised_date'],
			'DueDate' => $formData['due_date'],
			'TermsOfDays' => $formData['term_days'],
			'ContractNo' => $formData['contract_no'],
			'SalesResp' => $formData['sales_resp'],

			//Payment Details
			'SubTotal' => $formData['payment_sub_total'],
			'SubTotalAcc' => str_replace('\'','', $formData['payment_sub_total_accno']), //Remove quotes
			'TotalDiscount' => $formData['payment_discount'],
			'TotalDiscountAcc' => str_replace('\'','', $formData['payment_discount_accno']), //Remove quotes
			'NetSubTotal' => $formData['payment_net_subtotal'],
			'VATAmount' => $formData['payment_vat_amount'],
			'PPH' => $formData['payment_pph'],
			'PPHAcc' => str_replace('\'','', $formData['payment_pph_accno']), //Remove quotes
			'FreightCost' => $formData['payment_freight'],
			'FreightCostAcc' => str_replace('\'','', $formData['payment_freight_accno']), //Remove quotes
			'TotalAmount' => $formData['payment_total_amount'],
			'TotalAmountAcc' => str_replace('\'','', $formData['payment_total_amount_accno']), //Remove quotes
			'PaymentType' => $formData['dp_payment_type'],
			'CardNo' => $formData['dp_payment_card_text'] ?? null,
			'BankCode' => $formData['dp_payment_bank'] ?? null,
			'Payment' => $formData['payment_total'],
			'PaymentStatus' => ($formData['payment_total'] === $formData['payment_total_amount'] ? 1 : 0),
			'Balance' => ((float)$formData['payment_total_amount'] - (float) $formData['payment_total'])
		];

		//INVOICE DETAIL
		for($i = 0; $i < count($formData['stockcode']); $i++){
			array_push($det, [
				'InvoiceNo' => $formData['invoice_no'],
				'StockCode' => $formData['stockcode'][$i],
				'OrderRemark' => $formData['order_remark'][$i],
				'UOM' => $formData['uom'][$i],
				'Currency' => $formData['currency'][$i],
				'Qty' => $formData['qty'][$i],
				'Price' => $formData['price'][$i],
				'Discount' => $formData['discount'][$i],
				'Total' => $formData['total'][$i]
			]);
		}

		//TRANSACTION (LEDGER)
		$this->_set_ledger_data($formData, 'payment_sub_total', $formData['payment_sub_total_accno'], $trans);
		$this->_set_ledger_data($formData, 'payment_discount', $formData['payment_discount_accno'], $trans);
		$this->_set_ledger_data($formData, 'payment_pph', $formData['payment_pph_accno'], $trans);
		$this->_set_ledger_data($formData, 'payment_freight', $formData['payment_freight_accno'], $trans);
		$this->_set_ledger_data($formData, 'payment_total_amount', $formData['payment_total_amount_accno'], $trans);

		//SET INVENTORY & COGS TO LEDGER
		$this->_set_ledger_data($formData, 'inventory_amount', 11501, $trans);
		$this->_set_ledger_data($formData, 'cogs_amount', 51101, $trans);

		//DELETE OLD DATA IF EXIST
		$error = $this->Mdl_corp_invoice->delete_invoice($formData['invoice_no']);
		if(!is_null($error)){
			return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
		}

		//SUBMIT INVOICE MASTER, INVOICE DETAIL, TRANSACTION LEDGER
		try {
			$this->Mdl_corp_invoice->submit_invoice($mas, $det, $trans);
		} catch (Exception $e) {
			return set_error_response(self::HTTP_INTERNAL_ERROR, $e->getMessage());
		}
		
		$invoice_date = $formData['raised_date'];
		$last_transaction = $this->Mdl_corp_common->get_last_trans_date();
		if (strtotime($invoice_date) < strtotime($last_transaction)) {
            $start = $invoice_date;
            $finish = $last_transaction;
        } else {
            $start = $last_transaction;
            $finish = $invoice_date;
        }

        //CALCULATE BALANCE FROM CURRENT TRANSDATE TO HIGHEST TRANSDATE
        [$result, $error] = $this->Mdl_corp_entry->recalculate_branch($formData['branch'], 10000, 99999, $start, $finish);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

		//CALCULATE EMPLOYEE BALANCE ABOVE TRANSDATE
        $error = $this->Mdl_corp_cash_advance->update_emp_balance($invoice_date, $formData['customer']);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        //CALCULATE RETAINING EARNING
        $error = $this->Mdl_corp_common->calculate_retaining_earnings($formData['branch'], $invoice_date);
        if (!is_null($error)) {
            return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
        }

        return set_success_response($result);
	}

	public function approve(){
		$list = [];
		$invoices = $this->input->post('invoice');
		for($i=0; $i < count($invoices); $i++){
			array_push($list, $invoices[$i]);
		}

		try{
			$this->Mdl_corp_invoice->set_approval('approve', $list);
		}catch(Exception $e){
			return set_error_response(self::HTTP_INTERNAL_ERROR, $e->getMessage());
		}

		return set_success_response("Approved");
	}
	
	public function decline(){
		$list = [];
		$invoices = $this->input->post('invoice');
		for($i=0; $i < count($invoices); $i++){
			array_push($list, $invoices[$i]);
		}

		try{
			$this->Mdl_corp_invoice->set_approval('decline', $list);
		}catch(Exception $e){
			return set_error_response(self::HTTP_INTERNAL_ERROR, $e->getMessage());
		}

		return set_success_response("Decline");
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
		$validation = validate($this->input->get(),[
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

		$branch = $input->get('branch');
		$customer = $input->get('customer');
		$ageby = $input->get('ageby') == 'raised_date' ? 'RaisedDate' : 'DueDate';
		$start = $input->get('date_start');

		try {
			[$summary, $q1, $q2, $q3, $q4] = $this->Mdl_corp_invoice->get_invoice_aging($branch, $customer, $ageby, $start);
			
			$result = [
				'summary' => $summary,
				'q1' => $q1,
				'q2' => $q2,
				'q3' => $q3,
				'q4' => $q4
			];
	
			return set_success_response($result);
		} catch (Exception $e) {
			return set_error_response(self::HTTP_INTERNAL_ERROR, $e->getMessage());
		}

	}

	/******************************************************************************
	 ** CALLABLE
	 *****************************************************************************/

	/**
	 * Calculate all payment on before submit to Database
	 * 
	 * @param 	array 	$formData using `POST` method, pass the reference instead of value
	 * 
	 * @return 	void
	 */
	protected function _calculate_payment(&$formData){
		$subtotal = $inventory_amount = $service_amount = $vat_amount = 0;

		//Order List
		for($i = 0; $i < count($formData['stockcode']); $i++){
			$qty = (float) $formData['qty'][$i];
			$price = (float) $formData['price'][$i];
			$discount = (float) $formData['discount'][$i] / 100;
			$total = $qty * $price;
			$total = $total - ($total * $discount);

			$formData['total'][$i] = (float) $total;

			$subtotal += $total;

			//Calculate VAT
			try{
				$stock_reg = $this->db->select('CostPrice, VAT, VATInclusive, InvType')->get_where('tbl_mat_stock_reg', ['Stockcode' => $formData['stockcode'][$i]]);
				$stock_reg = $stock_reg->row();
			}catch (Exception $e) {
				return set_error_response(self::HTTP_INTERNAL_ERROR, $e->getMessage());
			}

			//Calculate Inventory/COGS
			$costPrice = $stock_reg->CostPrice;
			$inventory_amount += $formData['qty'][$i] * $costPrice;
			$service_amount += $formData['qty'][$i] * $costPrice;

			$VAT = (float) ($stock_reg->VAT);
			$VATInclusive = strtolower($stock_reg->VATInclusive);

			if($VATInclusive === 'no'){
				$vat_amount += ($total * ($VAT / 100));
			}else{
				$vat_amount += ($total * (100 / (100 + $VAT)) * ($VAT / 100));
			}
		}

		//Payment Detail
		$formData['payment_sub_total'] = (float) $subtotal;
		$payment_discount = (float) $formData['payment_discount'] / 100;
		$formData['payment_net_subtotal'] = (float) ($subtotal - ($subtotal * $payment_discount));
		$net_subtotal = (float) $formData['payment_net_subtotal'];
		$formData['payment_vat_amount'] = $vat_amount;
		$pph = $net_subtotal * ($formData['payment_pph'] / 100);
		$freight = (float) $formData['payment_freight'];
		$formData['payment_total_amount'] = (float) ($net_subtotal + $vat_amount + $freight) - $pph;

		//Push VAT & Invetory to Trans
		$formData['inventory_amount'] = $inventory_amount;
		$formData['cogs_amount'] = $service_amount;
	}

	/**
	 * Generate Ledger Data
	 * 
	 * @param 	array 	$postData using `POST` method
	 * @param	string	$payment_type (subtotal, discount, pph, freight, total amount & inventory/cogs)
	 * @param  	string	$cur_accno AccountNo of $payment_type
	 * @param 	array	$trans for submit to Ledger, pass the reference instead of value
	 * 
	 * @return 	void
	 */
	protected function _set_ledger_data($postData, $payment_type, $cur_accno, &$trans){
		$cur_accno = str_replace("'", '', $cur_accno);
		$cur_accno = str_replace("\\", '', $cur_accno);
		$debit = 0;
		$credit = 0;
		$branch_beg_bal = 0;
		$branch_bal = 0;

		//Get Account Type
		$cur_acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $cur_accno]);
		if($cur_acctype->num_rows() == 0){
			return;
		}
		$cur_acctype = $cur_acctype->row()->Acc_Type;

		//Set Debit/Credit
		switch ($payment_type) {
			case 'payment_sub_total':
				$credit = (float) $postData['payment_sub_total'];
				break;
			case 'payment_discount':
				$debit = (float) ($postData['payment_discount'] / 100);
				$debit = (float) ($postData['payment_sub_total'] * $debit);
				$debit = (float) ($postData['payment_sub_total'] - $debit);
				break;
			case 'payment_vat':
				$credit = (float) ($postData['payment_vat'] / 100);
				$credit = (float) ($postData['payment_net_subtotal'] * $credit);
				$credit = (float) ($postData['payment_net_subtotal'] - $credit);
				break;
			case 'payment_pph':
				$debit = (float) ($postData['payment_pph'] / 100);
				$debit = (float) ($postData['payment_net_subtotal'] * $debit);
				$debit = (float) ($postData['payment_net_subtotal'] - $debit);
				break;
			case 'payment_freight':
				$credit = (float) $postData['payment_freight'];
				break;
			case 'payment_total_amount':
				$debit = (float) $postData['payment_total_amount'];
				break;
			case 'inventory_amount':
				$credit = (float) $postData['inventory_amount'];
				break;
			case 'cogs_amount':
				$debit = (float) $postData['cogs_amount'];
				break;
		}
			
		//Get Branch Beginning Balance
		$branch_beg_bal = (float) $this->Mdl_corp_entry->get_branch_last_balance($postData['branch'], $cur_accno, $postData['raised_date']);

		//Set Current Branch Beginning Balance
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
		
		//Push New Ledger Data
		array_push($trans, [
			'DocNo' => $postData['invoice_no'],
			'RefNo' => ($postData['reference_no'] == '' ? $postData['invoice_no'] : $postData['reference_no']),
			'TransDate' => $postData['raised_date'],
			'TransType' => 'INV',
			'Branch' => $postData['branch'],
			'ItemNo' => 0,
			'AccNo' => $cur_accno,
			'AccType' => $cur_acctype,
			'IDNumber' => $postData['customer'],
			'Currency' => 'IDR',
			'Rate' => 1,
			'Unit' => $postData['payment_total_amount'],
			'Amount' => $postData['payment_total_amount'],
			'Debit' => $debit,
			'Credit' => $credit,
			'Balance' => 0,
			'BalanceBranch' => $branch_bal,
			'Remarks' => $postData['remark'],
			'EntryBy' => '',
			'EntryDate' => date('Y-m-d h:m:s')
		]);
	}
}