/*
 * Core Script
*/

import helper from '../helper.js'

const cap = {
    indexPage: {
        eventGetEmpDetails: () => {
            $(document).on('click','[name=emp_id]',function(){
                var id = $(this).attr('data-id')

                repository.getRecord('ajax_get_emp_details', { id })
                .then(response => {
                    helper.unblockUI()

                    if(response.success == true){
                        if(response.data){
                            return
                        }
    
                        $('#tbody_statement_details').empty()
    
                        $('#idnumber').val(response.result[0].IDNumber)
                        $('#fullname').val(response.result[0].FullName || '-')
                        $('#jobtitle').val(response.result[0].JobTitle || '-')
                        $('#supervisor').val(response.result[0].Supervisor || '-')
                        $('#department').val(response.result[0].Department || '-')
                        $('#outstanding').val(response.result[0].Balance || '-')
    
                        if(response.result.length <= 1 && !response.result[0].DocNo ){
                            $('#tbody_statement_details').append(
                                `<tr class="sbold"> 
                                    <td class="text-center" colspan="8"> No Record Found... </td>
                                </tr>`
                            )

                            return
                        }

                        for(let i = 0; i < response.result.length; i++){
                            let debit = 0
                            let credit = 0
                            let balance = Intl.NumberFormat('id').format(response.result[i].Balance)

                            if (response.result[i].TransType == 'CW') {
                                debit = Intl.NumberFormat('id').format(response.result[i].Credit)
                            }else if (response.result[i].TransType == 'CR'){
                                credit = Intl.NumberFormat('id').format(response.result[i].Credit)
                            }

                            $('#tbody_statement_details').append(`
                                <tr class="sbold">
                                    <td class="text-center">${i+1}</td>
                                    <td class="text-center">${response.result[i].TransDate}</td>
                                    <td class="text-center">${response.result[i].DocNo}</td>
                                    <td class="text-left">${response.result[i].Remarks}</td>
                                    <td class="text-center">${response.result[i].AccNo}</td>
                                    <td class="text-right">${debit}</td>
                                    <td class="text-right">${credit}</td>
                                    <td class="text-right">${balance}</td>
                                </tr>
                            `)
                        }
                    }else{
                        Swal.fire({
                            'type': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${response.desc}</h4>`
                        })
                    }
                })
                .fail(err => {
                    helper.unblockUI()
                    
                    Swal.fire({
                        'type': 'error',
                        'title': 'ABORTED',
                        'html': `<h4 class="sbold">${err.responseJSON.desc}</h4>`
                    })
                })
            })
        }
    }
}

export default cap