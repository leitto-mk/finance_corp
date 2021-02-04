<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<div class="container-fluid">
    <div class="page-content">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="profile">
            <div class="row">
                <div class="col-md-2">
                    <ul class="list-unstyled profile-nav">
                        <li style="text-align: center;">
                            <img src="<?= base_url(); ?>assets/photos/adm/<?= $photo; ?>" class="img-responsive img-circle" style="max-width: 100%;" alt="" />
                        </li>
                    </ul>
                </div>
                <div class="col-md-10">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1" data-toggle="tab"> Admin Bio </a>
                            </li>
                            <li>
                                <a href="#tab_2" data-toggle="tab"> Change Picture </a>
                            </li>
                            <li>
                                <a href="#tab_3" data-toggle="tab"> Change Password </a>
                            </li>
                        </ul>
                        <div class="tab-content">

                            <!-- ADMIN BIO -->
                            <div class="tab-pane active" id="tab_1">
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
                                                                    <td> <?= "$table->FirstName $table->LastName, $table->StudyFocus" ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase" width="30%"> Gender </th>
                                                                    <td> <?= $table->Gender; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase" width="30%"> Date of Birth </th>
                                                                    <td> <?= $table->DateofBirth; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase" width="30%"> Place of Birth </th>
                                                                    <td> <?= $table->PointofBirth; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase" width="30%"> Age </th>
                                                                    <?php
                                                                    $today = date("Y-m-d");
                                                                    $diff = date_diff(date_create($table->DateofBirth), date_create($today)); ?>
                                                                    <td> <?= $age = $diff->format('%y'); ?> </td>
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
                                                                    <td> <?= $table->Address; ?> </td>
                                                                    <th class="uppercase"> Provinsi </th>
                                                                    <td> <?= $table->Province; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Kecamatan </th>
                                                                    <td> <?= $table->District; ?> </td>
                                                                    <th class="uppercase"> Negara </th>
                                                                    <td> <?= $table->Country; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Kabupaten </th>
                                                                    <td> <?= $table->Region; ?> </td>
                                                                    <th class="uppercase"> Email </th>
                                                                    <td> <?= $table->Email; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Kota </th>
                                                                    <td> <?= $table->City; ?> </td>
                                                                    <th class="uppercase"> Telp </th>
                                                                    <td> <?= $table->Phone; ?> </td>
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
                                                                    <td class="sbold"> <?= $table->IDNumber; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Personal ID </th>
                                                                    <td> <?= $table->PersonalID; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Occupation </th>
                                                                    <td> <?= $table->Occupation; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Job Description </th>
                                                                    <td> <?= $table->JobDesc; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Honorer </th>
                                                                    <td> <?= $table->Honorer; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Employee Type </th>
                                                                    <td> <?= $table->Emp_Type; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Teaches </th>
                                                                    <td> <?= $table->SubjectTeach; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Homeroom </th>
                                                                    <td> <?= $table->Homeroom; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Last Education </th>
                                                                    <td> <?= $table->LastEducation; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Year Started </th>
                                                                    <td> <?= $table->YearStarts; ?> </td>
                                                                </tr>
                                                            </thead>
                                                            <thead>
                                                                <tr>
                                                                    <th class="uppercase"> Status Perkawinan </th>
                                                                    <td> <?= $table->MaritalStatus; ?> </td>
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
                            <!-- END ADMIN BIO -->

                            <!-- CHANGE AVATAR TAB -->
                            <div class="tab-pane" id="tab_2">
                                <?php $this->session->flashdata('disp_err') ?>
                                <p> Upload image for Admin </p>
                                <form action="<?= base_url('Admin/update_img_adm/') . $table->IDNumber; ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 230px; height: 235px;">
                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img-prev" alt="" style="min-width: 50%; min-height: 100%;"> </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="image" id="inputFile"> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="margin-top-20" style="float: left;">
                                                <button type="submit" class="btn green" style="min-height: 45px; min-width: 100px;"> Add </button>
                                                <a href="<?= base_url('Admin/load_prof_std_edit') ?>" class="btn default" style="padding-top: 12px;height: 45px; min-width: 100px;"> Cancel </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- END CHANGE AVATAR TAB -->

                            <!-- CHANGE PASSWORD TAB -->
                            <div class="tab-pane" id="tab_3">
                                <?= $this->session->flashdata('pass') ?>
                                <div class="portlet-body">
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
                            <!-- END CHANGE PASSWORD TAB -->



                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END PAGE BASE CONTENT -->
</div>
<?php $this->load->view('_partials/_foot'); ?>