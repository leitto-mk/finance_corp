<?php $this->load->view('header_footer/header_sub_modul_sf_no_trees'); ?>
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
        <div class="col-lg-2 hidden-print">
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 pull-left hidden-print">
            <div class="portlet light form-horizontal bg-default">
                <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                    <div class="portlet-body form-horizontal hidden-print" style="margin-top: 20px">
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-blue-dark font-white">
                                        <th width="5%"></th>
                                        <th class="text-center" width="70%">Branch / Site</th>
                                        <th class="text-center" width="25%">Year</th>
                                        <th class="text-center" width="5%">Action</th>        
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
                                                        <option value="">--Select Branch--</option>
                                                        <?php foreach($branch as $br) :  ?>
                                                            <option value="<?= $br->BranchCode?>"><?= $br->BranchName ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <select id="year" name="year" class="form-control" required>
                                                        <option value="">--Select Year--</option>
                                                        <?php for($i = date('Y'); $i >= 2000; $i--) : ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group text-center">
                                                <div class="col-md-12">
                                                    <a href="#" class="btn btn-sm btn-success" id="submit_filter">
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
        <div class="col-lg-2 hidden-print">
        </div>
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
            <!-- <php $date = date("d-M-Y") ?> -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-logo-space text-center" style="margin-top: 15px">
                    <div>
                        <font size="6" class="uppercase">Company Name</font><br>
                        <font size="4" class="font-dark sbold uppercase">Income Statement Columnar</font><br>

                        <?php
                            $year = (isset($_GET['year']) ? $_GET['year'] : date('Y'));
                            $month = (isset($_GET['month']) ? date('F', mktime(0, 0, 0, (int)$_GET['month'], 10)) : date('F'));
                        ?>
                        <font size="4" class="font-dark sbold">January 2021 - December 2021</font><br>
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
                                        <tr class="font-dark bg-white">
                                            <th width="2%"></th>
                                            <th width="2%"></th>
                                            <th width="2%"></th>
                                            <th width="2%"></th>
                                            <th width="14%"></th>
                                            <th width="6%" class="text-center">Jan-<?= $year ?></th>
                                            <th width="6%" class="text-center">Feb-<?= $year ?></th>
                                            <th width="6%" class="text-center">Mar-<?= $year ?></th>
                                            <th width="6%" class="text-center">Apr-<?= $year ?></th>
                                            <th width="6%" class="text-center">May-<?= $year ?></th>
                                            <th width="6%" class="text-center">Jun-<?= $year ?></th>
                                            <th width="6%" class="text-center">Jul-<?= $year ?></th>
                                            <th width="6%" class="text-center">Aug-<?= $year ?></th>
                                            <th width="6%" class="text-center">Sep-<?= $year ?></th>
                                            <th width="6%" class="text-center">Oct-<?= $year ?></th>
                                            <th width="6%" class="text-center">Nov-<?= $year ?></th>
                                            <th width="6%" class="text-center">Dec-<?= $year ?></th>
                                            <th width="6%" class="text-center">Total</th>
                                    
                                        </tr>
                                    </thead>
                                    <tbody class="bold">
                                        <!--Revenue-->
                                        <?php 
                                            $cur_total_rev_jan = 0;
                                            $cur_total_rev_feb = 0;
                                            $cur_total_rev_mar = 0;
                                            $cur_total_rev_apr = 0;
                                            $cur_total_rev_may = 0;
                                            $cur_total_rev_jun = 0;
                                            $cur_total_rev_jul = 0;
                                            $cur_total_rev_aug = 0;
                                            $cur_total_rev_sep = 0;
                                            $cur_total_rev_oct = 0;
                                            $cur_total_rev_nov = 0;
                                            $cur_total_rev_des = 0;
                                            $cur_total_rev_year = 0;
                                            $grand_total_rev_jan = 0;
                                            $grand_total_rev_feb = 0;
                                            $grand_total_rev_mar = 0;
                                            $grand_total_rev_apr = 0;
                                            $grand_total_rev_may = 0;
                                            $grand_total_rev_jun = 0;
                                            $grand_total_rev_jul = 0;
                                            $grand_total_rev_aug = 0;
                                            $grand_total_rev_sep = 0;
                                            $grand_total_rev_oct = 0;
                                            $grand_total_rev_nov = 0;
                                            $grand_total_rev_des = 0;
                                            $grand_total_rev_year = 0;
                                            $cur_header_rev_h1 = '';
                                            $cur_header_rev_h2 = '';
                                            $cur_header_rev_h3 = '';
                                        ?>
                                        <?php for($i = 0; $i < count($revenue); $i++) : ?>
                                            <?php 
                                                $cur_header_rev_h1 = ($revenue[$i]['TransGroup'] == 'H1' ? $revenue[$i]['Acc_Name'] : $cur_header_rev_h1);
                                                $cur_header_rev_h2 = ($revenue[$i]['TransGroup'] == 'H2' ? $revenue[$i]['Acc_Name'] : $cur_header_rev_h2);
                                                $cur_header_rev_h3 = ($revenue[$i]['TransGroup'] == 'H3' ? $revenue[$i]['Acc_Name'] : $cur_header_rev_h3);
                                                if($i != 0){
                                                    if($revenue[$i-1]['TransGroup'] !== $revenue[$i]['TransGroup']) {
                                                        $cur_total_rev_jan = 0;
                                                        $cur_total_rev_feb = 0;
                                                        $cur_total_rev_mar = 0;
                                                        $cur_total_rev_apr = 0;
                                                        $cur_total_rev_may = 0;
                                                        $cur_total_rev_jun = 0;
                                                        $cur_total_rev_jul = 0;
                                                        $cur_total_rev_aug = 0;
                                                        $cur_total_rev_sep = 0;
                                                        $cur_total_rev_oct = 0;
                                                        $cur_total_rev_nov = 0;
                                                        $cur_total_rev_des = 0;
                                                        $cur_total_rev_year = 0;
                                                    }
                                                }
                                            ?>
                                            <?php if($revenue[$i]['TransGroup'] == 'H1') : ?>
                                                <!--Header 1-->
                                                <tr>
                                                    <td class="uppercase bold" colspan="18" style="background-color: #5c9bd194;"><?= $revenue[$i]['Acc_Name'] ?> - <?= $revenue[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($revenue[$i]['TransGroup'] == 'H2') : ?>
                                                <!--Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="17"><?= $revenue[$i]['Acc_Name'] ?> - <?= $revenue[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($revenue[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="16"><?= $revenue[$i]['Acc_Name'] ?> - <?= $revenue[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php else : ?>
                                                <!--Data-->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center"><?= $revenue[$i]['Acc_No']?></td>
                                                    <td><?= $revenue[$i]['Acc_Name'] ?></td>
                                                    <td align="right"><?= $revenue[$i]['Jan']?></td>
                                                    <td align="right"><?= $revenue[$i]['Feb']?></td>
                                                    <td align="right"><?= $revenue[$i]['Mar']?></td>
                                                    <td align="right"><?= $revenue[$i]['Apr']?></td>
                                                    <td align="right"><?= $revenue[$i]['May']?></td>
                                                    <td align="right"><?= $revenue[$i]['Jun']?></td>
                                                    <td align="right"><?= $revenue[$i]['Jul']?></td>
                                                    <td align="right"><?= $revenue[$i]['Aug']?></td>
                                                    <td align="right"><?= $revenue[$i]['Sep']?></td>
                                                    <td align="right"><?= $revenue[$i]['Oct']?></td>
                                                    <td align="right"><?= $revenue[$i]['Nov']?></td>
                                                    <td align="right"><?= $revenue[$i]['Des']?></td>
                                                    <td align="right"><?= $revenue[$i]['Yearly']?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_rev_year += $revenue[$i]['Yearly'];
                                                $cur_total_rev_jan += $revenue[$i]['Jan'];
                                                $cur_total_rev_feb += $revenue[$i]['Feb'];
                                                $cur_total_rev_mar += $revenue[$i]['Mar'];
                                                $cur_total_rev_apr += $revenue[$i]['Apr'];
                                                $cur_total_rev_may += $revenue[$i]['May'];
                                                $cur_total_rev_jun += $revenue[$i]['Jun'];
                                                $cur_total_rev_jul += $revenue[$i]['Jul'];
                                                $cur_total_rev_aug += $revenue[$i]['Aug'];
                                                $cur_total_rev_sep += $revenue[$i]['Sep'];
                                                $cur_total_rev_oct += $revenue[$i]['Oct'];
                                                $cur_total_rev_nov += $revenue[$i]['Nov'];
                                                $cur_total_rev_des += $revenue[$i]['Des'];
                                                $grand_total_rev_year += $revenue[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($revenue)-1)) : ?>
                                                <?php if($revenue[$i+1]['TransGroup'] == 'H3' && $revenue[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                <?php elseif($revenue[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h2?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($revenue) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h3?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jan , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_feb , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_mar , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_apr , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_may , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jun , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jul , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_aug , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_sep , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_oct , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_nov , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_des , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_year, 2, '.', ',') ?></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h2?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jan , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_feb , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_mar , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_apr , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_may , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jun , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_jul , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_aug , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_sep , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_oct , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_nov , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_des , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_year, 2, '.', ',') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>                                   
                                        <!--Total Header 1-->
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h1 ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_jan, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_feb, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_mar, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_apr, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_may, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_jun, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_jul, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_aug, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_sep, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_oct, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_nov, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_des, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_year, 2, '.', ',') ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>

                                        <!--Operational-->
                                        <?php 
                                            $cur_total_opr_jan = 0;
                                            $cur_total_opr_feb = 0;
                                            $cur_total_opr_mar = 0;
                                            $cur_total_opr_apr = 0;
                                            $cur_total_opr_may = 0;
                                            $cur_total_opr_jun = 0;
                                            $cur_total_opr_jul = 0;
                                            $cur_total_opr_aug = 0;
                                            $cur_total_opr_sep = 0;
                                            $cur_total_opr_oct = 0;
                                            $cur_total_opr_nov = 0;
                                            $cur_total_opr_des = 0;
                                            $cur_total_opr_year = 0;
                                            $grand_total_opr_jan = 0;
                                            $grand_total_opr_feb = 0;
                                            $grand_total_opr_mar = 0;
                                            $grand_total_opr_apr = 0;
                                            $grand_total_opr_may = 0;
                                            $grand_total_opr_jun = 0;
                                            $grand_total_opr_jul = 0;
                                            $grand_total_opr_aug = 0;
                                            $grand_total_opr_sep = 0;
                                            $grand_total_opr_oct = 0;
                                            $grand_total_opr_nov = 0;
                                            $grand_total_opr_des = 0;
                                            $grand_total_opr_year = 0;
                                            $cur_header_opr_h1 = '';
                                            $cur_header_opr_h2 = '';
                                            $cur_header_opr_h3 = '';
                                        ?>
                                        <?php for($i = 0; $i < count($operational); $i++) : ?>
                                            <?php 
                                                $cur_header_opr_h1 = ($operational[$i]['TransGroup'] == 'H1' ? $operational[$i]['Acc_Name'] : $cur_header_opr_h1);
                                                $cur_header_opr_h2 = ($operational[$i]['TransGroup'] == 'H2' ? $operational[$i]['Acc_Name'] : $cur_header_opr_h2);
                                                $cur_header_opr_h3 = ($operational[$i]['TransGroup'] == 'H3' ? $operational[$i]['Acc_Name'] : $cur_header_opr_h3);
                                                if($i != 0){
                                                    if($operational[$i-1]['TransGroup'] !== $operational[$i]['TransGroup']) {
                                                        $cur_total_opr_jan = 0;
                                                        $cur_total_opr_feb = 0;
                                                        $cur_total_opr_mar = 0;
                                                        $cur_total_opr_apr = 0;
                                                        $cur_total_opr_may = 0;
                                                        $cur_total_opr_jun = 0;
                                                        $cur_total_opr_jul = 0;
                                                        $cur_total_opr_aug = 0;
                                                        $cur_total_opr_sep = 0;
                                                        $cur_total_opr_oct = 0;
                                                        $cur_total_opr_nov = 0;
                                                        $cur_total_opr_des = 0;
                                                        $cur_total_opr_year = 0;
                                                    }
                                                }
                                            ?>
                                            <?php if($operational[$i]['TransGroup'] == 'H1') : ?>
                                                <!--Header 1-->
                                                <tr>
                                                    <td class="uppercase bold" colspan="18" style="background-color: #5c9bd194;"><?= $operational[$i]['Acc_Name'] ?> - <?= $operational[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($operational[$i]['TransGroup'] == 'H2') : ?>
                                                <!--Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="17"><?= $operational[$i]['Acc_Name'] ?> - <?= $operational[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($operational[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="16"><?= $operational[$i]['Acc_Name'] ?> - <?= $operational[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php else : ?>
                                                <!--Data-->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center"><?= $operational[$i]['Acc_No']?></td>
                                                    <td><?= $operational[$i]['Acc_Name'] ?></td>
                                                    <td align="right"><?= $operational[$i]['Jan']?></td>
                                                    <td align="right"><?= $operational[$i]['Feb']?></td>
                                                    <td align="right"><?= $operational[$i]['Mar']?></td>
                                                    <td align="right"><?= $operational[$i]['Apr']?></td>
                                                    <td align="right"><?= $operational[$i]['May']?></td>
                                                    <td align="right"><?= $operational[$i]['Jun']?></td>
                                                    <td align="right"><?= $operational[$i]['Jul']?></td>
                                                    <td align="right"><?= $operational[$i]['Aug']?></td>
                                                    <td align="right"><?= $operational[$i]['Sep']?></td>
                                                    <td align="right"><?= $operational[$i]['Oct']?></td>
                                                    <td align="right"><?= $operational[$i]['Nov']?></td>
                                                    <td align="right"><?= $operational[$i]['Des']?></td>
                                                    <td align="right"><?= $operational[$i]['Yearly']?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_opr_year += $operational[$i]['Yearly'];
                                                $cur_total_opr_jan += $operational[$i]['Jan'];
                                                $cur_total_opr_feb += $operational[$i]['Feb'];
                                                $cur_total_opr_mar += $operational[$i]['Mar'];
                                                $cur_total_opr_apr += $operational[$i]['Apr'];
                                                $cur_total_opr_may += $operational[$i]['May'];
                                                $cur_total_opr_jun += $operational[$i]['Jun'];
                                                $cur_total_opr_jul += $operational[$i]['Jul'];
                                                $cur_total_opr_aug += $operational[$i]['Aug'];
                                                $cur_total_opr_sep += $operational[$i]['Sep'];
                                                $cur_total_opr_oct += $operational[$i]['Oct'];
                                                $cur_total_opr_nov += $operational[$i]['Nov'];
                                                $cur_total_opr_des += $operational[$i]['Des'];
                                                $grand_total_opr_year += $operational[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($operational)-1)) : ?>
                                                <?php if($operational[$i+1]['TransGroup'] == 'H3' && $operational[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                <?php elseif($operational[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h2?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($operational) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h3?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jan , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_feb , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_mar , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_apr , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_may , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jun , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jul , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_aug , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_sep , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_oct , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_nov , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_des , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_year, 2, '.', ',') ?></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h2?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jan , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_feb , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_mar , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_apr , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_may , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jun , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_jul , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_aug , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_sep , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_oct , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_nov , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_des , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_year, 2, '.', ',') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>                                   
                                        <!--Total Header 1-->
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h1 ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_jan, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_feb, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_mar, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_apr, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_may, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_jun, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_jul, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_aug, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_sep, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_oct, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_nov, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_des, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_year, 2, '.', ',') ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>

                                        <!--Gross Profit / Loss-->
                                        <!--Formula bisa dapat Gross Profit / Loss = Total Revenue - Total Expense (Total Operational Costs)-->
                                        <?php
                                            $gross_gain_jan = $grand_total_rev_jan - $grand_total_opr_jan;
                                            $gross_gain_feb = $grand_total_rev_feb - $grand_total_opr_feb;
                                            $gross_gain_mar = $grand_total_rev_mar - $grand_total_opr_mar;
                                            $gross_gain_apr = $grand_total_rev_apr - $grand_total_opr_apr;
                                            $gross_gain_may = $grand_total_rev_may - $grand_total_opr_may;
                                            $gross_gain_jun = $grand_total_rev_jun - $grand_total_opr_jun;
                                            $gross_gain_jul = $grand_total_rev_jul - $grand_total_opr_jul;
                                            $gross_gain_aug = $grand_total_rev_aug - $grand_total_opr_aug;
                                            $gross_gain_sep = $grand_total_rev_sep - $grand_total_opr_sep;
                                            $gross_gain_oct = $grand_total_rev_oct - $grand_total_opr_oct;
                                            $gross_gain_nov = $grand_total_rev_nov - $grand_total_opr_nov;
                                            $gross_gain_des = $grand_total_rev_des - $grand_total_opr_des;
                                            $gross_gain_year = $grand_total_rev_year - $grand_total_opr_year;
                                        ?>
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Gross Profit / Loss</td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_jan, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_feb, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_mar, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_apr, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_may, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_jun, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_jul, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_aug, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_sep, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_oct, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_nov, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_des, 2, '.', ',')  ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_year, 2, '.', ',')  ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>


                                        <!--Other Revenue-->
                                        <?php 
                                            $cur_total_other_rev_jan = 0;
                                            $cur_total_other_rev_feb = 0;
                                            $cur_total_other_rev_mar = 0;
                                            $cur_total_other_rev_apr = 0;
                                            $cur_total_other_rev_may = 0;
                                            $cur_total_other_rev_jun = 0;
                                            $cur_total_other_rev_jul = 0;
                                            $cur_total_other_rev_aug = 0;
                                            $cur_total_other_rev_sep = 0;
                                            $cur_total_other_rev_oct = 0;
                                            $cur_total_other_rev_nov = 0;
                                            $cur_total_other_rev_des = 0;
                                            $cur_total_other_rev_year = 0;
                                            $grand_total_other_rev_jan = 0;
                                            $grand_total_other_rev_feb = 0;
                                            $grand_total_other_rev_mar = 0;
                                            $grand_total_other_rev_apr = 0;
                                            $grand_total_other_rev_may = 0;
                                            $grand_total_other_rev_jun = 0;
                                            $grand_total_other_rev_jul = 0;
                                            $grand_total_other_rev_aug = 0;
                                            $grand_total_other_rev_sep = 0;
                                            $grand_total_other_rev_oct = 0;
                                            $grand_total_other_rev_nov = 0;
                                            $grand_total_other_rev_des = 0;
                                            $grand_total_other_rev_year = 0;
                                            $cur_header_other_rev_h1 = '';
                                            $cur_header_other_rev_h2 = '';
                                            $cur_header_other_rev_h3 = '';
                                        ?>
                                        <?php for($i = 0; $i < count($other_revenue); $i++) : ?>
                                            <?php 
                                                $cur_header_other_rev_h1 = ($other_revenue[$i]['TransGroup'] == 'H1' ? $other_revenue[$i]['Acc_Name'] : $cur_header_other_rev_h1);
                                                $cur_header_other_rev_h2 = ($other_revenue[$i]['TransGroup'] == 'H2' ? $other_revenue[$i]['Acc_Name'] : $cur_header_other_rev_h2);
                                                $cur_header_other_rev_h3 = ($other_revenue[$i]['TransGroup'] == 'H3' ? $other_revenue[$i]['Acc_Name'] : $cur_header_other_rev_h3);
                                                if($i != 0){
                                                    if($other_revenue[$i-1]['TransGroup'] !== $other_revenue[$i]['TransGroup']) {
                                                        $cur_total_other_rev_jan = 0;
                                                        $cur_total_other_rev_feb = 0;
                                                        $cur_total_other_rev_mar = 0;
                                                        $cur_total_other_rev_apr = 0;
                                                        $cur_total_other_rev_may = 0;
                                                        $cur_total_other_rev_jun = 0;
                                                        $cur_total_other_rev_jul = 0;
                                                        $cur_total_other_rev_aug = 0;
                                                        $cur_total_other_rev_sep = 0;
                                                        $cur_total_other_rev_oct = 0;
                                                        $cur_total_other_rev_nov = 0;
                                                        $cur_total_other_rev_des = 0;
                                                        $cur_total_other_rev_year = 0;
                                                    }
                                                }
                                            ?>
                                            <?php if($other_revenue[$i]['TransGroup'] == 'H1') : ?>
                                                <!--Header 1-->
                                                <tr>
                                                    <td class="uppercase bold" colspan="18" style="background-color: #5c9bd194;"><?= $other_revenue[$i]['Acc_Name'] ?> - <?= $other_revenue[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($other_revenue[$i]['TransGroup'] == 'H2') : ?>
                                                <!--Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="17"><?= $other_revenue[$i]['Acc_Name'] ?> - <?= $other_revenue[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($other_revenue[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="16"><?= $other_revenue[$i]['Acc_Name'] ?> - <?= $other_revenue[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php else : ?>
                                                <!--Data-->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center"><?= $other_revenue[$i]['Acc_No']?></td>
                                                    <td><?= $other_revenue[$i]['Acc_Name'] ?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Jan']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Feb']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Mar']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Apr']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['May']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Jun']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Jul']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Aug']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Sep']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Oct']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Nov']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Des']?></td>
                                                    <td align="right"><?= $other_revenue[$i]['Yearly']?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_other_rev_year += $other_revenue[$i]['Yearly'];
                                                $cur_total_other_rev_jan += $other_revenue[$i]['Jan'];
                                                $cur_total_other_rev_feb += $other_revenue[$i]['Feb'];
                                                $cur_total_other_rev_mar += $other_revenue[$i]['Mar'];
                                                $cur_total_other_rev_apr += $other_revenue[$i]['Apr'];
                                                $cur_total_other_rev_may += $other_revenue[$i]['May'];
                                                $cur_total_other_rev_jun += $other_revenue[$i]['Jun'];
                                                $cur_total_other_rev_jul += $other_revenue[$i]['Jul'];
                                                $cur_total_other_rev_aug += $other_revenue[$i]['Aug'];
                                                $cur_total_other_rev_sep += $other_revenue[$i]['Sep'];
                                                $cur_total_other_rev_oct += $other_revenue[$i]['Oct'];
                                                $cur_total_other_rev_nov += $other_revenue[$i]['Nov'];
                                                $cur_total_other_rev_des += $other_revenue[$i]['Des'];
                                                $grand_total_other_rev_year += $other_revenue[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($other_revenue)-1)) : ?>
                                                <?php if($other_revenue[$i+1]['TransGroup'] == 'H3' && $other_revenue[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                <?php elseif($other_revenue[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h2?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($other_revenue) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h3?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jan , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_feb , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_mar , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_apr , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_may , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jun , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jul , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_aug , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_sep , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_oct , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_nov , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_des , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_year, 2, '.', ',') ?></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h2?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jan , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_feb , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_mar , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_apr , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_may , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jun , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_jul , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_aug , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_sep , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_oct , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_nov , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_des , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_year, 2, '.', ',') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>                                   
                                        <!--Total Header 1-->
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h1 ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_jan, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_feb, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_mar, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_apr, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_may, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_jun, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_jul, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_aug, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_sep, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_oct, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_nov, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_des, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_year, 2, '.', ',') ?></td>
                                        </tr>


                                        <!--Other Expense-->
                                        <?php 
                                            $cur_total_other_exp_jan = 0;
                                            $cur_total_other_exp_feb = 0;
                                            $cur_total_other_exp_mar = 0;
                                            $cur_total_other_exp_apr = 0;
                                            $cur_total_other_exp_may = 0;
                                            $cur_total_other_exp_jun = 0;
                                            $cur_total_other_exp_jul = 0;
                                            $cur_total_other_exp_aug = 0;
                                            $cur_total_other_exp_sep = 0;
                                            $cur_total_other_exp_oct = 0;
                                            $cur_total_other_exp_nov = 0;
                                            $cur_total_other_exp_des = 0;
                                            $cur_total_other_exp_year = 0;
                                            $grand_total_other_exp_jan = 0;
                                            $grand_total_other_exp_feb = 0;
                                            $grand_total_other_exp_mar = 0;
                                            $grand_total_other_exp_apr = 0;
                                            $grand_total_other_exp_may = 0;
                                            $grand_total_other_exp_jun = 0;
                                            $grand_total_other_exp_jul = 0;
                                            $grand_total_other_exp_aug = 0;
                                            $grand_total_other_exp_sep = 0;
                                            $grand_total_other_exp_oct = 0;
                                            $grand_total_other_exp_nov = 0;
                                            $grand_total_other_exp_des = 0;
                                            $grand_total_other_exp_year = 0;
                                            $cur_header_other_exp_h1 = '';
                                            $cur_header_other_exp_h2 = '';
                                            $cur_header_other_exp_h3 = '';
                                        ?>
                                        <?php for($i = 0; $i < count($other_expenses); $i++) : ?>
                                            <?php 
                                                $cur_header_other_exp_h1 = ($other_expenses[$i]['TransGroup'] == 'H1' ? $other_expenses[$i]['Acc_Name'] : $cur_header_other_exp_h1);
                                                $cur_header_other_exp_h2 = ($other_expenses[$i]['TransGroup'] == 'H2' ? $other_expenses[$i]['Acc_Name'] : $cur_header_other_exp_h2);
                                                $cur_header_other_exp_h3 = ($other_expenses[$i]['TransGroup'] == 'H3' ? $other_expenses[$i]['Acc_Name'] : $cur_header_other_exp_h3);
                                                if($i != 0){
                                                    if($other_expenses[$i-1]['TransGroup'] !== $other_expenses[$i]['TransGroup']) {
                                                        $cur_total_other_exp_jan = 0;
                                                        $cur_total_other_exp_feb = 0;
                                                        $cur_total_other_exp_mar = 0;
                                                        $cur_total_other_exp_apr = 0;
                                                        $cur_total_other_exp_may = 0;
                                                        $cur_total_other_exp_jun = 0;
                                                        $cur_total_other_exp_jul = 0;
                                                        $cur_total_other_exp_aug = 0;
                                                        $cur_total_other_exp_sep = 0;
                                                        $cur_total_other_exp_oct = 0;
                                                        $cur_total_other_exp_nov = 0;
                                                        $cur_total_other_exp_des = 0;
                                                        $cur_total_other_exp_year = 0;
                                                    }
                                                }
                                            ?>
                                            <?php if($other_expenses[$i]['TransGroup'] == 'H1') : ?>
                                                <!--Header 1-->
                                                <tr>
                                                    <td class="uppercase bold" colspan="18" style="background-color: #5c9bd194;"><?= $other_expenses[$i]['Acc_Name'] ?> - <?= $other_expenses[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($other_expenses[$i]['TransGroup'] == 'H2') : ?>
                                                <!--Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="17"><?= $other_expenses[$i]['Acc_Name'] ?> - <?= $other_expenses[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($other_expenses[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="16"><?= $other_expenses[$i]['Acc_Name'] ?> - <?= $other_expenses[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php else : ?>
                                                <!--Data-->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center"><?= $other_expenses[$i]['Acc_No']?></td>
                                                    <td><?= $other_expenses[$i]['Acc_Name'] ?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Jan']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Feb']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Mar']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Apr']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['May']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Jun']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Jul']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Aug']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Sep']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Oct']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Nov']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Des']?></td>
                                                    <td align="right"><?= $other_expenses[$i]['Yearly']?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_other_exp_year += $other_expenses[$i]['Yearly'];
                                                $cur_total_other_exp_jan += $other_expenses[$i]['Jan'];
                                                $cur_total_other_exp_feb += $other_expenses[$i]['Feb'];
                                                $cur_total_other_exp_mar += $other_expenses[$i]['Mar'];
                                                $cur_total_other_exp_apr += $other_expenses[$i]['Apr'];
                                                $cur_total_other_exp_may += $other_expenses[$i]['May'];
                                                $cur_total_other_exp_jun += $other_expenses[$i]['Jun'];
                                                $cur_total_other_exp_jul += $other_expenses[$i]['Jul'];
                                                $cur_total_other_exp_aug += $other_expenses[$i]['Aug'];
                                                $cur_total_other_exp_sep += $other_expenses[$i]['Sep'];
                                                $cur_total_other_exp_oct += $other_expenses[$i]['Oct'];
                                                $cur_total_other_exp_nov += $other_expenses[$i]['Nov'];
                                                $cur_total_other_exp_des += $other_expenses[$i]['Des'];
                                                $grand_total_other_exp_year += $other_expenses[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($other_expenses)-1)) : ?>
                                                <?php if($other_expenses[$i+1]['TransGroup'] == 'H3' && $other_expenses[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                <?php elseif($other_expenses[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h2?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jan , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_feb , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_mar , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_apr , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_may , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jun , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jul , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_aug , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_sep , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_oct , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_nov , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_des , 2, '.', ',') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_year, 2, '.', ',') ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($other_expenses) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h3?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jan , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_feb , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_mar , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_apr , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_may , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jun , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jul , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_aug , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_sep , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_oct , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_nov , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_des , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_year, 2, '.', ',') ?></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h2?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jan , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_feb , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_mar , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_apr , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_may , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jun , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_jul , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_aug , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_sep , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_oct , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_nov , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_des , 2, '.', ',') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_exp_year, 2, '.', ',') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>                                   
                                        <!--Total Header 1-->
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h1 ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_jan, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_feb, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_mar, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_apr, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_may, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_jun, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_jul, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_aug, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_sep, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_oct, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_nov, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_des, 2, '.', ',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_exp_year, 2, '.', ',') ?></td>
                                        </tr>
                                        
                                        <?php
                                            $other_gain_jan = $grand_total_other_rev_jan - $grand_total_other_exp_jan;
                                            $other_gain_feb = $grand_total_other_rev_feb - $grand_total_other_exp_feb;
                                            $other_gain_mar = $grand_total_other_rev_mar - $grand_total_other_exp_mar;
                                            $other_gain_apr = $grand_total_other_rev_apr - $grand_total_other_exp_apr;
                                            $other_gain_may = $grand_total_other_rev_may - $grand_total_other_exp_may;
                                            $other_gain_jun = $grand_total_other_rev_jun - $grand_total_other_exp_jun;
                                            $other_gain_jul = $grand_total_other_rev_jul - $grand_total_other_exp_jul;
                                            $other_gain_aug = $grand_total_other_rev_aug - $grand_total_other_exp_aug;
                                            $other_gain_sep = $grand_total_other_rev_sep - $grand_total_other_exp_sep;
                                            $other_gain_oct = $grand_total_other_rev_oct - $grand_total_other_exp_oct;
                                            $other_gain_nov = $grand_total_other_rev_nov - $grand_total_other_exp_nov;
                                            $other_gain_des = $grand_total_other_rev_des - $grand_total_other_exp_des;
                                            $other_gain_year = $grand_total_other_rev_year - $grand_total_other_exp_year;
                                        ?>
                                        <tr class="font-yellow">
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h1 ?> & <?= $cur_header_other_exp_h1 ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_jan, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_feb, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_mar, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_apr, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_may, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_jun, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_jul, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_aug, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_sep, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_oct, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_nov, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_des, 2, '.',',') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_year, 2, '.',',') ?></td>
                                        </tr>


                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>


                                        <!--Net Profit / Loss-->
                                        <!--Formula bisa dapat Net Profit / Loss = Total Gross Profit + (Total Other Revenue - Other Expense)-->
                                        <?php
                                            $net_gain_jan = $gross_gain_jan + $other_gain_jan;
                                            $net_gain_feb = $gross_gain_feb + $other_gain_feb;
                                            $net_gain_mar = $gross_gain_mar + $other_gain_mar;
                                            $net_gain_apr = $gross_gain_apr + $other_gain_apr;
                                            $net_gain_may = $gross_gain_may + $other_gain_may;
                                            $net_gain_jun = $gross_gain_jun + $other_gain_jun;
                                            $net_gain_jul = $gross_gain_jul + $other_gain_jul;
                                            $net_gain_aug = $gross_gain_aug + $other_gain_aug;
                                            $net_gain_sep = $gross_gain_sep + $other_gain_sep;
                                            $net_gain_oct = $gross_gain_oct + $other_gain_oct;
                                            $net_gain_nov = $gross_gain_nov + $other_gain_nov;
                                            $net_gain_des = $gross_gain_des + $other_gain_des;
                                            $net_gain_year = $gross_gain_year + $other_gain_year;
                                        ?>
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Net Profit / Loss</td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_jan, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_feb, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_mar, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_apr, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_may, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_jun, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_jul, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_aug, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_sep, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_oct, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_nov, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_des, 2,'.',',') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_year, 2,'.',',') ?></td>
                                        </tr>
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