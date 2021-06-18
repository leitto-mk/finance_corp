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
                            <!-- <span class="input-group-btn">
                                <a href="<?php echo site_url('Finance/view_add_rec_voucher') ?>" target="_blank" class="btn btn-md btn blue-oleo">
                                    <i class="fa fa-plus"></i>&nbsp;Add New</i>
                                </a>
                            </span> -->
                        </div>
                    </span>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed">
                            <thead>
                                <tr style="background-color: #22313F" class="font-white">
                                    <th class="text-center" width="10%"> Trans Date </th>
                                    <th class="text-center" width="20%"> Student </th>
                                    <th class="text-center" width="8%"> Room  </th>
                                    <th class="text-center" width="22%"> Cashier </th>
                                    <th class="text-center" widtsh="10%"> Amount </th>
                                    <th class="text-center" width="10%"> Remarks </th>
                                    <th class="text-center" width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $room = '';
                                    $count_room = 0;
                                    $count_std = 0;
                                    $sub_total = 0;
                                ?>
                                <?php if(count($table) == 0) : ?>
                                    <tr style="background-color: white">
                                        <td colspan="7" class="bold text-center uppercase">NO DATA TO SHOW...</td>
                                    </tr>
                                <?php endif; ?>
                                <?php for($i = 0; $i < count($table); $i++) : ?>
                                    <?php if($room !== $table[$i]['CostCenter']) : ?>
                                        <tr style="background-color: white">
                                            <td colspan="7" class="bold">ROOM <?= $table[$i]['CostCenter'] ?> - Wali Kelas: <?= $table[$i]['Homeroom'] ?></td>
                                        </tr>
                                        <?php
                                            $room = $table[$i]['CostCenter'];
                                            $count_room += 1;
                                            $count_std = 1;
                                            $sub_total = 0;
                                        ?>
                                    <?php endif; ?>
                                    <tr class="font-white sbold">
                                        <td align="center"><?= date('d-m-Y', strtotime($table[$i]['TransDate'])) ?> </td>
                                        <td align="left"><?= $table[$i]['IDNumber'] . ' - ' . $table[$i]['FullName'] ?></td>
                                        <td align="center"><?= $table[$i]['CostCenter'] ?></td>
                                        <td align="center"><?= $this->session->userdata('id') . ' - ' .  $this->session->userdata('fname') . ' - ' . $this->session->userdata('lname') ?></td>
                                        <td align="right">
                                            <?php
                                                $balance = $table[$i]['Balance'];

                                                if($balance < 0){
                                                    $balance = abs($balance);
                                                    $balance = number_format($balance, 2, ',', '.');
                                                    
                                                    echo '(' . $balance . ')';
                                                }else{
                                                    echo number_format($balance, 2, ',', '.');
                                                }
                                            ?>
                                        </td>
                                        <td align="left"><?= $table[$i]['Remarks'] ?></td>
                                        <td align="center">
                                            <a href="#" type="button" class="btn btn-xs blue" title="Detail">
                                                <i class="fa fa-search"> </i>
                                            </a>
                                            <a href="<?= base_url("Finance/view_add_rec_voucher?") 
                                                . "docno=" . $receive_docno 
                                                . "&nis=" . $table[$i]['IDNumber']
                                                . "&transdate=" . $table[$i]['TransDate']
                                                . "&school=" . $table[$i]['School']?>" 
                                               target="_blank" class="btn btn-xs green" title="Receipt">Receipt
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                        $count_std += 1;
                                        $sub_total += $table[$i]['Balance'];

                                        // $sub_total = $table[$i]['Balance'];
                                    ?>
                                    <?php if(!isset($table[$i+1]['CostCenter']) || $table[$i+1]['CostCenter'] !== $room) : ?>
                                        <?php
                                            if($sub_total < 0){
                                                $sub_total = abs($sub_total);
                                                $sub_total = number_format($sub_total, 2, ',', '.');
                                                
                                                $sub_total = '(' . $sub_total . ')';
                                            }else{
                                                $sub_total = number_format($sub_total, 2, ',', '.');
                                            }    
                                        ?>
                                        <tr class="font-white sbold">
                                            <td colspan="4"></td>                                 
                                            <td align="right" style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa"><?= $sub_total ?></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <?php
                                            $sub_total = 0;
                                            $room = (isset($table[$i+1]['CostCenter']) ? $table[$i+1]['CostCenter'] : '');
                                        ?>
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