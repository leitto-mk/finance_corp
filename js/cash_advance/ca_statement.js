/*
 *  CORE SCRIPT
*/
var CAStatement = (function(){
    const eventGetEmpDetails = () => {
        $(document).on('click','[name=emp_id]',function(){
            let id = $(this).attr('data-id')

            $.ajax({
                url: 'ajax_get_emp_details',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    id
                },
                success: response => {
                    if(!response){
                        return
                    }

                    $('#tbody_statement_details').empty()

                    $('#idnumber').val(response[0].IDNumber)
                    $('#fullname').val(response[0].FullName || '-')
                    $('#jobtitle').val(response[0].JobTitle || '-')
                    $('#supervisor').val(response[0].Supervisor || '-')
                    $('#department').val(response[0].Department || '-')
                    $('#outstanding').val(response[0].Balance || '-')

                    for(let i = 0; i < response.length; i++){
                        $('#tbody_statement_details').append(`
                            <tr class="sbold">
                                <td class="text-center">${i+1}</td>
                                <td class="text-center">${response[i].TransDate}</td>
                                <td class="text-center">${response[i].DocNo}</td>
                                <td class="text-left">${response[i].Remarks}</td>
                                <td class="text-left">${response[i].AccNo}</td>
                                <td class="text-left">${response[i].Debit}</td>
                                <td class="text-right">${response[i].Credit}</td>
                                <td class="text-right">${response[i].Balance}</td>
                            </tr>
                        `)
                    }
                },
                error: () => alert('NETWORK PROBLEM')
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
})()

/* INITIALIZE CORE SCRIPT */
CAStatement().init()
CAStatement().events()