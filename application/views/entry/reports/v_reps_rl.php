<?php $this->load->view('header_footer/header_sub_modul_sf_no_trees'); ?>
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
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
            <!-- <php $date = date("d-M-Y") ?> -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoice-logo-space text-center" style="margin-top: 15px">
                    <div>
                        <font size="6" class="uppercase">Company Name</font><br>
                        <font size="4" class="font-dark sbold uppercase">Perhitungan Rugi - Laba</font><br>
                        <font size="4" class="font-dark sbold">untuk Tahun yang Berakhir 31 Desember 2020</font><br>
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
                                    <!-- <thead>
                                        <tr class="font-dark bg-default">
                                            <th class="text-center"> No </th>
                                            <th class="text-center"> Trans Date </th>
                                            <th class="text-center"> Doc No </th>
                                            <th class="text-center"> Trans Type </th>
                                            <th class="text-left"> Description </th>
                                            <th class="text-center"> Dept. </th>
                                            <th class="text-center"> Cost Center </th>
                                            <th class="text-center"> Cry </th>
                                            <th class="text-right"> Debit </th>
                                            <th class="text-right"> Credit </th>
                                            <th class="text-right"> Balance </th>
                                        </tr>
                                    </thead> -->
                                    <tbody class="bold">
                                        <tr>
                                            <td colspan="4">Pendapatan dari penjualan</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="2">Penjualan</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">143,390,300</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="2">Dikurangi: </td>
                                            <td>Retur Penjualan</td>
                                            <td align="right">1,250,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Potongan Penjualan</td>
                                            <td align="right" style="border-bottom: solid 1px;">1,582,000</td>
                                            <td></td>
                                            <td align="right" style="border-bottom: solid 1px;">2,832,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2">Penjualan Bersih</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">140,558,300</td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr style="background-color: white">
                                            <td colspan="4">Harga Pokok Penjualan</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Persediaan Barang, 1 Januari 2020</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">28,000,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Pembelian </td>
                                            <td align="right">37,339,600</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Dikurangi Potongan Pembelian </td>
                                            <td align="right">37,339,600</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Dikurangi Retur Pembelian </td>
                                            <td align="right" style="border-bottom: solid 1px;">17,000,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Pembelian Bersih </td>
                                            <td></td>
                                            <td></td>
                                            <td align="right" style="border-bottom: solid 1px;">19,434,675</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Barang tersedia untuk dijual </td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">47,434,675</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td colspan="3">Dikurangi Pers.Barang Dag, 30 Des 2020 </td>
                                            <td></td>
                                            <td></td>
                                            <td align="right" style="border-bottom: solid 1px;">45,000,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2">harga pokok barang yang dijual</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td align="right" style="border-bottom: solid 1px;">2,434,675</td>
                                            <td></td>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan="3">Laba Kotor</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">138,123,625</td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">Beban Operasi</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Angkut Pembelian</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">345,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Servis Kendaraan</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">3,650,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Gaji Bagian Toko</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">11,000,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Gaji Bagian Kantor</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">10,250,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Kerugian Piutang Dagang</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">481,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Asuransi</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">150,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Sewa Gedung</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">1,250,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Perlengkapan Toko</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">520,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Penglengkapan Kantor</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">200,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Peny. Perlengkapan Toko</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">120,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Peny. Penglengkapan Kantor</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">85,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Peny. Kendaraan</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">195,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Biaya Listrik & Telepon</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right"style="border-bottom: solid 1px;">1,250,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2">Jumlah Biaya Operasi</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td align="right" style="border-bottom: solid 1px;">29,496,000</td>
                                            <td></td>
                                        </tr>
                                        <tr style="background-color: white">
                                            <td colspan="3">Laba Dari Operasi</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">108,627,625</td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">Pendapatan Lain-Lain</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="2">Pendapatan Bunga</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td align="right">1,245,000</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">Biaya Lain-Lain</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">Tidak ada</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right"style="border-bottom: solid 1px;"></td>
                                            <td></td>
                                            <td align="right"style="border-bottom: solid 1px;">1,245,000</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Laba Bersih</td>
                                            <td></td>
                                            <td></td>
                                            <td align="right"></td>
                                            <td></td>
                                            <td align="right"style="border-bottom: solid 1px;">109,872,625</td>
                                            <td></td>
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
    window.onload = load_function;

    function load_function() {
        document.body.style.zoom = 0.9;
    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php $this->load->view('header_footer/footer_sub_modul_sf'); ?>