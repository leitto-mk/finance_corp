<?php $this->load->view('header_footer/portal_teacher/header'); ?>
<style type="text/css" media="screen">
    .page-header{
        position: fixed !important;
        top:0;
        width: 100%
    }
    .page-container{
        margin-top: 150px !important;
    }
    .item-name{
        font-size: 20px
    }
    .horizontal-scrollable > .row > .col-xs-6 { 
        display: inline-table!important; 
        float: none!important; 
    }
    .input-group:not(.soh) {
        display: table;
        width: 100%;
        border-collapse: separate;
    }
    .soh{
        position: absolute;
        bottom: 30px;
        right: 30px;
        left: 0px;
        margin-left: 30px;
        margin-right: 30px;
    }

    @media only screen and (min-width: 600px){
        .item-name{
            font-size: 20px
        }
        .page-container{
            margin-top: 75px !important;
        }
    }

    @media only screen and (min-width: 1024px){
        .menu-toggler{
            visibility: hidden;
        }

        .horizontal-scrollable > .row { 
            display: inline-table!important;
            width: 100%;
            float: none!important; 
        }

        .horizontal-scrollable > .row > .col-xs-6{ 
            display: inline-table!important; 
            float: none!important; 
        }

        .page-sidebar{
            position: fixed;
        }

        #body-title{
            position: sticky;
            top: 75px;
            z-index: 50;
            background-color: white;
            position: -webkit-sticky;
        }

    }
    @media only screen and (max-width: 1023px){
        .horizontal-scrollable > .row { 
            overflow-x: auto!important; 
            white-space: nowrap!important; 
        } 
          
        .horizontal-scrollable > .row > .col-xs-6{ 
            display: inline-table!important; 
            float: none!important; 
        }

        .horizontal-scrollable > .row > .col-xs-6 > .portlet{ 
            white-space: normal!important;
            display: block!important; 
            float: none!important; 
        }
    }

    .breadcrumb a{
        color: #f2784b
    }
    .breadcrumb span.active{
        color: #555555
    }
