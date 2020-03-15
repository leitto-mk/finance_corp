<?php $this->load->view('admin/navbar/adm_navbar'); ?>


<!------------------------- MODAL CATEGORY OPTION ------------------------->
<div class="modal fade cat_opt" tabindex="1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin-top: 80px;width: 30%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title cat_title" style="color: white">Options</h4>
            </div>
            <div class="detail-body">





                <div class="modal-body" style="padding-right: 0px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-md-line-input has-info" style="padding-top: 0px;">
                                <h2 class="cat_desc" data-cur-hour="" data-room="" for="form_control_1" style="margin-bottom: 15px;"></h2>
                                <div class="col-sm-6" style="margin-top: 5px; padding-left: 0px; padding-right: 0px; width: 40%;">
                                    <div class="form-group" style="padding-right: 0px;">
                                        <select name="cat_degree" class="form-control form-filter input-sm">
                                            <option value="">Degree</option>
                                            <?php foreach ($degrees as $row) : ?>
                                                <option value="<?= $row->School_Desc ?>"> <?= $row->School_Desc ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group" style="margin-left:0px">
                                <h4>Current Tuition</h4>
                                <div class="input-group tuition-input">
                                    <span class="input-group-addon input-circle-left">
                                        Rp.
                                    </span>
                                    <input type="text" name="cur_tuition" class="form-control input-circle-right" placeholder="Current Tuition">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center" style="margin-top: 25px; margin-bottom: 10px;">
                            <div class="btn-group" style="padding-right: 10px;">
                                <button type="button" class="btn blue-madison btn-md sv_cur_tuition" style="min-width: 80px;">Save</button>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>
</div>

<!------------------------- MODAL PAYMENT ------------------------->
<div class="modal fade payment" tabindex="1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin-top: 75px;width: 35%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title pay_title" style="color: white"> </h4>
            </div>
            <div class="detail-body">





                <div class="modal-body" style="padding-right: 0px;">
                    <div class="row">
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="#" class="form-horizontal">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> Payment Date </label>
                                        <div class="col-md-7">
                                            <p class="form-control-static"> <?= date('d/m/Y') ?> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> NIS </label>
                                        <div class="col-md-7">
                                            <p class="form-control-static"> 201900010 </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> FullName </label>
                                        <div class="col-md-7">
                                            <p class="form-control-static"> Firstname Lastname </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> Payment Type </label>
                                        <div class="col-md-7">
                                            <select name="cat_degree" class="form-control form-filter input-sm">
                                                <option value=""> Type </option>
                                                <option value=""> SPP </option>
                                                <option value=""> Others </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> Amount </label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    Rp.
                                                </span>
                                                <input type="number" class="form-control" placeholder="Amount"> </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> Note </label>
                                        <div class="col-md-7">
                                            <textarea id="payment_note" class="form-control" style="max-width: 100%; min-height: 50px;;" placeholder="Note"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center" style="margin-top: 25px; margin-bottom: 10px;">
                            <div class="btn-group" style="padding-right: 10px;">
                                <button type="button" class="btn blue-madison btn-md proceed_payment" style="min-width: 80px;"> Proceed </button>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>
</div>

