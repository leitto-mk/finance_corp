<?php $this->load->view('_partials/personal_header'); ?>
<!-- BEGIN CONTAINER -->
<div class="page-container page-content-inner page-container-bg-solid">
    <!-- BEGIN BREADCRUMBS -->
    <!-- Remove "hide" class from "breadcrumbs hide" DIV and "margin-top-30" class from below "container-fluid container-lf-space margin-top-30" DIV in order to use the page breadcrumbs -->
    <div class="breadcrumbs hide">
        <div class="container-fluid">
            <h2 class="breadcrumbs-title">Dashboard</h2>
            <ol class="breadcrumbs-list">
                <li>
                    <a class="breadcrumbs-item-link" href="#">Home</a>
                </li>
                <li>
                    <a class="breadcrumbs-item-link" href="#">Features</a>
                </li>
                <li>
                    <a class="breadcrumbs-item-link" href="#">Dashboard</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- END BREADCRUMBS -->
    <!-- BEGIN CONTENT -->
    <div class="container-fluid container-lf-space margin-top-30">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row widget-bg-color-white no-space margin-bottom-20">
            <div class="col-md-3 col-sm-6 no-space">
                <div class="portfolio-content portfolio-1">
                    <div id="js-grid-juicy-projects" class="cbpnay">
                        <div class="cbp-item Anak">
                            <center> <img class="img-responsive thumbnail img-circle " style="width: 35%" src="<?= base_url('assets/photos/teachers/' . $photo); ?>" alt=""></center>
                            <div class="cbp-l-grid-projects-title text-center">
                                <span><?= strtoupper("$fname $lname, ") . "$degree" ?></span>
                            </div>
                            <div class="cbp-l-grid-projects-desc uppercase text-center">
                                <span class="sbold"><?= "$id - $jobdesc" ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 no-space">
                <div class="widget-subscribe">
                    <span class="widget-subscribe-no">1</span>
                    <h2 class="widget-subscribe-title widget-title-color-gray-dark text-uppercase">Profile
                        <br /> </h2>
                    <p class="widget-subscribe-subtitle widget-title-color-dark-light">Informasi pesonal data guru
                        <a data-toggle="modal" id="toggle_modal" class="widget-subscribe-subtitle-link" href="#full">full details...</a>
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 no-space">
                <div class="widget-subscribe widget-subscribe-border">
                    <span class="widget-subscribe-no">2</span>
                    <h2 class="widget-subscribe-title widget-title-color-gray-dark text-uppercase">AKADEMIK
                        <br /> </h2>
                    <p class="widget-subscribe-subtitle widget-title-color-dark-light">Informasi record dan Penilaian Akademik Siswa, mencakup Jadwal Pelajaran, Record Grade Siswa dan Absensi
                        <a data-toggle="modal" id="toggle_modal" class="widget-subscribe-subtitle-link" href="#full2">full details...</a>
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 no-space">
                <div class="widget-subscribe widget-subscribe-border-top">
                    <span class="widget-subscribe-no">3</span>
                    <h2 class="widget-subscribe-title widget-title-color-gray-dark text-uppercase">FINANCE
                        <br /></h2>
                    <p class="widget-subscribe-subtitle widget-title-color-dark-light">Data Finansial
                        <a class="widget-subscribe-subtitle-link" href="#">full details...</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="row widget-row">
            <div class="col-md-4 col-sm-6 col-xs-12 margin-bottom-20">
                <!-- BEGIN WIDGET TAB -->
                <div class="widget-bg-color-white widget-tab tabbable tabbable-tabdrop">
                    <ul class="nav nav-tabs">
                        <li class="disable" style="margin-top: 12px ">
                            <h4><b>JADWAL MENGAJAR</b></h4>
                        </li>
                        &nbsp;
                        <li class="active">
                            <a href="#senin" data-toggle="tab"> Senin</a>
                        </li>
                        <li>
                            <a href="#selasa" data-toggle="tab"> Selasa </a>
                        </li>
                        <li>
                            <a href="#rabu" data-toggle="tab"> Rabu </a>
                        </li>
                        <li>
                            <a href="#kamis" data-toggle="tab"> Kamis </a>
                        </li>
                        <li>
                            <a href="#jumat" data-toggle="tab"> Jumat </a>
                        </li>

                    </ul>

                    <div class="tab-content scroller" style="height: 527px;" data-always-visible="1" data-handle-color="#D7DCE2">
                        <div class="tab-pane fade active in" id="senin">
                            <?php foreach ($schedule as $row) : ?>
                                <?php if ($row->Days == 'Senin') : ?>
                                    <div class="widget-news margin-bottom-20">
                                        <img class="widget-news-left-elem" src="<?php echo base_url(); ?>assets/layouts/layout7/img/03.jpg" alt="">
                                        <div class="widget-news-right-body">
                                            <h3 class="widget-news-right-body-title"><?= $row->SubjName ?>
                                                <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                            </h3>
                                            <p>Kelas: <?= $row->RoomDesc ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="tab-pane fade" id="selasa">
                            <?php foreach ($schedule as $row) : ?>
                                <?php if ($row->Days == 'Selasa') : ?>
                                    <div class="widget-news margin-bottom-20">
                                        <img class="widget-news-left-elem" src="<?php echo base_url(); ?>assets/layouts/layout7/img/03.jpg" alt="">
                                        <div class="widget-news-right-body">
                                            <h3 class="widget-news-right-body-title"><?= $row->SubjName ?>
                                                <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                            </h3>
                                            <p>Kelas: <?= $row->RoomDesc ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="tab-pane fade" id="rabu">
                            <?php foreach ($schedule as $row) : ?>
                                <?php if ($row->Days == 'Rabu') : ?>
                                    <div class="widget-news margin-bottom-20">
                                        <img class="widget-news-left-elem" src="<?php echo base_url(); ?>assets/layouts/layout7/img/03.jpg" alt="">
                                        <div class="widget-news-right-body">
                                            <h3 class="widget-news-right-body-title"><?= $row->SubjName ?>
                                                <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                            </h3>
                                            <p>Kelas: <?= $row->RoomDesc ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="tab-pane fade" id="kamis">
                            <?php foreach ($schedule as $row) : ?>
                                <?php if ($row->Days == 'Kamis') : ?>
                                    <div class="widget-news margin-bottom-20">
                                        <img class="widget-news-left-elem" src="<?php echo base_url(); ?>assets/layouts/layout7/img/03.jpg" alt="">
                                        <div class="widget-news-right-body">
                                            <h3 class="widget-news-right-body-title"><?= $row->SubjName ?>
                                                <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                            </h3>
                                            <p>Kelas: <?= $row->RoomDesc ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="tab-pane fade" id="jumat">
                            <?php foreach ($schedule as $row) : ?>
                                <?php if ($row->Days == 'Jumat') : ?>
                                    <div class="widget-news margin-bottom-20">
                                        <img class="widget-news-left-elem" src="<?php echo base_url(); ?>assets/layouts/layout7/img/03.jpg" alt="">
                                        <div class="widget-news-right-body">
                                            <h3 class="widget-news-right-body-title"><?= $row->SubjName ?>
                                                <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                            </h3>
                                            <p>Kelas: <?= $row->RoomDesc ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET TAB -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 margin-bottom-20">
                <div class="portlet light" style="height: 590px">
                    <div class="portlet-title" style="margin-bottom: 0px;">
                        <div class="caption">
                            <span class="caption-subject bold uppercase" style="color: #293239;"><i></i>INPUT NILAI HARIAN</span>
                        </div>
                    </div>
                    <form role="form">
                        <div class="form-body">
                            <div class="form-group">
                                <label>KELAS</label>
                                <select class="form-control compact_rooms" id="grade_rooms_compact" style="width: 100%">
                                    <?php if (!empty($rooms)) : ?>
                                        <?php foreach ($rooms as $row) : ?>
                                            <option class="sbold" data-cls="<?= $row->ClassDesc ?>" value="<?= $row->RoomDesc ?>">
                                                <?= $row->RoomDesc ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value=""> No Room is/was taught at this period </option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>NAMA SISWA</label>
                                <select class="form-control selectpicker compact_students" id="grade_student" data-live-search="true" data-size="8">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>MATA PELAJARAN</label>
                                <select class="form-control" id="grade_subj_compact">
                                    <?php if (!empty($taught)) : ?>
                                        <?php foreach ($taught as $row) : ?>
                                            <option class="sbold" value="<?= $row->SubjName ?>">
                                                <?= $row->SubjName ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value=""> No Subject is/was taught at this period </option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label>KD</label>
                                        <select class="bs-select form-control" id="grade_type_compact">
                                            <optgroup label="Pengetahuan">
                                            </optgroup>
                                            <optgroup label="Keterampilan">
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>KATEGORI</label>
                                        <select class="form-control" id="grade_cat_compact">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input" style="margin-top: 30px">
                                <input type="number" class="form-control input-lg" id="input_grade_compact" min="0" max="100">
                                <label>INPUT NILAI</label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-sm-12" style="margin-top: 40px">
                                    <div class="text-center">
                                        <button type="submit" id="submit_grade_compact" class="btn blue">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 margin-bottom-20">
                <!-- BEGIN WIDGET PROGRESS -->
                <div class="portlet light" style="height: 590px">
                    <div class="portlet-title" style="margin-bottom: 0px;">
                        <div class="caption">
                            <span class="caption-subject bold uppercase" style="color: #293239;"><i></i>INPUT ABSENT</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-body">
                            <div class="form-group" style="margin-top: 7px">
                                <label>PILIH KELAS</label>
                                <select class="form-control compact_rooms" id="attd_rooms_compact" style="width: 100%">
                                    <?php if (!empty($rooms)) : ?>
                                        <?php foreach ($rooms as $row) : ?>
                                            <option class="sbold" value="<?= $row->RoomDesc ?>">
                                                <?= $row->RoomDesc ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value=""> No Room is/was taught at this period </option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-grop">
                                <label>NAMA SISWA</label>
                                <select class="form-control selectpicker compact_students" id="attd_student" data-live-search="true" data-size="8">
                                </select>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label> ALASAN </label>
                                <div class="md-radio-inline">
                                    <div class="md-radio" style="margin-top: 10px;">
                                        <input type="radio" id="sakit" name="absent_reason" class="md-radiobtn" value="Sick">
                                        <label for="sakit" style="color: #333">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Sakit
                                        </label>
                                    </div>
                                    <div class="md-radio" style="margin-top: 10px;">
                                        <input type="radio" id="izin" name="absent_reason" class="md-radiobtn" value="On Permit">
                                        <label for="izin" style="color: #333">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Izin
                                        </label>
                                    </div>
                                    <div class="md-radio" style="margin-top: 10px;">
                                        <input type="radio" id="alpha" name="absent_reason" class="md-radiobtn" value="Absent">
                                        <label for="alpha" style="color: #333">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Alpa
                                        </label>
                                    </div>
                                    <div class="md-radio" style="margin-top: 10px;">
                                        <input type="radio" id="bolos" name="absent_reason" class="md-radiobtn" value="Truant">
                                        <label for="bolos" style="color: #333">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Bolos
                                        </label>
                                    </div>
                                    <div class="md-radio" style="margin-top: 10px;">
                                        <input type="radio" id="terlambat" name="absent_reason" class="md-radiobtn" value="Late">
                                        <label for="terlambat" style="color: #333">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Terlambat
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="specific_attd_compact" hidden>
                                <div class="form-group">
                                    <label> MATA PELAJARAN </label>
                                    <select class="form-control abs_subj" id="attd_subj_compact">
                                        <?php if (!empty($taught)) : ?>
                                            <?php foreach ($taught as $row) : ?>
                                                <option class="sbold" value="<?= $row->SubjName ?>">
                                                    <?= $row->SubjName ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value=""> No Subject is/was taught at this period </option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label> WAKTU </label>
                                    <div class="input-group">
                                        <input type="text" name="time_abs" id="attd_hour_compact" class="form-control timepicker timepicker-24">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-clock-o"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> TANGGAL </label>
                                <div class="input-group input-medium date date-picker" data-date="<?= date('d-M-Y') ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input type="text" name="date_abs_compact" id="attd_absent_compact" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn blue fixed-bottom" id="attd_submit_compact" style="float: right;">Submit</button>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET PROGRESS -->
            </div>
        </div>
        <div class="row">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Grade Siswa</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="student_reports">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Room</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Recap Mid-Semester Siswa</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="full_mid_recap">
                        <thead>
                            <tr>
                                <th class="all">No</th>
                                <th class="all">NIS</th>
                                <th class="all">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner container-fluid container-lf-space">
        <p class="page-footer-copyright"> <?= date('Y'); ?> ABase Company &nbsp;|&nbsp;
            <a target="_blank" href="http://abase.id">ABASE</a>
            <!-- <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a> -->
        </p>
    </div>
    <div class="go2top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->

