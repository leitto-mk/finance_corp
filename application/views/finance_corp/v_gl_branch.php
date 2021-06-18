<?php $this->load->view('header_footer/finance_corp/header_sub_modul_sf_no_trees'); ?>
<div class="portlet light">
    <div class="row">
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
            <!-- <php $date = date("d-M-Y") ?> -->
                <!-- <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 invoice-logo-space hidden-print">
                    <img src="<?php echo base_url(); ?>assets/assets/pages/img/logos/logotwc.png" width="20%" class="img-responsive" alt="" /><br>
                    <div>
                        <font size="6">Company Name</font><br>
                        <font>Jl. Company Address</font><br>
                        <font>City, Postal Code</font><br>
                        <font>Phone : (0431) xxx-xxx</font><br>
                        <font>Mobile : 0813-xxxx-xxxx</font><br>
                        <font>Email : companyemail@email.com</font>
                    </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right hidden-print">
                    <div class="portlet light form-horizontal bg-default">
                        <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                            <div class="portlet-body form-horizontal hidden-print" style="margin-top: 20px">
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th valign="top" width="5%"></th>
                                                <th valign="top" width="18%">Branch / Site</th>
                                                <th valign="top" width="18%">Account No Start</th>
                                                <th valign="top" width="18%">Account No End</th>
                                                <th valign="top" width="18%">Date Start</th>
                                                <th valign="top" width="18%">Date End</th>        
                                                <th valign="top" width="5%" class="text-center">Action</th>        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label bold">Parameters</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="branch" name="branch" class="form-control" required>
                                                                <option value="">-- Choose --</option>
                                                                <option value="All">All</option>
                                                                <?php foreach($active_school as $branch) : ?>
                                                                    <option value="<?= $branch->School_Desc?>">[<?= $branch->School_Desc?>] <?= $branch->SchoolName?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="accno_start" id="accno_start">
                                                                <option value="">-- Choose --</option>
                                                                <?php foreach($account_no as $accno) : ?>
                                                                    <option value="<?= $accno->Acc_No?>">[<?= $accno->Acc_No?>] <?= $accno->Acc_Name?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="accno_finish" id="accno_finish">
                                                                <option value="">-- Choose --</option>
                                                                <?php foreach($account_no as $accno) : ?>
                                                                    <option value="<?= $accno->Acc_No?>">[<?= $accno->Acc_No?>] <?= $accno->Acc_Name?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="date" name="date_start" id='date_start' value="<?= date('Y-01-01') ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="date" name="date_finish" id='date_finish' value="<?= date('Y-m-d') ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <a class="btn btn-sm btn-success" id="submit_filter">
                                                                <center>PREVIEW</center>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                                                           
                            </div>
                        <?php echo form_close(); ?>
                    </div>  
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="portlet bordered light bg-blue-dark">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-white"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Date :  <span id="label_tbl_date_start"><?= date('01-01-Y'); ?></span> --> <span id="label_tbl_date_finish"><?= date('d-m-Y'); ?></span>
                                <div class="input-group input-large pull-right" style="margin-top: -5px">
                                   <!--  <input type="text" class="form-control" placeholder="Search for..." name="search_item" id="search_item">
                                    <span class="input-group-btn">
                                        <button  class="btn dark">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span> -->
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-xs btn green hidden-print pull-right"  onclick="printDiv('printDiv')" style="margin-left: 5px">
                                            <i class="fa fa-plus"></i>&nbsp;Print</i>
                                        </a>
                                        <a onclick="window.close();" class="btn btn-xs btn red hidden-print pull-right"><i class="fa fa-close"></i> Close</a>
                                    </span>

                                </div> 
                            </span>
                        </div>   
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table id="table_gl" class="table table-bordered table-stripped table-condensed">
                                    <thead>
                                        <tr style="background-color: #22313F" class="font-white">
                                            <th class="text-center" width="5%"> No. </th>
                                            <th class="text-center" width="7%"> Date </th>
                                            <th class="text-center" width="8%"> Doc No </th>
                                            <th class="text-center" width="8%"> Cheque/Giro </th>
                                            <th class="text-center" width="3%"> Branch </th>
                                            <th class="text-center" width="2%"> Department </th>
                                            <th class="text-center" width="3%"> Cost Center </th>
                                            <th class="text-center" width="5%"> AccNo  </th>
                                            <th class="text-center" width="15%"> Remarks </th>
                                            <th class="text-right" width="8%"> Debit </th>
                                            <th class="text-right" width="8%"> Credit </th>
                                            <th class="text-right" width="8%"> Balance </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $cur_acc = $cur_branch = '';
                                            $subtotal_credit = $subtotal_debit = 0;
                                        ?>
                                        <?php for($i = 0; $i < count($ledger); $i++) : ?>
                                            <?php if($ledger[$i]['Branch'] !== $cur_branch) : ?>
                                                <?php 
                                                    $cur_branch = $ledger[$i]['Branch'];    
                                                ?>
                                            <?php endif; ?>

                                            <!-- <?php if($ledger[$i]['Acc_Name'] !== $cur_acc) : ?>
                                                <tr style="background-color: white">
                                                    <td colspan="12" class="bold"><?= $ledger[$i]['AccNo'] ?> - <?= $ledger[$i]['Acc_Name'] ?></td>
                                                </tr>
                                                <?php
                                                    $cur_acc = $ledger[$i]['Acc_Name'];
                                                ?>
                                            <?php endif; ?> -->

                                            <tr class="font-white sbold">
                                                <td class="bold" align="center"><?= $i+1 ?></td>
                                                <td class="bold" align="center"><?= $ledger[$i]['TransDate'] ?></td>
                                                <td class="bold" align="center"><?= $ledger[$i]['DocNo'] ?></td>
                                                <td class="bold" align="center"></td>
                                                <td class="bold" align="center"><?= $cur_branch ?></td>
                                                <td class="bold" align="center"><?= $ledger[$i]['Department'] ?></td>
                                                <td class="bold" align="right"><?= $ledger[$i]['CostCenter'] ?></td>
                                                <td class="bold" align="right"><?= $ledger[$i]['AccNo'] ?></td>
                                                <td class="bold" align="center"><?= $ledger[$i]['Remarks'] ?></td>
                                                <td class="bold" align="right"><?= number_format($ledger[$i]['Debit'], 0, ',', '.') ?></td>
                                                <td class="bold" align="right"><?= number_format($ledger[$i]['Credit'], 0, ',', '.') ?></td>
                                                <td class="bold" align="right"><?= number_format($ledger[$i]['BalanceBranch'], 0, ',', '.') ?></td>
                                            </tr>

                                            <?php
                                                $subtotal_debit += $ledger[$i]['Debit'];
                                                $subtotal_credit += $ledger[$i]['Credit'];
                                            ?>

                                            <?php if(isset($ledger[$i+1]['Branch']) && $ledger[$i+1]['Branch'] !== $cur_branch || $i == (count($ledger)-1)) : ?>
                                                <?php
                                                    $subtotal_balance = $subtotal_debit + $subtotal_credit;
                                                ?>
                                                <tr class="font-white sbold">
                                                    <td class="bold" align="right" colspan="9">Beginning Balance</td>
                                                    <td class="sbold uppercase font-green-meadow" align="right" colspan="3" style="font-size: 1.25em"><?= number_format($ledger[$i]['BalanceBranch'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                                    <td align="right" colspan="9">Total :</td>                                    
                                                    <td align="right"><?= number_format($subtotal_debit, 0, ',', '.') ?></td>
                                                    <td align="right"><?= number_format($subtotal_credit, 0, ',', '.') ?></td>
                                                    <td align="right" class="font-white sbold bg bg-blue-ebonyclay"><?= number_format($subtotal_balance, 0, ',', '.') ?></td>
                                                </tr>
                                                <?php
                                                    $subtotal_credit = $subtotal_debit = $subtotal_balance = 0;
                                                ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
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
<script type="text/javascript">
    window.onload = load_function;

    function load_function() {
        document.body.style.zoom = 0.9;
    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php $this->load->view('header_footer/finance_corp/footer_sub_modul_sf'); ?>