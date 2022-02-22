/*
 * CORE SCRIPT 
*/

import helper from '../helper.js'

const jtr = {
    eventPreviewFilter: () => {
        $('#submit_filter').click(function(){
            var branch = $('#branch').val()
            var trans_type = $('#transtype').val()
            var accno_start = +$('#accno_start').val()
            var accno_finish = +$('#accno_finish').val()
            var date_start = $('#date_start').val()
            var date_finish = $('#date_finish').val()

            if(!branch || !trans_type || !accno_start || !accno_finish || !date_start || !date_finish){
                alert('Please Select All Filter!')
                return;
            }else if(accno_start > accno_finish){
                alert('Account Number Start must be higher or equal!')
                return;
            }else if(new Date(date_start) > new Date(date_finish)){
                alert('Date Start must be earlier or equal!')
                return;
            }

            $.ajax({
                url: 'ajax_get_journal_transaction',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    branch,
                    trans_type,
                    accno_start,
                    accno_finish,
                    date_start,
                    date_finish,
                },
                beforeSend: () => {
                    helper.blockUI({
                        animate: true
                    })
                },
                success: response => {
                    helper.unblockUI()

                    if(response.success == true){
                        let table = $('#table_jtr tbody')
                    
                        table.empty()

                        if(!Array.isArray(response.result) || response.result.length == 0){
                            table.append(`
                                <tr class="text-center" style="background-color: white">
                                    <td colspan="12" class="bold">NO RECORD FOUND</td>
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
                                    <td class="bold" align="center">${response.result[i].TransDate}</td>
                                    <td class="bold" align="center">${response.result[i].DocNo}</td>
                                    <td class="bold" align="center">${response.result[i].TransType}</td>
                                    <td class="bold" align="left">${response.result[i].Remarks}</td>
                                    <td class="bold" align="center">${response.result[i].Department}</td>
                                    <td class="bold" align="center">${response.result[i].CostCenter}</td>
                                    <td class="bold" align="center">${response.result[i].AccNo}</td>
                                    <td class="bold" align="center">${response.result[i].Acc_Name}</td>
                                    <td class="bold" align="center">${response.result[i].Currency}</td>
                                    <td class="bold" align="center">${response.result[i].Rate}</td>
                                    <td class="bold" align="center">${Intl.NumberFormat('id').format(response.result[i].Unit)}</td>
                                    <td class="bold" align="right">${Intl.NumberFormat('id').format(response.result[i].Debit)}</td>
                                    <td class="bold" align="right">${Intl.NumberFormat('id').format(response.result[i].Credit)}</td>
                                </tr>`
                            )

                            cur_docno = response.result[i].DocNo
                            subtotal_debit += +response.result[i].Debit;
                            subtotal_credit += +response.result[i].Credit;
                            
                            if(typeof response.result[i+1] == 'undefined' || response.result[i+1].DocNo !== cur_docno){
                                table.append(`
                                    <tr class="font-dark sbold">
                                        <td colspan="11"></td>
                                        <td align="right" style="border-top: solid 2px">${Intl.NumberFormat('id').format(subtotal_debit)}</td>
                                        <td align="right" style="border-top: solid 2px">${Intl.NumberFormat('id').format(subtotal_credit)}</td>
                                    </tr>`
                                )
    
                                subtotal_credit = subtotal_debit = 0
                            }
                        }
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

export default jtr