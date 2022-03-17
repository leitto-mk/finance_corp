<?php $this->load->view('financecorp/header_footer/header_main'); ?>
<div class="main_content">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="text-uppercase font-dark bold" style="margin-left: 10px">Calculate Branch</h4>
                    </div>
                </div>
            </div>
            <div class="portlet-body form-horizontal hidden-print">
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-blue-dark font-white">
                                <th class="text-center" width="5%"></th>
                                <th class="text-center" width="18%">Branch / Site</th>
                                <th class="text-center" width="18%">Account No Start</th>
                                <th class="text-center" width="18%">Account No End</th>
                                <th class="text-center" width="18%">Date Origin</th>
                                <th class="text-center" width="5%" class="text-center">Action</th>        
                            </tr>
                        </thead>
                        <tbody id="param_branch">
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
                                            <a class="btn btn-sm btn-success text-center" id="calculate_branch">
                                                <center>RECALCULATE</center>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="bg-white text-uppercase margin-bottom-20 " style="border-top: solid 4px; background-color: white">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="text-uppercase font-dark bold" style="margin-left: 10px">Calculate Employee</h4>
                    </div>
                </div>
            </div>
            <div class="portlet-body form-horizontal hidden-print">
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-blue-dark font-white">
                                <th class="text-center" width="5%"></th>
                                <th class="text-center" width="18%">Employee</th>
                                <th class="text-center" width="18%">Date Origin</th>
                                <th class="text-center" width="5%" class="text-center">Action</th>        
                            </tr>
                        </thead>
                        <tbody id="param_emp">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label bold text-center">Parameters</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select id="employee" name="employee" class="form-control" required>
                                                <option value="">-- Choose --</option>
                                                <option value="all">All</option>
                                                <?php for($i = 0; $i < count($employee); $i++) : ?>
                                                    <option value="<?= $employee[$i]['IDNumber'] ?>"><?= $employee[$i]['IDNumber']?> | <?= $employee[$i]['FullName'] ?></option>
                                                <?php endfor; ?>
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
                                        <div class="col-md-12 text-center">
                                            <a class="btn btn-sm btn-success" id="calculate_emp">
                                                <center>RECALCULATE</center>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('financecorp/header_footer/footer_main'); ?>