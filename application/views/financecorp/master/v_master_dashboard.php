<?php
    $this->load->view('financecorp/header_footer/master/header');
?>
<style type="text/css">
    .table td,th{
        border-top: 0px!important;
    }

    .profile-contact .table{
        margin-top: 10px;
    }

    .profile-contact .table th{
        padding: 12px 0px!important;
        color: #555555;
    }

    .profile-contact .table td{
        font-size: 16px;
        padding-right: 10px;
        color: #5e738b;
    }
</style>
<div class="page-content bg-grey-steel">
    <!-- BEGIN BREADCRUMBS -->
    <div class="breadcrumbs">
        <!-- <h1>Master File</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= base_url('APOS'); ?>">Home</a>
            </li>
            <li>
                <a href="#">Pages</a>
            </li>
            <li class="active">System</li>
        </ol> -->
        <!-- Sidebar Toggle Button -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#page-sidebar">
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
        <div class="page-content-row">
            <?php $this->load->view('financecorp/header_footer/master/sidebar_master'); ?>
            <div class="page-content-col">
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="tab-content">
                    <!-- OPERATION -->
                    <div class="tab-pane active" id="master_abase_company">
                        <!-- <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-institution"></i> Company</h1>
                                </div>
                            </div>
                        </div> -->
                        <?php if($check_company == false) :?>
                        <div class="portlet bordered light bg-grey-cararra">
                            <div class="portlet-title">
                                <div class="tools">
                                    <button type="button" class="btn blue btnModal" id="button_add_master_abase_company"><i class="fa fa-plus"></i> Company</button>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table dt-responsive" id="" width="100%">
                                    <thead>
                                        <tr class="bg-blue-chambray bg-font-blue-chambray">
                                            <td class="text-center">There's no Data ! Please Insert</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php else : ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-sidebar">
                                    <div class="portlet light profile-sidebar-portlet">
                                        <div>
                                            <center>
                                                <img src="<?=base_url('assets/')?><?=$company['Logo']?>" class="img-responsive" alt="" style="width:250px; height: 122px">
                                            </center>
                                        </div>
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name" style="padding: 0px 20px;"> <?=$company['ComName']?> </div>
                                            <div class="profile-usertitle-job"> <span class="badge badge-roundless bg-blue bg-font-blue"><?=$company['CompType']?></span> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 profile-contact">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="2" class="bg-blue-chambray bg-font-blue-chambray text-center bold uppercase">Contact</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th style="width: 50px" class="text-center"><i class="fa fa-phone"style="font-size: 19px"></i></th>
                                                            <td><?=$company['PhoneNo']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center"><i class="fa fa-mobile" style="font-size: 24px"></i></th>
                                                            <td><?=$company['ContactNo']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center"><i class="icon-envelope-open" style="font-size: 19px"></i></th>
                                                            <td><a href="#"><?=$company['Email']?></a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <span class="caption-subject bold uppercase font-blue">Company Profile</span>
                                                    </div>
                                                    <div class="actions">
                                                        <a href="" class="btn btn-sm blue edit-abase" input="abasecompany" data-id="<?=$company['CtrlNo']?>"><i class="fa fa-pencil"></i> Edit Profile</a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th width="20%">Code</th>
                                                                <td><?=$company['ComCode']?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Name</th>
                                                                <td><?=$company['ComName']?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Short Name</th>
                                                                <td><?=$company['ComShortName']?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Description</th>
                                                                <td><?=$company['ComDes']?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Type</th>
                                                                <td><span class="badge badge-roundless bg-blue bg-font-blue"><?=$company['CompType']?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>NPWP</th>
                                                                <td><?=$company['NPWP']?></td>
                                                            </tr>
                                                            <!--  <tr>
                                                                <th>Address</th>
                                                                <td><?=$company['Address'].", ".$company['City'].", ".$company['RegionDes'].", ".$company['Province'].", ".$company['NameLWC'] ?></td>
                                                            </tr> -->
                                                            <tr>
                                                                <th>Address</th>
                                                                <td><?=$company['Address'].", ".$company['City'].", ".$company['Region'].", ".$company['Province'].", ".$company['Country'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Country</th>
                                                                <td><?=$company['Country']?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Post Code</th>
                                                                <td><?=$company['PostalCode']?></td>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet bordered light bg-grey-cararra" style="margin-top: -5px">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-clone"></i> Branch</span>
                                        </div>
                                        <div class="actions">
                                            <button type="button" class="btn blue btnModal" id="button_add_master_abase_branch"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                    <div class="portlet-body" style="margin-top: -10px">
                                        <table class="table dt-responsive table-bordered" id="table_master_abase_branch2" width="100%">
                                            <thead class="font-dark bg-grey-salt">
                                                <tr>
                                                    <th></th>
                                                    <th class="all text-center">Code</th>
                                                    <th class="all text-center">Name</th>
                                                    <th class="all text-center">Type</th>
                                                    <th class="all text-center">Address</th>
                                                    <th class="all text-center">Contact No</th>
                                                    <th class="all text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>  
                    </div>
                    <div class="tab-pane" id="master_abase_branch">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-map-marker"></i> Branch</h1>
                                </div>
                            </div>
                        </div>
                        <div class="portlet bordered light bg-grey-cararra">
                            <div class="portlet-title">
                                <div class="tools">
                                    <button type="button" class="btn blue btnModal" id="button_add_master_abase_branch"><i class="fa fa-plus"></i> Branch</button>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table dt-responsive" id="table_master_abase_branch" width="100%">
                                    <thead class="font-dark bg-grey-salt">
                                        <tr>
                                            <th></th>
                                            <th class="all">Code</th>
                                            <th class="all">Name</th>
                                            <th class="all">Address</th>
                                            <th class="all">Contact No</th>
                                            <th class="all">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="master_abase_department">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-share-alt"></i> Departmentsss</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet bordered light bg-grey-cararra">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-clone"></i> Department</span>
                                        </div>
                                        <div class="actions">
                                            <button type="button" class="btn blue btnModal" id="button_add_master_abase_department"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table dt-responsive table-bordered" id="table_master_abase_department" width="100%">
                                            <thead class="font-dark bg-grey-salt">
                                                <tr>
                                                    <th></th>
                                                    <th class="all text-center">Code</th>
                                                    <th class="all text-center">Description</th>
                                                    <th class="all text-center">Branch</th>
                                                    <th class="all text-center">Bussines Unit</th>
                                                    <th class="all text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="portlet bordered light bg-grey-cararra">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-clone"></i> Business Unit</span>
                                        </div>
                                        <div class="actions">
                                            <button type="button" class="btn blue btnModal" id="button_add_master_abase_department_bu"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table dt-responsive table-bordered" id="table_master_abase_department_bu" width="100%">
                                            <thead class="font-dark bg-grey-salt">
                                                <tr>
                                                    <th></th>
                                                    <th class="all text-center">Code</th>
                                                    <th class="all text-center">Description</th>
                                                    <th class="all text-center">Division</th>
                                                    <th class="all text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="portlet bordered light bg-grey-cararra">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-clone"></i> Division</span>
                                        </div>
                                        <div class="actions">
                                            <button type="button" class="btn blue btnModal" id="button_add_master_abase_department_div"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table dt-responsive table-bordered" id="table_master_abase_department_div" width="100%">
                                            <thead class="font-dark bg-grey-salt">
                                                <tr>
                                                    <th></th>
                                                    <th class="all text-center">Code</th>
                                                    <th class="all text-center">Description</th>
                                                    <th class="all text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="master_abase_cost_center">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-suitcase"></i> Cost Center</h1>
                                </div>
                            </div>
                        </div>
                        <div class="portlet bordered light bg-grey-cararra">
                            <div class="portlet-title">
                                <div class="tools">
                                    <button type="button" class="btn blue btnModal" id="button_add_master_abase_cost_center"><i class="fa fa-plus"></i> Cost Center</button>
                                </div> 
                            </div>
                            <div class="portlet-body">
                                <table class="table dt-responsive" id="table_master_abase_cost_center" width="100%">
                                    <thead class="font-dark bg-grey-salt">
                                        <tr>
                                            <th></th>
                                            <th class="all">Code</th>
                                            <th class="all">Description</th>
                                            <th class="all">Department Code</th>
                                            <th class="all">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- SUPPLY -->
                    <div class="tab-pane" id="master_stockgroup">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-cubes"></i> Stock Group</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="portlet bordered light bg-grey-cararra">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-clone"></i> Group</span>
                                        </div>
                                        <div class="actions">
                                            <button type="button" class="btn blue btnModal" id="button_master_file_add_stockgroup_grp" title="Add New"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table dt-responsive" id="table_master_stockgroup_grp" width="100%">
                                            <thead class="font-dark bg-grey-salt">
                                                <tr>
                                                    <th></th>
                                                    <th class="all text-center">Code</th>
                                                    <th class="all text-center">Description</th>
                                                    <th class="none text-center">Sub Category :</th>
                                                    <th class="all text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="portlet bordered light bg-grey-cararra">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-clone"></i> Sub Category</span>
                                        </div>
                                        <div class="actions">
                                            <button type="button" class="btn blue btnModal" id="button_master_file_add_stockgroup_type"  title="Add New"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table dt-responsive" id="table_master_stockgroup_type" width="100%">
                                            <thead class="font-dark bg-grey-salt">
                                                <tr>
                                                    <th></th>
                                                    <th class="all text-center">Code</th>
                                                    <th class="all text-center">Description</th>
                                                    <th class="none text-center">Category :</th>
                                                    <th class="all text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="portlet bordered light bg-grey-cararra">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-clone"></i> Category</span>
                                        </div>
                                        <div class="actions">
                                            <button type="button" class="btn blue btnModal" id="button_master_file_add_stockgroup_cat"  title="Add New"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table dt-responsive" id="table_master_stockgroup_cat" width="100%">
                                            <thead class="font-dark bg-grey-salt">
                                                <tr>
                                                    <th></th>
                                                    <th class="all text-center">Code</th>
                                                    <th class="all text-center">Description</th>
                                                    <th class="none text-center">Class :</th>
                                                    <th class="all text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="portlet bordered light bg-grey-cararra">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-clone"></i> Stock Class</span>
                                        </div>
                                        <div class="actions">
                                            <button type="button" class="btn blue btnModal" id="button_master_file_add_stockgroup_class"  title="Add New"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table dt-responsive" id="table_master_stockgroup_class" width="100%">
                                            <thead class="font-dark bg-grey-salt">
                                                <tr>
                                                    <th></th>
                                                    <th class="all text-center">Code</th>
                                                    <th class="all text-center">Description</th>
                                                    <th class="all text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                                
                        </div>
                    </div>
                    <div class="tab-pane" id="master_storage">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-database"></i> Storage</h1>
                                </div>
                            </div>
                        </div>
                        <div class="portlet bordered light bg-grey-cararra">
                            <div class="portlet-title">
                                <div class="actions"> 
                                    <a id="om_add_storage" type="button" class="btn blue" title="Add New Storage"><i class="fa fa-plus"></i> Add New
                                    </a>
                                    <button id="switch_disc_storage" type="button" href="#" class="btn yellow btn-sm" title="Discontinue Storage">
                                        <i class="fa fa-clone"></i>
                                    </button> 
                                    <button id="switch_assign_storage" type="button" href="#" class="btn dark btn-sm" title="Assigned Storage">
                                        <i class="fa fa-refresh"></i>
                                    </button> 
                                </div> 
                            </div>
                            <div class="portlet-body">
                                <table id="mytable_list_storage" class="table table-bordered order-column">
                                    <thead class="font-dark bg-grey-salt">
                                        <tr>
                                            <th class="text-center" data-orderable="false">No</th>
                                            <th class="text-center">Storage Code</th>
                                            <th class="text-center">Storage Name</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">Branch</th>
                                            <th class="text-center">Status</th>
                                            <!-- <th class="text-center">Contact Person</th>
                                            <th class="text-center">Phone Number</th> -->
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="master_stockcode">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-cube"></i> Stockcode</h1>
                                </div>
                            </div>
                        </div>
                        <div class="portlet bordered light bg-grey-cararra">
                            <div class="portlet-title">
                                <div class="actions">
                                    <a href="<?= base_url('APOSMaster/form_add_stockcode')?>" type="button" class="btn blue" title="Add New Stockcode"><i class="fa fa-plus"></i> Add New
                                    </a>
                                    <button id="switch_disc_stockcode" type="button" href="#" class="btn yellow btn-sm" title="InActive Stockcode">InActive
                                        <i class="fa fa-close"></i>
                                    </button> 
                                    <button id="switch_continue_stockcode" type="button" href="#" class="btn dark btn-sm" title="Active Stockcode">Active
                                        <i class="fa fa-check-square-o"></i>
                                    </button> 
                                </div> 
                            </div>
                            <div class="portlet-body">
                                <table id="mytable_list_stock" class="table table-bordered table-hover order-column">
                                    <thead class="font-dark bg-grey-salt">
                                        <tr>
                                            <th width="2%" class="text-center" data-orderable="false">No</th>
                                            <th width=""   class="text-center">Stockcode</th>
                                            <th width=""   class="text-center">Barcode</th>
                                            <th width=""   class="text-center">Stock Name</th>
                                            <!-- <th width=""   class="text-center">Manufacture</th> -->
                                            <th width=""   class="text-center">Model No</th>
                                            <th width=""   class="text-center">UOM</th>
                                            <th width=""   class="text-center">Disc Date</th>
                                            <th width=""   class="text-center">Remarks</th>
                                            <!-- <th width=""   class="text-center">Photo</th> -->
                                            <th width=""   class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="master_supplier">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-user-plus"></i> Supplier</h1>
                                </div>
                            </div>
                        </div>
                        <div class="portlet bordered light bg-grey-cararra">
                            <div class="portlet-title">
                                <div class="tools">
                                    <a href="<?= base_url('APOSMaster/form_add_supplier')?>" title="Add New Supplier" class="pull-right" style="margin-top: -5px">
                                        <button class="btn blue "><i class="fa fa-plus"></i> Add New</button>
                                    </a>  
                                </div> 
                            </div>
                            <div class="portlet-body">
                                <table id="mytable_list_supplier" class="table table-bordered table-hover order-column">
                                    <thead class="font-dark bg-grey-salt">
                                        <tr>
                                            <th width="2%" class="text-center" data-orderable="false">No</th>
                                            <th width=""   class="text-center">Supplier Code</th>
                                            <th width=""   class="text-center">Supplier Name</th>
                                            <th width=""   class="text-center">Contact</th>
                                            <th width=""   class="text-center">Office Phone</th>
                                            <th width=""   class="text-center">Fax</th>
                                            <th width=""   class="text-center">Email</th>
                                            <th width=""   class="text-center">Address</th>
                                            <th width=""   class="text-center" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="master_customer">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-users"></i> Customer</h1>
                                </div>
                            </div>
                        </div>
                        <div class="portlet bordered light bg-grey-cararra">
                            <div class="portlet-title">
                                <div class="tools">
                                    <a href="<?= base_url('APOSMaster/form_add_customer')?>" title="Add New Customer" class="pull-right" style="margin-top: -5px">
                                        <button class="btn blue "><i class="fa fa-plus"></i> Add New</button>
                                    </a>  
                                </div> 
                            </div>
                            <div class="portlet-body">
                                <table id="mytable_list_customer" class="table table-bordered table-hover order-column">
                                    <thead class="font-dark bg-grey-salt">
                                        <tr>
                                            <th class="text-center" data-orderable="false">No</th>                          
                                            <th class="text-center">Customer Code</th>
                                            <th class="text-center">Customer Name</th>                                        
                                            <th class="text-center">Phone </th>
                                            <th class="text-center" width="30%">Address</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="master_uom">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-asterisk"></i> Unit of Material</h1>
                                </div>
                            </div>
                        </div>
                        <div class="portlet bordered light bg-grey-cararra">
                            <div class="portlet-title">
                                <div class="tools">
                                    <a href="#" title="Add New UOM" class="pull-right" style="margin-top: -5px">
                                        <button class="btn blue" id="om_add_uom"><i class="fa fa-plus"></i> Add New</button>
                                    </a>
                                </div> 
                            </div>
                            <div class="portlet-body">
                                <table id="mytable_list_uom" class="table table-bordered table-hover order-column">
                                    <thead class="font-dark bg-grey-salt">
                                        <tr>
                                            <th class="text-center" data-orderable="false">No</th>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>Disc</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="master_customer_type_price">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-money"></i> Customer Price</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="portlet bordered light bg-grey-cararra">
                                    <div class="portlet-title">
                                        <div class="actions">
                                            <button type="button" class="btn blue btnModal" id="button_add_master_custtype_price"  title="Add New"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table dt-responsive" id="table_master_custype_price" width="100%">
                                            <thead class="font-dark bg-grey-salt">
                                                <tr>
                                                    <th></th>
                                                    <th class="all text-center">Code</th>
                                                    <th class="all text-center">Description</th>
                                                    <th class="all text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <!-- FINANCE -->
                    <div class="tab-pane" id="master_coa">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-money"></i> Chart of Account</h1>
                                </div>
                            </div>
                        </div>
                        <div class="portlet bordered light bg-grey-cararra">
                            <!--  <div class="portlet-title">
                                <div class="tools">
                                    <a href="#" title="Add New Chart of Account" class="pull-right" style="margin-top: -5px">
                                        <button class="btn blue" id="om_add_coa"><i class="fa fa-plus"></i> Chart of Account</button>
                                    </a>
                                </div> 
                            </div> -->
                            <div class="portlet-body">
                                <div class="portlet-body">
                                    <div class="tabbable-custom ">
                                        <ul class="nav nav-tabs" style="border-style: dotted; border-width: 1px">
                                            <li class="active bold">
                                                <a href="#aktiva" data-toggle="tab" aria-expanded="true"> Aktiva </a>
                                            </li>
                                            <li class="bold">
                                                <a href="#kewajiban" data-toggle="tab" aria-expanded="false"> Kewajiban </a>
                                            </li>
                                            <li class="bold">
                                                <a href="#kewajiban" data-toggle="tab" aria-expanded="false"> Modal </a>
                                            </li>
                                            <li class="bold">
                                                <a href="#kewajiban" data-toggle="tab" aria-expanded="false"> Pendapatan </a>
                                            </li>
                                            <li class="bold">
                                                <a href="#kewajiban" data-toggle="tab" aria-expanded="false"> HPP </a>
                                            </li>
                                            <li class="bold">
                                                <a href="#kewajiban" data-toggle="tab" aria-expanded="false"> Biaya </a>
                                            </li>
                                            <li class="bold">
                                                <a href="#kewajiban" data-toggle="tab" aria-expanded="false"> Pendapatan Lain-lain </a>
                                            </li>
                                            <li class="bold">
                                                <a href="#kewajiban" data-toggle="tab" aria-expanded="false"> Biaya Lain </a>
                                            </li>
                                            <li class="bold">
                                                <a href="#kewajiban" data-toggle="tab" aria-expanded="false"> Semua Akun </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="aktiva">
                                                <!-- <table id="mytable_list_coa" class="table table-bordered table-hover"> -->
                                                <table class="table table-bordered table-hover">
                                                    <thead class="font-dark bg-grey-salt">
                                                        <tr>
                                                            <td class="bold font-dark" width="20%" align="center" colspan="4">Account No</td>
                                                            <td class="bold font-dark" width="40%" align="center">Account Name</td>
                                                            <td class="bold font-dark" width="20%" align="center">Type</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="master_currency">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-money"></i> Currency</h1>
                                </div>
                            </div>
                        </div>
                        <div class="portlet bordered light bg-grey-cararra">
                            <div class="portlet-title">
                                <div class="tools">
                                    <a href="#" title="Add New Currency" class="pull-right" style="margin-top: -5px">
                                        <button class="btn blue" id="om_add_currency"><i class="fa fa-plus"></i> Currency</button>
                                    </a>
                                </div> 
                            </div>
                            <div class="portlet-body">
                                <table id="mytable_list_currency" class="table table-bordered table-hover order-column">
                                    <thead class="font-dark bg-grey-salt">
                                        <tr>
                                            <th class="text-center" data-orderable="false">No</th>
                                            <th>Currency</th>
                                            <th>Currency Name</th>
                                            <th>Disc</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- SETTING -->
                    <div class="tab-pane" id="master_user_management">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet light bg-grey-cararra">
                                    <h1 class="uppercase bold"><i class="fa fa-users"></i> Users & Privileges</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet bordered light bg-grey-cararra">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-clone"></i> All Users</span>
                                        </div>
                                        <div class="actions">
                                            <button type="button" class="btn blue btnModal" id="button_add_master_users"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table dt-responsive table-bordered" id="table_master_users" width="100%">
                                            <thead class="font-dark bg-grey-salt">
                                                <tr>
                                                    <th></th>
                                                    <th class="all text-center">IDNumber</th>
                                                    <th class="all text-center">Username</th>
                                                    <th class="all text-center">User Level</th>
                                                    <th class="all text-center">Last Login</th>
                                                    <th class="all text-center">Status</th>
                                                    <th class="all text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGE BASE CONTENT -->
            </div>
        </div>
    </div>
    <!-- END SIDEBAR CONTENT LAYOUT -->
</div>

<!-- MODALS -->
<div id="m_add_storage" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Add Storage</h4>
            </div>
            <div class="modal-body">
                <form id="f_add_storage" class="form-horizontal" role="form" autocomplete="off">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Branch
                                    </label>
                                    <div class="col-md-9">
                                        <select id="i_branch" name="n_branch" class="form-control" required>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Code
                                    </label>
                                    <div class="col-md-9">
                                        <input id="h_storagecode" type="hidden" value="<?php echo $storagecode; ?>">
                                        <input name="n_storagecode" type="text" class="form-control input-inline input-medium" placeholder="Enter Storage Code" readonly required>
                                        <span class="help-inline">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" name="i_check_storagecode">
                                                <span></span>
                                            </label>
                                            <a href="#" title="check this box if you set the code"><i class="fa fa-info-circle"></i></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><font color="red">*</font> Name</label>
                                    <div class="col-md-9">
                                        <input name="n_storagename" type="text" class="form-control" placeholder="Enter Storage Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        Address
                                    </label>
                                    <div class="col-md-9">
                                        <textarea name="n_address" rows="5" class="form-control" placeholder="Enter Storage Address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Contact
                                    </label>
                                    <div class="col-md-8">
                                        <select id="i_warehouseman" name="n_warehouseman" class="form-control" required>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Phone No.
                                    </label>
                                    <div class="col-md-8">
                                        <input name="n_phoneno" type="text" class="form-control" placeholder="Warehouseman Phone Number" readonly required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Fax</label>
                                    <div class="col-md-8">
                                        <input name="n_fax" type="text" class="form-control" placeholder="Warehouseman Fax Number" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Email
                                    </label>
                                    <div class="col-md-8">
                                        <input name="n_email" type="text" class="form-control" placeholder="Warehouseman Email" readonly required>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        Contact
                                    </label>
                                    <div class="col-md-8">
                                        <input id="i_warehouseman" name="n_warehouseman" type="text" class="form-control" placeholder="Warehouseman">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        Phone No.
                                    </label>
                                    <div class="col-md-8">
                                        <input name="n_phoneno" type="text" class="form-control" placeholder="Warehouseman Phone Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Fax</label>
                                    <div class="col-md-8">
                                        <input name="n_fax" type="text" class="form-control" placeholder="Warehouseman Fax Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        Email
                                    </label>
                                    <div class="col-md-8">
                                        <input name="n_email" type="text" class="form-control" placeholder="Warehouseman Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn yellow btn-outline reset-form" data-dismiss="modal">Close</button>
                <button form="f_add_storage" type="submit" class="btn green">Submit</button>
            </div>
        </div>
    </div>
</div>
<div id="m_detail_storage" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eef1f5">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-search"></i> Detail Storage</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="28%" style="border-top: none;"> Storage Code </td>
                                        <td width="1%" style="border-top: none;"> : </td>
                                        <td class="bold" id="storage_detail_1" style="border-top: none;">-</td>
                                    </tr>
                                    <tr>
                                        <td width="28%"> Storage Name </td>
                                        <td width="1%"> : </td>
                                        <td id="storage_detail_2">-</td>
                                    </tr>
                                    <tr>
                                        <td width="28%"> Branch </td>
                                        <td width="1%"> : </td>
                                        <td id="storage_detail_3">-</td>
                                    </tr>
                                    <tr>
                                        <td width="28%"> Address </td>
                                        <td width="1%"> : </td>
                                        <td id="storage_detail_4"></td>
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
                                        <td width="28%" style="border-top: none;"> Contact </td>
                                        <td width="1%" style="border-top: none;"> : </td>
                                        <td class="bold" id="storage_detail_5" style="border-top: none;"></td>
                                    </tr>
                                    <tr>
                                        <td width="28%"> Phone No. </td>
                                        <td width="1%"> : </td>
                                        <td id="storage_detail_6">-</td>
                                    </tr>
                                    <tr>
                                        <td width="28%"> Fax </td>
                                        <td width="1%"> : </td>
                                        <td id="storage_detail_7">-</td>
                                    </tr>
                                    <tr>
                                        <td width="28%"> Email </td>
                                        <td width="1%"> : </td>
                                        <td id="storage_detail_8">-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="border-top: none;"> Register By </td>
                                        <td width="1%" style="border-top: none;"> : </td>
                                        <td width="50%" class="bold" id="storage_detail_9" style="border-top: none;">-</td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: none;"> Register Date </td>
                                        <td width="1%" style="border-top: none;"> : </td>
                                        <td width="50%" class="bold" id="storage_detail_10" style="border-top: none;">-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn yellow btn-outline reset-form" data-dismiss="modal">Close</button>
               <!--  <button type="submit" class="btn green">Submit</button> -->
            </div>
        </div>
    </div>
</div>
<div id="m_edit_storage" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Storage</h4>
            </div>
            <div class="modal-body">
                <form id="f_edit_storage" class="form-horizontal" role="form" autocomplete="off">
                    <input type="hidden" name="id_storagecode">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                         Branch
                                    </label>
                                    <div class="col-md-9">
                                        <select id="ei_branch" name="en_branch" class="form-control" required>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                         Code
                                    </label>
                                    <div class="col-md-9">
                                        <input name="en_storagecode" type="text" class="form-control input-inline input-medium" placeholder="Enter Storage Code" readonly required>
                                        <span class="help-inline">
                                            <!-- <button type="button" class="btn btn-outline yellow btn-xs" title="Edit Storage Code"><i class="fa fa-edit"></i></button>
                                            &nbsp; --><a href="#" title="Code can't be edit"><i class="fa fa-info-circle"></i></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Name</label>
                                    <div class="col-md-9">
                                        <input name="en_storagename" type="text" class="form-control" placeholder="Enter Storage Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                         Address
                                    </label>
                                    <div class="col-md-9">
                                        <textarea name="en_address" rows="5" class="form-control" placeholder="Enter Storage Address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                         Contact
                                    </label>
                                    <div class="col-md-8">
                                        <select id="ei_warehouseman" name="en_warehouseman" class="form-control" required>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                         Phone No.
                                    </label>
                                    <div class="col-md-8">
                                        <input name="en_phoneno" type="text" class="form-control" placeholder="Warehouseman Phone Number" readonly required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Fax</label>
                                    <div class="col-md-8">
                                        <input name="en_fax" type="text" class="form-control" placeholder="Warehouseman Fax Number" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                         Email
                                    </label>
                                    <div class="col-md-8">
                                        <input name="en_email" type="text" class="form-control" placeholder="Warehouseman Email" readonly required>
                                    </div>
                                </div><hr>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                         Status
                                    </label>
                                    <div class="col-md-8">
                                        <select id="en_status" name="en_status" class="form-control">
                                        </select> 
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                         Contact
                                    </label>
                                    <div class="col-md-8">
                                        <input id="ei_warehouseman" name="en_warehouseman" type="text" class="form-control" placeholder="Warehouseman Phone Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                         Phone No.
                                    </label>
                                    <div class="col-md-8">
                                        <input name="en_phoneno" type="text" class="form-control" placeholder="Warehouseman Phone Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Fax</label>
                                    <div class="col-md-8">
                                        <input name="en_fax" type="text" class="form-control" placeholder="Warehouseman Fax Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                         Email
                                    </label>
                                    <div class="col-md-8">
                                        <input name="en_email" type="text" class="form-control" placeholder="Warehouseman Email">
                                    </div>
                                </div><hr>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                         Status
                                    </label>
                                    <div class="col-md-8">
                                        <select id="en_status" name="en_status" class="form-control">
                                        </select> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn yellow btn-outline reset-form" data-dismiss="modal">Close</button>
                <button type="submit" form="f_edit_storage" class="btn blue">Save</button>
            </div>
        </div>
    </div>
</div>
<div id="m_add_coa" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-search"></i> Add Chart Of Account</h4>
            </div>
            <div class="modal-body">
                <form id="f_add_coa" class="form-horizontal" role="form" autocomplete="off">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Acc No
                                    </label>
                                    <div class="col-md-4">
                                        <input name="acc_no" type="text" class="form-control" placeholder="Enter Account No" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Acc Name
                                    </label>
                                    <div class="col-md-6">
                                        <input name="acc_name" type="text" class="form-control" placeholder="Enter Account Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Acc Name Eng</label>
                                    <div class="col-md-6">
                                        <input name="acc_name_eng" type="text" class="form-control" placeholder="Enter Account Name English">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Acc Group
                                    </label>
                                    <div class="col-md-6">
                                        <select id="acc_group" name="acc_group" class="form-control" required>
                                            <?php if ($accg != false) { ?>
                                                <?php foreach ($accg as $ag) { ?>
                                                    <option value="<?php echo $ag->AccGroup; ?>"><?php echo $ag->AccGroup; ?> - <?php echo $ag->AccGroupDes; ?></option>
                                                <?php }?>
                                            <?php } else { ?>
                                                <option value=""><font color="red">No Data Category</font></option>
                                            <?php } ?>
                                        </select>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Acc Fiscal</label>
                                    <div class="col-md-6">
                                        <input name="acc_fiscal" type="text" class="form-control" placeholder="Enter Account Fiscal">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Disc
                                    </label>
                                    <div class="col-md-2">
                                        <select name="n_disc" class="form-control" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Cash Bank
                                    </label>
                                    <div class="col-md-2">
                                        <select name="cash_bank" class="form-control" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> H1
                                    </label>
                                    <div class="col-md-2">
                                        <select name="h1" class="form-control" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Cash Advance
                                    </label>
                                    <div class="col-md-2">
                                        <select name="cash_advance" class="form-control" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> H2
                                    </label>
                                    <div class="col-md-2">
                                        <select name="h2" class="form-control" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Revenue
                                    </label>
                                    <div class="col-md-2">
                                        <select name="revenue" class="form-control" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> H3
                                    </label>
                                    <div class="col-md-2">
                                        <select name="h3" class="form-control" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Budget
                                    </label>
                                    <div class="col-md-2">
                                        <select name="budget" class="form-control" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn yellow btn-outline reset-form" data-dismiss="modal">Close</button>
                <button form="f_add_coa" type="submit" class="btn green">Submit</button>
            </div>
        </div>
    </div>
</div>
<div id="m_add_currency" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-search"></i> Add Currency</h4>
            </div>
            <div class="modal-body">
                <form id="f_add_currency" class="form-horizontal" role="form" autocomplete="off">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Currency
                                    </label>
                                    <div class="col-md-4">
                                        <input name="n_cur" type="text" class="form-control" placeholder="Enter Currency Code" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Currency Name
                                    </label>
                                    <div class="col-md-6">
                                        <input name="n_curname" type="text" class="form-control" placeholder="Enter Currency Name" required>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Disc
                                    </label>
                                    <div class="col-md-2">
                                        <select name="n_disc" class="form-control" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Remarks</label>
                                    <div class="col-md-8">
                                        <input name="n_remarks" type="text" class="form-control" placeholder="Enter Remarks">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn yellow btn-outline reset-form" data-dismiss="modal">Close</button>
                <button form="f_add_currency" type="submit" class="btn green">Submit</button>
            </div>
        </div>
    </div>
</div>
<div id="m_edit_currency" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Currency</h4>
            </div>
            <div class="modal-body">
                <form id="f_edit_currency" class="form-horizontal" role="form" autocomplete="off">
                    <input type="hidden" name="id_accno">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Currency</label>
                                    <div class="col-md-4">
                                        <input name="currency" type="text" class="form-control" placeholder="Enter Currency">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Currency Name</label>
                                    <div class="col-md-6">
                                        <input name="currencyname" type="text" class="form-control" placeholder="Enter Currency Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Disc
                                    </label>
                                    <div class="col-md-2">
                                        <select id="i_disc" name="ei_disc" class="form-control" required>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Remarks</label>
                                    <div class="col-md-8">
                                        <input name="remarks" type="text" class="form-control" placeholder="Enter Remarks">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn yellow btn-outline reset-form" data-dismiss="modal">Close</button>
                <button type="submit" form="f_edit_currency" class="btn blue">Save</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('financecorp/master/v_modal_master_crud'); ?> 
<?php $this->load->view('financecorp/header_footer/master/footer'); ?>