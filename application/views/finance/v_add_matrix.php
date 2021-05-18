<?php $this->load->view('finance/header_sub_modul_sf_no_trees'); ?>
<style type="text/css">
    #col_box {
        width: 25%;
    }

    @media only screen and (max-width: 900px) {
        #col_box {
            width: 100%;
        }
    }

    .collapsible {
        background-color: #ffffff;
        color: #f1f1f1;
        /* cursor: pointer; */
        padding: 10px;
        width: 100%;
        border: none;
        border-bottom: 1px solid;
        text-align: left;
        outline: none;
        font-size: 15px;
    }

    .actives,
    .collapsible:hover {
        background-color: #E5E5E5;
    }

    .content-col {
        /* display: none; */
        overflow: hidden;
        background-color: #ffffff;
    }
</style>

<div class="container-fluid" style="padding: 0px">
    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <!-- Content Start -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px">
                <!-- BEGIN PORTLET -->
                <div class="portlet light" style="margin-top: -20px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-blue-madison bold uppercase">
                                <i class="fa fa-book"></i> List Master Matrix Student
                            </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <a class="btn btn-transparent green btn-outline btn-circle btn-sm" id="btn_posting_trans_gl" disabled>
                                    <i class="fa fa-paper-plane"></i> Add New Matrix Student
                                </a>
                            </div>

                        </div>
                        <div class="actions" id="test">

                        </div>
                    </div>
                    <div class="portlet-body" id="show_list_journal">
                        <!-- Report By Account Start -->
                        <!-- Report By Account End -->
                    </div>
                </div>
                <!-- END PORTLET -->
            </div>
        </div>
        <!-- Content End -->
    </div>
    <!-- END PAGE CONTENT INNER -->
</div>
<div class="modal fade" id="insert_accno_new" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Confirmation User</h4>
        </div>

        <div class="modal-body">
            <form method="post" id="user_form">
                <div class="form-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label"> Amount</label>
                            <div class="col-md-9">
                                <input type="text" name="amount_new" id="amount_new" class="form-control" data-toggle="modal" data-target="#modal_caccount">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 pull-right">
                                <input type="submit" name="submit" value="Submit" class="btn btn-transparent green-jungle btn-outline btn-circle btn-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="static3" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false" aria-hidden="false" style="display: block; margin-top: -77px;">
    <div class="modal-header">
        <button id="close_modal3" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><b>New Matrix Student Preview</b></h4>
    </div>
    <div class="modal-body">
        <form id="user_form_addss" class="form-horizontal" method="post">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Document No
                        <span class="required"> # </span>

                    </label>
                    <div class="col-md-4">
                        <input type="text" id="m_docno" name="m_docno" class="form-control" readonly value="<?php echo $docNo; ?>" style="background-color:white;">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Account Type of Payment
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input type="text" id="m_accno_type" name="m_accno_type" class="form-control readonly" placeholder="Search.." style="background-color:white;" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">NIS
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input type="text" id="m_emp" name="m_emp" class="form-control readonly" placeholder="Search.." style="background-color:white;" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Amount
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <input type="text" id="m_amount" name="m_amount" class="form-control readonly" placeholder="Search.." style="background-color:white;" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="close_modal4" type="button" data-dismiss="modal" class="btn btn-outline yellow">Cancel</button>
                    <button type="submit" name="submit" class="btn blue">Continue Task</button>
                </div>
            </div>
        </form>
    </div>

