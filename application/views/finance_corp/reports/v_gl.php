<?php $this->load->view('header_footer/finance_corp/header_sub_modul_sf_no_trees'); ?>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right hidden-print">
                    <div class="portlet light form-horizontal bg-default">
                        <?php echo form_open('Report/view_get_rep_trans', 'role="form"', 'enctype="multipart/form-data"'); ?>
                            <div class="portlet-body form-horizontal hidden-print" style="margin-top: 20px">
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-blue-dark font-white">
                                                <th valign="top" width="5%"></th>
                                                <th valign="top" width="18%">Branch / Site</th>
                                                <th valign="top" width="18%">Account No Start</th>
                                                <th valign="top" width="18%">Account No End</th>
                                                <th valign="top" width="18%">Date Start</th>
                                                <th valign="top" width="18%">Date End</th>        
                                                <th valign="top" width="5%" class="text-center">Action</th>        
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
                                                                <option value="All" selected>All</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="bucode" id="bucode">
                                                                <option>All</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="bucode" id="bucode">
                                                                <option>All</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="date" name="companydes" id='companydes' value="" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="date" name="companydes" id='companydes' value="" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <center><input class="btn btn-sm btn-success" type="submit" name="submit" value="PRIVIEW"></center>
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
                            <span class="caption-subject bold uppercase font-white"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Date :  01-Jan-2021 - 06-Mei-2021
                                <div class="input-group input-large pull-right" style="margin-top: -5px">
                                   <!--  <input type="text" class="form-control" placeholder="Search for..." name="search_item" id="search_item">
                                    <span class="input-group-btn">
                                        <button  class="btn dark">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span> -->
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-xs btn green hidden-print pull-right"  onclick="printDiv('printDiv')" style="margin-left: 5px">
                                            <i class="fa fa-plus"></i>&nbsp;Print</i>
                                        </a>
                                        <a onclick="window.close();" class="btn btn-xs btn red hidden-print pull-right"><i class="fa fa-close"></i> Close</a>
                                    </span>

                                </div> 
                            </span>
                        </div>   
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped table-condensed">
                                    <thead>
                                        <tr style="background-color: #22313F" class="font-white">
                                            <th class="text-center" width="7%"> Date </th>
                                            <th class="text-center" width="8%"> Doc No </th>
                                            <th class="text-center" width="8%"> Cheque/Giro </th>
                                            <th class="text-center" width="8%"> Branch </th>
                                            <th class="text-center" width="5%"> Department </th>
                                            <th class="text-center" width="10%"> Cost Center </th>
                                            <th class="text-center" width="12%"> AccNo  </th>
                                            <th class="text-center" width="17%"> Remarks </th>
                                            <th class="text-right" width="8%"> Debit </th>
                                            <th class="text-right" width="8%"> Credit </th>
                                            <th class="text-right" width="12%"> Balance </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="background-color: white">
                                            <td colspan="11" class="bold">11101 - Cash</td>
                                        </tr>
                                        <tr class="font-white sbold">
                                            <td class="bold" align="right" colspan="9">Beginning Balance</td>
                                            <td class="bold" align="right" colspan="2">0.00</td>
                                        </tr>
                                        <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                            <td align="right" colspan="8">Total :</td>                                    
                                            <td align="right">0.00</td>                                    
                                            <td align="right">0.00</td>                                 
                                            <td align="right" class="font-white sbold bg bg-blue-ebonyclay">0.00</td>
                                        </tr>



                                        <tr style="background-color: white">
                                            <td colspan="11" class="bold">11303 - Piutang Student SD</td>
                                        </tr>
                                        <tr class="font-white sbold">
                                            <td class="bold" align="right" colspan="9">Beginning Balance</td>
                                            <td class="bold" align="right" colspan="2">0.00</td>
                                        </tr>

                                        <tr class="font-white sbold">
                                            <td class="bold" align="center">06-05-2021</td>
                                            <td class="bold" align="">2021-00001</td>
                                            <td class="bold" align="">TEST2021-00001</td>
                                            <td class="bold" align="">JKT</td>
                                            <td class="bold" align="">100</td>
                                            <td class="bold" align="">CostCenterA</td>
                                            <td class="bold" align="">1100104</td>
                                            <td class="bold" align="">Test JKT 2021-00001</td>
                                            <td class="bold" align="right">0.00</td>
                                            <td class="bold" align="right">3.000.000.00</td>
                                            <td class="bold" align="right">3.000.000.00</td>
                                        </tr>

                                        <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                            <td align="right" colspan="8">Total :</td>                                    
                                            <td align="right">0.00</td>                                    
                                            <td align="right">0.00</td>                                 
                                            <td align="right" class="font-white sbold bg bg-blue-ebonyclay">0.00</td>
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
<?php $this->load->view('header_footer/finance_corp/footer_sub_modul_sf'); ?>