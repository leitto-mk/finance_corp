/*
/*
 *  CORE SCRIPT
*/
var IncomeStatementColumnar = () => {
    const eventChangeOption = () => {
        var branch, year

        $(document).on('change','#branch, #year, #month',function(){
            branch = $('#branch').val()
            year = $('#year').val()

            //Empty before re-fill the address
            $('#submit_filter').attr('href',null)

            let addr = `${location.href}?branch=${branch}&year=${year}`

            $('#submit_filter').attr('href', addr)
        })
    }

    eventSubmitFilter = () => {
        $('#submit_filter').click(function(e){
            branch = $('#branch').val()
            year = $('#year').val()

            if (branch == "" || year == "") {
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
    IncomeStatementColumnar().init()
    IncomeStatementColumnar().events()
})()