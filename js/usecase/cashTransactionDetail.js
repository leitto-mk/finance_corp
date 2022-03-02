/*
 *  CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const ctd = {
    indexPage: {
        eventGetCashTransactionDetail: () => {
            $('#submit_filter').on('click', function(){
                var branch = $('#branch').val()
                var dept = $('#department').val()
                var costcenter = $('#costcenter').val()
                var date_start = $('#date_start').val()
                var date_finish = $('#date_finish').val()

                if(!branch || !dept || !costcenter || !date_start || !date_finish){
                    alert('PLEASE SELECT ALL PARAMTERS')
                }

                repository.getRecord('ajax_get_cash_transaction_detail', {branch, dept, costcenter, date_start, date_finish})
                .then(response => {
                    helper.unblockUI()

                    if(response.success) {
                        let table = $('#tbody_report')
                        table.empty()

                        for(let i = 0; i < response.result.length; i++){
                            let row = response.result[i]

                            table.append(`
                                <tr class="font-dark">
                                    <td align="center">${row.TransDate}</td>    
                                    <td align="center">${row.DocNo}</td>
                                    <td align="center">${row.TransType}</td>
                                    <td align="center">${row.IDNumber}</td>
                                    <td align="left">${row.FullName}</td>
                                    <td align="left">${row.Remarks}</td>
                                    <td align="left">${row.DeptDes}</td>
                                    <td align="center">${row.Currency}</td>
                                    <td align="center">${row.Rate}</td>
                                    <td align="right">${row.Unit}</td>
                                    <td align="right">${row.Amount}</td>
                                </tr>
                            `)
                        }

                        $('#label_date_start').html(helper.convertDate(date_start, "DD-MMM-YY"))
                        $('#label_date_finish').html(helper.convertDate(date_finish, "DD-MMM-YY"))
                    }else{
                        Swal.fire({
                            'type': 'error',
                            'title': 'ABORTED',
                            'html': `<h4 class="sbold">${response.desc}</h4>`
                        })
                    }
                })
                .fail(err => {
                    helper.unblockUI()

                    Swal.fire({
                        'type': 'error',
                        'title': 'ABORTED',
                        'html': `<h4 class="sbold">${err.desc}</h4>`
                    })
                })
            })
        }
    }
}

export default ctd