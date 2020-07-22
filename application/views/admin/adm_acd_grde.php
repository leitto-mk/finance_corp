<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<!-- MODAL FULL GRADE DETAILS (GOGNITIVE) -->
<div id="responsive" class="modal fade in full_details_cognitive" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-full" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title opt_title" style="color: white">Cognitive</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <select class="form-control edited by_cls">
                                <?php foreach ($rooms as $row) : ?>
                                    <option class="sbold" value="<?= $row->RoomDesc ?>"> <?= $row->RoomDesc ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="form_control_1">Select Class</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <select class="form-control edited by_year">
                                <?php foreach($period as $period_cog) : ?>
                                    <option value="<?=$period_cog->schoolyear?>" data-semester="<?= $period_cog->Semester?>"><?= 'Semester ' . ($period_cog->Semester == 1 ? 'Ganjil' : 'Genap') .' - '. $period_cog->schoolyear ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="form_control_1">Select Year</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabbable-custom" style="margin-top: 15px">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#detailed_cognitive" data-toggle="tab" aria-expanded="true"> Detailed </a>
                                </li>
                                <li class="">
                                    <a href="#recap_cognitive" data-toggle="tab" aria-expanded="false"> Recap </a>
                                </li>
                                <li class="">
                                    <a href="#summary_cognitive" data-toggle="tab" aria-expanded="false"> Summary </a>
                                </li>
                                <!-- <li class="">
                                    <a href="#old" data-toggle="tab" aria-expanded="false"> Old </a>
                                </li> -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="detailed_cognitive">
                                    <div class="portlet light portlet-fit">
                                        <div class="portlet-body" style="padding-left: 0px; padding-right: 0px">
                                            <div class="table-scrollable">
                                                <table class="table table-bordered table-hover table_full_det tbl_detailed_cognitive">
                                                    <!-- AJAX TABLE GOES HERE -->
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="recap_cognitive">
                                    <div class="portlet light portlet-fit">
                                        <div class="portlet-body" style="padding-left: 0px; padding-right: 0px">
                                            <div class="table-scrollable">
                                                <table class="table table-bordered table-hover table_full_det tbl_recap_cognitive">
                                                    <!-- AJAX TABLE GOES HERE -->
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="summary_cognitive">
                                    <div class="portlet light portlet-fit">
                                        <div class="portlet-body" style="padding-left: 0px; padding-right: 0px">
                                            <div class="table-scrollable">
                                                <table class="table table-bordered table-hover table_full_det tbl_summary_cognitive">
                                                    <!-- AJAX TABLE SUMMARY BODY GOES HERE -->
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

<!-- MODAL FULL GRADE DETAILS (SKILLS) -->
<div id="responsive" class="modal fade in full_details_skills" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-full" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title opt_title" style="color: white">Skill</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <select class="form-control edited by_cls">
                                <?php foreach ($rooms as $row) : ?>
                                    <option class="sbold" value="<?= $row->RoomDesc ?>"> <?= $row->RoomDesc ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="form_control_1">Select Class</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <select class="form-control edited by_year">
                                <?php foreach($period as $period_sk) : ?>
                                    <option value="<?=$period_sk->schoolyear?>" data-semester="<?=$period_sk->Semester?>"><?= 'Semester ' . ($period_sk->Semester == 1 ? 'Ganjil' : 'Genap') .' - '. $period_sk->schoolyear ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="form_control_1">Select Year</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabbable-custom" style="margin-top: 15px">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#detailed_skills" data-toggle="tab" aria-expanded="true"> Detailed </a>
                                </li>
                                <li class="">
                                    <a href="#summary_skills" data-toggle="tab" aria-expanded="false"> Summary </a>
                                </li>
                                <!-- <li class="">
                                    <a href="#old" data-toggle="tab" aria-expanded="false"> Old </a>
                                </li> -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="detailed_skills">
                                    <div class="portlet light portlet-fit">
                                        <div class="portlet-body" style="padding-left: 0px; padding-right: 0px">
                                            <div class="table-scrollable">
                                                <table class="table table-bordered table-hover table_full_det tbl_detailed_skills">
                                                    <!-- AJAX TABLE GOES HERE -->
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="summary_skills">
                                    <div class="portlet light portlet-fit">
                                        <div class="portlet-body" style="padding-left: 0px; padding-right: 0px">
                                            <div class="table-scrollable">
                                                <table class="table table-bordered table-hover table_full_det tbl_summary_skills">
                                                    <!-- AJAX TABLE SUMMARY BODY GOES HERE -->
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

