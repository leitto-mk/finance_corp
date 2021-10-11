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
                        <h1><?= $company ?></font>
                        <h3><?= date('d M Y')?></h3>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <tbody class="bold">
                                                <?php 
                                                    $cur_total_asset = 0;
                                                    $grand_total_asset = 0;
                                                    $cur_header_asset_h1 = '';
                                                    $cur_header_asset_h2 = '';
                                                    $cur_header_asset_h3 = '';
                                                    $total_left_rows = 0;
                                                ?>
                                                <?php for($i = 0; $i < count($asset); $i++) : ?>
                                                    <?php 
                                                        $cur_header_asset_h1 = ($asset[$i]['TransGroup'] == 'H1' ? $asset[$i]['Acc_Name'] : $cur_header_asset_h1);
                                                        $cur_header_asset_h2 = ($asset[$i]['TransGroup'] == 'H2' ? $asset[$i]['Acc_Name'] : $cur_header_asset_h2);
                                                        $cur_header_asset_h3 = ($asset[$i]['TransGroup'] == 'H3' ? $asset[$i]['Acc_Name'] : $cur_header_asset_h3);
                                                        if($i != 0){
                                                            if($asset[$i-1]['TransGroup'] !== $asset[$i]['TransGroup']) {
                                                                $cur_total_asset = 0;
                                                            }
                                                        }
                                                    ?>
                                                    <tr class="font-dark bg-white">
                                                        <?php if($asset[$i]['TransGroup'] == 'H1') : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%"><?= $asset[$i]['Acc_Name'] ?> - <?= $asset[$i]['Acc_No']?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"></td>
                                                        <?php elseif($asset[$i]['TransGroup'] == 'H2') : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $asset[$i]['Acc_Name'] ?> - <?= $asset[$i]['Acc_No']?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"></td>
                                                        <?php elseif($asset[$i]['TransGroup'] == 'H3') : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $asset[$i]['Acc_Name'] ?> - <?= $asset[$i]['Acc_No']?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"></td>
                                                        <?php else : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $asset[$i]['Acc_No']?> - <?= $asset[$i]['Acc_Name'] ?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"><?= ($asset[$i]['Amount'] == 0 ? '-' : number_format($asset[$i]['Amount'], 2, ',','.')) ?>&nbsp;</td>
                                                        <?php endif; ?>
                                                        <?php
                                                            $cur_total_asset += $asset[$i]['Amount'];
                                                            $grand_total_asset += $asset[$i]['Amount'];
                                                            $total_left_rows += 1;
                                                        ?>
                                                    </tr>
                                                    <?php if($i < (count($asset)-1)) : ?>
                                                        <?php if($asset[$i+1]['TransGroup'] == 'H3' && $asset[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                            <tr>
                                                                <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_asset_h3 ?> </td>
                                                                <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_asset == 0 ? '-' : number_format($cur_total_asset, 2, ',','.')) ?></td>
                                                            </tr>
                                                        <?php elseif($asset[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                            <tr>
                                                                <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_asset_h3 ?> </td>
                                                                <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_asset == 0 ? '-' : number_format($cur_total_asset, 2, ',','.')) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_asset_h2 ?> </td>
                                                                <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($grand_total_asset == 0 ? '-' : number_format($grand_total_asset, 2, ',','.')) ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php elseif($i < count($asset) && $i != 0) : ?>
                                                        <tr>
                                                            <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_asset_h3 ?> </td>
                                                            <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_asset == 0 ? '-' : number_format($cur_total_asset, 2, ',','.')) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_asset_h2 ?> </td>
                                                            <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_asset == 0 ? '-' : number_format($cur_total_asset, 2, ',','.')) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endfor; ?>                                   
                                                <tr>
                                                    <td style="padding:5px;border-top:none;" class="sbold" width="75%">Total <?= $asset[0]['Acc_Name']?> </td>
                                                    <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($grand_total_asset == 0 ? '-' : number_format($grand_total_asset, 2, ',','.')) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <tbody class="bold">
                                                <?php 
                                                    $cur_total_liabilities = 0;
                                                    $grand_total_liabilities = 0;
                                                    $cur_header_liabilities_h1 = '';
                                                    $cur_header_liabilities_h2 = '';
                                                    $cur_header_liabilities_h3 = '';
                                                    $total_right_rows = 0;
                                                ?>
                                                <?php for($i = 0; $i < count($liabilities); $i++) : ?>
                                                    <?php 
                                                        $cur_header_liabilities_h1 = ($liabilities[$i]['TransGroup'] == 'H1' ? $liabilities[$i]['Acc_Name'] : $cur_header_liabilities_h1);
                                                        $cur_header_liabilities_h2 = ($liabilities[$i]['TransGroup'] == 'H2' ? $liabilities[$i]['Acc_Name'] : $cur_header_liabilities_h2);
                                                        $cur_header_liabilities_h3 = ($liabilities[$i]['TransGroup'] == 'H3' ? $liabilities[$i]['Acc_Name'] : $cur_header_liabilities_h3);
                                                        if($i != 0){
                                                            if($liabilities[$i-1]['TransGroup'] !== $liabilities[$i]['TransGroup']) {
                                                                $cur_total_liabilities = 0;
                                                            }
                                                        }
                                                    ?>
                                                    <tr class="font-dark bg-white">
                                                        <?php if($liabilities[$i]['TransGroup'] == 'H1') : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%"><?= $liabilities[$i]['Acc_Name'] ?> - <?= $liabilities[$i]['Acc_No']?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"></td>
                                                        <?php elseif($liabilities[$i]['TransGroup'] == 'H2') : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $liabilities[$i]['Acc_Name'] ?> - <?= $liabilities[$i]['Acc_No']?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"></td>
                                                        <?php elseif($liabilities[$i]['TransGroup'] == 'H3') : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $liabilities[$i]['Acc_Name'] ?> - <?= $liabilities[$i]['Acc_No']?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"></td>
                                                        <?php else : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $liabilities[$i]['Acc_No']?> - <?= $liabilities[$i]['Acc_Name'] ?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"><?= ($liabilities[$i]['Amount'] == 0 ? '-' : number_format($liabilities[$i]['Amount'], 2, ',','.')) ?>&nbsp;</td>
                                                        <?php endif; ?>
                                                        <?php
                                                            $cur_total_liabilities += $liabilities[$i]['Amount'];
                                                            $grand_total_liabilities += $liabilities[$i]['Amount'];
                                                            $total_right_rows += 1;
                                                        ?>
                                                    </tr>
                                                    <?php if($i < (count($liabilities)-1)) : ?>
                                                        <?php if($liabilities[$i+1]['TransGroup'] == 'H3' && $liabilities[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                            <tr>
                                                                <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_liabilities_h3 ?> </td>
                                                                <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_liabilities == 0 ? '-' : number_format($cur_total_liabilities, 2, ',','.')) ?></td>
                                                            </tr>
                                                        <?php elseif($liabilities[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                            <tr>
                                                                <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_liabilities_h3 ?> </td>
                                                                <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_liabilities == 0 ? '-' : number_format($cur_total_liabilities, 2, ',','.')) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_liabilities_h2 ?> </td>
                                                                <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($grand_total_liabilities == 0 ? '-' : number_format($grand_total_liabilities, 2, ',','.')) ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php elseif($i < count($liabilities) && $i != 0) : ?>
                                                        <tr>
                                                            <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_liabilities_h3 ?> </td>
                                                            <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_liabilities == 0 ? '-' : number_format($cur_total_liabilities, 2, ',','.')) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_liabilities_h2 ?> </td>
                                                            <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_liabilities == 0 ? '-' : number_format($cur_total_liabilities, 2, ',','.')) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endfor; ?>                                   
                                                <tr>
                                                    <td style="padding:5px;border-top:none;" class="sbold" width="75%">Total <?= $liabilities[0]['Acc_Name']?> </td>
                                                    <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($grand_total_liabilities == 0 ? '-' : number_format($grand_total_liabilities, 2, ',','.')) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-hover">
                                            <tbody class="bold">
                                                <?php 
                                                    $cur_total_capital = 0;
                                                    $grand_total_capital = 0;
                                                    $cur_header_capital_h1 = '';
                                                    $cur_header_capital_h2 = '';
                                                    $cur_header_capital_h3 = '';
                                                ?>
                                                <?php for($i = 0; $i < count($capital); $i++) : ?>
                                                    <?php 
                                                        $cur_header_capital_h1 = ($capital[$i]['TransGroup'] == 'H1' ? $capital[$i]['Acc_Name'] : $cur_header_capital_h1);
                                                        $cur_header_capital_h2 = ($capital[$i]['TransGroup'] == 'H2' ? $capital[$i]['Acc_Name'] : $cur_header_capital_h2);
                                                        $cur_header_capital_h3 = ($capital[$i]['TransGroup'] == 'H3' ? $capital[$i]['Acc_Name'] : $cur_header_capital_h3);
                                                        if($i != 0){
                                                            if($capital[$i-1]['TransGroup'] !== $capital[$i]['TransGroup']) {
                                                                $cur_total_capital = 0;
                                                            }
                                                        }
                                                    ?>
                                                    <tr class="font-dark bg-white">
                                                        <?php if($capital[$i]['TransGroup'] == 'H1') : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%"><?= $capital[$i]['Acc_Name'] ?> - <?= $capital[$i]['Acc_No']?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"></td>
                                                        <?php elseif($capital[$i]['TransGroup'] == 'H2') : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $capital[$i]['Acc_Name'] ?> - <?= $capital[$i]['Acc_No']?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"></td>
                                                        <?php elseif($capital[$i]['TransGroup'] == 'H3') : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $capital[$i]['Acc_Name'] ?> - <?= $capital[$i]['Acc_No']?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"></td>
                                                        <?php else : ?>
                                                            <td style="padding:0px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $capital[$i]['Acc_No']?> - <?= $capital[$i]['Acc_Name'] ?></td>
                                                            <td style="padding:0px;border-top:none;" class="text-right" width="25%"><?= ($capital[$i]['Amount'] == 0 ? '-' : number_format($capital[$i]['Amount'], 2, ',','.')) ?>&nbsp;</td>
                                                        <?php endif; ?>
                                                        <?php
                                                            $cur_total_capital += $capital[$i]['Amount'];
                                                            $grand_total_capital += $capital[$i]['Amount'];
                                                            $total_right_rows += 1;
                                                        ?>
                                                    </tr>
                                                    <?php if($i < (count($capital)-1)) : ?>
                                                        <?php if($capital[$i+1]['TransGroup'] == 'H3' && $capital[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                            <tr>
                                                                <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_capital_h3 ?> </td>
                                                                <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_capital == 0 ? '-' : number_format($cur_total_capital, 2, ',','.')) ?></td>
                                                            </tr>
                                                        <?php elseif($capital[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                            <tr>
                                                                <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_capital_h3 ?> </td>
                                                                <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_capital == 0 ? '-' : number_format($cur_total_capital, 2, ',','.')) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_capital_h2 ?> </td>
                                                                <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($grand_total_capital == 0 ? '-' : number_format($grand_total_capital, 2, ',','.')) ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php elseif($i < count($capital) && $i != 0) : ?>
                                                        <tr>
                                                            <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_capital_h3 ?> </td>
                                                            <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_capital == 0 ? '-' : number_format($cur_total_capital, 2, ',','.')) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:5px;border-top:none;" class="sbold" width="75%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_capital_h2 ?> </td>
                                                            <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($cur_total_capital == 0 ? '-' : number_format($cur_total_capital, 2, ',','.')) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endfor; ?>                                   
                                                <tr>
                                                    <td style="padding:5px;border-top:none;" class="sbold" width="75%">Total <?= $capital[0]['Acc_Name']?> </td>
                                                    <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($grand_total_capital == 0 ? '-' : number_format($grand_total_capital, 2, ',','.')) ?></td>
                                                </tr>
                                                <?php for($i = 0; $i < ($total_left_rows - $total_right_rows+4); $i++) : ?>
                                                    <tr class="font-dark bg-white">
                                                        <td style="padding:5px;border-top:none;"></td>
                                                        <td style="padding:5px;border-top:none;"></td>
                                                    </tr>
                                                <?php endfor; ?>
                                                <?php $grand_total_liabilities_capital = $grand_total_liabilities + $grand_total_capital; ?>
                                                <tr>
                                                    <td style="padding:5px;border-top:none;" class="sbold" width="75%">Total Liability & Capital </td>
                                                    <td style="padding:5px;border-top:none;border-top: 1px solid #2F353B;" class="text-right" width="25%"><?= ($grand_total_liabilities_capital == 0 ? '-' : number_format($grand_total_liabilities_capital, 2, ',','.')) ?></td>
                                                </tr>
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