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
      <span>Direct Purchase</span>
    </li>
  </ul>
  <div class="page-toolbar">
    <div class="btn-group pull-right">
      <button type="button" class="btn btn-fit-height blue-chambray dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
        <i class="fa fa-angle-down"></i>
      </button>
      <ul class="dropdown-menu pull-right" role="menu">
        <li>
          <a href="<?= site_url('purchase/direct_purchase/new') ?>" id="action-new-directpurchase">
            <i class="icon-plus"></i> New Direct Purchase</a>
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
<div class="row">
  <div class="col-lg-12">
    <div class="portlet light bg-font-white">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Direct Purchase List</span>
          <span class="caption-helper" id="portlet-report"></span>
        </div>
      </div>
      <div class="portlet-body">
        <?php $this->load->view('abc/component/table_direct_purchase')
        ?>
      </div>
    </div>
  </div>
</div>