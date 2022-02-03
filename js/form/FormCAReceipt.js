/*
/*
 *  CORE SCRIPT
*/
const FormCAReceipt = () => {
    // const eventSelectCurrency = () => {
    //     $(document).on('change', '[name="currency[]"]', function(){
    //         const API_KEY = 'efa820d81d9a4c6bb64b469e432b033e'
            
    //         fetch(`https://api.currencyfreaks.com/latest?apikey=${API_KEY}`)
    //             .then(response => response.json())
    //             .then(response => console.log(JSON.stringify(response, null, '\t')))
    //     })
    // }

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
                e.stopImmediatePropagation()

                // Get all focusable elements
                var focusable = $(':focusable').not("a, button, #label_tot_amount, #totalamount, [name='itemno[]'], [name='amount[]']")
                var index = focusable.index(document.activeElement) + 1
                
                if (index >= focusable.length) index = 0

                focusable.eq(index).focus()
            }
        });
    }

    const eventAddPaidTo = () => {}

    const eventSelectEmployee = () => {
        $('#emp_master_id').change(function(){
            fullname = $(this).find('option:selected').attr('data-fullname')
            branch = $(this).find('option:selected').attr('data-branch')
            
            $('#emp_master_name').val(fullname)
            $('#branch').val(branch)
        })
    }

    const eventNextRow = () => {
        $(document).on('keydown','[name="unit[]"]', function(e){
            if(e.keyCode == 9){
                let remarks = $(this).parents('tr').find('input[name="remarks[]"]').val()
                let departments = $(this).parents('tr') .find('input[name="departments[]"]').val()
                let costcenters = $(this).parents('tr') .find('input[name="costcenters[]"]').val()
                // let emp  = $(this).parents('tr') .find('select[name="emp[]"]').val()
                let accnos = $(this).parents('tr') .find('select[name="accnos[]"]').val()
                let currency = $(this).parents('tr') .find('select[name="currency[]"]').val()
                let rate = $(this).parents('tr') .find('input[name="rate[]"]').val()
                let unit = $(this).parents('tr') .find('input[name="unit[]"]').val()

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
    }

    const eventDeleteRow = () => {
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
    }

    const eventInputUnit = () => {
        $(document).on('focusout','[name="unit[]"]', function(){
            
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
    }

    const eventSubmitCAReceipt = () => {
        $('#form_ca_receipt').submit(function(e){
            e.preventDefault()
            
            let obj = $(this).serializeArray()

            $.ajax({
                url: 'ajax_submit_ca_receipt',
                method: 'POST',
                dataType: 'JSON',
                data: obj,
                success: response => {
                    if(response.success == true){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'html': 'CA Receipt HAS BEEN SUBMITTED'
                        })

                        location.reload()
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
            })
        })
    }

    return {
        init: () => {
            initDisableEnterKey()
            initSetEnterToFocus()
        },
        events: () => {
            // eventSelectCurrency()
            eventAddPaidTo()
            eventSelectEmployee()
            eventNextRow()
            eventDeleteRow()
            eventInputUnit()
            eventSubmitCAReceipt()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    FormCAReceipt().init()
    FormCAReceipt().events()
})()