<!-- MODAL FULL GRADE DETAILS (CHARACTERS) -->
<div id="responsive" class="modal fade in full_details_character" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-full" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title opt_title" style="color: white">Character</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <select class="form-control edited by_cls">
                                <?php foreach ($rooms as $row) : ?>
                                    <option class="sbold" value="<?= $row->RoomDesc ?>"> <?= $row->RoomDesc ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="form_control_1">Select Class</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <select class="form-control edited by_year">
                                <?php foreach($period as $period_char) : ?>
                                    <option value="<?=$period_char->schoolyear?>" data-semester="<?= $period_char->Semester ?>"><?= 'Semester ' . ($period_char->Semester == 1 ? 'Ganjil' : 'Genap') .' - '. $period_char->schoolyear ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="form_control_1">Select Year</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabbable-custom" style="margin-top: 15px">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#social" data-toggle="tab" aria-expanded="true"> Social </a>
                                </li>
                                <li class="">
                                    <a href="#spiritual" data-toggle="tab" aria-expanded="false"> Spiritual </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="caption-desc font-grey-cascade">
                                    <span class="text-center sbold">4</span> -
                                    <pre class="mt-code">Selalu</pre>
                                    <br>
                                    <span class="text-center sbold">3</span> -
                                    <pre class="mt-code">Sering</pre>
                                    <br>
                                    <span class="text-center sbold">2</span> -
                                    <pre class="mt-code">Kadang-Kadang</pre>
                                    <br>
                                    <span class="text-center sbold">1</span> -
                                    <pre class="mt-code">Tidak Pernah</pre>
                                </div>
                                <div class="tab-pane active" id="social">
                                    <div class="portlet light portlet-fit">
                                        <div class="portlet-body" style="padding-left: 0px; padding-right: 0px">
                                            <div class="table-scrollable">
                                                <div class="table-scrollable">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <td colspan="2" class="text-center"><b>NOMOR</b></td>
                                                                <td rowspan="2" class="text-center"><b>NAMA</b></td>
                                                                <td colspan="7" class="text-center"><b>REKAP PENILAIAN SIKAP SOSIAL</b></td>
                                                                <td rowspan="2" class="sbold text-center">NILAI</td>
                                                                <td rowspan="2" class="sbold text-center">PREDIKAT</td>
                                                                <td rowspan="2" class="sbold text-center">DESKRIPSI</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center"><b> URT </b></td>
                                                                <td class="text-center"><b> INDUK </b></td>
                                                                <?php foreach ($social as $soc) : ?>
                                                                    <td><b><?= $soc->Description ?></b></td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="tbody_soc">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="spiritual">
                                    <div class="portlet light portlet-fit">
                                        <div class="portlet-body" style="padding-left: 0px; padding-right: 0px">
                                            <div class="table-scrollable">
                                                <div class="table-scrollable">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <td colspan="2" class="text-center"><b>NOMOR</b></td>
                                                                <td rowspan="2" class="text-center"><b>NAMA</b></td>
                                                                <td colspan="5" class="text-center"><b>PENILAIAN SIKAP SPIRITUAL</b></td>
                                                                <td rowspan="2" class="sbold text-center">NILAI</td>
                                                                <td rowspan="2" class="sbold text-center">PREDIKAT</td>
                                                                <td rowspan="2" class="sbold text-center">DESKRIPSI</td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="4" class="text-center"><b> URT </b></td>
                                                                <td rowspan="4" class="text-center"><b> INDUK </b></td>
                                                                <?php foreach ($spirit as $spirit) : ?>
                                                                    <td><b><?= $spirit->Description ?></b></td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="tbody_spr">

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
</div>

