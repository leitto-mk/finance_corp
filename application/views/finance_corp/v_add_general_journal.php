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
                                    <form method="post" class="form-horizontal" id="form_entry_payment" autocomplete="off">
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
                                                                                <input type="text" name="m_docno" class="form-control" readonly value="" style="background-color:white;">
                                                                            </div>
                                                                        </div>
                                                                        <!-- Row 2 -->
                                                                        <label class="col-md-2 control-label"><b>Branch</b></label>
                                                                        <div class="col-md-3" data-toggle="modal" data-target="#modal_branch">
                                                                            <input type="text" id="m_branch" name="m_branch" class="form-control readonly" placeholder="Search.." id="m_branch" style="background-color:white;" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Transaction Date</b></label>
                                                                        <div class="col-md-3">
                                                                            <input type="date" id="m_transdate" name="m_transdate" class="form-control" value="<?php echo date('Y-m-d') ?>" required>
                                                                        </div>
                                                                        <label class="col-md-2 control-label"><b>Paid To</b></label>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control" id="m_emp" name="m_emp" placeholder="Search for...">
                                                                                <span class="input-group-btn">
                                                                                    <button class="btn btn-primary" type="button" id="paid_branch" data-target="#insert_paid" data-toggle="modal"><i class="fa fa-plus"></i> Add</button>
                                                                                </span>
                                                                            </div>
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
                                                                                <a class="btn yellow btn-sm" id="btn_new">
                                                                                    <i class="fa fa-plus"></i> New
                                                                                </a>
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
                                                                        <th width="4%"></th>
                                                                        <th width="21%" class="text-center"> Remarks Detail </th>
                                                                        <th width="10%" class="text-center"> Department </th>
                                                                        <th width="10%" class="text-center"> Cost Center </th>
                                                                        <!-- <th width="7%" class="text-center"> Student </th> -->
                                                                        <th width="15%" class="text-center"> Account No. </th>
                                                                        <th width="5%" class="text-center"> Currency </th>
                                                                        <th width="17%" class="text-center"> Debit </th>
                                                                        <th width="18%" class="text-center"> Credit </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="table_body_detail_transaction">
                                                                    <tr style="background-color: #E9EDEF">
                                                                        <td><input type="button" name="" class="btn btn-primary" value="1"></td>
                                                                        <td><input type="" name="" class="form-control"></td>
                                                                        <td><input type="" name="" class="form-control"></td>
                                                                        <td><input type="" name="" class="form-control"><span class="input-group-btn" type="button"></span></td>
                                                                        <td><input type="" name="" class="form-control"></td>
                                                                        <td><input type="" name="" class="form-control"></td>
                                                                        <td><input type="number" name="" class="form-control"></td>
                                                                        <td><input type="number" name="" class="form-control"></td>
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