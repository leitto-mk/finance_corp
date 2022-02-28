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
    <li>
      <span>Detail</span>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="portlet light">
      <div class="invoice-content-2 ">
        <div class="row invoice-head">
          <div class="col-md-7 col-xs-6">
            <div class="invoice-logo">
              <img src="<?= base_url('assets/assets/layouts/layout/img/IPHLogo.jpg') ?>" class="img-responsive" alt="" />
              <!-- <h1 class="uppercase">Invoice</h1> -->
            </div>
          </div>
          <div class="col-md-5 col-xs-6">
            <div class="company-address">
              <span class="bold uppercase"><?= $branch['BranchName'] ?></span>
              <br> <?= $branch['BranchAddress'] ?>
              <br> <?= $branch['BranchCity'] ?>, <?= $branch['Province'] ?>
              <br> <?= $branch['PhoneNo'] ?>
              <br> <?= $branch['Email'] ?>
            </div>
          </div>
        </div>
        <div class="row invoice-cust-add">
          <div class="col-xs-3">
            <h2 class="invoice-title uppercase">Customer</h2>
            <p class="invoice-desc"><?= $master['Customer'] ?></p>
          </div>
          <div class="col-xs-3">
            <h2 class="invoice-title uppercase">Date</h2>
            <p class="invoice-desc"><?= date('d F Y', strtotime($master['RaiseDate'])) ?></p>
          </div>
          <div class="col-xs-6">
            <h2 class="invoice-title uppercase">Address</h2>
            <p class="invoice-desc inv-address"><?= $master['Address'] ?></p>
          </div>
        </div>
        <div class="row invoice-body">
          <div class="col-xs-12 table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th class="invoice-title uppercase">Description</th>
                  <th class="invoice-title uppercase text-center">Hours</th>
                  <th class="invoice-title uppercase text-center">Rate</th>
                  <th class="invoice-title uppercase text-center">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <h3>Web Design & Development</h3>
                    <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet et dolore siat magna aliquam erat volutpat. </p>
                  </td>
                  <td class="text-center sbold">200</td>
                  <td class="text-center sbold">80$</td>
                  <td class="text-center sbold">16,000$</td>
                </tr>
                <tr>
                  <td>
                    <h3>Branding</h3>
                    <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod. </p>
                  </td>
                  <td class="text-center sbold">130</td>
                  <td class="text-center sbold">60$</td>
                  <td class="text-center sbold">7,800$</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row invoice-subtotal">
          <div class="col-xs-3">
            <h2 class="invoice-title uppercase">Subtotal</h2>
            <p class="invoice-desc">23,800$</p>
          </div>
          <div class="col-xs-3">
            <h2 class="invoice-title uppercase">Tax (0%)</h2>
            <p class="invoice-desc">0$</p>
          </div>
          <div class="col-xs-6">
            <h2 class="invoice-title uppercase">Total</h2>
            <p class="invoice-desc grand-total">23,800$</p>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <a class="btn btn-lg green-haze hidden-print uppercase print-btn" onclick="javascript:window.print();">Print</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>