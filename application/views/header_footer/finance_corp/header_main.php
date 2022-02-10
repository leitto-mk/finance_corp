<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
<meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for blank page layout" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
    <link href="<?= base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?= base_url(); ?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/dropify-upload/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?= base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- <link href="<?= base_url(); ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?= base_url(); ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?= base_url(); ?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->

    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?= base_url(); ?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/pages/css/invoice.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/pages/css/invoice-2.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS NEW UPDATE-->
    <link rel="shortcut icon" href="" />

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top" style="background-color: white">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <!-- <div class="page-logo">
                        <a href="#">
                            <img src="<?= base_url('assets/layouts/layout/img/abase.png')?>" alt="logo" class="logo-default" style="width: 120px; margin-top: 3px"/> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div> -->
                    <div class="page-logo" style="margin-left: -10px; margin-top: -10px">
                        <a href="#">
                            <h2 class="font-dark bold uppercase">Finance<font color="white">_</font>Accounting</h2></a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <!-- <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">                     
                            <li class="dropdown dropdown-user" style="margin-top: -5px; background-color: #f6f6f6">
                                <a href="#">
                                    <span style="font-family: Oswald,sans-serif;"><font size="5" color="black">&nbsp;&nbsp;Student Finance</font></span>
                                </a>
                            </li>
                        </ul>
                    </div> -->
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <div class="page-sidebar navbar-collapse collapse bg-blue-ebonyclay">
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <li class="nav-head nav-item start" style="margin-top: -20px">
                                <a href="<?php echo site_url('FinanceCorp'); ?>" class="nav-link nav-toggle" style="background-color: #67809fcc">
                                    <i class="icon-share font-white"></i>
                                    <span class="caption-subject font-white uppercase title bold"> Dashboard </span>
                                </a>
                            </li>
                            <li class="nav-head nav-item active">
                                <a href="#" class="nav-link nav-toggle bg-blue-ebonyclay">
                                    <i class="fa fa-edit font-green"></i>
                                    <span class="title uppercase">Entry</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item start">
                                        <a href="<?= site_url('FinanceCorp/view_receipt_voucher') ?>" class="nav-link">
                                            <!-- <i class="icon-bar-chart"></i> -->
                                            <span class="title">&bull;&nbsp;&nbsp;Receipt Voucher</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="<?= site_url('FinanceCorp/view_payment_voucher') ?>" class="nav-link">
                                            <!-- <i class="icon-bar-chart"></i> -->
                                            <span class="title">&bull;&nbsp;&nbsp;Payment Voucher</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="<?= site_url('FinanceCorp/view_overbook_voucher') ?>" class="nav-link">
                                            <!-- <i class="icon-bar-chart"></i> -->
                                            <span class="title">&bull;&nbsp;&nbsp;Overbook Voucher</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="<?= site_url('FinanceCorp/view_general_journal') ?>" class="nav-link">
                                            <!-- <i class="icon-bar-chart"></i> -->
                                            <span class="title">&bull;&nbsp;&nbsp;General Journal</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-head nav-item active">
                                <a href="#" class="nav-link nav-toggle bg-blue-ebonyclay">
                                    <i class="fa fa-edit font-green"></i>
                                    <span class="title uppercase">A / R</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item start">
                                        <a href="#" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;Direct Sales</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="#" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;Sales Detail</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="#" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;Gross Profit</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="#" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;Aging</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-head nav-item">
                                <a href="#" class="nav-link nav-toggle bg-blue-ebonyclay">
                                    <i class="fa fa-edit font-green"></i>
                                    <span class="title uppercase font-white">A / P</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item start">
                                        <a href="#" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;Direct Purchase</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="#" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;Purchase Detail</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="#" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;Aging</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- <li class="nav-head nav-item active">
                                <a href="#" class="nav-link nav-toggle bg-blue-ebonyclay">
                                    <i class="fa fa-edit font-green"></i>
                                    <span class="title uppercase">Account</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item start">
                                        <a href="<?php echo site_url('Acc_pay/index2') ?>" target="_blank" class="nav-link">
                                            <i class="icon-bar-chart"></i>
                                            <span class="title">&bull;&nbsp;&nbsp;Accounts Payable</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="<?php echo site_url('Acc_rec/index2') ?>" target="_blank" class="nav-link">
                                            <i class="icon-bar-chart"></i>
                                            <span class="title">&bull;&nbsp;&nbsp;Accounts Receivable</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                            <li class="nav-head nav-item active">
                                <a href="#" class="nav-link nav-toggle bg-blue-ebonyclay">
                                    <i class="fa fa-edit font-green"></i>
                                    <span class="title uppercase">Inventory</span>
                                </a>
                            </li>
                            <li class="nav-head nav-item active">
                                <a href="#" class="nav-link nav-toggle bg-blue-ebonyclay">
                                    <i class="fa fa-edit font-green"></i>
                                    <span class="title uppercase">Assembly</span>
                                </a>
                            </li>
                            <li class="nav-head nav-item active">
                                <a href="#" class="nav-link nav-toggle bg-blue-ebonyclay">
                                    <i class="fa fa-edit font-green"></i>
                                    <span class="title uppercase">Fixed Asset</span>
                                </a>
                            </li>
                            <li class="nav-head nav-item active">
                                <a href="<?php echo site_url('Cash_adv') ?>" target="_blank" class="nav-link nav-toggle bg-blue-ebonyclay">
                                    <i class="fa fa-edit font-green"></i>
                                    <span class="title uppercase">Cash Advance</span>
                                </a>
                            </li>
                            <li class="nav-head nav-item active">
                                <a href="#" class="nav-link nav-toggle bg-blue-ebonyclay">
                                    <i class="fa fa-edit font-green"></i>
                                    <span class="title uppercase">Employee</span>
                                </a>
                            </li>
                            <li class="nav-head nav-item">
                                <a href="#" class="nav-link nav-toggle bg-blue-ebonyclay">
                                    <i class="fa fa-edit font-green"></i>
                                    <span class="title uppercase font-white">Report</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <!-- <li class="nav-item start">
                                        <a href="<?= site_url('FinanceCorp/view_gl') ?>" target="_blank" class="nav-link">
                                            <i class="icon-bar-chart"></i>
                                            <span class="title">&bull;&nbsp;&nbsp;Generala Ledger All</span>
                                        </a>
                                    </li> -->
                                    <li class="nav-item start">
                                        <a href="<?= site_url('FinanceCorp/view_balance_sheet') ?>" target="_blank" class="nav-link">
                                            <!-- <i class="icon-bar-chart"></i> -->
                                            <span class="title">&bull;&nbsp;&nbsp;Balance Sheet</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="<?= site_url('FinanceCorp/view_income_statement') ?>" target="_blank" class="nav-link">
                                            <!-- <i class="icon-bar-chart"></i> -->
                                            <span class="title">&bull;&nbsp;&nbsp;Income Statement</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="#" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;ES Columnar</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="<?= site_url('FinanceCorp/view_gl_branch') ?>" target="_blank" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;General Ledger</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="#" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;Cash Flow</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start">
                                        <a href="#" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;Journal Transaction</span>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item start">
                                        <a href="<?= site_url('FinanceCorp/view_trial_balance') ?>" target="_blank" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;Trial Balance</span>
                                        </a>
                                    </li> -->
                                    <!-- <li class="nav-item start">
                                        <a href="<?= site_url('FinanceCorp/view_gl_stockcard') ?>" target="_blank" class="nav-link">
                                            <span class="title">&bull;&nbsp;&nbsp;Stockcard</span>
                                        </a>
                                    </li> -->
                                </ul>
                            </li>
                            <li class="nav-head nav-item active">
                                <a href="<?php echo site_url('Cmaster') ?>" target="_blank" class="nav-link nav-toggle bg-blue-ebonyclay">
                                    <i class="fa fa-edit font-green"></i>
                                    <span class="title uppercase">Master</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content" style="background-color: #eef1f5">
                        <div class="page-bar bg-blue-dark" style="margin-bottom: 20px;">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="#" class="font-white uppercase">Preview</a>
                                </li>
                                <li>
                                    <i class="fa fa-circle font-white"></i>
                                    <a href="javascript:;" class="font-white uppercase"><?= $title ?></a>
                                </li>
                            </ul>
                        </div>