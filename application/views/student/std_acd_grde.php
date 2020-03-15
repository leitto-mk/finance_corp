<?php $this->load->view('student/navbar/navbar'); ?>

<div class="container-fluid">
    <div class="page-content">
        <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <h1>SELAMAT DATANG USER</h1>
        </div>
        <!-- END BREADCRUMBS -->

        <div class="row">
            <div class="col-xs-12">
                <!-- NILAI RAPORT -->
                <div class="portlet box grey">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>Hasil Raport FULLNAME </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs">
                                            <i class="fa fa-briefcase"></i> No </th>
                                        <th class="hidden-xs">
                                            <i class="fa fa-shopping-cart"></i> Code Kelas </th>
                                        <th class="hidden-xs">
                                            <i class="fa fa-user"></i> Nama Subjek </th>
                                        <th class="hidden-xs">
                                            <i class="fa fa-user"></i> Grade </th>
                                        <th class="hidden-xs">
                                            <i class="fa fa-user"></i> Nilai rata-rata Kelas </th>
                                        <th class="hidden-xs">
                                            <i class="fa fa-user"></i> Catatan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="hiddex-xs"> 1 </td>
                                        <td class="hiddex-xs"> 0017 </td>
                                        <td class="hiddex-xs"> Fisika </td>
                                        <td class="highlight">
                                            <div class="success"></div>
                                            <a href="javascript:;"> &nbsp;&nbsp; 95 </a>
                                        </td>
                                        <td class="hiddex-xs"> 80 </td>
                                        <td class="hiddex-xs"> - </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td class="hiddex-xs"> 2 </td>
                                        <td class="hiddex-xs"> 0017 </td>
                                        <td class="hiddex-xs"> Fisika </td>
                                        <td class="highlight">
                                            <div class="success"></div>
                                            <a href="javascript:;"> &nbsp;&nbsp; 95 </a>
                                        </td>
                                        <td class="hiddex-xs"> 80 </td>
                                        <td class="hiddex-xs"> - </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td class="hiddex-xs"> 3 </td>
                                        <td class="hiddex-xs"> 0017 </td>
                                        <td class="hiddex-xs"> Fisika </td>
                                        <td class="highlight">
                                            <div class="success"></div>
                                            <a href="javascript:;"> &nbsp;&nbsp; 95 </a>
                                        </td>
                                        <td class="hiddex-xs"> 80 </td>
                                        <td class="hiddex-xs"> - </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td class="hiddex-xs"> 4 </td>
                                        <td class="hiddex-xs"> 0017 </td>
                                        <td class="hiddex-xs"> Fisika </td>
                                        <td class="highlight">
                                            <div class="success"></div>
                                            <a href="javascript:;"> &nbsp;&nbsp; 95 </a>
                                        </td>
                                        <td class="hiddex-xs"> 80 </td>
                                        <td class="hiddex-xs"> - </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td class="hiddex-xs"> 5 </td>
                                        <td class="hiddex-xs"> 0017 </td>
                                        <td class="hiddex-xs"> Fisika </td>
                                        <td class="highlight">
                                            <div class="success"></div>
                                            <a href="javascript:;"> &nbsp;&nbsp; 95 </a>
                                        </td>
                                        <td class="hiddex-xs"> 80 </td>
                                        <td class="hiddex-xs"> - </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END RAPORT -->

            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <a class="dashboard-stat dashboard-stat-v2 grey" href="#">
                    <div class="visual">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="details">
                        <br>
                        <div class="desc"> Total Semua Mata Pelajaran </div>
                        <div class="number">
                            <span data-counter="counterup" data-value="35"></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div class="details">
                        <br>
                        <div class="desc"> Peringkat </div>
                        <div class="number">
                            <span data-counter="counterup" data-value="3"></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
<?php $this->load->view('_partials/_foot'); ?>