<?php $this->load->view('student/navbar/navbar'); ?>

<div class="container-fluid">
    <div class="page-content">
        <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <h1>SELAMAT DATANG USER</h1>
        </div>
        <!-- END BREADCRUMBS -->

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box grey">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Absent </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body flip-scroll">
                <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                        <tr>
                            <th height="40%"> No. </th>
                            <th> Nama </th>
                            <th> Kelas </th>
                            <th> Subjek </th>
                            <th> Tanggal Absent </th>
                            <th> Jam Pelajaran </th>
                            <th> Keterangan </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr height="40px">
                            <td> 1 </td>
                            <td> Fullname </td>
                            <td> VII </td>
                            <td> Matematika </td>
                            <td> 05-05-2018</td>
                            <td> 10:00 </td>
                            <td class="bg-primary"> Izin</td>
                        </tr>
                        <tr height="40px">
                            <td> 2 </td>
                            <td> Fullname </td>
                            <td> VII </td>
                            <td> Matematika </td>
                            <td> 05-05-2018</td>
                            <td> 12:00 </td>
                            <td class="bg-warning"> Sakit</td>
                        </tr>
                        <tr height="40px">
                            <td> 3 </td>
                            <td> Fullname </td>
                            <td> VII </td>
                            <td> Matematika </td>
                            <td> 05-05-2018</td>
                            <td> 08:00 </td>
                            <td class="bg-danger"> Bolos</td>
                        </tr>
                        <tr height="40px">
                            <td> 4 </td>
                            <td> Fullname </td>
                            <td> VII </td>
                            <td> Matematika </td>
                            <td> 05-05-2018</td>
                            <td> 10:00 </td>
                            <td class="bg-danger"> Bolos</td>
                        </tr>
                        <tr height="40px">
                            <td> 5 </td>
                            <td> Fullname </td>
                            <td> VII </td>
                            <td> Matematika </td>
                            <td> 05-05-2018</td>
                            <td> 13:00 </td>
                            <td class="bg-danger"> Bolos</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    <?php $this->load->view('_partials/_foot'); ?>