/*
 *  CORE SCRIPT
*/

import Helper from '../helper.js'

const FormGeneralJournal = () => {

    const initDisableEnterKey = () => {
        $(document).on('keyup keypress', function(e){
            const key = e.keyCode || e.which

            if(key === 13){
                e.preventDefault()
            }
            
            return;
        })
    }

    const initSetEnterToFocus = () => {
        $(document).on('keypress', function (e) {
            const key = e.keyCode || e.which
            
            if (key === 13) {
                e.preventDefault()

                // Get all focusable elements
                var focusable = $(':focusable').not("a, button, #label_tot_amount, #totalamount, [name='itemno[]'], [name='amount[]'], #total_debit, #total_credit")
                var index = focusable.index(document.activeElement)
                
                var cur_input = focusable.eq(index)

                if(cur_input.attr('name') == 'credit[]'){
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
                    $('#tbody_detail > tr > td > input[name="remarks[]"]').focus()
                }else if(index >= focusable.length){
                    index = 0
                }

                focusable.eq(index+1).focus()
            }
        });
    }

    const eventNextRow = () => {
        $(document).on('keydown','[name="credit[]"]', function(e){
            if(e.keyCode == 9){
                let remarks = $(this).parents('tr').find('input[name="remarks[]"]').val()
                let departments = $(this).parents('tr') .find('select[name="departments[]"] option:selected').val()
                let costcenters = $(this).parents('tr') .find('select[name="costcenters[]"] option:selected').val()
                // let emp  = $(this).parents('tr') .find('select[name="emp[]"]').val()
                let accnos = $(this).parents('tr') .find('select[name="accnos[]"]').val()
                let debit = $(this).parents('tr') .find('input[name="debit[]"]').val()
                let credit = $(this).parents('tr') .find('input[name="credit[]"]').val()

                if(!remarks || !departments || !costcenters || !accnos || !debit || !credit){
                    alert('PLEASE FILL ALL THE INPUT')
                    return
                }

                if(debit == 0 && credit == 0){
                    alert('PLEASE INPUT AMOUNT FOR DEBIT OR CREDIT')
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
                $(clone).find('[name="debit[]"]').val(0)
                $(clone).find('[name="credit[]"]').val(0)
    
                $('#tbody_detail').append(clone)
            }
        })
    }

    const eventDeleteRow = () => {
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
    }

    const eventInputAmount = () => {
        $(document).on('focusout','[name="debit[]"],[name="credit[]"]', function(){
            
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
    }

    const eventChangeBranch = () => {
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
    }

    const eventChangeDepartment = () => {
        $(document).on('change','select[name="departments[]"]', function(){
            var department = $(this).find('option:selected').val()

            $('#tbody_detail').find('select[name="costcenters[]"] option:first').prop('selected', true)

            $('#tbody_detail').find('select[name="costcenters[]"] option').each(function(){
                $(this).show()

                if($(this).is('[data-department]') && $(this).attr('data-department') !== department){
                    $(this).hide()
                }
            })
        })
    }

    const eventSubmitGeneral = () => {
        $('#btn_submit').on('click',function(e){
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
            let total_debit = +$('#total_debit').val()
            let total_credit = +$('#total_credit').val()

            if(count_row == 1){
                alert('DETAIL ROW MUST BE TWO OR MORE')
                return
            }

            if(total_debit !== total_credit){
                alert('DEBIT AND CREDIT IS NOT BALANCE')
                return
            }
            
            let obj = $('#form_general_journal').serializeArray()

            var docno = $('[name="docno"]').val()
            var branch = $('[name="branch"]').val()
            var transdate = $('[name="transdate"]').val()

            $.ajax({
                url: 'ajax_submit_general_journal',
                method: 'POST',
                dataType: 'JSON',
                data: obj,
                beforeSend: () => {
                    Helper().blockUI({
                        animate: true
                    })
                },
                success: response => {
                    alert(response)
                    if(response.success == true){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'html': 'GENERAL JOURNAL HAS BEEN SUBMITTED'
                        })

                        $('input, textarea').prop('readonly', true)
                        $('select').prop('disabled', true)

                        $('#new_transaction').prop('href', window.location.origin + '/FinanceCorp/add_general_journal')
                        $('#new_transaction').css('visibility', 'visible')
                        
                        $('#print_transaction').prop('href', window.location.origin + '/FinanceCorp/view_reps_general_journal' + `?docno=${docno}&branch=${branch}&transdate=${transdate}`)
                        $('#print_transaction').css('visibility', 'visible')
                        
                        $('#btn_submit').css('visibility', 'hidden')
                    }else{
                        Swal.fire({
                            'type': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${response.desc}</h4>`
                        })
                    }
                },
                error: response => {
                    Swal.fire({
                        'type': 'error',
                        'title': 'ABORTED',
                        'html': `<h4 class="sbold">${response.responseJSON.desc}</h4>`
                    })
                }
            }).done(() => {
                Helper().unblockUI()
            })
        })
    }

    return {
        init: () => {
            initDisableEnterKey()
            initSetEnterToFocus()
        },
        events: () => {
            eventNextRow()
            eventDeleteRow()
            eventInputAmount()
            eventChangeBranch()
            eventChangeDepartment()
            eventSubmitGeneral()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    FormGeneralJournal().init()
    FormGeneralJournal().events()
})()