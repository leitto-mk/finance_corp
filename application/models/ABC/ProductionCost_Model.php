<?php defined('BASEPATH') or exit('No direct script access allowed');

class ProductionCost_Model extends CI_Model
{
  public function M_get_production_cost()
  {
    $check_table = $this->db
      ->query('SELECT EXISTS (SELECT 1 FROM tbl_mat_production_cost) as Result')
      ->row_array();

    if ($check_table['Result'] > 0) {
      $query = $this->db->query("CALL get_production_cost()");
      $result = $query->result_array();

      $query->next_result();
      $query->free_result();
    } else {
      $result = false;
    }

    return $result;
  }

  public function M_get_group($where)
  {
    $query = $this->db->get_where('tbl_mat_abc_mas_type_perc', $where);

    return $query;
  }

  public function M_get_type($where)
  {
    $query = $this->db->get_where('tbl_mat_abc_mas_type', $where);

    return $query;
  }
}
