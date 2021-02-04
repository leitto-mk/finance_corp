<?php $this->load->view('admin/navbar/adm_navbar'); ?>
<div class="container-fluid">
    <div class="page-content">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="portlet light"> 
            <div class="row">
                <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12">
                </div>
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="background-color: #e9edef; margin-top: -20px">
                    <div class="row">
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; padding-right: 0px">
                            <div class="portlet light" style="background-color: white; height: 560px">
                                <div class="text-center">
                                    <img src="<?= base_url(); ?>assets/photos/adm/<?= $photo; ?>" alt="" style="width:auto; height: 190px"/>                                                   
                                </div>
                                <hr>
                                <div class="text-center">
                                    <h5  class="img-rounded zoom bold"><?= "$table->FirstName $table->LastName, $table->StudyFocus" ?></h5>
                                </div>
                                <hr style="margin: 9px 0;">
                                <table class="table" style="margin-bottom: 30px;">
                                    <tbody>
                                        <tr>
                                            <td width="28%" style="border-top: none;"><center>Job Description</center></td>
                                        </tr>
                                        <tr>
                                            <td class="bold font-yellow" style="border-top: none;"><center><?= $table->JobDesc; ?></center></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; padding: 0px">
                            <div class="col-md-12">
                                <div class="tabbable-line tabbable-custom-profile pull-right">
                                     <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#personal" data-toggle="tab" class="uppercase"><b>Personal</b></a>
                                        </li>
                                        <li>
                                            <a href="#changepicture" data-toggle="tab" class="uppercase"><b>Picture</b></a>
                                        </li>
                                        <li>
                                            <a href="#changepassword" data-toggle="tab" class="uppercase"><b>Password</b></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personal">
                                        <div class="portlet light" style="background-color: white">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-user"></i> Detail Info</span>
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
                                                                        <td class="bold" id="stock_detail_1" style="border-top: none;"><?= $table->IDNumber; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="28%"> ID<font color="white">_</font>Number<font color="white">_</font>Ref  </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold"> <?= $table->PersonalID; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="28%"> Gender </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold" id="stock_detail_6"> <?= $table->Gender; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="28%"> DOB </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold" id="stock_detail_6"> <?= $table->DateofBirth; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="28%"> POB </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold"> <?= $table->PointofBirth; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="28%"> Religion </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold"> <?= $table->Religion; ?></td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <td width="28%"> Occupation </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold"><?= $table->Occupation; ?></td>
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
                                                                        <td class="sbold" style="border-top: none;"> <?= $table->Honorer; ?></td>
                                                                    </tr>                                     
                                                                    <tr>
                                                                        <td width="28%"> Type </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold"><?= $table->Emp_Type; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="28%"> Teaches </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold"><?= $table->SubjectTeach; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="28%"> Homeroom </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold"><?= $table->Homeroom; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="28%"> Education </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold"><?= $table->LastEducation; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="28%"> Year </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold"><?= $table->YearStarts; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="28%"> Marital </td>
                                                                        <td width="1%"> : </td>
                                                                        <td class="sbold"><?= $table->MaritalStatus; ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="changepicture">
                                        <?php $this->session->flashdata('disp_err') ?>
                                        <div class="portlet light" style="background-color: white">
                                            <h3> Change Picture </h3>
                                            <hr>
                                            <form action="<?= base_url('Admin/update_img_adm/') . $table->IDNumber; ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail" style="width: 130px; height: 100px;">
                                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img-prev" alt="" style="min-width: 30%; min-height: 10%;"> </div>
                                                                <div>
                                                                    <span class="btn default btn-file">
                                                                        <span class="fileinput-new"> Select image </span>
                                                                        <span class="fileinput-exists"> Change </span>
                                                                        <input type="file" name="image" id="inputFile"> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="margin-top-20" style="float: left;">
                                                            <button type="submit" class="btn green" style="min-height: 45px; min-width: 100px;"> Add </button>
                                                            <a href="<?= base_url('Admin/load_prof_std_edit') ?>" class="btn default" style="padding-top: 12px;height: 45px; min-width: 100px;"> Cancel </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="changepassword">
                                        <?= $this->session->flashdata('pass') ?>
                                        <div class="portlet light" style="background-color: white">
                                            <h3> Change Password </h3>
                                            <hr>
                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <form action="<?= base_url('admin/change_password/' . $table->IDNumber); ?>" method="POST">
                                                            <div class="form-group">
                                                                <label for="curpass" class="control-label">Current Password</label>
                                                                <input type="password" class="form-control" name="curpass" id="curpass">
                                                                <small class="text-danger"><?= form_error('curpass') ?></small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="newpass" class="control-label">New Password</label>
                                                                <input type="password" class="form-control" name="newpass" id="newpass">
                                                                <small class="text-danger"><?= form_error('newpass') ?></small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="renew" class="control-label">Confirm New Password</label>
                                                                <input type="password" class="form-control" name="renew" id="renew">
                                                                <small class="text-danger"><?= form_error('renew') ?></small>
                                                            </div>
                                                            <div class="margin-top-10">
                                                                <button class="btn green" type="submit">Save</button>
                                                                <a href="javascript:;?>" class="btn default"> Cancel </a>
                                                            </div>
                                                        </form>
                                                    </div>
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
                                                                <td><?= $table->Phone; ?></td>
                                                                <td><?= $table->Phone; ?></td>
                                                                <td><?= $table->Phone; ?></td>
                                                                <td><?= $table->Email; ?></td>
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
                                                                <td><?= $table->Address; ?>, <?= $table->City; ?>, <?= $table->District; ?>, <?= $table->Region; ?>, <?= $table->Province; ?>, <?= $table->Country; ?></td>
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