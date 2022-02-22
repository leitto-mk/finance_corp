<?php $this->load->view('financecorp/payable/header_corp'); ?>
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
                    <span class="caption-subject bold uppercase font-dark"><font size="4"><i class="fa fa-files-o"></i> Account Payable Aging Control</font></span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr class="bg-blue-madison font-white">
                                    <th class="text-center" width="3%"> No </th>
                                    <th class="text-center" width="10%"> Supplier / Vendor </th>
                                    <th class="text-center" width="14%"> Outstanding </th>
                                    <th class="text-center" width="13%"> Current </th>
                                    <th class="text-center" width="15%"> 1-30 </th>
                                    <th class="text-center" width="15%"> 31-60 </th>
                                    <th class="text-center" width="15%"> 61-90 </th>
                                    <th class="text-center" width="15%"> 91 and Over </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>
                                    <td align="center">Supplier A</td>                                    
                                    <td align="right">1,100.000</td>
                                    <td align="right">500,000</td>
                                    <td align="right">500,000</td>
                                    <td align="right">100,000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">2</td>
                                    <td align="center">Supplier B</td>                                    
                                    <td align="right">130,000</td>
                                    <td align="right">40,000</td>
                                    <td align="right">40,000</td>
                                    <td align="right">50,000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">3</td>
                                    <td align="center">Supplier C</td>                                    
                                    <td align="right">1,750,000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">1.750.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">4</td>
                                    <td align="center">Supplier D</td>                                    
                                    <td align="right">100,000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">100.000</td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">5</td>
                                    <td align="center">Supplier E</td>                                    
                                    <td align="right">300.000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">200.000</td>
                                    <td align="right">100.000</td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">6</td>
                                    <td align="center">Supplier F</td>                                    
                                    <td align="right">1,950,000</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                    <td align="right">200.000</td>
                                    <td align="right"></td>
                                    <td align="right">1.750.000</td>
                                </tr>
                                <tr style="border-top: solid 2px;" class="font-dark sbold">
                                    <td align="center"></td>
                                    <td align="right">Total Amount :</td>                                    
                                    <td align="right">5,330.000</td>
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
                    <span class="caption-subject bold uppercase font-dark"><font size="4"><i class="fa fa-files-o"></i> Account Payable Aging Details</font></span>
                </div>
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Aged Due - Current</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr class="bg-blue-madison font-white">
                                    <th class="text-center" width="5%"> No </th>
                                    <th class="text-center" width="10%"> PO No </th>
                                    <th class="text-center" width="5%"> Terms </th>
                                    <th class="text-center" width="8%"> PO Date  </th>
                                    <th class="text-center" width="8%"> Due Date </th>
                                    <th class="text-center" width="6%"> Currency </th>
                                    <th class="text-center" width="10%"> Amount </th>
                                    <th class="text-center" width="10%"> Paid </th>
                                    <th class="text-center" width="10%"> Oustanding </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: #578ebe6b">
                                    <td colspan="9" class="bold">Supplier / Vendor A - Code</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>                                 
                                    <td align="left">PO2107-001</td>
                                    <td align="center">30</td>
                                    <td align="center">01-Jul-21</td>
                                    <td align="center">31-Jul-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">200.000</td>
                                    <td align="right">30.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">2</td>                                 
                                    <td align="left">PO2108-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">1,000.000</td>
                                    <td align="right">500.000</td>
                                    <td align="right">500.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">3</td>                                 
                                    <td align="left">PO2109-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">150.000</td>
                                    <td align="right">80.000</td>
                                </tr>
                                <tr class="font-dark sbold" style="border-top: solid 2px;">
                                                                  
                                    <td align="right" colspan="6">Total Amount :</td>
                                    <td align="right">1,460.000</td>
                                    <td align="right">850.000</td>
                                    <td align="right">610.000</td>
                                  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Aged Due 1 - 30 Days</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr class="bg-blue-madison font-white">
                                    <th class="text-center" width="5%"> No </th>
                                    <th class="text-center" width="10%"> PO No </th>
                                    <th class="text-center" width="5%"> Terms </th>
                                    <th class="text-center" width="8%"> PO Date  </th>
                                    <th class="text-center" width="8%"> Due Date </th>
                                    <th class="text-center" width="6%"> Currency </th>
                                    <th class="text-center" width="10%"> Amount </th>
                                    <th class="text-center" width="10%"> Paid </th>
                                    <th class="text-center" width="10%"> Oustanding </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: #578ebe6b">
                                    <td colspan="9" class="bold">Supplier / Vendor A - Code</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>                                 
                                    <td align="left">PO2107-001</td>
                                    <td align="center">30</td>
                                    <td align="center">01-Jul-21</td>
                                    <td align="center">31-Jul-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">200.000</td>
                                    <td align="right">30.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">2</td>                                 
                                    <td align="left">PO2108-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">1,000.000</td>
                                    <td align="right">500.000</td>
                                    <td align="right">500.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">3</td>                                 
                                    <td align="left">PO2109-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">150.000</td>
                                    <td align="right">80.000</td>
                                </tr>
                                <tr class="font-dark sbold" style="border-top: solid 2px;">
                                                                  
                                    <td align="right" colspan="6">Total Amount :</td>
                                    <td align="right">1,460.000</td>
                                    <td align="right">850.000</td>
                                    <td align="right">610.000</td>
                                   
                                </tr>   

                                <tr style="background-color: #578ebe6b">
                                    <td colspan="9" class="bold">Supplier / Vendor A - Code</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>                                 
                                    <td align="left">PO2107-001</td>
                                    <td align="center">30</td>
                                    <td align="center">01-Jul-21</td>
                                    <td align="center">31-Jul-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">200.000</td>
                                    <td align="right">30.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">2</td>                                 
                                    <td align="left">PO2108-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">1,000.000</td>
                                    <td align="right">500.000</td>
                                    <td align="right">500.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">3</td>                                 
                                    <td align="left">PO2109-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">150.000</td>
                                    <td align="right">80.000</td>
                                </tr>
                                <tr class="font-dark sbold" style="border-top: solid 2px;">
                                                                  
                                    <td align="right" colspan="6">Total Amount :</td>
                                    <td align="right">1,460.000</td>
                                    <td align="right">850.000</td>
                                    <td align="right">610.000</td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Aged Due 31 - 60 Days</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                               <tr class="bg-blue-madison font-white">
                                    <th class="text-center" width="5%"> No </th>
                                    <th class="text-center" width="10%"> PO No </th>
                                    <th class="text-center" width="5%"> Terms </th>
                                    <th class="text-center" width="8%"> PO Date  </th>
                                    <th class="text-center" width="8%"> Due Date </th>
                                    <th class="text-center" width="6%"> Currency </th>
                                    <th class="text-center" width="10%"> Amount </th>
                                    <th class="text-center" width="10%"> Paid </th>
                                    <th class="text-center" width="10%"> Oustanding </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: #578ebe6b">
                                    <td colspan="9" class="bold">Supplier / Vendor A - Code</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>                                 
                                    <td align="left">PO2107-001</td>
                                    <td align="center">30</td>
                                    <td align="center">01-Jul-21</td>
                                    <td align="center">31-Jul-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">200.000</td>
                                    <td align="right">30.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">2</td>                                 
                                    <td align="left">PO2108-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">1,000.000</td>
                                    <td align="right">500.000</td>
                                    <td align="right">500.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">3</td>                                 
                                    <td align="left">PO2109-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">150.000</td>
                                    <td align="right">80.000</td>
                                </tr>
                                <tr class="font-dark sbold" style="border-top: solid 2px;">
                                                                  
                                    <td align="right" colspan="6">Total Amount :</td>
                                    <td align="right">1,460.000</td>
                                    <td align="right">850.000</td>
                                    <td align="right">610.000</td>
                                   
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Aged Due 61 - 90 Days</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr class="bg-blue-madison font-white">
                                    <th class="text-center" width="5%"> No </th>
                                    <th class="text-center" width="10%"> PO No </th>
                                    <th class="text-center" width="5%"> Terms </th>
                                    <th class="text-center" width="8%"> PO Date  </th>
                                    <th class="text-center" width="8%"> Due Date </th>
                                    <th class="text-center" width="6%"> Currency </th>
                                    <th class="text-center" width="10%"> Amount </th>
                                    <th class="text-center" width="10%"> Paid </th>
                                    <th class="text-center" width="10%"> Oustanding </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: #578ebe6b">
                                    <td colspan="9" class="bold">Supplier / Vendor A - Code</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>                                 
                                    <td align="left">PO2107-001</td>
                                    <td align="center">30</td>
                                    <td align="center">01-Jul-21</td>
                                    <td align="center">31-Jul-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">200.000</td>
                                    <td align="right">30.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">2</td>                                 
                                    <td align="left">PO2108-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">1,000.000</td>
                                    <td align="right">500.000</td>
                                    <td align="right">500.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">3</td>                                 
                                    <td align="left">PO2109-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">150.000</td>
                                    <td align="right">80.000</td>
                                </tr>
                                <tr class="font-dark sbold" style="border-top: solid 2px;">
                                                                  
                                    <td align="right" colspan="6">Total Amount :</td>
                                    <td align="right">1,460.000</td>
                                    <td align="right">850.000</td>
                                    <td align="right">610.000</td>
                                   
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">Aged Due 90 Days - Over</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr class="bg-blue-madison font-white">
                                    <th class="text-center" width="5%"> No </th>
                                    <th class="text-center" width="10%"> PO No </th>
                                    <th class="text-center" width="5%"> Terms </th>
                                    <th class="text-center" width="8%"> PO Date  </th>
                                    <th class="text-center" width="8%"> Due Date </th>
                                    <th class="text-center" width="6%"> Currency </th>
                                    <th class="text-center" width="10%"> Amount </th>
                                    <th class="text-center" width="10%"> Paid </th>
                                    <th class="text-center" width="10%"> Oustanding </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: #578ebe6b">
                                    <td colspan="9" class="bold">Supplier / Vendor A - Code</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>                                 
                                    <td align="left">PO2107-001</td>
                                    <td align="center">30</td>
                                    <td align="center">01-Jul-21</td>
                                    <td align="center">31-Jul-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">200.000</td>
                                    <td align="right">30.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">2</td>                                 
                                    <td align="left">PO2108-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">1,000.000</td>
                                    <td align="right">500.000</td>
                                    <td align="right">500.000</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">3</td>                                 
                                    <td align="left">PO2109-001</td>
                                    <td align="center">30</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">05-Aug-21</td>
                                    <td align="center">IDR</td>
                                    <td align="right">230.000</td>
                                    <td align="right">150.000</td>
                                    <td align="right">80.000</td>
                                </tr>
                                <tr class="font-dark sbold" style="border-top: solid 2px;">
                                                                  
                                    <td align="right" colspan="6">Total Amount :</td>
                                    <td align="right">1,460.000</td>
                                    <td align="right">850.000</td>
                                    <td align="right">610.000</td>
                                  
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
<?php $this->load->view('financecorp/payable/footer'); ?>