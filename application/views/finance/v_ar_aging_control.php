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
        <div class="col-md-12">
            <div class="bg-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="text-uppercase font-dark bold" style="margin-left: 10px">AR Aging Control</h4>
                    </div>
                </div>
            </div>
            <div class="portlet bordered light bg-blue-dark">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-white"><i class="fa fa-files-o"></i>&nbsp;&nbsp;Aged on Due Date Charges</span>
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
                                    <th class="text-center" width="15%"> 90 and Over </th>
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
                    <span class="caption-subject bold uppercase font-white"><i class="fa fa-files-o"></i> Details AR Aging</span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr class="font-dark sbold bg bg-white">
                                    <th class="text-left" colspan="7"> ROOM 1A - Wali Kelas: Fine Hiborang </th>
                                </tr>
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="3%"></th>
                                    <th class="text-center" width="22%"> Student </th>
                                    <th class="text-center" width="10%"> Charge Date </th>
                                    <th class="text-center" width="10%"> Room </th>
                                    <th class="text-center" width="15%"> Amount  </th>
                                    <th class="text-center" width="30%"> Remarks </th>
                                    <th class="text-center" width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: white">
                                    <td class="uppercase bold" colspan="7">Aged Due 1-30 Days</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td></td>
                                    <td align="left">2021 - Aaron Anes</td>  
                                    <td align="center"></td>                               
                                    <td align="center">1A</td>
                                    <td align="right">300.000</td>
                                    <td align="left"></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td></td>
                                    <td align="left">2022 - Smith James</td>
                                    <td align="center"></td>                                 
                                    <td align="center">1A</td>
                                    <td align="right">150.000</td>
                                    <td align="left"></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td colspan="4"></td>                                 
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">450.000</td>
                                    <td colspan="2"></td>
                                </tr>
                                <tr style="background-color: white">
                                    <td class="uppercase bold" colspan="7">Aged Due 31-60 Days</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td></td>
                                    <td align="left">2023 - Aaron Winter</td>  
                                    <td align="center"></td>                               
                                    <td align="center">1A</td>
                                    <td align="right">50.000</td>
                                    <td align="left"></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td></td>
                                    <td align="left">2024 - Smith Summer</td>
                                    <td align="center"></td>                                 
                                    <td align="center">1A</td>
                                    <td align="right">50.000</td>
                                    <td align="left"></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td colspan="4"></td>                                 
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">100.000</td>
                                    <td colspan="2"></td>
                                </tr>
                                <tr style="background-color: white">
                                    <td class="uppercase bold" colspan="7">Aged Due 61-90 Days</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td></td>
                                    <td align="left">2023 - Aaron Winter</td>  
                                    <td align="center"></td>                               
                                    <td align="center">1A</td>
                                    <td align="right">50.000</td>
                                    <td align="left"></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td></td>
                                    <td align="left">2024 - Smith Summer</td>
                                    <td align="center"></td>                                 
                                    <td align="center">1A</td>
                                    <td align="right">50.000</td>
                                    <td align="left"></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td colspan="4"></td>                                 
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">100.000</td>
                                    <td colspan="2"></td>
                                </tr>
                                <tr style="background-color: white">
                                    <td class="uppercase bold" colspan="7">Aged Due 91 & Over Days</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td></td>
                                    <td align="left">2023 - Aaron Winter</td>  
                                    <td align="center"></td>                               
                                    <td align="center">1A</td>
                                    <td align="right">50.000</td>
                                    <td align="left"></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td></td>
                                    <td align="left">2024 - Smith Summer</td>
                                    <td align="center"></td>                                 
                                    <td align="center">1A</td>
                                    <td align="right">50.000</td>
                                    <td align="left"></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td colspan="4"></td>                                 
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">100.000</td>
                                    <td colspan="2"></td>
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