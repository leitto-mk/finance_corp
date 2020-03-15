<?php $this->load->view('teacher/navbar/navbar'); ?>

<div class="container-fluid">
    <div class="page-content">
        <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <h1>SELAMAT DATANG USER</h1>
        </div>
        <!-- END BREADCRUMBS -->

        <div class="row">
            <div class="col-xs-12">
                <div class="m-heading-1 border-green m-bordered">
                    <h4>Tabel Jadwal Ajar</h4>
                </div>
            </div>
        </div>

        <br>
        <!-- MAIN CONTENT STARTS HERE -->




        <div class="row">
            <div class="col-xs-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Jadwal Mengajar</div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_4">
                            <thead>
                                <tr>
                                    <th class="all">No.</th>
                                    <th>Kode Subjek</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Ruang Kelas</th>
                                    <th>Jam Mengajar</th>
                                    <th>Durasi Subjek</th>
                                    <th> Catatan </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>0017</td>
                                    <td>Biology</td>
                                    <td>IX</td>
                                    <td>201</td>
                                    <td>10:00</td>
                                    <td> 1,5 Jam</td>
                                    <td> - </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>0017</td>
                                    <td>Economy</td>
                                    <td>IX</td>
                                    <td>201</td>
                                    <td>12:00</td>
                                    <td> 1,5 Jam</td>
                                    <td> - </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>0017</td>
                                    <td>Physics</td>
                                    <td>IX</td>
                                    <td>201</td>
                                    <td>13:00</td>
                                    <td> 1,5 Jam</td>
                                    <td> - </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>




        <!-- MAIN CONTENT ENDS HERE -->

        <?php $this->load->view('_partials/_foot'); ?>