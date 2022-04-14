import helper from '../helper.js'

/**
 * 
 * This is Where You fetch/store Data,
 * Mainly interacts with the server and handle request/responses
 * 
*/

const CSRF_NAME = 'csrf_fin_token'
const CSRF_HASH = helper.getCookie('csrf_fin_cookie')

const repository = {
    /**
     * Generate `DataTable`
     * @type    {string}    Selected Table
     * @type    {string}    URL Target
     * @type    {object}    body param inside an object, use `serialize` or `serializeArray` for wrapping the body
     * @type    {object}    Column Definition
     * 
     * @return  {promise}   Promised
     */
    generateDataTable: (table, url, postData, dtColumns) => {
        var defer = $.Deferred()
        
        postData = postData ?? {}

        $(table).DataTable({
            destroy: true,
            serverSide: true,
            searching: false,
            info: false,
            targets: 'no-sort',
            bSort: false,
            lengthMenu: [30, 50, 100, 300],
            pagingType: "bootstrap_extended",
            ajax: {
                url: url?.target ?? url, //Some URL has multiple value, check receipt's `initDT` for example
                method: 'GET',
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
                        'html': `<h4 class="sbold">${err.responseJSON.desc || 'Server Problem'}</h4>`
                    })
                },
            },
            columns: dtColumns
        })

        return defer
    },

    /**
     * `Fetch` Record from the Server. with `POST` method
     * 
     * @type    {string}    URL string
     * @type    {object}    body param inside an object, use `serialize` or `serializeArray` for wrapping the body
     * @type    {object}    Type of Response (JSON, text/hml, etc)
     * 
     * @return  {promise}   Promise
     */
    getRecord: (url, postData, responseType) => {
        var defer = $.Deferred()

        postData = postData ?? {}

        $.ajax({
            url: url,
            method: 'GET',
            dataType: responseType ?? 'JSON',
            data: postData,
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
     * @type    {object}    body param inside an object, use `serialize` or `serializeArray` for wrapping the body
     * @type    {object}    Type of Response (JSON, html, text, etc)
     * 
     * @return  {promise}   Promise
     */
    deleteRecord: (url, postData, responseType) => {
        var defer = $.Deferred()

        postData = postData ?? {}

        //If `postData` is an array (serializeArray), push new CSRF's object
        //If `postData` is an object (serialize) bind new CSRF's key and value
        Array.isArray(postData) ? postData.push({ name: CSRF_NAME, value: CSRF_HASH }) : postData[CSRF_NAME] = CSRF_HASH

        /**
         * Couldn't use 'DELETE' method since `DELETE` cannot have parameters/body,
         * so `POST` method is applied instead.
         * For more information, see: https://stackoverflow.com/a/46020367
         */
        $.ajax({
            url: url,
            method: 'POST',
            dataType: responseType ?? 'JSON',
            data: postData,
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
     * @type    {object}    body param inside an object, use `serialize` or `serializeArray` for wrapping the body
     * @type    {object}    Type of Response (JSON, text/hml, etc)
     * 
     * @return  {promise}   Promise
     */
    submitRecord: (url, postData, responseType) => {
        var defer = $.Deferred()

        postData = postData ?? {}

        //If `postData` is an array (serializeArray), push new CSRF's object
        //If `postData` is an object (serialize) bind new CSRF's key and value
        Array.isArray(postData) ? postData.push({ name: CSRF_NAME, value: CSRF_HASH }) : postData[CSRF_NAME] = CSRF_HASH

        $.ajax({
            url: url,
            method: 'POST',
            dataType: responseType ?? 'JSON',
            data: postData,
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