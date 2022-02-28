<?php defined('BASEPATH') or exit('No direct script access allowed');

class InventoryStock_Model extends CI_Model
{
  public function M_get_stock($where)
  {
    $query = $this->db
      ->select('stockreg.CtrlNo, stockcode.Stockcode, stockcode.StockDescription, stockcode.UOM, stockreg.SOH, stockreg.SAV, stockreg.SOO, stockreg.SOR, stockreg.CombineStock')
      ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = stockreg.Stockcode', 'LEFT')
      ->get_where('tbl_mat_stock_reg stockreg', $where);

    // print_r($this->db->last_query());

    return $query;
  }

  public function M_get_stock_detail($where)
  {
    $query = $this->db
      ->select('stockcode.Stockcode, stockcode.StockDescription, CONCAT(stockcode.StockGroup, " - ", group.GroupDescription) as StockGroup, stockcode.Photo')
      ->join('tbl_mat_mas_stock_d_grp group', 'group.GroupCode = stockcode.StockGroup', 'LEFT')
      ->get_where('tbl_mat_stockcode stockcode', $where);

    return $query;
  }

  public function M_get_stockreg($where)
  {
    $query = $this->db
      ->select('stockreg.Bin1, stockreg.Min, stockreg.Max, stockreg.SOH, storage.StorageName, stockreg.Storage')
      ->join('tbl_mat_cat_storage storage', 'storage.StorageCode = stockreg.Storage', 'LEFT')
      ->get_where('tbl_mat_stock_reg stockreg', $where);

    return $query;
  }

  public function M_get_received($where, $in)
  {
    $query = $this->db
      ->select('QtyToReceived as Qty, ReceivedDate as TransDate, "Receipt" as Type')
      ->where_in('received.StorageCode', $in)
      ->get_where('tbl_mat_stock_received received', $where);

    return $query;
  }

  public function M_get_issue($where, $in)
  {
    $query = $this->db
      ->select('detail.qty as Qty, DATE_FORMAT(master.sale_date, "%Y-%m-%d") as TransDate, "Issued" as Type')
      ->join('tbl_sale_pos master', 'master.sale_doc_no = detail.sale_doc_no', 'LEFT')
      ->where_in('detail.storagecode', $in)
      ->get_where('tbl_sale_pos_det detail', $where);

    return $query;
  }

  public function M_get_history($where)
  {
    $received = $this->M_get_received([
      'Stockcode' => $where['Stockcode']
    ], $where['Storage'])->result_array();

    $issued = $this->M_get_issue([
      'stock_code' => $where['Stockcode'],
      'COStatus' => 'Completed'
    ], $where['Storage'])->result_array();

    $data = array_merge_recursive($received, $issued);
    usort($data, function ($a, $b) {
      return strtotime($b['TransDate']) - strtotime($a['TransDate']);
    });

    return $data;
  }
}
