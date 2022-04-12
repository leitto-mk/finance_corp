/*
 * CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

//Indempotent Function
const _callable = {
    DrawTableAging: (response, q) => {
        let table = $(`#table_${q} tbody`)

        const currency = Intl.NumberFormat('en', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        })

        if(response.result[q] && response.result[q].length > 0){
            table.empty()
    
            let total_amount = 0
            let payment = 0
            let balance = 0
            for(let i = 0; i < response.result[q].length; i++){
                if(i == 0){
                    table.append(`
                        <tr style="background-color: #578ebe6b">
                            <td colspan="9" class="bold">${response.result[q][i].CustomerName} - ${response.result[q][i].CustomerCode}</td>
                        </tr>
                    `)
                }else{
                    if(response.result[q][i].CustomerCode !== response.result[q][i-1].Customercode){
                        table.append(`
                            <tr style="background-color: #578ebe6b">
                                <td colspan="9" class="bold">${response.result[q][i].CustomerName}-${response.result[q][i].CustomerCode}</td>
                            </tr>
                        `)
                    }
                }
                
                table.append(`
                    <tr class="font-dark sbold">
                        <td align="center">${i+1}</td>
                        <td align="left">${response.result[q][i].InvoiceNo}</td>
                        <td align="center">${response.result[q][i].TermsOfDays}</td>
                        <td align="center">${response.result[q][i].RaisedDate}</td>
                        <td align="center">${response.result[q][i].DueDate}</td>
                        <td align="right">${currency.format(response.result[q][i].TotalAmount)}</td>
                        <td align="right">${currency.format(response.result[q][i].Payment)}</td>
                        <td align="right">${currency.format(response.result[q][i].Balance)}</td>
                    </tr>
                `)
    
                total_amount += +response.result[q][i].TotalAmount
                payment += +response.result[q][i].Payment
                balance += +response.result[q][i].Balance
    
                if(i < (response.result[q].length - 1)){
                    if(response.result[q][i].CustomerCode !== response.result[q][i+1].CustomerCode){
                        table.append(`
                            <tr style="border-top: solid 2px;" class="font-dark sbold">
                                <td align="right" colspan="5">Total Amount :</td>
                                <td align="right">${currency.format(total_amount)}</td>
                                <td align="right">${currency.format(payment)}</td>
                                <td align="right">${currency.format(balance)}</td>
                            </tr>
                        `)
                    }
    
                    total_amount = 0
                    payment = 0
                    balance = 0
                } else {
                    table.append(`
                        <tr style="border-top: solid 2px;" class="font-dark sbold">
                            <td align="right" colspan="5">Total Amount :</td>
                            <td align="right">${currency.format(total_amount)}</td>
                            <td align="right">${currency.format(payment)}</td>
                            <td align="right">${currency.format(balance)}</td>
                        </tr>
                    `)
    
                    total_amount = 0
                    payment = 0
                    balance = 0
                }
            }
        }else{
            table.empty()
            table.append(`
                <td>
                    <td colspan="8" class="sbold text-center">No Data</td>
                </td>
            `)
        }
    }
}

export const AgingPage = () => {
    (function InitSelectSearch(){
        helper.setSelect2($('#customer'), {width: 'auto'})
    })();

    (function EventPreviewFilter(){
        $('#submit_filter').click(function(){
            var currency = Intl.NumberFormat('en', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })

            var formData = {
                'customer': $('#customer option:selected').val(),
                'branch': $('#branch option:selected').val(),
                'ageby': $('#aging option:selected').val(),
                'date_start': $('#date_start').val()
            }

            var url = window.location.origin + '/invoice/get_aging'

            repository.getRecord(url, formData)
            .then(response => {
                helper.unblockUI()

                if(!response.success == true){
                    Swal.fire({
                        'icon': 'error',
                        'title': 'ERROR',
                        'html': `<h4 class="sbold">${response.desc}</h4>`
                    })   
                }

                /**
                 ** TABLE SUMMARY STARTS HERE
                 */
                if(response.result.summary.length > 0){
                    let table = $('#table_summary tbody')
                    let totalOutstanding = 0
                    let totalQ1 = 0
                    let totalQ2 = 0
                    let totalQ3 = 0
                    let totalQ4 = 0
                    table.empty()
                    
                    for(let i = 0; i < response.result.summary.length; i++){
                        table.append(`
                            <tr class="font-dark sbold">
                                <td align="center">${i+1}</td>
                                <td align="center">${response.result.summary[i].CustomerName}</td>   
                                <td align="right">${currency.format(response.result.summary[i].Outstanding)}</td>
                                <td align="right">${currency.format(response.result.summary[i].BalanceQ1)}</td>
                                <td align="right">${currency.format(response.result.summary[i].BalanceQ2)}</td>
                                <td align="right">${currency.format(response.result.summary[i].BalanceQ3)}</td>
                                <td align="right">${currency.format(response.result.summary[i].BalanceQ4)}</td>
                            </tr>
                        `)

                        totalOutstanding += +response.result.summary[i].Outstanding
                        totalQ1 += +response.result.summary[i].BalanceQ1
                        totalQ2 += +response.result.summary[i].BalanceQ2
                        totalQ3 += +response.result.summary[i].BalanceQ3
                        totalQ4 += +response.result.summary[i].BalanceQ4

                        if(i == (response.result.summary.length - 1)){
                            table.append(`
                                <tr style="border-top: solid 2px;" class="font-dark sbold">
                                    <td align="center"></td>
                                    <td align="right">Total Amount :</td>                                    
                                    <td align="right">${currency.format(totalOutstanding)}</td>
                                    <td align="right">${currency.format(totalQ1)}</td>
                                    <td align="right">${currency.format(totalQ2)}</td>
                                    <td align="right">${currency.format(totalQ3)}</td>
                                    <td align="right">${currency.format(totalQ4)}</td>
                                </tr>
                            `)
                        }
                    }
                }

                 /**
                 ** TABLE Q1-Q4 STARTS HERE
                 */
                _callable.DrawTableAging(response, 'q1')
                _callable.DrawTableAging(response, 'q2')
                _callable.DrawTableAging(response, 'q3')
                _callable.DrawTableAging(response, 'q4')
            })
            .fail(err => {
                helper.unblockUI()

                console.log(err)

                Swal.fire({
                    'icon': 'error',
                    'title': 'ERROR',
                    'html': `<h4 class="sbold">${err.response.JSON.desc ??= 'Server Problem'}</h4>`
                })
            })
        })
    })();
}