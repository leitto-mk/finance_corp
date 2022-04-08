/*
 * Core Script
*/

import helper from '../helper.js'
import repository from '../repository/repository.js';

const gl = {
    indexPage: {
        eventPreviewFilter: () => {
            $('#submit_filter').click(function(){
                var branch = $('#branch').val()
                var accno_start = +$('#accno_start').val()
                var accno_finish = +$('#accno_finish').val()
                var date_start = $('#date_start').val()
                var date_finish = $('#date_finish').val()
    
                if(!branch || !accno_start || !accno_finish || !date_start || !date_finish){
                    alert('Please Select All Filter!')
                    return;
                }else if(accno_start > accno_finish){
                    alert('Account Number Start must be higher or equal!')
                    return;
                }else if(new Date(date_start) > new Date(date_finish)){
                    alert('Date Start must be earlier or equal!')
                    return;
                }
    
                //Append new URL Param for Print
                let printURL = $('#print_report').attr('href')
                let url = new URL(printURL)
                let params = url.searchParams
                params.set('branch', branch)
                params.set('accno_start', accno_start)
                params.set('accno_finish', accno_finish)
                params.set('date_start', date_start)
                params.set('date_finish', date_finish)
    
                url.search = params.toString()
                
                $('#print_report').attr('href', url.toString())

                repository.getRecord('ajax_get_general_ledger', {
                    branch,
                    accno_start,
                    accno_finish,
                    date_start,
                    date_finish,
                })
                .then(response => {
                    helper.unblockUI()

                    if(response.success == true){
                        let table = $('#table_gl tbody')
                    
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

                        let subtotal_credit = 0
                        let subtotal_debit = 0
                        
                        for(let i = 0; i < response.result.length; i++){
                            let cur_accno = response.result[i].AccNo

                            if(response.result[i].AccNo !== cur_accno){
                                table.append(`
                                    <tr class="bg-default">
                                        <td colspan="11"></td>
                                    </tr>`
                                )
                            }

                            let transdate = response.result[i].TransDate
                            transdate = moment(transdate,'YYYY-MM-DD').format('DD-MM-YY')

                            table.append(`
                                <tr class="font-dark sbold">
                                    <td class="bold" align="center">${i+1}</td>
                                    <td class="bold" align="center">${transdate}</td>
                                    <td class="bold" align="center">${response.result[i].DocNo}</td>
                                    <td class="bold" align="center">${response.result[i].Branch}</td>
                                    <td class="bold" align="center">${response.result[i].Department}</td>
                                    <td class="bold" align="center">${response.result[i].CostCenter || ''}</td>
                                    <td class="bold" align="center">${response.result[i].AccNo}</td>
                                    <td class="bold" align="left">${response.result[i].Remarks}</td>
                                    <td class="bold" align="right">${Intl.NumberFormat('en').format(response.result[i].Debit)}</td>
                                    <td class="bold" align="right">${Intl.NumberFormat('en').format(response.result[i].Credit)}</td>
                                    <td class="bold" align="right">
                                        ${Intl.NumberFormat('en').format(response.result[i].BalanceBranch)}
                                    </td>
                                </tr>`
                            )

                            cur_accno = response.result[i].AccNo
                            subtotal_debit += +response.result[i].Debit;
                            subtotal_credit += +response.result[i].Credit;
                            
                            let subtotal_balance = subtotal_debit + subtotal_credit;
                            if(i < (response.result.length-1)){
                                if(response.result[i+1].AccNo !== cur_accno){
                                    table.append(`
                                        <tr class="font-dark sbold">
                                            <td class="bold" align="right" colspan="8">Balance</td>
                                            <td class="sbold uppercase font-green-meadow" align="right" colspan="3" style="font-size: 1.25em">${Intl.NumberFormat('en').format(response.result[i].BalanceBranch)}</td>
                                        </tr>
                                        <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                            <td align="right" colspan="8">Total :</td>                                    
                                            <td align="right">${Intl.NumberFormat('en').format(subtotal_debit)}</td>
                                            <td align="right">${Intl.NumberFormat('en').format(subtotal_credit)}</td>
                                            <td align="right" class="font-white sbold bg bg-blue-ebonyclay">${Intl.NumberFormat('en').format(subtotal_balance)}</td>
                                        </tr>`
                                    )
        
                                    subtotal_credit = subtotal_debit = subtotal_balance = 0
                                }
                            }else{
                                table.append(`
                                    <tr class="font-dark sbold">
                                        <td class="bold" align="right" colspan="8">Balance</td>
                                        <td class="sbold uppercase font-green-meadow" align="right" colspan="3" style="font-size: 1.25em">${Intl.NumberFormat('en').format(response.result[i].BalanceBranch)}</td>
                                    </tr>
                                    <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                        <td align="right" colspan="8">Total :</td>                                    
                                        <td align="right">${Intl.NumberFormat('en').format(subtotal_debit)}</td>
                                        <td align="right">${Intl.NumberFormat('en').format(subtotal_credit)}</td>
                                        <td align="right" class="font-white sbold bg bg-blue-ebonyclay">${Intl.NumberFormat('en').format(subtotal_balance)}</td>
                                    </tr>`
                                )
                            }
                        }
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
                            'html': `<h4 class="sbold">${err.desc}</h4>`
                    })
                })
            })
        }
    }
}

export default gl