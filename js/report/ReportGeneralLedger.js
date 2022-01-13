/*
 *  CORE SCRIPT
*/
const GeneralLedger = () => {
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

            //Append new URL Param for Print
            let printURL = $('#print_report').attr('href')
            let url = new URL(printURL)
            let params = url.searchParams
            params.set('branch', branch)
            params.set('accno_start', accno_start)
            params.set('accno_finish', accno_finish)
            params.set('date_start', date_start)
            params.set('date_finish', date_finish)

            //Append new URL Param for ReCalculate
            let calculateURL = $('#recalculate').attr('href')
            let cal = new URL(calculateURL)
            let calparam = cal.searchParams
            calparam.set('branch', branch)
            calparam.set('accno_start', accno_start)
            calparam.set('accno_finish', accno_finish)
            calparam.set('date_start', date_start)
            calparam.set('date_finish', date_finish)

            url.search = params.toString()
            cal.search = calparam.toString()
            
            $('#print_report').attr('href', url.toString())
            $('#recalculate').attr('href', cal.toString())

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
                    let cur_accno = response[0].AccNo
                    let subtotal_credit = subtotal_debit = 0

                    for(let i = 0; i < response.length; i++){
                        if(response[i].Branch !== cur_branch){
                            cur_branch = response[i].Branch
                        }

                        if(response[i].AccNo !== cur_accno){
                            table.append(`
                                <tr class="bg-default">
                                    <td colspan="11"></td>
                                </tr>`
                            )
                        }

                        table.append(`
                            <tr class="font-dark sbold">
                                <td class="bold" align="center">${i+1}</td>
                                <td class="bold" align="center">${response[i].TransDate}</td>
                                <td class="bold" align="center">${response[i].DocNo}</td>
                                <td class="bold" align="center">${response[i].Branch}</td>
                                <td class="bold" align="center">${response[i].Department}</td>
                                <td class="bold" align="center">${response[i].CostCenter || ''}</td>
                                <td class="bold" align="center">${response[i].AccNo}</td>
                                <td class="bold" align="left">${response[i].Remarks}</td>
                                <td class="bold" align="right">${Intl.NumberFormat('id').format(response[i].Debit)}</td>
                                <td class="bold" align="right">${Intl.NumberFormat('id').format(response[i].Credit)}</td>
                                <td class="bold" align="right">
                                    ${Intl.NumberFormat('id').format(response[i].BalanceBranch)}
                                </td>
                            </tr>`
                        )

                        cur_accno = response[i].AccNo
                        subtotal_debit += +response[i].Debit;
                        subtotal_credit += +response[i].Credit;
                        
                        if(branch == 'All'){
                            if(typeof response[i+1] !== 'undefined' && response[i+1].Branch !== cur_branch || i == (response.length-1)){
                                let subtotal_balance = subtotal_debit - subtotal_credit;
    
                                table.append(`
                                    <tr class="font-dark sbold">
                                        <td class="bold" align="right" colspan="8">Beginning Balance</td>
                                        <td class="sbold uppercase font-green-meadow" align="right" colspan="3" style="font-size: 1.25em">${Intl.NumberFormat('id').format(response[i].beg_balance)}</td>
                                    </tr>
                                    <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                        <td align="right" colspan="8">Total :</td>                                    
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
                                    <tr class="font-dark sbold">
                                        <td class="bold" align="right" colspan="8">Beginning Balance</td>
                                        <td class="sbold uppercase font-green-meadow" align="right" colspan="3" style="font-size: 1.25em">${Intl.NumberFormat('id').format(response[i].BalanceBranch)}</td>
                                    </tr>
                                    <tr style="border-top: solid 4px;" class="font-dark sbold bg bg-grey-salsa">
                                        <td align="right" colspan="8">Total :</td>                                    
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

    const eventRecalculate = () => {
        $('#recalculate').click(function(e){
            e.preventDefault()

            branch = $('#branch').val()
            accno_start = +$('#accno_start').val()
            accno_finish = +$('#accno_finish').val()
            date_start = $('#date_start').val()
            date_finish = $('#date_finish').val()

            if(!branch || !accno_start || !accno_finish || !date_start || !date_finish){
                alert("Please select all filter first")
                return
            }
            
            if(accno_start > accno_finish){
                alert('Account Number Start must be higher or equal!')
                return
            }else if(new Date(date_start) > new Date(date_finish)){
                alert('Date Start must be earlier or equal!')
                return
            }

            $.ajax({
                url: 'ajax_recalculate_balance',
                method: 'POST',
                data: {
                    branch,
                    accno_start,
                    accno_finish,
                    date_start,
                    date_finish
                },
                success: response => {
                    if(response == 'success'){
                        // swal({
                        //     'type': 'success',
                        //     'title': 'SUCCESS',
                        //     'text': 'Data has been Re-Calcualted'
                        // });
                        alert("Re-Calculate Success")
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
            eventPreviewFilter()
            eventRecalculate()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    GeneralLedger().init()
    GeneralLedger().events()
})()