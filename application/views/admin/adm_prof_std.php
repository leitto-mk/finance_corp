<?php $this->load->view('admin/navbar/adm_navbar'); ?>
<div class="container-fluid profiles">
    <div class="page-content">
        <?= $this->session->flashdata('addmsg'); ?>
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="portlet light"> 
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #e9edef; margin-top: -20px">
                    <div class="row">
                        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; padding-right: 0px">
                            <div class="portlet light" style="background-color: white; height: 580px">
                                <div class="text-center profile-userpic">
                                    <img src="<?= base_url() . 'assets/photos/student/' . $std_t->Photo; ?>" alt="" style="width:auto; height: 135px"/>                                                   
                                </div>
                                <hr>
                                <div class="text-center">
                                    <h5  class="img-rounded zoom bold"><?= $std_t->FirstName . ' ' . $std_t->MiddleName . ' ' . $std_t->LastName; ?></h5>
                                </div>
                                <hr style="margin: 9px 0;">
                                <table class="table" style="margin-bottom: 30px;">
                                    <tbody>
                                        <tr>
                                            <td width="28%" style="border-top: none;"><center><?= $std_t->status; ?></center></td>
                                        </tr>
                                        <tr>
                                            <td class="bold font-yellow" style="border-top: none;"><center>Class: <?= $std_t->Ruangan ?></center></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <div class="profile-userbuttons text-center" style="margin-top: 10px;">
                                    <a href="<?= base_url('Admin/load_prof_std_update/') . $std_t->IDNumber; ?>" class="btn btn-success btn-sm" style="min-width: 55px;">Edit</a>
                                    <a href="<?= base_url('Admin/delete/') . $std_t->IDNumber; ?>" class="btn btn-danger btn-sm" style="min-width: 45px;">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; padding: 0px">
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
                                                                <td width="38%" style="border-top: none;"> ID<font color="white">_</font>Number </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="bold" id="stock_detail_1" style="border-top: none;"><?= $std_t->IDNumber; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> First Name </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $std_t->FirstName; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Middle Name </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $std_t->MiddleName; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Last Name </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->LastName; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Nick Name </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->NickName; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Gender </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->Gender; ?></td>
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
                                                                <td width="38%" style="border-top: none;"> Date of Birth </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;"> <?= $std_t->DateofBirth; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Point of Birth </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $std_t->PointofBirth; ?></td>
                                                            </tr>                                 
                                                            <tr>
                                                                <td width="28%"> Religion </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $std_t->Religion; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Height </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $std_t->Height; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Weight </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $std_t->Weight; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Head Size </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $std_t->HeadDiameter; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="portlet light" style="background-color: white">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-book"></i> Academic Info</span>
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
                                                                <td width="38%" style="border-top: none;"> NIS </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="bold" id="stock_detail_1" style="border-top: none;"><?= $std_t->NIS; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> NISN </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $std_t->NISN; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Class</td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $std_t->Kelas; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Room </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->Ruangan; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Position </td>
                                                                <td width="1%"> : </td>
                                                                <?php if ($std_t->Position == '') : ?>
                                                                    <td class="sbold"> - </td>
                                                                <?php else : ?>
                                                                    <td class="sbold"> <?= $std_t->Position; ?> </td>
                                                                <?php endif; ?>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Competent </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->Competition; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Previous School </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->PreviousSchool; ?></td>
                                                            </tr>  
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" style="border-top: none;"> ID<font color="white">_</font>Diploma Number </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="bold" id="stock_detail_1" style="border-top: none;"><?= $std_t->Diploma; ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td width="28%"> Achievement </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->Achievement; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Achievement Level </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->AchievementLVL; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> AchievementName </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->AchievementName; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> AchievementYear </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->AchievementYear; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Sponsored By </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->Sponsor; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Achievement Rank </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->AchievementRank; ?></td>
                                                            </tr>  
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="margin-top: -20px">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>  
                                                            <tr>
                                                                <td width="38%" style="border-top: none;"> Scholarship </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;"> <?= $std_t->Scholarship; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Scholarship Description </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $std_t->ScholarDesc; ?></td>
                                                            </tr>                                 
                                                            <tr>
                                                                <td width="28%"> Scholarship Year Starts </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $std_t->ScholarStart; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Scholarship Year Finishes </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $std_t->ScholarFinish; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="margin-top: -20px">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>  
                                                            <tr>
                                                                <td width="38%" style="border-top: none;">  Prosperity Type </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;"> <?= $std_t->Prosperity; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Prosper Number </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $std_t->ProsperNumber; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Printed Name in Prosper Cards </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"><?= $std_t->ProsperNameTag; ?></td>
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
                                                                <th width="15%">Mobile :</th>
                                                                <th width="15%"> House Phone :</th>
                                                                <th width="15%">Phone :</th>
                                                                <th width="15%">WA :</th>
                                                                <th width="40%">Email :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?= $std_t->Phone; ?></td>
                                                                <td><?= $std_t->HousePhone; ?></td>
                                                                <td><?= $std_t->Phone; ?></td>
                                                                <td><?= $std_t->Phone; ?></td>
                                                                <td><?= $std_t->Email; ?></td>
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
                                                                <td class="bold"><u><?= $std_t->Address; ?>, <?= $std_t->RT; ?>, <?= $std_t->RW; ?>, <?= $std_t->Village; ?>, <?= $std_t->District; ?>, <?= $std_t->Region; ?>, <?= $std_t->Country; ?></u></td>
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
                            <div class="col-md-12" style="margin-top: -50px">
                                <div class="portlet light" style="background-color: white">
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" style="border-top: none;"> LiveWith </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="bold" id="stock_detail_1" style="border-top: none;"><?= $std_t->LiveWith; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Transportation </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $std_t->Transportation; ?></td>
                                                            </tr> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" style="border-top: none;"> Exact<font color="white">_</font>House<font color="white">_</font>Range </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="bold" id="stock_detail_1" style="border-top: none;"><?= $std_t->ExactRange; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Travel Time </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->TimeRange; ?></td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" style="border-top: none;"> Latitude </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="bold" id="stock_detail_1" style="border-top: none;"><?= $std_t->Latitude; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Longitude </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->Longitude; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-md-12">
                                <div class="portlet light" style="background-color: white">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-user"></i> Relationship</span>
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
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" style="border-top: none;"> Father's Name </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="bold" id="stock_detail_1" style="border-top: none;"><?= $std_t->Father; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> NIK </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $std_t->FatherNIK; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Born </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $std_t->FatherBorn; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Degree </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->FatherDegree; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Occupation </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->FatherJob; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Monthly Earning </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->FatherIncome; ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td width="28%"> Disability </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->FatherDisability; ?></td>
                                                            </tr> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" style="border-top: none;"> Mother's Name </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="bold" id="stock_detail_1" style="border-top: none;"><?= $std_t->Mother; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> NIK </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $std_t->MotherNIK; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Born </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $std_t->MotherBorn; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Degree </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->MotherDegree; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Occupation </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->MotherJob; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Monthly Earning </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->MotherIncome; ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td width="28%"> Disability </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->MotherDisability; ?></td>
                                                            </tr> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" style="border-top: none;">Guardian's Name </td>
                                                                <td width="1%" style="border-top: none;"> : </td>
                                                                <td class="bold" id="stock_detail_1" style="border-top: none;"><?= $std_t->Guardian; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> NIK </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $std_t->GuardianNIK; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Born </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold" id="stock_detail_6"> <?= $std_t->GuardianBorn; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Degree </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->GuardianDegree; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="28%"> Occupation </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->GuardianJob; ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="28%"> Monthly Earning </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->GuardianIncome; ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td width="28%"> Disability </td>
                                                                <td width="1%"> : </td>
                                                                <td class="sbold"> <?= $std_t->GuardianDisability; ?></td>
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
            </div>                            
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
</div>
<?php $this->load->view('_partials/_foot'); ?>