<!-- MODAL GRADE OPTION -->
<div id="responsive" class="modal fade in opt_modal" tabindex="-1" aria-hidden="true" style="margin-top: 20px;">
    <div class="modal-dialog modal-full" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title opt_title" style="color: white">Options</h4>
            </div>
            <div class="detail-body">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-md-line-input has-info" style="padding-top: 0px;margin-bottom: 10px">
                                <h2 for="form_control_1"> Select Degree </h2>
                                <select class="form-control glevel" id="form_control_1" style="width: 45%">
                                    <?php foreach ($degree as $row) : ?>
                                        <option value="<?= $row->School_Desc ?>"> <?= $row->School_Desc ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 35px">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="row" style="margin-left: 3px;">
                                                <h3 class="form-section">Active Days </h3>
                                                <div class="col-sm-12">
                                                    <span class="help-block"> insert school effective days for this semester </span>
                                                    <input class="form-control form-control-inline input-sm active_days" type="number" value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row" style="margin-left: 3px;">
                                                <h3 class="form-section">Grade's Weight <span style="color: red; font-size: 12px">*affects all subjects</span> </h3>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                                                        <span class="help-block"> KD Cognitive Recap Weight </span>
                                                        <input class="form-control form-control-inline input-sm subject_weight" data-field="KDWeight" type="number" value="0">
                                                    </div>
                                                    <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                                                        <span class="help-block"> KD Skill Recap Weight </span>
                                                        <input class="form-control form-control-inline input-sm subject_weight" data-field="KDWeight_SK" type="number" value="0">
                                                    </div>
                                                    <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                                                        <span class="help-block"> Mid Test Weight </span>
                                                        <input class="form-control form-control-inline input-sm subject_weight" data-field="MidWeight" type="number" value="0">
                                                    </div>
                                                    <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                                                        <span class="help-block"> Final Test Weight </span>
                                                        <input class="form-control form-control-inline input-sm subject_weight" data-field="FinalWeight" type="number" value="0">
                                                    </div>
                                                    <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                                                        <span class="help-block"> Absence Weight </span>
                                                        <input class="form-control form-control-inline input-sm subject_weight" data-field="Absent" type="number" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row" style="margin-left: 3px;">
                                                <h3 class="form-section">KKM </h3>
                                                <div class="col-sm-12">
                                                    <span class="help-block"> insert Subject's Minimum Passing Grade (<span style="color: red; font-size: 12px">*affects all Subject's KD</span>) </span>
                                                    <input class="form-control form-control-inline input-sm kkm_minimum" type="number" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <div class="row" style="margin-left: 3px;">
                                                    <h3 class="form-section">Predicate <span style="color: red; font-size: 12px">*double click the value and press enter to change</span> </h3>
                                                    <div class="col-sm-12">
                                                        <div class="table-responsive tbl_cls">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th> Predicate </th>
                                                                        <th> Maximum </th>
                                                                        <th> Minimum </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="edit_predicate">
                                                                    <!-- AJAX PREDICATE GOES HERE-->
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
                            <!-- <div class="row">
                                            <div class="col-md-12">
                                                <div class="portlet box white">
                                                    <div class="portlet-title">
                                                        <div class="caption" style="color:black">
                                                            <i class="fa fa-gift"></i>DATA MASTER: DESKRIPSI </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                                <ul class="nav nav-tabs tabs-left">
                                                                    <li class="active">
                                                                        <a href="#tab_6_1" data-toggle="tab" aria-expanded="true"><b>NILAI AKHIR </b></a>
                                                                    </li>
                                                                    <li class="">
                                                                        <a href="#tab_6_2" data-toggle="tab" aria-expanded="false"><b>Per KD </b></a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#tab_6_3" data-toggle="tab"><b>SPRITUAL & SOSIAL </b></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                                <div class="tab-content">
                                                                    <div class="tab-pane active in" id="tab_6_1">
                                                                        <div class="portlet light portlet-fit bordered">
                                                                            <div class="portlet-body">
                                                                                <div class="table-scrollable">
                                                                                    <table class="table table-bordered table-hover">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <td></td>
                                                                                                <td colspan="2" class="text-center"><b>PENGETAHUAN </b></td>
                                                                                                <td colspan="2" class="text-center"><b>KETERAMPILAN </b></td>

                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center"><b>Nilai</b></td>
                                                                                                <td class="text-center"><b>Teks Depan </b></td>
                                                                                                <td class="text-center"><b>Teks Belakang </b></td>
                                                                                                <td class="text-center"><b>Teks Depan</b></td>
                                                                                                <td class="text-center"><b>Teks Belakang</b></td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="text-center">0,00 ≤ x ≤ 0,00</td>
                                                                                                <td class="text-center">Tidak satupun kompetensi yang dikuasai</td>
                                                                                                <td class="text-center">Luangkan waktu untuk belajar!</td>
                                                                                                <td class="text-center">Tidak satupun keterampilan yang dikuasai</td>
                                                                                                <td class="text-center">Sediakan waktu untuk berlatih! </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">0,01 ≤ x ≤ 55,99</td>
                                                                                                <td class="text-center">Kurang kompeten</td>
                                                                                                <td class="text-center">Harus tingkatkan waktu belajar!</td>
                                                                                                <td class="text-center">Tidak terampil</td>
                                                                                                <td class='text-center'>. Lebih sering berlatih!</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">56,00 ≤ x ≤ 70,99</td>
                                                                                                <td class="text-center">Cukup kompeten</td>
                                                                                                <td class="text-center">Terus Semangat Belajar!</td>
                                                                                                <td class="text-center">Cukup terampil</td>
                                                                                                <td class="text-center">Tingkatkan semangat belajar!</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">71,00 ≤ x ≤ 85,99</td>
                                                                                                <td class="text-center">Sudah kompeten</td>
                                                                                                <td class="text-center">Tingkatkan Prestasi!</td>
                                                                                                <td class="text-center">Sudah terampil</td>
                                                                                                <td class="text-center">Terus tingkatkan belajarmu!</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">86,00 ≤ x ≤ 100,00</td>
                                                                                                <td class="text-center">Sangat kompeten</td>
                                                                                                <td class="text-center">Pertahankan Prestasi!</td>
                                                                                                <td class="text-center">Sangat terampil</td>
                                                                                                <td class="text-center">Tetap berlatih dan pertahankan keterampilan.</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="tab-pane fade" id="tab_6_2">
                                                                        <div class="portlet light portlet-fit bordered">
                                                                            <div class="portlet-body">
                                                                                <div class="table-scrollable">
                                                                                    <table class="table table-bordered table-hover">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <td colspan="3" class="text-center"><b>PENGETAHUAN DAN KETERAMPILAN </b></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center"><b>Logika</b></td>
                                                                                                <td class="text-center"><b>Pengetahuan</b></td>
                                                                                                <td class="text-center"><b>Keterampilan</b></td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="text-center">Jika telah tuntas</td>
                                                                                                <td class="text-center">Sudah menguasai</td>
                                                                                                <td class="text-center">Sudah menguasai</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">Jika Belum Tuntas</td>
                                                                                                <td class="text-center">Belum Menguasai</td>
                                                                                                <td class="text-center">Belum Menguasai</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">Kata Penghubung</td>
                                                                                                <td class="text-center">Namun </td>
                                                                                                <td class="text-center">Namun</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="tab_6_3">
                                                                        <div class="portlet light portlet-fit bordered">
                                                                            <div class="portlet-body">
                                                                                <div class="table-scrollable">
                                                                                    <table class="table table-bordered table-hover">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <td colspan="3" class="text-center"><b>SIKAP SPRITUAL DAN SOSIAL </b></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center"><b>Nilai</b></td>
                                                                                                <td class="text-center"><b>Nilai Per Aspek Sikap</b></td>
                                                                                                <td class="text-center"><b>Nilai Akhir Sikap</b></td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="text-center">0,00 ≤ x ≤ 0,00</td>
                                                                                                <td class="text-center">Tidak konsisten bersikap</td>
                                                                                                <td class="text-center">Tidak konsisten bersikap</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">0,01 ≤ x ≤ 1,84</td>
                                                                                                <td class="text-center">Tidak konsisten bersikap </td>
                                                                                                <td class="text-center">Tidak konsisten bersikap</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">1,85 ≤ x ≤ 2,84</td>
                                                                                                <td class="text-center">Perlu ditingkatkan bersikap </td>
                                                                                                <td class="text-center">Perlu ditingkatkan bersikap</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">2,85 ≤ x ≤ 3,84</td>
                                                                                                <td class="text-center">Sudah berusaha maksimal bersikap </td>
                                                                                                <td class="text-center">Sudah berusaha maksimal bersikap</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">3,85 ≤ x ≤ 4,00</td>
                                                                                                <td class="text-center">Selalu konsisten bersikap</td>
                                                                                                <td class="text-center">Selalu konsisten bersikap</td>
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

                                            <div class="col-md-12">
                                                <div class="portlet box white">
                                                    <div class="portlet-title">
                                                        <div class="caption" style="color:black">
                                                            <i class="fa fa-gift"></i>DATA MASTER: OPSI PENILAIAN </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                                <ul class="nav nav-tabs tabs-left">
                                                                    <li class="active">
                                                                        <a href="#tab_7_1" data-toggle="tab" aria-expanded="true"><b> PENILAIN (PILIHAN) </b></a>
                                                                    </li>
                                                                    <li class="">
                                                                        <a href="#tab_7_2" data-toggle="tab" aria-expanded="false"><b>SIKAP SOSIAL</b></a>
                                                                    </li>

                                                                    <li>
                                                                        <a href="#tab_7_3" data-toggle="tab"><b>SIKAP RELIGIUS</b></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                                <div class="tab-content">
                                                                    <div class="tab-pane active in" id="tab_7_1">
                                                                        <div class="portlet light portlet-fit bordered">

                                                                            <div class="portlet-body">
                                                                                <div class="table-scrollable">
                                                                                    <table class="table table-bordered table-hover">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <td class="text-center"><b>PENGETAHUAN </b></td>
                                                                                                <td class="text-center"><b>KETERAMPILAN </b></td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="text-center">Tugas</td>
                                                                                                <td class="text-center">Portofolio</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">Pekerjaan Rumah (PR)</td>
                                                                                                <td class="text-center">Praktik</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">Tes&nbsp;Tulis</td>
                                                                                                <td class="text-center">Proyek</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">Tes&nbsp;Lisan</td>
                                                                                                <td class="text-center">Tes&nbsp;Praktik</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">Ulangan&nbsp;Harian</td>
                                                                                                <td class="text-center">Lain-lain</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">Lain-lain</td>
                                                                                                <td class="text-center">&nbsp;</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="tab_7_2">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="portlet light portlet-fit bordered">

                                                                                    <div class="portlet-body">
                                                                                        <div class="table-scrollable">
                                                                                            <table class="table table-bordered table-hover">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <td class="text-center"><b>Aspek&nbsp;Sikap&nbsp;(Simpel)</b></td>
                                                                                                        <td class="text-center"><b>Kategori&nbsp;Penilaian</b></td>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Disiplin</td>
                                                                                                        <td class="text-center">OBSERVASI</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Rasa&nbsp;Ingin&nbsp;Tahu</td>
                                                                                                        <td class="text-center">PENILAIAN&nbsp;DIRI</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Teliti</td>
                                                                                                        <td class="text-center">PENILAIAN&nbsp;TEMAN</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Tanggung&nbsp;Jawab</td>
                                                                                                        <td class="text-center">JURNAL</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Komunikatif</td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Santun</td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Jujur</td>
                                                                                                        <td> </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Peduli</td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Percaya&nbsp;diri</td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Kerjasama</td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Toleransi</td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                                <tfoot>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Jumlah&nbsp;Aspek&nbsp;Sikap&nbsp;(SIMPEL)&nbsp;:</td>
                                                                                                        <td></td>
                                                                                                    <tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">11</td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                </tfoot>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="portlet light portlet-fit bordered">

                                                                                    <div class="portlet-body">
                                                                                        <div class="table-scrollable">
                                                                                            <table class="table table-bordered table-hover">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <td class="text-center"><b>Aspek&nbsp;Sikap&nbsp;(Standar)</b></td>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Jujur</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Disiplin</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Tanggung&nbsp;Jawab</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Toleransi</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Gotong&nbsp;Royong</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Santun</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Percaya Diri</d>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>&nbsp;</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>&nbsp;</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>&nbsp;</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>&nbsp;</td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                                <tfoot>
                                                                                                    <tr>
                                                                                                        <td class="text-center">Jumlah&nbsp;Aspek&nbsp;Sikap&nbsp;(STANDAR)&nbsp;:</td>
                                                                                                        <td></td>
                                                                                                    <tr>
                                                                                                    <tr>
                                                                                                        <td class="text-center">7</td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                </tfoot>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="tab_7_3">
                                                                        <div class="portlet light portlet-fit bordered">

                                                                            <div class="portlet-body">
                                                                                <div class="table-scrollable">
                                                                                    <table class="table table-bordered table-hover">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <td class="text-center"><b>Aspek&nbsp;Sikap&nbsp;(Simpel)</b></td>
                                                                                                <td class="text-center"><b>Kategori&nbsp;Penilaian</b></td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="text-center">Berdoa&nbsp;sebelum&nbsp;melakukan&nbsp;kegiatan</td>
                                                                                                <td class="text-center">OBSERVASI</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">Bersyukur&nbsp;setelah&nbsp;beraktivitas</td>
                                                                                                <td class="text-center">PENILAIAN&nbsp;DIRI</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">Toleran&nbsp;pada&nbsp;agama&nbsp;yang&nbsp;berbeda</td>
                                                                                                <td class="text-center">PENILAIAN&nbsp;TEMAN</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">Taat&nbsp;beribadah</td>
                                                                                                <td class="text-center">JURNAL</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-center">Memberi&nbsp;Salam&nbsp;dan&nbsp;bertegur&nbsp;sapa</td>
                                                                                                <td></td>
                                                                                            </tr>


                                                                                        </tbody>
                                                                                        <tfoot>
                                                                                            <tr>
                                                                                                <td class="text-center">Jumlah&nbsp;Aspek&nbsp;Sikap&nbsp;(SIMPEL)&nbsp;:</td>
                                                                                                <td></td>
                                                                                            <tr>
                                                                                            <tr>
                                                                                                <td class="text-center">5</td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                        </tfoot>
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
                                        </div> -->
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>
</div>

