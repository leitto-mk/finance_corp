<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<!------------------------- MODAL ADD SCHEDULE ------------------------->
<div class="modal fade" id="new-sch" tabindex="-1" role="basic" aria-hidden="true" style="display: none; padding-right: 17px; margin-top: 75px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color: white">Add New Schedule</h4>
            </div>
            <div class="mdl-add change_type">
                <!-- AJAX NEW SCH CONTENT GOES HERE -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!------------------------- MODAL DETAILS SCHEDULE ------------------------->
<div class="modal fade detail-class" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 75%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color: white">Detail Class</h4>
            </div>
            <div class="detail-body">
                <!-- AJAX DETAIL ALL HERE -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!------------------------- MODAL EDIT SCHEDULE ------------------------->
<div class="modal fade modal-edit" tabindex="-1" aria-hidden="true" style="display: none; ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color: white"></h4>
            </div>
            <div class="modal-body" style="padding-top: 20px; padding-bottom: 20px;">
                <div class="row" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="col-sm-12 edit-body change_type">
                        <!-- RESULT AJAX EDIT SCHEDULE -->
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="submit" class="btn green bg-green sv_upd_sche" style="min-width: 85px;">Save</button>
                <button type="button" class="btn red bg-red" data-dismiss="modal" style="min-width: 85px;">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!------------------------- MODAL DELETE SCHEDULE ------------------------->
<div class="modal fade del-confirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none; padding-right: 17px; margin-top: 75px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color: white">Delete ID</h4>
            </div>

            <div class="modal-body" style="padding-top: 20px; padding-bottom: 20px;">
                <h3 class="text-center display-1">
                    Are You sure to Purge this class' schedule ?<br><br>
                    (this action cannot be undone)
                </h3>
            </div>

            <div class="modal-footer text-center">
                <button id="del_sche_btn" class="btn green bg-green" style="min-width: 85px;">Yes</button>
                <button type="button" class="btn danger" data-dismiss="modal" style="min-width: 85px;">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!------------------------- MODAL OPTIONS SCHEDULE ------------------------->
