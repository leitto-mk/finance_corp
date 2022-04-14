/*
 * CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

//Indempotent Function
const _callable = {
    CalculatePayment: () => {
        //ORDER LIST
        let subtotal = 0

        $('#tbody_invoice tr').each(function(){
            let qty = +$(this).find('input[name="qty[]"]').val()
            let price = $(this).find('input[name="price[]"]').val()
            price = parseFloat(price.replaceAll(',',''))
            let discount = +$(this).find('input[name="discount[]"]').val() / 100
            let total = qty * price
            let total_discounted = total - (total * discount)

            $(this).find('input[name="total[]"]').val(total_discounted)
        })
        
        //PAYMENT DETAIL
        $('[name="total[]"]').each(function(){
            subtotal += parseFloat($(this).val().replaceAll(',',''))
        })

        $('#payment_sub_total').val(subtotal)
        let payment_sub_total = $('#payment_sub_total').val()
        payment_sub_total = payment_sub_total !== '' ? parseFloat($('#payment_sub_total').val().replaceAll(',','')) : 0
        let payment_discount = parseFloat($('#payment_discount').val().replaceAll(',','')) / 100
        $('#amount_discount').val(Intl.NumberFormat('en').format(parseFloat(payment_sub_total * payment_discount)))
        let net_subtotal = payment_sub_total - (payment_sub_total * payment_discount)

        $('#payment_net_subtotal').val(net_subtotal)

        //VAT Calculation
        let payment_vat = +$('#payment_vat').val()
        if($('#payment_vat_inclusive').is(':checked')){
            payment_vat = (net_subtotal * (100 / (100 + payment_vat)) * (payment_vat / 100))
            $('#amount_vat').val(Intl.NumberFormat('en').format(payment_vat))
        }else{
            payment_vat = (payment_vat / 100)
            $('#amount_vat').val(Intl.NumberFormat('en').format(net_subtotal * payment_vat))
            
            payment_vat = (net_subtotal * payment_vat)
        }

        // Payment PPH
        let payment_pph = +$('#payment_pph').val() / 100 
        $('#amount_pph').val(Intl.NumberFormat('en').format(net_subtotal * payment_pph))
        payment_pph = (net_subtotal * payment_pph)

        //Payment Freight
        let payment_freight = $('#payment_freight').val()
        payment_freight = payment_freight !== '' ? parseFloat($('#payment_freight').val().replaceAll(',','')) : 0
        
        let total_amount = 0
        total_amount = (net_subtotal + payment_vat - payment_pph + payment_freight)

        $('#payment_total_amount').val(total_amount)
    },

    CreateNewList: () => {
        let row = $('#tbody_invoice tr:last-child').clone()

        //Set Default Value
        let item_no = +row.find('td:first-child a').text()
        row.find('td:first-child a').text(item_no + 1)
        
        //? Re-instiated `select2`
        row.find("span.select2 ").remove()
        helper.setSelect2(row.find('[name="stockcode[]"]'), {width: 'auto'})

        //? Get UOM from Stockcode attribute
        let uom = row.find('select[name="stockcode[]"] option:selected').attr('data-uom')
        let uom_qty = row.find('select[name="stockcode[]"] option:selected').attr('data-uom-qty')
        row.find('[name="uom[]"]').val(uom)
        row.find('[name="currency[]"]').val('IDR')
        row.find('[name="qty[]"]').val(uom_qty)
        row.find('[name="price[]"]').val(0)
        row.find('[name="discount[]"]').val(0)
        row.find('[name="total[]"]').val(0)
        
        $('#tbody_invoice').append(row)

        //Set Focus on the next Description field
        $('#tbody_invoice > tr > td > input[name="stockcode[]"]').last().focus()
        $('#tbody_invoice > tr > td > input[name="stockcode[]"]').last().parent().addClass('has-warning')

        //Re-Initiated Input Mask
        let price = $(document).find('input[name="price[]"]')
        let total = $(document).find('input[name="total[]"]')
        helper.setInputMask(price, "currency")
        helper.setInputMask(total, "currency")
    }
}

export const FormPage = () => {
    (function InitSelectSearch(){
        helper.setSelect2($('#customer'), {width: 'auto'})
        helper.setSelect2($('#tbody_invoice select[name="stockcode[]"]'), {width: 'auto'})
        helper.setSelect2($('#accno'), {width: 'auto'})
    })();
    
    (function InitInputMask(){
        //Order List
        let price = $(document).find('input[name="price[]"]')
        let total = $(document).find('input[name="total[]"]')
        helper.setInputMask(price, "currency")
        helper.setInputMask(total, "currency")
        
        //Payment
        let pay_subtotal = $(document).find('#payment_sub_total')
        let pay_net_subtotal = $(document).find('#payment_net_subtotal')
        let pay_freight = $(document).find('#payment_freight')
        let pay_total_amount = $(document).find('#payment_total_amount')
        let dp_total = $(document).find('#payment_total')
        helper.setInputMask(pay_subtotal, "currency")
        helper.setInputMask(pay_net_subtotal, "currency")
        helper.setInputMask(pay_freight, "currency")
        helper.setInputMask(pay_total_amount, "currency")
        helper.setInputMask(dp_total, "currency")
    })();

    (function EventNextInput(){
        $(document).on('keypress', function (e) {
            const key = e.keyCode || e.which
            
            if (key === 13) {
                e.preventDefault()

                // Get all focusable elements
                var focusable = $(':focusable').not("a, button, [name='total[]'], [readonly]")
                var index = focusable.index(document.activeElement)
                
                var cur_input = focusable.eq(index)
                focusable.eq(index).parent().removeClass('has-warning')

                if(index >= focusable.length){
                    index = 0
                }

                if(cur_input.attr('name') == 'discount[]' && index !== -1){
                    _callable.CreateNewList()
                }

                focusable.eq(index+1).focus()
                focusable.eq(index+1).parent().addClass('has-warning')
            }
        });
    })();

    (function EventChangeRaisedDate(){
        $('#raised_date').change(function(){
            let raised = $(this).val()
            $('#due_date').attr({
                min: raised,
                value: raised
            })
        })
    })();

    (function EventGetTermsOfDay(){
        $('#raised_date, #term_days').change(function(){
            let raised_date = $('#raised_date').val()
            let term_day = +$('#term_days').val()

            let due_date = moment(raised_date,'YYYY-MM-DD').add(term_day, 'days')

            $('#due_date').val(due_date.format('YYYY-MM-DD'))
        })
    })();

    (function EventSelectStockcode(){
        $('#tbody_invoice').on('change','select[name="stockcode[]"]', function(){
            let uom = $('option:selected', this).attr('data-uom')
            let uom_qty = $('option:selected', this).attr('data-uom-qty')

            $(this).parents('tr').find('input[name="uom[]"]').val(uom)
            $(this).parents('tr').find('input[name="qty[]"]').val(uom_qty)
            $(this).parents('tr').find('input[name="qty[]"]').attr('min', uom_qty)

            _callable.CalculatePayment()
        })
    })();

    (function EventChangeCurrency(){
        $('#tbody_invoice').on('change', 'select[name="currency[]"]', function(){
            let currency = $(this).val()

            $(this).parents('tr').find('.input-group .input-group-addon').text(currency)
        })
    })();

    (function EventInputAmount(){
        $(document).on('input', '[name="qty[]"], [name="price[]"], [name="discount[]"], #payment_discount, #payment_vat, #payment_pph, #payment_freight', function(){
            _callable.CalculatePayment()
        })
    })();
    
    (function EventAddRow(){
        $('#add_row').click(function(){
            _callable.CreateNewList()
        })
    })();

    (function EventAddSelectAccNo(){
        $('a[name="select_accno"]').click(async function(){
            var anchor = $(this)
            var options = {}

            //Get existing AccNo Value from hidden input
            var curAccno = $(this).attr('id').replace('_label','')
            var existedVal = $(`#${curAccno}`).val() ?? ''

            //If Current Accno is for VAT and Inclusive is not checked,
            //then do nothing
            if(curAccno == 'payment_vat_accno' && $('#payment_vat_inclusive').is(':checked') == false){
                return
            }

            let url = window.location.origin + '/Invoice/get_accno'
            await repository.getRecord(url, null)
            .then(response => {
                helper.unblockUI()

                //Append options with Result Values
                let val = response.result
                options["n/a"]  = 'N/A'
                for(let i=0; i < response.result.length; i++){
                    options[`'${val[i]['Acc_No']}'`] = `${val[i]['Acc_No']} - ${val[i]['Acc_Name']}`
                }

                Swal.fire({
                    icon: 'question',
                    title: "Select Account Number",
                    input: 'select',
                    target: 'body',
                    inputOptions: options,
                    inputValue: existedVal,
                    inputPlaceholder: '-- Choose Acc No. --',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if(value !== 'n/a'){
                            //Store the selected value into hidden input
                            anchor.parent('.input-group').find('input:hidden').attr('value',value)
    
                            //Set the Button's color
                            anchor.removeClass('font-red-sunglo')
                            anchor.addClass('bg-font-blue-chambray')
                        }else{
                            //Empty the hidden input's value
                            anchor.parent('.input-group').find('input:hidden').attr('value', null)
    
                            //Set the Button's color
                            anchor.removeClass('bg-font-blue-chambray')
                            anchor.addClass('font-red-sunglo')
                        }
                    }
                })
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
    })();

    (function EventChangeVATInclusive(){
        $('#payment_vat_inclusive').change(function(){
            _callable.CalculatePayment()
        })
    })();

    (function EventChagePaymentMethod(){
        $('[name="dp_payment_type"]').change(function(){
            let available = ['cash', 'credit_sales']

            if(available.includes($(this).val())){
                $('#dp_payment_card_text').prop('disabled', true).val('')
                $('#dp_payment_bank').prop('disabled', true).val('')
            }else{
                $('#dp_payment_card_text').prop('disabled', false)
                $('#dp_payment_bank').prop('disabled', false)
            }
        })
    })();

    (function EventDeleteRow(){
        $(document).on('click','[name="item_no"]',function(){
            if(!confirm('Are you sure you want to delete this row ?')){
                return
            }

            var total = $('#tbody_invoice').children('tr').length
            if(total <= 1){
                return
            }

            $(this).parents('tr').remove()

            var index = 0
            $('#tbody_invoice [name="item_no"]').each(function(){
                $(this).text(index+1)

                ++index
            })

            _callable.CalculatePayment()
        })
    })();

    (function EventInputDownPayment(){
        $('#payment_total').on('input', function(){
            let total_amount = $('#payment_total_amount').val()
            total_amount = total_amount !== '' ? parseFloat(total_amount.replaceAll(',','')) : 0
            let dp_amount = $(this).val()
            dp_amount = dp_amount !== '' ? parseFloat(dp_amount.replaceAll(',','')) : 0

            if(dp_amount > total_amount){
                alert('Payment Exceeding Invoice Amount')
                $(this).val('')
            }
        })
    })();

    (function EventSubmitInvoice(){
        $('form').submit(function(e){
            e.preventDefault()

            let url = window.location.origin + '/invoice/submit'
            let formData = $(this).serializeArray()

            //Validate Subtotal
            if(!$('#payment_sub_total_accno').val()){
                Swal.fire({
                    'icon': 'error',
                    'title': 'Account No. for Subtotal is not selected',
                    'html': ''
                })

                return
            }

            //Validate Total Amount
            if(!$('#payment_total_amount_accno').val()){
                Swal.fire({
                    'icon': 'error',
                    'title': 'Account No. for Total Amount is not selected',
                    'html': ''
                })

                return
            }

            //Deformat Numbers
            formData.find(input => {
                let input_with_mask = [
                    'price[]', 
                    'total[]', 
                    'payment_sub_total', 
                    'payment_net_subtotal', 
                    'payment_total_amount',
                    'payment_freight',
                    'payment_total'
                ]

                if(input_with_mask.includes(input.name)){
                    input.value = parseFloat(input.value.replaceAll(',',''))
                }
            })

            repository.submitRecord(url, formData)
            .then(() => {
                helper.unblockUI()
                
                Swal.fire({
                    'icon': 'success',
                    'title': 'SUCCESS',
                    'html': 'DATA HAS BEEN SUBMITTED'
                })
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
    })();
}