<!-- MODAL REPORT FULL -->
<div id="responsive" class="modal fade in details_grade" tabindex="-1" aria-hidden="true" style="margin-top: 20px;">
    <div class="modal-dialog modal-full" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="rep_full_title" style="color: white"></h4>
            </div>
            <div class="detail-body">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-md-4">
                                <div class="list_subj_std">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="md-radio-inline" style="margin-top: 20px">
                                    <div class="md-radio">
                                        <input type="radio" id="full_grade_semester1" name="full_select_semester" class="md-radiobtn radio_semester" data-semester="1" checked>
                                        <label for="full_grade_semester1">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Semester 1 </label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio" id="full_grade_semester2" name="full_select_semester" class="md-radiobtn radio_semester" data-semester="2">
                                        <label for="full_grade_semester2">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Semester 2 </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <a href="#" target="_blank" class="btn green-meadow print_grade_report" style="float: right; margin-top: 10px; min-width: 70px; margin-left: 10px"> Full Report
                                    <i class="fa fa-print"></i>
                                </a>
                                <a href="#" target="_blank" class="btn blue-steel print_grade_mid_report" style="float: right; margin-top: 10px; min-width: 70px;"> Mid-Term
                                    <i class="fa fa-print"></i>
                                </a>
                            </div>
                            <div class="col-lg-12">
                                <div class="tabbable tabbable-tabdrop">
                                    <div class="col-sm-6" style="padding-left: 0px; ">
                                        <div class="table-scrollable" style="margin-top: 0px !important;">
                                            <table class="table table-hover table-light tbl_report_cognitive">
                                                <thead>
                                                    <tr>
                                                        <th colspan="5" class="text-center"> COGNITIVE </th>
                                                    </tr>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> Material (KD) </th>
                                                        <th> Code </th>
                                                        <th> KKM </th>
                                                        <th> Grade </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="kd_cog">

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th colspan="4" class="text-center"> Exams </th>
                                                        <th colspan="1"> Grade </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="exam_cog">

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th colspan="4" class="text-center"> Grade </th>
                                                        <th colspan="1"> Predicate </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="report_cog">

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" colspan="4"> Description </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="desc_cog">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding-left: 0px; padding-right: 0px;">
                                        <div class="table-scrollable" style="margin-top: 0px !important;">
                                            <table class="table table-hover table-light tbl_report_skills">
                                                <thead>
                                                    <tr>
                                                    <tr>
                                                        <th colspan="5" class="text-center"> SKILL </th>
                                                    </tr>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> Material (KD) </th>
                                                        <th> Code </th>
                                                        <th> KKM </th>
                                                        <th> Grade </th>
                                                    </tr>
                                                    </tr>
                                                </thead>
                                                <tbody class="kd_sk">

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th colspan="4" class="text-center"> Exams </th>
                                                        <th colspan="1"> Grade </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="exam_sk">

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th colspan="4" class="text-center"> Grade </th>
                                                        <th colspan="1"> Predicate </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="report_sk">

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" colspan="4"> Description </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="desc_sk">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-sm-6">
                                    <table class="table table-light table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="6">Kompetensi Sikap Spritual</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center" width="15%">DESKRIPSI</th>
                                                <th class="text-center" width="5%"> NILAI</th>
                                                <th class="text-center" width="5%"> PREDIKAT</th>
                                            </tr>
                                        </thead>
                                        <tbody class="report_spr">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <table class="table table-light table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="6">Kompetensi Sikap Sosial</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center" width="15%">DESKRIPSI</th>
                                                <th class="text-center" width="5%"> NILAI</th>
                                                <th class="text-center" width="5%"> PREDIKAT</th>
                                            </tr>
                                        </thead>
                                        <tbody class="report_soc">

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

