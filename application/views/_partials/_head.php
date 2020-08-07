<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title><?= $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #5 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/photos/abase-logo.png" />
    <!-- BEGIN LAYOUT FIRST STYLES -->
    <!-- <link href="//fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" /> -->
    <!-- END LAYOUT FIRST STYLES -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="<?= base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?= base_url() ?>assets/global/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel=" stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/jquery-ui-1.12.1.custom/jquery-ui.structure.min.css" rel=" stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/jquery-ui-1.12.1.custom/jquery-ui.theme.min.css" rel=" stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?= base_url(); ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/pages/css/about.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?= base_url() ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?= base_url() ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?= base_url() ?>assets/layouts/layout5/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/layouts/layout5/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <!-- <link rel="shortcut icon" href="<?= base_url('assets/photos/favicon.ico') ?>" /> -->

    <!-- CUSTOM -->
    <link href="<?= base_url(); ?>assets/CUSTOM-PLUGINS/daterangepicker-master/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOMS/academy.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/jqueryui-editable-1.5.1/css/jqueryui-editable.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <!-- <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/interactive-toggle/dist/jquery.btnswitch.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <style>
        @media only screen and (max-width: 1366px) {
            .container-fluid>.page-content {
                min-height: 820px;
            }
        }
    </style> -->
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo">

    <!-- LOAD MODAL LOGGED OUT-->
    <div class="modal fade" id="logout" tabindex="-1" role="basic" aria-hidden="true" style="display: none; padding-right: 17px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="mt-element-ribbon bg-grey-steel">
                    <div class="ribbon ribbon-round ribbon-border-dash ribbon-color-danger uppercase">Ribbon Border</div>
                    <p class="ribbon-content">Goodbye, see You soon</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Bye...</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- LOAD MODAL LOGGED OUT-->

    <!-- BEGIN CONTAINER -->
    <div class="wrapper">
        <!-- BEGIN HEADER -->
        <header class="page-header">
            <nav class="navbar mega-menu" role="navigation">
                <div class="container-fluid">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="toggle-icon">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </span>
                    </button>
                    <div class="clearfix navbar-fixed-top">
                        <!-- BEGIN LOGO -->
                        <a id="index" class="page-logo" href="<?= base_url($status) . '/index'; ?>" style="text-decoration: none;">
                            <!-- <img src="<?= base_url() ?>assets/pages/media/email/logo.png" alt="Logo" style="width: 10%"> -->
                            <h4 class="uppercase" style="color: #fff;"> School Information System </h4>
                        </a>
                        <!-- END LOGO -->
                        <!-- BEGIN TOPBAR ACTIONS -->
                        <div class="topbar-actions">
                            <!-- BEGIN USER PROFILE -->
                            <div class="btn-group-img btn-group">
                                <button type="button" class="btn btn-sm md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="border-style: solid; border-width: 1px; border-color: #f1f4f7">
                                    <span style="padding-left: 5px">Hi, <?= $fname . " " . $lname; ?></span>
                                    <?php if ($this->session->userdata('status') == 'admin') : ?>
                                        <img src="<?= base_url() ?>assets/photos/adm/<?= $photo ?>" alt="" style="padding: 3px"> </button>
                            <?php elseif ($this->session->userdata('status') == 'teacher') : ?>
                                <img src="<?= base_url() ?>assets/photos/teachers/<?= $photo ?>" alt="" style="padding: 3px"> </button>
                            <?php elseif ($this->session->userdata('status') == 'student') : ?>
                                <img src="<?= base_url() ?>assets/photos/student/<?= $photo ?>" alt="" style="padding: 3px"> </button>
                            <?php else : ?>
                                <img src="<?= base_url() ?>assets/photos/staff/<?= $photo ?>" alt="" style="padding: 3px"> </button>
                            <?php endif; ?>
                            <ul class="dropdown-menu-v2" role="menu">
                                <li>
                                    <?php if ($status == 'admin') : ?>
                                        <a href="<?= base_url($status) . '/load_prof_adm'; ?>">
                                        <?php else : ?>
                                            <a href="<?= base_url($status) . '/load_profile'; ?>">
                                            <?php endif; ?>
                                            <i class="icon-user"></i> My Profile
                                            <!-- <span class="badge badge-danger">
                                                1
                                            </span> -->
                                            </a>
                                </li>
                                <li>
                                    <?php if ($status == 'admin') : ?>
                                        <a href="<?= base_url() . 'admin/load_prof_adm#tab_3'; ?>">
                                        <?php else : ?>
                                            <a href="<?= base_url() . '/load_profile#tab_3'; ?>">
                                            <?php endif; ?>
                                            <i class="icon-eye"></i> Change Password </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="<?= base_url('Auth/logout') ?>">
                                        <i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                            </div>
                            <!-- END USER PROFILE -->
                        </div>
                        <!-- END TOPBAR ACTIONS -->
                    </div>