<!--=================================================== MODAL PROFILE =======================================================-->
<div class="modal fade in full" id="full" tabindex="-1" role="dialog" aria-hidden="true" style="display: hidden;">
    <div class="modal-dialog modal-full" style="width: 95%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title uppercase">Profile: <span class="sbold"><?= "$fname $lname" ?></span> </h4>
            </div>
            <div class="modal-body">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#profile" data-toggle="tab" aria-expanded="true"> Profile </a>
                        </li>
                        <li class="">
                            <a href="#account" data-toggle="tab" aria-expanded="false"> Change Password </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="profile-sidebar">

                                        <!-- PORTLET MAIN -->
                                        <div class="portlet light profile-sidebar-portlet">

                                            <div class="profile-userpic" style="margin: auto;">
                                                <img src="<?= base_url('assets/photos/teachers/') . $photo ?>" class="img-responsive thumbnail img-circle" style="max-width: 100%;">
                                            </div>

                                            <br>

                                            <!-- SIDEBAR USER TITLE -->
                                            <div class="profile-usertitle text-center">
                                                <span class="caption-subject font-blue bold"><?= "$fname $lname, $degree" ?></span>
                                                <br>
                                                <br>
                                                <div class="text-uppercase sbold"> <?= $status ?> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="portlet light portlet-fit ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-user font-red font-red"></i>
                                                            <span class="caption-subject font-red sbold uppercase">Biodata</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-scrollable table-scrollable-borderless">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase" width="30%"> FullName </th>
                                                                        <td> <?= "$fname $lname, $degree" ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase" width="30%"> Gender </th>
                                                                        <td> <?= $profile->Gender ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase" width="30%"> Date of Birth </th>
                                                                        <td> <?= $profile->DateofBirth ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase" width="30%"> Place of Birth </th>
                                                                        <td> <?= $profile->PointofBirth ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase" width="30%"> Age </th>
                                                                        <?php
                                                                        $age = date_diff(date_create('1970-02-01'), date_create('today'))->y; ?>
                                                                        <td> <?= $age ?> </td>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: -40px;">
                                                <div class="portlet light portlet-fit ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-user font-red font-red"></i>
                                                            <span class="caption-subject font-red sbold uppercase">Address/Contact</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-scrollable table-scrollable-borderless">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Alamat </th>
                                                                        <td> <?= $profile->Address ?></td>
                                                                        <th class="uppercase"> Provinsi </th>
                                                                        <td> <?= $profile->Province ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Kecamatan </th>
                                                                        <td> <?= $profile->District ?> </td>
                                                                        <th class="uppercase"> Negara </th>
                                                                        <td> <?= $profile->Country ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Kabupaten </th>
                                                                        <td> <?= $profile->Region ?> </td>
                                                                        <th class="uppercase"> Email </th>
                                                                        <td> <?= $profile->Email ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Kota </th>
                                                                        <td> <?= $profile->City ?> </td>
                                                                        <th class="uppercase"> Telp </th>
                                                                        <td> <?= $profile->Phone ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr></tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="portlet light portlet-fit ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-user font-red font-red"></i>
                                                            <span class="caption-subject font-red sbold uppercase"> Teacher's Detail </span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-scrollable table-scrollable-borderless">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> ID </th>
                                                                        <td class="sbold"> <?= $profile->IDNumber ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Personal ID </th>
                                                                        <td> <?= $profile->PersonalID ?></td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Occupation </th>
                                                                        <td> <?= $profile->Occupation ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Job Description </th>
                                                                        <td> <?= $profile->JobDesc ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Honorer </th>
                                                                        <td> <?= $profile->Honorer ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Employee Type </th>
                                                                        <td> <?= $profile->Emp_Type ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Teaches </th>
                                                                        <td> <?= $profile->SubjectTeach ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Homeroom </th>
                                                                        <td> <?= $profile->Homeroom ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Last Education </th>
                                                                        <td> <?= $profile->LastEducation ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Year Started </th>
                                                                        <td> <?= $profile->YearStarts ?> </td>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="uppercase"> Status Perkawinan </th>
                                                                        <td> <?= $profile->MaritalStatus ?> </td>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="account">
                            <div class="form-group">
                                <label>Current Password</label>
                                <div class="input-icon right">
                                    <i class="fa fa-user font-blue"></i>
                                    <input type="password" class="form-control input-circle password" name="oldpass" id="oldpass"> </div>
                                <label>New Password</label>
                                <div class="input-icon right">
                                    <i class="fa fa-user font-red"></i>
                                    <input type="password" class="form-control input-circle password" name="newpass" id="newpass"> </div>
                                <label>Re-type New Password</label>
                                <div class="input-icon right">
                                    <i class="fa fa-user font-yellow"></i>
                                    <input type="password" class="form-control input-circle password" name="renewpass" id="renewpass"> </div>
                                <div style="margin-top: 25px;">
                                    <button class="btn green btn-circle" id="submit_pass">Update</button>
                                    <button class="btn red btn-circle" id="cancel_pass" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="control-label">Current Password</label>
                                <input type="password" class="form-control password" name="oldpass" id="oldpass">
                            </div>
                            <div class="form-group">
                                <label class="control-label">New Password</label>
                                <input type="password" class="form-control password" name="newpass" id="newpass">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Re-type New Password</label>
                                <input type="password" class="form-control password" name="renewpass" id="renewpass">
                            </div>
                            <div class="margin-top-10">
                                <button class="btn green" id="submit_pass">Update</button>
                                <button class="btn red" id="cancel_pass">Cancel</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal" style="float: right; margin-right: 15px">Close</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!--=================================================== MODAL ACADEMIC =======================================================-->
