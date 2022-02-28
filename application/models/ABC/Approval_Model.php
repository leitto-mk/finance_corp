<?php defined('BASEPATH') or exit('No direct script access allowed');

class Approval_Model extends CI_Model
{
  public function M_dashboard_approval($data)
  {
    extract($data);

    $this->db->trans_start();
    if ($data_so) {
      $this->db->update_batch('tbl_mat_po_v2', $data_so, 'CtrlNo');
    }
    if ($data_bo) {
      $this->db->update_batch('tbl_mat_backorder', $data_bo, 'CtrlNo');
    }
    if ($data_mr) {
      $this->db->update_batch('tbl_mat_request', $data_mr, 'CtrlNo');
    }
    if ($data_stockreg) {
      $this->db->update_batch('tbl_mat_stock_reg', $data_stockreg, 'CtrlNo');
    }
    $this->db->trans_complete();

    if ($this->db->trans_status()) {
      $this->db->trans_commit();

      return 'success';
    } else {
      $this->db->trans_rollback();

      return $this->db->error();
    }
  }
}