<!-- REPORT COMPACT -->
<div id="responsive" class="modal fade in details_grade_compact" tabindex="-1" aria-hidden="true" style="margin-top: 20px;">
    <div class="modal-dialog modal-full" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 id="compact_title" class="modal-title opt_title" style="color: white">Options</h4>
            </div>
            <div class="detail-body">
                <div class="col-md-12">
                    <div class="md-radio-inline" style="margin-top: 20px">
                        <div class="md-radio">
                            <input type="radio" id="compact_grade_semester1" name="compact_select_semester" class="md-radiobtn radio_semester" data-semester="1" checked>
                            <label for="compact_grade_semester1">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Semester 1 </label>
                        </div>
                        <div class="md-radio">
                            <input type="radio" id="compact_grade_semester2" name="compact_select_semester" class="md-radiobtn radio_semester" data-semester="2">
                            <label for="compact_grade_semester2">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Semester 2 </label>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="tab-pane active" id="tab_1_3">
                                <div class="row profile-account">
                                    <div class="col-md-3">
                                        <ul class="ver-inline-menu tabbable margin-bottom-10">
                                            <li class="active">
                                                <a data-toggle="tab" href="#tab_1-1" aria-expanded="true">
                                                    <i class="fa fa-book"></i> Grades Report </a>
                                                <span class="after"> </span>
                                            </li>
                                            <li class="">
                                                <a data-toggle="tab" href="#tab_2-2" aria-expanded="true">
                                                    <i class="fa fa-sign-language"></i> Skills Report </a>
                                            </li>
                                            <li class="">
                                                <a data-toggle="tab" href="#tab_3-3" aria-expanded="true">
                                                    <i class="fa fa-user"></i> Character Report </a>
                                            </li>
                                            <!-- <li class="">
                                                <a data-toggle="tab" href="#tab_4-4" aria-expanded="true">
                                                    <i class="fa fa-child"></i> Extra Cullicular </a>
                                            </li>
                                            <li class="">
                                                <a data-toggle="tab" href="#tab_5-5" aria-expanded="true">
                                                    <i class="fa fa-trophy"></i> Achievement </a>
                                            </li> -->
                                            <li class="">
                                                <a data-toggle="tab" href="#tab_6-6" aria-expanded="true">
                                                    <i class="fa fa-list-ol"></i> Absence </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="tab-content">
                                            <div id="tab_1-1" class="tab-pane active">
                                                <div class="row">
                                                    <div class="col-md-12" style="padding-left: 0px">
                                                        <div class="table-scrollable" style="margin-top: 0px !important;">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr>
                                                                        <th> # </th>
                                                                        <th> Subject Name </th>
                                                                        <th> Grade </th>
                                                                        <th> Predicate </th>
                                                                        <th> Description </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="grade_report_tbody">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6" style="padding-left: 0px">
                                                        <div class="table-scrollable">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="4" class="sbold text-center" style="padding-top: 2px;padding-bottom: 2px;"> PREDICATE SPECTRUM </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="sbold text-center" style="padding-top: 3px;padding-bottom: 3px;"> D </th>
                                                                        <th class="sbold text-center" style="padding-top: 3px;padding-bottom: 3px;"> C </th>
                                                                        <th class="sbold text-center" style="padding-top: 3px;padding-bottom: 3px;"> B </th>
                                                                        <th class="sbold text-center" style="padding-top: 3px;padding-bottom: 3px;"> A </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="grade_report_spectrum">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab_2-2" class="tab-pane">
                                                <div class="row">
                                                    <div class="col-md-12" style="padding-left: 0px">
                                                        <div class="table-scrollable" style="margin-top: 0px !important;">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr>
                                                                        <th> # </th>
                                                                        <th> Subject Name </th>
                                                                        <th> Grade </th>
                                                                        <th> Predicate </th>
                                                                        <th> Description </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="skills_report_tbody">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6" style="padding-left: 0px">
                                                        <div class="table-scrollable">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="4" class="sbold text-center" style="padding-top: 2px;padding-bottom: 2px;"> PREDICATE SPECTRUM </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="sbold text-center" style="padding-top: 3px;padding-bottom: 3px;"> D </th>
                                                                        <th class="sbold text-center" style="padding-top: 3px;padding-bottom: 3px;"> C </th>
                                                                        <th class="sbold text-center" style="padding-top: 3px;padding-bottom: 3px;"> B </th>
                                                                        <th class="sbold text-center" style="padding-top: 3px;padding-bottom: 3px;"> A </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="grade_report_spectrum">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab_3-3" class="tab-pane">
                                                <div class="row">
                                                    <div class="col-md-12" style="padding-left: 0px">
                                                        <div class="table-scrollable" style="margin-top: 0px !important;">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="sbold"> # </th>
                                                                        <th class="sbold"> Subject Name </th>
                                                                        <th class="sbold"> Grade </th>
                                                                        <th class="sbold"> Predicate </th>
                                                                        <th class="sbold"> Description </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="soc_report_tbody">

                                                                </tbody>
                                                                <tbody class="spr_report_tbody">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab_4-4" class="tab-pane">
                                                <div class="row">
                                                    <div class="col-md-12" style="padding-left: 0px">
                                                        <div class="table-scrollable" style="margin-top: 0px !important;">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr>
                                                                        <th> # </th>
                                                                        <th> Excul </th>
                                                                        <th> Predicate </th>
                                                                        <th> Description </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="skills_report_tbody">
                                                                    <tr>
                                                                        <td width="5%">1</td>
                                                                        <td>...</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="5%">2</td>
                                                                        <td>...</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="5%">3</td>
                                                                        <td>...</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab_5-5" class="tab-pane">
                                                <div class="row">
                                                    <div class="col-md-12" style="padding-left: 0px">
                                                        <div class="table-scrollable" style="margin-top: 0px !important;">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr>
                                                                        <th> # </th>
                                                                        <th> Achievement </th>
                                                                        <th> Description </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="skills_report_tbody">
                                                                    <tr>
                                                                        <td width="5%">1</td>
                                                                        <td>...</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="5%">2</td>
                                                                        <td>...</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="5%">3</td>
                                                                        <td>...</td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab_6-6" class="tab-pane">
                                                <div class="row">
                                                    <div class="col-md-12" style="padding-left: 0px">
                                                        <table class="table table-hover table-light">
                                                            <thead>
                                                                <tr>
                                                                    <th> Absence Type </th>
                                                                    <th> Rate </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="absent_report_tbody">
                                                                <tr>
                                                                    <td width="25%"> Sick </td>
                                                                    <td> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="25%"> On Permit </td>
                                                                    <td> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="25%"> Absent </td>
                                                                    <td> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="25%"> Truant </td>
                                                                    <td> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="25%"> Late </td>
                                                                    <td> </td>
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
    </div>
