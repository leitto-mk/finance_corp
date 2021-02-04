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
    <style type="text/css" media="screen">
        .loader-wrapper {
          width: 100%;
          height: 100%;
          position: absolute;
          top: 0;
          left: 0;
          background-color: #3B3F51;
          display:flex;
          justify-content: center;
          align-items: center;
          z-index: 51;
        }
        .loader {
          display: inline-block;
          width: 30px;
          height: 30px;
          position: relative;
          border: 4px solid #Fff;
          animation: loader 2s infinite ease;
          z-index: 51;
        }
        .loader-inner {
          vertical-align: top;
          display: inline-block;
          width: 100%;
          background-color: #fff;
          animation: loader-inner 2s infinite ease-in;
          z-index: 51;
        }
        @keyframes loader {
          0% { transform: rotate(0deg);}
          25% { transform: rotate(180deg);}
          50% { transform: rotate(180deg);}
          75% { transform: rotate(360deg);}
          100% { transform: rotate(360deg);}
        }
        @keyframes loader-inner {
          0% { height: 0%;}
          25% { height: 0%;}
          50% { height: 100%;}
          75% { height: 100%;}
          100% { height: 0%;}
        }

        .page-logo img{
            width: 150px; 
            margin-top: 10px!important;
        }

        .page-logo a{
            text-decoration: none!important;
        }

        .page-logo h1{
            font-size: 30px;
        }

        .page-logo-footer img{
            width: 150px; 
            margin-top: 0px!important;
        }

        @media (min-width: 768px){
            .page-logo img{
                margin-left: 40px!important;
            }
            .page-logo-footer img{
                margin-left: 0px!important;
            }
        }
    </style>
    <head>
        <meta charset="utf-8" />
        <title><?=$title?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #4 for boxed page layout" name="description" />
        <meta content="" name="author" />
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/photos/abase-logo.png" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?=base_url('assets')?>/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets')?>/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets')?>/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets')?>/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets')?>/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets')?>/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/mapplic/mapplic/mapplic.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/global/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?=base_url('assets')?>/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url('assets')?>/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?=base_url('assets')?>/global/plugins/ion.rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets')?>/global/plugins/ion.rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets')?>/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets')?>/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets')?>/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets')?>/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('vendor')?>/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?=base_url('assets')?>/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets')?>/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?=base_url('assets')?>/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-boxed" data-status="<?= $status ?> " style="background: #44515d">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top bg-white">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner container">
                <!-- BEGIN LOGO -->
                <div class="page-logo" style="margin-top: 5px">
                    <!-- <h3 class="font-white bold uppercase">Teacher<font color="#3b3f51">_</font>Staff<font color="#3b3f51">_</font>Portal</h3> -->
                    <h3 class="font-grey-mint bold uppercase">Teacher<font color="white">_</font>Staff<font color="white">_</font>Portal</h3>
                    <h4 class="font-grey-mint sbold uppercase"></h4>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="#" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                   <!--  <div class="search-form search-form-expanded">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" placeholder="Search..." name="search_item" id="search_item">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                        </div>
                    </div> -->
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <li class="separator hide"> </li>
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                            <li class="dropdown dropdown-dark dropdown-inbox dropdown-extended dropdown-hoverable" id="header_notification_bar">
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-bell"></i>
                                    <span class="badge bg-yellow-casablanca total-cart"> 0 </span>
                                </a>
                            </li>
                            <li class="separator hide"> </li>
                            <li class="dropdown dropdown-dark" id="header_notification_bar">
                                <a href="<?php echo site_url('Teacher/home'); ?>" class="dropdown-toggle">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <!-- END NOTIFICATION DROPDOWN -->
                            <li class="separator hide"> </li>
                            
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username font-blue-oelo uppercase"> 
                                        <span class="username username-hide-on-mobile"> <?= "$fname" ?> </span>
                                    </span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    <?php if ($this->session->userdata('status') == 'admin') : ?>
                                    <img src="<?= base_url() ?>assets/photos/adm/<?= $photo ?>" alt="">
                                    <?php elseif ($this->session->userdata('status') == 'teacher') : ?>
                                        <img src="<?= base_url() ?>assets/photos/teachers/<?= $photo ?>" alt="">
                                    <?php elseif ($this->session->userdata('status') == 'student') : ?>
                                        <img src="<?= base_url() ?>assets/photos/student/<?= $photo ?>" alt="">
                                    <?php elseif ($this->session->userdata('status') == 'staff') : ?>
                                        <img src="<?= base_url() ?>assets/photos/staff/<?= $photo ?>" alt="">
                                    <?php endif; ?> 
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                   <!--  <li>
                                        <a href="#">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li class="divider"> </li> -->
                                    <li>
                                        <a href="<?= base_url('Auth/logout') ?>">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