<div class="modal fade options" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin-top: 50px;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title opt_title" style="color: white">Options</h4>
            </div>
            <div class="detail-body">
                <div class="modal-body" style="padding-right: 0px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-md-line-input has-info" style="padding-top: 0px;margin-bottom: 10px">
                                <h2 for="form_control_1"> Select Degree </h2>
                                <select class="form-control hlevel" id="form_control_1" style="max-width: 350px;">
                                    <option value="SD"> Elementary School </option>
                                    <option value="SMP"> Junior School </option>
                                    <option value="SMA"> High School </option>
                                    <option value="SMK"> Vocational High School</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-11">
                            <div class="row" style="margin-left: 3px;">
                                <h3 class="form-section">Class</h3>
                                <div class="col-sm-12">
                                    <div class="col-sm-6" style="padding-left: 0px;">
                                        <span class="help-block"> School starts </span>
                                        <input class="form-control form-control-inline input-sm timepicker hstart" type="text">
                                    </div>
                                    <div class="col-sm-6" style="padding-left: 0px; padding-right: 0px;">
                                        <span class="help-block"> Number of Sessions </span>
                                        <input class="form-control form-control-inline input-sm numclass" type="number" value="14" placeholder="14 (Default)">
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 15px;">
                                    <span class="help-block"> Duration </span>
                                    <select class="form-control input-sm hinterval" placeholder="Interval" required>
                                        <option value="30"> 30 minutes </option>
                                        <option value="35"> 35 minutes </option>
                                        <option value="40"> 40 minutes </option>
                                        <option value="45"> 45 minutes </option>
                                        <option value="50"> 50 minutes </option>
                                        <option value="55"> 55 minutes </option>
                                        <option value="60"> 60 minutes </option>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <span class="help-block"> Additional Setting </span>
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-small bootstrap-switch-animate bootstrap-switch-off" style="width: 16%;" value="">
                                        <div class="bootstrap-switch-container" style="width: 93px; margin-left: 0px;">
                                            <input type="checkbox" class="make-switch" id="test" data-size="mini">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="additional">
                                <div class="row" style="margin-left: 3px;">
                                    <h3 class="form-section">Break</h3>
                                    <div class="col-md-6">
                                        <span class="help-block"> 1st Break started at: </span>
                                        <select class="form-control input-sm break1" placeholder="Interval" required>
                                            <option value="1"> After 1st Hour </option>
                                            <option value="2"> After 2nd Hour </option>
                                            <option value="3"> After 3rd Hour </option>
                                            <option value="4"> After 4th Hour </option>
                                            <option value="5"> After 5th Hour </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="help-block"> Duration </span>
                                        <select class="form-control input-sm break1interval" placeholder="Interval" required>
                                            <option value="10"> 10 minutes </option>
                                            <option value="15"> 15 minutes </option>
                                            <option value="20"> 20 minutes </option>
                                            <option value="25"> 25 minutes </option>
                                            <option value="30"> 30 minutes </option>
                                            <option value="35"> 35 minutes </option>
                                            <option value="40"> 40 minutes </option>
                                            <option value="45"> 45 minutes </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 10px;">
                                        <span class="help-block"> Care Group started at: </span>
                                        <select class="form-control input-sm caregroup" placeholder="Interval" required>
                                            <option value="after"> After First Break </option>
                                            <option value="before"> Before First Break </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 10px;">
                                        <span class="help-block"> Duration </span>
                                        <select class="form-control input-sm caregroupinterval" placeholder="Interval" required>
                                            <option value="10"> 10 minutes </option>
                                            <option value="15"> 15 minutes </option>
                                            <option value="20"> 20 minutes </option>
                                            <option value="25"> 25 minutes </option>
                                            <option value="30"> 30 minutes </option>
                                            <option value="35"> 35 minutes </option>
                                            <option value="40"> 40 minutes </option>
                                            <option value="45"> 45 minutes </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 10px;">
                                        <span class="help-block"> 2nd Break started at: </span>
                                        <select class="form-control input-sm break2" placeholder="Interval" required>
                                            <option value="6"> After 6th Hour </option>
                                            <option value="7"> After 7th Hour </option>
                                            <option value="8"> After 8th Hour </option>
                                            <option value="9"> After 9th Hour </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 10px;">
                                        <span class="help-block"> Duration </span>
                                        <select class="form-control input-sm break2interval" placeholder="Interval" required>
                                            <option value="10"> 10 minutes </option>
                                            <option value="15"> 15 minutes </option>
                                            <option value="20"> 20 minutes </option>
                                            <option value="25"> 25 minutes </option>
                                            <option value="30"> 30 minutes </option>
                                            <option value="35"> 35 minutes </option>
                                            <option value="40"> 40 minutes </option>
                                            <option value="45"> 45 minutes </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="margin-left: 3px;">
                                    <h3 class="form-section">Extra-Cullicular</h3>
                                    <div class="col-sm-6">
                                        <span class="help-block"> Duration </span>
                                        <select class="form-control input-sm exculinterval" placeholder="Interval" required>
                                            <option value="30"> 30 minutes </option>
                                            <option value="35"> 35 minutes </option>
                                            <option value="40"> 40 minutes </option>
                                            <option value="45"> 45 minutes </option>
                                            <option value="50"> 50 minutes </option>
                                            <option value="55"> 55 minutes </option>
                                            <option value="60"> 60 minutes </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 40px; margin-bottom: 10px;">
                            <div class="btn-group" style=" float: right; padding-right: 10px;">
                                <button type="button" class="btn blue-madison btn-md sv_hcon" style="min-width: 80px;">Save</button>
                            </div>
                            <div class="btn-group" style="float: right; padding-right: 10px;">
                                <button type="button" class="btn red btn-md reset_curhour" data-degree="" style="min-width: 80px;">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!------------------------- MODAL HOURS SCHEDULE ------------------------->
