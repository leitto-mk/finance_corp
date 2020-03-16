<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?= base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/CUSTOM-PLUGINS/jquery-ui-1.12.1.custom/jquery-ui.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/mapplic/js/hammer.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/mapplic/js/jquery.easing.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/mapplic/js/jquery.mousewheel.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/mapplic/mapplic/mapplic.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?= base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= base_url(); ?>assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?= base_url(); ?>assets/layouts/layout7/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/pages/scripts/portfolio-1.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- CUSTOM SCRIPTS -->
<script type="text/javascript" src="<?= base_url(); ?>assets/CUSTOMS/student_profile.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/CUSTOMS/teacher_profile.js"></script>

<script>
    var base_url = '<?= base_url() ?>'
    var id = '<?= $id; ?>'
    var fullname = '<?= "$fname $lname" ?>'

    //FROM TEACHER CONTROLLER
    var cur_sem = '<?= $semester ?>'
    var cur_per = '<?= $schyear ?>'
    var homeroom = '<?= $homeroom ?>'

    console.log(`${id} - ${fullname} - ${cur_sem} - ${cur_per} - ${homeroom}`)
</script>

</body>

</html>