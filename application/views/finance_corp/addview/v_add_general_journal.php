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
                                    <h4 style="color:#ffffff">General Journal</h4>
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
                                    <form method="post" class="form-horizontal" id="form_general_journal" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="portlet light" style="height: 200px">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-edit"></i> Master Transaction </span>
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
                                                                                    <!-- <i class="fa fa-envelope"></i> -->
                                                                                </span>
                                                                                <input type="text" name="docno" class="form-control" readonly value="<?= $docno ?>" style="background-color:white;">
                                                                            </div>
                                                                        </div>
                                                                        <!-- Row 2 -->
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
                                                                        <label class="col-md-2 control-label"><b>Transaction Date</b></label>
                                                                        <div class="col-md-3">
                                                                            <input type="date" id="transdate" name="transdate" class="form-control" required>
                                                                        </div>
                                                                        <label class="col-md-2 control-label"><b>Paid To</b></label>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control" id="paidto" name="paidto" placeholder="Search for...">
                                                                                <span class="input-group-btn">
                                                                                    <button class="btn btn-primary" type="button" id="paid_branch" data-target="#insert_paid" data-toggle="modal"><i class="fa fa-plus"></i> Add</button>
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
                                                                        <div class="font-dark bold uppercase">Actions</div>
                                                                    </div>
                                                                    <div class="portlet-title text-center" style="margin-top: 27px">
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
                                                        <div class="portlet" style="margin-bottom: 5px;">
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
                                                                        <th class="text-center"> Debit </th>
                                                                        <th class="text-center"> Credit </th>
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
                                                                                    <option value="<?= $accno[$i]['Acc_No'] ?>"><?= $accno[$i]['Acc_No'] ?> | <?= $accno[$i]['Acc_Name'] ?> - [<?= $accno[$i]['Acc_Type'] ?>]</option>
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
                                                                        <td><input type="number" name="debit[]" class="form-control" min="0" value="0" required></td>
                                                                        <td><input type="number" name="credit[]" class="form-control" min="0" value="0" required></td>
                                                                    </tr>
                                                                </tbody>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-right sbold uppercase" colspan="6" style="padding-top: 15px">Total</td>
                                                                        <td><input type="number" id="total_debit" name="total_debit" class="form-control" value="0" readonly></td>
                                                                        <td><input type="number" id="total_credit" name="total_credit" class="form-control" value="0" readonly></td>
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