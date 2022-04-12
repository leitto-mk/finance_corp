/*
 *  CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const baseURL = window.location.origin

const _callable = {
    validateModalInputs: form => {
        let forms = $(`#${form} .form-required`).serializeArray()

        //Validate each inputs
        for (const e of forms) {
            if (e['value'] == "") {
                $(document).find(`.form-required[name="${e['name']}"]`).parents('div.form-group').addClass('has-error')
                return false
            } else {
                $(document).find(`.form-required[name="${e['name']}"]`).parents('div.form-group').removeClass('has-error')
                return true
            }
        }

        //remove class has-error
        for (const e of form_validation) {
            $(`#${e['name']}.form-required`).on('blur', function () {
                if ($(this).val() == "") {
                    $(this).parents('.form-group').addClass('has-error')
                } else {
                    $(this).parents('.form-group').removeClass('has-error')
                }
            })
        }

        return true
    },
}

const msup = {
    initTables: () => {
        //Group
        repository.generateDataTable(
            '#table_master_stockgroup_grp',
            `${baseURL}/Cmaster/getDataMasterStockGroup`,
            {
                input: 'mas_stock_d_grp'
            },
            [
                { className: 'control', orderable: false, defaultContent: "" },
                { data: "GroupCode" },
                { data: "GroupDescription" },
                { data: "TypeDescription" },
                {
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                            <center>
                                <a data-id="${row.GroupCode}" class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal">
                                    <i class="fa fa-pencil" title="Edit"></i>
                                </a> 
                                <a data-id="${row.GroupCode}" class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_d_grp" href="#" data-toggle="modal">
                                    <i class="fa fa-close" title="Discontinue"></i>
                                </a>
                            </center>`
                    }
                }
            ]
        )

        //Sub-Category
        repository.generateDataTable(
            '#table_master_stockgroup_type',
            `${baseURL}/Cmaster/getDataMasterStockGroup`,
            {
                input: 'mas_stock_c_type'
            },
            [
                { className: 'control', orderable: false, defaultContent: "" },
                { data: "TypeCode" },
                { data: "TypeDescription" },
                { data: "CatDescription" },
                {
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                            <center>
                                <a data-id="${row.TypeCode}" class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal">
                                    <i class="fa fa-pencil" title="Edit"></i>
                                </a> 
                                <a data-id="${row.TypeCode}" class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_c_type" href="#" data-toggle="modal">
                                    <i class="fa fa-close" title="Discontinue"></i>
                                </a>
                            </center>`
                    }
                }
            ]
        )

        //Category
        repository.generateDataTable(
            '#table_master_stockgroup_cat',
            `${baseURL}/Cmaster/getDataMasterStockGroup`,
            {
                input: 'mas_stock_b_cat'
            },
            [
                { className: 'control', orderable: false, defaultContent: "" },
                { data: "CatCode" },
                { data: "CatDescription" },
                { data: "StockClassDescription" },
                {
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                            <center>
                                <a data-id="${row.CatCode}" class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal">
                                    <i class="fa fa-pencil" title="Edit"></i>
                                </a> 
                                <a data-id="${row.CatCode}" class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_b_cat" href="#" data-toggle="modal">
                                    <i class="fa fa-close" title="Discontinue"></i>
                                </a>
                            </center>`
                    }
                }
            ]
        )

        //Stock-Class
        repository.generateDataTable(
            '#table_master_stockgroup_class',
            `${baseURL}/Cmaster/getDataMasterStockGroup`,
            {
                input: 'mas_stock_a_class'
            },
            [
                { className: 'control', orderable: false, defaultContent: "" },
                { data: "StockClassCode" },
                { data: "StockClassDescription" },
                {
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                            <center>
                                <a data-id="${row.StockClassCode}" class="btn green btn-xs btn-outline edit-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal">
                                    <i class="fa fa-pencil" title="Edit"></i>
                                </a> 
                                <a data-id="${row.StockClassCode}" class="btn yellow btn-xs btn-outline disc-stockgroup" input="mas_stock_a_class" href="#" data-toggle="modal">
                                    <i class="fa fa-close" title="Discontinue"></i>
                                </a>
                            </center>`
                    }
                }
            ]
        )
    },

    eventAddNewItem: () => {
        //OPEN MODAL
        $(document).on('click', '.btnModal', async function () {
            switch ($(this).attr('id')) {
                case 'btn_add_stockgroup_grp':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input', 'mas_stock_d_grp').show();
                    $('#btnEdit').hide();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterStockGroup`, { input: 'mas_stock_d_grp' }, 'html')
                        .then(response => {
                            helper.unblockUI()

                            $('#master_crud').find('div.modal-body').html(response);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Group`);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterStockGroup`, { input: 'mas_stock_c_type' })
                        .then(response => {
                            helper.unblockUI()

                            console.assert(response)

                            var html = '<option>-- Choose Sub-Category --</option>';
                            for (var i = 0; i < response.length; i++) {
                                html += `<option value="${response[i].TypeCode}">${response[i].TypeCode} - ${response[i].TypeDescription}</option>`
                            }

                            $('#stocktypecode').html(html);
                            helper.setSelect2($('#stocktypecode'), {
                                dropdownParent: $('#master_crud'),
                                width: 'auto'
                            });
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })
                    break;
                case 'btn_add_stockgroup_type':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input', 'mas_stock_c_type').show();
                    $('#btnEdit').hide();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterStockGroup`, { input: 'mas_stock_c_type' }, 'html')
                        .then(response => {
                            helper.unblockUI()

                            $('#master_crud').find('div.modal-body').html(response);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Type`);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterStockGroup`, { input: 'mas_stock_b_cat' })
                        .then(response => {
                            helper.unblockUI()

                            var html = '<option>-- Choose Sub-Category --</option>';
                            for (var i = 0; i < response.length; i++) {
                                html += `<option value="${response[i].CatCode}">${response[i].CatCode} - ${response[i].CatDescription}</option>`
                            }

                            $('#stockcatcode').html(html);
                            helper.setSelect2($('#stockcatcode'), {
                                dropdownParent: $('#master_crud'),
                                width: 'auto'
                            });
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })
                    break;
                case 'btn_add_stockgroup_cat':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input', 'mas_stock_b_cat').show();
                    $('#btnEdit').hide();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterStockGroup`, { input: 'mas_stock_b_cat' }, 'html')
                        .then(response => {
                            helper.unblockUI()

                            $('#master_crud').find('div.modal-body').html(response);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Category`);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterStockGroup`, { input: 'mas_stock_a_class' })
                        .then(response => {
                            helper.unblockUI()

                            var html = '<option>-- Choose Sub-Category --</option>';
                            for (var i = 0; i < response.length; i++) {
                                html += `<option value="${response[i].StockClassCode}">${response[i].StockClassCode} - ${response[i].StockClassDescription}</option>`
                            }

                            $('#stockclasscode').html(html);
                            helper.setSelect2($('#stockclasscode'), {
                                placeholder: "Choose Class",
                                dropdownParent: $('#master_crud'),
                                width: 'auto'
                            });
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })
                    break;
                case 'btn_add_stockgroup_class':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input', 'mas_stock_a_class').show();
                    $('#btnEdit').hide();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterStockGroup`, { input: 'mas_stock_a_class' }, 'html')
                        .then(response => {
                            helper.unblockUI()

                            $('#master_crud').find('div.modal-body').html(data);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Class`);
                            $('#master_crud').on('shown.bs.modal', function () {
                                $('#stockclasscode').focus()
                            })
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })
                    break;
            }
        })

        //SUBMIT ITEM
        $(document).on('click', '#btnAdd', async function () {
            var curTable = $(this).parents('portlet').find('table')
            
            switch ($(this).attr('input')) {
                case 'mas_stock_d_grp':
                    validate = _callable.validateModalInputs('form_stockgrp')
                    if (!validate) {
                        alert("Data invalid")
                        return
                    }

                    //Serialize and convert as Object
                    var data_stockgrp = $('#form_stockgrp').serialize();
                    data_stockgrp = Objects.fromEntries(new URLSearchParams(data_stockgrp))
                    data_stockgrp.input = 'mas_stock_d_grp'

                    await repository.submitRecord(`${baseURL}/Cmaster/inputDataMasterStockGroup`, data_stockgrp)
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                $('#master_crud').modal('hide');

                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data has been submitted'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'warning',
                                    'title': 'NOT SUBMITTED',
                                    'html': `<h1>${response.result}</h1>`
                                })

                                $('#stockgrpcode').parents('.form-group').addClass('has-warning')
                                $('#stockgrpcode').focus()
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()
                    break;
                case 'mas_stock_c_type':
                    validate = _callable.validateModalInputs('form_stocktype')
                    if (!validate) {
                        alert("Data invalid")
                        return
                    }

                    //Serialize and convert as Object
                    var data_stocktype = $('#form_stocktype').serialize();
                    data_stocktype = Objects.fromEntries(new URLSearchParams(data_stocktype))
                    data_stocktype.input = 'mas_stock_c_type'

                    await repository.submitRecord(`${baseURL}/Cmaster/inputDataMasterStockGroup`, data_stocktype)
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                $('#master_crud').modal('hide');

                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data has been submitted'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'warning',
                                    'title': 'NOT SUBMITTED',
                                    'html': `<h1>${response.result}</h1>`
                                })

                                $('#stocktypecode').parents('.form-group').addClass('has-warning')
                                $('#stocktypecode').focus()
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()
                    break;
                case 'mas_stock_b_cat':
                    validate = _callable.validateModalInputs('form_stockcategory')
                    if (!validate) {
                        alert("Data invalid")
                        return
                    }

                    //Serialize and convert as Object
                    var data_stockcategory = $('#form_stockcategory').serialize();
                    data_stockcategory = Objects.fromEntries(new URLSearchParams(data_stockcategory))
                    data_stockcategory.input = 'mas_stock_b_cat'

                    await repository.submitRecord(`${baseURL}/Cmaster/inputDataMasterStockGroup`, data_stockcategory)
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                $('#master_crud').modal('hide');

                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data has been submitted'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'warning',
                                    'title': 'NOT SUBMITTED',
                                    'html': `<h1>${response.result}</h1>`
                                })

                                $('#stockcatcode').parents('.form-group').addClass('has-warning')
                                $('#stockcatcode').focus()
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()
                    break;
                case 'mas_stock_a_class':
                    validate = _callable.validateModalInputs('form_stockclass')
                    if (!validate) {
                        alert("Data invalid")
                        return
                    }

                    //Serialize and convert as Object
                    var data_stockclass = $('#form_stockclass').serialize();
                    data_stockclass = Objects.fromEntries(new URLSearchParams(data_stockclass))
                    data_stockclass.input = 'mas_stock_a_class'

                    await repository.submitRecord(`${baseURL}/Cmaster/inputDataMasterStockGroup`, data_stockclass)
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                $('#master_crud').modal('hide');

                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data has been submitted'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'warning',
                                    'title': 'NOT SUBMITTED',
                                    'html': `<h1>${response.result}</h1>`
                                })

                                $('#stockclasscode').parents('.form-group').addClass('has-warning')
                                $('#stockclasscode').focus()
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()
                    break;
            }
        })
    },

    eventEditItem: () => {
        //OPEN MODAL
        $(document).on('click', 'a.edit-stockgroup', async function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            switch ($(this).attr('input')) {
                case 'mas_stock_d_grp':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({ 'data-id': id, 'input': 'mas_stock_d_grp' }).show();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterStockGroup`, { input: 'mas_stock_d_grp' }, 'html')
                        .then(response => {
                            helper.unblockUI()

                            $('#master_crud').find('div.modal-body').html(response);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Group`);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterStockGroup`, { input: 'mas_stock_d_grp' })
                        .then(response => {
                            helper.unblockUI()

                            var html = '<option>-- Choose Sub-Category --</option>';
                            for (var i = 0; i < response.length; i++) {
                                html += `<option value="${response[i].TypeCode}">${response[i].TypeCode} - ${response[i].TypeDescription}</option>`
                            }

                            $('#stocktypecode').html(html);

                            helper.setSelect2($('#stocktypecode'), {
                                dropdownParent: $('#master_crud'),
                                width: 'auto'
                            });
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterStockGroupByID`, { input: 'mas_stock_d_grp', GroupCode: id })
                        .then(response => {
                            helper.unblockUI()

                            $('#stocktypecode').val(response.TypeCode).trigger('change');
                            $('#stockgrpcode').val(response.GroupCode);
                            $('#stockgrpdescription').val(response.GroupDescription);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })
                    break;
                case 'mas_stock_c_type':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({ 'data-id': id, 'input': 'mas_stock_c_type' }).show();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterStockGroup`, { input: 'mas_stock_c_type' }, 'html')
                        .then(response => {
                            helper.unblockUI()

                            $('#master_crud').find('div.modal-body').html(response);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Sub Category`);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterStockGroup`, { input: 'mas_stock_b_cat' })
                        .then(response => {
                            helper.unblockUI()

                            var html = '<option>-- Choose Sub-Category --</option>';
                            for (var i = 0; i < response.length; i++) {
                                html += `<option value="${response[i].CatCode}">${response[i].CatCode} - ${response[i].CatDescription}</option>`
                            }
                            $('#stockcatcode').html(html);
                            helper.setSelect2($('#stockcatcode'), {
                                dropdownParent: $('#master_crud'),
                                width: 'auto'
                            });
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterStockGroupByID`, { input: 'mas_stock_c_type', TypeCode: id })
                        .then(response => {
                            helper.unblockUI()

                            $('#stockcatcode').val(response.CatCode).trigger('change');
                            $('#stocktypecode').val(response.TypeCode);
                            $('#stocktypedescription').val(response.TypeDescription);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })
                    break;
                case 'mas_stock_b_cat':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({ 'data-id': id, 'input': 'mas_stock_b_cat' }).show();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterStockGroup`, { input: 'mas_stock_b_cat' }, 'html')
                        .then(response => {
                            helper.unblockUI()

                            $('#master_crud').find('div.modal-body').html(response);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Category`);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterStockGroup`, { input: 'mas_stock_a_class' })
                        .then(response => {
                            helper.unblockUI()

                            var html = '<option>-- Choose Sub-Category --</option>';
                            for (var i = 0; i < response.length; i++) {
                                html += `<option value="${response[i].StockClassCode}">${response[i].StockClassCode} - ${response[i].StockClassDescription}</option>`
                            }
                            $('#stockclasscode').html(html);
                            helper.setSelect2($('#stockclasscode'), {
                                dropdownParent: $('#master_crud'),
                                width: 'auto'
                            });
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterStockGroupByID`, { input: 'mas_stock_b_cat', CatCode: id })
                        .then(response => {
                            helper.unblockUI()

                            $('#stockclasscode').val(response.StockClassCode).trigger('change');
                            $('#stockcatcode').val(response.CatCode);
                            $('#stockcatdescription').val(response.CatDescription);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })
                    break;
                case 'mas_stock_a_class':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({ 'data-id': id, 'input': 'mas_stock_a_class' }).show();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterStockGroup`, { input: 'mas_stock_a_class' }, 'html')
                        .then(response => {
                            helper.unblockUI()

                            $('#master_crud').find('div.modal-body').html(response);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Class`);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterStockGroupByID`, { input: 'mas_stock_a_class', StockClassCode: id })
                        .then(response => {
                            helper.unblockUI()

                            $('#stockclasscode').val(response.StockClassCode);
                            $('#stockclassdescription').val(response.StockClassDescription);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })
                    break;
            }
        })

        //SUBMIT EDIT
        $(document).on('click', 'button#btnEdit', async function () {
            var id = $(this).data('id')
            var curTable = $(this).parents('table')

            switch ($(this).attr('input')) {
                case 'mas_stock_d_grp':
                    //Serialize and convert as Object
                    var data_stockgrp = $('#form_stockgrp').serialize();
                    data_stockgrp = Object.fromEntries(new URLSearchParams(data_stockgrp))
                    data_stockgrp.input = 'mas_stock_d_grp'
                    data_stockgrp.id = id

                    await repository.submitRecord(`${baseURL}/Cmaster/editDataMasterStockGroup`, data_stockgrp)
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                $('#master_crud').modal('hide');

                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data Updated'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'ERROR',
                                    'html': `<h4 class="sbold">${response.result}</h4>`
                                })
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()
                    break;
                case 'mas_stock_c_type':
                    //Serialize and convert as Object
                    var data_stocktype = $('#form_stocktype').serialize();
                    data_stocktype = Object.fromEntries(new URLSearchParams(data_stocktype))
                    data_stocktype.input = 'mas_stock_c_type'
                    data_stocktype.id = id

                    await repository.submitRecord(`${baseURL}/Cmaster/editDataMasterStockGroup`, data_stocktype)
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                $('#master_crud').modal('hide');

                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data Updated'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'ERROR',
                                    'html': `<h4 class="sbold">${response.result}</h4>`
                                })
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()
                    break;
                case 'mas_stock_b_cat':
                    //Serialize and convert as Object
                    var data_stockcategory = $('#form_stockcategory').serialize();
                    data_stockcategory = Object.fromEntries(new URLSearchParams(data_stockcategory))
                    data_stockcategory.input = 'mas_stock_b_cat'
                    data_stockcategory.id = id

                    await repository.submitRecord(`${baseURL}/Cmaster/editDataMasterStockGroup`, data_stockcategory)
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                $('#master_crud').modal('hide');

                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data Updated'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'ERROR',
                                    'html': `<h4 class="sbold">${response.result}</h4>`
                                })
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()
                    break;
                case 'mas_stock_a_class':
                    //Serialize and convert as Object
                    var data_stockclass = $('#form_stockclass').serialize();
                    data_stockclass = Object.fromEntries(new URLSearchParams(data_stockclass))
                    data_stockclass.input = 'mas_stock_a_class'
                    data_stockclass.id = id

                    await repository.submitRecord(`${baseURL}/Cmaster/editDataMasterStockGroup`, data_stockclass)
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                $('#master_crud').modal('hide');

                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data Updated'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'ERROR',
                                    'html': `<h4 class="sbold">${response.result}</h4>`
                                })
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()
                    break;
            }
        })
    },

    eventDeleteItem: () => {
        $(document).on('click', 'a.disc-stockgroup', async function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var curTable = $(this).parents('table')

            var confirm = window.confirm('Are you sure to discontinue this data ?');
            if (!confirm) return;

            switch ($(this).attr('input')) {
                case 'mas_stock_d_grp':
                    var remarks = prompt("Remarks", "");

                    await repository.deleteRecord(`${baseURL}/Cmaster/discDataMasterStockGroup`, { input: 'mas_stock_d_grp', id: id, remarks: remarks ?? '-' })
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data has been deleted'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'ERROR',
                                    'html': `<h4>${response.result}</h4>`
                                })
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()

                    break;
                case 'mas_stock_c_type':
                    var remarks = prompt("Remarks", "");

                    await repository.deleteRecord(`${baseURL}/Cmaster/getDataMasterStockGroup`, { input: 'mas_stock_c_type', id: id, remarks: remarks ?? '-' })
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data has been deleted'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'ERROR',
                                    'html': `<h4>${response.result}</h4>`
                                })
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()
                    break;
                case 'mas_stock_b_cat':
                    var remarks = prompt("Remarks", "");

                    await repository.deleteRecord(`${baseURL}/Cmaster/getDataMasterStockGroup`, { input: 'mas_stock_b_cat', id: id, remarks: remarks ?? '-' })
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data has been deleted'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'ERROR',
                                    'html': `<h4>${response.result}</h4>`
                                })
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()
                    break;
                case 'mas_stock_a_class':
                    var remarks = prompt("Remarks", "");

                    await repository.deleteRecord(`${baseURL}/Cmaster/getDataMasterStockGroup`, { input: 'mas_stock_a_class', id: id, remarks: remarks ?? '-' })
                        .then(response => {
                            helper.unblockUI()

                            if (response.result) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'SUCCESS',
                                    'html': 'Data has been deleted'
                                })
                            } else {
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'ERROR',
                                    'html': `<h4>${response.result}</h4>`
                                })
                            }
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                            })
                        })

                    await curTable.ajax.reload()
                    break;
            }
        })
    }
}

export default msup