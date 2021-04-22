<?php $this->load->view('header_footer/student_finance/header_sub_modul_sf'); ?>
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
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border: solid 1px; border-color:#e9ecf3; background-color: #f6f6f6">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark">0 - 30 Days</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green fa fa-calendar"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Total</span>
                            <span class="widget-thumb-body-stat">100.000</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-md-3">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border: solid 1px; border-color:#e9ecf3; background-color: #f6f6f6">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark">30 - 60 Days</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue fa fa-calendar"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Total</span>
                            <span class="widget-thumb-body-stat">1.500.000</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-md-3">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border: solid 1px; border-color:#e9ecf3; background-color: #f6f6f6">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark">60 - 90 Days</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-yellow fa fa-calendar"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Total</span>
                            <span class="widget-thumb-body-stat">250.000</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-md-3">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border: solid 1px; border-color:#e9ecf3; background-color: #f6f6f6">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark">90 - 120 Days</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Total Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-purple fa fa-calendar"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Total</span>
                            <span class="widget-thumb-body-stat">750.000</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="col_box" class="col-md-3">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border: solid 1px; border-color:#e9ecf3; background-color: #f6f6f6">
                <div class="row">
                    <div class="col-md-8" style="float: left">
                        <h4 class="widget-thumb-heading text-uppercase font-dark"> > 120 Days</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Total Data" style="float: right"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <a href="#">
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-red fa fa-calendar"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Total</span>
                            <span class="widget-thumb-body-stat">500.000</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark"><i class="fa fa-files-o"></i> Report - Summary&nbsp;&nbsp;[ 6 ] </span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr style="background-color: #bfbfbf7a">
                                    <th class="text-left" colspan="3">
                                    </th>
                                    <th class="text-center sbold font-dark" colspan="5">
                                        Aging
                                    </th>
                                </tr>
                                <tr style="background-color: #bfbfbfb0" class="font-dark">
                                    <td class="text-left" width="33%" colspan="2"> Supplier List </td>
                                    <td class="text-center" width="17%"> Currency </td>
                                    <th class="text-center" width="10%"> 0 - 30 Days </th>
                                    <th class="text-center" width="10%"> 30 - 60 Days </th>
                                    <th class="text-center" width="10%"> 60 - 90 Days </th>
                                    <th class="text-center" width="10%"> 90 - 120 Days </th>
                                    <th class="text-center" width="10%"> >120 Days </th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
                                    <td align="center">1</td>
                                    <td>Supplier (Name) AA</td>                                    
                                    <td align="center">IDR</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="right">500.000</td>
                                </tr>
                                <tr>
                                    <td align="center">2</td>
                                    <td>Supplier (Name) AB</td>                                  
                                    <td align="center">IDR</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="right">750.000</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="center">3</td>
                                    <td>Supplier (Name) AC</td>                                 
                                    <td align="center">IDR</td>
                                    <td></td>
                                    <td></td>
                                    <td align="right">250.000</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="center">3</td>
                                    <td>Supplier (Name) AC</td>                                
                                    <td align="center">IDR</td>
                                    <td></td>
                                    <td align="right">500.000</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="center">4</td>
                                    <td>Supplier (Name) AD</td>                                
                                    <td align="center">IDR</td>
                                    <td></td>
                                    <td align="right">1.000.000</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="center">5</td>
                                    <td>Supplier (Name) AE</td>                                 
                                    <td align="center">IDR</td>
                                    <td align="right">100.000</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                 <tr style="background-color: #f6f6f6">
                                    <td></td>
                                    <td colspan="" class="uppercase sbold">Grand Total</td>
                                    <td align="center">IDR</td>
                                    <td align="right" class="sbold">100.000</td>
                                    <td align="right" class="sbold">1.500.000</td>
                                    <td align="right" class="sbold">250.000</td>
                                    <td align="right" class="sbold">750.000</td>
                                    <td align="right" class="sbold">500.000</td>
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
            <div class="portlet light bordered">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark"><i class="fa fa-files-o"></i> Report Details&nbsp;&nbsp;[ 6 ] </span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr style="background-color: #bfbfbf7a">
                                    <th class="text-left" colspan="2">Supplier
                                    </th>
                                    <th class="text-center" colspan="4">
                                    </th>
                                    <th class="text-center sbold font-dark" colspan="5">
                                        Aging
                                    </th>
                                </tr>
                                <tr style="background-color: #bfbfbfb0" class="font-dark">
                                    <td class="text-center" width="23%" colspan="2"> Trans Date </td>
                                    <td class="text-center" width="7%"> Due Date </td>
                                    <td class="text-center" width="5%"> Type </td>
                                    <td class="text-center" width="10%"> Ref No </td>
                                    <td class="text-center" width="5%"> Currency </td>
                                    <th class="text-center" width="10%"> 0 - 30 Days </th>
                                    <th class="text-center" width="10%"> 30 - 60 Days </th>
                                    <th class="text-center" width="10%"> 60 - 90 Days </th>
                                    <th class="text-center" width="10%"> 90 - 120 Days </th>
                                    <th class="text-center" width="10%"> >120 Days </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="11" class="sbold">Supplier (Name) AA - Code</td>
                                </tr>
                                <tr>
                                    <td align="center">1</td>
                                    <td class="td-color_raiseddate">01-Feb-2020</td>
                                    <td class="td-color_duedate">28-Feb-2020</td>
                                    <td>PO</td>
                                    <td class="sbold">PO#1234</td>
                                    <td align="center">IDR</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="right">500.000</td>
                                </tr>
                                <tr>
                                    <td align="center">2</td>
                                    <td class="td-color_raiseddate">01-Mar-2020</td>
                                    <td class="td-color_duedate">28-Mar-2020</td>
                                    <td>PO</td>
                                    <td class="sbold">PO#1235</td>
                                    <td align="center">IDR</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="right">750.000</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="center">3</td>
                                    <td class="td-color_raiseddate">01-Apr-2020</td>
                                    <td class="td-color_duedate">28-APr-2020</td>
                                    <td>PO</td>
                                    <td class="sbold">PO#1236</td>
                                    <td align="center">IDR</td>
                                    <td></td>
                                    <td></td>
                                    <td align="right">250.000</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="center">3</td>
                                    <td class="td-color_raiseddate">01-Mei-2020</td>
                                    <td class="td-color_duedate">28-Mei-2020</td>
                                    <td>PO</td>
                                    <td class="sbold">PO#1237</td>
                                    <td align="center">IDR</td>
                                    <td></td>
                                    <td align="right">500.000</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="center">4</td>
                                    <td class="td-color_raiseddate">01-Mei-2020</td>
                                    <td class="td-color_duedate">28-Mei-2020</td>
                                    <td>PO</td>
                                    <td class="sbold">PO#1238</td>
                                    <td align="center">IDR</td>
                                    <td></td>
                                    <td align="right">1.000.000</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="center">5</td>
                                    <td class="td-color_raiseddate">01-Jun-2020</td>
                                    <td class="td-color_duedate">28-Jun-2020</td>
                                    <td>PO</td>
                                    <td class="sbold">PO#1239</td>
                                    <td align="center">IDR</td>
                                    <td align="right">100.000</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr style="background-color: #f6f6f6">
                                    <td></td>
                                    <td colspan="4" class="uppercase sbold">Total Supplier (Name) AA</td>
                                    <td>IDR</td>
                                    <td align="right" class="sbold">100.000</td>
                                    <td align="right" class="sbold">1.500.000</td>
                                    <td align="right" class="sbold">250.000</td>
                                    <td align="right" class="sbold">750.000</td>
                                    <td align="right" class="sbold">500.000</td>
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
<?php $this->load->view('header_footer/student_finance/footer_sub_modul_sf'); ?>