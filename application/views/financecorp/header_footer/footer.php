        <div class="page-wrapper-row">
            <div class="page-wrapper-bottom">
                <!-- BEGIN FOOTER -->
                <!-- BEGIN INNER FOOTER -->
                <div class="page-footer">
                    <div class="container-fluid"> 2021 &copy; PT. Andalan Banua Sejahtera
                        <a target="_blank" href="#">ABase</a> &nbsp;|&nbsp;
                        <a href="#"><?= $title ?></a>
                    </div>
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
                <!-- END INNER FOOTER -->
                <!-- END FOOTER -->
            </div>
        </div>
        </div>
        <!-- <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/global/plugins/moment.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= base_url() ?>assets/metronic/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?= base_url() ?>assets/metronic/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/metronic/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?= base_url() ?>assets/metronic/pages/scripts/form-input-mask.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <?php if(isset($script) && $script !== '') : ?>
            <script id="script" type="module" data-base-url="<?= base_url() ?>" data-csrf-name="<?= $this->security->get_csrf_token_name() ?>" data-csrf-token="<?= $this->security->get_csrf_hash() ?>" data-load-module="<?= $script ?>" src="<?= base_url("js/main.js") ?>"></script>
        <?php endif; ?>  
    </body>
</html>