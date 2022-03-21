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
                                                    <h3 class="bold">Employee Gender Rekap</h3>                                                    
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
                                                                 <?php if($r_data_gender != null) { ?>                          
                                                                    <?php $no=1; $totalrow=0; $totalgender=0;
                                                                    foreach($r_data_gender as $gn) { ?>
                                                                    <?php  $totalrow = $gn->total ?>
                                                                    <?php $no++;$totalgender+=$totalrow;} ?>    
                                                                  <?php } else { ?> 
                                                                    <?php $totalrow=0; $totalgender=0; ?>
                                                                    <?php  $totalrow = '0' ?>
                                                                    <?php $totalgender+=$totalrow ?>                            
                                                                  <?php } ?>  
                                                                <tr class="bg-blue-madison font-white">
                                                                    <td class="text-center bold" width="10%">No</td>
                                                                    <td class="text-center bold" width="60%">Gender
                                                                    </td>
                                                                    <td class="text-center bold" width="30%">Total = <?php echo $totalgender; ?></td>
                                                                </tr>   
                                                            </thead>
                                                            <tbody>
                                                                <?php if($r_data_gender != null) { ?>                          
                                                                    <?php $no=1; $totalrow2=0; $totalgender2=0;
                                                                    foreach($r_data_gender as $gn) { ?>    
                                                                        <tr class="font-dark">
                                                                           <td align="center"><?php echo $no; ?></td>
                                                                           <td align="left"><?php echo $gn->Gender ?></td>
                                                                           <td align="center" class="bold"><?php echo $totalrow2 = $gn->total ?></td>
                                                                       </tr>
                                                                    <?php $no++;$totalgender2+=$totalrow2;} ?>  
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
                                                                    <th class="text-center" width="20%">Branch / Site</th>
                                                                    <th class="text-center" width="20%">Business Unit</th>
                                                                    <th class="text-center" width="20%">Department</th>
                                                                    <th class="text-center" width="20%">Cost Center</th>
                                                                    <?php if($genders != null) { ?>  
                                                                        <?php $cspan = 0;  foreach($genders as $gndr) { ?>
                                                                            <th width="15%" class="bg-blue-ebonyclay font-white"><center><?php echo $gndr->Gender ?></center></th>
                                                                        <?php $cspan++;} ?>
                                                                    <?php } else { ?>

                                                                    <?php } ?> 
                                                                    <th class="text-center" width="3%">Total</th>                                                               
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- <tr>
                                                                   <td colspan="5"><font size="4" color="#36c6d3"><i><u><center>Input parameter first to get report</center></u></i></font></td>
                                                                </tr> -->
                                                                <?php $gtal = 0; ?>
                                                                <?php if($databranch != null) { ?>  
                                                                    <?php foreach ($databranch as $br) { ?>
                                                                        <?php $total = 0; foreach($buss as $bus) { ?>
                                                                            <?php if($bus->Branch == $br->Branch) {?>
                                                                                <?php $no=1; foreach($dept as $dep) { ?>
                                                                                    <?php $no=1; foreach($costcenter as $costc) { ?>
                                                                                        <?php if($costc->Branch == $br->Branch AND $costc->BusinessUnit == $bus->BusinessUnit AND $costc->DeptCode == $dep->DeptCode) {?>
                                                                                            <tr class="font-dark">
                                                                                                <td width="2%" align="center"><?php echo $no ?></td>
                                                                                                <td width="20%" ><?php echo $br->BranchDes?></td>
                                                                                                <td width="20%" ><?php echo $bus->BUDes ?></td>
                                                                                                <td width="20%" ><?php echo $dep->DeptDes?></td>
                                                                                                <td width="20%" style="border-right: solid 1px;"><?php echo $costc->CostCenterDes?></td>
                                                                                                <?php $ttl = 0 ?>
                                                                                                <?php foreach($genders as $gndrs) { ?>
                                                                                                    <td width="15%" align="center" class="bold" style="border-top: solid 1px; border-left: solid 1px; border-right: solid 1px; border-bottom: solid 1px;">
                                                                                                        <?php foreach($dataget as $row) { ?>
                                                                                                          <?php if($row->Branch == $bus->Branch AND $row->BusinessUnit == $bus->BusinessUnit AND $row->DeptCode == $dep->DeptCode AND $row->CostCenter == $costc->CostCenter AND $row->Gender == $gndrs->Gender) { ?>
                                                                                                                    <a class="font-dark" href="#"><?php echo $row->count ?></a>
                                                                                                            <?php $ttl += $row->count; $total+=$row->count?>
                                                                                                          <?php } ?>
                                                                                                        <?php } ?>
                                                                                                    </td>
                                                                                                <?php } ?>                                  
                                                                                                <td width="3%" align="center" class="bold" style="border-top: solid 1px; border-left: solid 1px; border-right: solid 1px; border-bottom: solid 1px;"><a href="#"><font color="black"><?php echo $ttl ?></font></a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php } ?>
                                                                                    <?php $no++;} ?>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } else { ?>                          
                                                                    <tr>
                                                                      <td colspan="6" class="bold text-center"><font color="red">No Data !</font></td>
                                                                    </tr>
                                                                <?php } ?>   
                                                                <tr style="border-top: solid 2px;" class="font-dark sbold">
                                                                    <td width="2%" class="bg-blue-madison"></td>
                                                                    <td width="30%" class="bg-blue-madison"></td>
                                                                    <td width="20%" class="bg-blue-madison"></td>
                                                                    <td width="20%" class="bg-blue-madison"></td>
                                                                    <td width="15%" class="bg-blue-madison"><div align="right" class="font-white"><b>Grand Total : </b></div></td>
                                                                    <?php $gtotal = 0 ?>
                                                                    <?php if($grandtotal != null) { ?>  
                                                                        <?php foreach($grandtotal as $gtl) { ?>
                                                                            <td width="10%" align="center" class="sbold bg bg-blue-ebonyclay"><a href="#" ><font color="white"><?php echo $gtl = $gtl->count ?></font></a></td>
                                                                            <?php $gtotal += $gtl ?>
                                                                        <?php $cspan++;} ?>
                                                                    <?php } else { ?>

                                                                    <?php } ?>  
                                                                    <td width="3%" align="center" class="bg-blue-madison font-white"><a href="#"><font color="white"><b><?php echo $gtotal ?></b></font></a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table> 
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <?php if($datagender != nULL){ ?>
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
                                                                <?php foreach($genderst as $ge){ ?>
                                                                    <!-- <tr>
                                                                       <td colspan="5"><font size="4" color="#36c6d3"><i><u><center>Input parameter first to get report</center></u></i></font></td>
                                                                   </tr> -->
                                                                   <tr>
                                                                      <td style="padding-left: 10px;" colspan="8" class="bg-grey-salsa"><font color="black"><b><?php echo $ge->Gender ?></b></font></td><!-- background-color: #dad9d9;"-->
                                                                    </tr>
                                                                    <?php $no = 1;
                                                                    foreach($datagender as $dts){ ?>
                                                                        <?php if($dts->Gender == $ge->Gender){ ?>
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
                                                                        <?php $no++;} ?>
                                                                    <?php } ?>
                                                                <?php  } ?>   
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>                                            
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-md-12" id="printDivDetails" style="size: landscape; font-family: Open Sans, sans-serif;">
                                                <div class="portlet light bg-white">
                                                    <div style="float: right;">
                                                        <button class="btn btn-sm bg-blue-ebonyclay hidden-print" onclick="printDivDetails('printDivDetails')" style="background-color: #424e58; color: white">Print</button>
                                                        <!-- <a onclick="window.close();" class="btn btn-sm btn-danger hidden-print">Exit</a> -->
                                                    </div>                                            
                                                    <div class="caption">
                                                        <i class="fa fa-th font-dark"></i>
                                                            <span class="caption-subject font-dark bold uppercase">Detail <font color="red">( Total = 0 )</font></span>                                                    
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
                                                                    <tr><td class="text-center bold" colspan="8"><font color="red">No Data!</font></td></tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>                                            
                                                </div>
                                            </div>
                                        <?php } ?>
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
