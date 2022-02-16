<?php $this->load->view('finance_corp/payable/header_rep_corp'); ?>
<style type="text/css">
    tr:nth-child(even){
        background-color: #eef1f5;
    }

    tr:nth-child(odd){
        background-color: white;
    }
</style>
<div class="portlet light">
    <div class="row">
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left hidden-print">
                    <div class="portlet light form-horizontal bg-default">
                        <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                            <div class="portlet-body form-horizontal hidden-print" style="margin-top: 60px">
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th width="5%"></th>
                                                <th class="text-center" width="15%">Branch</th>
                                                <th class="text-center" width="15%">Type</th>
                                                <th class="text-center" width="15%">Start Date</th>
                                                <th class="text-center" width="20%">End Date</th>
                                                <th class="text-center" width="15%">Doc No Start</th>
                                                <th class="text-center" width="15%">Doc No End</th>
                                                <th class="text-center" width="5%">Action</th>        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label bold">Parameters</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="school" name="school" class="form-control" required>
                                                                <option value="All">All</option>
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="school" name="school" class="form-control" required>
                                                                <option value="All">All</option>
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="date" name="date_start" id='date_start' value="<?= date('Y-01-01') ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="date" name="date_finish" id='date_finish' value="<?= date('Y-m-d') ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="school" name="school" class="form-control" required>
                                                                <option value="All">All</option>
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="school" name="school" class="form-control" required>
                                                                <option value="All">All</option>
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <a class="btn btn-sm bg-blue-madison font-white" id="submit_filter">
                                                                <center>PREVIEW</center>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                                                           
                            </div>
                        <?php echo form_close(); ?>
                    </div>  
                </div>
                <div class="col-md-12">
                    <div class="portlet bordered light">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-logo-space text-center" style="margin-top: -5px">
                            <div>
                                <font size="6">Company Name</font><br>
                                <font size="4" class="font-dark sbold uppercase">Journal Report</font><br>
                                <font size="3" class="font-dark sbold"><i class="fa fa-calendar"></i> Period : 01-Jan-2021 - 31-Jan-2021</font>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped table-condensed">
                                    <thead>
                                        <tr class="bg-blue-dark font-white">
                                            <th class="text-center" width="7%"> Trans Date </th>
                                            <th class="text-center" width="5%"> Doc No </th>
                                            <th class="text-center" width="5%"> Type </th>
                                            <th class="text-center" width="12%"> Description </th>
                                            <th class="text-center" width="8%"> Dept </th>
                                            <th class="text-center" width="8%"> CostC </th>
                                            <th class="text-center" width="5%"> Account </th>
                                            <th class="text-center" width="15%"> Acc Name </th>
                                            <th class="text-center" width="5%"> Cry </th>
                                            <th class="text-center" width="5%"> Rate </th>
                                            <th class="text-center" width="5%"> Unit </th>
                                            <th class="text-center" width="10%"> Debet </th>
                                            <th class="text-center" width="10%"> Credit </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="font-dark sbold">
                                            <td align="center">1-Jan-2021</td>
                                            <td align="center">12345</td>                                    
                                            <td align="center">Receipt</td>
                                            <td align="left">Cash</td>
                                            <td align="left">AAA</td>
                                            <td align="left">123</td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="center">IDR  </td>
                                            <td align="center"></td>
                                            <td align="center"></td>
                                            <td align="right">10,000.00</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr class="font-dark sbold">
                                            <td align="center">2-Jan-2021</td>
                                            <td align="center">12345</td>                                    
                                            <td align="center">Receipt</td>
                                            <td align="left">Penjualan Tunai Harian</td>
                                            <td align="left">AAA</td>
                                            <td align="left">123</td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="center">IDR  </td>
                                            <td align="center"></td>
                                            <td align="center"></td>
                                            <td align="right">-</td>
                                            <td align="right">10,000.00</td>
                                        </tr>
                                        <tr class="font-dark sbold">
                                            <td colspan="11"></td>
                                            <td align="right" style="border-top: solid 2px">10,000.00</td>
                                            <td align="right" style="border-top: solid 2px">10,000.00</td>
                                        </tr>


                                        <tr class="font-dark sbold">
                                            <td align="center">1-Jan-2021</td>
                                            <td align="center">12345</td>                                    
                                            <td align="center">Receipt</td>
                                            <td align="left">Cash</td>
                                            <td align="left">AAA</td>
                                            <td align="left">123</td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="center">IDR  </td>
                                            <td align="center"></td>
                                            <td align="center"></td>
                                            <td align="right">20,000.00</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr class="font-dark sbold">
                                            <td align="center">2-Jan-2021</td>
                                            <td align="center">12345</td>                                    
                                            <td align="center">Receipt</td>
                                            <td align="left">Penjualan Tunai Harian</td>
                                            <td align="left">AAA</td>
                                            <td align="left">123</td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="center">IDR  </td>
                                            <td align="center"></td>
                                            <td align="center"></td>
                                            <td align="right">-</td>
                                            <td align="right">20,000.00</td>
                                        </tr>
                                        <tr class="font-dark sbold">
                                            <td colspan="11"></td>
                                            <td align="right" style="border-top: solid 2px">20,000.00</td>
                                            <td align="right" style="border-top: solid 2px">20,000.00</td>
                                        </tr>

                                        <tr class="font-dark sbold">
                                            <td align="center">1-Jan-2021</td>
                                            <td align="center">12345</td>                                    
                                            <td align="center">Receipt</td>
                                            <td align="left">Penjualan Kredit</td>
                                            <td align="left">AAA</td>
                                            <td align="left">123</td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="center">IDR  </td>
                                            <td align="center"></td>
                                            <td align="center"></td>
                                            <td align="right">5,000.00</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr class="font-dark sbold">
                                            <td align="center">2-Jan-2021</td>
                                            <td align="center">12345</td>                                    
                                            <td align="center">Receipt</td>
                                            <td align="left">Penjualan Kredit Harian</td>
                                            <td align="left">AAA</td>
                                            <td align="left">123</td>
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="center">IDR  </td>
                                            <td align="center"></td>
                                            <td align="center"></td>
                                            <td align="right">-</td>
                                            <td align="right">5,000.00</td>
                                        </tr>
                                        <tr class="font-dark sbold">
                                            <td colspan="11"></td>
                                            <td align="right" style="border-top: solid 2px">5,000.00</td>
                                            <td align="right" style="border-top: solid 2px">5,000.00</td>
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
<?php $this->load->view('finance_corp/payable/footer'); ?>