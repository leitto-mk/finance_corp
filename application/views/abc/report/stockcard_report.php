<style>
  table#table-stockcard>thead>tr>th {
    font-size: 12px;
    vertical-align: middle;
    text-align: center;
    padding: 5px;
  }

  table#table-stockcard>tbody>tr>td {
    font-size: 12px;
    vertical-align: middle;
  }
</style>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="icon-home"></i>
      <a href="<?= site_url('abc/dashboard') ?>">Home</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="#">Report</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <span>Stockcard Report</span>
    </li>
  </ul>
  <div class="page-toolbar">
    <div class="btn-group pull-right">
      <button type="button" class="btn btn-fit-height blue-chambray dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
        <i class="fa fa-angle-down"></i>
      </button>
      <ul class="dropdown-menu pull-right" role="menu">
        <li>
          <a href="<?= site_url('download/report/wo?') . 'date_start=' . date('y-m-d') . '&date_end=' . date('y-m-d') ?>" target="_blank" id="btn-download-pdf">
            <i class="icon-doc"></i>Save as PDF</a>
        </li>
      </ul>
    </div>
  </div>
</div>
<?php $this->load->view('abc/content/stockcard') ?>