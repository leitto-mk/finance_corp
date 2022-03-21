<?php $this->load->view('humanresource/rekap/v_header_print'); ?>

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
        background-color: #E1E5EC;
    }

    tr:nth-child(odd){
        background-color: white;
    }
</style>
<div class="page-wrapper-row full-height bg-default" style="padding: 0px; margin-top: -20px">
    <div class="page-wrapper-middle">
      <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->             
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container-fluid" style="padding-bottom:30px;">
                        <div class="page-content-inner">                                                    
                            <!-- Content Start -->                            
                            <div class="profile-content"> 
                                <!-- <div id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;">   -->
                                    <div class="caption">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="bold">Employee Supervisor Rekap</h3>                                                    
                                                </div>
                                            </div>
                                        </div>                                            
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-md-3" id="printDivDet" style="size: landscape; font-family: Open Sans, sans-serif;">
                                            <div class="portlet light bg-white">
                                                <div style="float: right;">
                                                    <button class="btn btn-sm bg-blue-ebonyclay hidden-print" onclick="printDivDet('printDivDet')" style="background-color: #424e58; color: white">Print</button>
                                                    <!-- <a onclick="window.close();" class="btn btn-sm btn-danger hidden-print">Exit</a> -->
                                                </div>                                                
                                                <div class="caption">
                                                    <i class="fa fa-th-list font-dark"></i>
                                                        <span class="caption-subject font-dark bold uppercase">All Category</span>                                                    
                                                </div>
                                                <div  id="printDivDet" style="size: landscape; font-family: Open Sans, sans-serif;" class="portlet-body"> 
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <?php if($r_data_supervisor != null) { ?>                          
                                                                    <?php $no=1; $totalrow=0; $totalsupervisor=0;
                                                                    foreach($r_data_supervisor as $esupervisor) { ?>
                                                                    <?php  $totalrow = $esupervisor->total ?>
                                                                    <?php $no++;$totalsupervisor+=$totalrow;} ?>    
                                                                <?php } else { ?> 
                                                                    <?php $totalrow=0; $totalsupervisor=0; ?>
                                                                    <?php  $totalrow = '0' ?>
                                                                    <?php $totalsupervisor+=$totalrow ?>                            
                                                                <?php } ?>  
                                                                <tr class="bg-blue-madison font-white">
                                                                    <td class="text-center bold" width="10%">No</td>
                                                                    <td class="text-center bold" width="60%">Supervisor
                                                                    </td>
                                                                    <td class="text-center bold" width="30%">Total = <?php echo $totalsupervisor; ?></td>
                                                                </tr>   
                                                            </thead>
                                                            <tbody>
                                                                <?php if($r_data_supervisor != Null) { ?>                          
                                                                    <?php $no=1; $test=0; $total=0;
                                                                    foreach($r_data_supervisor as $esupervisor) { ?>  
                                                                       <tr class="font-dark">
                                                                           <td align="center"><?php echo $no; ?></td>
                                                                           <td align="left"><?php echo $esupervisor->SupervisorName ?></td>
                                                                           <td align="center" class="bold"><?php echo $test = $esupervisor->total ?></td>
                                                                       </tr>
                                                                    <?php $no++;$total+=$test;} ?>   
                                                                <?php } else { ?>                          
                                                                    <tr>
                                                                      <td colspan="3" class="bold text-center"><font color="red">No Data !</font></td>
                                                                    </tr>
                                                                <?php } ?>    
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div class="col-md-9" id="printDivSum" style="size: landscape; font-family: Open Sans, sans-serif;">
                                            <div class="portlet light bg-white">
                                                <div style="float: right;">
                                                    <button class="btn btn-sm bg-blue-ebonyclay hidden-print" onclick="printDivSum('printDivSum')" style="background-color: #424e58; color: white">Print</button>
                                                    <!-- <a onclick="window.close();" class="btn btn-sm btn-danger hidden-print">Exit</a> -->
                                                </div>                                                
                                                <div class="caption">
                                                    <i class="fa fa-th-large font-dark"></i>
                                                        <span class="caption-subject font-dark bold uppercase">Summary</span>                                                    
                                                </div>
                                                <div  id="printDivSum" style="size: landscape; font-family: Open Sans, sans-serif;" class="portlet-body"> 
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead> 
                                                                <tr class="bg-blue-madison font-white">
                                                                    <th class="text-center" width="2%">No</th>
                                                                    <th class="text-center" width="25%">Branch / Site</th>
                                                                    <th class="text-center" width="20%">Business Unit</th>
                                                                    <th class="text-center" width="20%">Department</th>
                                                                    <th class="text-center" width="20%">Cost Center</th>                                     
                                                                    <th class="text-center" width="18%">Total</th>                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- <tr>
                                                                   <td colspan="5"><font size="4" color="#36c6d3"><i><u><center>Input parameter first to get report</center></u></i></font></td>
                                                                </tr> -->
                                                                <?php if($r_data_supervisor != false) { ?>   
                                                                    <?php foreach($r_data_supervisor as $sup) { ?>
                                                                        <tr>
                                                                              <td colspan="6" class="bg-grey-salsa" style="padding-left: 10px;"><b><?php echo $sup->SupervisorName ?></b></td><!--background-color: #dad9d9;-->
                                                                            </tr>
                                                                            <?php $total = 0; ?>
                                                                                <?php $index=1; $no=1; foreach($datas as $dts) { ?>
                                                                                    <?php if($dts->Supervisor == $sup->Supervisor) { ?>
                                                                                        <?php if($index == $ind){ ?>
                                                                                            <tr id="<?= $index; ?>" class="pulse font-dark">
                                                                                        <?php }else{ ?>
                                                                                            <tr id="<?= $index; ?>" class="font-dark">
                                                                                        <?php } ?>
                                                                                            <td width="2%" align="center"><?php echo $no ?></td>
                                                                                            <td width="25%"><?php echo $dts->BranchDes ?></td>
                                                                                            <td width="20%" style="padding-left:25px"><?php echo $dts->BUDes ?></td>
                                                                                            <td width="20%"><?php echo $dts->DeptDes ?></td>
                                                                                            <td width="20%"><?php echo $dts->CostCenterDes ?></td>
                                                                                            <td width="18%" align="center"><a href="#"><font color="black" class="bold"><?php echo $dts->ttl ?></font></a></td>
                                                                                            </tr>
                                                                                    <?php $no++;} ?>
                                                                                <?php $total=$total+$dts->ttl; $index++; } ?>
                                                                          <?php } ?>  
                                                                       <tr>
                                                                    <td></td>          
                                                                    <td colspan="3"></td>          
                                                                    <td align="right" class="font-dark"><b>Grand Total : </b></td>
                                                                    <td class="text-center bold" style="background-color: #22313F;"><a href="#"><font color="white"><?php echo $total; ?></font></a></td>
                                                                  </tr>
                                                            <?php } else { ?>   
                                                                <tr>
                                                                    <td colspan="6" class="bold text-center"><font color="red">No Data !</font></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                        </table> 
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="printDivDetails" style="size: landscape; font-family: Open Sans, sans-serif;">
                                            <div class="portlet light bg-white">
                                                <div style="float: right;">
                                                    <button class="btn btn-sm bg-blue-ebonyclay hidden-print" onclick="printDivDetails('printDivDetails')" style="background-color: #424e58; color: white">Print</button>
                                                    <!-- <a onclick="window.close();" class="btn btn-sm btn-danger hidden-print">Exit</a> -->
                                                </div>         
                                                <?php $totl = 0 ?>
                                                <?php foreach($detotal as $tt) { ?>
                                                    <?php $totl =$tt->total ?>
                                                <?php } ?>                                    
                                                <div class="caption">
                                                    <i class="fa fa-th font-dark"></i>
                                                        <span class="caption-subject font-dark bold uppercase">Detail <font color="red">( Total = <?php echo $totl; ?> )</font></span>                                                    
                                                </div>
                                                <div  id="printDivDetails" style="size: landscape; font-family: Open Sans, sans-serif;" class="portlet-body"> 
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead> 
                                                                <tr class="bg-blue-madison font-white">
                                                                    <th class="text-center" width="3%">No</th>
                                                                    <th class="text-center" width="7%">ID Number</th>
                                                                    <th class="text-center" width="15%">FullName</th>
                                                                    <th class="text-center" width="15%">Job Title</th>
                                                                    <th class="text-center" width="15%">Workgroup</th>
                                                                    <th class="text-center" width="15%">Work Location</th>
                                                                    <th class="text-center" width="15%">Cost Center</th>                                                                   
                                                                    <th class="text-center" width="15%">Department</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php if ($esupervisornict != ''){ ?>
                                                                <?php foreach($esupervisornict as $esupervisors){ ?>
                                                                    <!-- <tr>
                                                                       <td colspan="5"><font size="4" color="#36c6d3"><i><u><center>Input parameter first to get report</center></u></i></font></td>
                                                                   </tr> -->
                                                                   <tr>
                                                                      <td style="padding-left: 10px;" colspan="8" class="bg-grey-salsa"><font color="black"><b><?php echo $esupervisors->SupervisorName ?></b></font></td><!-- background-color: #dad9d9;"-->
                                                                    </tr>
                                                                    <?php $no = 1;
                                                                    foreach($datasupervisor as $dts){ ?>
                                                                        <?php if($dts->Supervisor == $esupervisors->Supervisor){ ?>
                                                                           <tr>
                                                                                <tr>
                                                                                    <td align="center"><a href="<?php echo site_url('Humanresource/view_personal_data_abc/'.$dts->IDNumber); ?>" target="_blank" class="font-dark"><?php echo $no; ?></a></td>
                                                                                    <td align=""><a href="<?php echo site_url('Humanresource/view_personal_data_abc/'.$dts->IDNumber); ?>" target="_blank" class="font-dark"><?php echo $dts->IDNumber; ?></a></td>
                                                                                    <td><a href="<?php echo site_url('Humanresource/view_personal_data_abc/'.$dts->IDNumber); ?>" target="_blank" class="font-dark"> <?php echo $dts->FirstName . ' ' . $dts->LastName; ?></a></td>
                                                                                    <td><a href="<?php echo site_url('Humanresource/view_personal_data_abc/'.$dts->IDNumber); ?>" target="_blank" class="font-dark"> <?php echo $dts->JobTitleDes; ?></a></td>
                                                                                    <td><a href="<?php echo site_url('Humanresource/view_personal_data_abc/'.$dts->IDNumber); ?>" target="_blank" class="font-dark"> <?php echo $dts->CrewDes; ?></a></td>
                                                                                    <td><a href="<?php echo site_url('Humanresource/view_personal_data_abc/'.$dts->IDNumber); ?>" target="_blank" class="font-dark"> <?php echo $dts->WorkLocation; ?> </a></td>
                                                                                    <td><a href="<?php echo site_url('Humanresource/view_personal_data_abc/'.$dts->IDNumber); ?>" target="_blank" class="font-dark"> <?php echo $dts->CostCenterDes; ?></a></td>
                                                                                    <td><a href="<?php echo site_url('Humanresource/view_personal_data_abc/'.$dts->IDNumber); ?>" target="_blank" class="font-dark"> <?php echo $dts->DeptDes; ?></a></td>
                                                                                </tr>
                                                                           </tr>
                                                                        <?php $no++;} ?>
                                                                    <?php } ?>
                                                                <?php } ?>   
                                                            <?php }else{ ?>
                                                                <tr>
                                                                    <td colspan="8" class="bold text-center"><font color="red">No Data !</font></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>
                                <!--  </div> -->
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
    document.body.style.zoom = 0.8;
}

function printDivDet(divName) {
var printContents = document.getElementById(divName).innerHTML;
var originalContents = document.body.innerHTML;
document.body.innerHTML = printContents;
window.print();
document.body.innerHTML = originalContents;
}

function printDivSum(divName) {
var printContents = document.getElementById(divName).innerHTML;
var originalContents = document.body.innerHTML;
document.body.innerHTML = printContents;
window.print();
document.body.innerHTML = originalContents;
}

function printDivDetails(divName) {
var printContents = document.getElementById(divName).innerHTML;
var originalContents = document.body.innerHTML;
document.body.innerHTML = printContents;
window.print();
document.body.innerHTML = originalContents;
}
</script>
<?php $this->load->view('humanresource/rekap/v_footer_print'); ?>
