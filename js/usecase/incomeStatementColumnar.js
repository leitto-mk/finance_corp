/*
 *  CORE SCRIPT
*/

const icsc = {
    eventChangeOption: () => {
        $(document).on('change','#branch, #year, #month',function(){
            let branch = $('#branch').val()
            let year = $('#year').val()

            //Empty before re-fill the address
            $('#submit_filter').attr('href',null)

            let addr = `${location.href}?branch=${branch}&year=${year}`

            $('#submit_filter').attr('href', addr)
        })
    },

    eventSubmitFilter: () => {
        $('#submit_filter').click(function(e){
            let branch = $('#branch').val()
            let year = $('#year').val()

            if (branch == "" || year == "") {
                alert('Please Select All Options')
                
                e.preventDefault()
                return
            }
        })
    },
}

export default icsc