<!------------------------- MODAL RECEIPT ------------------------->
<div class="modal fade receipt" tabindex="1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin-top: 35px;width: 75%;">
        <div class="modal-content">
            <div class="page-content-col" style="padding: 15px;">
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="invoice">
                    <div class="row invoice-logo">
                        <div class="col-xs-6 invoice-logo-space">
                            <img src="../assets/pages/media/email/logo.png" class="img-responsive" alt="" width="250"> </div>
                        <div class="col-xs-6">
                            <div class="company-address" style="float: right;">
                                <span class="bold uppercase">ABase.</span>
                                <br> Kairagi
                                <br> Manado - Sulawesi Utara, Indonesia
                                <br>
                                <span class="bold">T</span> 123 456 789
                                <br>
                                <span class="bold">E</span> support@abase.com
                                <br>
                                <span class="bold">W</span> www.abase.com </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-4">
                            <h3>Name:</h3>
                            <ul class="list-unstyled">
                                <li> Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="uppercase">FirstName LastName</span> </li>
                                <li> ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="uppercase"> 123456789 </span> </li>
                                <li> Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <span class="uppercase"> X (A) </span> </li>
                                <li> Category&nbsp; : <span class="uppercase"> A </span> </li>
                            </ul>
                        </div>
                        <div class="col-xs-4">
                            <h3>Recipient:</h3>
                            <ul class="list-unstyled">
                                <li> Name&nbsp;&nbsp;: <span class="uppercase"><?= $fname . ' ' . $lname ?></span> </li>
                                <li> ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="uppercase"><?= $this->session->userdata('id'); ?></span> </li>
                                <li> Status&nbsp;: <span class="uppercase"><?= $status ?></span> </li>
                            </ul>
                        </div>
                        <div class="col-xs-4 invoice-payment" style="padding-left: 100px;">
                            <h3>Payment Details:</h3>
                            <ul class="list-unstyled">
                                <li>
                                    <strong>Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong> SPP </li>
                                <li>
                                    <strong>Transaction No :</strong> 123456789 </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Date </th>
                                        <th class="hidden-xs"> Type </th>
                                        <th class="hidden-xs"> Amount </th>
                                        <th class="hidden-xs"> Balance </th>
                                        <th> Note </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 1 </td>
                                        <td> <?= date('d/m/Y [h:m:s]') ?> </td>
                                        <td class="hidden-xs"> SPP </td>
                                        <td class="hidden-xs"> Rp.500.000 </td>
                                        <td class="hidden-xs"> - Rp.3.500.000,00 </td>
                                        <td> - </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 invoice-block">
                            <ul class="list-unstyled amounts" style="float: right; padding-right: 50px;">
                                <li>
                                    <strong>Balance &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> - Rp.3.500.000,00
                                </li>
                                <li>
                                    <strong>Total Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> Rp.500.000,00
                                </li>
                                <li class="divider">------------------------------------------------</li>
                                <li>
                                    <strong>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> Rp.3.000.000,00 </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px;padding-left: 15px;">
                        <a class="btn btn-lg blue hidden-print margin-bottom-5 btn_print_receipt"> Print
                            <i class="fa fa-print"></i>
                        </a>
                        <a class="btn btn-lg green hidden-print margin-bottom-5"> Submit
                            <i class="fa fa-check"></i>
                        </a>
                    </div>
                </div>
                <!-- END PAGE BASE CONTENT -->
            </div>
        </div>
    </div>
</div>



