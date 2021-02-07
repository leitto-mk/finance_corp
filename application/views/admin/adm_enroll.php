<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<!-- APPROVE STUDENT -->
<div class="modal fade" id="new-std" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 30%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color: white">Appoint Student/s</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h2 class="display-1" style="margin-left: 10px"> Appoint to Class </h2>
                    <div class="col-sm-12 approve_std">
                        <!-- AJAX CALLBACK GOES HERE -->
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="submit" class="btn green bg-blue set_approve" style="min-width: 85px;">Approve</button>
                <button type="button" class="btn red bg-red" data-dismiss="modal" style="min-width: 85px;">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- EVALUATE STUDENT -->
<div class="modal fade" id="evaluate-std" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 30%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color: white">Data Evaluation</h4>
            </div>
            <div class="modal-body">
                <form id="form_evaluation" class="form-inline" role="form" method="POST">
                    <h4>Diploma</h4>
                    <div class="row">
                        <label class="mt-checkbox">
                            <input type="checkbox" id="checkdiploma" name="checkdiploma">
                            <span></span>
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="notediploma" name="notediploma" placeholder="Note">
                        </div>
                    </div>
                    <h4>Birth Certificate</h4>
                    <div class="row">
                        <label class="mt-checkbox">
                            <input type="checkbox" id="checkbirthcert" name="checkbirthcert">
                            <span></span>
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="notebirthcert" name="notebirthcert" placeholder="Note">
                        </div>
                    </div>
                    <h4>KK</h4>
                    <div class="row">
                        <label class="mt-checkbox">
                            <input type="checkbox" id="checkkk" name="checkkk">
                            <span></span>
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="notekk" name="notekk" placeholder="Note">
                        </div>
                    </div>
                    <h4>Photo</h4>
                    <div class="row">
                        <label class="mt-checkbox">
                            <input type="checkbox" id="checkphoto" name="checkphoto">
                            <span></span>
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="notephoto" name="notephoto" placeholder="Note">
                        </div>
                    </div>
                    <h4>SPP</h4>
                    <div class="row">
                        <label class="mt-checkbox">
                            <input type="checkbox" id="checkspp" name="checkspp">
                            <span></span>
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="notespp" name="notespp" placeholder="Note">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer text-center">
                <button type="submit" form="form_evaluation" class="btn green bg-blue set_approve_evaluation" style="min-width: 85px;">Approve</button>
                <button type="button" class="btn red bg-red" data-dismiss="modal" style="min-width: 85px;">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- PROFILE DETAILS -->
