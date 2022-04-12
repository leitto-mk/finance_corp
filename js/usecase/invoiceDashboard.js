/*
 * CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const dtColumns = [
    {
        orderable: false,
        width: 'auto',
        class: "text-center",
        render: (data, type, row) => {
            return `
            <div class="md-checkbox" style="left: 17%">
                <input type="checkbox" name="invoice_check" value="${row.InvoiceNo}" id="${row.InvoiceNo}" class="md-check">
                <label for="${row.InvoiceNo}">
                    <span class="inc"></span>
                    <span class="check"></span>
                    <span class="box"></span>
                </label>
            </div>`
        }
    },
    {
        className: "text-center",
        orderable: false,
        data: "ItemNo",
    },
    { data: "InvoiceNo" },
    { 
        data: "Approvedstatus" ,
        class: 'text-center',
        render: (data, type, row) => {
            let approval;
            
            if(row.ApprovedStatus == 1){
                approval = `<span class="badge badge-info sbold">Approved</span>`
            }else{
                approval = `<span class="badge badge-danger sbold">Declined</span>`
            }
            
            return approval
        }
    },
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

    (function EventSelectAlInvoices(){
        $('#invoice_check_all').click(function(){
            var checkAll = $(this)

            $('table').find('input[name="invoice_check"]').each(function(){
                checkAll.is(':checked') ? $(this).prop('checked', true) : $(this).prop('checked', false)
            })
        })
    })();

    (function EventSelectApproval(){
        $('a[name="set_approval"]').click(function(){
            var approval = $(this).data('status')
            var list = []

            $('table').find('input[name="invoice_check"]').each(function(){
                if($(this).is(':checked')){
                    list.push({
                        name: 'invoice[]',
                        value: $(this).val()
                    })
                }
            })

            if(list.length == 0){
                Swal.fire({
                    'icon': 'warning',
                    'title': 'NO INVOICE SELECTED'
                })
                return
            }

            let url = window.location.origin

            switch (approval) {
                case 'approve':
                    url += '/Invoice/approve'
                    break;
                case 'decline':
                    url += '/Invoice/decline'
                    break;
            }

            repository.submitRecord(url, list)
            .then(response => {
                helper.unblockUI()

                if(response.success){
                    Swal.fire({
                        'icon': 'success',
                        'title': response.result
                    })

                    $('#table-approval').DataTable().ajax.reload()
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
        })
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

                    if(response.success){
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

                await repository.generateDataTable('#table-approval', dtUrl, null, dtColumns)
            }
        })
    })();
}