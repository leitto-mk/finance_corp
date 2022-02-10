<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_coa extends CI_Model
{
  public function M_get_coaccount($where)
  {
    return $this->db
      ->select('*')
      ->get_where('tbl_fa_account_no', $where);
  }

  public function M_count_level()
  {
    $query = $this->db
      ->select('MAX(Level) as maxLevel, MIN(Level) as minLevel')
      ->get('tbl_fa_account_no')
      ->row_array();

    return $query;
  }

  public function M_get_last_co_number($data)
  {
    extract($data);

    if ($level == 3) {
      $query = $this->db
        ->query("SELECT MAX(SUBSTRING(Acc_No, $level+1, 2)) AS MaxId, SUBSTRING(Acc_No, 1, $level) AS ID FROM tbl_fa_account_no WHERE Parent = $parent")->row_array();
    } elseif ($level == 0) {
      $query = $this->db
        ->query("SELECT MAX(SUBSTRING(Acc_No, $level+1, 1)) AS MaxId, SUBSTRING(Acc_No, 1, $level) AS ID FROM tbl_fa_account_no WHERE Parent IS $parent")->row_array();
    } else {
      $query = $this->db
        ->query("SELECT MAX(SUBSTRING(Acc_No, $level+1, 1)) AS MaxId, SUBSTRING(Acc_No, 1, $level) AS ID FROM tbl_fa_account_no WHERE Parent = $parent")->row_array();
    }
    // print_r($this->db->last_query());
    // die;

    $total = $query['MaxId'];
    if ($total == 0) {
      $total = 1;
    } else {
      $total++;
    }

    if ($query['MaxId'] == null && $query['ID'] == null) {
      $query = $this->db->query("SELECT SUBSTRING(Acc_No,1,$level)AS ID FROM tbl_fa_account_no WHERE ID = $id")->row_array();
    }

    if ($level == 3) {
      $co_number = str_pad($query['ID'], 3, "0") . str_pad($total, 2, "0", STR_PAD_LEFT);
    } else {
      $co_number = str_pad($query['ID'] . $total, 5, "0");
    }

    return $co_number;
  }

  public function M_get_type()
  {
    $query = $this->db->query("SELECT DISTINCT Acc_Type as id, Acc_Type as text FROM tbl_fa_account_no WHERE Disc = 'No'")->result_array();

    return $query;
  }

  public function M_get_group()
  {
    $query = $this->db->query("SELECT DISTINCT TransGroup as id, TransGroup as text FROM tbl_fa_account_no WHERE Disc = 'No'")->result_array();

    return $query;
  }

  public function M_get_account_type()
  {
    return $this->db->select('AccGroup as id, CONCAT(AccGroup, " - ", AccGroupDes) as text')
      ->get_where('tbl_fa_account_group_mas');
  }

  public function M_insert_coa($data)
  {
    $this->db->trans_start();
    $this->db->insert('tbl_fa_account_no', $data);
    $this->db->trans_complete();

    if ($this->db->trans_status()) {
      $this->db->trans_commit();

      return 'success';
    } else {
      $this->db->trans_rollback();

      return $this->db->error();
    }
  }

  public function M_update_coa($data, $where)
  {
    $this->db->trans_start();
    $this->db->update('tbl_fa_account_no', $data, $where);
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