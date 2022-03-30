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

	public function new()
	{
		$content_data = [
			'title' => 'Create Invoice',

			//Master
			'invoice_no' => $this->Mdl_corp_invoice->generate_invoice(),
			'customer' => $this->Mdl_corp_invoice->get_customer(),
			'storage' => $this->Mdl_corp_invoice->get_storage(),
			'raised_by' => 'ABASE-ADMIN',

			//List
			'stockcode' => $this->Mdl_corp_invoice->get_stockcode(),
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

		$mas = [
			'InvoiceNo' => $input->post('invoice_no'),
			'CustomerCode' => $input->post('customer'),
			'QuoteRefNo' => ($input->post('reference_no') == '' ? $input->post('stockcode') : $input->post('reference_no')),
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

			// array_push($trans, [
            //     'DocNo' => $input->post('stockcode'),
            //     'RefNo' => ($input->post('reference_no') == '' ? $input->post('stockcode') : $input->post('reference_no')),
            //     'TransDate' => $input->post('raised_date'),
            //     'TransType' => 'INV',
            //     'JournalGroup' => '',
            //     'Branch' => $input->post('branch'),
            //     'ItemNo' => $i+1,
            //     'AccNo' => $input->post('accno'),
            //     'AccType' => $acctype,
            //     'Currency' => $input->post('currency')[$i],
            //     'Rate' => 1,
            //     'Unit' => $input->post('price')[$i],
            //     'Amount' => $input->post('total')[$i],
            //     'Debit' => 0,
            //     'Credit' => 0,
            //     'Balance' => 0,
            //     'BalanceBranch' => 0,
            //     'Remarks' => '',
            //     'EntryBy' => '',
            //     'EntryDate' => date('Y-m-d h:m:s')
            // ]);
		}

		$error = $this->Mdl_corp_invoice->submit_invoice($mas, $det);
		if($error !== null){
			return set_error_response(self::HTTP_INTERNAL_ERROR, $error);
		}

		return set_success_response("success");
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