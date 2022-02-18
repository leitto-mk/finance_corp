/*
 *  CORE SCRIPT
*/

import helper from "../helper.js"

const ListGeneralJournal = () => {
    
    const initDataTable = (docno, date_start, date_end) => {
        let today = new Date()
        let firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), +1).toLocaleDateString('fr-CA')
        let lastDayOfMonth = new Date(today.getFullYear(), today.getMonth()+1, 0).toLocaleDateString('fr-CA')

        docno = docno ?? ''
        date_start = date_start ?? firstDayOfMonth
        date_end = date_end ?? lastDayOfMonth
        
        $('table').DataTable({
            destroy: true,
            serverSide: true,
            searching: false,
            info: false,
            lengthMenu: [30, 50, 100, 300],
            ajax: {
                url: 'ajax_get_annual_general_journal',
                method: 'POST',
                data: {
                    docno,
                    date_start,
                    date_end
                },
                beforeSend: () => {
                    helper.blockUI({
                        animate: true
                    })
                },
                dataSrc: response => {
                    helper.unblockUI()
                    return response.result.data
                },
                error: response => {
                    helper.unblockUI()
                    
                    Swal.fire({
                        'type': 'error',
                        'title': 'ABORTED',
                        'html': `<h4 class="sbold">${response.responseJSON.desc}</h4>`
                    })
                },
            },
            columns: [
                {
                    data: 'TransDate',
                    createdCell: response => response.setAttribute('align', 'center'),
                    render: row => {
                        return `<div class="font-dark sbold">${row}</div>`
                    },
                    orderable: false,
                },
                {
                    data: 'DocNo',
                    createdCell: response => response.setAttribute('align', 'center'),
                    render: row => {
                        return `<div class="font-dark sbold">${row}</div>`
                    },
                    orderable: false,
                },
                {
                    data: 'TransType',
                    createdCell: response => response.setAttribute('align', 'center'),
                    render: row => {
                        return `<div class="font-dark sbold">${row}</div>`
                    },
                    orderable: false,
                },
                {
                    data: response => {
                        return response.Branch + ' | ' + response.BranchName
                    },
                    createdCell: response => response.setAttribute('align', 'left'),
                    render: row => {
                        return `<div class="font-dark sbold">${row}</div>`
                    },
                    orderable: false,
                },
                {
                    data: 'Remarks',
                    createdCell: response => response.setAttribute('align', 'left'),
                    render: row => {
                        return `<div class="font-dark sbold">${row}</div>`
                    },
                    orderable: false,
                },
                {
                    data: 'TotalAmount',
                    createdCell: response => response.setAttribute('align', 'right'),
                    render: row => {
                        return `<div class="font-dark sbold">${row}</div>`
                    },
                    orderable: false,
                },
                {
                    data: response => {
                        var location = window.location.protocol + '//' + window.location.hostname

                        return `
                            <a href="${location}/FinanceCorp/edit_general_journal?docno=${response.docno}" target="_blank" type="button" class="btn btn-xs green">
                                <i class="fa fa-edit"> </i>
                            </a>
                            <a href="${location}/FinanceCorp/view_reps_general_journal?docno=${response.DocNo}&branch=${response.Branch}&transdate=${response.TransDate}" target="_blank" name="report" type="button" class="btn btn-xs green-meadow">
                                <i class="fa fa-print"> </i>
                            </a>
                            <a href="javascript:;" name="delete" data-docno="${response.DocNo}" data-branch="${response.Branch}" data-transdate="${response.TransDate}" type="button" class="btn btn-xs red">
                                <i class="fa fa-trash"> </i>
                            </a>
                        `
                    },
                    createdCell: response => response.setAttribute('align', 'center'),
                    render: response => {
                        return `<div>${response}</div>`
                    },
                    orderable: false
                },
            ]
        })
    }

    const eventShowList = () => {
        $('#preview, #search').click(function(){
            let docno = $('#search_item').val()
            let date_start = $('#date_from').val()
            let date_end = $('#date_to').val()

            initDataTable(docno, date_start, date_end)
        })
    }

    const eventDeleteButton = () => {
        $(document).on('click','[name=delete]', function(){
            var row = $(this).parents('tr')
            let docno = $(this).attr('data-docno')
            let branch = $(this).attr('data-branch')
            let transdate = $(this).attr('data-transdate')

            let confirmed = confirm(`Are You sure want to delete ${docno} ? `)

            if(!confirmed){
                return
            }

            $.ajax({
                url: 'ajax_delete_gl',
                method: 'POST',
                data: {
                    docno,
                    branch,
                    transdate
                },
                beforeSend: () => {
                    helper.blockUI({
                        animate: true
                    })
                },
                success: response => {
                    if(response.success == true){
                        Swal.fire({
                            'type': 'success',
                            'title': 'DELETED'
                        })
                        
                        row.remove()
                    }else{
                        Swal.fire({
                            'type': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${response.desc}</h4>`
                        })
                    }
                },
                error: response => {
                    Swal.fire({
                        'type': 'error',
                        'title': 'ERROR',
                        'html': `<h4 class="sbold">${response.responseJSON.desc}</h4>`
                    })
                }
            }).done(() => {
                helper.unblockUI()
            })
        })
    }

    return {
        init: () => {
            initDataTable(null, null, null)
        },
        events: () => {
            eventShowList()
            eventDeleteButton()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    ListGeneralJournal().init()
    ListGeneralJournal().events()
})()