</div>
<div id="modal_caccount_start" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false" aria-hidden="false">
    <div class="modal-header" id="header_modal_accno">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><b>Account List</b></h4>
    </div>
    <div class="modal-body" id="content_modal_accno">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Account No.</th>
                    <th>Account Desc</th>
                    <th class="text-center">Type</th>
                </tr>
            </thead>
        </table>
        <div class="table-responsive" style="height: 450px; overflow-y: auto;">
            <table class="table table-striped table-hover">
                <tbody id="modal_baccount_s">
                    <!-- JSON DATA -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="modal_emp" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false" aria-hidden="false">
    <div class="modal-header" id="header_modal_emp">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><b>Student List</b></h4>
    </div>
    <div class="modal-body" id="content_modal_emp">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Student Name</th>
                </tr>
            </thead>
        </table>
        <div class="table-responsive" style="height: 450px; overflow-y: auto;">
            <table class="table table-striped table-hover">
                <tbody id="modal_bemp">
                    <!-- JSON DATA -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.onload = edit_delete_trasaction;
    var options = {
        decimal: ".",
        thousand: ",",
        precision: 2,
        format: "%v"
    };
    document.body.style.zoom = 0.9;

    function edit_delete_trasaction() {
        load_last_transaction();
    }

    function load_last_transaction() {
        $(document).on('focus', '#m_accno_type', function() {
            $('#modal_caccount_start').modal('show');
            load_maccount_no_start();
        });
        $(document).on('click', '#d_accno_std', function() {
            $('#m_accno_type').val($(this).attr('account_no'));
            $('#modal_caccount_start').modal('hide');
        });
        $(document).on('focus', '#m_emp', function() {
            $('#modal_emp').modal('show');
            load_m_emp();
        });
        $(document).on('click', '#d_emp', function() {
            $('#m_emp').val($(this).attr('account_no'));
            $('#modal_emp').modal('hide');
        });
        $.ajax({
            url: "<?php echo site_url('SDAFinance/load_last_tday_matris_student'); ?>",
            type: "POST",
            dataType: "json",
            success: function(data) {
                if (!data || !Object.keys(data).length) {
                    $('#show_list_journal').html(data);
                    $('#btn_posting_trans_gl').removeAttr('disabled');

                } else {
                    $('#show_list_journal').html(data);
                    $('#btn_posting_trans_gl').removeAttr('disabled');

                }
            },
            error: function() {
                alert('Error occur...!!');
            }
        });
        $(document).on('click', '#btn_posting_trans_gl', function() {
            // Open Modal
            $('#static3').modal('show');
        });

        $(document).on('click', '#edit_acc_no_mat', function() {
            var total = 0;
            $('#insert_accno_new').modal('show');
            let docno = $(this).attr('doc_no_mat');
            let transtype = $(this).attr('item_no_mat');
            let accno = $(this).attr('accno_type_mat');
            let amount = $(this).attr('amount_type_mat');
            let nis = $(this).attr('nis_mat_for');
            $('#amount_new').val($(this).attr('amount_type_mat_for'));

            $(document).on('submit', '#user_form', function(event) {
                event.preventDefault();
                var amount_new = $('#amount_new').val();
                var docno_edit = docno;
                var recno_edit = transtype;
                var accno_edit = accno;
                var nis_edit = nis;
                var r = confirm("Are you sure want to Submit Transaction ?");
                console.table({
                    amount_new,
                    docno_edit,
                    recno_edit,
                    accno_edit,
                    nis_edit
                })
            });
        });

        function get_swal_action_button_click(issueno) {
            // close form
            $(document).on('click', '#btn_swal_close', function() {
                location.reload();
            });
        }
        $(document).on('submit', '#user_form_addss', function(event) {
            event.preventDefault();
            $('#static3').modal('hide');
            submit_matrix_student();
        });

        function submit_matrix_student() {
            var form = $('#user_form_addss').serializeArray();
            console.log(form)
            $.ajax({
                url: "<?php echo site_url('SDAFinance/add_new_matrix_student'); ?>",
                data: $('#user_form_addss').serialize(),
                type: "POST",
                dataType: "json",
                success: function(res) {
                    if (res.rstatus != 'false') {
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            html: '<p>' +
                                // 'Supplier : '+res.SupplierID+', has been Added' +
                                'Add Payment Matrix, submit success.' +
                                '</p>' +
                                '<p>' +
                                '<button id="btn_swal_close" type="button" class="btn red btn-outline btn-sm"><i class="fa fa-close"></i> Close</button>&nbsp;' +
                                '</p>',
                            showConfirmButton: false,
                            showCancelButton: false,
                            allowOutsideClick: false
                        });
                        $('#m_edit_costpricetype').modal('hide');
                        get_swal_action_button_click(res.issueno);
                    } else {
                        console.log(res);
                        Swal.fire({
                            title: 'Error!',
                            icon: 'error',
                            html: '<p>' +
                                'Do you want continue ?' +
                                '</p>' +
                                '<p>' +
                                '<button id="btn_swal_close" type="button" class="btn red btn-outline btn-sm"><i class="fa fa-close"></i> Close</button>&nbsp;' +
                                '</p>',
                            showConfirmButton: false,
                            showCancelButton: false,
                            allowOutsideClick: false
                        });
                        get_swal_action_button_click(0);
                    }
                },
                error: function(res) {
                    alert("Error Occur");
                    console.log(res.responseText);
                }
            });
        }

    }


    function load_maccount_no_start() {
        var cstts = 0;
        $.ajax({
            url: "<?php echo site_url('SDAFinance/get_list_account_student'); ?>",
            data: {
                cstatus: cstts
            },
            type: "POST",
            dataType: "json",
            success: function(data) {
                $('#modal_baccount_s').html(data.row);
            },
            error: function() {
                alert('Error occur...!!');
            }
        });
    }

    function load_m_emp() {
        var cstts = 0;
        $.ajax({
            url: "<?php echo site_url('SDAFinance/get_list_emp_nis'); ?>",
            data: {
                cstatus: cstts
            },
            type: "POST",
            dataType: "json",
            success: function(data) {
                $('#modal_bemp').html(data);
            },
            error: function() {
                alert('Error occur...!!');
            }
        });
    }
</script>

<?php $this->load->view('finance/footer_sub_modul_sf'); ?>