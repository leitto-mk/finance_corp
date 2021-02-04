<?php $this->load->view('duty/header'); ?>
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
                <form class="margin-bottom-40 form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Duty/transfer_newduty" enctype="multipart/form-data">
                    <div class="col-md-12" style="padding: 0px">
                        <div class="portlet light" style="background-color: #f6f6f6">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" style="margin-top: -5px">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="portlet-body">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label"><b>Document No <span><font color="red">*</font>:</span></b></label>
                                                    <div class="col-md-3">
                                                        <input name="idn" value="<?php echo str_pad($autoidnum,11,0,STR_PAD_LEFT) ?>" class="form-control" placeholder="Enter..." readonly>                                            
                                                    </div>   
                                                    <label class="col-md-2 control-label"><b>Due Date <span><font color="red">*</font>:</span></b></label>
                                                    <div class="col-md-3">
                                                        <input type="date" name="duedate" class="form-control" value="<?php echo $date; ?>" required>                                            
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
                                                            <label class="col-md-2 control-label"><b>Type <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-3">
                                                                <select class="form-control" name="type" required>
                                                                    <option value="Assigment">Assigment</option>
                                                                    <option value="Homework">Homework</option>
                                                                    <option value="Annoucement">Annoucement</option>
                                                                    <option value="News">News</option>
                                                                </select>                            
                                                            </div>                                                                   
                                                        </div>                                                      
                                                    </div>
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label"><b>Title <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-10">
                                                                <textarea name="title" class="form-control" rows="2" style="resize: none;"></textarea required>                               
                                                            </div>                                                                   
                                                        </div>                                                      
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <div class="portlet light" style="background-color: #f6f6f6">
                                        <div class="row">
                                            <div class="col-md-12" style="margin-top: -55px">
                                                <div class="portlet-body">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label"><b>Details <span><font color="red">*</font>:</span></b></label>
                                                            <div class="col-md-10">
                                                                <textarea name="detail" class="form-control" rows="7" style="resize: none;" required></textarea>                 
                                                            </div>   
                                                        </div>                                                      
                                                    </div>
                                                </div>
                                                <div class="portlet-body" style="margin-left: 5px">
                                                    <div class="form-body">
                                                        <div class="col-md-2">
                                                        </div>
                                                        <div class="col-md-10 col-sm-12 col-xs-12 invoice-payment" style="margin-top: 0px; background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa">
                                                            <ul class="pull-right" style="margin-top: 10px">
                                                                <li>
                                                                    <strong>Submit By <b style="margin-left: 18px">:</b></strong>  <?php echo $submit_by; ?> 
                                                                </li>
                                                                <li>
                                                                    <strong>Submit Date <b style="margin-left: 5px">:</b></strong> 
                                                                    <input type="date" name="submitdate" class="form-control hidden" value="<?php echo $date; ?>" required>
                                                                    <?php echo date('d-M-Y', strtotime($date)); ?>
                                                                </li>
                                                            </ul>
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
                                            <input  id="submit_duty" type="submit" name="submitduty" value="Submit" class="btn btn-transparent green btn-block btn-sm">                                     
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 18px; background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa"> 
                                        <h3><i class="fa fa-edit"></i>&nbsp;Parameter</h3>
                                        <div class="portlet-body">
                                             <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Category<font color="white">_</font><span><font color="red">*</font>:</span></b></label>
                                                    <div class="col-md-7">
                                                        <select id="catstatus" name="catstatus" class="form-control" required>
                                                            <option value="All" selected>All</option>
                                                            <?php if ($cstatus != false) { ?>
                                                                <?php foreach ($cstatus as $cs) { ?>
                                                                    <option value="<?php echo $cs->status; ?>"><?php echo $cs->status; ?></option>
                                                                <?php }?>
                                                            <?php } else { ?>
                                                                <option value=""><font color="red">No Data Category</font></option>
                                                            <?php } ?>
                                                        </select>                          
                                                    </div>                                                                   
                                                </div>                                                      
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>School<font color="white">_</font><span><font color="red">*</font>:</span></b></label>
                                                    <div class="col-md-7">
                                                        <select name="sch" id="sch" class="form-control" required>
                                                        </select>                          
                                                    </div>                                                                   
                                                </div>                                                      
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Class<font color="white">_</font><span><font color="red">*</font>:</span></b></label>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="cls" id="cls" required>
                                                            <option value="All" selected>All</option>  
                                                        </select>                            
                                                    </div>                                                                   
                                                </div>                                                      
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Room<font color="white">_</font><span><font color="red">*</font>:</span></b></label>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="rm" id="rm" required>
                                                            <option value="All" selected>All</option>                   
                                                        </select>                            
                                                    </div>                                                                   
                                                </div>                                                      
                                            </div>

                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>To<font color="white">_</font><span><font color="red">*</font>:</span></b></label>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="idnum" id="idnum" required>
                                                            <option value="All" selected>All</option>
                                                        </select>                           
                                                    </div>                                                                   
                                                </div>                                                      
                                            </div>
                                        </div>
                                    </div>          
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: -10px; background-color: #f6f6f6">
                            <div class="caption">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="bold">News & Assigments </h3>
                                            <div class="portlet-body form-horizontal hidden-print" style="margin-top: 20px">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="datatable_duty">
                                                        <thead>
                                                            <tr style="background-color: #eff3f8;">
                                                                <th width="3%" class="text-center">#</th>
                                                                <th width="15%" class="text-center">Title</th>
                                                                <th width="37%" class="text-center">Details</th>
                                                                <th width="15%" class="text-center">DueDate</th>
                                                                <th width="5%" class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no=1; foreach ($data_duty_all as $dda){ 
                                                                $date1 = date('Y-m-d',strtotime($dda->DueDate));
                                                                $date2 = date('Y-m-d');

                                                                $dateExpire = date_create($date1);
                                                                $datePost = date_create($date2);
                                                               
                                                                $diff=date_diff($dateExpire,$datePost); 
                                                                $diffcount = $diff->format("%R%a");

                                                                ?>
                                                                <tr>
                                                                    <td align="center"><?php echo $no; ?></td>
                                                                    <td><?php echo $dda->AssignmentTitle ?></td>
                                                                    <td><?php echo $dda->AssignmentDetail ?></td>
                                                                    <?php if ($diffcount == '-5'){ ?>
                                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dda->DueDate)); ?></font></td>
                                                                    <?php }else if ($diffcount == '-4'){ ?>
                                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dda->DueDate)); ?></font></td>
                                                                    <?php }else if ($diffcount == '-3'){ ?>
                                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dda->DueDate)); ?></font></td>
                                                                    <?php }else if ($diffcount == '-2'){ ?>
                                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dda->DueDate)); ?></font></td>
                                                                    <?php }else if ($diffcount == '-1'){ ?>
                                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dda->DueDate)); ?></font></td>
                                                                    <?php }else if ($diffcount == '-0'){ ?>
                                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($dda->DueDate)); ?></font></td>
                                                                    <?php }else if ($diffcount >= '-5'){ ?>
                                                                        <td align="center" class="font-dark bold"><font color="#e7505a"><?php echo date('d-M-Y', strtotime($dda->DueDate)); ?></font></td>
                                                                    <?php }else{ ?>
                                                                        <td align="center" class="font-dark bold" style="background-color: white"><font color="#32c5d2"><?php echo date('d-M-Y', strtotime($dda->DueDate)); ?></font></td>
                                                                    <?php } ?>
                                                                    <td align="center">
                                                                        <a class="btn btn-outline btn-sm blue newsassignments" data-ctrlno="<?= $dda->CtrlNo?>" title="Details"><i class="fa fa-search"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php $no++;} ?>                                                           
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
                </form>
             </div>
         </div>
     </div>
