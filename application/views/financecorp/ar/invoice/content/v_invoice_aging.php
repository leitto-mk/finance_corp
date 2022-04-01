<?php $this->load->view('financecorp/ar/invoice/layout/header_aging'); ?>
<style type="text/css">
    tr:nth-child(even){
        background-color: #eef1f5;
    }

    tr:nth-child(odd){
        background-color: white;
    }
</style>
<div class="portlet light">
    <div class="row">
        <div class="col-md-12" id="printDiv" style="size: landscape; font-family: Open Sans, sans-serif;" >
            <div class="row invoice-logo" align="left">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left hidden-print">
                    <div class="portlet light form-horizontal bg-default">
                        <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                            <div class="portlet-body form-horizontal hidden-print" style="margin-top: 60px">
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th width="5%"></th>
                                                <th class="text-center" width="25%">Branch</th>
                                                <th class="text-center" width="25%">Customer</th>
                                                <th class="text-center" width="25%">Age By</th>
                                                <th class="text-center" width="20%">Start Date</th>
                                                <th class="text-center" width="10%">Action</th>        
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
                                                            <select name="branch" id="branch" class="form-control" required>
                                                                <option value="">-- Select Branch --</option>
                                                                <?php for($i=0; $i<count($branch); $i++) : ?>) : ?>
                                                                    <option value="<?= $branch[$i]['BranchCode'] ?>"><?= $branch[$i]['BranchName'] ?></option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select name="customer" id="customer" class="form-control" data-value="" required>
                                                                <option value="">-- Select Customer --</option>
                                                                <?php if (!empty($customer)) : ?>
                                                                    <?php for ($i = 0; $i < count($customer); $i++) : ?>
                                                                        <option value="<?= $customer[$i]['CustomerCode'] ?>"><?= $customer[$i]['CustomerName'] ?></option>
                                                                    <?php endfor; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select name="aging" id="aging" class="form-control" data-value="" required>
                                                                <option value="raised_date" selected>Raised Date</option>
                                                                <option value="due_date">Due Date</option>
                                                            </option>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="date" name="date_start" id='date_start' value="<?= date('Y-m-d') ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <a class="btn btn-sm bg-blue-madison font-white" id="submit_filter">
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
                <div class="col-md-12">
                    <div class="portlet bordered light">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <div>
                                    <h2 size="sbold text-center"><?= $company ?></h2>
                                    <div size="4" class="font-dark sbold uppercase">Invoice Aging</d><br>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table id="table_summary" class="table table-bordered table-stripped table-condensed">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th class="text-center" width="3%"> No </th>
                                                <th class="text-center" width="10%"> Customer </th>
                                                <th class="text-center" width="14%"> Outstanding </th>
                                                <th class="text-center" width="15%"> 0-30 </th>
                                                <th class="text-center" width="15%"> 31-60 </th>
                                                <th class="text-center" width="15%"> 61-90 </th>
                                                <th class="text-center" width="15%"> 91 and Over </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <tr>
                                               <td colspan="7" class="sbold text-center">-- Select Parameter --</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet bordered light">
                        <div class="row">
                            <div class="caption">
                                <span class="caption-subject bold uppercase font-dark">Aged Due 0 - 30 Days</span>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table id="table_q1" class="table table-bordered table-stripped table-condensed">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th class="text-center" width="5%"> No </th>
                                                <th class="text-center" width="10%"> Invoice No </th>
                                                <th class="text-center" width="5%"> Terms </th>
                                                <th class="text-center" width="8%"> Invoice Date  </th>
                                                <th class="text-center" width="8%"> Due Date </th>
                                                <th class="text-center" width="10%"> Amount </th>
                                                <th class="text-center" width="10%"> Receipt </th>
                                                <th class="text-center" width="10%"> Oustanding </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td>
                                                <td colspan="8" class="sbold text-center">-- Select Parameter --</td>
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    
                            <div class="caption">
                                <span class="caption-subject bold uppercase font-dark">Aged Due 31 - 60 Days</span>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table id="table_q2" class="table table-bordered table-stripped table-condensed">
                                        <thead>
                                           <tr class="bg-blue-dark font-white">
                                                <th class="text-center" width="5%"> No </th>
                                                <th class="text-center" width="10%"> Invoice No </th>
                                                <th class="text-center" width="5%"> Terms </th>
                                                <th class="text-center" width="8%"> Invoice Date  </th>
                                                <th class="text-center" width="8%"> Due Date </th>
                                                <th class="text-center" width="10%"> Amount </th>
                                                <th class="text-center" width="10%"> Receipt </th>
                                                <th class="text-center" width="10%"> Oustanding </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td>
                                                <td colspan="8" class="sbold text-center">-- Select Parameter --</td>
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    
                            <div class="caption">
                                <span class="caption-subject bold uppercase font-dark">Aged Due 61 - 90 Days</span>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table id="table_q3" class="table table-bordered table-stripped table-condensed">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th class="text-center" width="5%"> No </th>
                                                <th class="text-center" width="10%"> Invoice No </th>
                                                <th class="text-center" width="5%"> Terms </th>
                                                <th class="text-center" width="8%"> Invoice Date  </th>
                                                <th class="text-center" width="8%"> Due Date </th>
                                                <th class="text-center" width="10%"> Amount </th>
                                                <th class="text-center" width="10%"> Receipt </th>
                                                <th class="text-center" width="10%"> Oustanding </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td>
                                                <td colspan="8" class="sbold text-center">-- Select Parameter --</td>
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    
                            <div class="caption">
                                <span class="caption-subject bold uppercase font-dark">Aged Due 90 Days - Over</span>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table id="table_q4" class="table table-bordered table-stripped table-condensed">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th class="text-center" width="5%"> No </th>
                                                <th class="text-center" width="10%"> Invoice No </th>
                                                <th class="text-center" width="5%"> Terms </th>
                                                <th class="text-center" width="8%"> Invoice Date  </th>
                                                <th class="text-center" width="8%"> Due Date </th>
                                                <th class="text-center" width="10%"> Amount </th>
                                                <th class="text-center" width="10%"> Receipt </th>
                                                <th class="text-center" width="10%"> Oustanding </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td>
                                                <td colspan="8" class="sbold text-center">-- Select Parameter --</td>
                                            </td>
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
<?php $this->load->view('financecorp/ar/invoice/layout/footer_aging'); ?>