<div class="modal fade edit_hour" tabindex="1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin-top: 150px;width: 25%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title hour_title" style="color: white">Options</h4>
            </div>
            <div class="detail-body">
                <div class="modal-body" style="padding-right: 0px;">
                    <div class="row">
                        <div class="col-sm-12" class="text-center">
                            <div class="form-group form-md-line-input has-info" style="padding-top: 0px;">
                                <h2 class="curhour_desc" data-cur-hour="" data-room="" for="form_control_1" style="margin-bottom: 15px;"> Change Duration: </h2>
                                <div class="col-sm-6" style="margin-top: 5px; padding-left: 0px; padding-right: 0px; width: 40%;">
                                    <div class="form-group" style="padding-right: 0px;">
                                        <select class="form-control edited type" id="form_control_1">
                                            <option value="" selected>-- Hour --</option>
                                            <option value="inc">Increase</option>
                                            <option value="dec">Decrease</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="margin-top: 5px; padding-right: 0px;">
                                    <div class="form-group" style="padding-right: 0px; width: 110%">
                                        <select class="form-control edited interval" id="form_control_1">
                                            <option value="" selected>by...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-12">
                            <div class="form-group form-md-radios">
                                <label style="font-size: 16px;">Applied to</label>
                                <div class="md-radio-list" style="margin-top: 10px;">
                                    <div class="md-radio">
                                        <input type="radio" id="radio9" name="radio1" class="md-radiobtn" value="one">
                                        <label for="radio9">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            Only to this Class
                                        </label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio" id="radio10" name="radio1" class="md-radiobtn" value="many">
                                        <label for="radio10">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            Entire Classes
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center" style="margin-top: 25px; margin-bottom: 10px;">
                            <div class="btn-group" style="padding-right: 10px;">
                                <button type="button" class="btn blue-madison btn-md sv_curhour" data-degree="" style="min-width: 80px;">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!------------------------- MODAL SESSIONS SCHEDULE ------------------------->
<div class="modal fade edit_sessions" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin-top: 35px;width: 75%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f373e">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title hour_title" style="color: white">Sessions</h4>
            </div>
            <div class="detail-body">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12" class="text-center">
                            <div class="form-group">
                                <form action="#" class="mt-repeater form-horizontal">
                                    <h3 class="mt-repeater-title">Add Sessions</h3>
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item="" class="mt-repeater-item">
                                            <!-- jQuery Repeater Container -->
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Session Type</label>
                                                <br>
                                                <select name="sess_type" class="form-control">
                                                    <option value="" selected>-- Session Type --</option>
                                                    <option value="reg_subj">Regular Subjects</option>
                                                    <option value="elective_subj">Elective Subjects</option>
                                                    <option value="excul">Extra-Cullicular</option>
                                                    <option value="non_subj">Non-Subjects</option>
                                                </select>
                                            </div>
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Session Code</label>
                                                <br>
                                                <input type="text" name="group-a[0][text-input]" class="form-control sess_code" placeholder="Code"></div>
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Session Name</label>
                                                <br>
                                                <input class="input-group form-control form-control-inline sess_name" size="25" type="text" name="group-a[0][date-input]" placeholder="Name"></div>
                                            <div class="mt-repeater-input">
                                                <a href="javascript:;" class="btn btn-success mt-repeater-delete new_sess">
                                                    <i class="fa fa-plus"></i> Add Session </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="portlet box grey-mint">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-plus"></i> Regular </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> CODE </th>
                                                        <th> Regular Subjects </th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tr_session_reg">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet box grey-mint">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-plus"></i> Elective </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> CODE </th>
                                                        <th> Elective Subjects </th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tr_session_elc">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet box grey-mint">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-plus"></i> Extra-Culllicular </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> CODE </th>
                                                        <th> Extra-Cullicular Subjects </th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tr_session_exc">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet box grey-mint">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-plus"></i> Non-Subject </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> CODE </th>
                                                        <th> Session </th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tr_session_non">

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

