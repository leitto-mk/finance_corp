<?php $this->load->view('finance_corp/cashadvance/header_rep_corp'); ?>
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
                                <font size="4" class="font-dark sbold uppercase">Current Outstanding Balance</font><br>
                                <font size="3" class="font-dark sbold"><i class="fa fa-calendar"></i> Date : 01-Jan-2021 - 01-Jan-2021</font>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped table-condensed">
                                    <thead>
                                        <tr class="bg-blue-dark font-white">
                                            <th class="text-center" width="15%" colspan="2"> Deparment </th>
                                            <th class="text-center" width="25%"> Full Name </th>
                                            <th class="text-center" width="25%"> Job Title </th>
                                            <th class="text-center" width="25%"> Supervisor  </th>
                                            <th class="text-center" width="10%"> Outstanding </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="background-color: #578ebe6b">
                                            <td colspan="6" class="bold uppercase">Finance Accounting Department (Code)</td>
                                        </tr>
                                        <tr class="font-white sbold">
                                            <td align="center">1</td>                                 
                                            <td align="center">2000</td>
                                            <td align="left">Eduard Salindeho</td>
                                            <td align="left">Finance Accounting Supervisor</td>
                                            <td align="left">Sesca Londah - 2000</td>
                                            <td align="right"> 1,400,000</td>
                                        </tr>
                                        <tr class="font-white sbold">
                                            <td align="center">2</td>                                 
                                            <td align="center">2001</td>
                                            <td align="left">Sesca Londah</td>
                                            <td align="left">Accountant Officer</td>
                                            <td align="left">Sesca Londah - 2000</td>
                                            <td align="right"> 500,000</td>
                                        </tr>
                                        <tr class="font-white sbold">
                                            <td align="center">3</td>                                 
                                            <td align="center">2000</td>
                                            <td align="left">Pranayan Salindeho</td>
                                            <td align="left">Finance Coodinator</td>
                                            <td align="left">Sesca Londah - 2000</td>
                                            <td align="right"> 1,000,000</td>
                                        </tr>
                                        <tr class="font-dark sbold" style="border-top: solid 2px;">                          
                                            <td align="right" colspan="5">Total :</td>
                                            <td align="right">2,900,000</td>
                                        </tr>


                                        <tr style="background-color: #578ebe6b">
                                            <td colspan="6" class="bold uppercase">Operation Department (Code)</td>
                                        </tr>
                                        <tr class="font-white sbold">
                                            <td align="center">1</td>                                 
                                            <td align="center">2000</td>
                                            <td align="left">Eduard Salindeho</td>
                                            <td align="left">Finance Accounting Supervisor</td>
                                            <td align="left">Sesca Londah - 2000</td>
                                            <td align="right"> 1,400,000</td>
                                        </tr>
                                        <tr class="font-white sbold">
                                            <td align="center">2</td>                                 
                                            <td align="center">2001</td>
                                            <td align="left">Sesca Londah</td>
                                            <td align="left">Accountant Officer</td>
                                            <td align="left">Sesca Londah - 2000</td>
                                            <td align="right"> 500,000</td>
                                        </tr>
                                        <tr class="font-white sbold">
                                            <td align="center">3</td>                                 
                                            <td align="center">2000</td>
                                            <td align="left">Pranayan Salindeho</td>
                                            <td align="left">Finance Coodinator</td>
                                            <td align="left">Sesca Londah - 2000</td>
                                            <td align="right"> 1,000,000</td>
                                        </tr>
                                        <tr class="font-dark sbold" style="border-top: solid 2px;">                          
                                            <td align="right" colspan="5">Total :</td>
                                            <td align="right">2,900,000</td>
                                        </tr>


                                        <tr style="background-color: #578ebe6b">
                                            <td colspan="6" class="bold uppercase">Human Resource Department (Code)</td>
                                        </tr>
                                        <tr class="font-white sbold">
                                            <td align="center">1</td>                                 
                                            <td align="center">2000</td>
                                            <td align="left">Eduard Salindeho</td>
                                            <td align="left">Finance Accounting Supervisor</td>
                                            <td align="left">Sesca Londah - 2000</td>
                                            <td align="right"> 1,400,000</td>
                                        </tr>
                                        <tr class="font-white sbold">
                                            <td align="center">2</td>                                 
                                            <td align="center">2001</td>
                                            <td align="left">Sesca Londah</td>
                                            <td align="left">Accountant Officer</td>
                                            <td align="left">Sesca Londah - 2000</td>
                                            <td align="right"> 500,000</td>
                                        </tr>
                                        <tr class="font-white sbold">
                                            <td align="center">3</td>                                 
                                            <td align="center">2000</td>
                                            <td align="left">Pranayan Salindeho</td>
                                            <td align="left">Finance Coodinator</td>
                                            <td align="left">Sesca Londah - 2000</td>
                                            <td align="right"> 1,000,000</td>
                                        </tr>
                                        <tr class="font-dark sbold" style="border-top: solid 2px;">                          
                                            <td align="right" colspan="5">Total :</td>
                                            <td align="right">2,900,000</td>
                                        </tr>

                                        <tr class="bg-blue-ebonyclay font-white bold">                          
                                            <td align="right" colspan="5"> Grand Total :</td>
                                            <td align="right">8,700,000</td>
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
<?php $this->load->view('finance_corp/cashadvance/footer'); ?>