<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<div class="modal fade new-absn" tabindex="-1" role="basic" aria-hidden="true" style="display: none; padding-right: 17px; margin-top: 75px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" style="">Add Absent</h4>
            </div>
            <form role="form" action="<?= base_url('Admin/save_add_sch/'); ?>" method="post">
                <div class="row">
                    <div class="col-sm-12 new-absn-body" style="margin-top: 15px; padding: 0px 30px;">

                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- MODAL ADD ABSENT -->
<div id="responsive" class="modal fade in sv_absent_modal" tabindex="-1" aria-hidden="true" style="margin-top: 50px;">
    <div class="modal-dialog" style="width: 35%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title opt_title" style="color: white"> ABSENCE SUBMIT</h4>
            </div>
            <div class="detail-body">





                <div class="modal-body" style="padding-right: 0px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-md-line-input has-info" style="padding-top: 0px;margin-bottom: 10px">
                                <h4 for="form_control_1"> Absent Type </h4>
                                <div class="md-radio-inline">
                                    <?php $i = 1; ?>
                                    <?php foreach ($type as $row) : ?>
                                        <div class="md-radio" style="margin-top: 10px;">
                                            <input type="radio" id="<?= 'cb_' . $i ?>" name="radio2" class="md-radiobtn" value="<?= $row->Type ?>">
                                            <label for="<?= 'cb_' . $i ?>" style="color: #333">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span> <?= $row->Type ?> </label>
                                        </div>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="width: 40%">
                        <h4 for="form_control_1" style="margin-top: 15px;"> Absent Date </h4>
                        <div class="input-group bootstrap-timepicker timepicker">
                            <input id="pick_absent_date" type="text" class="form-control input-small">
                        </div>
                    </div>
                    <div id="absent_misc" hidden>
                        <div class="form-group" style="width: 40%">
                            <h4 for="form_control_1" style="margin-top: 15px;"> Subject Name </h4>
                            <select class="form-control edited" id="abs_subj">
                            </select>
                        </div>
                        <div class="form-group" style="width: 40%">
                            <h4 for="form_control_1" style="margin-top: 15px;"> Time </h4>
                            <div class="input-group">
                                <input type="text" id="abs_time" class="form-control timepicker timepicker-24">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-clock-o"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-11">
                            <table class="table table-light" style="margin-top: 15px;">
                                <thead>
                                    <th class="sbold" colspan="2">
                                        <h4 for="form_control_1"> On List </h4>
                                    </th>
                                </thead>
                                <tbody class="absn_list_for_submit">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 40px; margin-bottom: 10px;">
                            <div class="btn-group" style="left: 40%;padding-right: 10px;">
                                <button type="button" class="btn blue-madison btn-md submit_absent" style="min-width: 80px;">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="container-fluid absent">
    <div class="page-content">

        <div class="row">

            <div class="col-sm-4">

                <div class="portlet-body">
                    <div id="search-absn" class="dataTables_wrapper no-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <select name="search" class="form-control" id="form_control_1" style="padding: 0px 5px;">
                                    <option>Search by :</option>
                                    <option value="Class">Class</option>
                                    <option value="Personal">Student ID/Name</option>
                                    <option value="Teacher">Teacher/Staff</option>
                                </select>
                            </div>
                            <div class="col-md-6 search-sel" style="padding-left: 0px;">

                            </div>
                        </div>
                        <div class="tbl_absn">
                            <div class="table-scrollable scrl" style="border-color: #FFF">
                                <table class="table table-light tbl_list">
                                    <thead>
                                        <tr role="row">
                                            <th tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 20px;"> # </th>
                                            <th tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 90px;"> IDNumber </th>
                                            <th tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 90px;"> Username </th>
                                        </tr>
                                    </thead>
                                    <tbody class="search-result">
                                        <!-- AJAX RESPONSE HERE -->
                                        <tr class="gradeX odd" role="row">
                                            <td colspan="2"> NO STUDENTS/TEACHERS/STAFFS SELECTED </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-8">
                <div class="portlet light bg-inverse">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-share font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase port-title">&nbsp;ATTENDANCE DETAILS </span>
                            <!-- <span class="caption-helper">monthly stats...</span> -->
                        </div>
                    </div>
                    <div class="portlet-body portlet_subcls">
                        <div class="table-responsive">
                            <table class="table tbl_portlet_cls">
                                <thead>
                                    <tr>
                                        <th> No. </th>
                                        <th> ID </th>
                                        <th> Nama </th>
                                        <th> Absent </th>
                                        <th> Total Absent </th>
                                        <th> Keterangan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td colspan="6"> NO DATA SELECTED </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php $this->load->view('_partials/_foot'); ?>