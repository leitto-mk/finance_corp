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
                                                        <input class="form-control input-sm font-dark" name="BudgetCode" value="<?php echo str_pad($autoidnum,9,0,STR_PAD_LEFT) ?>" placeholder="" readonly>                                    
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
                                                        <!-- <div class="form-group">
                                                            <label class="col-md-2 control-label"><b>School <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-4">
                                                                <select name="text" id="sch" class="form-control" required>
                                                                   
                                                                </select>                        
                                                            </div>   
                                                            <label class="col-md-2 control-label"><b>Type <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-4">
                                                                <input type="text" name="type" value="" class="form-control" placeholder="">                                     
                                                            </div> 
                                                        </div>  -->
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label"><b>Date Trans <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-4">
                                                                <input type="date" name="datetrans" value="" class="form-control" placeholder="" required>                                                    
                                                            </div>   
                                                            <label class="col-md-2 control-label"><b>Work Order <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-4">
                                                                <input type="text" name="paidto" value="" class="form-control" placeholder="" required>                                                      
                                                            </div> 
                                                        </div> 
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label"><b>Justification <span>:</span></b></label>
                                                            <div class="col-md-10">
                                                                <textarea name="detail" class="form-control" rows="5" style="resize: none;"></textarea>                 
                                                            </div>   
                                                        </div>                                                     
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                   <!--  <div class="portlet light" style="background-color: #f6f6f6; margin-top: -50px">
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
                                    </div> -->
                                </div>                                            
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" style="border-left: solid; border-width: 1px; border-color: white; margin-top: -20px">
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px; background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa"> 
                                        <h3><i class="fa fa-edit"></i>&nbsp;Validation </h3>
                                        <div class="portlet-body">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label"><b>Request By <span><font color="red">*</font></span>:</b></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="reqby" class="form-control" required>                           
                                                    </div>                                                                   
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label"><b>Request Date <span><font color="red">*</font></span>:</b></label>
                                                    <div class="col-md-8">
                                                        <input type="date" name="reqdate" class="form-control" required>                           
                                                    </div>                                                                   
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label"><b>Paid To <span><font color="red">*</font></span>:</b></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="paidto" class="form-control" required>                           
                                                    </div>                                                                   
                                                </div>                                                    
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px; background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa"> 
                                        <h3><i class="fa fa-money"></i>&nbsp;Amounts</h3>
                                        <div class="portlet-body">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label"><b>Total :</b></label>
                                                    <div class="col-md-8">
                                                        <input type="number" id="total_amount" value="0" class="form-control text-right" readonly>                           
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
                                                            <th width="26%" class="text-center"> Description  <span><font color="red">*</font></span></th>
                                                            <!-- <th width="10%" class="text-center"> Account No <span><font color="red">*</font></span></th> -->
                                                            <th width="10%" class="text-center"> Qty <span><font color="red">*</font></span></th>
                                                            <th width="15%" class="text-center"> Price <span><font color="red">*</font></span></th>
                                                            <th width="18%" class="text-center"> Amount</th>
                                                            <th width="28%" class="text-center"> Remarks </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_body_detail_cashdisbursement">   
                                                    </tbody>
                                                </table>
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
                    <div class="col-md-12 col-sm-12 col-xs-12 invoice-payment" style="background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa;">
                        <label class="col-md-10 col-sm-10 control-label bold">Action:</label>
                        <div class="col-md-2 col-sm-2">
                            <input  id="submit_duty" type="submit" name="submitcashdisb" value="Submit" class="btn btn-transparent green btn-block btn-sm">                                     
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

        fillInRows3();
        var id = 1;
        // load_accno(id); 
    }
    /*Data Cash*/
    var TABLE_NAME3 = 'table_detail_cashdisbursement';
    var TABLE_BODY3 = 'table_body_detail_cashdisbursement';
    var ROW_BASE3 = 1;
    var hasLoaded3 = false;
    var maxRows3 = 30;
    var ctrow3 = 1;
    var trow3 = 1;
    var iteration3 = 1;

    function fillInRows3() {
        hasLoaded3 = true;     
        addRowToTable3();      
        trow3 = document.getElementById(TABLE_BODY3).getElementsByTagName("tr").length;
        // console.log(trow);   
       
    }
    function check_addrow3(desc, remarks, idc){
        if ($('#'+desc).val() != '' && $('#'+remarks).val() != '') {
            if(ctrow3 < maxRows3){       
                addRowToTable3();
                // console.log(ctrow3, maxRows3);
                var id= idc;
                // load_accno(id); 
                ctrow3++;

            } else {
                alert("Reached Max Row (30 Records)");
            }
        }                
    }
    function addRowToTable3(num){
        if(hasLoaded3) {
            var tbl = document.getElementById(TABLE_NAME3);
            var nextRow = tbl.tBodies[0].rows.length;        
            iteration3 = nextRow + ROW_BASE3;
            if (num == null){
                    num = nextRow;                    
            } else {
                iteration3 = num + ROW_BASE3;
            }
            // console.log("this i :" , iteration);
            // console.log("COUNT : " + ctrow2);
            // add the row
            var row = tbl.tBodies[0].insertRow(num);

            // CONFIG: requires classes named classy0 and classy1
            row.className = 'classy' + (iteration3 % 2);

            // CONFIG: this whole section can be configured
            
            // cell 0
            var cell0 = row.insertCell(0);
            // var con1 = '<td><button id="sample_editable_1_new" class="btn btn-primary"> '+iteration+' </button></td>';
            var con0 = document.createElement('input');
            con0.setAttribute('id', 'ordernumber_'+iteration3);
            con0.setAttribute('type', 'Button');
            con0.setAttribute('class', 'btn btn-primary');
            con0.setAttribute('value', iteration3);
            con0.onclick = function() {
                deleteCurrentRow3(this)

            };
            cell0.appendChild(con0);

            // cell 1
            var cell1 = row.insertCell(1);
            var con1 = document.createElement('input');
            con1.setAttribute('id', 'desc_'+iteration3);
            con1.setAttribute('type', 'text');
            con1.setAttribute('name', 'itemno_[]');
            con1.setAttribute('class', 'form-control');
            con1.setAttribute('placeholder', 'Enter Description');
            con1.setAttribute('required', 'true');
            cell1.appendChild(con1);

            // cell 2
            // var cell2 = row.insertCell(2);
            // var con2 = document.createElement('input');
            // con2.setAttribute('id', 'budgettype_'+iteration3);
            // con2.setAttribute('type', 'text');
            // con2.setAttribute('name', 'budgettype_[]');
            // con2.setAttribute('class', 'form-control');
            // con2.setAttribute('required', 'true');
            // con2.setAttribute('placeholder', 'Enter');
            // cell2.appendChild(con2);

            // cell 3
            // var cell3 = row.insertCell(2);
            // var con3 = document.createElement('input');
            // con3.setAttribute('id', 'desc_'+iteration3);
            // con3.setAttribute('type', 'text');
            // con3.setAttribute('name', 'desc_[]');
            // con3.setAttribute('class', 'form-control');
            // con3.setAttribute('required', 'true');
            // cell3.appendChild(con3);

            // cell 4
            // var cell4 = row.insertCell(3);
            // var con4 = document.createElement('select');
            // con4.setAttribute('id', 'month_'+iteration3);
            // con4.setAttribute('type', 'text');
            // con4.setAttribute('name', 'month_[]');
            // con4.setAttribute('class', 'form-control');
            // con4.setAttribute('required', 'true');
            // document.createElement('option')
            // con4.appendChild(new Option("Januari","01"));
            // con4.appendChild(new Option("Februari","02"));
            // con4.appendChild(new Option("Maret","03"));
            // con4.appendChild(new Option("April","04"));
            // con4.appendChild(new Option("Mei","05"));
            // con4.appendChild(new Option("Juni","06"));
            // con4.appendChild(new Option("Juli","07"));
            // con4.appendChild(new Option("Agustus","08"));
            // con4.appendChild(new Option("September","09"));
            // con4.appendChild(new Option("Oktober","10"));
            // con4.appendChild(new Option("November","11"));
            // con4.appendChild(new Option("Desember","12"));
            // cell4.appendChild(con4);

            // cell 5
            // var cell5 = row.insertCell(3);
            // var con5 = document.createElement('select');
            // con5.setAttribute('id', 'currency_'+iteration3);
            // con5.setAttribute('type', 'text');
            // con5.setAttribute('name', 'currency_[]');
            // con5.setAttribute('class', 'form-control');
            // con5.setAttribute('required', 'true');

            // document.createElement('option')
            // con5.appendChild(new Option("IDR","IDR"));
            // con5.appendChild(new Option("USD","USD"));
            // cell5.appendChild(con5);

            // cell 6
            // var cell6 = row.insertCell(2);
            // var con6 = document.createElement('select');
            // con6.setAttribute('id', 'accno_'+iteration3);
            // // con6.setAttribute('type', 'text');
            // con6.setAttribute('name', 'accno_[]');
            // con6.setAttribute('class', 'form-control');
            // con6.setAttribute('required', 'true');
            // cell6.appendChild(con6);

            // cell 7
            var cell7 = row.insertCell(2);
            var con7 = document.createElement('input');
            con7.setAttribute('id', 'qty_'+iteration3);
            con7.setAttribute('type', 'number');
            con7.setAttribute('name', 'qty_[]');
            con7.setAttribute('class', 'form-control qty-name');
            con7.setAttribute('value', '1');
            con7.setAttribute('min', '1');
            con7.setAttribute('required', 'true');
            cell7.appendChild(con7);

            // cell 8
            var cell8 = row.insertCell(3);
            var con8 = document.createElement('input');
            con8.setAttribute('id', 'price_'+iteration3);
            con8.setAttribute('type', 'number');
            con8.setAttribute('name', 'price_[]');
            con8.setAttribute('class', 'form-control price-name');
            con8.setAttribute('value', '1');
            con8.setAttribute('min', '1');
            con8.setAttribute('required', 'true');
            cell8.appendChild(con8);


            // cell 9
            var cell9 = row.insertCell(4);
            var con9 = document.createElement('input');
            con9.setAttribute('id', 'amount_'+iteration3);
            con9.setAttribute('type', 'number');
            con9.setAttribute('name', 'amount_[]');
            con9.setAttribute('class', 'form-control amount-name text-right');
            con9.setAttribute('readonly', 'readonly');
            con9.setAttribute('value', 0);
            cell9.appendChild(con9);

            // cell 10
            // var cell10 = row.insertCell(7);
            // var con10 = document.createElement('input');
            // con10.setAttribute('id', 'doc_'+iteration3);
            // con10.setAttribute('type', 'file');
            // con10.setAttribute('name', 'doc_[]');
            // con10.setAttribute('class', 'form-control');
            // con10.setAttribute('disabled', 'disabled');
            // cell10.appendChild(con10);
           
            // cell 11
            var cell11 = row.insertCell(5);
            var con11 = document.createElement('input');
            con11.setAttribute('id', 'remarks_'+iteration3);
            con11.setAttribute('pos_data', + iteration3);
            con11.setAttribute('type', 'text');
            con11.setAttribute('name', 'remarks_[]');       
            con11.setAttribute('class', 'form-control');
            con11.setAttribute('placeholder', 'Enter Remarks');
            con11.setAttribute('required', 'true');
            con11.onkeydown = function() {

                var desc = "desc_"+iteration3;
                var remarks = "remarks_"+iteration3;                        
                if (event.keyCode == 13 || event.keyCode == 9) {
                    trow3 = document.getElementById(TABLE_BODY3).getElementsByTagName("tr").length;
                    var ordernum = $('#ordernumber_'+iteration3).val();
                    // console.log("Total Row : " + trow3, "Iteration3 : " + iteration3, "OrderNum : "+ordernum);                
                    if (trow3 == ordernum) {
                         // console.log(ctrow3, maxRows3);
                        // console.log(fullname, phone);
                        check_addrow3(desc, remarks, iteration3+1);
                    }                
                }
            };
            cell11.appendChild(con11);
            
            // Pass in the elements you want to refence later
            // Store the myRow object in each row
            row.myRow = new myRowObject3(con0, con1, con7, con8, con9, con11);
        }
    }
    function deleteCurrentRow3(obj){
        if(hasLoaded3){
            var delRow = obj.parentNode.parentNode;
            var tbl = delRow.parentNode.parentNode;
            var rIndex = delRow.sectionRowIndex;
            var rowArray = new Array(delRow);
            trow3 = document.getElementById(TABLE_BODY3).getElementsByTagName("tr").length;
            if (trow3 == 1){
                alert("Row Cannot Empty");
            } else {
                deleteRows3(rowArray); 
                reorderRows3(tbl, rIndex);
            }        
        }
    }
    function deleteRows3(rowObjArray){
        if(hasLoaded3){
            for(var i=0; i<rowObjArray.length; i++){
                var rIndex = rowObjArray[i].sectionRowIndex;
                rowObjArray[i].parentNode.deleteRow(rIndex);
            }
            ctrow3--;
            iteration3--;
        }
    }
    function reorderRows3(tbl, startingIndex){
        if(hasLoaded3){
            if(tbl.tBodies[0].rows[startingIndex]){
                var count = startingIndex + ROW_BASE3;
                for(var i=startingIndex; i<tbl.tBodies[0].rows.length; i++){
                    // CONFIG: next line is affected by myRowObject settings
                    tbl.tBodies[0].rows[i].myRow.one.value = count;
                    tbl.tBodies[0].rows[i].myRow.one.id = 'ordernumber_' + count;

                    // CONFIG: next line is affected by myROwObject setting
                    // row 2
                    tbl.tBodies[0].rows[i].myRow.two.id = 'desc' + count;
                    
                    // row 8
                    tbl.tBodies[0].rows[i].myRow.eleven.id = 'remarks' + count;
                    // tbl.tBodies[0].rows[i].myRow.eight.pos_data = count;
                                

                    // CONFIG : requires class named classy0 and classy1
                    tbl.tBodies[0].rows[i].className = 'classy' + (count % 2);

                    count++;
                }
            }
        }
    }
    function myRowObject3(one, two, eight, nine, ten, twelve){
        this.one = one;
        this.two = two;
        this.eight = eight;
        this.nine = nine;
        this.ten = ten;
        this.twelve = twelve;
    }
    // function load_accno(id){
    //     $.ajax({
    //         url : "<?php echo site_url('CashDisb/get_data_account') ?>",
    //         type    : "POST",
    //         dataType    : "json",
    //         success : function (data){
    //                 $('#accno_'+id).html(data);
    //         }, error : function () {
    //             alert ('Error occur...!!!');
    //         }
    //     });
    // }
</script>
<?php $this->load->view('cashdisbursement/footer'); ?>