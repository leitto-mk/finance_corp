/*
 *  CORE SCRIPT
*/
const ListCAStatement = () => {

    const eventGetEmpDetails = () => {
        $(document).on('click','[name=emp_id]',function(){
            $.ajax({
                url: 'ajax_get_emp_details',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    id: $(this).attr('data-id')
                },
                success: response => {
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
                            $('#tbody_statement_details').append(`
                                <tr class="sbold">
                                    <td class="text-center">${i+1}</td>
                                    <td class="text-center">${response.result[i].TransDate ?? ''}</td>
                                    <td class="text-center">${response.result[i].DocNo}</td>
                                    <td class="text-left">${response.result[i].Remarks}</td>
                                    <td class="text-left">${response.result[i].AccNo}</td>
                                    <td class="text-left">${response.result[i].Debit}</td>
                                    <td class="text-right">${response.result[i].Credit}</td>
                                    <td class="text-right">${response.result[i].Balance}</td>
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
                },
                error: response => {
                    Swal.fire({
                        'type': 'error',
                        'title': 'ABORTED',
                        'html': `<h4 class="sbold">${response.responseJSON.desc}</h4>`
                    })
                }
            })
        })
    }

    return {
        init: () => {
            //NO INIT FUNCTION FOR THIS SCRIPT
        },
        events: () => {
            eventGetEmpDetails()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    ListCAStatement().init()
    ListCAStatement().events()
})()