<div class="modal fade in full2" id="full2" tabindex="-1" role="dialog" aria-hidden="true" style="display: hidden;">
    <div class="modal-dialog modal-full" style="width: 96%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">AKADEMIK</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <select class="form-control selected_period" id="form_control_1">
                                <?php if (!empty($period)) : ?>
                                    <?php foreach ($period as $row) : ?>
                                        <option class="sbold" data-sem="<?= $row['Semester'] ?>" data-period="<?= $row['schoolyear'] ?>">
                                            Semester <?= ($row['Semester'] == 1 ? 'Ganjil&nbsp;' : 'Genap') . ' - ' . $row['schoolyear']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option value=""> Not Available </option>
                                <?php endif; ?>
                            </select>
                            <label for="form_control_1">Select Semester</label>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabbable-custom" style="margin-top: 15px">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#schedule" data-toggle="tab" aria-expanded="true"> Schedule </a>
                                </li>
                                <li class="">
                                    <a href="#grades" data-toggle="tab" aria-expanded="false"> Student Grades </a>
                                </li>
                                <li class="">
                                    <a href="#absent" data-toggle="tab" aria-expanded="false"> Absence </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="schedule">
                                    <div class="portlet light portlet-fit">
                                        <div class="portlet-body" style="padding-left: 0px; padding-right: 0px">
                                            <div class="portlet light portlet-fit" style="margin-bottom: 0px;padding-left: 0px;">
                                                <div class="portlet-title" style="padding-left: 15px;padding-top: 0px">
                                                    <div class="caption">
                                                        <i class="fa fa-calendar" style="color:midnightblue"></i>
                                                        <span class="caption-subject font-blue sbold uppercase sch_caption">&nbsp;TIMETABLE</span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body" style="padding: 0">
                                                    <div class="table-scrollable" style="margin: 0px">
                                                        <table class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr style="background-color: lightgrey">
                                                                    <th> # </th>
                                                                    <th> Nama Subjek </th>
                                                                    <th> Hari </th>
                                                                    <th> Jam </th>
                                                                    <th> Ket </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="sche_tbody">
                                                                <!-- AJAX GOES HERE -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="grades">
                                    <div class="portlet light portlet-fit">
                                        <div class="portlet-body" style="padding-left: 0px; padding-right: 0px; padding-top: 0px">
                                            <div class="portlet light bordered">
                                                <div class="portlet-title tabbable-line">
                                                    <div class="col-md-1" style="padding: 0px">
                                                        <div class="caption">
                                                            <i class="icon-user font-dark"></i>
                                                            <span class="caption-subject font-dark bold uppercase">&nbsp;Full Grade</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group form-md-line-input form-md-floating-label has-info" style="padding-top: 0px">
                                                            <select class="form-control edited selected_rooms" id="form_control_1">
                                                                <?php if (!empty($rooms)) : ?>
                                                                    <?php foreach ($rooms as $row) : ?>
                                                                        <option class="sbold" value="<?= $row->RoomDesc ?>">
                                                                            <?= $row->RoomDesc ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <option value=""> No Room is/was taught at this period </option>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-md-line-input form-md-floating-label has-info taught_subject" style="padding-top: 0px">
                                                            <select class="form-control edited selected_subj" id="form_control_1">
                                                                <?php if (!empty($taught)) : ?>
                                                                    <?php foreach ($taught as $row) : ?>
                                                                        <option class="sbold" value="<?= $row->SubjName ?>">
                                                                            <?= $row->SubjName ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <option value=""> No Subject is/was taught at this period </option>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="md-radio-inline">
                                                            <div class="md-radio">
                                                                <input type="radio" id="cognitive" name="grade_type" class="md-radiobtn" value="cognitive" checked>
                                                                <label for="cognitive">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Pengetahuan </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="skills" name="grade_type" class="md-radiobtn" value="skills">
                                                                <label for="skills">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Keterampilan </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="character" name="grade_type" class="md-radiobtn" value="character">
                                                                <label for="character">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Karakter </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="nav nav-tabs" id="grade_inner_tab">
                                                        <li class="active">
                                                            <a href="#grade" data-toggle="tab">
                                                                <!--JQUERY get_full_grading --></a>
                                                        </li>
                                                        <li>
                                                            <a href="#recap" data-toggle="tab">
                                                                <!--JQUERY get_full_grading --></a>
                                                        </li>
                                                        <li>
                                                            <a href="#predicate" data-toggle="tab">
                                                                <!--JQUERY get_full_grading --></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="grade">
                                                            <div class="table-scrollable">
                                                                <table class="table table-bordered table-hover grade_data">
                                                                    <!-- AJAX TABLE GOES HERE -->
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="recap">
                                                            <div class="table-scrollable">
                                                                <table class="table table-bordered table-hover recap_data">
                                                                    <!-- AJAX TABLE GOES HERE -->
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="predicate">
                                                            <div class="table-scrollable">
                                                                <table class="table table-bordered table-hover predicate_data">
                                                                    <!-- AJAX TABLE GOES HERE -->
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="absent">
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption font-red-sunglo">
                                                <i class="icon-share font-red-sunglo"></i>
                                                <span class="caption-subject bold uppercase port-title">&nbsp;ATTENDANCE DETAILS </span>
                                                <!-- <span class="caption-helper">monthly stats...</span> -->
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="form-group">
                                                <label>PILIH KELAS</label>
                                                <select class="form-control attd_rooms" style="width: 20%">
                                                    <?php if (!empty($rooms)) : ?>
                                                        <?php foreach ($rooms as $row) : ?>
                                                            <option class="sbold" value="<?= $row->RoomDesc ?>">
                                                                <?= $row->RoomDesc ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <option value=""> No Room is/was taught at this period </option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <table class="table table-striped table-bordered table-hover table-checkable dt-responsive" id="abs_table" style="width: 100%">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th> No. </th>
                                                                <th> ID </th>
                                                                <th> Nama </th>
                                                                <th> Total </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="portlet light bordered">
                                                        <div class="form-group form-md-line-input">
                                                            <label> KETERANGAN </label>
                                                            <div class="md-radio-inline has-info">
                                                                <div class="md-radio">
                                                                    <input type="radio" id="sick" name="attendance" class="md-radiobtn" value="Sick">
                                                                    <label for="sick" style="color: #333">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Sick
                                                                    </label>
                                                                </div>
                                                                <div class="md-radio">
                                                                    <input type="radio" id="onpermit" name="attendance" class="md-radiobtn" value="On Permit">
                                                                    <label for="onpermit" style="color: #333">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> On Permit
                                                                    </label>
                                                                </div>
                                                                <div class="md-radio">
                                                                    <input type="radio" id="abs" name="attendance" class="md-radiobtn" value="Absent">
                                                                    <label for="abs" style="color: #333">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Absent
                                                                    </label>
                                                                </div>
                                                                <div class="md-radio">
                                                                    <input type="radio" id="truant" name="attendance" class="md-radiobtn" value="Truant">
                                                                    <label for="truant" style="color: #333">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Truant
                                                                    </label>
                                                                </div>
                                                                <div class="md-radio">
                                                                    <input type="radio" id="late" name="attendance" class="md-radiobtn" value="Late">
                                                                    <label for="late" style="color: #333">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Late
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="specific_attd" hidden>
                                                            <div class="form-group">
                                                                <label> MATA PELAJARAN </label>
                                                                <select class="form-control edited abs_subj" id="form_control_1">
                                                                    <?php if (!empty($taught)) : ?>
                                                                        <?php foreach ($taught as $row) : ?>
                                                                            <option class="sbold" value="<?= $row->SubjName ?>">
                                                                                <?= $row->SubjName ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    <?php else : ?>
                                                                        <option value=""> No Subject is/was taught at this period </option>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label> WAKTU </label>
                                                                <div class="input-group">
                                                                    <input type="text" name="time_abs" class="form-control timepicker timepicker-24">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn default" type="button">
                                                                            <i class="fa fa-clock-o"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> TANGGAL </label>
                                                            <div class="input-group input-medium date date-picker" data-date="<?= date('d-M-Y') ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                                <input type="text" name="date_abs" class="form-control">
                                                                <span class="input-group-btn">
                                                                    <button class="btn default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-actions" style="padding-top: 25px">
                                                            <button type="submit" class="btn blue">Submit</button>
                                                            <button type="button" class="btn default">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal" style="float: right; margin-right: 15px">Close</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php $this->load->view('_partials/personal_footer'); ?>