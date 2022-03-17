<?php $this->load->view('financecorp/header_footer/header_sub_modul_sf_no_trees'); ?>
<!-- <style type="text/css">
    tr:nth-child(even){
        background-color: #E1E5EC;
    }

    tr:nth-child(odd){
        background-color: white;
    }
</style> -->
<div class="portlet light">
    <div class="row">
        <div class="col-lg-2 hidden-print">
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 pull-left hidden-print">
            <div class="portlet light form-horizontal bg-default">
                <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                    <div class="portlet-body form-horizontal hidden-print" style="margin-top: 20px">
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-blue-dark font-white">
                                        <th width="5%"></th>
                                        <th class="text-center" width="40%">Branch / Site</th>
                                        <th class="text-center" width="25%">Year</th>
                                        <th class="text-center" width="25%">Month</th>
                                        <th class="text-center" width="5%">Action</th>        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label bold">Parameters</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <select id="branch" name="branch" class="form-control" required>
                                                        <option value="">Default Branch User Login</option>
                                                        <option value="All">All</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <select id="year" name="year" class="form-control" required>
                                                        <option value="">Default Current Year</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2020">2020</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <select id="month" name="month" class="form-control" required>
                                                        <option value="">Default Current Month</option>
                                                        <option value="Jan">January</option>
                                                        <option value="Feb">February</option>
                                                        <option value="Mar">March</option>
                                                        <option value="Apr">April</option>
                                                        <option value="May">May</option>
                                                        <option value="Jun">June</option>
                                                        <option value="Jul">July</option>
                                                        <option value="Aug">August</option>
                                                        <option value="Sep">September</option>
                                                        <option value="Oct">October</option>
                                                        <option value="Nov">November</option>
                                                        <option value="Dec">December</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group text-center">
                                                <div class="col-md-12">
                                                    <a class="btn btn-sm btn-success" id="submit_filter">
                                                        <center>PREVIEW</center>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                                                           
                    </div>
                <?php echo form_close(); ?>
            </div>  
        </div>
        <div class="col-lg-2 hidden-print">
        </div>
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
            <!-- <php $date = date("d-M-Y") ?> -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-logo-space text-center" style="margin-top: 15px">
                    <div>
                        <font size="6" class="uppercase">Company Name</font><br>
                        <font size="4" class="font-dark sbold uppercase">Trial Balance</font><br>
                        <font size="4" class="font-dark sbold">October 2021</font><br>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="portlet bordered light bg-white">
                        <div class="caption">
                            <span class="caption-subject uppercase font-dark">
                                <div class="input-group input-large pull-right" style="margin-top: -5px">
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-xs btn green hidden-print pull-right"  onclick="printDiv('printDiv')" style="margin-left: 5px">
                                            <i class="fa fa-plus"></i>&nbsp;Print</i>
                                        </a>
                                        <a onclick="window.close();" class="btn btn-xs btn red hidden-print pull-right"><i class="fa fa-close"></i> Close</a>
                                    </span>

                                </div> 
                            </span>
                        </div>   
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped table-condensed">
                                    <thead>
                                        <tr class="font-dark" style="background-color: #5c9bd194;">
                                            <th class="text-center" width="7%">Kode Akun</th>
                                            <th class="text-center" width="18%">Nama Akun</th>
                                            <th class="text-center">Tipe</th>
                                            <th class="text-center" colspan="2">Saldo Awal</th>
                                            <th class="text-center" colspan="2">Transaksi</th>
                                            <th class="text-center" colspan="2">Saldo Akhir</th>
                                            <th class="text-center" colspan="2">Laba (Rugi)</th>
                                            <th class="text-center" colspan="2">Neraca</th>
                                        </tr>
                                        <tr class="font-dark bg-default">
                                            <th colspan="3"></th>
                                            <th class="text-center" width="10%">Debit</th>
                                            <th class="text-center" width="10%">Credit</th>
                                            <th class="text-center" width="10%">Debit</th>
                                            <th class="text-center" width="10%">Credit</th>
                                            <th class="text-center" width="10%">Debit</th>
                                            <th class="text-center" width="10%">Credit</th>
                                            <th class="text-center" width="10%">Debit</th>
                                            <th class="text-center" width="10%">Credit</th>
                                            <th class="text-center" width="10%">Debit</th>
                                            <th class="text-center" width="10%">Credit</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bold">
                                        <tr>
                                            <td align="center">10100</td>
                                            <td>Kas</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">3.051.335.891,00</td>
                                            <td align="right">3.051.335.891,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">10201</td>
                                            <td>Bank Mandiri</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">2.995.428.469,00</td>
                                            <td align="right">1.860.910.085,00</td>
                                            <td align="right">1.134.518.384,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">1.134.518.384,00</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">11000</td>
                                            <td>Pindah Buku</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">7.000.000,00</td>
                                            <td align="right">2.000.000,00</td>
                                            <td align="right">5.000.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">5.000.000,00</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">11001</td>
                                            <td>Deposit Sewa Kantor</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">3.000.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">3.000.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">3.000.000,00</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">12100</td>
                                            <td>Pembelian Tanah</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">4.800.907.500,00</td>
                                            <td align="right">-</td>
                                            <td align="right">4.800.907.500,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">4.800.907.500,00</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">12105</td>
                                            <td>Legal dan Notaris</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">12110</td>
                                            <td>Sertifikasi Lahan</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">12115</td>
                                            <td>Pajak2</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">12200</td>
                                            <td>Desain Arsitektur dan Sipil</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">12205</td>
                                            <td>Perizinan Pemda</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">4.000.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">4.000.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">4.000.000,00</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">12210</td>
                                            <td>Perizinan BPN</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">12300</td>
                                            <td>Infrastruktur</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">12305</td>
                                            <td>Utilitas</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">12310</td>
                                            <td>Fasum/Fasos</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">12315</td>
                                            <td>Perawatan dan Sosial</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">5.000.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">5.000.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">5.000.000,00</td>
                                            <td align="right">-</td>
                                        </tr>     
                                        <tr>
                                            <td align="center">21000</td>
                                            <td>Peralatan Kantor</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">15.474.800,00</td>
                                            <td align="right">-</td>
                                            <td align="right">15.474.800,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">15.474.800,00</td>
                                            <td align="right">-</td>
                                        </tr>  
                                        <tr>
                                            <td align="center">22000</td>
                                            <td>Kendaraan Bermotor</td>
                                            <td align="center">A</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr> 
                                        <tr>
                                            <td align="center">23000</td>
                                            <td>Akumulasi Penyusutan</td>
                                            <td align="center">A1</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">229.164,00</td>
                                            <td align="right">-</td>
                                            <td align="right">229.164,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">229.164,00</td>
                                        </tr> 
                                        <tr>
                                            <td align="center">30000</td>
                                            <td>Hutang Usaha</td>
                                            <td align="center">L</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">31000</td>
                                            <td>Hutang Pajak</td>
                                            <td align="center">L</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">4.360.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">4.360.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">4.360.000,00</td>
                                        </tr>  
                                        <tr>
                                            <td align="center">34000</td>
                                            <td>Hutang P/ S</td>
                                            <td align="center">L</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">38.870.891,00</td>
                                            <td align="right">5.438.870,891,00</td>
                                            <td align="right">-</td>
                                            <td align="right">5.400.000,000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">5.400.000,000,00</td>
                                        </tr>  
                                        <tr>
                                            <td align="center">40100</td>
                                            <td>Modal Disetor</td>
                                            <td align="center">C</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">5.400.000,000,00</td>
                                            <td align="right">6.000.000,000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">6.000.000,000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">6.000.000,000,00</td>
                                        </tr>  
                                        <tr>
                                            <td align="center">40200</td>
                                            <td>Laba (Rugi) Ditahan Awal</td>
                                            <td align="center">C</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>   
                                        <tr>
                                            <td align="center">40300</td>
                                            <td>Laba (Rugi) Ditahan Tahun Berjalan</td>
                                            <td align="center">XC</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>  
                                        <tr>
                                            <td align="center">50000</td>
                                            <td>Pendapatan</td>
                                            <td align="center">R</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>  
                                        <tr>
                                            <td align="center">60000</td>
                                            <td>Biaya Gaji</td>
                                            <td align="center">E</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">8.000.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">8.000.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">8.000.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>  
                                        <tr>
                                            <td align="center">60005</td>
                                            <td>Biaya Entertain</td>
                                            <td align="center">E</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">1.903.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">1.903.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">1.903.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr> 
                                        <tr>
                                            <td align="center">60010</td>
                                            <td>Biaya Sewa Kantor</td>
                                            <td align="center">E</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">13.911.091,00</td>
                                            <td align="right">-</td>
                                            <td align="right">13.911.091,00</td>
                                            <td align="right">-</td>
                                            <td align="right">13.911.091,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">60012</td>
                                            <td>Biaya Perbaikan Kantor</td>
                                            <td align="center">E</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">2.025.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">2.025.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">2.025.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>  
                                        <tr>
                                            <td align="center">60015</td>
                                            <td>Biaya Perijinan</td>
                                            <td align="center">E</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">11.200.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">11.200.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">11.200.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">60020</td>
                                            <td>Biaya ATK</td>
                                            <td align="center">E</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">385.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">385.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">385.000,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr> 
                                        <tr>
                                            <td align="center">60025</td>
                                            <td>Biaya Penyusutan</td>
                                            <td align="center">E</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">229.164,00</td>
                                            <td align="right">-</td>
                                            <td align="right">229.164,00</td>
                                            <td align="right">-</td>
                                            <td align="right">229.164,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">65000</td>
                                            <td>Biaya Lain2</td>
                                            <td align="center">E</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">70000</td>
                                            <td>Pendapatan Jasa Giro</td>
                                            <td align="center">R</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">1.533.469,00</td>
                                            <td align="right">-</td>
                                            <td align="right">1.533.469,00</td>
                                            <td align="right">-</td>
                                            <td align="right">1.533.469,00</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr>
                                        <tr>
                                            <td align="center">70002</td>
                                            <td>Biaya Admin Bank</td>
                                            <td align="center">E</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">568.694</td>
                                            <td align="right">-</td>
                                            <td align="right">568.694</td>
                                            <td align="right">-</td>
                                            <td align="right">568.694</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                        </tr> 

                                        <tr>
                                            <td class="font-white" colspan="13">_</td>
                                        </tr> 

                                        <!--Total-->
                                        <tr class="font-yellow-gold" style="border-top: solid 2px">
                                            <td align="center"></td>
                                            <td></td>
                                            <td align="center"></td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">16.359.239.499,00</td>
                                            <td align="right">16.359.239.499,00</td>
                                            <td align="right">6.006.122.633,00</td>
                                            <td align="right">6.006.122.633,00</td>
                                            <td align="right">38.221.949,00</td>
                                            <td align="right">1.533.469,00</td>
                                            <td align="right">5.967.900.684,00</td>
                                            <td align="right">6.004.589.164,00</td>
                                        </tr> 

                                        <!--Laba Rugi-->
                                        <tr>
                                            <td align="center" class="font-red-thunderbird">99995</td>
                                            <td class="font-red-thunderbird">Laba (Rugi) Sebelum Pajak</td>
                                            <td align="center" class="font-red-thunderbird">Z</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">36.688.480,00</td>
                                            <td align="right">36.688.480,00</td>
                                            <td align="right">-</td>
                                        </tr> 

                                        <!--Total All = Total + Laba Rugi-->
                                        <tr class="font-blue-madison" style="border-top: solid 2px">
                                            <td colspan="3"></td>
                                            <td align="right">-</td>
                                            <td align="right">-</td>
                                            <td align="right">16.359.239.499,00</td>
                                            <td align="right">16.359.239.499,00</td>
                                            <td align="right">6.006.122.633,00</td>
                                            <td align="right">6.006.122.633,00</td>
                                            <td align="right">38.221.949,00</td>
                                            <td align="right">38.221.949,00</td>
                                            <td align="right">6.004.589.164,00</td>
                                            <td align="right">6.004.589.164,00</td>
                                        </tr> 
 

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
<script type="text/javascript">
    

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php $this->load->view('financecorp/header_footer/footer_sub_modul_sf'); ?>