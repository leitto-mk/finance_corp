<style>
  td i.fa {
    width: 12px;
  }

  td a.btn-xs {
    margin-bottom: 5px;
  }

  /* td {
    vertical-align: middle !important;
  } */
</style>
<h1 class="page-title"><?= $title ?></h1>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="icon-home"></i>
      <a href="<?= site_url('abc/dashboard') ?>">Home</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="<?= site_url('abc/sales/direct_sales') ?>">Direct Sales</a>
    </li>
  </ul>
</div>
<form id="form-direct-sales">
  <div class="row">
    <div class="col-lg-8 col-md-12">
      <div class="portlet light">
        <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject bold uppercase">Item</span>
          </div>
        </div>
        <div class="portlet-body">
          <?php if (isset($detail) && $detail) : ?>
          <?php else : ?>
            <div class="form-group">
              <select name="item_input" id="item_input" class="form-control">
                <option value=""></option>
              </select>
            </div>
          <?php endif; ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-direct-sales">
              <thead class="bg-blue-chambray bg-font-blue-chambray">
                <tr>
                  <th class="text-center" width="4%">No</th>
                  <th class="text-center" width="15%">Stockcode</th>
                  <th class="text-center" width="30%">Description</th>
                  <th class="text-center" width="15%">Price</th>
                  <th class="text-center" width="12%">Qty</th>
                  <th class="text-center" width="8%">Disc%</th>
                  <th class="text-center" width="14%">Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($detail) && $detail) : ?>
                  <?php foreach ($detail as $row => $value) : ?>
                    <tr>
                      <td><?= $row + 1 ?></td>
                      <td><?= $value['Stockcode'] ?></td>
                      <td><?= $value['StockDescription'] ?></td>
                      <td class="text-right"><?= convertRupiah($value['Price']) ?></td>
                      <td class="text-right"><?= $value['Qty'] ?></td>
                      <td class="text-right"><?= $value['Discount'] ?></td>
                      <td class="text-right"><?= convertRupiah($value['Amount']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else : ?>
                  <tr>
                    <td colspan="7" class="text-center no-data">No Data</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="portlet light">
        <div class="portlet-body">
          <?php if (isset($master) && $master) : ?>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="ds_submit_by" class="control-label">Submit By</label>
                  <input type="text" name="ds_submit_by" id="ds_submit_by" class="form-control" readonly value="<?= $master['Seller'] ?>">
                  <span class="help-block hidden"></span>
                </div>
                <div class="form-group">
                  <label for="ds_submit_date" class="control-label">Submit Date</label>
                  <input type="date" name="ds_submit_date" id="ds_submit_date" class="form-control" value="<?= date('Y-m-d', strtotime($master['Date'])) ?>" readonly>
                  <span class="help-block hidden"></span>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="ds_remarks" class="control-label">Remarks</label>
                  <textarea type="text" name="ds_remarks" id="ds_remarks" class="form-control" rows="5" readonly><?= $master['Remarks'] ?? null ?></textarea>
                  <span class="help-block hidden"></span>
                </div>
              </div>
            </div>
          <?php else : ?>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="ds_submit_by" class="control-label">Submit By</label>
                  <input type="text" name="ds_submit_by" id="ds_submit_by" class="form-control" readonly value="<?= $this->session->userdata('uid') . ' - ' . $this->session->userdata('uname') ?>">
                  <span class="help-block hidden"></span>
                </div>
                <div class="form-group">
                  <label for="ds_submit_date" class="control-label">Submit Date</label>
                  <input type="date" name="ds_submit_date" id="ds_submit_date" class="form-control" value="<?= date('Y-m-d') ?>">
                  <span class="help-block hidden"></span>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="ds_remarks" class="control-label">Remarks</label>
                  <textarea type="text" name="ds_remarks" id="ds_remarks" class="form-control" rows="5"></textarea>
                  <span class="help-block hidden"></span>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-12">
      <div class="portlet light">
        <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject bold uppercase">Storage & Customer</span>
          </div>
        </div>
        <div class="portlet-body">
          <?php if (isset($master) && $master) : ?>
            <div class="form-group">
              <label for="ds_no" class="control-label">Document No</label>
              <input type="text" name="ds_no" id="ds_no" class="form-control" readonly value="<?= $master['DocNo'] ?? null ?>">
            </div>
            <div class="form-group">
              <label for="ds_customer" class="control-label">Customer</label>
              <input type="text" name="ds_customer" id="ds_customer" class="form-control" readonly value="<?= $master['Customer'] ?>">
              <span class="help-block hidden"></span>
            </div>
            <div class="form-group">
              <label for="ds_storage" class="control-label">Storage</label>
              <input type="text" name="ds_storage" id="ds_storage" class="form-control" readonly value="<?= $master['Storage'] ?? null ?>">
              <span class="help-block hidden"></span>
            </div>
          <?php else : ?>
            <div class="form-group">
              <label for="ds_no" class="control-label">Document No</label>
              <div class="input-group">
                <input type="text" name="ds_no" id="ds_no" class="form-control" readonly value="<?= $ds_no ?? null ?>" data-no="<?= $ds_no ?? null ?>">
                <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">
                  <input type="checkbox" name="checkbox_ds_no" id="checkbox_ds_no">
                  <label for="checkbox_ds_no">Manual</label>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="ds_customer" class="control-label">Customer</label>
              <select name="ds_customer" id="ds_customer" class="form-control">
                <option value=""></option>
              </select>
              <span class="help-block hidden"></span>
            </div>
            <div class="form-group">
              <label for="ds_storage" class="control-label">Storage</label>
              <select name="ds_storage" id="ds_storage" class="form-control">
                <option value=""></option>
              </select>
              <span class="help-block hidden"></span>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="portlet light">
        <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject bold uppercase">Payment Detail</span>
          </div>
        </div>
        <div class="portlet-body">
          <div class="form-group">
            <label for="ds_payment_sub_total" class="control-label">Sub Total</label>
            <input type="text" name="ds_payment_sub_total" id="ds_payment_sub_total" class="form-control text-right" readonly value="<?= isset($master['SubTotal']) ? convertRupiah($master['SubTotal']) : 0 ?>">
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="ds_payment_discount" class="control-label">Discount</label>
                <div class="input-group">
                  <input type="number" name="ds_payment_discount" id="ds_payment_discount" class="form-control text-right" step="0.01" min="0" <?= isset($master['Discount']) ? 'readonly value="' . $master['Discount'] . '"' : 'value="0"' ?>>
                  <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">%</span>
                </div>
                <span class="help-block hidden"></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="ds_payment_tax" class="control-label">Tax</label>
                <div class="input-group">
                  <input type="number" name="ds_payment_tax" id="ds_payment_tax" class="form-control text-right" step="0.01" min="0" <?= isset($master['Tax']) ? 'readonly value="' . $master['Tax'] . '"' : 'value="0"' ?>>
                  <span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">%</span>
                </div>
                <span class="help-block hidden"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="ds_payment_grand_total" class="control-label">Grand Total</label>
            <input type="text" name="ds_payment_grand_total" id="ds_payment_grand_total" class="form-control text-right" readonly min="0" <?= isset($master['GrandTotal']) ? 'readonly value="' . convertRupiah($master['GrandTotal']) . '"' : 'value="0"' ?>>
          </div>
        </div>
      </div>
      <div class="portlet light">
        <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject bold uppercase">Payment</span>
          </div>
        </div>
        <div class="portlet-body">
          <div class="form-group">
            <label for="ds_payment_type" class="control-label">Payment Method</label>
            <div class="mt-radio-inline">
              <label class="mt-radio">
                <input type="radio" name="ds_payment_type" value="cash" checked>
                <span></span>
                Cash
              </label>
              <label class="mt-radio">
                <input type="radio" name="ds_payment_type" value="debit">
                <span></span>
                Debit
              </label>
              <label class="mt-radio">
                <input type="radio" name="ds_payment_type" value="credit">
                <span></span>
                Credit
              </label>
            </div>
          </div>
          <div id="card-payment" class="hidden">
            <div class="form-group">
              <label for="ds_payment_card_number" class="control-label">Card Number</label>
              <input type="text" name="ds_payment_card_number" id="ds_payment_card_number" class="form-control">
            </div>
            <div class="form-group">
              <label for="ds_payment_bank" class="control-label">Bank</label>
              <select name="ds_payment_bank" id="ds_payment_bank" class="form-control">
                <option value=""></option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="ds_payment_total_paid" class="control-label">Total Payment</label>
            <?php if (isset($master) && $master) : ?>
              <input type="text" name="ds_payment_total_paid" id="ds_payment_total_paid" class="form-control text-right" min="0" readonly value="<?= convertRupiah($master['TotalPayment']) ?>">
            <?php else : ?>
              <input type="number" name="ds_payment_total_paid" id="ds_payment_total_paid" class="form-control text-right" min="0" value="0">
            <?php endif; ?>
          </div>
          <?php if (isset($master) && $master) : ?>
          <?php else : ?>
            <div class="form-group">
              <label for="ds_payment_changes" class="control-label">Changes</label>
              <input type="text" name="ds_payment_changes" id="ds_payment_changes" class="form-control text-right" readonly value="0">
            </div>
          <?php endif; ?>
        </div>
        <div class="portlet-footer text-right">
          <?php if (isset($ds_no) && $ds_no) : ?>
            <hr>
            <div class="row">
              <div class="col-lg-6" style="margin-bottom: 5px;">
                <button type="reset" class="btn btn-block btn-outline grey-gallery">Reset</button>
              </div>
              <div class="col-lg-6" style="margin-bottom: 5px;">
                <button type="submit" class="btn btn-block yellow-casablanca">Submit</button>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</form>