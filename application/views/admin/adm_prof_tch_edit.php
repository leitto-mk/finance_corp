<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<div id="modaledit" class="modal fade in" tabindex="-1" aria-hidden="true" style="display: none; margin-top: 30px;">
    <div class="modal-dialog" style="width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit ID</h4>
            </div>
            <div class="modal-body">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 875px;">
                    <div class="scroller" style="height: 1000px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                        <div class="row">

                        </div>
                    </div>
                    <div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 300px;"></div>
                    <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn green">Save changes</button>
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid profiles">
    <div class="page-content">
        <!-- BEGIN PAGE BASE CONTENT -->

        <div class="row">
            <?= $this->session->flashdata('addmsg'); ?>
            <?= $this->session->flashdata('delmsg'); ?>
            <?= $this->session->flashdata('updmsg'); ?>
            <?= $this->session->flashdata('disp_err'); ?>

            <!-- BEGIN PROFILE DATA GURU-->
            <div class="row">
                <div class="col-md-3" style="padding-right: 0px">
                    <div class="m-heading-1 border-green-meadow">
                        <a href="<?= base_url('Admin/load_prof_tch_add') ?>" class="btn green-meadow btn-md">
                            <i class="fa fa-user-plus"></i> &nbsp;&nbsp;ADD TEACHER / STAFF
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-md-line-input has-success" style="margin-bottom: 0px; padding-top: 0px">
                        <div class="input-icon">
                            <input type="text" class="form-control search_person" data-emp="nonstd" placeholder="Search name...">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">search teachers / staff by Name</span>
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-scrollable">
                <table class="table table-advance table-hover">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> ID </th>
                            <th> Fullname </th>
                            <th> Gender </th>
                            <th> Date of Birth</th>
                            <th> Occupation </th>
                            <th> Job Description </th>
                            <th> Honorer </th>
                            <th> Employee Type </th>
                            <th> Homeroom </th>
                            <th> Teaches </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <?php if (empty($tch_t)) : ?>
                        <td class="text-center" colspan="11">
                            <p class="font font-weight-bold"> NO RECORD </p>
                        </td>
                    <?php else : ?>
                        <tbody class="emp_t_body">
                            <?php $i = 1; ?>
                            <?php foreach ($tch_t as $row) : ?>
                                <tr>
                                    <td class="hiddex-xs"><?= $i; ?></td>
                                    <td class="hiddex-xs">
                                        <a href="<?= base_url('Admin/load_prof_tch/') . $row->IDNumber; ?>">
                                            <?= $row->IDNumber; ?>
                                        </a>
                                    </td>
                                    <td class="hiddex-xs"><?= ucfirst($row->Fullname); ?></td>
                                    <td class="hiddex-xs"><?= $row->Gender; ?></td>
                                    <td class="hiddex-xs"><?= $row->DateofBirth; ?></td>
                                    <td class="hiddex-xs"><?= ucfirst($row->Occupation); ?></td>
                                    <td class="hiddex-xs"><?= $row->JobDesc; ?></td>
                                    <td class="hiddex-xs"><?= $row->Honorer; ?></td>
                                    <td class="hiddex-xs"><?= $row->Emp_Type; ?></td>
                                    <td class="hiddex-xs"><?= $row->Homeroom; ?></td>
                                    <td class="hiddex-xs"><?= $row->SubjectTeach; ?></td>
                                    <td>
                                        <a class="btn font-white bg-blue text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href="<?= base_url('Admin/load_prof_tch/') . $row->IDNumber; ?>">
                                            &nbsp;&nbsp;Profile&nbsp;&nbsp;
                                        </a>
                                        <a class="btn btn-primary text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href="<?= base_url('Admin/load_prof_tch_update/') . $row->IDNumber; ?>">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;
                                        </a>
                                        <a class="btn btn-danger text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href="<?= base_url('Admin/delete/') . $row->IDNumber; ?>">
                                            &nbsp;Delete&nbsp;
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div>
            <!-- END PROFILE DATA GURU-->


        </div>

        <!-- END PAGE BASE CONTENT -->

    </div>

    <?php $this->load->view('_partials/_foot'); ?>