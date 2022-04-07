<?php $this->load->view('financecorp/header_footer/header_main'); ?>
<style type="text/css">
    .td-color_raiseddate {
        color: #3598dc;
    }

    .td-color_duedate {
        color: red;
    }

    #col_box {
        width: 25%;
    }

/*    @media only screen and (max-width: 900px) {
        #col_box {
            width: 100%;
        }
    }*/
</style>
<div class="main_content">
    <div class="row">
        <div class="col-md-12">
            <marquee><h1 class="text-center bold uppercase" style="margin-top: -5px">Automation Based Resource System</h1></marquee>
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-sidebar">
                        <div class="portlet light profile-sidebar-portlet" style="height: 445px">
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
        </div>
    </div>
</div>
<!-- <script type="text/javascript">
    
</script> -->
<?php $this->load->view('financecorp/header_footer/footer_main'); ?>