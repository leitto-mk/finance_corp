<?php $this->load->view('_partials/_head'); ?>
<!-- BEGIN HEADER MENU -->
<div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">
        <li class="dropdown dropdown-fw dropdown-fw-disabled main dashb">
            <a class="text-uppercase">
                <i class="fa fa-window-restore"></i> Dashboard </a>
            <ul class="dropdown-menu dropdown-menu-fw">
                <li>
                    <a class="subnav" id="full_det" href="<?= base_url('admin/index'); ?>">
                        <i class="icon-bar-chart"></i> School Details </a>
                </li>
            </ul>
        </li>

        <li class="dropdown dropdown-fw dropdown-fw-disabled main profile">
            <a class="text-uppercase">
                <i class="fa fa-users"></i> &nbsp;Profile </a>
            <ul class="dropdown-menu dropdown-menu-fw">
                <li>
                    <a class="subnav" id="adm" href="<?= base_url('admin/load_prof_adm'); ?>">
                        <i class="fa fa-id-badge"></i> Admin Profile </a>
                </li>
                <li>
                    <a class="subnav" id="guru" href="<?= base_url('Admin/load_prof_tch_edit'); ?>">
                        <i class="fa fa-address-card"></i> Teachers / Staffs </a>
                </li>
                <li>
                    <a class="subnav" id="siswa" href="<?= base_url('Admin/load_prof_std_edit'); ?>">
                        <i class="fa fa-graduation-cap"></i> Students </a>
                </li>
                <!-- <li>
                    <a class="subnav" id="staff" href="<?= base_url('admin/load_prof_stf_edit'); ?>">
                        <i class="fa fa-user"></i> Staffs </a>
                </li> -->
            </ul>
        </li>

        <li class="dropdown dropdown-fw dropdown-fw-disabled main akademik">
            <a class="text-uppercase">
                <i class="fa fa-building"></i> Academic </a>
            <ul class="dropdown-menu dropdown-menu-fw">
                <!-- <li>
                    <a id="kelas" href="<?= base_url(''); ?>">
                        <i class="fas fa-school"></i> &nbsp;Kelas </a>
                </li> -->
                <li>
                    <a class="subnav" id="jadwal" href="<?= base_url('admin/load_acd_sch_edit'); ?>">
                        <i class="fa fa-calendar"></i> &nbsp;Schedule </a>
                </li>
                <li>
                    <a class="subnav" id="nilai" href="<?= base_url('admin/load_acd_grde'); ?>">
                        <i class="icon-bulb"></i> Student Grades </a>
                </li>
                <li>
                    <a class="subnav" id="absen" href="<?= base_url('admin/load_acd_absn'); ?>">
                        <i class="icon-graph"></i> Absence </a>
                </li>
            </ul>
        </li>

        <li class="dropdown dropdown-fw dropdown-fw-disabled main">
            <a class="text-uppercase">
                <i class="fa fa-list-alt"></i> &nbsp;Enrollment </a>
            <ul class="dropdown-menu dropdown-menu-fw">
                <li>
                    <a class="subnav" href="<?= base_url('admin/load_enroll'); ?>">
                        <i class="icon-bar-chart"></i> Enrollment </a>
                </li>
            </ul>
        </li>

        <!-- <li class="dropdown dropdown-fw dropdown-fw-disabled main">
            <a class="text-uppercase">
                <i class="fa fa-bookmark"></i> &nbsp;Finance </a>
            <ul class="dropdown-menu dropdown-menu-fw">
                <li>
                    <a class="subnav" id="guru" href="<?= base_url('Admin/load_fnc_tch'); ?>">
                        <i class="fa fa-address-card"></i> Teachers </a>
                </li>
                <li>
                    <a class="subnav" id="siswa" href="<?= base_url('Admin/load_fnc_std'); ?>">
                        <i class="fa fa-graduation-cap"></i> Students </a>
                </li>
                <li>
                    <a class="subnav" id="staff" href="<?= base_url('admin/load_fnc_stf'); ?>">
                        <i class="fa fa-user"></i> Staffs </a>
                </li>
            </ul>
        </li> -->
    </ul>
</div>
<!-- END HEADER MENU -->

</div>
<!--/container-->
</nav>
</header>
<!-- END HEADER -->