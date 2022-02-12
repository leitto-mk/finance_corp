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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-logo-space text-center" style="margin-top: 0px">
                    <div>
                        <font size="5" class="uppercase"><?= $company ?></font><br>
                        <font size="4" class="font-dark sbold uppercase">Overbook</font><br>
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
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th width="10%" style="border: none;">Document No</th>
                                                    <td width="1%" style="border: none;">:</td>
                                                    <td width="20%" style="border: none;"><?= $report[0]['DocNo'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="10%" style="border: none;">Account No</th>
                                                    <td width="1%" style="border: none;">:</td>
                                                    <td width="20%" style="border: none;"><?= $report[0]['AccNo'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="10%" style="border: none;">Journal Group</th>
                                                    <td width="1%" style="border: none;">:</td>
                                                    <td width="20%" style="border: none;"><?= $report[0]['JournalGroup'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="10%" style="border: none;">Description</th>
                                                    <td width="1%" style="border: none;">:</td>
                                                    <td width="20%" style="border: none;"><?= $report[0]['Remarks'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                    <th width="10%" style="border: none;">Transaction Date</th>
                                                    <td width="1%" style="border: none;">:</td>
                                                    <td width="20%" style="border: none;"><?= $report[0]['TransDate'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="10%" style="border: none;">Paid To</th>
                                                    <td width="1%" style="border: none;">:</td>
                                                    <td width="20%" style="border: none;"><?= $report[0]['IDNumber'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="10%" style="border: none;"></th>
                                                    <td width="1%" style="border: none;">:</td>
                                                    <td width="20%" style="border: none;"></td>
                                                </tr>
                                                <tr>
                                                    <th width="10%" style="border: none;">Cheque / Giro</th>
                                                    <td width="1%" style="border: none;">:</td>
                                                    <td width="20%" style="border: none;"><?= $report[0]['Giro'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: -15px">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead class="well">
                                                    <tr>
                                                        <th width="3%"  class="text-center"> No </th>
                                                        <th width="30%" class="text-center"> Description </th>
                                                        <th width="10%" class="text-center"> Department </th>
                                                        <th width="10%"  class="text-center"> Cost Center </th>
                                                        <th width="7%" class="text-center"> Account No </th>
                                                        <th width="10%" class="text-center"> Account Name </th>
                                                        <th width="5%" class="text-center"> Cry </th>
                                                        <th width="5%" class="text-right"> Rate </th>
                                                        <th width="10%" class="text-right"> Unit  </th>
                                                        <th width="20%" class="text-right"> Amount </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php for($i = 0; $i < count($report); $i++) : ?>
                                                        <?php if($report[$i]['ItemNo'] > 0) : ?>
                                                            <tr>
                                                                <td align="center"><?= $i+1 ?></td>
                                                                <td><?= $report[$i]['Remarks']?></td>
                                                                <td><?= $report[$i]['Department']?></td>
                                                                <td><?= $report[$i]['CostCenter']?></td>
                                                                <td><?= $report[$i]['AccNo']?></td>
                                                                <td><?= $report[$i]['Acc_Name']?></td>
                                                                <td align="center" class="sbold"><?= $report[$i]['Currency']?></td>
                                                                <td align="right" class="sbold"><?= $report[$i]['Rate']?></td>
                                                                <td align="right" class="sbold"><?= number_format($report[$i]['Unit'], 0, '.',',') ?></td>
                                                                <td align="right" class="sbold"><?= number_format($report[$i]['Amount'], 0, '.',',') ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                            <tr>
                                                                <td class="text-right bold" colspan="9">Grand Total :</td>
                                                                <td align="right" class="bold">0</td>
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
<?php $this->load->view('header_footer/finance_corp/footer_sub_modul_sf'); ?>