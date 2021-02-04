<?php $this->load->view('cashdisbursement/header'); ?>
<style>
@media (min-width: 992px){
    .page-content-wrapper .page-content {
        margin-left: 0px;        
    }

    .jumptarget::before {
      content:"";
      display:block;
      height:20px; /* fixed header height*/
      margin:-50px 0 0; /* negative fixed header height */
    }
}
</style>
<div class="container-fluid" style="background-color: #e9ecf3">
    <div class="page-content">
        <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <!-- <h1>Register Personal</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Create New Personal</a>
                </li>
                <li>
                    <a href="#">Data</a>
                </li>
                <li class="active">Form Input</li>
            </ol> -->
            <!-- Sidebar Toggle Button -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".page-sidebar">
                <span class="sr-only">Toggle navigation</span>
                <span class="toggle-icon">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </span>
            </button>
            <!-- Sidebar Toggle Button -->
        </div>
        <!-- END BREADCRUMBS -->
        <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
        <div class="page-content-container">
            <div class="page-content-row">
                <?php echo $this->session->flashdata('success_added'); ?>
                <?php echo $this->session->flashdata('error_msg_added'); ?>
                <form class="margin-bottom-40 form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/CashDisb/transfer_newcashdisbursement" enctype="multipart/form-data">
                    <div class="col-md-12" style="padding: 0px">
                        <div class="portlet light" style="background-color: #f6f6f6">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" style="margin-top: -5px">
                                    <div class="col-md-12">
                                        <div class="portlet-body">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label"><b>Document No <span><font color="red">*</font>:</span></b></label>
                                                    <div class="col-md-4">
                                                        <input name="manplanno" value="<?php echo str_pad($autoidnum,11,0,STR_PAD_LEFT) ?>" class="form-control" placeholder="Enter..." readonly>                                            
                                                    </div>    
                                                </div>
                                            </div>                                                                                               
                                        </div>
                                    </div>
                                    <div class="portlet light" style="background-color: #f6f6f6">
                                        <div class="row">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <span class="caption-subject font-dark sbold uppercase" ><i class="fa fa-warning"></i>  Required</span>
                                                    <p style="border: solid 1px;color: #555; margin-top: 5px"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="margin-top: -15px">
                                                <div class="portlet-body">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label"><b>School <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-4">
                                                                <select name="text" id="sch" class="form-control" required>
                                                                   
                                                                </select>                        
                                                            </div>   
                                                            <label class="col-md-2 control-label"><b>Type <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-4">
                                                                <input type="text" name="type" value="" class="form-control" placeholder="">                                     
                                                            </div> 
                                                        </div> 
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label"><b>Date Trans <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-4">
                                                                <input type="date" name="datetrans" value="" class="form-control" placeholder="">                                                    
                                                            </div>   
                                                            <label class="col-md-2 control-label"><b>PaidTo <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-4">
                                                                <input type="text" name="paidto" value="" class="form-control" placeholder="">                                                      
                                                            </div> 
                                                        </div>                                                         
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="portlet light" style="background-color: #f6f6f6; margin-top: -50px">
                                        <div class="row">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <span class="caption-subject font-dark sbold uppercase" ><i class="fa fa-warning"></i> Validation</span>
                                                    <p style="border: solid 1px;color: #555; margin-top: 5px"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="margin-top: -15px">
                                                <div class="portlet-body">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label"><b>Request By <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-4">
                                                                <input type="text" name="reqby" value="" class="form-control" placeholder="">                       
                                                            </div>   
                                                            <label class="col-md-2 control-label"><b>Request Date <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-4">
                                                                <input type="date" name="reqdate" value="" class="form-control" placeholder="">                        
                                                            </div> 
                                                        </div>                                             
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>                                            
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" style="border-left: solid; border-width: 1px; border-color: white;">
                                    <div class="col-md-12 col-sm-12 col-xs-12 invoice-payment" style="background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa">
                                        <label class="col-md-5 col-sm-5 control-label bold">Action:</label>
                                        <div class="col-md-7 col-sm-7">
                                            <input  id="submit_duty" type="submit" name="submitcashdisb" value="Submit" class="btn btn-transparent green btn-block btn-sm">                                     
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px; background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa"> 
                                        <h3><i class="fa fa-money"></i>&nbsp;Amounts</h3>
                                        <div class="portlet-body">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label"><b>Total :</b></label>
                                                    <div class="col-md-8">
                                                        <input type="number" name="total" value="" class="form-control text-right" readonly>                           
                                                    </div>                                                                   
                                                </div>                                                      
                                            </div>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: -20px; padding: 0px">
                        <div class="tabbable-line tabbable-custom-profile">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#details" data-toggle="tab"><b>Details</b></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="details">
                                    <div class="portlet light" style="background-color: #f4f7f8; margin-top: -30px">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover" id="table_detail_cashdisbursement">
                                                    <thead>
                                                        <tr>
                                                            <th width="3%"></th>
                                                            <th width="20%" class="text-center"> Item No <span><font color="red">*</font></span></th>              
                                                            <th width="16%" class="text-center"> Description  <span><font color="red">*</font></span></th>
                                                            <th width="15%" class="text-center"> Account No <span><font color="red">*</font></span></th>
                                                            <th width="10%" class="text-center"> Qty <span><font color="red">*</font></span></th>
                                                            <th width="16%" class="text-center"> Price <span><font color="red">*</font></span></th>
                                                            <th width="20%" class="text-center"> Remarks </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_body_detail_cashdisbursement">   
                                                    </tbody>
                                                </table>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
             </div>
         </div>
     </div>
</div>             
    
<script src="<?php echo base_url(); ?>assets/datetime-realtime/datetime-ind-format.js" type="text/javascript"></script>
<script type="text/javascript">
    // Notes : This Code Add row Copyright to mredkj.com - tabledeleterow.js version 1.2 2006-02-21
    window.onload = get_detail_addrow
    function get_detail_addrow() {
        document.body.style.zoom = 0.9;
        date_time('realtime_clock');
    }
</script>
<?php $this->load->view('cashdisbursement/footer'); ?>