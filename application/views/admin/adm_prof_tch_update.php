<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<div class="container-fluid profiles">
    <div class="page-content">
        <!-- BEGIN PAGE BASE CONTENT -->

        <?= $this->session->flashdata('addmsg'); ?>
        <div class="row">


            <!-- BEGIN PROFILE DATA GURU-->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="profile-sidebar">
                            <!-- PORTLET MAIN -->
                            <div class="portlet light profile-sidebar-portlet">
                                <!-- SIDEBAR USERPIC -->
                                <div class="profile-userpic">
                                    <img src="<?= base_url() . 'assets/photos/teachers/' . $datatoedit->Photo; ?>" class="img-responsive thumbnail img-circle" style="max-width: 100%;">
                                </div>
                                <!-- END SIDEBAR USERPIC -->
                                <br>
                                <!-- SIDEBAR USER TITLE -->
                                <div class="profile-usertitle text-center">
                                    <span class="caption-subject font-blue bold uppercase"><?= $datatoedit->FirstName; ?>&nbsp;<?= $datatoedit->LastName; ?></span>
                                    <br>
                                    <br>
                                    <div class="text-uppercase"> <?= $datatoedit->status ?> </div>
                                </div>
                                <!-- END SIDEBAR USER TITLE -->
                                <br>
                            </div>
                            <!-- END PORTLET MAIN -->

                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Update Teacher / Staff Data</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">Change Photo</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <form role="form" action="<?= base_url('Admin/update_tch/') . $datatoedit->IDNumber ?>" method="POST">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4 style="background-color: #2f373e; height: 30px;padding-top: 5px">
                                                        <font color="white">&nbsp;&nbsp;&nbsp;Biodata</font>
                                                    </h4>
                                                    <div class="form-group">
                                                        <label class="control-label">ID Teacher</label>
                                                        <input type="text" placeholder="ID" class="form-control" name="newid" id="newid" value="<?= $datatoedit->IDNumber ?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Previeges</label>
                                                        <select name="previlege" class="form-control" name="previlege" id="previlege">
                                                            <option value="-" <?php if ($datatoedit->status == '-') echo 'selected' ?>>-- Choose --</option>
                                                            <option value="admin" <?php if ($datatoedit->status == 'admin') echo 'selected' ?>>Admin</option>
                                                            <option value="teacher" <?php if ($datatoedit->status == 'teacher') echo 'selected' ?>>Teacher</option>
                                                            <option value="staff" <?php if ($datatoedit->status == 'staff') echo 'selected' ?>>Staff</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Firstname</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-user"></i>
                                                            </span>
                                                            <input type="text" class="form-control" placeholder="Nama Depan" name="newfname" id="newfname" value="<?= $datatoedit->FirstName ?>"> </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Lastname</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-user"></i>
                                                            </span>
                                                            <input type="text" class="form-control" placeholder="Nama Belakang" name="newlname" id="newlname" value="<?= $datatoedit->LastName ?>"> </div>
                                                    </div>
                                                    <div class="form-group form-md-radios">
                                                        <label class="control-label" style="color: black"> Gender</label>
                                                        <div class="md-radio-inline">
                                                            <div class="md-radio">
                                                                <input type="radio" id="male" name="gender" class="md-radiobtn" value="Laki-Laki" <?php if ($datatoedit->Gender == 'Laki-Laki') echo 'checked' ?>>
                                                                <label for="male">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Male </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="female" name="gender" class="md-radiobtn" value="Perempuan" <?php if ($datatoedit->Gender == 'Perempuan') echo 'checked' ?>>
                                                                <label for="female">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Female </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Date of Birth</label>
                                                        <!-- <input type="text" placeholder="Tanggal Lahir" class="form-control" > -->
                                                        <input class="form-control input-medium" name="newtgllhr" id="newtgllhr" size="30" type="date" value="<?= $datatoedit->DateofBirth ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Place of Birth</label>
                                                        <input type="text" placeholder="Tempat Lahir" class="form-control" name="newtmplhr" id="newtmplhr" value="<?= $datatoedit->PointofBirth ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Marital Status</label>
                                                        <select name="marital" class="form-control" name="marital" id="marital">
                                                            <option value="-" <?php if ($datatoedit->MaritalStatus == '-') echo 'selected' ?>>-- Choose --</option>
                                                            <option id="marital" value="Belum Menikah" <?php if ($datatoedit->MaritalStatus == 'Belum Menikah') echo 'selected' ?>>Single</option>
                                                            <option id="marital" value="Menikah" <?php if ($datatoedit->MaritalStatus == 'Menikah') echo 'selected' ?>>Married</option>
                                                            <option id="marital" value="Duda/Janda" <?php if ($datatoedit->MaritalStatus == 'Duda/Janda') echo 'selected' ?>>Widower</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Religion</label>
                                                        <select name="Religion" class="form-control">
                                                            <?php if ($datatoedit->Religion == 'Budha') : ?>
                                                                <option value="Budha" selected>Budha</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Katolik">Katholik</option>
                                                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                                                <option value="Kristen">Kristen</option>
                                                                <option value="Advent">Advent</option>
                                                            <?php elseif ($datatoedit->Religion == 'Hindu') : ?>
                                                                <option value="Budha">Budha</option>
                                                                <option value="Hindu" selected>Hindu</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Katolik">Katholik</option>
                                                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                                                <option value="Kristen">Kristen</option>
                                                                <option value="Advent">Advent</option>
                                                            <?php elseif ($datatoedit->Religion == 'Islam') : ?>
                                                                <option value="Budha">Budha</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Islam" selected>Islam</option>
                                                                <option value="Katolik">Katholik</option>
                                                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                                                <option value="Kristen">Kristen</option>
                                                                <option value="Advent">Advent</option>
                                                            <?php elseif ($datatoedit->Religion == 'Katolik') : ?>
                                                                <option value="Budha">Budha</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Katolik" selected>Katholik</option>
                                                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                                                <option value="Kristen">Kristen</option>
                                                                <option value="Advent">Advent</option>
                                                            <?php elseif ($datatoedit->Religion == 'Kong Hu Cu') : ?>
                                                                <option value="Budha">Budha</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Katolik">Katholik</option>
                                                                <option value="Kong Hu Cu" selected>Kong Hu Cu</option>
                                                                <option value="Kristen">Kristen</option>
                                                                <option value="Advent">Advent</option>
                                                            <?php elseif ($datatoedit->Religion == 'Kristen') : ?>
                                                                <option value="Budha">Budha</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Katolik">Katholik</option>
                                                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                                                <option value="Kristen" selected>Kristen</option>
                                                                <option value="Advent">Advent</option>
                                                            <?php elseif ($datatoedit->Religion == 'Advent') : ?>
                                                                <option value="Budha">Budha</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Katolik">Katholik</option>
                                                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                                                <option value="Kristen">Kristen</option>
                                                                <option value="Advent" selected>Advent</option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <h4 style="background-color: #2f373e; height: 30px;padding-top: 5px">
                                                            <font color="white">&nbsp;&nbsp;&nbsp;Employment Info</font>
                                                        </h4>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label">ID License </label>
                                                                <input type="text" placeholder="No KTP Guru" class="form-control" name="newktp" id="newktp" value="<?= $datatoedit->PersonalID ?>"> </div>
                                                            <div class="form-group form-md-radios">
                                                                <label class="control-label" style="color: black">Occupation</label>
                                                                <div class="md-radio-list">
                                                                    <div class="md-radio">
                                                                        <input type="radio" id="teachers" name="status" class="md-radiobtn" value="teacher" <?php if ($datatoedit->Occupation == 'teacher') echo 'checked' ?>>
                                                                        <label for="teachers">
                                                                            <span></span>
                                                                            <span class="check"></span>
                                                                            <span class="box"></span> Teacher </label>
                                                                    </div>
                                                                    <div class="md-radio">
                                                                        <input type="radio" id="staffs" name="status" class="md-radiobtn" value="staff" <?php if ($datatoedit->Occupation == 'staff') echo 'checked' ?>>
                                                                        <label for="staffs">
                                                                            <span></span>
                                                                            <span class="check"></span>
                                                                            <span class="box"></span> Staff </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-md-radios">
                                                                <label class="control-label" style="color: black"> Non-Permanent / Honorer</label>
                                                                <div class="md-radio-inline">
                                                                    <div class="md-radio">
                                                                        <input type="radio" id="honoreryes" name="honorer" class="md-radiobtn" value="yes" <?php if ($datatoedit->Honorer == 'yes') echo 'checked' ?>>
                                                                        <label for="honoreryes">
                                                                            <span></span>
                                                                            <span class="check"></span>
                                                                            <span class="box"></span> Yes </label>
                                                                    </div>
                                                                    <div class="md-radio">
                                                                        <input type="radio" id="honorerno" name="honorer" class="md-radiobtn" value="no" <?php if ($datatoedit->Honorer == 'no') echo 'checked' ?>>
                                                                        <label for="honorerno">
                                                                            <span></span>
                                                                            <span class="check"></span>
                                                                            <span class="box"></span> No </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Job Description (for Non-Teacher) </label>
                                                                <input type="text" placeholder="Deskripsi Pekerjaan" class="form-control" name="jobdesc" id="jobdesc" value="<?= $datatoedit->JobDesc ?>"> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Employee Type</label>
                                                                <select name="emp" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->Emp_Type == '-') echo 'selected' ?>>-- Choose --</option>
                                                                    <option value="PNS" <?php if ($datatoedit->Emp_Type == 'PNS') echo 'selected' ?>>PNS</option>
                                                                    <option value="GTY" <?php if ($datatoedit->Emp_Type == 'GTY') echo 'selected' ?>>GTY</option>
                                                                    <option value="PTY" <?php if ($datatoedit->Emp_Type == 'PTY') echo 'selected' ?>>PTY</option>
                                                                    <option value="GTT" <?php if ($datatoedit->Emp_Type == 'GTT') echo 'selected' ?>>GTT</option>
                                                                    <option value="PTT" <?php if ($datatoedit->Emp_Type == 'PTT') echo 'selected' ?>>PTT</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Homeroom / Advisor</label>
                                                                <select name="homeroom" class="form-control">
                                                                    <option id="homeroom" value="-">-- Choose --</option>
                                                                    <?php $i = 1; ?>
                                                                    <?php foreach ($room as $row) : ?>
                                                                        <option id="homeroom" value="<?= $row->RoomDesc; ?>" <?php if ($row->RoomDesc == $datatoedit->Homeroom) echo 'selected' ?>><?= $row->RoomDesc; ?></option>
                                                                        <?php $i++; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Teaches</label>
                                                                <select name="subjteach" class="form-control">
                                                                    <option value="-">-- Choose --</option>
                                                                    <?php $i = 1; ?>
                                                                    <?php foreach ($subj as $row) : ?>
                                                                        <option id="subjteach" value="<?= $row->SubjName; ?>" <?php if ($row->SubjName == $datatoedit->SubjectTeach) echo 'selected' ?>><?= $row->SubjName; ?></option>
                                                                        <?php $i++; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Current Degree</label>
                                                                <select name="education" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->LastEducation == '-') echo 'selected' ?>>-- Choose --</option>
                                                                    <option id="education" value="SD" <?php if ($datatoedit->LastEducation == 'Diploma 1') echo 'selected' ?>>SD</option>
                                                                    <option id="education" value="SMP" <?php if ($datatoedit->LastEducation == 'Diploma 2') echo 'selected' ?>>SMP</option>
                                                                    <option id="education" value="SMA" <?php if ($datatoedit->LastEducation == 'Diploma 3') echo 'selected' ?>>SMA</option>
                                                                    <option id="education" value="Diploma 1" <?php if ($datatoedit->LastEducation == 'Diploma 1') echo 'selected' ?>>Diploma 1</option>
                                                                    <option id="education" value="Diploma 2" <?php if ($datatoedit->LastEducation == 'Diploma 2') echo 'selected' ?>>Diploma 2</option>
                                                                    <option id="education" value="Diploma 3" <?php if ($datatoedit->LastEducation == 'Diploma 3') echo 'selected' ?>>Diploma 3</option>
                                                                    <option id="education" value="Diploma 4" <?php if ($datatoedit->LastEducation == 'Diploma 4') echo 'selected' ?>>Diploma 4</option>
                                                                    <option id="education" value="Strata 1" <?php if ($datatoedit->LastEducation == 'Strata 1') echo 'selected' ?>>Strata 1</option>
                                                                    <option id="education" value="Strata 2" <?php if ($datatoedit->LastEducation == 'Strata 2') echo 'selected' ?>>Strata 2</option>
                                                                    <option id="education" value="Strata 3" <?php if ($datatoedit->LastEducation == 'Strata 3') echo 'selected' ?>>Strata 3</option>
                                                                </select> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Last Diploma / Degree Title</label>
                                                                <input type="text" placeholder="Ijazah Terakhir" class="form-control" name="diploma" id="diploma" value="<?= $datatoedit->StudyFocus ?>"> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Year Start</label>
                                                                <input type="text" placeholder="Tahun Masuk" class="form-control" name="starts" id="starts" value="<?= $datatoedit->YearStarts ?>"> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Govt. Certificate</label>
                                                                <input type="text" placeholder="Certificate" class="form-control" name="govt" id="govt" value="<?= $datatoedit->Govt_Cert ?>"> </div>
                                                            <div class="portlet solid grey">
                                                                <div class="portlet-title">
                                                                    <div class="form-group" style="margin-top: 25px;">
                                                                        <div class="md-checkbox-inline">
                                                                            <div class="md-checkbox">
                                                                                <input type="checkbox" id="institute" name="institute" class="md-check" <?php if ($datatoedit->Institute_Cert == 'yes') echo 'checked'; ?>>
                                                                                <label for="institute">
                                                                                    <span class="inc"></span>
                                                                                    <span class="check"></span>
                                                                                    <span class="box"></span> Institute Certificate </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <h4 style="background-color: #2f373e; height: 30px;padding-top: 5px">
                                                        <font color="white">&nbsp;&nbsp;&nbsp;Address / Contact</font>
                                                    </h4>
                                                    <div class="form-group">
                                                        <label class="control-label">Address</label>
                                                        <input type="text" placeholder="Alamat" class="form-control" name="newaddr" id="newaddr" value="<?= $datatoedit->Address ?>"> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">District</label>
                                                        <input type="text" placeholder="Kecamatan" class="form-control" name="newdis" id="newdis" value="<?= $datatoedit->District ?>"> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Region</label>
                                                        <input type="text" placeholder="Kabupaten" class="form-control" name="newreg" id="newreg" value="<?= $datatoedit->Region ?>"> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">City</label>
                                                        <input type="text" placeholder="Kota" class="form-control" name="newcity" id="newcity" value="<?= $datatoedit->City ?>"> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Province</label>
                                                        <input type="text" placeholder="Provinsi" class="form-control" name="newprov" id="newprov" value="<?= $datatoedit->Province ?>"> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Nationality</label>
                                                        <input type="text" placeholder="Negara" class="form-control" name="newnat" id="newnat" value="<?= $datatoedit->Country ?>"> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <div class="input-group input-icon right">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope font-purple"></i>
                                                            </span>
                                                            <i class="fa fa-exclamation tooltips" data-original-title="Invalid email." data-container="body"></i>
                                                            <input id="email" class="input-error form-control" type="text" name="newmail" value="<?= $datatoedit->Email ?>"> </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Contact</label>
                                                        <input type="text" placeholder="No. Telp" class="form-control" name="newtelp" id="newtelp" value="<?= $datatoedit->Phone ?>"> </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="margin-top-20" style="float: right;">
                                                        <button type="submit" class="btn default" style="padding-top: 8px;height: 45px; min-width: 100px;"> UPDATE </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->



                                    <!-- CHANGE AVATAR TAB -->
                                    <div class="tab-pane" id="tab_1_2">
                                        <?php 
                                            $flash = $this->session->flashdata('disp_err');
                                            if(isset($flash)){
                                                echo    "<div class=\"note note-danger\">
                                                            <p> $flash </p>
                                                         </div>"; 
                                            }
                                        ?>
                                        <p> Upload image for Teacher </p>
                                        <form action="<?= base_url('Admin/update_img_tch/') . $datatoedit->IDNumber; ?>" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 230px; height: 235px;">
                                                        <img src="<?= base_url('assets/photos/noimage.gif') ?>" id="img-prev" alt="" style="min-width: 80%; min-height: 100%;"> </div>
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
                                                        <a href="<?= base_url('Admin/load_prof_tch_edit') ?>" class="btn default" style="padding-top: 12px;height: 45px; min-width: 100px;"> Cancel </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE AVATAR TAB -->



                                    <!-- CHANGE PASSWORD TAB -->
                                    <div class="tab-pane" id="tab_1_3">
                                        <?= $this->session->flashdata('pass'); ?>
                                        <form action="<?= base_url('Admin/change_password/' . $datatoedit->IDNumber); ?>" method="POST" enctype="multipart/form-data">
                                            <!-- <div class="form-group">
                                                <label class="control-label">Current Password</label>
                                                <input type="password" class="form-control" id="curpass" name="curpass"> </div> -->
                                            <div class="form-group">
                                                <label class="control-label">New Password</label>
                                                <input type="password" class="form-control" id="newpass" name="newpass"> </div>
                                            <div class="form-group">
                                                <label class="control-label">Re-type New Password</label>
                                                <input type="password" class="form-control" id="renew" name="renew"> </div>
                                            <div class="margin-top-10">
                                                <button type="submit" class="btn green" style="min-height: 45px; min-width: 100px;"> Save </button>
                                                <a href="<?= base_url('Admin/load_prof_tch_edit') ?>" class="btn default" style="padding-top: 12px;height: 45px; min-width: 100px;"> Cancel </a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                <!-- END PROFILE DATA Siswa-->

            </div>

            <!-- END PAGE BASE CONTENT -->


        </div>

        <?php $this->load->view('_partials/_foot'); ?>