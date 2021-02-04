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
<div class="container-fluid" style="background-color: #e9ecf3;">
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
                <form class="margin-bottom-40" method="post" action="<?php echo base_url(); ?>index.php/CashDisb/submit_datacashvoucher" enctype="multipart/form-data">
                    <div class="col-md-12" style="padding: 0px">
                        <div class="portlet light" style="background-color: #f6f6f6">
                            <div class="row">                                           
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" style="border-left: solid; border-width: 1px; border-color: white; margin-top: -20px">
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px; background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa"> 
                                        <h3><i class="fa fa-edit"></i>&nbsp;Master </h3>
                                        <?php foreach ($get_data_mas_save_cash_voucher as $cv){ ?>
                                            <div class="portlet-body form-horizontal">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><b>Document No <span><font color="red">*</font>:</span></b></label>
                                                        <div class="col-md-8">
                                                            <input class="form-control input-sm font-dark" id ="cashcode" name="cashcode" value="<?php echo $cv->CashCode ?>" placeholder="" readonly>                                    
                                                        </div>    
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><b>Request By <span><font color="red">*</font></span>:</b></label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="reqby" value="<?php echo $cv->ReqBy ?>" class="form-control" required>                           
                                                        </div>                                                                   
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><b>School <span><font color="red">*</font></span></b></label>
                                                        <div class="col-md-8">
                                                            <select  name="sch" class="form-control" required>
                                                                <?php foreach ($schoolsave as $ssave){ ?>
                                                                    <option value="<?php echo $ssave->Branch ?>"><?php echo $ssave->SchoolName ?><span>*</span></option>
                                                                <?php } ?>
                                                                <?php foreach($school as $s) { ?> 
                                                                    <option  value="<?php echo $s->SchoolID?>"><td><?php echo $s->SchoolName ?></td></option>
                                                                <?php } ?>
                                                            </select> 
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><b>Cost Center <span><font color="red">*</font></span></b></label>
                                                        <div class="col-md-8"> 
                                                            <select  name="cc" class="form-control" required>
                                                                <?php foreach ($costcentersave as $ccsave){ ?>
                                                                    <option value="<?php echo $ccsave->CostCenterCode ?>"><?php echo $ccsave->CCDes ?><span>*</span></option>
                                                                <?php } ?>
                                                                <?php foreach($costcenter as $c) { ?> 
                                                                    <option  value="<?php echo $c->CostCenter?>"><?php echo $c->CCDes ?></option>
                                                                <?php } ?>
                                                            </select> 
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><b>Paid To <span><font color="red">*</font></span>:</b></label>
                                                        <div class="col-md-8">
                                                            <select  name="paidto" class="form-control" required>
                                                                <?php foreach ($teacher_staffsave as $tssave){ ?>
                                                                    <option value="<?php echo $tssave->PaidTo ?>"><?php echo $tssave->FirstName ?> <?php echo $tssave->MiddleName ?> <?php echo $tssave->LastName ?><span>*</span></option>
                                                                <?php } ?>
                                                                <?php foreach($teacher_staff as $ts) { ?> 
                                                                    <option  value="<?php echo $ts->IDNumber?>"><?php echo $ts->FirstName ?> <?php echo $ts->MiddleName ?> <?php echo $ts->LastName ?></option>
                                                                <?php } ?>
                                                            </select>                         
                                                        </div>                                                                   
                                                    </div>                                                    
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><b>Date Trans <span><font color="red">*</font>:</span></b></label>
                                                        <div class="col-md-8">
                                                            <input type="date" name="datetrans" value="<?php echo $cv->DateTrans ?>" class="form-control" placeholder="" required>                                                    
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><b>Work Order <span><font color="red">*</font>:</span></b></label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="wo" value="<?php echo $cv->WO ?>" class="form-control" placeholder="" required>                                                      
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><b>Remarks <span>:</span></b></label>
                                                        <div class="col-md-8">
                                                            <input name="remarks" value="<?php echo $cv->Remarks ?>" class="form-control">                 
                                                        </div>   
                                                    </div>  
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>           
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" style="margin-top: 0px">
                                    <div class="row form-horizontal">
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="portlet-body">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label"><b>Total :</b></label>
                                                        <div class="col-md-7">
                                                            <input type="number" id="total_amount" value="0" class="form-control text-right bold" readonly style="background-color: white">                           
                                                        </div>                                                                   
                                                    </div>                                                      
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: -5px">
                                            <div class="portlet light">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th width="5%"></th>        
                                                                <th width="30%"><font color="white">____________</font>Description<span><font color="red">*</font></span><font color="white">____________</font></th>
                                                                <th width="10%"><font color="white">______</font>Account<span><font color="red">*</font></span><font color="white">______</font></th>
                                                                <th width="10%"><font color="white">_____</font>Qty<span><font color="red">*</font></span><font color="white">_____</font></th>
                                                                <th width="20%"><font color="white">______</font>Price<span><font color="red">*</font></span><font color="white">______</font></th>
                                                                <th width="25%"><font color="white">______</font>Amount<font color="white">______</font></th>
                                                                <!-- <th width="28%" class="text-center"> Remarks </th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="get_cash_vocher">
                                                        </tbody>
                                                        <tbody id="row-input">
                                                        <tr>
                                                            <td><a class="btn btn-success" title="Add Data" onclick="input_row_cashvoucher()">+</a></td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control input-md required-input" id="desc" placeholder="Enter Description">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <select id="accno" class="form-control input-md required-input">
                                                                        <option value="">--Pilih Account--</option>
                                                                        <?php foreach($accno as $cvacc) { ?> 
                                                                            <option  value="<?php echo $cvacc->Acc_No?>"><?php echo $cvacc->Acc_Name ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control input-md required-input qty-cls text-right" min="1" value="1" id="qty" value=""  placeholder="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control input-md required-input price-cls text-right" min="1" value="1" id="price" value="" placeholder="">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control input-md amount-avb text-right" id="amount" value="0" readonly placeholder="">
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br> 
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>     
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="background-color: #f6f6f6; margin-left: 30px; margin-top: -10px;">
                                                <label class="col-md-10 col-sm-10 control-label bold"></label>
                                                <div class="col-md-2 col-sm-2 pull-right">
                                                    <input type="submit" name="save" value="Save" disabled="" class="btn green btn-sm yellow">
                                                    <input type="submit" name="submit" value="Submit" class="btn btn-transparent green btn-sm" onclick="return confirm('Are You Sure? Please! Check before submit!!!')">                                   
                                                </div>
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
    window.onload = loadall
    function loadall() {
        document.body.style.zoom = 0.9;
        get_data_detail_cashvoucher();
    }

    function get_data_detail_cashvoucher() {
        var idcv = $('#cashcode').val();
        $.ajax({
          url:"<?php echo site_url('CashDisb/get_data_det_cashvoucher') ?>",
          type: "POST",
          dataType: "json",
          data: {idcv : idcv},
          beforeSend: function(){
            // Show image container
            $("#loader").show();
          },
          success: function(data){
            $('#get_cash_vocher').html(data.render)
            $('#total_amount').val(data.tot_amount)
          },
          complete:function(){
            // Hide image container
            $("#loader").hide();
          },
          error: function(data){
            alert('Error occur...!!');
            console.log(data.tot_amount)
            // console.log(data.responseText);
          }
        });


        $('#row-input, #get_cash_vocher').on('keyup','.qty-cls, .price-cls', function(){
            let sibs = $(this).parents('td')
            let amount = sibs.siblings().find('.amount-cls, .amount-avb')

            if($(this).is('.price-cls')){
                let qty = sibs.siblings().find('.qty-cls').val()

                let amount_val = (qty * $(this).val())
                amount.val(amount_val)
                
                countAmount();
            }else if($(this).is('.qty-cls')){
                let qty = sibs.siblings().find('.price-cls').val()

                let amount_val = (qty * $(this).val())
                amount.val(amount_val)
                
                countAmount();

            }
        })

        $('#row-input, #get_cash_vocher').on('change','.qty-cls, .price-cls', function(){
            let sibs = $(this).parents('td')
            let amount = sibs.siblings().find('.amount-cls, .amount-avb')

            if($(this).is('.price-cls')){
                let qty = sibs.siblings().find('.qty-cls').val()

                let amount_val = (qty * $(this).val())
                amount.val(amount_val)
                
                countAmount();
            }else if($(this).is('.qty-cls')){
                let qty = sibs.siblings().find('.price-cls').val()

                let amount_val = (qty * $(this).val())
                amount.val(amount_val)
                
                countAmount();
            }
        })
    }   

    function countAmount(){
        var total_amount = 0;
        $('.amount-avb').each(function(){
            total_amount = (total_amount + parseInt($(this).val()))
        })

        console.log(total_amount)
        $('#total_amount').val(total_amount)
    }

    function input_row_cashvoucher(){
        var newcvdesc = $('#desc').val();
        var newcvaccno = $('#accno').val();
        var newcvqty = $('#qty').val();
        var newcvprice = $('#price').val();
        var newcvamount = $('#amount').val();
        var idcv = $('#cashcode').val();

        let i = 0;
        $('.required-input').each(function(){
            if($(this).val() == ''){
                i += 1;
                $(this).closest('.form-group').addClass('has-error')
            }
        })

        if(i == 0){
            $.ajax({
                url : "<?php echo site_url('CashDisb/inputrowcashvoucher') ?>",
                type    : "POST",
                dataType    : "json",
                data : {new_cvdesc : newcvdesc , new_cvaccno : newcvaccno, new_cvqty : newcvqty, new_cvprice : newcvprice, new_cvamount : newcvamount, id_cv : idcv},
                success : function (data){
                    $('#desc').val('');
                    $('#accno').val('');
                    $('#qty').val(1);
                    $('#price').val(1);
                    $('#amount').val(0);
                    alert ('Data has been added!');
                    get_data_detail_cashvoucher();

                    if($('.form-group').hasClass('has-error')){
                        $('.form-group').removeClass('has-error');
                    }

                    countAmount()
                }, error : function () {
                    alert ('Error occur...!!!');
                }
            });
        }
    }

    function delete_cashvoucher(cash_det_no){
        if (confirm("Are yoou sure to delete this data?")) {
             $.ajax({
                url : "<?php echo site_url('CashDisb/delrowbudget') ?>",
                type    : "POST",
                dataType    : "json",
                data : {cash_det_no : cash_det_no},
                success : function (data){
                    alert ('Data has been deleted!');
                    get_data_detail_cashvoucher();
                }, error : function () {
                    alert ('Error occur...!!!');
                }
            });
        }else{

        }  
    }
</script>
<?php $this->load->view('cashdisbursement/footer'); ?>