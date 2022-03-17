/*
 *  CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const arp = {
    indexPage: {
        initDT: () => {
            let url = {
                target: 'ajax_get_ranged_ar_receipt_payment',
                edit: 'edit_ar_receipt_payment',
                report: 'view_reps_ar_receipt_payment'
            }

            repository.generateDataTable(url)
            .then(() => {
                helper.unblockUI()
            })
            .fail(err => {
                helper.unblockUI()
                
                Swal.fire({
                    'type': 'error',
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
                    target: 'ajax_get_ranged_ar_receipt_payment',
                    edit: 'edit_ar_receipt_payment',
                    report: 'view_reps_ar_receipt_payment'
                }
    
                repository.generateDataTable(url, { docno, date_start, date_end })
                .then(() => {
                    helper.unblockUI()
                })
                .fail(err => {
                    helper.unblockUI()
                    
                    Swal.fire({
                        'type': 'error',
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
    
                repository.deleteRecord('ajax_delete_ar_receipt_payment', { docno, branch, transdate })
                .then(response => {
                    helper.unblockUI()

                    if(response.success == true){
                        Swal.fire({
                            'type': 'success',
                            'title': 'DELETED'
                        })
                        
                        row.remove()
                    }else{
                        Swal.fire({
                            'type': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${response.desc}</h4>`
                        })
                    }
                })
                .fail(err => {
                    helper.unblockUI()

                    Swal.fire({
                        'type': 'error',
                        'title': 'ERROR',
                        'html': `<h4 class="sbold">${err.desc}</h4>`
                    })
                })
            })
        },
    },

    formPage: {
        eventFocusNextInput: () => {
            $(document).on('keypress', function (e) {
                const key = e.keyCode || e.which
                
                if (key === 13) {
                    e.preventDefault()
    
                    // Get all focusable elements
                    var focusable = $(':focusable').not("a, button, #label_tot_amount, #totalamount, [name='itemno[]'], [name='amount[]']")
                    var index = focusable.index(document.activeElement)
                    
                    var cur_input = focusable.eq(index)
    
                    if(cur_input.attr('name') == 'unit[]'){
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
                        $('#tbody_detail > tr > td > input[name="remarks[]"]').focus()
                    }else if(index >= focusable.length){
                        index = 0
                    }
    
                    focusable.eq(index+1).focus()
                }
            });
        },
    
        eventCreateRow: () => {
            $(document).on('keydown','[name="unit[]"]', function(e){
                if(e.keyCode == 9){
                    let remarks = $(this).parents('tr').find('input[name="remarks[]"]').val()
                    let departments = $(this).parents('tr').find('select[name="departments[]"] option:selected').val()
                    let costcenters = $(this).parents('tr').find('select[name="costcenters[]"] option:selected').val()
                    // let emp  = $(this).parents('tr').find('select[name="emp[]"]').val()
                    let accnos = $(this).parents('tr').find('select[name="accnos[]"]').val()
                    let currency = $(this).parents('tr').find('select[name="currency[]"]').val()
                    let rate = $(this).parents('tr').find('input[name="rate[]"]').val()
                    let unit = $(this).parents('tr').find('input[name="unit[]"]').val()
    
                    if(!remarks || !departments || !costcenters || !accnos || !currency || !rate || !unit){
                        alert('PLEASE FILL ALL THE INPUT')
                        
                        return
                    }
    
                    let row = $('#tbody_detail').children('tr').last()
                    $('tbody').find('tr[data-empty-row="true"]').remove()
        
                    let clone = row.clone()
                    
                    $(clone).find('[name="itemno[]"]').val(function(i, oldval){
                        return ++oldval
                    })
        
                    $(clone).find('[name="remarks[]"]').val('')
                    $(clone).find('[name="departments[]"]').val('')
                    $(clone).find('[name="costcenters[]"]').val('')
                    $(clone).find('[name="unit[]"]').val(0)
                    $(clone).find('[name="amount[]"]').val(0)
        
                    $('tbody').append(clone)
                }
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
                    totalamount += +$(this).val()
                })
    
                $('#totalamount').val(totalamount)
                $('#label_tot_amount').val(`Rp. ${Intl.NumberFormat('id').format(totalamount)}`)
            })
        },
    
        eventInputUnit: () => {
            $(document).on('input','[name="unit[]"],[name="rate[]"]', function(){
                
                let totalamount = 0
                let rate = +$(this).parents('tr').find('[name="rate[]"]').val()
                let unit = +$(this).parents('tr').find('[name="unit[]"]').val()
                let total = rate * unit
    
                $(this).parents('tr').find('[name="amount[]"]').val(total)
    
                $('[name="amount[]"]').each(function(){
                    totalamount += +$(this).val()
                })
    
                $('#totalamount').val(totalamount)
                $('#label_tot_amount').val(`Rp. ${Intl.NumberFormat('id').format(totalamount)}`)
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
    
        eventSubmitARReceiptPayment: () => {
            $('#btn_submit').on('click',function(e){
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
                
                let formData = $('#form_ar_receipt_payment').serializeArray()
    
                var docno = $('[name="docno"]').val()
                var branch = $('[name="branch"]').val()
                var transdate = $('[name="transdate"]').val()
    
                repository.submitRecord('ajax_submit_ar_receipt_payment', formData)
                .then(response => {
                    helper.unblockUI()

                    if(response.success == true){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'html': 'DATA HAS BEEN SUBMITTED'
                        })

                        $('input, textarea').prop('readonly', true)
                        $('select').prop('disabled', true)

                        $('#new_transaction').prop('href', window.location.origin + '/AR/add_ar_receipt_payment')
                        $('#new_transaction').css('visibility', 'visible')
                        
                        $('#print_transaction').prop('href', window.location.origin + '/AR/view_reps_ar_receipt_payment' + `?docno=${docno}&branch=${branch}&transdate=${transdate}`)
                        $('#print_transaction').css('visibility', 'visible')
                        
                        $('#btn_submit').css('visibility', 'hidden')
                    }else{
                        Swal.fire({
                            'type': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${response.desc}</h4>`
                        })
                    }
                })
                .fail(err => {
                    helper.unblockUI()
            
                    Swal.fire({
                        'type': 'error',
                        'title': 'ABORTED',
                        'html': `<h4 class="sbold">${err.desc}</h4>`
                    })
                })
            })
        },
    }
}

export default arp