</style>
<div class="container">
    <!-- BEGIN CONTAINER -->
    <div class="page-container bg-default">
        <?php $this->load->view('header_footer/portal_teacher/sidebar'); ?>
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="margin-top: -10px">
                <!-- BEGIN PAGE HEAD-->
                <div class="loader-wrapper">
                  <span class="loader"><span class="loader-inner"></span></span>
                </div>
                <div class="page-head">
                    <div class="portlet light bg-blue-hoki" style="height: 75px">
                        <h4 class="font-white bold">
                            <?php if ($this->session->userdata('status') == 'admin') : ?>
                            <img src="<?= base_url() ?>assets/photos/adm/<?= $photo ?>" alt="" width="4%" height="4%">
                            <?php elseif ($this->session->userdata('status') == 'teacher') : ?>
                                <img src="<?= base_url() ?>assets/photos/teachers/<?= $photo ?>" alt="" width="4%" height="4%">
                            <?php elseif ($this->session->userdata('status') == 'student') : ?>
                                <img src="<?= base_url() ?>assets/photos/student/<?= $photo ?>" alt="" width="4%" height="4%">
                            <?php elseif ($this->session->userdata('status') == 'staff') : ?>
                                <img src="<?= base_url() ?>assets/photos/staff/<?= $photo ?>" alt="" width="4%" height="4%">
                            <?php endif; ?> 
                            <?= "$id"; ?> | <u><?= strtoupper("$fname $lname, ") . "$degree" ?></u>
                            <small class="font-green"> [ <?= "$jobdesc" ?> ]</small>
                        </h4>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light" style="background-color: white; border: dotted 1px">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-book"></i> News &  Assignments </span>
                                </div>
                            </div>
                            <div class="portlet-body ">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: -20px">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-stripped" id="datatable_duty">
                                                <thead class="font-white bg-blue-oleo">
                                                    <tr>
                                                        <th width="3%" class="text-center">#</th>
                                                        <th width="25%" class="text-center">Title</th>
                                                        <th width="42%" class="text-center">Details</th>
                                                        <th width="20%" class="text-center">DueDate</th>
                                                        <th width="10%" class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if ($data_duty != false){ ?>
                                                        <?php $no=1; foreach ($data_duty as $dd){ 
                                                        $date1 = date('Y-m-d',strtotime($dd->DueDate));
                                                        $date2 = date('Y-m-d');

                                                        $dateExpire = date_create($date1);
                                                        $datePost = date_create($date2);
                                                       
                                                        $diff=date_diff($dateExpire,$datePost); 
                                                        $diffcount = $diff->format("%R%a");
                                                        ?>
                                                            <tr>
                                                                <td align="center"><?php echo $no; ?></td>
                                                                <td><?php echo $dd->AssignmentTitle ?></td>
                                                                <td><?php echo $dd->AssignmentDetail ?></td>
                                                                <?php if ($diffcount == '-5'){ ?>
                                                                    <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dd->DueDate)); ?></font></td>
                                                                <?php }else if ($diffcount == '-4'){ ?>
                                                                    <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dd->DueDate)); ?></font></td>
                                                                <?php }else if ($diffcount == '-3'){ ?>
                                                                    <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dd->DueDate)); ?></font></td>
                                                                <?php }else if ($diffcount == '-2'){ ?>
                                                                    <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dd->DueDate)); ?></font></td>
                                                                <?php }else if ($diffcount == '-1'){ ?>
                                                                    <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dd->DueDate)); ?></font></td>
                                                                <?php }else if ($diffcount == '-0'){ ?>
                                                                    <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dd->DueDate)); ?></font></td>
                                                                <?php }else if ($diffcount >= '-5'){ ?>
                                                                    <td align="center" class="font-dark bold"><font color="#e7505a"><?php echo date('d-M-Y', strtotime($dd->DueDate)); ?></font></td>
                                                                <?php }else{ ?>
                                                                    <td align="center" class="font-dark bold" style="background-color: white"><font color="#32c5d2"><?php echo date('d-M-Y', strtotime($dd->DueDate)); ?></font></td>
                                                                <?php } ?>
                                                                <td align="center">
                                                                    <a class="btn btn-outline btn-sm blue newsassignments" data-ctrlno="<?= $dd->CtrlNo?>" title="Details"><i class="fa fa-search"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td align="center" class="font-red bold" colspan="4">No Data News & Assignment!</td></tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                            
                    </div>  
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light" style="background-color: white;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-check"></i> My Earnings </span>
                                </div>
                            </div>
                            <div class="portlet-body ">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: -20px">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-stripped">
                                                <thead class="font-white bg-blue-dark">
                                                    <tr>
                                                        <th width="10%" class="text-center uppercase">Date</th>
                                                        <th width="15%" class="text-center uppercase">Doc No</th>
                                                        <th width="25%" class="text-center uppercase">Description </th>
                                                        <th width="15%" class="text-center uppercase">Charge</th>
                                                        <th width="15%" class="text-center uppercase">Credit</th>
                                                        <th width="20%" class="text-center uppercase">Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                            
                    </div> 
                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 margin-bottom-20">
                        <div class="portlet light bg-blue-oleo" style="border: dotted 1px">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-edit font-white"></i>
                                    <!-- <span class="caption-subject bold uppercase font-white">INPUT NILAI HARIAN</span> -->
                                    <span class="caption-subject bold uppercase font-white">Daily Input Grade</span>
                                </div>
                            </div>
                        </div>
                        <div class="portlet light" style="height: 550px; margin-top: -55px">
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
                                                    <option value="">Choose KD</option>
                                                    <optgroup label="Pengetahuan" selected>
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
                    <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 margin-bottom-20">
                        <!-- BEGIN WIDGET PROGRESS -->
                        <div class="portlet light bg-blue-oleo" style="border: dotted 1px">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-edit font-white"></i>
                                    <span class="caption-subject bold uppercase font-white">INPUT ABSENT</span>
                                </div>
                            </div>
                        </div>
                        <div class="portlet light" style="height: 550px; margin-top: -55px">
                            <div class="form-body">
                                <div class="form-group" style="margin-top: 7px">
                                    <label>PILIH KELAS </label>
                                    <select class="form-control compact_rooms" id="attd_rooms_compact" style="width: 100%">
                                        <?php if (!empty($rooms) && $homeroom != '-') : ?>
                                            <option class="sbold" value="<?= $homeroom ?>">
                                                <?= $homeroom ?>
                                            </option>
                                        <?php else : ?>
                                            <option value=""> This ID is not an homeroom teacher </option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-grop">
                                    <label>NAMA SISWA</label>
                                    <?php if (!empty($rooms) && $homeroom != '-') : ?>
                                        <select class="form-control selectpicker compact_students" id="attd_student" data-live-search="true" data-size="8">
                                        </select>
                                    <?php else : ?>
                                        <select class="form-control">
                                            <option value=""> This ID is not an homeroom teacher </option>
                                        </select>
                                    <?php endif; ?>
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
                        <!-- END WIDGET PROGRESS -->
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-20" style="margin-top: -20px">
                        <!-- BEGIN WIDGET TAB -->
                        <div class="widget-bg-color-white widget-tab tabbable tabbable-tabdrop">
                            <ul class="nav nav-tabs">
                                <li class="disable">
                                     <h4 class="caption-subject font-dark bold uppercase"><i class="fa fa-clock-o"></i> Scheduling |</h4>
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light" style="background-color: white;">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase">Student Grade</span>
                                </div>
                                <div class="tools"> </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase">Recap Mid-Semester Siswa Kelas <?= $homeroom ?> SEMESTER <?= $this->session->userdata('semester') ?> TAHUN AJARAN <?= $this->session->userdata('period') ?></span>
                                </div>
                                <div class="actions">
                                    <a href="<?= base_url('Teacher/print_recap_mid')?>" class="btn green-jungle btn-xs btn-outline">
                                    <i class="fa fa-file-excel-o"></i>&nbsp;Export Recap</a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="full_mid_recap">
                                    <thead>
                                        <tr>
                                            <th class="all" width="1%">NIS</th>
                                            <th class="all" width="35%">Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase">Recap Absent Siswa Kelas <?= $homeroom ?> BULAN <?= date('F')?> SEMESTER <?= $this->session->userdata('semester') ?> TAHUN AJARAN <?= $this->session->userdata('period') ?></span>
                                </div>
                                <div class="actions">
                                    <a href="<?= base_url('Teacher/print_attendance_recap')?>" class="btn green-jungle btn-xs btn-outline">
                                    <i class="fa fa-file-excel-o"></i>&nbsp;Export Recap</a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="attd_recap">
                                    <thead>
                                        <tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-calendar font-dark"></i>
                                    <span class="caption-subject bold uppercase">School Calendar</span>
                                </div>
                                <div class="tools"> </div>
                            </div>
                            <div class="portlet-body">
                                <div class="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGE BASE CONTENT -->
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->

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
                    <h4 class="modal-title">ACADEMIC</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input has-info">
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
                                        <a href="#voc" data-toggle="tab" aria-expanded="false"> UKK/Prakerin </a>
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
                                    <div class="tab-pane" id="voc">
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
                                                                <select class="form-control edited selected_voc_rooms" id="form_control_1">
                                                                    <?php if (!empty($voc_rooms)) : ?>
                                                                        <?php foreach ($voc_rooms as $row) : ?>
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
                                                                <select class="form-control edited selected_voc_subj" id="form_control_1">
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
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-scrollable">
                                                            <table class="table table-condensed table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th> # </th>
                                                                        <th> NIS </th>
                                                                        <th> Name </th>
                                                                        <th class="text-center"> Grade </th>
                                                                        <th class="text-center"> Predicate </th>
                                                                        <th class="text-center"> Description </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="">
                                                                </tbody>
                                                            </table>
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
                                                <?php if($homeroom && $homeroom != '-') : ?>
                                                    <div class="form-group">
                                                        <label>PILIH KELAS</label>
                                                        <select class="form-control attd_rooms" style="width: 20%">
                                                            <?php if (!empty($rooms) && $homeroom != '-') : ?>
                                                                <option class="sbold" value="<?= $homeroom ?>">
                                                                    <?= $homeroom ?>
                                                                </option>
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
                                                <?php else : ?>
                                                    <h4> Only Homeroom Teacher can assign attendance...</h4>
                                                <?php endif;?>
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

    <!--=================================================== MODAL ASSIGN ELECTIVE =======================================================-->
    <div class="modal fade in full" id="modal_assign" tabindex="-1" role="dialog" aria-hidden="true" style="display: hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4> Assign Non-Regular Subject </h4>
                </div>
                <div class="modal-body">
                    <form id="assign_nonregular" role="form" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Student</label>
                                <div class="col-md-8">
                                    <input type="text" id="assign_name" name="assign_name" class="form-control" data-id="" data-cls="" data-room="" required readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Type</label>
                                <div class="col-md-8">
                                    <select type="text" id="assign_type" name="assign_type" class="form-control" required> 
                                        <option value="Elective">Linas Minat</option>
                                        <option value="Excul">Extra Kulikuler</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Day</label>
                                <div class="col-md-8">
                                    <select type="text" id="assign_day" name="assign_day" class="form-control" required> 
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Hour</label>
                                <div class="col-md-8">
                                    <select type="text" id="assign_hour" name="assign_hour" class="form-control" required disabled> 
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Subject</label>
                                <div class="col-md-8">
                                    <select type="text" id="assign_subject" name="assign_subject" class="form-control" required> 
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-8">
                                    <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn blue" form="assign_nonregular">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- MODAL News & Assingment -->
    <div class="modal fade in" id="newsassignmentModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: hidden;">
         <div class="modal-dialog modal-full" style="width: 95%">
             <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title uppercase">News & Assignment<span class="uppercase sbold"> Details</span></h4>
                 </div>
                 <div class="modal-body">
                    <div class="col-md-12" style="padding: 0px">
                        <div class="portlet light" style="background-color: #f6f6f6">
                            <div class="row form-horizontal" id="data_modal_newsassignment">
                                <!-- <?php if ($data_duty_all != false){ ?>
                                    <?php foreach ($data_duty_all as $dda){ ?>                
                                    <div class="col-md-9" style="margin-top: -10px">
                                        <div class="col-md-12">
                                            <div class="portlet-body">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label"><b>Document No</span></b></label>
                                                        <div class="col-md-3">
                                                            <input  class="form-control" value="<?php echo $dda->CtrlNo; ?>" readonly>                                            
                                                        </div>   
                                                        <label class="col-md-2 control-label"><b>Due Date</span></b></label>
                                                        <div class="col-md-3">
                                                            <input class="form-control font-red bold" value="<?php echo date('d-M-Y', strtotime($dda->DueDate)); ?>" readonly>                                            
                                                        </div> 
                                                    </div>
                                                </div>                                                                                               
                                            </div>
                                        </div>
                                        <div class="portlet light" style="background-color: #f6f6f6">
                                            <div class="row">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <span class="caption-subject font-dark sbold uppercase" ><i class="fa fa-warning"></i>  Description</span>
                                                        <p style="border: solid 1px;color: #555; margin-top: 5px"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-top: -15px">
                                                    <div class="portlet-body">
                                                         <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-md-2 control-label"><b>Type</span></b></label>
                                                                <div class="col-md-3">
                                                                    <input  class="form-control" style="background-color: white" value="<?php echo $dda->AssignmentType; ?>" readonly>                           
                                                                </div>                                                                   
                                                            </div>                                                      
                                                        </div>
                                                    </div>
                                                </div>                                           
                                            </div>
                                        </div>
                                        <div class="portlet light" style="background-color: #f6f6f6">
                                            <div class="row">
                                                <div class="col-md-12" style="margin-top: -55px">
                                                    <div class="portlet-body">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-md-2 control-label"><b>Title</span></b></label>
                                                                <div class="col-md-10">
                                                                    <input  class="form-control" rows="2" style="background-color: white" value="<?php echo $dda->AssignmentTitle ?>" readonly>                               
                                                                </div>                                                                   
                                                            </div>                                                      
                                                        </div>
                                                    </div>
                                                </div>                                           
                                            </div>
                                        </div>
                                        <div class="portlet light" style="background-color: #f6f6f6">
                                            <div class="row">
                                                <div class="col-md-12" style="margin-top: -55px">
                                                    <div class="portlet-body">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-md-2 control-label"><b>Details</span></b></label>
                                                                <div class="col-md-10 bold">
                                                                    "<?php echo $dda->AssignmentDetail ?>"  
                                                                </div>   
                                                            </div>                                                      
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                            
                                    <div class="col-md-3" style="border-left: solid; border-width: 1px; border-color: white; height: 400px">
                                        <div class="col-md-12 col-sm-12 col-xs-12 invoice-payment" style="background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa">
                                            <h3>Submited Status:</h3>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <strong>School <b style="margin-left: 20px">:</b></strong> <?php echo $dda->TypeSchool; ?>
                                                </li>
                                                <li>
                                                    <strong>Class <b style="margin-left: 28px">:</b></strong> <?php echo $dda->Class; ?>
                                                </li>
                                                <li>
                                                    <strong>Room <b style="margin-left: 26px">:</b></strong> <?php echo $dda->Room; ?>
                                                </li>
                                                <li>
                                                    <strong>To <b style="margin-left: 49px">:</b></strong> <?php echo $dda->IDNumber; ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 invoice-payment" style="margin-top: 30px; background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa">
                                            <h3>Submited:</h3>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <strong>By <b style="margin-left: 49px">:</b></strong> <?php echo $dda->SubmitBy; ?> </li>
                                                <li>
                                                    <strong>Date <b style="margin-left: 35px">:</b></strong> 
                                                    <input type="date" name="submitdate" class="form-control hidden" value="<?php echo $date; ?>" required>
                                                    <?php echo date('d-M-Y', strtotime($dda->SubmitDate)); ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <h2 align="center"  class="font-red bold">No Data News & Assignment!</h2>
                                <?php } ?> -->
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
<?php $this->load->view('header_footer/portal_teacher/footer'); ?>
<script type="text/javascript">
    $('.loader-wrapper').fadeOut("slow")
    document.body.style.zoom = 0.9;

    var dt_datatable_duty = $('#datatable_duty').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    $(document).on('click','.newsassignments', function() {
        let id_ctrlno = $(this).attr('data-ctrlno')
        $.ajax({
            url     : "<?php echo site_url('Teacher/get_detail_data_news_assigments'); ?>",
            type    : "POST",
            data    : {
                id_ctrlno
            },
            success : function(data){
                $('#data_modal_newsassignment').html(data)
                $('#newsassignmentModal').modal('show');
            }, error : function(){
                alert("Error to load Data !");
            }
        });
    });
</script>