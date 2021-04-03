<?php $this->load->view('header_footer/portal_student/header'); ?>
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
    #font-size-absent{
        font-size: 20px;
    }
</style>
 
<div class="container">
    <!-- BEGIN CONTAINER -->
    <div class="page-container bg-default">
        <?php $this->load->view('header_footer/portal_student/sidebar'); ?>
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="margin-top: -10px">
                <!-- BEGIN PAGE HEAD-->
                <div class="loader-wrapper">
                  <span class="loader"><span class="loader-inner"></span></span>
                </div>
                <?php if(!$active) : ?>
                    <div class="page-head">
                        <div class="portlet light bg-blue-hoki" style="height: 75px">
                            <h4 class="font-white bold" name='satya' data-id="<?= $id?>">
                                <?php if ($this->session->userdata('status') == 'admin') : ?>
                                <img src="<?= base_url() ?>assets/photos/adm/<?= $photo ?>" alt="" width="4%" height="4%">
                                <?php elseif ($this->session->userdata('status') == 'teacher') : ?>
                                    <img src="<?= base_url() ?>assets/photos/teachers/<?= $photo ?>" alt="" width="4%" height="4%">
                                <?php elseif ($this->session->userdata('status') == 'student') : ?>
                                    <img src="<?= base_url() ?>assets/photos/student/<?= $photo ?>" alt="" width="4%" height="4%">
                                <?php elseif ($this->session->userdata('status') == 'staff') : ?>
                                    <img src="<?= base_url() ?>assets/photos/staff/<?= $photo ?>" alt="" width="4%" height="4%">
                                <?php endif; ?> 
                                <?= "$id"; ?> | <u><?= "$fname $lname"; ?></u>
                                <small class="font-yellow-casablanca"></small>
                            </h4>
                        </div>
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-check icon-info"></i>
                                <span class="sbold uppercase"> WELCOME TO <?= $schoolappliedname ?> </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <?php if($is_enrolled) : ?>
                                <p>
                                    <span class="font-red">This is your current Username and Password for access:</span> 
                                        <br><br>
                                        USERNAME:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?= $id ?></strong>
                                        <br>
                                        PASSWORD:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>123456</strong>
                                        <br><br>
                                        <span class="font-red">
                                        *Please be advised, that Your Email Username (<?= $id ?>) will be changed to your new IDNumber after Your documents and payment have been approved. after that, You can no longer access Your Portal using your email address.
                                    </span> 
                                </p>
                                <hr>
                                <p class="margin-top-20 sbold uppercase"> 
                                    Your Data has been submitted
                                </p>
                                <?php if($is_approved_diploma) : ?>
                                    <div class="alert alert-success" style="margin: 15px 15px;">
                                        <strong>Success!</strong> Your <span class="sbold">Diploma</span> has been approved 
                                    </div>
                                <?php else:?>
                                    <div class="alert alert-danger" style="margin: 15px 15px;">
                                        <strong>Warning!</strong> Your <span class="sbold">Diploma</span> has not been approved yet. <br> Reason: <span class="uppercase"><?= $unapproved_diploma_msg ?></span>
                                    </div>
                                <?php endif;?>
                                <?php if($is_approved_birthcert) : ?>
                                    <div class="alert alert-success" style="margin: 15px 15px;">
                                        <strong>Success!</strong> Your <span class="sbold">Birth Certifiate</span> has been approved 
                                    </div>
                                <?php else:?>
                                    <div class="alert alert-danger" style="margin: 15px 15px;">
                                        <strong>Warning!</strong> Your <span class="sbold">Birth Certifiate</span> has not been approved yet. <br> Reason: <span class="uppercase"><?= $unapproved_birthcert_msg ?></span>
                                    </div>
                                <?php endif;?>
                                <?php if($is_approved_kk) : ?>
                                    <div class="alert alert-success" style="margin: 15px 15px;">
                                        <strong>Success!</strong> Your <span class="sbold">KK</span> has been approved 
                                    </div>
                                <?php else:?>
                                    <div class="alert alert-danger" style="margin: 15px 15px;">
                                        <strong>Warning!</strong> Your <span class="sbold">KK</span> has not been approved yet. <br> Reason: <span class="uppercase"><?= $unapproved_kk_msg ?></span>
                                    </div>
                                <?php endif;?>
                                <?php if($is_approved_photo) : ?>
                                    <div class="alert alert-success" style="margin: 15px 15px;">
                                        <strong>Success!</strong> Your <span class="sbold">Photo</span> has been approved 
                                    </div>
                                <?php else:?>
                                    <div class="alert alert-danger" style="margin: 15px 15px;">
                                        <strong>Warning!</strong> Your <span class="sbold">Photo</span> has not been approved yet. <br> Reason: <span class="uppercase"><?= $unapproved_photo_msg ?></span>
                                    </div>
                                <?php endif;?>
                                <?php if($is_approved_spp) : ?>
                                    <div class="alert alert-success" style="margin: 15px 15px;">
                                        <strong>Success!</strong> Your <span class="sbold">Tuition</span> has been approved 
                                    </div>
                                <?php else:?>
                                    <div class="alert alert-danger" style="margin: 15px 15px;">
                                        <strong>Warning!</strong> Your <span class="sbold">Tuition</span> has not been approved yet. <br> Reason: <span class="uppercase"><?= $unapproved_spp_msg ?></span>
                                    </div>
                                <?php endif;?>
                            <?php elseif(!$is_enrolled) : ?>
                                <p>
                                    <span class="font-red">This is your current Username and Password for access:</span> 
                                        <br><br>
                                        USERNAME:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?= $id ?></strong>
                                        <br>
                                        PASSWORD:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>123456</strong>
                                        <br><br>
                                        <span class="font-red">
                                        *Please be advised, that Your Email Username (<?= $id ?>) will be changed to your new IDNumber after Your documents and payment have been approved. after that, You can no longer access your Portal using your email address.
                                    </span> 
                                </p>
                                <hr>
                                <p class="margin-top-20"> 
                                    Please Complete Your Registration by Registering Your <b>Biodata</b>
                                </p>
                            <?php endif; ?>
                            <div class="row text-center">
                                <a href="<?= base_url("enrollment?first=$fname&last=$lname&school=$schoolapplied&mail=$id&birth=$birth&phone=$phone") ?>" type="button" class="btn btn-success" style="margin-bottom: 15px;">ENROLLMENT FORM</a>
                            </div>
                        </div>
                    </div>
                    <?php if($is_approved_diploma && $is_approved_birthcert && $is_approved_kk && $is_approved_photo && $is_approved_spp == 0) : ?>
                        <div class="row widget-row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet light" style="background-color: white; border : dotted 1px">
                                    <div class="portlet-body ">
                                        <div class="row">
                                            <div class="invoice-content-2 bordered">
                                                <div class="row invoice-head">
                                                    <div class="col-md-7 col-xs-6" style="margin-top: -70px">
                                                    
                                                        <h2 class="uppercase">Informasi Pembayaran</h2>
                                                        
                                                    </div>
                                                    <div class="col-md-5 col-xs-6 pull-right">
                                                        <div class="company-address font-dark">
                                                            <span class="bold uppercase">Hubungi :<br></span>
                                                            <span class="bold"><i class="fa fa-phone"></i></span> 0852-4088-4568 (Farland Lumentah, SE)
                                                            <br/>
                                                            <span class="bold"><i class="fa fa-phone"></i></span> 0813-5432-1100 (Tetty G. Kapoh, SE, MM)
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row invoice-cust-add" style="margin-top: -40px">
                                                    <div class="col-xs-6">
                                                        <h2 class="invoice-title uppercase">Notes</h2>
                                                        <p class="invoice-desc font-red"><i>* Pembayaran uang sekolah dilakukan di awal bulan/semester.<br><br>
                                                        *Permohonan pembayaan cicilan uang sekolah tidak lebih dari enam kali pembayaran dalam satu semester</i></p>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <h2 class="invoice-title uppercase">Cara Pembayaran :</h2>
                                                        <p class="invoice-desc inv-address font-dark">1 .Secara tunai di kantor keuangan sekolah atau<br>
                                                            2. Dilakukan lewat transfer rekening sekolah (Menunjukan bukti setoran yang dapat di kirim ke WA personil yang tertera di atas)<br>
                                                            3. Dilakukan lewat transfer rekening sekolah (Mengupload bukti setoran di form upload bukti bayar yang ada dibawah)<br><br>
                                                        No. Rekening Resmi Sekolah : <br>
                                                        <span class="bold">* BRI 5168 0100 44055 36 (SMA Advent Klabat)</span></p>
                                                    </div>
                                                </div>
                                                <div class="row invoice-body">
                                                    <div class="col-xs-12 table-responsive" style="margin-top: -50px">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class="invoice-title uppercase">Description</th>
                                                                    <th class="invoice-title uppercase text-center">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <h3>Biaya sekali bayar selama sekolah</h3>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 . Uang Pembangunan Advent
                                                                    </td>
                                                                    
                                                                    <td class="text-center sbold">Rp. 1.000.000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2 . Uang Pembangunan Non-Advent
                                                                    </td>
                                                                    
                                                                    <td class="text-center sbold">Rp. 1.300.000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="uppercase">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3 . Pendaftaran
                                                                    </td>
                                                                    
                                                                    <td class="text-center sbold">Rp. 150.000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <h3 style="margin-top: -5px">A . Biaya asuransi  per tahun</h3>
                                                                    </td>
                                                                    <td class="text-center sbold">Rp. 15.000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <h3>B . Biaya per semester (6 Bulan)</h3>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 . Uang Sekolah SMA/SMK Tanpa Asrama
                                                                    </td>
                                                                    
                                                                    <td class="text-center sbold">Rp. 2.400.000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2 . Uang Sekolah SMA/SMK & Biaya Asrama
                                                                    </td>
                                                                    
                                                                    <td class="text-center sbold">Rp. 8.000.000</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <label class="col-md-4 col-sm-4 control-label bold font-dark uppercase">Upload bukti transfer : </label>
                                                    <div class="col-md-8 col-sm-8">
                                                        <input type="file" name="photo" id="photo" class="dropify" data-id="<?= $id ?>" data-fname="<?= $fname ?>" data-lname="<?= $lname ?>" data-show-loader="false" data-height="250" data-allowed-file-extensions="jpg jpeg png">
                                                    </div>
                                                    <div class="col-xs-12" style="margin-top: 10px">
                                                        <a id="submit_tuition" class="btn btn-lg green-haze hidden-print uppercase print-btn">Upload</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    <?php else: ?>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue-dark" href="#">
                                <div class="visual">
                                    <i class="fa fa-building-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span><font size="5">Kelas :</font></span>
                                    </div>
                                    <div class="desc bold"> <?= $room ?> </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue-oleo" href="#">
                                <div class="visual">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span><font size="5">Wali Kelas :</font></span>
                                    </div>
                                    <div class="desc bold"> <?= $homeroom ?> </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span><font size="5">Jumlah Siswa :</font></span>
                                    </div>
                                    <div class="desc bold"> <?= $total ?> </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row widget-row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet light" style="background-color: white; border : dotted 1px">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-book"></i> Assignments Book (News & Announcement) </span>
                                </div>
                            </div>
                            <div class="portlet-body ">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: -20px">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-stripped" id="datatable_duty">
                                                <thead class="font-white bg-blue-dark">
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
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-check"></i> Student Account </span>
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
                                                <tbody id="idetailss">
                                                  
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
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-check"></i> Student Absent </span>
                                </div>
                            </div>
                            <div class="portlet-body ">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: -20px">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-stripped">
                                                <thead class="font-white bg-blue-dark">
                                                    <tr>
                                                        <th width="20%" class="text-center uppercase">Absent</th>
                                                        <th width="20%" class="text-center uppercase">Izin</th>
                                                        <th width="20%" class="text-center uppercase">Sakit</th>
                                                        <th width="20%" class="text-center uppercase">Bolos</th>
                                                        <th width="20%" class="text-center uppercase">Terlambat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td align="right" class="bold font-red" id="font-size-absent"><?= $absn ?></td>
                                                        <td align="right" class="bold font-green" id="font-size-absent"><?= $permit ?></td>
                                                        <td align="right" class="bold font-yellow" id="font-size-absent"><?= $sick ?></td>
                                                        <td align="right" class="bold font-blue" id="font-size-absent"><?= $truant ?></td>
                                                        <td align="right" class="bold font-purple" id="font-size-absent"><?= $late ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                            
                    </div>                          
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 margin-bottom-20">
                         <!-- BEGIN WIDGET TAB -->
                         <div class="widget-bg-color-white widget-tab">
                             <ul class="nav nav-tabs">
                                 <li class="disable">
                                     <h4 class="caption-subject font-dark bold uppercase"><i class="fa fa-clock-o"></i> SCHEDULE |</h4>
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
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
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
                <?php endif; ?>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    
    <!-- MODAL PROFILE -->
    <div class="modal fade in full" id="full" tabindex="-1" role="dialog" aria-hidden="true" style="display: hidden;">
         <div class="modal-dialog modal-full" style="width: 95%">
             <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title uppercase">Profile: <span class="uppercase sbold"><?= "$prof->FirstName $prof->LastName"; ?></span></h4>
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
                     <h4 class="modal-title">ACADEMIC</h4>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-md-3">
                             <div class="form-group form-md-line-input has-info">
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
                                                                 
                                                                 <li class="">
                                                                     <a data-toggle="tab" href="#tab_4-4" aria-expanded="true">
                                                                         <i class="fa fa-book"></i> Prakerin/UKK </a>
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
                                                                                             <th> MidRecap </th>
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
                                                                 <div id="tab_4-4" class="tab-pane">
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
                                                                                     <tbody class="voc_report_tbody">

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
                     <div class="form-group form-md-line-input has-info">
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
<?php $this->load->view('header_footer/portal_student/footer'); ?>
<script type="text/javascript">
    window.onload = load_function;

    function load_function() {
        $('.loader-wrapper').fadeOut("slow")
        document.body.style.zoom = 0.9;

        load_list_gl_student();

        $(document).ready(function(){
            $('.dropify').dropify();
        });
        
        //OPEN PROFILE FROM NAV-BAR
        $(document).on('click','#profilemodal',function () {
            $('a[href="#profile"]').click()
        })

        //CHANGE PASSWORD FROM NAV-BAR
        $(document).on('click','#changepassmodal',function () {
            $('a[href="#account"]').click()
        })

        $(document).on('click','.newsassignments', function() {
            let id_ctrlno = $(this).attr('data-ctrlno')
            $.ajax({
                url     : "<?php echo site_url('Student/get_detail_data_news_assigments'); ?>",
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
    }

    function load_list_gl_student(){
        let vcustomer = $(document).find('h4[name="satya"]').attr('data-id');
        mdocno = '';
        $.ajax({
            url: "<?php echo site_url('Student/get_po_customer') ?>",
            type: "POST",
            data: {
                id: vcustomer,
                mdocno: mdocno
            },
            dataType: 'json',
            success: function(data) {
                // console.log(data[0].beg_bal)
              /*  if (data[2] == '') {
                    alert('Charges of Student Not Set')
                }*/
                $('#idetailss').html(data[1]);
            },
            error: function(data) {
                alert('Error when select Customer');
            }
        })
    }
</script>