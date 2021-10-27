/*
 *  CORE SCRIPT
*/
var CAWithdraw = () => {
    const eventShowList = () => {
        $('#preview, #search').click(function(){
            let docno = $('#search_item').val()
            let start = $('#date_from').val()
            let end = $('#date_to').val()

            $.ajax({
                url: 'ajax_get_annual_ca_withdraw',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    docno,
                    start,
                    end
                },
                success: response => {
                    if(response){
                        $('tbody').empty()

                        for(let i=0; i < response.length; i++){
                            $('tbody').append(
                                `<tr class="font-dark sbold">
                                    <td align="center">${response[i].TransDate}</td>
                                    <td align="center">${response[i].DocNo}</td>
                                    <td align="center">${response[i].TransType}</td>
                                    <td align="left">${response[i].Branch} - ${response[i].BranchName}</td>
                                    <td align="left">${response[i].Remarks}</td>
                                    <td align="right">${response[i].TotalAmount}</td>
                                    <td align="center">
                                        <a href="${base_url}FinanceCorp/edit_ca_withdraw?docno=${response[i].DocNo}" target="_blank" type="button" class="btn btn-xs green">
                                            <i class="fa fa-edit"> </i>
                                        </a>
                                        <a href="${base_url}FinanceCorp/view_reps_cash_withdraw?docno=${response[i].DocNo}&branch=${response[i].Branch}&transdate=${response[i].TransDate}" target="_blank" name="report" type="button" class="btn btn-xs green-meadow">
                                            <i class="fa fa-print"> </i>
                                        </a>
                                        <a href="javascript:;" name="delete" data-docno="${response[i].DocNo}" data-branch="${response[i].Branch}" data-transdate="${response[i].TransDate}" type="button" class="btn btn-xs red">
                                            <i class="fa fa-trash"> </i>
                                        </a>
                                    </td>
                                 </tr>`
                            )
                        }
                    }
                },
                error: () => alert('NETWORK PROBLEM')
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
                url: 'ajax_delete_ca_withdraw',
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
                error: () => alert('NETWORK PROBLEM')
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
    CAWithdraw().init()
    CAWithdraw().events()
})()