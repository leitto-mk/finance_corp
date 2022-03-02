<?php $this->load->view('header_footer/header_main'); ?>
<style type="text/css">
    .td-color_raiseddate {
        color: #3598dc;
    }

    .td-color_duedate {
        color: red;
    }

    #col_box {
        width: 25%;
    }

/*    @media only screen and (max-width: 900px) {
        #col_box {
            width: 100%;
        }
    }*/
</style>
<div class="main_content">
    <!-- <div class="row">
        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bg-blue-ebonyclay">
                <div class="row">
                    <div class="col-md-12" style="float: left;">
                        <h1 class="widget-thumb-heading text-uppercase font-white" style="margin-top: 5px"><font size="4">Supplier (0)</font></h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bg-blue-sharp">
                <div class="row">
                    <div class="col-md-12" style="float: left">
                        <h1 class="widget-thumb-heading text-uppercase font-white" style="margin-top: 5px"><font size="4">Customer (0)</font></h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bg-green">
                <div class="row">
                    <div class="col-md-12" style="float: left">
                        <h1 class="widget-thumb-heading text-uppercase font-white" style="margin-top: 5px"><font size="4">Stockcode (0)</font></h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bg-grey-salsa">
                <div class="row">
                    <div class="col-md-12" style="float: left">
                        <h1 class="widget-thumb-heading text-uppercase font-white" style="margin-top: 5px"><font size="4">User (0)</font></h1>
                    </div>
                </div>
            </div>
        </div>

        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h1 class="widget-thumb-heading text-uppercase font-dark"><font size="4">Receipt (0)</font></h1>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue-hoki fa fa-line-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Preview</span>
                            <span class="widget-thumb-body-stat"><font size="3">0</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark"><font size="4">Payment</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue-sharp fa fa-line-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Priview</span>
                            <span class="widget-thumb-body-stat"><font size="3">0</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark"><font size="4">Journal</font></h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green fa fa-line-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Priview</span>
                            <span class="widget-thumb-body-stat"><font size="3">0</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark"><font size="4">Aging<font color="white">_</font>Control</font></h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Total Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue-madison fa fa-line-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Priview</span>
                            <span class="widget-thumb-body-stat"><font size="3">0</font></span>
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
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="portlet bordered light">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark"><i class="fa fa-files-o"></i> Cash-Bank Transaction</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="5%"> No </th>
                                    <th class="text-center" width="10%"> Trans Date </th>
                                    <th class="text-center" width="10%"> Doc No </th>
                                    <th class="text-center" width="8%"> Trans Type  </th>
                                    <th class="text-center" width="8%"> Branch </th>
                                    <th class="text-center" width="10%"> Cost Center </th>
                                    <th class="text-center" width="17%"> Account No </th>
                                    <th class="text-center" width="17%"> Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-dark sbold">
                                    <td align="center">1</td>                                 
                                    <td align="center">01-Mar-2021</td>
                                    <td align="center">123</td>
                                    <td align="center">Receipt</td>
                                    <td align="left">HO</td>
                                    <td align="left">Finance - Treasury</td>
                                    <td align="left">1001 - Cash</td>
                                    <td align="right">10.000.000</td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">2</td>                                 
                                    <td align="center">03-Mar-2021</td>
                                    <td align="center">123</td>
                                    <td align="center">Payment</td>
                                    <td align="left">Branch A</td>
                                    <td align="left">Finance - Payroll</td>
                                    <td align="left">1001 - Cash</td>
                                    <td align="right">2.000.000</td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">3</td>                                 
                                    <td align="center">10-Mar-2021</td>
                                    <td align="center">123</td>
                                    <td align="center">General</td>
                                    <td align="left">Branch B</td>
                                    <td align="left">Finance - Treasury</td>
                                    <td align="left">1002 - Bank</td>
                                    <td align="right">3.000.000</td>
                                </tr>

                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="tabbable-custom nav-justified">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#rec" data-toggle="tab" class="uppercase font-dark bold"><font size="4">Accounts Receivable Aging</font></a>
                    </li>
                    <li>
                        <a href="#pay" data-toggle="tab" class="uppercase font-dark bold"><font size="4">Accounts Payable Aging</font></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="rec">
                        <div class="portlet bordered light">
                            <div class="caption">
                                <span class="caption-subject bold uppercase font-white"><i class="fa fa-files-o"></i> Account Receivable Aging</span>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped table-condensed">
                                        <thead>
                                            <tr style="background-color: #22313F" class="font-white">
                                                <th class="text-center" width="3%"> No </th>
                                                <th class="text-center" width="15%"> Customer </th>
                                                <th class="text-center" width="15%"> Outstanding </th>
                                                <th class="text-center" width="15%"> Current </th>
                                                <th class="text-center" width="15%"> 1 - 30 Days </th>
                                                <th class="text-center" width="15%"> 31 - 60 Days </th>
                                                <th class="text-center" width="15%"> 61 - 90 Days </th>
                                                <th class="text-center" width="17%"> 91 and Over </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="font-dark sbold">
                                                <td align="center">1</td>
                                                <td align="center">Customer A</td>                                    
                                                <td align="right">600.000</td>
                                                <td align="right">500.000</td>
                                                <td align="right">500.000</td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                            </tr>
                                            <tr class="font-dark sbold">
                                                <td align="center">2</td>
                                                <td align="center">Customer B</td>                                    
                                                <td align="right">90.000</td>
                                                <td align="right">40.000</td>
                                                <td align="right">40.000</td>
                                                <td align="right">50.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                            </tr>
                                            <tr class="font-dark sbold">
                                                <td align="center">3</td>
                                                <td align="center">Customer C</td>                                    
                                                <td align="right">1.750.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">1.750.000</td>
                                            </tr>
                                            <tr class="font-dark sbold">
                                                <td align="center">4</td>
                                                <td align="center">Customer D</td>                                    
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                            </tr>
                                            <tr class="font-dark sbold">
                                                <td align="center">5</td>
                                                <td align="center">Customer E</td>                                    
                                                <td align="right">300.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">200.000</td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                            </tr>
                                            <tr class="font-dark sbold">
                                                <td align="center">6</td>
                                                <td align="center">Customer F</td>                                    
                                                <td align="right">1.950.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">200.000</td>
                                                <td align="right"></td>
                                                <td align="right">1.750.000</td>
                                            </tr>
                                            <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                                <td align="center"></td>
                                                <td align="center">Total :</td>                                    
                                                <td align="right" class="font-white sbold bg bg-blue-ebonyclay">4.250.000</td>
                                                <td align="right">540.000</td>
                                                <td align="right">540.000</td>
                                                <td align="right">550.000</td>
                                                <td align="right">200.000</td>
                                                <td align="right">3.500.000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="pay">
                        <div class="portlet bordered light">
                            <div class="caption">
                                <span class="caption-subject bold uppercase font-white"><i class="fa fa-files-o"></i> Account Receivable Aging</span>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped table-condensed">
                                        <thead>
                                            <tr style="background-color: #22313F" class="font-white">
                                                <th class="text-center" width="3%"> No </th>
                                                <th class="text-center" width="15%"> Supplier / Vendor </th>
                                                <th class="text-center" width="15%"> Outstanding </th>
                                                <th class="text-center" width="15%"> Current </th>
                                                <th class="text-center" width="15%"> 1 - 30 Days </th>
                                                <th class="text-center" width="15%"> 31 - 60 Days </th>
                                                <th class="text-center" width="15%"> 61 - 90 Days </th>
                                                <th class="text-center" width="17%"> 91 and Over </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="font-dark sbold">
                                                <td align="center">1</td>
                                                <td align="center">Supplier A</td>                                    
                                                <td align="right">600.000</td>
                                                <td align="right">500.000</td>
                                                <td align="right">500.000</td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                            </tr>
                                            <tr class="font-dark sbold">
                                                <td align="center">2</td>
                                                <td align="center">Supplier B</td>                                    
                                                <td align="right">90.000</td>
                                                <td align="right">40.000</td>
                                                <td align="right">40.000</td>
                                                <td align="right">50.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                            </tr>
                                            <tr class="font-dark sbold">
                                                <td align="center">3</td>
                                                <td align="center">Supplier C</td>                                    
                                                <td align="right">1.750.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">1.750.000</td>
                                            </tr>
                                            <tr class="font-dark sbold">
                                                <td align="center">4</td>
                                                <td align="center">Supplier D</td>                                    
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                            </tr>
                                            <tr class="font-dark sbold">
                                                <td align="center">5</td>
                                                <td align="center">Supplier E</td>                                    
                                                <td align="right">300.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">200.000</td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                            </tr>
                                            <tr class="font-dark sbold">
                                                <td align="center">6</td>
                                                <td align="center">Supplier F</td>                                    
                                                <td align="right">1.950.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">200.000</td>
                                                <td align="right"></td>
                                                <td align="right">1.750.000</td>
                                            </tr>
                                            <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                                <td align="center"></td>
                                                <td align="center">Total :</td>                                    
                                                <td align="right" class="font-white sbold bg bg-blue-ebonyclay">4.250.000</td>
                                                <td align="right">540.000</td>
                                                <td align="right">540.000</td>
                                                <td align="right">550.000</td>
                                                <td align="right">200.000</td>
                                                <td align="right">3.500.000</td>
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
    </div> -->
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="portlet bordered light">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark"><i class="fa fa-files-o"></i> Accounts Receivable Aging</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="3%"> No </th>
                                    <th class="text-center" width="15%"> Customer </th>
                                    <th class="text-center" width="15%"> Outstanding </th>
                                    <th class="text-center" width="15%"> Current </th>
                                    <th class="text-center" width="15%"> 1 - 30 Days </th>
                                    <th class="text-center" width="15%"> 31 - 60 Days </th>
                                    <th class="text-center" width="15%"> 61 - 90 Days </th>
                                    <th class="text-center" width="17%"> 91 and Over </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-dark sbold">
                                    <td align="center">1</td>
                                    <td align="center">Customer A</td>                                    
                                    <td align="right">600.000</td>
                                    <td align="right">500.000</td>
                                    <td align="right">500.000</td>
                                    <td align="right">100.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">2</td>
                                    <td align="center">Customer B</td>                                    
                                    <td align="right">90.000</td>
                                    <td align="right">40.000</td>
                                    <td align="right">40.000</td>
                                    <td align="right">50.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">3</td>
                                    <td align="center">Customer C</td>                                    
                                    <td align="right">1.750.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">1.750.000</td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">4</td>
                                    <td align="center">Customer D</td>                                    
                                    <td align="right">100.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">100.000</td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">5</td>
                                    <td align="center">Customer E</td>                                    
                                    <td align="right">300.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">200.000</td>
                                    <td align="right">100.000</td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">6</td>
                                    <td align="center">Customer F</td>                                    
                                    <td align="right">1.950.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">200.000</td>
                                    <td align="right"></td>
                                    <td align="right">1.750.000</td>
                                </tr>
                                <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                    <td align="center"></td>
                                    <td align="center">Total :</td>                                    
                                    <td align="right" class="font-white sbold bg bg-blue-ebonyclay">4.250.000</td>
                                    <td align="right">540.000</td>
                                    <td align="right">540.000</td>
                                    <td align="right">550.000</td>
                                    <td align="right">200.000</td>
                                    <td align="right">3.500.000</td>
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
                    <span class="caption-subject bold uppercase font-dark"><i class="fa fa-files-o"></i> Accounts Payable Aging</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="3%"> No </th>
                                    <th class="text-center" width="15%"> Supplier / Vendor </th>
                                    <th class="text-center" width="15%"> Outstanding </th>
                                    <th class="text-center" width="15%"> Current </th>
                                    <th class="text-center" width="15%"> 1 - 30 Days </th>
                                    <th class="text-center" width="15%"> 31 - 60 Days </th>
                                    <th class="text-center" width="15%"> 61 - 90 Days </th>
                                    <th class="text-center" width="17%"> 91 and Over </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-dark sbold">
                                    <td align="center">1</td>
                                    <td align="center">Supplier A</td>                                    
                                    <td align="right">600.000</td>
                                    <td align="right">500.000</td>
                                    <td align="right">500.000</td>
                                    <td align="right">100.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">2</td>
                                    <td align="center">Supplier B</td>                                    
                                    <td align="right">90.000</td>
                                    <td align="right">40.000</td>
                                    <td align="right">40.000</td>
                                    <td align="right">50.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">3</td>
                                    <td align="center">Supplier C</td>                                    
                                    <td align="right">1.750.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">1.750.000</td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">4</td>
                                    <td align="center">Supplier D</td>                                    
                                    <td align="right">100.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">100.000</td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">5</td>
                                    <td align="center">Supplier E</td>                                    
                                    <td align="right">300.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">200.000</td>
                                    <td align="right">100.000</td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-dark sbold">
                                    <td align="center">6</td>
                                    <td align="center">Supplier F</td>                                    
                                    <td align="right">1.950.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">200.000</td>
                                    <td align="right"></td>
                                    <td align="right">1.750.000</td>
                                </tr>
                                <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                    <td align="center"></td>
                                    <td align="center">Total :</td>                                    
                                    <td align="right" class="font-white sbold bg bg-blue-ebonyclay">4.250.000</td>
                                    <td align="right">540.000</td>
                                    <td align="right">540.000</td>
                                    <td align="right">550.000</td>
                                    <td align="right">200.000</td>
                                    <td align="right">3.500.000</td>
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
            <marquee><h1 class="text-center" style="margin-top: -5px">Automation Based Resource System</h1></marquee>
            <center><img src="<?= base_url() ?>assets/bg4.jpeg" alt="" height="85%" width="85%"/></center>
        </div>
    </div>
</div>
<!-- <script type="text/javascript">
    
</script> -->
<?php $this->load->view('header_footer/footer_main'); ?>