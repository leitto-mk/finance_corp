/*
 * Core Script
*/

import helper from '../helper.js'

var branch, accno_start, accno_finish, date_start, date_finish;

const gl = {
    eventPreviewFilter: () => {
        $('#submit_filter').click(function(){
            branch = $('#branch').val()
            accno_start = +$('#accno_start').val()
            accno_finish = +$('#accno_finish').val()
            date_start = $('#date_start').val()
            date_finish = $('#date_finish').val()

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

            //Append new URL Param for ReCalculate
            let calculateURL = $('#recalculate').attr('href')
            let cal = new URL(calculateURL)
            let calparam = cal.searchParams
            calparam.set('branch', branch)
            calparam.set('accno_start', accno_start)
            calparam.set('accno_finish', accno_finish)
            calparam.set('date_start', date_start)
            calparam.set('date_finish', date_finish)

            url.search = params.toString()
            cal.search = calparam.toString()
            
            $('#print_report').attr('href', url.toString())
            $('#recalculate').attr('href', cal.toString())

            $.ajax({
                url: 'ajax_get_general_ledger',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    branch,
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

                        let cur_branch = ''
                        let cur_accno = response.result[0].AccNo
                        let subtotal_credit = subtotal_debit = 0

                        for(let i = 0; i < response.result.length; i++){
                            if(response.result[i].Branch !== cur_branch){
                                cur_branch = response.result[i].Branch
                            }

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
                                    <td class="bold" align="right">${Intl.NumberFormat('id').format(response.result[i].Debit)}</td>
                                    <td class="bold" align="right">${Intl.NumberFormat('id').format(response.result[i].Credit)}</td>
                                    <td class="bold" align="right">
                                        ${Intl.NumberFormat('id').format(response.result[i].BalanceBranch)}
                                    </td>
                                </tr>`
                            )

                            cur_accno = response.result[i].AccNo
                            subtotal_debit += +response.result[i].Debit;
                            subtotal_credit += +response.result[i].Credit;
                            
                            if(branch == 'All'){
                                if(typeof response[i+1] !== 'undefined' && response[i+1].Branch !== cur_branch || i == (response.length-1)){
                                    let subtotal_balance = subtotal_debit - subtotal_credit;
        
                                    table.append(`
                                        <tr class="font-dark sbold">
                                            <td class="bold" align="right" colspan="8">Beginning Balance</td>
                                            <td class="sbold uppercase font-green-meadow" align="right" colspan="3" style="font-size: 1.25em">${Intl.NumberFormat('id').format(response.result[i].beg_balance)}</td>
                                        </tr>
                                        <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                            <td align="right" colspan="8">Total :</td>                                    
                                            <td align="right">${Intl.NumberFormat('id').format(subtotal_debit)}</td>
                                            <td align="right">${Intl.NumberFormat('id').format(subtotal_credit)}</td>
                                            <td align="right" class="font-white sbold bg bg-blue-ebonyclay">${Intl.NumberFormat('id').format(subtotal_balance)}</td>
                                        </tr>`
                                    )
                                }
                            }else{
                                if(typeof response[i+1] !== 'undefined' && response[i+1].Branch !== cur_branch || i == (response.length-1)){
                                    let subtotal_balance = subtotal_debit + subtotal_credit;
        
                                    table.append(`
                                        <tr class="font-dark sbold">
                                            <td class="bold" align="right" colspan="8">Beginning Balance</td>
                                            <td class="sbold uppercase font-green-meadow" align="right" colspan="3" style="font-size: 1.25em">${Intl.NumberFormat('id').format(response.result[i].BalanceBranch)}</td>
                                        </tr>
                                        <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                            <td align="right" colspan="8">Total :</td>                                    
                                            <td align="right">${Intl.NumberFormat('id').format(subtotal_debit)}</td>
                                            <td align="right">${Intl.NumberFormat('id').format(subtotal_credit)}</td>
                                            <td align="right" class="font-white sbold bg bg-blue-ebonyclay">${Intl.NumberFormat('id').format(subtotal_balance)}</td>
                                        </tr>`
                                    )
        
                                    subtotal_credit = subtotal_debit = subtotal_balance = 0
                                }
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

    eventRecalculate: () => {
        $('#recalculate').click(function(e){
            e.preventDefault()

            branch = $('#branch').val()
            accno_start = +$('#accno_start').val()
            accno_finish = +$('#accno_finish').val()
            date_start = $('#date_start').val()
            date_finish = $('#date_finish').val()

            if(!branch || !accno_start || !accno_finish || !date_start || !date_finish){
                alert("Please select all filter first")
                return
            }
            
            if(accno_start > accno_finish){
                alert('Account Number Start must be higher or equal!')
                return
            }else if(new Date(date_start) > new Date(date_finish)){
                alert('Date Start must be earlier or equal!')
                return
            }

            $.ajax({
                url: 'ajax_recalculate_balance',
                method: 'POST',
                data: {
                    branch,
                    accno_start,
                    accno_finish,
                    date_start,
                    date_finish
                },
                beforeSend: () => {
                    helper.blockUI({
                        animate: true
                    })
                },
                success: response => {
                    if(response.success){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'html': 'Data has been Re-Calcualted'
                        });
                    }else{
                        Swal.fire({
                            'type': 'error',
                            'title': 'ABORTED',
                            'html': response.desc
                        })
                    }
                },
                error: response => {
                    Swal.fire({
                            'type': 'error',
                            'title': 'ABORTED',
                            'html': response.responseJSON.desc
                    })
                }
            }).done(() => {
                helper.unblockUI()
            })
        })
    },
}

export default gl