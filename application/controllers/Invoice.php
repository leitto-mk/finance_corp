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
	}

	public function index()
	{
		$title = 'Invoice Module';

		$data_view = [
			'title' => 'Dashboard'
		];

		$content = $this->load->view('financecorp/ar/invoice/content/dashboard', $data_view, true);

		$data = [
			'title' => $title,
			'content' => $content,
			'script' => 'invoice',
		];

		$this->load->view('financecorp/ar/invoice/layout/main', $data);
	}

	public function get(){
		$input = $this->input;
		$limit = $input->get('length');
		$offset = $input->get('start');

		[$result, $error] = $this->Mdl_corp_invoice->get_invoices($limit, $offset);
		if(!is_null($error)){
			return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
		}

		$dt = [
            'draw' => $input->get('draw'),
            'data' => $result
        ];

		return set_success_response($dt);
	}

	public function new()
	{
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

		$content = $this->load->view('financecorp/ar/invoice/content/new_invoice', $content_data, TRUE);

		$data = [
			'form' => $content,
			'script' => 'invoice'
		];

		$this->load->view('financecorp/ar/invoice/layout/header_footer_form', $data);
	}

	public function submit(){
		$validation = validate(
            $this->input->post(),
            [ //Specific Case
                'date' => ['raised_date', 'due_date'],
                'number' => ['qty', 'price', 'total', 'payment_sub_total', 'payment_net_subtotal', 'payment_total_amount']
            ],
            [ //Ignore
                'remark',
                'freight_info',
				'dp_payment_card_text',
				'dp_payment_total',
				'payment_total'
            ]
        );

		if (!$validation) {
            return set_error_response(self::HTTP_BAD_REQUEST, $validation);
        }

		$input = $this->input;
		$mas = $det = $trans = [];
		$acctype = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $input->post('accno')])->row()->Acc_Type;

		//INVOICE MASTER
		$mas = [
			'InvoiceNo' => $input->post('invoice_no'),
			'CustomerCode' => $input->post('customer'),
			'QuoteRefNo' => ($input->post('reference_no') == '' ? $input->post('reference_no') : $input->post('reference_no')),
			'Remark' => $input->post('remark'),
			'BillTo' => $input->post('bill_to'),
			'ShipTo' => $input->post('ship_to'),
			'Storage' => $input->post('storage'),
			'Freight' => $input->post('freight'),
			'FreightInfo' => $input->post('freight_info'),
			'Ship_Via_Air' => $input->post('ship_via_air') == 'on' ? 1 : 0,
			'Ship_Via_Sea' => $input->post('ship_via_sea') == 'on' ? 1 : 0,
			'Ship_Via_Land' => $input->post('ship_via_land') == 'on' ? 1 : 0,
			'RaisedBy' => $input->post('raised_by'),
			'RaisedDate' => $input->post('raised_date'),
			'TermsOfDays' => $input->post('term_days'),
			'DueDate' => $input->post('due_date'),
			'Branch' => $input->post('branch'),
			'AccNo' => $input->post('accno'),
			'SubTotal' => $input->post('payment_sub_total'),
			'TotalDiscount' => $input->post('payment_discount'),
			'NetSubTotal' => $input->post('payment_net_subtotal'),
			'VAT' => $input->post('payment_vat'),
			'PPH' => $input->post('payment_pph'),
			'FreightCost' => $input->post('payment_freight'),
			'TotalAmount' => $input->post('payment_total_amount'),
			'PaymentType' => $input->post('dp_payment_type'),
			'CardNo' => $input->post('dp_payment_card_text'),
			'BankCode' => $input->post('dp_payment_bank'),
			'Payment' => $input->post('payment_total')
		];

		//INVOICE DETAIL
		for($i = 0; $i < count($input->post('stockcode')); $i++){
			array_push($det, [
				'InvoiceNo' => $input->post('invoice_no'),
				'StockCode' => $input->post('stockcode')[$i],
				'UOM' => $input->post('uom')[$i],
				'Currency' => $input->post('currency')[$i],
				'Qty' => $input->post('qty')[$i],
				'Price' => $input->post('price')[$i],
				'Discount' => $input->post('discount')[$i],
				'Total' => $input->post('total')[$i]
			]);
		}

		//TRANSACTION (GENERAL LEDGER)
		$branch_beg_bal = $this->Mdl_corp_common->get_branch_last_balance($input->post('branch'), $input->post('accno'), $input->post('raised_date'));

		if ($acctype == 'A' || $acctype == 'E' || $acctype == 'E1') {
			/**
			 * (BEGINNING BALANCE + DEBIT) - CREDIT
			 */
			$branch_bal = ($branch_beg_bal + $input->post('payment_total_amount')) - 0;
		} elseif ($acctype == 'L' || $acctype == 'C' || $acctype == 'R' || $acctype == 'A1' || $acctype == 'R1' || $acctype == 'C1' || $acctype == 'C2' || $acctype == 'CX') {
			/**
			 * (BEGINNING BALANCE - DEBIT) + CREDIT
			 */
			$branch_bal = ($branch_beg_bal - $input->post('payment_total_amount')) + 0;
		}

		$trans = [
			'DocNo' => $input->post('invoice_no'),
			'RefNo' => ($input->post('reference_no') == '' ? $input->post('reference_no') : $input->post('reference_no')),
			'TransDate' => $input->post('raised_date'),
			'TransType' => 'INV',
			'Branch' => $input->post('branch'),
			'ItemNo' => 0,
			'AccNo' => $input->post('accno'),
			'AccType' => $acctype,
			'Currency' => 'IDR',
			'Rate' => 1,
			'Unit' => $input->post('payment_total_amount'),
			'Amount' => $input->post('payment_total_amount'),
			'Debit' => $input->post('payment_total_amount'),
			'Credit' => 0,
			'Balance' => 0,
			'BalanceBranch' => $branch_bal,
			'Remarks' => $input->post('remark'),
			'EntryBy' => $input->post('raised_by'),
			'EntryDate' => date('Y-m-d h:m:s')
		];

		//SUBMIT INVOICE MASTER, INVOICE DETAIL, TRANSACTION LEDGER
		$error = $this->Mdl_corp_invoice->submit_invoice($mas, $det, $trans);
		if(!is_null($error)){
			return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
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
        [$result, $error] = $this->Mdl_corp_entry->recalculate_branch($input->post('branch'), min($input->post('accno')), max($input->post('accno')), $start, $finish);
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

	public function view_invoice_list(){

		$title = 'Invoice Module';
		$data_view = [
			'title' => 'List Invoice'
		];
		$content = $this->load->view('financecorp/ar/invoice/content/v_invoice_list', $data_view, true);

		$data = [
			'title' => $title,
			'content' => $content,
			
		];
		$this->load->view('financecorp/ar/invoice/layout/main', $data);
	}

	public function view_invoice_aging(){
        $data = [
            'title' => 'Invoice Aging',
            'h1' => 'Invoice',
            'h2' => 'Aging',
            'h3' => '',
            'h4' => ''
        ];
        
        $this->load->view('financecorp/ar/invoice/content/v_invoice_aging', $data);
    }
}