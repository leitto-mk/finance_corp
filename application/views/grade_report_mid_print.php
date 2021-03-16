<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>
        <?php
        // $semester = ($info->Semester == 1) ? 'Ganjil' : 'Genap';
        // //$info = (isset($info->NIS) ? $info->NIS : 'NO DATA');
        // $subj = (isset($info->SubjName) ? $info->SubjName : 'NO DATA');
        echo "$info->NIS - Mid-Semester";
        ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #5 for blank page layout" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
    <link href="<?= base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?= base_url() ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?= base_url() ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?= base_url() ?>assets/layouts/layout5/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/layouts/layout5/css/custom.min.css" rel="stylesheet" type="text/css" />

    <!-- CUSTOM -->
    <link href="<?= base_url() ?>assets/CUSTOMS/academy.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/DataTables/datatables.min.css" /> -->
    <!-- <link href="<?= base_url(); ?>assets/CUSTOM-PLUGINS/daterangepicker-master/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/jqueryui-editable-1.5.1/css/jqueryui-editable.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/global/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" /> -->

    <!-- END THEME LAYOUT STYLES -->
    <!-- <link rel="shortcut icon" href="favicon.ico" /> -->
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo new_enroll">
    <!-- BEGIN CONTAINER -->
    <div class="wrapper">
        <!-- BEGIN HEADER -->
        <header class="page-header">
            <nav class="navbar mega-menu" role="navigation">
                <div class="container-fluid">
                    <div class="clearfix navbar-fixed-top" style="padding-bottom: 2px;padding-top: 2px; margin-top: 0px; margin-bottom: 0px;">
                        <!-- BEGIN LOGO -->
                        <a id="index" class="page-logo" href="index.html">
                            <img src="<?= base_url() ?>/assets/pages/media/email/logo.png" alt="Logo" style="width: 10%"> </a>
                        <!-- END LOGO -->
                    </div>
                </div>
                <!--/container-->
            </nav>
        </header>
        <!-- END HEADER -->
        <div class="container-fluid">
            <div class="page-content" style="padding-top: 30px;">

                <div class="page-container">
                    <div class="page-content-wrapper">
                        <div class="page-content" style="margin-top: 0px; margin-left: 0px; padding-top:0px">                        

                            <div class="row">
                                <div class="col-md-12 text-center" style="margin-bottom: 0px;">
                                    <!-- <h3 class="text-center sbold"><?= isset($info->SchoolName) ? strtoupper($info->SchoolName) : 'REPORT' ?><br></h3> -->
                                    <span class="sbold uppercase h4">LAPORAN HASIL TENGAH SEMESTER</span>
                                    <hr>
                                </div>
                                <div class="col-xs-6 invoice-payment">
                                    <ul class="list-unstyled">
                                        <li>
                                            Peserta Didik:<br>
                                            <h4 class="sbold"><?= $info->FullName ?></h4>
                                        </li>
                                        <br>
                                        <li>
                                            Nomor Induk: <strong><?= $info->NIS ?></strong>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-6 invoice-payment">
                                    <ul class="list-unstyled">
                                        <li>
                                            <?php $semester = ($info->Semester == 1 ? 'Ganjil' : 'Genap')?>
                                            <span style="padding-left: 100px">Tahun Ajaran &nbsp;&nbsp;&nbsp;: </span><strong style="float: right"><?= $info->schoolyear ?></strong>
                                        </li>
                                        <li>
                                            <span style="padding-left: 100px">Semester&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </span><strong style="float: right"><?= "$info->Semester ($semester)" ?></strong>
                                        </li>
                                        <li>
                                            <span style="padding-left: 100px">Kelas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </span><strong style="float: right"><?= $info->Room ?></strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="text-center"> #NO </th>
                                                <th rowspan="2" class="text-center"> MATA PELAJARAN </th>
                                                <th colspan="2" class="text-center"> PENCAPAIAN </th>
                                            </tr>
                                            <tr>
                                                <th class="text-center"> KKM </th>
                                                <th class="text-center"> NILAI </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($subjects as $row) : ?>
                                                <?php $color = ($row->MidRecap >= $row->KKM ? 'text-success' : 'text-danger') ?>
                                                <tr>
                                                    <td class="text-center sbold"> <?= $i ?> </td>
                                                    <td class="text-center"> <?= strtoupper($row->SubjName) ?> </td>
                                                    <td class="text-center"> <?= $row->KKM ?> </td>
                                                    <td class="text-center sbold <?= $color ?>"> <?= $row->MidRecap ?> </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="3" style="text-align: right"> <b>JUMLAH</b> </td>
                                                <td class="text-center"><b><?= $score ?></b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align: right"> <b>RATA-RATA</b> </td>
                                                <td class="text-center"><b><?= $average ?></b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="table-scrollable">
                                    <table class="table table-striped">
                                        <thead>
                                            <th style="text-align:justify">
                                                <p>TIDAK HADIR</p>
                                            </th>
                                            <td>
                                                Sakit: <span class="sbold" style="float: right"> <?= $sick->Total ?> Hari</span>
                                                <br>
                                                Izin: <span class="sbold" style="float: right"> <?= $permit->Total ?> Hari</span>
                                                <br>
                                                Tanpa Keterangan: <span class="sbold" style="float: right"> <?= $absent->Total ?> Hari</span>
                                            </td>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="sbold uppercase" style="border-bottom: 0px">Catatan untuk diperhatikan Orang Tua/ Wali:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="100" contenteditable="true"  class="text-center sbold" style="border-bottom: 0px"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 20px;">
                                <div class="col-xs-6">
                                    <p>
                                        Mengetahui,<br>
                                        Orang Tua/Wali
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <span class="sbold" contenteditable="true">......................................</span>
                                    </p>
                                </div>
                                <div class="col-xs-6">
                                    <p style="padding-left: 30%">
                                        <?php
                                            $month = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            $date = explode('0',date('m'));
                                            
                                            $month = date('d') .' '. $month[$date[1]] .' '. date('Y');
                                        ?>
                                        Manado, <?= $month ?><br>
                                        Wali Kelas
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <span class="sbold" style="text-decoration: underline"><?= $info->TeacherName . ($info->StudyFocus != '' ? ", $info->StudyFocus" : '') ?></span>
                                    </p>
                                </div>
                            </div>
                            <p class="text-center sbold" style="font-family:'Times New Roman', Times, serif">
                                Takut akan TUHAN adalah permulaan pengetahuan,<br>
                                tetapi orang bodoh menghina hikmat dan didikan.<br>
                                Amsal 1:7
                            </p>
                            <div class="row">
                                <a class="btn btn-lg blue hidden-print" onclick="javascript:window.print();" style="float: right; margin-right: 20px; min-width: 120px; max-width: 120px"> Print
                                    <i class="fa fa-print"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>

            </div>
        </div>
    </div>
    <!-- END CONTAINER -->
    <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <!-- <script src="<?= base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script> -->
    <!-- END CORE PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <!-- <script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script> -->
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <!-- <script src="<?= base_url() ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script> -->
    <!-- END THEME LAYOUT SCRIPTS -->

    <!-- CUSTOM PLUGIN -->
    <!-- <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/DataTables/datatables.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/daterangepicker-master/daterangepicker.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/underscore-master/underscore-min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/global/plugins/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/RobinHerbots-Inputmask/dist/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/RobinHerbots-Inputmask/dist/bindings/inputmask.binding.js" type="text/javascript"></script> -->
</body>

</html>