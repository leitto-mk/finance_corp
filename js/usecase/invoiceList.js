/*
 * CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const dtColumns = [
    {
        className: "text-center",
        orderable: false,
        data: "ItemNo",
    },
    { data: "InvoiceNo" },
    { data: "CustomerName" },
    { data: "InvoiceDate", className: "text-center" },
    { data: "DueDate", className: "text-center" },
    {
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
        orderable: false,
        className: "text-center",
        render: (data, type, row) => {
            let hostname = window.location.host
            let base_url = (hostname == 'localhost' ? window.location.origin + '/financecorp/Invoice' : window.location.origin + '/Invoice')

            return `<a name="edit" href="${base_url}/edit/${row.InvoiceNo}" target="_blank" class="btn btn-xs grey-gallery btn-outline" title="Edit">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a name="delete" href="#" data-invoiceno="${row.InvoiceNo}" class="btn btn-xs grey-gallery btn-outline" title="Delete">
                        <i class="fa fa-close"></i>
                    </a>`
        },
    }
]

export const ListPage = () => {
    (function InitGenerateDataTable(){
        let hostname = window.location.host
            let url = (hostname == 'localhost' ? window.location.origin + '/financecorp/Invoice/get' : window.location.origin + '/Invoice/get')

        repository.generateDataTable('#list_invoice', url, null, dtColumns)
    })();

    (function InitSelectSearch(){
        helper.setSelect2($('#customer'), {width: 'auto'})
    })();

    (function EventDeleteInvoice(){
        $('#list_invoice').on('click', 'a[name="delete"]', async function(e){
            e.preventDefault()
    
            let deleteUrl = window.location.origin + '/invoice/delete'
            let deleteData = {
                invoice: $(this).attr('data-invoiceno')
            }
            let dtUrl = window.location.origin + '/invoice/get'
            let postData = {
                'customer': $('#customer option:selected').val(),
                'date_start': $('#date_start').val(),
                'date_finish': $('#date_finish').val()
            }
    
            let confirm = window.confirm("Are You sure to delete this record ?")

            if(confirm){
                await repository.deleteRecord(deleteUrl, deleteData)
                .then(response => {
                    helper.unblockUI()

                    if(response.success == true){
                        Swal.fire({
                            'icon': 'success',
                            'title': response.result
                        })
                    }else{
                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${response.desc}</h4>`
                        })
                    }
                })
                .fail(err => {
                    helper.unblockUI()

                    Swal.fire({
                        'icon': 'error',
                        'title': 'ERROR',
                        'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                    })
                })

                await repository.generateDataTable('#list_invoice', dtUrl, postData, dtColumns)
            }
        })
    })();

    (function EventPreviewFilter(){
        $('#submit_filter').click(function(){
            let postData = {
                'customer': $('#customer option:selected').val(),
                'date_start': $('#date_start').val(),
                'date_finish': $('#date_finish').val()
            }

            let hostname = window.location.host
            let url = (hostname == 'localhost' ? window.location.origin + '/financecorp/Invoice/get' : window.location.origin + '/Invoice/get')

            repository.generateDataTable('#list_invoice', url, postData, dtColumns)
        })
    })();
}