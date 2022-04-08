        <!-- <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script> -->
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/moment.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?= base_url() ?>assets/metronic/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>        
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>        
        <script src="<?= base_url() ?>assets/metronic/global/plugins/ladda/spin.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/ladda/ladda.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= base_url() ?>assets/metronic/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?= base_url() ?>assets/metronic/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/ui-extended-modals.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/form-validation.min.js" type="text/javascript"></script>        
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/ui-buttons.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/form-input-mask.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php if(isset($script) && $script !== '') : ?>
            <script id="script" type="module" data-base-url="<?= base_url() ?>" data-csrf-name="<?= $this->security->get_csrf_token_name() ?>" data-csrf-token="<?= $this->security->get_csrf_hash() ?>" data-load-module="<?= $script ?>" src="<?= base_url("js/main.js") ?>"></script>
        <?php endif; ?>
    </body>
</html>