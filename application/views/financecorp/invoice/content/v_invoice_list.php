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

  td i.fa {
    width: 12px;
  }

  td a.btn-xs {
    margin-bottom: 5px;
  }
</style>
<!-- <h1 class="page-title"><?= $title ?></h1>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="icon-home"></i>
      <a href="#"><?= $title ?></a>
    </li>
  </ul>
</div> -->
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left hidden-print">
        <div class="portlet light form-horizontal bg-default">
            <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                <div class="portlet-body form-horizontal hidden-print" style="margin-top: 10px">
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-blue-chambray font-white">
                                    <th width="5%"></th>
                                    <th class="text-center" width="15%">Customer</th>
                                    <th class="text-center" width="15%">Start Date</th>
                                    <th class="text-center" width="15%">End Date</th>
                                    <th class="text-center" width="5%">Action</th>        
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-md-12 control-label bold">Parameters</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <select id="school" name="school" class="form-control" required>
                                                    <option value="All">All</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="date" name="date_start" id='date_start' value="<?= date('Y-01-01') ?>" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="date" name="date_finish" id='date_finish' value="<?= date('Y-m-d') ?>" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td align="center">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <a class="btn btn-sm bg-blue-madison font-white" id="submit_filter">
                                                    <center>PREVIEW</center>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                                                           
                </div>
            <?php echo form_close(); ?>
        </div>  
    </div>
</div>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">List Invoice</span>
        </div>
        <button class="btn font-white pull-right" style="margin-left: 10px; background-color: #F2784B">Create Service Invoice</button>
        <button class="btn font-white pull-right" style="background-color: #F2784B">Create Invoice</button>
      </div>
      <div class="portlet-body">
        <table class="table table-bordered table-hover">
          <thead class="bg-blue-chambray bg-font-blue-chambray">
            <tr>
              <th class="text-center" width="5%">No</th>
              <th class="text-center" width="10%">Invoice No</th>
              <th class="text-center" width="20%">Customer</th>
              <th class="text-center" width="7%">Invoice Date</th>
              <th class="text-center" width="7%">Payment Due</th>
              <th class="text-center" width="12%">Invoice Amount</th>
              <th class="text-center" width="12%">Paid</th>
              <th class="text-center" width="12%">Balance</th>
              <th class="text-center" width="15%">Action</th>
              <!-- <th class="text-center" width="25%">Customer Group</th> -->
            </tr>
          </thead>
          <tbody>
            <tr>
              <td align="center">1</td>
              <td align="center">INV2112-001</td>
              <td>BES Building & Engineering Services</td>
              <td align="center">2020-02-12</td>
              <td align="center">2020-03-12</td>
              <td align="right">1,000,000.00</td>
              <td align="right">1,000,000.00</td>
              <td align="right">1,000,000.00</td>
              <td align="center">
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Detail">
                    <i class="fa fa-search"></i>
                  </a>
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Edit">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Delete">
                    <i class="fa fa-close"></i>
                  </a>
              </td>
            </tr>
            <tr>
              <td align="center">2</td>
              <td align="center">INV2112-002</td>
              <td>BES Building & Engineering Services</td>
              <td align="center">2020-02-12</td>
              <td align="center">2020-03-12</td>
              <td align="right">1,000,000.00</td>
              <td align="right">1,000,000.00</td>
              <td align="right">1,000,000.00</td>
              <td align="center">
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Detail">
                    <i class="fa fa-search"></i>
                  </a>
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Edit">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Delete">
                    <i class="fa fa-close"></i>
                  </a>
              </td>
            </tr>
            <tr>
              <td align="center">3</td>
              <td align="center">INV2112-003</td>
              <td>BES Building & Engineering Services</td>
              <td align="center">2020-02-12</td>
              <td align="center">2020-03-12</td>
              <td align="right">1,000,000.00</td>
              <td align="right">1,000,000.00</td>
              <td align="right">1,000,000.00</td>
              <td align="center">
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Detail">
                    <i class="fa fa-search"></i>
                  </a>
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Edit">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Delete">
                    <i class="fa fa-close"></i>
                  </a>
              </td>
            </tr>
            <tr>
              <td align="center">4</td>
              <td align="center">INV2112-004</td>
              <td>BES Building & Engineering Services</td>
              <td align="center">2020-02-12</td>
              <td align="center">2020-03-12</td>
              <td align="right">1,000,000.00</td>
              <td align="right">1,000,000.00</td>
              <td align="right">1,000,000.00</td>
              <td align="center">
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Detail">
                    <i class="fa fa-search"></i>
                  </a>
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Edit">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Delete">
                    <i class="fa fa-close"></i>
                  </a>
              </td>
            </tr>
            <tr>
              <td align="center">5</td>
              <td align="center">INV2112-005</td>
              <td>BES Building & Engineering Services</td>
              <td align="center">2020-02-12</td>
              <td align="center">2020-03-12</td>
              <td align="right">1,000,000.00</td>
              <td align="right">1,000,000.00</td>
              <td align="right">1,000,000.00</td>
              <td align="center">
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Detail">
                    <i class="fa fa-search"></i>
                  </a>
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Edit">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Delete">
                    <i class="fa fa-close"></i>
                  </a>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>