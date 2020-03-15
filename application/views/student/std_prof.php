<?php $this->load->view('student/navbar/navbar'); ?>

<div class="container-fluid profiles">
    <div class="page-content">

        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="row profile">
                <div class="col-md-2">
                    <div class="profile-sidebar">

                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic" style="margin: auto;">
                            <img src="<?= base_url() . 'assets/photos/student/' . $table->Photo; ?>" class="img-responsive thumbnail img-circle" style="max-width: 100%;">
                        </div>
                        <!-- END SIDEBAR USERPIC -->

                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle text-center">
                            <div class="profile-usertitle-name text-uppercase h4">
                                <?= $table->FirstName . ' ' . $table->LastName; ?>
                            </div>
                            <div class="profile-usertitle-job text-uppercase h5" style="margin-top: 5px;">
                                <?= $table->status; ?> <br> Class: <?= $table->Ruangan ?>
                            </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->

                        <!-- SIDEBAR BUTTONS -->
                        <div class="profile-userbuttons text-center" style="margin-top: 10px;">
                            <a href="<?= base_url('Admin/load_prof_std_update/') . $table->IDNumber; ?>" class="btn btn-circle btn-sm blue btn_add_absn" style="min-width: 60px;">Edit</a>
                            <a href="<?= base_url('Admin/delete/') . $table->IDNumber; ?>" class="btn btn-circle btn-sm red btn_add_absn" style="min-width: 60px;">Delete</a>
                        </div>
                        <!-- END SIDEBAR BUTTONS -->

                    </div>
                </div>

                <?= $this->session->flashdata('updmsg') ?>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-sm-7">
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
                                                        <th class="uppercase"> Firstname </th>
                                                        <td> <?= $table->FirstName; ?> </td>
                                                        <th class="uppercase"> Birth Place </th>
                                                        <td> <?= $table->PointofBirth; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Lastname </th>
                                                        <td> <?= $table->LastName; ?> </td>
                                                        <th class="uppercase"> Religion </th>
                                                        <td> <?= $table->Religion; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> NIK </th>
                                                        <td> <?= $table->PersonalID; ?> </td>
                                                        <th class="uppercase"> Height </th>
                                                        <td> <?= $table->Height; ?> cm </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Gender </th>
                                                        <td> <?= $table->Gender; ?> </td>
                                                        <th class="uppercase"> Weight </th>
                                                        <td> <?= $table->Weight; ?> Kg </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Date of Birth </th>
                                                        <td> <?= $table->DateofBirth; ?> </td>
                                                        <th class="uppercase"> Head Size </th>
                                                        <td> <?= $table->HeadDiameter; ?> cm </td>
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
                                                        <td style="width: 25%"> <?= $table->LiveWith; ?> </td>
                                                        <th class="uppercase"> Postal </th>
                                                        <td> <?= $table->Postal; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Transportation </th>
                                                        <td> <?= $table->Transportation; ?> </td>
                                                        <th class="uppercase"> House Range </th>
                                                        <td> <?= $table->Range; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Address </th>
                                                        <td> <?= $table->Address; ?> </td>
                                                        <th class="uppercase"> Exact House Range </th>
                                                        <td> <?= $table->ExactRange; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> RT </th>
                                                        <td> <?= $table->RT; ?> </td>
                                                        <th class="uppercase"> Travel Time </th>
                                                        <td> <?= $table->TimeRange; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> RW </th>
                                                        <td> <?= $table->RW; ?> </td>
                                                        <th class="uppercase"> Latitude </th>
                                                        <td> <?= $table->Latitude; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Village </th>
                                                        <td> <?= $table->Village; ?> </td>
                                                        <th class="uppercase"> Longitude </th>
                                                        <td> <?= $table->Longitude; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> District </th>
                                                        <td> <?= $table->District; ?> </td>
                                                        <th class="uppercase"> Email </th>
                                                        <td> <?= $table->Email; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Region </th>
                                                        <td> <?= $table->Region; ?> </td>
                                                        <th class="uppercase"> HouseNumber </th>
                                                        <td> <?= $table->HousePhone; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Country </th>
                                                        <td> <?= $table->Country; ?> </td>
                                                        <th class="uppercase"> PhoneNumber </th>
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

                        <div class="col-sm-5">
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
                                                        <td> <?= $table->NIS; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Class </th>
                                                        <td> <?= $table->Kelas; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Ruang </th>
                                                        <td> <?= $table->Ruangan; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Position </th>
                                                        <?php if ($table->Position == '') : ?>
                                                            <td> - </td>
                                                        <?php else : ?>
                                                            <td> <?= $table->Position; ?> </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Competent </th>
                                                        <td> <?= $table->Competition; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Previous School </th>
                                                        <td> <?= $table->PreviousSchool; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Diploma Number </th>
                                                        <td> <?= $table->Diploma; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Achievement </th>
                                                        <td> <?= $table->Achievement; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Achievement Level </th>
                                                        <td> <?= $table->AchievementLVL; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> AchievementName </th>
                                                        <td> <?= $table->AchievementName; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> AchievementYear </th>
                                                        <td> <?= $table->AchievementYear; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Sponsored By </th>
                                                        <td> <?= $table->Sponsor; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Achievement Rank </th>
                                                        <td> <?= $table->AchievementRank; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Scholarship </th>
                                                        <td> <?= $table->Scholarship; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Scholarship Description </th>
                                                        <td> <?= $table->ScholarDesc; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Scholarship Year Starts </th>
                                                        <td> <?= $table->ScholarStart; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Scholarship Year Finishes </th>
                                                        <td> <?= $table->ScholarFinish; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Prosperity Type </th>
                                                        <td> <?= $table->Prosperity; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Prosper Number </th>
                                                        <td> <?= $table->ProsperNumber; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Printed Name in Prosper Card </th>
                                                        <td> <?= $table->ProsperNameTag; ?> </td>
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
                                                    <td> <?= $table->Father; ?> </td>
                                                    <th class="uppercase"> Mother's Name </th>
                                                    <td> <?= $table->Mother; ?> </td>
                                                    <th class="uppercase"> Guardian's Name </th>
                                                    <td> <?= $table->Guardian; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> NIK </th>
                                                    <td> <?= $table->FatherNIK; ?> </td>
                                                    <th class="uppercase"> NIK </th>
                                                    <td> <?= $table->MotherNIK; ?> </td>
                                                    <th class="uppercase"> NIK </th>
                                                    <td> <?= $table->GuardianNIK; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Born </th>
                                                    <td> <?= $table->FatherBorn; ?> </td>
                                                    <th class="uppercase"> Born </th>
                                                    <td> <?= $table->MotherBorn; ?> </td>
                                                    <th class="uppercase"> Born </th>
                                                    <td> <?= $table->GuardianBorn; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Degree </th>
                                                    <td> <?= $table->FatherDegree; ?> </td>
                                                    <th class="uppercase"> Degree </th>
                                                    <td> <?= $table->MotherDegree; ?> </td>
                                                    <th class="uppercase"> Degree </th>
                                                    <td> <?= $table->GuardianDegree; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Occupation </th>
                                                    <td> <?= $table->FatherJob; ?> </td>
                                                    <th class="uppercase"> Occupation </th>
                                                    <td> <?= $table->MotherJob; ?> </td>
                                                    <th class="uppercase"> Occupation </th>
                                                    <td> <?= $table->GuardianJob; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Monthly Earning </th>
                                                    <td> <?= $table->FatherIncome; ?> </td>
                                                    <th class="uppercase"> Monthly Earning </th>
                                                    <td> <?= $table->MotherIncome; ?> </td>
                                                    <th class="uppercase"> Monthly Earning </th>
                                                    <td> <?= $table->GuardianIncome; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Disability </th>
                                                    <td> <?= $table->FatherDisability; ?> </td>
                                                    <th class="uppercase"> Disability </th>
                                                    <td> <?= $table->MotherDisability; ?> </td>
                                                    <th class="uppercase"> Disability </th>
                                                    <td> <?= $table->GuardianDisability; ?> </td>
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

            </div>
        </div>
        
        <!-- END PAGE BASE CONTENT -->
<?php $this->load->view('_partials/_foot'); ?>