                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            <div class="page-footer">
                <div class="page-footer-inner"> <?= Date('Y')?> &copy; Andalan Banua Sejahtera | 
                    <a target="_blank" href="http://abase.com">abase.com</a>
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
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
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?= base_url() ?>assets/metronic/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-table/bootstrap-table.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/table-bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/table-datatables-fixedheader.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/ui-blockui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/ui-blockui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/portfolio-1.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/form-input-mask.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php if(isset($script) && $script !== '') : ?>
            <script id="script" type="module" data-load-module="<?= $script ?>" src="<?= base_url("js/main.js") ?>"></script>
        <?php endif; ?>
     </body>
</html>