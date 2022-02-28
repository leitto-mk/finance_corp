<?php defined('BASEPATH') or exit('No direct script access allowed');

class DirectPurchase_Model extends CI_Model
{
  public function M_get_supplier($where)
  {
    $query = $this->db
      ->select('SupplierCode as id, CONCAT(SupplierCode, " - ", SupplierName) as text')
      ->get_where('tbl_mat_cat_supplier', $where);

    return $query;
  }

  public function M_get_cost_center($where)
  {
    $query = $this->db
      ->select('CostCenter as id, CONCAT(CostCenter, " - ", CCDes) as text')
      ->get_where('abase_04_cost_center', $where);

    return $query;
  }

  public function M_get_account_code($where)
  {
    $query = $this->db
      ->select('CostCenter as id, CONCAT(CostCenter, " - ", CCDes) as text')
      ->get_where('abase_04_cost_center', $where);

    return $query;
  }

  public function M_get_price_data($where)
  {
    $query = $this->db->get_where('tbl_mat_stock_costprice', $where);

    return $query;
  }

  public function M_get_price_tbv_data($where)
  {
    $avg = $this->db->get_where('tbv_mat_stock_costprice_avg', $where)->row_array();
    $fifo = $this->db->get_where('tbv_mat_stock_costprice_fifo', $where)->row_array();
    $lifo = $this->db->get_where('tbv_mat_stock_costprice_lifo', $where)->row_array();

    $data = [
      'avg' => $avg['PriceAVG'] ?? 0,
      'fifo' => $fifo['PriceFIFO'] ?? 0,
      'lifo' => $lifo['PriceLIFO'] ?? 0
    ];

    return $data;
  }

  public function M_create_direct_purchase($data)
  {
    extract($data);

    $this->db->trans_start();
    $this->db->insert('tbl_mat_po_v2', $data_mat_po);
    $this->db->insert_batch('tbl_mat_po_det_v2', $data_mat_po_det);
    $this->db->insert_batch('tbl_mat_stock_received', $data_received);
    $this->db->insert_batch('tbl_mat_stock_trans', $data_stock_trans);
    $this->db->insert('tbl_pos_trans', $data_pos_trans);
    $this->db->update_batch('tbl_mat_stock_reg', $data_stockreg, 'CtrlNo');
    $this->db->update_batch('tbl_mat_stock', $data_stock, 'CtrlNo');
    $this->db->trans_complete();

    if ($this->db->trans_status()) {
      $this->db->trans_commit();

      return 'success';
    } else {
      $this->db->trans_rollback();

      return $this->db->error();
    }
  }

  public function M_update_price($data)
  {
    extract($data);

    $this->db->trans_start();
    if ($data_update_price) {
      $this->db->update_batch('tbl_mat_stock_costprice', $data_update_price, 'CtrlNo');
    }
    if ($data_price) {
      $this->db->insert_batch('tbl_mat_stock_costprice', $data_price);
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

  public function M_get_direct_purchase_master($where)
  {
    $query = $this->db
      ->select('master.CtrlNo, master.PurchaseOrderID as DocNo, master.SupInvoiceNo as InvoiceNo, master.PORemarks as Description, master.SupplierID, CONCAT(master.SupplierID, " - ", supplier.SupplierName) as Supplier, master.Term, master.DueDate, master.POStatus, master.ApprovedBy, master.ApprovedStatus, master.PaymentStatus, master.GrandTotal as Amount, master.RaiseDate, master.QuoteRefNo as RefNo, master.BillTo, master.ShipTo, CONCAT(master.ShipTo, " - ", storage.StorageName) as Storage, master.FreightService as Freight, master.DeliveryMethod as Shipment, master.FreightInfo, CONCAT(master.RaiseBy, " - ", raise_user.username) as RaisedBy, master.SubTotal, master.Tax as TaxPercent, master.TaxAmount as Tax, master.FreightCost, master.Discount as DiscPercent, master.DiscAmount as Discount, CONCAT(master.ApprovedBy, " - ", approve_user.username) ApprovedBy, master.ApprovedDate')
      ->join('tbl_mat_cat_supplier supplier', 'supplier.SupplierCode = master.SupplierID', 'LEFT')
      ->join('tbl_mat_cat_storage storage', 'master.ShipTo = storage.StorageCode', 'LEFT')
      ->join('db_abase_pos_users.tbl_users as raise_user', 'raise_user.user_id = master.RaiseBy', 'LEFT')
      ->join('db_abase_pos_users.tbl_users as approve_user', 'approve_user.user_id = master.ApprovedBy', 'LEFT') 
      ->get_where('tbl_mat_po_v2 master', $where);

    return $query;
  }

  public function M_get_direct_purchase_detail($where)
  {
    $query = $this->db
      ->select('detail.ItemID as ID, detail.StockCode as StockID, detail.Stockcode, detail.StockDesc, detail.UOM, detail.Currency, detail.Qty, detail.ItemPrice as Price, detail.Discount, detail.TotalAmount')
      ->get_where('tbl_mat_po_det_v2 detail', $where);

    return $query;
  }
}
