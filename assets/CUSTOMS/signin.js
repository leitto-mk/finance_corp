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
                        'text': 'PLEASE SIGN IN USING EMAIL AND YOUR CURRENT PASSWORD IS: 123456'
                    }).then(result => {
                        if(result.value){
                            close()
                            window.open(BASE_URL + `auth/index?email=${response.email}`)
                        }
                    })
                }else if(response.result == 'EMAIL_REGISTERED'){
                    swal.fire({
                        'type': 'error',
                        'title': 'EMAIL REGISTERED',
                        'text': 'EMAIL HAS ALREADY BEEN REGISTERED, PLEASE USE ANOTHER EMAIL'
                    })
                }else{
                    alert("SOMETHING'S WRONG")
                }
            },
            error: () => alert('NETWORK PROBLEM')
        })
    })

});