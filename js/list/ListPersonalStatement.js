/*
 *  CORE SCRIPT
*/
const CAStatement = () => {

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
    
                        $('#idnumber').val(response[0].IDNumber)
                        $('#fullname').val(response[0].FullName || '-')
                        $('#jobtitle').val(response[0].JobTitle || '-')
                        $('#supervisor').val(response[0].Supervisor || '-')
                        $('#department').val(response[0].Department || '-')
                        $('#outstanding').val(response[0].Balance || '-')
    
                        for(let i = 0; i < response.result.length; i++){
                            $('#tbody_statement_details').append(`
                                <tr class="sbold">
                                    <td class="text-center">${i+1}</td>
                                    <td class="text-center">${response.result[i].TransDate}</td>
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
CAStatement().init()
CAStatement().events()