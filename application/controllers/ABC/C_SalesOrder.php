<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_SalesOrder extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ABC/SalesOrder_Model', 'so');
    auth_admin();
  }

  public function index()
  {
    $where_condition = [
      // 'Disc' => '0',
      'PaymentType' => 'SO',
      'master.BranchCode' => $this->session->userdata('branch'),
    ];

    $where_condition['POStatus'] = 'Order';
    $order = $this->so->M_get_sales_order($where_condition)->num_rows();

    $where_condition['POStatus'] = 'OnProcess';
    $process = $this->so->M_get_sales_order($where_condition)->num_rows();

    $where_condition['POStatus'] = 'Completed';
    $completed = $this->so->M_get_sales_order($where_condition)->num_rows();

    $where_condition['POStatus'] = 'Canceled';
    $cancelled = $this->so->M_get_sales_order($where_condition)->num_rows();

    $title = 'Sales Order';
    $script = '<script src="' . base_url('js/abc/sales_order/view_sales_order.js') . '" type="text/javascript"></script>';
    $data_view = [
      'title' => 'Sales Order',
      'order' => $order,
      'process' => $process,
      'completed' => $completed,
      'cancelled' => $cancelled
    ];
    $content = $this->load->view('abc/content/sales_order', $data_view, true);

    $data = [
      'title' => $title,
      'content' => $content,
      'script' => $script
    ];
    $this->load->view('abc/layout/main', $data);
  }

  public function get_doc_no()
  {
    return 'SO-' . date('ym') . '-' . random_word(4);
  }

  public function ajax_get_doc_no()
  {
    echo $this->get_doc_no();
  }

  public function get_sales_order_form()
  {
    $title = 'Sales Order';
    $script = '<script src="' . base_url('js/abc/sales_order/new_sales_order.js') . '" type="module"></script>';
    $data_view = [
      'title' => 'New Sales Order',
      'type' => 'create',
      'so_no' => $this->get_doc_no()
    ];
    $content = $this->load->view('abc/content/sales_order_form', $data_view, true);

    $data = [
      'title' => $title,
      'content' => $content,
      'script' => $script,
      'no_sidebar' => true
    ];
    $this->load->view('abc/layout/main', $data);
  }

  public function get_sales_order()
  {
    $data = $this->so->M_get_sales_order([
      // 'Disc' => '0',
      'PaymentType' => 'SO',
      'master.BranchCode' => $this->session->userdata('branch'),
      'ApprovedStatus' => 'NotApproved'
    ])->result_array();

    echo json_encode($data);
  }

  public function get_sales_order_by_id($id)
  {
    $title = 'Sales Order';
    $script = '<script src="' . base_url('js/abc/sales_order/edit_sales_order.js') . '" type="module"></script>';

    $branch_session = $this->session->userdata('branch');
    $master_data = $this->so->M_get_sales_order_master([
      'master.CtrlNo' => $id,
      'master.PaymentType' => 'SO',
      'master.ApprovedStatus' => 'NotApproved',
      'master.BranchCode' => $branch_session
    ])->row_array();

    $detail_data = $this->so->M_get_sales_order_detail([
      'PurchaseOrderID' => $master_data['DocNo']
    ])->result_array();

    if ($master_data) {
      $data_view = [
        'title' => 'Edit Sales Order',
        'type' => 'edit',
        'so_no' => $master_data['DocNo'],
        'master' => $master_data,
        'detail' => $detail_data
      ];
      $content = $this->load->view('abc/content/sales_order_form', $data_view, true);

      $data = [
        'title' => $title,
        'content' => $content,
        'script' => $script,
        'no_sidebar' => true
      ];
      $this->load->view('abc/layout/main', $data);
    } else {
      redirect('abc/sales/sales_order');
    }
  }

  public function view_sales_order_detail($id)
  {
    $title = 'Sales Order';
    $script = '<script src="' . base_url('js/abc/sales_order/detail_sales_order.js') . '" type="module"></script>';
    $branch_session = $this->session->userdata('branch');

    $branch_data = $this->so->M_get_branch([
      'BranchCode' => $branch_session
    ])->row_array();

    $master_data = $this->so->M_get_sales_order_master([
      'master.CtrlNo' => $id,
      'master.PaymentType' => 'SO',
      'master.BranchCode' => $branch_session
    ])->row_array();

    $detail_data = $this->so->M_get_sales_order_detail([
      'PurchaseOrderID' => $master_data['DocNo']
    ])->result_array();

    if ($master_data) {
      $data_view = [
        'title' => 'Sales Order Detail',
        'branch' => $branch_data,
        'master' => $master_data,
        'detail' => $detail_data
      ];
      $content = $this->load->view('abc/content/sales_order_detail', $data_view, true);

      $data = [
        'title' => $title,
        'content' => $content,
        'script' => $script
      ];
      $this->load->view('abc/layout/main', $data);
    } else {
      redirect('abc/sales/sales_order');
    }
  }

  public function get_sales_order_by_status($data_status)
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
        $status = 'OnProcess';
        break;
    }

    $where_condition = [
      // 'Disc' => '0',
      'PaymentType' => 'SO',
      'master.BranchCode' => $this->session->userdata('branch'),
      'POStatus' => $status
    ];

    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');

    isset($start_date) ? $where_condition['master.RaiseDate >='] = date('Y-m-d', strtotime($start_date)) : false;
    isset($end_date) ? $where_condition['master.RaiseDate <='] = date('Y-m-d', strtotime($end_date)) : false;

    $data = $this->so->M_get_sales_order($where_condition)->result_array();

    echo json_encode($data);
  }

  public function create_sales_order()
  {
    $result = null;

    $doc_no = $this->input->post('so_no', true);
    $customer = $this->input->post('so_customer', true);
    $quote_ref_no = $this->input->post('so_no_ref', true);
    $remarks = $this->input->post('so_remarks', true);

    $storage = $this->input->post('so_storage', true);
    $bill_to = $this->input->post('so_bill_to', true);
    $ship_to = $this->input->post('so_ship_to', true);
    $freight = $this->input->post('so_freight', true);
    $shipment = $this->input->post('so_shipment', true);
    $freight_remarks = $this->input->post('so_freight_remarks', true);

    $raised_by = $this->session->userdata('uid');
    $raised_date = $this->input->post('so_raised_date', true);
    $term_days = $this->input->post('so_term_days', true);
    $due_date = $this->input->post('so_due_date', true);

    $stockcode = $this->input->post('so_stockcode', true);
    $currency = $this->input->post('so_currency', true);
    $qty = $this->input->post('so_qty', true);
    $price = $this->input->post('so_price', true);
    $discount = $this->input->post('so_discount', true);
    $total = $this->input->post('so_total', true);

    $calc_sub_total = 0;
    $payment_discount = $this->input->post('so_payment_discount', true);
    $payment_tax = $this->input->post('so_payment_tax', true);
    $payment_freight_cost = $this->input->post('so_payment_freight_cost', true);

    $data_detail = [];
    $data_master = [];

    $config_validation = [
      [
        'field' => 'so_no',
        'label' => 'Document Number',
        'rules' => ['required', 'is_unique[tbl_mat_po_v2.PurchaseOrderID]'],
        'errors' => [
          'is_unique' => 'This %s is already taken. Please input another Code'
        ]
      ],
      [
        'field' => 'so_customer',
        'label' => 'Customer',
        'rules' => 'required'
      ],
      [
        'field' => 'so_storage',
        'label' => 'Storage',
        'rules' => 'required'
      ],
      [
        'field' => 'so_bill_to',
        'label' => 'Bill To',
        'rules' => 'required'
      ],
      [
        'field' => 'so_ship_to',
        'label' => 'Ship To',
        'rules' => 'required'
      ],
      [
        'field' => 'so_shipment',
        'label' => 'Shipment',
        'rules' => 'required'
      ],
      [
        'field' => 'so_raised_date',
        'label' => 'Raised Date',
        'rules' => 'required'
      ],
      [
        'field' => 'so_payment_discount',
        'label' => 'Discount',
        'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
        'errors' => [
          'less_than_equal_to' => '%s cannot be more than 100'
        ]
      ],
      [
        'field' => 'so_payment_tax',
        'label' => 'Tax',
        'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
        'errors' => [
          'less_than_equal_to' => '%s cannot be more than 100'
        ]
      ],
      [
        'field' => 'so_payment_freight_cost',
        'label' => 'Freight Cost',
        'rules' => ['numeric', 'greater_than_equal_to[0]']
      ]
    ];

    foreach ($stockcode as $row => $value) {
      array_push($config_validation, [
        'field' => 'so_stockcode[' . $row . ']',
        'label' => 'Stockcode',
        'rules' => 'required'
      ]);
    }

    foreach ($currency as $row => $value) {
      array_push($config_validation, [
        'field' => 'so_currency[' . $row . ']',
        'label' => 'Currency',
        'rules' => 'required'
      ]);
    }

    foreach ($qty as $row => $value) {
      array_push($config_validation, [
        'field' => 'so_qty[' . $row . ']',
        'label' => 'Qty',
        'rules' => ['required', 'numeric', 'greater_than[0]'],
        'errors' => [
          'greater_than' => '%s must be more than 0'
        ]
      ]);
    }

    foreach ($discount as $row => $value) {
      array_push($config_validation, [
        'field' => 'so_discount[' . $row . ']',
        'label' => 'Discount',
        'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
        'errors' => [
          'less_than_equal_to' => '%s cannot be more than 100'
        ]
      ]);
    }

    foreach ($price as $row => $value) {
      array_push($config_validation, [
        'field' => 'so_price[' . $row . ']',
        'label' => 'Price',
        'rules' => ['required', 'numeric']
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
        $calc_total = $price[$row] * $qty[$row];
        $calc_disc_amount = ($calc_total * $discount[$row]) / 100;
        $calc_item_total = $calc_total - $calc_disc_amount;

        array_push($data_detail, [
          'ItemNo' => $row + 1,
          'PurchaseOrderID' => $doc_no,
          'SalesNo' => '',
          'Stockcode' => $value,
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
        'SupplierID' => $customer,
        'SupContactID' => '', //TODO : Add this
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
        'PaymentType' => 'SO',
        'SubTotal' => $calc_sub_total,
        'Discount' => $payment_discount,
        'DiscAmount' => $discount_amount,
        'Tax' => $payment_tax,
        'TaxAmount' => $tax_amount,
        'TaxStatus' => 'Exclude', // TODO : Check Again
        'FreightCost' => $payment_freight_cost,
        'GrandTotal' => $grand_total,
        // ? for what
        'Current_pay' => 0,
        'Mast_cur_pay' => 0,
        'Det_cur_pay' => 0,
        'Total_N_payment' => 0,
        // ? end
        'PORemarks' => $remarks,
        'POStatus' => 'OnProcess',
        'POStatusPayment' => 'OnProcess',
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
        'AccNo' => null,
        'CostCenter' => null
      ];

      $data = [
        'detail' => $data_detail,
        'master' => $data_master
      ];
      // $query_insert = 'success';
      $query_insert = $this->so->M_insert_sales_order($data);

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

  public function get_customer_select2()
  {
    $data  = $this->so->M_get_customer([
      'Disc' => '0',
      'Branch' => $this->session->userdata('branch')
    ])->result_array();

    echo json_encode($data);
  }

  public function get_storage_select2()
  {
    $data = $this->so->M_get_storage([
      'Disc' => '0',
      // 'BranchCode' => $this->session->userdata('branch')
      'BranchCode' => '0101'
    ])->result_array();

    echo json_encode($data);
  }

  public function get_stockcode_select2()
  {
    $data = $this->so->M_get_stockcode([
      'stockcode.Row' => 'No',
      'stockreg.Disc' => '0',
      // 'stockreg.BranchCode' => $this->session->userdata('branch'),
      'stockreg.BranchCode' => '0101',
    ])->result_array();

    echo json_encode($data);
  }

  public function get_currency_select2()
  {
    $data = $this->so->M_get_currency([
      'Disc' => '0',
    ])->result_array();

    echo json_encode($data);
  }

  public function get_bank_select2()
  {
    $data = $this->so->M_get_bank([
      'Disc' => '0',
    ])->result_array();

    echo json_encode($data);
  }

  public function get_price_by_customer()
  {
    $customer = $this->input->get('customer', true);
    $stockcode = $this->input->get('stockcode', true);
    $storage = $this->input->get('storage', true);
    $branch = $this->session->userdata('branch');

    $customer_type = $this->so->M_get_customer_type([
      'CustomerCode' => $customer,
      'Branch' => $branch
    ])->row_array();

    $price = $this->so->M_get_price([
      'Branch' => $branch,
      'Storage' => $storage,
      'Stockcode' => $stockcode,
      'PriceType' => $customer_type['Type']
    ])->row_array() ?? 0;

    $data = [
      'price' => $price['Price'],
    ];

    echo json_encode($data);
  }

  public function approve_multi_sales_order()
  {
    $id = $this->input->post('id', true);
    if ($id) {
      $approve_date = Date('Y-m-d H:i:s');
      $data_update_so = [];
      foreach ($id as $row => $value) {
        array_push($data_update_so, [
          'CtrlNo' => $value,
          'ApprovedStatus' => 'Approved',
          'POStatus' => 'OnProcess',
          'ApprovedBy' => $this->session->userdata('uid'),
          'ApprovedDate' => $approve_date
        ]);
      }

      $data = [
        'so' => $data_update_so
      ];
      $query_update = $this->so->M_approve_multi_so($data);
    }
    // $query_update = "success";
    $result = [
      'success' => true,
      'status' => $query_update,
      'message' => 'SO Approved!'
    ];

    echo json_encode($result);
  }

  public function get_number_of_sales_order()
  {
    $where_condition = [
      // 'Disc' => '0',
      'PaymentType' => 'SO',
      'master.BranchCode' => $this->session->userdata('branch'),
    ];

    $where_condition['POStatus'] = 'Order';
    $order = $this->so->M_get_sales_order($where_condition)->num_rows();

    $where_condition['POStatus'] = 'OnProcess';
    $process = $this->so->M_get_sales_order($where_condition)->num_rows();

    $where_condition['POStatus'] = 'Completed';
    $completed = $this->so->M_get_sales_order($where_condition)->num_rows();

    $where_condition['POStatus'] = 'Canceled';
    $cancelled = $this->so->M_get_sales_order($where_condition)->num_rows();

    $result = [
      'order' => $order,
      'process' => $process,
      'completed' => $completed,
      'cancelled' => $cancelled
    ];

    echo json_encode($result);
  }

  public function update_sales_order($id)
  {
    $result = null;

    $master_id = $id;
    $doc_no = $this->input->post('so_no', true);
    $customer = $this->input->post('so_customer', true);
    $quote_ref_no = $this->input->post('so_no_ref', true);
    $remarks = $this->input->post('so_remarks', true);
    $storage = $this->input->post('so_storage', true);
    $bill_to = $this->input->post('so_bill_to', true);
    $ship_to = $this->input->post('so_ship_to', true);
    $freight = $this->input->post('so_freight', true);
    $shipment = $this->input->post('so_shipment', true);
    $freight_remarks = $this->input->post('so_freight_remarks', true);
    $raised_by = $this->session->userdata('uid');
    $raised_date = $this->input->post('so_raised_date', true);
    $term_days = $this->input->post('so_term_days', true);
    $due_date = $this->input->post('so_due_date', true);

    $detail_id = $this->input->post('so_id', true);
    $stockcode = $this->input->post('so_stockcode', true);
    $currency = $this->input->post('so_currency', true);
    $qty = $this->input->post('so_qty', true);
    $price = $this->input->post('so_price', true);
    $discount = $this->input->post('so_discount', true);
    $total = $this->input->post('so_total', true);
    $calc_sub_total = 0;
    $payment_discount = $this->input->post('so_payment_discount', true);
    $payment_tax = $this->input->post('so_payment_tax', true);
    $payment_freight_cost = $this->input->post('so_payment_freight_cost', true);

    $data_detail = [];
    $data_master = [];

    $config_validation = [
      [
        'field' => 'so_customer',
        'label' => 'Customer',
        'rules' => 'required'
      ],
      [
        'field' => 'so_storage',
        'label' => 'Storage',
        'rules' => 'required'
      ],
      [
        'field' => 'so_bill_to',
        'label' => 'Bill To',
        'rules' => 'required'
      ],
      [
        'field' => 'so_ship_to',
        'label' => 'Ship To',
        'rules' => 'required'
      ],
      [
        'field' => 'so_raised_date',
        'label' => 'Raised Date',
        'rules' => 'required'
      ],
      [
        'field' => 'so_payment_discount',
        'label' => 'Discount',
        'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
        'errors' => [
          'less_than_equal_to' => '%s cannot be more than 100'
        ]
      ],
      [
        'field' => 'so_payment_tax',
        'label' => 'Tax',
        'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
        'errors' => [
          'less_than_equal_to' => '%s cannot be more than 100'
        ]
      ],
      [
        'field' => 'so_payment_freight_cost',
        'label' => 'Freight Cost',
        'rules' => ['numeric', 'greater_than_equal_to[0]']
      ]
    ];

    foreach ($stockcode as $row => $value) {
      array_push($config_validation, [
        'field' => 'so_stockcode[' . $row . ']',
        'label' => 'Stockcode',
        'rules' => 'required'
      ]);
    }

    foreach ($currency as $row => $value) {
      array_push($config_validation, [
        'field' => 'so_currency[' . $row . ']',
        'label' => 'Currency',
        'rules' => 'required'
      ]);
    }

    foreach ($qty as $row => $value) {
      array_push($config_validation, [
        'field' => 'so_qty[' . $row . ']',
        'label' => 'Qty',
        'rules' => ['required', 'numeric', 'greater_than[0]'],
        'errors' => [
          'greater_than' => '%s must be more than 0'
        ]
      ]);
    }

    foreach ($discount as $row => $value) {
      array_push($config_validation, [
        'field' => 'so_discount[' . $row . ']',
        'label' => 'Discount',
        'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
        'errors' => [
          'less_than_equal_to' => '%s cannot be more than 100'
        ]
      ]);
    }

    foreach ($price as $row => $value) {
      array_push($config_validation, [
        'field' => 'so_price[' . $row . ']',
        'label' => 'Price',
        'rules' => ['required', 'numeric']
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
        $calc_total = $price[$row] * $qty[$row];
        $calc_disc_amount = ($calc_total * $discount[$row]) / 100;
        $calc_item_total = $calc_total - $calc_disc_amount;

        array_push($data_detail, [
          'ItemID' => $detail_id[$row],
          'ItemNo' => $row + 1,
          'PurchaseOrderID' => $doc_no,
          'SalesNo' => '',
          'ItemNo' => $row,
          'Stockcode' => $value,
          'StockDesc' => $stockcode_data['StockDescription'],
          'UOM' => $stockcode_data['UOM'],
          'Qty' => $qty[$row],
          'Currency' => $currency[$row],
          'ItemPrice' => $price[$row],
          'Discount' => $discount[$row],
          'DiscAmount' => $calc_disc_amount,
          'Tax' => 0,
          'TaxAmount' => 0,
          'TotalAmount' => $calc_item_total,
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
        'SupplierID' => $customer,
        'RaiseBy' => $raised_by,
        'RaiseDate' => $raised_date,
        'Term' => $term_days,
        'DueDate' => $due_date,
        'BillTo' => $bill_to,
        'ShipTo' => $ship_to,
        'Storage' => $storage,
        'FreightService' => $freight,
        'DeliveryMethod' => $shipment,
        'FreightInfo' => $freight_remarks,
        'SubTotal' => $calc_sub_total,
        'Discount' => $payment_discount,
        'DiscAmount' => $discount_amount,
        'Tax' => $payment_tax,
        'TaxAmount' => $tax_amount,
        'TaxStatus' => 'Exclude', // TODO : Check Again
        'FreightCost' => $payment_freight_cost,
        'GrandTotal' => $grand_total,
        'PORemarks' => $remarks,
      ];

      $data = [
        'master_id' => $id,
        'detail' => $data_detail,
        'master' => $data_master
      ];
      // $query_update = 'success';
      $query_update = $this->so->M_update_sales_order($data);

      if ($query_update == 'success') {
        $result = [
          'success' => true,
          'status' => $query_update,
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
}