</div>

<!-- MODAL INPUT MATERIAL -->
<div id="responsive" class="modal fade in material_mapping" tabindex="-1" aria-hidden="true" style="margin-top: 50px;">
    <div class="modal-dialog modal-full" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title opt_title" style="color: white"> </h4>
            </div>
            <div class="detail-body">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row" style="margin-left: 5px">
                                <div class="form-group form-md-line-input has-info" style="padding-top: 0px;margin-bottom: 10px">
                                    <h2 for="form_control_1"> Select Class </h2>
                                    <select class="form-control kd_classes" id="form_control_1" style="width: 50%">
                                        <?php foreach ($class as $row) : ?>
                                            <option value="<?= $row->ClassRomanic ?>"> <?= $row->ClassRomanic  ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 5px">
                                <div class="mt-element-list">
                                    <div class="mt-list-container list-simple ext-1 group">
                                        <a class="list-toggle-container" data-toggle="collapse" href="#completed-simple" aria-expanded="true">
                                            <div class="list-toggle uppercase blue-chambray"> General
                                            </div>
                                        </a>
                                        <div class="panel-collapse collapse in" id="completed-simple" aria-expanded="true">
                                            <ul class="regular">
                                                <?php foreach ($subject as $row) : ?>
                                                    <?php if ($row->Type == 'Regular') : ?>
                                                        <li class="mt-list-item" style="padding: 5px; border-bottom: 0px; border-color: #fff">
                                                            <label class="uppercase">
                                                                <a href="javascript:;" class="list_subj"><?= $row->SubjName ?></a>
                                                            </label>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <a class="list-toggle-container" data-toggle="collapse" href="#pending-simple" aria-expanded="true">
                                            <div class="list-toggle uppercase blue-chambray"> Elective
                                            </div>
                                        </a>
                                        <div class="panel-collapse collapse in" id="completed-simple" aria-expanded="true">
                                            <ul class="elective">
                                                <?php foreach ($subject as $row) : ?>
                                                    <?php if ($row->Type == 'Elective') : ?>
                                                        <li style="padding: 5px; border-bottom: 0px; border-color: #fff">
                                                            <label class="uppercase">
                                                                <a href="javascript:;" class="list_subj"><?= $row->SubjName ?></a>
                                                            </label>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="mt-element-ribbon bg-grey-steel" style="margin-top: 15px">
                                <div id="selected_kd_class" class="ribbon ribbon-shadow ribbon-color-success uppercase" style="margin-top: 0px"></div>
                            </div>
                            <div class="tabbable-custom nav-justified" style="margin-top: 105px">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="text-center active" style="min-width: 100px">
                                        <a href="#cognitive" data-toggle="tab" data-type="cognitive">Cognitive</a>
                                    </li>
                                    <li class="text-center" style="min-width: 100px">
                                        <a href="#skills" data-toggle="tab" data-type="skills">Skills</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="cognitive">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="portlet box blue-chambray">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-cogs"></i> Semester 1 </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <a href="javascript:;" class="btn btn-md green margin-bottom-10 btn_new_kd" data-semester="1" data-subj="">
                                                            <i class="fa fa-plus"></i> Add
                                                        </a>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover table_material">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="1%"> #No </th>
                                                                        <th> Materi Pengetahuan </th>
                                                                        <th width="10%"> Code </th>
                                                                        <th> Penyesuaian Materi </th>
                                                                        <th width="1%"> KKM Weight </th>
                                                                        <th> Action </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="semester1">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="portlet box blue-chambray">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-cogs"></i> Semester 2 </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <a href="javascript:;" class="btn btn-md green margin-bottom-10 btn_new_kd" data-semester="2" data-subj="">
                                                            <i class="fa fa-plus"></i> Add
                                                        </a>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover table_material">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="1%"> #No </th>
                                                                        <th> Materi Pengetahuan </th>
                                                                        <th width="10%"> Code </th>
                                                                        <th> Penyesuaian Materi </th>
                                                                        <th width="1%"> KKM Weight </th>
                                                                        <th> Action </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="semester2">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="skills">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="portlet box blue-chambray">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-cogs"></i> Semester 1 </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <a href="javascript:;" class="btn btn-md green margin-bottom-10 btn_new_kd" data-semester="1" data-subj="">
                                                            <i class="fa fa-plus"></i> Add
                                                        </a>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="1%"> #No </th>
                                                                        <th> Materi Pengetahuan </th>
                                                                        <th width="10%"> Code </th>
                                                                        <th> Penyesuaian Materi </th>
                                                                        <th width="1%"> KKM Weight </th>
                                                                        <th> Action </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="semester1">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="portlet box blue-chambray">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-cogs"></i> Semester 2 </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <a href="javascript:;" class="btn btn-md green margin-bottom-10 btn_new_kd" data-semester="2" data-subj="">
                                                            <i class="fa fa-plus"></i> Add
                                                        </a>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="1%"> #No </th>
                                                                        <th> Materi Pengetahuan </th>
                                                                        <th width="10%"> Code </th>
                                                                        <th> Penyesuaian Materi </th>
                                                                        <th width="1%"> KKM Weight </th>
                                                                        <th> Action </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="semester2">

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
        </div>
    </div>
