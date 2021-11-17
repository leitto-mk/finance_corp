<?php $this->load->view('finance/student/header'); ?>


<style type="text/css">
    table {
        page-break-inside: auto
    }

    tr {
        page-break-inside: avoid;
        page-break-after: auto
    }

    td {
        page-break-inside: avoid;
        page-break-after: auto
    }

    thead {
        display: table-header-group
    }

    tfoot {
        display: table-footer-group
    }

    tr:nth-child(even){
        background-color: #eef1f5;
    }

    tr:nth-child(odd){
        background-color: white;
    }
</style>
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
      <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->             
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <h3 class="bold uppercase"><?php echo $h1; ?> <?php echo $h2; ?></h3>  
                            <!-- <i class="icon-bar-chart font-blue-madison"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Search Parameter to get data
                            </span> -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12" style="padding: 0px">
                                        <div class="portlet-body form-horizontal hidden-print" style="margin-top: 20px">
                                            <div>
                                                <table class="table table-bordered" style="margin-top: -20px">
                                                    <thead>
                                                        <tr class="bg-blue-madison font-white">   
                                                            <th width="70%" class="text-left uppercase" colspan="2">Register Name</th>         
                                                            <th width="20%" class="text-center">ID No</th>         
                                                            <th width="10%" class="text-center uppercase">Oustanding</th>         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                           <td colspan="17" class="bold" style="background-color: #578ebe6b">Finance Accounting</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">1</td>
                                                            <td>Eduard Salindeho</td>
                                                            <td align="center">2000</td>
                                                            <td align="center">250,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">2</td>
                                                            <td>Sesca Londah</td>
                                                            <td align="center">2001</td>
                                                            <td align="center">100,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">3</td>
                                                            <td>Pranayan Salindeho</td>
                                                            <td align="center">2002</td>
                                                            <td align="center">2,500,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">4</td>
                                                            <td>Jannice Salindeho</td>
                                                            <td align="center">2003</td>
                                                            <td align="center">500,000</td>
                                                        </tr>

                                                        <tr>
                                                           <td colspan="17" class="bold" style="background-color: #578ebe6b">Operation Department</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">1</td>
                                                            <td>Eduard Salindeho</td>
                                                            <td align="center">2000</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">2</td>
                                                            <td>Sesca Londah</td>
                                                            <td align="center">2001</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">3</td>
                                                            <td>Pranayan Salindeho</td>
                                                            <td align="center">2002</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">4</td>
                                                            <td>Jannice Salindeho</td>
                                                            <td align="center">2003</td>
                                                            <td align="center">750,000</td>
                                                        </tr>

                                                        <tr>
                                                           <td colspan="17" class="bold" style="background-color: #578ebe6b">Human Resource Department</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">1</td>
                                                            <td>Eduard Salindeho</td>
                                                            <td align="center">2000</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">2</td>
                                                            <td>Sesca Londah</td>
                                                            <td align="center">2001</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">3</td>
                                                            <td>Pranayan Salindeho</td>
                                                            <td align="center">2002</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">4</td>
                                                            <td>Jannice Salindeho</td>
                                                            <td align="center">2003</td>
                                                            <td align="center">750,000</td>
                                                        </tr> 
                                                        <tr class="sbold">
                                                            <td align="center">1</td>
                                                            <td>Eduard Salindeho</td>
                                                            <td align="center">2000</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">2</td>
                                                            <td>Sesca Londah</td>
                                                            <td align="center">2001</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">3</td>
                                                            <td>Pranayan Salindeho</td>
                                                            <td align="center">2002</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">4</td>
                                                            <td>Jannice Salindeho</td>
                                                            <td align="center">2003</td>
                                                            <td align="center">750,000</td>
                                                        </tr> 
                                                        <tr class="sbold">
                                                            <td align="center">1</td>
                                                            <td>Eduard Salindeho</td>
                                                            <td align="center">2000</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">2</td>
                                                            <td>Sesca Londah</td>
                                                            <td align="center">2001</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">3</td>
                                                            <td>Pranayan Salindeho</td>
                                                            <td align="center">2002</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">4</td>
                                                            <td>Jannice Salindeho</td>
                                                            <td align="center">2003</td>
                                                            <td align="center">750,000</td>
                                                        </tr> 
                                                        <tr class="sbold">
                                                            <td align="center">1</td>
                                                            <td>Eduard Salindeho</td>
                                                            <td align="center">2000</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">2</td>
                                                            <td>Sesca Londah</td>
                                                            <td align="center">2001</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">3</td>
                                                            <td>Pranayan Salindeho</td>
                                                            <td align="center">2002</td>
                                                            <td align="center">750,000</td>
                                                        </tr>
                                                        <tr class="sbold">
                                                            <td align="center">4</td>
                                                            <td>Jannice Salindeho</td>
                                                            <td align="center">2003</td>
                                                            <td align="center">750,000</td>
                                                        </tr>                                                     
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12" style="padding: 0px"> 
                                        <div class="portlet-body form-horizontal" style="margin-top: -20px">
                                                <div class="table-responsive">
                                                     <table class="table table-bordered">
                                                        <thead> 
                                                            <tr>   
                                                                <a href="#" class="btn btn-xs btn bg-blue-ebonyclay pull-right font-white uppercase">
                                                                    <i class="fa fa-print"></i>&nbsp;Print</i>
                                                                </a>   
                                                            </tr>
                                                            <tr>   
                                                                <th width="10%" class="text-left uppercase bg-blue-madison font-white">Statement Of Account
                                                                </th> 
                                                                <th width="10%" class="text-right uppercase bg-blue-madison"><!-- <font size="5">500</font> -->
                                                                </th>         
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-body">
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label"><b><font color="red">*</font>&nbsp;ID Number<font color="white">_</font><span>:</span></b></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control bold" value="254875" readonly>                         
                                                                            </div>                                                             
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label"><b><font color="red">*</font>&nbsp;Full Name<font color="white">_</font><span>:</span></b></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control bold" value="Eduard Salindeho" readonly>                          
                                                                            </div>                                                             
                                                                        </div> 
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label"><b><font color="red">*</font>&nbsp;Job Title<font color="white">_</font><span>:</span></b></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control bold" value="I / IA" readonly>                       
                                                                            </div>                                                           
                                                                        </div>                                                    
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-body">
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label"><b><font color="red">*</font>&nbsp;Supervisor<font color="white">_</font><span>:</span></b></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control bold" value="SD" readonly>                          
                                                                            </div>                                                             
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label"><b><font color="red">*</font>&nbsp;Department<font color="white">_</font><span>:</span></b></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control bold" value="I / IA" readonly>                         
                                                                            </div>                                                             
                                                                        </div> 
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label"><b><font color="red">*</font>&nbsp;Outstanding<font color="white">_</font><span>:</span></b></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control bold" value="1,500,000" readonly>                       
                                                                            </div>                                                           
                                                                        </div>                                                    
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-bordered" style="margin-top: -20px">
                                                        <thead> 
                                                            <tr style="background-color: #578ebe6b">
                                                                <th class="text-center" width="3%">No</th>
                                                                <th class="text-center" width="7%">Date</th>
                                                                <th class="text-center" width="15%">Doc No</th>
                                                                <th class="text-left" width="20%">Transaction Description</th>
                                                                <th class="text-left" width="20%">Accounts</th>
                                                                <th class="text-right" width="10%">Debit</th>
                                                                <th class="text-right" width="10%">Credit</th>
                                                                <th class="text-right" width="15%">Balance</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr class="sbold">
                                                                <td class="text-center">1</td>
                                                                <td class="text-center">01-Jan-21</td>
                                                                <td class="text-center">CWR2107-001</td>
                                                                <td class="text-left">Biaya Pendaftaran 1 Jan 2021</td>
                                                                <td class="text-left">51101 - CA Withdraw</td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right">1,000,000</td>
                                                                <td class="text-right">1,000,000</td>
                                                            </tr>

                                                            <tr class="sbold">
                                                                <td class="text-center">2</td>
                                                                <td class="text-center">05-Jan-21</td>
                                                                <td class="text-center">CWR2107-001</td>
                                                                <td class="text-left">Biaya Pendaftaran 5 Jan 2021</td>
                                                                <td class="text-left">Paid Electrical</td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right">500,000</td>
                                                                <td class="text-right">1,500,000</td>
                                                            </tr>

                                                            <tr class="sbold">
                                                                <td class="text-center">3</td>
                                                                <td class="text-center">10-Jan-21</td>
                                                                <td class="text-center">SRE2107-001</td>
                                                                <td class="text-left">Pembayaran Pendaftaran 10 Jan 2021</td>
                                                                <td class="text-left">Paid Phome</td>
                                                                <td class="text-right">500,000</td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right">1,000,000</td>
                                                            </tr>

                                                            <tr class="sbold">
                                                                <td class="text-center">4</td>
                                                                <td class="text-center">01-Feb-21</td>
                                                                <td class="text-center">SRE2107-001</td>
                                                                <td class="text-left">Biaya Pendaftaran 1 Feb 2021</td>
                                                                <td class="text-left">11401 - Student AR</td>
                                                                <td class="text-right">500,000</td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right">500,000</td>
                                                            </tr>

                                                            <tr class="sbold">
                                                                <td class="text-center">5</td>
                                                                <td class="text-center">05-Feb-21</td>
                                                                <td class="text-center">SRE2107-001</td>
                                                                <td class="text-left">Pembayaran Pendaftaran 5 Feb 2021</td>
                                                                <td class="text-left">11101 - Cash</td>
                                                                <td class="text-right">100,000</td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right">400,000</td>
                                                            </tr>

                                                            <tr class="sbold">
                                                                <td class="text-center">6</td>
                                                                <td class="text-center">10-Feb-21</td>
                                                                <td class="text-center">CWR2107-001</td>
                                                                <td class="text-left">Biaya Pendaftaran 10 Feb 2021</td>
                                                                <td class="text-left">51103 - Uniform Charge</td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right">100,000</td>
                                                                <td class="text-right">500,000</td>
                                                            </tr>

                                                            <tr class="sbold">
                                                                <td class="text-center">7</td>
                                                                <td class="text-center"></td>
                                                                <td class="text-left"></td>
                                                                <td class="text-left"></td>
                                                                <td class="text-left"></td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right"></td>
                                                            </tr>

                                                            <tr class="sbold">
                                                                <td class="text-center">8</td>
                                                                <td class="text-center"></td>
                                                                <td class="text-left"></td>
                                                                <td class="text-left"></td>
                                                                <td class="text-left"></td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right"></td>
                                                                <td class="text-right"></td>
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
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
window.onload = load_function;
function load_function(){
    document.body.style.zoom = 0.85;
}
function printDivSum(divName) {
var printContents = document.getElementById(divName).innerHTML;
var originalContents = document.body.innerHTML;
document.body.innerHTML = printContents;
window.print();
document.body.innerHTML = originalContents;
}

function printDivDet(divName) {
var printContents = document.getElementById(divName).innerHTML;
var originalContents = document.body.innerHTML;
document.body.innerHTML = printContents;
window.print();
document.body.innerHTML = originalContents;
}
</script>
<?php $this->load->view('finance/student/footer'); ?>
