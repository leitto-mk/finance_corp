<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title><?php echo $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dropify-upload/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- <link href="<?php echo base_url(); ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo base_url(); ?>assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?php echo base_url(); ?>assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo" style="background: #000000;">
                <a href="#" class="logo-default" style="margin-top: 20px; margin-left: 5px ">
                    <font color="white" size="4"><center><i class="fa fa-male"></i>&nbsp;&nbsp;<?php echo $headertitle; ?> </center></font>
                </a>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN PAGE TOP -->
            <div class="page-top">
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="page-actions">
                    <?php foreach ($personal as $pers){ ?>
                        <h3 class="bold" style="margin-top: 3px"><?php echo $pers->IDNumber ?> - <?php echo $pers->FirstName ?> <?php echo $pers->LastName ?></h3>
                    <?php } ?>
                </div>
                <!-- <ul class="nav navbar-nav pull-right bg-default" style="margin-top: 0px">                     
                    <li class="dropdown dropdown-user">
                        <a data-target="#modal-change-password" data-toggle="modal">
                            <span class="username username-hide-on-mobile"><h4 class="bold font-dark"><i class="icon-lock"></i>Change Password</h4></span>
                        </a>
                    </li>
                </ul> -->
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <div id="modal-change-password" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-login-label" class="modal-title">Please Insert New Password</h4></div>
                <div class="modal-body" style="margin-bottom: 5%">
                    <div class="form">
                        <?php echo form_open('Login/change_pass', 'role="form"')?>
                        <form class="form-horizontal">
                            <div class="form-group"><label style="padding-top: 15px" for="password" class="control-label col-md-3">Old Pass</label>
                                <div class="col-md-9"><input id="ioldpass" name="ioldpass" type="password" class="form-control" required/></div>
                            </div>
                            <div class="form-group" style="padding-top: 8%"><label style="padding-top: 15px" for="password" class="control-label col-md-3">New Pass</label>
                                <div class="col-md-9"><input id="inewpass" name="inewpass" type="password" class="form-control" required/></div>
                            </div>
                            <div class="form-group" style="padding-top: 5%"><label style="padding-top: 15px" for="password" class="control-label col-md-3">Confirm Pass</label>
                                <div class="col-md-9"><input id="iconfirmpass" name="iconfirmpass" type="password" class="form-control" required/></div>
                            </div>
                            <div class="form-group" style="padding-top: 5%">
                                <div class="col-md-9 col-md-offset-3" align="right">
                                    <input type="submit" name="submit" value="Change" class="btn btn-primary"/>
                                </div>
                            </div>
                        </form>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->