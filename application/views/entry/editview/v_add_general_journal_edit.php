<?php $this->load->view('header_footer/header'); ?>
<body class="page-container-bg-solid">
    <div class="page-wrapper">
        <div class="page-wrapper-row">
            <div class="page-wrapper-top">
                <!-- BEGIN HEADER MENU -->
                <div class="page-header-menu" style="background:#444d58;">
                    <div class="container-fluid">
                        <div class="hor-menu">
                            <ul class="nav navbar-nav">
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active uppercase">
                                    <h4 style="color:#ffffff">General Journal</h4>
                                </li>
                            </ul>
                        </div>
                        <!-- END MEGA MENU -->
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>
        <div class="portlet light" style="margin-top: -20px">
            <form method="post" class="form-horizontal" id="form_general_journal" autocomplete="off">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject bold uppercase font-dark" style="margin-left: -10px"><i class="fa fa-edit"></i> Master Transaction </span>
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
                                                <label class="col-md-2 control-label"><b>Branch</b></label>
                                                <div class="col-md-3" data-toggle="modal" data-target="#modal_branch">
                                                    <select name="branch" id="branch" class="form-control" data-live-search="true" data-size="8" required>
                                                        <option value="">--Choose Branch--</option>
                                                        <?php foreach($branches as $branches) : ?>
                                                            <?php if($branches->BranchCode == $branch ) : ?>
                                                                <option selected value="<?= $branches->BranchCode ?>"><?= $branches->BranchCode ?> - <?= $branches->BranchName ?></option>    
                                                            <?php else : ?>
                                                                <option value="<?= $branches->BranchCode ?>"><?= $branches->BranchCode ?> - <?= $branches->BranchName ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label"><b>Reference No.</b></label>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            #
                                                        </span>
                                                        <input type="text" name="refno" class="form-control" placeholder="Reference No. (Optional)"  value="<?= $refno ?>" style="background-color:white;">
                                                    </div>
                                                </div>
                                                <label class="col-md-2 control-label"><b>Transaction Date</b></label>
                                                <div class="col-md-3">
                                                <input type="date" id="transdate" name="transdate" class="form-control" min="<?= date('Y-m-d') ?>" value="<?= $transdate ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label"><b>Paid To</b></label>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <input name="paidto" id="paidto" class="form-control" value="<?= $paidto ?>"/>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-primary" type="button" id="paid_branch" data-target="#insert_paid" data-toggle="modal"><i class="fa fa-plus"></i> Add</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label"><b>Description</b></label>
                                                <div class="col-md-10">
                                                <textarea id="remark" name="remark" cols="30" rows="1" class="form-control" style="resize:none;" placeholder="Add remarks to your transaction..." value="-"><?= $remark ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-12 col-sm-12" style="padding: 0px; margin-top: -10px">
                                    <div class="portlet light" style="border-style: solid; border-color: lightgrey;">
                                        <div class="portlet-body">
                                            <div class="mt-step-desc">
                                                <div class="font-dark bold uppercase">Actions</div>
                                            </div>
                                            <div class="portlet-title text-center" style="margin-top: 27px">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-top: -45px; padding: 0px">
                        <div class="portlet light">
                            <div class="portlet-body">
                                <div class="portlet" style="margin-bottom: 5px;">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-dark bold"><i class="icon-list"></i> Detail Transaction </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" style="margin-top: -10px">
                                    <table class="table table-striped" id="table_detail_transaction">
                                        <thead>
                                            <tr style="background-color: #22313F" class="font-white">
                                                <th class="text-center" width="3%">Item<font color="#22313F">_</font>No</th>
                                                <th class="text-center" width="32%"> Description Det. </th>
                                                <th class="text-center" width="10%"> Department </th>
                                                <th class="text-center" width="10%"> Cost Center </th>
                                                <!-- <th class="text-center"> Paid To </th> -->
                                                <th class="text-center" width="10%"> Account No. </th>
                                                <th class="text-center" width="5%"> Cry </th>
                                                <th class="text-center" width="15%"> Debit </th>
                                                <th class="text-center" width="15%"> Credit </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_detail">
                                            <?php
                                                $debit_total = 0;
                                                $credit_total = 0;
                                            ?>
                                            <?php for($i=0; $i < count($list); $i++) : ?>
                                                <tr style="background-color: #E9EDEF">
                                                    <td><input type="number" name="itemno[]" class="form-control" readonly value="<?= $list[$i]['ItemNo'] ?>"></td>
                                                    <td><input type="text" name="remarks[]" class="form-control" value="<?= $list[$i]['Remarks'] ?>" required></td>
                                                    <td>
                                                        <select name="departments[]" class="form-control" required>
                                                            <option value="">--Choose Department --</option>
                                                            <?php if(!empty($department)) : ?>
                                                                <?php for($j=0; $j < count($department); $j++) : ?>
                                                                    <?php if($department[$j]['DeptCode'] == $list[$i]['Department']) : ?>
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
                                                                    <?php if($costcenter[$k]['CostCenter'] == $list[$i]['CostCenter']) : ?>
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
                                                    <td><input type="number" name="debit[]" value="<?= $list[$i]['Debit'] ?>" class="form-control" value="0" required></td>
                                                    <td><input type="number" name="credit[]" value="<?= $list[$i]['Credit'] ?>" class="form-control" required></td>
                                                </tr>
                                                <?php
                                                    $debit_total += $list[$i]['Debit'];
                                                    $credit_total = $list[$i]['Credit'];
                                                ?>
                                            <?php endfor; ?>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td class="text-right sbold uppercase" colspan="6" style="padding-top: 15px">Total</td>
                                                <td><input type="number" id="total_debit" name="total_debit" class="form-control" value="<?= $debit_total?>" readonly></td>
                                                <td><input type="number" id="total_credit" name="total_credit" class="form-control" value="<?= $credit_total?>" readonly></td>
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
</div>                    
<script type="text/javascript">
    window.onload = load_function;

    function load_function() {
        document.body.style.zoom = 0.8;
    }
</script>
<?php $this->load->view('header_footer/footer'); ?>