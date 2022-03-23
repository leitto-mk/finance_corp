<?php $this->load->view('humanresource/header_footer/header'); ?>
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

tr:nth-child(even){
    background-color: #E1E5EC;
}

tr:nth-child(odd){
    background-color: white;
}
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
                        <!-- <li>
                            <a href="#dependent" data-toggle="tab"><b class="font-white">Dependent</b></a>
                        </li>
                        <li>
                            <a href="#kin" data-toggle="tab"><b class="font-white">Kin</b></a>
                        </li>
                        </li> -->
                        <!--<li>
                            <a href="#appraisal" data-toggle="tab"><b>Appraisal</b></a>
                        </li>
                        <li>
                            <a href="#career" data-toggle="tab"><b>Career</b></a>
                        </li>
                        <li>
                            <a href="#asset" data-toggle="tab"><b>My Asset</b></a>
                        </li>
                        <li>
                            <a href="#leave" data-toggle="tab"><b>Leave</b></a>
                        </li>
                        <li>
                            <a href="#discipline" data-toggle="tab"><b>Discipline</b></a>
                        </li>
                        <li>
                            <a href="#earnings" data-toggle="tab"><b>Earnings</b></a>
                        </li>
                        <li>
                            <a href="#loans" data-toggle="tab"><b>Loans</b></a>
                        </li>
                        <li>
                            <a href="#ppe" data-toggle="tab"><b>PPE</b></a>
                        </li>
                        <li>
                            <a href="#efile" data-toggle="tab"><b>E-File</b></a>
                        </li> -->
                    </ul>
                </div>
            </div>
            <!-- END PAGE HEADER-->  
            <div class="tab-content">
            <?php echo $this->session->flashdata('success_update'); ?>  
            <?php echo $this->session->flashdata('success_added'); ?>
            <?php echo $this->session->flashdata('success_edit'); ?>
            <?php echo $this->session->flashdata('failed_added'); ?>
            <?php echo $this->session->flashdata('failed_edit'); ?>
            <?php echo $this->session->flashdata('success_delete'); ?>
            <?php if ($personal != ''){ ?>
                <?php foreach ($personal as $pers){ ?>
                    <div class="tab-pane active" id="persdet">
                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/transfer_edit_data_personal_abc" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet light bg-blue-ebonyclay">
                                    <div class="text-center modal_edit_pic_profile">
                                        <?php if ($pers->Photo != ''){ ?> 
                                        <img data-idnum="<?php echo $pers->IDNumber; ?>" src="<?php echo base_url(); ?>upload/profile/<?php echo $pers->Photo; ?>" alt=""  height="100%" width="100%"//>
                                        <?php }else{ ?>
                                            <img data-idnum="<?php echo $pers->IDNumber; ?>" src="<?php echo base_url(); ?>upload/profile/kosong.png" alt="" height="100%" width="100%"//>
                                        <?php } ?>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <h5 class="img-rounded zoom bold font-white"><?php echo $pers->FullName ?></h5>
                                    </div>
                                    <hr style="margin: 9px 0;">
                                    <!-- <table class="table" style="margin-bottom: 0px;">
                                        <tbody>
                                            <tr>
                                                <td width="28%" style="border-top: none;"><center>Registered Date :</center></td>
                                            </tr>
                                            <tr>
                                            <?php if ($pers->RegDate == '0000-00-00' || $pers->RegDate == ''){ ?>
                                                <td class="sbold"></td>  
                                            <?php }else{ ?>
                                                <td class="bold" style="border-top: none;"><center><?php echo date('d-M-Y', strtotime($pers->RegDate)); ?></center></td>
                                            <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table> -->
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
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-user"></i> Detail Info</span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 pull-right">
                                            <label class="col-md-2 col-sm-2 control-label bold" style="margin-left: -18px">Action</label>
                                            <label class="col-md-1 col-sm-1 control-label bold" style="margin-left: 15px">:</label>
                                            <div class="col-md-8 col-sm-8 pulse" style="margin-left: 16px">
                                                <input type="submit" name="submitdataeditpersonal" value="Edit" onclick="return confirm('Are you sure?')" class="btn btn-transparent blue btn-block btn-sm">                                       
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
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" class="text-right" style="border-top: none;"> ID Number </td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;"><input type="text" name="i_idnumber" class="form-control" value="<?php echo $pers->IDNumber ?>" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Personal ID </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><input type="text" name="personalid" class="form-control" value="<?php echo $pers->PersonalID ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> First Name </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><input type="text" name="firstname" class="form-control" value="<?php echo $pers->FirstName ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Middle Name </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><input type="text" name="middlename" class="form-control" value="<?php echo $pers->MiddleName ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Last Name </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><input type="text" name="lastname" class="form-control" value="<?php echo $pers->LastName ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Full Name </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><input type="text" name="fullname" class="form-control" value="<?php echo $pers->FullName ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Nick Name </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><input type="text" name="nickname" class="form-control" value="<?php echo $pers->NickName ?>"></td>
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
                                                                <td width="38%" class="text-right" style="border-top: none;"> Date of Birth </td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;"><input type="date" name="dateofbirth" class="form-control" value="<?php echo $pers->DateofBirth ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Point of Birth </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><input type="text" name="pointofbirth" class="form-control" value="<?php echo $pers->PointofBirth ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Gender </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <select name="gender"  class="form-control">
                                                                          <option value="<?php echo $pers->Gender ?>"><?php echo $pers->Gender ?>*</option>
                                                                          <option id="gender" value="Male">Male</option>
                                                                          <option id="gender" value="Female">Female</option>
                                                                    </select>
                                                                </td>
                                                            </tr>     
                                                            <tr>
                                                                <td width="38%" class="text-right"> Marital Status </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <div class="input-group">
                                                                        <input value="<?php echo $pers->MaritalStatusDes ?>" class="form-control" readonly>
                                                                        <span class="input-group-btn">
                                                                            <button href="#" type="button" class="btn blue btn-outline pull-right update_marital" title="Update Marital">
                                                                            <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                    <input name="maritalstatus" value="<?php echo $pers->MaritalStatus ?>" class="form-control hidden">
                                                                    <input name="i_maritalstatusdes" value="<?php echo $pers->MaritalStatusDes ?>" class="form-control hidden">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Religion </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <select name="religion"  class="form-control">
                                                                          <option value="<?php echo $pers->Religion ?>"><?php echo $pers->Religion ?>*</option>
                                                                          <option id="religion" value="Advent">Christian (Advent)</option>
                                                                          <option id="religion" value="Protestan">Christian (Protestan)</option>
                                                                          <option id="religion" value="Islam">Islam</option>
                                                                          <option id="religion" value="Catholic">Catholic</option>
                                                                          <option id="religion" value="Hindu">Hindu</option>
                                                                          <option id="religion" value="Buddha">Buddha</option>
                                                                          <option id="religion" value="Khonghucu">Khonghucu</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Ethnic </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <select name="ethnic" id="ethnic" class="form-control">
                                                                        <?php if ($get_ethnic != false) { ?>
                                                                            <option value="<?php echo $pers->Ethnic ?>"><?php echo $pers->Ethnic ?>*</option>
                                                                            <?php foreach ($get_ethnic as $eth) { ?>
                                                                                <option value="<?php echo $eth->Ethnic; ?>"><?php echo $eth->Ethnic; ?></option>
                                                                            <?php }?>
                                                                        <?php } else { ?>
                                                                            <option value=""><font color="red">No Data Ethnic</font></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right" style="border-top: none;"> Nationality </td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;">
                                                                    <select name="nationality" id="nationality" class="form-control">
                                                                        <?php if ($get_country != false) { ?>
                                                                            <option value="<?php echo $pers->Nationality ?>"><?php echo $pers->Nationality ?>*</option>
                                                                            <?php foreach ($get_country as $nat) { ?>
                                                                                <option value="<?php echo $nat->CountryCode; ?>"><?php echo $nat->CountryCode; ?> - <?php echo $nat->CountryName; ?></option>
                                                                            <?php }?>
                                                                        <?php } else { ?>
                                                                            <option value=""><font color="red">No Data Nationality</font></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
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
                                                                <th width="20%">Address</th>
                                                                <th width="12%">Country</th>
                                                                <th width="12%">Province</th>
                                                                <th width="12%">Region</th>
                                                                <th width="12%">District</th>
                                                                <th width="12%">Sub District</th>
                                                                <th width="12%">City</th>
                                                                <th width="8%">Post Code</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input type="text" name="address" class="form-control" value="<?php echo $pers->Address ?>"></td>
                                                                <td>
                                                                    <select name="country" id="country" class="form-control">
                                                                        <?php if ($get_country != false) { ?>
                                                                            <option value="<?php echo $pers->CountryCode ?>" selected><?php echo $pers->CountryDes ?>*</option>
                                                                            <?php foreach ($get_country as $ct) { ?>
                                                                                <option value="<?php echo $ct->CountryCode; ?>" country-des="<?php echo $ct->CountryName; ?>"><?php echo $ct->CountryCode; ?> - <?php echo $ct->CountryName; ?></option>
                                                                            <?php }?>
                                                                        <?php } else { ?>
                                                                            <option value=""><font color="red">No Data Country</font></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <input id="i_countrydes" name="i_countrydes" type="text" value="<?php echo $pers->CountryDes ?>" class="form-control hidden" readonly="true">
                                                                </td>
                                                                <td>
                                                                    <select name="province" id="province" class="form-control">
                                                                        <option value="<?php echo $pers->ProvinceCode ?>" selected=""><?php echo $pers->ProvinceDes ?>*</option> 
                                                                    </select>
                                                                    <input id="i_provincedes" name="i_provincedes" type="text" class="form-control hidden" value="<?php echo $pers->ProvinceDes ?>" readonly="true">
                                                                </td>
                                                                <td>
                                                                    <select name="region" id="region" class="form-control">
                                                                        <option value="<?php echo $pers->RegionCode ?>" selected=""><?php echo $pers->RegionDes ?>*</option> 
                                                                    </select>
                                                                    <input id="i_regiondes" name="i_regiondes" type="text" value="<?php echo $pers->RegionDes ?>" class="form-control hidden" readonly="true">
                                                                </td>
                                                                <td>
                                                                    <select name="district" id="district" class="form-control">
                                                                        <option value="<?php echo $pers->DistrictCode ?>" selected=""><?php echo $pers->DistrictDes ?>*</option> 
                                                                    </select>
                                                                    <input id="i_districtdes" name="i_districtdes" value="<?php echo $pers->DistrictDes ?>" type="text" class="form-control hidden" readonly="true">
                                                                </td>
                                                                <td>
                                                                    <select name="subdistrict" id="subdistrict" class="form-control">
                                                                        <option value="<?php echo $pers->SubDistrictCode ?>" selected=""><?php echo $pers->SubDistrictDes ?>*</option> 
                                                                    </select>
                                                                    <input id="i_subdistrictdes" name="i_subdistrictdes" value="<?php echo $pers->SubDistrictDes ?>" type="text" class="form-control hidden" readonly="true">
                                                                </td>
                                                                <td>
                                                                    <select name="city" id="city" class="form-control">
                                                                        <option value="<?php echo $pers->CityCode ?>" selected=""><?php echo $pers->CityDes ?>*</option> 
                                                                    </select>
                                                                    <input id="i_citydes" name="i_citydes" type="text" value="<?php echo $pers->CityDes ?>" class="form-control hidden" readonly="true">
                                                                </td>
                                                                <td><input type="text" name="postcode" id="postcode" class="form-control" value="<?php echo $pers->PostCode ?>" readonly></td>
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
                        </form>
                    </div>   
                    <form class="form-horizontal"  method="post"action="<?php echo base_url(); ?>index.php/Humanresource/edit_persphoto_byid_abc" enctype="multipart/form-data">
                    <input type="text" name="IDNumber" value="<?php echo $pers->IDNumber; ?>" class="hidden">
                        <div id="persphotoModal" data-backdrop="static"  data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-blue">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h5 class="modal-title font-white"><i class="fa fa-pencil"></i> <b>Edit Photo</b></h5>
                                    </div>
                                    <div class="modal-body" style="margin-bottom: 4%">
                                        <div class="form-body">
                                            <center>
                                                <div class="form-group form-md-line-input has-success" style="margin-bottom: 15px; padding-top: 0px;">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" >
                                                            <img src="#" data-idnum="" alt="" style="width:auto; height: 200px"/>
                                                            <input type="text" name="idnum" val="" class="hidden">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="width:auto; height: 200px"> </div>
                                                        <div>
                                                            <span class="btn blue btn-file">
                                                                <span class="fileinput-new">Image Profile </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="photo" required> </span>
                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                </div><hr>
                                                <div class="portlet-title" style="background-color: #2D5F8B">
                                                    <div class="caption pull-right">
                                                      <button type="submit" name="submitpersphoto" value="Submit" class="btn btn-transparent green btn-block btn-sm">
                                                      Submit</button></div>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div> 
                    </form>                
                    <div class="tab-pane" id="jobinfo">
                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/transfer_edit_data_job_abc" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet light bg-blue-ebonyclay">
                                    <div class="text-center modal_edit_pic_profile">
                                        <?php if ($pers->Photo != ''){ ?> 
                                        <img data-idnum="<?php echo $pers->IDNumber; ?>" src="<?php echo base_url(); ?>upload/profile/<?php echo $pers->Photo; ?>" alt=""  height="100%" width="100%"//>
                                        <?php }else{ ?>
                                            <img data-idnum="<?php echo $pers->IDNumber; ?>" src="<?php echo base_url(); ?>upload/profile/kosong.png" alt="" height="100%" width="100%"//>
                                        <?php } ?>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <h5 class="img-rounded zoom bold font-white"><?php echo $pers->FullName ?></h5>
                                    </div>
                                    <hr style="margin: 9px 0;">
                                    <!-- <table class="table" style="margin-bottom: 0px;">
                                        <tbody>
                                            <tr>
                                                <td width="28%" style="border-top: none;"><center>Registered Date :</center></td>
                                            </tr>
                                            <tr>
                                            <?php if ($pers->RegDate == '0000-00-00' || $pers->RegDate == ''){ ?>
                                                <td class="sbold"></td>  
                                            <?php }else{ ?>
                                                <td class="bold" style="border-top: none;"><center><?php echo date('d-M-Y', strtotime($pers->RegDate)); ?></center></td>
                                            <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table> -->
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
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject font-blue-chambray bold uppercase"><i class="fa fa-pencil"></i> Job Details</span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 pull-right">
                                            <label class="col-md-2 col-sm-2 control-label bold" style="margin-left: -18px">Action</label>
                                            <label class="col-md-1 col-sm-1 control-label bold" style="margin-left: 15px">:</label>
                                            <div class="col-md-8 col-sm-8 pulse" style="margin-left: 16px">
                                                <input type="submit" name="submitdataeditjob" value="Edit" onclick="return confirm('Are you sure?')" class="btn btn-transparent green btn-block btn-sm">                                       
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
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr class="hidden">
                                                                <td width="38%" class="text-right" style="border-top: none;"> ID Number </td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;"><input type="text" name="i_idnumber" class="form-control" value="<?php echo $pers->IDNumber ?>" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Hire Date </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <div class="input-group">
                                                                        <input value="<?php echo date('d-M-Y', strtotime($pers->HireDate)); ?>" class="form-control" readonly>
                                                                        <span class="input-group-btn">
                                                                            <button href="#" type="button" class="btn blue btn-outline pull-right update_hiredate" title="Update Hire Date">
                                                                            <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                    <input name="hiredate" value="<?php echo $pers->HireDate ?>" class="form-control hidden">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Employee Class </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <select name="employeeclass" id="employeeclass" class="form-control">
                                                                        <?php if ($get_employeeclass != false) { ?>
                                                                            <option value="<?php echo $pers->EmployeeClass ?>" selected><?php echo $pers->EmployeeClassDes ?>*</option>
                                                                            <?php foreach ($get_employeeclass as $ec) { ?>
                                                                                <option value="<?php echo $ec->EmployeeClass; ?>" empclass-des="<?php echo $ec->EmployeeClassDes; ?>"><?php echo $ec->EmployeeClassDes; ?></option>
                                                                            <?php }?>
                                                                        <?php } else { ?>
                                                                            <option value=""><font color="red">No Data Employee Class</font></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <input id="i_employeeclassdes" name="i_employeeclassdes" type="text" class="form-control hidden" value="<?php echo $pers->EmployeeClassDes ?>" readonly="true">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Employee Type </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <div class="input-group">
                                                                        <input value="<?php echo $pers->EmployeeTypeDes ?>" class="form-control" readonly>
                                                                        <span class="input-group-btn">
                                                                            <button href="#" type="button" class="btn blue btn-outline pull-right update_employeetype" title="Update Employee Type">
                                                                            <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                    <input name="employeetype" value="<?php echo $pers->EmployeeType ?>" class="form-control hidden">
                                                                    <input name="i_employeetypedes" value="<?php echo $pers->EmployeeTypeDes ?>" class="form-control hidden">
                                                                </td>
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
                                                                <td width="38%" class="text-right"> Point of Hire </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <div class="input-group">
                                                                        <input value="<?php echo $pers->PointofHire ?>" class="form-control" readonly>
                                                                        <span class="input-group-btn">
                                                                            <button href="#" type="button" class="btn blue btn-outline pull-right update_pointofhire" title="Update Point of Hire">
                                                                            <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                    <input name="pointofhire" value="<?php echo $pers->PointofHire ?>" class="form-control hidden">
                                                                </td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="38%" class="text-right" style="border-top: none;"> Job Title </td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;">
                                                                    <div class="input-group">
                                                                        <input value="<?php echo $pers->JobTitleDes ?>" class="form-control" readonly>
                                                                        <span class="input-group-btn">
                                                                            <button href="#" type="button" class="btn blue btn-outline pull-right update_jobtitle" title="Update Job Title">
                                                                            <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                    <input name="jobtitle" value="<?php echo $pers->JobTitle ?>" class="form-control hidden">
                                                                    <input name="i_jobtitle" value="<?php echo $pers->JobTitleDes ?>" class="form-control hidden">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Work Function </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <div class="input-group">
                                                                        <input value="<?php echo $pers->WorkFunctionDes ?>" class="form-control" readonly>
                                                                        <span class="input-group-btn">
                                                                            <button href="#" type="button" class="btn blue btn-outline pull-right update_workfunction" title="Update Work Function">
                                                                            <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                    <input name="workfunction" value="<?php echo $pers->WorkFunction ?>" class="form-control hidden">
                                                                    <input name="i_workfunctiondes" value="<?php echo $pers->WorkFunctionDes ?>" class="form-control hidden">
                                                                </td>
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
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table" id="detail_table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Supervisor </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <div class="input-group">
                                                                        <input value="<?php echo $pers->SupervisorName ?>" class="form-control" readonly>
                                                                        <span class="input-group-btn">
                                                                            <button href="#" type="button" class="btn blue btn-outline pull-right update_supervisor" title="Update Supervisor">
                                                                            <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                    <input name="supervisor" class="form-control hidden" rows="3" value="<?php echo $pers->Supervisor ?>" style="resize: none;" readonly>
                                                                    <input name="i_sup_des" class="form-control hidden" rows="3" value="<?php echo $pers->SupervisorName ?>" style="resize: none;" readonly>
                                                                    <input name="i_sup_title_code" class="form-control hidden" rows="3" value="<?php echo $pers->SupervisorTitle ?>" style="resize: none;" readonly>
                                                                    <input name="i_sup_title_des" class="form-control hidden" rows="3" value="<?php echo $pers->SupervisorTitleDes ?>" style="resize: none;" readonly>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right" style="border-top: none;">Company</td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="bold" style="border-top: none;">
                                                                    <input class="form-control" value="<?php echo $pers->ComDes ?>" readonly>
                                                                    <input name="i_companycode" value="<?php echo $pers->Company ?>" class="form-control hidden">
                                                                    <input name="i_companydes" value="<?php echo $pers->ComDes ?>" class="form-control hidden">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Site / Branch </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <div class="input-group">
                                                                        <input  class="form-control" value="<?php echo $pers->BranchDes ?>" readonly>
                                                                        <span class="input-group-btn">
                                                                            <button href="#" type="button" class="btn blue btn-outline pull-right view_branch_his" title="Preview History Branch">
                                                                            <i class="fa fa-search"></i>
                                                                            </button>
                                                                        </span>  
                                                                    </div>
                                                                    <input name="i_branchcode" value="<?php echo $pers->Branch ?>" class="form-control hidden">
                                                                    <input name="i_branchdes" value="<?php echo $pers->BranchDes ?>" class="form-control hidden">
                                                                </td>
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
                                                                <td width="38%" class="text-right"> Department </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <div class="input-group">
                                                                        <input value="<?php echo $pers->DeptDes ?>" class="form-control" readonly>
                                                                        <span class="input-group-btn">
                                                                            <button href="#" type="button" class="btn blue btn-outline pull-right update_dept" title="Update Department">
                                                                            <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                        </span>  
                                                                    </div>
                                                                    <input name="i_dept" value="<?php echo $pers->DeptCode ?>" class="form-control hidden">
                                                                    <input name="i_deptdesc" value="<?php echo $pers->DeptDes ?>" class="form-control hidden">
                                                                    <input name="i_bucode" value="<?php echo $pers->BusinessUnit ?>" type="text" class="form-control hidden" readonly="true">
                                                                    <input name="i_budes" value="<?php echo $pers->BUDes ?>" type="text" class="form-control hidden" readonly="true">
                                                                    <input name="i_divcode" value="<?php echo $pers->DivCode ?>" type="text" class="form-control hidden" readonly="true">
                                                                    <input name="i_divdes" value="<?php echo $pers->DivisionName ?>" type="text" class="form-control hidden" readonly="true">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Cost Center / Section </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <div class="input-group">
                                                                        <input value="<?php echo $pers->CostCenterDes; ?>" class="form-control" readonly>
                                                                        <span class="input-group-btn">
                                                                            <button href="#" type="button" class="btn blue btn-outline pull-right view_costcenter_his" title="Preview History Cost Center">
                                                                            <i class="fa fa-search"></i>
                                                                            </button>
                                                                        </span>  
                                                                    </div>
                                                                </td>
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
                                                                <td width="38%" class="text-right"> Status </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold">
                                                                    <select name="status"  class="form-control">
                                                                          <option value="<?php echo $pers->Status ?>"><?php echo $pers->Status ?>*</option>
                                                                          <option id="status" value="Active">Active</option>
                                                                          <option id="status" value="InActive">InActive</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="38%" class="text-right"> Status Date </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><input type="date" name="statusdate" class="form-control" value="<?php echo $pers->StatusDate ?>"></td>
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
                                                                <td width="38%" class="text-right" style="border-top: none;"> Mobile</td>
                                                                <td width="1%" class="bold" style="border-top: none;"> : </td>
                                                                <td class="sbold" style="border-top: none;"><input type="text" name="mobile1" class="form-control" value="<?php echo $pers->Mobile1 ?>"></td>
                                                            </tr> 
                                                            <tr>
                                                                <td width="38%" class="text-right"> WA </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><input type="text" name="wa" class="form-control" value="<?php echo $pers->WA ?>"></td>
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
                                                                <td class="sbold" style="border-top: none;"><input type="text" name="workphone" class="form-control" value="<?php echo $pers->WorkPhone ?>"></td>
                                                            </tr>    
                                                            <tr>
                                                                <td width="38%" class="text-right"> Email Personal </td>
                                                                <td width="1%" class="bold"> : </td>
                                                                <td class="sbold"><input type="text" name="emailpersonal" class="form-control" value="<?php echo $pers->EmailPersonal ?>"></td>
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
                        </form>
                    </div>
                    
                    <div class="modal fade" id="maritalModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Marital !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_marital_abc" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Marital
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="maritalstatus" id="maritalstatus" class="form-control" required>
                                                        <option value="" selected>-- Select Marital--</option>
                                                            <?php if ($get_marital != ''){ ?>
                                                                <?php foreach ($get_marital as $mar) { ?>
                                                                    <option value="<?php echo $mar->Marital; ?>" marital-des="<?php echo $mar->MaritalDes; ?>"><?php echo $mar->Marital; ?> | <?php echo $mar->MaritalDes; ?></option>
                                                                <?php }?>
                                                            <?php } else { ?>
                                                                <option value="">
                                                                    <font color="red">No Data Marital</font>
                                                                </option>
                                                            <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_maritalstatusdes" id="i_maritalstatusdes" value="" class="form-control" style="resize: none;" placeholder="Marital Description" readonly>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditmarital" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Marital History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hismarital">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Marital Status</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_marital_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_marital_his as $marh){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $marh->MaritalDes ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($marh->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $marh->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="employeetypeModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Employee Type !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_employeetype" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Employee Type
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="employeetype" id="employeetype" class="form-control" required>
                                                        <?php if ($get_employeetype != false) { ?>
                                                            <option value="" selected>-- Choose Employee Type --</option>
                                                            <?php foreach ($get_employeetype as $et) { ?>
                                                                <option value="<?php echo $et->EmployeeType; ?>" emptype-des="<?php echo $et->EmployeeTypeDes; ?>"><?php echo $et->EmployeeTypeDes; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data Employee Type</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_employeetypedes" id="i_employeetypedes" value="" class="form-control" style="resize: none;" placeholder="Employee Type Description" readonly>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditemployeetype" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Employee Type History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisemployeetype">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Employee Type</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_employeetype_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_employeetype_his as $ethis){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $ethis->EmployeeTypeDes ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($ethis->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $ethis->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="employmenttypeModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Employment Type !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_employmenttype" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Employee Type
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="employmenttype" id="employmenttype" class="form-control" required>
                                                        <?php if ($get_employmenttype != false) { ?>
                                                            <option value="" selected>-- Choose Employment Type --</option>
                                                            <?php foreach ($get_employmenttype as $emt) { ?>
                                                                <option value="<?php echo $emt->EmploymentType; ?>" employmenttype-des="<?php echo $emt->EmploymentTypeDes; ?>"><?php echo $emt->EmploymentTypeDes; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data Employment Type</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_employmenttypedes" id="i_employmenttypedes" value="" class="form-control" style="resize: none;" placeholder="Employment Type Description" readonly>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditemploymenttype" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Employment Type History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisemploymenttype">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Employment Type</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_employmenttype_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_employmenttype_his as $emthis){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $emthis->EmploymentTypeDes ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($emthis->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $emthis->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="jobtitleModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Job Title !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_jobtitle_abc" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Job Title
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="jobtitle" id="jobtitle" class="form-control" required>
                                                        <?php if ($get_title != false) { ?>
                                                            <option value="" selected>-- Choose Title --</option>
                                                            <?php foreach ($get_title as $jt) { ?>
                                                                <option value="<?php echo $jt->JobTitleCode; ?>" jobtitle-des="<?php echo $jt->JobTitle; ?>"><?php echo $jt->JobTitle; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data JobTitle</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_jobtitle" id="i_jobtitle" value="" class="form-control" style="resize: none;" placeholder="Job Title Description" readonly>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditjobtitle" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Job Title History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisjobtitle">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Job Title</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_jobtitle_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_jobtitle_his as $jth){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $jth->JobTitleDes ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($jth->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $jth->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="positiontitleModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Position Title !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_positiontitle" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Position Title
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="positiontitle" id="positiontitle" class="form-control" required>
                                                        <?php if ($get_title != false) { ?>
                                                            <option value="" selected>-- Choose Title --</option>
                                                            <?php foreach ($get_title as $jt) { ?>
                                                                <option value="<?php echo $jt->JobTitleCode; ?>" positiontitle-des="<?php echo $jt->JobTitle; ?>"><?php echo $jt->JobTitle; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data Position Title</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_positiontitle" id="i_positiontitle" value="" class="form-control" style="resize: none;" placeholder="Position Title Description" readonly>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditpositiontitle" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Position Title History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hispositiontitle">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Position Title</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_position_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_position_his as $jph){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $jph->JobPositionDes ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($jth->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $jph->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="individuallevelModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Position Level !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_individuallevel" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Position Level
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="i_levelcode" id="i_levelcode" class="form-control" required>
                                                        <option value="" selected>-- Select Level--</option>
                                                            <?php if ($get_level != ''){ ?>
                                                                <?php foreach ($get_level as $dlevel) { ?>
                                                                    <option value="<?php echo $dlevel->LevelCode; ?>" e-level="<?php echo $dlevel->Level; ?>" e-level-des="<?php echo $dlevel->LevelDescription; ?>" e-mgt-type="<?php echo $dlevel->ManagementType; ?>" e-mgt-group="<?php echo $dlevel->ManagementGroup; ?>"><?php echo $dlevel->Level ?> | <?php echo $dlevel->LevelCode ?> | <?php echo $dlevel->LevelDescription ?></option>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <option value="">
                                                                    <font color="red">No Data Level</font>
                                                                </option>
                                                            <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_leveldes" id="i_leveldes" value="" class="form-control" style="resize: none;" placeholder="Level Description" readonly>

                                                    <input name="i_level" id="i_level" value="" class="form-control hidden" style="resize: none;" readonly>
                                                    <input name="i_mgttype" id="i_mgttype" value="" class="form-control hidden" style="resize: none;" readonly>
                                                    <input name="i_mgtgroup" id="i_mgtgroup" value="" class="form-control hidden" style="resize: none;" readonly>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditindividuallevel" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure to submit?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Level History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisindividualgrade">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Grade</center></th>
                                                            <th><center>Level</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_grade_level_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_grade_level_his as $glhis){ ?>
                                                            <tr>
                                                                <td width="10%" align="center"><?php echo $no; ?></td>
                                                                <td width="20%"><?php echo $glhis->EmployeeLevel ?></td>
                                                                <td width="20%"><?php echo $glhis->EmployeeLevelDes ?></td>
                                                                <td width="15%" align="center"><?php echo date('d-M-Y', strtotime($glhis->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $glhis->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="workfunctionModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Work Function !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_workfunction_abc" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Work Function
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="workfunction" id="workfunction" class="form-control" required>
                                                        <?php if ($get_workfunction != false) { ?>
                                                            <option value="" selected>-- Choose Function --</option>
                                                            <?php foreach ($get_workfunction as $wf) { ?>
                                                                <option value="<?php echo $wf->WorkFunction; ?>" workfunction-des="<?php echo $wf->WorkFunctionDes; ?>" wgroup-code="<?php echo $wf->WorkGroup; ?>" wgroup-des="<?php echo $wf->WorkGroupDes; ?>"><?php echo $wf->WorkFunctionDes; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data Function</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_workfunctiondes" id="i_workfunctiondes" value="" class="form-control" style="resize: none;" placeholder="Work Function Description" readonly>
                                                    <input id="i_wgroup" name="i_wgroup" type="text" class="form-control hidden" readonly="true">
                                                    <input id="i_wgroupdes" name="i_wgroupdes" type="text" class="form-control hidden" readonly="true">
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditworkfunction" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Work Function History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisworkfunction">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Work Function</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_workfunction_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_workfunction_his as $wf){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $wf->WorkFunctionDes ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($wf->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $wf->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="workgroupModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Workgroup / Crew !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_workgroup_abc" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Workgroup
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="crew" id="crew" class="form-control" required>
                                                        <?php if ($get_workgroup != false) { ?>
                                                            <option value="" selected>-- Choose Workgroup --</option>
                                                            <?php foreach ($get_workgroup as $wg) { ?>
                                                                <option value="<?php echo $wg->Crew; ?>" workgroup_des="<?php echo $wg->CrewName; ?>"><?php echo $wg->Crew; ?> - <?php echo $wg->CrewName; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data Workgroup</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_workgroup" id="i_workgroup" value="" class="form-control" style="resize: none;" placeholder="Workgroup Description" readonly>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditworkgroup" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Workgroup History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisworkgroup">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Workgroup</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_workgroup_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_workgroup_his as $wgh){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $wgh->Crew; ?> - <?php echo $wgh->CrewDes ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($wgh->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $wgh->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="onsitemaritalModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Onsite Marital !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_onsitemarital" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Onsite Marital
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="onsitemarital" id="onsitemarital" class="form-control" required>
                                                        <?php if ($get_onsitemarital != false) { ?>
                                                            <option value="" selected>-- Choose Onsite Marital --</option>
                                                            <?php foreach ($get_onsitemarital as $onmar) { ?>
                                                                <option value="<?php echo $onmar->OnsiteMarital; ?>" onsitemarital-des="<?php echo $onmar->OnsiteMaritalDes; ?>"><?php echo $onmar->OnsiteMaritalDes; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data Onsite Marital</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_onsitemaritaldes" id="i_onsitemaritaldes" value="" class="form-control" style="resize: none;" placeholder="Onsite Marital Description" readonly>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditonsitemarital" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Onsite Marital History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisonsitemarital">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Onsite Marital</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_onsitemarital_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_onsitemarital_his as $omh){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $omh->OnsiteMaritalDes ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($omh->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $omh->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="maritalbenefitModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Marital Benefit !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_maritalbenefit" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Marital Benefit
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="maritalbenefit" id="maritalbenefit" class="form-control" required>
                                                        <?php if ($get_maritalbenefit != false) { ?>
                                                            <option value="" selected>-- Choose Marital Benefit --</option>
                                                            <?php foreach ($get_maritalbenefit as $marben) { ?>
                                                                <option value="<?php echo $marben->MaritalBenefitCode; ?>" maritalbenefit-des="<?php echo $marben->MaritalBenefitDes; ?>"><?php echo $marben->MaritalBenefitDes; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data Marital Benefit</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_maritalbenefitdes" id="i_maritalbenefitdes" value="" class="form-control" style="resize: none;" placeholder="Marital Benefit Description" readonly>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditmaritalbenefit" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Marital Benefit History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hismaritalbenefit">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Marital Benefit</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_maritalbenefit_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_maritalbenefit_his as $mbh){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $mbh->MaritalBenefitDes ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($mbh->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $mbh->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="probationdateModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Probation Date !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_probationdate" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Probation Date
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="date" name="probationdate" id="probationdate" value="" class="form-control" required>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditprobationdate" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Probation Date History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisprobationdate">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Probation Date</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_probationdate_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_probationdate_his as $pd){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%" align="center"><?php echo date('d-M-Y', strtotime($pd->ProbationDate)); ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($pd->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $pd->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="hiredateModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Hire Date !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_hiredate_abc" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Hire Date
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="date" name="hiredate" id="hiredate" value="" class="form-control" required>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submitedithiredate" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Hire Date History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hishiredate">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Hire Date</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_hire_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_hire_his as $hd){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%" align="center"><?php echo date('d-M-Y', strtotime($hd->HireDate)); ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($hd->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $hd->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="servicedateModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Service Date !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_servicedate" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Service Date
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="date" name="servicedate" id="servicedate" value="" class="form-control" required>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditservicedate" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Service Date History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisservicedate">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Services Date</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_service_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_service_his as $sd){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%" align="center"><?php echo date('d-M-Y', strtotime($sd->ServiceDate)); ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($sd->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $sd->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="pointofhireModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Point of Hire !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_pointofhire_abc" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Point of Hire
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="text" name="pointofhire" id="pointofhire" value="" class="form-control" placeholder="Enter text" required>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditpointofhire" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Point of Hire History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hispointofhire">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Point of Hire</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_pointofhire_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_pointofhire_his as $poh){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $poh->PointOfHire; ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($poh->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $poh->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="pointofleaveModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Point of Leave !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_pointofleave" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Point of Leave
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="text" name="pointofleave" id="pointofleave" value="" class="form-control" placeholder="Enter text" required>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditpointofleave" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Point of Leave History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hispointofleave">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Point of Leave</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_pointofleave_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_pointofleave_his as $pol){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $pol->PointOfLeave; ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($pol->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $pol->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="pointoftravelModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Point of Travel !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_pointoftravel" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Point of Travel
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="text" name="pointoftravel" id="pointoftravel" value="" class="form-control" placeholder="Enter text" required>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditpointoftravel" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Point of Travel History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hispointoftravel">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Point of Travel</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_pointoftravel_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_pointoftravel_his as $pot){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $pot->PointOfTravel; ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($pot->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $pot->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="worklocationModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Work Location !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_worklocation" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Worklocation
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="text" name="worklocation" id="worklocation" value="" class="form-control" placeholder="Enter text" required>
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditworklocation" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Worklocation History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisworklocation">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Worklocation</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_worklocation_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_worklocation_his as $wl){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $wl->WorkLocation; ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($wl->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $wl->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="supervisorModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Supervisor !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_supervisor_abc" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Supervisor
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="supervisor" id="supervisor" class="form-control" required>
                                                        <?php if ($get_supervisor != false) { ?>
                                                            <option value="" selected>-- Choose Supervisor --</option>
                                                            <?php foreach ($get_supervisor as $sup) { ?>
                                                                <option value="<?php echo $sup->IDNumber; ?>" sup-des="<?php echo $sup->FirstName; ?> <?php echo $sup->LastName; ?>" suptitle-code="<?php echo $sup->PositionTitle; ?>" suptitle-des="<?php echo $sup->PositionTitleDes; ?>"><?php echo $sup->IDNumber; ?> | <?php echo $sup->FirstName; ?> <?php echo $sup->LastName; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data Supervisor</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <textarea name="i_sup_des" class="form-control" placeholder="Supervisor Description" style="resize: none;" readonly></textarea>
                                                    <input name="i_sup_title_code" id="i_sup_title_code" value="" class="form-control hidden" style="resize: none;"readonly>
                                                    <input name="i_sup_title_des" id="i_sup_title_des" value="" class="form-control hidden" style="resize: none;"readonly>
                                                </div>
                                            </div>    
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditsupervisor" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Supervisor History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hissupervisor">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Supervisor</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_supervisor_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_supervisor_his as $sup){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $sup->SupervisorName; ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($sup->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $sup->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="workinsuranceModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Work Insurance !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_workinsurance" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Work Insurance
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="text" name="workinsurance" id="workinsurance" value="" class="form-control" placeholder="Enter text" required>
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditworkinsurance" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Work Insurance History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisworkinsurance">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Work Insurance</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_workinsurance_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_workinsurance_his as $wi){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $wi->InsuranceBPJS; ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($wi->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $wi->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="medicalinsuranceModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Medical Insurance !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_medicalinsurance" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Medical Insurance
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="text" name="medicalinsurance" id="medicalinsurance" value="" class="form-control" placeholder="Enter text" required>
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditmedicalinsurance" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Medical Insurance History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisworkinsurance">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Medical Insurance</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_medicalinsurance_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_medicalinsurance_his as $wi){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $wi->InsuranceMedical; ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($wi->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $wi->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="workdayModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Work Day !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_workday" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Work Day
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="workday" id="workday" class="form-control" required>
                                                        <?php if ($get_workday != false) { ?>
                                                            <option value="" selected>-- Choose Work Day --</option>
                                                            <?php foreach ($get_workday as $workd) { ?>
                                                                <option value="<?php echo $workd->WorkDayCode; ?>" workday-des="<?php echo $workd->WorkDayDes; ?>"><?php echo $workd->WorkDayDes; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data Work Day</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_workdaydes" id="i_workdaydes" value="" class="form-control" style="resize: none;" placeholder="Work Day Description" readonly>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditworkday" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Work Day History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisworkday">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Work Day</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_workday_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_workday_his as $wd){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="30%"><?php echo $wd->WorkDayDes; ?></td>
                                                                <td width="25%" align="center"><?php echo date('d-M-Y', strtotime($wd->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $wd->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="leavetypeModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Leave Type !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_leavetype" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Leave Type
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="leavetype" id="leavetype" class="form-control" required>
                                                        <?php if ($get_leavetype != false) { ?>
                                                            <option value="" selected>-- Choose Leave Type --</option>
                                                            <?php foreach ($get_leavetype as $ltpe) { ?>
                                                                <option value="<?php echo $ltpe->LeaveType; ?>" leavetype-des="<?php echo $ltpe->LeaveTypeDes; ?>"><?php echo $ltpe->LeaveTypeDes; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data Leave Type</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_leavetypedes" id="i_leavetypedes" value="" class="form-control" style="resize: none;" placeholder="Leave Type Description" readonly>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditleavetype" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Leave Type History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisleavetype">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Leave Type</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_leavetype_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_leavetype_his as $ltype){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $ltype->LeaveTypeDes; ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($ltype->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $ltype->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="bankaccount1Modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Bank Account !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_bankaccount1" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Bank Account
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="text" name="bankaccount1" id="bankaccount1" value="" class="form-control" placeholder="Enter text" required>
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditbankaccount1" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Bank Account History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisbankaccount1">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Bank Account</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_bankaccount1_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_bankaccount1_his as $ba1){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $ba1->BankAccount1; ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($ba1->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $ba1->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="bankaccount2Modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Bank Account !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_bankaccount2" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Bank Account
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="text" name="bankaccount2" id="bankaccount2" value="" class="form-control" placeholder="Enter text" required>
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditbankaccount2" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Bank Account History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisbankaccount2">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Bank Account</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_bankaccount2_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_bankaccount2_his as $ba2){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $ba2->BankAccount2; ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($ba2->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $ba2->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="uniformtshirtModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Uniform T-shirt !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_uniformtshirt" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Uniform T-shirt
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input type="text" name="uniformtshirt" id="uniformtshirt" value="" class="form-control" placeholder="Enter text" required>
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submitedituniformtshirt" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Uniform T-shirt History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisuniformtshirt">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Uniform T-shirt</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_uniformtshirt_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_uniformtshirt_his as $uft){ ?>
                                                            <tr>
                                                                <td width="10%"align="center"><?php echo $no; ?></td>
                                                                <td width="25%"><?php echo $uft->UniformTshirt; ?></td>
                                                                <td width="30%" align="center"><?php echo date('d-M-Y', strtotime($uft->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $uft->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="empcompanyModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>History !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_empcompany" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">                        
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Employee Company
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="empcompany" id="empcompany" class="form-control" required>
                                                        <?php if ($get_empcompany != false) { ?>
                                                            <option value="" selected>-- Choose Company --</option>
                                                            <?php foreach ($get_empcompany as $ecom) { ?>
                                                                <option value="<?php echo $ecom->ComCode; ?>" empcompany-des="<?php echo $ecom->ComDes; ?>"><?php echo $ecom->ComDes; ?></option>
                                                            <?php }?>
                                                        <?php } else { ?>
                                                            <option value=""><font color="red">No Data Company</font></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_empcompanydes" id="i_empcompanydes" value="" class="form-control" style="resize: none;" placeholder="Company Description" readonly>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submiteditempcompany" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form> 
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Company History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisempcompany">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Company</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_data_empcompany_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_data_empcompany_his as $chis){ ?>
                                                            <tr>
                                                                <td width="10%" align="center"><?php echo $no; ?></td>
                                                                <td width="35%"><?php echo $chis->CompanyDes ?></td>
                                                                <td width="20%" align="center"><?php echo date('d-M-Y', strtotime($chis->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $chis->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="branchModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>History !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Branch History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisbranch">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Branch</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_data_branch_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_data_branch_his as $bhis){ ?>
                                                            <tr>
                                                                <td width="10%" align="center"><?php echo $no; ?></td>
                                                                <td width="35%"><?php echo $bhis->BranchDes ?></td>
                                                                <td width="20%" align="center"><?php echo date('d-M-Y', strtotime($bhis->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $bhis->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>Update Department !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/update_dept_abc" enctype="multipart/form-data"> 
                                        <input type="hidden" id="hide" name="IDNumber" value="<?php echo $pers->IDNumber; ?>">
                                        <div class="form-body well">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Department
                                                <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select name="i_dept" id="i_dept" class="form-control" required>
                                                        <option value="" selected>-- Select Department--</option>
                                                            <?php if ($get_dept != ''){ ?>
                                                                <?php foreach ($get_dept as $dpt) { ?>
                                                                    <option value="<?php echo $dpt->DeptCode; ?>" department-des="<?php echo $dpt->DeptDes; ?>" bu-code="<?php echo $dpt->BUCode; ?>" bu-des="<?php echo $dpt->BUDes; ?>" div-code="<?php echo $dpt->DivCode; ?>" div-des="<?php echo $dpt->DivDes; ?>" branch-code="<?php echo $dpt->BranchCode; ?>" branch-des="<?php echo $dpt->BranchDes; ?>" com-code="<?php echo $dpt->ComCode; ?>" com-des="<?php echo $dpt->ComDes; ?>"><?php echo $dpt->DeptCode ?> | <?php echo $dpt->DeptDes ?></option>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <option value="">
                                                                    <font color="red">No Data Department</font>
                                                                </option>
                                                            <?php } ?>
                                                    </select>
                                                </div>
                                            </div>                        
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Description
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">                   
                                                    <input name="i_deptdesc" value="" class="form-control" style="resize: none;" placeholder="Department Description" readonly>

                                                    <input name="i_bucode" id="i_bucode" value="" class="form-control hidden" style="resize: none;" readonly>
                                                    <input name="i_budes" id="i_budes" value="" class="form-control hidden" style="resize: none;" readonly>

                                                    <input name="i_divcode" id="i_divcode" value="" class="form-control hidden" style="resize: none;" readonly>
                                                    <input name="i_divdes" id="i_divdes" value="" class="form-control hidden" style="resize: none;" readonly>

                                                    <input name="i_branchcode" id="i_branchcode" value="" class="form-control hidden" style="resize: none;" readonly>
                                                    <input name="i_branchdes" id="i_branchdes" value="" class="form-control hidden" style="resize: none;" readonly>

                                                    <input name="i_companycode" id="i_companycode" value="" class="form-control hidden" style="resize: none;" readonly>
                                                    <input name="i_companydes" id="i_companydes" value="" class="form-control hidden" style="resize: none;" readonly>
                                                </div>
                                            </div>  

                                             <div class="form-group">
                                                <label class="col-md-4 col-sm-4 control-label">Cost Center / Section</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <select id="costcenter" name="costcenter" class="form-control" required>
                                                        <option value="" selected>-- Choose Department First --</option>
                                                    </select>
                                                    <input id="i_costdes" name="i_costdes" type="text" class="form-control hidden" readonly="true">
                                                </div>
                                            </div>       
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">
                                                    Remarks
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea  name="reason" class="form-control" rows="3" placeholder="Enter Record Remarks"></textarea>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submit" value="Submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure to submit?')">Submit</button>
                                                </div>
                                            </div>
                                        </div> 
                                        </form>                              
                                        <hr style="margin-top: -40px;">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Department History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hisdepartment">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Department</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_data_dept_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_data_dept_his as $his){ ?>
                                                            <tr>
                                                                <td width="10%" align="center"><?php echo $no; ?></td>
                                                                <td width="35%"><?php echo $his->DeptDes ?></td>
                                                                <td width="20%" align="center"><?php echo date('d-M-Y', strtotime($his->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $his->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="costcenterModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="false">
                        <div class="modal-dialog" style="width: 45%">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h5 class="modal-title font-white"><i class="fa fa-exclamation-triangle"></i> <b>History !</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <h5 class="modal-title"><b><i class="fa fa-list"></i> My Cost Center History</b></h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 0px; margin-top:0px">
                                                <table class="table table-striped table-bordered" id="hiscostcenter">
                                                    <thead style="background-color: #eef1f5">
                                                        <tr>
                                                            <th><center>No</center></th>
                                                            <th><center>Cost Center / Section</center></th>
                                                            <th><center>Date</center></th>
                                                            <th><center>Reason</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if ($get_data_costcenter_his != ''){ ?>
                                                        <?php $no=1; foreach ($get_data_costcenter_his as $cchis){ ?>
                                                            <tr>
                                                                <td width="10%" align="center"><?php echo $no; ?></td>
                                                                <td width="35%"><?php echo $cchis->CostCenterDes ?></td>
                                                                <td width="20%" align="center"><?php echo date('d-M-Y', strtotime($cchis->RegDate)); ?></td>
                                                                <td width="35%"><?php echo $cchis->Reason ?></td>
                                                            </tr>
                                                        <?php $no++;} ?>
                                                    <?php }else{ ?>
                                                        <tr><td colspan="4"><center><font color="red">No Data!</font></center></td></tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: -30px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="form-horizontal"  method="post"action="<?php echo base_url(); ?>index.php/Humanresource/edit_ktp_byid_abc" enctype="multipart/form-data">
                    <input type="text" name="IDNumber" value="<?php echo $pers->IDNumber; ?>" class="hidden">
                        <div id="ktpModal" data-backdrop="static"  data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-blue">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h5 class="modal-title font-white"><i class="fa fa-pencil"></i> <b>Edit File Identity (KTP)</b></h5>
                                    </div>
                                    <div class="modal-body" style="margin-bottom: 4%">
                                        <div class="form-body">
                                            <center>
                                                <div class="form-group form-md-line-input has-success" style="margin-bottom: 15px; padding-top: 0px;">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" >
                                                            <?php if ($pers->Identity != ''){ ?> 
                                                                <img src="<?php echo base_url(); ?>upload/profile/<?php echo $pers->Identity; ?>" alt="" style="width:auto; height: 200px"/>
                                                            <?php }else{ ?>
                                                                <img src="<?php echo base_url(); ?>upload/profile/kosong.png" alt="" style="width:auto; height: 200px"/>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="width:auto; height: 200px"> </div>
                                                        <div>
                                                            <span class="btn blue btn-file">
                                                                <span class="fileinput-new">Image Profile </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="identity" required> </span>
                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div><br>
                                                        <label class="col-md-3 col-sm-3 control-label">Identity No</label>
                                                        <div class="col-md-3 col-sm-3" style="margin-left: -10px">
                                                            <input type="number" name="identityno" value="<?php echo $pers->IdentityNo ?>" class="form-control"><br>
                                                        </div> 
                                                        <label class="col-md-3 col-sm-3 control-label">Identity Expire</label>
                                                        <div class="col-md-3 col-sm-3" style="margin-left: -10px">
                                                            <input type="date" name="identityexpire" value="<?php echo $pers->IdentityExpire ?>" class="form-control"> 
                                                        </div>
                                                    </div>
                                                </div><hr>
                                                <div class="portlet-title" style="background-color: #2D5F8B">
                                                    <div class="caption pull-right">
                                                      <button type="submit" name="submitktpfile" value="Submit" class="btn btn-transparent green btn-block btn-sm">
                                                      Submit</button></div>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div> 
                    </form>
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

    $('#nationality').select2();
    $('#ethnic').select2();
    $('#country').select2();
    $('#province').select2();
    $('#region').select2();
    $('#district').select2();
    $('#subdistrict').select2();
    $('#city').select2();

    // $('#onsitecountry').select2();
    // $('#onsiteprovince').select2();
    // $('#onsiteregion').select2();
    // $('#onsitedistrict').select2();
    // $('#onsitesubdistrict').select2();
    // $('#onsitecity').select2();

    // $('#employeeclass').select2();
    // $('#employeetype').select2();
    // $('#employmenttype').select2();
  
    // $('#jobtitle').select2();
    // $('#joblevel').select2();
    // $('#jobgrade').select2();

    // $('#positiontitle').select2();
    // $('#individuallevel').select2();
    // $('#individualgrade').select2();
    // $('#workfunction').select2();
    // $('#crew').select2();
    // $('#workday').select2();
    // $('#onsitemarital').select2();
    // $('#maritalbenefit').select2();
    // $('#supervisor').select2();
    // $('#leavetype').select2();

    $('.pulse').pulsate({
        // color: '#36c6d3',
        color: '#333',
        repeat: true
    })

    var dt_hismarital = $('#hismarital').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    var dt_hisempcompany = $('#hisempcompany').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    var dt_hisbranch = $('#hisbranch').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    var dt_hisdepartment = $('#hisdepartment').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    var dt_hiscostcenter = $('#hiscostcenter').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    var dt_hisemployeetype = $('#hisemployeetype').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    var dt_hisjobtitle = $('#hisjobtitle').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    var dt_hisworkfunction = $('#hisworkfunction').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    var dt_hisworkgroup = $('#hisworkgroup').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    var dt_hishiredate = $('#hishiredate').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    var dt_hispointofhire = $('#hispointofhire').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    var dt_hissupervisor = $('#hissupervisor').DataTable({
        autoWidth: false,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "All"]]
    })

    $(document).ready(function(){
        $('.dropify').dropify();
    }); 

    $(document).on('click','.update_marital', function() {
        $('#maritalModal').modal('show');
    }); 

    $(document).on('click','.update_employeetype', function() {
        $('#employeetypeModal').modal('show');
    });

    $(document).on('click','.update_employmenttype', function() {
        $('#employmenttypeModal').modal('show');
    }); 

    $(document).on('click','.update_jobtitle', function() {
        $('#jobtitleModal').modal('show');
    });

    $(document).on('click','.update_positiontitle', function() {
        $('#positiontitleModal').modal('show');
    }); 

    // $(document).on('click','.update_individualgrade', function() {
    //     $('#individualgradeModal').modal('show');
    // });

    $(document).on('click','.update_individuallevel', function() {
        $('#individuallevelModal').modal('show');
    });

    $(document).on('click','.update_workfunction', function() {
        $('#workfunctionModal').modal('show');
    }); 

    $(document).on('click','.update_workgroup', function() {
        $('#workgroupModal').modal('show');
    }); 

    $(document).on('click','.update_onsitemarital', function() {
        $('#onsitemaritalModal').modal('show');
    });

    $(document).on('click','.update_maritalbenefit', function() {
        $('#maritalbenefitModal').modal('show');
    });

    $(document).on('click','.update_probationdate', function() {
        $('#probationdateModal').modal('show');
    }); 

    $(document).on('click','.update_hiredate', function() {
        $('#hiredateModal').modal('show');
    }); 

    $(document).on('click','.update_servicedate', function() {
        $('#servicedateModal').modal('show');
    });

    $(document).on('click','.update_pointofhire', function() {
        $('#pointofhireModal').modal('show');
    });  

    $(document).on('click','.update_pointofleave', function() {
        $('#pointofleaveModal').modal('show');
    });

    $(document).on('click','.update_pointoftravel', function() {
        $('#pointoftravelModal').modal('show');
    });

    $(document).on('click','.update_worklocation', function() {
        $('#worklocationModal').modal('show');
    }); 

    $(document).on('click','.update_supervisor', function() {
        $('#supervisorModal').modal('show');
    }); 

    $(document).on('click','.update_workinsurance', function() {
        $('#workinsuranceModal').modal('show');
    });  

    $(document).on('click','.update_medicalinsurance', function() {
        $('#medicalinsuranceModal').modal('show');
    });

    $(document).on('click','.update_workday', function() {
        $('#workdayModal').modal('show');
    });

    $(document).on('click','.update_leavetype', function() {
        $('#leavetypeModal').modal('show');
    }); 

    $(document).on('click','.update_bankaccount1', function() {
        $('#bankaccount1Modal').modal('show');
    });

    $(document).on('click','.update_bankaccount2', function() {
        $('#bankaccount2Modal').modal('show');
    }); 

    $(document).on('click','.update_uniformtshirt', function() {
        $('#uniformtshirtModal').modal('show');
    });  

    $(document).on('click','.view_empcompany_his', function() {
        $('#empcompanyModal').modal('show');
    });

    $(document).on('click','.view_branch_his', function() {
        $('#branchModal').modal('show');
    });   

    $(document).on('click','.update_dept', function() {
        $('#myModal').modal('show');
    });

    $(document).on('click','.view_costcenter_his', function() {
        $('#costcenterModal').modal('show');
    });

    $(document).on('change', '#empcompany', function(){
        var empcompanydes = $(this).children("option:selected").attr('empcompany-des');        
        $('#i_empcompanydes').val(empcompanydes);
    });

    $(document).on('change', '#i_dept', function() {
        let data = $(this, 'option:selected').val()
        if ($(this).val() == "") {
            $('input[name="costcenter"]').val('');
            $('input[name="i_costdes"]').val('');
            $('input[name="i_deptdesc"]').val('');
            $('input[name="i_bucode"]').val('');
            $('input[name="i_budes"]').val('');
            $('input[name="i_divcode"]').val('');
            $('input[name="i_divdes"]').val('');
            $('input[name="i_branchcode"]').val('');
            $('input[name="i_branchdes"]').val('');
            $('input[name="i_companycode"]').val('');
            $('input[name="i_companydes"]').val('');
        } else {
            var deptdes = $('#i_dept option:selected').attr('department-des');
            $('input[name="i_deptdesc"]').val(deptdes);

            var bucodes = $('#i_dept option:selected').attr('bu-code');    
            $('#i_bucode').val(bucodes);

            var budess = $('#i_dept option:selected').attr('bu-des');            
            $('#i_budes').val(budess);

            var divcodes = $('#i_dept option:selected').attr('div-code');            
            $('#i_divcode').val(divcodes);

            var divdess = $('#i_dept option:selected').attr('div-des');            
            $('#i_divdes').val(divdess);

            var branchcodes = $('#i_dept option:selected').attr('branch-code');            
            $('#i_branchcode').val(branchcodes);

            var branchdes = $('#i_dept option:selected').attr('branch-des');            
            $('#i_branchdes').val(branchdes);

            var companycodes = $('#i_dept option:selected').attr('com-code');            
            $('#i_companycode').val(companycodes);

            var companydes = $('#i_dept option:selected').attr('com-des');            
            $('#i_companydes').val(companydes);
        }
        getCostCenter(data)
    });

    function getCostCenter(data){
        // var url = window.location.origin
        $.ajax({    
            url: '<?= base_url('index.php/Humanresource/get_cost_center_edit')?>',
            method: 'POST',
            data: { 
                i_dept: data,
            },
            success: resp => {
               
                $('#costcenter').empty()
                $('#costcenter').html(resp)
                var costcenterdes = $('#costcenter').children("option:selected").attr('costcenter-des');            
                $('#i_costdes').val(costcenterdes);        
            }
        })
    }

    $(document).on('change', '#costcenter', function(){
        var ccdes = $(this).children("option:selected").attr('costcenter-des');        
        $('#i_costdes').val(ccdes);
    });

    $(document).on('click','.new_data_dep', function() {
        $('#depModal').modal('show');
    });

    $(document).on('click','.new_data_kin', function() {
        $('#kinModal').modal('show');
    });

    $(document).on('click','.modal_edit_pic', function(e) {
        // e.preventDefault()
        // alert()

        let img_src = $(this).find('img').attr('src')
        let img_id = $(this).find('img').attr('data-id')

        $('#depphotoModal').find('img').attr('src', img_src)
        $('#depphotoModal').find('input[name="idep"]').val(img_id)

        $('#depphotoModal').modal('show');
    });

    $(document).on('click','.modal_edit_pic_profile', function(e) {
        // e.preventDefault()
        // alert()

        let img_srcp = $(this).find('img').attr('src')
        let img_idp = $(this).find('img').attr('data-idnum')

        $('#persphotoModal').find('img').attr('src', img_srcp)
        $('#persphotoModal').find('input[name="idnum"]').val(img_idp)

        $('#persphotoModal').modal('show');
    });

    $(document).on('click','.modal_edit_ktp', function(e) {
        // e.preventDefault()
        // alert() 
        $('#ktpModal').modal('show');
    });

    $(document).on('change', '#maritalstatus', function(){
        var maritastatusdes = $(this).children("option:selected").attr('marital-des');        
        $('#i_maritalstatusdes').val(maritastatusdes);
    });

    $(document).on('change', '#employeeclass', function(){
        var empclassdes = $(this).children("option:selected").attr('empclass-des');        
        $('#i_employeeclassdes').val(empclassdes);
    });

    $(document).on('change', '#employeetype', function(){
        var emptypedes = $(this).children("option:selected").attr('emptype-des');        
        $('#i_employeetypedes').val(emptypedes);
    });

    $(document).on('change', '#employmenttype', function(){
        var employmenttypedes = $(this).children("option:selected").attr('employmenttype-des');        
        $('#i_employmenttypedes').val(employmenttypedes);
    });

    $(document).on('change', '#jobtitle', function(){
        var jtdes = $(this).children("option:selected").attr('jobtitle-des');        
        $('#i_jobtitle').val(jtdes);
    });  

    $(document).on('change', '#positiontitle', function(){
        var ptdes = $(this).children("option:selected").attr('positiontitle-des');        
        $('#i_positiontitle').val(ptdes);
    });  

    $(document).on('change', '#individualgrade', function(){
        var individualgradedes = $(this).children("option:selected").attr('individualgrade-des');        
        $('#i_individualgradedes').val(individualgradedes);
    }); 

    $(document).on('change', '#i_levelcode', function() {
        if ($(this).val() == "") {
            $('input[name="i_leveldes"]').val('');
            $('input[name="i_level"]').val('');
            $('input[name="i_mgttype"]').val('');
            $('input[name="i_mgtgroup"]').val('');
        } else {
            var individualleveldes = $(this).children("option:selected").attr('e-level-des');        
            $('#i_leveldes').val(individualleveldes);

            var lvl = $('#i_levelcode option:selected').attr('e-level');            
            $('#i_level').val(lvl);

            var mgttypecode = $('#i_levelcode option:selected').attr('e-mgt-type');            
            $('#i_mgttype').val(mgttypecode);

            var mgtgroupcode = $('#i_levelcode option:selected').attr('e-mgt-group');            
            $('#i_mgtgroup').val(mgtgroupcode);
        }
    });

    $(document).on('change', '#jobpoint', function(){
        var pointdes = $(this).children("option:selected").attr('point-des');        
        $('#i_jobpointdes').val(pointdes);

        var ratepoint= $(this).children("option:selected").attr('rate-point');        
        $('#i_jobratepoint').val(ratepoint);

        var amountpoint = $(this).children("option:selected").attr('amount-point');        
        $('#i_jobamountpoint').val(amountpoint);

    });

    $(document).on('change', '#joblevel', function(){
        var levcode = $(this).children("option:selected").attr('level-code');        
        $('#i_joblevelcode').val(levcode);

        var leveldes = $(this).children("option:selected").attr('level-des');        
        $('#i_jobleveldes').val(leveldes);

        var leveltype = $(this).children("option:selected").attr('level-type');        
        $('#i_joblevelmgttype').val(leveltype);

        var levelgroup = $(this).children("option:selected").attr('level-group');        
        $('#i_joblevelmgtgroup').val(levelgroup);
    });

    $(document).on('change', '#jobgrade', function(){
        var jobgradedes = $(this).children("option:selected").attr('jobgrade-des');        
        $('#i_jobgradedes').val(jobgradedes);
    });

    $(document).on('change', '#workfunction', function(){
        var wfdes = $(this).children("option:selected").attr('workfunction-des');        
        $('#i_workfunctiondes').val(wfdes);

        var wgroup = $(this).children("option:selected").attr('wgroup-code');        
        $('#i_wgroup').val(wgroup);

        var wgroupdes = $(this).children("option:selected").attr('wgroup-des');        
        $('#i_wgroupdes').val(wgroupdes);
    });

    $(document).on('change', '#crew', function(){
        var wgdes = $(this).children("option:selected").attr('workgroup_des');        
        $('#i_workgroup').val(wgdes);
    });

    $(document).on('change', '#onsitemarital', function(){
        var onsitemaritaldes = $(this).children("option:selected").attr('onsitemarital-des');        
        $('#i_onsitemaritaldes').val(onsitemaritaldes);
    });

    $(document).on('change', '#maritalbenefit', function(){
        var maritalbenefitdes = $(this).children("option:selected").attr('maritalbenefit-des');        
        $('#i_maritalbenefitdes').val(maritalbenefitdes);
    });

    $(document).on('change', '#supervisor', function(){        
        if ($(this).val() == "") {
            $('textarea[name="i_sup_des"]').val('');
        } else {
            var supervisordes = $('#supervisor option:selected').attr('sup-des');                      
            var supervistitlecode = $('#supervisor option:selected').attr('suptitle-code');                      
            var supervistitledes = $('#supervisor option:selected').attr('suptitle-des');                      
            $('textarea[name="i_sup_des"]').val(supervisordes);
            $('input[name="i_sup_title_code"]').val(supervistitlecode);
            $('input[name="i_sup_title_des"]').val(supervistitledes);
        }
    });

    $(document).on('change', '#workday', function(){
        var workkdaydes = $(this).children("option:selected").attr('workday-des');        
        $('#i_workdaydes').val(workkdaydes);
    });

    $(document).on('change', '#leavetype', function(){
        var leavetypedes = $(this).children("option:selected").attr('leavetype-des');        
        $('#i_leavetypedes').val(leavetypedes);
    });

    $(document).on('change', '#country', function(){
        var cvalue = $(this).val();
        if (cvalue != ""){     
            load_list_province_by_country(cvalue);
            var countrydes = $('#country').children("option:selected").attr('country-des');
            $('#i_countrydes').val(countrydes);
        } else {
            alert("Choose Country First");
        }
    });

    function load_list_province_by_country(countrycode){
        var html = '';
        var code = '';
        var id = '';

        //AJAX = ASYNCHROUNUS JAVASCRIPT AND XML / JSON
        $.ajax({
            url     : "<?php echo site_url('Humanresource/get_list_province_by_country'); ?>",
            data    : {country_code : countrycode},
            type    : "POST",
            async   : false,
            dataType : "json",
            success : function(data){
                if (data.rstatus == "success") {
                    var province = data.data;
                    for (let index = 0; index < province.length; index++) {
                        html += '<option value="'+province[index].ProvinceCode+'" province-id="'+province[index].ProvinceID+'" province-des="'+province[index].ProvinceDes+'">'+province[index].ProvinceDes+'</option>';                                                      
                    }
                    $('#province').html(html);
                } else {
                    $('#province').html('<option value="-"> No Data Province </option>');
                    $('#i_provincedes').val("");
                }
            }, error : function(){
                alert("Error to load Province !");
            }
        });

        code = $('#province option:selected').val()                        
        // id = $('#province option:selected').attr('province-id')

        if(code !== ''){
            load_list_region_by_province(code)
            var provincedes = $('#province').children("option:selected").attr('province-des');
            $('#i_provincedes').val(provincedes);
        }else{
            $('#region').html('<option> No Data </option>')
        }

        // if(id !== ''){
        //     load_list_city_by_province(id)
        // }else{
        //     $('#city').html('<option> No Data </option>')
        // }
    }

    function load_list_region_by_province(provincecode){
        var html = '';
        var codereg ='';
        $.ajax({
            url     : "<?php echo site_url('Humanresource/get_list_region_by_province'); ?>",
            data    : {province_code : provincecode},
            type    : "POST",
            dataType : "json",
            async   : false,
            success : function(data){
                if (data.rstatus == "success") {
                    var region = data.data;
                    for (let index = 0; index < region.length; index++) {
                        html += '<option value="'+region[index].RegionCode+'" region-des="'+region[index].RegionDes+'">'+region[index].RegionDes+'</option>';                                                      
                    }
                    $('#region').html(html);
                    
                } else {
                    $('#region').html('<option value="-"> No Data Region </option>');
                    $('#i_regiondes').val("");
                }
            }, error : function(){
                alert("Error to load Region !");
            }
        });


        codereg = $('#region option:selected').val()      
        if(codereg !== ''){
            load_list_district_by_region(codereg)
            var regionedes = $('#region').children("option:selected").attr('region-des');
            $('#i_regiondes').val(regionedes);
        }else{
            $('#region').html('<option> No Data </option>')
        }    

        if(codereg !== ''){
            load_list_city_by_region(codereg)
        }else{
            $('#city').html('<option> No Data </option>')
        }      
    }

    function load_list_city_by_province(provincecode){
        var html = '';
        $.ajax({
            url     : "<?php echo site_url('Humanresource/get_list_city_by_province'); ?>",
            data    : {province_code : provincecode},
            type    : "POST",
            dataType : "json",
            success : function(data){
                if (data.rstatus == "success") {
                    var city = data.data;
                    for (let index = 0; index < city.length; index++) {
                        html += '<option value="'+city[index].K_BSNI+'" city-des="'+city[index].CapitalCity+'">'+city[index].CapitalCity+'</option>';                                                      
                    }

                    $('#city').html(html);
                    $('#i_citydes').val($('#city option:selected').attr('city-des'));
                } else {
                    $('#city').html('<option value="-"> No Data City </option>');
                    $('#i_citydes').val("");
                }
            }, error : function(){
                alert("Error to load City !");
            }
        });
    }

    function load_list_city_by_region(regioncode){
        var html = '';
        $.ajax({
            url     : "<?php echo site_url('Humanresource/get_list_city_by_region'); ?>",
            data    : {region_code : regioncode},
            type    : "POST",
            dataType : "json",
            success : function(data){
                if (data.rstatus == "success") {
                    var city = data.data;
                    for (let index = 0; index < city.length; index++) {
                        html += '<option value="'+city[index].RegionCityCode+'" city-des="'+city[index].RegionCity+'">'+city[index].RegionCity+'</option>';                                                      
                    }

                    $('#city').html(html);
                    $('#i_citydes').val($('#city option:selected').attr('city-des'));
                } else {
                    $('#city').html('<option value="-"> No Data City </option>');
                    $('#i_citydes').val("");
                }
            }, error : function(){
                alert("Error to load City !");
            }
        });
    }

    function load_list_district_by_region(regioncode){
        var html = '';
        var codedistrict = '';
        $.ajax({
            url     : "<?php echo site_url('Humanresource/get_list_district_by_region'); ?>",
            data    : {region_code : regioncode},
            type    : "POST",
            dataType : "json",
            async   : false,
            success : function(data){
                if (data.rstatus == "success") {
                    var district = data.data;
                    for (let index = 0; index < district.length; index++) {
                        html += '<option value="'+district[index].DistrictCode+'" district-des="'+district[index].DistrictDes+'">'+district[index].DistrictDes+'</option>';                                                      
                    }
                    $('#district').html(html);      
                    
                } else {
                    $('#district').html('<option value="-"> No Data District </option>');
                    $('#i_districtdes').val("");
                }
            }, error : function(){
                alert("Error to load District !");
            }
        });

        
        codedistrict = $('#district option:selected').val()
        if(codedistrict !== ''){
            load_list_subdistrict_by_district(codedistrict)
            var districtdes = $('#district').children("option:selected").attr('district-des');
            $('#i_districtdes').val(districtdes);
        }else{
            $('#district').html('<option> No Data </option>')
        }      
    }

    function load_list_subdistrict_by_district(districtcode){
        var html = '';
        var codesubdistrict = '';
        $.ajax({
            url     : "<?php echo site_url('Humanresource/get_list_subdistrict_by_district'); ?>",
            data    : {district_code : districtcode},
            type    : "POST",
            dataType : "json",
            async   : false,
            success : function(data){
                if (data.rstatus == "success") {
                    var subdistrict = data.data;
                    for (let index = 0; index < subdistrict.length; index++) {
                        html += '<option value="'+subdistrict[index].SubDistrictCode+'" subdistrict-des="'+subdistrict[index].SubDistrictDes+'" kode-pos="'+subdistrict[index].PostalCode+'">'+subdistrict[index].SubDistrictDes+'</option>';                                                      
                    }
                    $('#subdistrict').html(html);
                    var okodepos = $('#subdistrict').children("option:selected").attr('kode-pos');            
                    $('#postcode').val(okodepos);   
                    
                } else {
                    $('#subdistrict').html('<option value="-"> No Data SubDistrict </option>');
                    $('#i_subdistrictdes').val("");
                }
            }, error : function(){
                alert("Error to load SubDistrict !");
            }
        });

        codesubdistrict = $('#subdistrict option:selected').val()      
        if(codesubdistrict !== ''){
            var subdistrictdes = $('#subdistrict').children("option:selected").attr('subdistrict-des');
            $('#i_subdistrictdes').val(subdistrictdes);
            var okodepos = $('#subdistrict').children("option:selected").attr('kode-pos');            
            $('#postcode').val(okodepos);   
        }else{
            $('#postcode').val(""); 
        }   
    }

    $(document).on('change', '#province', function(){
        var pvalue = $(this).val();
        if (pvalue != "") {
            let code = $('#province option:selected').val()                        
            // let id = $('#province option:selected').attr('province-id')

            load_list_region_by_province(code) 
            // load_list_city_by_province(id)

            var provincedes = $('#province').children("option:selected").attr('province-des');
            $('#i_provincedes').val(provincedes);

        } else {
            alert("Empty Province");            
        }
    });

    $(document).on('change', '#region', function(){
        var rvalue = $(this).val();
        if (rvalue != "") {
            let regioncode = $('#region option:selected').val()

            load_list_district_by_region(regioncode) 
            load_list_city_by_region(regioncode)

            var regiondes = $('#region').children("option:selected").attr('region-des');
            $('#i_regiondes').val(regiondes);
        } else {
            alert("Empty Region");            
        }
    });

    $(document).on('change', '#district', function(){
        var dvalue = $(this).val();
        if (dvalue != "") {
            let districtcode = $('#district option:selected').val()

            load_list_subdistrict_by_district(districtcode) 
            
            var districtdes = $('#district').children("option:selected").attr('district-des');
            $('#i_districtdes').val(districtdes);
        } else {
            alert("Empty District");            
        }
    });

    $(document).on('change', '#subdistrict', function(){
        var subdvalue = $(this).val();
        if (subdvalue != ""){     
            var subdistrictdes = $('#subdistrict').children("option:selected").attr('subdistrict-des');
            $('#i_subdistrictdes').val(subdistrictdes);
            var kodepos = $('#subdistrict').children("option:selected").attr('kode-pos');            
            $('#postcode').val(kodepos);
        } else {
            alert("Empty SubDistrict");  
            
        }         
    });

    $(document).on('change', '#city', function(){
        var cityvalue = $(this).val();
        if (cityvalue != ""){     
            var citydes = $('#city').children("option:selected").attr('city-des');
            $('#i_citydes').val(citydes);
        } else {
            alert("Empty City");   
        }
    });

    $(document).on('change', '#onsitecountry', function(){
        var ocvalue = $(this).val();
        if (ocvalue != ""){     
            load_list_onsiteprovince_by_onsitecountry(ocvalue);
            var ocountrydes = $('#onsitecountry').children("option:selected").attr('ocountry-des');
            $('#i_ocountrydes').val(ocountrydes);
        } else {
            alert("Choose Country First");
        }
    });

    $(document).on('change', '#onsiteprovince', function(){
        var opvalue = $(this).val();
        if (opvalue != "") {
            let code = $('#onsiteprovince option:selected').val()                        
            // let id = $('#onsiteprovince option:selected').attr('oprovince-id')

            load_list_onsiteregion_by_onsiteprovince(code) 
            // load_list_onsitecity_by_onsiteprovince(id)

            var oprovincedes = $('#onsiteprovince').children("option:selected").attr('oprovince-des');
            $('#i_oprovincedes').val(oprovincedes);

        } else {
            alert("Empty Province");            
        }
    });

    $(document).on('change', '#onsiteregion', function(){
        var orvalue = $(this).val();
        if (orvalue != "") {
            let oregioncode = $('#onsiteregion option:selected').val()

            load_list_onsitedistrict_by_onsiteregion(oregioncode) 
            load_list_onsitecity_by_onsiteregion(oregioncode)

            var oregiondes = $('#onsiteregion').children("option:selected").attr('oregion-des');
            $('#i_oregiondes').val(oregiondes);
        } else {
            alert("Empty Region");            
        }
    });

    $(document).on('change', '#onsitedistrict', function(){
        var odvalue = $(this).val();
        if (odvalue != "") {
            let odistrictcode = $('#onsitedistrict option:selected').val()

            load_list_onsitesubdistrict_by_onsitedistrict(odistrictcode) 
            
            var odistrictdes = $('#onsitedistrict').children("option:selected").attr('odistrict-des');
            $('#i_odistrictdes').val(odistrictdes);
        } else {
            alert("Empty District");            
        }
    });

    $(document).on('change', '#onsitesubdistrict', function(){
        var osubdvalue = $(this).val();
        if (osubdvalue != ""){     
            var osubdistrictdes = $('#onsitesubdistrict').children("option:selected").attr('osubdistrict-des');
            $('#i_osubdistrictdes').val(osubdistrictdes);
            var okodepos = $('#onsitesubdistrict').children("option:selected").attr('okode-pos');            
            $('#onsitepostcode').val(okodepos);
        } else {
            alert("Empty SubDistrict");  
            
        }         
    });

    $(document).on('change', '#onsitecity', function(){
        var ocityvalue = $(this).val();
        if (ocityvalue != ""){     
            var ocitydes = $('#onsitecity').children("option:selected").attr('ocity-des');
            $('#i_ocitydes').val(ocitydes);
        } else {
            alert("Empty City");   
        }
    });

    load_list_countrydep();

    $(document).on('change', '#countrydep', function(){
        var depcvalue = $(this).val();
        if (depcvalue != ""){     
            load_list_provincedep_by_countrydep(depcvalue);
            var countrydepdes = $('#countrydep').children("option:selected").attr('countrydep-des');
            $('#i_countrydepdes').val(countrydepdes);
        } else {
            alert("Choose Country First");
        }
    });

    $(document).on('change', '#provincedep', function(){
        var deppvalue = $(this).val();
        if (deppvalue != "") {
            let code = $('#provincedep option:selected').val()                        
            // let id = $('#province option:selected').attr('province-id')

            load_list_regiondep_by_provincedep(code) 
            // load_list_city_by_province(id)

            var provincedepdes = $('#provincedep').children("option:selected").attr('provincedep-des');
            $('#i_provincedepdes').val(provincedepdes);

        } else {
            alert("Empty Province");            
        }
    });

    $(document).on('change', '#regiondep', function(){
        var deprvalue = $(this).val();
        if (deprvalue != "") {
            let regiondepcode = $('#regiondep option:selected').val()

            load_list_districtdep_by_regiondep(regiondepcode) 
            load_list_citydep_by_regiondep(regiondepcode)

            var regiondepdes = $('#regiondep').children("option:selected").attr('regiondep-des');
            $('#i_regiondepdes').val(oregiondes);
        } else {
            alert("Empty Region");            
        }
    });

    $(document).on('change', '#districtdep', function(){
        var depdvalue = $(this).val();
        if (depdvalue != "") {
            let districtdepcode = $('#districtdep option:selected').val()

            load_list_subdistrictdep_by_districtdep(districtdepcode) 
            
            var districtdepdes = $('#districtdep').children("option:selected").attr('districtdep-des');
            $('#i_districtdepdes').val(districtdepdes);
        } else {
            alert("Empty District");            
        }
    });

    $(document).on('change', '#subdistrictdep', function(){
        var subddepvalue = $(this).val();
        if (subddepvalue != ""){     
            var subdistrictdepdes = $('#subdistrictdep').children("option:selected").attr('subdistrictdep-des');
            $('#i_subdistrictdepdes').val(subdistrictdepdes);
            var kodedeppos = $('#subdistrictdep').children("option:selected").attr('kodedep-pos');            
            $('#postcodedep').val(kodedeppos);
        } else {
            alert("Empty SubDistrict");  
            
        }         
    });

    load_list_countrykin();

    $(document).on('change', '#countrykin', function(){
        var kincvalue = $(this).val();
        if (kincvalue != ""){     
            load_list_provincekin_by_countrykin(kincvalue);
            var countrykindes = $('#countrykin').children("option:selected").attr('countrykin-des');
            $('#i_countrykindes').val(countrykindes);
        } else {
            alert("Choose Country First");
        }
    });

    $(document).on('change', '#provincekin', function(){
        var kinpvalue = $(this).val();
        if (kinpvalue != "") {
            let code = $('#provincekin option:selected').val()                        
            // let id = $('#province option:selected').attr('province-id')

            load_list_regionkin_by_provincekin(code) 
            // load_list_city_by_province(id)

            var provincekindes = $('#provincekin').children("option:selected").attr('provincekin-des');
            $('#i_provincekindes').val(provincekindes);

        } else {
            alert("Empty Province");            
        }
    });

    $(document).on('change', '#regionkin', function(){
        var kinrvalue = $(this).val();
        if (kinrvalue != "") {
            let regionkincode = $('#regionkin option:selected').val()

            load_list_districtkin_by_regionkin(regionkincode) 
            load_list_citykin_by_regionkin(regionkincode)

            var regionkindes = $('#regionkin').children("option:selected").attr('regionkin-des');
            $('#i_regionkindes').val(oregiondes);
        } else {
            alert("Empty Region");            
        }
    });

    $(document).on('change', '#districtkin', function(){
        var kindvalue = $(this).val();
        if (kindvalue != "") {
            let districtkincode = $('#districtkin option:selected').val()

            load_list_subdistrictkin_by_districtkin(districtkincode) 
            
            var districtkindes = $('#districtkin').children("option:selected").attr('districtkin-des');
            $('#i_districtkindes').val(districtkindes);
        } else {
            alert("Empty District");            
        }
    });

    $(document).on('change', '#subdistrictkin', function(){
        var subdkinvalue = $(this).val();
        if (subdkinvalue != ""){     
            var subdistrictkindes = $('#subdistrictkin').children("option:selected").attr('subdistrictkin-des');
            $('#i_subdistrictkindes').val(subdistrictkindes);
            var kodekinpos = $('#subdistrictkin').children("option:selected").attr('kodekin-pos');            
            $('#postcodekin').val(kodekinpos);
        } else {
            alert("Empty SubDistrict");  
            
        }         
    });

    $(document).on('change', '#citykin', function(){
        var citykinvalue = $(this).val();
        if (citykinvalue != ""){     
            var citykindes = $('#citykin').children("option:selected").attr('citykin-des');
            $('#i_citykindes').val(citykindes);
        } else {
            alert("Empty City");   
        }
    });

    load_list_nationalitydep();
}

function load_list_onsiteprovince_by_onsitecountry(ocountrycode){
    var html = '';
    var code = '';
    var id = '';

    //AJAX = ASYNCHROUNUS JAVASCRIPT AND XML / JSON
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_onsiteprovince_by_onsitecountry'); ?>",
        data    : {ocountry_code : ocountrycode},
        type    : "POST",
        async   : false,
        dataType : "json",
        success : function(data){
            console.table(data)
            if (data.rstatus == "success") {
                var onsiteprovince = data.data;
                for (let index = 0; index < onsiteprovince.length; index++) {
                    html += '<option value="'+onsiteprovince[index].ProvinceCode+'" oprovince-id="'+onsiteprovince[index].ProvinceID+'" oprovince-des="'+onsiteprovince[index].ProvinceDes+'">'+onsiteprovince[index].ProvinceDes+'</option>';                                                      
                }
                $('#onsiteprovince').html(html);
            } else {
                $('#onsiteprovince').html('<option value="-"> No Data Province </option>');
                $('#i_oprovincedes').val("");
            }
        }, error : function(){
            alert("Error to load Province !");
        }
    });

    code = $('#onsiteprovince option:selected').val()                        
    // id = $('#onsiteprovince option:selected').attr('oprovince-id')

    if(code !== ''){
        load_list_onsiteregion_by_onsiteprovince(code)
        var oprovincedes = $('#onsiteprovince').children("option:selected").attr('oprovince-des');
        $('#i_oprovincedes').val(oprovincedes);
    }else{
        $('#onsiteregion').html('<option> No Data </option>')
    }

    // if(id !== ''){
    //     load_list_onsitecity_by_onsiteprovince(id)
    // }else{
    //     $('#onsitecity').html('<option> No Data </option>')
    // }
}

function load_list_onsiteregion_by_onsiteprovince(oprovincecode){
    var html = '';
    var codereg ='';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_onsiteregion_by_onsiteprovince'); ?>",
        data    : {oprovince_code : oprovincecode},
        type    : "POST",
        dataType : "json",
        async   : false,
        success : function(data){
            if (data.rstatus == "success") {
                var onsiteregion = data.data;
                for (let index = 0; index < onsiteregion.length; index++) {
                    html += '<option value="'+onsiteregion[index].RegionCode+'" oregion-des="'+onsiteregion[index].RegionDes+'">'+onsiteregion[index].RegionDes+'</option>';                                                      
                }
                $('#onsiteregion').html(html);
                
            } else {
                $('#onsiteregion').html('<option value="-"> No Data Region </option>');
                $('#i_oregiondes').val("");
            }
        }, error : function(){
            alert("Error to load Region !");
        }
    });


    codereg = $('#onsiteregion option:selected').val()      
    if(codereg !== ''){
        load_list_onsitedistrict_by_onsiteregion(codereg)
        var oregionedes = $('#onsiteregion').children("option:selected").attr('oregion-des');
        $('#i_oregiondes').val(oregionedes);
    }else{
        $('#onsiteregion').html('<option> No Data </option>')
    }      

    if(codereg !== ''){
        load_list_onsitecity_by_onsiteregion(codereg)
    }else{
        $('#city').html('<option> No Data </option>')
    }    
}

function load_list_onsitecity_by_onsiteprovince(oprovincecode){
    var html = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_onsitecity_by_onsiteprovince'); ?>",
        data    : {oprovince_code : oprovincecode},
        type    : "POST",
        dataType : "json",
        success : function(data){
            if (data.rstatus == "success") {
                var onsitecity = data.data;
                for (let index = 0; index < onsitecity.length; index++) {
                    html += '<option value="'+onsitecity[index].K_BSNI+'" ocity-des="'+onsitecity[index].CapitalCity+'">'+onsitecity[index].CapitalCity+'</option>';                                                      
                }

                $('#onsitecity').html(html);
                $('#i_ocitydes').val($('#onsitecity option:selected').attr('ocity-des'));
            } else {
                $('#onsitecity').html('<option value="-"> No Data City </option>');
                $('#i_ocitydes').val("");
            }
        }, error : function(){
            alert("Error to load City !");
        }
    });
}

function load_list_onsitecity_by_onsiteregion(oregioncode){
    var html = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_onsitecity_by_onsiteregion'); ?>",
        data    : {oregion_code : oregioncode},
        type    : "POST",
        dataType : "json",
        success : function(data){
            if (data.rstatus == "success") {
                var onsitecity = data.data;
                for (let index = 0; index < onsitecity.length; index++) {
                    html += '<option value="'+onsitecity[index].RegionCityCode+'" ocity-des="'+onsitecity[index].RegionCity+'">'+onsitecity[index].RegionCity+'</option>';                                                      
                }

                $('#onsitecity').html(html);
                $('#i_ocitydes').val($('#onsitecity option:selected').attr('ocity-des'));
            } else {
                $('#onsitecity').html('<option value="-"> No Data City </option>');
                $('#i_ocitydes').val("");
            }
        }, error : function(){
            alert("Error to load City !");
        }
    });
}

function load_list_onsitedistrict_by_onsiteregion(oregioncode){
    var html = '';
    var codedistrict = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_onsitedistrict_by_onsiteregion'); ?>",
        data    : {oregion_code : oregioncode},
        type    : "POST",
        dataType : "json",
        async   : false,
        success : function(data){
            if (data.rstatus == "success") {
                var onsitedistrict = data.data;
                for (let index = 0; index < onsitedistrict.length; index++) {
                    html += '<option value="'+onsitedistrict[index].DistrictCode+'" odistrict-des="'+onsitedistrict[index].DistrictDes+'">'+onsitedistrict[index].DistrictDes+'</option>';                                                      
                }
                $('#onsitedistrict').html(html);      
                
            } else {
                $('#onsitedistrict').html('<option value="-"> No Data District </option>');
                $('#i_odistrictdes').val("");
            }
        }, error : function(){
            alert("Error to load District !");
        }
    });

    
    codedistrict = $('#onsitedistrict option:selected').val()
    if(codedistrict !== ''){
        load_list_onsitesubdistrict_by_onsitedistrict(codedistrict)
        var odistrictdes = $('#onsitedistrict').children("option:selected").attr('odistrict-des');
        $('#i_odistrictdes').val(odistrictdes);
    }else{
        $('#onsitedistrict').html('<option> No Data </option>')
    }      
}

function load_list_onsitesubdistrict_by_onsitedistrict(odistrictcode){
    var html = '';
    var codesubdistrict = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_onsitesubdistrict_by_onsitedistrict'); ?>",
        data    : {odistrict_code : odistrictcode},
        type    : "POST",
        dataType : "json",
        async   : false,
        success : function(data){
            if (data.rstatus == "success") {
                var onsitesubdistrict = data.data;
                for (let index = 0; index < onsitesubdistrict.length; index++) {
                    html += '<option value="'+onsitesubdistrict[index].SubDistrictCode+'" osubdistrict-des="'+onsitesubdistrict[index].SubDistrictDes+'" okode-pos="'+onsitesubdistrict[index].PostalCode+'">'+onsitesubdistrict[index].SubDistrictDes+'</option>';                                                      
                }
                $('#onsitesubdistrict').html(html);
                var okodepos = $('#onsitesubdistrict').children("option:selected").attr('okode-pos');            
                $('#onsitepostcode').val(okodepos);   
                
            } else {
                $('#onsitesubdistrict').html('<option value="-"> No Data SubDistrict </option>');
                $('#i_osubdistrictdes').val("");
            }
        }, error : function(){
            alert("Error to load SubDistrict !");
        }
    });

    codesubdistrict = $('#onsitesubdistrict option:selected').val()      
    if(codesubdistrict !== ''){
        var osubdistrictdes = $('#onsitesubdistrict').children("option:selected").attr('osubdistrict-des');
        $('#i_osubdistrictdes').val(osubdistrictdes);
        var okodepos = $('#onsitesubdistrict').children("option:selected").attr('okode-pos');            
        $('#onsitepostcode').val(okodepos);   
    }else{
        $('#onsitepostcode').val(""); 
    }   
}

function load_list_provincekin_by_countrykin(countrykincode){
    var html = '';
    var code = '';
    var id = '';

    //AJAX = ASYNCHROUNUS JAVASCRIPT AND XML / JSON
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_provincekin_by_countrykin'); ?>",
        data    : {countrykin_code : countrykincode},
        type    : "POST",
        async   : false,
        dataType : "json",
        success : function(data){
            console.table(data)
            if (data.rstatus == "success") {
                var provincekin = data.data;
                for (let index = 0; index < provincekin.length; index++) {
                    html += '<option value="'+provincekin[index].ProvinceCode+'" provincekin-id="'+provincekin[index].ProvinceID+'" provincekin-des="'+provincekin[index].ProvinceDes+'">'+provincekin[index].ProvinceDes+'</option>';                                                      
                }
                $('#provincekin').html(html);
            } else {
                $('#provincekin').html('<option value="-"> No Data Province </option>');
                $('#i_provincekindes').val("");
            }
        }, error : function(){
            alert("Error to load Province !");
        }
    });

    code = $('#provincekin option:selected').val()                        
    // id = $('#provincekin option:selected').attr('provincekin-id')

    if(code !== ''){
        load_list_regionkin_by_provincekin(code)
        var provincekindes = $('#provincekin').children("option:selected").attr('provincekin-des');
        $('#i_provincekindes').val(provincekindes);
    }else{
        $('#regionkin').html('<option> No Data </option>')
    }

    // if(id !== ''){
    //     load_list_citydep_by_provincedep(id)
    // }else{
    //     $('#citydep').html('<option> No Data </option>')
    // }
}

function load_list_regionkin_by_provincekin(provincekincode){
    var html = '';
    var codereg ='';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_regionkin_by_provincekin'); ?>",
        data    : {provincekin_code : provincekincode},
        type    : "POST",
        dataType : "json",
        async   : false,
        success : function(data){
            if (data.rstatus == "success") {
                var regionkin = data.data;
                for (let index = 0; index < regionkin.length; index++) {
                    html += '<option value="'+regionkin[index].RegionCode+'" regionkin-des="'+regionkin[index].RegionDes+'">'+regionkin[index].RegionDes+'</option>';                                                      
                }
                $('#regionkin').html(html);
                
            } else {
                $('#regionkin').html('<option value="-"> No Data Region </option>');
                $('#i_regionkindes').val("");
            }
        }, error : function(){
            alert("Error to load Region !");
        }
    });


    codereg = $('#regionkin option:selected').val()      
    if(codereg !== ''){
        load_list_districtkin_by_regionkin(codereg)
        var regionkindes = $('#regionkin').children("option:selected").attr('regionkin-des');
        $('#i_regionkindes').val(regionkindes);
    }else{
        $('#regionkin').html('<option> No Data </option>')
    }     

    if(codereg !== ''){
        load_list_citykin_by_regionkin(codereg)
    }else{
        $('#citykin').html('<option> No Data </option>')
    }  
}

function load_list_districtkin_by_regionkin(regionkincode){
    var html = '';
    var codedistrict = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_districtkin_by_regionkin'); ?>",
        data    : {regionkin_code : regionkincode},
        type    : "POST",
        dataType : "json",
        async   : false,
        success : function(data){
            if (data.rstatus == "success") {
                var districtkin = data.data;
                for (let index = 0; index < districtkin.length; index++) {
                    html += '<option value="'+districtkin[index].DistrictCode+'" districtkin-des="'+districtkin[index].DistrictDes+'">'+districtkin[index].DistrictDes+'</option>';                                                      
                }
                $('#districtkin').html(html);      
                
            } else {
                $('#districtkin').html('<option value="-"> No Data District </option>');
                $('#i_districtkindes').val("");
            }
        }, error : function(){
            alert("Error to load District !");
        }
    });

    
    codedistrict = $('#districtkin option:selected').val()
    if(codedistrict !== ''){
        load_list_subdistrictkin_by_districtkin(codedistrict)
        var districtkindes = $('#districtkin').children("option:selected").attr('districtkin-des');
        $('#i_districtkindes').val(districtkindes);
    }else{
        $('#districtkin').html('<option> No Data </option>')
    }      
}

function load_list_citykin_by_regionkin(regionkincode){
    var html = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_citykin_by_regionkin'); ?>",
        data    : {regionkin_code : regionkincode},
        type    : "POST",
        dataType : "json",
        success : function(data){
            if (data.rstatus == "success") {
                var citykin = data.data;
                for (let index = 0; index < citykin.length; index++) {
                    html += '<option value="'+citykin[index].RegionCityCode+'" citykin-des="'+citykin[index].RegionCity+'">'+citykin[index].RegionCity+'</option>';                                                      
                }

                $('#citykin').html(html);
                $('#i_citykindes').val($('#citykin option:selected').attr('citykin-des'));
            } else {
                $('#citykin').html('<option value="-"> No Data City </option>');
                $('#i_citykindes').val("");
            }
        }, error : function(){
            alert("Error to load City !");
        }
    });
}

function load_list_subdistrictkin_by_districtkin(districtkincode){
    var html = '';
    var codesubdistrict = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_subdistrictkin_by_districtkin'); ?>",
        data    : {districtkin_code : districtkincode},
        type    : "POST",
        dataType : "json",
        async   : false,
        success : function(data){
            if (data.rstatus == "success") {
                var subdistrictkin = data.data;
                for (let index = 0; index < subdistrictkin.length; index++) {
                    html += '<option value="'+subdistrictkin[index].SubDistrictCode+'" subdistrictkin-des="'+subdistrictkin[index].SubDistrictDes+'" kodekin-pos="'+subdistrictkin[index].PostalCode+'">'+subdistrictkin[index].SubDistrictDes+'</option>';                                                      
                }
                $('#subdistrictkin').html(html);
                var kodekinpos = $('#subdistrictkin').children("option:selected").attr('kodekin-pos');            
                $('#postcodekin').val(kodekinpos);   
                
            } else {
                $('#subdistrictkin').html('<option value="-"> No Data SubDistrict </option>');
                $('#i_subdistrictkindes').val("");
            }
        }, error : function(){
            alert("Error to load SubDistrict !");
        }
    });

    codesubdistrict = $('#subdistrictkin option:selected').val()      
    if(codesubdistrict !== ''){
        var subdistrictkindes = $('#subdistrictkin').children("option:selected").attr('subdistrictkin-des');
        $('#i_subdistrictkindes').val(subdistrictkindes);
        var kodekinpos = $('#subdistrictkin').children("option:selected").attr('kodekin-pos');            
        $('#postcodekin').val(kodekinpos);   
    }else{
        $('#postcodekin').val(""); 
    }   
}

function get_data_dependent(ctrlno) {
    $.ajax({
      url:"<?php echo site_url('Humanresource/get_data_dep') ?>",
      type: "POST",
      dataType: "json",
      data: {ctrlno : ctrlno},
      beforeSend: function(){
        // Show image container
        $("#loader").show();
      },
      success: function(data){
        //alert(data);
        $('#data_edit_dependent').html(data)
      },
      complete:function(){
        // Hide image container
        $("#loader").hide();
      },
      error: function(){
        alert('Error occur...!!');
      }
    });
}

function get_data_kin(ctrlno) {
    $.ajax({
      url:"<?php echo site_url('Humanresource/get_data_kin') ?>",
      type: "POST",
      dataType: "json",
      data: {ctrlno : ctrlno},
      beforeSend: function(){
        // Show image container
        $("#loader").show();
      },
      success: function(data){
        //alert(data);
        $('#data_edit_kin').html(data)
      },
      complete:function(){
        // Hide image container
        $("#loader").hide();
      },
      error: function(){
        alert('Error occur...!!');
      }
    });
}

function load_list_countrydep(){
    var html = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_country'); ?>",
        type    : "POST",
        async   : false,
        dataType : "json",
        success : function(data){
            if (data.rstatus == "success") {
                var countrydep = data.data;
                html += '<option value="" selected="">-- Choose Country --</option>';
                for (let index = 0; index < countrydep.length; index++) {
                    html += '<option value="'+countrydep[index].CountryCode+'" countrydep-des="'+countrydep[index].CountryName+'">'+countrydep[index].CountryCode+' - '+countrydep[index].CountryName+'</option>';                                                      
                }
                $('#countrydep').html(html);  
            } else {
                
            }
        }, error : function(){
            alert("Error to load Country !");
        }
    });
}

function load_list_provincedep_by_countrydep(countrydepcode){
    var html = '';
    var code = '';
    var id = '';

    //AJAX = ASYNCHROUNUS JAVASCRIPT AND XML / JSON
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_provincedep_by_countrydep'); ?>",
        data    : {countrydep_code : countrydepcode},
        type    : "POST",
        async   : false,
        dataType : "json",
        success : function(data){
            console.table(data)
            if (data.rstatus == "success") {
                var provincedep = data.data;
                for (let index = 0; index < provincedep.length; index++) {
                    html += '<option value="'+provincedep[index].ProvinceCode+'" provincedep-id="'+provincedep[index].ProvinceID+'" provincedep-des="'+provincedep[index].ProvinceDes+'">'+provincedep[index].ProvinceDes+'</option>';                                                      
                }
                $('#provincedep').html(html);
            } else {
                $('#provincedep').html('<option value="-"> No Data Province </option>');
                $('#i_provincedepdes').val("");
            }
        }, error : function(){
            alert("Error to load Province !");
        }
    });

    code = $('#provincedep option:selected').val()                        
    // id = $('#provincedep option:selected').attr('provincedep-id')

    if(code !== ''){
        load_list_regiondep_by_provincedep(code)
        var provincedepdes = $('#provincedep').children("option:selected").attr('provincedep-des');
        $('#i_provincedepdes').val(provincedepdes);
    }else{
        $('#regiondep').html('<option> No Data </option>')
    }

    // if(id !== ''){
    //     load_list_citydep_by_provincedep(id)
    // }else{
    //     $('#citydep').html('<option> No Data </option>')
    // }
}

function load_list_regiondep_by_provincedep(provincedepcode){
    var html = '';
    var codereg ='';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_regiondep_by_provincedep'); ?>",
        data    : {provincedep_code : provincedepcode},
        type    : "POST",
        dataType : "json",
        async   : false,
        success : function(data){
            if (data.rstatus == "success") {
                var regiondep = data.data;
                for (let index = 0; index < regiondep.length; index++) {
                    html += '<option value="'+regiondep[index].RegionCode+'" regiondep-des="'+regiondep[index].RegionDes+'">'+regiondep[index].RegionDes+'</option>';                                                      
                }
                $('#regiondep').html(html);
                
            } else {
                $('#regiondep').html('<option value="-"> No Data Region </option>');
                $('#i_regiondepdes').val("");
            }
        }, error : function(){
            alert("Error to load Region !");
        }
    });


    codereg = $('#regiondep option:selected').val()      
    if(codereg !== ''){
        load_list_districtdep_by_regiondep(codereg)
        var regiondepdes = $('#regiondep').children("option:selected").attr('regiondep-des');
        $('#i_regiondepdes').val(regiondepdes);
    }else{
        $('#regiondep').html('<option> No Data </option>')
    }     

    if(codereg !== ''){
        load_list_citydep_by_regiondep(codereg)
    }else{
        $('#citydep').html('<option> No Data </option>')
    }  
}

function load_list_districtdep_by_regiondep(regiondepcode){
    var html = '';
    var codedistrict = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_districtdep_by_regiondep'); ?>",
        data    : {regiondep_code : regiondepcode},
        type    : "POST",
        dataType : "json",
        async   : false,
        success : function(data){
            if (data.rstatus == "success") {
                var districtdep = data.data;
                for (let index = 0; index < districtdep.length; index++) {
                    html += '<option value="'+districtdep[index].DistrictCode+'" districtdep-des="'+districtdep[index].DistrictDes+'">'+districtdep[index].DistrictDes+'</option>';                                                      
                }
                $('#districtdep').html(html);      
                
            } else {
                $('#districtdep').html('<option value="-"> No Data District </option>');
                $('#i_districtdepdes').val("");
            }
        }, error : function(){
            alert("Error to load District !");
        }
    });

    
    codedistrict = $('#districtdep option:selected').val()
    if(codedistrict !== ''){
        load_list_subdistrictdep_by_districtdep(codedistrict)
        var districtdepdes = $('#districtdep').children("option:selected").attr('districtdep-des');
        $('#i_districtdepdes').val(districtdepdes);
    }else{
        $('#districtdep').html('<option> No Data </option>')
    }      
}

function load_list_citydep_by_regiondep(regiondepcode){
    var html = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_citydep_by_regiondep'); ?>",
        data    : {regiondep_code : regiondepcode},
        type    : "POST",
        dataType : "json",
        success : function(data){
            if (data.rstatus == "success") {
                var citydep = data.data;
                for (let index = 0; index < citydep.length; index++) {
                    html += '<option value="'+citydep[index].RegionCityCode+'" citydep-des="'+citydep[index].RegionCity+'">'+citydep[index].RegionCity+'</option>';                                                      
                }

                $('#citydep').html(html);
                $('#i_citydepdes').val($('#citydep option:selected').attr('citydep-des'));
            } else {
                $('#citydep').html('<option value="-"> No Data City </option>');
                $('#i_citydepdes').val("");
            }
        }, error : function(){
            alert("Error to load City !");
        }
    });
}

function load_list_subdistrictdep_by_districtdep(districtdepcode){
    var html = '';
    var codesubdistrict = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_subdistrictdep_by_districtdep'); ?>",
        data    : {districtdep_code : districtdepcode},
        type    : "POST",
        dataType : "json",
        async   : false,
        success : function(data){
            if (data.rstatus == "success") {
                var subdistrictdep = data.data;
                for (let index = 0; index < subdistrictdep.length; index++) {
                    html += '<option value="'+subdistrictdep[index].SubDistrictCode+'" subdistrictdep-des="'+subdistrictdep[index].SubDistrictDes+'" kodedep-pos="'+subdistrictdep[index].PostalCode+'">'+subdistrictdep[index].SubDistrictDes+'</option>';                                                      
                }
                $('#subdistrictdep').html(html);
                var kodedeppos = $('#subdistrictdep').children("option:selected").attr('kodedep-pos');            
                $('#postcodedep').val(kodedeppos);   
                
            } else {
                $('#subdistrictdep').html('<option value="-"> No Data SubDistrict </option>');
                $('#i_subdistrictdepdes').val("");
            }
        }, error : function(){
            alert("Error to load SubDistrict !");
        }
    });

    codesubdistrict = $('#subdistrictdep option:selected').val()      
    if(codesubdistrict !== ''){
        var subdistrictdepdes = $('#subdistrictdep').children("option:selected").attr('subdistrictdep-des');
        $('#i_subdistrictdepdes').val(subdistrictdepdes);
        var kodedeppos = $('#subdistrictdep').children("option:selected").attr('kodedep-pos');            
        $('#postcodedep').val(kodedeppos);   
    }else{
        $('#postcodedep').val(""); 
    }   
}

function load_list_countrykin(){
    var html = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_country'); ?>",
        type    : "POST",
        async   : false,
        dataType : "json",
        success : function(data){
            if (data.rstatus == "success") {
                var countrykin = data.data;
                html += '<option value="" selected="">-- Choose Country --</option>';
                for (let index = 0; index < countrykin.length; index++) {
                    html += '<option value="'+countrykin[index].CountryCode+'" countrykin-des="'+countrykin[index].CountryName+'">'+countrykin[index].CountryCode+' - '+countrykin[index].CountryName+'</option>';                                                      
                }
                $('#countrykin').html(html);  
            } else {
                
            }
        }, error : function(){
            alert("Error to load Country !");
        }
    });
}

function load_list_nationalitydep(){
    var html = '';
    $.ajax({
        url     : "<?php echo site_url('Humanresource/get_list_country'); ?>",
        type    : "POST",
        async   : false,
        dataType : "json",
        success : function(data){
            if (data.rstatus == "success") {
                var nationalitydep = data.data;
                html += '<option value="" selected="">-- Choose Nationality --</option>';
                for (let index = 0; index < nationalitydep.length; index++) {
                    html += '<option value="'+nationalitydep[index].CountryCode+'" nationalitydep-des="'+nationalitydep[index].CountryName+'">'+nationalitydep[index].CountryCode+' - '+nationalitydep[index].CountryName+'</option>';                                                      
                }
                $('#nationalitydep').html(html);  
            } else {
                
            }
        }, error : function(){
            alert("Error to load Country !");
        }
    });
}
</script>
<?php $this->load->view('humanresource/header_footer/footer'); ?>