<h1 class="page-title"><?= $title ?></h1>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="icon-home"></i>
      <a href="<?= site_url('abc/dashboard') ?>">Home</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="<?= site_url('abc/purchase/purchase_order') ?>">Purchase Order</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <?php if (isset($master['DocNo'])) : ?>
      <li>
        <span><?= $master['DocNo'] ?></span>
      </li>
    <?php else : ?>
      <li>
        <span><?= $title ?></span>
      </li>
    <?php endif; ?>
  </ul>
</div>

<form id="form-purchase-order" data-type="<?= $type ?>" data-id="<?= $master['CtrlNo'] ?? null ?>">
  <div class="row">
    <div class="col-lg-4">
      <div class="portlet light">
        <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject bold uppercase">Detail</span>
          </div>
        </div>
        <div class="portlet-body">
          <div class="form-group">
            <label for="po_no" class="control-label">PO No</label>
            <?php if (isset($master['DocNo'])) : ?>
              <input type="text" name="po_no" id="po_no" class="form-control" readonly value="<?= $po_no ?>" data-no="<?= $po_no ?>">
            <?php else : ?>
              <div class="input-group">
                <input type="text" name="po_no" id="po_no" class="form-control" readonly value="<?= $po_no ?>" data-no="<?= $po_no ?>">
                <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">
                  <input type="checkbox" name="checkbox_po_no" id="checkbox_po_no">
                  <label for="checkbox_po_no">Manual</label>
                </span>
              </div>
            <?php endif; ?>
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="po_supplier" class="control-label">Supplier</label>
            <select name="po_supplier" id="po_supplier" class="form-control" data-value="<?= $master['CustomerID'] ?? null ?>">
              <option value=""></option>
            </select>
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="po_no_ref" class="control-label">Quote Ref No</label>
            <input type="text" name="po_no_ref" id="po_no_ref" class="form-control" value="<?= $master['RefNo'] ?? null ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="po_remarks" class="control-label">Remarks</label>
            <textarea type="text" name="po_remarks" id="po_remarks" class="form-control"><?= $master['Description'] ?? null ?></textarea>
            <span class="help-block hidden"></span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="portlet light">
        <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject bold uppercase">Bill & Shipping</span>
          </div>
        </div>
        <div class="portlet-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="po_bill_to" class="control-label">Bill To</label>
                <input type="text" name="po_bill_to" id="po_bill_to" class="form-control" value="<?= $master['BillTo'] ?? null ?>">
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="po_ship_to" class="control-label">Ship To</label>
                <input type="text" name="po_ship_to" id="po_ship_to" class="form-control" value="<?= $master['ShipTo'] ?? null ?>">
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label for="po_cost_center" class="control-label">Cost Center</label>
                <input type="text" name="po_cost_center" id="po_cost_center" class="form-control">
                <!-- <select name="po_cost_center" id="po_cost_center" class="form-control" data-value="<?= $master['StorageID'] ?? null ?>">
                  <option value=""></option>
                </select> -->
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label for="po_acc_code" class="control-label">Account Code</label>
                <input type="text" name="po_acc_code" id="po_acc_code" class="form-control">
                <!-- <select name="po_acc_code" id="po_acc_code" class="form-control" data-value="<?= $master['StorageID'] ?? null ?>">
                  <option value=""></option>
                </select> -->
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label for="po_freight" class="control-label">Freight</label>
                <input type="text" name="po_freight" id="po_freight" class="form-control" value="<?= $master['Freight'] ?? null ?>">
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group" class="control-label" style="margin-bottom: 0px;">
                <label for="po_shipment">Shipment Via</label>
                <div class="mt-checkbox-inline">
                  <label class="mt-checkbox">
                    <input type="checkbox" name="po_shipment" id="po_shipment" value="Air" <?= isset($master['Shipment']) && $master['Shipment'] == 'Air' ? 'checked' : null ?>>
                    Air
                    <span></span>
                  </label>
                  <label class="mt-checkbox">
                    <input type="checkbox" name="po_shipment" id="po_shipment" value="Sea" <?= isset($master['Shipment']) && $master['Shipment'] == 'Sea' ? 'checked' : null ?>>
                    Sea
                    <span></span>
                  </label>
                  <label class="mt-checkbox">
                    <input type="checkbox" name="po_shipment" id="po_shipment" value="Land" <?= isset($master['Shipment']) && $master['Shipment'] == 'Land' ? 'checked' : null ?>>
                    Land
                    <span></span>
                  </label>
                </div>
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="po_freight_remarks" class="control-label">Freight Info</label>
            <textarea type="text" name="po_freight_remarks" id="po_freight_remarks" class="form-control"><?= $master['FreightInfo'] ?? null ?></textarea>
            <span class="help-block hidden"></span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="portlet light">
        <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject bold uppercase">Raise Info</span>
          </div>
        </div>
        <div class="portlet-body">
          <div class="form-group">
            <label for="po_raised_by" class="control-label">Raised By</label>
            <?php if (isset($master['RaisedBy'])) : ?>
              <input type="text" name="po_raised_by" id="po_raised_by" class="form-control" readonly value="<?= $master['RaisedBy'] ?>">
            <?php else : ?>
              <input type="text" name="po_raised_by" id="po_raised_by" class="form-control" readonly value="<?= $this->session->userdata('uid') . ' - ' . $this->session->userdata('uname') ?>">
            <?php endif; ?>
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="po_raised_date" class="control-label">Raised Date</label>
            <input type="date" name="po_raised_date" id="po_raised_date" class="form-control" value="<?= $master['RaiseDate'] ?? date('Y-m-d') ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="po_term_days" class="control-label">Term Day(s)</label>
            <input type="number" name="po_term_days" id="po_term_days" class="form-control" value="<?= $master['Term'] ?? null ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group" style="margin-bottom: 37px">
            <label for="po_due_date" class="control-label">Due Date</label>
            <input type="date" name="po_due_date" id="po_due_date" class="form-control" value="<?= $master['DueDate'] ?? null ?>">
            <span class="help-block hidden"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="portlet light">
        <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject bold uppercase">Order List</span>
          </div>
        </div>
        <div class="portlet-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" style="margin-bottom: 8px;" id="table-form-po">
              <thead>
                <tr>
                  <th width="3%" class="text-center">Item</th>
                  <th width="25%" class="text-center">Stockcode</th>
                  <th width="5%" class="text-center">UOM</th>
                  <th width="5%" class="text-center">Currency</th>
                  <th width="6%" class="text-center">Qty</th>
                  <th width="13%" class="text-center">Price</th>
                  <th width="5%" class="text-center">Discount</th>
                  <th width="13%" class="text-center">Total</th>
                </tr>
              </thead>
              <tbody id="tbody-form-po">
                <?php if (isset($detail)) : ?>
                  <?php foreach ($detail as $row => $value) : ?>
                    <tr class="t-row">
                      <td class="text-center">
                        <a href="#" class="btn blue-chambray">
                          <input type="hidden" name="po_id[<?= $row ?>]" value="<?= $value['ID'] ?>">
                          <?= $row + 1 ?>
                          <input type="hidden" id="_po_stockcode[0]" name="_po_stockcode[0]" class="_po_stockcode">
                        </a>
                      </td>
                      <td>
                        <div class="form-group">
                          <select name="po_stockcode[<?= $row ?>]" id="po_stockcode[<?= $row ?>]" class="form-control po-stockcode" data-value="<?= $value['StockID'] ?>">
                            <option value=""></option>
                          </select>
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" name="po_uom[<?= $row ?>]" id="po_uom[<?= $row ?>]" class="form-control po-uom" readonly value="<?= $value['UOM'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <select name="po_currency[<?= $row ?>]" id="po_currency[<?= $row ?>]" class="form-control po-currency" data-value="<?= $value['Currency'] ?>">
                            <option value=""></option>
                          </select>
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="po_qty[<?= $row ?>]" id="po_qty[<?= $row ?>]" class="form-control text-right po-qty" min="0" value="<?= $value['Qty'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="po_price[<?= $row ?>]" id="po_price[<?= $row ?>]" class="form-control text-right po-price" min="0" value="<?= $value['Price'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="po_discount[<?= $row ?>]" id="po_discount[<?= $row ?>]" class="form-control text-right po-discount" min="0" value="<?= $value['Discount'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="po_total[<?= $row ?>]" id="po_total[<?= $row ?>]" class="form-control text-right po-total" min="0" readonly value="<?= $value['TotalAmount'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else : ?>
                  <tr class="t-row">
                    <td class="text-center">
                      <a href="#" class="btn blue-chambray">
                        1
                        <input type="hidden" id="_po_stockcode[0]" name="_po_stockcode[0]" class="_po_stockcode">
                      </a>
                    </td>
                    <td>
                      <div class="form-group">
                        <select name="po_stockcode[0]" id="po_stockcode[0]" class="form-control po-stockcode">
                          <option value=""></option>
                        </select>
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="text" name="po_uom[0]" id="po_uom[0]" class="form-control po-uom" readonly>
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <select name="po_currency[0]" id="po_currency[0]" class="form-control po-currency">
                          <option value=""></option>
                        </select>
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="po_qty[0]" id="po_qty[0]" class="form-control text-right po-qty" min="0" value="0">
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="po_price[0]" id="po_price[0]" class="form-control text-right po-price" min="0" value="0">
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="po_discount[0]" id="po_discount[0]" class="form-control text-right po-discount" min="0" value="0">
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="po_total[0]" id="po_total[0]" class="form-control text-right po-total" min="0" readonly value="0">
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
            <a href="#" class="btn blue-chambray pull-right" id="action-add-row">Add Item</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
      <div class="portlet light">
        <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject bold uppercase">Payment Details</span>
          </div>
        </div>
        <div class="portlet-body">
          <div class="form-group">
            <label for="po_payment_sub_total" class="control-label">Sub Total</label>
            <input type="text" name="po_payment_sub_total" id="po_payment_sub_total" class="form-control text-right" readonly value="<?= $master['SubTotal'] ?? '0' ?>">
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="po_payment_discount" class="control-label">Discount</label>
                <div class="input-group">
                  <input type="number" name="po_payment_discount" id="po_payment_discount" class="form-control text-right" step="0.01" min="0" value="<?= $master['DiscPercent'] ?? '0' ?>">
                  <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">%</span>
                </div>
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="po_payment_tax" class="control-label">Tax</label>
                <div class="input-group">
                  <input type="number" name="po_payment_tax" id="po_payment_tax" class="form-control text-right" step="0.01" min="0" value="<?= $master['TaxPercent'] ?? '0' ?>">
                  <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">%</span>
                </div>
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="po_payment_freight_cost" class="control-label">Freight</label>
            <input type="number" name="po_payment_freight_cost" id="po_payment_freight_cost" class="form-control text-right" min="0" value="<?= $master['FreightCost'] ?? '0' ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="po_payment_grand_total" class="control-label">Grand Total</label>
            <input type="text" name="po_payment_grand_total" id="po_payment_grand_total" class="form-control text-right" readonly min="0" value="<?= $master['Amount'] ?? '0' ?>">
          </div>
        </div>
        <div class="portlet-footer text-right">
          <hr>
          <button type="reset" class="btn btn-outline grey-gallery">Reset</button>
          <button type="submit" class="btn blue-chambray">Submit</button>
        </div>
      </div>
    </div>
  </div>
</form>