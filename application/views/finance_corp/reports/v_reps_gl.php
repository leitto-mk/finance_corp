<?php $this->load->view('header_footer/finance_corp/header_sub_modul_sf_no_trees'); ?>
<!-- <style type="text/css">
    tr:nth-child(even){
        background-color: #E1E5EC;
    }

    tr:nth-child(odd){
        background-color: white;
    }
</style> -->
<div class="portlet light" style="background-color: #eff2f6;">
    <div class="row">
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
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

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <img src="" class="img-responsive" alt="" width="50px">
                                        <address>
                                            <h4>
                                                <i class="fa fa-building"></i><stro>&nbsp;&nbsp;<?= ($ledger[0]['ComName'] ?? 'N/A') ?></stro)ng>
                                                <br> <i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?= ($ledger[0]['Address'] ?? 'N/A') ?>
                                                <br> <i class="fa fa-phone"></i>&nbsp;&nbsp;<?= ($ledger[0]['Contact'] ?? 'N/A') ?>
                                                <br> <i class="fa fa-envelope"></i>&nbsp;&nbsp;<?= ($ledger[0]['Email'] ?? 'N/A') ?>
                                            </h4>
                                        </address>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right" style="margin-top: -20px;">
                                    <p>
                                        <font size="6"><b>#General Ledger</b></font>
                                    </p>
                                    <address>
                                        <h4><b><i class="fa fa-calendar"></i> Period : <?= $date_start ?> - <?= $date_end ?></b></h4>                                       
                                    </address>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped table-condensed">
                                    <thead>
                                        <tr class="font-dark bg-default">
                                            <!-- <th class="text-center"> No </th> -->
                                            <th class="text-center" width="5%"> Trans Date </th>
                                            <th class="text-center" width="15%"> Description </th>
                                            <th class="text-center" width="7%"> Doc No </th>
                                            <th class="text-center" width="5%"> Trans Type </th>
                                            <th class="text-center" width="7%"> Dept. </th>
                                            <th class="text-center" width="7%"> Cost Center </th>
                                            <th class="text-center" width="5%"> Cry </th>
                                            <th class="text-right" width="10%"> Debit </th>
                                            <th class="text-right" width="10%"> Credit </th>
                                            <th class="text-right" width="10%"> Balance </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $cur_acc = '';
                                            $subtotal_credit = $subtotal_debit = 0;
                                        ?>
                                        <?php for($i = 0; $i < count($ledger); $i++) : ?>
                                            <?php
                                                $curdate = date('Y-m-d', strtotime($ledger[$i]['TransDate']));
                                                $start = date('Y-m-d', strtotime($date_start));
                                                $end = date('Y-m-d', strtotime($date_end));
                                            ?>
                                            <?php if($ledger[$i]['Acc_Name'] !== $cur_acc) : ?>
                                                <tr style="background-color: #eff2f6c9">
                                                    <td colspan="11" class="bold"><?= $ledger[$i]['AccNo'] ?> -- <?= $ledger[$i]['Acc_Name'] ?> | <?= $ledger[$i]['Acc_Type']?></td>
                                                </tr>
                                                <tr class="font-dark sbold">
                                                    <td class="bold" align="right" colspan="2">Beginning Balance</td>
                                                    <?php 
                                                        if(($ledger[$i]['Acc_Type'] == 'R' || $ledger[$i]['Acc_Type'] == 'E') && $curdate < $start){
                                                            $ledger[$i]['beg_balance'] = 0;
                                                        }
                                                    ?>
                                                    <td class="sbold uppercase font-green-meadow" align="right" colspan="8" style="font-size: 1.25em"><?= number_format($ledger[$i]['beg_balance'], 0, ',', '.') ?></td>
                                                </tr>
                                                <?php
                                                    // $no = 0;
                                                    $cur_acc = $ledger[$i]['Acc_Name'];
                                                ?>
                                            <?php endif; ?>
                                            <?php if(($curdate >= $start) && ($curdate <= $end)) :?>
                                                <tr class="sbold">
                                                    <td class="bold" align="center"><?= $ledger[$i]['TransDate'] ?></td>
                                                    <td class="bold" align="left"><?= $ledger[$i]['Remarks'] ?></td>
                                                    <td class="bold" align="center"><?= $ledger[$i]['DocNo'] ?></td>
                                                    <td class="bold" align="center"><?= $ledger[$i]['TransType'] ?></td>
                                                    <td class="bold" align="center"><?= $ledger[$i]['Department'] ?></td>
                                                    <td class="bold" align="center"><?= $ledger[$i]['CostCenter'] ?></td>
                                                    <td class="bold" align="center"><?= $ledger[$i]['Currency'] ?></td>
                                                    <td class="bold" align="right"><?= number_format($ledger[$i]['Debit'], 2, ',', '.') ?></td>
                                                    <td class="bold" align="right"><?= number_format($ledger[$i]['Credit'], 2, ',', '.') ?></td>
                                                    <td class="bold" align="right"><?= number_format($ledger[$i]['BalanceBranch'], 2, ',', '.') ?></td>
                                                </tr>
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