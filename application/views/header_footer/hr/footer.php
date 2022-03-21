 <!-- BEGIN FOOTER -->
 <div class="page-footer">
    <div class="page-footer-inner"> 2020 &copy; ABase |
        <a href="<?php echo site_url('HumanResource/view_home'); ?>" target="_blank">Home Shortcut</a>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
        <!-- [if lt IE 9]>
        <script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
        <script src="<?php echo base_url(); ?>assets/global/plugins/ie8.fix.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>        
        <script src="<?php echo base_url(); ?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-table/bootstrap-table.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-fixedheader.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/dropify-upload/js/dropify.js" type="text/javascript"></script>        
        <script src="<?php echo base_url(); ?>assets/toastr/js/toastr.min.js" type="text/javascript"></script>        
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- EX ASSETS IMP -->
        <!-- Clave Input Format -->
        <script src="<?php echo base_url(); ?>assets/clave/dist/cleave.min.js" type="text/javascript"></script>
         <!-- FusionCharts -->
         <script src="<?php echo base_url(); ?>assets/chart_assets/js/fusioncharts.js" type="text/javascript"></script>
        <!-- jQuery-FusionCharts -->
        <script src="<?php echo base_url(); ?>assets/chart_assets/js/jquery-fusioncharts.js" type="text/javascript"></script>
        <!-- Fusion Theme -->
        <script src="<?php echo base_url(); ?>assets/chart_assets/js/themes/fusioncharts.theme.fusion.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
        <!-- EX ASSETS IMP -->  
        <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click', '#btn_logout', function(){
                $.ajax({
                    url     : "<?php echo site_url('Login/logout'); ?>",
                    type    : "POST",
                    dataType : "json",
                    success : function(res){
                        if (res.rstatus == "success") {
                            var url = "<?php echo site_url('Login'); ?>";                                         
                            location.replace(url);         
                        } else if (res.rstatus == "failed") {
                            alert("Logout Error");
                        }
                    }, error : function(){
                        alert("Logout Error");
                    }
                });
            });
        });
        </script>      
    </body>
</html>