<?php $this->load->view('report/template/header');?>
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
<div class="">
    <div class="page-content bg-grey-steel">
        <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <!-- <h1>Master File</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Home</a>
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
                <?php $this->load->view('report/template/sidebar_master'); ?>
                <div class="page-content-col">
                   
                </div>
            </div>
        </div>
        <!-- END SIDEBAR CONTENT LAYOUT -->
    </div>
<?php $this->load->view('report/template/footer');?>
<script type="text/javascript">
    // Notes : This Code Add row Copyright to mredkj.com - tabledeleterow.js version 1.2 2006-02-21
    window.onload = get_detail_addrow
    function get_detail_addrow() {
        document.body.style.zoom = 0.9;
    }

</script>
                