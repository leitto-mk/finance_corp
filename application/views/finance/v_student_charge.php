<?php $this->load->view('finance/header_sub_modul_sf'); ?>
<div class="main_content">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="text-uppercase font-dark bold" style="margin-left: 10px">Student Charge</h4>
                    </div>
                </div>
            </div>
            <div class="portlet bordered light bg-blue-dark">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-white"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Date : <?= date('d-M-Y') ?>
                        <div class="input-group input-large pull-right" style="margin-top: -5px">
                            <input type="text" class="form-control" placeholder="Search for..." name="search_item" id="search_item">
                            <span class="input-group-btn">
                                <button  class="btn dark">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            <span class="input-group-btn">
                                <a href="<?php echo site_url('Finance/view_add_std_charge') ?>" target="_blank" class="btn btn-md btn blue-oleo">
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
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="5%"> No </th>
                                    <th class="text-center" width="22%"> NIS - FullName </th>
                                    <th class="text-center" width="12%"> Room </th>
                                    <th class="text-center" width="17%"> Charges  </th>
                                    <th class="text-center" width="17%"> Paid </th>
                                    <th class="text-center" width="17%"> Variance </th>
                                    <th class="text-center" width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $room = '';
                                    $count_room = 0;
                                    $count_std = 0;
                                    $sub_total = 0;
                                    $sub_total_paid = 0;
                                    $sub_total_variance = 0;
                                    $grand_total = 0;
                                    $grand_total_paid = 0;
                                    $grand_total_variance = 0;
                                ?>
                                <?php if(count($table) == 0) : ?>
                                    <tr style="background-color: white">
                                        <td colspan="7" class="bold text-center uppercase">NO DATA TO SHOW...</td>
                                    </tr>
                                <?php endif; ?>
                                <?php for($i = 0; $i < count($table); $i++) : ?>
                                    <?php if($room !== $table[$i]['Room']) : ?>
                                        <tr style="background-color: white">
                                            <td colspan="7" class="bold">ROOM <?= $table[$i]['Room'] ?> - Wali Kelas: <?= $table[$i]['Homeroom'] ?></td>
                                        </tr>
                                        <?php
                                            $room = $table[$i]['Room'];
                                            $count_room += 1;
                                            $count_std = 1;
                                            $sub_total = 0;
                                            $sub_total_paid = 0;
                                            $sub_total_variance = 0;
                                        ?>
                                    <?php endif; ?>
                                    <tr class="font-white sbold">
                                        <td align="center"><?= $count_std?> </td>                                 
                                        <td align="left"><?= $table[$i]['NIS'] . ' - ' . $table[$i]['FullName'] ?></td>
                                        <td align="center"><?= $table[$i]['Room'] ?></td>
                                        <td align="right"><?= number_format($table[$i]['Amount'], 2, ',', '.') ?></td>
                                        <td align="right"><?= number_format($table[$i]['Paid'], 2, ',', '.') ?></td>
                                        <td align="right">0</td>
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
                                    <?php
                                        $count_std += 1;
                                        $sub_total += $table[$i]['Amount'];
                                        $sub_total_paid += $table[$i]['Paid'];
                                        $sub_total_variance += $table[$i]['Paid'];
                                        $grand_total += $table[$i]['Amount'];
                                        $grand_total_paid += $table[$i]['Paid'];
                                        $grand_total_variance += $table[$i]['Amount'];
                                    ?>
                                    <?php if(!isset($table[$i+1]['Room']) || $table[$i+1]['Room'] !== $room) : ?>
                                        <tr class="font-white sbold">
                                            <td align="center" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa"></td>                                  
                                            <td align="left" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa"></td>
                                            <td align="center" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa text-right">Sub-Total</td>
                                            <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa"><?= number_format($sub_total, 2, ',', '.') ?></td>
                                            <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa"><?= number_format($sub_total_paid, 2, ',', '.') ?></td>
                                            <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa"><?= number_format($sub_total_variance, 2, ',', '.') ?></td>
                                            <td align="center" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa"></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($i == (count($table)-1)) : ?>
                                        <tr>
                                            <td align="center"></td>                                   
                                            <td align="left"></td>
                                            <td align="center" class="font-white sbold bg bg-blue-ebonyclay uppercase text-right">Grand Total</td>
                                            <td align="right" class="font-white sbold bg bg-blue-ebonyclay"><?= number_format($grand_total, 2, ',', '.') ?></td>
                                            <td align="right" class="font-white sbold bg bg-blue-ebonyclay"><?= number_format($grand_total_paid, 2, ',', '.') ?></td>
                                            <td align="right" class="font-white sbold bg bg-blue-ebonyclay"><?= number_format($grand_total_variance, 2, ',', '.') ?></td>
                                            <td align="center">
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endfor; ?>
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
<?php $this->load->view('finance/footer_sub_modul'); ?>