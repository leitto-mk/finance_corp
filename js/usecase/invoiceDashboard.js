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