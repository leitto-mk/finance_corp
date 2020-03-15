<?php $this->load->view('student/navbar/navbar'); ?>

<div class="container-fluid student_schedule">
    <div class="page-content">
        <div class="row">
            <div class="portlet light portlet-fit" style="margin-bottom: 0px;padding-left: 0px;">
                <div class="portlet-title" style="padding-left: 40px;padding-top: 0px;border-bottom: 0px;margin-bottom: 0px;">
                    <div class="caption">
                        <i class="fa fa-calendar font-red font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">&nbsp;<?= $fullname ?>'s SCHEDULE (<?= $cls ?>)</span>
                    </div>
                </div>
                <div class="portlet-body" style="padding-top: 0px;padding-bottom: 0px;">
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr class="uppercase text-justify">
                                    <th class="text-center"> Hour </th>
                                    <th class="text-center"> Monday </th>
                                    <th class="text-center"> Tuesday </th>
                                    <th class="text-center"> Wednesday </th>
                                    <th class="text-center"> Thursday </th>
                                    <th class="text-center"> Friday </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tbl_sche as $row) : ?>
                                    <?php if ($row->Start != NULL || $row->Finish != NULL) : ?>
                                        <tr>
                                            <td style="border-bottom: 0px;" class="text-center sbold">
                                                <?= "$row->Start - $row->Finish" ?>
                                            </td>
                                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center sbold"><?= $row->Mon ?></td>
                                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center sbold"><?= $row->Tue ?></td>
                                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center sbold"><?= $row->Wed ?></td>
                                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center sbold"><?= $row->Thu ?></td>
                                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center sbold"><?= $row->Fri ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('_partials/_foot'); ?>