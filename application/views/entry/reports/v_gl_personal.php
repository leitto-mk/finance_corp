<?php $this->load->view('header_footer/entry/header_sub_modul_sf_no_trees'); ?>
<div class="portlet light">
    <div class="row">
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="portlet bordered light bg-blue-dark">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-white"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Date : <?= "1-Jan-" . date('Y') ?> - <?= date('d-F-Y') ?>
                        <div class="input-group input-large pull-right" style="margin-top: -5px">
                           <!--  <input type="text" class="form-control" placeholder="Search for..." name="search_item" id="search_item">
                            <span class="input-group-btn">
                                <button  class="btn dark">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span> -->
                            <span class="input-group-btn">
                                <a href="#" class="btn btn-md btn green hidden-print pull-right"  onclick="printDiv('printDiv')" style="margin-left: 5px">
                                    <i class="fa fa-plus"></i>&nbsp;Print</i>
                                </a>
                                <a onclick="window.close();" class="btn btn-md btn red hidden-print pull-right"><i class="fa fa-close"></i>Close</a>
                            </span>

                        </div> 
                    </span>
                </div>   
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="7%"> Date </th>
                                    <th class="text-center" width="8%"> Doc No </th>
                                    <th class="text-center" width="13%"> Cheque/Giro </th>
                                    <th class="text-center" width="8%"> Branch </th>
                                    <th class="text-center" width="8%"> AccNo  </th>
                                    <th class="text-center" width="16%"> Remarks </th>
                                    <th class="text-right" width="10%"> Debit </th>
                                    <th class="text-right" width="10%"> Credit </th>
                                    <th class="text-right" width="13%"> Balance </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $cur_id = '';
                                    $subtotal_credit = $subtotal_debit = 0;
                                ?>
                                <?php for($i = 0; $i < count($ledger); $i++) : ?>
                                    <?php if($ledger[$i]['IDNumber'] !== $cur_id) : ?>
                                        <tr style="background-color: white">
                                            <td colspan="10" class="bold"><?= $ledger[$i]['IDNumber'] ?> - <?= $ledger[$i]['FullName'] ?></td>
                                        </tr>
                                        <?php
                                            $cur_id = $ledger[$i]['IDNumber'];
                                        ?>
                                    <?php endif; ?>

                                    <tr class="font-white sbold">
                                        <td class="bold" align="center"><?= $ledger[$i]['TransDate'] ?></td>
                                        <td class="bold" align="center"><?= $ledger[$i]['DocNo'] ?></td>
                                        <td class="bold" align="center"></td>
                                        <td class="bold" align="center"><?= $ledger[$i]['Branch'] ?></td>
                                        <td class="bold" align="right"><?= $ledger[$i]['AccNo'] ?></td>
                                        <td class="bold" align="center"><?= $ledger[$i]['Remarks'] ?></td>
                                        <td class="bold" align="right"><?= number_format($ledger[$i]['Debit'], 0, ',', '.') ?></td>
                                        <td class="bold" align="right"><?= number_format($ledger[$i]['Credit'], 0, ',', '.') ?></td>
                                        <td class="bold" align="right"><?= number_format($ledger[$i]['Balance'], 0, ',', '.') ?></td>
                                    </tr>

                                    <?php
                                        $subtotal_credit += $ledger[$i]['Credit'];
                                        $subtotal_debit += $ledger[$i]['Debit'];
                                    ?>

                                    <?php if(isset($ledger[$i+1]['IDNumber']) && $ledger[$i+1]['IDNumber'] !== $cur_id || $i == (count($ledger)-1)) : ?>
                                        <?php
                                            $subtotal_balance = $subtotal_debit - $subtotal_credit;
                                        ?>
                                        <tr class="font-white sbold">
                                            <td class="bold" align="right" colspan="7">Beginning Balance</td>
                                            <td class="sbold uppercase font-green-meadow" align="right" colspan="2" style="font-size: 1.25em"><?= number_format($ledger[$i]['beg_balance'], 0, ',', '.') ?></td>
                                        </tr>
                                        <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                            <td align="right" colspan="6">Total :</td>                                    
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
<?php $this->load->view('header_footer/entry/footer_sub_modul_sf'); ?>