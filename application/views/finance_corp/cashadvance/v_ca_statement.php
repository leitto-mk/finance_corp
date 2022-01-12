<?php $this->load->view('finance_corp/cashadvance/header_st'); ?>


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
                                                            <th width="20%" class="text-center">ID No</th>
                                                            <th width="70%" class="text-left uppercase" colspan="2">Register Name</th>         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php for($i = 0;$i < count($employees); $i++) : ?>
                                                            <tr class="sbold">
                                                                <td align="center" width="5%"><?= $i+1?></td>
                                                                <td align="center">
                                                                    <a href="javascript:;" name="emp_id" data-id="<?= $employees[$i]['IDNumber']?>"><?= $employees[$i]['IDNumber']?></a>
                                                                </td>
                                                                <td><?= $employees[$i]['FullName'] ?></td>
                                                            </tr>
                                                        <?php endfor; ?>
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
                                                                                <input type="text" id="idnumber" class="form-control bold" readonly>                    
                                                                            </div>                                                             
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label"><b><font color="red">*</font>&nbsp;Full Name<font color="white">_</font><span>:</span></b></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" id="fullname" class="form-control bold" readonly>                     
                                                                            </div>                                                             
                                                                        </div> 
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label"><b><font color="red">*</font>&nbsp;Job Title<font color="white">_</font><span>:</span></b></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" id="jobtitle" class="form-control bold" readonly>                  
                                                                            </div>                                                           
                                                                        </div>                                                    
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-body">
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label"><b><font color="red">*</font>&nbsp;Supervisor<font color="white">_</font><span>:</span></b></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" id="supervisor" class="form-control bold" readonly>                     
                                                                            </div>                                                             
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label"><b><font color="red">*</font>&nbsp;Department<font color="white">_</font><span>:</span></b></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" id="department" class="form-control bold" readonly>                    
                                                                            </div>                                                             
                                                                        </div> 
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label"><b><font color="red">*</font>&nbsp;Outstanding<font color="white">_</font><span>:</span></b></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" id="outstanding" class="form-control bold" readonly>                  
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
                                                        <tbody id="tbody_statement_details">
                                                            <tr class="sbold">
                                                                <td colspan="8" class="text-center">Select IDNumber...</td>
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
<?php $this->load->view('finance_corp/cashadvance/footer_st'); ?>
