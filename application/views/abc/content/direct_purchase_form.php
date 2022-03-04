<h1 class="page-title"><?= $title ?></h1>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="icon-home"></i>
      <a href="<?= site_url('abc/dashboard') ?>">Home</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="<?= site_url('abc/purchase/direct_purchase') ?>">Direct Purchase</a>
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

<form id="form-direct-purchase" data-type="<?= $type ?>" data-id="<?= $master['CtrlNo'] ?? null ?>">
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
            <label for="dp_no" class="control-label">DP No</label>
            <?php if (isset($master['DocNo'])) : ?>
              <input type="text" name="dp_no" id="dp_no" class="form-control" readonly value="<?= $dp_no ?>" data-no="<?= $dp_no ?>">
            <?php else : ?>
              <div class="input-group">
                <input type="text" name="dp_no" id="dp_no" class="form-control" readonly value="<?= $dp_no ?>" data-no="<?= $dp_no ?>">
                <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">
                  <input type="checkbox" name="checkbox_dp_no" id="checkbox_dp_no">
                  <label for="checkbox_dp_no">Manual</label>
                </span>
              </div>
            <?php endif; ?>
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="dp_requisition" class="control-label">Purchase Requisition</label>
            <input type="text" name="dp_requisition" id="dp_requisition" class="form-control" value="<?= $master['RefNo'] ?? null ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="dp_invoice" class="control-label">Invoice No</label>
            <input type="text" name="dp_invoice" id="dp_invoice" class="form-control" value="<?= $master['RefNo'] ?? null ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="dp_supplier" class="control-label">Supplier</label>
            <select name="dp_supplier" id="dp_supplier" class="form-control" data-value="<?= $master['CustomerID'] ?? null ?>">
              <option value=""></option>
            </select>
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="dp_no_ref" class="control-label">Quote Ref No</label>
            <input type="text" name="dp_no_ref" id="dp_no_ref" class="form-control" value="<?= $master['RefNo'] ?? '-' ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="dp_remarks" class="control-label">Remarks</label>
            <textarea type="text" name="dp_remarks" id="dp_remarks" class="form-control"><?= $master['Description'] ?? null ?></textarea>
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
                <label for="dp_bill_to" class="control-label">Bill To</label>
                <input type="text" name="dp_bill_to" id="dp_bill_to" class="form-control" value="<?= $master['BillTo'] ?? $this->session->userdata('branch') ?>">
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="dp_ship_to" class="control-label">Ship To</label>
                <select name="dp_ship_to" id="dp_ship_to" class="form-control" data-value="<?= $master['StorageID'] ?? null ?>">
                  <option value=""></option>
                </select>
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label for="dp_cost_center" class="control-label">Cost Center</label>
                <input type="text" name="dp_cost_center" id="dp_cost_center" class="form-control">
                <!-- <select name="dp_cost_center" id="dp_cost_center" class="form-control" data-value="<?= $master['StorageID'] ?? null ?>">
                  <option value=""></option>
                </select> -->
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label for="dp_acc_code" class="control-label">Account Code</label>
                <input type="text" name="dp_acc_code" id="dp_acc_code" class="form-control">
                <!-- <select name="dp_acc_code" id="dp_acc_code" class="form-control" data-value="<?= $master['StorageID'] ?? null ?>">
                  <option value=""></option>
                </select> -->
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label for="dp_freight" class="control-label">Freight</label>
                <input type="text" name="dp_freight" id="dp_freight" class="form-control" value="<?= $master['Freight'] ?? null ?>">
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group" style="margin-bottom: 0px;">
                <label for="dp_shipment" class="control-label">Shipment Via</label>
                <div class="mt-checkbox-inline">
                  <label class="mt-checkbox">
                    <input type="checkbox" name="dp_shipment" id="dp_shipment" value="Air" <?= isset($master['Shipment']) && $master['Shipment'] == 'Air' ? 'checked' : null ?>>
                    Air
                    <span></span>
                  </label>
                  <label class="mt-checkbox">
                    <input type="checkbox" name="dp_shipment" id="dp_shipment" value="Sea" <?= isset($master['Shipment']) && $master['Shipment'] == 'Sea' ? 'checked' : null ?>>
                    Sea
                    <span></span>
                  </label>
                  <label class="mt-checkbox">
                    <input type="checkbox" name="dp_shipment" id="dp_shipment" checked value="Land" <?= isset($master['Shipment']) && $master['Shipment'] == 'Land' ? 'checked' : null ?>>
                    Land
                    <span></span>
                  </label>
                </div>
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="dp_freight_remarks" class="control-label">Freight Info</label>
            <textarea type="text" name="dp_freight_remarks" id="dp_freight_remarks" class="form-control"><?= $master['FreightInfo'] ?? null ?></textarea>
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
            <label for="dp_raised_by" class="control-label">Raised By</label>
            <?php if (isset($master['RaisedBy'])) : ?>
              <input type="text" name="dp_raised_by" id="dp_raised_by" class="form-control" readonly value="<?= $master['RaisedBy'] ?>">
            <?php else : ?>
              <input type="text" name="dp_raised_by" id="dp_raised_by" class="form-control" readonly value="<?= $this->session->userdata('uid') . ' - ' . $this->session->userdata('uname') ?>">
            <?php endif; ?>
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="dp_raised_date" class="control-label">Raised Date</label>
            <input type="date" name="dp_raised_date" id="dp_raised_date" class="form-control" value="<?= $master['RaiseDate'] ?? date('Y-m-d') ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="dp_term_days" class="control-label">Term Day(s)</label>
            <input type="text" name="dp_term_days" id="dp_term_days" class="form-control" value="<?= $master['Term'] ?? null ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group" style="margin-bottom: 37px">
            <label for="dp_due_date" class="control-label">Due Date</label>
            <input type="date" name="dp_due_date" id="dp_due_date" class="form-control" value="<?= $master['DueDate'] ?? null ?>">
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
                  <th width="5%" class="text-center">Disc%</th>
                  <th width="13%" class="text-center">Total</th>
                </tr>
              </thead>
              <tbody id="tbody-form-dp">
                <?php if (isset($detail)) : ?>
                  <?php foreach ($detail as $row => $value) : ?>
                    <tr class="t-row">
                      <td class="text-center">
                        <a href="#" class="btn blue-chambray">
                          <input type="hidden" name="dp_id[<?= $row ?>]" value="<?= $value['ID'] ?>">
                          <?= $row + 1 ?>
                        </a>
                      </td>
                      <td>
                        <div class="form-group">
                          <select name="dp_stockcode[<?= $row ?>]" id="dp_stockcode[<?= $row ?>]" class="form-control dp-stockcode" data-value="<?= $value['StockID'] ?>">
                            <option value=""></option>
                          </select>
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" name="dp_uom[<?= $row ?>]" id="dp_uom[<?= $row ?>]" class="form-control dp-uom" readonly value="<?= $value['UOM'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <select name="dp_currency[<?= $row ?>]" id="dp_currency[<?= $row ?>]" class="form-control dp-currency" data-value="<?= $value['Currency'] ?>">
                            <option value=""></option>
                          </select>
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="dp_qty[<?= $row ?>]" id="dp_qty[<?= $row ?>]" class="form-control text-right dp-qty" min="0" value="<?= $value['Qty'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="dp_price[<?= $row ?>]" id="dp_price[<?= $row ?>]" class="form-control text-right dp-price" min="0" value="<?= $value['Price'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="dp_discount[<?= $row ?>]" id="dp_discount[<?= $row ?>]" class="form-control text-right dp-discount" min="0" value="<?= $value['Discount'] ?>">
                          <span class="help-block hidden"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" name="dp_total[<?= $row ?>]" id="dp_total[<?= $row ?>]" class="form-control text-right dp-total" min="0" readonly value="<?= $value['TotalAmount'] ?>">
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
                      <input type="hidden" id="_dp_stockcode[0]" name="_dp_stockcode[0]" class="_dp_stockcode">
                    </td>
                    <td>
                      <div class="form-group">
                        <select name="dp_stockcode[0]" id="dp_stockcode[0]" class="form-control dp-stockcode">
                          <option value=""></option>
                        </select>
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="text" name="dp_uom[0]" id="dp_uom[0]" class="form-control dp-uom" readonly>
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <select name="dp_currency[0]" id="dp_currency[0]" class="form-control dp-currency">
                          <option value=""></option>
                        </select>
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="dp_qty[0]" id="dp_qty[0]" class="form-control text-right dp-qty" min="0" value="0">
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="dp_price[0]" id="dp_price[0]" class="form-control text-right dp-price" min="0" value="0">
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="dp_discount[0]" id="dp_discount[0]" class="form-control text-right dp-discount" min="0" value="0">
                        <span class="help-block hidden"></span>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" name="dp_total[0]" id="dp_total[0]" class="form-control text-right dp-total" min="0" readonly value="0">
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
            <label for="dp_payment_sub_total" class="control-label">Sub Total</label>
            <input type="text" name="dp_payment_sub_total" id="dp_payment_sub_total" class="form-control text-right" readonly value="<?= $master['SubTotal'] ?? '0' ?>">
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="dp_payment_discount" class="control-label">Discount</label>
                <div class="input-group">
                  <input type="number" name="dp_payment_discount" id="dp_payment_discount" class="form-control text-right" step="0.01" min="0" value="<?= $master['DiscPercent'] ?? '0' ?>">
                  <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">%</span>
                </div>
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="dp_payment_tax" class="control-label">Tax</label>
                <div class="input-group">
                  <input type="number" name="dp_payment_tax" id="dp_payment_tax" class="form-control text-right" step="0.01" min="0" value="<?= $master['TaxPercent'] ?? '0' ?>">
                  <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">%</span>
                </div>
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="dp_payment_freight_cost" class="control-label">Freight</label>
            <input type="number" name="dp_payment_freight_cost" id="dp_payment_freight_cost" class="form-control text-right" min="0" value="<?= $master['FreightCost'] ?? '0' ?>">
            <span class="help-block hidden"></span>
          </div>
          <div class="form-group">
            <label for="dp_payment_grand_total" class="control-label">Grand Total</label>
            <input type="text" name="dp_payment_grand_total" id="dp_payment_grand_total" class="form-control text-right" readonly min="0" value="<?= $master['Amount'] ?? '0' ?>">
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label for="dp_payment_type" class="control-label">Payment Method</label>
          <div class="mt-radio-inline">
            <label class="mt-radio">
              <input type="radio" id="radio-cash" name="dp_payment_type" value="cash" checked>
              <span></span>
              Cash
            </label>
            <label class="mt-radio">
              <input type="radio" id="radio-debit" name="dp_payment_type" value="debit">
              <span></span>
              Debit
            </label>
            <label class="mt-radio">
              <input type="radio" id="radio-credit" name="dp_payment_type" value="credit">
              <span></span>
              Credit
            </label>
            <label class="mt-radio">
              <input type="radio" id="radio-credit" name="dp_payment_type" value="credit purchase">
              <span></span>
              Credit Purchase
            </label>
          </div>
        </div>
        <div id="card-payment" class="hidden">
          <div class="form-group">
            <label for="dp_payment_card_number" class="control-label">Card Number</label>
            <input type="text" name="dp_payment_card_number" id="dp_payment_card_number" class="form-control">
          </div>
          <div class="form-group">
            <label for="dp_payment_bank" class="control-label">Bank</label>
            <select name="dp_payment_bank" id="dp_payment_bank" class="form-control">
              <option value=""></option>
            </select>
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