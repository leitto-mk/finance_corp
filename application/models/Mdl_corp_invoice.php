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

	public function get_invoices($limit, $offset)
	{
		$this->db->trans_begin();

		$result = $this->db->select('
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
				->limit($limit, $offset)
				->get()
				->result_array();

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
}
