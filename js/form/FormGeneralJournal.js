/*
 *  CORE SCRIPT
*/
var FormGeneralJournal = () => {
    const eventNextRow = () => {
        $(document).on('keydown','[name="credit[]"]', function(e){
            if(e.keyCode == 9){
                let remarks = $(this).parents('tr').find('input[name="remarks[]"]').val()
                let departments = $(this).parents('tr') .find('input[name="departments[]"]').val()
                let costcenters = $(this).parents('tr') .find('input[name="costcenters[]"]').val()
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

    const eventSubmitGeneral = () => {
        $('#form_general_journal').submit(function(e){
            e.preventDefault()

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
            
            let obj = $(this).serializeArray()

            $.ajax({
                url: 'ajax_submit_general_journal',
                method: 'POST',
                dataType: 'JSON',
                data: obj,
                success: response => {
                    if(response.success == true){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'html': 'GENERAL JOURNAL HAS BEEN SUBMITTED'
                        })

                        location.reload()
                    }else{
                        Swal.fire({
                            'type': 'error',
                            'title': 'ERROR',
                            'html': response.desc
                        })
                    }
                },
                error: response => {
                    Swal.fire({
                        'type': 'error',
                        'title': 'ABORTED',
                        'html': response.responseJSON.desc
                    })
                }
            })
        })
    }

    return {
        init: () => {
            //NO INIT FUNCTION FOR THIS SCRIPT
        },
        events: () => {
            eventNextRow()
            eventDeleteRow()
            eventInputAmount()
            eventSubmitGeneral()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    FormGeneralJournal().init()
    FormGeneralJournal().events()
})()