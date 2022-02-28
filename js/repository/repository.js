import helper from '../helper.js'

/**
 * 
 * This is Where You fetch/store Data,
 * Mainly interacts with the server and handle request/responses
 * 
*/
const repository = {
    /**
     * Generate `DataTable`
     * @type {object}       URLs
     * @type {object}       body param inside an object
     * 
     * @return {promise}    Promise
     */
    generateDataTable: (url, datas) => {
        var defer = $.Deferred()
        
        datas = {
            docno: datas?.docno ?? '',
            date_start: datas?.date_start ?? helper.firstDayOfMonth(),
            date_end: datas?.date_end ?? helper.lastDayOfMonth()
        }

        $('table').DataTable({
            destroy: true,
            serverSide: true,
            searching: false,
            info: false,
            lengthMenu: [30, 50, 100, 300],
            ajax: {
                url: url.target,
                method: 'POST',
                data: datas,
                beforeSend: () => {
                    helper.blockUI({
                        animate: true
                    })
                },
                dataSrc: response => {
                    defer.resolve()
                    return response.result.data
                },
                error: err => {
                    defer.reject(err)
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
                        var location = window.location.href
                        var baseURL = location.substring(0, location.lastIndexOf('/'))

                        return `
                            <a href="${baseUrl}/${url.edit}?docno=${response.DocNo}" target="_blank" type="button" class="btn btn-xs green">
                                <i class="fa fa-edit"> </i>
                            </a>
                            <a href="${baseUrl}/${url.report}?docno=${response.DocNo}&branch=${response.Branch}&transdate=${response.TransDate}" target="_blank" name="report" type="button" class="btn btn-xs green-meadow">
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

        return defer
    },

    /**
     * `Fetch` Record from the Server. with `POST` method
     * 
     * @type {string}       URL string
     * @type {object}       body param inside an object
     * 
     * @return {promise}    Promise
     */
    getRecord: (url, datas) => {
        var defer = $.Deferred()
        
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: datas,
            beforeSend: () => {
                helper.blockUI({
                    animate: true
                })
            },
            success: response => {
                defer.resolve(response)
            },
            error: err => {
                defer.reject(err)
            }
        })

        return defer
    },

    /**
     * `Delete` Record from the server. with `POST` method
     * 
     * @type {string}       URL string
     * @type {object}       body param inside an object
     * 
     * @return {promise}    Promise
     */
    deleteRecord: (url, datas) => {
        var defer = $.Deferred()

        $.ajax({
            url: url,
            method: 'POST',
            data: datas,
            beforeSend: () => {
                helper.blockUI({
                    animate: true
                })
            },
            success: response => {
                defer.resolve(response)
            },
            error: err => {
                defer.reject(err)
            }
        })

        return defer
    },

    /**
     * `Submit` Record to the server. with `POST` method
     * 
     * @type {string}       URL string
     * @type {object}       body param inside an object
     * 
     * @return {promise}    Promise
     */
    submitRecord: (url, datas) => {
        var defer = $.Deferred()

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: datas,
            beforeSend: () => {
                helper.blockUI({
                    animate: true
                })
            },
            success: response => {
                defer.resolve(response)
            },
            error: err => {
                defer.reject(err)
            }
        })

        return defer
    }
}

export default repository