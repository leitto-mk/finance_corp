<?php $this->load->view('finance/header_sub_modul_sf'); ?>
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
</style>
<div class="main_content">
    <div class="row">
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet bordered light bg-blue-dark">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-white"><i class="fa fa-files-o"></i> Account Receivable Aging</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="3%"> No </th>
                                    <th class="text-center" width="17%"> Class </th>
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
    <div class="row">
        <div class="col-md-12">
            <div class="portlet bordered light bg-blue-dark">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-white"><i class="fa fa-files-o"></i> Student Charges</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="5%"> No </th>
                                    <th class="text-center" width="27%"> NIS - FullName </th>
                                    <th class="text-center" width="12%"> Room </th>
                                    <th class="text-center" width="17%"> Charges  </th>
                                    <th class="text-center" width="17%"> Paid </th>
                                    <th class="text-center" width="17%"> Variance </th>
                                    <th class="text-center" width="5%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: white">
                                    <td colspan="7" class="bold">ROOM 1A - Wali Kelas: Fine Hiborang</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>                                 
                                    <td align="left">20126 - Aaron Anes</td>
                                    <td align="center">1A</td>
                                    <td align="right">350.000</td>
                                    <td align="right">350.000</td>
                                    <td align="right">350.000</td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs green" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">2</td>                                   
                                    <td align="left">2022 - Smith James</td>
                                    <td align="center">1A</td>
                                    <td align="right">150.000</td>
                                    <td align="right">150.000</td>
                                    <td align="right">150.000</td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs green" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center"></td>                                   
                                    <td align="left"></td>
                                    <td align="center" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">Sub Total :</td>
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">500.000</td>
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">500.000</td>
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">500.000</td>
                                    <td align="center">
                                    </td>
                                </tr>
                                <tr style="background-color: white">
                                    <td colspan="9" class="bold">ROOM 2A - Wali Kelas: Jessy Togas</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">1</td>                                 
                                    <td align="left">2023 - Aaron Winter</td>
                                    <td align="center">2A</td>
                                    <td align="right">50.000</td>
                                    <td align="right">50.000</td>
                                    <td align="right">50.000</td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs green" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">2</td>                                   
                                    <td align="left">2024 - Smith Summer</td>
                                    <td align="center">2A</td>
                                    <td align="right">100.000</td>
                                    <td align="right">100.000</td>
                                    <td align="right">100.000</td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs green" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center"></td>                                   
                                    <td align="left"></td>
                                    <td align="center" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">Sub Total :</td>
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">150.000</td>
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">150.000</td>
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">150.000</td>
                                    <td align="center">
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center"></td>                                   
                                    <td align="left"></td>
                                    <td align="center" class="font-white sbold bg bg-blue-ebonyclay">Grand Total :</td>
                                    <td align="right" class="font-white sbold bg bg-blue-ebonyclay">650.000</td>
                                    <td align="right" class="font-white sbold bg bg-blue-ebonyclay">650.000</td>
                                    <td align="right" class="font-white sbold bg bg-blue-ebonyclay">650.000</td>
                                    <td align="center">
                                    </td>
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
<?php $this->load->view('finance/footer_sub_modul_sf'); ?>