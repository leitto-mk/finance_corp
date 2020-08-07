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
            <?= $this->session->flashdata('errormsg'); ?>
            <?= $this->session->flashdata('regismsg'); ?>
            <?= $this->session->flashdata('disp_err'); ?>
            <?= $this->session->flashdata('delmsg'); ?>
            
            <!-- <div class="table-scrollable" style="margin-top: 0px">
                <table class="table table-advance table-hover">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> ID </th>
                            <th> Name </th>
                            <th> Nickname </th>
                            <th> Gender </th>
                            <th> Date of Birth </th>
                            <th> Status</th>
                            <th> Class </th>
                            <th> Room </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <?php if (empty($std_t)) : ?>
                        <td class="text-center" colspan="8">
                            <p class="font font-weight-bold"> NO RECORD </p>
                        </td>
                    <?php else : ?>
                        <?php $i = 1; ?>
                        <tbody class="emp_t_body">
                            <?php foreach ($std_t as $row) : ?>
                                <tr data-id="<?= $row->IDNumber ?>">
                                    <td class="hiddex-xs"><?= $i; ?></td>
                                    <td class="hiddex-xs">
                                        <a href="<?= base_url('Admin/load_prof_std/') . $row->IDNumber; ?>">
                                            <?= $row->IDNumber; ?>
                                        </a>
                                    </td>
                                    <td class="hiddex-xs"><?= ucfirst($row->Fullname); ?></td>
                                    <td class="hiddex-xs"><?= ucfirst($row->NickName); ?></td>
                                    <td class="hiddex-xs"><?= $row->Gender; ?></td>
                                    <td class="hiddex-xs"><?= $row->DateofBirth; ?></td>
                                    <td class="hiddex-xs"><?= ucfirst($row->status); ?></td>
                                    <td class="hiddex-xs"><?= $row->Kelas; ?></td>
                                    <td class="hiddex-xs"><?= $row->Ruangan; ?></td>
                                    <td>
                                        <a class="btn font-white bg-blue text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href="<?= base_url('Admin/load_prof_std/') . $row->IDNumber; ?>">
                                            Profile
                                        </a>
                                        <a class="btn btn-primary text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href="<?= base_url('Admin/load_prof_std_update/') . $row->IDNumber; ?>">
                                            Edit
                                        </a>
                                        <a class="btn btn-danger text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href="<?= base_url('Admin/delete/') . $row->IDNumber; ?>">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                    <tbody>
                                
                    </tbody>
                </table>
            </div> -->

            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Students</span>
                    </div>
                    <div class="actions">
                        <div class="border-green-meadow">
                            <div class="col-md-6">
                                <select class="form-control classes" id="form_control_1" placeholder="Search by...">
                                    <option value="all"> Select Room </option>
                                    <?php foreach($active_room as $rooms) : ?>
                                        <option value="<?= $rooms->RoomDesc ?>"> <?= $rooms->RoomDesc?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <a href="<?= base_url('Admin/load_prof_std_add') ?>" class="btn green-meadow btn-md">
                                    <i class="fa fa-user-plus"></i> &nbsp;&nbsp;ADD STUDENT
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="std_table" class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_5">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> ID </th>
                                <th> Name </th>
                                <th> Nickname </th>
                                <th> Gender </th>
                                <th> Date of Birth </th>
                                <th> Status</th>
                                <th> Class </th>
                                <th> Room </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('_partials/_foot'); ?>