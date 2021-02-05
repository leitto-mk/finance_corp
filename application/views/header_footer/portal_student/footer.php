<!-- BEGIN FOOTER -->
            <div class="page-footer">
                <div class="page-footer-inner">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo-footer">
                        <a href="<?=base_url('Cecommerce')?>">
                            <img src="<?=base_url('assets')?>/abase.png" alt="logo" class="logo-default">
                        </a>
                        <div class="menu-toggler sidebar-toggler">
                            <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                        </div>
                    </div>
                    <!-- END LOGO -->
                    2020 &copy; Portal Student By
                    <a target="_blank" href="#">ABase</a>   
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
        </div>
        <!--[if lt IE 9]>
<script src="<?=base_url('assets')?>/global/plugins/respond.min.js"></script>
<script src="<?=base_url('assets')?>/global/plugins/excanvas.min.js"></script> 
<script src="<?=base_url('assets')?>/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?=base_url('assets')?>/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=base_url('assets')?>/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE GLOBAL SCRIPTS -->
        <script src="<?=base_url('assets')?>/global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/pages/scripts/components-ion-sliders.min.js" type="text/javascript"></script>
        <!-- END PAGE GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?=base_url('assets')?>/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script src="<?=base_url('assets')?>/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=base_url('assets')?>/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>
        <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="<?=base_url('assets')?>/dropify-upload/js/dropify.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/CUSTOMS/student_profile.js"></script>
        <script>
            var base_url = '<?= base_url() ?>'
            var id = '<?= $id; ?>'
            var fullname = '<?= "$fname $lname" ?>'

            //FROM TEACHER CONTROLLER
            var cur_sem = '<?= $period[0]['Semester'] ?>'
            var cur_per = '<?= $period[0]['schoolyear'] ?>'

            console.log(`${id} - ${fullname} - ${cur_sem} - ${cur_per}`)
        </script>
    </body>

</html>