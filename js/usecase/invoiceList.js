/*
 * CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

//Indempotent Function
const _callable = {
    GenerateInvoiceDataTable: (table, formData) => {
        let base_url = window.location.origin + '/invoice/get'

        $(table).DataTable({
            destroy: true,
            serverSide: true,
            searching: false,
            info: false,
            lengthMenu: [30, 50, 100, 300],
            pagingType: "bootstrap_extended",
            ajax: {
                url: base_url,
                method: 'GET',
                dataType: 'JSON',
                data: formData ?? null,
                beforeSend: () => {
                    helper.blockUI({
                        animate: true
                    })
                },
                dataSrc: response => {
                    helper.unblockUI()

                    if(response.result && response.result.length > 0){
                        for (let i = 0; i < response.result.length; i++){
                            response.result[i].ItemNo = i+1
                        }

                        return response.result
                    }

                    return response
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
                        let base_url = window.location.origin + '/invoice'

                        return `<a name="edit" href="${base_url}/edit/${row.InvoiceNo}" target="_blank" class="btn btn-xs grey-gallery btn-outline" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a name="delete" href="${base_url}/delete/${row.InvoiceNo}" class="btn btn-xs grey-gallery btn-outline" title="Delete">
                                    <i class="fa fa-close"></i>
                                </a>`
                    },
                }
            ]
        })
    },
    
    DeleteInvoiceRecord: url => {
        let confirm = window.confirm("Are You sure to delete this record ?")

        if(confirm){
            repository.deleteRecord(url)
            .then(response => {
                helper.unblockUI()

                if(response.success == true){
                    Swal.fire({
                        'type': 'success',
                        'title': response.result
                    })
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
        }
    }
}

export const DashboardPage = () => {
    (function InitGenerateDatatable(){
        _callable.GenerateInvoiceDataTable('#table-approval')
    })();

    (function EventDeleteInvoice(){
        $('#table-approval').on('click', 'a[name="delete"]', function(e){
            e.preventDefault()
    
            let url = $(this).attr('href')
    
            _callable.DeleteInvoiceRecord(url)
            _callable.GenerateInvoiceDataTable('#table-approval')
        })
    })();
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
        $(document).on('change','#raised_date, #due_date', function(){
            let raised_date = $('#raised_date').val()
            let due_date = $('#due_date').val()

            let start = moment(raised_date,'YYYY-MM-DD')
            let end = moment(due_date,'YYYY-MM-DD')

            let duration = moment.duration(end.diff(start)).asDays()

            duration > 0 ? $('#term_days').val(`${duration} Days`) : $('#term_days').val('0 Day')
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

            //Re-Initiated Input Mask
            let price = $(document).find('input[name="price[]"]')
            let total = $(document).find('input[name="total[]"]')
            helper.setInputMask(price, "currency")
            helper.setInputMask(total, "currency")
        })
    })();

    (function EventChagePaymentMethod(){
        $('[name="dp_payment_type"]').change(function(){
            if($(this).val() == 'cash'){
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
    })();
}

export const ListPage = () => {
    (function InitGenerateDataTable(){
        _callable.GenerateInvoiceDataTable('#list_invoice')
    })();

    (function InitSelectSearch(){
        helper.setSelect2($('#customer'), {width: 'auto'})
    })();

    (function EventDeleteInvoice(){
        $('#list_invoice').on('click', 'a[name="delete"]', function(e){
            e.preventDefault()

            let url = $(this).attr('href')

            _callable.DeleteInvoiceRecord(url)

            let formData = {
                'customer': $('#customer option:selected').val(),
                'date_start': $('#date_start').val(),
                'date_finish': $('#date_finish').val()
            }

            _callable.GenerateInvoiceDataTable('#list_invoice', formData)
        })
    })();

    (function EventPreviewFilter(){
        $('#submit_filter').click(function(){
            let formData = {
                'customer': $('#customer option:selected').val(),
                'date_start': $('#date_start').val(),
                'date_finish': $('#date_finish').val()
            }

            _callable.GenerateInvoiceDataTable('#list_invoice', formData)
        })
    })();
}

export const AgingPage = () => {
    (function InitSelectSearch(){
        helper.setSelect2($('#customer'), {width: 'auto'})
    })();

    (function EventPreviewFilter(){
        $('#submit_filter').click(function(){
            var currency = Intl.NumberFormat('en', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })

            var formData = {
                'customer': $('#customer option:selected').val(),
                'branch': $('#branch option:selected').val(),
                'ageby': $('#aging option:selected').val(),
                'date_start': $('#date_start').val()
            }

            var url = window.location.origin + '/invoice/get_aging'

            repository.getRecord(url, formData)
            .then(response => {
                helper.unblockUI()

                if(!response.success == true){
                    Swal.fire({
                        'type': 'error',
                        'title': 'ERROR',
                        'html': `<h4 class="sbold">${response.desc}</h4>`
                    })   
                }

                /**
                 ** TABLE SUMMARY STARTS HERE
                 */
                if(response.result.summary.length > 0){
                    let table = $('#table_summary tbody')
                    let totalOutstanding = 0
                    let totalQ1 = 0
                    let totalQ2 = 0
                    let totalQ3 = 0
                    let totalQ4 = 0
                    table.empty()
                    
                    for(let i = 0; i < response.result.summary.length; i++){
                        table.append(`
                            <tr class="font-dark sbold">
                                <td align="center">${i+1}</td>
                                <td align="center">${response.result.summary[i].CustomerName}</td>   
                                <td align="right">${currency.format(response.result.summary[i].Outstanding)}</td>
                                <td align="right">${currency.format(response.result.summary[i].BalanceQ1)}</td>
                                <td align="right">${currency.format(response.result.summary[i].BalanceQ2)}</td>
                                <td align="right">${currency.format(response.result.summary[i].BalanceQ3)}</td>
                                <td align="right">${currency.format(response.result.summary[i].BalanceQ4)}</td>
                            </tr>
                        `)

                        totalOutstanding += +response.result.summary[i].Outstanding
                        totalQ1 += +response.result.summary[i].BalanceQ1
                        totalQ2 += +response.result.summary[i].BalanceQ2
                        totalQ3 += +response.result.summary[i].BalanceQ3
                        totalQ4 += +response.result.summary[i].BalanceQ4

                        if(i == (response.result.summary.length - 1)){
                            table.append(`
                                <tr style="border-top: solid 2px;" class="font-dark sbold">
                                    <td align="center"></td>
                                    <td align="right">Total Amount :</td>                                    
                                    <td align="right">${currency.format(totalOutstanding)}</td>
                                    <td align="right">${currency.format(totalQ1)}</td>
                                    <td align="right">${currency.format(totalQ2)}</td>
                                    <td align="right">${currency.format(totalQ3)}</td>
                                    <td align="right">${currency.format(totalQ4)}</td>
                                </tr>
                            `)
                        }
                    }
                }

                 /**
                 ** TABLE Q1-Q4 STARTS HERE
                 */
                _callable.DrawTableAging(response, 'q1')
                _callable.DrawTableAging(response, 'q2')
                _callable.DrawTableAging(response, 'q3')
                _callable.DrawTableAging(response, 'q4')
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
    })();
}