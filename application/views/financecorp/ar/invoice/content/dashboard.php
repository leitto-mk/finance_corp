<style>
  .table th {
    vertical-align: middle !important;
  }

  .col-box {
    width: 20%;
  }

  .col-box a {
    text-decoration: none;
  }

  @media only screen and (max-width: 768px) {
    .col-box {
      width: 100% !important;
    }
  }
</style>
<h1 class="page-title"><?= $title ?></h1>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="icon-home"></i>
      <a href="#">Home</a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="row widget-row">
      <div class="col-lg-3 col-md-12 col-sm-12 col-box">
        <a href="#">
          <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 widget-status">
            <h4 class="widget-thumb-heading">Waiting</h4>
            <div class="widget-thumb-wrap">
              <i class="widget-thumb-icon bg-blue-chambray icon-hourglass"></i>
              <div class="widget-thumb-body">
                <span class="widget-thumb-subtitle">Total</span>
                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= rand(10, 100) ?>"><?= rand(10, 100) ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-12 col-sm-12 col-box">
        <a href="#">
          <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 widget-status">
            <h4 class="widget-thumb-heading">Approved</h4>
            <div class="widget-thumb-wrap">
              <i class="widget-thumb-icon bg-blue-chambray icon-check"></i>
              <div class="widget-thumb-body">
                <span class="widget-thumb-subtitle">Total</span>
                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= rand(10, 100) ?>"><?= rand(10, 100) ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-12 col-sm-12 col-box">
        <a href="#">
          <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 widget-status">
            <h4 class="widget-thumb-heading">Cancel</h4>
            <div class="widget-thumb-wrap">
              <i class="widget-thumb-icon bg-blue-chambray icon-close"></i>
              <div class="widget-thumb-body">
                <span class="widget-thumb-subtitle">Total</span>
                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= rand(10, 100) ?>"><?= rand(10, 100) ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-12 col-sm-12 col-box">
        <a href="#">
          <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 widget-status">
            <h4 class="widget-thumb-heading">Paid</h4>
            <div class="widget-thumb-wrap">
              <i class="widget-thumb-icon bg-blue-chambray icon-wallet"></i>
              <div class="widget-thumb-body">
                <span class="widget-thumb-subtitle">Total</span>
                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= rand(10, 100) ?>"><?= rand(10, 100) ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-12 col-sm-12 col-box">
        <a href="#">
          <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 widget-status">
            <h4 class="widget-thumb-heading">Unpaid</h4>
            <div class="widget-thumb-wrap">
              <i class="widget-thumb-icon bg-blue-chambray icon-wallet"></i>
              <div class="widget-thumb-body">
                <span class="widget-thumb-subtitle">Total</span>
                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= rand(10, 100) ?>"><?= rand(10, 100) ?></span>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">List Invoice Approval</span>
        </div>
        <!-- <button class="btn font-white pull-right" style="margin-left: 10px; background-color: #F2784B">Create Service Invoice</button> -->
        <!-- <button class="btn font-white pull-right" style="background-color: #F2784B">Create Invoice</button> -->
      </div>
      <div class="portlet-body">
        <?php $this->load->view('financecorp/ar/invoice/component/table_invoice_approval'); ?>
      </div>
    </div>
  </div>
</div>