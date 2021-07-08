<?php $this->load->view('header_footer/finance_corp/header_sub_modul_sf_no_trees'); ?>
<!-- <style type="text/css">
    tr:nth-child(even){
        background-color: #E1E5EC;
    }

    tr:nth-child(odd){
        background-color: white;
    }
</style> -->
<div class="portlet light">
    <div class="row">
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
            <!-- <php $date = date("d-M-Y") ?> -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-logo-space text-center" style="margin-top: 15px">
                    <div>
                        <font size="6">Company Name</font><br>
                        <font size="4" class="font-dark sbold">General Ledger</font><br>
                        <font size="3" class="font-dark sbold"><i class="fa fa-calendar"></i> Period : <?= $date_start ?> - <?= $date_end ?></font>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="portlet bordered light bg-white">
                        <div class="caption">
                            <span class="caption-subject uppercase font-dark">
                                <div class="input-group input-large pull-right" style="margin-top: -5px">
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
                                <table class="table table-bordered table-stripped table-condensed">
                                    <thead>
                                        <tr class="font-dark bg-default">
                                            <!-- <th class="text-center"> No </th> -->
                                            <th class="text-center"> Trans Date </th>
                                            <th class="text-center"> Doc No </th>
                                            <th class="text-center"> Trans Type </th>
                                            <th class="text-left"> Description </th>
                                            <th class="text-center"> Dept. </th>
                                            <th class="text-center"> Cost Center </th>
                                            <th class="text-center"> Cry </th>
                                            <th class="text-right"> Debit </th>
                                            <th class="text-right"> Credit </th>
                                            <th class="text-right"> Balance </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $cur_acc = '';
                                            $subtotal_credit = $subtotal_debit = 0;
                                        ?>
                                        <?php for($i = 0; $i < count($ledger); $i++) : ?>

                                            <?php if($ledger[$i]['Acc_Name'] !== $cur_acc) : ?>
                                                <tr style="background-color: white">
                                                    <td colspan="11" class="bold"><?= $ledger[$i]['AccNo'] ?> -- <?= $ledger[$i]['Acc_Name'] ?></td>
                                                </tr>
                                                <tr class="font-dark sbold">
                                                    <td class="bold" align="right" colspan="4">Beginning Balance</td>
                                                    <td class="sbold uppercase font-green-meadow" align="right" colspan="7" style="font-size: 1.25em"><?= number_format($ledger[$i]['beg_balance'], 0, ',', '.') ?></td>
                                                </tr>
                                                <?php
                                                    // $no = 0;
                                                    $cur_acc = $ledger[$i]['Acc_Name'];
                                                ?>
                                            <?php endif; ?>

                                            <tr class="sbold">
                                                <td class="bold" align="center"><?= $ledger[$i]['TransDate'] ?></td>
                                                <td class="bold" align="center"><?= $ledger[$i]['DocNo'] ?></td>
                                                <td class="bold" align="center"><?= $ledger[$i]['TransType'] ?></td>
                                                <td class="bold" align="center"><?= $ledger[$i]['Remarks'] ?></td>
                                                <td class="bold" align="center"><?= $ledger[$i]['Department'] ?></td>
                                                <td class="bold" align="center"><?= $ledger[$i]['CostCenter'] ?></td>
                                                <td class="bold" align="center"><?= $ledger[$i]['Currency'] ?></td>
                                                <td class="bold" align="right"><?= number_format($ledger[$i]['Debit'], 0, ',', '.') ?></td>
                                                <td class="bold" align="right"><?= number_format($ledger[$i]['Credit'], 0, ',', '.') ?></td>
                                                <td class="bold" align="right"><?= number_format($ledger[$i]['BalanceBranch'], 0, ',', '.') ?></td>
                                            </tr>
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