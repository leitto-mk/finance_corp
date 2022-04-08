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
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
  <link href="<?= base_url() ?>assets/metronic/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN THEME GLOBAL STYLES -->
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
  <!-- END THEME GLOBAL STYLES -->
  <!-- BEGIN PAGE LEVE STYLES -->
  <link href="<?= base_url() ?>assets/metronic/pages/css/invoice-2.min.css" rel="stylesheet" type="text/css" />
  <!-- END PAGE LEVEL STYLES -->
  <!-- BEGIN THEME LAYOUT STYLES -->
  <link href="<?= base_url() ?>assets/metronic/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
  <link href="<?= base_url() ?>assets/metronic/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
  <!-- END THEME LAYOUT STYLES -->
  <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
  <!-- BEGIN HEADER -->
  <div class="page-header navbar navbar-fixed-top bg-white">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
      <!-- BEGIN LOGO -->
      <!-- <div class="page-logo bg-white" style="padding-left:0px;">
        <a href="#">
          <img src="<?= base_url('assets/abasewhite.png') ?>" alt="logo" class="logo-default" style="margin: 10px; width:175px;" />
        </a>
        <div class="menu-toggler sidebar-toggler hide">
        </div>
      </div> -->
      <div class="page-logo bg-white" style="margin-left: -10px; margin-top: 0px">
          <a href="#">
              <h2 class="font-dark bold uppercase">Invoice<font color="white">_</font>Management</h2></a>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN RESPONSIVE MENU TOGGLER -->
      <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
      <!-- END RESPONSIVE MENU TOGGLER -->
      <!-- BEGIN PAGE ACTIONS -->
      <!-- BEGIN PAGE TOP -->
      <div class="page-top">
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
          <ul class="nav navbar-nav pull-right">
            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            <li class="dropdown dropdown-user">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img alt="" class="img-circle" src="<?= base_url() ?>assets/metronic/layouts/layout2/img/avatar3_small.jpg" />
                <span class="username username-hide-on-mobile"> <?= $this->session->userdata('uname'); ?> </span>
                <i class="fa fa-angle-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-default">
                <li>
                  <a href="#">
                    <i class="icon-user"></i> My Profile </a>
                </li>
                <li>
                  <a href="#" id="btn-logout" class="btn-logout">
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
  <!-- BEGIN HEADER & CONTENT DIVIDER -->
  <div class="clearfix"> </div>
  <!-- END HEADER & CONTENT DIVIDER -->
  <!-- BEGIN CONTAINER -->
  <div class="page-container">
    <?php if (isset($no_sidebar)) : ?>
    <?php else : ?>
      <!-- BEGIN SIDEBAR -->
      <div class="page-sidebar-wrapper">
        <!-- END SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
          <!-- BEGIN SIDEBAR MENU -->
          <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
          <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
          <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
          <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
          <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
          <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
          <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-compact " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <?php $this->load->view('financecorp/ar/invoice/layout/sidebar') ?>
          </ul>
          <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
      </div>
      <!-- END SIDEBAR -->
    <?php endif; ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <?php if (isset($no_sidebar)) : ?>
        <div class="page-content" style="margin-left: 0;">
          <?= $content ?? null ?>
        </div>
      <?php else : ?>
        <div class="page-content">
          <?= $content ?? null ?>
        </div>
      <?php endif; ?>
      <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
  </div>
  <!-- END CONTAINER -->
  <!-- BEGIN FOOTER -->
  <div class="page-footer">
    <div class="page-footer-inner">
      <a href="#" target="_blank" class="font-white"><?= date('Y') ?> &copy; ABase</a> &nbsp;|&nbsp;
      <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
      </div>
    </div>
  </div>
  <!-- END FOOTER -->
  <!--[if lt IE 9]>
<script src="<?= base_url() ?>assets/metronic/global/plugins/respond.min.js"></script>
<script src="<?= base_url() ?>assets/metronic/global/plugins/excanvas.min.js"></script> 
<script src="<?= base_url() ?>assets/metronic/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
  <!-- BEGIN CORE PLUGINS -->
  <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/js.cookie.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/moment.min.js" type="text/javascript"></script>
  <!-- END CORE PLUGINS -->
  <!-- BEGIN THEME GLOBAL SCRIPTS -->
  <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/ladda/spin.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/ladda/ladda.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/scripts/app.min.js" type="text/javascript"></script>
  <!-- END THEME GLOBAL SCRIPTS -->
  <!-- BEGIN THEME LAYOUT SCRIPTS -->
  <script src="<?= base_url() ?>assets/metronic/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/pages/scripts/form-input-mask.min.js" type="text/javascript"></script>
  <!-- END THEME LAYOUT SCRIPTS -->
  <?php if(isset($script) && $script !== '') : ?>
    <script id="script" type="module" data-base-url="<?= base_url() ?>" data-csrf-name="<?= $this->security->get_csrf_token_name() ?>" data-csrf-token="<?= $this->security->get_csrf_hash() ?>" data-load-module="<?= $script ?>" src="<?= base_url("js/main.js") ?>"></script>
  <?php endif; ?>  
</body>

</html>