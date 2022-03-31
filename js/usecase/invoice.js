/*
 * CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const inv = {
    dashboardPage: {
        generateDataTable: () => {
            $("#table-approval").DataTable({
                destroy: true,
                serverSide: true,
                searching: false,
                info: false,
                lengthMenu: [30, 50, 100, 300],
                pagingType: "bootstrap_extended",
                ajax: {
                    url: 'Invoice/get',
                    method: 'GET',
                    beforeSend: () => {
                        helper.blockUI({
                            animate: true
                        })
                    },
                    dataSrc: response => {
                        helper.unblockUI()

                        for (let i = 0; i < response.result.length; i++){
                            response.result[i].ItemNo = i+1
                        }

                        return response.result
                    },
                    error: () => {
                        helper.unblockUI()
                    }
                },
                columnDefs: [
                    {
                        targets: 0,
                        className: "text-center",
                        orderable: false,
                        data: "ItemNo",
                    },
                    { targets: 1, data: "InvoiceNo" },
                    { targets: 2, data: "CustomerName" },
                    { targets: 3, data: "InvoiceDate", className: "text-center" },
                    { targets: 4, data: "DueDate", className: "text-center" },
                    {
                        targets: 5,
                        data: "TotalAmount",
                        className: "text-right",
                        render: (data, type, row) => {
                            return new Intl.NumberFormat('en', {
                                style: "currency",
                                currency: "IDR",
                            }).format(data)
                        },
                    },
                    {
                        targets: 6,
                        data: "Payment",
                        className: "text-right",
                        render: (data, type, row) => {
                            return new Intl.NumberFormat('en', {
                                style: "currency",
                                currency: "IDR",
                            }).format(data)
                        },
                    },
                    {
                        targets: 7,
                        data: "Balance",
                        className: "text-right",
                        render: (data, type, row) => {
                            return new Intl.NumberFormat('en', {
                                style: "currency",
                                currency: "IDR",
                            }).format(data)
                        },
                    },
                    {
                        targets: 8,
                        orderable: false,
                        className: "text-center",
                        render: (data, type, row) => {
                            let base_url = window.location.origin + window.location.pathname
                            return `<a href="${base_url}/edit/${row.InvoiceNo}" class="btn btn-xs grey-gallery btn-outline" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-xs grey-gallery btn-outline" title="Delete">
                                        <i class="fa fa-close"></i>
                                    </a>`
                        },
                    }
                ]
            })
        }
    },

    formPage: {
        initSelectSearch: () => {
            $('#customer').select2({width: 'auto'})
            $('#tbody_invoice select[name="stockcode[]"]').select2({width: 'auto'})
            $('#accno').select2({width: 'auto'})
        },
        
        initInputMask: () => {
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
        },

        eventGetTermsOfDay: () => {
            $(document).on('change','#raised_date, #due_date', function(){
                let raised_date = $('#raised_date').val()
                let due_date = $('#due_date').val()

                let start = moment(raised_date,'YYYY-MM-DD')
                let end = moment(due_date,'YYYY-MM-DD')

                let duration = moment.duration(end.diff(start)).asDays()

                duration > 0 ? $('#term_days').val(`${duration} Days`) : $('#term_days').val('')
            })
        },

        eventSelectStockcode: () => {
            $('#tbody_invoice').on('change','select[name="stockcode[]"]', function(){
                let uom = $('option:selected', this).attr('data-uom')
                let uom_qty = $('option:selected', this).attr('data-uom-qty')

                $(this).parents('tr').find('input[name="uom[]"]').val(uom).trigger('input')
                $(this).parents('tr').find('input[name="qty[]"]').val(uom_qty).trigger('input')
                $(this).parents('tr').find('input[name="qty[]"]').attr('min', uom_qty)
            })
        },

        eventChangeCurrency: () => {
            $('#tbody_invoice').on('change', 'select[name="currency[]"]', function(){
                let currency = $(this).val()

                $(this).parents('tr').find('.input-group .input-group-addon').text(currency)
            })
        },

        eventInputAmount: () => {
            $(document).on('input', '[name="qty[]"], [name="price[]"], [name="discount[]"], #payment_discount, #payment_vat, #payment_pph, #payment_freight', function(){
                let order_list = ['qty[]','price[]','discount[]']
                let current_changes = $(this).attr('name')

                // Order List
                if(order_list.includes(current_changes)){
                    let subtotal = 0
                    let qty = +$(this).parents('tr').find('[name="qty[]"]').val()
                    let price = $(this).parents('tr').find('[name="price[]"]').val()
                    price = parseFloat(price.replaceAll(',',''))
                    let discount = +$(this).parents('tr').find('[name="discount[]"]').val() / 100
                    let total = qty * price
                    let total_discounted = total - (total * discount)
        
                    $(this).parents('tr').find('[name="total[]"]').val(total_discounted)
        
                    $('[name="total[]"]').each(function(){
                        subtotal += parseFloat($(this).val().replaceAll(',',''))
                    })
    
                    $('#payment_sub_total').val(subtotal)
                }

                //Payment Details
                let payment_sub_total = $('#payment_sub_total').val()
                payment_sub_total = payment_sub_total !== '' ? parseFloat($('#payment_sub_total').val().replaceAll(',','')) : 0
                let payment_discount = parseFloat($('#payment_discount').val().replaceAll(',','')) / 100
                let net_subtotal = payment_sub_total - (payment_sub_total * payment_discount)

                $('#payment_net_subtotal').val(net_subtotal)

                let payment_vat = +$('#payment_vat').val() / 100 
                let payment_pph = +$('#payment_pph').val() / 100 
                let payment_freight = $('#payment_freight').val()
                payment_freight = payment_freight !== '' ? parseFloat($('#payment_freight').val().replaceAll(',','')) : 0
                let total_amount = 0

                payment_vat = (net_subtotal * payment_vat)
                payment_pph = (net_subtotal * payment_pph)
                
                total_amount = (net_subtotal + payment_vat - payment_pph + payment_freight)

                $('#payment_total_amount').val(total_amount)
            })
        },
        
        eventAddRow: () => {
            $('#add_row').click(function(){
                let row = $('#tbody_invoice tr:last-child').clone()

                //Set Default Value
                let item_no = +row.find('td:first-child a').text()
                row.find('td:first-child a').text(item_no + 1)
                
                //? Re-instiated `select2`
                row.find("span.select2 ").remove()
                row.find('[name="stockcode[]"]').select2({width: 'auto'})

                row.find('[name="uom[]"]').val('')
                row.find('[name="currency[]"]').val('IDR')
                row.find('[name="qty[]"]').val(1)
                row.find('[name="price[]"]').val(0)
                row.find('[name="discount[]"]').val(0)
                row.find('[name="total[]"]').val(0)
                
                $('#tbody_invoice').append(row)

                //Re-Initiated Input Mask
                let price = $(document).find('input[name="price[]"]')
                let total = $(document).find('input[name="total[]"]')
                helper.setInputMask(price, "currency")
                helper.setInputMask(total, "currency")
            })
        },

        eventChagePaymentMethod: () => {
            $('[name="dp_payment_type"]').change(function(){
                if($(this).val() == 'cash'){
                    $('#dp_payment_card_text').prop('disabled', true).val('')
                    $('#dp_payment_bank').prop('disabled', true).val('')
                }else{
                    $('#dp_payment_card_text').prop('disabled', false)
                    $('#dp_payment_bank').prop('disabled', false)
                }
            })
        },

        eventDeleteRow: () => {
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
            })
        },

        eventInputDownPayment: () => {
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
        },

        eventSubmitInvoice: () => {
            $('form').submit(function(e){
                e.preventDefault()

                let formData = $(this).serializeArray()

                //Deformat Numbers
                formData.find(input => {
                    let input_with_mask = [
                        'price[]', 
                        'total[]', 
                        'payment_sub_total', 
                        'payment_net_subtotal', 
                        'payment_total_amount',
                        'payment_total'
                    ]

                    if(input_with_mask.includes(input.name)){
                        input.value = parseFloat(input.value.replaceAll(',',''))
                    }
                })

                repository.submitRecord('submit', formData)
                .then(() => {
                    helper.unblockUI()
                    
                    Swal.fire({
                        'type': 'success',
                        'title': 'SUCCESS',
                        'html': 'DATA HAS BEEN SUBMITTED'
                    })
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
        }
    }
}

export default inv