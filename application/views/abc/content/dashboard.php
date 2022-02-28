<style>
  .table th {
    vertical-align: middle !important;
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
<div class="row widget-row">
  <div class="col-md-3">
    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
      <h4 class="widget-thumb-heading">Invoices</h4>
      <div class="widget-thumb-wrap">
        <i class="widget-thumb-icon bg-blue-chambray icon-notebook"></i>
        <div class="widget-thumb-body">
          <span class="widget-thumb-subtitle">Total</span>
          <span class="widget-thumb-body-stat" data-counter="counterup" data-value="0">0</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
      <h4 class="widget-thumb-heading">Order</h4>
      <div class="widget-thumb-wrap">
        <i class="widget-thumb-icon bg-blue-chambray icon-bar-chart"></i>
        <div class="widget-thumb-body">
          <span class="widget-thumb-subtitle">Total</span>
          <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= $so ?>">0</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
      <h4 class="widget-thumb-heading">Weekly Sales</h4>
      <div class="widget-thumb-wrap">
        <i class="widget-thumb-icon bg-blue-chambray icon-wallet"></i>
        <div class="widget-thumb-body">
          <span class="widget-thumb-subtitle">Total</span>
          <span class="widget-thumb-body-stat" data-counter="counterup" data-value="0">0</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
      <h4 class="widget-thumb-heading">Monthly Sales</h4>
      <div class="widget-thumb-wrap">
        <i class="widget-thumb-icon bg-blue-chambray icon-wallet"></i>
        <div class="widget-thumb-body">
          <span class="widget-thumb-subtitle">Total</span>
          <span class="widget-thumb-body-stat" data-counter="counterup" data-value="0">0</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="portlet light">
      <div class="portlet-title tabbable-line">
        <div class="caption">
          <span class="caption-subject bold uppercase">
            Approval
          </span>
        </div>
        <div class="actions">
          <div class="btn-group">
            <a href="javascript:" class="btn btn-default" data-toggle="dropdown">
              <i class="fa fa-cog"> </i>
              Approval Actions
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="#" class="action-approve">
                  <i class="fa fa-check"></i> Approve Transaction</a>
              </li>
              <li>
                <a href="#" class="action-reject">
                  <i class="fa fa-close"></i> Reject Transaction</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body">
        <?php $this->load->view('abc/component/dashboard_approval_table') ?>
      </div>
    </div>
  </div>
  <!-- <div class="col-lg-6">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">
            Sales per Month
          </span>
        </div>
      </div>
      <div class="portlet-body">

      </div>
    </div>
  </div> -->
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">
            Stock On Order
          </span>
        </div>
      </div>
      <div class="portlet-body">
        <?php $this->load->view('abc/component/table_stock_on_process') ?>
      </div>
    </div>
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">
            Current Monthly Sales
          </span>
        </div>
      </div>
      <div class="portlet-body">
        <?php $this->load->view('abc/component/table_le_sales') ?>
      </div>
    </div>
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">
            Current Month Stock
          </span>
        </div>
      </div>
      <div class="portlet-body">
        <?php $this->load->view('abc/component/table_stockcard') ?>
      </div>
    </div>
  </div>
</div>