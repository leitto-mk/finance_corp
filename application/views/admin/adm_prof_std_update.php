<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<div class="container-fluid profiles">
    <div class="page-content">
        <!-- BEGIN PAGE BASE CONTENT -->

        <?= $this->session->flashdata('updmsg'); ?>


        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-2">
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="<?= base_url() . 'assets/photos/student/' . $datatoedit->Photo; ?>" class="img-responsive thumbnail img-circle">
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

                <div class="col-md-10">
                    <!-- BEGIN PROFILE DATA SISWA-->
                    <div class="col-lg-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Update Student's Data</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                        <!-- PERSONAL INFO TAB -->
                                        <form class="form-horizontal upd-std" action="<?= base_url('Admin/update_std/') . $datatoedit->IDNumber ?>" method="POST">
                                            <div class="row">
                                                <div class="row">
                                                    <div class="form-group" style="margin-bottom: 5px;" style="display: none;">
                                                        <label class="control-label col-md-3">NIS/Nomor Induk
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="nis" value="<?= $datatoedit->IDNumber ?>" disabled>
                                                                <span class="help-block">Nomor Induk Siswa untuk peserta didik</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Nama Depan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="fname" placeholder="" value="<?= ucfirst($datatoedit->FirstName) ?>">
                                                                <span class="help-block">masukan nama depan...</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Nama Tengah
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="mname" placeholder="" value="<?= ucfirst($datatoedit->MiddleName) ?>">
                                                                <span class="help-block">masukan nama tengah</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Nama Belakang
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="lname" placeholder="" value="<?= ucfirst($datatoedit->LastName) ?>">
                                                                <span class="help-block">masukan nama belakang</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Nama Panggilan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="nname" placeholder="" value="<?= ucfirst($datatoedit->NickName) ?>">
                                                                <span class="help-block">masukan nama Panggilan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Jenis Kelamin
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <?php if ($datatoedit->Gender == 'Laki-Laki') : ?>
                                                                <div class="md-radio-inline">
                                                                    <div class="md-radio has-error">
                                                                        <input type="radio" id="male" name="gender" class="md-radiobtn" value="Laki-Laki" checked>
                                                                        <label for="male">
                                                                            <span class="inc"></span>
                                                                            <span class="check"></span>
                                                                            <span class="box"></span> Laki-Laki</label>
                                                                    </div>
                                                                    <div class="md-radio has-error">
                                                                        <input type="radio" id="female" name="gender" class="md-radiobtn" value="Perempuan">
                                                                        <label for="female">
                                                                            <span></span>
                                                                            <span class="check"></span>
                                                                            <span class="box"></span> Perempuan </label>
                                                                    </div>
                                                                </div>
                                                            <?php else : ?>
                                                                <div class="md-radio-inline">
                                                                    <div class="md-radio has-error">
                                                                        <input type="radio" id="male" name="gender" class="md-radiobtn" value="Laki-Laki">
                                                                        <label for="male">
                                                                            <span class="inc"></span>
                                                                            <span class="check"></span>
                                                                            <span class="box"></span> Laki-Laki</label>
                                                                    </div>
                                                                    <div class="md-radio has-error">
                                                                        <input type="radio" id="female" name="gender" class="md-radiobtn" value="Perempuan" checked>
                                                                        <label for="female">
                                                                            <span></span>
                                                                            <span class="check"></span>
                                                                            <span class="box"></span> Perempuan </label>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Kelas
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="classes" class="form-control classes">
                                                                    <option value="-"> - </option>
                                                                    <?php foreach ($class as $row) : ?>
                                                                        <?php if ($datatoedit->Kelas == $row->ClassDesc) : ?>
                                                                            <option value="<?= $row->ClassDesc ?>" selected><?= $row->ClassDesc ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $row->ClassDesc ?>"><?= $row->ClassDesc ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Kelas</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Ruangan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="room" class="form-control room">
                                                                    <option value="<?= $datatoedit->Ruangan ?>"><?= $datatoedit->Ruangan ?></option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Ruangan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">NISN
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="nisn" placeholder="" value="<?= $datatoedit->NISN ?>">
                                                                <span class="help-block" style="z-index: 10">Nomor Induk Siswa Nasional Peserta Didik.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">NIK/KITAS (untuk WNA)
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="nik" placeholder="" value="<?= $datatoedit->PersonalID ?>">
                                                                <p class="help-block" style="z-index: 10;">Nomor Induk Kependudukan. Kartu Izin Tinggal Terbatas (untuk WNA).</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">No. KK
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="kk" placeholder="" value="<?= $datatoedit->KK ?>">
                                                                <p class="help-block" style="z-index: 10;">Nomor Kartu Keluarga.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Tanggal Lahir
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control date-picker" name="tgllhr" placeholder="" value="<?= date('m-d-Y', strtotime($datatoedit->DateofBirth)) ?>">
                                                                <span class="help-block" style="z-index: 10;">Bulan/Tanggal/Tahun</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Tempat Lahir
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="tmplhr" placeholder="" value="<?= $datatoedit->PointofBirth ?>">
                                                                <span class="help-block" style="z-index: 10;">Tempat Kelahiran.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">No. Registrasi Akta Lahir
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="akta" placeholder="" value="<?= $datatoedit->BirthCertificate ?>">
                                                                <span class="help-block" style="z-index: 10;">Nomor Registrasi Akta Lahir</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Agama/Kepercayaan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="religion" class="form-control">
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
                                                                <span class="help-block" style="z-index: 10;">Agama</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Kewarganegaraan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="country" class="form-control" value="<?= $datatoedit->Country ?>">
                                                                    <option value=""></option>
                                                                    <!-- JSON DATA GOES HERE -->
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Kewarganegaraan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Berkebutuhan Khusus
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="disabled" placeholder="" value="<?= $datatoedit->Disability ?>">
                                                                <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang oleh peserta didik.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Alamat
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="address" placeholder="" value="<?= $datatoedit->Address ?>">
                                                                <span class="help-block" style="z-index: 10;">Alamat Peserta Didik.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">RT
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="rt" placeholder="" value="<?= $datatoedit->RT ?>">
                                                                <span class="help-block" style="z-index: 10;">RT</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">RW
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="rw" placeholder="" value="<?= $datatoedit->RW ?>">
                                                                <span class="help-block" style="z-index: 10;">RW</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Nama Dusun
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="dusun" placeholder="" value="<?= $datatoedit->Dusun ?>">
                                                                <span class="help-block" style="z-index: 10;">Dusun</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Kelurahan/Desa
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="village" placeholder="" value="<?= $datatoedit->Village ?>">
                                                                <span class="help-block" style="z-index: 10;">Kelurahan/Desa</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Kecamatan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="district" placeholder="" value="<?= $datatoedit->District ?>">
                                                                <span class="help-block" style="z-index: 10;">Kecamatan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Kabupaten
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="region" placeholder="" value="<?= $datatoedit->Region ?>">
                                                                <span class="help-block" style="z-index: 10;">Kabupaten</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Kode Post
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="postal" placeholder="" value="<?= $datatoedit->Postal ?>">
                                                                <span class="help-block" style="z-index: 10;">Kode Post</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Tempat Tinggal
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="livewith" class="form-control">
                                                                    <option value="With Parent" <?php if ($datatoedit->LiveWith == 'With Parent') echo 'selected'; ?>> Orang Tua </option>
                                                                    <option value="With Guardian" <?php if ($datatoedit->LiveWith == 'With Guardian') echo 'selected'; ?>> Wali </option>
                                                                    <option value="Kost / Private Apt" <?php if ($datatoedit->LiveWith == 'Kost / Private Apt') echo 'selected'; ?>> Kost/Apartemen Pribadi </option>
                                                                    <option value="Dormitory" <?php if ($datatoedit->LiveWith == 'Dormitory') echo 'selected'; ?>> Asrama </option>
                                                                    <option value="Foster Home" <?php if ($datatoedit->LiveWith == 'Foster Home') echo 'selected'; ?>> Panti Asuhan </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Tempat Tinggal</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Moda Transportasi
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="transport" class="form-control">
                                                                    <option value="On Foot" <?php if ($datatoedit->Transportation == 'On Foot') echo 'selected'; ?>> Jalan Kaki </option>
                                                                    <option value="Private Vehicle" <?php if ($datatoedit->Transportation == 'Private Vehicle') echo 'selected'; ?>> Kendaraan Pribadi </option>
                                                                    <option value="Public Transportation" <?php if ($datatoedit->Transportation == 'Public Transportation') echo 'selected'; ?>> Angkutan Umum </option>
                                                                    <option value="School Bus" <?php if ($datatoedit->Transportation == 'School Bus') echo 'selected'; ?>> Jemputan Sekolah </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Moda Transportasi</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5x;">
                                                        <label class="control-label col-md-3">Lintang
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="lintang" placeholder="" value="<?= $datatoedit->Latitude ?>">
                                                                <span class="help-block" style="z-index: 10;">Lintang</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Bujur
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="bujur" placeholder="" value="<?= $datatoedit->Longitude ?>">
                                                                <span class="help-block" style="z-index: 10;">Bujur</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Anak Ke
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="child" placeholder="" value="<?= $datatoedit->AnakKe ?>">
                                                                <span class="help-block" style="z-index: 10;">Anak Keberapa</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Memiliki KIP
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="md-radio-inline">
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="kipyes" name="kip" class="md-radiobtn" value="yes" <?php if ($datatoedit->KIP == 'yes') echo 'checked'; ?>>
                                                                    <label for="kipyes">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Ya </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="kipno" name="kip" class="md-radiobtn" value="no" checked <?php if ($datatoedit->KIP == 'no') echo 'checked'; ?>>
                                                                    <label for="kipno">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Tidak </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Tetap Memegang KIP
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="md-radio-inline">
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="kipstay" name="keepkip" class="md-radiobtn" value="yes" <?php if ($datatoedit->Stayed_KIP == 'yes') echo 'checked'; ?>>
                                                                    <label for="kipstay">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Ya </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="kipunstay" name="keepkip" class="md-radiobtn" value="no" <?php if ($datatoedit->Stayed_KIP == 'no') echo 'checked'; ?>>
                                                                    <label for="kipunstay">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Tidak </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Alasan Menolak PIP
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="refusepip" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->Refuse_PIP == '') echo 'selected'; ?>> - </option>
                                                                    <option value="Dilarang PEMDA" <?php if ($datatoedit->Refuse_PIP == 'Dilarang PEMDA') echo 'selected'; ?>> Dilarang PEMDA (memiliki bantuan serupa) </option>
                                                                    <option value="Menolak" <?php if ($datatoedit->Refuse_PIP == 'Menolak') echo 'selected'; ?>> Menolak </option>
                                                                    <option value="Sudah Mampu" <?php if ($datatoedit->Refuse_PIP == 'Sudah Mampu') echo 'selected'; ?>> Sudah Mampu </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Alasan Penolakan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">No. Telpon Rumah
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="housephone" value="<?= $datatoedit->HousePhone ?>">
                                                                <span class="help-block" style="z-index: 10;">Nomor Telpon Rumah</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">No. HP
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="handheldnumber" value="<?= $datatoedit->Phone ?>">
                                                                <span class="help-block" style="z-index: 10;">Nomor Telpon Rumah</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Email
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="email" class="form-control" name="email" placeholder="" value="<?= $datatoedit->Email ?>">
                                                                <span class="help-block" style="z-index: 10;">Email milik peserta atau milik orang tua/wali</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Nama Ayah Kandung
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="father" placeholder="" value="<?= $datatoedit->Father ?>">
                                                                <span class="help-block" style="z-index: 10;">Nama Ayah Kandung</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">NIK Ayah
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="fathernik" placeholder="" value="<?= $datatoedit->FatherNIK ?>">
                                                                <span class="help-block" style="z-index: 10;">Nomor Induk Keluarga Ayah</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Tahun Lahir
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="fatheryear" placeholder="" value="<?= $datatoedit->FatherBorn ?>">
                                                                <span class="help-block" style="z-index: 10;">Tahun Kelahiran Ayah</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Pendidikan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="fatherdegree" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->FatherDegree == '') echo 'selected'; ?>> - </option>
                                                                    <option value="Tidak Sekolah" <?php if ($datatoedit->FatherDegree == '') echo 'selected'; ?>> Tidak Sekolah </option>
                                                                    <option value="Putus SD" <?php if ($datatoedit->FatherDegree == 'Putus SD') echo 'selected'; ?>> Putus SD </option>
                                                                    <option value="SD Sederajat" <?php if ($datatoedit->FatherDegree == 'SD Sederajat') echo 'selected'; ?>> SD Sederajat </option>
                                                                    <option value="SMP Sederajat" <?php if ($datatoedit->FatherDegree == 'SMP Sederajat') echo 'selected'; ?>> SMP Sederajat </option>
                                                                    <option value="SMA Sederajat" <?php if ($datatoedit->FatherDegree == 'SMA Sederajat') echo 'selected'; ?>> SMA Sederajat </option>
                                                                    <option value="D1" <?php if ($datatoedit->FatherDegree == 'D1') echo 'selected'; ?>> D1 </option>
                                                                    <option value="D2" <?php if ($datatoedit->FatherDegree == 'D2') echo 'selected'; ?>> D2 </option>
                                                                    <option value="D3" <?php if ($datatoedit->FatherDegree == 'D3') echo 'selected'; ?>> D3 </option>
                                                                    <option value="D4/S1" <?php if ($datatoedit->FatherDegree == 'D4/S1') echo 'selected'; ?>> D4/S1 </option>
                                                                    <option value="S2" <?php if ($datatoedit->FatherDegree == 'S2') echo 'selected'; ?>> S2 </option>
                                                                    <option value="S3" <?php if ($datatoedit->FatherDegree == 'S3') echo 'selected'; ?>> S3 </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Pendidikan Terakhir Ayah</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Pekerjaan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="fatherjob" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->FatherJob == '') echo 'selected'; ?>> - </option>
                                                                    <option value="Tidak Bekerja" <?php if ($datatoedit->FatherJob == '') echo 'selected'; ?>> Tidak Bekerja </option>
                                                                    <option value="Nelayan" <?php if ($datatoedit->FatherJob == 'Nelayan') echo 'selected'; ?>> Nelayan </option>
                                                                    <option value="Petani" <?php if ($datatoedit->FatherJob == 'Petani') echo 'selected'; ?>> Petani </option>
                                                                    <option value="Peternak" <?php if ($datatoedit->FatherJob == 'Peternak') echo 'selected'; ?>> Peternak </option>
                                                                    <option value="PNS/TNI/POLRI" <?php if ($datatoedit->FatherJob == 'PNS/TNI/POLRI') echo 'selected'; ?>> PNS/TNI/POLRI </option>
                                                                    <option value="Karyawan Swasta" <?php if ($datatoedit->FatherJob == 'Karyawan Swasta') echo 'selected'; ?>> Karyawan Swasta </option>
                                                                    <option value="Pedagang Kecil" <?php if ($datatoedit->FatherJob == 'Pedagang Kecil') echo 'selected'; ?>> Pedagang Kecil </option>
                                                                    <option value="Pedagang Besar" <?php if ($datatoedit->FatherJob == 'Pedagang Besar') echo 'selected'; ?>> Pedagang Besar </option>
                                                                    <option value="Wiraswasta" <?php if ($datatoedit->FatherJob == 'Wiraswasta') echo 'selected'; ?>> Wiraswasta </option>
                                                                    <option value="Wirausaha" <?php if ($datatoedit->FatherJob == 'Wirausaha') echo 'selected'; ?>> Wirausaha </option>
                                                                    <option value="Buruh" <?php if ($datatoedit->FatherJob == 'Buruh') echo 'selected'; ?>> Buruh </option>
                                                                    <option value="Pensiunan" <?php if ($datatoedit->FatherJob == 'Pensiunan') echo 'selected'; ?>> Pensiunan </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Pekerjaan Ayah</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Penghasilan Bulanan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="fatherincome" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->FatherIncome == '') echo 'selected'; ?>> - </option>
                                                                    <option value="Rp. 500.000" <?php if ($datatoedit->FatherIncome == '') echo 'selected'; ?>> Rp. 500.000 </option>
                                                                    <option value="Rp. 500.000 - Rp. 999.999" <?php if ($datatoedit->FatherIncome == 'Rp. 500.000 - Rp. 999.999') echo 'selected'; ?>> Rp. 500.000 - Rp. 999.999 </option>
                                                                    <option value="Rp. 1.0000.0000 - Rp. 1.999.9999" <?php if ($datatoedit->FatherIncome == 'Rp. 1.0000.0000 - Rp. 1.999.9999') echo 'selected'; ?>> Rp. 1.0000.0000 - Rp. 1.999.9999 </option>
                                                                    <option value="Rp. 2.0000.0000 - Rp. 4.999.999" <?php if ($datatoedit->FatherIncome == 'Rp. 2.0000.0000 - Rp. 4.999.999') echo 'selected'; ?>> Rp. 2.0000.0000 - Rp. 4.999.999 </option>
                                                                    <option value="Rp. 5.000.0000 - Rp. 20.000.000" <?php if ($datatoedit->FatherIncome == 'Rp. 5.000.0000 - Rp. 20.000.000 ') echo 'selected'; ?>> Rp. 5.000.0000 - Rp. 20.000.000 </option>
                                                                    <option value="Rp. 20.000.000" <?php if ($datatoedit->FatherIncome == 'Rp. 20.000.000') echo 'selected'; ?>> > Rp. 20.000.000 </option>
                                                                    <option value="Tidak Berpenghasilan" <?php if ($datatoedit->FatherIncome == 'Rp. 20.000.000') echo 'selected'; ?>> Tidak Berpenghasilan </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Pekerjaan Ayah</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Berkebutuhan Khusus
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="fatherdisabled" placeholder="" value="<?= $datatoedit->FatherDisability ?>">
                                                                <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang Ayah</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Nama Ibu Kandung
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="father" placeholder="" value="<?= $datatoedit->Mother ?>">
                                                                <span class="help-block" style="z-index: 10;">Nama Ibu Kandung</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">NIK Ibu
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="mothernik" placeholder="" value="<?= $datatoedit->MotherNIK ?>">
                                                                <span class="help-block" style="z-index: 10;">Nomor Induk Keluarga Ibu</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Tahun Lahir
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="motheryear" placeholder="" value="<?= $datatoedit->MotherBorn ?>">
                                                                <span class="help-block" style="z-index: 10;">Tahun Kelahiran Ibu</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Pendidikan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="motherdegree" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->MotherDegree == '') echo 'selected'; ?>> - </option>
                                                                    <option value="Tidak Sekolah" <?php if ($datatoedit->MotherDegree == '') echo 'selected'; ?>> Tidak Sekolah </option>
                                                                    <option value="Putus SD" <?php if ($datatoedit->MotherDegree == 'Putus SD') echo 'selected'; ?>> Putus SD </option>
                                                                    <option value="SD Sederajat" <?php if ($datatoedit->MotherDegree == 'SD Sederajat') echo 'selected'; ?>> SD Sederajat </option>
                                                                    <option value="SMP Sederajat" <?php if ($datatoedit->MotherDegree == 'SMP Sederajat') echo 'selected'; ?>> SMP Sederajat </option>
                                                                    <option value="SMA Sederajat" <?php if ($datatoedit->MotherDegree == 'SMA Sederajat') echo 'selected'; ?>> SMA Sederajat </option>
                                                                    <option value="D1" <?php if ($datatoedit->MotherDegree == 'D1') echo 'selected'; ?>> D1 </option>
                                                                    <option value="D2" <?php if ($datatoedit->MotherDegree == 'D2') echo 'selected'; ?>> D2 </option>
                                                                    <option value="D3" <?php if ($datatoedit->MotherDegree == 'D3') echo 'selected'; ?>> D3 </option>
                                                                    <option value="D4/S1" <?php if ($datatoedit->MotherDegree == 'D4/S1') echo 'selected'; ?>> D4/S1 </option>
                                                                    <option value="S2" <?php if ($datatoedit->MotherDegree == 'S2') echo 'selected'; ?>> S2 </option>
                                                                    <option value="S3" <?php if ($datatoedit->MotherDegree == 'S3') echo 'selected'; ?>> S3 </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Pendidikan Terakhir Ibu</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Pekerjaan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="motherjob" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->MotherJob == '') echo 'selected'; ?>> - </option>
                                                                    <option value="Tidak Bekerja" <?php if ($datatoedit->MotherJob == '') echo 'selected'; ?>> Tidak Bekerja </option>
                                                                    <option value="Nelayan" <?php if ($datatoedit->MotherJob == 'Nelayan') echo 'selected'; ?>> Nelayan </option>
                                                                    <option value="Petani" <?php if ($datatoedit->MotherJob == 'Petani') echo 'selected'; ?>> Petani </option>
                                                                    <option value="Peternak" <?php if ($datatoedit->MotherJob == 'Peternak') echo 'selected'; ?>> Peternak </option>
                                                                    <option value="PNS/TNI/POLRI" <?php if ($datatoedit->MotherJob == 'PNS/TNI/POLRI') echo 'selected'; ?>> PNS/TNI/POLRI </option>
                                                                    <option value="Karyawan Swasta" <?php if ($datatoedit->MotherJob == 'Karyawan Swasta') echo 'selected'; ?>> Karyawan Swasta </option>
                                                                    <option value="Pedagang Kecil" <?php if ($datatoedit->MotherJob == 'Pedagang Kecil') echo 'selected'; ?>> Pedagang Kecil </option>
                                                                    <option value="Pedagang Besar" <?php if ($datatoedit->MotherJob == 'Pedagang Besar') echo 'selected'; ?>> Pedagang Besar </option>
                                                                    <option value="Wiraswasta" <?php if ($datatoedit->MotherJob == 'Wiraswasta') echo 'selected'; ?>> Wiraswasta </option>
                                                                    <option value="Wirausaha" <?php if ($datatoedit->MotherJob == 'Wirausaha') echo 'selected'; ?>> Wirausaha </option>
                                                                    <option value="Buruh" <?php if ($datatoedit->MotherJob == 'Buruh') echo 'selected'; ?>> Buruh </option>
                                                                    <option value="Pensiunan" <?php if ($datatoedit->MotherJob == 'Pensiunan') echo 'selected'; ?>> Pensiunan </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Pekerjaan Ibu</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Penghasilan Bulanan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="motherincome" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->MotherIncome == '') echo 'selected'; ?>> - </option>
                                                                    <option value="Rp. 500.000" <?php if ($datatoedit->MotherIncome == '') echo 'selected'; ?>> Rp. 500.000 </option>
                                                                    <option value="Rp. 500.000 - Rp. 999.999" <?php if ($datatoedit->MotherIncome == 'Rp. 500.000 - Rp. 999.999') echo 'selected'; ?>> Rp. 500.000 - Rp. 999.999 </option>
                                                                    <option value="Rp. 1.0000.0000 - Rp. 1.999.9999" <?php if ($datatoedit->MotherIncome == 'Rp. 1.0000.0000 - Rp. 1.999.9999') echo 'selected'; ?>> Rp. 1.0000.0000 - Rp. 1.999.9999 </option>
                                                                    <option value="Rp. 2.0000.0000 - Rp. 4.999.999" <?php if ($datatoedit->MotherIncome == 'Rp. 2.0000.0000 - Rp. 4.999.999') echo 'selected'; ?>> Rp. 2.0000.0000 - Rp. 4.999.999 </option>
                                                                    <option value="Rp. 5.000.0000 - Rp. 20.000.000" <?php if ($datatoedit->MotherIncome == 'Rp. 5.000.0000 - Rp. 20.000.000 ') echo 'selected'; ?>> Rp. 5.000.0000 - Rp. 20.000.000 </option>
                                                                    <option value="Rp. 20.000.000" <?php if ($datatoedit->MotherIncome == 'Rp. 20.000.000') echo 'selected'; ?>> > Rp. 20.000.000 </option>
                                                                    <option value="Tidak Berpenghasilan" <?php if ($datatoedit->MotherIncome == 'Rp. 20.000.000') echo 'selected'; ?>> Tidak Berpenghasilan </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Pekerjaan Ibu</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Berkebutuhan Khusus
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="motherdisabled" placeholder="" value="<?= $datatoedit->MotherDisability ?>">
                                                                <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang Ibu</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">NIK Wali
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="guardiannik" placeholder="" value="<?= $datatoedit->GuardianNIK ?>">
                                                                <span class="help-block" style="z-index: 10;">Nomor Induk Keluarga Wali</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Tahun Lahir
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="guardianyear" placeholder="" value="<?= $datatoedit->GuardianBorn ?>">
                                                                <span class="help-block" style="z-index: 10;">Tahun Kelahiran Wali</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Pendidikan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="guardiandegree" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->GuardianDegree == '') echo 'selected'; ?>> - </option>
                                                                    <option value="Tidak Sekolah" <?php if ($datatoedit->GuardianDegree == '') echo 'selected'; ?>> Tidak Sekolah </option>
                                                                    <option value="Putus SD" <?php if ($datatoedit->GuardianDegree == 'Putus SD') echo 'selected'; ?>> Putus SD </option>
                                                                    <option value="SD Sederajat" <?php if ($datatoedit->GuardianDegree == 'SD Sederajat') echo 'selected'; ?>> SD Sederajat </option>
                                                                    <option value="SMP Sederajat" <?php if ($datatoedit->GuardianDegree == 'SMP Sederajat') echo 'selected'; ?>> SMP Sederajat </option>
                                                                    <option value="SMA Sederajat" <?php if ($datatoedit->GuardianDegree == 'SMA Sederajat') echo 'selected'; ?>> SMA Sederajat </option>
                                                                    <option value="D1" <?php if ($datatoedit->GuardianDegree == 'D1') echo 'selected'; ?>> D1 </option>
                                                                    <option value="D2" <?php if ($datatoedit->GuardianDegree == 'D2') echo 'selected'; ?>> D2 </option>
                                                                    <option value="D3" <?php if ($datatoedit->GuardianDegree == 'D3') echo 'selected'; ?>> D3 </option>
                                                                    <option value="D4/S1" <?php if ($datatoedit->GuardianDegree == 'D4/S1') echo 'selected'; ?>> D4/S1 </option>
                                                                    <option value="S2" <?php if ($datatoedit->GuardianDegree == 'S2') echo 'selected'; ?>> S2 </option>
                                                                    <option value="S3" <?php if ($datatoedit->GuardianDegree == 'S3') echo 'selected'; ?>> S3 </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Pendidikan Terakhir Wali</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Pekerjaan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="guardianjob" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->GuardianJob == '') echo 'selected'; ?>> - </option>
                                                                    <option value="Tidak Bekerja" <?php if ($datatoedit->GuardianJob == '') echo 'selected'; ?>> Tidak Bekerja </option>
                                                                    <option value="Nelayan" <?php if ($datatoedit->GuardianJob == 'Nelayan') echo 'selected'; ?>> Nelayan </option>
                                                                    <option value="Petani" <?php if ($datatoedit->GuardianJob == 'Petani') echo 'selected'; ?>> Petani </option>
                                                                    <option value="Peternak" <?php if ($datatoedit->GuardianJob == 'Peternak') echo 'selected'; ?>> Peternak </option>
                                                                    <option value="PNS/TNI/POLRI" <?php if ($datatoedit->GuardianJob == 'PNS/TNI/POLRI') echo 'selected'; ?>> PNS/TNI/POLRI </option>
                                                                    <option value="Karyawan Swasta" <?php if ($datatoedit->GuardianJob == 'Karyawan Swasta') echo 'selected'; ?>> Karyawan Swasta </option>
                                                                    <option value="Pedagang Kecil" <?php if ($datatoedit->GuardianJob == 'Pedagang Kecil') echo 'selected'; ?>> Pedagang Kecil </option>
                                                                    <option value="Pedagang Besar" <?php if ($datatoedit->GuardianJob == 'Pedagang Besar') echo 'selected'; ?>> Pedagang Besar </option>
                                                                    <option value="Wiraswasta" <?php if ($datatoedit->GuardianJob == 'Wiraswasta') echo 'selected'; ?>> Wiraswasta </option>
                                                                    <option value="Wirausaha" <?php if ($datatoedit->GuardianJob == 'Wirausaha') echo 'selected'; ?>> Wirausaha </option>
                                                                    <option value="Buruh" <?php if ($datatoedit->GuardianJob == 'Buruh') echo 'selected'; ?>> Buruh </option>
                                                                    <option value="Pensiunan" <?php if ($datatoedit->GuardianJob == 'Pensiunan') echo 'selected'; ?>> Pensiunan </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Pekerjaan Wali</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Penghasilan Bulanan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="guardianincome" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->GuardianIncome == '') echo 'selected'; ?>> - </option>
                                                                    <option value="Rp. 500.000" <?php if ($datatoedit->GuardianIncome == '') echo 'selected'; ?>> Rp. 500.000 </option>
                                                                    <option value="Rp. 500.000 - Rp. 999.999" <?php if ($datatoedit->GuardianIncome == 'Rp. 500.000 - Rp. 999.999') echo 'selected'; ?>> Rp. 500.000 - Rp. 999.999 </option>
                                                                    <option value="Rp. 1.0000.0000 - Rp. 1.999.9999" <?php if ($datatoedit->GuardianIncome == 'Rp. 1.0000.0000 - Rp. 1.999.9999') echo 'selected'; ?>> Rp. 1.0000.0000 - Rp. 1.999.9999 </option>
                                                                    <option value="Rp. 2.0000.0000 - Rp. 4.999.999" <?php if ($datatoedit->GuardianIncome == 'Rp. 2.0000.0000 - Rp. 4.999.999') echo 'selected'; ?>> Rp. 2.0000.0000 - Rp. 4.999.999 </option>
                                                                    <option value="Rp. 5.000.0000 - Rp. 20.000.000" <?php if ($datatoedit->GuardianIncome == 'Rp. 5.000.0000 - Rp. 20.000.000 ') echo 'selected'; ?>> Rp. 5.000.0000 - Rp. 20.000.000 </option>
                                                                    <option value="Rp. 20.000.000" <?php if ($datatoedit->GuardianIncome == 'Rp. 20.000.000') echo 'selected'; ?>> > Rp. 20.000.000 </option>
                                                                    <option value="Tidak Berpenghasilan" <?php if ($datatoedit->GuardianIncome == 'Rp. 20.000.000') echo 'selected'; ?>> Tidak Berpenghasilan </option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Pekerjaan Wali</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Berkebutuhan Khusus
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="guardiandisabled" placeholder="" value="<?= $datatoedit->GuardianDisability ?>">
                                                                <span class="help-block" style="z-index: 10;">Kebutuhan Khusus yang disandang Wali</span>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Tinggi Badan (cm)
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="height" placeholder="" value="<?= $datatoedit->Height ?>">
                                                                <span class="help-block">tinggi badan peserta didik</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Berat Badan (kg)
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="weight" placeholder="" value="<?= $datatoedit->Weight ?>">
                                                                <span class="help-block">tinggi badan peserta didik</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Lingkar Kepala (cm)
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="headdiameter" placeholder="" value="<?= $datatoedit->HeadDiameter ?>">
                                                                <span class="help-block">ukurang lingkar kepala</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Jarak tempat tinggal ke sekolah
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="md-radio-inline">
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="KM" name="range" class="md-radiobtn" value="< 1 KM" <?php if ($datatoedit->Range == '< 1 KM') echo 'checked' ?>>
                                                                    <label for="KM">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Kurang dari 1KM</label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="KMS" name="range" class="md-radiobtn" value="> 1 KM" <?php if ($datatoedit->Range == '> 1 KM') echo 'checked' ?>>
                                                                    <label for="KMS">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Lebih dari 1KM </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Jarak tepatnya
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="exactrange" placeholder="" value="<?= $datatoedit->ExactRange ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1" style="padding-left: 0px;margin-top: 10px">
                                                            <span class="meters"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Jarak Waktu Rumah ke Sekolah
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="timerange" placeholder="" value="<?= $datatoedit->TimeRange ?>">
                                                                <span class="help-block">Waktu tempuh Peserta Didik ke Sekolah. masukan dalam satuan menit</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1" style="padding-left: 0px; margin-left: 0px; margin-top: 10px">
                                                            <span class="duration">(Menit)</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Jumlah Saudara Kandung
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="siblings" value="0" placeholder="" value="<?= $datatoedit->Saudara ?>">
                                                                <span class="help-block">Jumlah saudara kandung peserta didik. isikan 0 jika tidak ada saudara</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Jenis Prestasi
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-9">
                                                            <div class="md-radio-inline">
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Sains" name="achievement" class="md-radiobtn" value="Sains" <?php if ($datatoedit->Achievement == 'Sains') echo 'checked' ?>>
                                                                    <label for="Sains">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Sains </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Seni" name="achievement" class="md-radiobtn" value="Seni" <?php if ($datatoedit->Achievement == 'Seni') echo 'checked' ?>>
                                                                    <label for="Seni">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Seni </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Olahraga" name="achievement" class="md-radiobtn" value="Olahraga" <?php if ($datatoedit->Achievement == 'Olahraga') echo 'checked' ?>>
                                                                    <label for="Olahraga">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Olahraga </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Lain-Lain" name="achievement" class="md-radiobtn" value="Lain-Lain" <?php if ($datatoedit->Achievement == 'Lain-Lain') echo 'checked' ?>>
                                                                    <label for="Lain-Lain">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Lain-Lain </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Tingkat Prestasi
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-9">
                                                            <div class="md-radio-inline">
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Sekolah" name="achievementlevel" class="md-radiobtn" value="Sekolah" <?php if ($datatoedit->AchievementLVL == 'Sekolah') echo 'checked' ?>>
                                                                    <label for="Sekolah">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Sekolah </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Kecamatan" name="achievementlevel" class="md-radiobtn" value="Kecamatan" <?php if ($datatoedit->AchievementLVL == 'Kecamatan') echo 'checked' ?>>
                                                                    <label for="Kecamatan">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Kecamatan </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Kabupaten" name="achievementlevel" class="md-radiobtn" value="Kabupaten" <?php if ($datatoedit->AchievementLVL == 'Kabupaten') echo 'checked' ?>>
                                                                    <label for="Kabupaten">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Kabupaten </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Provinsi" name="achievementlevel" class="md-radiobtn" value="Provinsi" <?php if ($datatoedit->AchievementLVL == 'Provinsi') echo 'checked' ?>>
                                                                    <label for="Provinsi">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Provinsi </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Nasional" name="achievementlevel" class="md-radiobtn" value="Nasional" <?php if ($datatoedit->AchievementLVL == 'Nasional') echo 'checked' ?>>
                                                                    <label for="Nasional">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Nasional </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Internasional" name="achievementlevel" class="md-radiobtn" value="Internasional" <?php if ($datatoedit->AchievementLVL == 'Internasional') echo 'checked' ?>>
                                                                    <label for="Internasional">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Internasional </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Nama Prestasi
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="ach_name" placeholder="" value="<?= $datatoedit->AchievementName ?>">
                                                                <span class="help-block">Nama Prestasi yang diraih peserta didik</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Tahun Prestasi
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="ach_year" value="0" placeholder="2010" value="<?= $datatoedit->AchievementYear ?>">
                                                                <span class="help-block">Tahun Prestasi didapat oleh peserta Didik</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Penyelanggara
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="sponsor" placeholder="" value="<?= $datatoedit->Sponsor ?>">
                                                                <span class="help-block">Penyelenggara Prestasi yang diraih Peserta Didik</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Peringkat Prestasi
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="ach_rank" value="0" placeholder="2010" value="<?= $datatoedit->AchievementRank ?>">
                                                                <span class="help-block">Peringkat Prestasi Peserta Didik</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Jenis Beasiswa
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-9">
                                                            <div class="md-radio-inline">
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Berprestasi" name="scholarship" class="md-radiobtn" value="Berprestasi" <?php if ($datatoedit->Scholarship == 'Berprestasi') echo 'checked' ?>>
                                                                    <label for="Berprestasi">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Berprestasi </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="KurangMampu" name="scholarship" class="md-radiobtn" value="Kurang Mampu" <?php if ($datatoedit->Scholarship == 'Kurang Mampu') echo 'checked' ?>>
                                                                    <label for="KurangMampu">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Kurang Mampu </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Pendidikan" name="scholarship" class="md-radiobtn" value="Pendidikan" <?php if ($datatoedit->Scholarship == 'Pendidikan') echo 'checked' ?>>
                                                                    <label for="Pendidikan">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Pendidikan </label>
                                                                </div>
                                                                <div class="md-radio has-error">
                                                                    <input type="radio" id="Unggulan" name="scholarship" class="md-radiobtn" value="Unggulan" <?php if ($datatoedit->Scholarship == 'Unggulan') echo 'checked' ?>>
                                                                    <label for="Unggulan">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Unggulan </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Keterangan Beasiswa
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="scholardesc" value="<?= $datatoedit->ScholarDesc ?>">
                                                                <span class="help-block">Keterangan Beasiswa Peserta Didik. dapat diisi dengan nama beasiswa, atau keterangan yang relevan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Tahun Mulai
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="scholarstart" placeholder="ex. <?= date('Y'); ?>" value="<?= $datatoedit->ScholarStart ?>">
                                                                <span class="help-block">Tahun Mulai Beasiswa</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Tahun Selesai
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="number" class="form-control" name="scholarfinish" placeholder="ex. <?= date('Y') + 3; ?>" value="<?= $datatoedit->ScholarFinish ?>">
                                                                <span class="help-block">Tahun Beasiswa Berakhir</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Jenis Kesejahteraan
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <select name="prosperity" class="form-control">
                                                                    <option value="-" <?php if ($datatoedit->Prosperity == '') echo 'selected' ?>> - </option>
                                                                    <option value="PKH" <?php if ($datatoedit->Prosperity == 'PKH') echo 'selected' ?>>PKH</option>
                                                                    <option value="PIP" <?php if ($datatoedit->Prosperity == 'PIP') echo 'selected' ?>>PIP</option>
                                                                    <option value="Kartu Perlindungan Sosial" <?php if ($datatoedit->Prosperity == 'Kartu Perlindungan Sosial') echo 'selected' ?>>Kartu Perlindungan Sosial</option>
                                                                    <option value="Kartu Keluarga Sejahtera" <?php if ($datatoedit->Prosperity == 'Kartu Keluarga Sejahtera') echo 'selected' ?>>Kartu Keluarga Sejahtera</option>
                                                                    <option value="Kartu Kesehatan" <?php if ($datatoedit->Prosperity == 'PKH') echo 'Kartu Kesehatan' ?>>Kartu Kesehatan</option>
                                                                </select>
                                                                <span class="help-block" style="z-index: 10;">Kesejahteraan Peserta Didik</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">No. Kartu
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="prospernumber" value="<?= $datatoedit->ProsperNumber ?>">
                                                                <span class="help-block">No. Kartu yang bersangkutan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Nama di Kartu
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="prospernametag" value="<?= $datatoedit->ProsperNameTag ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">Sekolah Asal
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="previousschool" value="<?= $datatoedit->PreviousSchool ?>">
                                                                <span class="help-block">Nama Sekolah Asal Peserta Didik Baru/Pindahan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">No. Peserta UN jenjang sebelumnya
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="unnumber" value="<?= $datatoedit->UNNumber ?>">
                                                                <span class="help-block">
                                                                    Nomor peserta ujian saat peserta didik masih di jenjang sebelumnya, berformat (x-xx-xx-xx-xxx-xxx-x).<br>
                                                                    untuk peserta didik WNA, diisi dengan no Luar Negeri.
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">No. Seri Ijazah
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="diploma" value="<?= $datatoedit->Diploma ?>">
                                                                <span class="help-block">
                                                                    Nomor seri ijazah peserta didik pada jenjang sebelumnya
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <label class="control-label col-md-3">No. SKHUN Jenjang Sebelumnya
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-md-line-input" style="padding-top: 0px; padding-left: 15px;">
                                                                <input type="text" class="form-control" name="skhun" value="<?= $datatoedit->SKHUN ?>">
                                                                <span class="help-block">
                                                                    Nomor seri ijazah peserta didik pada jenjang sebelumnya
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="margin-top-20" style="float: right;">
                                                        <a type="submit" class="btn blue-ebonyclay btn-lg btn-outline btn_upd_std" style="padding-top: 12px;height: 45px; min-width: 100px;"> UPDATE </a>
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
                                        <p> Upload image for Student. </p>
                                        <form action="<?= base_url('Admin/update_img_std/') . $datatoedit->NIS; ?>" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 300px; height: 300px; background-color: #F8F8F7">
                                                        <img src="<?= base_url('assets/photos/noimage.gif') ?>" class="img-prev" alt=""> </div>
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
                                    <div class="tab-pane" id="tab_1_3">
                                        <?= $this->session->flashdata('pass'); ?>
                                        <form action="<?= base_url('admin/change_password/' . $datatoedit->NIS); ?>" method="POST" enctype="multipart/form-data">
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
                                                <a href="<?= base_url('Admin/load_prof_std_edit') ?>" class="btn default" style="padding-top: 12px;height: 45px; min-width: 100px;"> Cancel </a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE DATA SISWA-->
                </div>
            </div>




        </div>
        <!-- END PAGE BASE CONTENT -->

        <!-- 
            this Function loads all the Room from selected Class. 
            this function placed here because it does not work in external .js files (profile.js)
            for unknown reason. 
            
            i'm still trying to figure it out, but might as well comment for future reminder
        -->
        <script type="text/javascript">
            window.onload = function() {
                $('.upd-std .classes').change(function() {
                    let cls = $(this).val();

                    $.ajax({
                        url: '<?= base_url('Admin/get_room_from_selected_class') ?>',
                        method: 'POST',
                        data: {
                            cls
                        },
                        success: function(data) {
                            let option = $('.upd-std option').parent('select[name="room"]');

                            option.html(data);
                        },
                        error: function() {
                            alert('ERROR');
                        }
                    });
                })
            }
        </script>

        <?php $this->load->view('_partials/_foot'); ?>