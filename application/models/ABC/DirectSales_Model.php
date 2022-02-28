<?php defined('BASEPATH') or exit('No direct script access allowed');

class DirectSales_Model extends CI_Model
{
  public function M_get_cost_percentage($where)
  {
    $query = $this->db
      ->select('group.ComGrp as ID, group.ComGrpDes as Description, percentage.Percentage')
      ->join('tbl_mat_abc_mas_type_perc percentage', 'group.ComGrp = percentage.ComGrp', 'LEFT')
      ->get_where('tbl_mat_abc_mas_type_grp group', $where);

    return $query;
  }

  public function M_get_direct_sales($where)
  {
    $query = $this->db
      ->select('pos.ctrl_no as CtrlNo, DATE_FORMAT(pos.sale_date, "%Y-%m-%d") as Date, pos.sale_doc_no as DocNo, CONCAT(pos.submit_by, " - ", raise_user.username) as Seller, pos.end_balance as Amount, pos.payment_type as Method, pos.payment_status as Status, CONCAT(pos.CustomerID, " - ", cust.CustomerName)  as Customer, pos.sale_remark as Remarks, pos.total_sale as SubTotal, pos.discount as Discount, pos.tax as Tax, pos.end_balance as GrandTotal, pos.payment as TotalPayment, det.storagecode as Storage')
      ->group_by('pos.sale_doc_no')
      ->join('tbl_sale_pos_det det', 'pos.sale_doc_no = det.sale_doc_no', 'LEFT')
      ->join('tbl_mat_cat_customer as cust', 'cust.CustomerCode = pos.CustomerID')
      ->join('db_abase_pos_users.tbl_users as raise_user', 'raise_user.user_id = pos.submit_by', 'LEFT')
      //->where('YEAR(pos.sale_date) = YEAR(CURDATE())')select current year - tambahan dari chio bole di hapus 
      ->get_where('tbl_sale_pos pos', $where);

    return $query;
  }

  public function M_get_direct_sales_detail($where)
  {
    $query = $this->db
      ->select('stockcode.Stockcode, stockcode.StockDescription, det.qty as Qty, det.price as Price, det.discount as Discount, det.total_discount as TotalDiscount, det.tax as Tax, det.total_tax as TotalTax, det.amount as Amount')
      ->join('tbl_mat_stockcode stockcode', 'det.stock_code = stockcode.Stockcode', 'LEFT')
      ->get_where('tbl_sale_pos_det det', $where);

    return $query;
  }

  public function M_get_stockcode_data($where)
  {
    $query = $this->db
      ->select('stockcode.Stockcode, stockcode.StockDescription, stockreg.SAV')
      ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = stockreg.Stockcode')
      ->get_where('tbl_mat_stock_reg stockreg', $where);

    return $query;
  }

  public function M_get_stock_trans_data($where)
  {
    $query = $this->db
      ->select('qty_bal, qty_reg, item_no_trans, item_no, cost_price_stand, cost_price_native,  fifo_id, total_amount_tbv, trans_type, qty_in, qty_out, cost_price_set, tot_bal_right, remain_fifo_i, cost_price_type')
      ->order_by('ctrl_no', 'DESC')
      ->get_where('tbl_mat_stock_trans', $where);

    return $query;
  }

  public function M_get_stockreg_data($where)
  {
    $query = $this->db
      ->select('CtrlNo, BB_SOH, SOH, SAV, SOR, SOO, CombineStock, BB_CostPrice, CostPriceType, CostPrice')
      ->get_where('tbl_mat_stock_reg', $where);

    return $query;
  }

  public function M_get_stock_data($where)
  {
    $query = $this->db
      ->select('CtrlNo, SOH')
      ->get_where('tbl_mat_stock', $where);

    return $query;
  }

  public function M_get_fifo_process($where)
  {
    $query = $this->db
      ->select('ctrl_no, switch_cost, qty_in, qty_out, cost_price_stand, item_no_trans, qty, qty_reg, remain_fifo_i, remain_fifo')
      ->get_where('tbl_mat_stock_trans', $where);

    return $query;
  }

  public function M_check_stockreg($where, $in = null)
  {
    $query = $this->db
      ->select("SAV, Stockcode")
      ->where_in('Stockcode', $in)
      ->get_where('tbl_mat_stock_reg', $where);

    return $query;
  }

  public function M_get_trans_id()
  {
    $year = date('y');
    $id = $this->db
      ->select('RIGHT(MAX(trans_id), 7) as last_id')
      ->like('trans_id', 'T-' . $year, 'after')
      ->get('tbl_pos_trans')->row_array()['last_id'];

    $number = $id + 1 ?? '1';
    $result = 'T-' . $year . str_pad($number, 7, '0', STR_PAD_LEFT);

    return $result;
  }

  public function M_create_direct_sales($data)
  {
    extract($data);

    $this->db->trans_start();
    $this->db->insert('tbl_sale_pos', $data_master);
    $this->db->insert_batch('tbl_sale_pos_det', $data_detail);
    $this->db->insert('tbl_pos_trans', $data_pos_trans);
    $this->db->insert_batch('tbl_mat_stock_trans', $data_trans);
    $this->db->update_batch('tbl_mat_stock', $data_update_stock, 'CtrlNo');
    $this->db->update_batch('tbl_mat_stock_reg', $data_update_stockreg, 'CtrlNo');
    if ($data_update_fifo) {
      $this->db->update_batch('tbl_mat_stock_trans', $data_update_fifo, 'ctrl_no');
    }
    $this->db->insert_batch('tbl_mat_production_cost', $data_production_cost);
    $this->db->trans_complete();

    if ($this->db->trans_status()) {
      $this->db->trans_commit();

      return 'success';
    } else {
      $this->db->trans_rollback();

      return $this->db->error();
    }
  }

  public function M_get_customer_price($where)
  {
    $query = $this->db
      ->select('Price')
      ->order_by('CtrlNo', 'DESC')
      ->limit(1)
      ->get_where('tbl_mgt_price', $where);

    return $query;
  }

  public function M_get_customer_data($where)
  {
    $query = $this->db
      ->select('CONCAT(CustomerType, " - ", CustTypeDesc) as CustomerType, CustomerType as Type')
      ->join('tbl_mat_cat_customer_price type', 'customer.CustomerType = type.CustType', 'LEFT')
      ->get_where('tbl_mat_cat_customer customer', $where);

    return $query;
  }

  public function M_get_product_point($where)
  {
    $query = $this->db
      ->select('stockcode.ProductPoint, price.Price')
      ->join('tbl_mgt_price price', 'stockcode.Stockcode = price.Stockcode', 'LEFT')
      ->get_where('tbl_mat_stockcode stockcode', $where);

    return $query;
  }
}
