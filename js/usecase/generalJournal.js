/*
 *  CORE SCRIPT
*/

import helper from '../helper.js'

const gj = {
    initDataTable: (docno, date_start, date_end) => {
        
        let firstDayOfMonth = date_start ?? helper.firstDayOfMonth()
        let lastDayOfMonth = date_end ?? helper.lastDayOfMonth()

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
                url: 'ajax_get_ranged_general_journal',
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
                        var location = window.location.origin

                        return `
                            <a href="${location}/Entry/edit_general_journal?docno=${response.DocNo}" target="_blank" type="button" class="btn btn-xs green">
                                <i class="fa fa-edit"> </i>
                            </a>
                            <a href="${location}/Entry/view_reps_general_journal?docno=${response.DocNo}&branch=${response.Branch}&transdate=${response.TransDate}" target="_blank" name="report" type="button" class="btn btn-xs green-meadow">
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

            gj.initDataTable(docno, date_start, date_end)
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
                    helper.unblockUI()

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
                    helper.unblockUI()

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
                var focusable = $(':focusable').not("a, button, #label_tot_amount, #totalamount, [name='itemno[]'], [name='amount[]'], #total_debit, #total_credit")
                var index = focusable.index(document.activeElement)
                
                var cur_input = focusable.eq(index)

                if(cur_input.attr('name') == 'credit[]'){
                    let remarks = cur_input.parents('tr').find('input[name="remarks[]"]').val()
                    let departments = cur_input.parents('tr').find('select[name="departments[]"] option:selected').val()
                    let costcenters = cur_input.parents('tr').find('select[name="costcenters[]"] option:selected').val()
                    let accnos = cur_input.parents('tr').find('select[name="accnos[]"]').val()
                    let currency = cur_input.parents('tr').find('select[name="currency[]"]').val()
                    let debit = cur_input.parents('tr').find('input[name="debit[]"]').val()
                    let credit = cur_input.parents('tr').find('input[name="credit[]"]').val()

                    if(!remarks || !departments || !costcenters || !accnos || !currency || !debit || !credit){
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
                        row.find('[name="debit[]"]').val(0)
                        row.find('[name="credit[]"]').val(0)

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

    eventNextRow: () => {
        $(document).on('keydown','[name="credit[]"]', function(e){
            if(e.keyCode == 9){
                let remarks = $(this).parents('tr').find('input[name="remarks[]"]').val()
                let departments = $(this).parents('tr') .find('select[name="departments[]"] option:selected').val()
                let costcenters = $(this).parents('tr') .find('select[name="costcenters[]"] option:selected').val()
                // let emp  = $(this).parents('tr') .find('select[name="emp[]"]').val()
                let accnos = $(this).parents('tr') .find('select[name="accnos[]"]').val()
                let debit = $(this).parents('tr') .find('input[name="debit[]"]').val()
                let credit = $(this).parents('tr') .find('input[name="credit[]"]').val()

                if(!remarks || !departments || !costcenters || !accnos || !debit || !credit){
                    alert('PLEASE FILL ALL THE INPUT')
                    return
                }

                if(debit == 0 && credit == 0){
                    alert('PLEASE INPUT AMOUNT FOR DEBIT OR CREDIT')
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
                $(clone).find('[name="debit[]"]').val(0)
                $(clone).find('[name="credit[]"]').val(0)
    
                $('#tbody_detail').append(clone)
            }
        })
    },

    eventDeleteRow: () => {
        $(document).on('click','[name="itemno[]"]',function(){
            let count_row = $('#tbody_detail').children('tr').length

            if(window.confirm('Delete Row ?') && count_row > 1){
                $(this).parents('tr').remove()
            }else{
                return
            }

            var total_debit = 0
            $('[name="debit[]"]').each(function(i, n){
                total_debit += +$(this).val()
            })
            
                $('#total_debit').val(total_debit)

            var total_credit = 0
            $('[name="credit[]"]').each(function(i, n){
                total_credit += +$(this).val()
            })
            
            $('#total_debit').val(total_debit)
            $('#total_credit').val(total_credit)
        })
    },

    eventInputAmount: () => {
        $(document).on('focusout','[name="debit[]"],[name="credit[]"]', function(){
            
            var total_debit = 0
            $('[name="debit[]"]').each(function(i, n){
                total_debit += +$(this).val()
            })
            
                $('#total_debit').val(total_debit)

            var total_credit = 0
            $('[name="credit[]"]').each(function(i, n){
                total_credit += +$(this).val()
            })
            
            $('#total_debit').val(total_debit)
            $('#total_credit').val(total_credit)
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

    eventSubmitGeneral: () => {
        $('#btn_submit').on('click',function(e){
            e.preventDefault()
        
            //Remove Row with empty Description
            if($('#tbody_detail > tr').length > 1){
                $(document).find('#tbody_detail tr').each(function(){
                    var cur_remark_val = $(this).find('input[name="remarks[]"]').val()
                    var cur_debit_val = +$(this).find('input[name="debit[]"]').val()
                    var cur_credit_val = +$(this).find('input[name="credit[]"]').val()
    
                    if(cur_remark_val == '' || (cur_debit_val == 0 && cur_credit_val == 0)){
                        $(this).remove()
                    }
                })
            }

            let count_row = $('#tbody_detail').children('tr').length
            let total_debit = +$('#total_debit').val()
            let total_credit = +$('#total_credit').val()

            if(count_row == 1){
                alert('DETAIL ROW MUST BE TWO OR MORE')
                return
            }

            if(total_debit !== total_credit){
                alert('DEBIT AND CREDIT IS NOT BALANCE')
                return
            }
            
            let obj = $('#form_general_journal').serializeArray()

            var docno = $('[name="docno"]').val()
            var branch = $('[name="branch"]').val()
            var transdate = $('[name="transdate"]').val()

            $.ajax({
                url: 'ajax_submit_general_journal',
                method: 'POST',
                dataType: 'JSON',
                data: obj,
                beforeSend: () => {
                    helper.blockUI({
                        animate: true
                    })
                },
                success: response => {
                    helper.unblockUI()

                    if(response.success == true){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'html': 'GENERAL JOURNAL HAS BEEN SUBMITTED'
                        })

                        $('input, textarea').prop('readonly', true)
                        $('select').prop('disabled', true)

                        $('#new_transaction').prop('href', window.location.origin + '/Entry/add_general_journal')
                        $('#new_transaction').css('visibility', 'visible')
                        
                        $('#print_transaction').prop('href', window.location.origin + '/Entry/view_reps_general_journal' + `?docno=${docno}&branch=${branch}&transdate=${transdate}`)
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
                    helper.unblockUI()
                    
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

export default gj