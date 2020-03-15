<?php $this->load->view('_partials/_head'); ?>

<!-- BEGIN HEADER MENU -->
<div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">
        <li class="dropdown dropdown-fw dropdown-fw-disabled">
            <a href="javascript:;" class="text-uppercase">
                <i class="icon-home"></i> Akademik </a>
            <ul class="dropdown-menu dropdown-menu-fw">
                <li>
                    <a href="<?= base_url('teacher/load_acd_sche'); ?>">
                        <i class="icon-bar-chart"></i> Jadwal Mengajar </a>
                </li>
                <li>
                    <a href="<?= base_url('teacher/load_acd_grde'); ?>">
                        <i class="icon-bulb"></i> Nilai Siswa </a>
                </li>
                <li>
                    <a href="<?= base_url('teacher/load_acd_absn'); ?>">
                        <i class="icon-graph"></i> Absensi </a>
                </li>
            </ul>
        </li>
        <li class="dropdown dropdown-fw dropdown-fw-disabled">
            <a href="javascript:;" class="text-uppercase">
                <i class="icon-puzzle"></i> Profile </a>
            <ul class="dropdown-menu dropdown-menu-fw">
                <li>
                    <a href="<?= base_url('teacher/load_profile'); ?>">
                        <i class="icon-bar-chart"></i> Profile Guru </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- END HEADER MENU -->

</div>
<!--/container-->
</nav>
</header>
<!-- END HEADER -->