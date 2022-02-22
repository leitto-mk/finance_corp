<?php $this->load->view('header_footer/header_sub_modul_sf_no_trees'); ?>
<div class="portlet light" style="background-color: #eff2f6;" id="printDiv">
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
            font-size: 11px;
        }

        .table td h6 {
            margin-top: -1px;
            margin-bottom: -1px;
            font-size: 11px;
        }
    </style>
    <div class="row">
        <div class="col-md-12" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="portlet bordered light bg-white">
                        <div class="row">
                            <div class="caption">
                                <span class="caption-subject uppercase font-dark">
                                    <div class="input-group input-large pull-right" style="margin-top: -5px;">
                                        <span class="input-group-btn">
                                            <a href="#" class="btn btn-xs btn green hidden-print pull-right"  onclick="printDiv('printDiv')" style="margin-left: 5px">
                                                <i class="fa fa-plus"></i>&nbsp;Print</i>
                                            </a>
                                            <a onclick="window.close();" class="btn btn-xs btn red hidden-print pull-right"><i class="fa fa-close"></i> Close</a>
                                        </span>

                                    </div> 
                                </span>
                            </div>   
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding: 0px">
                                <img src="" class="img-responsive" alt="" width="50px">
                                    <address>
                                        <h6>
                                            <i class="fa fa-building"></i><strong>&nbsp;&nbsp;<?= ($ledger[0]['ComName'] ?? 'N/A') ?></strong>
                                            <br> <i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?= ($ledger[0]['Address'] ?? 'N/A') ?>
                                            <br> <i class="fa fa-phone"></i>&nbsp;&nbsp;<?= ($ledger[0]['Contact'] ?? 'N/A') ?>
                                            <br> <i class="fa fa-envelope"></i>&nbsp;&nbsp;<?= ($ledger[0]['Email'] ?? 'N/A') ?>
                                        </h6>
                                    </address>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right" style="margin-top: -20px; padding: 0px">
                                <p>
                                    <font size="4"><b>#General Ledger</b></font>
                                </p>
                                <address>
                                    <h5><b><i class="fa fa-calendar"></i> Period : <?= $date_start ?> - <?= $date_end ?></b></h5>                                       
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: -22px; padding: 0px">
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-stripped table-condensed">
                                            <thead>
                                                <tr class="font-dark bg-default">
                                                    <!-- <th class="text-center"> No </th> -->
                                                    <th width="6%"><h5 class="text-center bold">Trans Date</h5></th>
                                                    <th width="52%"><h5 class="text-center bold">Description</h5></th>
                                                    <th width="8%"><h5 class="text-center bold">Doc No</h5></th>
                                                    <th width="4%"><h5 class="text-center bold">Type</h5></th>
                                                    <!-- <th width="7%"><h5 class="text-center bold">Dept.</h5></th>
                                                    <th width="7%"><h5 class="text-center bold">Cost Center</h5></th> -->
                                                    <th width="4%"><h5 class="text-center bold">Account</h5></th>
                                                    <th width="3%"><h5 class="text-center bold">Cry</h5></th>
                                                    <th width="8%"><h5 class="text-right bold">Debit</h5></th>
                                                    <th width="8%"><h5 class="text-right bold">Credit</h5></th>
                                                    <th width="8%"><h5 class="text-right bold">Balance</h5></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $cur_acc = '';
                                                    $subtotal_credit = $subtotal_debit = 0;
                                                ?>
                                                <?php for($i = 0; $i < count($ledger); $i++) : ?>
                                                    <?php if($ledger[$i]['Acc_Name'] !== $cur_acc) : ?>
                                                        <tr style="background-color: #eff2f6c9">
                                                            <td colspan="11"><h6 class="font-dark bold"><!-- <?= $ledger[$i]['AccNo'] ?> --  --><?= $ledger[$i]['Acc_Name'] ?><!--  | <?= $ledger[$i]['Acc_Type']?> --></h6></td>
                                                        </tr>
                                                        <tr class="font-white sbold">
                                                            <td colspan="2"><h6 class="text-right font-dark bold">Beginning Balance</h6></td>
                                                            <td colspan="7"><h6 class="sbold uppercase font-green-meadow" style="float: right;"><?= number_format($ledger[$i]['beg_balance'], 0, ',', '.') ?></h6></td>
                                                        </tr>
                                                        <?php
                                                            // $no = 0;
                                                            $cur_acc = $ledger[$i]['Acc_Name'];
                                                        ?>
                                                    <?php endif; ?>
                                                    <?php if(date('Y-m-d', strtotime($ledger[$i]['TransDate'])) >= date('Y-m-d', strtotime($date_start))) : ?>
                                                        <tr>
                                                            <td><h6 class="text-center"><?= date('d-m-y', strtotime($ledger[$i]['TransDate'])) ?></h6></td>
                                                            <td><h6 class="text-left"><?= substr($ledger[$i]['Remarks'], 0,105) ?></h6></td>
                                                            <td><h6 class="text-left"><?= $ledger[$i]['DocNo'] ?></h6></td>
                                                            <td><h6 class="text-center"><?= $ledger[$i]['TransType'] ?></h6></td>
                                                            <!-- <td><h6 class="text-center bold"><?= $ledger[$i]['Department'] ?></h6></td>
                                                            <td><h6 class="text-center bold"><?= $ledger[$i]['CostCenter'] ?></h6></td> -->
                                                            <td><h6 class="text-center"><?= $ledger[$i]['AccNo'] ?></h6></td>
                                                            <td><h6 class="text-center"><?= $ledger[$i]['Currency'] ?></h6></td>
                                                            <td><h6 style="float: right"><?= number_format($ledger[$i]['Debit'], 0, ',', '.') ?></h6></td>
                                                            <td><h6 style="float: right"><?= number_format($ledger[$i]['Credit'], 0, ',', '.') ?></h6></td>
                                                            <td><h6 style="float: right"><?= number_format($ledger[$i]['BalanceBranch'], 0, ',', '.') ?></h6></td>
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
    </div>
</div>
<script type="text/javascript">
    window.onload = load_function;

    function load_function() {
        let url = new URLSearchParams(window.location.search)

        let date = url.get('date_start').split("-")
        let year = date[0]
        let month = +date[1]

        switch (month) {
            case 1:
                month = 'Jan'
                break;
            case 2:
                month = 'Feb'
                break;
            case 3:
                month = 'Mar'
                break;
            case 4:
                month = 'Apr'
                break;
            case 5:
                month = 'May'
                break;
            case 6:
                month = 'Jun'
                break;
            case 7:
                month = 'Jul'
                break;
            case 8:
                month = 'Aug'
                break;
            case 9:
                month = 'Sep'
                break;
            case 10:
                month = 'Oct'
                break;
            case 11:
                month = 'Nov'
                break;
            case 12:
                month = 'Dec'
                break;
        
            default:
                break;
        }

        date = `${month} ${year}`
        let branch = url.get('branch')

        document.title = `GL ${date} (${branch})`

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