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
        $semester = ($info->Semester == 1) ? 'Ganjil' : 'Genap';
        echo "$info->NIS - $info->SubjName ($semester)";
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
                    <!-- BEGIN SIDEBAR -->

                    <!-- END SIDEBAR -->
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <div class="page-content" style="margin-top: 0px; margin-left: 0px; padding-top:0px">
                            <!-- BEGIN PAGE HEADER-->

                            <div class="row">
                                <div class="col-md-12" style="margin-bottom: 0px;">
                                    <center>
                                        <h3>REKAP CAPAIAN KOMPETENSI PESERTA DIDIK</h3>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-xs-2 invoice-payment">
                                    <ul class="list-unstyled">
                                        <li>
                                            Peserta Didik
                                        </li>
                                        <li>
                                            Nomor Induk
                                        </li>
                                        <li>
                                            Kelas
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-10 invoice-payment">
                                    <ul class="list-unstyled">
                                        <li>
                                            <span class="sbold uppercase">: <?= $info->FullName ?></span>
                                        </li>
                                        <li>
                                            <span class="sbold uppercase">: <?= $info->NIS ?></span>
                                        </li>
                                        <li>
                                            <span class="sbold uppercase">: <?= $info->Kelas ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 25px">
                                <div class="col-md-12">
                                    <h5 class="uppercase sbold">A. Sikap</h5>
                                    <div class="col-md-12">
                                        <h5 class="uppercase sbold">I. Sikap Spiritual</h5>
                                        <div class="col-md-12">
                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                <thead style="background-color: #bac3d0">
                                                    <th class="sbold uppercase text">
                                                        Predikat
                                                    </th>
                                                    <th class="sbold uppercase text">
                                                        Deskripsi
                                                    </th>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="uppercase sbold">I. Sikap Sosial</h5>
                                        <div class="col-md-12">
                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                <thead style="background-color: #bac3d0">
                                                    <th class="sbold uppercase text">
                                                        Predikat
                                                    </th>
                                                    <th class="sbold uppercase text">
                                                        Deskripsi
                                                    </th>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="text-center sbold">
                                        Didiklah orang yang muda menurut jalan yang pantut baginya,<br>
                                        maka pada masa tuanya pun ia tidak akan menyimpang dari pada jalan itu.<br>
                                        Amsal 22:6
                                    </p>
                                    <!-- <legend>Educating for Eternity</legend> -->
                                </div>
                                <div class="col-md-12">
                                    <h5 class="uppercase sbold">B. Pengetahuan dan Keterampilan</h5>
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead style="background-color: #bac3d0">
                                                <tr>
                                                    <th class="sbold uppercase text-center" rowspan="2">
                                                        No
                                                    </th>
                                                    <th class="sbold uppercase text-center" rowspan="2">
                                                        Mata Pelajaran
                                                    </th>
                                                    <th class="sbold uppercase text-center" colspan="2">
                                                        Pengetahuan
                                                    </th>
                                                    <th class="sbold uppercase text-center" colspan="2">
                                                        Keterampilan
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="sbold uppercase text-center">Nilai</th>
                                                    <th class="sbold uppercase text-center">Predikat</th>
                                                    <th class="sbold uppercase text-center">Nilai</th>
                                                    <th class="sbold uppercase text-center">Predikat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = 1;
                                                ?>
                                                <?php foreach($grade as $row) : ?>
                                                    <tr>
                                                        <td class="sbold uppercase"><?= $i?></td>
                                                        <td class="sbold uppercase" contenteditable="true"><?= $row->SubjName?></td>
                                                        <td class="sbold uppercase" contenteditable="true"><?= $row->Report?></td>
                                                        <td class="sbold uppercase" contenteditable="true"><?= $row->Predicate?></td>
                                                        <td class="sbold uppercase" contenteditable="true"><?= $row->Report?></td>
                                                        <td class="sbold uppercase" contenteditable="true"><?= $row->Predicate?></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <th class="sbold uppercase">Catatan untuk diperhatikan Orang Tua/Wali: </th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td contenteditable="true" height="50px"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12" style="margin-top: 20px;">
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
                                                $month = ['None','Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
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
                                            <br>
                                            <span class="sbold" style="text-decoration: underline"><?= $info->TeacherName . ($info->StudyFocus != '' ? ", $info->StudyFocus" : '') ?></span>
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <br><br><br>
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