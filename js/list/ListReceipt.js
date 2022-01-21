/*
 *  CORE SCRIPT
*/
var Receipt = () => {
    const eventShowList = () => {
        $('#preview, #search').click(function(){
            let docno = $('#search_item').val()
            let start = $('#date_from').val()
            let end = $('#date_to').val()

            $.ajax({
                url: 'ajax_get_annual_receipt',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    docno,
                    start,
                    end
                },
                success: response => {
                    if(response.success == true){
                        $('tbody').empty()

                        if(!Array.isArray(response.result) || response.result.length == 0){
                            return
                        }

                        for(let i=0; i < response.result.length; i++){
                            $('tbody').append(
                                `<tr class="font-white sbold">
                                    <td align="center">${response.result[i].TransDate}</td>
                                    <td align="center">${response.result[i].DocNo}</td>
                                    <td align="center">${response.result[i].TransType}</td>
                                    <td align="left">${response.result[i].Branch} - ${response.result[i].BranchName}</td>
                                    <td align="left">${response.result[i].Remarks}</td>
                                    <td align="right">${response.result[i].TotalAmount}</td>
                                    <td align="center">
                                        <a href="${base_url}FinanceCorp/edit_receipt?docno=${response.result[i].DocNo}" target="_blank" type="button" class="btn btn-xs green">
                                            <i class="fa fa-edit"> </i>
                                        </a>
                                        <a href="${base_url}FinanceCorp/view_reps_receipt_voucher?docno=${response.result[i].DocNo}&branch=${response.result[i].Branch}&transdate=${response.result[i].TransDate}" target="_blank" name="report" type="button" class="btn btn-xs green-meadow">
                                            <i class="fa fa-print"> </i>
                                        </a>
                                        <a href="javascript:;" name="delete" data-docno="${response.result[i].DocNo}" data-branch="${response.result[i].Branch}" data-transdate="${response.result[i].TransDate}" type="button" class="btn btn-xs red">
                                            <i class="fa fa-trash"> </i>
                                        </a>
                                    </td>
                                 </tr>`
                            )
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

    const eventDeleteButton = () => {
        $(document).on('click','[name=delete]', function(){
            var row = $(this).parents('tr')
            let docno = $(this).attr('data-docno')
            let branch = $(this).attr('data-branch')
            let transdate = $(this).attr('data-transdate')

            $.ajax({
                url: 'ajax_delete_receipt',
                method: 'POST',
                data: {
                    docno,
                    branch,
                    transdate
                },
                success: response => {
                    if(response == 'success'){
                        alert("Delete Success")
                        
                        row.remove()
                    }else{
                        alert("SERVER PROBLEM")
                    }
                },
                error: response => {
        Swal.fire({
                'type': 'error',
                'title': 'ABORTED',
                'text': response.desc
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
            eventShowList()
            eventDeleteButton()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    Receipt().init()
    Receipt().events()
})()