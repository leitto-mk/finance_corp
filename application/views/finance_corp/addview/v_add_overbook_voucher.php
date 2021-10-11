<?php $this->load->view('header_footer/finance_corp/header'); ?>
<body class="page-container-bg-solid">
    <div class="page-wrapper">
        <div class="page-wrapper-row">
            <div class="page-wrapper-top">
                <!-- BEGIN HEADER MENU -->
                <div class="page-header-menu" style="background:#444d58;">
                    <div class="container-fluid">
                        <div class="hor-menu  ">
                            <ul class="nav navbar-nav">
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active uppercase">
                                    <h4 style="color:#ffffff">Overbook Voucher</h4>
                                </li>
                            </ul>
                        </div>
                        <!-- END MEGA MENU -->
                    </div>
                </div>
                <!-- END HEADER MENU -->
            </div>
        </div>
        <div class="page-wrapper-row full-height">
            <div class="page-wrapper-middle">
                <!-- BEGIN CONTAINER -->
                <div class="page-container">
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN PAGE CONTENT BODY -->
                        <div class="page-content">
                            <div class="container-fluid" style="padding-bottom:30px;">
                                <!-- BEGIN PAGE CONTENT INNER -->
                                <div class="page-content-inner">
                                    <!-- Content Start -->
                                    <form method="post" class="form-horizontal" id="form_overbook" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="portlet light" style="height: 300px">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-edit"></i> Master Transaction </span>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="btn-group btn-group-devided">
                                                                <button class="btn btn-transparent green btn-sm" id="btn_submit" type="submit">
                                                                    <i class="fa fa-check"></i> Submit
                                                                </button>
                                                                <a class="btn blue-madison btn-sm" id="tools_print_exprt">
                                                                    <i class="fa fa-print"></i> Print
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-9 col-xs-12 col-sm-12 bg-grey-salsa">
                                                            <div class="portlet-body form-horizontal">
                                                                <div class="form-body" style="margin-top: 10px">
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Document No.</b></label>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                    #
                                                                                </span>
                                                                                <input type="text" name="docno" class="form-control" readonly value="<?= $docno ?>" style="background-color:white;">
                                                                            </div>
                                                                        </div>
                                                                        <!-- Row 2 -->
                                                                        <label class="col-md-2 control-label"><b>Account No.</b></label>
                                                                        <div class="col-md-3" data-toggle="modal" data-target="#modal_caccount">
                                                                            <select name="accno" id="accno" class="form-control" required>
                                                                                <option value="">--Choose Account No--</option>
                                                                                <?php foreach($accno as $acc) : ?>
                                                                                    <option value="<?= $acc->Acc_No ?>"><?= $acc->Acc_No ?> | <?= $acc->Acc_Name ?> - [<?= $acc->Acc_Type?>]</option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;<span class="help-inline" id="accdesc"><b></b></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Transaction Date</b></label>
                                                                        <div class="col-md-3">
                                                                            <input type="date" id="transdate" name="transdate" class="form-control" required>
                                                                        </div>
                                                                        <label class="col-md-2 control-label"><b>Branch</b></label>
                                                                        <div class="col-md-3" data-toggle="modal" data-target="#modal_branch">
                                                                            <select name="branch" id="branch" class="form-control" data-live-search="true" data-size="8" required>
                                                                                <option value="">--Choose Branch--</option>
                                                                                <?php foreach($branch as $branch) : ?>
                                                                                    <option value="<?= $branch->BranchCode ?>"><?= $branch->BranchCode ?> - <?= $branch->BranchName ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><font color="red" size="2">*</font> <b>Journal Group</b></label>
                                                                        <div class="col-md-3">
                                                                            <select class="form-control" name="journalgroup" id="journalgroup" required>
                                                                                <option selected="true" value="">--Select Journal--</option>
                                                                                <option value="Cash">Cash</option>
                                                                                <option value="Bank">Bank</option>
                                                                                <option value="General Ledger">General Ledger</option>
                                                                            </select>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;<span class="help-inline" id="namestd"><b></b></span>
                                                                        <label class="col-md-2 control-label"><b>Paid To</b></label>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group">
                                                                                <input name="paidto" id="paidto" class="form-control"/>
                                                                                <span class="input-group-btn">
                                                                                    <button class="btn btn-primary" type="button" id="add_id"><i class="fa fa-plus"></i> Add</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Description</b></label>
                                                                        <div class="col-md-10">
                                                                            <textarea id="remark" name="remark" cols="30" rows="1" class="form-control" style="resize:none;" placeholder="Add remarks to your transaction..." value="-"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-xs-12 col-sm-12" style="padding: 0px">
                                                            <div class="portlet light" style="border-style: solid; border-color: lightgrey;">
                                                                <div class="portlet-body">
                                                                    <div class="mt-step-desc">
                                                                        <div class="font-dark bold uppercase">Total Amount</div>
                                                                        <br>
                                                                    </div>
                                                                    <div class="row static-info">
                                                                        <!-- <div class="col-md-2 name" style="font-size:20px;"> Rp. </div> -->
                                                                        <div class="col-md-12 value" style="margin-top: -15px">
                                                                            <b>
                                                                                <input style="text-align:right; background: #E9EDEF; font-size: 25px; border:none;" type="text" id="label_tot_amount" readonly="true" class="input-group input-group-sm form-control">
                                                                                <input type="number" class="form-control hidden" id="totalamount" name="totalamount">
                                                                            </b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="portlet light" style="border-style: solid; border-color: lightgrey; margin-top: -28px">
                                                                <div class="portlet-body">
                                                                    <div class="mt-step-desc">
                                                                        <div class="font-dark bold uppercase">Cheque / Giro</div>
                                                                        <br>
                                                                    </div>
                                                                    <div class="row static-info">
                                                                        <!-- <div class="col-md-2 name" style="font-size:20px;"> Rp. </div> -->
                                                                        <div class="col-md-12 value" style="margin-top: -15px">
                                                                            <b><input id="giro" name="giro" style="text-align:left; background: #E9EDEF;  border:none;" type="text" placeholder="Input Check/Giro Here" class="input-group input-group-sm form-control"></b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="portlet-title" style="background-color: lightblue">
                                                                <div class="caption ">
                                                                    <span class="caption-subject font-dark bold uppercase" style="padding-left: 20px">Issue List</span> |
                                                                    <span class="caption-helper font-dark bold">
                                                                        <font size="2"><b>Status</b> : <label class="label label-success label-sm bold" style="font-size: 10px;">Approved</label></font>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-advanced table-striped table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Document No</th>
                                                                                <th class="">Account No</th>
                                                                                <th class="">Trans Date</th>
                                                                                <th class="">Charges</th>
                                                                                <th class="">Credit</th>
                                                                                <th class="text-center">Balance</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="idetailss">
                                                                            <tr>
                                                                                <td colspan="8" align="center">--- Select Customer First ---</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="portlet bordered light bg-blue-dark">
                                                    <div class="portlet-body">
                                                        <div id="r_tbl_stockcode" class="portlet" style="margin-bottom: 5px;">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <span class="caption-subject font-white"><i class="icon-list"></i> Detail Transaction </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped" id="table_detail_transaction">
                                                                <thead>
                                                                    <tr style="background-color: #22313F" class="font-white">
                                                                        <th class="text-center" width="3%">Item No</th>
                                                                        <th class="text-center"> Description Det. </th>
                                                                        <th class="text-center"> Department </th>
                                                                        <th class="text-center"> Cost Center </th>
                                                                        <!-- <th class="text-center"> Paid To </th> -->
                                                                        <th class="text-center"> Account No. </th>
                                                                        <th class="text-center"> Cry. </th>
                                                                        <th class="text-center"> Rate </th>
                                                                        <th class="text-center"> Unit </th>
                                                                        <th class="text-center"> Amount </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody_detail">
                                                                    <tr style="background-color: #E9EDEF">
                                                                        <td><input type="number" name="itemno[]" class="form-control" readonly value="1"></td>
                                                                        <td><input type="text" name="remarks[]" class="form-control" required></td>
                                                                        <td><input type="text" name="departments[]" class="form-control" required></td>
                                                                        <td><input type="text" name="costcenters[]" class="form-control" required><span class="input-group-btn" type="button"></span></td>
                                                                        <!-- <td>
                                                                            <select name="emp[]" class="form-control" required>
                                                                                <option value="">--Choose ID--</option>
                                                                                <?php foreach($employee as $emp) : ?>
                                                                                    <option value="<?= $emp->IDNumber ?>" data-fullname="<?= $emp->FullName ?>" data-dept="<?= $emp->DeptCode ?>" data-cc="<?= $emp->CostCenter ?>"><?= $emp->IDNumber ?> - <?= $emp->FullName ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </td> -->
                                                                        <td>
                                                                            <select name="accnos[]" class="form-control" required>
                                                                                <option value="">--Choose Account No--</option>
                                                                                <?php for($i=0; $i < count($accno); $i++) : ?>
                                                                                    <?php if($accno[$i]['Acc_No'] < 11300) : ?>
                                                                                        <option value="<?= $accno[$i]['Acc_No'] ?>"><?= $accno[$i]['Acc_No'] ?> | <?= $accno[$i]['Acc_Name'] ?> - [<?= $accno[$i]['Acc_Type'] ?>]</option>
                                                                                    <?php endif; ?>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <select name="currency[]" class="form-control" required>
                                                                                <?php foreach($currency as $cur) : ?> 
                                                                                    <option value="<?= $cur->Currency ?>" <?= ($cur->Currency == 'IDR' ? 'selected' : '') ?>><?= $cur->Currency ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </td>
                                                                        <td><input type="number" name="rate[]" class="form-control text-right" min="1" value="1" required></td>
                                                                        <td><input type="number" name="unit[]" class="form-control text-right" required></td>
                                                                        <td><input type="" name="amount[]" class="form-control text-right" readonly></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Content End -->
                                </div>
                                <!-- END PAGE CONTENT INNER -->
                            </div>
                        </div>
                        <!-- END PAGE CONTENT BODY -->
                        <!-- END CONTENT BODY -->
                    </div>
                    <!-- END CONTENT -->

                    <!-- BEGIN QUICK SIDEBAR -->
                    <a href="javascript:;" class="page-quick-sidebar-toggler">
                        <i class="icon-login"></i>
                    </a>
                    <!-- END QUICK SIDEBAR -->
                </div>
                <!-- END CONTAINER -->
            </div>
        </div>
        <script type="text/javascript">
            window.onload = load_function;

            function load_function() {
                document.body.style.zoom = 0.8;
            }
        </script>
        <?php $this->load->view('header_footer/finance_corp/footer'); ?>