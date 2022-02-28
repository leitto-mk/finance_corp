<?php defined('BASEPATH') or exit('No direct script access allowed');

class BackOrder_Model extends CI_Model
{
  public function M_get_back_order($where)
  {
    $query = $this->db
      ->select('CtrlNo as ID, RegDate as Date, BONo as DocNo, Status, Remarks as Description')
      ->get_where('tbl_mat_backorder', $where);

    return $query;
  }

  public function M_get_back_order_master($where)
  {
    $query = $this->db
      ->select('master.CtrlNo, master.RegDate as Date, master.BONo as DocNo, master.Status, master.Remarks as Description, CONCAT(master.RegBy, " - ", reg_user.username) as RegBy, reg_user.username as RegName, CONCAT(ApprovedBy, " - ", approved_user.username) as ApprovedBy, ApprovedDate')
      ->join('db_abase_pos_users.tbl_users as reg_user', 'reg_user.user_id = master.RegBy', 'LEFT')
      ->join('db_abase_pos_users.tbl_users as approved_user', 'approved_user.user_id = master.ApprovedBy', 'LEFT')
      ->get_where('tbl_mat_backorder master', $where);

    return $query;
  }

  public function M_get_back_order_detail($where)
  {
    $query = $this->db
      ->select('stockcode.Stockcode, stockcode.StockDescription as BookName, detail.Qty as Ordered, detail.InvoiceQty as Invoice, detail.OutstandingQty as Outstanding, detail.Remarks')
      ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = detail.Stockcode', 'LEFT')
      ->get_where('tbl_mat_backorder_detail detail', $where);

    return $query;
  }

  public function M_get_back_order_transfered($where)
  {
    $query = $this->db
      ->select('det.StockCode as Stockcode, det.StockDesc as BookName, stockcode.UOM, MAX(CASE WHEN bo_det.InvoiceQty THEN bo_det.InvoiceQty ELSE 0 END) as Transferred, MAX(CASE WHEN bo_det.Qty THEN bo_det.Qty ELSE 0 END) as Ordered, MAX(CASE WHEN received.QtyReceived THEN received.QtyReceived ELSE 0 END) as Received, MIN(CASE WHEN received.QtyOutstanding THEN received.QtyOutstanding ELSE 0 END) Outstanding')
      ->group_by('det.StockCode')
      ->join('tbl_mat_po_v2 po', 'po.PurchaseOrderID = det.PurchaseOrderId', 'LEFT')
      ->join('tbl_mat_stock_received received', 'received.PONo = po.QuoteRefNo AND received.Stockcode = det.StockCode', 'LEFT')
      ->join('tbl_mat_backorder_detail bo_det', 'bo_det.BONo = po.QuoteRefNo AND bo_det.Stockcode = det.StockCode', 'LEFT')
      ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = det.StockCode', 'LEFT')
      ->get_where('tbl_mat_po_det_v2 det', $where);

    return $query;
  }

  public function M_get_back_order_received($where)
  {

    $query = $this->db
      ->select('stockcode.Stockcode, stockcode.StockDescription as BookName, stockcode.UOM, detail.Qty as Ordered, MAX(CASE WHEN received.QtyReceived THEN received.QtyReceived ELSE 0 END) as Received, MIN(CASE WHEN received.QtyOutstanding THEN received.QtyOutstanding ELSE 0 END) Outstanding')
      ->group_by('stockcode.Stockcode')
      ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = detail.Stockcode', 'LEFT')
      ->join('tbl_mat_stock_received received', 'received.PONo = detail.BONo AND received.Stockcode = detail.Stockcode', 'LEFT')
      ->get_where('tbl_mat_backorder_detail detail', $where);

    // $query = $this->db
    //   ->select('stockcode.Stockcode, stockcode.StockDescription as BookName, stockcode.UOM, detail.Qty as Ordered, 0 as Received, 0 as Outstanding')
    //   ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = detail.Stockcode', 'LEFT')
    //   ->get_where('tbl_mat_backorder_detail detail', $where);

    return $query;
  }

  public function M_get_back_order_progress($where, $branch)
  {
    $query = $this->db
      ->select('CONCAT(approved_user.username) as ApprovedBy, backorder.ApprovedDate as ApprovedDate, backorder.Remarks, bo_detail.CtrlNo as ID, SUM(CASE WHEN bo_detail.BranchCode = ' . $branch . ' THEN bo_detail.Qty ELSE 0 END) as Ordered, SUM(CASE WHEN bo_detail.BranchCode = ' . $branch . ' THEN bo_detail.InvoiceQty ELSE 0 END) as Invoice, SUM(CASE WHEN bo_detail.BranchCode = ' . $branch . ' THEN bo_detail.OutstandingQty ELSE 0 END) as Outstanding, stockcode.Stockcode, stockcode.StockDescription')
      ->group_by('stockcode.Stockcode')
      ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = bo_detail.Stockcode', 'LEFT')
      ->join('tbl_mat_backorder backorder', 'bo_detail.BONo = backorder.BONo', 'LEFT')
      ->join('db_abase_pos_users.tbl_users as approved_user', 'approved_user.user_id = backorder.ApprovedBy', 'LEFT')
      ->get_where('tbl_mat_backorder_detail bo_detail', $where);

    return $query;
  }