<!------------------------- MODAL NON-REGULAR ASSIGNMENT ------------------------->
<div class="modal fade in full" id="modal_assign" tabindex="-1" role="dialog" aria-hidden="true" style="display: hidden;">
    <div class="modal-dialog" style="width: 900px">
        <div class="modal-content">
            <div class="modal-header">
                <h4> Assign Non-Regular Subject </h4>
            </div>
            <div class="modal-body">
                <form id="assign_nonregular" role="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Room</label>
                            <div class="col-md-8">
                                <input type="text" id="assign_room" name="assign_room" class="form-control" required readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Type</label>
                            <div class="col-md-8">
                                <input type="text" id="assign_type" name="assign_type" class="form-control" required readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Day</label>
                            <div class="col-md-8">
                                <input type="text" id="assign_day" name="assign_day" class="form-control" required readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Hour</label>
                            <div class="col-md-8">
                                <input type="text" id="assign_hour" name="assign_hour" class="form-control" required readonly>
                            </div>
                        </div>
                        <div class="form-group mt-repeater">
                            <div data-repeater-list="group-c">
                                <div data-repeater-item class="mt-repeater-item">
                                    <div class="row mt-repeater-row">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-8">
                                            <div class="col-md-5" style="padding-right: 0px">
                                                <label class="control-label">Subject</label>
                                                <select type="text" id="assign_subject" name="assign_subject" class="form-control subject_repeater" required> 
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="col-md-5" style="padding-right: 0px">
                                                <label class="control-label">Teacher</label>
                                                <select type="text" id="assign_teacher" name="assign_teacher" class="form-control teacher_repeater" required> 
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add" style="float: right">
                                    <i class="fa fa-plus"></i> New </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-8">
                                <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn blue" form="assign_nonregular">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!------------------------- SCHEDULE CONTENT ------------------------->
<div class="container-fluid schedule">
    <div class="page-content" style="padding-left: 10px;">

        <!-- MAIN CONTENT STARTS HERE -->

        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-2 classes" style="padding: 0px;">
                        <div class="col-sm-12" style="margin-bottom: 5px; margin-top: 0px;padding-right: 5px">
                            <div class="portlet light bordered" style="padding: 1px 10px 10px 10px;">
                                <h4 class="form-section text-center" style="margin-bottom: 12px;">Schedule Options</h4>
                                <button type="button" class="btn btn-sm green-jungle text-center hour_opt" style="height: 20; min-width: 80px;" data-room="' . $room . '" data-toggle="modal" href="new-sch">
                                    <icon class="fa fa-plus" />&nbsp; <span class="font-weight-light" style="font-family: 'open sans', sans-serif; font-weight: 500"> Hour </span>
                                </button>
                                <button type="button" class="btn btn-sm yellow-gold text-center sess_opt" style="height: 20; min-width: 80px;" data-room="' . $room . '" data-toggle="modal" href="new-sch">
                                    <icon class="fa fa-plus" />&nbsp; <span class="font-weight-light" style="font-family: 'open sans', sans-serif; font-weight: 500"> Sessions </span>
                                </button>
                            </div>
                        </div>
                        <!-- <div class="col-sm-12 form-group form-md-radios has-info">
                            <label> Select Schedule by: </label>
                            <div class="md-radio-inline">
                                <div class="md-radio">
                                    <input type="radio" id="by_class" name="slct_sch_radio" class="md-radiobtn">
                                    <label for="by_class">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> Class </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="by_std" name="slct_sch_radio" class="md-radiobtn" checked="">
                                    <label for="by_std">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> Student </label>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-sm-12 nav_degrees" style="padding-right: 5px">
                            <!-- AJAX GOES HERE -->
                        </div>
                    </div>

                    <div class="col-sm-10">
                        <div class="row">
                            <div class="portlet light std_rep" style="margin-bottom: 0px;padding-top: 0px; padding-left: 5px;">
                                <!-- AJAX GRADE'S TABLE GOES HERE -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT ENDS HERE -->

        <?php $this->load->view('_partials/_foot'); ?>