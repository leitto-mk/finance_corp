/*
/*
 *  CORE SCRIPT
*/
const balanceSheet = () => {
    /**
     ** Get URL Param as Select Options Value
     */
    const initGetURLParamAsFilter = () => {
        var urlParams = new URLSearchParams(window.location.search)

        $('#branch').val(urlParams.get('branch'))
        $('#year').val(urlParams.get('year'))
        $('#month').val(urlParams.get('month'))
    }

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

    const eventSubmitFilter = () => {
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
            initGetURLParamAsFilter()
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