<div class="modal fade in" id="profile_detail" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 1250px">
        <div class="modal-content">
            <div class="modal-header" style="background-color: white ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color: black">Student Profile</h4>
            </div>
            <div class="modal-body">

                <div class="portlet-body">
                    <div class="tab-content">

                        <div class="col-md-12">
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
                                                                <td id="fullname"> </td>
                                                                <th class="uppercase"> Birth Place </th>
                                                                <td id="pointofbirth"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Nickname </th>
                                                                <td id="nickname"> </td>
                                                                <th class="uppercase"> Religion </th>
                                                                <td id="religion"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> NIK </th>
                                                                <td id="nik"> </td>
                                                                <th class="uppercase"> Height </th>
                                                                <td id="height"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Gender </th>
                                                                <td id="gender"> </td>
                                                                <th class="uppercase"> Weight </th>
                                                                <td id="weight"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Date of Birth </th>
                                                                <td id="dateofbirth"> </td>
                                                                <th class="uppercase"> Head Size </th>
                                                                <td id="headsize"> </td>
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
                                                                <td id="livewith"> </td>
                                                                <th class="uppercase"> Postal </th>
                                                                <td id="postal"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Transportation </th>
                                                                <td id="transportation"> </td>
                                                                <th class="uppercase"> House Range </th>
                                                                <td id="houserange"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Address </th>
                                                                <td id="address"> </td>
                                                                <th class="uppercase"> Exact House Range </th>
                                                                <td id="exactrange"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> RT </th>
                                                                <td id="rt"> </td>
                                                                <th class="uppercase"> Travel Time </th>
                                                                <td id="traveltime"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> RW </th>
                                                                <td id="rw"> </td>
                                                                <th class="uppercase"> Latitude </th>
                                                                <td id="latitude"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Village </th>
                                                                <td id="village"> </td>
                                                                <th class="uppercase"> Longitude </th>
                                                                <td id="longitude"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> District </th>
                                                                <td id="district"> </td>
                                                                <th class="uppercase"> Email </th>
                                                                <td id="email"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Region </th>
                                                                <td id="region"> </td>
                                                                <th class="uppercase"> HouseNumber </th>
                                                                <td id="housenumber"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Country </th>
                                                                <td id="country"> </td>
                                                                <th class="uppercase"> PhoneNumber </th>
                                                                <td id="phone"> </td>
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
                                                                <td id="nis"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Class </th>
                                                                <td id="class"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Ruang </th>
                                                                <td id="ruang"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Position </th>
                                                                <td id="position"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Competent </th>
                                                                <td id="competent"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Previous School </th>
                                                                <td id="previousschool"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Diploma Number </th>
                                                                <td id="diploma"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Achievement </th>
                                                                <td id="achievement"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Achievement Level </th>
                                                                <td id="achievementlevel"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> AchievementName </th>
                                                                <td id="achievementname"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> AchievementYear </th>
                                                                <td id="achievementyear"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Sponsored By </th>
                                                                <td id="sponsor"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Achievement Rank </th>
                                                                <td id="achievementrank"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Scholarship </th>
                                                                <td id="scholarship"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Scholarship Description </th>
                                                                <td id="scholardesc"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Scholarship Year Starts </th>
                                                                <td id="scholarstart"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Scholarship Year Finishes </th>
                                                                <td id="scholarend"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Prosperity Type </th>
                                                                <td id="prosper"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Prosper Number </th>
                                                                <td id="prospernum"> </td>
                                                            </tr>
                                                        </thead>
                                                        <thead>
                                                            <tr>
                                                                <th class="uppercase"> Printed Name in Prosper Card </th>
                                                                <td id="prospername"> </td>
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
                                                            <td id="fathername"> </td>
                                                            <th class="uppercase"> Mother's Name </th>
                                                            <td id="mothername"> </td>
                                                            <th class="uppercase"> Guardian's Name </th>
                                                            <td id="guardianname"> </td>
                                                        </tr>
                                                    </thead>
                                                    <thead>
                                                        <tr>
                                                            <th class="uppercase"> NIK </th>
                                                            <td id="fatherid"> </td>
                                                            <th class="uppercase"> NIK </th>
                                                            <td id="motherid"> </td>
                                                            <th class="uppercase"> NIK </th>
                                                            <td id="guardianid"> </td>
                                                        </tr>
                                                    </thead>
                                                    <thead>
                                                        <tr>
                                                            <th class="uppercase"> Born </th>
                                                            <td id="fatherborn"> </td>
                                                            <th class="uppercase"> Born </th>
                                                            <td id="motherborn"> </td>
                                                            <th class="uppercase"> Born </th>
                                                            <td id="guardianborn"> </td>
                                                        </tr>
                                                    </thead>
                                                    <thead>
                                                        <tr>
                                                            <th class="uppercase"> Degree </th>
                                                            <td id="fatherdegree"> </td>
                                                            <th class="uppercase"> Degree </th>
                                                            <td id="motherdegree"> </td>
                                                            <th class="uppercase"> Degree </th>
                                                            <td id="guardiandegree"> </td>
                                                        </tr>
                                                    </thead>
                                                    <thead>
                                                        <tr>
                                                            <th class="uppercase"> Occupation </th>
                                                            <td id="fatherjob"> </td>
                                                            <th class="uppercase"> Occupation </th>
                                                            <td id="motherjob"> </td>
                                                            <th class="uppercase"> Occupation </th>
                                                            <td id="guardianjob"> </td>
                                                        </tr>
                                                    </thead>
                                                    <thead>
                                                        <tr>
                                                            <th class="uppercase"> Monthly Earning </th>
                                                            <td id="fatherearn"> </td>
                                                            <th class="uppercase"> Monthly Earning </th>
                                                            <td id="motherearn"> </td>
                                                            <th class="uppercase"> Monthly Earning </th>
                                                            <td id="guardianearn"> </td>
                                                        </tr>
                                                    </thead>
                                                    <thead>
                                                        <tr>
                                                            <th class="uppercase"> Disability </th>
                                                            <td id="fatherdisable"> </td>
                                                            <th class="uppercase"> Disability </th>
                                                            <td id="motherdisable"> </td>
                                                            <th class="uppercase"> Disability </th>
                                                            <td id="guardiandisable"> </td>
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
                            <div class="col-md-12">
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class=" icon-layers font-green"></i>
                                            <span class="caption-subject font-green bold uppercase">DOCUMENTS</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="mt-element-card mt-element-overlay">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="col-xs-6">
                                                        <div class="mt-card-item">
                                                            <div class="mt-card-avatar mt-overlay-1">
                                                                <img name="diplomafile" src=""/>
                                                                <div class="mt-overlay">
                                                                    <ul class="mt-info">
                                                                        <li>
                                                                            <a name="diplomafile" class="btn default btn-outline" href="" download>
                                                                                <i class="icon-cloud-download"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="mt-card-content">
                                                                <h3 class="mt-card-name">Diploma</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="mt-card-item">
                                                            <div class="mt-card-avatar mt-overlay-1">
                                                                <img name="birthcertfile" src=""/>
                                                                <div class="mt-overlay mt-top">
                                                                    <ul class="mt-info">
                                                                        <li>
                                                                            <a name="birthcertfile" class="btn default btn-outline" href="" download>
                                                                                <i class="icon-cloud-download"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="mt-card-content">
                                                                <h3 class="mt-card-name">Birth Certificate</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="mt-card-item">
                                                            <div class="mt-card-avatar mt-overlay-1">
                                                                <img name="kkfile" src=""/>
                                                                <div class="mt-overlay">
                                                                    <ul class="mt-info">
                                                                        <li>
                                                                            <a name="kkfile" class="btn default btn-outline" href="" download>
                                                                                <i class="icon-cloud-download"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="mt-card-content">
                                                                <h3 class="mt-card-name">KK</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="mt-card-item">
                                                            <div class="mt-card-avatar mt-overlay-1">
                                                                <img name="photofile" src=""/>
                                                                <div class="mt-overlay">
                                                                    <ul class="mt-info">
                                                                        <li>
                                                                            <a name="photofile" class="btn default btn-outline" href="" download>
                                                                                <i class="icon-cloud-download"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="mt-card-content">
                                                                <h3 class="mt-card-name">Photo</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="col-xs-6">
                                                        <div class="mt-card-item">
                                                            <div class="mt-card-avatar mt-overlay-1">
                                                                <img name="sppfile" src=""/>
                                                                <div class="mt-overlay">
                                                                    <ul class="mt-info">
                                                                        <li>
                                                                            <a name="sppfile" class="btn default btn-outline" href="" download>
                                                                                <i class="icon-cloud-download"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="mt-card-content">
                                                                <h3 class="mt-card-name">SPP</h3>
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
                <div class="modal-footer">
                    <button type="button" class="btn green " data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="container-fluid enroll">
    <div class="page-content">
        <!-- BEGIN PAGE BASE CONTENT -->

        <div class="row">
            <div class="col-md-4">
                <a class="dashboard-stat dashboard-stat-v2 dark" href="#" style="background-color: #575B5B">
                    <div class="visual">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span class="enroll-total" data-counter="counterup" data-value="<?= $total ?>">
                            </span>
                        </div>
                        <br>
                        <div class="desc"> NEW REGISTRANT</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="portlet box" style="background-color: #575B5B">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Registrant List </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                </div>
            </div>
            <div class="portlet-body flip-scroll portlet-enroll" style="display: block;padding-top: 10px;">
                <table class="table table-light table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                        <tr>
                            <th> No. </th>
                            <th> Fullname </th>
                            <th> Date of Birth </th>
                            <th> Age </th>
                            <th> Gender </th>
                            <th> Previous School </th>
                            <th> Address </th>
                            <th> Applying </th>
                            <th> Registration Date </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody class="enroll-list">
                        <!-- AJAX TABLE GOES HERE -->
                    </tbody>
                </table>
            </div>
        </div>

        <?php $this->load->view('_partials/_foot'); ?>