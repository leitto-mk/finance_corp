<?php $this->load->view('finance/charge_header'); ?>

<body class="page-container-bg-solid">
    <div class="page-wrapper">
        <div class="page-wrapper-row">
            <div class="page-wrapper-top">
                <!-- BEGIN HEADER MENU -->
                <div class="page-header-menu" style="background:#444d58;">
                    <div class="container-fluid">
                        <div class="hor-menu  ">
                            <ul class="nav navbar-nav">
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">
                                    <h4 style="color:#ffffff">STUDENT CHARGES</h4>
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
                        <!-- BEGIN CONTENT BODY -->
                        <!-- BEGIN PAGE CONTENT BODY -->
                        <div class="page-content">
                            <div class="container-fluid" style="padding-bottom:30px;">
                                <!-- BEGIN PAGE CONTENT INNER -->
                                <div class="page-content-inner">
                                    <!-- Content Start -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light" style="height: 475px">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-edit"></i> Master Transaction </span>
                                                    </div>
                                                    <div class="actions">
                                                        <div class="btn-group btn-group-devided">
                                                            <button id="submit_charge" class="btn btn-transparent green btn-sm" type="submit">
                                                                <i class="fa fa-check"></i> Submit
                                                            </button>
                                                            <button id="btn_new" type="button" class="btn yellow">
                                                                <i class="fa fa-plus"></i> New
                                                            </button>
                                                            <a class="btn blue-madison btn-sm" id="tools_print_exprt">
                                                                <i class="fa fa-print"></i> Print
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form method="post" class="form-horizontal" id="form_master_charge">
                                                    <div class="row">
                                                        <div class="col-lg-9 col-xs-12 col-sm-12 bg-grey-salsa">
                                                            <div class="portlet-body form-horizontal">
                                                                <div class="form-body" style="margin-top: 30px">
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Document No.</b></label>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                    #
                                                                                </span>
                                                                                <input type="text" id="docno" name="docno" class="form-control" readonly style="background-color:white;" value="<?= $docno ?>"/>
                                                                            </div>
                                                                        </div>
                                                                        <label class="col-md-2 control-label bold">
                                                                            <font color="red" size="2">*</font> Submit By
                                                                        </label>
                                                                        <div class="col-md-4">
                                                                            <input id="submitby" name="submitby" type="text" value="<?= $user ?>" class="form-control" readonly required>
                                                                        </div>

                                                                    </div>
                                                                    <div class="form-group">

                                                                        <label class="col-md-2 control-label bold">
                                                                            <font color="red" size="2">*</font> Year
                                                                        </label>
                                                                        <div class="col-md-3">
                                                                            <select id="year" name="year" class="form-control" required>
                                                                                <?php for($y = 2020; $y <= date('Y'); $y++) : ?>
                                                                                    <option value="<?= $y?>" <?= ($y == date('Y') ? 'selected' : '')?>><?= $y ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <label class="col-md-2 control-label"><b>Transaction Date</b></label>
                                                                        <div class="col-md-4">
                                                                            <input type="date" id="transdate" name="transdate" class="form-control" value="<?php echo date('Y-m-d') ?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Month Start</b></label>
                                                                        <div class="col-md-3">
                                                                            <select id="monthstart" name="monthstart" class="form-control" required>
                                                                                <option value="1" selected>Jan</option>
                                                                                <option value="2">Feb</option>
                                                                                <option value="3">Mar</option>
                                                                                <option value="4">Apr</option>
                                                                                <option value="5">May</option>
                                                                                <option value="6">Jun</option>
                                                                                <option value="7">Jul</option>
                                                                                <option value="8">Aug</option>
                                                                                <option value="9">Sep</option>
                                                                                <option value="10">Oct</option>
                                                                                <option value="11">Nov</option>
                                                                                <option value="12">Dec</option>
                                                                            </select> </div>
                                                                        <label class="col-md-2 control-label"><b>Account No.</b></label>
                                                                        <div class="col-md-2">
                                                                            <select name="accno" id="accno" class="form-control" required>
                                                                                <option value="">--Select--</option>
                                                                                <?php foreach($accno as $accno) : ?>
                                                                                    <option value="<?= $accno->Acc_No ?>"><?= $accno->Acc_No?> | <?= $accno->Acc_Name ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Month Finish</b></label>
                                                                        <div class="col-md-3">
                                                                            <select id="monthfinish" name="monthfinish" class="form-control" required>
                                                                                <option value="1" selected>Jan</option>
                                                                                <option value="2">Feb</option>
                                                                                <option value="3">Mar</option>
                                                                                <option value="4">Apr</option>
                                                                                <option value="5">May</option>
                                                                                <option value="6">Jun</option>
                                                                                <option value="7">Jul</option>
                                                                                <option value="8">Aug</option>
                                                                                <option value="9">Sep</option>
                                                                                <option value="10">Oct</option>
                                                                                <option value="11">Nov</option>
                                                                                <option value="12">Dec</option>
                                                                            </select> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-4">
                                                                <div class="portlet light" style="border-style: solid; border-color: lightgrey;">
                                                                    <div class="portlet-body">
                                                                        
                                                                        <div class="row static-info">
                                                                            <div class="col-md-2 name" style="font-size:20px;"> Rp. </div>
                                                                            <div class="col-md-10 value">
                                                                                <b><input style="text-align:right; background:white; font-size: 25px; border:none;" type="text" id="totalamount" name="totalamount" readonly="true" class="input-group input-group-sm form-control"></b>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            <div class="col-md-12" style="margin-top: 18px">
                                                                <div class="portlet light" style="border-style: solid; border-color: lightgrey;">
                                                                    <div class="portlet-body">
                                                                        <textarea id="remarks" name="remarks" cols="30" rows="3" class="form-control" style="resize:none;" placeholder="Add remarks to your transaction..."></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-xs-12 col-sm-12">
                                                            <div class="portlet light bg-grey-salsa">
                                                                <div class="portlet-title">
                                                                    <div class="caption font-dark">
                                                                        <i class="icon-settings font-dark"></i>
                                                                        <span class="caption-subject sbold uppercase">Parameter <span style="color: red">*</span></span>
                                                                    </div>
                                                                </div>
                                                                <div id="parameter" class="row">
                                                                    <div class="col-md-12 form-horizontal">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <select name="chargetype" id="chargetype" class="form-control" required>
                                                                                    <option value="">--Select--</option>
                                                                                    <?php foreach($chargetype as $chargetype) : ?>
                                                                                        <option value="<?= $chargetype->Acc_No ?>"><?= $chargetype->Acc_No?> | <?= $chargetype->Acc_Name ?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>          
                                                                            </div>
                                                                        </div> 
                                                                        <hr>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label bold">School</label>
                                                                            <div class="col-md-9">
                                                                                <select name="school" id="school" class="form-control" required>
                                                                                    <option value="">--Select--</option>
                                                                                    <?php foreach($school as $sch) : ?>
                                                                                        <option value="<?= $sch->School_Desc ?>"><?= $sch->SchoolName ?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label bold">Class</label>
                                                                            <div class="col-md-9">
                                                                                <select name="cls" id="cls" class="form-control" disabled>
                                                                                    <option value="">--Select--</option>
                                                                                </select>         
                                                                            </div>
                                                                        </div> 
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label bold">Room</label>
                                                                            <div class="col-md-9">
                                                                                <select name="room" id="room" class="form-control" disabled>
                                                                                    <option value="">--Select--</option>
                                                                                </select>         
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label bold">Student</label>
                                                                            <div class="col-md-9">
                                                                                <select name="std" id="std" class="form-control selectpicker" multiple data-actions-box="true" data-multiple-separator="|" required>
                                                                                </select>     
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                    <div class="col-md-12 form-actions">
                                                                        <button id="submit_parameter" class="btn bg-dark font-white" style="float: right">Preview</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <form method="POST" class="form-horizontal" id="form_details_charge">
                                            <div class="col-md-12">
                                                <div class="portlet bordered light bg-blue-dark">
                                                    <div class="portlet-body">
                                                        <div class="portlet" style="margin-bottom: 5px;">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <span class="caption-subject font-white"><i class="icon-user"></i> List Student Charge </span>
                                                                </div>
                                                                <div class="actions btn-action-filter">
                                                                    <input type="text" id="totalamount" name="totalamount" value="0" readonly="true" class="input-group input-group-sm form-control sbold text-right">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr class="font-white">
                                                                    <th class="text-center" width="1%"> No </th>
                                                                    <th class="text-center" width="5%"> Year </th>
                                                                    <th class="text-center" width="5%"> Month </th>
                                                                    <th class="text-center" width="5%"> NIS </th>
                                                                    <th class="text-center" width="15%"> Full Name </th>
                                                                    <th class="text-center" width="5%"> Room </th>
                                                                    <th class="text-center" width="5%"> Account Code </th>
                                                                    <th class="text-center" width="10%"> Amount </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody_charge">
                                                                <tr>
                                                                    <td class="text-center font-white uppercase" colspan="8">Select Student to Approve Transaction </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Content End -->
                                </div>
                                <!-- END PAGE CONTENT INNER -->
                            </div>
                        </div>
                        <!-- END PAGE CONTENT BODY -->
                        <!-- END CONTENT BODY -->
                    </div>
                    <!-- END CONTENT -->
                </div>
                <!-- END CONTAINER -->
            </div>
        </div>
        <?php $this->load->view('finance/charge_footer'); ?>