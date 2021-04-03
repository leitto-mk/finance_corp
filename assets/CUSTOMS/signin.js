$(document).ready(function () {
    //INPUT MASK
    $('input[name="handheldnumber"]').inputmask("(+62) 999-9999-9999", { clearMaskOnLostFocus: false });

    //SUBMIT DATA
	$(document).on('submit', '#signinnew', function(e){
        e.preventDefault();
        
        obj = $(this).serializeArray();

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
                        'text': `Press OK to to proceed...`
                    }).then(result => {
                        if(result.value){
                            window.location.replace(BASE_URL + `auth/index?email=${response.email}`)
                        }
                    })
                }else if(response.result == 'EMAIL_REGISTERED'){
                    swal.fire({
                        'type': 'error',
                        'title': 'EMAIL REGISTERED',
                        'text': 'EMAIL HAS ALREADY BEEN REGISTERED, PLEASE USE ANOTHER EMAIL',
                        'width': 600
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