<?php $this->load->view('teacher/navbar/navbar'); ?>

<div class="container-fluid">
    <div class="page-content">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="profile">
            <div class="row">
                <div class="col-md-2">
                    <ul class="list-unstyled profile-nav">
                        <li>
                            <img src="<?= base_url(); ?>assets/photos/<?= $table->Photo; ?>" class="img-responsive img-circle" style="max-width: 100%;" alt="" />
                        </li>
                    </ul>
                </div>
                <div class="col-md-10">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1" data-toggle="tab"> Data Diri Guru </a>
                            </li>
                            <li>
                                <a href="#tab_2 " data-toggle="tab"> Detil Keanggotaan Guru </a>
                            </li>
                            <li>
                                <a href="#tab_3" data-toggle="tab"> Change Password </a>
                            </li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="tab_1">
                                <div class="row">

                                    <div class="col-md-6">
                                        <h4 style="background-color: #659be0; height: 30px;padding-top: 5px">
                                            <font color="white">&nbsp;&nbsp;&nbsp;Data Pribadi</font>
                                        </h4>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-advance table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            ID
                                                        </td>
                                                        <td> <?= $table->IDNumber ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            No KTP
                                                        </td>
                                                        <td> <?= $table->PersonalID ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Nama Lengkap
                                                        </td>
                                                        <td> <?= $table->FirstName ?> <?= $table->LastName ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Status
                                                        </td>
                                                        <td> <?= strtoupper($table->status) ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Posisi
                                                        </td>
                                                        <td> <?= $table->SchoolPosition ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Jenis Kelamin
                                                        </td>
                                                        <td> <?= $table->Gender ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Agama
                                                        </td>
                                                        <td> <?= $table->Religion ?> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h4 style="background-color: #659be0; height: 30px;padding-top: 5px">
                                            <font color="white">&nbsp;&nbsp;&nbsp;Data Fisik</font>
                                        </h4>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-advance table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Tanggal Lahir
                                                        </td>
                                                        <td> <?= $table->DateofBirth ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Umur
                                                        </td>
                                                        <td>
                                                            <?php $dateOfBirth = $table->DateofBirth;
                                                            $today = date("Y-m-d");
                                                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                            ?>
                                                            <?= $diff->format('%y'); ?>
                                                        </td>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Golongan Darah
                                                        </td>
                                                        <td> <?= $table->Bloodtype ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Suku
                                                        </td>
                                                        <td> <?= $table->Race ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Tinggi
                                                        </td>
                                                        <td> <?= $table->Height ?> cm </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Berat
                                                        </td>
                                                        <td> <?= $table->Weight ?> kg </td>
                                                    </tr>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 style="background-color: #659be0; height: 30px;padding-top: 5px">
                                            <font color="white">&nbsp;&nbsp;&nbsp;Alamat Lengkap Siswa</font>
                                        </h4>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-advance table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Alamat
                                                        </td>
                                                        <td>
                                                            <?= $table->Address ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Kecamatan
                                                        </td>
                                                        <td>
                                                            <?= $table->Region ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Kota
                                                        </td>
                                                        <td>

                                                            <?= $table->City ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Provinsi
                                                        </td>
                                                        <td>
                                                            <?= $table->Province ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Negara
                                                        </td>
                                                        <td>
                                                            <?= $table->Country ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h4 style="background-color: #659be0; height: 30px;padding-top: 5px">
                                            <font color="white">&nbsp;&nbsp;&nbsp;Kontak</font>
                                        </h4>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-advance table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            Email
                                                        </td>
                                                        <td> <?= $table->Email ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-dark sbold">
                                                            No. Telp
                                                        </td>
                                                        <td> <?= $table->Phone ?> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab_2">
                                <div class="row">
                                    <div class="portlet-body">
                                        <div class="col-lg-12">
                                            <h4 style="background-color: #659be0; height: 30px;padding-top: 5px">
                                                <font color="white">&nbsp;&nbsp;&nbsp;Data Guru</font>
                                            </h4>
                                            <div class="portlet-body">
                                                <table class="table table-striped table-advance table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <td class="font-dark sbold">
                                                                Status yang Diajar
                                                            </td>
                                                            <td> <?= $table->SubjectTeach ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-dark sbold">
                                                                Pendidikan Terakhir
                                                            </td>
                                                            <td> <?= $table->LastEducation ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-dark sbold">
                                                                Program Studi
                                                            </td>
                                                            <td> <?= $table->StudyFocus ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-dark sbold">
                                                                Masa Bakti
                                                            </td>
                                                            <td> <?= $table->ServiceYear ?> Tahun </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="font-dark sbold">
                                                                Status Perkawinan
                                                            </td>
                                                            <td> <?= $table->MaritalStatus ?> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- CHANGE PASSWORD TAB -->
                            <div class="tab-pane" id="tab_3">
                                <div class="portlet-body">
                                    <?= $this->session->flashdata('message'); ?>
                                    <form action="<?= base_url('Teacher/chg_pass'); ?>" method="post">
                                        <div class="form-group">
                                            <label class="control-label">Current Password</label>
                                            <input type="password" class="form-control" name="oldpass" id="oldpass">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">New Password</label>
                                            <input type="password" class="form-control" name="newpass" id="newpass">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Re-type New Password</label>
                                            <input type="password" class="form-control" name="renewpass" id="renewpass">
                                        </div>
                                        <div class="margin-top-10">
                                            <button class="btn green" type="submit">Save</button>
                                            <a href="<?= base_url('Student/load_profile#tab_2'); ?>" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
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