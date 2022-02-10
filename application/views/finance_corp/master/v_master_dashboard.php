<?php
    $this->load->view('header_footer/finance_corp/master/header');
?>
<style type="text/css">
    .table td,th{
        border-top: 0px!important;
    }

    .profile-contact .table{
        margin-top: 10px;
    }

    .profile-contact .table th{
        padding: 12px 0px!important;
        color: #555555;
    }

    .profile-contact .table td{
        font-size: 16px;
        padding-right: 10px;
        color: #5e738b;
    }
</style>
<div class="">
    <div class="page-content bg-grey-steel">
        <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <!-- <h1>Master File</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url('APOS'); ?>">Home</a>
                </li>
                <li>
                    <a href="#">Pages</a>
                </li>
                <li class="active">System</li>
            </ol> -->
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
        <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
        <div class="page-content-container" style="margin-top: -40px">
            <div class="page-content-row">
                <?php $this->load->view('header_footer/finance_corp/master/sidebar_master'); ?>
                <div class="page-content-col">
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="tab-content">  
                        <div class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="portlet light bg-grey-cararra">
                                        <h1 class="uppercase bold text-center">Master Finance</h1>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="tab-pane" id="master_currency">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="portlet light bg-grey-cararra">
                                        <h1 class="uppercase bold"><i class="fa fa-money"></i> Currency</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet bordered light bg-grey-cararra">
                                <div class="portlet-title">
                                    <div class="tools">
                                        <a href="#" title="Add New Currency" class="pull-right" style="margin-top: -5px">
                                            <button class="btn blue" id="om_add_currency"><i class="fa fa-plus"></i> Currency</button>
                                        </a>
                                    </div> 
                                </div>
                                <div class="portlet-body">
                                    <table id="mytable_list_currency" class="table table-bordered table-hover order-column">
                                        <thead class="font-dark bg-grey-salt">
                                            <tr>
                                                <th class="text-center" data-orderable="false">No</th>
                                                <th>Currency</th>
                                                <th>Currency Name</th>
                                                <th>Disc</th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>
        </div>
        <!-- END SIDEBAR CONTENT LAYOUT -->
    </div>
<div id="m_add_currency" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-search"></i> Add Currency</h4>
            </div>
            <div class="modal-body">
                <form id="f_add_currency" class="form-horizontal" role="form" autocomplete="off">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Currency
                                    </label>
                                    <div class="col-md-4">
                                        <input name="n_cur" type="text" class="form-control" placeholder="Enter Currency Code" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Currency Name
                                    </label>
                                    <div class="col-md-6">
                                        <input name="n_curname" type="text" class="form-control" placeholder="Enter Currency Name" required>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Disc
                                    </label>
                                    <div class="col-md-2">
                                        <select name="n_disc" class="form-control" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Remarks</label>
                                    <div class="col-md-8">
                                        <input name="n_remarks" type="text" class="form-control" placeholder="Enter Remarks">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn yellow btn-outline reset-form" data-dismiss="modal">Close</button>
                <button form="f_add_currency" type="submit" class="btn green">Submit</button>
            </div>
        </div>
    </div>
</div>
<div id="m_edit_currency" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Currency</h4>
            </div>
            <div class="modal-body">
                <form id="f_edit_currency" class="form-horizontal" role="form" autocomplete="off">
                    <input type="hidden" name="id_accno">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Currency</label>
                                    <div class="col-md-4">
                                        <input name="currency" type="text" class="form-control" placeholder="Enter Currency">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Currency Name</label>
                                    <div class="col-md-6">
                                        <input name="currencyname" type="text" class="form-control" placeholder="Enter Currency Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <font color="red">*</font> Disc
                                    </label>
                                    <div class="col-md-2">
                                        <select id="i_disc" name="ei_disc" class="form-control" required>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Remarks</label>
                                    <div class="col-md-8">
                                        <input name="remarks" type="text" class="form-control" placeholder="Enter Remarks">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn yellow btn-outline reset-form" data-dismiss="modal">Close</button>
                <button type="submit" form="f_edit_currency" class="btn blue">Save</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('header_footer/finance_corp/master/footer'); ?>
