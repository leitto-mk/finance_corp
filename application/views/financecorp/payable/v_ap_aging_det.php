<?php $this->load->view('financecorp/payable/header_rep_corp'); ?>
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
                                                <th class="text-center" width="15%">Department</th>
                                                <th class="text-center" width="15%">Bussines Unit</th>
                                                <th class="text-center" width="20%">Cost Center</th>
                                                <th class="text-center" width="15%">Start Date</th>
                                                <th class="text-center" width="15%">End Date</th>
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
                                <font size="4" class="font-dark sbold uppercase">Account Payable Aging Details</font><br>
                                <font size="3" class="font-dark sbold"><i class="fa fa-calendar"></i> Date : 01-Jan-2021 - 01-Jan-2021</font>
                            </div>
                        </div>
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark">Aged Due - Current</span>
                        </div>
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped table-condensed">
                                    <thead>
                                        <tr class="bg-blue-dark font-white">
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
                                        <tr class="bg-blue-dark font-white">
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
                                       <tr class="bg-blue-dark font-white">
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
                                        <tr class="bg-blue-dark font-white">
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
                                        <tr class="bg-blue-dark font-white">
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
    </div>
</div>
<script type="text/javascript">
    

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php $this->load->view('financecorp/payable/footer'); ?>