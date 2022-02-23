<?php $this->load->view('financecorp/payable/header_rep_corp'); ?>
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
                                                <th class="text-center" width="15%">Type</th>
                                                <th class="text-center" width="15%">Account No. Start</th>
                                                <th class="text-center" width="15%">Account No. End</th>
                                                <th class="text-center" width="15%">Start Date</th>
                                                <th class="text-center" width="20%">End Date</th>
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
                                                                <option value="">-- Select Branch -- </option>
                                                                <?php foreach($branch as $branch) : ?>
                                                                    <option value="<?= $branch->BranchCode?>">[<?= $branch->BranchCode?>] <?= $branch->BranchName ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="transtype" name="transtype" class="form-control" required>
                                                                <option value="">-- Select Type -- </option>
                                                                <option value="RE">Receipt</option>
                                                                <option value="PA">Payment</option>
                                                                <option value="OB">Overbook</option>
                                                                <option value="GJ">General Journal</option>
                                                                <option value="CAW">Cash Withdraw</option>
                                                                <option value="CAR">Cash Receipt</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="accno_start" id="accno_start">
                                                                <option value="">-- Choose --</option>
                                                                <?php foreach($account_no as $accno) : ?>
                                                                    <option value="<?= $accno->Acc_No?>">[<?= $accno->Acc_No?>] <?= $accno->Acc_Name?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="accno_finish" id="accno_finish">
                                                                <option value="">-- Choose --</option>
                                                                <?php foreach($account_no as $accno) : ?>
                                                                    <option value="<?= $accno->Acc_No?>">[<?= $accno->Acc_No?>] <?= $accno->Acc_Name?></option>
                                                                <?php endforeach; ?>
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
                                <font size="6">Company Name</font><br>
                                <font size="4" class="font-dark sbold uppercase">Journal Report</font><br>
                                <!-- <font size="3" class="font-dark sbold">
                                    <i class="fa fa-calendar"></i> 
                                    <span id="period">Periode : - </span>
                                </font> -->
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table id="table_jtr" class="table table-bordered table-stripped table-condensed">
                                    <thead>
                                        <tr class="bg-blue-dark font-white">
                                            <th class="text-center" width="7%"> Trans Date </th>
                                            <th class="text-center" width="8%"> Doc No </th>
                                            <th class="text-center" width="5%"> Type </th>
                                            <th class="text-center" width="12%"> Description </th>
                                            <th class="text-center" width="8%"> Dept </th>
                                            <th class="text-center" width="8%"> CostC </th>
                                            <th class="text-center" width="5%"> Account </th>
                                            <th class="text-center" width="15%"> Acc Name </th>
                                            <th class="text-center" width="5%"> Cry </th>
                                            <th class="text-center" width="5%"> Rate </th>
                                            <th class="text-center" width="5%"> Unit </th>
                                            <th class="text-center" width="10%"> Debit </th>
                                            <th class="text-center" width="10%"> Credit </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="font-dark sbold">
                                            <td align="center" colspan="13">-- Select Parameters --</td>
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
    window.onload = load_function;

    function load_function() {
        document.body.style.zoom = 0.9;
    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php $this->load->view('financecorp/payable/footer'); ?>