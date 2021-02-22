<?php $this->load->view('admin/navbar/adm_navbar'); ?>
<div class="container-fluid profiles">
    <div class="page-content">
        <?= $this->session->flashdata('addmsg'); ?>
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="portlet light"> 
            <div class="row">
                <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12">
                </div>
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="background-color: #e9edef; margin-top: -20px">
                    <div class="row">
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; padding-right: 0px">
                            <div class="portlet light" style="background-color: white; height: 560px">
                                <div class="text-center profile-userpic">
                                    <img src="<?= base_url() . 'assets/photos/teachers/' . $tch_t->Photo; ?>" alt="" style="width:auto; height: 190px"/>                                                   
                                </div>
                                <hr>
                                <div class="text-center">
                                    <h5  class="img-rounded zoom bold"><?= $tch_t->FirstName; ?>&nbsp;<?= $tch_t->LastName; ?></h5>
                                </div>
                                <hr style="margin: 9px 0;">
                                <table class="table" style="margin-bottom: 30px;">
                                    <tbody>
                                        <tr>
                                            <td width="28%" style="border-top: none;"><center>Job Description</center></td>
                                        </tr>
                                        <tr>
                                            <td class="bold font-yellow" style="border-top: none;"><center><?= $tch_t->JobDesc; ?></center></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <div class="profile-userbuttons text-center" style="margin-top: 10px;">
                                    <a href="<?= base_url('Admin/load_prof_tch_update/') . $tch_t->IDNumber; ?>" class="btn btn-success btn-sm" style="min-width: 55px;">Edit</a>
                                    <a href="<?= base_url('Admin/delete/') . $tch_t->IDNumber; ?>" class="btn btn-danger btn-sm" style="min-width: 45px;">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; padding: 0px">
                            <div class="col-md-12">
                                <div class="portlet light" style="background-color: white">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-user"></i> Personal Data</span>
                                        </div>
                                       <!--  <div class="actions">
                                            <a href="#" class="btn yellow btn-outline btn-sm edit-stock">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                            <a id="i_label" href="#" class="btn blue btn-outline btn-sm">
                                                <i class="fa fa-barcode"></i> Label
                                            </a>
                                        </div> -->
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="20%" style="border-top: none;"> ID<font color="white">_</font>Number </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="bold" id="stock_detail_1" style="border-top: none;"><?= $tch_t->IDNumber; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> ID<font color="white">_</font>Number<font color="white">_</font>Ref </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $tch_t->PersonalID; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Gender </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $tch_t->Gender; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> DOB </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $tch_t->DateofBirth; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> POB </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $tch_t->PointofBirth; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Religion </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $tch_t->Religion; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Occupation </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $tch_t->Occupation; ?></td>
                                                            </tr>  
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>  
                                                            <tr>
                                                                <td width="28%" style="border-top: none;"> Honorer </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;"> <?= $tch_t->Honorer; ?></td>
                                                            </tr>                                   
                                                            <tr>
                                                                <td width="28%"> Type </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $tch_t->Emp_Type; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Teaches </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $tch_t->SubjectTeach; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Homeroom </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $tch_t->Homeroom; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Education </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $tch_t->LastEducation; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Year </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $tch_t->YearStarts; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Marital </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $tch_t->MaritalStatus; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: -5px">
                                <div class="portlet light" style="background-color: white">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-dark bold uppercase"><i class="fa fa-phone"></i> Contact Detail</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table" style="margin-top: -10px">
                                                        <thead>
                                                            <tr>
                                                                <th width="20%">Mobile :</th>
                                                                <th width="20%">Phone :</th>
                                                                <th width="20%">WA :</th>
                                                                <th width="40%">Email :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?= $tch_t->Phone; ?></td>
                                                                <td><?= $tch_t->Phone; ?></td>
                                                                <td><?= $tch_t->Phone; ?></td>
                                                                <td><?= $tch_t->Email; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: -5px;">
                                <div class="portlet light" style="background-color: white">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-dark bold uppercase"><i class="fa fa-map-marker"></i> Address Detail</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table" style="margin-top: -10px">
                                                        <!-- <thead>
                                                            <tr>
                                                                <th width="100%">Address :</th>
                                                                <th width="15%">City :</th>
                                                                <th width="15%">Sub District :</th>
                                                                <th width="10%">District :</th>
                                                                <th width="10%">Region :</th>
                                                                <th width="10%">Province :</th>
                                                                <th width="10%">Country :</th>
                                                            </tr>
                                                        </thead> -->
                                                            <tr>
                                                                <td><?= $tch_t->Address; ?>, <?= $tch_t->City; ?>, <?= $tch_t->District; ?>, <?= $tch_t->Region; ?>, <?= $tch_t->Province; ?>, <?= $tch_t->Country; ?></td>
                                                                <!-- <td>Manado</td>
                                                                <td>Tuminting</td>
                                                                <td>Tuminting</td>
                                                                <td>Kota Manado</td>
                                                                <td>Sulawesi Utara</td>
                                                                <td>Indonesia</td> -->
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
                    </div>
                </div>
                <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12">
                </div>
            </div>                            
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
</div>
<?php $this->load->view('_partials/_foot'); ?>