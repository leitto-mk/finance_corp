<style>
  td i.fa {
    width: 12px;
  }

  td a.btn-xs {
    margin-bottom: 5px;
  }

  td,
  th {
    vertical-align: middle !important;
    font-size: 10px !important;
    text-align: center;
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
      <span>Production Cost</span>
    </li>
  </ul>
</div>

<div class="row">
  <div class="col-lg-2">
    <div class="portlet light">

    </div>
  </div>
  <div class="col-lg-12">
    <div class="portlet light">
      <table class="table table-bordered" id="table-production">
        <thead class="bg-blue-chambray bg-font-blue-chambray">
          <tr>
            <th rowspan="3">Stockcode</th>
            <th rowspan="3">Stock Name</th>
            <th rowspan="3">Unit</th>
            <th rowspan="2">Sale Price</th>
            <th colspan="5">IPH Fund</th>
            <th colspan="3">ABC</th>
            <th>LE</th>
            <th colspan="5">Union Fund</th>
            <th rowspan="2">Tithe</th>
            <th rowspan="3">Action</th>
          </tr>
          <tr>
            <th>Factory Costs
            <th>Operation</th>
            <th>Profit</th>
            <th>New Equip</th>
            <th>Total</th>
            <th>Operation</th>
            <th>Cashier</th>
            <th>Total</th>
            <th>Commission</th>
            <th>LMS Fund</th>
            <th>LE Benefiit Fund</th>
            <th>Leads Fund</th>
            <th>LE Retire</th>
            <th>Total</th>
          </tr>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>