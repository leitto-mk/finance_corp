<?php $this->load->view('header_footer/finance_corp/header_main'); ?>
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
                    <span class="caption-subject bold uppercase font-white">
                        <div class="input-group input-large pull-left" style="margin-top: -5px">
                            <span class="input-group-btn">
                                <a class="btn btn-md btn blue-oleo">
                                    From
                                </a>
                            </span>
                            <input type="date" class="form-control" id="date_from" value="<?= date('Y-01-01') ?>" style="width: 150px">
                        </div>
                        <div class="input-group input-large pull-left" style="margin-top: -5px; margin-left: -100px ">
                            <span class="input-group-btn">
                                <a class="btn btn-md btn blue-oleo">
                                    To
                                </a>
                            </span>
                            <input type="date" class="form-control" id="date_to" value="<?= date('Y-m-d') ?>" style="width: 150px">
                        </div>
                        <div class="input-group input-large pull-left" style="margin-top: -5px; margin-left: -120px">
                            <span class="input-group-btn">
                                <a id="preview" class="btn btn-md btn bg-dark font-white">
                                    Preview
                                </a>
                            </span>
                        </div>


                        <div class="input-group input-large pull-right" style="margin-top: -5px">
                            <input type="text" class="form-control" placeholder="Search By Doc No" name="search_item" id="search_item">
                            <span class="input-group-btn">
                                <button id="search" class="btn dark">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            <span class="input-group-btn">
                                <a href="<?php echo site_url('FinanceCorp/add_receipt_voucher') ?>" target="_blank" class="btn btn-md btn blue-oleo">
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
                                    <th class="text-center" width="10%"> Trans Date </th>
                                    <th class="text-center" width="10%"> Doc No </th>
                                    <th class="text-center" width="10%"> Trans Type </th>
                                    <th class="text-center" width="17%"> Branch  </th>
                                    <th class="text-center" width="10%"> Amount </th>
                                    <th class="text-center" width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i =0; $i < count($list); $i++) : ?>
                                    <?php $docno = $list[$i]['DocNo']; ?>
                                    <tr class="font-white sbold">
                                        <td align="center"><?= $list[$i]['TransDate'] ?></td>
                                        <td align="left"><?= $list[$i]['DocNo'] ?></td>
                                        <td align="left"><?= $list[$i]['TransType'] ?></td>
                                        <td align="left"><?= $list[$i]['Branch'] ?></td>
                                        <td align="right"><?= $list[$i]['TotalAmount'] ?></td>
                                        <td align="center">
                                            <a href="<?= base_url("financecorp/edit_receipt?docno=$docno")?>" target="_blank" type="button" class="btn btn-xs green">
                                                <i class="fa fa-edit"> </i>
                                            </a>
                                            <a href="javascript:;" name="delete" data-docno="<?= $list[$i]['DocNo'] ?>" data-branch="<?= $list[$i]['Branch'] ?>" data-transdate="<?= $list[$i]['TransDate'] ?>" type="button" class="btn btn-xs red">
                                                <i class="fa fa-trash"> </i>
                                            </a>
                                        </td>
                                    </tr>
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
    const base_url = "<?= base_url() ?>"
    window.onload = load_function;

    function load_function() {
        document.body.style.zoom = 0.9;
    }
</script>
<?php $this->load->view('header_footer/finance_corp/footer_main'); ?>