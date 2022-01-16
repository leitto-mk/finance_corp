/*
/*
 *  CORE SCRIPT
*/
var addCAWithdraw = () => {
    // const eventSelectCurrency = () => {
    //     $(document).on('change', '[name="currency[]"]', function(){
    //         const API_KEY = 'efa820d81d9a4c6bb64b469e432b033e'
            
    //         fetch(`https://api.currencyfreaks.com/latest?apikey=${API_KEY}`)
    //             .then(response => response.json())
    //             .then(response => console.log(JSON.stringify(response, null, '\t')))
    //     })
    // }

    const eventAddPaidTo = () => {}

    const eventSelectEmployee = () => {
        $('#emp_master_id').change(function(){
            fullname = $(this).find('option:selected').attr('data-fullname')
            branch = $(this).find('option:selected').attr('data-branch')
            balance = $(this).find('option:selected').attr('data-balance')
            
            $('#emp_master_name').val(fullname)
            $('#branch').val(branch)
            $('#outstanding').val(balance)
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

            let outstanding = +$(document).find('#outstanding').val()
            let outstanding_left = (outstanding - totalamount)

            $('#totalamount').val(totalamount)
            $('#label_tot_amount').val(`Rp. ${Intl.NumberFormat('id').format(totalamount)}`)
            $('#outstanding_left').val(outstanding_left)
            $('#label_outstanding_left').val(`Rp. ${Intl.NumberFormat('id').format(outstanding_left)}`)
        })
    }

    const eventSubmitCAWithdraw = () => {
        $('#form_ca_withdraw').submit(function(e){
            e.preventDefault()
            
            let obj = $(this).serializeArray()

            $.ajax({
                url: 'ajax_submit_ca_withdraw',
                method: 'POST',
                dataType: 'JSON',
                data: obj,
                success: response => {
                    if(response.success == true){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'text': 'WITHDRAWAL HAS BEEN SUBMITTED'
                        })

                        location.reload()
                    }else{
                        Swal.fire({
                            'type': 'error',
                            'title': 'ERROR',
                            'text': response.desc
                        })
                    }
                },
                error: () => alert('NETWORK PROBLEM')
            })
        })
    }

    return {
        init: () => {
            //NO INIT FUNCTION FOR THIS SCRIPT
        },
        events: () => {
            // eventSelectCurrency()
            eventAddPaidTo()
            eventSelectEmployee()
            eventNextRow()
            eventDeleteRow()
            eventInputUnit()
            eventSubmitCAWithdraw()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    addCAWithdraw().init()
    addCAWithdraw().events()
})()