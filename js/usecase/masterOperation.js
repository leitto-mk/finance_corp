/*
 *  CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const host = window.location.host
var baseURL = window.location.origin
baseURL = (host == 'localhost' ? baseURL + '/financecorp' : baseURL)

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
    }
}

const mopr = {
    initTables: () => {
        //Company
        repository.generateDataTable(
            '#table_master_abase_company',
            'Cmaster/getDataMasterAbase',
            { input: 'abasecompany' },
            [
                { className: 'control', orderable: false, defaultContent: "" },
                { data: "ComCode" },
                { data: "ComShortName" },
                { data: "City" },
                {
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                            <a data-id="${row.ComCode}" class="btn blue btn-xs btn-outline view-abase" input="abasebranch">
                                <i class="fa fa-search"></i>
                            </a> 
                            <a data-id="${row.CtrlNo}" class="btn green btn-xs btn-outline edit-abase" input="abasebranch">
                                <i class="fa fa-pencil"></i>
                            </a> 
                            <a data-id="${row.ComCode}" class="btn yellow btn-xs btn-outline disc-abase" input="abasebranch">
                                <i class="fa fa-close"></i>
                            </a>`
                    }
                }
            ]
        )

        //Branch
        repository.generateDataTable(
            '#table_master_abase_branch',
            'Cmaster/getDataMasterAbase',
            { input: 'abasebranch' },
            [
                { className: 'control', orderable: false, defaultContent: "" },
                { data: "BranchCode" },
                { data: "BranchName" },
                { data: "BranchType" },
                { data: "BranchAddress" },
                { data: "ContactNo" },
                {
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                            <a data-id="${row.BranchCode}" class="btn blue btn-xs btn-outline view-abase" input="abasebranch">
                                <i class="fa fa-search"></i>
                            </a> 
                            <a data-id="${row.CtrlNo}" class="btn green btn-xs btn-outline edit-abase" input="abasebranch">
                                <i class="fa fa-pencil"></i>
                            </a> 
                            <a data-id="${row.BranchCode}" class="btn yellow btn-xs btn-outline disc-abase" input="abasebranch">
                                <i class="fa fa-close"></i>
                            </a>`
                    }
                }
            ]
        )

        //Department
        repository.generateDataTable(
            '#table_master_abase_department',
            'Cmaster/getDataMasterAbase',
            { input: 'abasedepartment' },
            [
                { className: 'control', orderable: false, defaultContent: "" },
                { data: "DeptCode" },
                { data: "DeptDes" },
                {
                    data: "Branch",
                    render: function (data, type, row) {
                        return `${data} - ${row.BranchName}`
                    }
                },
                {
                    data: "BUCode",
                    render: function (data, type, row) {
                        return `${data} - ${row.BUDes}`
                    }
                },
                {
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                            <a data-id="${row.DeptCode}" class="btn blue btn-xs btn-outline view-abase" input="abasedepartment">
                                <i class="fa fa-search"></i>
                            </a> 
                            <a data-id="${row.CtrlNo}" class="btn green btn-xs btn-outline edit-abase" input="abasedepartment">
                                <i class="fa fa-pencil"></i>
                            </a> 
                            <a data-id="${row.DeptCode}" class="btn yellow btn-xs btn-outline disc-abase" input="abasedepartment">
                                <i class="fa fa-close"></i>
                            </a>`
                    }
                }
            ]
        )

        //Department Business Unit (BU)
        repository.generateDataTable(
            '#table_master_abase_department_bu',
            'Cmaster/getDataMasterAbase',
            { input: 'abasedepartmentbu' },
            [
                { className: 'control', orderable: false, defaultContent: "" },
                { data: "BUCode" },
                { data: "BUDes" },
                {
                    data: "DivCode",
                    render: function (data, type, row) {
                        return `${data} - ${row.DivDes}`
                    }
                },
                {
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                            <a data-id="${row.BUCode}" class="btn blue btn-xs btn-outline view-abase" input="abasedepartmentbu">
                                <i class="fa fa-search"></i>
                            </a> 
                            <a data-id="${row.CtrlNo}" class="btn green btn-xs btn-outline edit-abase" input="abasedepartmentbu">
                                <i class="fa fa-pencil"></i>
                            </a> 
                            <a data-id="${row.BUCode}" class="btn yellow btn-xs btn-outline disc-abase" input="abasedepartmentbu">
                                <i class="fa fa-close"></i>
                            </a>`
                    }
                }
            ]
        )

        //Department Division
        repository.generateDataTable(
            '#table_master_abase_department_div',
            'Cmaster/getDataMasterAbase',
            { input: 'abasedepartmentdiv' },
            [
                { className: 'control', orderable: false, defaultContent: "" },
                { data: "DivCode" },
                { data: "DivDes" },
                {
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                            <a data-id="${row.DivCode}" class="btn blue btn-xs btn-outline view-abase" input="abasedepartmentdiv">
                                <i class="fa fa-search"></i>
                            </a> 
                            <a data-id="${row.CtrlNo}" class="btn green btn-xs btn-outline edit-abase" input="abasedepartmentdiv">
                                <i class="fa fa-pencil"></i>
                            </a> 
                            <a data-id="${row.DivCode}" class="btn yellow btn-xs btn-outline disc-abase" input="abasedepartmentdiv">
                                <i class="fa fa-close"></i>
                            </a>`
                    }
                }
            ]
        )

        //Cost Center
        repository.generateDataTable(
            '#table_master_abase_cost_center',
            'Cmaster/getDataMasterAbase',
            { input: 'abasecostcenter' },
            [
                { className: 'control', orderable: false, defaultContent: "" },
                { data: "CostCenter" },
                { data: "CCDes" },
                { data: "DeptCode" },
                {
                    orderable: false,
                    render: (data, type, row) => {
                        return `
                            <a data-id="${row.CostCenter}" class="btn blue btn-xs btn-outline view-abase" input="abasecostcenter">
                                <i class="fa fa-search"></i>
                            </a> 
                            <a data-id="${row.CtrlNo}" class="btn green btn-xs btn-outline edit-abase" input="abasecostcenter">
                                <i class="fa fa-pencil"></i>
                            </a> 
                            <a data-id="${row.CostCenter}" class="btn yellow btn-xs btn-outline disc-abase" input="abasecostcenter">
                                <i class="fa fa-close"></i>
                            </a>`
                    }
                }
            ]
        )
    },

    eventAddNewItem: () => {
        //OPEN MODAL
        $(document).on('click', '.btnModal', function () {
            $('#master_crud>div.modal-dialog').attr('class', 'modal-dialog modal-md');
            switch ($(this).attr('id')) {
                case 'button_add_master_abase_company':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input', 'abasecompany').show();
                    $('#btnEdit').hide();

                    repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, { input: 'abasecompany' }, 'html')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(response);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Company`);
                        $('#master_crud').on('shown.bs.modal', function () {
                            $('#abasecompanycode').focus()
                        })
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })
                    break;
                case 'button_add_master_abase_branch':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input', 'abasebranch').show();
                    $('#btnEdit').hide();

                    repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, { input: 'abasebranch' }, 'html')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(data);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Branch`);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbase`, { input: 'abasecompany' })
                    .then(response => {
                        helper.unblockUI()

                        var html = '<option></option>';
                        for (var i = 0; i < response.length; i++) {
                            html += `<option value="${response[i].ComCode}">${response[i].ComCode} - ${response[i].ComShortName}</option>`
                        }

                        $('#abasebranchcompanycode').html(html);

                        helper.setSelect2($('#abasebranchcompanycode'), {
                            dropdownParent: $('#master_crud'),
                            width: 'auto'
                        });
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })
                    break;
                case 'button_add_master_abase_department':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input', 'abasedepartment').show();
                    $('#btnEdit').hide();

                    repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, { input: 'abasedepartment' }, 'html')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(response);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Department`);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbase`, { input: 'abasebranch' })
                    .then(response => {
                        helper.unblockUI()

                        var html = '<option></option>';
                        for (var i = 0; i < response.length; i++) {
                            html += `<option value="${response[i].BranchCode}">${response[i].BranchName}</option>`
                        }

                        $('#abasedepartmentbranch').html(html);

                        helper.setSelect2($('#abasedepartmentbranch'), {
                            dropdownParent: $('#master_crud'),
                            width: 'auto'
                        });
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })

                        var html = '<option></option>';
                        for (var i = 0; i < response.length; i++) {
                            html += `<option value="${response[i].BUCode}">${response[i].BUCode} - ${response[i].BUDes}</option>`
                        }

                        $('#abasedepartmentbucode').html(html);

                        helper.setSelect2($('#abasedepartmentbucode'), {
                            dropdownParent: $('#master_crud'),
                            width: 'auto'
                        });
                    })
                    break;
                case 'button_add_master_abase_department_bu':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input', 'abasedepartmentbu').show();
                    $('#btnEdit').hide();

                    repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, { input: 'abasedepartmentbu' }, 'html')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(response);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Business Unit`);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbase`, { input: 'abasedepartmentbu' })
                        .then(response => {
                            helper.unblockUI()

                            var html = '<option></option>';
                            for (var i = 0; i < response.length; i++) {
                                html += `<option value="${response[i].DivCode}">${response[i].DivCode} - ${response[i].DivDes}</option>`
                            }

                            $('#abasedepartmentbudivisioncode').html(html);

                            helper.setSelect2($('#abasedepartmentbudivisioncode'), {
                                dropdownParent: $('#master_crud'),
                                width: 'auto'
                            });
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err}</h4>`
                            })
                        })
                    break;
                case 'button_add_master_abase_department_div':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input', 'abasedepartmentdiv').show();
                    $('#btnEdit').hide();

                    repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, { input: 'abasedepartmentdiv' }, 'html')
                        .then(response => {
                            helper.unblockUI()

                            $('#master_crud').find('div.modal-body').html(response);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i>  Division`);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err}</h4>`
                            })
                        })

                    repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbase`, { input: 'abasedepartmentdiv' })
                        .then(response => {
                            helper.unblockUI()
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err}</h4>`
                            })
                        })
                    break;
                case 'button_add_master_abase_cost_center':
                    $('#master_crud').modal('show');
                    $('#btnAdd').attr('input', 'abasecostcenter').show();
                    $('#btnEdit').hide();

                    repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, { input: 'abasecostcenter' }, 'html')
                        .then(response => {
                            helper.unblockUI()

                            $('#master_crud').find('div.modal-body').html(response);
                            $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-plus"></i> Cost Center`);
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err}</h4>`
                            })
                        })

                    repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbase`, { input: 'abasedepartment' })
                        .then(response => {
                            helper.unblockUI()

                            var html = '<option></option>';
                            for (var i = 0; i < response.length; i++) {
                                html += `<option value="${response[i].DeptCode}">${response[i].DeptCode} - ${response[i].DeptDes}</option>`
                            }

                            $('#abasecostcenterdepartment').html(html);

                            helper.setSelect2($('#abasecostcenterdepartment'), {
                                dropdownParent: $('#master_crud'),
                                width: 'auto'
                            });
                        })
                        .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err}</h4>`
                            })
                        })
                    break;
            }
        })

        //SUBMIT ITEM
        $(document).on('click', '#btnAdd', async function () {
            var curTable = $(this).parents('portlet').find('table')

            switch ($(this).attr('input')) {
                case 'abasecompany':
                    var validated = _callable.validateModalInputs('form_abasecompany')
                    if (!validated) {
                        alert('Data Invalid')
                        return
                    }

                    var data_abasecompany = $('#form_abasecompany').serialize();
                    data_abasecompany = Object.fromEntries(new URLSearchParams(data_abasecompany))
                    data_abasecompany.input = 'abasecompany'

                    repository.submitRecord(`${baseURL}/Cmaster/inputDatamasterAbase`, data_abasecompany)
                    .then(response => {
                        helper.unblockUI()

                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                            })
                        }else{
                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4>${response.result}</h4>`
                            })
                        }

                        $('#master_crud').modal('hide');
                        location.reload();
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })
                    break;
                case 'abasebranch':
                    var validated = _callable.validateModalInputs('form_abasebranch')
                    if (!validated) {
                        alert('Data Invalid')
                        return
                    }

                    var data_abasebranch = $('#form_abasebranch').serialize();
                    data_abasebranch = Object.fromEntries(new URLSearchParams(data_abasebranch))
                    data_abasebranch.input = 'abasebranch'

                    await repository.submitRecord(`${baseURL}/Cmaster/inputDatamasterAbase`, data_abasebranch)
                    .then(response => {
                        helper.unblockUI()
                        
                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                            
                            })
                            
                            $('#master_crud').modal('hide');
                        }else{
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
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })
                    
                    await curTable.ajax.reload();
                    break;
                case 'abasedepartment':
                    var validated = _callable.validateModalInputs('form_abasedepartment')
                    if (!validated) {
                        alert('Data Invalid')
                        return
                    }

                    var data_abasedepartment = $('#form_abasedepartment').serialize();
                    data_abasedepartment = Object.fromEntries(new URLSearchParams(data_abasedepartment))
                    data_abasedepartment.input = 'abasedepartment'

                    await repository.submitRecord(`${baseURL}/Cmaster/inputDatamasterAbase`, data_abasedepartment)
                    .then(response => {
                        helper.unblockUI()
                        
                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                            
                            })
                            
                            $('#master_crud').modal('hide');
                        }else{
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
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })

                    await curTable.ajax.reload()
                    break;
                case 'abasedepartmentbu':
                    var validated = _callable.validateModalInputs('form_abasedepartmentbu')
                    if (!validated) {
                        alert('Data Invalid')
                        return
                    }

                    var data_abasedepartmentbu = $('#form_abasedepartmentbu').serialize();
                    data_abasedepartmentbu = Object.fromEntries(new URLSearchParams(data_abasedepartmentbu))
                    data_abasedepartmentbu.input = 'abasedepartmentbu'

                    await repository.submitRecord(`${baseURL}/Cmaster/inputDatamasterAbase`, data_abasedepartmentbu)
                    .then(response => {
                        helper.unblockUI()
                        
                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                            
                            })
                            
                            $('#master_crud').modal('hide');
                        }else{
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
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })
                    
                    await curTable.ajax.reload();
                    break;
                case 'abasedepartmentdiv':
                    var validated = _callable.validateModalInputs('form_abasedepartmentdiv')
                    if (!validated) {
                        alert('Data Invalid')
                        return
                    }

                    var data_abasedepartmentdiv = $('#form_abasedepartmentdiv').serialize();
                    data_abasedepartmentdiv = Object.fromEntries(new URLSearchParams(data_abasedepartmentdiv))
                    data_abasedepartmentdiv.input = 'abasedepartmentdiv'

                    await repository.submitRecord(`${baseURL}/Cmaster/inputDatamasterAbase`, data_abasedepartmentdiv)
                    .then(response => {
                        helper.unblockUI()
                        
                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                            
                            })
                            
                            $('#master_crud').modal('hide');
                        }else{
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
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })
                    
                    await curTable.ajax.reload();
                    break;
                case 'abasecostcenter':
                    var validated = _callable.validateModalInputs('form_abasecostcenter')
                    if (!validated) {
                        alert('Data Invalid')
                        return
                    }

                    var data_abasecostcenter = $('#form_abasecostcenter').serialize();
                    data_abasecostcenter = Object.fromEntries(new URLSearchParams(data_abasecostcenter))
                    data_abasecostcenter.input = 'abasecostcenter'

                    await repository.submitRecord(`${baseURL}/Cmaster/inputDatamasterAbase`, data_abasecostcenter)
                    .then(response => {
                        helper.unblockUI()
                        
                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                        
                            })
                            $('#master_crud').modal('hide');
                        }else{
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
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })
                    
                    await curTable.ajax.reload();
                    break;
            }
        })
    },

    eventEditItem: () => {
        // OPEN MODAL COMPANY PROFILE
        $(document).on('click', '.view-abase', async function () {
            var id = $(this).parent().parent().attr('id');
            $('#master_crud>div.modal-dialog').attr('class', 'modal-dialog modal-lg');
            switch ($(this).attr('input')) {
                case 'abasecompany':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').hide();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterViewAbase`, { input: 'abasecompany' }, 'htm')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(response);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-search"></i> Company`);
                        $('#master_crud').find('.abasecompanyviewaction').attr('id', id);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbaseByID`, { input: 'abasecompany', CtrlNo: id })
                    .then(response => {
                        helper.unblockUI()

                        $('#abasecompanyshortname').text(response.ComShortName)
                        $('#abasecompanydescription').text(response.ComDes)
                        $('#abasecompanyaddress').text(`${response.Address}, ${response.City}, ${response.Province}, ${response.Country}, ${response.PostalCode}`)
                        $('#abasecompanycode').text(response.ComCode)
                        $('#abasecompanyname').text(response.ComName)
                        $('#abasecompanytype').html(`<span class="badge badge-roundless bg-blue bg-font-blue">${response.CompType}</span>`)
                        $('#abasecompanynpwp').text(response.NPWP)
                        $('#abasecompanyphone').text(response.PhoneNo)
                        $('#abasecompanycontact').text(response.ContactNo);
                        $('#abasecompanycontactname').text(response.ContactName);
                        $('#abasecompanyemail').text(response.Email);
                        $('#abasecompanywebaddress').text(response.WebAddress);
                        $('#abasebranchlogo').attr("src", "http://localhost/assets/" + response.Logo)
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })
                    break;
                case 'abasebranch':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').hide();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterViewAbase`, { input: 'abasebranch' }, 'html')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(response);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-search"></i> Branch`);
                        $('#master_crud').find('.abasebranchviewaction').attr('id', id);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbaseByID`, { input: 'abasebranch', CtrlNo: id })
                    .then(response => {
                        helper.unblockUI()

                        $('#abasebranchname').text(response.BranchName)
                        $('#abasebranchdescription').text(response.BranchDes)
                        $('#abasebranchaddress').text(`${response.BranchAddress}, ${response.BranchCity}, ${response.Province}, ${response.Country}, ${response.PostalCode}`)
                        $('#abasebranchcode').text(response.BranchCode)
                        $('#abasebranchtype').html(`<span class="badge badge-roundless bg-blue bg-font-blue">${response.BranchType}</span>`)
                        $('#abasebranchphone').text(response.PhoneNo)
                        $('#abasebranchcontact').text(response.ContactNo)
                        $('#abasebranchcontactname').text(response.ContactName)
                        $('#abasebranchemail').text(response.Email)
                        $('#abasebranchwebaddress').text(response.WebAddress)
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })
                    break;
            }
        })

        //OPEN MODAL ITEM
        $(document).on('click', '.edit-abase', async function (e) {
            e.preventDefault();
            
            var id = $(this).data('id')
            $('#master_crud>div.modal-dialog').attr('class', 'modal-dialog modal-md');

            switch ($(this).attr('input')) {
                case 'abasecompany':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({ 'data-id': id, 'input': 'abasecompany' }).show();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, { input: 'abasecompany' }, 'html')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(response);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Company`);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbaseByID`, { input: 'abasecompany', CtrlNo: id })
                    .then(response => {
                        helper.unblockUI()

                        $('#abasebranchcompanycode').val(response.ComCode).trigger('change');
                        $('#abasecompanycode').val(response.ComCode);
                        $('#abasecompanyname').val(response.ComName);
                        $('#abasecompanyshortname').val(response.ComShortName);
                        $('#abasecompanydescription').val(response.ComDes);
                        $('#abasecompanytype').val(response.CompType);
                        $('#abasecompanyaddress').val(response.Address);
                        $('#abasecompanycity').val(response.City);
                        $('#abasecompanyprovince').val(response.Province);
                        $('#abasecompanypostalcode').val(response.PostalCode);
                        $('#abasecompanycountry').val(response.Country);
                        $('#abasecompanyregion').val(response.Region);
                        $('#abasecompanyphone').val(response.PhoneNo);
                        $('#abasecompanycontact').val(response.ContactNo);
                        $('#abasecompanycontactname').val(response.ContactName);
                        $('#abasecompanynpwp').val(response.NPWP);
                        $('#abasecompanylogo').val(response.Logo);
                        $('#abasecompanyemail').val(response.Email);
                        $('#abasecompanyremarks').val(response.Remarks);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })
                    break;
                case 'abasebranch':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({ 'data-id': id, 'input': 'abasebranch' }).show();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, { input: 'abasebranch' }, 'html')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(response);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Branch`);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbase`, { input: 'abasecompany' })
                    .then(response => {
                        helper.unblockUI()

                        var html = '<option></option>';
                        for (var i = 0; i < response.length; i++) {
                            html += `<option value="${response[i].ComCode}">${response[i].ComCode} - ${response[i].ComShortName}</option>`
                        }

                        $('#abasebranchcompanycode').html(html);
                        helper.setSelect2($('#abasebranchcompanycode'), {
                            dropdownParent: $('#master_crud'),
                            width: 'auto'
                        });
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbaseByID`, { input: 'abasebranch', CtrlNo: id })
                    .then(response => {
                        helper.unblockUI()

                        $('#abasebranchcompanycode').val(response.ComCode).trigger('change');
                        $('#abasebranchcode').val(response.BranchCode);
                        $('#abasebranchname').val(response.BranchName);
                        $('#abasebranchdescription').val(response.BranchDes);
                        $('#abasebranchtype').val(response.BranchType);
                        $('#abasebranchaddress').val(response.BranchAddress);
                        $('#abasebranchcity').val(response.BranchCity);
                        $('#abasebranchprovince').val(response.Province);
                        $('#abasebranchprovincegroup').val(response.ProvinceGrp);
                        $('#abasebranchpostalcode').val(response.PostalCode);
                        $('#abasebranchcountry').val(response.Country);
                        $('#abasebranchphone').val(response.PhoneNo);
                        $('#abasebranchcontact').val(response.ContactNo);
                        $('#abasebranchcontactname').val(response.ContactName);
                        $('#abasebranchnpwp').val(response.NPWP);
                        $('#abasebranchlogo').val(response.Logo);
                        $('#abasebranchemail').val(response.Email);
                        $('#abasebranchremarks').val(response.Remarks);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })
                    break;
                case 'abasedepartment':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({ 'data-id': id, 'input': 'abasedepartment' }).show();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, { input: 'abasedepartment' }, 'html')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(response);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Department`);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbase`, { input: 'abasebranch' })
                    .then(response => {
                        helper.unblockUI()

                        var html = '<option></option>';
                        for (var i = 0; i < response.length; i++) {
                            html += `<option value="${response[i].BranchCode}">${response[i].BranchName}</option>`
                        }

                        $('#abasedepartmentbranch').html(html);

                        helper.setSelect2($('#abasedepartmentbranch'), {
                            dropdownParent: $('#master_crud'),
                            width: 'auto'
                        });

                        $(document).find('#abasedepartmentbranch').val(response.Branch).trigger('change');
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbase`, { input: 'abasedepartmentbu' })
                    .then(response => {
                        helper.unblockUI()

                        var html = '<option></option>';
                        for (var i = 0; i < response.length; i++) {
                            html += `<option value="${response[i].BUCode}">${response[i].BUCode} - ${response[i].BUDes}</option>`
                        }

                        $('#abasedepartmentbucode').html(html);

                        helper.setSelect2($('#abasedepartmentbucode'), {
                            dropdownParent: $('#master_crud'),
                            width: 'auto'
                        });

                        $(document).find('#abasedepartmentbucode').val(response.BUCode).trigger('change');
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbaseByID`, { input: 'abasedepartment', CtrlNo: id })
                    .then(response => {
                        helper.unblockUI()

                        $('#abasedepartmentcode').val(response.DeptCode);
                        $('#abasedepartmentdescription').val(response.DeptDes);
                        $('#abasedepartmentremarks').val(response.Remarks);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })
                    break;
                case 'abasedepartmentbu':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({ 'data-id': id, 'input': 'abasedepartmentbu' }).show();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, { input: 'abasedepartmentbu' }, 'html')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(response);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Business Unit`);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbase`, { input: 'abasedepartmentdiv' })
                    .then(response => {
                        helper.unblockUI()

                        var html = '<option></option>';
                        for (var i = 0; i < value.length; i++) {
                            html += `<option value="${value[i].DivCode}">${value[i].DivCode} - ${value[i].DivDes}</option>`
                        }

                        $('#abasedepartmentbudivisioncode').html(html);

                        helper.setSelect2($('#abasedepartmentbudivisioncode'), {
                            dropdownParent: $('#master_crud'),
                            width: 'auto'
                        });

                        $('#abasedepartmentbudivisioncode').val(response.DivCode).trigger('change');
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbaseByID`, { input: 'abasedepartmentbu', CtrlNo: id })
                    .then(response => {
                        helper.unblockUI()

                        $('#abasedepartmentbucode').val(response.BUCode);
                        $('#abasedepartmentbudescription').val(response.BUDes);
                        $('#abasedepartmentburemarks').val(response.Remarks);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })
                    break;
                case 'abasedepartmentdiv':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({ 'data-id': id, 'input': 'abasedepartmentdiv' }).show();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, { input: 'abasedepartmentdiv' }, 'html')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(response);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Division`);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbaseByID`, { input: 'abasedepartmentdiv', CtrlNo: id })
                    .then(response => {
                        helper.unblockUI()

                        $('#abasedepartmentdivcode').val(response.DivCode);
                        $('#abasedepartmentdivdescription').val(response.DivDes);
                        $('#abasedepartmentdivremarks').val(response.Remarks);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })
                    break;
                case 'abasecostcenter':
                    $('#master_crud').modal('show');
                    $('#btnAdd').hide();
                    $('#btnEdit').attr({ 'data-id': id, 'input': 'abasecostcenter' }).show();

                    await repository.getRecord(`${baseURL}/Cmaster/viewModalMasterAbase`, postData, 'html')
                    .then(response => {
                        helper.unblockUI()

                        $('#master_crud').find('div.modal-body').html(response);
                        $('#master_crud').find('h4.modal-title').html(`<i class="fa fa-pencil"></i> Cost Center`);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbase`, postData)
                    .then(response => {
                        helper.unblockUI()

                        var html = '<option></option>';
                        for (var i = 0; i < response.length; i++) {
                            html += `<option value="${response[i].DeptCode}">${response[i].DeptCode} - ${response[i].DeptDes}</option>`
                        }

                        $('#abasecostcenterdepartment').html(html);

                        helper.setSelect2($('#abasecostcenterdepartment'), {
                            dropdownParent: $('#master_crud'),
                            width: 'auto'
                        });

                        $('#abasecostcenterdepartment').val(response.DeptCode).trigger('change');
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    await repository.getRecord(`${baseURL}/Cmaster/getDataMasterAbaseByID`, postData)
                    .then(response => {
                        helper.unblockUI()

                        $('#abasecostcentercode').val(response.CostCenter);
                        $('#abasecostcenterdescription').val(response.CCDes);
                        $('#abasecostcenterremarks').val(response.Remarks);
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })
                    break;
            }
        })

        //SUBMIT EDIT
        $(document).on('click', '#btnEdit', async function () {
            var id = $(this).data('id')
            var curTable = $(this).parents('portlet').find('table')

            switch ($(this).attr('input')) {
                case 'abasecompany':
                    var data_abasecompany = $('#form_abasecompany').serialize();
                    data_abasecompany = Object.fromEntries(new URLSearchParams(data_abasecompany))
                    data_abasecompany.id = id
                    data_abasecompany.input = 'abasecompany'

                    await repository.submitRecord(`${baseURL}/Cmaster/editDataMasterAbase`, data_abasecompany)
                    .then(response => {
                        helper.unblockUI()

                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                            })
                            
                            $('#master_crud').modal('hide');
                        }else{
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
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })

                    location.reload()
                    break;
                case 'abasebranch':
                    var data_abasebranch = $('#form_abasebranch').serialize();
                    data_abasebranch = Object.fromEntries(new URLSearchParams(data_abasebranch))
                    data_abasebranch.id = id
                    data_abasebranch.input = 'abasebranch'

                    await repository.submitRecord(`${baseURL}/Cmaster/editDataMasterAbase`, data_abasebranch)
                    .then(response => {
                        helper.unblockUI()

                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                            })
                            
                            $('#master_crud').modal('hide');
                        }else{
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
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })

                    await curTable.ajax.reload();
                    break;
                case 'abasedepartment':
                    var data_abasedepartment = $('#form_abasedepartment').serialize();
                    data_abasedepartment = Object.fromEntries(new URLSearchParams(data_abasedepartment))
                    data_abasedepartment.id = id
                    data_abasedepartment.input = 'abasedepartment'

                    await repository.submitRecord(`${baseURL}/Cmaster/editDataMasterAbase`, data_abasedepartment)
                    .then(response => {
                        helper.unblockUI()

                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                            })
                            
                            $('#master_crud').modal('hide');
                        }else{
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
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })

                    await curTable.ajax.reload();
                    break;
                case 'abasedepartmentbu':
                    var data_abasedepartmentbu = $('#form_abasedepartmentbu').serialize();
                    data_abasedepartmentbu = Object.fromEntries(new URLSearchParams(data_abasedepartmentbu))
                    data_abasedepartmentbu.id = id
                    data_abasedepartmentbu.input = 'abasedepartmentbu'

                    await repository.submitRecord(`${baseURL}/Cmaster/editDataMasterAbase`, data_abasedepartmentbu)
                    .then(response => {
                        helper.unblockUI()

                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                            })
                            
                            $('#master_crud').modal('hide');
                        }else{
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
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })

                    await curTable.ajax.reload();
                    break;
                case 'abasedepartmentdiv':
                    var data_abasedepartmentdiv = $('#form_abasedepartmentdiv').serialize();
                    data_abasedepartmentdiv = Object.fromEntries(new URLSearchParams(data_abasedepartmentdiv))
                    data_abasedepartmentdiv.id = id
                    data_abasedepartmentdiv.input = 'abasedepartmentdiv'

                    await repository.submitRecord(`${baseURL}/Cmaster/editDataMasterAbase`, data_abasedepartmentdiv)
                    .then(response => {
                        helper.unblockUI()

                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                            })
                            
                            $('#master_crud').modal('hide');
                        }else{
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
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })

                    await curTable.ajax.reload();
                    break;
                case 'abasecostcenter':
                    var data_abasecostcenter = $('#form_abasecostcenter').serialize();
                    data_abasecostcenter = Object.fromEntries(new URLSearchParams(data_abasecostcenter))
                    data_abasecostcenter.id = id
                    data_abasecostcenter.input = 'abasecostcenter'

                    await repository.submitRecord(`${baseURL}/Cmaster/editDataMasterAbase`, data_abasecostcenter)
                    .then(response => {
                        helper.unblockUI()

                        if(response.result){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'SUCCESS',
                                'html': 'Data Submitted'
                            })
                            
                            $('#master_crud').modal('hide');
                        }else{
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
                            'html': `<h4 class="sbold">${err?.responseJSON?.desc ?? 'Server Problem'}</h4>`
                        })
                    })

                    await curTable.ajax.reload();
                    break;
            }
        })
    },

    eventDeleteItem: () => {
        $(document).on('click', 'a.disc-abase', async function () {
            var id = $(this).data('id')
            var curTable = $(this).parents('table')

            var confirm = window.confirm('Are you sure to discontinue this data ?')
            if (!confirm) return

            switch ($(this).attr('input')) {
                case 'abasecompany':
                    await repository.getRecord(`${baseURL}/Cmaster/discDataMasterAbase`, { input: 'abasecompany', id: id })
                    .then(() => {
                        helper.unblockUI()
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    alert('Company Discontinued');
                    $('#master_crud').modal('hide');

                    await curTable.ajax.reload()
                    break;
                case 'abasebranch':
                    var remarks = prompt("Remarks", "");

                    await repository.getRecord(`${baseURL}/Cmaster/discDataMasterAbase`, { input: 'abasebranch', id: id, remarks: remarks })
                    .then(() => {
                        helper.unblockUI()
                    })
                    .fail(err => {
                            helper.unblockUI()

                            Swal.fire({
                                'icon': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${err}</h4>`
                            })
                        })

                    alert('Branch Discontinued');
                    $('#master_crud').modal('hide');

                    await curTable.ajax.reload()
                    break;
                case 'abasedepartment':
                    var remarks = prompt("Remarks", "");

                    await repository.getRecord(`${baseURL}/Cmaster/discDataMasterAbase`, { input: 'abasedepartment', id: id, remarks: remarks })
                    .then(() => {
                        helper.unblockUI()
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    alert('Department Discontinued');
                    $('#master_crud').modal('hide');

                    await curTable.ajax.reload()
                    break;
                case 'abasedepartmentbu':
                    var remarks = prompt("Remarks", "");

                    await repository.getRecord(`${baseURL}/Cmaster/discDataMasterAbase`, { input: 'abasedepartmentbu', id: id, remarks: remarks })
                    .then(() => {
                        helper.unblockUI()
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    alert('Business Unit Discontinued');
                    $('#master_crud').modal('hide');

                    await curTable.ajax.reload()
                    break;
                case 'abasedepartmentdiv':
                    var remarks = prompt("Remarks", "");

                    await repository.getRecord(`${baseURL}/Cmaster/discDataMasterAbase`, { input: 'abasedepartmentdiv', id: id, remarks: remarks })
                    .then(() => {
                        helper.unblockUI()
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    alert('Division Discontinued');
                    $('#master_crud').modal('hide');

                    await curTable.ajax.reload()
                    break;
                case 'abasecostcenter':
                    await repository.getRecord(`${baseURL}/Cmaster/discDataMasterAbase`, { input: 'abasecostcenter', id: id })
                    .then(() => {
                        helper.unblockUI()
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err}</h4>`
                        })
                    })

                    alert('Cost Center Discontinued');
                    $('#master_crud').modal('hide');

                    await curTable.ajax.reload()
                    break;
            }
        })
    }
}

export default mopr