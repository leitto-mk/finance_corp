<?php $this->load->view('financecorp/cashadvance/header_corp'); ?>
<style type="text/css">
    .td-color_raiseddate {
        color: #3598dc;
    }

    .td-color_duedate {
        color: red;
    }

    #col_box {
        width: 20%;
    }

    @media only screen and (max-width: 900px) {
        #col_box {
            width: 100%;
        }
    }

    tr:nth-child(even){
        background-color: #eef1f5;
    }

    tr:nth-child(odd){
        background-color: white;
    }
</style>
<div class="main_content">
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="portlet bordered light">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark"><font size="4"><i class="fa fa-files-o"></i> Online Cash Request</font></span>
                </div>
                <div class="caption" style="margin-top: 10px">
                    <span class="caption-subject bold uppercase font-dark"><a href="#" class="font-dark">Approved (3)</a> | <a href="#" class="font-dark">Waiting Approved (3)</a> | <a href="#" class="font-dark">Pending (4)</a> | <a href="#" class="font-dark">Cancel (7)</a></span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr class="bg-blue-madison font-white">
                                    <th class="text-center" width="3%"> No </th>
                                    <th class="text-center" width="10%"> Request No </th>
                                    <th class="text-center" width="17%"> Requestor </th>
                                    <th class="text-center" width="14%"> Job Title </th>
                                    <th class="text-center" width="10%"> Request Date </th>
                                    <th class="text-center" width="10%"> Approved Date </th>
                                    <th class="text-right" width="13%"> Requested </th>
                                    <th class="text-right" width="13%"> Approved </th>
                                    <th class="text-center" width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-dark sbold">
                                    <td align="center">1</td>
                                    <td align="center">CAW2101-0001</td>                                    
                                    <td align="left">Eduard Salindeho - 2929</td>
                                    <td align="left">Finance Clerk</td>
                                    <td align="center">01-Aug-21</td>
                                    <td align="center">10-Aug-01</td>
                                    <td align="right">50,000 </td>
                                    <td align="right">25,000</td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="V">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" type="button" class="btn btn-xs green" title="E">
                                            <i class="fa fa-edit"> </i>
                                        </a>
                                        <a href="#" type="button" class="btn btn-xs red" title="D">
                                            <i class="fa fa-trash"> </i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">2</td>
                                    <td align="center">CAW2101-0001</td>                                    
                                    <td align="left">Sesca Londah - 2000</td>
                                    <td align="left">Finance Manager</td>
                                    <td align="center">01-Aug-21</td>
                                    <td align="center">10-Aug-01</td>
                                    <td align="right">250,000 </td>
                                    <td align="right">250,000</td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="V">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" type="button" class="btn btn-xs green" title="E">
                                            <i class="fa fa-edit"> </i>
                                        </a>
                                        <a href="#" type="button" class="btn btn-xs red" title="D">
                                            <i class="fa fa-trash"> </i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">3</td>
                                    <td align="center">CAW2101-0001</td>                                    
                                    <td align="left">Pranayan Salindeho - 2001</td>
                                    <td align="left">IT Manager</td>
                                    <td align="center">01-Aug-21</td>
                                    <td align="center">15-Aug-01</td>
                                    <td align="right">100,000 </td>
                                    <td align="right">100,000</td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="V">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" type="button" class="btn btn-xs green" title="E">
                                            <i class="fa fa-edit"> </i>
                                        </a>
                                        <a href="#" type="button" class="btn btn-xs red" title="D">
                                            <i class="fa fa-trash"> </i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet bordered light">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark"><font size="4"><i class="fa fa-files-o"></i> Current Outstanding Balance</font></span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr class="bg-blue-dark font-white">
                                    <th class="text-center" width="15%" colspan="2"> Deparment </th>
                                    <th class="text-center" width="20%"> Full Name </th>
                                    <th class="text-center" width="20%"> Job Title </th>
                                    <th class="text-center" width="20%"> Supervisor  </th>
                                    <th class="text-center" width="15%"> Outstanding </th>
                                    <th class="text-center" width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $cur_dept = null;
                                    $cur_total = 0;
                                    $grand_total = 0;
                                ?>
                                <?php for($i=0; $i < count($cur_outstanding_bal); $i++) : ?>
                                    <?php if($cur_outstanding_bal[$i]['DeptCode'] !== $cur_dept) : ?>
                                        <tr style="background-color: #578ebe6b">
                                            <td colspan="9" class="bold uppercase"><?= $cur_outstanding_bal[$i]['DeptDes']?> (<?= $cur_outstanding_bal[$i]['DeptCode']?>)</td>
                                        </tr>
                                        <?php
                                            $cur_dept = $cur_outstanding_bal[$i]['DeptCode'];
                                            $grand_total = 0;
                                        ?>
                                    <?php endif; ?>

                                    <tr class="font-dark sbold">
                                        <td align="center"><?= $i+1 ?></td>                                 
                                        <td align="center"><?= $cur_outstanding_bal[$i]['DeptCode'] ?></td>
                                        <td align="left"><?= $cur_outstanding_bal[$i]['FullName'] ?></td>
                                        <td align="center"><?= $cur_outstanding_bal[$i]['JobTitleDes'] ?></td>
                                        <td align="left"><?= $cur_outstanding_bal[$i]['Supervisor'] ?></td>
                                        <td align="right"><?= $cur_outstanding_bal[$i]['Balance'] ?></td>
                                        <td align="center">
                                            <a href="#" type="button" class="btn btn-xs blue" title="V">
                                                <i class="fa fa-search"> </i>
                                            </a>
                                            <a href="#" type="button" class="btn btn-xs green" title="W">
                                                <i class="fa fa-pencil"> </i>
                                            </a>
                                            <a href="#" type="button" class="btn btn-xs yellow" title="R">
                                                <i class="fa fa-pencil"> </i>
                                            </a>
                                        </td>
                                    </tr>

                                    <?php
                                        $cur_total += $cur_outstanding_bal[$i]['Balance'];
                                        $grand_total += $cur_outstanding_bal[$i]['Balance']
                                    ?>

                                    <?php if($i < (count($cur_outstanding_bal)-1)) : ?>
                                        <?php if($cur_outstanding_bal[$i+1]['DeptCode'] !== $cur_dept) : ?>
                                            <tr class="font-dark sbold" style="border-top: solid 2px;">                          
                                                <td align="right" colspan="5">Total :</td>
                                                <td align="right"><?= number_format($cur_total, 2,'.',',') ?></td>
                                                <td align="right"></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <tr class="font-dark sbold" style="border-top: solid 2px;">                          
                                    <td align="right" colspan="5">Total :</td>
                                    <td align="right"><?= number_format($cur_total, 2,'.',',') ?></td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="bg-blue-ebonyclay font-white bold">                          
                                    <td align="right" colspan="5"> Grand Total :</td>
                                    <td align="right"><?= number_format($grand_total, 2,'.',',') ?></td>
                                    <td align="right"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
</script>
<?php $this->load->view('financecorp/cashadvance/footer'); ?>