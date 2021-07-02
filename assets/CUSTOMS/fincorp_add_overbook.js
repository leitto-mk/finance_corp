/*
 *  CORE SCRIPT
*/
var addOverbook = () => {
    // const eventSelectCurrency = () => {
    //     $(document).on('change', '[name="currency[]"]', function(){
    //         const API_KEY = 'efa820d81d9a4c6bb64b469e432b033e'
            
    //         fetch(`https://api.currencyfreaks.com/latest?apikey=${API_KEY}`)
    //             .then(response => response.json())
    //             .then(response => console.log(JSON.stringify(response, null, '\t')))
    //     })
    // }

    const eventAddPaidTo = () => {
        $('#add_id').click(function(){
            let exit = false
            let emp = $('#emp').val()
            let fullname = $('#emp option:selected').attr('data-fullname')
            let dept = $('#emp option:selected').attr('data-dept')
            let cc = $('#emp option:selected').attr('data-cc')

            $('tbody tr').each(function(){
                if($(this).find('[name="idnumber[]"]').val() == emp){
                    alert('EMPLOYEE HAS BEEN SELECTED')
                    
                    exit = true
                }
            })

            if(exit == true){
                return
            }

            $('#emp').val('')

            let row = $('tbody').children('tr').last()
            $('tbody').find('tr[data-empty-row="true"]').remove()

            let clone = row.clone()
            
            $(clone).attr('data-empty-row', 'false')
            $(clone).find('[name="itemno[]"]').val(function(i, oldval){
                return ++oldval
            })

            $(clone).find('[name="idnumber[]"]').val(emp)
            $(clone).find('[name="fullname[]"]').val(fullname)
            $(clone).find('[name="departments[]"]').val(dept)
            $(clone).find('[name="costcenters[]"]').val(cc)

            $('tbody').append(clone)
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

            $('#totalamount').val(`Rp. ${Intl.NumberFormat('id').format(totalamount)}`)
        })
    }

    const eventChangeAccNo = () => {
        $('#accno').change(function(){
            $(document).find('[name="accnos[]"]').val($(this).val())
        })
    }

    const eventSubmitOverbook = () => {
        $('#form_receipt_voucher').submit(function(e){
            e.preventDefault()
            
            let obj = $(this).serializeArray()

            $.ajax({
                url: 'ajax_submit_receipt',
                method: 'POST',
                data: obj,
                success: response => {
                    if(response == 'success'){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'text': 'RECEIPT HAS BEEN SUBMITTED'
                        })

                        location.reload()
                    }else{
                        alert('SERVER PROBLEM')
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
            eventInputUnit()
            eventChangeAccNo()
            eventSubmitOverbook()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    addOverbook().init()
    addOverbook().events()
})()