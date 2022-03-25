<?php $this->load->view('humanresource/header_footer/header_reg'); ?>
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
<div class="container-fluid">
    <div class="page-content">
        <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs" style="margin-top: -15px">
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
        <div class="page-content-container" style="margin-top: -20px">
            <div class="page-content-row">
                <div class="col-md-12 "> 
                      <?php echo $this->session->flashdata('success_added'); ?>
                      <?php echo $this->session->flashdata('success_saved'); ?>
                      <?php echo $this->session->flashdata('error_msg_added'); ?>
                </div>  
                <form class="margin-bottom-40 form-horizontal" method="post"action="<?php echo base_url(); ?>index.php/Humanresource/transfer_data_personal_abc" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="portlet light" style="background-color: #f1f3fa">
                            <div class="row">
                                <div class="col-md-9" style="margin-top: -10px">
                                    <div class="portlet-body form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group">
                                                 <label class="col-md-2 control-label"><b>ID Number <span><font color="red">*</font>:</span></b></label>
                                                <div class="col-md-4">
                                                    <input id="i_hidden_idnumber" type="hidden" value="<?php echo $idnumbercode; ?>">
                                                    <input name="i_idnumber" type="text" class="form-control input-inline input-medium" placeholder="Enter ID Number" value="<?php echo $idnumbercode; ?>" required="" readonly>
                                                    <span class="help-inline">
                                                        <label class="mt-checkbox mt-checkbox-outline">
                                                            <input type="checkbox"  name="i_check_aidnumber" value="iset" >
                                                            <span></span>
                                                        </label>
                                                        <a href="#" title="Check the box for set idnumber"><i class="fa fa-info-circle" style="background-color: white"></i></a>
                                                    </span>
                                                </div>   
                                                <label class="col-md-2 control-label"><b>Full Name <span><font color="red">*</font>:</span></b></label>
                                                <div class="col-md-4">
                                                    <input type="text" name="fullname" class="form-control" placeholder="Enter text..." required>                                            
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label"><b>First Name <span><font color="red">*</font>:</span></b></label>
                                                <div class="col-md-4">
                                                    <input type="text" name="firstname" class="form-control" placeholder="Enter text..." required>                                            
                                                </div> 
                                                <!-- Row 2 -->
                                                <label class="col-md-2 control-label"><b>Nick Name :</b></label>
                                                <div class="col-md-4">
                                                    <input type="text" name="nickname" class="form-control" placeholder="Enter text...">                                            
                                                </div> 
                                            </div>
                                            <div class="form-group"> 
                                                <label class="col-md-2 control-label"><b>Middle Name :</b></label>
                                                <div class="col-md-4">
                                                    <input type="text" name="middlename" class="form-control" placeholder="Enter text...">                                            
                                                </div> 
                                                <!-- Row 2 -->
                                                <label class="col-md-2 control-label"><b>Personal Ref ID :</b></label>
                                                <div class="col-md-4">
                                                    <input type="text" name="personalid" class="form-control" placeholder="Enter text...">                                            
                                                </div> 
                                            </div>
                                             <div class="form-group">
                                                <label class="col-md-2 control-label"><b>Last Name :</b></label>
                                                <div class="col-md-4">
                                                    <input type="text" name="lastname" class="form-control" placeholder="Enter text...">                                            
                                                </div>
                                            </div>
                                        </div>                                                                                                
                                    </div>
                                </div>                                            
                                <div class="col-md-3">
                                    <label class="col-md-2 col-sm-2 control-label bold">Action:</label>
                                    <div class="col-md-10 col-sm-10">
                                        <input type="submit" name="submit" value="Submit" onclick="return confirm('Are you sure?')" class="btn btn-transparent blue btn-block btn-sm">                                     
                                    </div>
                                    <hr>
                                    <label class="col-md-2 col-sm-2 control-label bold">Photo:</label>
                                    <div class="col-md-10 col-sm-10">
                                        <input type="file" name="photo" id="photo" class="dropify" data-show-loader="false" data-height="150" data-allowed-file-extensions="jpg jpeg png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: -20px">
                        <div class="tabbable-line tabbable-custom-profile">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#persdet" data-toggle="tab"><b>Personal Detail</b></a>
                                </li>
                                <li>
                                    <a href="#jobinfo" data-toggle="tab"><b>Job Information</b></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="persdet" style="margin-top: -30px">
                                    <div class="portlet light"  style="background-color: #f4f7f8">
                                        <!-- <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject bold uppercase font-dark"> Detail Meeting </span>                                                    
                                            </div>                                                                                       
                                        </div> -->
                                        <div class="portlet-body form">
                                            <div class="form-horizontal">
                                                <div class="col-md-6">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="caption-subject font-dark sbold uppercase">Details</span>
                                                        </div>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <label class="col-md-2 col-sm-2 control-label">Date of Birth <span><font color="red">*</font></span></label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <input type="date" name="dateofbirth" class="form-control" required>
                                                        </div>

                                                        <label class="col-md-2 col-sm-2 control-label">Point of Birth</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <input type="text" name="pointofbirth" class="form-control" placeholder="Enter text">
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 col-sm-2 control-label">Gender <span><font color="red">*</font></span></label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                           <select name="gender"  class="form-control" required>
                                                                  <option value="">-- Choose Gender --</option>
                                                                  <option id="gender" value="Male">Male</option>
                                                                  <option id="gender" value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                        <label class="col-md-2 col-sm-2 control-label">Marital</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <select name="maritalstatus" id="maritalstatus" class="form-control">
                                                                <?php if ($get_marital != false) { ?>
                                                                    <option value="" selected>-- Choose Marial --</option>
                                                                    <?php foreach ($get_marital as $mar) { ?>
                                                                        <option value="<?php echo $mar->Marital; ?>" marital-des="<?php echo $mar->MaritalDes; ?>"><?php echo $mar->Marital; ?> - <?php echo $mar->MaritalDes; ?></option>
                                                                    <?php }?>
                                                                <?php } else { ?>
                                                                    <option value=""><font color="red">No Data Marital</font></option>
                                                                <?php } ?>
                                                            </select>
                                                            <input id="i_maritalstatusdes" name="i_maritalstatusdes" type="text" class="form-control hidden" readonly="true">
                                                        </div>
                                                    </div>               
                                                    <div class="form-group">
                                                        <label class="col-md-2 col-sm-2 control-label">Religion <span><font color="red">*</font></span></label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <select name="religion"  class="form-control" required>
                                                                  <option value="">-- Choose Religion --</option>
                                                                  <option id="religion" value="Buddha">Buddha</option>
                                                                  <option id="religion" value="Christian">Christian</option>
                                                                  <option id="religion" value="Catholic">Catholic</option>
                                                                  <option id="religion" value="Hindu">Hindu</option>
                                                                  <option id="religion" value="Islam">Islam</option>
                                                                  <option id="religion" value="Khonghucu">Khonghucu</option>
                                                            </select>
                                                        </div>
                                                        <label class="col-md-2 col-sm-2 control-label">Ethnic</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <select name="ethnic" id="ethnic" class="form-control">
                                                                <?php if ($get_ethnic != false) { ?>
                                                                    <option value="" selected>-- Choose Ethnic --</option>
                                                                    <?php foreach ($get_ethnic as $eth) { ?>
                                                                        <option value="<?php echo $eth->Ethnic; ?>"><?php echo $eth->Ethnic; ?></option>
                                                                    <?php }?>
                                                                <?php } else { ?>
                                                                    <option value=""><font color="red">No Data Ethnic</font></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>                                                        
                                                    </div>
                                                    <div class="form-group">
                                                        <!-- <label class="col-md-2 col-sm-2 control-label">Nationality</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <input type="text" name="nationality" class="form-control" placeholder="Enter text">
                                                        </div>  -->
                                                        <label class="col-md-2 col-sm-2 control-label">Nationality</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <select name="nationality" id="nationality" class="form-control">
                                                            </select>
                                                            <input id="i_nationalitydes" name="i_nationalitydes" type="text" class="form-control hidden" readonly="true">
                                                        </div>                                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="caption-subject font-dark sbold uppercase">Address Info</span>
                                                        </div>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <label class="col-md-2 col-sm-2 control-label">Address</label>
                                                        <div class="col-md-10 col-sm-10" style="margin-left: -10px">
                                                            <textarea type="text" name="address" class="form-control" placeholder="Enter text"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 col-sm-2 control-label">Country</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <select name="country" id="country" class="form-control">
                                                            </select>
                                                            <input id="i_countrydes" name="i_countrydes" type="text" class="form-control hidden" readonly="true">
                                                        </div>
                                                        <label class="col-md-2 col-sm-2 control-label">Province</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <select name="province" id="province" class="form-control">
                                                                <option value="" selected="">-- Choose Country First --</option> 
                                                            </select>
                                                            <input id="i_provincedes" name="i_provincedes" type="text" class="form-control hidden" readonly="true">
                                                        </div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label class="col-md-2 col-sm-2 control-label">Region</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <select name="region" id="region" class="form-control">
                                                                <option value="" selected="">-- Choose Province First --</option> 
                                                            </select>
                                                            <input id="i_regiondes" name="i_regiondes" type="text" class="form-control hidden" readonly="true">
                                                        </div>
                                                        <label class="col-md-2 col-sm-2 control-label">District</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <select name="district" id="district" class="form-control">
                                                                <option value="" selected="">-- Choose Region First --</option> 
                                                            </select>
                                                            <input id="i_districtdes" name="i_districtdes" type="text" class="form-control hidden" readonly="true">
                                                        </div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label class="col-md-2 col-sm-2 control-label">Subdistrict</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <select name="subdistrict" id="subdistrict" class="form-control">
                                                                <option value="" selected="">-- Choose District First --</option> 
                                                            </select>
                                                            <input id="i_subdistrictdes" name="i_subdistrictdes" type="text" class="form-control hidden" readonly="true">
                                                        </div>
                                                        <label class="col-md-2 col-sm-2 control-label">City</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <select name="city" id="city" class="form-control">
                                                                <option value="" selected="">-- Choose Region First --</option> 
                                                            </select>
                                                            <input id="i_citydes" name="i_citydes" type="text" class="form-control hidden" readonly="true">
                                                        </div>
                                                    </div>                                                      
                                                    <div class="form-group">
                                                        <label class="col-md-2 col-sm-2 control-label">Postal Code</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <input type="text" name="postcode" id="postcode" class="form-control" readonly="" placeholder="-- Choose SubDistrict First --">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="caption-subject font-dark sbold uppercase">Identity Info</span>
                                                        </div>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <label class="col-md-2 col-sm-2 control-label">Id No / NIK</label>
                                                        <div class="col-md-4 col-sm-4" style="margin-left: -10px">
                                                            <input type="number" name="identityno" class="form-control" placeholder="Enter number"><br>
                                                            <input type="date" name="identityexpire" class="form-control" placeholder="Indentity Expire"> 
                                                        </div> 
                                                        <label class="col-md-2 col-sm-2 control-label">Identity Photo</label>
                                                        <div class="col-md-4" style="margin-left: -10px;margin-top: 0px">
                                                            <input  type="file" name="identity" id="identity" class="dropify" data-show-loader="false" data-height="150" data-allowed-file-extensions="jpg jpeg png">
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: -30px">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="jobinfo" style="margin-top: -30px">
                                    <div class="portlet light"  style="background-color: #f4f7f8">
                                        <!-- <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject bold uppercase font-dark"> Detail Meeting </span>                                                    
                                            </div>                                                                                       
                                        </div> -->
                                        <div class="portlet-body form">
                                            <div class="form-horizontal">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <span class="caption-subject font-dark sbold uppercase">Job Details</span>
                                                            </div>
                                                        </div><br>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Job Title</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select name="jobtitle" id="jobtitle" class="form-control">
                                                                    <?php if ($get_title != false) { ?>
                                                                        <option value="" selected>-- Choose Title --</option>
                                                                        <?php foreach ($get_title as $jt) { ?>
                                                                            <option value="<?php echo $jt->JobTitleCode; ?>" jobtitle-des="<?php echo $jt->JobTitle; ?>"><?php echo $jt->JobTitleCode; ?> - <?php echo $jt->JobTitle; ?></option>
                                                                        <?php }?>
                                                                    <?php } else { ?>
                                                                        <option value=""><font color="red">No Data JobTitle</font></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input id="i_jobtitle" name="i_jobtitle" type="text" class="form-control hidden" readonly="true">
                                                            </div> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Hire Date</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="date" name="hiredate" class="form-control" placeholder="Enter text">
                                                            </div> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Point of Hire</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="text" name="pointofhire" class="form-control" placeholder="Enter text">
                                                            </div> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md- col-sm-4 control-label">Employee Class</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select name="employeeclass" id="employeeclass" class="form-control">
                                                                    <?php if ($get_employeeclass != false) { ?>
                                                                        <option value="" selected>-- Choose Employee Class --</option>
                                                                        <?php foreach ($get_employeeclass as $ec) { ?>
                                                                            <option value="<?php echo $ec->EmployeeClass; ?>" empclass-des="<?php echo $ec->EmployeeClassDes; ?>"><?php echo $ec->EmployeeClass; ?> - <?php echo $ec->EmployeeClassDes; ?></option>
                                                                        <?php }?>
                                                                    <?php } else { ?>
                                                                        <option value=""><font color="red">No Data Employee Class</font></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input id="i_employeeclassdes" name="i_employeeclassdes" type="text" class="form-control hidden" readonly="true">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <span class="caption-subject font-dark sbold uppercase">Contact Details</span>
                                                            </div>
                                                        </div><br>                                                    
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Mobile</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="number" name="mobile1" class="form-control" placeholder="Enter number">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">WA</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="number" name="wa" class="form-control" placeholder="Enter number">
                                                            </div>
                                                        </div> 
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Workphone</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="number" name="workphone" class="form-control" placeholder="Enter number">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Email Personal</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="text" name="emailpersonal" class="form-control" placeholder="Enter text">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <span class="caption-subject font-white sbold uppercase">-</span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">PTKP</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="text" name="ptkp" class="form-control" placeholder="Enter text">
                                                            </div> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">NPWP</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <input type="text" name="npwp" class="form-control" placeholder="Enter text">
                                                            </div> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Employee Type</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select name="employeetype" id="employeetype" class="form-control">
                                                                    <?php if ($get_employeetype != false) { ?>
                                                                        <option value="" selected>-- Choose Employee Type --</option>
                                                                        <?php foreach ($get_employeetype as $et) { ?>
                                                                            <option value="<?php echo $et->EmployeeType; ?>" emptype-des="<?php echo $et->EmployeeTypeDes; ?>"><?php echo $et->EmployeeType; ?> - <?php echo $et->EmployeeTypeDes; ?></option>
                                                                        <?php }?>
                                                                    <?php } else { ?>
                                                                        <option value=""><font color="red">No Data Employee Type</font></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input id="i_employeetypedes" name="i_employeetypedes" type="text" class="form-control hidden" readonly="true">
                                                            </div>
                                                        </div>                                                        
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Work Function</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select name="workfunction" id="workfunction" class="form-control">
                                                                    <?php if ($get_workfunction != false) { ?>
                                                                        <option value="" selected>-- Choose Function --</option>
                                                                        <?php foreach ($get_workfunction as $wf) { ?>
                                                                            <option value="<?php echo $wf->WorkFunction; ?>" workfunction-des="<?php echo $wf->WorkFunctionDes; ?>" wgroup-code="<?php echo $wf->WorkGroup; ?>" wgroup-des="<?php echo $wf->WorkGroupDes; ?>"><?php echo $wf->WorkFunction; ?> - <?php echo $wf->WorkFunctionDes; ?></option>
                                                                        <?php }?>
                                                                    <?php } else { ?>
                                                                        <option value=""><font color="red">No Data Function</font></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input id="i_workfunctiondes" name="i_workfunctiondes" type="text" class="form-control hidden" readonly="true">
                                                                <input id="i_wgroup" name="i_wgroup" type="text" class="form-control hidden" readonly="true">
                                                                <input id="i_wgroupdes" name="i_wgroupdes" type="text" class="form-control hidden" readonly="true">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <span class="caption-subject font-dark sbold uppercase">Organization</span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Company <span><font color="red">*</font></span></label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <?php if ($get_company != false) { ?>
                                                                    <?php foreach ($get_company as $comp) { ?>
                                                                        <input type="text" value="<?php echo $comp->ComCode; ?> - <?php echo $comp->ComDes; ?>" class="form-control " readonly="true">
                                                                        <input id="company" name="company" type="text" value="<?php echo $comp->ComCode; ?>" class="form-control hidden" readonly="true">
                                                                        <input id="i_company_des" name="i_company_des" value="<?php echo $comp->ComDes; ?>" type="text" class="form-control hidden" readonly="true">
                                                                    <?php }?>
                                                                <?php } else { ?>
                                                                    <option value=""><font color="red">No Data Company</font></option>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Site / Branch <span><font color="red">*</font></span></label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select id="branch" name="branch" class="form-control" required>
                                                                    <?php if ($get_branch != false) { ?>
                                                                        <option value="" selected>-- Choose Branch --</option>
                                                                        <?php foreach ($get_branch as $branch) { ?>
                                                                            <option value="<?php echo $branch->BranchCode; ?>" branch-des="<?php echo $branch->BranchDes?>"><?php echo $branch->BranchCode; ?> | <?php echo $branch->BranchDes; ?></option>
                                                                        <?php }?>
                                                                    <?php } else { ?>
                                                                        <option value=""><font color="red">No Data Branch</font></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input id="i_branchdes" name="i_branchdes" type="text" class="form-control hidden" readonly="true">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Department</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select id="deptcode" name="deptcode" class="form-control">
                                                                    <option value="" selected>-- Choose Branch First --</option>
                                                                </select>
                                                                <input id="i_deptdes" name="i_deptdes" type="text" class="form-control hidden" readonly="true">
                                                                <input id="i_bucode" name="i_bucode" type="text" class="form-control hidden" readonly="true">
                                                                <input id="i_budes" name="i_budes" type="text" class="form-control hidden" readonly="true">
                                                                <input id="i_divcode" name="i_divcode" type="text" class="form-control hidden" readonly="true">
                                                                <input id="i_divdes" name="i_divdes" type="text" class="form-control hidden" readonly="true">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Cost Center / Section</label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select id="costcenter" name="costcenter" class="form-control">
                                                                    <option value="" selected>-- Choose Department First --</option>
                                                                </select>
                                                                <input id="i_costdes" name="i_costdes" type="text" class="form-control hidden" readonly="true">
                                                            </div>
                                                        </div>   
                                                        <div class="form-group">
                                                            <label class="col-md-4 col-sm-4 control-label">Supervisor </label>
                                                            <div class="col-md-8 col-sm-8">
                                                                <select name="supervisor" id="supervisor" class="form-control">
                                                                    <?php if ($get_supervisor != false) { ?>
                                                                        <option value="" selected>-- Choose Supervisor --</option>
                                                                        <?php foreach ($get_supervisor as $sup) { ?>
                                                                            <option value="<?php echo $sup->IDNumber; ?>" sup-des="<?php echo $sup->FirstName; ?> <?php echo $sup->LastName; ?>" suptitle-code="<?php echo $sup->PositionTitle; ?>" suptitle-des="<?php echo $sup->PositionTitleDes; ?>"><?php echo $sup->IDNumber; ?> - <?php echo $sup->FirstName; ?> <?php echo $sup->LastName; ?></option>
                                                                        <?php }?>
                                                                    <?php } else { ?>
                                                                        <option value=""><font color="red">No Data Supervisor</font></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <textarea name="i_sup_des" class="form-control hidden" rows="3" style="resize: none;" readonly></textarea>
                                                                <input name="i_sup_title_code" class="form-control hidden" rows="3" style="resize: none;" readonly>
                                                                <input name="i_sup_title_des" class="form-control hidden" rows="3" style="resize: none;" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: -30px">
                                            
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
<script type="text/javascript">
window.onload = load_function;
function load_function(){
    document.body.style.zoom = 0.9;
    date_time('realtime_clock');

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
  
    //$('#jobtitle').select2();
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

    $(document).ready(function(){
        $('.dropify').dropify();
    });  

    $(document).on('change', 'input[name="i_check_aidnumber"]', function(){
        var checkedstts = $(this).is(':checked');
        if (checkedstts == true) {
            $('input[name="i_idnumber"]').val('');
            $('input[name="i_idnumber"]').removeAttr('readonly');
        } else {
            var hidden_idnumber = $('#i_hidden_idnumber').val();
            $('input[name="i_idnumber"]').val(hidden_idnumber);
            $('input[name="i_idnumber"]').attr('readonly', 'readonly');
        }
    }); 

    //Get ID Increment to IDDep
    var id = $('input[name="i_idnumber"]').val()
    $('input[name="iddep"]').val(id+'-D01')

    //Get ID on SET to IDDep
    // $('.nama-class').val()
    // $('#nama-class').val()
    // $('[name="test"]').val()
    // $('input[name="test"]').val()

    $('[name="i_idnumber"]').on('keyup', function(){
        let check = $('input[name="i_check_aidnumber"]').prop('checked')
        let id_new = $('input[name="i_idnumber"]').val()

        if(check){
            $('input[name="iddep"]').val(id_new + '-D01')
        }
    })

    //Action Check
    $('input[name="i_check_aidnumber"]').on('change',function(){
        if($(this).prop('checked') == false){
            $('input[name="iddep"]').val(id + '-D01')
        }
    })


    //Get ID Increment to IDKin
    var id = $('input[name="i_idnumber"]').val()
    $('input[name="idnumberkin"]').val(id+'-K01')

    //Get ID on SET to IDKin
    $('[name="i_idnumber"]').on('keyup', function(){
        let check = $('input[name="i_check_aidnumber"]').prop('checked')
        let id_new = $('input[name="i_idnumber"]').val()

        if(check){
            $('input[name="idnumberkin"]').val(id_new + '-K01')
        }
    })

    //Action Check
    $('input[name="i_check_aidnumber"]').on('change',function(){
        if($(this).prop('checked') == false){
            $('input[name="idnumberkin"]').val(id + '-K01')
        }
    })

    load_list_country();

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

    load_list_onsitecountry();

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

    $(document).on('change', '#citydep', function(){
        var citydepvalue = $(this).val();
        if (citydepvalue != ""){     
            var citydepdes = $('#citydep').children("option:selected").attr('citydep-des');
            $('#i_citydepdes').val(citydepdes);
        } else {
            alert("Empty City");   
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
            $('#i_provincekindes').val(provincedepdes);

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

    function load_list_country(){
        var html = '';
        $.ajax({
            url     : "<?php echo site_url('Humanresource/get_list_country'); ?>",
            type    : "POST",
            async   : false,
            dataType : "json",
            success : function(data){
                if (data.rstatus == "success") {
                    var country = data.data;
                    html += '<option value="" selected="">-- Choose Country --</option>';
                    for (let index = 0; index < country.length; index++) {
                        html += '<option value="'+country[index].CountryCode+'" country-des="'+country[index].CountryName+'">'+country[index].CountryCode+' - '+country[index].CountryName+'</option>';                                                     
                    }
                    $('#country').html(html);  
                } else {
                    
                }
            }, error : function(){
                alert("Error to load Country !");
            }
        });
    }

    function load_list_onsitecountry(){
        var html = '';
        $.ajax({
            url     : "<?php echo site_url('Humanresource/get_list_country'); ?>",
            type    : "POST",
            async   : false,
            dataType : "json",
            success : function(data){
                if (data.rstatus == "success") {
                    var onsitecountry = data.data;
                    html += '<option value="" selected="">-- Choose Country --</option>';
                    for (let index = 0; index < onsitecountry.length; index++) {
                        html += '<option value="'+onsitecountry[index].CountryCode+'" ocountry-des="'+onsitecountry[index].CountryName+'">'+onsitecountry[index].CountryCode+' - '+onsitecountry[index].CountryName+'</option>';                                                      
                    }
                    $('#onsitecountry').html(html);  
                } else {
                    
                }
            }, error : function(){
                alert("Error to load Country !");
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
            $('#onsitecity').html('<option> No Data </option>')
        }  
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

    $(document).on('change', '#individualgrade', function(){
        let idgrade = $(this, 'option:selected').val();
        var individualgradedes = $(this).children("option:selected").attr('individualgrade-des');            
        $('#i_individualgradedes').val(individualgradedes);
    });

    $(document).on('change', '#jobgrade', function(){
        let jobgrade = $(this, 'option:selected').val();
        var jobgradedes = $(this).children("option:selected").attr('jobgrade-des');            
        $('#i_jobgradedes').val(jobgradedes);
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

    $(document).on('change', '#jobpoint', function(){
        var pointdes = $(this).children("option:selected").attr('point-des');        
        $('#i_jobpointdes').val(pointdes);

        var ratepoint= $(this).children("option:selected").attr('rate-point');        
        $('#i_jobratepoint').val(ratepoint);

        var amountpoint = $(this).children("option:selected").attr('amount-point');        
        $('#i_jobamountpoint').val(amountpoint);

    });

    $(document).on('change', '#individuallevel', function(){
        var ilevcode = $(this).children("option:selected").attr('ilevel-code');        
        $('#i_individuallevelcode').val(ilevcode);

        var ileveldes = $(this).children("option:selected").attr('ilevel-des');        
        $('#i_individualleveldes').val(ileveldes);

        var ileveltype = $(this).children("option:selected").attr('ilevel-type');        
        $('#i_managementtype').val(ileveltype);

        var ilevelgroup = $(this).children("option:selected").attr('ilevel-group');        
        $('#i_managementgroup').val(ilevelgroup);

    });

    $(document).on('change', '#jobtitle', function(){
        var jtdes = $(this).children("option:selected").attr('jobtitle-des');        
        $('#i_jobtitle').val(jtdes);
    });

    $(document).on('change', '#positiontitle', function(){
        var ptdes = $(this).children("option:selected").attr('positiontitle-des');        
        $('#i_positiontitle').val(ptdes);
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

    $(document).on('change', '#empcompany', function(){        
        if ($(this).val() == "") {
            $('textarea[name="i_empcompany_des"]').val('');
        } else {
            var empcomdes = $('#empcompany option:selected').attr('empcom-des');                                  
            $('textarea[name="i_empcompany_des"]').val(empcomdes);
        }
    });

    $(document).on('change', '#company', function(){
        let idcompany = $(this, 'option:selected').val();
        if (idcompany.length > 0) {            
            var companydes = $(this).children("option:selected").attr('com-des');            
            $('#i_company_des').val(companydes);
            $.ajax({
                url     : 'get_branch_list',
                data    : {id_company : idcompany},
                type    : "POST",
                dataType : "json",
                success : function(data){
                    console.log(data)
                    $('#branch').removeAttr('disabled');                    
                    $('#branch').html(data);                    
                    var branchdesc = $('#branch').children("option:selected").attr('branch-des');            
                    $('#i_branchdes').val(branchdesc);     
                  
                    let idbranch = $('#branch').val()
                    searchDept(idbranch)

                }, error : function(){
                    $('#i_branchdes').val("");
                    alert('Error Occur !');
                }
            });
        } else {            
            $('#i_company_des').val("");
            $('#i_branchdes').val("");         
            $('#i_deptdes').val("");         
            $('#i_bucode').val("");         
            $('#i_budes').val("");         
            $('#i_divcode').val("");         
            $('#i_divdes').val("");         
            $('#i_costdes').val("");         
            $('#branch').html('<option value="">-- Choose Company First --</option>');
            $('#deptcode').html('<option value="">-- Choose Branch First --</option>');
            $('#costcenter').html('<option value="">-- Choose Department First --</option>');
        }
    });

    // $(document).on('change', '#branch', function(){
    //     var branchdescription = $(this).children("option:selected").attr('branch-des');        
    //     $('#i_branchdes').val(branchdescription);
    // });

    $(document).on('change', '#branch', function(){
        var branchdescription = $(this).children("option:selected").attr('branch-des');        
        $('#i_branchdes').val(branchdescription);
        let idbranch = $(this, 'option:selected').val();        
        searchDept(idbranch)
    });

    function searchDept(idbranch){
        $.ajax({
            url     : 'get_department_list',
            data    : {id_branch : idbranch},
            type    : "POST",
            dataType : "json",
            success : function(data){
                $('#deptcode').removeAttr('disabled');                    
                $('#deptcode').html(data);                    
                var deptdesc = $('#deptcode option:selected').attr('department-des');            
                $('#i_deptdes').val(deptdesc);

                var bucodes = $('#deptcode option:selected').attr('bu-code');            
                $('#i_bucode').val(bucodes);

                var budess = $('#deptcode option:selected').attr('bu-des');            
                $('#i_budes').val(budess);

                var divcodes = $('#deptcode option:selected').attr('div-code');            
                $('#i_divcode').val(divcodes);

                var divdess = $('#deptcode option:selected').attr('div-des');            
                $('#i_divdes').val(divdess);

                getCostCenter($('#deptcode option:selected').val())
            }, error : function(){
                $('#i_deptdes').val("");
                alert('Error Occur !');
            }
        });
    }

    $(document).on('change','#deptcode', function(){
        let data = $(this, 'option:selected').val()
        var deptdesc = $('#deptcode option:selected').attr('department-des');            
        $('#i_deptdes').val(deptdesc); 
        var bucodes = $('#deptcode option:selected').attr('bu-code');            
        $('#i_bucode').val(bucodes);
        var budess = $('#deptcode option:selected').attr('bu-des');            
        $('#i_budes').val(budess);
        var divcodes = $('#deptcode option:selected').attr('div-code');            
        $('#i_divcode').val(divcodes);
        var divdess = $('#deptcode option:selected').attr('div-des');            
        $('#i_divdes').val(divdess);

        getCostCenter(data)
    })

    function getCostCenter(data){
        $.ajax({
            url: 'get_cost_center',
            method: 'POST',
            data: { 
                deptcode: data,
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

    $(document).on('change','#workday', function(){
        if ($(this).val() == "") {
            $('input[name="i_workdaydes"]').val('');
        } else {
            var workdaydesc = $('#workday option:selected').attr('workday-des');                      
            $('input[name="i_workdaydes"]').val(workdaydesc);
        }
    })

    $(document).on('change','#leavetype', function(){
        if ($(this).val() == "") {
            $('input[name="i_leavetypedes"]').val('');
        } else {
            var leavetypedesc = $('#leavetype option:selected').attr('leavetype-des');                      
            $('input[name="i_leavetypedes"]').val(leavetypedesc);
        }
    })


    //Start - 21Jun2021
    load_list_nationality();

    function load_list_nationality(){
        var html = '';
        $.ajax({
            url     : "<?php echo site_url('Humanresource/get_list_country'); ?>",
            type    : "POST",
            async   : false,
            dataType : "json",
            success : function(data){
                if (data.rstatus == "success") {
                    var nationality = data.data;
                    html += '<option value="" selected="">-- Choose Nationality --</option>';
                    for (let index = 0; index < nationality.length; index++) {
                        html += '<option value="'+nationality[index].CountryCode+'" nationality-des="'+nationality[index].CountryName+'">'+nationality[index].CountryCode+' - '+nationality[index].CountryName+'</option>';                                                      
                    }
                    $('#nationality').html(html);  
                } else {
                    
                }
            }, error : function(){
                alert("Error to load Country !");
            }
        });
    }

    $(document).on('change', '#nationality', function(){
        var cvalue = $(this).val();
        if (cvalue != ""){     
            var nationalitydes = $('#nationality').children("option:selected").attr('nationality-des');
            $('#i_nationalitydes').val(nationalitydes);
        } else {
            alert("Choose Nationality First");
        }
    });


    load_list_nationalitydep();

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
    //End - 21Jun2021
}
</script>
<script src="<?php echo base_url(); ?>assets/datetime-realtime/datetime-ind-format.js" type="text/javascript"></script>
<?php $this->load->view('humanresource/header_footer/footer_reg'); ?> 