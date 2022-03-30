<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_invoice extends CI_Model
{
	function generate_invoice(){ 
        $current = $this->db
                    ->limit(1)
                    ->order_by('InvoiceNo', 'DESC')
                    ->select('SUBSTRING(InvoiceNo, 6,5)+0 AS InvoiceNo')
                    ->get('tbl_fa_invoice_mas');

        if($current->num_rows() == 0 ){
            $sequence = str_pad(1, 5, 0, STR_PAD_LEFT);
        }elseif($current->num_rows() > 0){
            $current = $current->row()->InvoiceNo;
            $sequence = str_pad($current+1, 5, 0, STR_PAD_LEFT);
        }

        $invoice_no = date('ym') . '-' . $sequence . 'INV'; 
        
        return $invoice_no;
    }

	public function get_customer(){
		$query = $this->db->select('CustomerCode, CustomerName')->get('tbl_mat_cat_customer')->result_array();

		return $query;
	}

	public function get_storage(){
		$query = $this->db->select('StorageCode, StorageName')->get('tbl_mat_cat_storage')->result_array();

		return $query;
	}

	public function get_stockcode(){
		$query = $this->db->select('Stockcode, StockDescription, UOM, UOMQty')->get('tbl_mat_stockcode')->result_array();

		return $query;
	}

	public function submit_invoice($mas, $det){
		$this->db->trans_begin();
        
        $this->db->insert('tbl_fa_invoice_mas', $mas);
        $this->db->insert_batch('tbl_fa_invoice_det', $det);

		if($this->db->error()['code'] != 0){
            $code = $this->db->error()['code'];
            $message = $this->db->error()['message'];
            log_message('error', "$code: $message");

            $this->db->trans_rollback();
   
            return "Database Error";
         }
        
        $this->db->trans_complete();
		
		return null;
	}

	public function get_approval()
	{
		$data = [
			[
				'ID' => '1',
				'DocNo' => 'INV2112-001',
				'CustomerGroup' => 'Customer A',
				'Customer' => 'BES Building & Engineering Services',
				'InvoiceDate' => '2019-08-06',
				'PaymentDue' => '',
				'Amount' => 81.14,
				'Paid' => 0,
				'Balance' => 81.14
			],
			[
				'ID' => '2',
				'DocNo' => 'INV2112-002',
				'CustomerGroup' => 'Customer A',
				'Customer' => 'BES Building & Engineering Services',
				'InvoiceDate' => '2020-02-12',
				'PaymentDue' => '',
				'Amount' => 555,
				'Paid' => 0,
				'Balance' => 555
			],
			[
				'ID' => '3',
				'DocNo' => 'INV2112-003',
				'CustomerGroup' => 'Customer A',
				'Customer' => 'THAMES Thames Industries',
				'InvoiceDate' => '2011-03-14',
				'PaymentDue' => '2011-03-15',
				'Amount' => 518.28,
				'Paid' => 0,
				'Balance' => 518.28
			],
			[
				'ID' => '4',
				'DocNo' => 'INV2112-004',
				'CustomerGroup' => 'Customer B',
				'Customer' => 'Acme Acme Industries',
				'InvoiceDate' => '2020-02-21',
				'PaymentDue' => '',
				'Amount' => 2400,
				'Paid' => 0,
				'Balance' => 2400
			],
			[
				'ID' => '5',
				'DocNo' => 'INV2112-005',
				'CustomerGroup' => 'Customer B',
				'Customer' => 'BES Building & Engineering Services',
				'InvoiceDate' => '2019-09-19',
				'PaymentDue' => '',
				'Amount' => 38.50,
				'Paid' => 0,
				'Balance' => 38.50
			],
			[
				'ID' => '6',
				'DocNo' => 'INV2112-006',
				'CustomerGroup' => 'Customer B',
				'Customer' => 'BES Building & Engineering Services',
				'InvoiceDate' => '2019-09-19',
				'PaymentDue' => '',
				'Amount' => 38.50,
				'Paid' => 0,
				'Balance' => 38.50
			],
			[
				'ID' => '7',
				'DocNo' => 'INV2112-007',
				'CustomerGroup' => 'Customer B',
				'Customer' => 'BES Building & Engineering Services',
				'InvoiceDate' => '2019-09-19',
				'PaymentDue' => '',
				'Amount' => 38.50,
				'Paid' => 0,
				'Balance' => 38.50
			],
			[
				'ID' => '8',
				'DocNo' => 'INV2112-008',
				'CustomerGroup' => 'Customer C',
				'Customer' => 'BES Building & Engineering Services',
				'InvoiceDate' => '2019-09-19',
				'PaymentDue' => '',
				'Amount' => 38.50,
				'Paid' => 0,
				'Balance' => 38.50
			],
			[
				'ID' => '9',
				'DocNo' => 'INV2112-009',
				'CustomerGroup' => 'Customer C',
				'Customer' => 'BES Building & Engineering Services',
				'InvoiceDate' => '2019-09-19',
				'PaymentDue' => '',
				'Amount' => 38.50,
				'Paid' => 0,
				'Balance' => 38.50
			]
		];

		return $data;
	}
}
