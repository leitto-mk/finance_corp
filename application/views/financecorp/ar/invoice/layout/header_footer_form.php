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
  <!-- <link href="<?= base_url() ?>assets/metronic/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" /> -->
  <!-- <link href="<?= base_url() ?>assets/metronic/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
  <!-- END GLOBAL MANDATORY STYLES -->
  <link href="<?= base_url() ?>assets/metronic/pages/css/invoice-2.min.css" rel="stylesheet" type="text/css" />
  <!-- BEGIN THEME LAYOUT STYLES -->
  <link href="<?= base_url() ?>assets/metronic/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/metronic/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
  <link href="<?= base_url() ?>assets/metronic/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
  <!-- END THEME LAYOUT STYLES -->
  <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
  <!-- BEGIN CONTAINER -->
  <div class="page-container" style="margin-top: 0">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <div class="page-content" style="margin-left: 0;">
        <?= $form ?>
      </div>
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
  <!-- END CORE PLUGINS -->
  <!-- BEGIN THEME GLOBAL SCRIPTS -->
  <script src="<?= base_url() ?>assets/metronic/global/plugins/moment.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
  <script src="<?= base_url();?>assets/metronic/global/plugins/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
  <script src="<?= base_url();?>assets/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
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