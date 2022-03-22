<<<<<<< HEAD
<?php $this->load->view('header_footer/hr/header'); ?>
=======
<?php $this->load->view('humanresource/header_footer/header'); ?>
>>>>>>> 86faed4050dcae44fadc4b3129d1106aa9377d39
<style>
    .zoom {
        transition: transform .2s;
        /* Animation */
        margin: 0 auto;
    }

    .zoom:hover {
        transform: scale(1.5);
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }

@media (min-width: 992px){
    .page-content-wrapper .page-content {
        margin-left: -10px;        
    }

    .jumptarget::before {
      content:"";
      display:block;
      height:20px; /* fixed header height*/
      margin:-50px 0 0; /* negative fixed header height */
    }
}

tr:nth-child(even){
    background-color: #E1E5EC;
}

tr:nth-child(odd){
    background-color: white;
}
</style>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <div class="page-bar bg-blue-dark">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home font-white"></i>
                        <a href="#" class="font-white">Employee Admin</a>
                        <i class="fa fa-angle-right font-white"></i>
                    </li>
                    <li>
                        <i class="icon-user font-white"></i>
                        <a href="#" class="font-white">Personal Data</a>
                    </li>
                </ul>
                <div class="tabbable-line tabbable-custom-profile pull-right">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#persdet" data-toggle="tab"><b class="font-white">Personal</b></a>
                        </li>
                        <li>
                            <a href="#jobinfo" data-toggle="tab"><b class="font-white">Job Info</b></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <?php echo $this->session->flashdata('notif_login'); ?>
                <?php echo $this->session->flashdata('success_added'); ?>
                <?php echo $this->session->flashdata('error_msg_added'); ?>
            </div>
            <!-- END PAGE HEADER-->  
            <div class="tab-content">
            <?php echo $this->session->flashdata('success_update'); ?>    
            <?php if ($personal != ''){ ?>
                <?php foreach ($personal as $pers){ ?>
                    <div class="tab-pane active" id="persdet">
                        <div class="row">
                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet light bg-blue-ebonyclay">
                                    <div class="text-center">
                                        <?php if ($pers->Photo != ''){ ?> 
                                        <img src="<?php echo base_url(); ?>upload/profile/<?php echo $pers->Photo; ?>" alt="" height="100%" width="100%"/>
                                        <?php }else{ ?>
                                            <img src="<?php echo base_url(); ?>upload/profile/kosong.png" alt="" height="100%" width="100%"/>
                                        <?php } ?>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <h5 class="img-rounded zoom bold font-white"><?php echo $pers->FullName ?></h5>
                                    </div>
                                    <hr style="margin: 9px 0;">
                                    <table class="table" style="margin-bottom: 0px;">
                                        <tbody>
                                            <tr>
                                            <?php if ($pers->JobTitle == '' || $pers->JobTitle == null){ ?>
                                                <td class="sbold font-dark" align="center"><u>No Position</u></td>  
                                            <?php }else{ ?>
                                                <td class="sbold font-dark" style="border-top: none;"><center><u> <?php echo $pers->JobTitleDes ?></u></center></td>
                                            <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="portlet light bg-blue-ebonyclay">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-file font-white"></i> <font color="white">Identity Info</font></span>
                                        </div>
                                    </div>
                                    <table class="table font-dark" style="margin-bottom: 0px;">
                                        <tbody>
                                            <tr>
                                                <td width="28%" style="border-top: none;"> Number </td>
                                                <td class="bold" style="border-top: none;"> : </td>
                                                <td class="img-rounded zoom sbold"  style="border-top: none;"><?php echo $pers->IdentityNo ?></td>
                                            </tr>
                                            <tr>
                                                <td width="28%"> Expire </td>
                                                <td class="bold" width="1%"> : </td>
                                                <?php if ($pers->IdentityExpire == '0000-00-00' || $pers->IdentityExpire == ''){ ?>
                                                    <td class="sbold"></td>  
                                                <?php }else{ ?>
                                                <td class="sbold" ><?php echo date('d-M-Y', strtotime($pers->IdentityExpire)); ?></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <td width="28%"> Scan </td>
                                                <td class="bold" width="1%"> : </td>
                                                <td class="sbold" ><a href="#" data-target="#modal-dataktp" data-toggle="modal" class="btn btn-sm green btn-block">Priview</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-user"></i> Detail Info</span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 pull-right">
                                            <label class="col-md-2 col-sm-2 control-label bold" style="margin-left: -18px">Status</label>
                                            <label class="col-md-1 col-sm-1 control-label bold" style="margin-left: 15px">:</label>
                                            <div class="col-md-8 col-sm-8 pulse" style="margin-left: 16px" >
                                                <?php if ($pers->Status == 'Active'){ ?>
                                                    <input type="text" value="<?php echo $pers->Status ?>" class="btn btn-transparent btn-block btn-sm bold font-white" style="background-color: #577ec0">                                       
                                                <?php }else if($pers->Status == 'InActive'){ ?>
                                                    <input type="text" value="<?php echo $pers->Status ?>" class="btn btn-transparent btn-block btn-sm bold font-white" style="background-color: #e7505a"> 
                                                <?php } ?>                                       
                                            </div>
                                        </div>
                                       <!--  <div class="actions">
                                            <a href="#" class="btn yellow btn-outline btn-sm edit-stock">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                            <a id="i_label" href="#" class="btn blue btn-outline btn-sm">
                                                <i class="fa fa-barcode"></i> Label
                                            </a>
                                        </div> -->
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" class="text-right" style="border-top: none;"> ID Number </td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="sbold" id="stock_detail_1" style="border-top: none;"><?php echo $pers->IDNumber ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Personal ID </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" ><?php echo $pers->PersonalID ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> First Name </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" ><?php echo $pers->FirstName ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Middle Name </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" id="stock_detail_4"><?php echo $pers->MiddleName ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Last Name </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" id="stock_detail_5"><?php echo $pers->LastName ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Full Name </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" id="stock_detail_4"><?php echo $pers->FullName ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Nick Name </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" id="stock_detail_4"><?php echo $pers->NickName ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" class="text-right" style="border-top: none;"> Date of Birth </td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <?php if ($pers->DateofBirth == '0000-00-00' || $pers->DateofBirth == ''){ ?>
                                                                    <td class="sbold"></td>  
                                                                <?php }else{ ?>
                                                                    <td class="sbold" style="border-top: none;"><?php echo date('d-M-Y', strtotime($pers->DateofBirth)); ?></td>
                                                                <?php } ?>
                                                            </tr>
                                                             <tr>
                                                                <td width="38%" class="text-right"> Point of Birth </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->PointofBirth ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Gender </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" id="stock_detail_6"><?php echo $pers->Gender ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Marital Status </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->MaritalStatusDes ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Religion </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->Religion ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right" > Ethnic </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->Ethnic ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" class="text-right" style="border-top: none;"> Nationality </td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;"><?php echo $pers->Nationality ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Blood Type </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->BloodType ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Height </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->Height ?> Cm</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Weight </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->Weight ?> Kg</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-dark bold uppercase"><i class="fa fa-map-marker"></i> Address Detail</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="bg-blue-madison font-white">
                                                                <th width="30%">Address</th>
                                                                <th width="15%">City</th>
                                                                <th width="15%">Sub District</th>
                                                                <th width="10%">District</th>
                                                                <th width="10%">Region</th>
                                                                <th width="10%">Province</th>
                                                                <th width="10%">Country</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo $pers->Address ?>, <?php echo $pers->PostCode ?></td>
                                                                <td><?php echo $pers->CityDes ?></td>
                                                                <td><?php echo $pers->SubDistrictDes ?></td>
                                                                <td><?php echo $pers->DistrictDes ?></td>
                                                                <td><?php echo $pers->RegionDes ?></td>
                                                                <td><?php echo $pers->ProvinceDes ?></td>
                                                                <td><?php echo $pers->CountryDes ?></td>
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
                    <div class="tab-pane" id="jobinfo">
                        <div class="row">
                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet light bg-blue-ebonyclay">
                                    <div class="text-center">
                                        <?php if ($pers->Photo != ''){ ?> 
                                        <img src="<?php echo base_url(); ?>upload/profile/<?php echo $pers->Photo; ?>" alt="" height="100%" width="100%"/>
                                        <?php }else{ ?>
                                            <img src="<?php echo base_url(); ?>upload/profile/kosong.png" alt="" height="100%" width="100%"/>
                                        <?php } ?>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <h5 class="img-rounded zoom bold font-white"><?php echo $pers->FullName ?></h5>
                                    </div>
                                    <hr style="margin: 9px 0;">
                                    <table class="table" style="margin-bottom: 0px;">
                                        <tbody>
                                            <tr>
                                            <?php if ($pers->JobTitle == '' || $pers->JobTitle == null){ ?>
                                                <td class="sbold font-dark" align="center"><u>No Position</u></td>  
                                            <?php }else{ ?>
                                                <td class="sbold font-dark" style="border-top: none;"><center><u> <?php echo $pers->JobTitleDes ?></u></center></td>
                                            <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="portlet light bg-blue-ebonyclay">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-file font-white"></i> <font color="white">Identity Info</font></span>
                                        </div>
                                    </div>
                                    <table class="table font-dark" style="margin-bottom: 0px;">
                                        <tbody>
                                            <tr>
                                                <td width="28%" style="border-top: none;"> Number </td>
                                                <td class="bold" style="border-top: none;"> : </td>
                                                <td class="img-rounded zoom sbold"  style="border-top: none;"><?php echo $pers->IdentityNo ?></td>
                                            </tr>
                                            <tr>
                                                <td width="28%"> Expire </td>
                                                <td class="bold" width="1%"> : </td>
                                                <?php if ($pers->IdentityExpire == '0000-00-00' || $pers->IdentityExpire == ''){ ?>
                                                    <td class="sbold"></td>  
                                                <?php }else{ ?>
                                                <td class="sbold" ><?php echo date('d-M-Y', strtotime($pers->IdentityExpire)); ?></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <td width="28%"> Scan </td>
                                                <td class="bold" width="1%"> : </td>
                                                <td class="sbold" ><a href="#" data-target="#modal-dataktp" data-toggle="modal" class="btn btn-sm green btn-block">Priview</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-pencil"></i> Job Details</span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 pull-right">
                                            <label class="col-md-2 col-sm-2 control-label bold" style="margin-left: -18px">Status</label>
                                            <label class="col-md-1 col-sm-1 control-label bold" style="margin-left: 15px">:</label>
                                            <div class="col-md-8 col-sm-8 pulse" style="margin-left: 16px" >
                                                <?php if ($pers->Status == 'Active'){ ?>
                                                    <input type="text" value="<?php echo $pers->Status ?>" class="btn btn-transparent btn-block btn-sm bold font-white" style="background-color: #577ec0">                                       
                                                <?php }else if($pers->Status == 'InActive'){ ?>
                                                    <input type="text" value="<?php echo $pers->Status ?>" class="btn btn-transparent btn-block btn-sm bold font-white" style="background-color: #e7505a"> 
                                                <?php } ?>
                                            </div>
                                        </div>
                                       <!--  <div class="actions">
                                            <a href="#" class="btn yellow btn-outline btn-sm edit-stock">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                            <a id="i_label" href="#" class="btn blue btn-outline btn-sm">
                                                <i class="fa fa-barcode"></i> Label
                                            </a>
                                        </div> -->
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Employee Class </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" id="stock_detail_6"><?php echo $pers->EmployeeClassDes ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Employee Type </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" id="stock_detail_6"><?php echo $pers->EmployeeTypeDes ?></td>
                                                            </tr>                               
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" class="text-right" style="border-top: none;"> Job Title </td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;"><?php echo $pers->JobTitleDes ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Job Point </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->JobPointDes ?></td>
                                                            </tr> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody> 
                                                            <tr>
                                                                <td width="38%" class="text-right"> Work Function </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->WorkFunctionDes ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Workgroup </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->CrewDes ?></td>
                                                            </tr> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-building"></i> Hire Info</span>
                                        </div>
                                       <!--  <div class="actions">
                                            <a href="#" class="btn yellow btn-outline btn-sm edit-stock">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                            <a id="i_label" href="#" class="btn blue btn-outline btn-sm">
                                                <i class="fa fa-barcode"></i> Label
                                            </a>
                                        </div> -->
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr style="background-color: #e1e5ec">
                                                                <td width="38%" class="text-right"> Hire Date </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <?php if ($pers->HireDate == '0000-00-00' || $pers->HireDate == ''){ ?>
                                                                    <td class="sbold"></td>  
                                                                <?php }else{ ?>
                                                                    <td class="sbold"><?php echo date('d-M-Y', strtotime($pers->HireDate)); ?></td>
                                                                <?php } ?>
                                                            </tr>                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr style="background-color: #e1e5ec">
                                                                <td width="38%" class="text-right"> Point of Hire </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->PointofHire ?></td>
                                                            </tr>                                      
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-building"></i> Organization</span>
                                        </div>
                                       <!--  <div class="actions">
                                            <a href="#" class="btn yellow btn-outline btn-sm edit-stock">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                            <a id="i_label" href="#" class="btn blue btn-outline btn-sm">
                                                <i class="fa fa-barcode"></i> Label
                                            </a>
                                        </div> -->
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Supervisor </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->SupervisorName ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right" style="border-top: none;">Company</td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="bold" id="stock_detail_1" style="border-top: none;"><?php echo $pers->ComDes ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Site / Branch </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" ><?php echo $pers->BranchDes ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Division </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" id="stock_detail_4"><?php echo $pers->DivisionName ?></td>
                                                            </tr>                                         
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" class="text-right" style="border-top: none;"> Business Unit </td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="sbold" id="stock_detail_4" style="border-top: none;"><?php echo $pers->BUDes ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Department </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" id="stock_detail_4"><?php echo $pers->DeptDes ?> <!-- <span><a href="#" data-target="#myModal" data-toggle="modal" class="btn yellow btn-sm btn-outline pull-right"><i class="fa fa-pencil"></i></a></span> --></td>

                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Cost Center / Section </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold" id="stock_detail_5"><?php echo $pers->CostCenterDes ?></td>
                                                            </tr>
                                                                                                                  
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-phone"></i> Contact Details</span>
                                        </div>
                                       <!--  <div class="actions">
                                            <a href="#" class="btn yellow btn-outline btn-sm edit-stock">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                            <a id="i_label" href="#" class="btn blue btn-outline btn-sm">
                                                <i class="fa fa-barcode"></i> Label
                                            </a>
                                        </div> -->
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Mobile </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->Mobile1 ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="38%" class="text-right"> WA </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->WA ?></td>
                                                            </tr>                                      
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" class="text-right" style="border-top: none;"> Workphone </td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="sbold"  style="border-top: none;"><?php echo $pers->WorkPhone ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Email Personal </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><?php echo $pers->EmailPersonal ?></td>
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
                    <div class="modal fade" id="modal-dataktp" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #32c5d2; color: white">
                                     <button type="button" style="color: red" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                     <h4 id="modal-login-label" class="modal-title">Identity File [KTP] </h4>
                                </div>
                                <div class="modal-body" style="margin-bottom: 4%">
                                    <div class="form-body">
                                        <center>
                                            <div class="form-group form-md-line-input has-success" style="margin-bottom: 15px; padding-top: 0px;">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" >
                                                        <img src="<?php echo base_url(); ?>upload/profile/<?php echo $pers->Identity; ?>" alt="" height="100%" width="100%"/>
                                                    </div>                                                        
                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="modal fade" id="modal-efiledoc" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #32c5d2; color: white">
                                     <button type="button" style="color: red" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                     <h4 id="modal-login-label" class="modal-title">File Scan</h4>
                                </div>
                                <div class="modal-body" style="margin-bottom: 4%">
                                    <div class="form-body">
                                        <center>
                                            <div class="form-group form-md-line-input has-success" style="margin-bottom: 15px; padding-top: 0px;">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" >
                                                        <img src="<?php echo base_url(); ?>upload/profile/<?php echo $pers->Identity; ?>" alt="" width="100%" height="100%"/>
                                                    </div>                                                        
                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <div class="row">
                    <tr><td><center><font color="red">No Data!</font></center></td></tr>
                </div>
            <?php } ?>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<script type="text/javascript">
window.onload = load_function;
function load_function(){
    document.body.style.zoom = 0.9;
    $(document).on('click','.update_dept', function() {
        $('#myModal').modal('show');
    });

    $(document).on('change', '#i_dept', function() {
        if ($(this).val() == "") {
            $('input[name="i_deptdesc"]').val('');
        } else {
            var addr = $('#i_dept option:selected').attr('department-des');
            $('input[name="i_deptdesc"]').val(addr);
        }
    });
}
</script>
<<<<<<< HEAD
<?php $this->load->view('header_footer/hr/footer'); ?>
=======
<?php $this->load->view('humanresource/header_footer/footer'); ?>
>>>>>>> 86faed4050dcae44fadc4b3129d1106aa9377d39
