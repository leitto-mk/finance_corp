/*
/*
 *  CORE SCRIPT
*/
var balanceSheet = () => {
    const eventChangeOption = () => {
        var branch, year, month

        $(document).on('change','#branch, #year, #month',function(){
            branch = $('#branch').val()
            year = $('#year').val()
            month = $('#month').val()

            //Empty before re-fill the address
            $('#submit_filter').attr('href',null)

            let addr = `${location.href}?branch=${branch}&year=${year}&month=${month}`

            window.history.pushState({}, document.title, `/FinanceCorp/view_balance_sheet`);

            $('#submit_filter').attr('href', addr)
        })
    }

    eventSubmitFilter = () => {
        $('#submit_filter').click(function(e){
            branch = $('#branch').val()
            year = $('#year').val()
            month = $('#month').val()

            if (branch == "" || year == "" || month == "") {
                alert('Please Select All Options')
                
                e.preventDefault()
                return
            }
        })
    }

    return {
        init: () => {
            //NO INIT FUNCTION FOR THIS SCRIPT
        },
        events: () => {
            eventChangeOption()
            eventSubmitFilter()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    balanceSheet().init()
    balanceSheet().events()
})()