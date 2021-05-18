<?php $this->load->view('finance/header_sub_modul_sf_no_trees'); ?>
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
                                    <h4 style="color:#ffffff">Student Receipt Voucher</h4>
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
                <div class="page-container" style="margin: auto;">
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <div class="container-fluid">
                            <!-- BEGIN PAGE CONTENT INNER -->
                            <div class="page-content-inner">
                                <!-- Content Start -->
                                <form method="POST" class="form-horizontal" id="form_entry_payment" autocomplete="off">
                                    <div class="row" style="margin-top: 25px">
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
                                                            <a class="btn yellow" id="btn_new">
                                                                <i class="fa fa-plus"></i> New
                                                            </a>
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
                                                                            <input type="text" id="docno" name="docno" class="form-control" value="" style="background-color:white;" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Row 2 -->
                                                                    <label class="col-md-2 control-label"><b>Account No.</b></label>
                                                                    <div class="col-md-3" data-toggle="modal" data-target="#modal_caccount">
                                                                        <select name="accno" id="accno" class="form-control" required>
                                                                            <option value="">--Select--</option>
                                                                            <?php foreach($accno as $accno) : ?>
                                                                                <option value="<?= $accno->Acc_No ?>"><?= $accno->Acc_No ?> | <?= $accno->Acc_Name ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    &nbsp;&nbsp;&nbsp;<span class="help-inline" id="m_accdesc"><b></b></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label"><b>Transaction Date</b></label>
                                                                    <div class="col-md-3">
                                                                        <input type="date" id="transdate" name="transdate" class="form-control" readonly value="<?php echo date('Y-m-d') ?>" required>
                                                                    </div>
                                                                    <label class="col-md-2 control-label"><b>Degree</b></label>
                                                                    <div class="col-md-3" data-toggle="modal" data-target="#modal_branch">
                                                                        <input type="text" id="school" name="school" class="form-control readonly" readonly required style="background-color:white;">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label"><font color="red" size="2">*</font> <b>Student NIS</b></label>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" id="nis" name="nis" readonly required>
                                                                        <!-- <span class="input-group-btn">
                                                                                <button class="btn btn-primary" type="button" data-target="#insert_paid" data-toggle="modal"><i class="fa fa-plus"></i> Add</button>
                                                                            </span> -->
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label"><b>Remarks</b></label>
                                                                    <div class="col-md-10">
                                                                        <textarea id="remarks" name="remarks" cols="30" rows="1" class="form-control" style="resize:none;" placeholder="Add remarks to your transaction..." value="-"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-xs-12 col-sm-12" style="padding: 0px">
                                                        <div class="portlet light" style="border-style: solid; border-color: lightgrey;">
                                                            <div class="portlet-body">
                                                                <div class="mt-step-desc">
                                                                    <div class="font-dark bold uppercase">School Balance</div>
                                                                    <br>
                                                                </div>
                                                                <div class="row static-info">
                                                                    <!-- <div class="col-md-2 name" style="font-size:20px;"> Rp. </div> -->
                                                                    <div class="col-md-12 value" style="margin-top: -15px">
                                                                        <b><input type="text" id="balance" name="balance" data-non-format="" value="0" readonly="true" class="input-group input-group-sm form-control" style="text-align:right; background: #E9EDEF; font-size: 25px; border:none;"></b>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="portlet light" style="border-style: solid; border-color: lightgrey; margin-top: -25px">
                                                            <div class="portlet-body">
                                                                <div class="mt-step-desc">
                                                                    <div class="font-dark bold uppercase">Total Amount</div>
                                                                    <br>
                                                                </div>
                                                                <div class="row static-info">
                                                                    <!-- <div class="col-md-2 name" style="font-size:20px;"> Rp. </div> -->
                                                                    <div class="col-md-12 value" style="margin-top: -15px">
                                                                        <b><input type="text" id="totalamount" name="totalamount" data-non-format="0" value="Rp. 0" readonly="true" class="input-group input-group-sm form-control" style="text-align:right; background: #E9EDEF; font-size: 25px; border:none;"></b>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                        <table class="table table-striped table-hover" id="table_detail_transaction">
                                                            <thead>
                                                                <tr style="background-color: #22313F" class="font-white">
                                                                    <th class="text-center"> Action </th>
                                                                    <th class="text-center"> Remarks Detail </th>
                                                                    <th class="text-right"> Year </th>
                                                                    <th class="text-right"> Month </th>
                                                                    <th class="text-right"> Group Charge </th>
                                                                    <th class="text-center"> Currency </th>
                                                                    <th class="text-right"> Exchange Rate </th>
                                                                    <th class="text-right"> Amount </th>
                                                                    <th class="text-right"> Total </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="table_body_detail_transaction">
                                                                <tr style="background-color: #E9EDEF" hidden>
                                                                    <td>
                                                                        <a class="btn btn-transparent red btn-md remove_detail_row">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                    <td><input type="text" name="remark_detail[]" class="form-control"></td>
                                                                    <td>
                                                                        <input type="text" name="year[]" class="form-control">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="month[]" class="form-control">
                                                                    </td>
                                                                    <td><input type="text" name="group_charge[]" class="form-control text-right" required></td>
                                                                    <td>
                                                                        <select id="currency" name="currency[]" class="form-control" required>
                                                                            <?php foreach($currency as $cur) : ?> 
                                                                                <option value="<?= $cur->Currency ?>" <?= ($cur->Currency == 'IDR' ? 'selected' : '') ?>><?= $cur->Currency ?> | <?= $cur->CurrencyName ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="number" name="rate[]" class="form-control" value="1"></td>
                                                                    <td><input type="number" name="unit[]" class="form-control"></td>
                                                                    <td><input type="number" name="amount[]" class="form-control"></td>
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
        <?php $this->load->view('finance/footer_sub_modul'); ?>