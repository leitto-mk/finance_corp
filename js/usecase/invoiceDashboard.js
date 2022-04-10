/*
 * CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const dtColumns = [
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
                    <a name="delete" href="#" data-invoiceno="${row.InvoiceNo}" class="btn btn-xs grey-gallery btn-outline" title="Delete">
                        <i class="fa fa-close"></i>
                    </a>`
        },
    }
]

export const DashboardPage = () => {
    (function InitGenerateDatatable(){
        let url = window.location.origin + '/invoice/get'

        repository.generateDataTable('#table-approval', url, null, dtColumns)
    })();

    (function EventDeleteInvoice(){
        $('#table-approval').on('click', 'a[name="delete"]', async function(e){
            e.preventDefault()
    
            let deleteUrl = window.location.origin + '/invoice/delete'
            let deleteData = {
                invoice: $(this).attr('data-invoiceno')
            }
            let dtUrl = window.location.origin + '/invoice/get'
    
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
                        'html': `<h4 class="sbold">${err.desc}</h4>`
                    })
                })

                await repository.generateDataTable('#table-approval', dtUrl, null, dtColumns)
            }
        })
    })();
}