</div>

<!-- MODAL SUBJECT'S KD -->
<div id="responsive" class="modal fade in new_kd" aria-hidden="true" style="margin-top: 100px;">
    <div class="modal-dialog modal-full" style="width: 25%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title new_kd_title" style="color: white"> </h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="col-sm-12">
                        <div class="form-group form_new_kd">
                            <div class="form-group">
                                <div class="row">
                                    <label class="control-label col-md-3">Materi Pengetahuan</label>
                                    <div class="col-md-9">
                                        <input id="material" name="material" class="form-control form-kd"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="control-label col-md-3">Code</label>
                                    <div class="col-md-9">
                                        <input id="code" name="code" class="form-control form-kd"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="control-label col-md-3">Penyesuaian Materi</label>
                                    <div class="col-md-9">
                                        <input id="adjust" name="adjust" class="form-control form-kd"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="javascript:;" class="btn btn-md green-meadow margin-bottom-10 save_kd" style="float: right">
                            Confirm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid grade">
    <div class="page-content">
        <div class="row">
            <div class="col-sm-2" style="padding-left: 0px">
                <div class="portlet light bordered text-center" style="padding: 1px 10px 10px 10px;">
                    <h4 class="form-section text-center" style="margin-bottom: 12px;">Grades Option</h4>
                    <button type="button" class="btn btn-sm blue-madison text-center btn_kd" style="height: 20; min-width: 120px;" data-room="' . $room . '" data-toggle="modal" href="new-sch">
                        <icon class="fa fa-plus" />&nbsp; <span class="font-weight-light" style="font-family: 'open sans', sans-serif; font-weight: 500"> Material (KD) </span>
                    </button>
                    <button type="button" class="btn btn-sm green-jungle text-center grade_opt" style="height: 20; min-width: 120px;" data-room="' . $room . '" data-toggle="modal" href="new-sch">
                        <icon class="fa fa-plus" />&nbsp; <span class="font-weight-light" style="font-family: 'open sans', sans-serif; font-weight: 500"> Grades </span>
                    </button>
                </div>
                <div class="portlet light bordered" style="padding: 1px 10px 10px 10px;">
                    <h4 class="form-section text-center" style="margin-bottom: 12px;">Display by</h4>
                    <div class="md-radio-inline text-center">
                        <div class="md-radio">
                            <input type="radio" id="by_class" name="display_by" class="md-radiobtn" checked value="cls">
                            <label for="by_class">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Class </label>
                        </div>
                        <div class="md-radio">
                            <input type="radio" id="by_subject" name="display_by" class="md-radiobtn" value="subject">
                            <label for="by_subject">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Subject </label>
                        </div>
                    </div>
                </div>
                <div class="nav_degrees">
                    <!-- AJAX ACTIVE DEGREES GO HERE-->
                </div>
            </div>

            <div class="col-sm-10" class="portletz">
                <div class="portlet light std_rep">
                    <!-- AJAX GRADE'S TABLE GOES HERE -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('_partials/_foot'); ?>