<?php $this->load->view('financecorp/payable/header_rep_corp'); ?>
<div class="portlet light" id="printDiv">
    <style type="text/css">
        /*tr:nth-child(even){
            background-color: #eef1f5;
        }

        tr:nth-child(odd){
            background-color: white;
        }*/

        .table th h5 {
            margin-top: -1px;
            margin-bottom: -1px;
            font-size: 11px;
        }

        .table td h6 {
            margin-top: -1px;
            margin-bottom: -1px;
            font-size: 11px;
        }
    </style>
    <div class="row">
        <div class="col-md-12" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left hidden-print">
                    <div class="portlet light form-horizontal bg-default">
                        <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                            <div class="portlet-body form-horizontal hidden-print" style="margin-top: 60px">
                                <div >
                                    <table class="table table-bordered table-stripped table-condensed" style="margin-top: -50px">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th width="5%"></th>
                                                <th width="15%"><h5 class="text-center bold">Branch</h5></th>
                                                <th width="15%"><h5 class="text-center bold">Type</h5></th>
                                                <th width="15%"><h5 class="text-center bold">Document No. Start</h5></th>
                                                <th width="15%"><h5 class="text-center bold">Document No. End</h5></th>
                                                <th width="15%"><h5 class="text-center bold">Start Date</h5></th>
                                                <th width="20%"><h5 class="text-center bold">End Date</h5></th>
                                                <th width="5%"><h5 class="text-center bold">Action</h5></th>        
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
                                                                <option value="all">All</option>
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: -20px">
                            <span class="input-group-btn">
                                <a href="#" class="btn btn-xs btn green hidden-print pull-right"  onclick="printDiv('printDiv')" style="margin-left: 5px">
                                    <i class="fa fa-plus"></i>&nbsp;Print</i>
                                </a>
                                <a onclick="window.close();" class="btn btn-xs btn red hidden-print pull-right"><i class="fa fa-close"></i> Close</a>
                            </span>
                        </div>
                    </div>
                    <div class="portlet bordered light">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-logo-space text-center" style="margin-top: -5px">
                                <div>
                                    <font size="3" class="uppercase"><?= $company ?></font><br>
                                    <font size="2" class="font-dark sbold uppercase">Journal Report</font><br>
                                    <font size="3" class="font-dark sbold"><i class="fa fa-calendar"></i> Date : <span id="label_date_start"></span> --- <span id="label_date_finish"></span></font>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-stripped table-condensed" id="table_jtr" >
                                            <thead>
                                                <tr class="bg-blue-dark font-white">
                                                    <th width="8%"><h5 class="text-center bold"> Trans Date </h5></th>
                                                    <th width="8%"><h5 class="text-center bold"> Doc No </h5></th>
                                                    <th width="4%"><h5 class="text-center bold"> Type </h5></th>
                                                    <th width="42%"><h5 class="text-center bold"> Description </h5></th>
                                                    <!-- <th width="8%"><h5 class="text-center bold"> Dept </h5></th>
                                                    <th width="8%"><h5 class="text-center bold"> CostC </h5></th> -->
                                                    <th width="6%"><h5 class="text-center bold"> Account </h5></th>
                                                    <!-- <th width="15%"><h5 class="text-center bold"> Acc Name </h5></th> -->
                                                    <th width="4%"><h5 class="text-center bold"> Cry </h5></th>
                                                    <th width="4%"><h5 class="text-center bold"> Rate </h5></th>
                                                    <th width="8%"><h5 class="text-right bold"> Unit </h5></th>
                                                    <th width="8%"><h5 class="text-right bold"> Debit </h5></th>
                                                    <th width="8%"><h5 class="text-right bold"> Credit </h5></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="10"><h5 class="text-center font-dark bold">-- Select Parameters --</h5></td>
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