<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<div class="container-fluid profiles">
    <div class="page-content">

        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="row profile">
                <div class="col-md-2">
                    <div class="profile-sidebar">

                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic" style="margin: auto;">
                            <img src="<?= base_url() . 'assets/photos/student/' . $std_t->Photo; ?>" class="img-responsive thumbnail img-circle" style="max-width: 100%;">
                        </div>
                        <!-- END SIDEBAR USERPIC -->

                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle text-center">
                            <div class="profile-usertitle-name text-uppercase h4">
                                <?= $std_t->FirstName . ' ' . $std_t->LastName; ?>
                            </div>
                            <div class="profile-usertitle-job text-uppercase h5" style="margin-top: 5px;">
                                <?= $std_t->status; ?> <br> Class: <?= $std_t->Ruangan ?>
                            </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->

                        <!-- SIDEBAR BUTTONS -->
                        <div class="profile-userbuttons text-center" style="margin-top: 10px;">
                            <a href="<?= base_url('Admin/load_prof_std_update/') . $std_t->IDNumber; ?>" class="btn btn-circle btn-sm blue btn_add_absn" style="min-width: 60px;">Edit</a>
                            <a href="<?= base_url('Admin/delete/') . $std_t->IDNumber; ?>" class="btn btn-circle btn-sm red btn_add_absn" style="min-width: 60px;">Delete</a>
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
                                                        <th class="uppercase"> Fullname </th>
                                                        <td> <?= "$std_t->FirstName $std_t->MiddleName $std_t->LastName"; ?> </td>
                                                        <th class="uppercase"> Birth Place </th>
                                                        <td> <?= $std_t->PointofBirth; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Nickname </th>
                                                        <td> <?= $std_t->NickName; ?> </td>
                                                        <th class="uppercase"> Religion </th>
                                                        <td> <?= $std_t->Religion; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> NIK </th>
                                                        <td> <?= $std_t->PersonalID; ?> </td>
                                                        <th class="uppercase"> Height </th>
                                                        <td> <?= $std_t->Height; ?> cm </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Gender </th>
                                                        <td> <?= $std_t->Gender; ?> </td>
                                                        <th class="uppercase"> Weight </th>
                                                        <td> <?= $std_t->Weight; ?> Kg </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Date of Birth </th>
                                                        <td> <?= $std_t->DateofBirth; ?> </td>
                                                        <th class="uppercase"> Head Size </th>
                                                        <td> <?= $std_t->HeadDiameter; ?> cm </td>
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
                                                        <td style="width: 25%"> <?= $std_t->LiveWith; ?> </td>
                                                        <th class="uppercase"> Postal </th>
                                                        <td> <?= $std_t->Postal; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Transportation </th>
                                                        <td> <?= $std_t->Transportation; ?> </td>
                                                        <th class="uppercase"> House Range </th>
                                                        <td> <?= $std_t->Range; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Address </th>
                                                        <td> <?= $std_t->Address; ?> </td>
                                                        <th class="uppercase"> Exact House Range </th>
                                                        <td> <?= $std_t->ExactRange; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> RT </th>
                                                        <td> <?= $std_t->RT; ?> </td>
                                                        <th class="uppercase"> Travel Time </th>
                                                        <td> <?= $std_t->TimeRange; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> RW </th>
                                                        <td> <?= $std_t->RW; ?> </td>
                                                        <th class="uppercase"> Latitude </th>
                                                        <td> <?= $std_t->Latitude; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Village </th>
                                                        <td> <?= $std_t->Village; ?> </td>
                                                        <th class="uppercase"> Longitude </th>
                                                        <td> <?= $std_t->Longitude; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> District </th>
                                                        <td> <?= $std_t->District; ?> </td>
                                                        <th class="uppercase"> Email </th>
                                                        <td> <?= $std_t->Email; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Region </th>
                                                        <td> <?= $std_t->Region; ?> </td>
                                                        <th class="uppercase"> HouseNumber </th>
                                                        <td> <?= $std_t->HousePhone; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Country </th>
                                                        <td> <?= $std_t->Country; ?> </td>
                                                        <th class="uppercase"> PhoneNumber </th>
                                                        <td> <?= $std_t->Phone; ?> </td>
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
                                                        <td> <?= $std_t->NIS; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Class </th>
                                                        <td> <?= $std_t->Kelas; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Ruang </th>
                                                        <td> <?= $std_t->Ruangan; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Position </th>
                                                        <?php if ($std_t->Position == '') : ?>
                                                            <td> - </td>
                                                        <?php else : ?>
                                                            <td> <?= $std_t->Position; ?> </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Competent </th>
                                                        <td> <?= $std_t->Competition; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Previous School </th>
                                                        <td> <?= $std_t->PreviousSchool; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Diploma Number </th>
                                                        <td> <?= $std_t->Diploma; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Achievement </th>
                                                        <td> <?= $std_t->Achievement; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Achievement Level </th>
                                                        <td> <?= $std_t->AchievementLVL; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> AchievementName </th>
                                                        <td> <?= $std_t->AchievementName; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> AchievementYear </th>
                                                        <td> <?= $std_t->AchievementYear; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Sponsored By </th>
                                                        <td> <?= $std_t->Sponsor; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Achievement Rank </th>
                                                        <td> <?= $std_t->AchievementRank; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Scholarship </th>
                                                        <td> <?= $std_t->Scholarship; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Scholarship Description </th>
                                                        <td> <?= $std_t->ScholarDesc; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Scholarship Year Starts </th>
                                                        <td> <?= $std_t->ScholarStart; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Scholarship Year Finishes </th>
                                                        <td> <?= $std_t->ScholarFinish; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Prosperity Type </th>
                                                        <td> <?= $std_t->Prosperity; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Prosper Number </th>
                                                        <td> <?= $std_t->ProsperNumber; ?> </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th class="uppercase"> Printed Name in Prosper Card </th>
                                                        <td> <?= $std_t->ProsperNameTag; ?> </td>
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
                                                    <td> <?= $std_t->Father; ?> </td>
                                                    <th class="uppercase"> Mother's Name </th>
                                                    <td> <?= $std_t->Mother; ?> </td>
                                                    <th class="uppercase"> Guardian's Name </th>
                                                    <td> <?= $std_t->Guardian; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> NIK </th>
                                                    <td> <?= $std_t->FatherNIK; ?> </td>
                                                    <th class="uppercase"> NIK </th>
                                                    <td> <?= $std_t->MotherNIK; ?> </td>
                                                    <th class="uppercase"> NIK </th>
                                                    <td> <?= $std_t->GuardianNIK; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Born </th>
                                                    <td> <?= $std_t->FatherBorn; ?> </td>
                                                    <th class="uppercase"> Born </th>
                                                    <td> <?= $std_t->MotherBorn; ?> </td>
                                                    <th class="uppercase"> Born </th>
                                                    <td> <?= $std_t->GuardianBorn; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Degree </th>
                                                    <td> <?= $std_t->FatherDegree; ?> </td>
                                                    <th class="uppercase"> Degree </th>
                                                    <td> <?= $std_t->MotherDegree; ?> </td>
                                                    <th class="uppercase"> Degree </th>
                                                    <td> <?= $std_t->GuardianDegree; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Occupation </th>
                                                    <td> <?= $std_t->FatherJob; ?> </td>
                                                    <th class="uppercase"> Occupation </th>
                                                    <td> <?= $std_t->MotherJob; ?> </td>
                                                    <th class="uppercase"> Occupation </th>
                                                    <td> <?= $std_t->GuardianJob; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Monthly Earning </th>
                                                    <td> <?= $std_t->FatherIncome; ?> </td>
                                                    <th class="uppercase"> Monthly Earning </th>
                                                    <td> <?= $std_t->MotherIncome; ?> </td>
                                                    <th class="uppercase"> Monthly Earning </th>
                                                    <td> <?= $std_t->GuardianIncome; ?> </td>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th class="uppercase"> Disability </th>
                                                    <td> <?= $std_t->FatherDisability; ?> </td>
                                                    <th class="uppercase"> Disability </th>
                                                    <td> <?= $std_t->MotherDisability; ?> </td>
                                                    <th class="uppercase"> Disability </th>
                                                    <td> <?= $std_t->GuardianDisability; ?> </td>
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