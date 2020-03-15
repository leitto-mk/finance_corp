<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<div class="container-fluid profiles">
    <div class="page-content">
        <!-- BEGIN PAGE BASE CONTENT -->

        <?= $this->session->flashdata('addmsg'); ?>
        <div class="row justify-content-center">


            <!-- BEGIN PROFILE DATA GURU-->
            <div class="col-lg-12">
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Insert New Teacher / Staff Data</span>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                            </li>
                            <li>
                                <a href="#tab_1_2" data-toggle="tab">Change Photo</a>
                            </li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <form role="form" action="<?= base_url('Admin/add_tch/'); ?>" method="post" enctype="multipart/form-data">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h4 style="background-color: #2f373e; height: 30px;padding-top: 5px">
                                                <font color="white">&nbsp;&nbsp;&nbsp;Biodata</font>
                                            </h4>
                                            <div class="form-group">
                                                <label class="control-label">ID Teacher</label>
                                                <input type="text" placeholder="ID" class="form-control" name="newid" id="newid">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Firstname</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Nama Depan" name="newfname" id="newfname"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Lastname</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Nama Belakang" name="newlname" id="newlname"> </div>
                                            </div>
                                            <div class="form-group form-md-radios">
                                                <label class="control-label" style="color: black"> Gender</label>
                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" id="male" name="gender" class="md-radiobtn" value="Laki-Laki" checked>
                                                        <label for="male">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Male </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="female" name="gender" class="md-radiobtn" value="Perempuan">
                                                        <label for="female">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Female </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Point of Birth</label>
                                                <!-- <input type="text" placeholder="Tanggal Lahir" class="form-control" > -->
                                                <input class="form-control input-medium date-picker" name="newtgllhr" id="newtgllhr" size="30" type="text" value="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Place of Birth</label>
                                                <input type="text" placeholder="Tempat Lahir" class="form-control" name="newtmplhr" id="newtmplhr">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Marital Status</label>
                                                <select name="marital" class="form-control" name="marital" id="marital">
                                                    <option value="-">-- Choose --</option>
                                                    <option id="marital" value="Belum Menikah">Single</option>
                                                    <option id="marital" value="Menikah">Married</option>
                                                    <option id="marital" value="Duda/Janda">Widower</option>
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
                                                        <input type="text" placeholder="No KTP Guru" class="form-control" name="newktp" id="newktp"> </div>
                                                    <div class="form-group form-md-radios">
                                                        <label class="control-label" style="color: black">Occupation</label>
                                                        <div class="md-radio-list">
                                                            <div class="md-radio">
                                                                <input type="radio" id="teachers" name="status" class="md-radiobtn" checked value="teacher">
                                                                <label for="teachers">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Teacher </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="staffs" name="status" class="md-radiobtn" value="staff">
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
                                                                <input type="radio" id="honoreryes" name="honorer" class="md-radiobtn" value="yes">
                                                                <label for="honoreryes">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Yes </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="honorerno" name="honorer" class="md-radiobtn" value="no" checked>
                                                                <label for="honorerno">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> No </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Job Description (for Non-Teacher) </label>
                                                        <input type="text" placeholder="Deskripsi Pekerjaan" class="form-control" name="jobdesc" id="jobdesc"> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Employee Type</label>
                                                        <select name="emp" class="form-control">
                                                            <option value="-">-- Choose --</option>
                                                            <option value="PNS">PNS</option>
                                                            <option value="GTY">GTY</option>
                                                            <option value="PTY">PTY</option>
                                                            <option value="GTT">GTT</option>
                                                            <option value="PTT">PTT</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Homeroom Teacher</label>
                                                        <select name="homeroom" class="form-control">
                                                            <option id="homeroom" value="-">-- Choose --</option>
                                                            <?php $i = 1; ?>
                                                            <?php foreach ($room as $row) : ?>
                                                                <option id="homeroom" value="<?= $row->RoomDesc; ?>"><?= $row->RoomDesc; ?></option>
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
                                                                <option id="subjteach" value="<?= $row->SubjName; ?>"><?= $row->SubjName; ?></option>
                                                                <?php $i++; ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Current Degree</label>
                                                        <select name="education" class="form-control">
                                                            <option value="-">-- Choose --</option>
                                                            <option id="education" value="SD">SD</option>
                                                            <option id="education" value="SMP">SMP</option>
                                                            <option id="education" value="SMA">SMA</option>
                                                            <option id="education" value="Diploma 1">Diploma 1</option>
                                                            <option id="education" value="Diploma 2">Diploma 2</option>
                                                            <option id="education" value="Diploma 3">Diploma 3</option>
                                                            <option id="education" value="Diploma 4">Diploma 4</option>
                                                            <option id="education" value="Strata 1">Strata 1</option>
                                                            <option id="education" value="Strata 2">Strata 2</option>
                                                            <option id="education" value="Strata 3">Strata 3</option>
                                                        </select> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Last Diploma / Degree Title</label>
                                                        <input type="text" placeholder="Ijazah Terakhir" class="form-control" name="diploma" id="diploma"> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Year Start</label>
                                                        <input type="text" placeholder="Tahun Masuk" class="form-control" name="starts" id="starts"> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Govt. Certificate</label>
                                                        <input type="text" placeholder="Certificate" class="form-control" name="govt" id="govt"> </div>
                                                    <div class="portlet solid grey">
                                                        <div class="portlet-title">
                                                            <div class="form-group" style="margin-top: 25px;">
                                                                <div class="md-checkbox-inline">
                                                                    <div class="md-checkbox">
                                                                        <input type="checkbox" id="institute" name="institute" class="md-check" value="no">
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
                                                <input type="text" placeholder="Alamat" class="form-control" name="newaddr" id="newaddr"> </div>
                                            <div class="form-group">
                                                <label class="control-label">District</label>
                                                <input type="text" placeholder="Kecamatan" class="form-control" name="newdis" id="newdis"> </div>
                                            <div class="form-group">
                                                <label class="control-label">Region</label>
                                                <input type="text" placeholder="Kabupaten" class="form-control" name="newreg" id="newreg"> </div>
                                            <div class="form-group">
                                                <label class="control-label">City</label>
                                                <input type="text" placeholder="Kota" class="form-control" name="newcity" id="newcity"> </div>
                                            <div class="form-group">
                                                <label class="control-label">Province</label>
                                                <input type="text" placeholder="Provinsi" class="form-control" name="newprov" id="newprov"> </div>
                                            <div class="form-group">
                                                <label class="control-label">Nationality</label>
                                                <input type="text" placeholder="Negara" class="form-control" name="newnat" id="newnat"> </div>
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <div class="input-group input-icon right">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope font-purple"></i>
                                                    </span>
                                                    <i class="fa fa-exclamation tooltips" data-original-title="Invalid email." data-container="body"></i>
                                                    <input id="email" class="input-error form-control" type="text" value="" name="newmail" id="newmail"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Contact</label>
                                                <input type="text" placeholder="No. Telp" class="form-control" name="newtelp" id="newtelp"> </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="margin-top-20" style="float: right;">
                                                <a href="#tab_1_2" data-toggle="tab" class="btn default btn_next_tch" style="padding-top: 12px;height: 45px; min-width: 100px;"> Next </a>
                                            </div>
                                        </div>
                                    </div>
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
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?= base_url('assets/photos/noimage.gif') ?>" id="img-prev" alt="" style="min-width: 80%; min-height: 50%;"> </div>
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
                                            <div class="margin-top-20" style="float: right;">
                                                <a href="<?= base_url('Admin/load_prof_tch_edit') ?>" class="btn default" style="padding-top: 12px;height: 45px; min-width: 100px;"> Cancel </a>
                                                <button type="submit" class="btn green add_new_tch" style="min-height: 45px; min-width: 100px;"> Add </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END PROFILE DATA GURU-->


        </div>
        <!-- END PAGE BASE CONTENT -->

        <?php $this->load->view('_partials/_foot'); ?>