<?php $this->load->view('header_footer/header_main'); ?>
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
            <div class="portlet bordered light" style="margin-top: -10px">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-white">
                        <div class="input-group input-large pull-left">
                            <span class="input-group-btn">
                                <a class="btn btn-md btn blue-oleo">
                                    From
                                </a>
                            </span>
                            <input type="date" class="form-control" id="date_from" value="<?= date('Y-m-01') ?>" style="width: 150px">
                        </div>
                        <div class="input-group input-large pull-left" style="margin-left: -95px">
                            <span class="input-group-btn">
                                <a class="btn btn-md btn blue-oleo">
                                    To
                                </a>
                            </span>
                            <input type="date" class="form-control" id="date_to" value="<?= date('Y-m-t') ?>" style="width: 150px">
                        </div>
                        <div class="input-group input-large pull-left" style="margin-left: -115px">
                            <span class="input-group-btn">
                                <a id="preview" class="btn btn-md btn bg-dark font-white">
                                    Preview
                                </a>
                            </span>
                        </div>


                        <div class="input-group input-large pull-right">
                            <input type="text" class="form-control" placeholder="Search By Doc No" name="search_item" id="search_item">
                            <span class="input-group-btn">
                                <button id="search" class="btn dark">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            <span class="input-group-btn">
                                <a href="<?php echo site_url('Entry/add_receipt_voucher') ?>" target="_blank" class="btn btn-md btn blue-oleo">
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
                                <tr style="background-color: #2C3E50" class="font-white">
                                    <th class="text-center" width="10%"> Trans Date </th>
                                    <th class="text-center" width="10%"> Doc No </th>
                                    <th class="text-center" width="10%"> Trans Type </th>
                                    <th class="text-center" width="17%"> Branch  </th>
                                    <th class="text-center" width="20%"> Description  </th>
                                    <th class="text-center" width="10%"> Amount </th>
                                    <th class="text-center" width="10%"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                               
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
<?php $this->load->view('header_footer/footer_main'); ?>