import helper from '../helper.js'

/**
 * 
 * This is Where You fetch/store Data,
 * Mainly interacts with the server and handle request/responses
 * 
*/

//Get CSRF Hash
const csrfName = document.querySelector('#script').getAttribute('data-csrf-name')
const csrfHash = document.querySelector('#script').getAttribute('data-csrf-token')

const repository = {
    /**
     * Generate `DataTable`
     * @type    {string}    Selected Table
     * @type    {string}    URL Target
     * @type    {object}    Request (POST) Body
     * @type    {object}    Column Definition
     * 
     * @return  {promise}   Promised
     */
    generateDataTable: (table, url, postData, dtColumns) => {
        var defer = $.Deferred()
        
        postData = postData ?? {}

        //Add CSRF Token
        postData[csrfName] = csrfHash

        $(table).DataTable({
            destroy: true,
            serverSide: true,
            searching: false,
            info: false,
            lengthMenu: [30, 50, 100, 300],
            pagingType: "bootstrap_extended",
            ajax: {
                url: url?.target ?? url, //Some URL has multiple value, check receipt's `initDT` for example
                method: 'POST',
                data: postData,
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
                error: err => {
                    helper.unblockUI()

                    Swal.fire({
                        'icon': 'error',
                        'title': 'ERROR',
                        'html': `<h4 class="sbold">${err.desc}</h4>`
                    })
                },
            },
            columnDefs: dtColumns
        })

        return defer
    },

    /**
     * `Fetch` Record from the Server. with `POST` method
     * 
     * @type    {string}    URL string
     * @type    {object}    body param inside an object
     * @type    {object}    Type of Response (JSON, text/hml, etc)
     * 
     * @return  {promise}   Promise
     */
    getRecord: (url, datas, responseType) => {
        var defer = $.Deferred()
        
        datas = datas ?? {}
        
        //Add CSRF Token
        datas[csrfName] = csrfHash

        $.ajax({
            url: url,
            method: 'POST',
            dataType: responseType ?? 'JSON',
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
     * @type    {string}    URL string
     * @type    {object}    body param inside an object
     * @type    {object}    Type of Response (JSON, text/hml, etc)
     * 
     * @return  {promise}   Promise
     */
    deleteRecord: (url, datas, responseType) => {
        var defer = $.Deferred()

        datas = datas ?? {}
        
        //Add CSRF Token
        datas[csrfName] = csrfHash

        $.ajax({
            url: url,
            method: 'POST',
            dataType: responseType ?? 'JSON',
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
     * @type    {string}    URL string
     * @type    {object}    body param inside an object
     * @type    {object}    Type of Response (JSON, text/hml, etc)
     * 
     * @return  {promise}   Promise
     */
    submitRecord: (url, datas, responseType) => {
        var defer = $.Deferred()

        //If `datas` is array (serializeArray), push new CSRF's object
        //If `datas` is an object (serialize) bind new CSRF's key and value
        Array.isArray(datas) ? datas.push({ name: csrfName, value: csrfHash }) : datas[csrfName] = csrfHash

        $.ajax({
            url: url,
            method: 'POST',
            dataType: responseType ?? 'JSON',
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