<?php $this->load->view('financecorp/header_footer/header_sub_modul_sf_no_trees'); ?>
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

         .table td {
            margin-top: -1px;
            margin-bottom: -1px;
            font-size: 12px;
        }

    </style>
    <div class="row">
        <div class="col-lg-2 hidden-print">
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 pull-left hidden-print">
            <div class="portlet light form-horizontal bg-default">
                <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                    <div class="portlet-body form-horizontal hidden-print" style="margin-top: 20px">
                        <div>
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr class="bg-blue-dark font-white">
                                        <th width="5%"></th>
                                        <th width="70%"><h5 class="text-center bold">Branch / Site</h5></th>
                                        <th width="25%"><h5 class="text-center bold">Year</h5></th>
                                        <th width="5%"><h5 class="text-center bold">Action</h5></th>        
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
                                                        <?php foreach($branches as $br) :  ?>
                                                            <?php if($br->BranchCode == $branch) : ?>
                                                                <option value="<?= $br->BranchCode?>" selected><?= $br->BranchName ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $br->BranchCode?>"><?= $br->BranchName ?></option>
                                                            <?php endif; ?>
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
                                                            <?php if($i == $year) : ?>
                                                                <option value="<?= $i ?>" selected><?= $i ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $i ?>"><?= $i ?></option>
                                                            <?php endif; ?>
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
        <div class="col-md-12" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
            <!-- <php $date = date("d-M-Y") ?> -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-logo-space text-center" style="margin-top: 15px">
                    <div>
                        <font size="4" class="uppercase"><?= $company ?></font><br>
                        <font size="3" class="font-dark sbold uppercase">Income Statement Columnar</font><br>
                        <font size="3" class="font-dark sbold">
                            <i class="fa fa-calendar"></i> 
                                <span id="period">Periode : Jan-<?=$year?> --- Dec-<?=$year?></span>
                        </font>
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
                                <table class="table table-condensed">
                                    <thead>
                                        <tr class="font-dark bg-white">
                                            <th width="2%"></th>
                                            <th width="2%"></th>
                                            <th width="2%"></th>
                                            <th width="2%"></th>
                                            <th width="14%"></th>
                                            <th width="6%"><h5 class="text-center bold">Jan-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">Feb-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">Mar-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">Apr-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">May-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">Jun-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">Jul-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">Aug-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">Sep-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">Oct-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">Nov-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">Dec-<?= $year ?></h5></th>
                                            <th width="6%"><h5 class="text-center bold">Total</h5></th>
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- COA 40000 -->
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
                                                <tr class="font-yellow bold">
                                                    <td></td>
                                                    <td colspan="17"><?= $revenue[$i]['Acc_Name'] ?> - <?= $revenue[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($revenue[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison bold">
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
                                                    <td align="center" class="bold"><?= $revenue[$i]['Acc_No']?></td>
                                                    <td class="bold"><?= $revenue[$i]['Acc_Name'] ?></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Jan'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Feb'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Mar'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Apr'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['May'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Jun'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Jul'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Aug'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Sep'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Oct'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Nov'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Des'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($revenue[$i]['Yearly'], 2, '.', ',') ?></h6></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_rev_jan += (int) $revenue[$i]['Jan'];
                                                $cur_total_rev_feb += (int) $revenue[$i]['Feb'];
                                                $cur_total_rev_mar += (int) $revenue[$i]['Mar'];
                                                $cur_total_rev_apr += (int) $revenue[$i]['Apr'];
                                                $cur_total_rev_may += (int) $revenue[$i]['May'];
                                                $cur_total_rev_jun += (int) $revenue[$i]['Jun'];
                                                $cur_total_rev_jul += (int) $revenue[$i]['Jul'];
                                                $cur_total_rev_aug += (int) $revenue[$i]['Aug'];
                                                $cur_total_rev_sep += (int) $revenue[$i]['Sep'];
                                                $cur_total_rev_oct += (int) $revenue[$i]['Oct'];
                                                $cur_total_rev_nov += (int) $revenue[$i]['Nov'];
                                                $cur_total_rev_des += (int) $revenue[$i]['Des'];
                                                $cur_total_rev_year += (int) $revenue[$i]['Yearly'];
                                                $grand_total_rev_jan += (int) $revenue[$i]['Jan'];
                                                $grand_total_rev_feb += (int) $revenue[$i]['Feb'];
                                                $grand_total_rev_mar += (int) $revenue[$i]['Mar'];
                                                $grand_total_rev_apr += (int) $revenue[$i]['Apr'];
                                                $grand_total_rev_may += (int) $revenue[$i]['May'];
                                                $grand_total_rev_jun += (int) $revenue[$i]['Jun'];
                                                $grand_total_rev_jul += (int) $revenue[$i]['Jul'];
                                                $grand_total_rev_aug += (int) $revenue[$i]['Aug'];
                                                $grand_total_rev_sep += (int) $revenue[$i]['Sep'];
                                                $grand_total_rev_oct += (int) $revenue[$i]['Oct'];
                                                $grand_total_rev_nov += (int) $revenue[$i]['Nov'];
                                                $grand_total_rev_des += (int) $revenue[$i]['Des'];
                                                $grand_total_rev_year += (int) $revenue[$i]['Yearly'];
                                                $grand_total_rev_year += (int) $revenue[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($revenue)-1)) : ?>
                                                <?php if($revenue[$i+1]['TransGroup'] == 'H3' && $revenue[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h3?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                <?php elseif($revenue[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h3?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h2?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_rev_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($revenue) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h3?></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_jan , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_feb , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_mar , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_apr , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_may , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_jun , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_jul , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_aug , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_sep , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_oct , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_nov , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_des , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_rev_year, 2, '.', ',') ?></h6></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h2?></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_jan , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_feb , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_mar , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_apr , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_may , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_jun , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_jul , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_aug , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_sep , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_oct , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_nov , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_des , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_rev_year, 2, '.', ',') ?></h6></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <!--Grand Total Revenue -->
                                        <tr class="font-yellow-gold">
                                            <td colspan="5" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h1 ?></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_jan, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_feb, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_mar, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_apr, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_may, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_jun, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_jul, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_aug, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_sep, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_oct, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_nov, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_des, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_rev_year, 2, '.', ',') ?></h6></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>

                                        <!--COA 50000 -->
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
                                                <tr class="font-yellow bold">
                                                    <td></td>
                                                    <td colspan="17"><?= $operational[$i]['Acc_Name'] ?> - <?= $operational[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($operational[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison bold">
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
                                                    <td align="center" class="bold"><?= $operational[$i]['Acc_No']?></td>
                                                    <td class="bold"><?= $operational[$i]['Acc_Name'] ?></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Jan'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Feb'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Mar'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Apr'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['May'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Jun'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Jul'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Aug'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Sep'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Oct'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Nov'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Des'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($operational[$i]['Yearly'], 2, '.', ',') ?></h6></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_opr_jan += (int) $operational[$i]['Jan'];
                                                $cur_total_opr_feb += (int) $operational[$i]['Feb'];
                                                $cur_total_opr_mar += (int) $operational[$i]['Mar'];
                                                $cur_total_opr_apr += (int) $operational[$i]['Apr'];
                                                $cur_total_opr_may += (int) $operational[$i]['May'];
                                                $cur_total_opr_jun += (int) $operational[$i]['Jun'];
                                                $cur_total_opr_jul += (int) $operational[$i]['Jul'];
                                                $cur_total_opr_aug += (int) $operational[$i]['Aug'];
                                                $cur_total_opr_sep += (int) $operational[$i]['Sep'];
                                                $cur_total_opr_oct += (int) $operational[$i]['Oct'];
                                                $cur_total_opr_nov += (int) $operational[$i]['Nov'];
                                                $cur_total_opr_des += (int) $operational[$i]['Des'];
                                                $cur_total_opr_year += (int) $operational[$i]['Yearly'];
                                                $grand_total_opr_jan += (int) $operational[$i]['Jan'];
                                                $grand_total_opr_feb += (int) $operational[$i]['Feb'];
                                                $grand_total_opr_mar += (int) $operational[$i]['Mar'];
                                                $grand_total_opr_apr += (int) $operational[$i]['Apr'];
                                                $grand_total_opr_may += (int) $operational[$i]['May'];
                                                $grand_total_opr_jun += (int) $operational[$i]['Jun'];
                                                $grand_total_opr_jul += (int) $operational[$i]['Jul'];
                                                $grand_total_opr_aug += (int) $operational[$i]['Aug'];
                                                $grand_total_opr_sep += (int) $operational[$i]['Sep'];
                                                $grand_total_opr_oct += (int) $operational[$i]['Oct'];
                                                $grand_total_opr_nov += (int) $operational[$i]['Nov'];
                                                $grand_total_opr_des += (int) $operational[$i]['Des'];
                                                $grand_total_opr_year += (int) $operational[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($operational)-1)) : ?>
                                                <?php if($operational[$i+1]['TransGroup'] == 'H3' && $operational[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h3?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                <?php elseif($operational[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h3?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h2?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_opr_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($operational) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h3?></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_jan , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_feb , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_mar , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_apr , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_may , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_jun , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_jul , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_aug , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_sep , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_oct , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_nov , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_des , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_opr_year, 2, '.', ',') ?></h6></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h2?> </td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_jan , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_feb , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_mar , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_apr , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_may , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_jun , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_jul , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_aug , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_sep , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_oct , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_nov , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_des , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_opr_year, 2, '.', ',') ?></h6></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <!--Grand Operational -->
                                        <tr class="font-yellow-gold">
                                            <td colspan="5" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h1 ?></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_jan, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_feb, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_mar, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_apr, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_may, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_jun, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_jul, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_aug, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_sep, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_oct, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_nov, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_des, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_opr_year, 2, '.', ',') ?></h6></td>
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
                                            <td colspan="5" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Gross Profit / Loss</td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_jan, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_feb, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_mar, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_apr, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_may, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_jun, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_jul, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_aug, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_sep, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_oct, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_nov, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_des, 2, '.', ',')  ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($gross_gain_year, 2, '.', ',')  ?></h6></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>


                                        <!--COA 60000 -->
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
                                                <tr class="font-yellow bold">
                                                    <td></td>
                                                    <td colspan="17"><?= $other_revenue[$i]['Acc_Name'] ?> - <?= $other_revenue[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($other_revenue[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison bold">
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
                                                    <td align="center" class="bold"><?= $other_revenue[$i]['Acc_No']?></td>
                                                    <td class="bold"><?= $other_revenue[$i]['Acc_Name'] ?></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Jan'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Feb'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Mar'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Apr'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['May'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Jun'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Jul'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Aug'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Sep'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Oct'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Nov'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Des'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_revenue[$i]['Yearly'], 2, '.', ',') ?></h6></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_other_rev_jan += (int) $other_revenue[$i]['Jan'];
                                                $cur_total_other_rev_feb += (int) $other_revenue[$i]['Feb'];
                                                $cur_total_other_rev_mar += (int) $other_revenue[$i]['Mar'];
                                                $cur_total_other_rev_apr += (int) $other_revenue[$i]['Apr'];
                                                $cur_total_other_rev_may += (int) $other_revenue[$i]['May'];
                                                $cur_total_other_rev_jun += (int) $other_revenue[$i]['Jun'];
                                                $cur_total_other_rev_jul += (int) $other_revenue[$i]['Jul'];
                                                $cur_total_other_rev_aug += (int) $other_revenue[$i]['Aug'];
                                                $cur_total_other_rev_sep += (int) $other_revenue[$i]['Sep'];
                                                $cur_total_other_rev_oct += (int) $other_revenue[$i]['Oct'];
                                                $cur_total_other_rev_nov += (int) $other_revenue[$i]['Nov'];
                                                $cur_total_other_rev_des += (int) $other_revenue[$i]['Des'];
                                                $cur_total_other_rev_year += (int) $other_revenue[$i]['Yearly'];
                                                $grand_total_other_rev_jan += (int) $other_revenue[$i]['Jan'];
                                                $grand_total_other_rev_feb += (int) $other_revenue[$i]['Feb'];
                                                $grand_total_other_rev_mar += (int) $other_revenue[$i]['Mar'];
                                                $grand_total_other_rev_apr += (int) $other_revenue[$i]['Apr'];
                                                $grand_total_other_rev_may += (int) $other_revenue[$i]['May'];
                                                $grand_total_other_rev_jun += (int) $other_revenue[$i]['Jun'];
                                                $grand_total_other_rev_jul += (int) $other_revenue[$i]['Jul'];
                                                $grand_total_other_rev_aug += (int) $other_revenue[$i]['Aug'];
                                                $grand_total_other_rev_sep += (int) $other_revenue[$i]['Sep'];
                                                $grand_total_other_rev_oct += (int) $other_revenue[$i]['Oct'];
                                                $grand_total_other_rev_nov += (int) $other_revenue[$i]['Nov'];
                                                $grand_total_other_rev_des += (int) $other_revenue[$i]['Des'];
                                                $grand_total_other_rev_year += (int) $other_revenue[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($other_revenue)-1)) : ?>
                                                <?php if($other_revenue[$i+1]['TransGroup'] == 'H3' && $other_revenue[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h3?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                <?php elseif($other_revenue[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h3?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h2?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_rev_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($other_revenue) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h3?></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jan , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_feb , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_mar , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_apr , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_may , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jun , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_jul , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_aug , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_sep , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_oct , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_nov , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_des , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_rev_year, 2, '.', ',') ?></h6></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h2?></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_jan , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_feb , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_mar , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_apr , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_may , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_jun , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_jul , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_aug , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_sep , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_oct , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_nov , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_des , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_rev_year, 2, '.', ',') ?></h6></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <!--Grand Total Other Revenue -->
                                        <tr class="font-yellow-gold">
                                            <td colspan="5" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h1 ?></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_jan, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_feb, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_mar, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_apr, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_may, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_jun, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_jul, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_aug, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_sep, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_oct, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_nov, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_des, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_rev_year, 2, '.', ',') ?></h6></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>

                                        <!--Operating Profit -->
                                        <?php
                                            $opr_profit_jan = $gross_gain_jan - $grand_total_other_rev_jan;
                                            $opr_profit_feb = $gross_gain_feb - $grand_total_other_rev_feb;
                                            $opr_profit_mar = $gross_gain_mar - $grand_total_other_rev_mar;
                                            $opr_profit_apr = $gross_gain_apr - $grand_total_other_rev_apr;
                                            $opr_profit_may = $gross_gain_may - $grand_total_other_rev_may;
                                            $opr_profit_jun = $gross_gain_jun - $grand_total_other_rev_jun;
                                            $opr_profit_jul = $gross_gain_jul - $grand_total_other_rev_jul;
                                            $opr_profit_aug = $gross_gain_aug - $grand_total_other_rev_aug;
                                            $opr_profit_sep = $gross_gain_sep - $grand_total_other_rev_sep;
                                            $opr_profit_oct = $gross_gain_oct - $grand_total_other_rev_oct;
                                            $opr_profit_nov = $gross_gain_nov - $grand_total_other_rev_nov;
                                            $opr_profit_des = $gross_gain_des - $grand_total_other_rev_des;
                                            $opr_profit_year = $gross_gain_year - $grand_total_other_rev_year;
                                        ?>
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Operating Profit</td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_jan,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_feb,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_mar,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_apr,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_may,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_jun,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_jul,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_aug,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_sep,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_oct,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_nov,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_des,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_year,2,',','.') ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>

                                        <!--COA 70000 -->
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
                                                <tr class="font-yellow bold">
                                                    <td></td>
                                                    <td colspan="17"><?= $other_expenses[$i]['Acc_Name'] ?> - <?= $other_expenses[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($other_expenses[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison bold">
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
                                                    <td align="center" class="bold"><?= $other_expenses[$i]['Acc_No']?></td>
                                                    <td class="bold"><?= $other_expenses[$i]['Acc_Name'] ?></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Jan'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Feb'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Mar'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Apr'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['May'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Jun'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Jul'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Aug'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Sep'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Oct'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Nov'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Des'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_expenses[$i]['Yearly'], 2, '.', ',') ?></h6></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_other_exp_jan += (int) $other_expenses[$i]['Jan'];
                                                $cur_total_other_exp_feb += (int) $other_expenses[$i]['Feb'];
                                                $cur_total_other_exp_mar += (int) $other_expenses[$i]['Mar'];
                                                $cur_total_other_exp_apr += (int) $other_expenses[$i]['Apr'];
                                                $cur_total_other_exp_may += (int) $other_expenses[$i]['May'];
                                                $cur_total_other_exp_jun += (int) $other_expenses[$i]['Jun'];
                                                $cur_total_other_exp_jul += (int) $other_expenses[$i]['Jul'];
                                                $cur_total_other_exp_aug += (int) $other_expenses[$i]['Aug'];
                                                $cur_total_other_exp_sep += (int) $other_expenses[$i]['Sep'];
                                                $cur_total_other_exp_oct += (int) $other_expenses[$i]['Oct'];
                                                $cur_total_other_exp_nov += (int) $other_expenses[$i]['Nov'];
                                                $cur_total_other_exp_des += (int) $other_expenses[$i]['Des'];
                                                $cur_total_other_exp_year += (int) $other_expenses[$i]['Yearly'];
                                                $grand_total_other_exp_jan += (int) $other_expenses[$i]['Jan'];
                                                $grand_total_other_exp_feb += (int) $other_expenses[$i]['Feb'];
                                                $grand_total_other_exp_mar += (int) $other_expenses[$i]['Mar'];
                                                $grand_total_other_exp_apr += (int) $other_expenses[$i]['Apr'];
                                                $grand_total_other_exp_may += (int) $other_expenses[$i]['May'];
                                                $grand_total_other_exp_jun += (int) $other_expenses[$i]['Jun'];
                                                $grand_total_other_exp_jul += (int) $other_expenses[$i]['Jul'];
                                                $grand_total_other_exp_aug += (int) $other_expenses[$i]['Aug'];
                                                $grand_total_other_exp_sep += (int) $other_expenses[$i]['Sep'];
                                                $grand_total_other_exp_oct += (int) $other_expenses[$i]['Oct'];
                                                $grand_total_other_exp_nov += (int) $other_expenses[$i]['Nov'];
                                                $grand_total_other_exp_des += (int) $other_expenses[$i]['Des'];
                                                $grand_total_other_exp_year += (int) $other_expenses[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($other_expenses)-1)) : ?>
                                                <?php if($other_expenses[$i+1]['TransGroup'] == 'H3' && $other_expenses[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h3?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                <?php elseif($other_expenses[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h3?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h2?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_exp_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($other_expenses) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h3?></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jan , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_feb , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_mar , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_apr , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_may , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jun , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_jul , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_aug , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_sep , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_oct , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_nov , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_des , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_exp_year, 2, '.', ',') ?></h6></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h2?></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_jan , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_feb , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_mar , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_apr , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_may , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_jun , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_jul , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_aug , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_sep , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_oct , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_nov , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_des , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_exp_year, 2, '.', ',') ?></h6></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <!--Grand Total Other Expense -->
                                        <tr class="font-yellow-gold">
                                            <td colspan="5" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h1 ?></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_jan, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_feb, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_mar, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_apr, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_may, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_jun, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_jul, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_aug, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_sep, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_oct, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_nov, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_des, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_exp_year, 2, '.', ',') ?></h6></td>
                                        </tr>

                                        <!--COA 80000 -->
                                        <?php 
                                            $cur_total_other_operational_jan = 0;
                                            $cur_total_other_operational_feb = 0;
                                            $cur_total_other_operational_mar = 0;
                                            $cur_total_other_operational_apr = 0;
                                            $cur_total_other_operational_may = 0;
                                            $cur_total_other_operational_jun = 0;
                                            $cur_total_other_operational_jul = 0;
                                            $cur_total_other_operational_aug = 0;
                                            $cur_total_other_operational_sep = 0;
                                            $cur_total_other_operational_oct = 0;
                                            $cur_total_other_operational_nov = 0;
                                            $cur_total_other_operational_des = 0;
                                            $cur_total_other_operational_year = 0;
                                            $grand_total_other_operational_jan = 0;
                                            $grand_total_other_operational_feb = 0;
                                            $grand_total_other_operational_mar = 0;
                                            $grand_total_other_operational_apr = 0;
                                            $grand_total_other_operational_may = 0;
                                            $grand_total_other_operational_jun = 0;
                                            $grand_total_other_operational_jul = 0;
                                            $grand_total_other_operational_aug = 0;
                                            $grand_total_other_operational_sep = 0;
                                            $grand_total_other_operational_oct = 0;
                                            $grand_total_other_operational_nov = 0;
                                            $grand_total_other_operational_des = 0;
                                            $grand_total_other_operational_year = 0;
                                            $cur_header_other_operational_h1 = '';
                                            $cur_header_other_operational_h2 = '';
                                            $cur_header_other_operational_h3 = '';
                                        ?>
                                        <?php for($i = 0; $i < count($other_operational); $i++) : ?>
                                            <?php 
                                                $cur_header_other_operational_h1 = ($other_operational[$i]['TransGroup'] == 'H1' ? $other_operational[$i]['Acc_Name'] : $cur_header_other_operational_h1);
                                                $cur_header_other_operational_h2 = ($other_operational[$i]['TransGroup'] == 'H2' ? $other_operational[$i]['Acc_Name'] : $cur_header_other_operational_h2);
                                                $cur_header_other_operational_h3 = ($other_operational[$i]['TransGroup'] == 'H3' ? $other_operational[$i]['Acc_Name'] : $cur_header_other_operational_h3);
                                                if($i != 0){
                                                    if($other_operational[$i-1]['TransGroup'] !== $other_operational[$i]['TransGroup']) {
                                                        $cur_total_other_operational_jan = 0;
                                                        $cur_total_other_operational_feb = 0;
                                                        $cur_total_other_operational_mar = 0;
                                                        $cur_total_other_operational_apr = 0;
                                                        $cur_total_other_operational_may = 0;
                                                        $cur_total_other_operational_jun = 0;
                                                        $cur_total_other_operational_jul = 0;
                                                        $cur_total_other_operational_aug = 0;
                                                        $cur_total_other_operational_sep = 0;
                                                        $cur_total_other_operational_oct = 0;
                                                        $cur_total_other_operational_nov = 0;
                                                        $cur_total_other_operational_des = 0;
                                                        $cur_total_other_operational_year = 0;
                                                    }
                                                }
                                            ?>
                                            <?php if($other_operational[$i]['TransGroup'] == 'H1') : ?>
                                                <!--Header 1-->
                                                <tr>
                                                    <td class="uppercase bold" colspan="18" style="background-color: #5c9bd194;"><?= $other_operational[$i]['Acc_Name'] ?> - <?= $other_operational[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($other_operational[$i]['TransGroup'] == 'H2') : ?>
                                                <!--Header 2-->
                                                <tr class="font-yellow bold">
                                                    <td></td>
                                                    <td colspan="17"><?= $other_operational[$i]['Acc_Name'] ?> - <?= $other_operational[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($other_operational[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison bold">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="16"><?= $other_operational[$i]['Acc_Name'] ?> - <?= $other_operational[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php else : ?>
                                                <!--Data-->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center" class="bold"><?= $other_operational[$i]['Acc_No']?></td>
                                                    <td class="bold"><?= $other_operational[$i]['Acc_Name'] ?></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Jan'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Feb'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Mar'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Apr'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['May'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Jun'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Jul'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Aug'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Sep'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Oct'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Nov'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Des'], 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($other_operational[$i]['Yearly'], 2, '.', ',') ?></h6></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_other_operational_jan += (int) $other_operational[$i]['Jan'];
                                                $cur_total_other_operational_feb += (int) $other_operational[$i]['Feb'];
                                                $cur_total_other_operational_mar += (int) $other_operational[$i]['Mar'];
                                                $cur_total_other_operational_apr += (int) $other_operational[$i]['Apr'];
                                                $cur_total_other_operational_may += (int) $other_operational[$i]['May'];
                                                $cur_total_other_operational_jun += (int) $other_operational[$i]['Jun'];
                                                $cur_total_other_operational_jul += (int) $other_operational[$i]['Jul'];
                                                $cur_total_other_operational_aug += (int) $other_operational[$i]['Aug'];
                                                $cur_total_other_operational_sep += (int) $other_operational[$i]['Sep'];
                                                $cur_total_other_operational_oct += (int) $other_operational[$i]['Oct'];
                                                $cur_total_other_operational_nov += (int) $other_operational[$i]['Nov'];
                                                $cur_total_other_operational_des += (int) $other_operational[$i]['Des'];
                                                $cur_total_other_operational_year += (int) $other_operational[$i]['Yearly'];
                                                $grand_total_other_operational_jan += (int) $other_operational[$i]['Jan'];
                                                $grand_total_other_operational_feb += (int) $other_operational[$i]['Feb'];
                                                $grand_total_other_operational_mar += (int) $other_operational[$i]['Mar'];
                                                $grand_total_other_operational_apr += (int) $other_operational[$i]['Apr'];
                                                $grand_total_other_operational_may += (int) $other_operational[$i]['May'];
                                                $grand_total_other_operational_jun += (int) $other_operational[$i]['Jun'];
                                                $grand_total_other_operational_jul += (int) $other_operational[$i]['Jul'];
                                                $grand_total_other_operational_aug += (int) $other_operational[$i]['Aug'];
                                                $grand_total_other_operational_sep += (int) $other_operational[$i]['Sep'];
                                                $grand_total_other_operational_oct += (int) $other_operational[$i]['Oct'];
                                                $grand_total_other_operational_nov += (int) $other_operational[$i]['Nov'];
                                                $grand_total_other_operational_des += (int) $other_operational[$i]['Des'];
                                                $grand_total_other_operational_year += (int) $other_operational[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($other_operational)-1)) : ?>
                                                <?php if($other_operational[$i+1]['TransGroup'] == 'H3' && $other_operational[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_operational_h3?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                <?php elseif($other_operational[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_operational_h3?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_operational_h2?></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jan , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_feb , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_mar , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_apr , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_may , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jun , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jul , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_aug , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_sep , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_oct , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_nov , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_des , 2, '.', ',') ?></h6></td>
                                                        <td><h6 style="float: right"><?= number_format($cur_total_other_operational_year, 2, '.', ',') ?></h6></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($other_operational) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_operational_h3?></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jan , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_feb , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_mar , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_apr , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_may , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jun , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_jul , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_aug , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_sep , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_oct , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_nov , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_des , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($cur_total_other_operational_year, 2, '.', ',') ?></h6></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_operational_h2?></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_jan , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_feb , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_mar , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_apr , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_may , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_jun , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_jul , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_aug , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_sep , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_oct , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_nov , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_des , 2, '.', ',') ?></h6></td>
                                                    <td><h6 style="float: right"><?= number_format($grand_total_other_operational_year, 2, '.', ',') ?></h6></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <!--Grand Total Other Expense -->
                                        <tr class="font-yellow-gold">
                                            <td colspan="5" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_operational_h1 ?></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_jan, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_feb, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_mar, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_apr, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_may, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_jun, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_jul, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_aug, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_sep, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_oct, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_nov, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_des, 2, '.', ',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($grand_total_other_operational_year, 2, '.', ',') ?></h6></td>
                                        </tr>
                                        
                                        <?php
                                            $other_gain_jan = $grand_total_other_operational_jan - $grand_total_other_operational_jan;
                                            $other_gain_feb = $grand_total_other_operational_feb - $grand_total_other_operational_feb;
                                            $other_gain_mar = $grand_total_other_operational_mar - $grand_total_other_operational_mar;
                                            $other_gain_apr = $grand_total_other_operational_apr - $grand_total_other_operational_apr;
                                            $other_gain_may = $grand_total_other_operational_may - $grand_total_other_operational_may;
                                            $other_gain_jun = $grand_total_other_operational_jun - $grand_total_other_operational_jun;
                                            $other_gain_jul = $grand_total_other_operational_jul - $grand_total_other_operational_jul;
                                            $other_gain_aug = $grand_total_other_operational_aug - $grand_total_other_operational_aug;
                                            $other_gain_sep = $grand_total_other_operational_sep - $grand_total_other_operational_sep;
                                            $other_gain_oct = $grand_total_other_operational_oct - $grand_total_other_operational_oct;
                                            $other_gain_nov = $grand_total_other_operational_nov - $grand_total_other_operational_nov;
                                            $other_gain_des = $grand_total_other_operational_des - $grand_total_other_operational_des;
                                            $other_gain_year = $grand_total_other_operational_year - $grand_total_other_operational_year;
                                        ?>
                                        <tr class="font-yellow">
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>
                                        <tr class="font-yellow-gold">
                                            <td colspan="5" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_exp_h1 ?> & <?= $cur_header_other_operational_h1 ?></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_jan, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_feb, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_mar, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_apr, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_may, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_jun, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_jul, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_aug, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_sep, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_oct, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_nov, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_des, 2, '.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($other_gain_year, 2, '.',',') ?></h6></td>
                                        </tr>


                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>


                                        <!--Net Profit / Loss-->
                                        <!--Formula bisa dapat Net Profit / Loss = Total Gross Profit - (Total Other Revenue - Other Expense)-->
                                        <?php
                                            $net_gain_jan = $gross_gain_jan - $other_gain_jan;
                                            $net_gain_feb = $gross_gain_feb - $other_gain_feb;
                                            $net_gain_mar = $gross_gain_mar - $other_gain_mar;
                                            $net_gain_apr = $gross_gain_apr - $other_gain_apr;
                                            $net_gain_may = $gross_gain_may - $other_gain_may;
                                            $net_gain_jun = $gross_gain_jun - $other_gain_jun;
                                            $net_gain_jul = $gross_gain_jul - $other_gain_jul;
                                            $net_gain_aug = $gross_gain_aug - $other_gain_aug;
                                            $net_gain_sep = $gross_gain_sep - $other_gain_sep;
                                            $net_gain_oct = $gross_gain_oct - $other_gain_oct;
                                            $net_gain_nov = $gross_gain_nov - $other_gain_nov;
                                            $net_gain_des = $gross_gain_des - $other_gain_des;
                                            $net_gain_year = $gross_gain_year - $other_gain_year;
                                        ?>
                                        <tr class="font-yellow-gold">
                                            <td colspan="5" class="bold">&nbsp;&nbsp;&nbsp;&nbsp;Net Profit / Loss</td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_jan, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_feb, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_mar, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_apr, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_may, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_jun, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_jul, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_aug, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_sep, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_oct, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_nov, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_des, 2,'.',',') ?></h6></td>
                                            <td><h6 style="float: right"><?= number_format($net_gain_year, 2,'.',',') ?></h6></td>
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
    

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php $this->load->view('financecorp/header_footer/footer_sub_modul_sf'); ?>