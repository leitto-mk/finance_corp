<?php $this->load->view('header_footer/finance_corp/header'); ?>
<div class="page-wrapper bg-white">
    <div class="page-wrapper-row">
        <div class="page-wrapper-top">
            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu" style="background:#444d58;">
                <div class="container-fluid">
                    <div class="hor-menu">
                        <ul class="nav navbar-nav">
                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active uppercase" style="margin-left: -30px">
                                <h4 style="color:#ffffff">Cash Advance Withdraw</h4>
                            </li>
                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>
    </div>
    <div class="portlet light" style="margin-top: -19px">
        <form method="post" class="form-horizontal" id="form_ca_withdraw" autocomplete="off">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject bold uppercase font-dark" style="margin-left: -10px"><i class="fa fa-edit"></i> Master Transaction </span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    <a class="btn yellow-crusta btn-sm" id="new_transaction" style="visibility: hidden">
                                        <i class="fa fa-plus"></i> New
                                    </a>
                                    <a class="btn blue-madison btn-sm" id="print_transaction" id="print_transaction" style="visibility: hidden">
                                        <i class="fa fa-print"></i> Print
                                    </a>
                                    <button class="btn btn-transparent green btn-sm" id="btn_submit" type="submit" style="visibility: visible">
                                        <i class="fa fa-check"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9 col-xs-12 col-sm-12" style="background-color: #E9EDEF; margin-top: -10px">
                                <div class="portlet-body form-horizontal">
                                    <div class="form-body" style="margin-top: 10px">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><b>Document No.</b></label>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        #
                                                        <!-- <i class="fa fa-envelope"></i> -->
                                                    </span>
                                                    <input type="text" name="docno" class="form-control" readonly value="<?= $docno ?>" style="background-color:white;">
                                                </div>
                                            </div>
                                            <!-- Row 2 -->
                                            <label class="col-md-2 control-label"><b>Account No.</b></label>
                                            <div class="col-md-3" data-toggle="modal" data-target="#modal_caccount">
                                                <select name="accno" id="accno" class="form-control" required>
                                                    <option value="">--Choose Account No--</option>
                                                    <?php for($i = 0; $i < count($accno); $i++) : ?>
                                                        <?php if($accno[$i]['TransGroup'] == 'CB') : ?>
                                                            <option value="<?= $accno[$i]['Acc_No'] ?>"><?= $accno[$i]['Acc_No'] ?> | <?= $accno[$i]['Acc_Name'] ?> - [<?= $accno[$i]['Acc_Type']?>]</option>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                            &nbsp;&nbsp;&nbsp;<span class="help-inline" id="m_accdesc"><b></b></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><b>Reference No.</b></label>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        #
                                                    </span>
                                                    <input type="text" name="refno" class="form-control" placeholder="Reference No. (Optional)"  value="" style="background-color:white;">
                                                </div>
                                            </div>
                                            <label class="col-md-2 control-label"><b>Employee</b></label>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <select id="emp_master_id" name="emp_master_id" class="form-control" required>
                                                        <option value="">--Choose ID--</option>
                                                        <?php for($i = 0; $i < count($employee); $i++) : ?>        
                                                            <option value="<?= $employee[$i]['IDNumber'] ?>" data-fullname="<?= $employee[$i]['FullName'] ?>" data-branch="<?= $employee[$i]['Branch'] ?>" data-dept="<?= $employee[$i]['DeptCode'] ?>" data-cc="<?= $employee[$i]['CostCenter'] ?>" data-balance="<?= $employee[$i]['Balance']?>"><?= $employee[$i]['IDNumber'] ?> - <?= $employee[$i]['FullName'] ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-primary" type="button" id="paid_branch" data-target="#insert_paid" data-toggle="modal"><i class="fa fa-plus"></i> Add</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><b>Branch</b></label>
                                            <div class="col-md-3" data-toggle="modal" data-target="#modal_branch">
                                                <input type="text" id="branch" name="branch" class="form-control" placeholder="Branch" readonly>
                                            </div>
                                            <label class="col-md-2 control-label"><b>Transaction Date</b></label>
                                            <div class="col-md-3">
                                                <input type="date" id="transdate" name="transdate" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><font color="red" size="2">*</font> <b>Journal Group</b></label>
                                            <div class="col-md-3">
                                                <select class="form-control" name="journalgroup" id="journalgroup" required>
                                                    <option selected="true" value="">--Select Journal--</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Bank">Bank</option>
                                                    <option value="General Ledger">General Ledger</option>
                                                </select>
                                            </div>
                                            <label class="col-md-2 control-label"><b>Outstanding</b></label>
                                            <div class="col-md-3">
                                                <input id="outstanding" name="outstanding" type="number" placeholder="0" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-top: 22px">
                                            <label class="col-md-2 control-label"><b>Description</b></label>
                                            <div class="col-md-10">
                                                <textarea id="remark" name="remark" cols="30" rows="4" class="form-control" style="resize:none;" placeholder="Add remarks to your transaction..." value="-"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12" style="padding: 0px; margin-top: -10px">
                                <div class="portlet light" style="border-style: solid; border-color: lightgrey;">
                                    <div class="portlet-body">
                                        <div class="mt-step-desc">
                                            <div class="font-dark bold uppercase">Total Amount</div>
                                            <br>
                                        </div>
                                        <div class="row static-info">
                                            <!-- <div class="col-md-2 name" style="font-size:20px;"> Rp. </div> -->
                                            <div class="col-md-12 value" style="margin-top: 8px">
                                                <b>
                                                    <input style="text-align:right; background: #E9EDEF; font-size: 25px; border:none;" type="text" id="label_tot_amount" readonly="true" class="input-group input-group-sm form-control">
                                                    <input type="number" class="form-control hidden" id="totalamount" name="totalamount">
                                                </b>
                                            </div>
                                        </div>
                                        <div class="mt-step-desc">
                                            <div class="font-dark bold uppercase">Outstanding Left</div>
                                            <br>
                                        </div>
                                        <div class="row static-info">
                                            <!-- <div class="col-md-2 name" style="font-size:20px;"> Rp. </div> -->
                                            <div class="col-md-12 value" style="margin-top: 8px">
                                                <b>
                                                    <input style="text-align:right; background: #E9EDEF; font-size: 25px; border:none;" type="text" id="label_outstanding_left" value="0.00" readonly="true" class="input-group input-group-sm form-control">
                                                    <input hidden type="number" id="outstanding_left" name="outstanding_left">
                                                </b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet light" style="border-style: solid; border-color: lightgrey; margin-top: -30px">
                                    <div class="portlet-body">
                                        <div class="mt-step-desc">
                                            <div class="font-dark bold uppercase">Cheque / Giro</div>
                                            <br>
                                        </div>
                                        <div class="row static-info">
                                            <!-- <div class="col-md-2 name" style="font-size:20px;"> Rp. </div> -->
                                            <div class="col-md-12 value" style="margin-top: -15px">
                                                <b><input id="giro" name="giro" style="text-align:left; background: #E9EDEF;  border:none;" type="text" placeholder="Input Check/Giro Here" class="input-group input-group-sm form-control"></b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top: -65px; padding: 0px">
                    <div class="portlet light">
                        <div class="portlet-body">
                            <div id="r_tbl_stockcode" class="portlet" style="margin-bottom: 5px;">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject font-dark bold"><i class="icon-list"></i> Detail Transaction </span>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" style="margin-top: -10px">
                                <table class="table table-striped" id="table_detail_transaction">
                                    <thead>
                                        <tr class="bg-blue-ebonyclay font-white">
                                            <th class="text-center" width="3%">Item<font color="#22313F">_</font>No</th>
                                            <th class="text-center" width="32%"> Description Det. </th>
                                            <th class="text-center" width="10%"> Department </th>
                                            <th class="text-center" width="10%"> Cost Center </th>
                                            <th class="text-center" width="10%"> Account No. </th>
                                            <th class="text-center" width="5%"> Cry </th>
                                            <th class="text-center" width="10%"> Rate </th>
                                            <th class="text-center" width="10%"> Unit </th>
                                            <th class="text-center" width="10%"> Amount </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_detail">
                                        <tr style="background-color: #E9EDEF">
                                            <td><input type="number" name="itemno[]" class="form-control" readonly value="1"></td>
                                            <td><input type="text" name="remarks[]" class="form-control" required></td>
                                            <td>
                                                <select name="departments[]" class="form-control" required>
                                                    <option value="">--Choose Department --</option>
                                                    <?php for($i=0; $i < count($department); $i++) : ?>
                                                        <option value="<?= $department[$i]['DeptCode'] ?>" data-branch="<?= $department[$i]['Branch'] ?>"><?= $department[$i]['DeptDes'] ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="costcenters[]" class="form-control" required>
                                                    <option value="">--Choose Cost Center --</option>
                                                    <?php for($i=0; $i < count($costcenter); $i++) : ?>
                                                        <option value="<?= $costcenter[$i]['CostCenter'] ?>" data-department="<?= $costcenter[$i]['DeptCode'] ?>"><?= $costcenter[$i]['CCDes'] ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="accnos[]" class="form-control" required>
                                                    <option value="">--Choose Account No--</option>
                                                    <?php for($i = 0; $i < count($accno); $i++) : ?>
                                                        <?php if($accno[$i]['TransGroup'] == 'CA') : ?>
                                                            <option value="<?= $accno[$i]['Acc_No'] ?>"><?= $accno[$i]['Acc_No'] ?> | <?= $accno[$i]['Acc_Name'] ?> - [<?= $accno[$i]['Acc_Type']?>]</option>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="currency[]" class="form-control" required>
                                                    <?php foreach($currency as $cur) : ?> 
                                                        <option value="<?= $cur->Currency ?>" <?= ($cur->Currency == 'IDR' ? 'selected' : '') ?>><?= $cur->Currency ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td><input type="number" name="rate[]" class="form-control text-right" min="1" value="1" required></td>
                                            <td><input type="number" name="unit[]" class="form-control text-right" required></td>
                                            <td><input type="" name="amount[]" class="form-control text-right" readonly></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    window.onload = load_function;

    function load_function() {
        document.body.style.zoom = 0.8;
    }
</script>
<?php $this->load->view('header_footer/finance_corp/footer'); ?>