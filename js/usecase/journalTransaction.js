/*
 * CORE SCRIPT 
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const jtr = {
    indexPage:{
        eventPreviewFilter: () => {
            $('#submit_filter').click(function(){
                var branch = $('#branch').val()
                var trans_type = $('#transtype').val()
                // var accno_start = +$('#accno_start').val()
                // var accno_finish = +$('#accno_finish').val()
                var date_start = $('#date_start').val()
                var date_finish = $('#date_finish').val()
    
                // if(!branch || !trans_type || !accno_start || !accno_finish || !date_start || !date_finish){
                //     alert('Please Select All Filter!')
                //     return;
                // }
                
                // if(accno_start > accno_finish){
                //     alert('Account Number Start must be higher or equal!')
                //     return;
                // }

                if(new Date(date_start) > new Date(date_finish)){
                    alert('Date Start must be earlier or equal!')
                    return;
                }
                
                if(!branch || !trans_type || !date_start || !date_finish){
                    alert('Please Select All Filter!')
                    return;
                }

                let data = {
                    branch,
                    trans_type,
                    // accno_start,
                    // accno_finish,
                    date_start,
                    date_finish
                }

                repository.getRecord('ajax_get_journal_transaction', data)
                .then(response => {
                    helper.unblockUI()
        
                    if(response.success == true){
                        let table = $('#table_jtr tbody')
                    
                        table.empty()
        
                        if(!Array.isArray(response.result) || response.result.length == 0){
                            table.append(`
                                <tr class="text-center" style="background-color: white">
                                    <td colspan="10" class="bold">NO RECORD FOUND</td>
                                </tr>`
                            )
        
                            return
                        }
        
                        $('#label_tbl_date_start').html(date_start)
                        $('#label_tbl_date_finish').html(date_finish)
        
                        let cur_branch = ''
                        let cur_docno = response.result[0].DocNo
                        let subtotal_credit = 0
                        let subtotal_debit = 0
        
                        for(let i = 0; i < response.result.length; i++){
                            if(response.result[i].Branch !== cur_branch){
                                cur_branch = response.result[i].Branch
                            }
        
                            table.append(`
                                <tr class="font-dark sbold">
                                    <td><h6 class="text-center">${response.result[i].TransDate}</h6></td>
                                    <td><h6 class="text-left">${response.result[i].DocNo}</h6></td>
                                    <td><h6 class="text-center">${response.result[i].TransType}</h6></td>
                                    <td><h6 class="text-left">${response.result[i].Remarks}</h6></td>
                                    <td><h6 class="text-center">${response.result[i].AccNo}</h6></td>
                                    <td><h6 class="text-center">${response.result[i].Currency}</h6></td>
                                    <td><h6 class="text-center">${response.result[i].Rate}</h6></td>
                                    <td><h6 style="float: right">${Intl.NumberFormat('en').format(response.result[i].Unit)}</h6></td>
                                    <td><h6 style="float: right">${Intl.NumberFormat('en').format(response.result[i].Debit)}</h6></td>
                                    <td><h6 style="float: right">${Intl.NumberFormat('en').format(response.result[i].Credit)}</h6></td>
                                </tr>`
                            )
        
                            cur_docno = response.result[i].DocNo
                            subtotal_debit += +response.result[i].Debit;
                            subtotal_credit += +response.result[i].Credit;
                            
                            if(typeof response.result[i+1] == 'undefined' || response.result[i+1].DocNo !== cur_docno){
                                table.append(`
                                    <tr>
                                        <td colspan="8"></td>
                                        <td><h6 style="float: right">${Intl.NumberFormat('en').format(subtotal_debit)}</h6></td>
                                        <td><h6 style="float: right">${Intl.NumberFormat('en').format(subtotal_credit)}</h6></td>
                                    </tr>`
                                )
        
                                subtotal_credit = subtotal_debit = 0
                            }
                        }
    
                        $('#label_date_start').html(helper.convertDate(date_start, "DD-MMM-YY"))
                        $('#label_date_finish').html(helper.convertDate(date_finish, "DD-MMM-YY"))
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
                            'title': 'ABORTED',
                            'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                    })
                })
            })
        }
    }
}

export default jtr