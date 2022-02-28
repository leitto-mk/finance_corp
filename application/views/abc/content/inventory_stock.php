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
      <a href="<?= site_url('abc/dashboard') ?>">Home</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <span>Inventory Stock</span>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">All Stock</span>
        </div>
      </div>
      <div class="portlet-body">
        <?php $this->load->view('abc/component/table_inventory_stock') ?>
      </div>
    </div>
  </div>
</div>
<div id="stock_modal" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-blue-chambray bg-font-blue-chambray">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title uppercase bold"><i class="fa fa-search"></i> Stock Detail</h4>
      </div>
      <div class="modal-body bg-grey-steel">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn grey-gallery btn-outline" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>