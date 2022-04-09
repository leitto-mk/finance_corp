/*
 * Core Script
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const dtColumns = [
    {
        data: 'TransDate',
        createdCell: response => response.setAttribute('align', 'center'),
        render: row => {
            return `<div class="font-dark sbold">${row}</div>`
        },
        orderable: false,
    },
    {
        data: 'DocNo',
        createdCell: response => response.setAttribute('align', 'center'),
        render: row => {
            return `<div class="font-dark sbold">${row}</div>`
        },
        orderable: false,
    },
    {
        data: 'TransType',
        createdCell: response => response.setAttribute('align', 'center'),
        render: row => {
            return `<div class="font-dark sbold">${row}</div>`
        },
        orderable: false,
    },
    {
        data: response => {
            return response.Branch + ' | ' + response.BranchName
        },
        createdCell: response => response.setAttribute('align', 'left'),
        render: row => {
            return `<div class="font-dark sbold">${row}</div>`
        },
        orderable: false,
    },
    {
        data: 'Remarks',
        createdCell: response => response.setAttribute('align', 'left'),
        render: row => {
            return `<div class="font-dark sbold">${row}</div>`
        },
        orderable: false,
    },
    {
        data: 'TotalAmount',
        createdCell: response => response.setAttribute('align', 'right'),
        render: row => {
            return `<div class="font-dark sbold">${Intl.NumberFormat('en').format(row)}</div>`
        },
        orderable: false,
    },
    {
        data: response => {
            var location = window.location.href
            var baseURL = location.substring(0, location.lastIndexOf('/'))

            return `
                <a href="${baseURL}/${url.edit}?docno=${response.DocNo}" target="_blank" type="button" class="btn btn-xs green">
                    <i class="fa fa-edit"> </i>
                </a>
                <a href="${baseURL}/${url.report}?docno=${response.DocNo}&branch=${response.Branch}&transdate=${response.TransDate}" target="_blank" name="report" type="button" class="btn btn-xs green-meadow">
                    <i class="fa fa-print"> </i>
                </a>
                <a href="javascript:;" name="delete" data-docno="${response.DocNo}" data-branch="${response.Branch}" data-transdate="${response.TransDate}" type="button" class="btn btn-xs red">
                    <i class="fa fa-trash"> </i>
                </a>
            `
        },
        createdCell: response => response.setAttribute('align', 'center'),
        render: response => {
            return `<div>${response}</div>`
        },
        orderable: false
    },
]

const caw = {
    indexPage: {
        initDT: () => {
            let url = {
                target: 'ajax_get_ranged_ca_withdraw',
                edit: 'edit_ca_withdraw',
                report: 'view_reps_cash_withdraw'
            }

            let postData = {
                docno: '',
                date_start: helper.firstDayOfMonth(),
                date_end: helper.lastDayOfMonth()
            }

            repository.generateDataTable('table', url, postData, dtColumns)
            .then(() => {
                helper.unblockUI()
            })
            .fail(err => {
                helper.unblockUI()
                
                Swal.fire({
                    'icon': 'error',
                    'title': 'ABORTED',
                    'html': `<h4 class="sbold">${err.desc}</h4>`
                })
            })
        },
    
        eventShowList: () => {
            $('#preview, #search').click(function(){
                let docno = $('#search_item').val()
                let date_start = $('#date_from').val()
                let date_end = $('#date_to').val()

                let url = {
                    target: 'ajax_get_ranged_ca_withdraw',
                    edit: 'edit_ca_withdraw',
                    report: 'view_reps_cash_withdraw'
                }
    
                repository.generateDataTable('table', url, { docno, date_start, date_end }, dtColumns)
                .then(() => {
                    helper.unblockUI()
                })
                .fail(err => {
                    helper.unblockUI()
                    
                    Swal.fire({
                        'icon': 'error',
                        'title': 'ABORTED',
                        'html': `<h4 class="sbold">${err.desc}</h4>`
                    })
                })
            })
        },
    
        eventDeleteRecord: () => {
            $(document).on('click','[name=delete]', function(){
                var row = $(this).parents('tr')
                let docno = $(this).attr('data-docno')
                let branch = $(this).attr('data-branch')
                let transdate = $(this).attr('data-transdate')
    
                let confirmed = confirm(`Are You sure want to delete ${docno} ? `)
    
                if(!confirmed){
                    return
                }
    
                repository.deleteRecord('ajax_delete_ca_withdraw', { docno, branch, transdate })
                .then(response => {
                    helper.unblockUI()

                    if(response.success == true){
                        Swal.fire({
                            'icon': 'success',
                            'title': 'DELETED'
                        })
                        
                        row.remove()
                    }else{
                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${response.desc}</h4>`
                        })
                    }
                })
                .fail(err => {
                    helper.unblockUI()

                    Swal.fire({
                        'icon': 'error',
                        'title': 'ERROR',
                        'html': `<h4 class="sbold">${err.desc}</h4>`
                    })
                })
            })
        },
    },

    formPage: {
        initInputMask: () => {
            let unit = $(document).find('input[name="unit[]"]')
            let amount = $(document).find('input[name="amount[]"]')
            helper.setInputMask(unit, "currency")
            helper.setInputMask(amount, "currency")
        },
        
        eventFocusNextInput: () => {
            $(document).on('keypress', function (e) {
                const key = e.keyCode || e.which
                
                if (key === 13) {
                    e.preventDefault()
    
                    // Get all focusable elements
                    var focusable = $(':focusable').not("a, button, #label_tot_amount, #totalamount, [name='itemno[]'], [name='amount[]'], [readonly]")
                    var index = focusable.index(document.activeElement)
                    
                    var cur_input = focusable.eq(index)
                    focusable.eq(index).parent().removeClass('has-warning')

                    if(index >= focusable.length){
                        index = 0
                    }
    
                    if(cur_input.attr('name') == 'unit[]' && index !== -1){
                        let remarks = cur_input.parents('tr').find('input[name="remarks[]"]').val()
                        let departments = cur_input.parents('tr').find('select[name="departments[]"] option:selected').val()
                        let costcenters = cur_input.parents('tr').find('select[name="costcenters[]"] option:selected').val()
                        let accnos = cur_input.parents('tr').find('select[name="accnos[]"]').val()
                        let currency = cur_input.parents('tr').find('select[name="currency[]"]').val()
                        let rate = cur_input.parents('tr').find('input[name="rate[]"]').val()
                        let unit = cur_input.parents('tr').find('input[name="unit[]"]').val()
    
                        if(!remarks || !departments || !costcenters || !accnos || !currency || !rate || !unit){
                            alert('PLEASE FILL ALL THE INPUT')
                            
                            return
                        }
    
                        let row = cur_input.parents('tr').clone()
    
                        if(cur_input.parents('tr').is(':last-child')){
                            let cur_itemno = +row.find('[name="itemno[]"]').val()
    
                            row.find('[name="itemno[]"]').val(cur_itemno+1)
                            row.find('[name="remarks[]"]').val('')
                            row.find('[name="departments[]"]').val('')
                            row.find('[name="costcenters[]"]').val('')
                            row.find('[name="unit[]"]').val(0)
                            row.find('[name="amount[]"]').val(0)
    
                            $('#tbody_detail').append(row)
                        }

                        //Set Focus on the next Description field
                        $('#tbody_detail > tr > td > input[name="remarks[]"]').last().focus()
                        $('#tbody_detail > tr > td > input[name="remarks[]"]').last().parent().addClass('has-warning')

                        initInputMask()
                    }

                    focusable.eq(index+1).focus()
                    focusable.eq(index+1).parent().addClass('has-warning')
                }
            });
        },
    
        eventSelectEmployee: () => {
            $(document).on('change', '#emp_master_id',function(){
                let fullname = $(this).find('option:selected').attr('data-fullname')
                let branch = $(this).find('option:selected').attr('data-branch')
                let balance = $(this).find('option:selected').attr('data-balance')
                
                $('#emp_master_name').val(fullname)
                $('#branch').val(branch)
                $('#outstanding').val(balance)
            })
        },
    
        eventDeleteRow: () => {
            $(document).on('click','input[name="itemno[]"]',function(){
                var total = $('#tbody_detail').children('tr').length
                if(total <= 1){
                    return
                }
    
                $(this).parents('tr').remove()
    
                var index = 0
                $('#tbody_detail input[name="itemno[]"]').each(function(){
                    $(this).val(index+1)
    
                    ++index
                })
    
                var totalamount = 0;
                $('[name="amount[]"]').each(function(){
                    totalamount += parseFloat($(this).val().replaceAll(',',''))
                })
    
                $('#totalamount').val(totalamount)
                $('#label_tot_amount').val(`Rp. ${Intl.NumberFormat('en').format(totalamount)}`)
            })
        },
    
        eventInputUnit: () => {
            $(document).on('input','[name="unit[]"],[name="rate[]"]', function(){
                let cur_total_amount = +$('#totalamount').val()
                let outstanding = +$('#outstanding').val()

                let totalamount = 0
                let rate = +$(this).parents('tr').find('[name="rate[]"]').val()
                let unit = $(this).parents('tr').find('[name="unit[]"]').val()
                unit = (unit !== '' ? parseFloat(unit.replaceAll(',','')) : 0)
                let total = rate * unit
    
                $(this).parents('tr').find('[name="amount[]"]').val(total)
    
                $('[name="amount[]"]').each(function(){
                    totalamount += parseFloat($(this).val().replaceAll(',',''))
                })

                let outstanding_left = (outstanding-cur_total_amount)+totalamount
    
                $('#totalamount').val(totalamount)
                $('#label_tot_amount').val(`Rp. ${Intl.NumberFormat('en').format(totalamount)}`)
                $('#outstanding').val(outstanding_left)
                
                $('#outstanding_left').val(outstanding_left)
                $('#label_outstanding_left').val(`Rp. ${Intl.NumberFormat('en').format(outstanding_left)}`)
            })
        },
    
        eventChangeBranch: () => {
            $(document).on('change','.branch', function(){
                var branch = $(this).find('option:selected').val()
    
                $('#tbody_detail').find('select[name="departments[]"] option:first').prop('selected', true)
            
                $('#tbody_detail').find('select[name="departments[]"] option:selected').each(function(){
                    $(this).show()
    
                    if($(this).is('[data-department]') && $(this).attr('data-branch') !== branch){
                        $(this).hide()
                    }
                })
            })
        },
    
        eventChangeDepartment: () => {
            $(document).on('change','select[name="departments[]"]', function(){
                var department = $(this).find('option:selected').val()
    
                $(this).parents('tr').find('select[name="costcenters[]"] option:first').prop('selected', true)
    
                $(this).parents('tr').find('select[name="costcenters[]"] option').each(function(){
                    $(this).show()
    
                    if($(this).is('[data-department]') && $(this).attr('data-department') !== department){
                        $(this).hide()
                    }
                })
            })
        },
    
        eventSubmitCAWithdraw: () => {
            $('form').submit(function(e){
                e.preventDefault()
            
                //Remove Row with empty Description
                if($('#tbody_detail > tr').length > 1){
                    $(document).find('#tbody_detail tr').each(function(){
                        var cur_remark_val = $(this).find('input[name="remarks[]"]').val()
                        var cur_amount_val = +$(this).find('input[name="amount[]"]').val()
        
                        if(cur_remark_val == '' || cur_remark_val == null || cur_amount_val == 0 || cur_amount_val == null){
                            $(this).remove()
                        }
                    })
                }
                
                let formData = $('#form_ca_withdraw').serializeArray()

                //Deformat Numbers
                formData.find(input => {
                    if(input.name == 'unit[]' || input.name == 'amount[]'){
                        input.value = parseFloat(input.value.replaceAll(',',''))
                    }
                })
    
                var docno = $('[name="docno"]').val()
                var branch = $('[name="branch"]').val()
                var transdate = $('[name="transdate"]').val()
    
                repository.submitRecord('ajax_submit_ca_withdraw', formData)
                .then(response => {
                    helper.unblockUI()

                    if(response.success == true){
                        Swal.fire({
                            'icon': 'success',
                            'title': 'SUCCESS',
                            'html': 'DATA HAS BEEN SUBMITTED'
                        })

                        $('input, textarea').prop('readonly', true)
                        $('select').prop('disabled', true)

                        $('#new_transaction').prop('href', window.location.origin + '/Cash_adv/add_ca_withdraw')
                        $('#new_transaction').css('visibility', 'visible')
                        
                        $('#print_transaction').prop('href', window.location.origin + '/Cash_adv/view_reps_cash_withdraw' + `?docno=${docno}&branch=${branch}&transdate=${transdate}`)
                        $('#print_transaction').css('visibility', 'visible')
                        
                        $('#btn_submit').css('visibility', 'hidden')
                    }else{
                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${response.desc}</h4>`
                        })
                    }
                })
                .fail(err => {
                    helper.unblockUI()
            
                    Swal.fire({
                        'icon': 'error',
                        'title': 'ABORTED',
                        'html': `<h4 class="sbold">${err.desc}</h4>`
                    })
                })
            })
        },
    }
}

export default caw