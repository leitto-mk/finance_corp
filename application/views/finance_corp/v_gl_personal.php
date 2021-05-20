<?php $this->load->view('header_footer/finance_corp/header_sub_modul_sf_no_trees'); ?>
<div class="portlet light">
    <div class="row">
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="portlet bordered light bg-blue-dark">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-white"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Date :  01-Jan-2021 - 06-Mei-2021
                        <div class="input-group input-large pull-right" style="margin-top: -5px">
                           <!--  <input type="text" class="form-control" placeholder="Search for..." name="search_item" id="search_item">
                            <span class="input-group-btn">
                                <button  class="btn dark">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span> -->
                            <span class="input-group-btn">
                                <a href="#" class="btn btn-md btn green hidden-print pull-right"  onclick="printDiv('printDiv')" style="margin-left: 5px">
                                    <i class="fa fa-plus"></i>&nbsp;Print</i>
                                </a>
                                <a onclick="window.close();" class="btn btn-md btn red hidden-print pull-right"><i class="fa fa-close"></i> Close</a>
                            </span>

                        </div> 
                    </span>
                </div>   
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="7%"> Date </th>
                                    <th class="text-center" width="8%"> Doc No </th>
                                    <th class="text-center" width="13%"> Cheque/Giro </th>
                                    <th class="text-center" width="8%"> Branch </th>
                                    <th class="text-center" width="5%"> Year </th>
                                    <th class="text-center" width="5%"> Month </th>
                                    <th class="text-center" width="8%"> AccNo  </th>
                                    <th class="text-center" width="16%"> Remarks </th>
                                    <th class="text-right" width="10%"> Debit </th>
                                    <th class="text-right" width="10%"> Credit </th>
                                    <th class="text-right" width="13%"> Balance </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: white">
                                    <td colspan="11" class="bold">10001 - Pranayan Salindeho</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td class="bold" align="right" colspan="9">Beginning Balance</td>
                                    <td class="bold" align="right" colspan="2">0.00</td>
                                </tr>
                                <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                    <td align="right" colspan="8">Total :</td>                                    
                                    <td align="right">0.00</td>                                    
                                    <td align="right">0.00</td>                                 
                                    <td align="right" class="font-white sbold bg bg-blue-ebonyclay">0.00</td>
                                </tr>



                                <tr style="background-color: white">
                                    <td colspan="11" class="bold">10002 - Michio Kumaunang</td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td class="bold" align="right" colspan="9">Beginning Balance</td>
                                    <td class="bold" align="right" colspan="2">0.00</td>
                                </tr>

                                <tr class="font-white sbold">
                                    <td class="bold" align="center">06-05-2021</td>
                                    <td class="bold" align="">2021-00001</td>
                                    <td class="bold" align="">TEST2021-00001</td>
                                    <td class="bold" align="">JKT</td>
                                    <td class="bold" align="">2020</td>
                                    <td class="bold" align="">Mei</td>
                                    <td class="bold" align="">1100104</td>
                                    <td class="bold" align="">Test JKT 2021-00001</td>
                                    <td class="bold" align="right">0.00</td>
                                    <td class="bold" align="right">3.000.000.00</td>
                                    <td class="bold" align="right">3.000.000.00</td>
                                </tr>

                                <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                    <td align="right" colspan="8">Total :</td>                                    
                                    <td align="right">0.00</td>                                    
                                    <td align="right">0.00</td>                                 
                                    <td align="right" class="font-white sbold bg bg-blue-ebonyclay">0.00</td>
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

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php $this->load->view('header_footer/finance_corp/footer_sub_modul_sf'); ?>