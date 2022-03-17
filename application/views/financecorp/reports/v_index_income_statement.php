<?php $this->load->view('financecorp/header_footer/header_sub_modul_sf_no_trees'); ?>
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
                                        <th class="text-center" width="40%">Branch / Site</th>
                                        <th class="text-center" width="25%">Year</th>
                                        <th class="text-center" width="25%">Month</th>
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
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <select id="month" name="month" class="form-control" required>
                                                        <option value="">--Select Month--</option>
                                                        <option value="01">January</option>
                                                        <option value="02">February</option>
                                                        <option value="03">March</option>
                                                        <option value="04">April</option>
                                                        <option value="05">May</option>
                                                        <option value="06">June</option>
                                                        <option value="07">July</option>
                                                        <option value="08">August</option>
                                                        <option value="09">September</option>
                                                        <option value="10">October</option>
                                                        <option value="11">November</option>
                                                        <option value="12">December</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group text-center">
                                                <div class="col-md-12">
                                                    <a href="<?= base_url('Reports/view_income_statement')?>" class="btn btn-sm btn-success" id="submit_filter">
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
                        <font size="6" class="uppercase"><?= $company ?></font><br>
                        <font size="4" class="font-dark sbold uppercase">Income Statement</font><br>

                        <?php
                            $year = (isset($_GET['year']) ? $_GET['year'] : date('Y'));
                            $month = (isset($_GET['month']) ? date('F', mktime(0, 0, 0, (int)$_GET['month'], 10)) : date('F'));
                        ?>
                        <font size="4" class="font-dark sbold"><?= $month ?> <?= $year ?></font><br>
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
                                            <th width="20%"></th>
                                            <th width="10%" class="text-center">Current Month</th>
                                            <th width="10%" class="text-center">Year To Date</th>
                                    
                                        </tr>
                                    </thead>
                                    <tbody class="bold">
                                        <!-- COA 40000 -->
                                        <?php 
                                            $cur_total_rev_month = 0;
                                            $cur_total_rev_year = 0;
                                            $grand_total_rev_month = 0;
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
                                                        $cur_total_rev_month = 0;
                                                        $cur_total_rev_year = 0;
                                                    }
                                                }
                                            ?>
                                            <?php if($revenue[$i]['TransGroup'] == 'H1') : ?>
                                                <!--Header 1-->
                                                <tr>
                                                    <td class="uppercase bold" colspan="7" style="background-color: #5c9bd194;"><?= $revenue[$i]['Acc_Name'] ?> - <?= $revenue[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($revenue[$i]['TransGroup'] == 'H2') : ?>
                                                <!--Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4"><?= $revenue[$i]['Acc_Name'] ?> - <?= $revenue[$i]['Acc_No']?></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                            <?php elseif($revenue[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3"><?= $revenue[$i]['Acc_Name'] ?> - <?= $revenue[$i]['Acc_No']?></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                            <?php else : ?>
                                                <!--Data-->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center"><?= $revenue[$i]['Acc_No']?></td>
                                                    <td><?= $revenue[$i]['Acc_Name'] ?></td>
                                                    <td align="right"><?= number_format($revenue[$i]['Monthly'],2,',','.') ?></td>
                                                    <td align="right"><?= number_format($revenue[$i]['Yearly'],2,',','.') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_rev_month += $revenue[$i]['Monthly'];
                                                $cur_total_rev_year += $revenue[$i]['Yearly'];
                                                $grand_total_rev_month += $revenue[$i]['Monthly'];
                                                $grand_total_rev_year += $revenue[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($revenue)-1)) : ?>
                                                <?php if($revenue[$i+1]['TransGroup'] == 'H3' && $revenue[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_year, 2, ',','.') ?></td>
                                                    </tr>
                                                <?php elseif($revenue[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_year, 2, ',','.') ?></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h2?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_year, 2, ',','.') ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($revenue) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h3?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_month, 2, ',','.') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_year, 2, ',','.') ?></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h2?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_month, 2, ',','.') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_rev_year, 2, ',','.') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>                                   
                                        <!--Total Header 1-->
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_rev_h1 ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_month, 2,',','.') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_rev_year, 2,',','.') ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>

                                        <!-- COA 50000 -->
                                        <?php 
                                            $cur_total_opr_month = 0;
                                            $cur_total_opr_year = 0;
                                            $grand_total_opr_month = 0;
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
                                                        $cur_total_opr_month = 0;
                                                        $cur_total_opr_year = 0;
                                                    }
                                                }
                                            ?>
                                            <?php if($operational[$i]['TransGroup'] == 'H1') : ?>
                                                <!--Header 1-->
                                                <tr>
                                                    <td class="uppercase bold" colspan="7" style="background-color: #5c9bd194;"><?= $operational[$i]['Acc_Name'] ?> - <?= $operational[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($operational[$i]['TransGroup'] == 'H2') : ?>
                                                <!--Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4"><?= $operational[$i]['Acc_Name'] ?> - <?= $operational[$i]['Acc_No']?></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                            <?php elseif($operational[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3"><?= $operational[$i]['Acc_Name'] ?> - <?= $operational[$i]['Acc_No']?></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                            <?php else : ?>
                                                <!--Data-->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center"><?= $operational[$i]['Acc_No']?></td>
                                                    <td><?= $operational[$i]['Acc_Name'] ?></td>
                                                    <td align="right"><?= number_format($operational[$i]['Monthly'],2,',','.') ?></td>
                                                    <td align="right"><?= number_format($operational[$i]['Yearly'],2,',','.') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_opr_month += $operational[$i]['Monthly'];
                                                $cur_total_opr_year+= $operational[$i]['Yearly'];
                                                $grand_total_opr_month += $operational[$i]['Monthly'];
                                                $grand_total_opr_year+= $operational[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($operational)-1)) : ?>
                                                <?php if($operational[$i+1]['TransGroup'] == 'H3' && $operational[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_year, 2, ',','.') ?></td>
                                                    </tr>
                                                <?php elseif($operational[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_year, 2, ',','.') ?></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h2?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_year, 2, ',','.') ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($operational) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h3?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_month, 2, ',','.') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_year, 2, ',','.') ?></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h2?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_month, 2, ',','.') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_opr_year, 2, ',','.') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>                                   
                                        <!--Total Header 1-->
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_opr_h1 ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_month, 2,',','.') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_opr_year, 2,',','.') ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>

                                        <!--Gross Profit / Loss-->
                                        <!--Formula bisa dapat Gross Profit / Loss = Total Revenue - Total Expense (Total Operational Costs)-->
                                        <?php
                                            $gross_gain_month = $grand_total_rev_month - $grand_total_opr_month;
                                            $gross_gain_year = $grand_total_rev_year - $grand_total_opr_year;
                                        ?>
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Gross Profit / Loss</td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_month,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($gross_gain_year,2,',','.') ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>

                                        <!-- COA 60000 -->
                                        <?php 
                                            $cur_total_other_rev_month = 0;
                                            $cur_total_other_rev_year = 0;
                                            $grand_total_other_rev_month = 0;
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
                                                        $cur_total_other_rev_month = 0;
                                                        $cur_total_other_rev_year = 0;
                                                    }
                                                }
                                            ?>
                                            <?php if($other_revenue[$i]['TransGroup'] == 'H1') : ?>
                                                <!--Header 1-->
                                                <tr>
                                                    <td class="uppercase bold" colspan="7" style="background-color: #5c9bd194;"><?= $other_revenue[$i]['Acc_Name'] ?> - <?= $other_revenue[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($other_revenue[$i]['TransGroup'] == 'H2') : ?>
                                                <!--Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4"><?= $other_revenue[$i]['Acc_Name'] ?> - <?= $other_revenue[$i]['Acc_No']?></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                            <?php elseif($other_revenue[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3"><?= $other_revenue[$i]['Acc_Name'] ?> - <?= $other_revenue[$i]['Acc_No']?></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                            <?php else : ?>
                                                <!--Data-->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center"><?= $other_revenue[$i]['Acc_No']?></td>
                                                    <td><?= $other_revenue[$i]['Acc_Name'] ?></td>
                                                    <td align="right"><?= number_format($other_revenue[$i]['Monthly'],2,',','.') ?></td>
                                                    <td align="right"><?= number_format($other_revenue[$i]['Yearly'],2,',','.') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_other_rev_month += $other_revenue[$i]['Monthly'];
                                                $cur_total_other_rev_year += $other_revenue[$i]['Yearly'];
                                                $grand_total_other_rev_month += $other_revenue[$i]['Monthly'];
                                                $grand_total_other_rev_year += $other_revenue[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($other_revenue)-1)) : ?>
                                                <?php if($other_revenue[$i+1]['TransGroup'] == 'H3' && $other_revenue[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_year, 2, ',','.') ?></td>
                                                    </tr>
                                                <?php elseif($other_revenue[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_year, 2, ',','.') ?></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h2?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_year, 2, ',','.') ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($other_revenue) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h3?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_month, 2, ',','.') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_year, 2, ',','.') ?></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h2?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_month, 2, ',','.') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_rev_year, 2, ',','.') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>                                   
                                        <!--Total Header 1-->
                                        <!-- <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h1 ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_month, 2,',','.') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_rev_year, 2,',','.') ?></td>
                                        </tr> -->

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>

                                        <!--Operating Profit -->
                                        <?php
                                            $opr_profit_month = $gross_gain_month - $grand_total_other_rev_month;
                                            $opr_profit_year = $gross_gain_year - $grand_total_other_rev_year;
                                        ?>
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Operating Profit</td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_month,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($opr_profit_year,2,',','.') ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>

                                        <!-- COA 70000 -->
                                        <?php 
                                            $cur_total_other_expenses_month = 0;
                                            $cur_total_other_expenses_year = 0;
                                            $grand_total_other_expenses_month = 0;
                                            $grand_total_other_expenses_year = 0;
                                            $cur_header_other_expenses_h1 = '';
                                            $cur_header_other_expenses_h2 = '';
                                            $cur_header_other_expenses_h3 = '';
                                        ?>
                                        <?php for($i = 0; $i < count($other_expenses); $i++) : ?>
                                            <?php 
                                                $cur_header_other_expenses_h1 = ($other_expenses[$i]['TransGroup'] == 'H1' ? $other_expenses[$i]['Acc_Name'] : $cur_header_other_expenses_h1);
                                                $cur_header_other_expenses_h2 = ($other_expenses[$i]['TransGroup'] == 'H2' ? $other_expenses[$i]['Acc_Name'] : $cur_header_other_expenses_h2);
                                                $cur_header_other_expenses_h3 = ($other_expenses[$i]['TransGroup'] == 'H3' ? $other_expenses[$i]['Acc_Name'] : $cur_header_other_expenses_h3);
                                                if($i != 0){
                                                    if($other_expenses[$i-1]['TransGroup'] !== $other_expenses[$i]['TransGroup']) {
                                                        $cur_total_other_expenses_month = 0;
                                                        $cur_total_other_expenses_year = 0;
                                                    }
                                                }
                                            ?>
                                            <?php if($other_expenses[$i]['TransGroup'] == 'H1') : ?>
                                                <!--Header 1-->
                                                <tr>
                                                    <td class="uppercase bold" colspan="7" style="background-color: #5c9bd194;"><?= $other_expenses[$i]['Acc_Name'] ?> - <?= $other_expenses[$i]['Acc_No']?></td>
                                                </tr>
                                            <?php elseif($other_expenses[$i]['TransGroup'] == 'H2') : ?>
                                                <!--Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4"><?= $other_expenses[$i]['Acc_Name'] ?> - <?= $other_expenses[$i]['Acc_No']?></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                            <?php elseif($other_expenses[$i]['TransGroup'] == 'H3') : ?>
                                                <!--Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3"><?= $other_expenses[$i]['Acc_Name'] ?> - <?= $other_expenses[$i]['Acc_No']?></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                            <?php else : ?>
                                                <!--Data-->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="center"><?= $other_expenses[$i]['Acc_No']?></td>
                                                    <td><?= $other_expenses[$i]['Acc_Name'] ?></td>
                                                    <td align="right"><?= number_format($other_expenses[$i]['Monthly'],2,',','.') ?></td>
                                                    <td align="right"><?= number_format($other_expenses[$i]['Yearly'],2,',','.') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php
                                                $cur_total_other_expenses_month += $other_expenses[$i]['Monthly'];
                                                $cur_total_other_expenses_year += $other_expenses[$i]['Yearly'];
                                                $grand_total_other_expenses_month += $other_expenses[$i]['Monthly'];
                                                $grand_total_other_expenses_year += $other_expenses[$i]['Yearly'];
                                            ?>
                                            <?php if($i < (count($other_expenses)-1)) : ?>
                                                <?php if($other_expenses[$i+1]['TransGroup'] == 'H3' && $other_expenses[$i]['TransGroup'] !== 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_expenses_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_expenses_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_expenses_year, 2, ',','.') ?></td>
                                                    </tr>
                                                <?php elseif($other_expenses[$i+1]['TransGroup'] == 'H2' && $i > 2) : ?>
                                                    <!--Total Header 3-->
                                                    <tr class="font-blue-madison">
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_expenses_h3?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_expenses_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_expenses_year, 2, ',','.') ?></td>
                                                    </tr>
                                                    <!--Total Header 2-->
                                                    <tr class="font-yellow">
                                                        <td></td>
                                                        <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_expenses_h2?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_expenses_month, 2, ',','.') ?></td>
                                                        <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_expenses_year, 2, ',','.') ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif($i < count($other_expenses) && $i != 0) : ?>
                                                <!--Total Header 3-->
                                                <tr class="font-blue-madison">
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_expenses_h3?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_expenses_month, 2, ',','.') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_expenses_year, 2, ',','.') ?></td>
                                                </tr>
                                                <!--Total Header 2-->
                                                <tr class="font-yellow">
                                                    <td></td>
                                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_expenses_h2?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_expenses_month, 2, ',','.') ?></td>
                                                    <td align="right" style="border-top: solid 2px"><?= number_format($cur_total_other_expenses_year, 2, ',','.') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>                                   
                                        <!--Total Header 1-->
                                        <!-- <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_expenses_h1 ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_expenses_month, 2,',','.') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($grand_total_other_expenses_year, 2,',','.') ?></td>
                                        </tr> -->
                                        
                                        <?php
                                            $other_gain_month = $grand_total_other_rev_month - $grand_total_other_expenses_month;
                                            $other_gain_year = $grand_total_other_rev_year - $grand_total_other_expenses_year;
                                        ?>
                                        <tr class="font-yellow">
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Total <?= $cur_header_other_rev_h1 ?> & <?= $cur_header_other_expenses_h1 ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_month, 2,',','.') ?></td>
                                            <td align="right" style="border-top: solid 2px"><?= number_format($other_gain_year, 2,',','.') ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7" class="font-white">_</td>
                                        </tr>

                                        <!--Net Profit / Loss-->
                                        <!--Formula bisa dapat Net Profit / Loss = Total Gross Profit - (Total Other Revenue - Other Expense)-->
                                        <?php
                                            $net_gain_month = $gross_gain_month - $other_gain_month;
                                            $net_gain_year = $gross_gain_year - $other_gain_year;
                                        ?>
                                        <tr class="font-yellow-gold">
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Net Profit / Loss</td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_month,2,',','.') ?></td>
                                            <td align="right" style="border: solid 2px; border-color: black;"><?= number_format($net_gain_year,2,',','.') ?></td>
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