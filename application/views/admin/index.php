<?php $this->load->view('admin/navbar/adm_navbar'); ?>

<div class="modal fade degree_opt" tabindex="-1" role="basic" aria-hidden="true" style="display: none; padding-right: 17px;">
    <div class="modal-dialog modal-full" style="width: 95%">
        <div class="modal-content">
            <div class="mt-element-ribbon bg-grey-steel" style="margin-bottom: 0;">
                <div class="ribbon ribbon-right ribbon-shadow uppercase" style="color: white"></div>
                <div class="ribbon-content" style="padding-top: 5px">
                    <div class="form-group form-md-radios">
                        <h4> Degree State: </h4>
                        <div class="md-radio-inline">
                            <div class="md-radio-inline">
                                <div class="md-radio">
                                    <input type="radio" id="active" name="toggle_degree" class="md-radiobtn">
                                    <label for="active">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> Activated </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="deactive" name="toggle_degree" class="md-radiobtn" checked="">
                                    <label for="deactive">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> Deactivated </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portlet light bordered" style="background-color: #e9edef">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Manage School</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <!-- <li class="">
                                    <a href="#school_details" data-toggle="tab" aria-expanded="true">School Detail</a>
                                </li> -->
                                <li class="active">
                                    <a href="#manage_class" data-toggle="tab" aria-expanded="false">Class Management</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- <div class="tab-pane" id="school_details">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="portlet light about-text">
                                                <h4>SMA ADVENT KLABAT</h4>
                                                <div class="about-quote">
                                                    <h3>ABOUT</h3>
                                                </div>
                                                <p class="margin-top-20">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore consectetur quasi corrupti fuga quas distinctio dignissimos, saepe laboriosam autem molestiae, aliquam dolores? Omnis cumque sequi culpa sed aspernatur necessitatibus suscipit facere blanditiis repudiandae repellendus asperiores rem sit autem fugit magni incidunt quia, facilis assumenda. Numquam quam voluptatum nam ab. Commodi?
                                                </p>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <ul class="list-unstyled margin-top-10 margin-bottom-10">
                                                            <li>
                                                                <i class="fa fa-check"></i> Nam liber tempor cum soluta </li>
                                                            <li>
                                                                <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                            <li>
                                                                <i class="fa fa-check"></i> Lorem ipsum dolor sit amet </li>
                                                            <li>
                                                                <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                            <li>
                                                                <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <ul class="list-unstyled margin-top-10 margin-bottom-10">
                                                            <li>
                                                                <i class="fa fa-check"></i> Nam liber tempor cum soluta </li>
                                                            <li>
                                                                <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                            <li>
                                                                <i class="fa fa-check"></i> Lorem ipsum dolor sit amet </li>
                                                            <li>
                                                                <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                            <li>
                                                                <i class="fa fa-check"></i> Mirum est notare quam </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-element-card mt-element-overlay">
                                                <div class="row">
                                                    <div class="col-lg-11">
                                                        <div class="mt-card-item">
                                                            <div class="mt-card-avatar mt-scroll-left mt-overlay-1">
                                                                <img src="<?= base_url('assets/photos/noimage.gif'); ?>">
                                                                <div class="mt-overlay mt-top">
                                                                    <ul class="mt-info">
                                                                        <li>
                                                                            <input class="upload_sch_img" type="file" name="schimg" style="display: none">
                                                                            <a class="btn default btn-outline upload_ico">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-20">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="portlet light">
                                                <div class="card-icon text-center margin-bottom-5">
                                                    <i class="icon-user-follow font-red-sunglo theme-font"></i>
                                                </div>
                                                <div class="card-title text-center margin-bottom-10">
                                                    <span class="sbold"> VISION </span>
                                                </div>
                                                <div class="card-desc text-center">
                                                    <span> The best way to find yourself is
                                                        <br> to lose yourself in the service of others </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="portlet light">
                                                <div class="card-icon text-center margin-bottom-5">
                                                    <i class="icon-trophy font-green-haze theme-font"></i>
                                                </div>
                                                <div class="card-title text-center margin-bottom-10">
                                                    <span class="sbold"> MISSION </span>
                                                </div>
                                                <div class="card-desc text-center">
                                                    <span> The best way to find yourself is
                                                        <br> to lose yourself in the service of others </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="portlet light">
                                                <div class="card-icon text-center margin-bottom-5">
                                                    <i class="icon-basket font-purple-wisteria theme-font"></i>
                                                </div>
                                                <div class="card-title text-center margin-bottom-10">
                                                    <span class="sbold"> MOTTO </span>
                                                </div>
                                                <div class="card-desc text-center">
                                                    <span> The best way to find yourself is
                                                        <br> to lose yourself in the service of others </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="tab-pane active" id="manage_class">
                                    <div class="row">
                                        <div class="table-scrollable table-responsive">
                                            <table class="table table-bordered" style="background-color: #e9edef">
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
</div>

