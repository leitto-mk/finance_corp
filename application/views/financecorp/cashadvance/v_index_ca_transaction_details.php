<?php $this->load->view('financecorp/cashadvance/header_rep_corp'); ?>
<style type="text/css">
    tr:nth-child(even){
        background-color: #eef1f5;
    }

    tr:nth-child(odd){
        background-color: white;
    }
</style>
<div class="portlet light">
    <div class="row">
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left hidden-print">
                    <div class="portlet light form-horizontal bg-default">
                        <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                            <div class="portlet-body form-horizontal hidden-print" style="margin-top: 60px">
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th width="5%"></th>
                                                <th class="text-center" width="15%">Branch</th>
                                                <th class="text-center" width="15%">Department</th>
                                                <th class="text-center" width="20%">Cost Center</th>
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
                                                            <select id="branch" name="branch" class="form-control" required>
                                                                <option value="all">All</option>
                                                                <?php for($i=0; $i < count($branch); $i++) : ?>
                                                                    <option value="<?= $branch[$i]['BranchCode'] ?>"><?= $branch[$i]['BranchName'] ?></option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="department" name="department" class="form-control" required>
                                                                <option value="all">All</option>
                                                                <?php for($i=0; $i < count($department); $i++) : ?>
                                                                    <option value="<?= $department[$i]['DeptCode'] ?>"><?= $department[$i]['DeptDes'] ?></option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="costcenter" name="costcenter" class="form-control" required>
                                                                <option value="all">All</option>
                                                                <?php for($i=0; $i < count($costcenter); $i++) : ?>
                                                                    <option value="<?= $costcenter[$i]['CostCenter'] ?>"><?= $costcenter[$i]['CCDes'] ?></option>
                                                                <?php endfor; ?>
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
                                                <td>
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
                <div class="col-md-12">
                    <div class="portlet bordered light">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-logo-space text-center" style="margin-top: -5px">
                            <div>
                                <font size="6"><?= $company ?></font><br>
                                <font size="4" class="font-dark sbold uppercase">Cash Advance Transaction</font><br>
                                <font size="3" class="font-dark sbold"><i class="fa fa-calendar"></i> Date : <span id="label_date_start"></span> --- <span id="label_date_finish"></span></font>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped table-condensed">
                                    <thead>
                                        <tr class="bg-blue-dark font-white">
                                            <th class="text-center" width="7%"> Trans Date </th>
                                            <th class="text-center" width="7%"> Doc No </th>
                                            <th class="text-center" width="7%"> Trans Type </th>
                                            <th class="text-center" width="7%"> ID No  </th>
                                            <th class="text-center" width="15%"> Full Name </th>
                                            <th class="text-center" width="15%"> Remarks </th>
                                            <th class="text-center" width="15%"> Department </th>
                                            <th class="text-center" width="5%"> Currency </th>
                                            <th class="text-center" width="5%"> Rate </th>
                                            <th class="text-center" width="10%"> Unit </th>
                                            <th class="text-center" width="10%"> Amount  </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_report">
                                        <tr>
                                            <td colspan="11" class="bold uppercase text-center bg-info">-- Select Parameters --</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php $this->load->view('financecorp/cashadvance/footer'); ?>