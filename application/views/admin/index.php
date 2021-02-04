<?php $this->load->view('admin/navbar/adm_navbar'); ?>
<style>
#font-count-total {
    font-size: 28px;
}

#font-button{
    font-size: 16px;
}
</style>
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

<div class="modal fade" id="calendar_action" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" name="calendarradio" value="delete" checked> Delete
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="calendarradio" value="change"> Change
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="eventchange" hidden>
                        <div class="form-group col-md-12">
                            <input id="eventchange_title" name="eventchange_date_start" class="form-control input-md" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <input id="eventchange_date_start" name="eventchange_date_start" class="form-control input-md" type="date">
                        </div>
                        <div class="col-md-1" style="padding-left: 0px; padding-right: 0px; width: auto;">To</div>
                        <div class="col-md-5">
                            <input id="eventchange_date_end" name="eventchange_date_end" class="form-control input-md" type="date">
                        </div>
                        <div class="form-group col-md-12">
                            <select class="form-control input-md" name="eventchange_color" id="eventchange_color">
                                <option value="#E7505A">Red</option>
                                <option value="#4B77BE">Blue</option>
                                <option value="#26C281">Green</option>
                                <option value="#95A5A6">Grey</option>
                                <option value="#F7CA18">Yellow</option>
                                <option value="#8E44AD">Purple</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="submitcalendarchange" type="button" class="btn green">Save changes</button>
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid dashboard_pg">
    <div class="page-content">
        <div class="page-content-wrapper">
            <div class="portlet light bg-grey-steel" style="margin-top: -20px">
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
                <div class="row" style="margin-top: 15px;">
                    <!--  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
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
                    </div> -->
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-style: dotted; border-width: 2px; border-color: #e9ecf3;">
                            <a href="#">
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-blue-dark fa fa-users"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle desc">STUDENTS</span>
                                        <span class="widget-thumb-body-stat" id="font-count-total" data-counter="counterup" data-value="<?= $std; ?>"></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
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
                    </div> -->
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-style: dotted; border-width: 2px; border-color: #e9ecf3;">
                            <a href="#">
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-blue-sharp fa fa-graduation-cap"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle desc">TEACHERS</span>
                                        <span class="widget-thumb-body-stat" id="font-count-total" data-counter="counterup" data-value="<?= $tch; ?>"></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
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
                    </div> -->
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-style: dotted; border-width: 2px; border-color: #e9ecf3;">
                            <a href="#">
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-green fa fa-male"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle desc">STAFFS</span>
                                        <span class="widget-thumb-body-stat" id="font-count-total" data-counter="counterup" data-value="<?= $stf; ?>"></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
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
                    </div> -->
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 " style="border-style: dotted; border-width: 2px; border-color: #e9ecf3;">
                            <a href="#">
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-blue-ebonyclay fa fa-check"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle desc">Total</span>
                                        <span class="widget-thumb-body-stat" id="font-count-total" data-counter="counterup" data-value="<?= $count; ?>"></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered" style="background-color: #f6f6f6">
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
                                <span class="caption-subject font-dark bold uppercase">News & Assigments</span>
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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="portlet">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i> Input Event(s) </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <form class="form-horizontal" role="form">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Title</label>
                                                        <div class="col-md-9">
                                                            <input id="event_title" name="event_title" type="text" class="form-control input-md" placeholder="Event's title"> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Date Start</label>
                                                        <div class="col-md-9">
                                                            <input id="event_date_start" name="event_date_start" class="form-control input-md" type="date" value="<?= date('Y/m/d')?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Date End</label>
                                                        <div class="col-md-9">
                                                            <input id="event_date_end" name="event_date_end" class="form-control input-md" type="date" value="<?= date('Y/m/d')?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Label</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control input-md" name="event_color" id="event_color">
                                                                <option value="#E7505A">Red</option>
                                                                <option value="#4B77BE">Blue</option>
                                                                <option value="#26C281">Green</option>
                                                                <option value="#95A5A6">Grey</option>
                                                                <option value="#F7CA18">Yellow</option>
                                                                <option value="#8E44AD">Purple</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions right1">
                                                    <button id="submit_calendar" type="submit" class="btn green">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id="calendar"></div>
                                </div>
                            
                            </div>
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
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-purple-soft bold uppercase">Monthy Report</span>
                        </div>
                        <div class="actions">
                            <?php foreach($degree_active as $degree) : ?>
                                <a href="<?= base_url('Admin/export_closing_report?degree=' . $degree->School_Desc)?>" class="btn grey-cascade"> 
                                    <i class="fa fa-file-excel-o"></i>
                                    Export Closing Report <?= $degree->School_Desc ?> - <?= date('Y')?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#report_monthly" data-toggle="tab" aria-expanded="true"> Monthly </a>
                            </li>
                            <li class="">
                                <a href="#report_student" data-toggle="tab" aria-expanded="false"> Student </a>
                            </li>
                            <li class="">
                                <a href="#report_teacher" data-toggle="tab" aria-expanded="false"> Teacher </a>
                            </li>
                            <li class="">
                                <a href="#report_nonteacher" data-toggle="tab" aria-expanded="false"> Non-Teacher </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="report_monthly">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject font-dark sbold uppercase">LAPORAN BULANAN TAHUN PELAJARAN <?= $this->session->userdata('period') ?> - <?= date('F Y')?></span>
                                        </div>
                                        <div class="actions">
                                            <a class="btn btn-circle btn-icon-only btn-default" href="">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-default" href="<?= base_url('Admin/export_labul'); ?>">
                                                <i class="fa fa-file-excel-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">Nama Sekolah</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="SchoolName" type="text" class="form-control" value="<?= $report_input->SchoolName?>">
                                                            <span class="input-group-btn">
                                                                <button name="SchoolName" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 sbold">Alamat Sekolah</label>
                                                    <label class="col-md-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="Address" type="text" class="form-control" value="<?= $report_input->Address?>">
                                                            <span class="input-group-btn">
                                                                <button name="Address" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kecamatan</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="District" type="text" class="form-control" value="<?= $report_input->District?>">
                                                            <span class="input-group-btn">
                                                                <button name="District" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kota/Kabupaten</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="Region" type="text" class="form-control" value="<?= $report_input->Region?>">
                                                            <span class="input-group-btn">
                                                                <button name="Region" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">Provinsi</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="Province" type="text" class="form-control" value="<?= $report_input->Province?>">
                                                            <span class="input-group-btn">
                                                                <button name="Province" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">NSS/NSPN</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="NSS_NSPN" type="text" class="form-control" value="<?= $report_input->NSS_NSPN?>">
                                                            <span class="input-group-btn">
                                                                <button name="NSS_NSPN" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">No.Telp Sekolah</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="Phone" type="text" class="form-control" value="<?= $report_input->Phone?>">
                                                            <span class="input-group-btn">
                                                                <button name="Phone" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">Email Sekolah</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="Email" type="text" class="form-control" value="<?= $report_input->Email?>">
                                                            <span class="input-group-btn">
                                                                <button name="Email" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">No. Kode Pos</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="PostCode" type="text" class="form-control" value="<?= $report_input->PostCode?>">
                                                            <span class="input-group-btn">
                                                                <button name="PostCode" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 sbold">Jenjang Akreditasi Sekolah</label>
                                                    <label class="col-md-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pemerintah</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="GovtCertificate" type="text" class="form-control" value="<?= $report_input->GovtCertificate?>">
                                                            <span class="input-group-btn">
                                                                <button name="GovtCertificate" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yayasan/Organisasi</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="BoardCertificate" type="text" class="form-control" value="<?= $report_input->BoardCertificate?>">
                                                            <span class="input-group-btn">
                                                                <button name="BoardCertificate" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">Bentuk Gedung Sekolah</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="BuildingType" type="text" class="form-control" value="<?= $report_input->BuildingType?>">
                                                            <span class="input-group-btn">
                                                                <button name="BuildingType" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 sbold">Status Kepemilikan</label>
                                                    <label class="col-md-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanah</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="LandOwnership" type="text" class="form-control" value="<?= $report_input->LandOwnership?>">
                                                            <span class="input-group-btn">
                                                                <button name="LandOwnership" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Akte No. (Jika Milik Sendiri)</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="SchoolConstructionCertificate" type="text" class="form-control" value="<?= $report_input->SchoolConstructionCertificate?>">
                                                            <span class="input-group-btn">
                                                                <button name="SchoolConstructionCertificate" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gedung Sekolah</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="BuildingOwnership" type="text" class="form-control" value="<?= $report_input->BuildingOwnership?>">
                                                            <span class="input-group-btn">
                                                                <button name="BuildingOwnership" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">Nama Badan Penyelenggara</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="FoundationName" type="text" class="form-control" value="<?= $report_input->FoundationName?>">
                                                            <span class="input-group-btn">
                                                                <button name="FoundationName" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">Waktu Penyelenggaraan</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="ConferenceTime" type="text" class="form-control" value="<?= $report_input->ConferenceTime?>">
                                                            <span class="input-group-btn">
                                                                <button name="ConferenceZone" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">Jumlah Hari Efektif Sekolah</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="SchoolActiveDays" type="text" class="form-control" value="<?= $report_input->SchoolActiveDays?>">
                                                            <span class="input-group-btn">
                                                                <button name="SchoolActiveDays" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">No. Akte Pendirian Sekolah</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="SchoolConstructionCertificate" type="text" class="form-control" value="<?= $report_input->SchoolConstructionCertificate?>">
                                                            <span class="input-group-btn">
                                                                <button name="SchoolConstructionCertificate" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 sbold">No. Ijin Operasional Sekolah</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                        <input name="NoOperation" type="text" class="form-control" value="<?= $report_input->NoOperation?>">
                                                            <span class="input-group-btn">
                                                                <button name="NoOperation" class="btn save_report green-jungle" type="button">Save</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 sbold">Data Sekolah</label>
                                                    <br><br>
                                                    <?= $report ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="report_student">
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject font-dark bold uppercase">DATA STUDENT - <?= date('F Y')?></span>
                                        </div>
                                        <div class="actions">
                                            <a class="btn btn-circle btn-icon-only btn-default" href="">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-default" href="<?= base_url('Admin/export_labul_student'); ?>">
                                                <i class="fa fa-file-excel-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="portlet light portlet-fit bordered">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="icon-settings font-dark"></i>
                                                            <span class="caption-subject font-dark bold uppercase">DATA OVERALL - <?= date('F Y')?></span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-scrollable">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th> Item </th>
                                                                    <th> Laki-Laki </th>
                                                                    <th> Perempuan </th>
                                                                    <th> Jumlah </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td> Jumlah Siswa Seluruhnya </td>
                                                                    <td> <?= $report_overall->Male ?> </td>
                                                                    <td> <?= $report_overall->Female ?> </td>
                                                                    <td> <?= $report_overall->Total ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Advent </td>
                                                                    <td> <?= $report_adventist->Male ?> </td>
                                                                    <td> <?= $report_adventist->Female ?> </td>
                                                                    <td> <?= $report_adventist->Total ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Non-Adventist </td>
                                                                    <td> <?= $report_non_adventist->Male ?> </td>
                                                                    <td> <?= $report_non_adventist->Female ?> </td>
                                                                    <td> <?= $report_non_adventist->Total ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Jumlah Absen Bulan Ini </td>
                                                                    <td> <?= $report_attendance->Male ?> </td>
                                                                    <td> <?= $report_attendance->Female ?> </td>
                                                                    <td> <?= $report_attendance->Total ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Sakit </td>
                                                                    <td> <?= $report_sick->Male ?> </td>
                                                                    <td> <?= $report_sick->Female ?> </td>
                                                                    <td> <?= $report_sick->Total ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Izin </td>
                                                                    <td> <?= $report_on_permit->Male ?> </td>
                                                                    <td> <?= $report_on_permit->Female ?> </td>
                                                                    <td> <?= $report_on_permit->Total ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Alpa </td>
                                                                    <td> <?= $report_absent->Male ?> </td>
                                                                    <td> <?= $report_absent->Female ?> </td>
                                                                    <td> <?= $report_absent->Total ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Jumlah Siswa Mutasi/DO </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Masuk </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Keluar/Pindah </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                </tr>
                                                                    <td> Drop Out (DO) </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                <tr>
                                                                    <td> Jumlah Siswa yang sudah dibaptis </td>
                                                                    <td contenteditable="0"> 0 </td>
                                                                    <td contenteditable="0"> 0 </td>
                                                                    <td contenteditable="0"> 0 </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Jumlah Siswa yang sudah dibaptis sampai bulan ini </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Jumlah Siswa yang belum dibaptis <br> (Usia Baptis mengikuti Bible Study) </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                    <td contenteditable="true"> 0 </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-md-6">
                                                <?= $report_std ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="report_teacher">
                                <div class="col-md-12">
                                    <div class="portlet light portlet-fit bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-settings font-dark"></i>
                                                <span class="caption-subject font-dark bold uppercase">DATA KEADAAN GURU/PEGAWAI <?= date('F Y') ?></span>
                                            </div>
                                            <div class="actions">
                                                <a class="btn btn-circle btn-icon-only btn-default" href="">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" href="<?= base_url('Admin/export_labul_teacher'); ?>">
                                                    <i class="fa fa-file-excel-o"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th> Item </th>
                                                        <th> Laki-Laki </th>
                                                        <th> Perempuan </th>
                                                        <th> Jumlah </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Jumlah Guru/Pegawai Seluruhnya</td>
                                                        <td contenteditable="true"><?= $overall->Male?></td>
                                                        <td contenteditable="true"><?= $overall->Female?></td>
                                                        <td contenteditable="true"><?= $overall->Total?></td>
                                                    <tr>
                                                        <td>Index (GTY)</td>
                                                        <td contenteditable="true"><?= $gty->Male?></td>
                                                        <td contenteditable="true"><?= $gty->Female?></td>
                                                        <td contenteditable="true"><?= $gty->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Aparat Sipil Negara (ASN)</td>
                                                        <td contenteditable="true"><?= $asn->Male?></td>
                                                        <td contenteditable="true"><?= $asn->Female?></td>
                                                        <td contenteditable="true"><?= $asn->Total?></td>
                                                    </tr>    
                                                        <td contenteditable="true">Honor (GTT) </td>
                                                        <td contenteditable="true"><?= $gtt->Male?></td>
                                                        <td contenteditable="true"><?= $gtt->Female?></td>
                                                        <td contenteditable="true"><?= $gtt->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jumlah Staff Non-Guru</td>
                                                        <td contenteditable="true"><?= $nontch->Male?></td>
                                                        <td contenteditable="true"><?= $nontch->Female?></td>
                                                        <td contenteditable="true"><?= $nontch->Total?></td>
                                                    <tr>
                                                        <td>Keuangan</td>
                                                        <td contenteditable="true"><?= $acc->Male?></td>
                                                        <td contenteditable="true"><?= $acc->Female?></td>
                                                        <td contenteditable="true"><?= $acc->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tata Usaha / Administrasi</td>
                                                        <td contenteditable="true"><?= $adm->Male?></td>
                                                        <td contenteditable="true"><?= $adm->Female?></td>
                                                        <td contenteditable="true"><?= $adm->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Satpam, DLL</td>
                                                        <td contenteditable="true"><?= $other->Male?></td>
                                                        <td contenteditable="true"><?= $other->Female?></td>
                                                        <td contenteditable="true"><?= $other->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jumlah Guru/Pegawai Menurut Agama</td>
                                                        <td contenteditable="true"><?= $overall->Male?></td>
                                                        <td contenteditable="true"><?= $overall->Female?></td>
                                                        <td contenteditable="true"><?= $overall->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Advent</td>
                                                        <td contenteditable="true"><?= $adv->Male?></td>
                                                        <td contenteditable="true"><?= $adv->Female?></td>
                                                        <td contenteditable="true"><?= $adv->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Non-Advent</td>
                                                        <td contenteditable="true"><?= $nonadv->Male?></td>
                                                        <td contenteditable="true"><?= $nonadv->Female?></td>
                                                        <td contenteditable="true"><?= $nonadv->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jumlah Guru Menurut Jenjang</td>
                                                        <td contenteditable="true"><?= $overall->Male?></td>
                                                        <td contenteditable="true"><?= $overall->Female?></td>
                                                        <td contenteditable="true"><?= $overall->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SMA/SPG/PGSLP/D1/D2/D3</td>
                                                        <td contenteditable="true"><?= $nonstrat->Male?></td>
                                                        <td contenteditable="true"><?= $nonstrat->Female?></td>
                                                        <td contenteditable="true"><?= $nonstrat->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Strata 1 (S1)</td>
                                                        <td contenteditable="true"><?= $strat1->Male?></td>
                                                        <td contenteditable="true"><?= $strat1->Female?></td>
                                                        <td contenteditable="true"><?= $strat1->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Strata 2 (S2)</td>
                                                        <td contenteditable="true"><?= $strat2->Male?></td>
                                                        <td contenteditable="true"><?= $strat2->Female?></td>
                                                        <td contenteditable="true"><?= $strat2->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Guru/Pegawai yang tamat Perguruan Tinggi</td>
                                                        <td contenteditable="true"></td>
                                                        <td contenteditable="true"></td>
                                                        <td contenteditable="true"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Perguruan Tinggi Advent</td>
                                                        <td contenteditable="true"></td>
                                                        <td contenteditable="true"></td>
                                                        <td contenteditable="true"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Perguruan Tinggi Non-Advent</td>
                                                        <td contenteditable="true"></td>
                                                        <td contenteditable="true"></td>
                                                        <td contenteditable="true"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jumlah Guru Tersertifikasi Gereja (Yayasan)</td>
                                                        <td contenteditable="true"></td>
                                                        <td contenteditable="true"></td>
                                                        <td contenteditable="true"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pemerintah</td>
                                                        <td contenteditable="true"></td>
                                                        <td contenteditable="true"></td>
                                                        <td contenteditable="true"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jumlah Absent Guru dan Pegawai</td>
                                                        <td contenteditable="true"><?= $attd->Male?></td>
                                                        <td contenteditable="true"><?= $attd->Female?></td>
                                                        <td contenteditable="true"><?= $attd->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sakit</td>
                                                        <td contenteditable="true"><?= $sick->Male?></td>
                                                        <td contenteditable="true"><?= $sick->Female?></td>
                                                        <td contenteditable="true"><?= $sick->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Izin</td>
                                                        <td contenteditable="true"><?= $onpermit->Male?></td>
                                                        <td contenteditable="true"><?= $onpermit->Female?></td>
                                                        <td contenteditable="true"><?= $onpermit->Total?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alpa</td>
                                                        <td contenteditable="true"><?= $abs->Male?></td>
                                                        <td contenteditable="true"><?= $abs->Female?></td>
                                                        <td contenteditable="true"><?= $abs->Total?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="report_nonteacher">
                                <div class="col-md-12">
                                    <div class="portlet light portlet-fit bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-settings font-dark"></i>
                                                <span class="caption-subject font-dark bold uppercase">DAFTAR NOMINATIF GURU-PEGAWAI</span>
                                            </div>
                                            <div class="actions">
                                                <a class="btn btn-circle btn-icon-only btn-default" href="">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-default" href="<?= base_url('Admin/export_labul_staff'); ?>">
                                                    <i class="fa fa-file-excel-o"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th> No </th>
                                                        <th> Nama/NIP </th>
                                                        <th> L/P </th>
                                                        <th> GTY / PNS<hr style="margin: 5px">PTY/GTT/<br>PTT </th>
                                                        <th> Tempat Tanggal Lahir </th>
                                                        <th> Ijazah<br>Terakhir </th>
                                                        <th> Tahun<br>Tamat </th>
                                                        <th> Jabatan </th>
                                                        <th> Mulai<br>Kerja (TMT) </th>
                                                        <th> Masa Dinas <br> di Yayasan <br> (terhitung mulai <br> dari honor <br> untuk guru index) </th>
                                                        <th> Alamat </th>
                                                        <th> Sertifikasi<br>Pemerintah </th>
                                                        <th> Sertifikasi<br>Yayasan </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $i = 1;
                                                        foreach($nom_t as $nom_t) : ?>
                                                        <tr>
                                                            <td width="1%"><?=$i?></td>
                                                            <td width="15%"><?=$nom_t->FullName?> - <?= $nom_t->IDNumber?></td>
                                                            <td width="1%"><?=$nom_t->Gender?></td>
                                                            <td width="1%"><?=$nom_t->Emp_Type?></td>
                                                            <td width="10%"><?=$nom_t->Birth?></td>
                                                            <td width="1%" contenteditable="true"></td>
                                                            <td width="1%" contenteditable="true"></td>
                                                            <td width="5%"><?=$nom_t->JobDesc?></td>
                                                            <td width="1%"><?=$nom_t->YearStarts?></td>
                                                            <td width="1%" contenteditable="true"></td>
                                                            <td width="10%"><?=$nom_t->Address?></td>
                                                            <td width="5%"><?=$nom_t->Govt_Cert?></td>
                                                            <td width="5%"><?=$nom_t->Institute_Cert?></td>
                                                        </tr>
                                                    <?php
                                                        $i++;
                                                        endforeach; 
                                                    ?>
                                                    <tr>
                                                        <td colspan="14" class="sbold text-center"> ADMINISTRASI </td>
                                                    </tr>
                                                    <?php
                                                        foreach($nom_s as $nom_s) : ?>
                                                        <tr>
                                                            <td width="1%"><?=$i?></td>
                                                            <td width="15%"><?=$nom_s->FullName?> - <?= $nom_s->IDNumber?></td>
                                                            <td width="1%"><?=$nom_s->Gender?></td>
                                                            <td width="1%"><?=$nom_s->Emp_Type?></td>
                                                            <td width="10%"><?=$nom_s->Birth?></td>
                                                            <td width="1%" contenteditable="true"></td>
                                                            <td width="1%" contenteditable="true"></td>
                                                            <td width="5%"><?=$nom_s->JobDesc?></td>
                                                            <td width="1%"><?=$nom_s->YearStarts?></td>
                                                            <td width="1%" contenteditable="true"></td>
                                                            <td width="10%"><?=$nom_s->Address?></td>
                                                            <td width="5%"><?=$nom_s->Govt_Cert?></td>
                                                            <td width="5%"><?=$nom_s->Institute_Cert?></td>
                                                        </tr>
                                                    <?php 
                                                        $i++;
                                                        endforeach; ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix margin-bottom-20"> </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Recap Mid-Semester Siswa SEMESTER <?= $this->session->userdata('semester') ?> TAHUN AJARAN <?= $this->session->userdata('period') ?></span>
                        </div>
                        <div class="actions">
                            <a id="print_recap_mid" href="javascript:;" class="btn green-jungle btn-xs btn-outline">
                            <i class="fa fa-file-excel-o"></i>&nbsp;Export Recap</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-body">
                            <div class="form-group col-md-2" style="padding-left: 0px">
                                <label>Select Rooms</label>
                                <select class="form-control" id="recap_rooms_mid">
                                    <?php if($active_rooms) : ?>
                                        <?php foreach($active_rooms as $row) : ?>
                                            <option value="<?= $row->RoomDesc?>"><?= $row->RoomDesc?></option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">No Rooms available</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="full_mid_recap">
                                    <thead>
                                        <tr>
                                            <th class="all" width="1%">NIS</th>
                                            <th class="all" width="35%">Name</th>
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
            <div class="row">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Recap Absent Siswa Kelas Tahun <?= date('Y')?></span>
                        </div>
                        <div class="actions">
                            <a id="print_attd" href="javascript:;" class="btn green-jungle btn-xs btn-outline">
                            <i class="fa fa-file-excel-o"></i>&nbsp;Export Recap</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-body">
                            <div class="col-md-2" style="padding-left: 0px">
                                <div class="form-group" style="padding-left: 0px">
                                    <label>Select Rooms</label>
                                    <select class="form-control" id="recap_rooms_attd">
                                        <?php if($active_rooms) : ?>
                                            <?php foreach($active_rooms as $row) : ?>
                                                <option value="<?= $row->RoomDesc?>"><?= $row->RoomDesc?></option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value="">No Rooms available</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="padding-left: 0px">
                                    <label>Select Month</label>
                                    <select class="form-control" id="attd_month">
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding: 0px">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="attd_recap">
                                            <thead>
                                                <tr>
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
            </div>
        </div>

        <?php $this->load->view('_partials/_foot'); ?>