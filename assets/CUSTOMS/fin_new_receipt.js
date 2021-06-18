/*
 *  CORE SCRIPT
*/
const fin_new_receipt = () => {
    //GET URL PARAM
    const param = new URLSearchParams(window.location.search)

    const docno = param.get('docno')
    const nis = param.get('nis')
    const transdate = param.get('transdate')
    const school = param.get('school')

    const currency = $('#currency').clone()
    
    //SET URL PARAM TO FORM INPUT
    const initStudentParam = () => {
        //APPEND PARAM
        $('#docno').val(docno)
        $('#transdate').val(transdate)
        $('#nis').val(nis) 
        $('#school').val(school)
    }

    //GET CURRENT BALANCE
    const initCurrentBalance = () => {
        $.ajax({
            url: 'ajax_get_cur_balance',
            method: 'POST',
            dataType: 'text',
            data: {
                nis: param.get('nis')
            },
            success: response => {
                school_balance = +response
                $('#balance').attr('data-non-format', response)

                if(response < 0){
                    response = Math.abs(response)
                    response = Intl.NumberFormat('id').format(response)
                    response = '(' + response + ')'
                }else{
                    response = Intl.NumberFormat('id').format(response)
                }

                $('#balance').val(`Rp. ${response}`)
            },
            error: () => alert('NETWORK PROBLEM')
        })
    }

    //DISABLED YEAR & MONTH INPUT IF ACCOUNT GROUP IS NOT MONTHLY TUITION
    const eventChangeAccNo = () => {
        $('#accno').change(function(){
            initCurrentBalance()
            $('#totalamount').val(0)

            var selected_accno = $(this).val()

            var table = $('#table_body_detail_transaction')
            
            $.ajax({
                url: 'ajax_get_group_charge',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    nis,
                    accno: selected_accno
                },
                success: response => {
                
                    table.empty()

                    for(let i = 0; i < response.length; i++){
                        table.append(`
                            <tr style="background-color: #E9EDEF">
                                <td>
                                    <a class="btn btn-transparent red btn-md remove_detail_row">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                                <td>
                                    <input type="number" class="form-control text-right" value="${i+1}"/>
                                </td>
                                <td>
                                    <input type="number" required name="year[]" value="${response[i].YearCharge}" class="form-control text-right">
                                </td>
                                <td>
                                    <input type="number" required name="month[]" value="${response[i].MonthCharge}" class="form-control text-right">
                                </td>
                                <td><input readonly type="number" required name="group_charge[]" value="${response[i].Amount}" class="form-control text-right" required></td>
                                <td>
                                    ${currency[0].outerHTML}
                                </td>
                                <td><input type="number" name="rate[]" class="form-control text-right" value="1"></td>
                                <td><input type="number" required name="unit[]" min="${response[i].Amount}" class="form-control text-right"></td>
                                <td><input readonly type="number" required name="amount[]" class="form-control text-right"></td>
                            </tr>
                        `) //<td><input type="text" name="remark_detail[]" class="form-control"></td>
                    }
                },
                error: () => alert('NETWORK PROBLEM')
            })
        })
    }

    //REMOVE TRANSACTION ROW
    const eventRemoveTransRow = () => {
        $(document).on('click', '.remove_detail_row', function(){

            $(this).parents('tr').remove()
        })
    }

    //CALCULATE UNIT BY 
    const eventInputUnit = () => {
        $(document).on('focusout','[name="rate[]"], [name="unit[]"]',function(){
            
            let balance = +$('#balance').attr('data-non-format')
            let totalamount = +$('#totalamount').attr('data-non-format')
            let rate = +$(this).parents('tr').find('[name="rate[]"]').val()
            let unit = +$(this).parents('tr').find('[name="unit[]"]').val()
            let total = rate * unit

            $(this).parents('tr').find('[name="amount[]"]').val(total)

            $('[name="amount[]"]').each(function(){
                totalamount += +$(this).val() || 0
                balance -= +$(this).val() || 0
            })

            if(balance < 0){
                balance = Math.abs(balance)
                balance = Intl.NumberFormat('id').format(balance)
                balance = '(' + balance + ')'
            }else{
                balance = Intl.NumberFormat('id').format(balance)
            }

            $('#balance').val(`Rp. ${balance}`)
            $('#totalamount').val(`Rp. ${Intl.NumberFormat('id').format(totalamount)}`)
        
        })
    }

    const eventSubmitReceipt = () => {
        $('#form_entry_payment').submit(function(e){
            e.preventDefault()

            let form = $(this).serializeArray()

            $.ajax({
                url: 'ajax_submit_receipt',
                method: 'POST',
                dataType: 'text',
                data: form,
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
            initStudentParam()
            initCurrentBalance()
        },
        events: () => {
            eventChangeAccNo()
            eventRemoveTransRow()
            eventInputUnit()
            eventSubmitReceipt()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    fin_new_receipt().init()
    fin_new_receipt().events()
})()