<?php $this->load->view('header_footer/hr/header_n');?>
<style type="text/css">
#col_box {
    width: 25%;
}

@media only screen and (max-width: 1100px) {
  #col_box {
    width: 100%;
  }
}

tr:nth-child(even){
    background-color: #E1E5EC;
}

tr:nth-child(odd){
    background-color: white;
}
</style>
<?php $this->load->view('humanresource/sidebar/sidebar_persreg');?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="background-color: #eef1f5">
        <!-- <div class="page-bar" style="margin-bottom: 20px; background-color: #67809F"> -->
        <div class="page-bar bg-blue-dark" style="margin-bottom: 20px;">
            <ul class="page-breadcrumb">
                <li>
                    <a href="#" class="font-white uppercase">Preview</a>
                </li>
                <li>
                    <i class="fa fa-circle font-white"></i>
                    <a href="javascript:;" class="font-white uppercase"><?= $title ?></a>
                </li>
            </ul>
        </div>
        <div class="row">
            <?php if ($sumemptype != null){ ?>
                <?php foreach ($sumemptype as $dsum){ ?>
                    <div class="col-lg-3 col-xs-12 col-sm-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" style="background-color: white; margin-top: -5px">
                            <!-- <h4 class="widget-thumb-heading">Male</h4> -->
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue-ebonyclay icon-user"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">Staff</span>
                                    <span class="widget-thumb-body-stat"><?php echo $dsum->EStaff ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-sm-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" style="background-color: white; margin-top: -5px">
                            <!-- <h4 class="widget-thumb-heading">Male</h4> -->
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue-madison icon-user"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">Non Staff</span>
                                    <span class="widget-thumb-body-stat"><?php echo $dsum->ENonStaff ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-sm-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" style="background-color: white; margin-top: -5px">
                            <!-- <h4 class="widget-thumb-heading">Male</h4> -->
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-green icon-user"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">Expat</span>
                                    <span class="widget-thumb-body-stat"><?php echo $dsum->EExpat ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-sm-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" style="background-color: white; margin-top: -5px">
                            <!-- <h4 class="widget-thumb-heading">Male</h4> -->
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue-dark icon-users"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">Total</span>
                                    <span class="widget-thumb-body-stat"><?php echo $dsum->Total ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                    <div class="col-lg-3 col-xs-12 col-sm-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" style="background-color: white; margin-top: -5px">
                            <!-- <h4 class="widget-thumb-heading">Male</h4> -->
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue-ebonyclay icon-user"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">Staff</span>
                                    <span class="widget-thumb-body-stat">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-sm-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" style="background-color: white; margin-top: -5px">
                            <!-- <h4 class="widget-thumb-heading">Male</h4> -->
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue-madison icon-user"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">Non Staff</span>
                                    <span class="widget-thumb-body-stat">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-sm-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" style="background-color: white; margin-top: -5px">
                            <!-- <h4 class="widget-thumb-heading">Male</h4> -->
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-green icon-user"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">Expat</span>
                                    <span class="widget-thumb-body-stat">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-sm-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20" style="background-color: white; margin-top: -5px">
                            <!-- <h4 class="widget-thumb-heading">Male</h4> -->
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue-dark icon-users"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle">Total</span>
                                    <span class="widget-thumb-body-stat">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-sm-12">
                <div class="portlet box bg-blue-ebonyclay">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-white bold"><i class="icon-users font-white"></i> Employee by Department</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="chart_dashboardhrpie" class="chart" style="height: 315px;"> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xs-12 col-sm-12">
                <!-- BEGIN TAB PORTLET-->
                <div class="portlet box bg-blue-ebonyclay">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-white bold"><i class="icon-users font-white"></i> Employee Type Summary</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="portlet light" style="background-color: white; padding: 0px">
                           <!--  <div class="caption">
                                <i class="fa fa-th-list font-blue-madison"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Employee Type</span>                                                    
                            </div> -->
                            <div class="portlet-body" style="overflow-y: scroll; height: 290px"> 
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>                                             
                                            <tr class="bg-grey-salsa">
                                                <td class="bold" align="left">Department</td>
                                                <?php $cspan = 0; 
                                                    foreach($emptype as $etype) { ?>
                                                    <td class="bold" align="center"><?php echo $etype->EmployeeTypeDes ?></td>
                                                <?php $cspan++;} ?>
                                                <td class="bold" align="center">Total</td>
                                            </tr> 
                                        </thead>
                                        <tbody style="background-color: white">
                                            <?php $gtlemptype = 0; ?>
                                            <?php $no = 1; $total = 0; foreach($dept as $dep) { ?>
                                                <tr>
                                                    <td><?php echo $dep->DeptDes?></td>
                                                        <?php $ttl = 0 ?> <?php foreach($emptype as $etyps) { ?>
                                                            <!-- <td align="center" style="background-color: #bfcad1"> -->
                                                            <td align="center">
                                                                <?php foreach($report_emptype as $row) { ?>
                                                                    <?php if($row->DeptCode == $dep->DeptCode AND $row->EmployeeType == $etyps->EmployeeType) { ?>

                                                                            <?php echo $tl = $row->count ?>

                                                                        <?php $ttl += $tl; ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </td>
                                                        <?php } ?>
                                                    <!-- <td class="bold" align="center" style="background-color: #67809fcc;"><?php echo $ttl ?></td> -->
                                                    <td class="bold" align="center"><?php echo $ttl ?></td>
                                                </tr> 
                                            <?php $no++; $total += $ttl;} ?> 
                                            <tr>
                                                <td class="bold pull-right" >Grand Total :</td>
                                                <?php $gtotal = 0 ?>
                                                <?php if($grandtotalemptype != false) { ?>   
                                                    <?php foreach($grandtotalemptype as $gtlemptypes) { ?>
                                                      <td align="center" style="background-color: #bfcad1"><font color="red"><?php echo $gtlemptype = $gtlemptypes->count ?></font></td>
                                                      <?php $gtotal += $gtlemptype ?>
                                                    <?php $cspan++;} ?>
                                                    <td align="center" style="background-color: #67809fcc;"><font color="white"><?php echo $gtotal ?></font></td>
                                                <?php }else{ ?>
                                                    <td align="center" style="background-color: #67809fcc;"><font color="white">0</font></td>
                                                <?php } ?>
                                            </tr>                                      
                                        </tbody>
                                    </table> 
                                </div>
                            </div>                                            
                        </div>      
                    </div>
                </div>
                <!-- END TAB PORTLET-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="portlet bordered light bg-white">
                    <div class="portlet light bg-grey-cararra" style="border-style: dotted; border-color: #333; border-width: 2px">
                        <h3 class="uppercase bold" id="body-title"><i class="icon-users"></i> &bull;&nbsp;&nbsp;Employee Detail Register
                        </h3>
                        <div class="input-group input-large pull-right" style="margin-top: -45px">
                            <input type="text" class="form-control" placeholder="Search for..." name="search_item" id="search_item">
                            <span class="input-group-btn">
                                <button  class="btn dark">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="portlet-body" id="emp_list" style="margin-top: -30px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<div class="modal fade" id="reportlistModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue-madison">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h5 class="modal-title font-white uppercase bold"><i class="fa fa-pencil"></i> <b>Module Report Parameter</b></h5>
            </div>
            <div class="modal-body" style="background-color: #f5f5f5">
                <div class="portlet light portlet-fit">
                    <div class="portlet-body">
                        <div class="mt-element-list">
                            <div class="mt-list-container list-todo" id="accordion1" role="tablist" aria-multiselectable="true" >
                                <div class="list-todo-line"></div>
                                <ul>
                                    <li class="mt-list-item">
                                        <div class="list-todo-icon bg-white">
                                            <i class="fa fa-database"></i>
                                        </div>
                                        <div class="list-todo-item blue-dark" >
                                            <a class="list-toggle-container" data-toggle="collapse" data-parent="#accordion1" href="#task-1" aria-expanded="false">
                                                <div class="list-toggle done uppercase">
                                                    <font size="2"><div class="list-toggle-title bold">Personal</div></font>
                                                </div>
                                            </a>
                                            <div class="task-list panel-collapse collapse in" id="task-1">
                                                <ul>
                                                    <li class="task-list-item done">
                                                        <div class="task-icon">
                                                            <a href="javascript:;">
                                                                <i class="fa fa-book"></i>
                                                            </a>
                                                        </div>
                                                        <div class="task-status">
                                                            <a class="done" href="javascript:;">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div>
                                                        <div class="task-content">
                                                            <h4 class="uppercase bold">
                                                                <a href="<?php echo site_url('Humanresource/view_report'); ?>" target="_blank"><font size="2">Employee Admin Report</font></a>
                                                            </h4>
                                                        </div>
                                                        <div class="task-content">
                                                            <h4 class="uppercase bold">
                                                                <a href="#"><font size="2">Employee Movement</font></a>
                                                            </h4>
                                                        </div>
                                                        <div class="task-content">
                                                            <h4 class="uppercase bold">
                                                                <a href="#"><font size="2">Employee Contract</font></a>
                                                            </h4>
                                                        </div>
                                                        <div class="task-content">
                                                            <h4 class="uppercase bold">
                                                                <a href="#"><font size="2">My Company Asset</font></a>
                                                            </h4>
                                                        </div>
                                                        <div class="task-content">
                                                            <h4 class="uppercase bold">
                                                                <a href="#"><font size="2">My Role & Responsibility</font></a>
                                                            </h4>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.onload = load_function;
    function load_function(){
        document.body.style.zoom = 0.9;
        
        $(document).on('click','.get_list_report', function() {
            $('#reportlistModal').modal('show');
        });

        $.ajax({
            url: "<?php echo site_url('Humanresource/allEmployee_priview_abc'); ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#emp_list').html(data.all);
            },
            error: function() {
                alert('Error Occur!');
            }
        });

        $('#search_item').on('keyup', function(e) {
            let search = $(this).val()
            let title = $('#body-title')

            if (search != '') {
                title.html(`
                            <i class="icon-user"></i> &bull;&nbsp;&nbsp;Search Result
                          `)
                load_data_search(search)
            } else {
                load_data_all()
                title.html(`
                            <i class="icon-users"></i> &bull;&nbsp;&nbsp;Employee Detail Register
                          `)
            }
        })

    }

    function load_data_search(query) {
        $.ajax({
            url: "<?= site_url('Humanresource/search_priview_abc') ?>",
            method: "POST",
            data: {
                query: query
            },
            success: function(hasil) {
                $('#emp_list').html(hasil)
            }
        })
    }

    function load_data_all() {
        $.ajax({
            url: "<?php echo site_url('Humanresource/allEmployee_priview_abc'); ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#emp_list').html(data.all);
            },
            error: function() {
                alert('Error Occur!');
            }
        });
    }
</script>
<?php $this->load->view('header_footer/hr/footer_n');?>