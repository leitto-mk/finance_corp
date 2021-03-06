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
    <link href="<?= base_url()?>assets/metronic/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?= base_url() ?>assets/metronic/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?= base_url()?>assets/metronic/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?= base_url()?>assets/metronic/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS NEW UPDATE -->
    <link href="<?= base_url() ?>assets/metronic/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/metronic/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/metronic/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/metronic/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/dropify-upload/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGE LEVEL PLUGINS NEW UPDATE-->
    <!-- BEGIN PAGE LEVEL PLUGINS NEW UPDATE -->
    <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/metronic/global/plugins/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGE LEVEL PLUGINS NEW UPDATE-->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?= base_url() ?>assets/metronic/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/global/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/metronic/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS NEW UPDATE -->
    <link href="<?= base_url() ?>assets/metronic/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/metronic/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/metronic/pages/css/invoice.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/metronic/pages/css/invoice-2.min.css" rel="stylesheet" type="text/css" />
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
                            <img src="<?= base_url('assets/metronic/layouts/layout/img/abase.png')?>" alt="logo" class="logo-default" style="width: 120px; margin-top: 3px"/> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div> -->
                    <div class="page-logo" style="margin-left: -10px; margin-top: -10px">
                        <a href="#">
                            <h2 class="font-dark bold uppercase"><?= $h1; ?><font color="white">_</font><?= $h2; ?><font color="white">_</font><?= $h3; ?><font color="white">_</font><?= $h4; ?></h2>
                        </a>
                    </div>
                    <!-- END LOGO -->
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
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrappers">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content" style="background-color: #eef1f5">
                       