</div>             
<!-- MODAL News & Assingment -->
<div class="modal fade in" id="newsassignmentModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: hidden;">
     <div class="modal-dialog modal-full" style="width: 95%">
         <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title uppercase">News & Assignment<span class="uppercase sbold"> Details</span></h4>
             </div>
             <div class="modal-body">
                <div class="col-md-12" style="padding: 0px">
                    <div class="portlet light" style="background-color: #f6f6f6">
                        <div class="row form-horizontal" id="data_modal_newsassignment">
                            <!-- <?php if ($data_duty_all != false){ ?>
                                <?php foreach ($data_duty_all as $dda){ ?>                
                                <div class="col-md-9" style="margin-top: -10px">
                                    <div class="col-md-12">
                                        <div class="portlet-body">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label"><b>Document No</span></b></label>
                                                    <div class="col-md-3">
                                                        <input  class="form-control" value="<?php echo $dda->CtrlNo; ?>" readonly>                                            
                                                    </div>   
                                                    <label class="col-md-2 control-label"><b>Due Date</span></b></label>
                                                    <div class="col-md-3">
                                                        <input class="form-control font-red bold" value="<?php echo date('d-M-Y', strtotime($dda->DueDate)); ?>" readonly>                                            
                                                    </div> 
                                                </div>
                                            </div>                                                                                               
                                        </div>
                                    </div>
                                    <div class="portlet light" style="background-color: #f6f6f6">
                                        <div class="row">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <span class="caption-subject font-dark sbold uppercase" ><i class="fa fa-warning"></i>  Description</span>
                                                    <p style="border: solid 1px;color: #555; margin-top: 5px"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="margin-top: -15px">
                                                <div class="portlet-body">
                                                     <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label"><b>Type</span></b></label>
                                                            <div class="col-md-3">
                                                                <input  class="form-control" style="background-color: white" value="<?php echo $dda->AssignmentType; ?>" readonly>                           
                                                            </div>                                                                   
                                                        </div>                                                      
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <div class="portlet light" style="background-color: #f6f6f6">
                                        <div class="row">
                                            <div class="col-md-12" style="margin-top: -55px">
                                                <div class="portlet-body">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label"><b>Title</span></b></label>
                                                            <div class="col-md-10">
                                                                <input  class="form-control" rows="2" style="background-color: white" value="<?php echo $dda->AssignmentTitle ?>" readonly>                               
                                                            </div>                                                                   
                                                        </div>                                                      
                                                    </div>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <div class="portlet light" style="background-color: #f6f6f6">
                                        <div class="row">
                                            <div class="col-md-12" style="margin-top: -55px">
                                                <div class="portlet-body">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label"><b>Details</span></b></label>
                                                            <div class="col-md-10 bold">
                                                                "<?php echo $dda->AssignmentDetail ?>"  
                                                            </div>   
                                                        </div>                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                            
                                <div class="col-md-3" style="border-left: solid; border-width: 1px; border-color: white; height: 400px">
                                    <div class="col-md-12 col-sm-12 col-xs-12 invoice-payment" style="background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa">
                                        <h3>Submited Status:</h3>
                                        <ul class="list-unstyled">
                                            <li>
                                                <strong>School <b style="margin-left: 20px">:</b></strong> <?php echo $dda->TypeSchool; ?>
                                            </li>
                                            <li>
                                                <strong>Class <b style="margin-left: 28px">:</b></strong> <?php echo $dda->Class; ?>
                                            </li>
                                            <li>
                                                <strong>Room <b style="margin-left: 26px">:</b></strong> <?php echo $dda->Room; ?>
                                            </li>
                                            <li>
                                                <strong>To <b style="margin-left: 49px">:</b></strong> <?php echo $dda->IDNumber; ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 invoice-payment" style="margin-top: 30px; background-color: white; border-style: solid; border-width: 1px; border-color: #f1f3fa">
                                        <h3>Submited:</h3>
                                        <ul class="list-unstyled">
                                            <li>
                                                <strong>By <b style="margin-left: 49px">:</b></strong> <?php echo $dda->SubmitBy; ?> </li>
                                            <li>
                                                <strong>Date <b style="margin-left: 35px">:</b></strong> 
                                                <input type="date" name="submitdate" class="form-control hidden" value="<?php echo $date; ?>" required>
                                                <?php echo date('d-M-Y', strtotime($dda->SubmitDate)); ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>
                            <?php }else{ ?>
                                <h2 align="center"  class="font-red bold">No Data News & Assignment!</h2>
                            <?php } ?> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                     <button type="button" class="btn dark btn-outline" data-dismiss="modal" style="float: right; margin-right: 15px">Close</button>
                </div>
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
        $('#sch').select2();
        $('#cls').select2();
        $('#rm').select2();
        $('#idnum').select2();  

        var dt_datatable_duty = $('#datatable_duty').DataTable({
            autoWidth: false,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
        })

        load_list_school();

        $(document).on('click','.newsassignments', function() {
            let id_ctrlno = $(this).attr('data-ctrlno')
            $.ajax({
                url     : "Duty/get_detail_data_news_assigments",
                type    : "POST",
                data    : {
                    id_ctrlno
                },
                success : function(data){
                    $('#data_modal_newsassignment').html(data)
                    $('#newsassignmentModal').modal('show');
                }, error : function(){
                    alert("Error to load Data !");
                }
            });
        });

        date_time('realtime_clock');
        
        $(document).ready(function(){
            $('.dropify').dropify();
        }); 

        $('#catstatus').change(function(){
            if($(this).val() == 'teacher' || $(this).val() == 'staff'){
                $('#sch').prop('disabled', true)
                $('#cls').prop('disabled', true)
                $('#rm').prop('disabled', true)
                load_list_school();
                $('#cls').html('<option value="All"> All </option>');
                $('#rm').html('<option value="All"> All </option>');
                $('#idnum').html('<option value="All"> All </option>');
                let cstatuscodes = $('#catstatus option:selected').val()
                load_list_data_by_category(cstatuscodes) 
            }else if($(this).val() == 'All'){
                load_list_school();
                $('#cls').html('<option value="All"> All </option>');
                $('#rm').html('<option value="All"> All </option>');
                $('#idnum').html('<option value="All"> All </option>');
                $('#sch').prop('disabled', false)
                $('#cls').prop('disabled', false)
                $('#rm').prop('disabled', false)
            }else{
                $('#sch').prop('disabled', false)
                $('#cls').prop('disabled', false)
                $('#rm').prop('disabled', false)
            }
        });   

        $('#sch').change(function(){
            var idsch = $(this).val() 
            if (idsch != 'All') {            
                load_list_class(idsch)
            } else {            
                $('#cls').html('<option value="All"> All </option>');
                $('#rm').html('<option value="All"> All </option>');
                $('#idnum').html('<option value="All"> All </option>');
            }
        });

        $(document).on('change', '#cls', function(){
            var clsvalue = $(this).val();
            if (clsvalue != "All") {
                let clscodes = $('#cls option:selected').val()         
                let clscodes_id = $('#cls option:selected').attr('cls-id')
                load_list_room_by_class(clscodes_id) 
            } else {
                $('#rm').html('<option value="All"> All </option>');       
                $('#idnum').html('<option value="All"> All </option>');       
            }
        });

        $(document).on('change', '#rm', function(){
            var rmvalue = $(this).val();
            if (rmvalue != "All") {
                let rmcodes = $('#rm option:selected').val()
                load_list_data_by_room(rmcodes) 
            } else {
                $('#idnum').html('<option value="All"> All </option>');       
            }
        });

        function load_list_school(){
            var html = '';
            $.ajax({
                url     : "<?php echo site_url('Duty/get_list_school'); ?>",
                type    : "POST",
                async   : false,
                dataType : "json",
                success : function(data){
                    if (data.rstatus == "success") {
                        var school = data.data;
                        html += '<option value="All">All</option>';    
                        for (let index = 0; index < school.length; index++) {
                            html += '<option value="'+school[index].SchoolID+'">'+school[index].School_Desc+' | '+school[index].SchoolName+'</option>';                                                      
                        }
                        $('#sch').html(html);  
                    } else {
                        $('#sch').html('<option disabled> No Data School </option>');
                    }
                }, error : function(){
                    alert("Error to load School !");
                }
            });
        }

        function load_list_class(idsch){
            var html = '';
            $.ajax({
                url     : "<?php echo site_url('Duty/get_list_class_by_school'); ?>",
                data    : {id_sch : idsch},
                type    : "POST",
                dataType : "json",
                async   : false,
                success : function(data){
                    if (data.rstatus == "success") {
                        var class_ = data.data;
                        html += '<option value="All">All</option>';                                                      
                        for (let index = 0; index < class_.length; index++) {
                            html += '<option value="'+class_[index].ClassDesc+'"  cls-id="'+class_[index].ClassID+'">'+class_[index].ClassDesc+'</option>';                                                      
                        }
                        $('#cls').html(html);

                    } else {
                        $('#cls').html('<option disabled> No Data Class </option>');
                    }
                }, error : function(){
                    alert("Error to load Class !");
                }
            });
        }

        function load_list_room_by_class(clscodes_id){
            var html = '';
            $.ajax({
                url     : "<?php echo site_url('Duty/get_data_list_room_by_class'); ?>",
                data    : {cls_codes_id : clscodes_id},
                type    : "POST",
                dataType : "json",
                async   : false,
                success : function(data){
                    if (data.rstatus == "success") {
                        var room_ = data.data;
                        html += '<option value="All">All</option>';
                        for (let index = 0; index < room_.length; index++) {
                            html += '<option value="'+room_[index].RoomDesc+'">'+room_[index].RoomDesc+'</option>';                                                      
                        }
                        $('#rm').html(html);      
                        
                    } else {
                        $('#rm').html('<option disabled> No Data Room </option>');
                    }
                }, error : function(){
                    alert("Error to load Room !");
                }
            });      
        }

        function load_list_data_by_room(rmcodes){
            var html = '';
            $.ajax({
                url     : "<?php echo site_url('Duty/get_data_list_data_by_room'); ?>",
                data    : {rm_codes : rmcodes},
                type    : "POST",
                dataType : "json",
                async   : false,
                success : function(data){
                    if (data.rstatus == "success") {
                        var datas_ = data.data;
                        html += '<option value="All">All</option>';
                        for (let index = 0; index < datas_.length; index++) {
                            html += '<option value="'+datas_[index].NIS+'">'+datas_[index].FirstName+' '+datas_[index].LastName+'</option>';                                                      
                        }
                        $('#idnum').html(html);      
                        
                    } else {
                        $('#idnum').html('<option disabled> No Data </option>');
                    }
                }, error : function(){
                    alert("Error to load Data !");
                }
            });      
        }


        function load_list_data_by_category(cstatuscodes){
            var html = '';
            $.ajax({
                url     : "<?php echo site_url('Duty/get_data_list_data_by_category'); ?>",
                data    : {cstatus_codes : cstatuscodes},
                type    : "POST",
                dataType : "json",
                async   : false,
                success : function(data){
                    if (data.rstatus == "success") {
                        var datas_ = data.data;
                        html += '<option value="All">All</option>';
                        for (let index = 0; index < datas_.length; index++) {
                            html += '<option value="'+datas_[index].IDNumber+'">'+datas_[index].FirstName+' '+datas_[index].LastName+'</option>';                                                      
                        }
                        $('#idnum').html(html);      
                        
                    } else {
                        $('#idnum').html('<option disabled> No Data </option>');
                    }
                }, error : function(){
                    alert("Error to load Data !");
                }
            });      
        }
    }
</script>
<?php $this->load->view('duty/footer'); ?> 