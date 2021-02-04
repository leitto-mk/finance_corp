<?php $this->load->view('header_footer/home/header');?>
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

.widget-thumb .widget-thumb-wrap .img-group {
    float: left;
    width: 100%;
    max-width: 75px;
    height: auto;
    display: inline-block;
    font-size: 20px;
    line-height: 41px;
    color: #fff;
    text-align: center;
    padding: 10px;
    margin-right: 15px;
}

.portlet.green, .portlet.box.green>.portlet-title, .portlet>.portlet-body.green {
    background-color: #009dc7;
}

.containers {
    width: 100%;
    margin: 15px auto;
}

.page-sidebar {
    border-right: 1px solid;color: #e9ecf3;
}

#col_box {
width: 25%;
}

@media only screen and (max-width: 900px) {
  #col_box {
    width: 100%;
  }
}

#font-count-total {
    font-size: 28px;
}

#font-button{
    font-size: 16px;
}
</style>

<div class="container-fluid" style="background-color: #e9ecf3;">
    <div class="page-content" style="margin-top: 25px">
        <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <!-- <h1><a href="#" class="btn btn-success btn-lg btn-block" style="background-color: #566573">&nbsp;&nbsp;&nbsp;Main Dashboard&nbsp;&nbsp;&nbsp;</a></h1>
            <ol class="breadcrumb">
                <a href="<?php echo site_url('MainMenu'); ?>" target="_blank">
                    <button class="btn dark btn-md" style="background-color: #32c5d2"><i class="fa fa-arrows"></i> Asset </button>
                </a>
                <a href="<?php echo site_url('Budget/view_home') ?>" target="_blank">
                    <button class="btn dark btn-md" style="background-color: #c49f47"><i class="fa fa-arrows"></i> Budget </button>
                </a>
                <div class="blog-single-sidebar-search pull-left">
                    <div class="input-icon right" style="margin-left: 40px">
                        <i class="icon-magnifier"></i>
                        <input type="text" class="form-control" placeholder="Search for..."> </div>
                </div>
                <div class="btn-group" title="Dashboard">
                    <a href="<?php echo site_url('Admin/load_enroll'); ?>" target="_blank" class="btn yellow btn-outline">
                       <i class="fa fa-plus"></i>&nbsp;
                        <span class="hidden-sm hidden-xs bold" id="font-button">Enrollment&nbsp;</span>&nbsp;
                    </a>
                </div>
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
        <div class="page-content-container" style="margin-top: -40px">
            <div class="page-content-row" style="background-color: white">
                <!-- BEGIN PAGE SIDEBAR -->
                <div class="page-sidebar">
                    <div class="blog-single-sidebar-tags">
                        <h3 class="blog-sidebar-title uppercase"><a href="<?php echo site_url('Admin/index'); ?>" target="_blank" class="font-dark">Dashboard</a></h3>
                    </div>
                    <div class="blog-single-sidebar-tags">
                        <h3 class="blog-sidebar-title uppercase">Admission</h3>
                        <ul class="blog-post-tags">
                            <li class="font-dark">
                                <a href="<?php echo site_url('Admin/load_prof_std_edit'); ?>" target="_blank">Student Profile</a>
                            </li>
                            <li class="font-dark">
                                <a href="<?php echo site_url('Admin/load_prof_tch_edit'); ?>" target="_blank">Teacher & Staff Profile</a>
                            </li>
                            <li class="font-dark">
                                <a href="<?php echo site_url('Admin/load_enroll'); ?>" target="_blank">Enrollment Management</a>
                            </li>                         
                        </ul>
                    </div>
                    <div class="blog-single-sidebar-tags">
                        <h3 class="blog-sidebar-title uppercase">Academic</h3>
                        <ul class="blog-post-tags">
                            <li class="font-dark">
                                <a href="<?php echo site_url('Admin/load_acd_sch_edit'); ?>" target="_blank">Schedule</a>
                            </li>
                            <li class="font-dark">
                                <a href="<?php echo site_url('Admin/load_acd_grde'); ?>" target="_blank">Grades</a>
                            </li>
                            <li class="font-dark">
                                <a href="<?php echo site_url('Admin/load_acd_absn'); ?>" target="_blank">Absence</a>
                            </li> 
                            <li class="font-dark">
                                <a href="<?php echo site_url('Duty'); ?>" target="_blank">Book Assignment</a>
                            </li>                           
                        </ul>
                    </div>
                    <div class="blog-single-sidebar-tags">
                        <h3 class="blog-sidebar-title uppercase">Admin</h3>
                        <ul class="blog-post-tags">
                            <li class="font-dark">
                                <a href="#">School Board</a>
                            </li>
                            <li class="font-dark">
                                <a href="#">Teacher & Staff Absent</a>
                            </li>
                            <li class="font-dark">
                                <a href="#">Leave & Travel</a>
                            </li>  
                            <li class="font-dark">
                                <a href="#">Training & Career</a>
                            </li>              
                            <li class="font-dark">
                                <a href="<?php echo site_url('Duty'); ?>" target="_blank">News & Bulletin</a>
                            </li>            
                        </ul>
                    </div>
                    <div class="blog-single-sidebar-tags">
                        <h3 class="blog-sidebar-title uppercase"><a href="http://localhost/finance_metronic_sat_fin_sch" class="font-dark">Finance</a></h3>
                        <ul class="blog-post-tags">
                            <li class="font-dark">
                                <a href="http://newfinance.abase.id/index.php/Login" target="_blank">Student Finance</a>
                            </li> 
                            <li class="font-dark">
                                <a href="#">School Asset</a>
                            </li>
                            <li class="font-dark">
                                <a href="<?php echo site_url('CashDisb'); ?>">Cash Disbursement</a>
                            </li>
                            <li class="font-dark">
                                <a href="http://newfinance.abase.id/index.php/Login" target="_blank">Finance Accounting</a>
                            </li>                            
                        </ul>
                    </div>
                    <div class="blog-single-sidebar-tags">
                        <h3 class="blog-sidebar-title uppercase">Useful Link</h3>
                        <ul class="blog-post-tags">
                            <li class="font-dark">
                                <a href="#">Library</a>
                            </li>
                            <li class="font-dark">
                                <a href="#">Canteen</a>
                            </li> 
                            <li class="font-dark">
                                <a href="#">Store & Inventory</a>
                            </li>                          
                        </ul>
                    </div>
                    <div class="blog-single-sidebar-tags">
                        <h3 class="blog-sidebar-title uppercase"><a href="<?php echo site_url('Report/view_report'); ?>" class="font-dark">Report</a></h3>
                    </div>
                    <div class="blog-single-sidebar-tags">
                        <h3 class="blog-sidebar-title uppercase">Masters</h3>
                    </div>
                    <div class="blog-single-sidebar-tags">
                        <h3 class="blog-sidebar-title uppercase">User Management</h3>
                    </div>
                </div>
                <!-- END PAGE SIDEBAR -->
                <div class="page-content-col">
                    <div class="row">
                        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border: solid 1px; border-color:#e9ecf3; background-color: #f6f6f6">
                                <!-- <div class="row">
                                    <div class="col-md-8" style="float: left">
                                        <h4 class="widget-thumb-heading text-uppercase font-dark">0 - 30 Days</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#" class="icon"  class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                                    </div>
                                </div> -->
                                <a href="#">
                                    <div class="widget-thumb-wrap">
                                        <i class="widget-thumb-icon bg-green fa fa-calendar"></i>
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-subtitle">Elementary</span>
                                            <span class="widget-thumb-body-stat" id="font-count-total">0</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border: solid 1px; border-color:#e9ecf3; background-color: #f6f6f6">
                                <!-- <div class="row">
                                    <div class="col-md-8" style="float: left">
                                        <h4 class="widget-thumb-heading text-uppercase font-dark">30 - 60 Days</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#" class="icon" class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                                    </div>
                                </div> -->
                                <a href="#">
                                    <div class="widget-thumb-wrap">
                                        <i class="widget-thumb-icon bg-blue fa fa-calendar"></i>
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-subtitle">Junior High</span>
                                            <span class="widget-thumb-body-stat" id="font-count-total">0</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>          
                        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border: solid 1px; border-color:#e9ecf3; background-color: #f6f6f6">
                               <!--  <div class="row">
                                    <div class="col-md-8" style="float: left">
                                        <h4 class="widget-thumb-heading text-uppercase font-dark">60 - 90 Days</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#"  class="icon" class="btn blue btn-sm btn-outline" title="Show Data" style="float: right"><i class="fa fa-bars"></i></a>
                                    </div>
                                </div> -->
                                <a href="#">
                                    <div class="widget-thumb-wrap">
                                        <i class="widget-thumb-icon bg-yellow fa fa-calendar"></i>
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-subtitle">High</span>
                                            <span class="widget-thumb-body-stat" id="font-count-total">0</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div id="col_box" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border: solid 1px; border-color:#e9ecf3; background-color: #f6f6f6">
                                <!-- <div class="row">
                                    <div class="col-md-8" style="float: left">
                                        <h4 class="widget-thumb-heading text-uppercase font-dark">90 - 120 Days</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#" class="icon"  class="btn blue btn-sm btn-outline" title="Show Total Data" style="float: right"><i class="fa fa-bars"></i></a>
                                    </div>
                                </div>  -->
                                <a href="#">
                                    <div class="widget-thumb-wrap">
                                        <i class="widget-thumb-icon bg-purple fa fa-calendar"></i>
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-subtitle">Vocational High</span>
                                            <span class="widget-thumb-body-stat" id="font-count-total">0</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-green-haze"></i>
                                        <span class="caption-subject bold uppercase font-green-haze"> Teacher Staff</span>
                                        <span class="caption-helper">column and line mix</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <canvas id="myChart" height="80"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-graph font-green-haze"></i>
                                        <span class="caption-subject bold uppercase font-green-haze"> Student</span>
                                        <span class="caption-helper">column and line mix</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <canvas id="myChart2" height="80"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: -5px;padding: 0px;">
                        <div class="portlet light bordered">
                            <div class="caption">
                                <span class="caption-subject bold uppercase font-dark">News & Bulletin</span><br>
                                <span class="font-dark"><font size="3"> Date : <?php echo date('d-M-Y', strtotime($currentdate)); ?> </font></span>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped table-condensed" id="datatable_duty">
                                        <thead>
                                            <tr style="background-color: #bfbfbfb0" class="font-dark">
                                                <th width="3%" class="text-center">#</th>
                                                <th width="15%" class="text-center">Title</th>
                                                <th width="32%" class="text-center">Details</th>
                                                <th width="10%" class="text-center">Type</th>
                                                <th width="10%" class="text-center">DueDate</th>
                                                <th width="5%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($data_duty_all_by_date as $ddbd){ 
                                                $date1 = date('Y-m-d',strtotime($ddbd->DueDate));
                                                $date2 = date('Y-m-d');

                                                $dateExpire = date_create($date1);
                                                $datePost = date_create($date2);
                                               
                                                $diff=date_diff($dateExpire,$datePost); 
                                                $diffcount = $diff->format("%R%a");
                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo $no; ?></td>
                                                    <td><?php echo $ddbd->AssignmentTitle ?></td>
                                                    <td><?php echo $ddbd->AssignmentDetail ?></td>
                                                    <td><?php echo $ddbd->AssignmentType ?></td>
                                                    <?php if ($diffcount == '-5'){ ?>
                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($ddbd->DueDate)); ?></font></td>
                                                    <?php }else if ($diffcount == '-4'){ ?>
                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($ddbd->DueDate)); ?></font></td>
                                                    <?php }else if ($diffcount == '-3'){ ?>
                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($ddbd->DueDate)); ?></font></td>
                                                    <?php }else if ($diffcount == '-2'){ ?>
                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($ddbd->DueDate)); ?></font></td>
                                                    <?php }else if ($diffcount == '-1'){ ?>
                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($ddbd->DueDate)); ?></font></td>
                                                    <?php }else if ($diffcount == '-0'){ ?>
                                                        <td align="center" class="font-dark bold"><font color="#dccd1c"><?php echo date('d-M-Y', strtotime($ddbd->DueDate)); ?></font></td>
                                                    <?php }else if ($diffcount >= '-5'){ ?>
                                                        <td align="center" class="font-dark bold"><font color="#e7505a"><?php echo date('d-M-Y', strtotime($ddbd->DueDate)); ?></font></td>
                                                    <?php }else{ ?>
                                                        <td align="center" class="font-dark bold" style="background-color: white"><font color="#32c5d2"><?php echo date('d-M-Y', strtotime($ddbd->DueDate)); ?></font></td>
                                                    <?php } ?>
                                                    <td align="center">
                                                        <a class="btn btn-outline btn-sm blue newsassignments" data-ctrlno="<?= $ddbd->CtrlNo?>" title="Details"><i class="fa fa-search"></i>
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
        <!-- END SIDEBAR CONTENT LAYOUT -->
    </div>
