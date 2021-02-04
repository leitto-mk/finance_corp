<?php $this->load->view('header_footer/portal_board/header'); ?>
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
        <?php $this->load->view('header_footer/portal_board/sidebar'); ?>
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
                        <div class="portlet light" style="background-color: white;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-check"></i> Online Approval </span>
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
                                                        <th width="10%" class="text-center uppercase">Trans No</th>
                                                        <th width="25%" class="text-center uppercase">Description </th>
                                                        <th width="5%" class="text-center uppercase">Qty</th>
                                                        <th width="10%" class="text-center uppercase">Price</th>
                                                        <th width="10%" class="text-center uppercase">Amount</th>
                                                        <th width="10%" class="text-center uppercase">1</th>
                                                        <th width="10%" class="text-center uppercase">2</th>
                                                        <th width="10%" class="text-center uppercase">3</th>
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light" style="background-color: white;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold"><i class="fa fa-check"></i>CASH & BANK (Current Month)</span>
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
                                                        <th width="10%" class="text-center uppercase">Trans No</th>
                                                        <th width="25%" class="text-center uppercase">Description </th>
                                                        <th width="5%" class="text-center uppercase">Qty</th>
                                                        <th width="10%" class="text-center uppercase">Price</th>
                                                        <th width="10%" class="text-center uppercase">Amount</th>
                                                        <th width="10%" class="text-center uppercase">1</th>
                                                        <th width="10%" class="text-center uppercase">2</th>
                                                        <th width="10%" class="text-center uppercase">3</th>
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light" style="background-color: white;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-check"></i> Rekap Student </span>
                                </div>
                            </div>
                            <div class="portlet-body ">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: -20px">
                                        <div class="table-responsive">
                                            
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
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-check"></i> Rekap Teacher & Staff </span>
                                </div>
                            </div>
                            <div class="portlet-body ">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: -20px">
                                        <div class="table-responsive">
                                            
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
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-check"></i> Online Approval </span>
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
                                                        <th width="10%" class="text-center uppercase">Trans No</th>
                                                        <th width="25%" class="text-center uppercase">Description </th>
                                                        <th width="5%" class="text-center uppercase">Qty</th>
                                                        <th width="10%" class="text-center uppercase">Price</th>
                                                        <th width="10%" class="text-center uppercase">Amount</th>
                                                        <th width="10%" class="text-center uppercase">1</th>
                                                        <th width="10%" class="text-center uppercase">2</th>
                                                        <th width="10%" class="text-center uppercase">3</th>
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
                </div>
                <div class="row">
                    <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                                        <th width="3%" class="text-center">No</th>
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
                    </div> -->
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light" style="background-color: white; border: dotted 1px">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-book"></i> Asset Register </span>
                                </div>
                            </div>
                            <div class="portlet-body ">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: -20px">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-stripped" id="datatable_duty">
                                                <thead class="font-white bg-blue-oleo">
                                                    <tr>
                                                        <th width="3%" class="text-center">No</th>
                                                        <th width="25%" class="text-center">Asset No</th>
                                                        <th width="42%" class="text-center">Asset Description</th>
                                                        <th width="20%" class="text-center">Receive Date</th>
                                                        <th width="10%" class="text-center">Current Value</th>
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
<?php $this->load->view('header_footer/portal_board/footer'); ?>
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