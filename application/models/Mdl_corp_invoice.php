<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_invoice extends CI_Model
{
	public function generate_invoice(){ 
		$this->db->select('SUBSTRING(InvoiceNo, 6,5)+0 AS InvoiceNo')
		->order_by('InvoiceNo', 'DESC')
		->limit(1);
		
		$current = $this->db->get('tbl_fa_invoice_mas');
		
		if($this->db->error()['code'] !== 0){
			throw new Exception("Database Error");
		}

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
		$this->db->select('
			mas.*, 
			det.*
		')
		->from('tbl_fa_invoice_mas AS mas')
		->join('tbl_fa_invoice_det AS det', 'InvoiceNo', 'LEFT')
		->where('mas.InvoiceNo', $invoice);
		
		$query = $this->db->get();

		if($this->db->error()['code'] !== 0){
			throw new Exception("Database Error");
		}

		return $query->result_array();
	}

	public function get_invoices($customer, $start, $finish, $limit, $offset)
	{
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

		$result = $this->db->get();
		
		if($this->db->error()['code'] !== 0){
			throw new Exception("Database Error");
		}
		
		return $result->result_array();
	}

	public function submit_invoice($mas, $det, $trans){
		$this->db->trans_begin();
        
        $this->db->insert('tbl_fa_invoice_mas', $mas);
        $this->db->insert_batch('tbl_fa_invoice_det', $det);
        $this->db->insert_batch('tbl_fa_transaction', $trans);

		if($this->db->trans_status() == false){
            $this->db->trans_rollback();
   
            throw new Exception("Database Error");
        }
        
        $this->db->trans_complete();
	}

	public function delete_invoice($invoice){
		$this->db->trans_begin();

		$this->db->delete('tbl_fa_invoice_mas', ['InvoiceNo' => $invoice]);
		$this->db->delete('tbl_fa_invoice_det', ['InvoiceNo' => $invoice]);
		$this->db->delete('tbl_fa_transaction', ['DocNo' => $invoice]);

		if($this->db->trans_status() == false){
            $this->db->trans_rollback();
   
            throw new Exception("Database Error");
        }
        
        $this->db->trans_complete();
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

		$summary = $this->db->get();
		if($this->db->error()['code'] !== 0){
			throw new Exception("Database Error");
		}

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
			 WHERE $ageby BETWEEN '$start' AND DATE_ADD('$start', INTERVAL 30 DAY)) AS q1", "CustomerCode", 'LEFT')->get();
		
		if($this->db->error()['code'] !== 0){
			throw new Exception("Database Error");
		}

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
			 WHERE $ageby BETWEEN DATE_ADD('$start', INTERVAL 31 DAY) AND DATE_ADD('$start', INTERVAL 60 DAY)) AS q2", "CustomerCode", 'LEFT')->get();
		
		if($this->db->error()['code'] !== 0){
			throw new Exception("Database Error");
		}

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
			 WHERE $ageby BETWEEN DATE_ADD('$start', INTERVAL 61 DAY) AND DATE_ADD('$start', INTERVAL 90 DAY)) AS q3", "CustomerCode", 'LEFT')->get();
		
		if($this->db->error()['code'] !== 0){
			throw new Exception("Database Error");
		}

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
			 WHERE $ageby >= DATE_ADD('$start', INTERVAL 91 DAY)) AS q4", "CustomerCode", 'LEFT')->get();
		
		if($this->db->error()['code'] !== 0){
			throw new Exception("Database Error");
		}

		$summary = $summary->result_array();
		$q1 = $q1->result_array();
		$q2 = $q2->result_array();
		$q3 = $q3->result_array();
		$q4 = $q4->result_array();

		return [$summary, $q1, $q2, $q3, $q4];
	}
}
