<?php $this->load->view('finance/header_sub_modul_sf'); ?>
<div class="main_content">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="text-uppercase font-dark bold" style="margin-left: 10px">Receipt Voucher</h4>
                    </div>
                </div>
            </div>
            <div class="portlet bordered light bg-blue-dark">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-white"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Date :  31-Jan-2021
                        <div class="input-group input-large pull-right" style="margin-top: -5px">
                            <input type="text" class="form-control" placeholder="Search for..." name="search_item" id="search_item">
                            <span class="input-group-btn">
                                <button  class="btn dark">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            <span class="input-group-btn">
                                <a href="<?php echo site_url('SDAFinance/f_entry_transaction_receipt_fin_stu') ?>" target="_blank" class="btn btn-md btn blue-oleo">
                                    <i class="fa fa-plus"></i>&nbsp;Add New</i>
                                </a>
                            </span>
                        </div>
                    </span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr class="font-dark sbold bg bg-white">
                                    <th class="text-left" colspan="8"> ROOM 1A - Wali Kelas: Fine Hiborang </th>
                                </tr>
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="10%"> Trans Date </th>
                                    <th class="text-center" width="10%"> Doc No </th>
                                    <th class="text-center" width="20%"> Student </th>
                                    <th class="text-center" width="8%"> Room  </th>
                                    <th class="text-center" width="22%"> Cashier </th>
                                    <th class="text-center" widtsh="10%"> Amount </th>
                                    <th class="text-center" width="10%"> Remarks </th>
                                    <th class="text-center" width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-white sbold">
                                    <td align="center">01-Jan-2021</td>                                 
                                    <td align="left">1111</td>
                                    <td align="left">2021 - Aaron Anes</td>
                                    <td align="center">1A</td>
                                    <td align="left">10030 - Novita Wewengkang</td>
                                    <td align="right">350.000</td>
                                    <td></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">01-Jan-2021</td>                                 
                                    <td align="left">1112</td>
                                    <td align="left">2022 - Smith James</td>
                                    <td align="center">1A</td>
                                    <td align="left">10030 - Novita Wewengkang</td>
                                    <td align="right">150.000</td>
                                    <td></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td colspan="5"></td>                                 
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">500.000</td>
                                    <td colspan="2"></td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">02-Feb-2023</td>                                 
                                    <td align="left">1113</td>
                                    <td align="left">2023 - Aaron Winter</td>
                                    <td align="center">1A</td>
                                    <td align="left">10030 - Novita Wewengkang</td>
                                    <td align="right">50.000</td>
                                    <td></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td align="center">02-Feb-2021</td>                                 
                                    <td align="left">1114</td>
                                    <td align="left">2024 - Smith Summer</td>
                                    <td align="center">1A</td>
                                    <td align="left">10030 - Novita Wewengkang</td>
                                    <td align="right">100.000</td>
                                    <td></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                            <i class="fa fa-search"> </i>
                                        </a>
                                        <a href="#" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="font-white sbold">
                                    <td colspan="5"></td>                                 
                                    <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">150.000</td>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
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
</script>
<?php $this->load->view('finance/footer_sub_modul_sf'); ?>