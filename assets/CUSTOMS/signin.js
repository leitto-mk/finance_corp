$(document).ready(function () {
    
    //SUBMIT DATA
	$(document).on('submit', '#signinnew', function(e){
        e.preventDefault();
        
        obj = $(this).serializeArray();
        console.log(obj);

        $.ajax({
            url: 'Sign/ajax_submit_data',
            method: 'POST',
            dataType: 'JSON',
            data: obj,
            success: response => {
                if(response.result == 'success'){
                    swal.fire({
                        'type': 'success',
                        'title': 'SIGNIN SUCCESS',
                        'text': `USERNAME: ${obj[5].value}, PASSWORD: 123456 OR CHECK YOUR EMAIL`
                    }).then(result => {
                        if(result.value){
                            window.location.replace(BASE_URL + `auth/index?email=${response.email}`)
                        }
                    })
                }else if(response.result == 'EMAIL_REGISTERED'){
                    swal.fire({
                        'type': 'error',
                        'title': 'EMAIL REGISTERED',
                        'text': 'EMAIL HAS ALREADY BEEN REGISTERED, PLEASE USE ANOTHER EMAIL'
                    })
                }else if(response.result == 'EMAIL_REGISTERED'){
                    swal.fire({
                        'type': 'error',
                        'title': 'EMAIL NOT SENT',
                        'text': response.message
                    })
                }else{
                    alert("SOMETHING'S WRONG")
                }
            },
            error: () => alert('NETWORK PROBLEM')
        })
    })

});