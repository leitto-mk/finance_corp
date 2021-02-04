<?php $this->load->view('teacher/navbar/navbar'); ?>

<!-- BEGIN MODAL ABSENT-->
<div class="modal-content" style="display: none;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Masukan Absensi Siswa</h4>
    </div>
    <div class="modal-body">





    </div>
    <div class="modal-footer">
        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn green">Simpan</button>
    </div>
</div>
<!-- END MODAL ABSENT -->

<div class="container-fluid">
    <div class="page-content">



        <!-- BEGIN BUTTON ADD ABSENT -->
        <div class="m-heading-1 border-red">
            <a href="javascript:;" class="btn red-sunglo btn-lg">Add Absent</a>
        </div>
        <!-- END BUTTON ADD ABSENT -->



        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
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
                            <th> No. </th>
                            <th> Nama </th>
                            <th> Kelas </th>
                            <th> Subjek </th>
                            <th> Tanggal Absent </th>
                            <th> Jam Pelajaran </th>
                            <th> Keterangan </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> 1 </td>
                            <td> Fullname </td>
                            <td> IX </td>
                            <td> Biology </td>
                            <td> 01-01-2019 </td>
                            <td> 12:00 </td>
                            <td class="bg-danger"> Bolos </td>
                        </tr>
                        <tr>
                            <td> 2 </td>
                            <td> Fullname </td>
                            <td> IX </td>
                            <td> Biology </td>
                            <td> 01-01-2019 </td>
                            <td> 12:00 </td>
                            <td class="bg-primary"> Sakit </td>
                        </tr>
                        <tr>
                            <td> 3 </td>
                            <td> Fullname </td>
                            <td> IX </td>
                            <td> Biology </td>
                            <td> 01-01-2019 </td>
                            <td> 12:00 </td>
                            <td class="bg-warning"> Izin </td>
                        </tr>
                        <tr>
                            <td> 4 </td>
                            <td> Fullname </td>
                            <td> IX </td>
                            <td> Biology </td>
                            <td> 01-01-2019 </td>
                            <td> 12:00 </td>
                            <td class="bg-danger"> Bolos </td>
                        </tr>
                        <tr>
                            <td> 5 </td>
                            <td> Fullname </td>
                            <td> IX </td>
                            <td> Biology </td>
                            <td> 01-01-2019 </td>
                            <td> 12:00 </td>
                            <td class="bg-danger"> Bolos </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    <?php $this->load->view('_partials/_foot'); ?>