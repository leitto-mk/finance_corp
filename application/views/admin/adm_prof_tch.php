<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<div class="container-fluid profiles">
    <div class="page-content">

        <!-- BEGIN PAGE BASE CONTENT -->
        <?= $this->session->flashdata('addmsg'); ?>
        <div class="row">

            <!-- BEGIN PROFILE DATA GURU-->
            <div class="col-lg-2">
                <div class="profile-sidebar">

                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet">

                        <div class="profile-userpic" style="margin: auto;">
                            <img src="<?= base_url() . 'assets/photos/teachers/' . $tch_t->Photo; ?>" class="img-responsive thumbnail img-circle" style="max-width: 100%;">
                        </div>

                        <br>

                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle text-center">
                            <span class="caption-subject font-blue bold uppercase"><?= $tch_t->FirstName; ?>&nbsp;<?= $tch_t->LastName; ?></span>
                            <br>
                            <br>
                            <div class="text-uppercase"> <?= $tch_t->status; ?> </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <br>
                        <div class="profile-userbuttons text-center" style="margin-top: 10px;">
                            <a href="<?= base_url('Admin/load_prof_tch_update/') . $tch_t->IDNumber; ?>" class="btn btn-success btn-sm" style="min-width: 55px;">Edit</a>
                            <a href="<?= base_url('Admin/delete/') . $tch_t->IDNumber; ?>" class="btn btn-danger btn-sm" style="min-width: 45px;">Delete</a>
                        </div>
                    </div>
                    <!-- END PORTLET MAIN -->

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
                                                    <td> <?= "$tch_t->FirstName $tch_t->LastName, $tch_t->StudyFocus" ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase" width="30%"> Gender </th>
                                                    <td> <?= $tch_t->Gender; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase" width="30%"> Date of Birth </th>
                                                    <td> <?= $tch_t->DateofBirth; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase" width="30%"> Place of Birth </th>
                                                    <td> <?= $tch_t->PointofBirth; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase" width="30%"> Age </th>
                                                    <?php
                                                    $today = date("Y-m-d");
                                                    $diff = date_diff(date_create($tch_t->DateofBirth), date_create($today)); ?>
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
                                                    <td> <?= $tch_t->Address; ?> </td>
                                                    <th class="uppercase"> Provinsi </th>
                                                    <td> <?= $tch_t->Province; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Kecamatan </th>
                                                    <td> <?= $tch_t->District; ?> </td>
                                                    <th class="uppercase"> Negara </th>
                                                    <td> <?= $tch_t->Country; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Kabupaten </th>
                                                    <td> <?= $tch_t->Region; ?> </td>
                                                    <th class="uppercase"> Email </th>
                                                    <td> <?= $tch_t->Email; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Kota </th>
                                                    <td> <?= $tch_t->City; ?> </td>
                                                    <th class="uppercase"> Telp </th>
                                                    <td> <?= $tch_t->Phone; ?> </td>
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
                                                    <td class="sbold"> <?= $tch_t->IDNumber; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Personal ID </th>
                                                    <td> <?= $tch_t->PersonalID; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Occupation </th>
                                                    <td> <?= $tch_t->Occupation; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Job Description </th>
                                                    <td> <?= $tch_t->JobDesc; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Honorer </th>
                                                    <td> <?= $tch_t->Honorer; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Employee Type </th>
                                                    <td> <?= $tch_t->Emp_Type; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Teaches </th>
                                                    <td> <?= $tch_t->SubjectTeach; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Homeroom </th>
                                                    <td> <?= $tch_t->Homeroom; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Last Education </th>
                                                    <td> <?= $tch_t->LastEducation; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Year Started </th>
                                                    <td> <?= $tch_t->YearStarts; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Status Perkawinan </th>
                                                    <td> <?= $tch_t->MaritalStatus; ?> </td>
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
        <!-- END PROFILE DATA GURU-->

    </div>
    <!-- END PAGE BASE CONTENT -->

    <?php $this->load->view('_partials/_foot'); ?>