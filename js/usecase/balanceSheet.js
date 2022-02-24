/*
 *  CORE SCRIPT
*/

const bal = {
    indexPage: {
        /**
         ** Get URL Param as Select Options Value
         */
        initGetURLParamAsFilter: () => {
            var urlParams = new URLSearchParams(window.location.search)
    
            $('#branch').val(urlParams.get('branch'))
            $('#year').val(urlParams.get('year'))
            $('#month').val(urlParams.get('month'))
        },
    
        eventChangeOption: () => {
            $(document).on('change','#branch, #year, #month',function(){
                let branch = $('#branch').val()
                let year = $('#year').val()
                let month = $('#month').val()
    
                //Empty before re-fill the address
                $('#submit_filter').prop('href',null)
    
                let addr = `${location.href}?branch=${branch}&year=${year}&month=${month}`
    
                window.history.pushState({}, document.title, `/Entry/view_balance_sheet`);
    
                $('#submit_filter').attr('href', addr)
            })
        },
    
        eventSubmitFilter: () => {
            $('#submit_filter').click(function(e){
                let branch = $('#branch').val()
                let year = $('#year').val()
                let month = $('#month').val()
    
                if (branch == "" || year == "" || month == "") {
                    alert('Please Select All Options')
                    
                    e.preventDefault()
                    return
                }
            })
        },
    }
}

export default bal