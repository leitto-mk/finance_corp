<h1 class="page-title"><?= $title ?></h1>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="icon-home"></i>
      <a href="<?= site_url('abc/dashboard') ?>">Home</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="<?= site_url('abc/sales/sales_order') ?>">Sales Order</a>
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

<form id="form-sales-order" data-type="<?= $type ?>" data-id="<?= $master['CtrlNo'] ?? null ?>">
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
            <label for="so_no" class="control-label">SO No</label>
            <?php if (isset($master['DocNo'])) : ?>
              <input type="text" name="so_no" id="so_no" class="form-control" readonly value="<?= $so_no ?>" data-no="<?= $so_no ?>">
            <?php else : ?>
              <div class="input-group">
                <input type="text" name="so_no" id="so_no" class="form-control" readonly value="<?= $so_no ?>" data-no="<?= $so_no ?>">
                <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">
                  <input type="checkbox" name="checkbox_so_no" id="checkbox_so_no">
                  <label for="checkbox_so_no">Manual</label>
                </span>
              </div>
            <?php endif; ?>
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="so_customer" class="control-label">Customer</label>
            <select name="so_customer" id="so_customer" class="form-control" data-value="<?= $master['CustomerID'] ?? null ?>">
              <option value=""></option>
            </select>
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="so_no_ref" class="control-label">Quote Ref No</label>
            <input type="text" name="so_no_ref" id="so_no_ref" class="form-control" value="<?= $master['RefNo'] ?? null ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="so_remarks" class="control-label">Remarks</label>
            <textarea type="text" name="so_remarks" id="so_remarks" class="form-control"><?= $master['Description'] ?? null ?></textarea>
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
                <label for="so_bill_to" class="control-label">Bill To</label>
                <input type="text" name="so_bill_to" id="so_bill_to" class="form-control" value="<?= $master['BillTo'] ?? null ?>">
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="so_ship_to" class="control-label">Ship To</label>
                <input type="text" name="so_ship_to" id="so_ship_to" class="form-control" value="<?= $master['ShipTo'] ?? null ?>">
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="so_storage" class="control-label">Storage</label>
            <select name="so_storage" id="so_storage" class="form-control" data-value="<?= $master['StorageID'] ?? null ?>">
              <option value=""></option>
            </select>
            <span class="help-block hidden"></span>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label for="so_freight" class="control-label">Freight</label>
                <input type="text" name="so_freight" id="so_freight" class="form-control" value="<?= $master['Freight'] ?? null ?>">
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group" class="control-label" style="margin-bottom: 0px;">
                <label for="so_shipment">Shipment Via</label>
                <div class="mt-checkbox-inline">
                  <label class="mt-checkbox">
                    <input type="checkbox" name="so_shipment" id="so_shipment" value="Air" <?= isset($master['Shipment']) && $master['Shipment'] == 'Air' ? 'checked' : null ?>>
                    Air
                    <span></span>
                  </label>
                  <label class="mt-checkbox">
                    <input type="checkbox" name="so_shipment" id="so_shipment" value="Sea" <?= isset($master['Shipment']) && $master['Shipment'] == 'Sea' ? 'checked' : null ?>>
                    Sea
                    <span></span>
                  </label>
                  <label class="mt-checkbox">
                    <input type="checkbox" name="so_shipment" id="so_shipment" value="Land" <?= isset($master['Shipment']) && $master['Shipment'] == 'Land' ? 'checked' : null ?>>
                    Land
                    <span></span>
                  </label>
                </div>
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="so_freight_remarks" class="control-label">Freight Info</label>
            <textarea type="text" name="so_freight_remarks" id="so_freight_remarks" class="form-control"><?= $master['FreightInfo'] ?? null ?></textarea>
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
            <label for="so_raised_by" class="control-label">Raised By</label>
            <?php if (isset($master['RaisedBy'])) : ?>
              <input type="text" name="so_raised_by" id="so_raised_by" class="form-control" readonly value="<?= $master['RaisedBy'] ?>">
            <?php else : ?>
              <input type="text" name="so_raised_by" id="so_raised_by" class="form-control" readonly value="<?= $this->session->userdata('uid') . ' - ' . $this->session->userdata('uname') ?>">
            <?php endif; ?>
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="so_raised_date" class="control-label">Raised Date</label>
            <input type="date" name="so_raised_date" id="so_raised_date" class="form-control" value="<?= $master['RaiseDate'] ?? date('Y-m-d') ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="so_term_days" class="control-label">Term Day(s)</label>
            <input type="text" name="so_term_days" id="so_term_days" class="form-control" value="<?= $master['Term'] ?? null ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group" style="margin-bottom: 37px">
            <label for="so_due_date" class="control-label">Due Date</label>
            <input type="date" name="so_due_date" id="so_due_date" class="form-control" value="<?= $master['DueDate'] ?? null ?>">
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
            <table class="table table-bordered table-hover" style="margin-bottom: 8px;" id="table-form-so">
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
              <tbody id="tbody-form-so">
                <?php if (isset($detail)) : ?>
                  <?php foreach ($detail as $row => $value) : ?>
                    <tr class="t-row">
                      <td class="text-center">
                        <a href="#" class="btn blue-chambray">
                          <input type="hidden" name="so_id[<?= $row ?>]" value="<?= $value['ID'] ?>">
                          <?= $row + 1 ?>
                        </a>
                      </td>
                      <td>
                        <div class="form-group">
                          <select name="so_stockcode[<?= $row ?>]" id="so_stockcode[<?= $row ?>]" class="form-control so-stockcode" data-value="<?= $value['StockID'] ?>">
                            <option value=""></option>
                          </select>
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" name="so_uom[<?= $row ?>]" id="so_uom[<?= $row ?>]" class="form-control so-uom" readonly value="<?= $value['UOM'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <select name="so_currency[<?= $row ?>]" id="so_currency[<?= $row ?>]" class="form-control so-currency" data-value="<?= $value['Currency'] ?>">
                            <option value=""></option>
                          </select>
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="so_qty[<?= $row ?>]" id="so_qty[<?= $row ?>]" class="form-control text-right so-qty" min="0" value="<?= $value['Qty'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="so_price[<?= $row ?>]" id="so_price[<?= $row ?>]" class="form-control text-right so-price" min="0" value="<?= $value['Price'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="so_discount[<?= $row ?>]" id="so_discount[<?= $row ?>]" class="form-control text-right so-discount" min="0" value="<?= $value['Discount'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="so_total[<?= $row ?>]" id="so_total[<?= $row ?>]" class="form-control text-right so-total" min="0" readonly value="<?= $value['TotalAmount'] ?>">
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
                      </a>
                    </td>
                    <td>
                      <div class="form-group">
                        <select name="so_stockcode[0]" id="so_stockcode[0]" class="form-control so-stockcode">
                          <option value=""></option>
                        </select>
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="text" name="so_uom[0]" id="so_uom[0]" class="form-control so-uom" readonly>
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <select name="so_currency[0]" id="so_currency[0]" class="form-control so-currency">
                          <option value=""></option>
                        </select>
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="so_qty[0]" id="so_qty[0]" class="form-control text-right so-qty" min="0" value="0">
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="so_price[0]" id="so_price[0]" class="form-control text-right so-price" min="0" value="0">
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="so_discount[0]" id="so_discount[0]" class="form-control text-right so-discount" min="0" value="0">
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="so_total[0]" id="so_total[0]" class="form-control text-right so-total" min="0" readonly value="0">
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
            <label for="so_payment_sub_total" class="control-label">Sub Total</label>
            <input type="text" name="so_payment_sub_total" id="so_payment_sub_total" class="form-control text-right" readonly value="<?= $master['SubTotal'] ?? '0' ?>">
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="so_payment_discount" class="control-label">Discount</label>
                <div class="input-group">
                  <input type="number" name="so_payment_discount" id="so_payment_discount" class="form-control text-right" step="0.01" min="0" value="<?= $master['DiscPercent'] ?? '0' ?>">
                  <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">%</span>
                </div>
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="so_payment_tax" class="control-label">Tax</label>
                <div class="input-group">
                  <input type="number" name="so_payment_tax" id="so_payment_tax" class="form-control text-right" step="0.01" min="0" value="<?= $master['TaxPercent'] ?? '0' ?>">
                  <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">%</span>
                </div>
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="so_payment_freight_cost" class="control-label">Freight</label>
            <input type="number" name="so_payment_freight_cost" id="so_payment_freight_cost" class="form-control text-right" min="0" value="<?= $master['FreightCost'] ?? '0' ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="so_payment_grand_total" class="control-label">Grand Total</label>
            <input type="text" name="so_payment_grand_total" id="so_payment_grand_total" class="form-control text-right" readonly min="0" value="<?= $master['Amount'] ?? '0' ?>">
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