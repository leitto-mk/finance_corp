<?php defined('BASEPATH') or exit('No direct script access allowed');

class SalesOrder_Model extends CI_Model
{
  public function M_get_branch($where)
  {
    $query = $this->db->get_where('abase_02_branch', $where);

    return $query;
  }

  public function M_get_sales_order($where)
  {
    $query = $this->db
      ->select('master.CtrlNo, master.PurchaseOrderID as DocNo, master.PORemarks as Description, CONCAT(master.SupplierID, " - ", customer.CustomerName) as Customer, master.Term, master.DueDate, master.POStatus as SOStatus, master.ApprovedBy,master.ApprovedStatus, master.PaymentStatus, master.GrandTotal as Amount, master.RaiseDate, raise_user.username as RaisedBy')
      ->join('tbl_mat_cat_customer customer', 'customer.CustomerCode = master.SupplierID', 'LEFT')
      ->join('db_abase_pos_users.tbl_users as raise_user', 'raise_user.user_id = master.RaiseBy', 'LEFT')
      ->get_where('tbl_mat_po_v2 master', $where);

    return $query;
  }

  public function M_get_sales_order_master($where)
  {
    $query = $this->db
      ->select('master.CtrlNo, master.PurchaseOrderID as DocNo, master.PORemarks as Description, master.SupplierID as CustomerID, CONCAT(master.SupplierID, " - ", customer.CustomerName) as Customer, master.Term, master.DueDate, master.POStatus as SOStatus, master.ApprovedBy,master.ApprovedStatus, master.PaymentStatus, master.GrandTotal as Amount, master.RaiseDate, customer.Address, master.QuoteRefNo as RefNo, master.BillTo, master.ShipTo, master.Storage as StorageID, CONCAT(master.Storage, " - ",storage.StorageName) as Storage, master.FreightService as Freight, master.DeliveryMethod as Shipment, master.FreightInfo, CONCAT(master.RaiseBy, " - ", raise_user.username) as RaisedBy, master.SubTotal, master.Tax as TaxPercent, master.TaxAmount as Tax, master.FreightCost, master.Discount as DiscPercent, master.DiscAmount as Discount, CONCAT(master.ApprovedBy, " - ", approve_user.username) ApprovedBy, master.ApprovedDate')
      ->join('tbl_mat_cat_customer customer', 'customer.CustomerCode = master.SupplierID', 'LEFT')
      ->join('tbl_mat_cat_storage storage', 'master.Storage = storage.StorageCode', 'LEFT')
      ->join('db_abase_pos_users.tbl_users as raise_user', 'raise_user.user_id = master.RaiseBy', 'LEFT')
      ->join('db_abase_pos_users.tbl_users as approve_user', 'approve_user.user_id = master.ApprovedBy', 'LEFT')
      ->get_where('tbl_mat_po_v2 master', $where);

    return $query;
  }

  public function M_get_sales_order_detail($where)
  {
    $query = $this->db
      ->select('detail.ItemID as ID, detail.StockCode as StockID, CONCAT(detail.StockCode, " - ", detail.StockDesc) as Stockcode, detail.UOM, detail.Currency, detail.Qty, detail.ItemPrice as Price, detail.Discount, detail.TotalAmount')
      // ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = detail.StockCode', 'LEFT')
      ->get_where('tbl_mat_po_det_v2 detail', $where);

    return $query;
  }

  public function M_get_customer($where)
  {
    $query = $this->db
      ->select('CustomerCode as id, CONCAT(CustomerCode, " - ", CustomerName) as text')
      ->get_where('tbl_mat_cat_customer', $where);

    return $query;
  }

  public function M_get_storage($where)
  {
    $query = $this->db
      ->select('StorageCode as id, CONCAT(StorageCode, " - ", StorageName) as text')
      ->get_where('tbl_mat_cat_storage', $where);

    return $query;
  }

  public function M_get_stockcode($where)
  {
    $query = $this->db
      ->select('stockcode.Stockcode as id, CONCAT(stockcode.Stockcode, " - ", stockcode.StockDescription) as text, stockcode.UOM as uom')
      ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = stockreg.Stockcode')
      ->get_where('tbl_mat_stock_reg stockreg', $where);

    return $query;
  }

  public function M_get_currency($where)
  {
    $query = $this->db
      ->select('Currency as id, CONCAT(Currency, " - ", CurrencyName) as text')
      ->get_where('tbl_fa_mas_currency', $where);

    return $query;
  }

  public function M_get_bank($where)
  {
    $query = $this->db
      ->select('BankCode as id, BankName as text')
      ->get_where('tbl_mat_fa_bank', $where);

    return $query;
  }

  public function M_get_customer_type($where)
  {
    $query = $this->db
      ->select('CustomerType as Type')
      ->get_where('tbl_mat_cat_customer', $where);

    return $query;
  }

  public function M_get_price($where)
  {
    $query = $this->db
      ->select('Price')
      ->order_by('CtrlNo', 'DESC')
      ->limit(1)
      ->get_where('tbl_mgt_price', $where);

    return $query;
  }

  public function M_get_stockcode_data($where)
  {
    $query = $this->db
      ->select('stockcode.UOM, stockcode.StockDescription')
      ->join('tbl_mat_stockcode stockcode', 'stockcode.Stockcode = stockreg.Stockcode')
      ->get_where('tbl_mat_stock_reg stockreg', $where);

    return $query;
  }

  public function M_insert_sales_order($data)
  {
    extract($data);

    $this->db->trans_start();
    $this->db->insert('tbl_mat_po_v2', $master);
    $this->db->insert_batch('tbl_mat_po_det_v2', $detail);
    $this->db->trans_complete();

    if ($this->db->trans_status()) {
      $this->db->trans_commit();

      return 'success';
    } else {
      $this->db->trans_rollback();

      return $this->db->error();
    }
  }

  public function M_approve_multi_so($data)
  {
    extract($data);
    $this->db->trans_start();
    $this->db->update_batch('tbl_mat_po_v2', $so, 'CtrlNo');
    $this->db->trans_complete();

    if ($this->db->trans_status()) {
      $this->db->trans_commit();

      return 'success';
    } else {
      $this->db->trans_rollback();

      return $this->db->error();
    }
  }

  public function M_update_sales_order($data)
  {
    extract($data);
    $this->db->trans_start();
    $this->db->update('tbl_mat_po_v2', $master, ['CtrlNo' => $master_id]);
    $this->db->update_batch('tbl_mat_po_det_v2', $detail, 'ItemID');
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
