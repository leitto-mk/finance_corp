<?php $this->load->view('finance_corp/payable/header_corp'); ?>
<div class="main_content">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="text-uppercase font-dark bold" style="margin-left: 10px">List Receipt Payment</h4>
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
                                <a href="<?php echo site_url('Acc_pay/add_payment_po') ?>" target="_blank" class="btn btn-md btn blue-oleo">
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
                                <tr class="font-white sbold">
                                    <td align="center"></td>
                                    <td align="left"></td>
                                    <td align="left"></td>
                                    <td align="left"></td>
                                    <td align="right"></td>
                                    <td align="center">
                                        <a href="#" type="button" class="btn btn-xs green">
                                            <i class="fa fa-edit"> </i>
                                        </a>
                                        <a href="javascript:;" name="delete" type="button" class="btn btn-xs red">
                                            <i class="fa fa-trash"> </i>
                                        </a>
                                    </td>
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
    const base_url = "<?= base_url() ?>"
    window.onload = load_function;

    function load_function() {
        document.body.style.zoom = 0.9;
    }
</script>
<?php $this->load->view('finance_corp/payable/footer'); ?>