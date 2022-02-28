<style>
  textarea {
    resize: none;
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
  <div class="page-toolbar">
    <div class="btn-group pull-right">
      <button type="button" class="btn btn-fit-height blue-chambray dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
        <i class="fa fa-angle-down"></i>
      </button>
      <ul class="dropdown-menu pull-right" role="menu">
        <li>
          <a href="#create-bo-modal" data-toggle="modal" id="action-new-backorder">
            <i class="icon-plus"></i> New Back Order</a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Back Order List</span>
          <span class="caption-helper" id="portlet-report"></span>
        </div>
      </div>
      <div class="portlet-body">
        <?php $this->load->view('abc/component/table_back_order') ?>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Summary Back Order</span>
          <span class="caption-helper" id="portlet-report"></span>
        </div>
      </div>
      <div class="portlet-body">
        <?php $this->load->view('abc/component/table_bo_stockcode') ?>
      </div>
    </div>
  </div>
</div>
<div id="create-bo-modal" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-blue-chambray bg-font-blue-chambray">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title uppercase bold"><i class="fa fa-plus"></i> Create Back Order</h4>
      </div>
      <form id="modal-form" method="post">
        <div class="modal-body bg-grey-steel">
          <div class="alert alert-success hidden alert-dismissable">
            <button type="button" class="close"></button>
            <div class="content-message"></div>
          </div>
          <div id="body-content">

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

<div id="view-bo-modal" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-blue-chambray bg-font-blue-chambray">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title uppercase bold"><i class="fa fa-search"></i> Detail Back Order</h4>
      </div>
      <form id="modal-form" method="post">
        <div class="modal-body bg-grey-steel">
          <div class="alert alert-success hidden alert-dismissable">
            <button type="button" class="close"></button>
            <div class="content-message"></div>
          </div>
          <div id="body-content">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey-gallery btn-outline" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="receive-bo-modal" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-full">
    <div class="modal-content">
      <div class="modal-header bg-blue-chambray bg-font-blue-chambray">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title uppercase bold"><i class="fa fa-search"></i> Receive Back Order</h4>
      </div>
      <form id="receive-modal-form" method="post">
        <div class="modal-body bg-grey-steel">
          <div class="alert alert-success hidden alert-dismissable">
            <button type="button" class="close"></button>
            <div class="content-message"></div>
          </div>
          <div id="body-content">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey-gallery btn-outline" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>