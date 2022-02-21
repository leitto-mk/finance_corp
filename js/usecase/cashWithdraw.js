/*
 * Core Script
*/

import helper from '../helper.js'

const caw = {
    initDataTable: (docno, date_start, date_end) => {
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
                url: 'ajax_get_annual_ca_receipt',
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
                        var location = window.location.protocol

                        return `
                            <a href="${location}/FinanceCorp/edit_cash_withdraw?docno=${response.DocNo}" target="_blank" type="button" class="btn btn-xs green">
                                <i class="fa fa-edit"> </i>
                            </a>
                            <a href="${location}/FinanceCorp/view_reps_cash_withdraw?docno=${response.DocNo}&branch=${response.Branch}&transdate=${response.TransDate}" target="_blank" name="report" type="button" class="btn btn-xs green-meadow">
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
    },

    eventShowList: () => {
        $('#preview, #search').click(function(){
            let docno = $('#search_item').val()
            let date_start = $('#date_from').val()
            let date_end = $('#date_to').val()

            caw.initDataTable(docno, date_start, date_end)
        })
    },

    eventDeleteButton: () => {
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
                url: 'ajax_delete_ca_withdraw',
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
    },

    initDisableEnterKey: () => {
        $(document).on('keyup keypress', function(e){
            const key = e.keyCode || e.which

            if(key === 13){
                e.preventDefault()
            }
            
            return;
        })
    },

    initSetEnterToFocus: () => {
        $(document).on('keypress', function (e) {
            const key = e.keyCode || e.which
            
            if (key === 13) {
                e.preventDefault()

                // Get all focusable elements
                var focusable = $(':focusable').not("a, button, #label_tot_amount, #totalamount, [name='itemno[]'], [name='amount[]']")
                var index = focusable.index(document.activeElement)
                
                var cur_input = focusable.eq(index)

                if(cur_input.attr('name') == 'unit[]'){
                    let remarks = cur_input.parents('tr').find('input[name="remarks[]"]').val()
                    let departments = cur_input.parents('tr').find('select[name="departments[]"] option:selected').val()
                    let costcenters = cur_input.parents('tr').find('select[name="costcenters[]"] option:selected').val()
                    let accnos = cur_input.parents('tr').find('select[name="accnos[]"]').val()
                    let currency = cur_input.parents('tr').find('select[name="currency[]"]').val()
                    let rate = cur_input.parents('tr').find('input[name="rate[]"]').val()
                    let unit = cur_input.parents('tr').find('input[name="unit[]"]').val()

                    if(!remarks || !departments || !costcenters || !accnos || !currency || !rate || !unit){
                        alert('PLEASE FILL ALL THE INPUT')
                        
                        return
                    }

                    let row = cur_input.parents('tr').clone()

                    if(cur_input.parents('tr').is(':last-child')){
                        let cur_itemno = +row.find('[name="itemno[]"]').val()

                        row.find('[name="itemno[]"]').val(cur_itemno+1)
                        row.find('[name="remarks[]"]').val('')
                        row.find('[name="departments[]"]').val('')
                        row.find('[name="costcenters[]"]').val('')
                        row.find('[name="unit[]"]').val(0)
                        row.find('[name="amount[]"]').val(0)

                        $('#tbody_detail').append(row)
                    }

                    //Set Focus on the next Description field
                    $('#tbody_detail > tr > td > input[name="remarks[]"]').focus()
                }else if(index >= focusable.length){
                    index = 0
                }

                focusable.eq(index+1).focus()
            }
        });
    },

    eventSelectEmployee: () => {
        $('#emp_master_id').change(function(){
            fullname = $(this).find('option:selected').attr('data-fullname')
            branch = $(this).find('option:selected').attr('data-branch')
            balance = $(this).find('option:selected').attr('data-balance')
            
            $('#emp_master_name').val(fullname)
            $('#branch').val(branch)
            $('#outstanding').val(balance)
        })
    },

    eventNextRow: () => {
        $(document).on('keydown','[name="unit[]"]', function(e){
            if(e.keyCode == 9){
                let remarks = $(this).parents('tr').find('input[name="remarks[]"]').val()
                let departments = $(this).parents('tr') .find('select[name="departments[]"] option:selected').val()
                let costcenters = $(this).parents('tr') .find('select[name="costcenters[]"] option:selected').val()
                // let emp  = $(this).parents('tr') .find('select[name="emp[]"]').val()
                let accnos = $(this).parents('tr') .find('select[name="accnos[]"]').val()
                let currency = $(this).parents('tr') .find('select[name="currency[]"]').val()
                let rate = $(this).parents('tr') .find('input[name="rate[]"]').val()
                let unit = $(this).parents('tr') .find('input[name="unit[]"]').val()

                if(!remarks || !departments || !costcenters || !accnos || !currency || !rate || !unit){
                    alert('PLEASE FILL ALL THE INPUT')
                    
                    return
                }

                let row = $('#tbody_detail').children('tr').last()
                $('tbody').find('tr[data-empty-row="true"]').remove()
    
                let clone = row.clone()
                
                $(clone).find('[name="itemno[]"]').val(function(i, oldval){
                    return ++oldval
                })
    
                $(clone).find('[name="remarks[]"]').val('')
                $(clone).find('[name="departments[]"]').val('')
                $(clone).find('[name="costcenters[]"]').val('')
                $(clone).find('[name="unit[]"]').val(0)
                $(clone).find('[name="amount[]"]').val(0)
    
                $('tbody').append(clone)
            }
        })
    },

    eventDeleteRow: () => {
        $(document).on('click','input[name="itemno[]"]',function(){
            var total = $('#tbody_detail').children('tr').length
            if(total <= 1){
                return
            }

            $(this).parents('tr').remove()

            var index = 0
            $('#tbody_detail input[name="itemno[]"]').each(function(){
                $(this).val(index+1)

                ++index
            })

            var totalamount = 0;
            $('[name="amount[]"]').each(function(){
                totalamount += +$(this).val()
            })

            $('#totalamount').val(totalamount)
            $('#label_tot_amount').val(`Rp. ${Intl.NumberFormat('id').format(totalamount)}`)
        })
    },

    eventInputUnit: () => {
        $(document).on('input','[name="unit[]"],[name="rate[]"]', function(){
            
            let totalamount = 0
            let rate = +$(this).parents('tr').find('[name="rate[]"]').val()
            let unit = +$(this).parents('tr').find('[name="unit[]"]').val()
            let total = rate * unit

            $(this).parents('tr').find('[name="amount[]"]').val(total)

            $('[name="amount[]"]').each(function(){
                totalamount += +$(this).val()
            })

            let outstanding = +$(document).find('#outstanding').val()
            let outstanding_left = (outstanding - totalamount)

            $('#totalamount').val(totalamount)
            $('#label_tot_amount').val(`Rp. ${Intl.NumberFormat('id').format(totalamount)}`)
            $('#outstanding_left').val(outstanding_left)
            $('#label_outstanding_left').val(`Rp. ${Intl.NumberFormat('id').format(outstanding_left)}`)
        })
    },

    eventChangeBranch: () => {
        $(document).on('change','.branch', function(){
            var branch = $(this).find('option:selected').val()

            $('#tbody_detail').find('select[name="departments[]"] option:first').prop('selected', true)
        
            $('#tbody_detail').find('select[name="departments[]"] option:selected').each(function(){
                $(this).show()

                if($(this).is('[data-department]') && $(this).attr('data-branch') !== branch){
                    $(this).hide()
                }
            })
        })
    },

    eventChangeDepartment: () => {
        $(document).on('change','select[name="departments[]"]', function(){
            var department = $(this).find('option:selected').val()

            $(this).parents('tr').find('select[name="costcenters[]"] option:first').prop('selected', true)

            $(this).parents('tr').find('select[name="costcenters[]"] option').each(function(){
                $(this).show()

                if($(this).is('[data-department]') && $(this).attr('data-department') !== department){
                    $(this).hide()
                }
            })
        })
    },

    eventSubmitCAWithdraw: () => {
        $('#btn_submit').on('click',function(e){
            e.preventDefault()
        
            //Remove Row with empty Description
            if($('#tbody_detail > tr').length > 1){
                $(document).find('#tbody_detail tr').each(function(){
                    var cur_remark_val = $(this).find('input[name="remarks[]"]').val()
                    var cur_amount_val = +$(this).find('input[name="amount[]"]').val()
    
                    if(cur_remark_val == '' || cur_remark_val == null || cur_amount_val == 0 || cur_amount_val == null){
                        $(this).remove()
                    }
                })
            }
            
            let obj = $('#form_ca_withdraw').serializeArray()

            var docno = $('[name="docno"]').val()
            var branch = $('[name="branch"]').val()
            var transdate = $('[name="transdate"]').val()

            $.ajax({
                url: 'ajax_submit_ca_withdraw',
                method: 'POST',
                dataType: 'JSON',
                data: obj,
                beforeSend: () => {
                    helper.blockUI({
                        animate: true
                    })
                },
                success: response => {
                    if(response.success == true){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'html': 'WITHDRAWAL HAS BEEN SUBMITTED'
                        })

                        $('input, textarea').prop('readonly', true)
                        $('select').prop('disabled', true)

                        $('#new_transaction').prop('href', window.location.origin + '/FinanceCorp/add_ca_withdraw')
                        $('#new_transaction').css('visibility', 'visible')
                        
                        $('#print_transaction').prop('href', window.location.origin + '/FinanceCorp/view_reps_cash_withdraw' + `?docno=${docno}&branch=${branch}&transdate=${transdate}`)
                        $('#print_transaction').css('visibility', 'visible')
                        
                        $('#btn_submit').css('visibility', 'hidden')
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
                        'title': 'ABORTED',
                        'html': `<h4 class="sbold">${response.responseJSON.desc}</h4>`
                    })
                }
            }).done(() => {
                helper.unblockUI()
            })
        })
    },
}

export default caw