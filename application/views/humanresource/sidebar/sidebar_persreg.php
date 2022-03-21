<div class="page-sidebar-wrapper">
<!-- BEGIN SIDEBAR -->
<!-- <div class="page-sidebar navbar-collapse collapse" style="background-color: #4d5b69"> -->
<div class="page-sidebar navbar-collapse collapse bg-blue-ebonyclay">
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler">
                <span></span>
            </div>
        </li>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <li class="nav-head nav-item start" style="margin-top: -20px">
            <!-- <a href="<?php echo site_url('Humanresource/view_personal_register'); ?>" class="nav-link nav-toggle" style="background-color: #15bed1"> -->
            <a href="<?php echo site_url('Humanresource/view_personal_register_abc'); ?>" class="nav-link nav-toggle" style="background-color: #67809fcc">
                <i class="icon-share font-white"></i>
                <span class="caption-subject font-white uppercase title bold"> Dashboard </span>
            </a>
        </li>
        <li class="nav-head nav-item active">
            <a href="<?php echo site_url('Humanresource/view_new_data_personal_abc'); ?>" target="_blank" class="nav-link nav-toggle bg-blue-ebonyclay">
                <i class="icon-user-follow font-green"></i>
                <span class="title uppercase">New Register</span>
            </a>
        </li>
        <li class="nav-head nav-item active">
            <a href="javascript:;" class="nav-link nav-toggle bg-blue-ebonyclay">
                <i class="fa fa-gear font-green"></i>
                <span class="title uppercase">Report Management</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="<?php echo site_url('Humanresource/view_rekap_preview_all_by_gender_by_branch/no') ?>" target="_blank" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title font-white">Employee Gender</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('Humanresource/view_rekap_preview_all_by_emptype_by_branch/no') ?>" target="_blank" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title font-white">Employee Type</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('Humanresource/view_rekap_preview_all_by_supervisor_by_branch/no') ?>" target="_blank" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title font-white">Employee Supervisor</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- END SIDEBAR -->
</div>