<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_DirectSales extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ABC/DirectSales_Model', 'ds');
    auth_admin();
  }

  public function index()
  {
    $title = 'Direct Sales';
    $script = '<script src="' . base_url('js/abc/direct_sales/view_direct_sales.js') . '" type="text/javascript"></script>';
    $data_view = [
      'title' => 'Direct Sales'
    ];
    $content = $this->load->view('abc/content/direct_sales', $data_view, true);

    $data = [
      'title' => $title,
      'content' => $content,
      'script' => $script
    ];
    $this->load->view('abc/layout/main', $data);
  }

  public function get_doc_no()
  {
    return 'DS-' . date('ym') . '-' . random_word(4);
  }

  public function get_direct_sales()
  {
    $data = $this->ds->M_get_direct_sales([
      'BranchCode' => $this->session->userdata('branch')
    ])->result_array();

    echo json_encode($data);
  }

  public function get_direct_sales_form()
  {
    $title = 'Direct Sales';
    $script = '<script src="' . base_url('js/abc/direct_sales/new_direct_sales.js') . '" type="module"></script>';

    $data_view = [
      'title' => 'New Direct Sales',
      'ds_no'  => $this->get_doc_no()
    ];
    $content = $this->load->view('abc/content/direct_sales_form', $data_view, true);

    $data = [
      'title' => $title,
      'content' => $content,
      'script' => $script,
      'no_sidebar' => true
    ];
    $this->load->view('abc/layout/main', $data);
  }

  public function get_stockcode_data()
  {
    $stockcode = $this->input->get('stockcode', true);
    $storage = $this->input->get('storage', true);
    $customer = $this->input->get('customer', true);
    $branch = $this->session->userdata('branch');

    $data = $this->ds->M_get_stockcode_data([
      'stockreg.Storage' => $storage,
      'stockreg.Stockcode' => $stockcode
    ])->row_array();

    $customer_data = $this->ds->M_get_customer_data([
      'CustomerCode' => $customer,
      'Branch' => $branch
    ])->row_array();

    $customer_price = $this->ds->M_get_customer_price([
      'Branch' => $branch,
      'Stockcode' => $stockcode,
      'Storage' => $storage,
      'PriceType' => $customer_data['Type']
    ])->row_array();

    if ($data) {
      if ($data['SAV'] <= 0) {
        $result = [
          'error' => true,
          'status' => 'insuficient',
          'message' => $data['Stockcode'] . ' - ' . $data['StockDescription']
        ];
      } elseif (!$customer_price) {
        $result = [
          'error' => true,
          'status' => 'cprice',
          'message' => [
            'stockcode' => $data['Stockcode'] . ' - ' . $data['StockDescription'],
            'customertype' => $customer_data['CustomerType']
          ]
        ];
      } else {
        $data['Price'] = $customer_price['Price'] ?? 0;
        $result = [
          'success' => true,
          'message' => $data
        ];
      }
    } else {
      $result = [
        'error' => true,
        'status' => 'nregistered',
        'message' => $data['Stockcode'] . ' - ' . $data['StockDescription']
      ];
    }

    echo json_encode($result);
  }

  public function create_direct_sales()
  {
    $branch_session = $this->session->userdata('branch');

    $pos_trans_id = $this->ds->M_get_trans_id();
    $result = null;
    $doc_no = $this->input->post('ds_no', true);
    $customer = $this->input->post('ds_customer', true);
    $storage = $this->input->post('ds_storage', true);
    $payment_discount = $this->input->post('ds_payment_discount', true);
    $payment_tax = $this->input->post('ds_payment_tax', true);
    $payment_type = $this->input->post('ds_payment_type', true);
    $card_no = $this->input->post('ds_payment_card_number', true);
    $bank = $this->input->post('ds_payment_bank', true);
    $payment = $this->input->post('ds_payment_total_paid', true);
    $raised_by = $this->session->userdata('uid');
    $raised_date = $this->input->post('ds_submit_date', true);
    $remarks = $this->input->post('ds_remarks', true);

    $stockcode = $this->input->post('ds_stockcode', true);
    $price = $this->input->post('ds_price', true);
    $qty = $this->input->post('ds_qty', true);
    $discount = $this->input->post('ds_discount', true);

    $data_detail = [];
    $data_master = [];
    $data_trans = [];
    $data_pos_trans = [];
    $check_stockcode = [];
    $data_update_stockreg = [];
    $data_update_stock = [];
    $data_production_cost = [];

    $calc_sub_total = 0;
    $discount_amount = 0;
    $tax_amount = 0;
    $grand_total = 0;

    $config_validation = [
      [
        'field' => 'ds_no',
        'label' => 'Document Number',
        'rules' => ['required', 'is_unique[tbl_sale_pos.sale_doc_no]'],
        'errors' => [
          'is_unique' => 'This %s is already taken. Please input another Code'
        ]
      ],
      [
        'field' => 'ds_customer',
        'label' => 'Customer',
        'rules' => 'required',
      ],
      [
        'field' => 'ds_storage',
        'label' => 'Storage',
        'rules' => 'required',
      ],
      [
        'field' => 'ds_submit_date',
        'label' => 'Submit Date',
        'rules' => 'required',
      ],
      [
        'field' => 'ds_payment_discount',
        'label' => 'Discount',
        'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
        'errors' => [
          'less_than_equal_to' => '%s cannot be more than 100'
        ]
      ],
      [
        'field' => 'ds_payment_tax',
        'label' => 'Tax',
        'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
        'errors' => [
          'less_than_equal_to' => '%s cannot be more than 100'
        ]
      ],
    ];

    if ($stockcode) {
      // * Check SAV condition
      foreach ($stockcode as $row => $value) {
        $stockcode_data = $this->ds->M_check_stockreg([
          'Storage' => $storage,
          'Stockcode' => $value
        ])->row_array();
        $count_sav = $stockcode_data['SAV'] - $qty[$row];
        if ($count_sav < 0) {
          array_push($check_stockcode, [
            'Stockcode' => $stockcode_data['Stockcode']
          ]);
        }
      }
    }

    if ($price) {
      foreach ($price as $row => $value) {
        array_push($config_validation, [
          'field' => 'ds_price[' . $row . ']',
          'label' => 'Price',
          'rules' => ['required', 'numeric']
        ]);
      }
    }

    if ($qty) {
      foreach ($qty as $row => $value) {
        array_push($config_validation, [
          'field' => 'ds_qty[' . $row . ']',
          'label' => 'Qty',
          'rules' => ['required', 'numeric', 'greater_than[0]'],
          'errors' => [
            'greater_than' => '%s must be more than 0'
          ]
        ]);
      }
    }

    if ($discount) {
      foreach ($discount as $row => $value) {
        array_push($config_validation, [
          'field' => 'ds_discount[' . $row . ']',
          'label' => 'Discount',
          'rules' => ['numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]'],
          'errors' => [
            'less_than_equal_to' => '%s cannot be more than 100'
          ]
        ]);
      }
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
      if ($stockcode) {
        if ($check_stockcode) {
          $result = [
            'error' => true,
            'status' => 'insuficient',
            'message' => array_column($check_stockcode, 'Stockcode')
          ];
        } else {
          foreach ($stockcode as $row => $value) {
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
              'Stockcode' => $value
            ])->row_array();

            // * Get production cost percentage
            $cost_percentage_data = $this->ds->M_get_cost_percentage([
              'group.Disc' => '0',
              'percentage.Disc' => '0'
            ])->result_array();

            // * Get Product Point 
            $product_point = $this->ds->M_get_product_point([
              'price.Storage' => $storage,
              'price.Stockcode' => $value
            ])->row_array();

            // * Count Ending Balance 
            if ($stocktrans_data) {
              $ending_balance = $stocktrans_data['qty_bal'];
              $reg_card = $stocktrans_data['qty_reg'];
            } else {
              $ending_balance = $stockreg_data['BB_SOH'];
              $reg_card = $stockreg_data['BB_SOH'];
            }

            $qty_bal = $ending_balance - $qty[$row];
            $cost_type = $stocktrans_data['cost_price_type'] ?? 0;
            $id_fifo = $stocktrans_data['fifo_id'] ?? 0;
            $com_cost = $stocktrans_data['cost_price_stand'] ?? 0;
            $qty_in_out = $stocktrans_data['qty_in'] ?? 0;
            $qty_in_cost = $stocktrans_data['cost_price_set'] ?? 0;
            $qty_in_right = $stocktrans_data['tot_bal_right'] ?? 0;
            $itemno_trans = $stocktrans_data['item_no_trans'] ?? 0;
            $total_amount_trans = $stocktrans_data['total_amount_tbv'] ?? 0;

            // * FIFO Processs
            // TODO: Check the process again
            $data_update_fifo = [];
            $update_fifo_condition = [];
            $fifo_process = $this->ds->M_get_fifo_process([
              'stock_code' => $value,
              'storage' => $storage,
              'switch_cost' => '1',
              'remain_fifo_i' => '1',
              'trans_type' => 'Receive'
            ])->result_array();

            // print_r($stocktrans_data);
            // print_r($fifo_process);
            // die;

            // var_dump($fifo_process);
            // die;

            $cost_count = 0;
            $cost_price = 0;
            $no_trans = 0;
            $sum = 0;

            if ($fifo_process) {
              foreach ($fifo_process as $fifo_row => $fifo_value) {
                $cost_count += $fifo_value['remain_fifo'];
                $no_trans += $fifo_value['item_no_trans'];

                if ($cost_count <= $qty[$row]) {
                  $data_update_fifo[] = [
                    'ctrl_no' => $fifo_value['ctrl_no'],
                    'switch_cost' => '0',
                    'remain_fifo_i' => '0'
                  ];
                } elseif ($cost_count >= $qty[$row]) {
                  $cost_price  = $fifo_value['cost_price_stand'];
                  $no_trans = $fifo_value['item_no_trans'];
                  $sum = $cost_count - $qty[$row];

                  $data_update_fifo[] = [
                    'ctrl_no' => $fifo_value['ctrl_no'],
                    'switch_cost' => '1',
                    'remain_fifo_i' => '1',
                    'remain_fifo' => $sum
                  ];
                }

                // ? Still Needed ?
                // $update_fifo_condition = [
                //   'stock_code' => $value,
                //   'storage' => $storage,
                //   'trans_type' => 'Receive',
                //   'item_no_trans' => $no_trans
                // ];
              }
            }
            // * End FIFO Process

            $com_val = $no_trans;
            $com_cost = $cost_price;
            $total_amount_trans_fifo = $reg_card - $qty[$row];
            $id_fifo_ = $id_fifo + 1;

            $cost_price = $qty_in_cost;
            $balance_total_left = $qty[$row] * $qty_in_cost;
            $balance_total_right = $balance_total_left + $qty_in_right;

            $product_point['ProductPoint'] > 0 ? $ppoint = ($product_point['Price'] / $product_point['ProductPoint']) : $ppoint = 0;
            // * Pos Det
            array_push($data_detail, [
              'sale_doc_no' => $doc_no,
              'storagecode' => $storage,
              'item_no' => $row + 1,
              'stock_code' => $value,
              'qty' => $qty[$row],
              'price' => $price[$row],
              'discount' => $discount[$row],
              'total_discount' => $calc_disc_amount, //TODO: Check Again
              'tax' => 0,
              'total_tax' => 0,
              'qty_bal' => $qty_bal, //TODO: Check Again
              'amount' => $calc_item_total, //TODO: Check Calculation
              'product_point' => $qty[$row] * $ppoint
            ]);

            // * Stock Trans
            array_push($data_trans, [
              'company_code' => $branch_session,
              'trans_id' => $pos_trans_id,
              'trans_date' => $raised_date,
              'trans_type'  => 'Issue',
              'trans_type_no' => $doc_no,
              'item_no' => $row + 1,
              'item_no_trans' => $itemno_trans,
              'total_amount_stand' => $qty_bal * $price[$row],
              'total_amount_tbv' => $total_amount_trans + ($qty_bal * $price[$row]),
              'stock_code' => $value,
              'qty' => $qty[$row],
              'qty_in' => 1,
              'qty_out' => $qty[$row],
              'cost_price_stand' => $price[$row],
              'storage' => $storage,
              'qty_bal' => $qty_bal,
              'transdate' => date('Y-m-d'),
              'tot_bal_left' => $balance_total_left,
              'tot_bal_right' => $balance_total_right,
              'cost_price_set' => $cost_price,
              'cost_price_type' => $cost_type,
              'switch_cost' => 1,
              'cost_price_native' => $price[$row],
              'fifo_id' => $id_fifo_,
              'cost_compare' => $com_cost,
              'cost_val' => $com_val,
              'qty_reg' => $total_amount_trans_fifo,
              'remain_fifo_i' => $sum,
              'remain_fifo' => $sum,
            ]);

            // * Reduce Stock Reg
            array_push($data_update_stockreg, [
              'CtrlNo' => $stockreg_data['CtrlNo'],
              'SOH' => $stockreg_data['SOH'] - $qty[$row],
              'SAV' => $stockreg_data['SAV'] - $qty[$row],
              'CombineStock' => $stockreg_data['CombineStock'] - $qty[$row]
            ]);

            // * Reduce Stock
            array_push($data_update_stock, [
              'CtrlNo' => $stock_data['CtrlNo'],
              'SOH' => $stock_data['SOH'] - $qty[$row]
            ]);

            // * Production Cost 
            foreach ($cost_percentage_data as $percentage_row => $percentage_value) {
              array_push($data_production_cost, [
                'SalesNo' => $doc_no,
                'Stockcode' => $value,
                'Type' => $percentage_value['ID'],
                'TypeDescription' => $percentage_value['Description'],
                'Percentage' => $percentage_value['Percentage'],
                'Amount' => ($percentage_value['Percentage'] / 100) * $calc_item_total,
                'BranchCode' => $branch_session,
                'RegBy' => $raised_by,
                'RegDate' => date("Y-m-d")
              ]);
            }
          }

          // * Grand Total Calculation
          $discount_amount = $calc_sub_total * ($payment_discount / 100);
          $tax_amount = $calc_sub_total * ($payment_tax / 100);
          $grand_total = $calc_sub_total - $discount_amount + $tax_amount;

          $data_master = [
            'sale_doc_no' => $doc_no,
            'BranchCode' => $branch_session,
            'CustomerID' => $customer,
            'CostumerName' => '',
            'sale_date' => $raised_date,
            'payment_type' => $payment_type,
            'payment_status' => 'paid',
            'COStatus' => 'Completed',
            'card_no' => $card_no ?? null,
            'bank_code' => $bank ?? null,
            'store' => '',
            'customer' => '',
            'due_date' => '',
            'sale_remark' => $remarks,
            'total_sale' => $calc_sub_total,
            'discount' => $payment_discount,
            'total_discount' => $discount_amount,
            'tax' => $payment_tax,
            'total_tax'  => $tax_amount,
            'cost_service' => null,
            'end_balance' => $grand_total,
            'payment' => $payment,
            'remain_value' => '',
            'Mast_cur_pay' => '',
            'Total_N_payment' => '',
            'WO' => null,
            'AccNo' => null,
            'submit_by' => $raised_by,
            'submit_date' => $raised_date,
            'Disc' => '0',
            'DiscDate' => null,
            'Remarks' => null,
            'ApprovedStatus' => 'NotApproved',
            'ApprovedBy' => '',
            'ApprovedDate' => '',
            'IssueBy' => '',
            'IssueDate' => '',
            'sale_type' => 'DirectSales'
          ];

          // * Pos Trans
          $data_pos_trans = [
            'trans_id' => $pos_trans_id,
            'trans_qty_items' => count($stockcode),
            'sale_doc_no' => $doc_no,
            'po_no' => null,
            'trans_date' => $raised_date,
            'trans_type' => 'Issue',
            'payment_type' => $payment_type,
            'trans_remarks' => $remarks,
            'trans_disc' => 'no'
          ];

          $data = [
            'data_master' => $data_master,
            'data_detail' => $data_detail,
            'data_pos_trans' => $data_pos_trans,
            'data_trans' => $data_trans,
            'data_update_fifo' => $data_update_fifo,
            'data_update_stock' => $data_update_stock,
            'data_update_stockreg' => $data_update_stockreg,
            'data_production_cost' => $data_production_cost
          ];

          $process_input = $this->ds->M_create_direct_sales($data);

          if ($process_input == 'success') {
            $result = [
              'success' => true,
              'status' => 'success',
              'message' => 'Data Recorded!'
            ];
          }
        }
      }
    }

    echo json_encode($result);
  }

  public function view_direct_sales_detail($id)
  {
    $title = 'Direct Sales';
    $script = '';

    $branch_session = $this->session->userdata('branch');

    $master_data = $this->ds->M_get_direct_sales([
      'pos.ctrl_no' => $id,
      'BranchCode' => $branch_session
    ])->row_array();

    if ($master_data) {
      $detail_data = $this->ds->M_get_direct_sales_detail([
        'sale_doc_no' => $master_data['DocNo']
      ])->result_array();

      $data_view = [
        'title' => 'Direct Sales Detail',
        'master' => $master_data,
        'detail' => $detail_data
      ];

      $content = $this->load->view('abc/content/direct_sales_form', $data_view, true);
      // $content = null;

      $data = [
        'title' => $title,
        'content' => $content,
        'script' => $script,
        'no_sidebar' => true
      ];
      $this->load->view('abc/layout/main', $data);
    } else {
      redirect('abc/sales/direct_sales');
    }
  }
}
