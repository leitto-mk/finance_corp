<style>
  td i.fa {
    width: 12px;
  }

  td a.btn-xs {
    margin-bottom: 5px;
  }

  td {
    vertical-align: middle !important;
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
      <span>Sales Order</span>
    </li>
  </ul>
  <div class="page-toolbar">
    <div class="btn-group pull-right">
      <button type="button" class="btn btn-fit-height blue-chambray dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
        <i class="fa fa-angle-down"></i>
      </button>
      <ul class="dropdown-menu pull-right" role="menu">
        <li>
          <a href="<?= site_url('abc/sales/sales_order/new') ?>" id="action-new-salesorder">
            <i class="icon-plus"></i> New Sales Order</a>
        </li>
        <li>
          <a href="#" id="btn-download-pdf">
            <i class="icon-doc"></i> Save as PDF</a>
        </li>
        <li>
          <a href="#" id="btn-download-excel">
            <i class="icon-doc"></i> Save as Excel</a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="row widget-row">
  <div class="col-md-3">
    <!-- BEGIN WIDGET THUMB -->
    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" id="widget-so-order" style="cursor: pointer;">
      <h4 class="widget-thumb-heading">Order</h4>
      <div class="widget-thumb-wrap">
        <i class="widget-thumb-icon bg-blue-chambray icon-present"></i>
        <div class="widget-thumb-body">
          <span class="widget-thumb-subtitle">Total</span>
          <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= $order ?>" id="so-order">0</span>
        </div>
      </div>
    </div>
    <!-- END WIDGET THUMB -->
  </div>
  <div class="col-md-3">
    <!-- BEGIN WIDGET THUMB -->
    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" id="widget-so-process" style="cursor: pointer;">
      <h4 class="widget-thumb-heading">On Process</h4>
      <div class="widget-thumb-wrap">
        <i class="widget-thumb-icon bg-blue-chambray icon-clock"></i>
        <div class="widget-thumb-body">
          <span class="widget-thumb-subtitle">Total</span>
          <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= $process ?>" id="so-process">0</span>
        </div>
      </div>
    </div>
    <!-- END WIDGET THUMB -->
  </div>
  <div class="col-md-3">
    <!-- BEGIN WIDGET THUMB -->
    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" id="widget-so-completed" style="cursor: pointer;">
      <h4 class="widget-thumb-heading">Completed</h4>
      <div class="widget-thumb-wrap">
        <i class="widget-thumb-icon bg-blue-chambray icon-check"></i>
        <div class="widget-thumb-body">
          <span class="widget-thumb-subtitle">Total</span>
          <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= $completed ?>" id="so-completed">0</span>
        </div>
      </div>
    </div>
    <!-- END WIDGET THUMB -->
  </div>
  <div class="col-md-3">
    <!-- BEGIN WIDGET THUMB -->
    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" id="widget-so-cancelled" style="cursor: pointer;">
      <h4 class="widget-thumb-heading">Cancelled</h4>
      <div class="widget-thumb-wrap">
        <i class="widget-thumb-icon bg-blue-chambray icon-trash"></i>
        <div class="widget-thumb-body">
          <span class="widget-thumb-subtitle">Total</span>
          <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= $cancelled ?>" id="so-cancelled">0</span>
        </div>
      </div>
    </div>
    <!-- END WIDGET THUMB -->
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="portlet light bg-font-white">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Sales Order List</span>
          <span class="caption-helper" id="portlet-report"></span>
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
                <a href="#" class="approve-so">
                  <i class="fa fa-check"></i> Approve Sales Order</a>
              </li>
              <li>
                <a href="#" class="reject-so">
                  <i class="fa fa-close"></i> Reject Sales Order</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body">
        <?php $this->load->view('abc/component/table_sales_order') ?>
      </div>
    </div>
  </div>
</div>

<div id="so-modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-blue-chambray bg-font-blue-chambray">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title uppercase bold"> Parameter</h4>
      </div>
      <form id="so-modal-form" method="post">
        <div class="modal-body bg-grey-steel">
          <div class="portlet light" style="margin-bottom: 0px;">
            <div class="form-group">
              <label for="so_rangedate" class="control-label">Range Date</label>
              <input type="text" name="so_rangedate" id="so_rangedate" class="form-control" readonly style="cursor: pointer;">
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