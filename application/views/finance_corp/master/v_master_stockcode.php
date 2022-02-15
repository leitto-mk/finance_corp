<?php $this->load->view('mmenu/header');?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view('mmenu/sidebar'); ?>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN BREADCRUMBS -->
            <div class="breadcrumbs">
                <ol class="breadcrumb" style="background-color: white">
                    <li>
                        <a href="#">Master</a>
                    </li>
                    <li>
                        <a href="#">Persediaan</a>
                    </li>
                    <li class="active">Stock</li>
                    <a href="<?php echo site_url('APOSMaster/form_add_stockcode')?>" title="Add New Stockcode" class="pull-right" style="margin-top: -5px">
                        <button class="btn blue btn-sm btn-outline"><i class="fa fa-plus"></i> Stockcode</button>
                    </a>                   
                </ol>
                <!-- Sidebar Toggle Button -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#page-sidebar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="toggle-icon">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </span>
                </button>
                <!-- Sidebar Toggle Button -->
            </div>
            <!-- END BREADCRUMBS -->
            <div class="row" style="margin-top: -8px">
                <div class="containers">  
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="portlet light" style="background-color: white">
                            <div class="portlet-body">
                                <table id="mytable_list_stock" class="table table-bordered table-hover order-column">
                                    <thead class="font-dark bg-grey-salt">
                                        <tr>
                                            <th width="2%" class="text-center" data-orderable="false">#</th>
                                            <th width="">Stockcode</th>
                                            <th width="">Barcode</th>
                                            <th width="">Stock Name</th>
                                            <th width="">Manufacture</th>
                                            <th width="">Model No</th>
                                            <th width="">UOM</th>
                                            <th width="">Photo</th>
                                            <th width="" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->            
</div>
<!-- END CONTAINER -->

<div id="m_detail_stock" class="modal fade" tabindex="-1" role="basic" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Stock Description</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="30%" class="bold" style="border-top: none;"> Stockcode </td>
                                        <td width="1%" style="border-top: none;"> : </td>
                                        <td id="stock_detail_1" style="border-top: none;">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> Stock Name </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_2">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> Manufacture No </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_3">-</td>
                                    </tr>                                        
                                    <tr>
                                        <td width="30%" class="bold"> Manufacture Desc </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_4">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> Model </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_5">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> Size </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_6">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> Color </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_7">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> UOM </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_8">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> UOM Qty </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_9">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> StockGroup </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_10">-</td>
                                    </tr>
                                    <!-- <tr>
                                        <td width="30%" class="bold"> Stocked </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_11">-</td>
                                    </tr> -->
                                    <tr>
                                        <td width="30%" class="bold"> Dangerous </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_12">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> Photo </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_13">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> Barcode </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_14">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> Document Ref. </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_15">-</td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="bold"> Disc </td>
                                        <td width="1%"> : </td>
                                        <td id="stock_detail_16">-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>               
            </div>            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php 
// $this->load->view('master/v_modal_master_stockgroup');
// $this->load->view('master/v_modal_master_crud');
$this->load->view('mmenu/footer');
?>
<script type="text/javascript">
window.onload = load_function;

function load_function(){  
    $('.menu-master').addClass('start active open');
    $('.arrow-master').remove();
    $('.menut-master').after('<span class="selected"></span><span class="arrow open"></span>');
    $('.menu-stock').addClass('start active open');
    $('.arrow-stock').remove();
    $('.menut-stock').after('<span class="selected"></span><span class="arrow open"></span>');
    $('.smenu-stockcode').addClass('start active open');
    $('.smenut-stockcode').after('<span class="selected">');   
    // transt_action();
    get_list_stock_dt();    
}

function transt_action(){
    var transt_action = '';
    transt_action += '<div class="page-actions">';
    transt_action += '<div class="btn-group">';
    transt_action += '<a href="<?php echo site_url('APOSMaster/form_add_stockcode'); ?>" target="_blank" class="btn blue mt-ladda-btn ladda-button">';
    transt_action += '<i class="fa fa-plus"></i>&nbsp;';
    transt_action += '<span class="hidden-sm hidden-xs">&nbsp;Add Stockcode&nbsp;</span>&nbsp;';    
    transt_action += '</a>';    
    transt_action += '</div>';
    transt_action += '</div>';
    $('.trans-action').before(transt_action);
}

function get_list_stock_dt(){
    // Setup Databels
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings){
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var table = $('#mytable_list_stock').dataTable({
        initComplete : function(){
            var api = this.api();
            $('#mytable_list_stock_filter input').off('.DT').on('input.DT', function() {
                api.search(this.value).draw();
            });
        },
            oLanguage : {
                sProcessing : "Loading.."
            },
                processing : true,
                serverSide : true,
                ajax : {
                    url     : "<?php echo site_url('APOSMaster/list_stock_dt'); ?>",
                    type    : "POST"
                },
                columns : [
                    {"data"   : "CtrlNo", className: "text-center"},
                    {"data"   : "Stockcode"},
                    {"data"   : "Barcode"},
                    {"data"   : "StockDescription"},
                    {"data"   : "ManufactureDesc"},
                    {"data"   : "ModelNo"},
                    {"data"   : "UOM"},
                    {"data"   : "Photo"},                    
                    {"data"   : "view", className: "text-center", "orderable": false},
                ],
                order    : [[1, 'asc']],
        rowCallback : function(row, data, iDisplayIndex){
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page*length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });
    // End Setup Databels

    // {"data"   : function(data, type, dataToSet){
    //     var checkbox = '';
    //     if (data.Stocked == "1") {
    //         checkbox += '<label class="mt-checkbox mt-checkbox-outline"> <input type="checkbox" value="1" name="stock_cstocked[]" checked disabled="disabled"><span></span></label>';
    //     } else {
    //         checkbox += '<label class="mt-checkbox mt-checkbox-outline"> <input type="checkbox" value="1" name="stock_cstocked[]" disabled="disabled"><span></span></label>';
    //     }
    //     return checkbox;
    // }, className: "text-center" , "orderable": false},
}

</script>
<script src="<?=base_url('js/js_master_stockgroup.js')?>" type="text/javascript"></script>
