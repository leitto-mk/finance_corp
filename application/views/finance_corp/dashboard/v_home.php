<?php $this->load->view('header_footer/finance_corp/header_main'); ?>
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

    @media only screen and (max-width: 900px) {
        #col_box {
            width: 100%;
        }
    }
</style>
<div class="main_content">
    <div class="row">
        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h1 class="widget-thumb-heading text-uppercase font-dark"><font size="4">General<font color="white">_</font>Ledger</font></h1>
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
                            <span class="widget-thumb-body-stat"><font size="3">Report</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark"><font size="4">Income<font color="white">_</font>Statement</font></h4>
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
                            <span class="widget-thumb-body-stat"><font size="3">Report</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark"><font size="4">Balance<font color="white">_</font>Sheet</font></h4>
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
                            <span class="widget-thumb-body-stat"><font size="3">Report</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark"><font size="4">Cash<font color="white">_</font>Flow</font></h4>
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
                            <span class="widget-thumb-body-stat"><font size="3">Report</font></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- <div id="col_box" class="col-md-3">
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
        </div> -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tabbable-custom nav-justified">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#pay" data-toggle="tab" class="uppercase font-dark bold"><font size="4">Accounts Payable Aging</font></a>
                    </li>
                    <li>
                        <a href="#rec" data-toggle="tab" class="uppercase font-dark bold"><font size="4">Accounts Receivable Aging</font></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="pay">
                        <div class="portlet bordered light bg-blue-dark">
                            <!-- <div class="caption">
                                <span class="caption-subject bold uppercase font-white"><i class="fa fa-files-o"></i> Account Receivable Aging</span>
                            </div> -->
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped table-condensed">
                                        <thead>
                                            <tr style="background-color: #22313F" class="font-white">
                                                <th class="text-center" width="3%"> No </th>
                                                <th class="text-center" width="17%"> Cost Center </th>
                                                <th class="text-center" width="15%"> 1 - 30 Days </th>
                                                <th class="text-center" width="15%"> 31 - 60 Days </th>
                                                <th class="text-center" width="15%"> 61 - 90 Days </th>
                                                <th class="text-center" width="15%"> 91 and Over </th>
                                                <th class="text-center" width="20%"> Total </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="background-color: white">
                                                <td colspan="7" class="bold">SD</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">1</td>
                                                <td align="center">I</td>                                    
                                                <td align="right">500.000</td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">600.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">2</td>
                                                <td align="center">II</td>                                    
                                                <td align="right">40.000</td>
                                                <td align="right">50.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">90.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">3</td>
                                                <td align="center">III</td>                                    
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">1.750.000</td>
                                                <td align="right">1.750.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">4</td>
                                                <td align="center">IV</td>                                    
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                                <td align="right">100.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">5</td>
                                                <td align="center">V</td>                                    
                                                <td align="right"></td>
                                                <td align="right">200.000</td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                                <td align="right">300.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">6</td>
                                                <td align="center">VI</td>                                    
                                                <td align="right"></td>
                                                <td align="right">200.000</td>
                                                <td align="right"></td>
                                                <td align="right">1.750.000</td>
                                                <td align="right">1.950.000</td>
                                            </tr>
                                            <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                                <td align="center"></td>
                                                <td align="center">Total :</td>                                    
                                                <td align="right">540.000</td>
                                                <td align="right">550.000</td>
                                                <td align="right">200.000</td>
                                                <td align="right">3.500.000</td>
                                                <td align="right" class="font-white sbold bg bg-blue-ebonyclay">4.250.000</td>
                                            </tr>
                                            <tr style="background-color: white; border-style: 1px">
                                                <td colspan="7" class="bold">SMP</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">1</td>
                                                <td align="center">VII</td>                                    
                                                <td align="right"></td>
                                                <td align="right">250.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">250.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">2</td>
                                                <td align="center">VIII</td>                                    
                                                <td align="right"></td>
                                                <td align="right">350.000</td>
                                                <td align="right">150.000</td>
                                                <td align="right">2.000.000</td>
                                                <td align="right">2.500.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">3</td>
                                                <td align="center">VIII</td>                                    
                                                <td align="right"></td>
                                                <td align="right">350.000</td>
                                                <td align="right">150.000</td>
                                                <td align="right">2.000.000</td>
                                                <td align="right">2.500.000</td>
                                            </tr>
                                            <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                                <td align="center"></td>
                                                <td align="center">Total :</td>                                    
                                                <td align="right"></td>
                                                <td align="right">950.000</td>
                                                <td align="right">300.000</td>
                                                <td align="right">4.000.000</td>
                                                <td align="right" class="font-white sbold bg bg-blue-ebonyclay">5.250.000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="rec">
                        <div class="portlet bordered light bg-blue-dark">
                            <!-- <div class="caption">
                                <span class="caption-subject bold uppercase font-white"><i class="fa fa-files-o"></i> Account Receivable Aging</span>
                            </div> -->
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped table-condensed">
                                        <thead>
                                            <tr style="background-color: #22313F" class="font-white">
                                                <th class="text-center" width="3%"> No </th>
                                                <th class="text-center" width="17%"> Cost Center </th>
                                                <th class="text-center" width="15%"> 1 - 30 Days </th>
                                                <th class="text-center" width="15%"> 31 - 60 Days </th>
                                                <th class="text-center" width="15%"> 61 - 90 Days </th>
                                                <th class="text-center" width="15%"> 91 and Over </th>
                                                <th class="text-center" width="20%"> Total </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="background-color: white">
                                                <td colspan="7" class="bold">SD</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">1</td>
                                                <td align="center">I</td>                                    
                                                <td align="right">500.000</td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">600.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">2</td>
                                                <td align="center">II</td>                                    
                                                <td align="right">40.000</td>
                                                <td align="right">50.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">90.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">3</td>
                                                <td align="center">III</td>                                    
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">1.750.000</td>
                                                <td align="right">1.750.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">4</td>
                                                <td align="center">IV</td>                                    
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                                <td align="right">100.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">5</td>
                                                <td align="center">V</td>                                    
                                                <td align="right"></td>
                                                <td align="right">200.000</td>
                                                <td align="right">100.000</td>
                                                <td align="right"></td>
                                                <td align="right">300.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">6</td>
                                                <td align="center">VI</td>                                    
                                                <td align="right"></td>
                                                <td align="right">200.000</td>
                                                <td align="right"></td>
                                                <td align="right">1.750.000</td>
                                                <td align="right">1.950.000</td>
                                            </tr>
                                            <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                                <td align="center"></td>
                                                <td align="center">Total :</td>                                    
                                                <td align="right">540.000</td>
                                                <td align="right">550.000</td>
                                                <td align="right">200.000</td>
                                                <td align="right">3.500.000</td>
                                                <td align="right" class="font-white sbold bg bg-blue-ebonyclay">4.250.000</td>
                                            </tr>
                                            <tr style="background-color: white; border-style: 1px">
                                                <td colspan="7" class="bold">SMP</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">1</td>
                                                <td align="center">VII</td>                                    
                                                <td align="right"></td>
                                                <td align="right">250.000</td>
                                                <td align="right"></td>
                                                <td align="right"></td>
                                                <td align="right">250.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">2</td>
                                                <td align="center">VIII</td>                                    
                                                <td align="right"></td>
                                                <td align="right">350.000</td>
                                                <td align="right">150.000</td>
                                                <td align="right">2.000.000</td>
                                                <td align="right">2.500.000</td>
                                            </tr>
                                            <tr class="font-white sbold">
                                                <td align="center">3</td>
                                                <td align="center">VIII</td>                                    
                                                <td align="right"></td>
                                                <td align="right">350.000</td>
                                                <td align="right">150.000</td>
                                                <td align="right">2.000.000</td>
                                                <td align="right">2.500.000</td>
                                            </tr>
                                            <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                                <td align="center"></td>
                                                <td align="center">Total :</td>                                    
                                                <td align="right"></td>
                                                <td align="right">950.000</td>
                                                <td align="right">300.000</td>
                                                <td align="right">4.000.000</td>
                                                <td align="right" class="font-white sbold bg bg-blue-ebonyclay">5.250.000</td>
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
    <div class="row">
        <div class="col-md-12">
            <div class="portlet bordered light bg-blue-dark">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-white"><i class="fa fa-files-o"></i> Cash-Bank Transaction</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="5%"> No </th>
                                    <th class="text-center" width="10%"> Doc No </th>
                                    <th class="text-center" width="10%"> Trans Date </th>
                                    <th class="text-center" width="8%"> Trans Type  </th>
                                    <th class="text-center" width="8%"> Branch </th>
                                    <th class="text-center" width="10%"> Cost Center </th>
                                    <th class="text-center" width="17%"> Account No </th>
                                    <th class="text-center" width="17%"> Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>                                 
                                    <td align="left">123</td>
                                    <td align="center">01-Mar-2021</td>
                                    <td align="left">Receipt</td>
                                    <td align="left">HO</td>
                                    <td align="left">Finance - Treasury</td>
                                    <td align="left">1001 - Cash</td>
                                    <td align="right">10.000.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>                                 
                                    <td align="left">123</td>
                                    <td align="center">03-Mar-2021</td>
                                    <td align="left">Payment</td>
                                    <td align="left">Branch A</td>
                                    <td align="left">Finance - Payroll</td>
                                    <td align="left">1001 - Cash</td>
                                    <td align="right">2.000.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>                                 
                                    <td align="left">123</td>
                                    <td align="center">10-Mar-2021</td>
                                    <td align="left">General</td>
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
    </div>
</div>
<script type="text/javascript">
    window.onload = load_function;

    function load_function() {
        document.body.style.zoom = 0.9;
    }
</script>
<?php $this->load->view('header_footer/finance_corp/footer_main'); ?>