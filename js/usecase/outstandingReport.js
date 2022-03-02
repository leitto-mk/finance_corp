/*
 *  CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const our = {
    indexPage: {
        eventGetOutstandingReport: () => {
            $('#submit_filter').on('click', function(){
                var branch = $('#branch').val()
                var dept = $('#department').val()
                var costcenter = $('#costcenter').val()
                var date_start = $('#date_start').val()
                var date_finish = $('#date_finish').val()

                if(!branch || !dept || !costcenter || !date_start || !date_finish){
                    alert('PLEASE SELECT ALL PARAMTERS')
                }

                repository.getRecord('ajax_get_outsanding_report', {branch, dept, costcenter, date_start, date_finish})
                .then(response => {
                    helper.unblockUI()

                    if(response.success) {
                        let table = $('#tbody_report')
                        table.empty()

                        let index = 1
                        let cur_dept = ''
                        let cur_total = 0;
                        let grand_total = 0;

                        for(let i = 0; i < response.result.length; i++){
                            let row = response.result[i]

                            if(i == 0 || row.DeptCode !== cur_dept){
                                table.append(`
                                    <tr style="background-color: #578ebe6b">
                                        <td colspan="6" class="bold uppercase">${row.DeptDes} (${row.DeptCode})</td>
                                    </tr>
                                `)

                                cur_dept = row.DeptCode
                                cur_total = 0
                                index = 1
                            }

                            table.append(`
                                <tr class="font-dark">
                                    <td align="center">${index}</td>                                 
                                    <td align="center">${row.DeptCode}</td>
                                    <td align="left">${row.FullName}</td>
                                    <td align="left">${row.JobTitleDes}</td>
                                    <td align="left">${row.Supervisor}</td>
                                    <td align="right">${Intl.NumberFormat('id').format(row.Outstanding)}</td>
                                </tr>
                            `)
                                
                            cur_total += +row.Outstanding
                            grand_total += +row.Outstanding
                            index += 1

                            if(i < (response.result.length-1) && response.result[i+1].DeptCode !== cur_dept){
                                table.append(`
                                    <tr class="font-dark sbold" style="border-top: solid 2px;">                          
                                        <td align="right" colspan="5">Total :</td>
                                        <td align="right">${Intl.NumberFormat('id').format(cur_total)}</td>
                                    </tr>
                                `)
                            }
                        }

                        table.append(`
                            <tr class="font-dark sbold" style="border-top: solid 2px;">                          
                                <td align="right" colspan="5">Total :</td>
                                <td align="right">${Intl.NumberFormat('id').format(cur_total)}</td>
                            </tr>
                            <tr class="bg-blue-ebonyclay font-white bold">                          
                                <td align="right" colspan="5"> Grand Total :</td>
                                <td align="right">${Intl.NumberFormat('id').format(grand_total)}</td>
                            </tr>
                        `)

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

export default our