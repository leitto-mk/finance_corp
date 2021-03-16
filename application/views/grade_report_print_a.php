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
                                        <h3 class="text-center sbold"><?= isset($info->SchoolName) ? $info->SchoolName : 'REPORT' ?><br></h3>
                                        <h3>REKAP CAPAIAN KOMPETENSI PESERTA DIDIK</h3>
                                        <hr>
                                    </center>
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
                                            <span style="padding-left: 100px">Mata Pelajaran : </span><strong style="float: right"><?= $info->SubjName ?></strong>
                                        </li>
                                        <li>
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

                            <div class="row" style="margin-top: 25px">
                                <div class="col-xs-12" style="margin-bottom: -15px">
                                    <table class="table table-striped table-hover">
                                        <thead style="background-color: #bac3d0">
                                            <tr>
                                                <th colspan="6" style="background-color:#eef1f5">Rekap Capaian Kompetensi Pengetahuan</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center" width="2%">No</th>
                                                <th class="text-center" width="15%"> MATERI</th>
                                                <th class="text-center" width="10%"> KODE</th>
                                                <th class="text-center" width="10%"> KKM</th>
                                                <th class="text-center" width="10%"> NILAI</th>
                                                <th class="text-center" width="10%"> KET</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($kd as $row) : ?>
                                                <?php if ($row->Type == 'cognitive') : ?>
                                                    <tr>
                                                        <td class="text-center"> <?= $i; ?> </td>
                                                        <td class="text-left" width="15%"><?= $row->KD ?></td>
                                                        <td class="text-center" width="10%"><?= $row->Code ?></td>
                                                        <td class="text-center" width="10%"><?= $row->KKM ?></td>
                                                        <td class="text-center" width="10%"><?= $row->KDAvg ?></td>
                                                        <td class="text-center" width="10%">
                                                            <?php if ($row->KDAvg < $row->KKM) {
                                                                echo 'Belum Tuntas';
                                                            } else {
                                                                echo 'Tuntas';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>

                                <div class="col-xs-12" style="margin-bottom: -15px">
                                    <table class="table table-striped table-hover">
                                        <thead style="background-color: #bac3d0">
                                            <tr>
                                                <th class="text-center" width="2%">No</th>
                                                <th class="text-center" width="15%"> Uraian</th>
                                                <th class="text-center" width="10%"> Bobot</th>
                                                <th class="text-center" width="10%"> KKM</th>
                                                <th class="text-center" width="10%"> NILAI</th>
                                                <th class="text-center" width="10%"> KET</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-left" width="15%">Nilai Rerata Harian </td>
                                                <td class="text-center" width="10%"><?= $exam->KDWeight ?></td>
                                                <td class="text-center" width="10%"><?= $exam->KD_KKM ?></td>
                                                <td class="text-center" width="10%"><?= $exam->KDRecapAVG ?></td>
                                                <td class="text-center" width="10%">
                                                    <?php if ($exam->KD_KKM > $exam->KDRecapAVG) {
                                                        echo 'Belum Tuntas';
                                                    } else {
                                                        echo 'Tuntas';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td class="text-left" width="15%">Hasil Penilaian Tengah Semester</td>
                                                <td class="text-center" width="10%"><?= $exam->MidWeight ?></td>
                                                <td class="text-center" width="10%"><?= $exam->Mid_KKM ?></td>
                                                <td class="text-center" width="10%"><?= $exam->MidRecap ?></td>
                                                <td class="text-center" width="10%">
                                                    <?php if ($exam->Mid_KKM > $exam->MidRecap) {
                                                        echo 'Belum Tuntas';
                                                    } else {
                                                        echo 'Tuntas';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td class="text-left" width="15%">Hasil Penilaian Akhir Semester</td>
                                                <td class="text-center" width="10%"><?= $exam->FinalWeight ?></td>
                                                <td class="text-center" width="10%"><?= $exam->Final_KKM ?></td>
                                                <td class="text-center" width="10%"><?= $exam->FinalRecap ?></td>
                                                <td class="text-center" width="10%">
                                                    <?php if ($exam->Final_KKM > $exam->FinalRecap) {
                                                        echo 'Belum Tuntas';
                                                    } else {
                                                        echo 'Tuntas';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-xs-12" style="margin-bottom: -15px">
                                    <table class="table table-striped table-hover">
                                        <thead style="background-color: #bac3d0">
                                            <tr>
                                                <th class="text-center" width="2%">No</th>
                                                <th class="text-center" width="15%"> Uraian</th>
                                                <th class="text-center" width="10%"> KKM</th>
                                                <th class="text-center" width="10%"> NILAI</th>
                                                <th class="text-center" width="10%"> NILAI AKHIR</th>
                                                <th class="text-center" width="10%"> PREDIKAT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-left" width="15%">Nilai Akhir Pengetahuan</td>
                                                <td class="text-center" width="10%"><?= $exam->Report_KKM ?></td>
                                                <td class="text-center" width="10%"><?= $rep->Report ?></td>
                                                <td class="text-center" width="10%"><strong><?= $rep->Report ?></strong> </td>
                                                <td class="text-center" width="10%"><strong><?= $rep->Predicate ?></strong> </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="col-md-12" style="margin-top: 15px">
                                    <?php if($voc->num_rows() > 0 && $this->session->userdata('semester') == 2): ?>
                                        <?php 
                                            $result_voc = $voc->row(); 

                                            if ($result_voc->Predicate == 'A') {
                                                $col_voc = '#5edfff';
                                            } elseif ($result_voc->Predicate == 'B') {
                                                $col_voc = '#71a95a';
                                            } elseif ($result_voc->Predicate == 'C') {
                                                $col_voc = '#fbe555';
                                            } elseif ($result_voc->Predicate == 'D') {
                                                $col_voc = '#fb5b5a';
                                            }
                                        ?>
                                        <table class="table table-striped table-hover">
                                            <thead class="report_voc">
                                                <tr style="background-color: #bac3d0">    
                                                    <th class="text-center" rowspan="2" >PRAKERIN/UKK</th>    
                                                    <th class="text-center"> NILAI</th>    
                                                    <th class="text-center"> PREDIKAT</th>    
                                                    <th class="text-center"> DESKRIPSI</th>
                                                </tr>
                                                <tr>    
                                                    <td class="text-center sbold"><?= $result_voc->Report?></td>    
                                                    <td class="text-center sbold" style="color: <?= $col_voc ?>"><?= $result_voc->Predicate?></td>    
                                                    <td class="text-center"><?= $result_voc->Description?></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    <?php endif; ?>
                                </div>
                                <div class="col-xs-12" style="margin-top: 15px">
                                    <table>
                                        <thead>
                                            <h5 style="margin-top: 10px"><strong>Deskripsi Capaian Kompetensi Pengetahuan</strong></h5>
                                        </thead>
                                    </table>

                                    <ul class="list-unstyled">
                                        <li><?= $rep->Description ?><br><br> <br></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12" style="margin-bottom: -15px">
                                    <table class="table table-striped table-hover">
                                        <thead style="background-color: #bac3d0">
                                            <tr>
                                                <th colspan="6" style="background-color:#eef1f5">Rekap Capaian Kompetensi Keterampilan</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center" width="2%">No</th>
                                                <th class="text-center" width="15%"> MATERI</th>
                                                <th class="text-center" width="10%"> KODE</th>
                                                <th class="text-center" width="10%"> KKM</th>
                                                <th class="text-center" width="10%"> NILAI</th>
                                                <th class="text-center" width="10%"> KET</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($kd as $row) : ?>
                                                <?php if ($row->Type == 'skills') : ?>
                                                    <tr>
                                                        <td class="text-center"> <?= $i; ?> </td>
                                                        <td class="text-left" width="15%"><?= $row->KD ?></td>
                                                        <td class="text-center" width="10%"><?= $row->Code ?></td>
                                                        <td class="text-center" width="10%"><?= $row->KKM ?></td>
                                                        <td class="text-center" width="10%"><?= $row->KDAvg ?></td>
                                                        <td class="text-center" width="10%">
                                                            <?php if ($row->KDAvg < $row->KKM) {
                                                                echo 'Belum Tuntas';
                                                            } else {
                                                                echo 'Tuntas';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-xs-12" style="margin-bottom: -15px">
                                    <table class="table table-striped table-hover">
                                        <thead style="background-color: #bac3d0">
                                            <tr>
                                                <th class="text-center" width="2%">No</th>
                                                <th class="text-center" width="15%"> URAIAN</th>
                                                <th class="text-center" width="10%"> BOBOT</th>
                                                <th class="text-center" width="10%"> KKM</th>
                                                <th class="text-center" width="10%"> NILAI</th>
                                                <th class="text-center" width="10%"> KET</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-left" width="15%">Nilai Rerata Harian </td>
                                                <td class="text-center" width="10%"><?= $exam->KDWeight_SK ?></td>
                                                <td class="text-center" width="10%"><?= $exam->KD_KKM ?></td>
                                                <td class="text-center" width="10%"><?= $exam->KDRecapAVG_SK ?></td>
                                                <td class="text-center" width="10%">
                                                    <?php if ($exam->KD_KKM > $exam->KDRecapAVG_SK) {
                                                        echo 'Belum Tuntas';
                                                    } else {
                                                        echo 'Tuntas';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td class="text-left" width="15%">Hasil Penilaian Tengah Semester</td>
                                                <td class="text-center" width="10%"></td>
                                                <td class="text-center" width="10%"><?= $exam->Mid_KKM ?></td>
                                                <td class="text-center" width="10%"><?= $exam->MidRecap ?></td>
                                                <td class="text-center" width="10%">
                                                    <?php if ($exam->Mid_KKM > $exam->MidRecap) {
                                                        echo 'Belum Tuntas';
                                                    } else {
                                                        echo 'Tuntas';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td class="text-left" width="15%">Hasil Penilaian Akhir Semester</td>
                                                <td class="text-center" width="10%"></td>
                                                <td class="text-center" width="10%"><?= $exam->Final_KKM ?></td>
                                                <td class="text-center" width="10%"><?= $exam->FinalRecap ?></td>
                                                <td class="text-center" width="10%">
                                                    <?php if ($exam->Final_KKM > $exam->FinalRecap) {
                                                        echo 'Belum Tuntas';
                                                    } else {
                                                        echo 'Tuntas';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="col-xs-12" style="margin-bottom: -15px">
                                    <table class="table table-striped table-hover">
                                        <thead style="background-color: #bac3d0">
                                            <tr>
                                                <th class="text-center" width="2%">No</th>
                                                <th class="text-center" width="15%"> URAIAN</th>
                                                <th class="text-center" width="10%"> KKM</th>
                                                <th class="text-center" width="10%"> NILAI</th>
                                                <th class="text-center" width="10%"> NILAI AKHIR</th>
                                                <th class="text-center" width="10%"> PREDIKAT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-left" width="15%">Nilai Akhir Pengetahuan</td>
                                                <td class="text-center" width="10%"><?= $exam->Report_KKM ?></td>
                                                <td class="text-center" width="10%"><?= $rep->Report_SK ?></td>
                                                <td class="text-center" width="10%"><strong><?= $rep->Report_SK ?></strong> </td>
                                                <td class="text-center" width="10%"><strong><?= $rep->Predicate_SK ?></strong> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="col-xs-12" style="margin-top: 15px">
                                    <h5 style="margin-top: 10px"><strong>Deskripsi Capaian Kompetensi Keterampilan</strong></h5>
                                    <ul class="list-unstyled">
                                        <li>
                                            <?= $rep->Description_SK ?><br><br> <br>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-xs-6" style="margin-bottom: -15px">
                                    <table class="table table-striped table-hover">
                                        <thead style="background-color: #bac3d0">
                                            <tr>
                                                <th colspan="6" style="background-color:#eef1f5">Kompetensi Sikap Spritual</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center" width="15%">DESKRIPSI</th>
                                                <th class="text-center" width="5%"> NILAI</th>
                                                <th class="text-center" width="5%"> PREDIKAT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                    <?= $rep->Description_SPR ?>
                                                    <br><br><br>
                                                </td>
                                                <td class="text-center" width="5%"><strong><?= $rep->Report_SPR ?></strong></td>
                                                <td class="text-center" width="5%"><strong><?= $rep->Predicate_SPR ?></strong></td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="col-xs-6" style="margin-bottom: -15px">
                                    <table class="table table-striped table-hover">
                                        <thead style="background-color: #bac3d0">
                                            <tr>
                                                <th colspan="6" style="background-color:#eef1f5">Kompetensi Sikap Sosial</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center" width="15%">DESKRIPSI</th>
                                                <th class="text-center" width="5%"> NILAI</th>
                                                <th class="text-center" width="5%"> PREDIKAT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                    <?= $rep->Description_SOC ?>
                                                    <br><br><br>
                                                </td>
                                                <td class="text-center" width="5%"><strong><?= $rep->Report_SOC ?></strong></td>
                                                <td class="text-center" width="5%"><strong><?= $rep->Predicate_SOC ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-xs-6" style="margin-bottom: -15px; margin-top: 35px;">
                                    <table class="table table-striped table-hover">
                                        <thead style="background-color: #bac3d0">
                                            <tr>
                                                <th colspan="6" style="background-color:#eef1f5">Daftar Absensi</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center" width="5%"> No </th>
                                                <th class="text-center" width="10%">KETERANGAN</th>
                                                <th class="text-center" width="5%"> JUMLAH</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-left" width="10%">Sakit</td>
                                                <td class="text-center" width="5%"><strong><?= $sick->Total ?></strong>&nbsp;Hari</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td class="text-left" width="10%">Izin</td>
                                                <td class="text-center" width="5%"><strong><?= $permit->Total ?></strong>&nbsp;Hari</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td class="text-left" width="10%">Tanpa Keterangan</td>
                                                <td class="text-center" width="5%"><strong><?= $absent->Total ?></strong>&nbsp;Hari</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-xs-2"></div>
                                <div class="col-xs-4" style="padding-left: 35px; float: left">
                                    <?php
                                        $month = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        $date = explode('0',date('m'));
                                        
                                        $month = date('d') .' '. $month[$date[1]] .' '. date('Y');
                                    ?>
                                    <h5 style="margin-top: 50px;">Manado, <?= $month ?></h5>
                                    <h5> Guru Mata Pelajaran <br></BR></h5>
                                    <ul class="list-unstyled">
                                        <br>
                                        <br>
                                        <br>
                                        <li><strong><?= $info->TeacherName ?></strong></li>
                                        <li>NIP.&nbsp;<?= $info->IDNumber ?></li>
                                    </ul>
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