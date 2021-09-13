<?php $this->load->view('header_footer/finance_corp/header_sub_modul_sf_no_trees'); ?>
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
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
            <!-- <php $date = date("d-M-Y") ?> -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-logo-space text-center" style="margin-top: 15px">
                    <div>
                        <font size="6" class="uppercase">Company Name</font><br>
                        <font size="4" class="font-dark sbold uppercase">Balance Sheet</font><br>
                        <font size="4" class="font-dark sbold">31 Juli 2021</font><br>
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
                                            <th> Asset </th>
                                            <th></th>
                                            <th></th>
                                            <th>Liabilities </th>
                                            <th> </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bold">
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;Current Asset</td>
                                            <td align="right"></td>
                                            <td align="right"></td>
                                            <td>&nbsp;&nbsp;&nbsp;Current Liabilities</td>
                                            <td align="right"></td>
                                            <td align="right"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cash</td>
                                            <td align="right">150,000</td>
                                            <td align="right"></td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accounts payable</td>
                                            <td align="right">160,000</td>
                                            <td align="right"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Trading Securities</td>
                                            <td align="right">70,000</td>
                                            <td align="right"></td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Salaries payable</td>
                                            <td align="right">30,000</td>
                                            <td align="right"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accounts receivable</td>
                                            <td align="right">110,000</td>
                                            <td align="right"></td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Interest payable</td>
                                            <td align="right" style="border-bottom: solid 1px;">10,000</td>
                                            <td align="right">200,000</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inventories</td>
                                            <td align="right" style="border-bottom: solid 1px;">220,000</td>
                                            <td align="right">550,000</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td align="right"></td>
                                            <td align="right"></td>
                                        </tr>




                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;Property, plant & equipment</td>
                                            <td align="right"></td>
                                            <td align="right"></td>
                                            <td>&nbsp;&nbsp;&nbsp;Long-term liabilities</td>
                                            <td align="right"></td>
                                            <td align="right"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Land</td>
                                            <td align="right">135,000</td>
                                            <td align="right"></td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notes payable</td>
                                            <td align="right">240,000</td>
                                            <td align="right"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buildings and equipment (net)</td>
                                            <td align="right" style="border-bottom: solid 1px;">375,000</td>
                                            <td align="right">510,000</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mortgage liability</td>
                                            <td align="right" style="border-bottom: solid 1px;">110,000</td>
                                            <td align="right" style="border-bottom: solid 1px;">350,000</td>
                                        </tr>

                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td align="right"></td>
                                            <td align="right"></td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td align="right"></td>
                                            <td align="right">550,000</td>
                                        </tr>




                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;Intangible asset</td>
                                            <td align="right"></td>
                                            <td align="right"></td>
                                            <td>&nbsp;&nbsp;&nbsp;Stockholder's equity</td>
                                            <td align="right"></td>
                                            <td align="right"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Patent</td>
                                            <td align="right">225,000</td>
                                            <td align="right"></td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Capital stock</td>
                                            <td align="right">330,000</td>
                                            <td align="right"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Goodwill</td>
                                            <td align="right" style="border-bottom: solid 1px;">65,000</td>
                                            <td align="right" style="border-bottom: solid 1px;">290,000</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Retained earnings</td>
                                            <td align="right" style="border-bottom: solid 1px;">500,000</td>
                                            <td align="right" style="border-bottom: solid 1px;">800,000</td>
                                        </tr>




                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;Total asset</td>
                                            <td align="right"></td>
                                            <td align="right" style="border-bottom: solid 2px;">1,350,000</td>
                                            <td>&nbsp;&nbsp;&nbsp;Total liabilities and equity</td>
                                            <td align="right"></td>
                                            <td align="right" style="border-bottom: solid 2px;">1,350,000</td>
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
    window.onload = load_function;

    function load_function() {
        document.body.style.zoom = 0.9;
    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php $this->load->view('header_footer/finance_corp/footer_sub_modul_sf'); ?>