<div class="container-fluid finance">
    <div class="page-content">

        <div class="row" style="margin-top: 0px;">
            <div class="col-md-2">
                <div class="row">
                    <a class="dashboard-stat dashboard-stat-v2 dark cat_bar" data-cat="A" href="#" style="background-color: #575B5B">
                        <div class="visual">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php if (!empty($tuition_a->Total)) : ?>
                                    <span class="enroll-total" data-counter="counterup" data-value="<?= $tuition_a->Total ?>"><?= $tuition_a->Total ?></span>
                                <?php else : ?>
                                    <span class="enroll-total" data-counter="counterup" data-value="0">0</span>
                                <?php endif; ?>
                            </div>
                            <br>
                            <div class="desc"> Category A </div>
                        </div>
                    </a>
                </div>
                <div class="row">
                    <a class="dashboard-stat dashboard-stat-v2 dark cat_bar" data-cat="B" href="#" style="background-color: #63bf71">
                        <div class="visual">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php if (!empty($tuition_b->Total)) : ?>
                                    <span class="enroll-total" data-counter="counterup" data-value="<?= $tuition_b->Total ?>"><?= $tuition_b->Total ?></span>
                                <?php else : ?>
                                    <span class="enroll-total" data-counter="counterup" data-value="0">0</span>
                                <?php endif; ?>
                            </div>
                            <br>
                            <div class="desc"> Category B </div>
                        </div>
                    </a>
                </div>
                <div class="row">
                    <a class="dashboard-stat dashboard-stat-v2 dark cat_bar" data-cat="C" href="#" style="background-color: #56d1cd">
                        <div class="visual">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php if (!empty($tuition_c->Total)) : ?>
                                    <span class="enroll-total" data-counter="counterup" data-value="<?= $tuition_c->Total ?>"><?= $tuition_c->Total ?></span>
                                <?php else : ?>
                                    <span class="enroll-total" data-counter="counterup" data-value="0">0</span>
                                <?php endif; ?>
                            </div>
                            <br>
                            <div class="desc"> Category C </div>
                        </div>
                    </a>
                </div>
                <div class="row">
                    <a class="dashboard-stat dashboard-stat-v2 dark cat_bar" data-cat="D" href="#" style="background-color: #6176ed">
                        <div class="visual">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php if (!empty($tuition_d->Total)) : ?>
                                    <span class="enroll-total" data-counter="counterup" data-value="<?= $tuition_d->Total ?>"><?= $tuition_d->Total ?></span>
                                <?php else : ?>
                                    <span class="enroll-total" data-counter="counterup" data-value="0">0</span>
                                <?php endif; ?>
                            </div>
                            <br>
                            <div class="desc"> Category D </div>
                        </div>
                    </a>
                </div>
                <div class="row">
                    <a class="dashboard-stat dashboard-stat-v2 dark cat_bar" data-cat="E" href="#" style="background-color: #d49f68">
                        <div class="visual">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php if (!empty($tuition_e->Total)) : ?>
                                    <span class="enroll-total" data-counter="counterup" data-value="<?= $tuition_e->Total ?>"><?= $tuition_e->Total ?></span>
                                <?php else : ?>
                                    <span class="enroll-total" data-counter="counterup" data-value="0">0</span>
                                <?php endif; ?>
                            </div>
                            <br>
                            <div class="desc"> Category E </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-5">
                <!-- <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-12">
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                    </div>
                </div> -->
                <div class="row" style="margin-top: 0px;">
                    <div class="portlet box" style="margin-top: 0px; margin-left: 15px; margin-right: 0px; background-color: #575B5B">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-users"></i> Student's Table </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                            </div>
                        </div>
                        <div class="portlet-body flip-scroll portlet-enroll" style="display: block;padding-top: 0px; padding-left: 0px;padding-right: 0px;">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-checkable no-footer" id="datatable_orders" aria-describedby="datatable_orders_info" role="grid">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <!-- <th width="2%" class="sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes">
                                                    <span></span>
                                                </label>
                                            </th> -->
                                            <th width="2%" class="sorting_asc" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Order&amp;nbsp;# : activate to sort column descending"> NIS </th>
                                            <th width="5%" class="sorting" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Purchased&amp;nbsp;On : activate to sort column ascending"> FullName </th>
                                            <th width="2%" class="sorting" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Base&amp;nbsp;Price : activate to sort column ascending"> Degree </th>
                                            <th width="2%" class="sorting" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Customer : activate to sort column ascending"> Class </th>
                                            <th width="2%" class="sorting" tabindex="0" aria-controls="datatable_orders" rowspan="1" colspan="1" aria-label=" Ship&amp;nbsp;To : activate to sort column ascending"> Room </th>
                                        </tr>
                                        <tr role="row" class="filter">
                                            <!-- <td rowspan="1" colspan="1"> </td> -->
                                            <td rowspan="1" colspan="1" style="padding: 8px 3px;">
                                                <input type="number" class="form-control form-filter input-sm" name="id"> </td>
                                            <td rowspan="1" colspan="1">
                                                <input type="text" class="form-control form-filter input-sm" name="fullname"> </td>
                                            <td rowspan="1" colspan="1">
                                                <select name="degree" class="form-control form-filter input-sm">
                                                    <option value="">Degree</option>
                                                    <?php foreach ($degrees as $row) : ?>
                                                        <option value="<?= $row->School_Desc ?>"> <?= $row->School_Desc ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td rowspan="1" colspan="1">
                                                <select name="classes" class="form-control form-filter input-sm">
                                                    <option value=""> Class </option>
                                                </select>
                                            </td>
                                            <td rowspan="1" colspan="1">
                                                <select name="rooms" class="form-control form-filter input-sm">
                                                    <option value=""> Room </option>
                                                </select>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody class="fnc_data">
                                        <tr role="row" class="">
                                            <!-- <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="1"><span></span></label></td> -->
                                            <td colspan="5"> STUDENT'S TABLE: USE THE SEARCH FUNCTION </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="fa fa-bar-chart"></i>
                            <span class="caption-subject bold uppercase"> Financial Summary of: FULLNAME </span>
                        </div>
                        <div class="actions">
                            <button type="button" class="btn green-jungle btn-outline sbold uppercase btn_payment">+ Payment</button>
                            <div class="btn-group btn-group-devided" data-toggle="buttons" style="margin-left: 10px;">
                                <select class="form-control" id="form_control_1" style="height: 30px;">
                                    <option value=""> Semester / Tahun Ajaran </option>
                                    <option value="1"> Option 1 </option>
                                    <option value="2"> Option 2 </option>
                                    <option value="3"> Option 3 </option>
                                    <option value="4"> Option 4 </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="profile-userpic" style="margin: auto;">
                                    <img src="<?= base_url('/assets/photos/default.png'); ?>" class="img-responsive thumbnail img-circle" style="max-width: 80%;">
                                </div>
                            </div>
                            <div class="col-sm-8" style="padding-left: 0px;">
                                <h5 class="profile-desc-title bold"> SPP Details </h5>
                                <div class="row static-info">
                                    <div class="col-md-4 name"> <span style="float:right">NIS</span> </div>
                                    <div class="col-md-7 value">: 123456
                                        <!-- <span class="label label-success label-sm"> Active </span> -->
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name right"> <span style="float:right">Name</span></div>
                                    <div class="col-md-7 value">: FullName </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name"> <span style="float:right">Kelas</span> </div>
                                    <div class="col-md-7 value">: X (A) </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name"> <span style="float:right">Semester</span> </div>
                                    <div class="col-md-7 value">: 1 </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name"> <span style="float:right">School Year</span> </div>
                                    <div class="col-md-7 value">: 2019/2020 </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name"> <span style="float:right">Category</span> </div>
                                    <div class="col-md-7 value">: A </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name">
                                        <h5 class="sbold">Monthly Due</h3>
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name" style="padding-left: 45px"> <span style="float:right">July</span> </div>
                                    <div class="col-md-7 value">: Rp. 350,000
                                        <span class="label label-success label-sm"> PAID </span>
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name" style="padding-left: 45px"> <span style="float:right">August</span> </div>
                                    <div class="col-md-7 value">: Rp. 350,000
                                        <span class="label label-success label-sm"> PAID </span>
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name" style="padding-left: 45px"> <span style="float:right">September</span> </div>
                                    <div class="col-md-7 value">: Rp. 350,000
                                        <span class="label label-success label-sm"> PAID </span>
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name" style="padding-left: 45px"> <span style="float:right">October</span> </div>
                                    <div class="col-md-7 value">: Rp. 350,000
                                        <span class="label label-success label-sm"> PAID </span>
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name" style="padding-left: 45px"> <span style="float:right">November</span> </div>
                                    <div class="col-md-7 value">: Rp. 350,000
                                        <span class="label label-danger label-sm"> UNPAID </span>
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-4 name" style="padding-left: 45px"> <span style="float:right">December</span> </div>
                                    <div class="col-md-7 value">: Rp. 350,000
                                        <span class="label label-danger label-sm"> UNPAID </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-md-12">
                                <h5 class="profile-desc-title bold"> Class </h5>
                                <div class="row static-info" style="margin-top: 10px;">
                                    <div class="col-md-4 name" style="padding-left: 50px;"> <span style="float:right">Book A</span> </div>
                                    <div class="col-md-7 value">: Rp. 50,000
                                        <span class="label label-success label-sm"> PAID </span>
                                    </div>
                                </div>
                                <div class="row static-info" style="margin-top: 10px;">
                                    <div class="col-md-4 name" style="padding-left: 50px;"> <span style="float:right">Book B</span> </div>
                                    <div class="col-md-7 value">: Rp. 125,000
                                        <span class="label label-success label-sm"> PAID </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h5 class="profile-desc-title bold"> Non-SPP </h5>
                                <div class="row static-info" style="margin-top: 10px;">
                                    <div class="col-md-4 name" style="padding-left: 50px;"> <span style="float:right">Construction</span> </div>
                                    <div class="col-md-7 value">: Rp. 500,000
                                        <span class="label label-success label-sm"> PAID </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php $this->load->view('_partials/_foot'); ?>