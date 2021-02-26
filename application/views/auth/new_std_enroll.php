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
    <title><?= $title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #5 for blank page layout" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN LAYOUT FIRST STYLES -->
    <link href="//fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" />
    <!-- END LAYOUT FIRST STYLES -->
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
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/DataTables/datatables.min.css" /> -->
    <link href="<?= base_url(); ?>assets/CUSTOM-PLUGINS/daterangepicker-master/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOMS/academy.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/jqueryui-editable-1.5.1/css/jqueryui-editable.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/global/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets')?>/dropify-upload/css/dropify.min.css" rel="stylesheet" type="text/css" />

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
            <div class="page-content" style="padding-top: 10px;">

                <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
                <div class="page-content-container">
                    <div class="page-content-row text-center">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="portlet light" id="form_wizard_1">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class=" icon-layers font-red"></i>
                                            <span class="caption-subject font-red bold uppercase"> Form Wizard -
                                                <span class="step-title"> Step 1 of 4 </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" id="submit_form" method="POST" role="form" enctype="multipart/form-data">
                                            <div class="form-wizard">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-8">
                                                            <ul class="nav nav-pills nav-justified steps">
                                                                <li class="active">
                                                                    <a href="#tab1" data-toggle="tab" class="step">
                                                                        <span class="number"> 1 </span>
                                                                        <span class="desc">
                                                                            <i class="fa fa-check"></i> Formulir Peserta Didik </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#tab2" data-toggle="tab" class="step">
                                                                        <span class="number"> 2 </span>
                                                                        <span class="desc">
                                                                            <i class="fa fa-check"></i> Rincian Peserta Didik </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#tab3" data-toggle="tab" class="step">
                                                                        <span class="number"> 3 </span>
                                                                        <span class="desc">
                                                                            <i class="fa fa-check"></i> Registrasi Peserta Didik </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#tab4" data-toggle="tab" class="step">
                                                                        <span class="number"> 4 </span>
                                                                        <span class="desc">
                                                                            <i class="fa fa-check"></i> Konfirmasi Data Didik </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                    </div>
                                                    <div class="tab-content" style="margin-top: 10px;">
                                                        <div class="tab-pane active" id="tab1" data-select="1">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="portlet box grey-gallery">
                                                                        <div class="portlet-title">
                                                                            <div class="caption">
                                                                                <i class="fa fa-address-card"></i>Biodata </div>
                                                                        </div>
                                                                        <div class="portlet-body">  
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Nama Depan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="fname" placeholder="">
                                                                                        <span class="help-block">masukan nama depan...</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Nama Tengah
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="mname" placeholder="">
                                                                                        <span class="help-block">masukan nama tengah</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Nama Belakang
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="lname" placeholder="">
                                                                                        <span class="help-block">masukan nama belakang</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Nama Panggilan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="nname" placeholder="">
                                                                                        <span class="help-block">masukan nama panggilan</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Jenis Kelamin
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="md-radio-inline">
                                                                                        <div class="md-radio">
                                                                                            <input type="radio" id="male" name="gender" class="md-radiobtn" value="Laki-Laki" checked>
                                                                                            <label for="male">
                                                                                                <span class="inc"></span>
                                                                                                <span class="check"></span>
                                                                                                <span class="box"></span> Laki-Laki</label>
                                                                                        </div>
                                                                                        <div class="md-radio">
                                                                                            <input type="radio" id="female" name="gender" class="md-radiobtn" value="Perempuan">
                                                                                            <label for="female">
                                                                                                <span></span>
                                                                                                <span class="check"></span>
                                                                                                <span class="box"></span> Perempuan </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">NISN
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="nisn" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10">Nomor Induk Siswa Nasional Peserta Didik.</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">NIK/KITAS (untuk WNA)
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="nik" placeholder="">
                                                                                        <p class="help-block" style="z-index: 10;">Nomor Induk Kependudukan. Kartu Izin Tinggal Terbatas (untuk WNA).</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">No. KK
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="kk" placeholder="">
                                                                                        <p class="help-block" style="z-index: 10;">Nomor Kartu Keluarga.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Tanggal Lahir
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="tgllhr" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Tanggal/Bulan/Tahun</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Tempat Lahir
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="tmplhr" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Tempat Kelahiran.</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">No. Registrasi Akta Lahir
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="akta" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Nomor Registrasi Akta Lahir</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Agama/Kepercayaan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <select name="religion" class="form-control" id="form_control_1">
                                                                                            <option value="" selected>-</option>
                                                                                            <option value="Budha">Budha</option>
                                                                                            <option value="Hindu">Hindu</option>
                                                                                            <option value="Islam">Islam</option>
                                                                                            <option value="Katolik">Katholik</option>
                                                                                            <option value="Kong Hu Cu">Kong Hu Cu</option>
                                                                                            <option value="Kristen">Kristen</option>
                                                                                            <option value="Advent">Advent</option>
                                                                                        </select>
                                                                                        <span class="help-block" style="z-index: 10;">Agama</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Kewarganegaraan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <select name="country" class="form-control" id="form_control_1">
                                                                                            <option value="" selected></option>
                                                                                            <!-- JSON DATA GOES HERE -->
                                                                                        </select>
                                                                                        <span class="help-block" style="z-index: 10;">Kewarganegaraan</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Berkebutuhan Khusus
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="disabled" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang oleh peserta didik.</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="portlet box grey-gallery">
                                                                        <div class="portlet-title">
                                                                            <div class="caption">
                                                                                <i class="fa fa-address-card"></i>Alamat </div>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                                <div class="form-group" style="margin-bottom: 5px;">
                                                                                    <label class="control-label col-md-4">Tempat Tinggal
                                                                                        <span class="required" aria-required="true"> * </span>
                                                                                    </label>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                            <select name="livewith" class="form-control" id="form_control_1">
                                                                                                <option value="With Parent" selected> Orang Tua </option>
                                                                                                <option value="With Guardian"> Wali </option>
                                                                                                <option value="Kost / PRivate Apt"> Kost/Apartemen Pribadi </option>
                                                                                                <option value="Dormitory"> Asrama </option>
                                                                                                <option value="Foster Home"> Panti Asuhan </option>
                                                                                            </select>
                                                                                            <span class="help-block" style="z-index: 10;">Tempat Tinggal</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group" style="margin-bottom: 5px;">
                                                                                    <label class="control-label col-md-4">Moda Transportasi
                                                                                        <span class="required" aria-required="true"> * </span>
                                                                                    </label>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                            <select name="transport" class="form-control" id="form_control_1">
                                                                                                <option value="On Foot" selected> Jalan Kaki </option>
                                                                                                <option value="Private Vehicle"> Kendaraan Pribadi </option>
                                                                                                <option value="Public Transportation"> Angkutan Umum </option>
                                                                                                <option value="School Bus"> Jemputan Sekolah </option>
                                                                                            </select>
                                                                                            <span class="help-block" style="z-index: 10;">Moda Transportasi</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Alamat
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="address" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Alamat Peserta Didik.</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">RT
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="number" class="form-control" id="form_control_1" name="rt" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">RT</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">RW
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="number" class="form-control" id="form_control_1" name="rw" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">RW</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Nama Dusun
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="dusun" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Dusun</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Kelurahan/Desa
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="village" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Kelurahan/Desa</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Kecamatan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="district" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Kecamatan</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Kabupaten
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="region" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Kabupaten</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Kode Post
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="postal" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Kode Post</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                                <div class="form-group" style="margin-bottom: 5x;">
                                                                                    <label class="control-label col-md-4">Lintang
                                                                                        <span class="required" aria-required="true"> * </span>
                                                                                    </label>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                            <input type="text" class="form-control" id="form_control_1" name="lintang" placeholder="">
                                                                                            <span class="help-block" style="z-index: 10;">Lintang</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group" style="margin-bottom: 5px;">
                                                                                    <label class="control-label col-md-4">Bujur
                                                                                        <span class="required" aria-required="true"> * </span>
                                                                                    </label>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                            <input type="text" class="form-control" id="form_control_1" name="bujur" placeholder="">
                                                                                            <span class="help-block" style="z-index: 10;">Bujur</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-4">Anak Ke
                                                                                        <span class="required" aria-required="true"> * </span>
                                                                                    </label>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                            <input type="number" class="form-control" id="form_control_1" name="child" placeholder="">
                                                                                            <span class="help-block" style="z-index: 10;">Anak Keberapa</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-4">Memiliki KIP
                                                                                        <span class="required" aria-required="true"> * </span>
                                                                                    </label>
                                                                                    <div class="col-md-6">
                                                                                        <div class="md-radio-inline">
                                                                                            <div class="md-radio">
                                                                                                <input type="radio" id="kipyes" name="kip" class="md-radiobtn" value="yes">
                                                                                                <label for="kipyes">
                                                                                                    <span class="inc"></span>
                                                                                                    <span class="check"></span>
                                                                                                    <span class="box"></span> Ya </label>
                                                                                            </div>
                                                                                            <div class="md-radio">
                                                                                                <input type="radio" id="kipno" name="kip" class="md-radiobtn" value="no" checked>
                                                                                                <label for="kipno">
                                                                                                    <span></span>
                                                                                                    <span class="check"></span>
                                                                                                    <span class="box"></span> Tidak </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-4">Tetap Memegang KIP
                                                                                        <span class="required" aria-required="true"> * </span>
                                                                                    </label>
                                                                                    <div class="col-md-6">
                                                                                        <div class="md-radio-inline">
                                                                                            <div class="md-radio">
                                                                                                <input type="radio" id="kipstay" name="keepkip" class="md-radiobtn" value="yes">
                                                                                                <label for="kipstay">
                                                                                                    <span class="inc"></span>
                                                                                                    <span class="check"></span>
                                                                                                    <span class="box"></span> Ya </label>
                                                                                            </div>
                                                                                            <div class="md-radio">
                                                                                                <input type="radio" id="kipunstay" name="keepkip" class="md-radiobtn" value="no">
                                                                                                <label for="kipunstay">
                                                                                                    <span></span>
                                                                                                    <span class="check"></span>
                                                                                                    <span class="box"></span> Tidak </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-4">Alasan Menolak PIP
                                                                                        <span class="required" aria-required="true"> * </span>
                                                                                    </label>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                            <select name="refusepip" class="form-control" id="form_control_1">
                                                                                                <option value="-" selected> - </option>
                                                                                                <option value="Dilarang PEMDA"> Dilarang PEMDA (memiliki bantuan serupa) </option>
                                                                                                <option value="Menolak"> Menolak </option>
                                                                                                <option value="Sudah Mampu"> Sudah Mampu </option>
                                                                                            </select>
                                                                                            <span class="help-block" style="z-index: 10;">Alasan Penolakan</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group" style="margin-bottom: 5px;">
                                                                                    <label class="control-label col-md-4">No. Telpon Rumah
                                                                                        <span class="required" aria-required="true"> * </span>
                                                                                    </label>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                            <input type="text" class="form-control" id="form_control_1" name="housephone">
                                                                                            <span class="help-block" style="z-index: 10;">Nomor Telpon Rumah</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group" style="margin-bottom: 5px;">
                                                                                    <label class="control-label col-md-4">No. HP
                                                                                        <span class="required" aria-required="true"> * </span>
                                                                                    </label>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                            <input type="text" class="form-control" id="form_control_1" name="handheldnumber">
                                                                                            <span class="help-block" style="z-index: 10;">Nomor Telpon Rumah</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group" style="margin-bottom: 5px;">
                                                                                    <label class="control-label col-md-4">Email
                                                                                        <span class="required" aria-required="true"> * </span>
                                                                                    </label>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                            <input type="email" class="form-control" id="form_control_1" name="email" placeholder="">
                                                                                            <span class="help-block" style="z-index: 10;">Email milik peserta atau milik orang tua/wali</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="portlet box grey-gallery">
                                                                        <div class="portlet-title">
                                                                            <div class="caption">
                                                                                <i class="fa fa-address-card"></i>Data Orang Tua / Wali </div>
                                                                        </div>
                                                                        <div class="portlet-body" style="padding-top: 0px">
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <h5 style="color: white; background-color: grey; padding: 5px; 1px;margin-top: 0px"> <span style="color: #e7505a">*</span> Abaikan data Ayah dan Ibu jika tinggal bersama Wali</h5>
                                                                                <label class="control-label col-md-4">Nama Ayah Kandung
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="father" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Nama Ayah Kandung</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">NIK Ayah
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="fathernik" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Nomor Induk Keluarga Ayah</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Tahun Lahir
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="number" class="form-control" id="form_control_1" name="fatheryear" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Tahun Kelahiran Ayah</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Pendidikan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <select name="fatherdegree" class="form-control" id="form_control_1">
                                                                                            <option value="-" selected> - </option>
                                                                                            <option value="Tidak Sekolah"> Tidak Sekolah </option>
                                                                                            <option value="Putus SD"> Putus SD </option>
                                                                                            <option value="SD Sederajat"> SD Sederajat </option>
                                                                                            <option value="SMP Sederajat"> SMP Sederajat </option>
                                                                                            <option value="SMA Sederajat"> SMA Sederajat </option>
                                                                                            <option value="D1"> D1 </option>
                                                                                            <option value="D2"> D2 </option>
                                                                                            <option value="D3"> D3 </option>
                                                                                            <option value="D4/S1"> D4/S1 </option>
                                                                                            <option value="S2"> S2 </option>
                                                                                            <option value="S3"> S3 </option>
                                                                                        </select>
                                                                                        <span class="help-block" style="z-index: 10;">Pendidikan Terakhir Ayah</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Pekerjaan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <select name="fatherjob" class="form-control" id="form_control_1">
                                                                                            <option value="-" selected> - </option>
                                                                                            <option value="Tidak Bekerja"> Tidak Bekerja </option>
                                                                                            <option value="Nelayan"> Nelayan </option>
                                                                                            <option value="Petani"> Petani </option>
                                                                                            <option value="Peternak"> Peternak </option>
                                                                                            <option value="PNS/TNI/POLRI"> PNS/TNI/POLRI </option>
                                                                                            <option value="Karyawan Swasta"> Karyawan Swasta </option>
                                                                                            <option value="Pedagang Kecil"> Pedagang Kecil </option>
                                                                                            <option value="Pedagang Besar"> Pedagang Besar </option>
                                                                                            <option value="Wiraswasta"> Wiraswasta </option>
                                                                                            <option value="Wirausaha"> Wirausaha </option>
                                                                                            <option value="Buruh"> Buruh </option>
                                                                                            <option value="Pensiunan"> Pensiunan </option>
                                                                                        </select>
                                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Ayah</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Penghasilan Bulanan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <select name="fatherincome" class="form-control" id="form_control_1">
                                                                                            <option value="-" selected> - </option>
                                                                                            <option value="Rp. 500.000"> Rp. 500.000 </option>
                                                                                            <option value="Rp. 500.000 - Rp. 999.999"> Rp. 500.000 - Rp. 999.999 </option>
                                                                                            <option value="Rp. 1.0000.0000 - Rp. 1.999.9999"> Rp. 1.0000.0000 - Rp. 1.999.9999 </option>
                                                                                            <option value="Rp. 2.0000.0000 - Rp. 4.999.999"> Rp. 2.0000.0000 - Rp. 4.999.999 </option>
                                                                                            <option value="Rp. 5.000.0000 - Rp. 20.000.000"> Rp. 5.000.0000 - Rp. 20.000.000 </option>
                                                                                            <option value="> Rp. 20.000.000"> > Rp. 20.000.000 </option>
                                                                                            <option value="Tidak Berpenghasilan"> Tidak Berpenghasilan </option>
                                                                                        </select>
                                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Ayah</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Berkebutuhan Khusus
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="fatherdisabled" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang Ayah</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Nama Ibu Kandung
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="mother" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Nama Ibu Kandung</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">NIK Ibu
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="mothernik" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Nomor Induk Keluarga Ibu</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Tahun Lahir
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="number" class="form-control" id="form_control_1" name="motheryear" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Tahun Kelahiran Ibu</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Pendidikan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <select name="motherdegree" class="form-control" id="form_control_1">
                                                                                            <option value="-" selected> - </option>
                                                                                            <option value="Tidak Sekolah"> Tidak Sekolah </option>
                                                                                            <option value="Putus SD"> Putus SD </option>
                                                                                            <option value="SD Sederajat"> SD Sederajat </option>
                                                                                            <option value="SMP Sederajat"> SMP Sederajat </option>
                                                                                            <option value="SMA Sederajat"> SMA Sederajat </option>
                                                                                            <option value="D1"> D1 </option>
                                                                                            <option value="D2"> D2 </option>
                                                                                            <option value="D3"> D3 </option>
                                                                                            <option value="D4/S1"> D4/S1 </option>
                                                                                            <option value="S2"> S2 </option>
                                                                                            <option value="S3"> S3 </option>
                                                                                        </select>
                                                                                        <span class="help-block" style="z-index: 10;">Pendidikan Terakhir Ibu</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Pekerjaan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <select name="motherjob" class="form-control" id="form_control_1">
                                                                                            <option value="-" selected> - </option>
                                                                                            <option value="Tidak Bekerja"> Tidak Bekerja </option>
                                                                                            <option value="Nelayan"> Nelayan </option>
                                                                                            <option value="Petani"> Petani </option>
                                                                                            <option value="Peternak"> Peternak </option>
                                                                                            <option value="PNS/TNI/POLRI"> PNS/TNI/POLRI </option>
                                                                                            <option value="Karyawan Swasta"> Karyawan Swasta </option>
                                                                                            <option value="Pedagang Kecil"> Pedagang Kecil </option>
                                                                                            <option value="Pedagang Besar"> Pedagang Besar </option>
                                                                                            <option value="Wiraswasta"> Wiraswasta </option>
                                                                                            <option value="Wirausaha"> Wirausaha </option>
                                                                                            <option value="Buruh"> Buruh </option>
                                                                                            <option value="Pensiunan"> Pensiunan </option>
                                                                                        </select>
                                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Ibu</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Penghasilan Bulanan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <select name="motherincome" class="form-control" id="form_control_1">
                                                                                            <option value="-" selected> - </option>
                                                                                            <option value="Rp. 500.000"> Rp. 500.000 </option>
                                                                                            <option value="Rp. 500.000 - Rp. 999.999"> Rp. 500.000 - Rp. 999.999 </option>
                                                                                            <option value="Rp. 1.0000.0000 - Rp. 1.999.9999"> Rp. 1.0000.0000 - Rp. 1.999.9999 </option>
                                                                                            <option value="Rp. 2.0000.0000 - Rp. 4.999.999"> Rp. 2.0000.0000 - Rp. 4.999.999 </option>
                                                                                            <option value="Rp. 5.000.0000 - Rp. 20.000.000"> Rp. 5.000.0000 - Rp. 20.000.000 </option>
                                                                                            <option value="> Rp. 20.000.000"> > Rp. 20.000.000 </option>
                                                                                            <option value="Tidak Berpenghasilan"> Tidak Berpenghasilan </option>
                                                                                        </select>
                                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Ibu</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Berkebutuhan Khusus
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="motherdisabled" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang Ibu</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <h5 style="color: white; background-color: grey; padding: 5px; 1px;"> <span style="color: #e7505a">*</span> Abaikan data Wali jika tinggal bersama Orang Tua</h5>
                                                                                <label class="control-label col-md-4">Nama Wali
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="guardian" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Nama Wali</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">NIK Wali
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="guardiannik" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Nomor Induk Keluarga Wali</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Tahun Lahir
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="number" class="form-control" id="form_control_1" name="guardianyear" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Tahun Kelahiran Wali</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Pendidikan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <select name="guardiandegree" class="form-control" id="form_control_1">
                                                                                            <option value="-"> - </option>
                                                                                            <option value="Tidak Sekolah"> Tidak Sekolah </option>
                                                                                            <option value="Putus SD"> Putus SD </option>
                                                                                            <option value="SD Sederajat"> SD Sederajat </option>
                                                                                            <option value="SMP Sederajat"> SMP Sederajat </option>
                                                                                            <option value="SMA Sederajat"> SMA Sederajat </option>
                                                                                            <option value="D1"> D1 </option>
                                                                                            <option value="D2"> D2 </option>
                                                                                            <option value="D3"> D3 </option>
                                                                                            <option value="D4/S1"> D4/S1 </option>
                                                                                            <option value="S2"> S2 </option>
                                                                                            <option value="S3"> S3 </option>
                                                                                        </select>
                                                                                        <span class="help-block" style="z-index: 10;">Pendidikan Terakhir Wali</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Pekerjaan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <select name="guardianjob" class="form-control" id="form_control_1">
                                                                                            <option value="-"> - </option>
                                                                                            <option value="Tidak Bekerja"> Tidak Bekerja </option>
                                                                                            <option value="Nelayan"> Nelayan </option>
                                                                                            <option value="Petani"> Petani </option>
                                                                                            <option value="Peternak"> Peternak </option>
                                                                                            <option value="PNS/TNI/POLRI"> PNS/TNI/POLRI </option>
                                                                                            <option value="Karyawan Swasta"> Karyawan Swasta </option>
                                                                                            <option value="Pedagang Kecil"> Pedagang Kecil </option>
                                                                                            <option value="Pedagang Besar"> Pedagang Besar </option>
                                                                                            <option value="Wiraswasta"> Wiraswasta </option>
                                                                                            <option value="Wirausaha"> Wirausaha </option>
                                                                                            <option value="Buruh"> Buruh </option>
                                                                                            <option value="Pensiunan"> Pensiunan </option>
                                                                                        </select>
                                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Wali</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Penghasilan Bulanan
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <select name="guardianincome" class="form-control" id="form_control_1">
                                                                                            <option value="-"> - </option>
                                                                                            <option value="Rp. 500.000"> Rp. 500.000 </option>
                                                                                            <option value="Rp. 500.000 - Rp. 999.999"> Rp. 500.000 - Rp. 999.999 </option>
                                                                                            <option value="Rp. 1.0000.0000 - Rp. 1.999.9999"> Rp. 1.0000.0000 - Rp. 1.999.9999 </option>
                                                                                            <option value="Rp. 2.0000.0000 - Rp. 4.999.999"> Rp. 2.0000.0000 - Rp. 4.999.999 </option>
                                                                                            <option value="Rp. 5.000.0000 - Rp. 20.000.000"> Rp. 5.000.0000 - Rp. 20.000.000 </option>
                                                                                            <option value="> Rp. 20.000.000"> > Rp. 20.000.000 </option>
                                                                                            <option value="Tidak Berpenghasilan"> Tidak Berpenghasilan </option>
                                                                                        </select>
                                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Wali</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                                <label class="control-label col-md-4">Berkebutuhan Khusus
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                </label>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                                        <input type="text" class="form-control" id="form_control_1" name="guardiandisabled" placeholder="">
                                                                                        <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang Wali</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-offset-4 col-md-12" style="margin-top: 20px;">
                                                                    <a class="btn btn-outline green btn-lg button-next"> Continue
                                                                        <i class="fa fa-angle-right"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="tab2" data-select="2">
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tinggi Badan (cm)
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-2">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="height" placeholder="">
                                                                        <span class="help-block">tinggi badan peserta didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Berat Badan (kg)
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-2">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="weight" placeholder="">
                                                                        <span class="help-block">tinggi badan peserta didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Lingkar Kepala (cm)
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-2">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="headdiameter" placeholder="">
                                                                        <span class="help-block">ukurang lingkar kepala</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jarak tempat tinggal ke sekolah
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="KM" name="range" class="md-radiobtn" value="< 1 KM" checked>
                                                                            <label for="KM">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Kurang dari 1KM</label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="KMS" name="range" class="md-radiobtn" value="> 1 KM">
                                                                            <label for="KMS">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Lebih dari 1KM </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jarak tepatnya
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-2">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="exactrange" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1" style="padding-left: 0px;margin-top: 10px">
                                                                    <span class="meters"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jarak Waktu Rumah ke Sekolah
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-2">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="timerange" placeholder="">
                                                                        <span class="help-block">Waktu tempuh Peserta Didik ke Sekolah. masukan dalam satuan menit</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1" style="padding-left: 0px; margin-left: 0px; margin-top: 10px">
                                                                    <span class="duration">(Menit)</span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jumlah Saudara Kandung
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="siblings" value="0" placeholder="">
                                                                        <span class="help-block">Jumlah saudara kandung peserta didik. isikan 0 jika tidak ada saudara</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jenis Prestasi
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Sains" name="achievement" class="md-radiobtn" value="Sains">
                                                                            <label for="Sains">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Sains </label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Seni" name="achievement" class="md-radiobtn" value="Seni">
                                                                            <label for="Seni">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Seni </label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Olahraga" name="achievement" class="md-radiobtn" value="Olahraga">
                                                                            <label for="Olahraga">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Olahraga </label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Lain-Lain" name="achievement" class="md-radiobtn" value="Lain-Lain">
                                                                            <label for="Lain-Lain">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Lain-Lain </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tingkat Prestasi
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Sekolah" name="achievementlevel" class="md-radiobtn" value="Sekolah">
                                                                            <label for="Sekolah">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Sekolah </label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Kecamatan" name="achievementlevel" class="md-radiobtn" value="Kecamatan">
                                                                            <label for="Kecamatan">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Kecamatan </label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Kabupaten" name="achievementlevel" class="md-radiobtn" value="Kabupaten">
                                                                            <label for="Kabupaten">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Kabupaten </label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Provinsi" name="achievementlevel" class="md-radiobtn" value="Provinsi">
                                                                            <label for="Provinsi">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Provinsi </label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Nasional" name="achievementlevel" class="md-radiobtn" value="Nasional">
                                                                            <label for="Nasional">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Nasional </label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Internasional" name="achievementlevel" class="md-radiobtn" value="Internasional">
                                                                            <label for="Internasional">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Internasional </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama Prestasi
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="ach_name" placeholder="">
                                                                        <span class="help-block">Nama Prestasi yang diraih peserta didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tahun Prestasi
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="ach_year" value="0" placeholder="2010">
                                                                        <span class="help-block">Tahun Prestasi didapat oleh peserta Didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Penyelanggara
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="sponsor" placeholder="">
                                                                        <span class="help-block">Penyelenggara Prestasi yang diraih Peserta Didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Peringkat Prestasi
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="ach_rank" value="0" placeholder="2010">
                                                                        <span class="help-block">Peringkat Prestasi Peserta Didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jenis Beasiswa
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Berprestasi" name="scholarship" class="md-radiobtn" value="Berprestasi">
                                                                            <label for="Berprestasi">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Berprestasi </label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="KurangMampu" name="scholarship" class="md-radiobtn" value="Kurang Mampu">
                                                                            <label for="KurangMampu">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Kurang Mampu </label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Pendidikan" name="scholarship" class="md-radiobtn" value="Pendidikan">
                                                                            <label for="Pendidikan">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Pendidikan </label>
                                                                        </div>
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="Unggulan" name="scholarship" class="md-radiobtn" value="Unggulan">
                                                                            <label for="Unggulan">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Unggulan </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Keterangan Beasiswa
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="scholardesc">
                                                                        <span class="help-block">Keterangan Beasiswa Peserta Didik. dapat diisi dengan nama beasiswa, atau keterangan yang relevan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tahun Mulai
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="scholarstart" placeholder="ex. <?= date('Y'); ?>">
                                                                        <span class="help-block">Tahun Mulai Beasiswa</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tahun Selesai
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="scholarfinish" placeholder="ex. <?= date('Y') + 3; ?>">
                                                                        <span class="help-block">Tahun Beasiswa Berakhir</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jenis Kesejahteraan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <select name="prosperity" class="form-control" id="form_control_1">
                                                                            <option value="" selected> - </option>
                                                                            <option value="PKH">PKH</option>
                                                                            <option value="PIP">PIP</option>
                                                                            <option value="Kartu Perlindungan Sosial">Kartu Perlindungan Sosial</option>
                                                                            <option value="Kartu Keluarga Sejahtera">Kartu Keluarga Sejahtera</option>
                                                                            <option value="Kartu Kesehatan">Kartu Kesehatan</option>
                                                                        </select>
                                                                        <span class="help-block" style="z-index: 10;">Kesejahteraan Peserta Didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. Kartu
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="prospernumber">
                                                                        <span class="help-block">No. Kartu yang bersangkutan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama di Kartu
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="prospernametag">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-offset-3 col-md-9" style="margin-top: 20px;">
                                                                    <a class="btn default btn-lg button-previous button-back">
                                                                        <i class="fa fa-angle-left"></i> Back </a>
                                                                    <a class="btn btn-outline btn-lg green button-next"> Continue
                                                                        <i class="fa fa-angle-right"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="tab3" data-select="3">
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Kompetensi Keahlian (Khusus SMK)
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="competition">
                                                                        <span class="help-block">Kompetensi Keahlian (Khusus SMK)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;" style="display: none;">
                                                                <label class="control-label col-md-4">NIS/Nomor Induk
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="nis">
                                                                        <span class="help-block">Nomor Induk peserta didik sesuai yang tercantum pada buku induk</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jenjang Tujuan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <select name="applying" class="form-control" id="form_control_1">
                                                                            <?php foreach($applying as $row) : ?>
                                                                                <option value="<?= $row->School_Desc ?>"> <?= $row->SchoolName ?> </option>
                                                                            <?php endforeach;?>
                                                                        </select>
                                                                        <span class="help-block" style="z-index: 10;">Agama</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Sekolah Asal
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="previousschool">
                                                                        <span class="help-block">Nama Sekolah Asal Peserta Didik Baru/Pindahan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. Peserta UN jenjang sebelumnya
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="unnumber">
                                                                        <span class="help-block">
                                                                            Nomor peserta ujian saat peserta didik masih di jenjang sebelumnya, berformat (x-xx-xx-xx-xxx-xxx-x).<br>
                                                                            untuk peserta didik WNA, diisi dengan no Luar Negeri.
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. Seri Ijazah
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="diploma">
                                                                        <span class="help-block">
                                                                            Nomor seri ijazah peserta didik pada jenjang sebelumnya
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. SKHUN Jenjang Sebelumnya
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="skhun">
                                                                        <span class="help-block">
                                                                            Nomor seri ijazah peserta didik pada jenjang sebelumnya
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">File Ijasah
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4" id="col_diplomafile">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="file" name="diplomafile" id="diplomafile" class="dropify" data-show-loader="false" data-height="200" data-allowed-file-extensions="jpg jpeg png" data-max-file-size="1M">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">File Akte Kelahiran
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4" id="col_birthcertfile">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="file" name="birthcertfile" id="birthcertfile" class="dropify" data-show-loader="false" data-height="200" data-allowed-file-extensions="jpg jpeg png" data-max-file-size="1M">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">File KK
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4" id="col_kkfile">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="file" name="kkfile" id="kkfile" class="dropify" data-show-loader="false" data-height="200" data-allowed-file-extensions="jpg jpeg png" data-max-file-size="1M">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">File Foto
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4" id="col_photo">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="file" name="photo" id="photo" class="dropify" data-show-loader="false" data-height="200" data-allowed-file-extensions="jpg jpeg png" data-max-file-size="1M">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-offset-3 col-md-9" style="margin-top: 20px;">
                                                                    <a class="btn default button-previous btn-lg button-back">
                                                                        <i class="fa fa-angle-left"></i> Back </a>
                                                                    <a class="btn btn-outline green btn-lg button-next"> Continue
                                                                        <i class="fa fa-angle-right"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="tab4" data-select="4">
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama Depan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_fname" placeholder="" value="" disabled>
                                                                        <span class="help-block">masukan nama depan...</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama Tengah
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_mname" placeholder="" value="" disabled>
                                                                        <span class="help-block">masukan nama tengah...</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama Belakang
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_lname" placeholder="" disabled>
                                                                        <span class="help-block">masukan nama belakang</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama Panggilan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_nname" placeholder="" disabled>
                                                                        <span class="help-block">masukan nama panggilan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jenis Kelamin
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="male" name="confirm_gender" class="md-radiobtn" value="Laki-Laki" disabled>
                                                                            <label for="male">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Laki-Laki</label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="female" name="confirm_gender" class="md-radiobtn" value="Perempuan" disabled>
                                                                            <label for="female">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Perempuan </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">NISN
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_nisn" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10">Nomor Induk Siswa Nasional Peserta Didik <br>(jika ada).</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">NIK/KITAS (untuk WNA)
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_nik" placeholder="" disabled>
                                                                        <p class="help-block" style="z-index: 10;">Nomor Induk Kependudukan. <br>Kartu Izin Tinggal Terbatas (untuk WNA).</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. KK
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_kk" placeholder="" disabled>
                                                                        <p class="help-block" style="z-index: 10;">Nomor Kartu Keluarga.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tanggal Lahir
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_tgllhr" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Tanggal Kelahiran</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tempat Lahir
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_tmplhr" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Tempat Kelahiran.</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. Registrasi Akta Lahir
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_akta" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Nomor Registrasi Akta Lahir</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Agama/Kepercayaan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_religion" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Agama</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Kewarganegaraan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_country" class="form-control" id="form_control_1" value="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Kewarganegaraan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Berkebutuhan Khusus
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_disabled" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang oleh peserta didik.</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Alamat
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_address" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Alamat Peserta Didik.</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">RT
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_rt" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">RT</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">RW
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_rw" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">RW</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama Dusun
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_dusun" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Dusun</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Kelurahan/Desa
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_village" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Kelurahan/Desa</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Kecamatan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_district" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Kecamatan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Kabupaten
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_region" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Kabupaten</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Kode Post
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_postal" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Kode Post</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tempat Tinggal
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_livewith" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Tempat Tinggal</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Moda Transportasi
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_transport" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Moda Transportasi</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5x;">
                                                                <label class="control-label col-md-4">Lintang
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_lintang" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Lintang</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Bujur
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_bujur" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Bujur</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Anak Ke
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_child" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Anak Keberapa</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Memiliki KIP
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="kipyes" name="confirm_kip" class="md-radiobtn" value="yes" disabled>
                                                                            <label for="kipyes">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Ya </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="kipno" name="confirm_kip" class="md-radiobtn" value="no" disabled>
                                                                            <label for="kipno">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Tidak </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Tetap Memegang KIP
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="kipstay" name="confirm_keepkip" class="md-radiobtn" value="yes" disabled>
                                                                            <label for="kipstay">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Ya </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="kipunstay" name="confirm_keepkip" class="md-radiobtn" value="no" disabled>
                                                                            <label for="kipunstay">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Tidak </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Alasan Menolak PIP
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_refusepip" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Alasan Penolakan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. Telpon Rumah
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_housephone" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Nomor Telpon Rumah</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. HP
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_handheldnumber" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Nomor Telpon Rumah</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Email
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="email" class="form-control" id="form_control_1" name="confirm_email" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Email milik peserta atau milik orang tua/wali</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama Ayah Kandung
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_father" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Nama Ayah Kandung</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">NIK Ayah
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_fathernik" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Nomor Induk Keluarga Ayah</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tahun Lahir
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_fatheryear" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Tahun Kelahiran Ayah</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Pendidikan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_fatherdegree" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Pendidikan Terakhir Ayah</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Pekerjaan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_fatherjob" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Ayah</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Penghasilan Bulanan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_fatherincome" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Ayah</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Berkebutuhan Khusus
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_fatherdisabled" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang Ayah</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama Ibu Kandung
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_mother" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Nama Ibu Kandung</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">NIK Ibu
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_mothernik" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Nomor Induk Keluarga Ibu</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tahun Lahir
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_motheryear" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Tahun Kelahiran Ibu</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Pendidikan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_motherdegree" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Pendidikan Terakhir Ibu</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Pekerjaan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_motherjob" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Ibu</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Penghasilan Bulanan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_motherincome" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Ibu</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Berkebutuhan Khusus
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_motherdisabled" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang Ibu</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama Wali
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_guardian" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Nama Wali</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">NIK Wali
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_guardiannik" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Nomor Induk Keluarga Wali</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tahun Lahir
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_guardianyear" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Tahun Kelahiran Wali</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Pendidikan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_guardiandegree" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Pendidikan Terakhir Wali</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Pekerjaan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_guardianjob" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Wali</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Penghasilan Bulanan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_guardianincome" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Pekerjaan Wali</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Berkebutuhan Khusus
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_guardiandisabled" placeholder="" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang Wali</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tinggi Badan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_height" placeholder="" disabled>
                                                                        <span class="help-block">tinggi badan peserta didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Berat Badan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_weight" placeholder="" disabled>
                                                                        <span class="help-block">tinggi badan peserta didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Lingkar Kepala
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_headdiameter" placeholder="" disabled>
                                                                        <span class="help-block">ukurang lingkar kepala</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jarak tempat tinggal ke sekolah
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="KM" name="confirm_range" class="md-radiobtn" value="< 1 KM" disabled>
                                                                            <label for="KM">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Kurang dari 1KM</label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="KMS" name="confirm_range" class="md-radiobtn" value="> 1 KM" disabled>
                                                                            <label for="KMS">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Lebih dari 1KM </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jarak tepatnya
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_exactrange" placeholder="" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jarak Waktu Rumah ke Sekolah
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_timerange" placeholder="" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jumlah Saudara Kandung
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_siblings" value="0" placeholder="" disabled>
                                                                        <span class="help-block">Jumlah saudara kandung peserta didik. isikan 0 jika tidak ada saudara</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jenis Prestasi
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Sains" name="confirm_achievement" class="md-radiobtn" value="Sains" disabled>
                                                                            <label for="Sains">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Sains </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Seni" name="confirm_achievement" class="md-radiobtn" value="Seni" disabled>
                                                                            <label for="Seni">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Seni </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Olahraga" name="confirm_achievement" class="md-radiobtn" value="Olahraga" disabled>
                                                                            <label for="Olahraga">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Olahraga </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Lain-Lain" name="confirm_achievement" class="md-radiobtn" value="Lain-Lain" disabled>
                                                                            <label for="Lain-Lain">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Lain-Lain </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tingkat Prestasi
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Sekolah" name="confirm_achievementlevel" class="md-radiobtn" value="Sekolah" disabled>
                                                                            <label for="Sekolah">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Sekolah </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Kecamatan" name="confirm_achievementlevel" class="md-radiobtn" value="Kecamatan" disabled>
                                                                            <label for="Kecamatan">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Kecamatan </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Kabupaten" name="confirm_achievementlevel" class="md-radiobtn" value="Kabupaten" disabled>
                                                                            <label for="Kabupaten">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Kabupaten </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Provinsi" name="confirm_achievementlevel" class="md-radiobtn" value="Provinsi" disabled>
                                                                            <label for="Provinsi">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Provinsi </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Nasional" name="confirm_achievementlevel" class="md-radiobtn" value="Nasional" disabled>
                                                                            <label for="Nasional">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Nasional </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Internasional" name="confirm_achievementlevel" class="md-radiobtn" value="Internasional" disabled>
                                                                            <label for="Internasional">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Internasional </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama Prestasi
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_ach_name" placeholder="" disabled>
                                                                        <span class="help-block">Nama Prestasi yang diraih peserta didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tahun Prestasi
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_ach_year" value="0" placeholder="2010" disabled>
                                                                        <span class="help-block">Tahun Prestasi didapat oleh peserta Didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Penyelanggara
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_sponsor" placeholder="" disabled>
                                                                        <span class="help-block">Penyelenggara Prestasi yang diraih Peserta Didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Peringkat Prestasi
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_ach_year" value="0" placeholder="2010" disabled>
                                                                        <span class="help-block">Peringkat Prestasi Peserta Didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jenis Beasiswa
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Berprestasi" name="confirm_scholarship" class="md-radiobtn" value="Berprestasi" disabled>
                                                                            <label for="Berprestasi">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Berprestasi </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="KurangMampu" name="confirm_scholarship" class="md-radiobtn" value="Kurang Mampu" disabled>
                                                                            <label for="KurangMampu">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Kurang Mampu </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Pendidikan" name="confirm_scholarship" class="md-radiobtn" value="Pendidikan" disabled>
                                                                            <label for="Pendidikan">
                                                                                <span class="inc"></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Pendidikan </label>
                                                                        </div>
                                                                        <div class="md-radio has-success">
                                                                            <input type="radio" id="Unggulan" name="confirm_scholarship" class="md-radiobtn" value="Unggulan" disabled>
                                                                            <label for="Unggulan">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> Unggulan </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Keterangan Beasiswa
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_scholardesc" disabled>
                                                                        <span class="help-block">Keterangan Beasiswa Peserta Didik. dapat diisi dengan nama beasiswa, atau keterangan yang relevan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tahun Mulai
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_scholarstart" placeholder="ex. <?= date('Y'); ?>" disabled>
                                                                        <span class="help-block">Tahun Mulai Beasiswa</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Tahun Selesai
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="number" class="form-control" id="form_control_1" name="confirm_scholarfinish" placeholder="ex. <?= date('Y') + 3; ?>" disabled>
                                                                        <span class="help-block">Tahun Beasiswa Berakhir</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jenis Kesejahteraan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input name="confirm_prosperity" class="form-control" id="form_control_1" disabled>
                                                                        <span class="help-block" style="z-index: 10;">Kesejahteraan Peserta Didik</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. Kartu
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_prospernumber" disabled>
                                                                        <span class="help-block">No. Kartu yang bersangkutan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Nama di Kartu
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_prospernametag" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Kompetensi Keahlian (Khusus SMK)
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_competition" disabled>
                                                                        <span class="help-block">Kompetensi Keahlian (Khusus SMK)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">NIS/Nomor Induk
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_nis" disabled>
                                                                        <span class="help-block">Nomor Induk peserta didik sesuai yang terantum pada buku induk</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Jenjang Tujuan
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                            <input type="text" class="form-control" id="form_control_1" name="confirm_applying" disabled>
                                                                            <span class="help-block">Jenjang Tujuan</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">Sekolah Asal
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_previousschool" disabled>
                                                                        <span class="help-block">Nama Sekolah Asal Peserta Didik Baru/Pindahan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. Peserta UN jenjang sebelumnya
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_unnumber" disabled>
                                                                        <span class="help-block">
                                                                            Nomor peserta ujian saat peserta didik masih di jenjang sebelumnya, berformat (x-xx-xx-xx-xxx-xxx-x).<br>
                                                                            untuk peserta didik WNA, diisi dengan no Luar Negeri.
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. Seri Ijazah
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_diploma" disabled>
                                                                        <span class="help-block">
                                                                            Nomor seri ijazah peserta didik pada jenjang sebelumnya
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 5px;">
                                                                <label class="control-label col-md-4">No. SKHUN Jenjang Sebelumnya
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                        <input type="text" class="form-control" id="form_control_1" name="confirm_skhun" disabled>
                                                                        <span class="help-block">
                                                                            Nomor seri ijazah peserta didik pada jenjang sebelumnya
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-offset-3 col-md-9" style="margin-top: 20px;">
                                                                    <a class="btn default button-previous btn-lg button-back">
                                                                        <i class="fa fa-angle-left"></i> Back </a>
                                                                    <a class="btn green button-submit btn-lg"> Submit
                                                                        <i class="fa fa-check"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SIDEBAR CONTENT LAYOUT -->
            </div>
            <!-- BEGIN FOOTER -->
            <p class="copyright"> 2016 &copy; Metronic Theme By
                <a target="_blank" href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
            </p>
            <a href="#index" class="go2top">
                <i class="icon-arrow-up"></i>
            </a>
            <!-- END FOOTER -->
        </div>
    </div>
    <!-- END CONTAINER -->
    <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="<?= base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="<?= base_url() ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->

    <!-- CUSTOM PLUGIN -->
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/DataTables/datatables.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/daterangepicker-master/daterangepicker.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/underscore-master/underscore-min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/global/plugins/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/RobinHerbots-Inputmask/dist/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/CUSTOM-PLUGINS/RobinHerbots-Inputmask/dist/bindings/inputmask.binding.js" type="text/javascript"></script>
    <script src="<?=base_url('assets')?>/dropify-upload/js/dropify.js" type="text/javascript"></script>
    <script>
        var BASE_URL = '<?= base_url() ?>'
    </script>
    <script src="<?= base_url() ?>assets/CUSTOMS/new_enroll.js" type="text/javascript"></script>
</body>

</html>