<script type="text/javascript">
window.onload = load_function;

var table = null;

function load_function(){  


    $(document).on('click', '#om_add_currency', function() {
        $('#m_add_currency').modal('show');
    });

    $(document).on('click', '.reset-form', function() {
        $('#f_add_currency')[0].reset();
    });

    $(document).on('submit', '#f_add_currency', function(e) {
        e.preventDefault();
        // console.log($(this).serialize());
        var r = confirm("Are you sure want to Add Currency ?");
        var form = $('#f_add_currency').serializeArray()
        console.log(form)
        if (r == true) {
            $.ajax({
                url: "<?php echo site_url('Cmaster/add_cur'); ?>",
                data: $(this).serialize(),
                type: "POST",
                dataType: "json",
                success: function(res) {
                    if (res.rstatus != false) {
                        $('#m_add_currency').modal('hide');
                        toastr.options.closeButton = false;
                        toastr.options.debug = false;
                        toastr.options.positionClass = "toast-top-center";
                        toastr.options.onclick = null;
                        toastr.options.showEasing = "swing";
                        toastr.options.showMethod = "fadeIn";
                        toastr.options.hideMethod = "fadeOut";
                        toastr.options.showDuration = 1000;
                        toastr.options.hideDuration = 500;
                        toastr.options.timeOut = 3000;
                        toastr.success("Success !!!", "Currency added.");
                        setInterval(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        toastr.options.closeButton = false;
                        toastr.options.debug = false;
                        toastr.options.positionClass = "toast-top-center";
                        toastr.options.onclick = null;
                        toastr.options.showEasing = "swing";
                        toastr.options.showMethod = "fadeIn";
                        toastr.options.hideMethod = "fadeOut";
                        toastr.options.showDuration = 1000;
                        toastr.options.hideDuration = 500;
                        toastr.options.timeOut = 3000;
                        toastr.warning("Failed !!!", "Please Check your Data");
                    }
                },
                error: function() {
                    // alert("Submitting Error");
                    toastr.options.closeButton = false;
                    toastr.options.debug = false;
                    toastr.options.positionClass = "toast-top-center";
                    toastr.options.onclick = null;
                    toastr.options.showEasing = "swing";
                    toastr.options.showMethod = "fadeIn";
                    toastr.options.hideMethod = "fadeOut";
                    toastr.options.showDuration = 1000;
                    toastr.options.hideDuration = 500;
                    toastr.options.timeOut = 3000;
                    toastr.warning("Failed !!!", "Data Exist, Please Check your Data");
                }
            });
        } else {
            console.log("Add Canceled");
        }
    });

    $(document).on('submit', '#f_edit_currency', function(e) {
            e.preventDefault();
            var r = confirm("Are you sure want to Submit Edit Currency ?");
            var form = $('#f_edit_currency').serializeArray()
            console.log(form)
            if (r == true) {
                $.ajax({
                    url: "<?php echo site_url('Cmaster/edit_cur'); ?>",
                    data: $(this).serialize(),
                    type: "POST",
                    dataType: "json",
                    success: function(res) {
                        if (res.rstatus != false) {
                            $('#m_edit_currency').modal('hide');
                            toastr.options.closeButton = false;
                            toastr.options.debug = false;
                            toastr.options.positionClass = "toast-top-center";
                            toastr.options.onclick = null;
                            toastr.options.showEasing = "swing";
                            toastr.options.showMethod = "fadeIn";
                            toastr.options.hideMethod = "fadeOut";
                            toastr.options.showDuration = 1000;
                            toastr.options.hideDuration = 500;
                            toastr.options.timeOut = 3000;
                            toastr.success("Success", "Edit Currency.");
                            setInterval(function() {
                                location.reload();
                            }, 3000);
                        } else {
                            console.log(res.responseText)
                            toastr.options.closeButton = false;
                            toastr.options.debug = false;
                            toastr.options.positionClass = "toast-top-center";
                            toastr.options.onclick = null;
                            toastr.options.showEasing = "swing";
                            toastr.options.showMethod = "fadeIn";
                            toastr.options.hideMethod = "fadeOut";
                            toastr.options.showDuration = 1000;
                            toastr.options.hideDuration = 500;
                            toastr.options.timeOut = 3000;
                            toastr.warning("Failed", "Nothing Changed");
                        }
                    },
                    error: function() {
                        alert("Error Occur");
                    }
                });
            } else {
                console.log("Edit Canceled");
            }
    });

    $(document).on('click', '#edit_currency', function() {
        var r = confirm("Are you sure want to Edit Currency ?");
        if (r == true) {
            $('#m_edit_currency').modal('show');
            var ccode = $(this).attr('currency-code');
            console.log(ccode)
            $.ajax({
                url: "<?php echo site_url('Cmaster/get_detail_cur_to_edit'); ?>",
                data: {
                    currencycode: ccode
                },
                type: "POST",
                dataType: "json",
                success: function(data) {
                    var data_ = data.dcur[0];
                    $('input[name="currency"]').val(data_.Currency);
                    $('input[name="currencyname"]').val(data_.CurrencyName);

                    var htmldisc = '';
                    var data1 = data.yess;
                    htmldisc += '<option value="' + data_.Disc + '">' + data_.Disc + '*</option>';
                    if (data1 != '') {
                        htmldisc += '<option value="' + 'No' + '">' + 'No' + '</option>';
                        htmldisc += '<option value="' + 'Yes' + '">' + 'Yes' + '</option>';
                    } else {
                        htmldisc += '<option value="" selected>No Discontinue Assign</option>';
                    }
                    $('#i_disc').html(htmldisc);
                    $('#i_disc option[value="' + data_.Disc + '"]').prop('selected', 'selected');

                    $('input[name="remarks"]').val(data_.Remarks);
                    // id COA
                    $('input[name="id_accno"]').val(data_.Currency);
                },
                error: function() {
                    alert("Error Occur !");
                }
            });
        } else {
            console.log("Edit Canceled");
        }
    });

    $(document).on('click', '#delete_currency', function() {
        var r = confirm("Are you sure want to Delete Currency ?");
        if (r == true) {
            var ccode = $(this).attr('currency-code');
            $.ajax({
                url: "<?php echo site_url("Cmaster/delete_cur_by_accgid"); ?>",
                data: {
                    currencycode: ccode
                },
                type: "POST",
                dataType: "json",
                success: function(res) {
                    if (res.rstatus != false) {
                        toastr.options.closeButton = false;
                        toastr.options.debug = false;
                        toastr.options.positionClass = "toast-top-center";
                        toastr.options.onclick = null;
                        toastr.options.showEasing = "swing";
                        toastr.options.showMethod = "fadeIn";
                        toastr.options.hideMethod = "fadeOut";
                        toastr.options.showDuration = 1000;
                        toastr.options.hideDuration = 500;
                        toastr.options.timeOut = 3000;
                        toastr.success("Success !!!", "Currency " + res.Currency + " Deleted.");
                        setInterval(function() {
                            location.reload();
                        }, 3000);
                    } else {

                    }
                },
                error: function() {
                    alert('Error Occur !');
                }
            });
        } else {
            console.log("Delete Canceled");
        }
    });

}

$(document).on('click', '#get_list_currency', function() {
    get_list_currency_dt();
});

function get_list_currency_dt() {
    // Setup Databels
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
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

    table = $('#mytable_list_currency').dataTable({
        destroy: true,
        initComplete: function() {
            var api = this.api();
            $('#mytable_list_currency_filter input').off('.DT').on('input.DT', function() {
                api.search(this.value).draw();
            });
        },
        oLanguage: {
            sProcessing: "Loading.."
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo site_url('Cmaster/list_cur_dt'); ?>",
            type: "POST"
        },
        columns: [{
                data: "CtrlNo",
                className: "text-center"
            },
            {
                data: "Currency"
            },
            {
                data: "CurrencyName"
            },
            {
                data: "Disc",
                className: "text-center"
            },
            {
                data: "Remarks"
            },
            {
                data: "view",
                className: "text-center",
                "orderable": false
            },
        ],
        order: [
            [1, 'asc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });
    // End Setup Databels
}

$(document).on('click', '#get_list_coa', function() {
    get_list_coa_dt();
});

</script>
                