  public function M_get_book_data($where, $in, $branch_code)
  {
    $query = $this->db
      ->select('stockcode.Stockcode, stockcode.StockDescription as BookName, cat.CatDescription as Category, SUM(CASE WHEN bo_detail.BranchCode = ' . $branch_code . ' AND bo.Status = "Process" THEN bo_detail.OutstandingQty ELSE 0 END) as Qty')
      ->group_by('stockcode.CtrlNo')
      ->join('tbl_mat_backorder_detail bo_detail', 'bo_detail.Stockcode = stockcode.Stockcode', 'LEFT')
      ->join('tbl_mat_backorder bo', 'bo.BONo = bo_detail.BONo', 'LEFT')
      ->join('tbl_mat_mas_stock_d_grp grp', 'stockcode.StockGroup = grp.GroupCode', 'LEFT')
      ->join('tbl_mat_mas_stock_c_type type', 'grp.TypeCode = type.TypeCode', 'LEFT')
      ->join('tbl_mat_mas_stock_b_cat cat', 'cat.CatCode = type.CatCode', 'LEFT')
      ->where_in('cat.CatCode', $in)
      ->get_where('tbl_mat_stockcode stockcode', $where);

    return $query;
  }

  public function M_get_book($where, $in)
  {
    $query = $this->db
      ->select('stockcode.Stockcode as id, stockcode.StockDescription as text')
      ->join('tbl_mat_mas_stock_d_grp grp', 'stockcode.StockGroup = grp.GroupCode', 'LEFT')
      ->join('tbl_mat_mas_stock_c_type type', 'grp.TypeCode = type.TypeCode', 'LEFT')
      ->join('tbl_mat_mas_stock_b_cat cat', 'cat.CatCode = type.CatCode', 'LEFT')
      ->where_in('cat.CatCode', $in)
      ->get_where('tbl_mat_stockcode stockcode', $where);

    return $query;
  }

  public function M_count_bo()
  {
    $query = $this->db->query("SELECT * FROM tbl_mat_backorder WHERE MONTH(RegDate) = MONTH(curdate())");

    return $query;
  }

  public function M_insert_back_order($data)
  {
    extract($data);

    $this->db->trans_start();
    $this->db->insert('tbl_mat_backorder', $master);
    $this->db->insert_batch('tbl_mat_backorder_detail', $detail);
    $this->db->update_batch('tbl_mat_stock_reg', $update_stockreg, 'CtrlNo');
    $this->db->trans_complete();

    if ($this->db->trans_status()) {
      $this->db->trans_commit();

      return 'success';
    } else {
      $this->db->trans_rollback();

      return $this->db->error();
    }
  }

  public function M_get_stockcode_data($where)
  {
    $query = $this->db
      ->select('stockreg.CtrlNo, stockreg.SOO, stockreg.CombineStock, stockcode.StockDescription, stockcode.Stockcode')
      ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = stockreg.Stockcode', 'LEFT')
      ->get_where('tbl_mat_stock_reg stockreg', $where);

    return $query;
  }

  public function M_get_mat_stockcode_data($where)
  {
    $query = $this->db
      ->select('StockDescription')
      ->get_where('tbl_mat_stockcode', $where);

    return $query;
  }

  public function M_get_sales_order($where)
  {
    $query = $this->db
      ->select('detail.ItemPrice, detail.Qty, master.PurchaseOrderID')
      ->order_by('detail.ItemID', 'Desc')
      ->join('tbl_mat_po_v2 master', 'master.PurchaseOrderID = detail.PurchaseOrderID', 'LEFT')
      ->get_where('tbl_mat_po_det_v2 detail', $where);

    return $query;
  }

  public function M_get_received($where)
  {
    $query = $this->db
      ->select('*')
      ->order_by('CtrlNo', 'Desc')
      ->get_where('tbl_mat_stock_received', $where);

    return $query;
  }

  public function M_create_receive_back_order($data)
  {
    extract($data);

    $this->db->trans_start();
    $this->db->insert_batch('tbl_mat_stock_received', $data_insert_receive);
    $this->db->update_batch('tbl_mat_stock_reg', $data_stockreg, 'CtrlNo');
    $this->db->update_batch('tbl_mat_stock', $data_stock, 'CtrlNo');
    $this->db->insert_batch('tbl_mat_stock_trans', $data_stock_trans);
    $this->db->trans_complete();

    if ($this->db->trans_status()) {
      $this->db->trans_commit();

      return 'success';
    } else {
      $this->db->trans_rollback();

      return $this->db->error();
    }
  }

  public function M_get_sales_order_data($where)
  {
    $query = $this->db
      ->select('ApprovedStatus')
      ->order_by('CtrlNo', 'DESC')
      ->get_where('tbl_mat_po_v2', $where);

    return $query;
  }

  public function M_update_bo($data)
  {
    $this->db->update_batch('tbl_mat_backorder', $data, 'BONo');
  }
}
