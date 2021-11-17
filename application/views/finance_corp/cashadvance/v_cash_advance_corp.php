<?php $this->load->view('finance_corp/cashadvance/header_corp'); ?>
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
        <div id="col_box" class="col-md-3">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark">SD</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue-hoki fa fa-line-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Total</span>
                            <span class="widget-thumb-body-stat"><font size="5">4.250.000</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-md-3">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark">SMP</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue-sharp fa fa-line-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Total</span>
                            <span class="widget-thumb-body-stat"><font size="5">5.250.000</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-md-3">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark">SMA</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green fa fa-line-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Total</span>
                            <span class="widget-thumb-body-stat"><font size="5">0</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-md-3">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark">SMK</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Total Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue-madison fa fa-line-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Total</span>
                            <span class="widget-thumb-body-stat"><font size="5">0</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-md-3">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark"> Total</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Total Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue-dark fa fa-line-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Total</span>
                            <span class="widget-thumb-body-stat"><font size="5">9.500.000</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div> -->
    <div class="row">
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
    </div>
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
                                <tr class="bg-blue-madison font-white">
                                    <th class="text-center" width="15%" colspan="2"> Deparment </th>
                                    <th class="text-center" width="20%"> Full Name </th>
                                    <th class="text-center" width="20%"> Job Title </th>
                                    <th class="text-center" width="20%"> Supervisor  </th>
                                    <th class="text-center" width="15%"> Outstanding </th>
                                    <th class="text-center" width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: #578ebe6b">
                                    <td colspan="9" class="bold uppercase">Finance Accounting Department (Code)</td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">1</td>                                 
                                    <td align="center">2000</td>
                                    <td align="left">Eduard Salindeho</td>
                                    <td align="left">Finance Accounting Supervisor</td>
                                    <td align="left">Sesca Londah - 2000</td>
                                    <td align="right"> 1,400,000</td>
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
                                <tr class="font-dark sbold">
                                    <td align="center">2</td>                                 
                                    <td align="center">2001</td>
                                    <td align="left">Sesca Londah</td>
                                    <td align="left">Accountant Officer</td>
                                    <td align="left">Sesca Londah - 2000</td>
                                    <td align="right"> 500,000</td>
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
                                <tr class="font-dark sbold">
                                    <td align="center">3</td>                                 
                                    <td align="center">2000</td>
                                    <td align="left">Pranayan Salindeho</td>
                                    <td align="left">Finance Coodinator</td>
                                    <td align="left">Sesca Londah - 2000</td>
                                    <td align="right"> 1,000,000</td>
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
                                <tr class="font-dark sbold" style="border-top: solid 2px;">                          
                                    <td align="right" colspan="5">Total :</td>
                                    <td align="right">2,900,000</td>
                                    <td align="right"></td>
                                </tr>


                                <tr style="background-color: #578ebe6b">
                                    <td colspan="9" class="bold uppercase">Operation Department (Code)</td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">1</td>                                 
                                    <td align="center">2000</td>
                                    <td align="left">Eduard Salindeho</td>
                                    <td align="left">Finance Accounting Supervisor</td>
                                    <td align="left">Sesca Londah - 2000</td>
                                    <td align="right"> 1,400,000</td>
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
                                <tr class="font-dark sbold">
                                    <td align="center">2</td>                                 
                                    <td align="center">2001</td>
                                    <td align="left">Sesca Londah</td>
                                    <td align="left">Accountant Officer</td>
                                    <td align="left">Sesca Londah - 2000</td>
                                    <td align="right"> 500,000</td>
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
                                <tr class="font-dark sbold">
                                    <td align="center">3</td>                                 
                                    <td align="center">2000</td>
                                    <td align="left">Pranayan Salindeho</td>
                                    <td align="left">Finance Coodinator</td>
                                    <td align="left">Sesca Londah - 2000</td>
                                    <td align="right"> 1,000,000</td>
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
                                <tr class="font-dark sbold" style="border-top: solid 2px;">                          
                                    <td align="right" colspan="5">Total :</td>
                                    <td align="right">2,900,000</td>
                                    <td align="right"></td>
                                </tr>


                                <tr style="background-color: #578ebe6b">
                                    <td colspan="9" class="bold uppercase">Human Resource Department (Code)</td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">1</td>                                 
                                    <td align="center">2000</td>
                                    <td align="left">Eduard Salindeho</td>
                                    <td align="left">Finance Accounting Supervisor</td>
                                    <td align="left">Sesca Londah - 2000</td>
                                    <td align="right"> 1,400,000</td>
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
                                <tr class="font-dark sbold">
                                    <td align="center">2</td>                                 
                                    <td align="center">2001</td>
                                    <td align="left">Sesca Londah</td>
                                    <td align="left">Accountant Officer</td>
                                    <td align="left">Sesca Londah - 2000</td>
                                    <td align="right"> 500,000</td>
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
                                <tr class="font-dark sbold">
                                    <td align="center">3</td>                                 
                                    <td align="center">2000</td>
                                    <td align="left">Pranayan Salindeho</td>
                                    <td align="left">Finance Coodinator</td>
                                    <td align="left">Sesca Londah - 2000</td>
                                    <td align="right"> 1,000,000</td>
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
                                <tr class="font-dark sbold" style="border-top: solid 2px;">                          
                                    <td align="right" colspan="5">Total :</td>
                                    <td align="right">2,900,000</td>
                                    <td align="right"></td>
                                </tr>

                                <tr class="bg-blue-ebonyclay font-white bold">                          
                                    <td align="right" colspan="5"> Grand Total :</td>
                                    <td align="right">8,700,000</td>
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
    window.onload = load_function;

    function load_function() {
        document.body.style.zoom = 0.9;
    }
</script>
<?php $this->load->view('finance_corp/cashadvance/footer'); ?>