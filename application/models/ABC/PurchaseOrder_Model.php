<?php defined('BASEPATH') or exit('No direct script access allowed');

class PurchaseOrder_Model extends CI_Model
{
  public function M_get_purchase_order($where)
  {
    $query = $this->db
      ->select('master.CtrlNo, master.PurchaseOrderID as DocNo, master.SupInvoiceNo as InvoiceNo, master.PORemarks as Description, CONCAT(master.SupplierID, " - ", supplier.SupplierName) as Supplier, master.Term, master.DueDate, master.POStatus, master.ApprovedBy,master.ApprovedStatus, master.PaymentStatus, master.GrandTotal as Amount, master.RaiseDate, raise_user.username as RaisedBy')
      ->join('tbl_mat_cat_supplier supplier', 'supplier.SupplierCode = master.SupplierID', 'LEFT')
      ->join('db_abase_pos_users.tbl_users as raise_user', 'raise_user.user_id = master.RaiseBy', 'LEFT')
      //->where('YEAR(master.RaiseDate) = YEAR(CURDATE())')select current year - tambahan dari chio bole di hapus
      ->get_where('tbl_mat_po_v2 master', $where);

    return $query;
  }

  public function M_approve_multi_po($data)
  {
    extract($data);
    $this->db->trans_start();
    $this->db->update_batch('tbl_mat_po_v2', $po, 'CtrlNo');
    $this->db->trans_complete();

    if ($this->db->trans_status()) {
      $this->db->trans_commit();

      return 'success';
    } else {
      $this->db->trans_rollback();

      return $this->db->error();
    }
  }

  public function M_insert_purchase_order($data)
  {
    extract($data);

    $this->db->trans_start();
    $this->db->insert('tbl_mat_po_v2', $master);
    $this->db->insert_batch('tbl_mat_po_det_v2', $detail);
    $this->db->update_batch('tbl_mat_stock_reg', $data_update_stockreg, 'CtrlNo');
    $this->db->trans_complete();

    if ($this->db->trans_status()) {
      $this->db->trans_commit();

      return 'success';
    } else {
      $this->db->trans_rollback();

      return $this->db->error();
    }
  }

  public function M_get_purchase_order_master($where)
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

  public function M_get_purchase_order_detail($where)
  {
    $query = $this->db
      ->select('detail.ItemID as ID, detail.StockCode as StockID, detail.Stockcode, detail.StockDesc, detail.UOM, detail.Currency, detail.Qty, detail.ItemPrice as Price, detail.Discount, detail.TotalAmount')
      ->get_where('tbl_mat_po_det_v2 detail', $where);

    return $query;
  }
}
