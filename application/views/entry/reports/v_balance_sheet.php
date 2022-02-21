<?php $this->load->view('header_footer/entry/header_sub_modul_sf_no_trees'); ?>
<div class="portlet light">
    <div class="row">
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
            <!-- <php $date = date("d-M-Y") ?> -->
                <!-- <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 invoice-logo-space hidden-print">
                    <img src="<?php echo base_url(); ?>assets/assets/pages/img/logos/logotwc.png" width="20%" class="img-responsive" alt="" /><br>
                    <div>
                        <font size="6">Company Name</font><br>
                        <font>Jl. Company Address</font><br>
                        <font>City, Postal Code</font><br>
                        <font>Phone : (0431) xxx-xxx</font><br>
                        <font>Mobile : 0813-xxxx-xxxx</font><br>
                        <font>Email : companyemail@email.com</font>
                    </div>
                </div> -->
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pull-left hidden-print">
                    <div class="portlet light form-horizontal bg-default">
                        <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                            <div class="portlet-body form-horizontal hidden-print" style="margin-top: 20px">
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th width="5%"></th>
                                                <th class="text-center" width="40%">Branches / Sites</th>
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
                                                                <option value="">-- Choose --</option>
                                                                <option value="All">All</option>
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="date" name="date_start" id='date_start' value="<?= date('Y-01-01') ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="date" name="date_finish" id='date_finish' value="<?= date('Y-m-d') ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="portlet bordered light bg-blue-dark">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-white"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Date :  <span id="label_tbl_date_start"><?= date('01-01-Y'); ?></span> --> <span id="label_tbl_date_finish"><?= date('d-m-Y'); ?></span>
                                <div class="input-group input-large pull-right" style="margin-top: -5px">
                                   <!--  <input type="text" class="form-control" placeholder="Search for..." name="search_item" id="search_item">
                                    <span class="input-group-btn">
                                        <button  class="btn dark">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span> -->
                                    <span class="input-group-btn">
                                        <a id="print_report" href="<?= base_url('Reports/view_reps_balance_sheet') ?>" target="_blank" class="btn btn-xs btn green hidden-print pull-right" style="margin-left: 5px">
                                            <i class="fa fa-plus"></i>&nbsp;Print</i>
                                        </a>
                                        <a onclick="window.close();" class="btn btn-xs btn red hidden-print pull-right"><i class="fa fa-close"></i> Close</a>
                                    </span>

                                </div> 
                            </span>
                        </div>   
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table id="table_gl" class="table table-bordered table-stripped table-condensed">
                                    <thead>
                                        <tr style="background-color: #22313F" class="font-white">
                                            <th class="text-center" width="5%"> No. </th>
                                            <th class="text-center" width="25%"> Branch </th>
                                            <th class="text-center" width="10%"> Year  </th>
                                            <th class="text-center" width="10%"> Month </th>
                                            <th class="text-center" width="10%"> Account No </th>
                                            <th class="text-center" width="25%"> Account Name </th>
                                            <th class="text-right" width="15%"> Balance </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr class="font-white sbold">
                                                <td class="bold" align="center">1</td>
                                                <td class="bold" align="left">AAA</td>
                                                <td class="bold" align="left">2021</td>
                                                <td class="bold" align="left">August</td>
                                                <td class="bold" align="left">1101</td>
                                                <td class="bold" align="left">Cash</td>
                                                <td class="bold" align="right">1,000,000</td>
                                            </tr>

                                            
                                            <tr class="font-white sbold">
                                                <td class="bold" align="right" colspan="6">Beginning Balance</td>
                                                <td class="sbold uppercase font-green-meadow" align="right" colspan="3" style="font-size: 1.25em">0</td>
                                            </tr>
                                            <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                                <td align="right" colspan="4">Total :</td>                                    
                                                <td align="right">0</td>
                                                <td align="right">0</td>
                                                <td align="right" class="font-white sbold bg bg-blue-ebonyclay">0</td>
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
<?php $this->load->view('header_footer/entry/footer_sub_modul_sf'); ?>