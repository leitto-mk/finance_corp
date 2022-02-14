<?php $this->load->view('header_footer/finance_corp/header'); ?>
<body class="page-container-bg-solid">
    <div class="page-wrapper">
        <div class="page-wrapper-row">
            <div class="page-wrapper-top">
                <!-- BEGIN HEADER MENU -->
                <div class="page-header-menu" style="background:#444d58;">
                    <div class="container-fluid">
                        <div class="hor-menu  ">
                            <ul class="nav navbar-nav">
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active uppercase">
                                    <h4 style="color:#ffffff">Cash Advance Receipt</h4>
                                </li>
                            </ul>
                        </div>
                        <!-- END MEGA MENU -->
                    </div>
                </div>
                <!-- END HEADER MENU -->
            </div>
        </div>
        <div class="page-wrapper-row full-height">
            <div class="page-wrapper-middle">
                <!-- BEGIN CONTAINER -->
                <div class="page-container">
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN PAGE CONTENT BODY -->
                        <div class="page-content">
                            <div class="container-fluid" style="padding-bottom:30px;">
                                <!-- BEGIN PAGE CONTENT INNER -->
                                <div class="page-content-inner">
                                    <!-- Content Start -->
                                    <form method="post" class="form-horizontal" id="form_ca_receipt" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="portlet light" style="height: 370px">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-edit"></i> Master Transaction </span>
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
                                                        <div class="col-lg-9 col-xs-12 col-sm-12 bg-grey-salsa">
                                                            <div class="portlet-body form-horizontal">
                                                                <div class="form-body" style="margin-top: 10px">
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Document No.</b></label>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                    #
                                                                                </span>
                                                                                <input type="text" name="docno" class="form-control" readonly value="<?= $docno ?>" style="background-color:white;">
                                                                            </div>
                                                                        </div>
                                                                        <!-- Row 2 -->
                                                                        <label class="col-md-2 control-label"><b>Account No.</b></label>
                                                                        <div class="col-md-3" data-toggle="modal" data-target="#modal_caccount">
                                                                            <select name="accno" id="accno" class="form-control" required>
                                                                                <option value="">--Choose Account No--</option>
                                                                                <?php for($i=0; $i < count($accnos); $i++) : ?>
                                                                                    <?php
                                                                                        $accn = $accnos[$i]['Acc_No'];
                                                                                        $acctype = $accnos[$i]['Acc_Type']; 
                                                                                        $accname = $accnos[$i]['Acc_Name'];
                                                                                    ?>
                                                                                    <?php if($accn == $accno) : ?>
                                                                                        <option value="<?= $accn ?>" selected><?= $accn ?> | <?= $accname ?> - [<?= $acctype ?>]</option>
                                                                                    <?php else: ?>
                                                                                        <option value="<?= $accn ?>"><?= $accn ?> | <?= $accname ?> - [<?= $acctype ?>]</option>
                                                                                    <?php endif; ?>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;<span class="help-inline" id="accdesc"><b></b></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Employee</b></label>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group">
                                                                            <select id="emp_master_id" name="emp_master_id" class="form-control" required>
                                                                                    <option value="">--Choose ID--</option>
                                                                                    <?php for($i = 0; $i < count($employees); $i++) :?>
                                                                                        <?php if($employees[$i]['IDNumber'] == $id) : ?>
                                                                                            <option selected value="<?= $employees[$i]['IDNumber'] ?>" data-fullname="<?= $employees[$i]['FullName'] ?>" data-branch="<?= $employees[$i]['Branch'] ?>" data-dept="<?= $employees[$i]['DeptCode'] ?>" data-cc="<?= $employees[$i]['CostCenter'] ?>"><?= $employees[$i]['IDNumber'] ?> | <?= $employees[$i]['FullName'] ?></option>
                                                                                        <?php else : ?>
                                                                                            <option value="<?= $employees[$i]['IDNumber'] ?> | <?= $employees[$i]['IDNumber'] ?>" data-fullname="<?= $employees[$i]['FullName'] ?>" data-branch="<?= $employees[$i]['Branch'] ?>" data-dept="<?= $employees[$i]['DeptCode'] ?>" data-cc="<?= $employees[$i]['CostCenter'] ?>"><?= $employees[$i]['IDNumber'] ?> | <?= $employees[$i]['FullName'] ?></option>
                                                                                        <?php endif;?>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                                <span class="input-group-btn">
                                                                                    <button class="btn btn-primary" type="button" id="paid_branch" data-target="#insert_paid" data-toggle="modal"><i class="fa fa-plus"></i> Add</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <label class="col-md-2 control-label"><b>Branch</b></label>
                                                                        <div class="col-md-3" data-toggle="modal" data-target="#modal_branch">
                                                                            <input type="text" id="branch" name="branch" class="form-control" placeholder="Branch" value="<?= $branch ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Outstanding</b></label>
                                                                        <div class="col-md-3">
                                                                            <input type="text" id="outstanding" name="outstanding" class="form-control" placeholder="0" value="<?= $outstanding ?>" readonly>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;<span class="help-inline" id="m_namestd"><b></b></span>
                                                                        <label class="col-md-2 control-label"><b>Transaction Date</b></label>
                                                                        <div class="col-md-3">
                                                                            <input type="date" id="transdate" name="transdate" value="<?= $transdate ?>" class="form-control" required>
                                                                        </div>

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Outstading</b></label>
                                                                        <div class="col-md-3">
                                                                            <input type="number" class="form-control">
                                                                        </div>
                                                                        <label class="col-md-2 control-label"><font color="red" size="2">*</font> <b>Journal Group</b></label>
                                                                        <div class="col-md-3">
                                                                            <select class="form-control" name="journalgroup" id="journalgroup" required>
                                                                                <option value="">--Select Journal--</option>
                                                                                <option value="Cash" <?= ($journalgroup == 'Cash' ? 'selected' : '')?>>Cash</option>
                                                                                <option value="Bank" <?= ($journalgroup == 'Bank' ? 'selected' : '')?>>Bank</option>
                                                                                <option value="General Ledger" <?= ($journalgroup == 'General Ledger' ? 'selected' : '')?>>General Ledger</option>
                                                                            </select>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;<span class="help-inline" id="m_namestd"><b></b></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label"><b>Description</b></label>
                                                                        <div class="col-md-10">
                                                                            <textarea id="remark" name="remark" cols="30" rows="1" class="form-control" value="<?= $remark ?>" style="resize:none;" placeholder="Add remarks to your transaction..." value="-"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-xs-12 col-sm-12" style="padding: 0px">
                                                            <div class="portlet light" style="border-style: solid; border-color: lightgrey;">
                                                                <div class="portlet-body">
                                                                    <div class="mt-step-desc">
                                                                        <div class="font-dark bold uppercase">Total Amount</div>
                                                                        <br>
                                                                    </div>
                                                                    <div class="row static-info">
                                                                        <!-- <div class="col-md-2 name" style="font-size:20px;"> Rp. </div> -->
                                                                        <div class="col-md-12 value" style="margin-top: -15px">
                                                                            <b>
                                                                                <input style="text-align:right; background: #E9EDEF; font-size: 25px; border:none;" type="text" id="label_tot_amount" readonly="true" class="input-group input-group-sm form-control">
                                                                                <input type="number" class="form-control hidden" id="totalamount" name="totalamount" value="<?= $total ?>">
                                                                            </b>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-step-desc">
                                                                        <div class="font-dark bold uppercase">Outstanding Left</div>
                                                                        <br>
                                                                    </div>
                                                                    <div class="row static-info">
                                                                        <!-- <div class="col-md-2 name" style="font-size:20px;"> Rp. </div> -->
                                                                        <div class="col-md-12 value" style="margin-top: -15px">
                                                                            <b><input style="text-align:right; background: #E9EDEF; font-size: 25px; border:none;" type="text" id="outstanding_left" name="outstanding_left" value="0.00" readonly="true" class="input-group input-group-sm form-control"></b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="portlet light" style="border-style: solid; border-color: lightgrey; margin-top: -26px">
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
                                            <div class="col-md-12">
                                                <div class="portlet bordered light bg-blue-dark">
                                                    <div class="portlet-body">
                                                        <div id="r_tbl_stockcode" class="portlet" style="margin-bottom: 5px;">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <span class="caption-subject font-white"><i class="icon-list"></i> Detail Transaction </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped" id="table_detail_transaction">
                                                                <thead>
                                                                    <tr style="background-color: #22313F" class="font-white">
                                                                        <th class="text-center" width="3%">Item No</th>
                                                                        <th class="text-center"> Description Det. </th>
                                                                        <th class="text-center"> Department </th>
                                                                        <th class="text-center"> Cost Center </th>
                                                                        <!-- <th class="text-center"> Paid To </th> -->
                                                                        <th class="text-center"> Account No. </th>
                                                                        <th class="text-center"> Currency </th>
                                                                        <th class="text-center"> Rate </th>
                                                                        <th class="text-center"> Unit </th>
                                                                        <th class="text-center"> Amount </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody_detail">
                                                                    <?php for($i=1; $i < count($list); $i++) : ?>
                                                                        <tr style="background-color: #E9EDEF">
                                                                            <td><input type="number" name="itemno[]" class="form-control" readonly value="<?= $list[$i]['ItemNo'] ?>"></td>
                                                                            <td><input type="text" name="remarks[]" class="form-control" value="<?= $list[$i]['Remarks'] ?>" required></td>
                                                                            <td>
                                                                                <select name="departments[]" class="form-control" required>
                                                                                    <option value="">--Choose Department --</option>
                                                                                    <?php if(!empty($department)) : ?>
                                                                                        <?php for($j=0; $j < count($department); $j++) : ?>
                                                                                            <?php if($departments[$j]['DeptCode'] == $list[$i]['Department']) : ?>
                                                                                                <option selected value="<?= $department[$j]['DeptCode'] ?>" data-branch="<?= $department[$j]['Branch'] ?>"><?= $department[$j]['DeptDes'] ?></option>
                                                                                            <?php else : ?>
                                                                                                <option value="<?= $department[$j]['DeptCode'] ?>" data-branch="<?= $department[$j]['Branch'] ?>"><?= $department[$j]['DeptDes'] ?></option>
                                                                                            <?php endif; ?>
                                                                                        <?php endfor; ?>
                                                                                    <?php endif; ?>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <select name="costcenters[]" class="form-control" required>
                                                                                    <option value="">--Choose Cost Center --</option>
                                                                                    <?php if(!empty($costcenter)) : ?>
                                                                                        <?php for($k=0; $k < count($costcenter); $k++) : ?>
                                                                                            <?php if($costcenter[$k]['DeptCode'] == $list[$i]['CostCenter']) : ?>
                                                                                                <option selected value="<?= $costcenter[$k]['CostCenter'] ?>" data-department="<?= $costcenter[$k]['DeptCode'] ?>"><?= $costcenter[$i]['CCDes'] ?></option>
                                                                                            <?php else :?>
                                                                                                <option value="<?= $costcenter[$k]['CostCenter'] ?>" data-department="<?= $costcenter[$k]['DeptCode'] ?>"><?= $costcenter[$i]['CCDes'] ?></option>
                                                                                            <?php endif; ?>
                                                                                        <?php endfor; ?>
                                                                                    <?php endif; ?>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <select name="accnos[]" class="form-control" required>
                                                                                    <option value="">--Choose Account No--</option>
                                                                                    <?php if(!empty($accnos)) : ?>
                                                                                        <?php for($l=0; $l < count($accnos); $l++) : ?>
                                                                                            <?php
                                                                                                $accname = $accnos[$l]['Acc_Name'];
                                                                                                $accn = $accnos[$l]['Acc_No'];
                                                                                                $acctype = $accnos[$l]['Acc_Type']; 
                                                                                            ?>
                                                                                            <?php if($accn == $list[$i]['AccNo']) : ?>
                                                                                                <option selected value="<?= $accn ?>"><?= $accn ?> | <?= $accname ?> - [<?= $acctype ?>]</option>
                                                                                            <?php else: ?>
                                                                                                <option value="<?= $accn ?>"><?= $accn ?> | <?= $accname ?> - [<?= $acctype ?>]</option>
                                                                                            <?php endif; ?>
                                                                                        <?php endfor; ?>
                                                                                    <?php endif; ?>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <select name="currency[]" class="form-control" required>
                                                                                    <?php foreach($currency as $cur) : ?> 
                                                                                        <?php if($cur->Currency == $list[$i]['Currency']) : ?>
                                                                                            <option selected value="<?= $cur->Currency ?>" <?= ($cur->Currency == 'IDR' ? 'selected' : '') ?>><?= $cur->Currency ?> | <?= $cur->CurrencyName ?></option>
                                                                                        <?php else : ?>
                                                                                            <option value="<?= $cur->Currency ?>" <?= ($cur->Currency == 'IDR' ? 'selected' : '') ?>><?= $cur->Currency ?> | <?= $cur->CurrencyName ?></option>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="number" name="rate[]" value="<?= $list[$i]['Rate'] ?>" class="form-control" min="1" value="1" required></td>
                                                                            <td><input type="number" name="unit[]" value="<?= $list[$i]['Unit'] ?>" class="form-control" required></td>
                                                                            <td><input type="" name="amount[]" value="<?= $list[$i]['Amount'] ?>" class="form-control" readonly></td>
                                                                        </tr>
                                                                    <?php endfor; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Content End -->
                                </div>
                                <!-- END PAGE CONTENT INNER -->
                            </div>
                        </div>
                        <!-- END PAGE CONTENT BODY -->
                        <!-- END CONTENT BODY -->
                    </div>
                    <!-- END CONTENT -->

                    <!-- BEGIN QUICK SIDEBAR -->
                    <a href="javascript:;" class="page-quick-sidebar-toggler">
                        <i class="icon-login"></i>
                    </a>
                    <!-- END QUICK SIDEBAR -->
                </div>
                <!-- END CONTAINER -->
            </div>
        </div>
        <script type="text/javascript">
            window.onload = load_function;

            function load_function() {
                document.body.style.zoom = 0.8;
            }
        </script>
        <?php $this->load->view('header_footer/finance_corp/footer'); ?>