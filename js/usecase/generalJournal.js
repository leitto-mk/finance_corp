/*
 *  CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const baseURL = window.location.origin

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

const gj = {
    indexPage: {
        initDT: () => {
            let url = {
                target: 'ajax_get_ranged_general_journal',
                edit: 'edit_general_journal',
                report: 'view_reps_general_journal'
            }

            let postData = {
                docno: '',
                date_start: helper.firstDayOfMonth(),
                date_end: helper.lastDayOfMonth()
            }

            repository.generateDataTable('table', url, postData, dtColumns)
        },
    
        eventShowList: () => {
            $('#preview, #search').click(function(){
                let docno = $('#search_item').val()
                let date_start = $('#date_from').val()
                let date_end = $('#date_to').val()

                let url = {
                    target: 'ajax_get_ranged_general_journal',
                    edit: 'edit_general_journal',
                    report: 'view_reps_general_journal'
                }
    
                repository.generateDataTable('table', url, { docno, date_start, date_end }, dtColumns)
                
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
    
                repository.deleteRecord('ajax_delete_general_journal', { docno, branch, transdate })
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
                        'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                    })
                })
            })
        },
    },

    formPage: {
        initInputMask: () => {
            let debit = $(document).find('input[name="debit[]"]')
            let credit = $(document).find('input[name="credit[]"]')
            let total_debit = $(document).find('#total_debit')
            let total_credit = $(document).find('#total_credit')
            
            helper.setInputMask(debit, "currency")
            helper.setInputMask(credit, "currency")
            helper.setInputMask(total_debit, "currency")
            helper.setInputMask(total_credit, "currency")
        },
        
        eventFocusNextInput: () => {
            $(document).on('keypress', function (e) {
                const key = e.keyCode || e.which
                
                if (key === 13) {
                    e.preventDefault()
    
                    // Get all focusable elements
                    var focusable = $(':focusable').not("a, button, #label_tot_amount, #totalamount, [name='itemno[]'], [name='amount[]'], #total_debit, #total_credit")
                    var index = focusable.index(document.activeElement)
                    
                    var cur_input = focusable.eq(index)
                    focusable.eq(index).parent().removeClass('has-warning')

                    if(index >= focusable.length){
                        index = 0
                    }
    
                    if(cur_input.attr('name') == 'credit[]' && index !== -1){
                        let remarks = cur_input.parents('tr').find('input[name="remarks[]"]').val()
                        let departments = cur_input.parents('tr').find('select[name="departments[]"] option:selected').val()
                        let costcenters = cur_input.parents('tr').find('select[name="costcenters[]"] option:selected').val()
                        let accnos = cur_input.parents('tr').find('select[name="accnos[]"]').val()
                        let currency = cur_input.parents('tr').find('select[name="currency[]"]').val()
                        let debit = cur_input.parents('tr').find('input[name="debit[]"]').val()
                        let credit = cur_input.parents('tr').find('input[name="credit[]"]').val()
    
                        if(!remarks || !departments || !costcenters || !accnos || !currency || !debit || !credit){
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
                            row.find('[name="debit[]"]').val(0)
                            row.find('[name="credit[]"]').val(0)
    
                            $('#tbody_detail').append(row)
                        }
    
                        //Set Focus on the next Description field
                        $('#tbody_detail > tr > td > input[name="remarks[]"]').last().focus()
                        $('#tbody_detail > tr > td > input[name="remarks[]"]').last().parent().addClass('has-warning')

                        gj.formPage.initInputMask()
                    }
    
                    focusable.eq(index+1).focus()
                    focusable.eq(index+1).parent().addClass('has-warning')
                }
            });
        },
    
        eventDeleteRow: () => {
            $(document).on('click','[name="itemno[]"]',function(){
                let count_row = $('#tbody_detail').children('tr').length
    
                if(window.confirm('Delete Row ?') && count_row > 1){
                    $(this).parents('tr').remove()
                }else{
                    return
                }
    
                var total_debit = 0
                $('[name="debit[]"]').each(function(i, n){
                    total_debit += +$(this).val()
                })
                
                    $('#total_debit').val(total_debit)
    
                var total_credit = 0
                $('[name="credit[]"]').each(function(i, n){
                    total_credit += +$(this).val()
                })
                
                $('#total_debit').val(total_debit)
                $('#total_credit').val(total_credit)
            })
        },
    
        eventInputAmount: () => {
            $(document).on('input','[name="debit[]"],[name="credit[]"]', function(){
                
                var total_debit = 0
                $('[name="debit[]"]').each(function(i, n){
                    total_debit += ($(this).val() !== '' ? parseFloat($(this).val().replaceAll(',','')) : 0)
                })
                
                    $('#total_debit').val(total_debit)
    
                var total_credit = 0
                $('[name="credit[]"]').each(function(i, n){
                    total_credit += ($(this).val() !== '' ? parseFloat($(this).val().replaceAll(',','')) : 0)
                })
                
                $('#total_debit').val(total_debit)
                $('#total_credit').val(total_credit)
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
    
        eventSubmitGeneral: () => {
            $('form').submit(function(e){
                e.preventDefault()
            
                //Remove Row with empty Description
                if($('#tbody_detail > tr').length > 1){
                    $(document).find('#tbody_detail tr').each(function(){
                        var cur_remark_val = $(this).find('input[name="remarks[]"]').val()
                        var cur_debit_val = +$(this).find('input[name="debit[]"]').val()
                        var cur_credit_val = +$(this).find('input[name="credit[]"]').val()
        
                        if(cur_remark_val == '' || (cur_debit_val == 0 && cur_credit_val == 0)){
                            $(this).remove()
                        }
                    })
                }
    
                let count_row = $('#tbody_detail').children('tr').length
                let total_debit = parseFloat($('#total_debit').val().replaceAll(',',''))
                let total_credit = parseFloat($('#total_credit').val().replaceAll(',',''))
    
                if(count_row == 1){
                    alert('DETAIL ROW MUST BE TWO OR MORE')
                    return
                }
    
                if(total_debit !== total_credit){
                    alert('DEBIT AND CREDIT IS NOT BALANCE')
                    return
                }
                
                let formData = $('#form_general_journal').serializeArray()

                //Deformat Numbers
                formData.find(input => {
                    if(input.name == 'debit[]' || input.name == 'credit[]'){
                        input.value = parseFloat(input.value.replaceAll(',',''))
                    }
                })
    
                var docno = $('[name="docno"]').val()
                var branch = $('[name="branch"]').val()
                var transdate = $('[name="transdate"]').val()
    
                repository.submitRecord('ajax_submit_general_journal', formData)
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

                        $('#new_transaction').prop('href', window.location.origin + '/Entry/add_general_journal')
                        $('#new_transaction').css('visibility', 'visible')
                        
                        $('#print_transaction').prop('href', window.location.origin + '/Entry/view_reps_general_journal' + `?docno=${docno}&branch=${branch}&transdate=${transdate}`)
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
                        'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                    })
                })
            })
        },
    }
}

export default gj