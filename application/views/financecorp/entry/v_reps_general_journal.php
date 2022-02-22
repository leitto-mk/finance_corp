<?php $this->load->view('header_footer/header_sub_modul_sf_no_trees'); ?>
<div class="portlet light" id="printDiv">
    <style type="text/css">
        /*tr:nth-child(even){
            background-color: #E1E5EC;
        }

        tr:nth-child(odd){
            background-color: white;
        }*/

        .table th h5 {
            margin-top: -1px;
            margin-bottom: -1px;
            font-size: 12px;
        }

        .table td h6 {
            margin-top: -1px;
            margin-bottom: -1px;
            font-size: 12px;
        }
    </style>
    <div class="row">
        <div class="col-md-12" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
            <!-- <php $date = date("d-M-Y") ?> -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-logo-space text-center" style="margin-top: 0px">
                    <div>
                        <font size="4" class="uppercase"><?= $company ?></font><br>
                        <font size="4" class="font-dark sbold uppercase">General Journal</font><br>
                        <font size="4" class="font-dark sbold"></font><br>
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
                            <div id="detail_preview_po" class="portlet-body">
                                <div class="row sbold">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <div class="table-responsive">
                                            <table class="table table-stripped table-condensed">
                                                <tbody>
                                                    <tr>
                                                        <td width="10%" style="border: none;"><h6 class="bold">Document No</h6></td>
                                                        <td width="1%" style="border: none;"><h6 class="bold">:</h6></td>
                                                        <td width="40%" style="border: none;"><h6 class="bold"><?= $report[0]['DocNo'] ?></h6></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="10%" style="border: none;"><h6 class="bold">Description</h6></td>
                                                        <td width="1%" style="border: none;"><h6 class="bold">:</h6></td>
                                                        <td width="40%" style="border: none;"><h6 class="bold"><?= $report[0]['DescMaster'] ?></h6></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="table-responsive">
                                            <table class="table table-stripped table-condensed">
                                                <tbody>
                                                    <tr>
                                                        <td width="10%" style="border: none;"><h6 class="bold">Voucher Ref. No</h6></td>
                                                        <td width="1%" style="border: none;"><h6 class="bold">:</h6></td>
                                                        <td width="20%" style="border: none;"><h6 class="bold"><?= $report[0]['RefNo'] ?></h6></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="10%" style="border: none;"><h6 class="bold">Transaction Date</h6></td>
                                                        <td width="1%" style="border: none;"><h6 class="bold">:</h6></td>
                                                        <td width="20%" style="border: none;"><h6 class="bold"><?= $report[0]['TransDate'] ?></h6></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: -15px">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-stripped table-condensed">
                                                <thead>
                                                    <tr class="font-dark bg-default">
                                                        <th width="3%"><h5 class="text-center bold">No</h5></th>
                                                        <th width="29%"><h5 class="text-center bold">Description</h5></th>
                                                        <th width="8%"><h5 class="text-center bold">Dept</h5></th>
                                                        <th width="8%"><h5 class="text-center bold">CostC</h5></th>
                                                        <th width="7%"><h5 class="text-center bold">Account</h5></th>
                                                        <th width="10%"><h5 class="text-center bold">Name</h5></th>
                                                        <th width="5%"><h5 class="text-center bold">Cry</h5></th>
                                                        <th width="10%"><h5 class="text-right bold">Debit</h5></th>
                                                        <th width="10%"><h5 class="text-right bold">Credit</h5></th>
                                                        <th width="10%"><h5 class="text-right bold">Amount</h5></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $grand_total = 0;
                                                    ?>
                                                    <?php for($i = 0; $i < count($report); $i++) : ?>
                                                        <?php if($report[$i]['ItemNo'] > 0) : ?>
                                                            <tr>
                                                                <td><h6 class="text-center bold"><?= $i ?></h6></td>
                                                                <td><h6 class="bold"><?= substr($report[$i]['DescDetail'], 0,105) ?></h6></td>
                                                                <td><h6 class="text-center bold"><?= $report[$i]['Department']?></h6></td>
                                                                <td><h6 class="text-center bold"><?= $report[$i]['CostCenter']?></h6></td>
                                                                <td><h6 class="text-center bold"><?= $report[$i]['AccNo']?></h6></td>
                                                                <td><h6 class="bold"><?= $report[$i]['Acc_Name']?></h6></td>
                                                                <td><h6 class="text-center bold"><?= $report[$i]['Currency']?></h6></td>
                                                                <td><h6 style="float: right" class="bold"><?= $report[$i]['Debit']?></h6></td>
                                                                <td><h6 style="float: right" class="bold"><?= number_format($report[$i]['Credit'], 0, '.',',') ?></h6></td>
                                                                <td><h6 style="float: right" class="bold"><?= number_format($report[$i]['Amount'], 0, '.',',') ?></h6></td>
                                                            </tr>
                                                            <?php 
                                                                $grand_total += $report[$i]['Amount'];
                                                            ?>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                    <tr>
                                                        <td colspan="9"><h6 class="text-right bold">Grand Total :</td>
                                                        <td><h6 style="float: right" class="bold"><?= number_format($grand_total, 0,'',',') ?></h6></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 220px">
                                    <div class="col-xs-3">
                                        <dl>
                                            <dt>Prepared By :</dt>
                                            <dt style="margin-top: 100px; border-bottom: solid 1px;"></dt>
                                            
                                        </dl>
                                    </div>
                                    <div class="col-xs-1">
                                    </div>
                                    <div class="col-xs-3">
                                        <dl>
                                            <dt>Reviewed By :</dt>
                                            <dt style="margin-top: 100px; border-bottom: solid 1px;"></dt>
                                            
                                        </dl>
                                    </div>
                                    <div class="col-xs-1">
                                    </div>
                                    <div class="col-xs-3">
                                        <dl>
                                            <dt>Approved By :</dt>
                                            <dt style="margin-top: 100px; border-bottom: solid 1px;"></dt>
                                        </dl>
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
<?php $this->load->view('header_footer/footer_sub_modul_sf'); ?>