</div>
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
<script type="text/javascript">
    window.onload = load_function;
    function load_function(){
        document.body.style.zoom = 0.9;

        var dt_datatable_duty = $('#datatable_duty').DataTable({
            autoWidth: false,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
        })

        $(document).on('click','.newsassignments', function() {
            let id_ctrlno = $(this).attr('data-ctrlno')
            $.ajax({
                url     : "<?php echo site_url('Duty/get_detail_data_news_assigments'); ?>",
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

        $(document).ready(function(){
            var ctx = $('#myChart')
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Elementary', 'Junior High', 'High', 'Vocational High'],
                    datasets: [{
                        label: 'Male',
                        data: [6, 6, 6, 7],
                        backgroundColor: '#d3d3d3',
                        borderColor: '#d3d3d3',
                        // backgroundColor: 'rgba(44,62,80, 0.8)',
                        // borderColor: 'rgba(44,62,80, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Female',
                        data: [7, 10, 5, 8],
                        backgroundColor: '#566573',
                        borderColor: '#566573',
                        // backgroundColor: 'rgba(242,120,75, 0.8)',
                        // borderColor: 'rgba(242,120,75, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            })

            var ctx2 = $('#myChart2')
            var myChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: ['Elementary', 'Junior High', 'High', 'Vocational High'],
                    datasets: [{
                        label: 'Male',
                        data: [0, 0, 13, 0],
                        backgroundColor: 'rgba(44,62,80, 0.8)',
                        borderColor: 'rgba(44,62,80, 1)',
                        // backgroundColor: 'rgba(44,62,80, 0.8)',
                        // borderColor: 'rgba(44,62,80, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Female',
                        data: [0, 0, 15, 0],
                        backgroundColor: '#8f8f8f',
                        borderColor: 'rgba(242,120,75, 1)',
                        // backgroundColor: 'rgba(242,120,75, 0.8)',
                        // borderColor: 'rgba(242,120,75, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            })

        })
    }
</script>
<?php $this->load->view('header_footer/home/footer');?>