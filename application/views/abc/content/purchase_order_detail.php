<style>
  h4.po-description,
  h3.po-description {
    margin: 0;
    color: #2C3E50;
  }

  .highlihgt {
    color: #2C3E50;
  }
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
      <a href="<?= site_url('abc/purchase/purchase_order') ?>">Purchase Order</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <span><?= $master['DocNo'] ?></span>
    </li>
  </ul>
  <div class="page-toolbar">
    <div class="btn-group pull-right">
      <button type="button" class="btn btn-fit-height blue-chambray dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
        <i class="fa fa-angle-down"></i>
      </button>
      <ul class="dropdown-menu pull-right" role="menu">
        <li>
          <a href="#" id="action-create-invoice">
            <i class="icon-plus"></i> Create Invoice</a>
        </li>
        <li>
          <a href="#" id="action-print-invoice">
            <i class="icon-doc"></i> Print Invoice</a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-3 col-md-6">
    <div class="portlet light" style="margin-bottom: 23px;">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Master</span>
        </div>
      </div>
      <div class="portlet-body">
        <div class="form-group">
          <label class="control-label" style="margin: 0;">PO No</label>
          <!-- <h4 class="po-description bold"><?= $master['DocNo'] ?></h4> -->
          <h3 class="po-description bold">
            <span class="label bg-blue bold"><?= $master['DocNo'] ?></span>
          </h3>
        </div>
        <div class="form-group">
          <label class="control-label">Customer</label>
          <h4 class="po-description bold"><?= $master['Supplier'] ?></h4>
        </div>
        <div class="form-group">
          <label class="control-label">Quote Reference Number</label>
          <h4 class="po-description bold"><?= $master['RefNo'] ?></h4>
        </div>
        <div class="form-group">
          <label class="control-label">Remarks</label>
          <h4 class="po-description bold"><?= $master['Description'] ?></h4>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Bill & Shipping</span>
        </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Bill To</label>
              <h4 class="po-description bold"><?= $master['BillTo'] ?></h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Ship To</label>
              <h4 class="po-description bold"><?= $master['Storage'] ?></h4>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Freight</label>
              <h4 class="po-description bold"><?= $master['Freight'] ?></h4>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Shipment</label>
              <h4 class="po-description bold"><?= $master['Shipment'] ?></h4>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Freight Info</label>
          <h4 class="po-description bold"><?= $master['FreightInfo'] ?></h4>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Raised Info</span>
        </div>
      </div>
      <div class="portlet-body">
        <div class="form-group">
          <label class="control-label">Raised By</label>
          <h4 class="po-description bold"><?= $master['RaisedBy'] ?></h4>
        </div>
        <div class="form-group">
          <label class="control-label">Raised Date</label>
          <h4 class="po-description bold"><?= $master['RaiseDate'] ?></h4>
        </div>
        <div class="form-group">
          <label class="control-label">Term Day(s)</label>
          <h4 class="po-description bold"><?= $master['Term'] ?></h4>
        </div>
        <div class="form-group">
          <label class="control-label">Due Date</label>
          <h4 class="po-description bold"><?= $master['DueDate'] ?></h4>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Status Info</span>
        </div>
      </div>
      <div class="portlet-body">
        <div class="form-group">
          <label class="control-label">SO Status</label>
          <h3 class="po-description bold">
            <span class="label bg-blue-chambray bold"> <?= $master['POStatus'] ?></span>
          </h3>
        </div>
        <?php if ($master['ApprovedBy']) : ?>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="control-label">Approved By</label>
                <h4 class="po-description bold"><?= $master['ApprovedBy'] ?></h4>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="control-label">Approved Date</label>
                <h4 class="po-description bold"><?= date('Y-m-d', strtotime($master['ApprovedDate'])) ?></h4>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="form-group">
          <label class="control-label">Amount</label>
          <h3 class="po-description bold">
            <span class="label bg-blue bold"> <?= convertRupiah($master['Amount']) ?></span>
          </h3>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="portlet light">
      <div class="portlet-body">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab-po-detail" class="bold uppercase" data-toggle="tab">Detail</a>
          </li>
          <li>
            <a href="#tab-po-invoice" class="bold uppercase" data-toggle="tab">Invoice</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade active in" id="tab-po-detail">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" style="margin-bottom: 8px;" id="table-form-so">
                <thead class="bg-blue-chambray bg-font-blue-chambray">
                  <tr>
                    <th width="3%" class="text-center">Item</th>
                    <th width="10%" class="text-center">Stockcode</th>
                    <th width="15%" class="text-center">Stock Name</th>
                    <th width="5%" class="text-center">UOM</th>
                    <th width="5%" class="text-center">Currency</th>
                    <th width="6%" class="text-center">Qty</th>
                    <th width="13%" class="text-center">Price</th>
                    <th width="5%" class="text-center">Discount</th>
                    <th width="13%" class="text-center">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($detail as $row => $value) : ?>
                    <tr>
                      <td class="text-center"><?= $row + 1 ?></td>
                      <td><?= $value['Stockcode'] ?></td>
                      <td><?= $value['StockDesc'] ?></td>
                      <td class="text-center"><?= $value['UOM'] ?></td>
                      <td class="text-center"><?= $value['Currency'] ?></td>
                      <td class="text-right"><?= convertDouble($value['Qty']) ?></td>
                      <td class="text-right"><?= convertRupiah($value['Price']) ?></td>
                      <td class="text-right"><?= convertDouble($value['Discount']) . '%' ?></td>
                      <th class="text-right"><?= convertRupiah($value['TotalAmount']) ?></th>
                    </tr>
                  <?php endforeach; ?>
                  <tr>
                    <td colspan="7"></td>
                    <td class="text-right" style="border-top: 1.5px solid black;">Sub Total</td>
                    <th class="text-right" style="border-top: 1.5px solid black;"><?= convertRupiah($master['SubTotal']) ?></th>
                  </tr>
                  <tr>
                    <td colspan="7"></td>
                    <td class="text-right">Discount</td>
                    <th class="text-right"><?= convertRupiah($master['Discount'])  ?></th>
                  </tr>
                  <tr>
                    <td colspan="7"></td>
                    <td class="text-right">Tax</td>
                    <th class="text-right"><?= convertRupiah($master['Tax']) ?></th>
                  </tr>
                  <tr>
                    <td colspan="7"></td>
                    <td class="text-right">Freight</td>
                    <th class="text-right"><?= convertRupiah($master['FreightCost']) ?></th>
                  </tr>
                  <tr>
                    <td colspan="7"></td>
                    <td class="text-right">Grand Total</td>
                    <th class="text-right"><?= convertRupiah($master['Amount'])  ?></th>
                  </tr>
                </tbody>
                <!-- <thead class="bg-blue-chambray bg-font-blue-chambray">
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
                </thead> -->
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="tab-po-invoice"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="po-modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-blue-chambray bg-font-blue-chambray">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title uppercase bold"> Create Invoice</h4>
      </div>
      <form id="po-modal-form" method="post">
        <div class="modal-body bg-grey-steel">
          <div class="portlet light" style="margin-bottom: 0px;">
            <div class="form-group">
              <label for="so_type" class="control-label">Type</label>
              <input type="text" name="so_type" id="so_type" class="form-control">
            </div>
            <div class="form-group">
              <label for="so_invoice_no" class="control-label">Invoice No</label>
              <input type="text" name="so_invoice_no" id="so_invoice_no" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey-gallery btn-outline" data-dismiss="modal">Close</button>
          <button type="submit" class="btn yellow-casablanca"><i class="fa fa-check"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>