/*
 * CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

//Indempotent Function
const _callable = {
    GenerateInvoiceDataTable: (table, formData) => {
        let base_url = window.location.origin + '/invoice/get'

        formData = formData ?? {}

        //Add CSRF Data
        formData[csrfName] = csrfHash

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
        }
    }
}

//Get CSRF Hash
const csrfName = document.querySelector('#script').getAttribute('data-csrf-name')
const csrfHash = document.querySelector('#script').getAttribute('data-csrf-token')

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