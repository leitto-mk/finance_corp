<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_invoice extends CI_Model
{
	public function generate_invoice(){ 
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

	public function get_invoice($invoice){
		$query = $this->db
				->select('mas.*, det.*')
				->from('tbl_fa_invoice_mas AS mas')
				->join('tbl_fa_invoice_det AS det', 'InvoiceNo', 'LEFT')
				->where('mas.InvoiceNo', $invoice)
				->get()
				->result_array();

		if($this->db->error()['code'] != 0){
			$code = $this->db->error()['code'];
			$message = $this->db->error()['message'];
			log_message('error', "$code: $message");

			return [null, "Database Error"];
		}
		
		$this->db->trans_complete();
		
		return [$query, null];
	}

	public function get_invoices($customer, $start, $finish, $limit, $offset)
	{
		$this->db->trans_begin();

		$this->db->select('
			mas.InvoiceNo, 
			cus.CustomerName, 
			DATE_FORMAT(mas.InvoiceDate, "%Y-%m-%d") AS InvoiceDate, 
			DATE_FORMAT(mas.DueDate, "%Y-%m-%d") AS DueDate, 
			mas.TotalAmount, 
			mas.Payment, 
			mas.Balance
		')
		->from('tbl_fa_invoice_mas AS mas')
		->join('tbl_mat_cat_customer AS cus', 'cus.CustomerCode = mas.CustomerCode', 'LEFT')
		->limit($limit, $offset);
		
		if($customer){
			$this->db->where('mas.CustomerCode', $customer);
		}

		if($start && $finish){
			$this->db->where([
				'mas.RaisedDate >=' => $start,
				'mas.RaisedDate <=' => $finish,
			]);
		}

		$result = $this->db->get()->result_array();

		if($this->db->error()['code'] != 0){
            $code = $this->db->error()['code'];
            $message = $this->db->error()['message'];
            log_message('error', "$code: $message");

            $this->db->trans_rollback();
   
            return [null, "Database Error"];
         }
        
        $this->db->trans_complete();
		
		return [$result, null];
	}

	public function submit_invoice($mas, $det, $trans){
		$this->db->trans_begin();
        
        $this->db->insert('tbl_fa_invoice_mas', $mas);
        $this->db->insert_batch('tbl_fa_invoice_det', $det);
        $this->db->insert('tbl_fa_transaction', $trans);

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

	public function delete_invoice($invoice){
		$this->db->trans_begin();

		$this->db->delete('tbl_fa_invoice_mas', ['InvoiceNo' => $invoice]);
		$this->db->delete('tbl_fa_invoice_det', ['InvoiceNo' => $invoice]);
		$this->db->delete('tbl_fa_transaction', ['DocNo' => $invoice]);

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

	public function get_invoice_aging($branch, $customer, $ageby, $start){
		$this->db->trans_begin();

		/**
		 **  SUMMARY
		 */ 
		$this->db->select("
			mas.Branch, 
			mas.InvoiceNo, 
			cus.CustomerName, 
			(
				IFNULL(q1.Balance, 0) +
				IFNULL(q2.Balance, 0) +
				IFNULL(q3.Balance, 0) +
				IFNULL(q4.Balance, 0)
			) AS Outstanding,
			IFNULL(q1.Balance, 0) AS BalanceQ1,
			IFNULL(q2.Balance, 0) AS BalanceQ2,
			IFNULL(q3.Balance, 0) AS BalanceQ3,
			IFNULL(q4.Balance, 0) AS BalanceQ4		
		")
		->from('tbl_fa_invoice_mas AS mas')
		->join('tbl_mat_cat_customer AS cus', 'CustomerCode', 'LEFT')
		->join("(SELECT CustomerCode, Balance FROM tbl_fa_invoice_mas
				 WHERE $ageby BETWEEN '$start' AND DATE_ADD('$start', INTERVAL 30 DAY)) AS q1", "CustomerCode", 'LEFT')
		->join("(SELECT CustomerCode, Balance FROM tbl_fa_invoice_mas
				 WHERE $ageby BETWEEN DATE_ADD('$start', INTERVAL 31 DAY) AND DATE_ADD('$start', INTERVAL 60 DAY)) AS q2", "CustomerCode", 'LEFT')
		->join("(SELECT CustomerCode, Balance FROM tbl_fa_invoice_mas
				 WHERE $ageby BETWEEN DATE_ADD('$start', INTERVAL 61 DAY) AND DATE_ADD('$start', INTERVAL 90 DAY)) AS q3", "CustomerCode", 'LEFT')
		->join("(SELECT CustomerCode, Balance FROM tbl_fa_invoice_mas
				 WHERE $ageby >= DATE_ADD('$start', INTERVAL 91 DAY)) AS q4", "CustomerCode", 'LEFT');

		if($branch !== ''){
			$this->db->where('mas.Branch', $branch);
		}

		if($customer !== ''){
			$this->db->where('mas.CustomerCode', $customer);
		}

		$summary = $this->db->get()->result_array();

		/**
		 **  Q1-Q4 Details
		 */
		if($branch !== ''){
			$this->db->where('mas.Branch', $branch);
		}
		if($customer !== ''){
			$this->db->where('mas.CustomerCode', $customer);
		}

		$q1 = $this->db->select("
			cus.CustomerName,
			cus.CustomerCode,
			mas.InvoiceNo,
			mas.TermsOfDays,
			DATE_FORMAT(mas.RaisedDate, '%d-%m-%Y') AS RaisedDate,
			DATE_FORMAT(mas.DueDate, '%d-%m-%Y') AS DueDate,
			mas.TotalAmount,
			mas.Payment,
			mas.Balance
		")
		->from('tbl_fa_invoice_mas AS mas')
		->join('tbl_mat_cat_customer AS cus', 'CustomerCode', 'LEFT')->join("
			(SELECT CustomerCode, Balance FROM tbl_fa_invoice_mas
			 WHERE $ageby BETWEEN '$start' AND DATE_ADD('$start', INTERVAL 30 DAY)) AS q1", "CustomerCode", 'LEFT')->get()->result_array();

		$q2 = $this->db->select("
			cus.CustomerName,
			cus.CustomerCode,
			mas.InvoiceNo,
			mas.TermsOfDays,
			DATE_FORMAT(mas.RaisedDate, '%d-%m-%Y') AS RaisedDate,
			DATE_FORMAT(mas.DueDate, '%d-%m-%Y') AS DueDate,
			mas.TotalAmount,
			mas.Payment,
			mas.Balance
		")
		->from('tbl_fa_invoice_mas AS mas')
		->join('tbl_mat_cat_customer AS cus', 'CustomerCode', 'LEFT')->join("
			(SELECT CustomerCode, Balance FROM tbl_fa_invoice_mas
			 WHERE $ageby BETWEEN DATE_ADD('$start', INTERVAL 31 DAY) AND DATE_ADD('$start', INTERVAL 60 DAY)) AS q2", "CustomerCode", 'LEFT')->get()->result_array();

		$q3 = $this->db->select("
			cus.CustomerName,
			cus.CustomerCode,
			mas.InvoiceNo,
			mas.TermsOfDays,
			DATE_FORMAT(mas.RaisedDate, '%d-%m-%Y') AS RaisedDate,
			DATE_FORMAT(mas.DueDate, '%d-%m-%Y') AS DueDate,
			mas.TotalAmount,
			mas.Payment,
			mas.Balance
		")
		->from('tbl_fa_invoice_mas AS mas')
		->join('tbl_mat_cat_customer AS cus', 'CustomerCode', 'LEFT')->join("
			(SELECT CustomerCode, Balance FROM tbl_fa_invoice_mas
			 WHERE $ageby BETWEEN DATE_ADD('$start', INTERVAL 61 DAY) AND DATE_ADD('$start', INTERVAL 90 DAY)) AS q3", "CustomerCode", 'LEFT')->get()->result_array();

		$q4 = $this->db->select("
			cus.CustomerName,
			cus.CustomerCode,
			mas.InvoiceNo,
			mas.TermsOfDays,
			DATE_FORMAT(mas.RaisedDate, '%d-%m-%Y') AS RaisedDate,
			DATE_FORMAT(mas.DueDate, '%d-%m-%Y') AS DueDate,
			mas.TotalAmount,
			mas.Payment,
			mas.Balance
		")
		->from('tbl_fa_invoice_mas AS mas')
		->join('tbl_mat_cat_customer AS cus', 'CustomerCode', 'LEFT')->join("
			(SELECT CustomerCode, Balance FROM tbl_fa_invoice_mas
			 WHERE $ageby >= DATE_ADD('$start', INTERVAL 91 DAY)) AS q4", "CustomerCode", 'LEFT')->get()->result_array();
	
		if($this->db->error()['code'] != 0){
			$code = $this->db->error()['code'];
			$message = $this->db->error()['message'];
			log_message('error', "$code: $message");
		
			$this->db->trans_rollback();
		
			return [null, "Database Error"];
		}
		
		$this->db->trans_complete();

		return [$summary, $q1, $q2, $q3, $q4, null];
	}
}
