<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_std_receipt extends CI_Model
{
   
   public function get_receipt_overview(){
      return $this->db->query(
         "SELECT 
            mas.TransDate,
            mas.DocNo,
            mas.AccNo,
            mas.Year,
            mas.Month,
            mas.Branch AS School,
            mas.Balance,
            mas.IDNumber,
            mas.Remarks,
            t1.FullName,
            t1.CostCenter,
            t3.IDNumber AS HomeroomID,
            CONCAT(t3.FirstName, ' ', t3.LastName) AS Homeroom
          FROM tbl_12_fin_transaction AS mas
          LEFT JOIN tbl_12_fin_std_charge_det AS t1
            ON mas.IDNumber = t1.NIS
          LEFT JOIN tbl_08_job_info AS t2
            ON t1.CostCenter = t2.Homeroom
          LEFT JOIN tbl_07_personal_bio AS t3
            ON t2.IDNumber = t3.IDNumber
          LEFT JOIN tbl_04_class_rooms AS t4
            ON t1.CostCenter = t4.RoomDesc
          LEFT JOIN tbl_04_class_rooms_vocational AS t4v
            ON t1.CostCenter = t4v.RoomDesc
          LEFT JOIN tbl_03_class AS t5
            ON t4.ClassID = t5.ClassID
          LEFT JOIN tbl_03_class AS t5v
            ON t4v.ClassID = t5v.ClassID
          WHERE mas.CtrlNo = (SELECT MAX(CtrlNo) 
                              FROM tbl_12_fin_transaction
                              WHERE IDNumber = mas.IDNumber)
          GROUP BY IDNumber, mas.AccNo
          ORDER BY t5.ClassNumeric, t5v.ClassNumeric, t1.CostCenter, t1.FullName"
      )->result_array();
   }

   public function get_new_receive_docno(){
      $iteration = date('Y') . '-' . date('m');
      $docno = $this->db->select('DocNo')
                        ->get_where('tbl_12_fin_std_charge_mas', "DocNo LIKE '$iteration%'")
                        ->num_rows() + 1;

      $docno = $iteration . str_pad($docno, 2, 0, STR_PAD_LEFT);

      return $docno;
   }

   public function get_currency(){
      return $this->db->get('tbl_12_fin_mas_cur')->result();
   }

   public function get_std_last_balance($nis){
      $query = $this->db->select('Balance')
                    ->limit(1)
                    ->order_by('CtrlNo', 'DESC')
                    ->get_where('tbl_12_fin_transaction', [
                       'IDNumber' => $nis
                    ])->row();

      $last_balance = ($query ? $query->Balance : 0);

      return $last_balance;
   }

   public function get_branch_balance($branch){
      $query = $this->db->select('BalanceBranch')
                    ->limit(1)
                    ->order_by('CtrlNo', 'DESC')
                    ->get_where('tbl_12_fin_transaction', [
                       'Branch' => $branch
                    ])->row();

      return ($query ? $query->BalanceBranch : 0);
   }

   public function get_gl_balance(){
         $query = $this->db->select('BalanceGL')
                     ->limit(1)
                     ->order_by('CtrlNo', 'DESC')
                     ->get('tbl_12_fin_transaction')->row();

         return ($query ? $query->BalanceGL : 0);
   }

   public function get_group_charge($nis, $accno){
      return $this->db->select("YearCharge, MonthCharge, REPLACE(FORMAT(Amount, 0, 'id_ID'), '.', '') AS Amount")->get_where('tbl_12_fin_std_charge_det', [
                           'NIS' => $nis,
                           'AccNo' => $accno
                      ])->result();  
   }

   public function submit_receipt($detail){
      
      $this->db->insert_batch('tbl_12_fin_transaction', $detail);
      
      return ($this->db->affected_rows() ? 'success' : this->db->error());
   }
}
