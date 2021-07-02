/*
 *  CORE SCRIPT
*/
var GLBranch = () => {
    var branch = accno_start = accno_finish = date_start = date_finish
    
    const eventPreviewFilter  = () => {
        $('#submit_filter').click(function(){
            branch = $('#branch').val()
            accno_start = +$('#accno_start').val()
            accno_finish = +$('#accno_finish').val()
            date_start = $('#date_start').val()
            date_finish = $('#date_finish').val()

            if(!branch || !accno_start || !accno_finish || !date_start || !date_finish){
                alert('Please Select All Filter!')
                return;
            }else if(accno_start > accno_finish){
                alert('Account Number Start must be higher or equal!')
                return;
            }else if(new Date(date_start) > new Date(date_finish)){
                alert('Date Start must be earlier or equal!')
                return;
            }

            let printURL = $('#print_report').attr('href')
            printURL = printURL + `?branch=${branch}&accno_start=${accno_start}&accno_finish=${accno_finish}&date_start=${date_start}&date_finish=${date_finish}`

            $('#print_report').attr('href', printURL)

            $.ajax({
                url: 'ajax_get_general_ledger',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    branch,
                    accno_start,
                    accno_finish,
                    date_start,
                    date_finish,
                },
                success: response => {

                    let table = $('#table_gl tbody')
                    
                    table.empty()

                    if(response.length < 1){    
                        table.append(`
                            <tr class="text-center" style="background-color: white">
                                <td colspan="12" class="bold">NO RECORD FOUND</td>
                            </tr>`
                        )

                        return
                    }

                    $('#label_tbl_date_start').html(date_start)
                    $('#label_tbl_date_finish').html(date_finish)

                    let cur_branch = ''
                    let subtotal_credit = subtotal_debit = 0

                    for(let i = 0; i < response.length; i++){
                        if(response[i].Branch !== cur_branch){
                            cur_branch = response[i].Branch
                        }

                        // if(response[i].Balance)

                        table.append(`
                            <tr class="font-white sbold">
                                <td class="bold" align="center">${i+1}</td>
                                <td class="bold" align="center">${response[i].TransDate}</td>
                                <td class="bold" align="center">${response[i].DocNo}</td>
                                <td class="bold" align="center"></td>
                                <td class="bold" align="center">${response[i].Branch}</td>
                                <td class="bold" align="center">${response[i].Department}</td>
                                <td class="bold" align="right">${response[i].CostCenter || ''}</td>
                                <td class="bold" align="right">${response[i].AccNo}</td>
                                <td class="bold" align="center">${response[i].Remarks}</td>
                                <td class="bold" align="right">${Intl.NumberFormat('id').format(response[i].Debit)}</td>
                                <td class="bold" align="right">${Intl.NumberFormat('id').format(response[i].Credit)}</td>
                                <td class="bold" align="right">
                                    ${Intl.NumberFormat('id').format(response[i].BalanceBranch)}
                                </td>
                            </tr>`
                        )

                        subtotal_debit += +response[i].Debit;
                        subtotal_credit += +response[i].Credit;
                        
                        if(branch == 'All'){
                            if(typeof response[i+1] !== 'undefined' && response[i+1].Branch !== cur_branch || i == (response.length-1)){
                                let subtotal_balance = subtotal_debit - subtotal_credit;
    
                                table.append(`
                                    <tr class="font-white sbold">
                                        <td class="bold" align="right" colspan="9">Beginning Balance</td>
                                        <td class="sbold uppercase font-green-meadow" align="right" colspan="3" style="font-size: 1.25em">${Intl.NumberFormat('id').format(response[i].beg_balance)}</td>
                                    </tr>
                                    <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                        <td align="right" colspan="9">Total :</td>                                    
                                        <td align="right">${Intl.NumberFormat('id').format(subtotal_debit)}</td>
                                        <td align="right">${Intl.NumberFormat('id').format(subtotal_credit)}</td>
                                        <td align="right" class="font-white sbold bg bg-blue-ebonyclay">${Intl.NumberFormat('id').format(subtotal_balance)}</td>
                                    </tr>`
                                )
                            }
                        }else{
                            if(typeof response[i+1] !== 'undefined' && response[i+1].Branch !== cur_branch || i == (response.length-1)){
                                let subtotal_balance = subtotal_debit + subtotal_credit;
    
                                table.append(`
                                    <tr class="font-white sbold">
                                        <td class="bold" align="right" colspan="9">Beginning Balance</td>
                                        <td class="sbold uppercase font-green-meadow" align="right" colspan="3" style="font-size: 1.25em">${Intl.NumberFormat('id').format(response[i].BalanceBranch)}</td>
                                    </tr>
                                    <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                        <td align="right" colspan="9">Total :</td>                                    
                                        <td align="right">${Intl.NumberFormat('id').format(subtotal_debit)}</td>
                                        <td align="right">${Intl.NumberFormat('id').format(subtotal_credit)}</td>
                                        <td align="right" class="font-white sbold bg bg-blue-ebonyclay">${Intl.NumberFormat('id').format(subtotal_balance)}</td>
                                    </tr>`
                                )
    
                                subtotal_credit = subtotal_debit = subtotal_balance = 0
                            }
                        }
                    }
                },
                error: () => alert('NETWORK PROBLEM')
            })
        })
    }

    const eventPrintReport = () => {
        
        $('#print_report').click(function(){
            branch = $('#branch').val()
            accno_start = +$('#accno_start').val()
            accno_finish = +$('#accno_finish').val()
            date_start = $('#date_start').val()
            date_finish = $('#date_finish').val()
            
            if(!branch || !accno_start || !accno_finish || !date_start || !date_finish){
                alert('Please Select All Filter!')
                return;
            }else if(accno_start > accno_finish){
                alert('Account Number Start must be higher or equal!')
                return;
            }else if(new Date(date_start) > new Date(date_finish)){
                alert('Date Start must be earlier or equal!')
                return;
            }

            $.ajax({
                url: 'view_gl_branch_report',
                method: 'POST',
                data: {
                    branch,
                    accno_start,
                    accno_finish,
                    date_start,
                    date_finish
                },
                success: response => {
                    $('body').html(response)
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
            eventPreviewFilter()
            eventPrintReport()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    GLBranch().init()
    GLBranch().events()
})()