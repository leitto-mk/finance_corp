<?php defined('BASEPATH') or exit('No direct script access allowed');

class Report_Model extends CI_Model
{
  public function M_get_stockcard_report($where = null, $branch)
  {
    $storage_iph = 'S-01';
    $query = $this->db
      ->select('stockreg.Stockcode, stockcode.StockDescription as StockName, (MAX(CASE WHEN stockreg.BB_SOH > 0 AND stockreg.BranchCode = "' . $branch . '" THEN stockreg.BB_SOH ELSE 0 END) + SUM(CASE WHEN stocktrans.trans_type = "Receive" AND company_code = "' . $branch . '" AND MONTH(transdate) < MONTH(current_date()) THEN stocktrans.qty ELSE 0 END) - SUM(CASE WHEN stocktrans.trans_type = "Issue" AND company_code = "' . $branch . '" AND MONTH(transdate) < MONTH(current_date()) THEN stocktrans.qty ELSE 0 END)) QtyStart, SUM(CASE WHEN stocktrans.trans_type = "Receive" AND company_code = "' . $branch . '" AND MONTH(transdate) = MONTH(current_date()) THEN stocktrans.qty ELSE 0 END) as QtyIn, SUM(CASE WHEN stocktrans.trans_type = "Issue" AND company_code = "' . $branch . '" AND MONTH(transdate) = MONTH(current_date()) THEN stocktrans.qty ELSE 0 END) QtyOut, (SUM(CASE WHEN stocktrans.trans_type = "Receive" AND company_code = "' . $branch . '" AND MONTH(transdate) = MONTH(current_date()) THEN stocktrans.qty ELSE 0 END) - SUM(CASE WHEN stocktrans.trans_type = "Issue" AND company_code = "' . $branch . '" AND MONTH(transdate) = MONTH(current_date()) THEN stocktrans.qty ELSE 0 END)) QtyEnd, MAX(CASE WHEN stockreg.SAV > 0 AND stockreg.Storage = "' . $storage_iph . '" THEN stockreg.SAV ELSE 0 END) as QtyIPH, MAX(CASE WHEN stockreg.BB_SOH > 0 AND stockreg.BranchCode = "' . $branch . '" THEN stockreg.BB_SOH ELSE 0 END) as BB_SOH')
      ->group_by(['stockcode.Stockcode'])
      ->join('tbl_mat_cat_storage storage', 'storage.StorageCode = stockreg.Storage', 'LEFT')
      ->join('tbl_mat_stock_trans stocktrans', 'stockreg.Stockcode = stocktrans.stock_code AND stockreg.BranchCode = stocktrans.company_code', 'LEFT')
      ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = stockreg.Stockcode', 'LEFT')
      ->join('tbl_mat_stock stock', 'stock.Stockcode = stockreg.Stockcode', 'LEFT')
      ->get_where('tbl_mat_stock_reg stockreg', $where);

    return $query;
  }

  public function M_get_branch_data($where)
  {
    $query = $this->db
      ->select('storage.StorageName, storage.Address')
      ->limit(1)
      ->order_by('storage.CtrlNo', 'ASC')
      ->join('abase_02_branch branch', 'branch.BranchCode = storage.BranchCode', 'LEFT')
      ->get_where('tbl_mat_cat_storage storage', $where);

    return $query;
  }

  public function M_get_sales_data($where)
  {
    $query = $this->db
      ->select('master.sale_doc_no as DocNo, CONCAT(master.CustomerID, , " - ",customer.CustomerName) as Customer, master.sale_date as SaleDate, master.total_sale as SubTotal, master.end_balance as GrandTotal, CONCAT(hr.Supervisor, " - ", hr.SupervisorName) as Supervisor, master.sale_remark as Remarks, master.total_tax as Tax')
      ->join('tbl_mat_cat_customer customer', 'master.CustomerID = customer.CustomerCode', 'LEFT')
      ->join('tbl_fa_hr_append hr', 'hr.CustomerRefNo = master.CustomerID', 'LEFT')
      ->get_where('tbl_sale_pos master', $where);

    return $query;
  }

  public function M_get_sales_detail_data($where)
  {
    $query = $this->db
      ->select('stockcode.Stockcode, stockcode.StockDescription, stockcode.UOM, detail.qty as Qty, detail.price as Price, detail.amount as Amount')
      ->join('tbl_mat_stockcode stockcode', 'detail.stock_code = stockcode.Stockcode', 'LEFT')
      ->get_where('tbl_sale_pos_det detail', $where);

    return $query;
  }

  public function M_get_assistance($where)
  {
    $query = $this->db
      ->select('IDNumber as id, CONCAT(IDNumber, " - ", FullName) as text')
      ->get_where('tbl_fa_hr_append', $where);

    return $query;
  }

  // ? Still used ?
  public function M_get_hr_data($where, $branch = null)
  {
    $query = $this->db
      ->select('IDNumber as ID, FullName as Name, JobTitleDes as JobTitle, CONCAT(Supervisor, " - ", SupervisorName) as Supervisor, sales.sale_doc_no, sales_detail.stock_code, sales_detail.qty, sales_detail.price, pcost.TypeDescription, pcost.Percentage, pcost.Amount')
      ->join('tbl_sale_pos sales', 'sales.CustomerID = hr.CustomerRefNo AND sales.BranchCode = "' . $branch . '"', 'LEFT')
      ->join('tbl_sale_pos_det sales_detail', 'sales_detail.sale_doc_no = sales.sale_doc_no', 'LEFT')
      ->join('tbl_mat_production_cost pcost', 'pcost.SalesNo = sales.sale_doc_no AND sales_detail.stock_code = pcost.Stockcode', 'LEFT')
      ->get_where('tbl_fa_hr_append hr', $where);

    print_r($this->db->last_query());
    die;

    return $query;
  }

  public function M_get_le_sales_data($employee, $branch, $start, $end)
  {
    $check_table = $this->db
      ->query('SELECT EXISTS (SELECT 1 FROM tbl_mat_production_cost) as Result')
      ->row_array();

    if ($check_table['Result'] > 0) {
      $query = $this->db->query("CALL get_hr_report('$employee', $branch, '$start', '$end')");
      $result = $query->result_array();

      $query->next_result();
      $query->free_result();
    } else {
      $result = false;
    }

    return $result;
  }

  public function M_get_le_sales_detail_data($employee, $branch, $start, $end)
  {
    $check_table = $this->db
      ->query('SELECT EXISTS (SELECT 1 FROM tbl_mat_production_cost) as Result')
      ->row_array();

    if ($check_table['Result'] > 0) {
      $query = $this->db->query("CALL get_hr_report_by_stockcode('$employee', $branch, '$start', '$end')");
      $result = $query->result_array();

      $query->next_result();
      $query->free_result();
    } else {
      $result = false;
    }

    return $result;
  }
}