<div class="container-fluid dashboard_pg">
    <div class="page-content">
        <div class="page-content-wrapper">
            <div class="row" class="degrees">
                <div class="col-md-3">
                    <button type="button" class="btn red sbold btn-lg uppercase toggle_sd" data-degree="SD" style="width: 100%; height: 75px;"> <span> Elementary </span> </button>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn blue-steel sbold btn-lg uppercase toggle_smp" data-degree="SMP" style="width: 100%; height: 75px;"> <span> Junior High </span> </button>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn grey-silver sbold btn-lg uppercase toggle_sma" data-degree="SMA" style="width: 100%; height: 75px;"> <span> High </span> </button>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn dark red-haze btn-lg uppercase toggle_smk" data-degree="SMK" style="width: 100%; height: 75px;"> <span> Vocational High </span> </button>
                </div>
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 red" href="<?= base_url('Admin/load_prof_std_edit'); ?>">
                        <div class="visual">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?= $std; ?>"></span>
                            </div>
                            <br>
                            <div class="desc"> STUDENTS </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 blue" href="<?= base_url('Admin/load_prof_tch_edit'); ?>">
                        <div class="visual">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?= $tch; ?>"></span>
                            </div>
                            <br>
                            <div class="desc"> TEACHERS </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="<?= base_url('Admin/load_prof_tch_edit'); ?>">
                        <div class="visual">
                            <i class="fa fa-list-alt"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?= $stf; ?>"></span>
                            </div>
                            <br>
                            <div class="desc"> STAFFS </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                        <div class="visual">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?= $count; ?>"></span>
                            </div>
                            <br>
                            <div class="desc"> Total </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">ACTIVE USER</h4>
                        <div class="widget-thumb-wrap">
                            <img class="widget-thumb-icon" src="<?= base_url('assets/photos/adm/' . $photo) ?>" alt="" style="padding: 1px">
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">
                                    <h4><?= "$fname $lname" ?></h4>
                                </span>
                                <span class="widget-thumb-subtitle"><?= $status ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="portlet light bordered" style="height: 530px">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase">News & Events</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group">
                                    <a class="btn btn-sm blue btn-outline btn-circle" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filter By
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" /> Finance
                                            <span></span>
                                        </label>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" checked="" /> Membership
                                            <span></span>
                                        </label>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" /> Customer Support
                                            <span></span>
                                        </label>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" checked="" /> HR
                                            <span></span>
                                        </label>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" /> System
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="scroller" style="height: 347px;" data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-info">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> You have 4 pending tasks.
                                                        <span class="label label-sm label-warning "> Take action
                                                            <i class="fa fa-share"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> Just now </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-success">
                                                            <i class="fa fa-bar-chart-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> Finance Report for year 2013 has been released. </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 20 mins </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-danger">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 24 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-info">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received with
                                                        <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 30 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-success">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 24 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-default">
                                                        <i class="fa fa-bell-o"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> Web server hardware needs to be upgraded.
                                                        <span class="label label-sm label-default "> Overdue </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 2 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                            <i class="fa fa-briefcase"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> IPO Report for year 2013 has been released. </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 20 mins </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-info">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> You have 4 pending tasks.
                                                        <span class="label label-sm label-warning "> Take action
                                                            <i class="fa fa-share"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> Just now </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-danger">
                                                            <i class="fa fa-bar-chart-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> Finance Report for year 2013 has been released. </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 20 mins </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-default">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 24 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-info">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received with
                                                        <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 30 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-success">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 24 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-warning">
                                                        <i class="fa fa-bell-o"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> Web server hardware needs to be upgraded.
                                                        <span class="label label-sm label-default "> Overdue </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 2 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-briefcase"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> IPO Report for year 2013 has been released. </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 20 mins </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="scroller-footer">
                                <div class="btn-arrow-link pull-right">
                                    <a href="javascript:;">See All Records</a>
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="portlet light calendar bordered">
                        <div class="portlet-title ">
                            <div class="caption">
                                <i class="icon-calendar font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase">Calendar</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bar-chart font-green-haze"></i>
                                <span class="caption-subject bold uppercase font-green-haze"> STUDENTS BASED ON ROOMS</span>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                                <a href="javascript:;" class="reload"> </a>
                                <a href="javascript:;" class="fullscreen"> </a>
                                <!-- <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                <a href="javascript:;" class="remove"> </a> -->
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="chart_7" class="chart" style="height: 340px;"> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bar-chart font-green-haze"></i>
                                <span class="caption-subject bold uppercase font-green-haze"> TOTAL STUDENT PER SEMESTER</span>
                                <span class="caption-helper">column and line mix</span>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                                <a href="javascript:;" class="reload"> </a>
                                <a href="javascript:;" class="fullscreen"> </a>
                                <!-- <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                <a href="javascript:;" class="remove"> </a> -->
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="chart_1" class="chart" style="height: 340px;"> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Leader board</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue icon-user"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">
                                    <h4>TEST</h4>
                                </span>
                                <span class="widget-thumb-subtitle">Test Message</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Leader board</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue icon-user"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">
                                    <h4>TEST</h4>
                                </span>
                                <span class="widget-thumb-subtitle">Test Message</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Leader board</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue icon-user"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">
                                    <h4>TEST</h4>
                                </span>
                                <span class="widget-thumb-subtitle">Test Message</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Leader board</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue icon-user"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">
                                    <h4>TEST</h4>
                                </span>
                                <span class="widget-thumb-subtitle">Test Message</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Leader board</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue icon-user"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">
                                    <h4>TEST</h4>
                                </span>
                                <span class="widget-thumb-subtitle">Test Message</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Leader board</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue icon-user"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">
                                    <h4>TEST</h4>
                                </span>
                                <span class="widget-thumb-subtitle">Test Message</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Leader board</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue icon-user"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">
                                    <h4>TEST</h4>
                                </span>
                                <span class="widget-thumb-subtitle">Test Message</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">Leader board</h4>
                        <div class="widget-thumb-wrap">
                            <i class="widget-thumb-icon bg-blue icon-user"></i>
                            <div class="widget-thumb-body">
                                <span class="widget-thumb-subtitle">
                                    <h4>TEST</h4>
                                </span>
                                <span class="widget-thumb-subtitle">Test Message</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('_partials/_foot'); ?>