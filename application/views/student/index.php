 <?php $this->load->view('_partials/personal_header'); ?>
 <!-- BEGIN CONTAINER -->
 <div class="page-container page-content-inner page-container-bg-solid student">
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
                             <center>
                                 <img class="img-responsive thumbnail img-circle" style="width: 35%" src="<?= base_url() ?>assets/photos/teachers/<?= $photo ?>" alt="">
                             </center>
                             <div class="cbp-l-grid-projects-title uppercase text-center">
                                 <?= "$fname $lname"; ?>
                             </div>
                             <div class="cbp-l-grid-projects-desc uppercase text-center">
                                 <strong><?= "$id - $room"; ?></strong>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-md-3 col-sm-6 no-space">
                 <!-- BEGIN WIDGET SUBSCRIBE -->
                 <div class="widget-subscribe">
                     <span class="widget-subscribe-no">1</span>
                     <h2 class="widget-subscribe-title widget-title-color-gray-dark text-uppercase">Profile
                         <br /> </h2>
                     <p class="widget-subscribe-subtitle widget-title-color-dark-light">Informasi pesonal data Siswa; Biodata dan Data Keluarga.
                         <a data-toggle="modal" id="toggle_modal" class="widget-subscribe-subtitle-link full1" href="#full">full details...</a>
                     </p>
                 </div>
                 <!-- END WIDGET SUBSCRIBE -->
             </div>
             <div class="col-md-3 col-sm-6 no-space">
                 <!-- BEGIN WIDGET SUBSCRIBE -->
                 <div class="widget-subscribe widget-subscribe-border">
                     <span class="widget-subscribe-no">2</span>
                     <h2 class="widget-subscribe-title widget-title-color-gray-dark text-uppercase">AKADEMIK
                         <br /> </h2>
                     <p class="widget-subscribe-subtitle widget-title-color-dark-light">Informasi record Akademik Siswa aktif, mencakup Jadwal Pelajaran, Absensi, dan Record Grade Siswa.
                         <a data-toggle="modal" id="toggle_modal" class="widget-subscribe-subtitle-link full2" href="#full2">full details...</a>
                     </p>
                 </div>
                 <!-- END WIDGET SUBSCRIBE -->
             </div>
             <div class="col-md-3 col-sm-6 no-space">
                 <!-- BEGIN WIDGET SUBSCRIBE -->
                 <div class="widget-subscribe widget-subscribe-border-top">
                     <span class="widget-subscribe-no">3</span>
                     <h2 class="widget-subscribe-title widget-title-color-gray-dark text-uppercase">FINANCE
                         <br /></h2>
                     <p class="widget-subscribe-subtitle widget-title-color-dark-light">Data Finansial Siswa aktif.
                         <a class="widget-subscribe-subtitle-link full3" href="#">full details...</a>
                     </p>
                 </div>
                 <!-- END WIDGET SUBSCRIBE -->
             </div>
         </div>

         <div class="row widget-row">
             <div class="col-md-6 col-sm-6 col-xs-12 margin-bottom-20">
                 <!-- BEGIN WIDGET TAB -->
                 <div class="widget-bg-color-white widget-tab">
                     <ul class="nav nav-tabs">
                         <li class="disable">
                             <h2>SCHEDULE</h2>
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
                             <?php foreach ($mon as $row) : ?>
                                 <div class="widget-news margin-bottom-20">
                                     <img class="widget-news-left-elem" src="<?php echo base_url(); ?>assets/layouts/layout7/img/03.jpg" alt="">
                                     <div class="widget-news-right-body">
                                         <?php if ($row->SubjName == 'ELECTIVE') : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?> | <span class="selected_nonregular text-primary">None</span>
                                                 <a href="javascript:;" class="btn">
                                                     <i class="fa fa-edit btn_nonregular" data-type="Elective" data-hour="<?= $row->Hour ?>" style="font-weight: 600; font-size: 15px"></i>
                                                 </a>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php elseif ($row->SubjName == 'EXCUL') : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?> | <span class="selected_nonregular text-primary">None</span>
                                                 <a href="javascript:;" class="btn">
                                                     <i class="fa fa-edit btn_nonregular" data-type="Excul" data-hour="<?= $row->Hour ?>" style="font-weight: 600; font-size: 15px"></i>
                                                 </a>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php else : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php endif; ?>
                                     </div>
                                 </div>
                             <?php endforeach; ?>
                         </div>
                         <div class="tab-pane fade active in" id="selasa">
                             <?php foreach ($tue as $row) : ?>
                                 <div class="widget-news margin-bottom-20">
                                     <img class="widget-news-left-elem" src="<?php echo base_url(); ?>assets/layouts/layout7/img/03.jpg" alt="">
                                     <div class="widget-news-right-body">
                                         <?php if ($row->SubjName == 'ELECTIVE') : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?> | <span class="selected_nonregular text-primary">None</span>
                                                 <a href="javascript:;" class="btn">
                                                     <i class="fa fa-edit btn_nonregular" data-type="Elective" data-hour="<?= $row->Hour ?>" style="font-weight: 600; font-size: 15px"></i>
                                                 </a>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php elseif ($row->SubjName == 'EXCUL') : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?> | <span class="selected_nonregular text-primary">None</span>
                                                 <a href="javascript:;" class="btn">
                                                     <i class="fa fa-edit btn_nonregular" data-type="Excul" data-hour="<?= $row->Hour ?>" style="font-weight: 600; font-size: 15px"></i>
                                                 </a>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php else : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php endif; ?>
                                     </div>
                                 </div>
                             <?php endforeach; ?>
                         </div>
                         <div class="tab-pane fade active in" id="rabu">
                             <?php foreach ($wed as $row) : ?>
                                 <div class="widget-news margin-bottom-20">
                                     <img class="widget-news-left-elem" src="<?php echo base_url(); ?>assets/layouts/layout7/img/03.jpg" alt="">
                                     <div class="widget-news-right-body">
                                         <?php if ($row->SubjName == 'ELECTIVE') : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?> | <span class="selected_nonregular text-primary">None</span>
                                                 <a href="javascript:;" class="btn">
                                                     <i class="fa fa-edit btn_nonregular" data-type="Elective" data-hour="<?= $row->Hour ?>" style="font-weight: 600; font-size: 15px"></i>
                                                 </a>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php elseif ($row->SubjName == 'EXCUL') : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?> | <span class="selected_nonregular text-primary">None</span>
                                                 <a href="javascript:;" class="btn">
                                                     <i class="fa fa-edit btn_nonregular" data-type="Excul" data-hour="<?= $row->Hour ?>" style="font-weight: 600; font-size: 15px"></i>
                                                 </a>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php else : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php endif; ?>
                                     </div>
                                 </div>
                             <?php endforeach; ?>
                         </div>
                         <div class="tab-pane fade active in" id="kamis">
                             <?php foreach ($thu as $row) : ?>
                                 <div class="widget-news margin-bottom-20">
                                     <img class="widget-news-left-elem" src="<?php echo base_url(); ?>assets/layouts/layout7/img/03.jpg" alt="">
                                     <div class="widget-news-right-body">
                                         <?php if ($row->SubjName == 'ELECTIVE') : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?> | <span class="selected_nonregular text-primary">None</span>
                                                 <a href="javascript:;" class="btn">
                                                     <i class="fa fa-edit btn_nonregular" data-type="Elective" data-hour="<?= $row->Hour ?>" style="font-weight: 600; font-size: 15px"></i>
                                                 </a>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php elseif ($row->SubjName == 'EXCUL') : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?> | <span class="selected_nonregular text-primary">None</span>
                                                 <a href="javascript:;" class="btn">
                                                     <i class="fa fa-edit btn_nonregular" data-type="Excul" data-hour="<?= $row->Hour ?>" style="font-weight: 600; font-size: 15px"></i>
                                                 </a>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php else : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php endif; ?>
                                     </div>
                                 </div>
                             <?php endforeach; ?>
                         </div>
                         <div class="tab-pane fade active in" id="jumat">
                             <?php foreach ($fri as $row) : ?>
                                 <div class="widget-news margin-bottom-20">
                                     <img class="widget-news-left-elem" src="<?php echo base_url(); ?>assets/layouts/layout7/img/03.jpg" alt="">
                                     <div class="widget-news-right-body">
                                         <?php if ($row->SubjName == 'ELECTIVE') : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?> | <span class="selected_nonregular text-primary">None</span>
                                                 <a href="javascript:;" class="btn">
                                                     <i class="fa fa-edit btn_nonregular" data-type="Elective" data-hour="<?= $row->Hour ?>" style="font-weight: 600; font-size: 15px"></i>
                                                 </a>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php elseif ($row->SubjName == 'EXCUL') : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?> | <span class="selected_nonregular text-primary">None</span>
                                                 <a href="javascript:;" class="btn">
                                                     <i class="fa fa-edit btn_nonregular" data-type="Excul" data-hour="<?= $row->Hour ?>" style="font-weight: 600; font-size: 15px"></i>
                                                 </a>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php else : ?>
                                             <h3 class="widget-news-right-body-title"><?= $row->SubjName ?>
                                                 <span class="label label-default"> Jam <?= $row->Hour ?> </span>
                                             </h3>
                                             <p>Teacher : <?= $row->TeacherName ?></p>
                                         <?php endif; ?>
                                     </div>
                                 </div>
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
                             <span class="caption-subject bold uppercase" style="color: #293239;"><i class="fa fa-info-circle"></i>&nbsp;Class Detail</span>
                         </div>
                     </div>
                     <div class="portlet-body" style="padding: 0px; margin-top: 15px">

                         <div class="col-md-12" style="padding-left: 0px; padding-right: 0px">
                             <!-- BEGIN WIDGET THUMB -->
                             <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-15 bordered" style="padding: 20px">
                                 <h4 class="widget-thumb-heading">Kelas :</h4>
                                 <div class="widget-thumb-wrap">
                                     <i class="widget-thumb-icon bg-green icon-user"></i>
                                     <div class="widget-thumb-body">
                                         <span class="widget-thumb-subtitle"></span>
                                         <span class="widget-thumb-body-stat" style="font-size: 15px"><?= $room ?></span>
                                     </div>
                                 </div>
                             </div>
                             <!-- END WIDGET THUMB -->
                         </div>
                         <div class="col-md-12" style="padding-left: 0px; padding-right: 0px">
                             <!-- BEGIN WIDGET THUMB -->
                             <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-15 bordered" style="padding: 20px">
                                 <h4 class="widget-thumb-heading">Wali Kelas :</h4>
                                 <div class="widget-thumb-wrap">
                                     <i class="widget-thumb-icon bg-red icon-user"></i>
                                     <div class="widget-thumb-body">
                                         <span class="widget-thumb-subtitle">&nbsp;</span>
                                         <span class="widget-thumb-body-stat" style="font-size: 15px"><?= $homeroom ?></span>
                                     </div>
                                 </div>
                             </div>
                             <!-- END WIDGET THUMB -->
                         </div>
                         <div class="col-md-12" style="padding-left: 0px; padding-right: 0px">
                             <!-- BEGIN WIDGET THUMB -->
                             <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-15 bordered" style="padding: 20px">
                                 <h4 class="widget-thumb-heading">Jumlah Siswa Di Kelas :</h4>
                                 <div class="widget-thumb-wrap">
                                     <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                                     <div class="widget-thumb-body">
                                         <span class="widget-thumb-subtitle">Total</span>
                                         <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= $total ?>"></span>
                                     </div>
                                 </div>
                             </div>
                             <!-- END WIDGET THUMB -->
                         </div>

                     </div>
                 </div>
             </div>
             <div class="col-md-2 col-sm-6 col-xs-12 margin-bottom-20">
                 <!-- BEGIN WIDGET PROGRESS -->
                 <div class="widget-progress">
                     <div class="widget-progress-element widget-bg-color-blue margin-bottom-25">
                         <span class="widget-progress-title" style="font-size: 20px">Absen
                             <span class="pull-right">Total: <?= $absn ?></span>
                         </span>
                         <div class="progress">
                             <div class="progress-bar widget-bg-color-white" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($absn * 100) / 14) ?>%;"> </div>
                         </div>
                     </div>
                     <div class="widget-progress-element widget-bg-color-green margin-bottom-25">
                         <span class="widget-progress-title" style="font-size: 20px">Izin
                             <span class="pull-right">Total: <?= $permit ?></span>
                         </span>
                         <div class="progress">
                             <div class="progress-bar widget-bg-color-white" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($permit * 100) / 14) ?>%;"> </div>
                         </div>
                     </div>
                     <div class="widget-progress-element widget-bg-color-red  margin-bottom-25">
                         <span class="widget-progress-title" style="font-size: 20px">Sakit
                             <span class="pull-right">Total: <?= $sick ?></span>
                         </span>
                         <div class="progress">
                             <div class="progress-bar widget-bg-color-white" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($sick * 100) / 14) ?>%;"> </div>
                         </div>
                     </div>
                     <div class="widget-progress-element widget-bg-color-purple margin-bottom-25">
                         <span class="widget-progress-title" style="font-size: 20px">Terlambat
                             <span class="pull-right">Total: <?= $truant ?></span>
                         </span>
                         <div class="progress">
                             <div class="progress-bar widget-bg-color-white" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($truant * 100) / 14) ?>%;"> </div>
                         </div>
                     </div>
                     <div class="widget-progress-element widget-bg-color-green">
                         <span class="widget-progress-title" style="font-size: 20px">Bolos
                             <span class="pull-right">Total: <?= $late ?></span>
                         </span>
                         <div class="progress">
                             <div class="progress-bar widget-bg-color-white" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($late * 100) / 14) ?>%;"> </div>
                         </div>
                     </div>
                 </div>
                 <!-- END WIDGET PROGRESS -->
             </div>
         </div>
         <div class="row widget-row">
             <div class="col-md-3">
                 <!-- BEGIN WIDGET THUMB -->
                 <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                     <h4 class="widget-thumb-heading">SPP</h4>
                     <div class="widget-thumb-wrap">
                         <i class="widget-thumb-icon bg-green icon-bulb"></i>
                         <div class="widget-thumb-body">
                             <span class="widget-thumb-subtitle">IDR</span>
                             <!-- <span class="widget-thumb-body-stat" data-counter="counterup" data-value="1.400.000.000">0</span> -->
                             <span class="widget-thumb-body-stat">1.400.000</span>
                         </div>
                     </div>
                 </div>
                 <!-- END WIDGET THUMB -->
             </div>
             <div class="col-md-3">
                 <!-- BEGIN WIDGET THUMB -->
                 <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                     <h4 class="widget-thumb-heading">PEMBANGUNAN</h4>
                     <div class="widget-thumb-wrap">
                         <i class="widget-thumb-icon bg-red icon-layers"></i>
                         <div class="widget-thumb-body">
                             <span class="widget-thumb-subtitle">IDR</span>
                             <span class="widget-thumb-body-stat">600.000</span>
                         </div>
                     </div>
                 </div>
                 <!-- END WIDGET THUMB -->
             </div>
             <div class="col-md-3">
                 <!-- BEGIN WIDGET THUMB -->
                 <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                     <h4 class="widget-thumb-heading">EXTRA</h4>
                     <div class="widget-thumb-wrap">
                         <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                         <div class="widget-thumb-body">
                             <span class="widget-thumb-subtitle">IDR</span>
                             <span class="widget-thumb-body-stat">300.000</span>
                         </div>
                     </div>
                 </div>
                 <!-- END WIDGET THUMB -->
             </div>
             <div class="col-md-3">
                 <!-- BEGIN WIDGET THUMB -->
                 <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                     <h4 class="widget-thumb-heading">TOTAL PEMBAYARAN</h4>
                     <div class="widget-thumb-wrap">
                         <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                         <div class="widget-thumb-body">
                             <span class="widget-thumb-subtitle">IDR</span>
                             <span class="widget-thumb-body-stat">2.300.000</span>
                         </div>
                     </div>
                 </div>
                 <!-- END WIDGET THUMB -->
             </div>
         </div>
         <!-- END PAGE BASE CONTENT -->
     </div>
     <!-- END CONTENT -->
 </div>
 <!-- END CONTAINER -->
 <!-- BEGIN QUICK SIDEBAR -->
 <a href="javascript:;" class="page-quick-sidebar-toggler">
     <i class="icon-login"></i>
 </a>
 <!-- END QUICK SIDEBAR -->
 <!-- BEGIN FOOTER -->
 <div class="page-footer">
     <div class="page-footer-inner container-fluid container-lf-space">
         <p class="page-footer-copyright"> <?= date('Y'); ?> <span style="font-family: helvetica, sans-serif">a</span> Metronic Theme By
             <a target="_blank" href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
             <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
         </p>
     </div>
     <div class="go2top">
         <i class="icon-arrow-up"></i>
     </div>
 </div>
 <!-- END FOOTER -->


 <div class="quick-nav-overlay"></div>
 <!-- END QUICK NAV -->

 <!-- MODAL PROFILE -->
 <div class="modal fade in" id="full" tabindex="-1" role="dialog" aria-hidden="true" style="display: hidden;">
     <div class="modal-dialog modal-full" style="width: 90%">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                 <h2 class="modal-title"> <span class="uppercase">Profile</span>: <span class="uppercase sbold"><?= "$prof->FirstName $prof->LastName"; ?></span> </h4>
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
                             <div class="col-md-2">
                                 <div class="profile-sidebar">
                                     <div class="portlet light profile-sidebar-portlet">
                                         <div class="profile-userpic" style="margin: auto;">
                                             <img src="<?= base_url('assets/photos/student/') . $photo ?>" class="img-responsive thumbnail img-circle" style="max-width: 100%;">
                                         </div>
                                         <div class="profile-usertitle text-center">
                                             <span class="caption-subject font-blue bold"><?= "$fname $lname" ?></span>
                                             <div class="text-uppercase sbold" style="margin-top: 10px;"> <?= $status ?> </div>
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
                                                 <span class="caption-subject font-red sbold uppercase">Student's Bio</span>
                                             </div>
                                         </div>
                                         <div class="portlet-body">
                                             <div class="table-scrollable table-scrollable-borderless">
                                                 <table class="table table-hover table-light">
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Fullname </th>
                                                             <td> <?= "$prof->FirstName $prof->MiddleName $prof->LastName"; ?> </td>
                                                             <th class="uppercase"> Birth Place </th>
                                                             <td> <?= $prof->PointofBirth; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Nickname </th>
                                                             <td> <?= $prof->NickName; ?> </td>
                                                             <th class="uppercase"> Religion </th>
                                                             <td> <?= $prof->Religion; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> NIK </th>
                                                             <td> <?= $prof->PersonalID; ?> </td>
                                                             <th class="uppercase"> Height </th>
                                                             <td> <?= $prof->Height; ?> cm </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Gender </th>
                                                             <td> <?= $prof->Gender; ?> </td>
                                                             <th class="uppercase"> Weight </th>
                                                             <td> <?= $prof->Weight; ?> Kg </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Date of Birth </th>
                                                             <td> <?= $prof->DateofBirth; ?> </td>
                                                             <th class="uppercase"> Head Size </th>
                                                             <td> <?= $prof->HeadDiameter; ?> cm </td>
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
                                 <div class="row" style="margin-top: -40px;">
                                     <div class="portlet light portlet-fit ">
                                         <div class="portlet-title">
                                             <div class="caption">
                                                 <i class="fa fa-user font-red font-red"></i>
                                                 <span class="caption-subject font-red sbold uppercase">Student's Address</span>
                                             </div>
                                         </div>
                                         <div class="portlet-body">
                                             <div class="table-scrollable table-scrollable-borderless">
                                                 <table class="table table-hover table-light">
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> LiveWith </th>
                                                             <td style="width: 25%"> <?= $prof->LiveWith; ?> </td>
                                                             <th class="uppercase"> Postal </th>
                                                             <td> <?= $prof->Postal; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Transportation </th>
                                                             <td> <?= $prof->Transportation; ?> </td>
                                                             <th class="uppercase"> House Range </th>
                                                             <td> <?= $prof->Range; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Address </th>
                                                             <td> <?= $prof->Address; ?> </td>
                                                             <th class="uppercase"> Exact House Range </th>
                                                             <td> <?= $prof->ExactRange; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> RT </th>
                                                             <td> <?= $prof->RT; ?> </td>
                                                             <th class="uppercase"> Travel Time </th>
                                                             <td> <?= $prof->TimeRange; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> RW </th>
                                                             <td> <?= $prof->RW; ?> </td>
                                                             <th class="uppercase"> Latitude </th>
                                                             <td> <?= $prof->Latitude; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Village </th>
                                                             <td> <?= $prof->Village; ?> </td>
                                                             <th class="uppercase"> Longitude </th>
                                                             <td> <?= $prof->Longitude; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> District </th>
                                                             <td> <?= $prof->District; ?> </td>
                                                             <th class="uppercase"> Email </th>
                                                             <td> <?= $prof->Email; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Region </th>
                                                             <td> <?= $prof->Region; ?> </td>
                                                             <th class="uppercase"> HouseNumber </th>
                                                             <td> <?= $prof->HousePhone; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Country </th>
                                                             <td> <?= $prof->Country; ?> </td>
                                                             <th class="uppercase"> PhoneNumber </th>
                                                             <td> <?= $prof->Phone; ?> </td>
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
                             <div class="col-sm-4">
                                 <div class="row">
                                     <div class="portlet light portlet-fit ">
                                         <div class="portlet-title">
                                             <div class="caption">
                                                 <i class="fa fa-user font-red font-red"></i>
                                                 <span class="caption-subject font-red sbold uppercase">Academic Info</span>
                                             </div>
                                         </div>
                                         <div class="portlet-body">
                                             <div class="table-scrollable table-scrollable-borderless">
                                                 <table class="table table-hover table-light">
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> NIS </th>
                                                             <td> <?= $prof->NIS; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Class </th>
                                                             <td> <?= $prof->Kelas; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Ruang </th>
                                                             <td> <?= $prof->Ruangan; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Position </th>
                                                             <?php if ($prof->Position == '') : ?>
                                                                 <td> - </td>
                                                             <?php else : ?>
                                                                 <td> <?= $prof->Position; ?> </td>
                                                             <?php endif; ?>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Competent </th>
                                                             <td> <?= $prof->Competition; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Previous School </th>
                                                             <td> <?= $prof->PreviousSchool; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Diploma Number </th>
                                                             <td> <?= $prof->Diploma; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Achievement </th>
                                                             <td> <?= $prof->Achievement; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Achievement Level </th>
                                                             <td> <?= $prof->AchievementLVL; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> AchievementName </th>
                                                             <td> <?= $prof->AchievementName; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> AchievementYear </th>
                                                             <td> <?= $prof->AchievementYear; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Sponsored By </th>
                                                             <td> <?= $prof->Sponsor; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Achievement Rank </th>
                                                             <td> <?= $prof->AchievementRank; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Scholarship </th>
                                                             <td> <?= $prof->Scholarship; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Scholarship Description </th>
                                                             <td> <?= $prof->ScholarDesc; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Scholarship Year Starts </th>
                                                             <td> <?= $prof->ScholarStart; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Scholarship Year Finishes </th>
                                                             <td> <?= $prof->ScholarFinish; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Prosperity Type </th>
                                                             <td> <?= $prof->Prosperity; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Prosper Number </th>
                                                             <td> <?= $prof->ProsperNumber; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Printed Name in Prosper Card </th>
                                                             <td> <?= $prof->ProsperNameTag; ?> </td>
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
                                 <div class="row" style=" margin-top: -20px;">
                                     <!-- RESERVED FOR ADDITIONAL DATA -->
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="portlet light portlet-fit ">
                                         <div class="portlet-title">
                                             <div class="caption">
                                                 <i class="fa fa-user font-red"></i>
                                                 <span class="caption-subject font-red sbold uppercase">Family Relationship</span>
                                             </div>
                                         </div>
                                         <div class="portlet-body">
                                             <div class="table-scrollable table-scrollable-borderless">
                                                 <table class="table table-hover table-light">
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Father's Name </th>
                                                             <td> <?= $prof->Father; ?> </td>
                                                             <th class="uppercase"> Mother's Name </th>
                                                             <td> <?= $prof->Mother; ?> </td>
                                                             <th class="uppercase"> Guardian's Name </th>
                                                             <td> <?= $prof->Guardian; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> NIK </th>
                                                             <td> <?= $prof->FatherNIK; ?> </td>
                                                             <th class="uppercase"> NIK </th>
                                                             <td> <?= $prof->MotherNIK; ?> </td>
                                                             <th class="uppercase"> NIK </th>
                                                             <td> <?= $prof->GuardianNIK; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Born </th>
                                                             <td> <?= $prof->FatherBorn; ?> </td>
                                                             <th class="uppercase"> Born </th>
                                                             <td> <?= $prof->MotherBorn; ?> </td>
                                                             <th class="uppercase"> Born </th>
                                                             <td> <?= $prof->GuardianBorn; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Degree </th>
                                                             <td> <?= $prof->FatherDegree; ?> </td>
                                                             <th class="uppercase"> Degree </th>
                                                             <td> <?= $prof->MotherDegree; ?> </td>
                                                             <th class="uppercase"> Degree </th>
                                                             <td> <?= $prof->GuardianDegree; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Occupation </th>
                                                             <td> <?= $prof->FatherJob; ?> </td>
                                                             <th class="uppercase"> Occupation </th>
                                                             <td> <?= $prof->MotherJob; ?> </td>
                                                             <th class="uppercase"> Occupation </th>
                                                             <td> <?= $prof->GuardianJob; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Monthly Earning </th>
                                                             <td> <?= $prof->FatherIncome; ?> </td>
                                                             <th class="uppercase"> Monthly Earning </th>
                                                             <td> <?= $prof->MotherIncome; ?> </td>
                                                             <th class="uppercase"> Monthly Earning </th>
                                                             <td> <?= $prof->GuardianIncome; ?> </td>
                                                         </tr>
                                                     </thead>
                                                     <thead>
                                                         <tr>
                                                             <th class="uppercase"> Disability </th>
                                                             <td> <?= $prof->FatherDisability; ?> </td>
                                                             <th class="uppercase"> Disability </th>
                                                             <td> <?= $prof->MotherDisability; ?> </td>
                                                             <th class="uppercase"> Disability </th>
                                                             <td> <?= $prof->GuardianDisability; ?> </td>
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
                                 <button class="btn red" data-dismiss="modal">Cancel</button>
                             </div> -->
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <button type="button" class="btn dark btn-outline" data-dismiss="modal" style="float: right; margin-right: 15px">Close</button>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- MODAL ACADEMIC -->
 <div class="modal fade in" id="full2" tabindex="-1" role="dialog" aria-hidden="true" style="display: hidden;">
     <div class="modal-dialog modal-full" style="width: 95%">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                 <h4 class="modal-title">AKADEMIK</h4>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col-md-3">
                         <div class="form-group form-md-line-input form-md-floating-label has-info">
                             <select class="form-control" id="select_period">
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
                                     <a href="#absence" data-toggle="tab" aria-expanded="false"> Absence </a>
                                 </li>
                                 <!-- <li class="">
                                    <a href="#old" data-toggle="tab" aria-expanded="false"> Old </a>
                                </li> -->
                             </ul>
                             <div class="tab-content">
                                 <div class="tab-pane active" id="schedule">
                                     <div class="portlet light portlet-fit">
                                         <div class="portlet-body" style="padding-left: 0px; padding-right: 0px">
                                             <div class="portlet light portlet-fit" style="margin-bottom: 0px;padding-left: 0px;">
                                                 <div class="portlet-title" style="padding-left: 40px;padding-top: 0px;border-bottom: 0px;margin-bottom: 0px;">
                                                     <div class="caption">
                                                         <i class="fa fa-calendar font-red font-red"></i>
                                                         <span class="caption-subject font-red sbold uppercase sch_caption"></span>
                                                     </div>
                                                 </div>
                                                 <div class="portlet-body" style="padding-top: 0px;padding-bottom: 0px;">
                                                     <div class="table-responsive">
                                                         <table class="table table-light">
                                                             <thead>
                                                                 <tr class="uppercase text-justify">
                                                                     <th class="text-center" style="min-width: 5px; border-bottom: 0"> Hour </th>
                                                                     <th class="text-center" style="max-width: 80px; border-bottom: 0"> Monday </th>
                                                                     <th class="text-center" style="max-width: 80px; border-bottom: 0"> Tuesday </th>
                                                                     <th class="text-center" style="max-width: 80px; border-bottom: 0"> Wednesday </th>
                                                                     <th class="text-center" style="max-width: 80px; border-bottom: 0"> Thursday </th>
                                                                     <th class="text-center" style="max-width: 80px; border-bottom: 0"> Friday </th>
                                                                 </tr>
                                                             </thead>
                                                             <tbody class="sch_tbody">

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
                                         <div class="portlet-body" style="padding-left: 0px; padding-right: 0px">
                                             <div class="tab-pane active" id="tab_1_3">
                                                 <div class="row profile-account">
                                                     <div class="col-md-2">
                                                         <ul class="ver-inline-menu tabbable margin-bottom-10">
                                                             <li class="active">
                                                                 <a data-toggle="tab" href="#tab_1-1" aria-expanded="true">
                                                                     <i class="fa fa-book"></i> Grades Report </a>
                                                                 <span class="after"> </span>
                                                             </li>
                                                             <li class="">
                                                                 <a data-toggle="tab" href="#tab_2-2" aria-expanded="true">
                                                                     <i class="fa fa-book"></i> Skills Report </a>
                                                             </li>
                                                             <li class="">
                                                                 <a data-toggle="tab" href="#tab_3-3" aria-expanded="true">
                                                                     <i class="fa fa-user"></i> Character Report </a>
                                                             </li>
                                                             <!-- <li class="">
                                                                <a data-toggle="tab" href="#tab_4-4" aria-expanded="true">
                                                                    <i class="fa fa-child"></i> Extra Cullicular </a>
                                                            </li>
                                                            <li class="">
                                                                <a data-toggle="tab" href="#tab_5-5" aria-expanded="true">
                                                                    <i class="fa fa-trophy"></i> Achievement </a>
                                                            </li>
                                                            <li class="">
                                                                <a data-toggle="tab" href="#tab_6-6" aria-expanded="true">
                                                                    <i class="fa fa-list-ol"></i> Absence </a>
                                                            </li> -->
                                                         </ul>
                                                     </div>
                                                     <div class="col-md-10">
                                                         <div class="tab-content">
                                                             <div id="tab_1-1" class="tab-pane active">
                                                                 <div class="row">
                                                                     <div class="col-md-12" style="padding-left: 0px">
                                                                         <div class="table-scrollable" style="margin-top: 0px !important;">
                                                                             <table class="table table-hover table-light">
                                                                                 <thead>
                                                                                     <tr>
                                                                                         <th> # </th>
                                                                                         <th> Subject Name </th>
                                                                                         <th> Grade </th>
                                                                                         <th> Predicate </th>
                                                                                         <th> Description </th>
                                                                                     </tr>
                                                                                 </thead>
                                                                                 <tbody class="grade_report_tbody">

                                                                                 </tbody>
                                                                             </table>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div id="tab_2-2" class="tab-pane">
                                                                 <div class="row">
                                                                     <div class="col-md-12" style="padding-left: 0px">
                                                                         <div class="table-scrollable" style="margin-top: 0px !important;">
                                                                             <table class="table table-hover table-light">
                                                                                 <thead>
                                                                                     <tr>
                                                                                         <th> # </th>
                                                                                         <th> Subject Name </th>
                                                                                         <th> Grade </th>
                                                                                         <th> Predicate </th>
                                                                                         <th> Description </th>
                                                                                     </tr>
                                                                                 </thead>
                                                                                 <tbody class="skills_report_tbody">

                                                                                 </tbody>
                                                                             </table>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div id="tab_3-3" class="tab-pane">
                                                                 <div class="row">
                                                                     <div class="col-md-12" style="padding-left: 0px">
                                                                         <div class="table-scrollable" style="margin-top: 0px !important;">
                                                                             <table class="table table-hover table-light">
                                                                                 <thead>
                                                                                     <tr>
                                                                                         <th class="sbold"> # </th>
                                                                                         <th class="sbold"> Subject Name </th>
                                                                                         <th class="sbold"> Grade </th>
                                                                                         <th class="sbold"> Predicate </th>
                                                                                         <th class="sbold"> Description </th>
                                                                                     </tr>
                                                                                 </thead>
                                                                                 <tbody class="soc_report_tbody">

                                                                                 </tbody>
                                                                                 <tbody class="spr_report_tbody">

                                                                                 </tbody>
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
                                     </div>
                                 </div>
                                 <div class="tab-pane" id="absence">
                                     <div class="portlet light portlet-fit">
                                         <div class="portlet-body" style="padding-left: 0px; padding-right: 0px">
                                             <div class="portlet">
                                                 <div class="portlet-title">
                                                     <div class="caption font-red-sunglo">
                                                         <i class="icon-share font-red-sunglo"></i>
                                                         <span class="caption-subject bold uppercase port-title">&nbsp;ATTENDANCE DETAILS </span>
                                                         <!-- <span class="caption-helper">monthly stats...</span> -->
                                                     </div>
                                                 </div>
                                                 <div class="portlet-body portlet_subcls">
                                                     <div class="table-responsive">
                                                         <table class="table tbl_portlet_cls table-light">
                                                             <thead>
                                                                 <tr>
                                                                     <th> No. </th>
                                                                     <th> Date </th>
                                                                     <th> Note </th>
                                                                 </tr>
                                                             </thead>
                                                             <tbody class="abs_tbody">

                                                             </tbody>
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
                 </div>
                 <div class="row">
                     <button type="button" class="btn dark btn-outline" data-dismiss="modal" style="float: right; margin-right: 15px">Close</button>
                 </div>
             </div>
         </div>
     </div>
     <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
 </div>

 <!-- MODAL SELECT ELECTIVE-->
 <div id="modal_select_nonregular" class="modal fade in" tabindex="-1" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-primary">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                 <h4 class="modal-title"></h4>
             </div>
             <div class="modal-body">
                 <div class="form-group form-md-line-input form-md-floating-label has-info">
                     <select class="form-control" id="select_nonregular">
                         <option value="-"> - </option>
                     </select>
                     <label for="select_nonregular">CHOOSE SUBJECT</label>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                 <button type="button" data-dismiss="modal" class="btn green">Update</button>
             </div>
         </div>
     </div>
 </div>

 <?php $this->load->view('_partials/personal_footer'); ?>