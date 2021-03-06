<?php $this->load->view('financecorp/header_footer/header_sub_modul_sf_no_trees'); ?>
<!-- <div class="portlet light"> -->
<div class="portlet light" style="background-color: #eff2f6;">
    <div class="row">
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
            <!-- <php $date = date("d-M-Y") ?> -->
                <!-- <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 invoice-logo-space hidden-print">
                    <img src="<?= base_url() ?>assets/assets/metronic/pages/img/logos/logotwc.png" width="20%" class="img-responsive" alt="" /><br>
                    <div>
                        <font size="6">Company Name</font><br>
                        <font>Jl. Company Address</font><br>
                        <font>City, Postal Code</font><br>
                        <font>Phone : (0431) xxx-xxx</font><br>
                        <font>Mobile : 0813-xxxx-xxxx</font><br>
                        <font>Email : companyemail@email.com</font>
                    </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right hidden-print">
                    <!-- <div class="portlet light form-horizontal bg-default"> -->
                    <div class="portlet light bordered form-horizontal">
                        <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                            <!-- <div class="portlet-body form-horizontal hidden-print" style="margin-top: 20px"> -->
                            <div class="portlet-body form-horizontal hidden-print">
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th class="text-center" width="5%"></th>
                                                <th class="text-center" width="18%">Branch / Site</th>
                                                <th class="text-center" width="18%">Account No Start</th>
                                                <th class="text-center" width="18%">Account No End</th>
                                                <th class="text-center" width="18%">Date Start</th>
                                                <th class="text-center" width="18%">Date End</th>        
                                                <th class="text-center" width="5%" class="text-center">Action</th>        
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
                                                                <?php foreach($branch as $branch) : ?>
                                                                    <option value="<?= $branch->BranchCode?>">[<?= $branch->BranchCode?>] <?= $branch->BranchName ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="accno_start" id="accno_start">
                                                                <option value="">-- Choose --</option>
                                                                <?php foreach($account_no as $accno) : ?>
                                                                    <option value="<?= $accno->Acc_No?>">[<?= $accno->Acc_No?>] <?= $accno->Acc_Name?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="accno_finish" id="accno_finish">
                                                                <option value="">-- Choose --</option>
                                                                <?php foreach($account_no as $accno) : ?>
                                                                    <option value="<?= $accno->Acc_No?>">[<?= $accno->Acc_No?>] <?= $accno->Acc_Name?></option>
                                                                <?php endforeach; ?>
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
                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="portlet bordered light bg-blue-dark"> -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: -20px;">
                    <div class="portlet light bordered">
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
                                        <?php
                                            $date_start = date('Y-01-01');
                                            $date_finish = date('Y-m-d');
                                        ?>
                                        <a id="print_report" href="<?= base_url("Reports/view_gl_branch_report?branch=All&accno_start=10000&accno_finish=99999&date_start=$date_start&date_finish=$date_finish") ?>" target="_blank" class="btn btn-xs btn green hidden-print pull-right" style="margin-left: 5px">
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
                                        <tr class="bg-blue-dark font-white">
                                            <th class="text-center" width="3%"> No. </th>
                                            <th class="text-center" width="7%"> Date </th>
                                            <th class="text-center" width="8%"> Doc No </th>
                                            <th class="text-center" width="3%"> Branch </th>
                                            <th class="text-center" width="2%"> Dept </th>
                                            <th class="text-center" width="3%"> CostC </th>
                                            <th class="text-center" width="10%"> AccNo  </th>
                                            <th class="text-center" width="15%"> Remarks </th>
                                            <th class="text-right" width="8%"> Debit </th>
                                            <th class="text-right" width="8%"> Credit </th>
                                            <th class="text-right" width="8%"> Balance </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center" style="background-color: white">
                                            <td colspan="12" class="bold">-- Select Parameters --</td>
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