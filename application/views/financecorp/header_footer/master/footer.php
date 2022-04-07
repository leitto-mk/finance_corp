<!-- BEGIN FOOTER -->
                <p class="copyright">  2022 &copy; ABase
                    <a href="#"></a> &nbsp;|&nbsp;
                    <a href="#">Master Data</a>
                </p>
                <a href="#index" class="go2top">
                    <i class="icon-arrow-up"></i>
                </a>
                <!-- END FOOTER -->
            </div>
        </div>
        <!-- END CONTAINER -->
        <!--[if lt IE 9]>
<script src="<?=base_url()?>assets/metronic/global/plugins/respond.min.js"></script>
<script src="<?=base_url()?>assets/metronic/global/plugins/excanvas.min.js"></script> 
<script src="<?=base_url()?>assets/metronic/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <!-- <script src="<?= base_url()?>assets/metronicjs/jquery-3.4.1.min.js" type="text/javascript"></script> -->
        <script src="<?=base_url()?>assets/metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=base_url()?>assets/metronic/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL PLUGIN -->
        <script src="<?=base_url()?>assets/metronic/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGIN -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?=base_url()?>assets/metronic/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/metronic/toastr/js/toastr.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- BEGIN PAGE LAYOUT SCRIPTS -->
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/form-input-mask.min.js" type="text/javascript"></script>
        <!-- END PAGE LAYOUT SCRIPTS -->
        <!-- <script src="<?=base_url('js/master/js_master_abase.js')?>" type="text/javascript"></script> -->
        <!-- <script src="<?=base_url('js/master/js_master_stockgroup.js')?>" type="text/javascript"></script> -->
        <!-- <script src="<?=base_url('js/master/js_master.js')?>" type="text/javascript"></script> -->
        <?php if(isset($script) && $script !== '') : ?>
            <script id="script" type="module" data-load-module="<?= $script ?>" src="<?= base_url("js/main.js") ?>"></script>
        <?php endif ?>
    </body>

</html>