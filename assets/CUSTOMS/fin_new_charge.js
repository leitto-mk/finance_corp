/*
 *  CORE SCRIPT
*/
const fin_new_charge = () => {
    //GLOBAL VAR
    var GLOBAL_STD_DATA //STORE STD DATA FROM AJAX SCHOOL PARAM
    
    //SCHOOL PARAM EVENTS
    const eventSchoolParameter = () => {
        $('#school').change(function(){
            if($(this).val()){
                $('#room').prop('disabled', false)
                $('#cls').prop('disabled', false)
                // $('#std').prop('disabled', false)

                $('#room').val('')
                $('#cls').val('')
                $('#std').val('')
            }else{
                $('#room').prop('disabled', true)
                $('#cls').prop('disabled', true)
                // $('#std').prop('disabled', true)
            }

            var sch = $(this).val()

            $.ajax({
                url: 'ajax_get_cls_list',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    sch
                },
                success: response => {
                    $('#cls').empty()
                    $('#cls').append('<option value="">--Select--</option>')

                    GLOBAL_STD_DATA = response.std

                    for(let i = 0; i < response.cls.length; i++){
                        $('#cls').append(`<option value="${response.cls[i].ClassDesc}">${response.cls[i].ClassDesc}</option>`)
                    }

                    for(let i = 0; i < response.std.length; i++){
                        $('#std').append(`<option value="${response.std[i].IDNumber}">${response.std[i].FullName}</option>`)
                    }

                    $('#std').selectpicker('refresh')
                },
                error: () => alert('NETWORK PROBLEM')
            })
        })

        $('#cls').change(function(){
            var sch = $('#school').val()
            var cls = $(this).val()

            $.ajax({
                url: 'ajax_get_room_list',
                method: 'POST',
                dataType: 'JSON',
                async: false,
                data: {
                    sch,
                    cls
                },
                success: response => {
                    $('#room, #std').empty()
                    $('#room').append('<option value="">--Select--</option>')

                    GLOBAL_STD_DATA = response.std

                    for(let i = 0; i < response.room.length; i++){
                        $('#room').append(`<option value="${response.room[i].RoomDesc}">${response.room[i].RoomDesc}</option>`)
                    }

                    for(let i = 0; i < response.std.length; i++){
                        $('#std').append(`<option value="${response.std[i].IDNumber}">${response.std[i].FullName}</option>`)
                    }

                    $('#std').selectpicker('refresh')
                },
                error: () => alert('NETWORK PROBLEM')
            })
        })

        $('#room').change(function(){
            var sch = $('#school').val()
            var cls = $('#cls').val()
            var room = $(this).val()

            $.ajax({
                url: 'ajax_get_std_list',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    sch,
                    cls,
                    room
                },
                success: response => {
                    $('#std').empty()

                    GLOBAL_STD_DATA = response

                    for(let i = 0; i < response.length; i++){
                        $('#std').append(`<option value="${response[i].IDNumber}">${response[i].FullName}</option>`)
                    }

                    $('#std').selectpicker('refresh')
                },
                error: () => alert('NETWORK PROBLEM')
            })
        })

    }
    
    //PREVIEW DATA TO CHARGE TABLE VIEW
    const eventPreviewList = () => {
        $('#submit_parameter').click(function(e){
            e.preventDefault()
            
            $('#tbody_charge').empty()

            var year = $('#year').val()
            var month_start = +$('#monthstart').val()
            var month_finish = +$('#monthfinish').val()
            var charge_type = $('#chargetype').val()
            var arr_selected_nis = $('#std').val()
            
            var totalamount = 0

            $.ajax({
                url: 'ajax_get_charge_type_matrix',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    charge: charge_type,
                    std: arr_selected_nis
                },
                success: response => {
                    for(let i = 0; i < response.length; i++){
                        response[i].FullName = GLOBAL_STD_DATA.find(x => x.IDNumber == response[i].IDNumber).FullName
                        response[i].Room = GLOBAL_STD_DATA.find(x => x.IDNumber == response[i].IDNumber).Ruangan
                    }

                    arr_selected_nis = response
                },
                error: () => alert('NETWORK PROBLEM')
            }).then(() => {
                let count = 1
                for(let i = 0; i < arr_selected_nis.length; i++){
                    for(let j = month_start; j <= month_finish; j++){
                        totalamount += +(arr_selected_nis[i].Amount)
                        $('#tbody_charge').append(
                            `<tr>
                                <td class="sbold font-white">
                                    ${count}
                                </td>
                                <td class="sbold uppercase text-center">
                                    <input readonly name="year[]" class="text-center" value="${year}"/>
                                </td>
                                <td class="sbold uppercase text-center">
                                    <input readonly name="month[]" class="text-center" value="${j}"/>
                                </td>
                                <td class="sbold text-center">
                                    <input readonly name="nis[]" class="text-center" value="${arr_selected_nis[i].IDNumber}"/>
                                </td>
                                <td class="sbold">
                                    <input readonly name="fullname[]" value="${arr_selected_nis[i].FullName}"/>
                                </td>
                                <td class="sbold text-center">
                                    <input readonly name="room[]" class="text-center" value="${arr_selected_nis[i].Room}"/>
                                </td>
                                <td class="sbold text-center">
                                    <input readonly name="chargetype[]" class="text-center" value="${charge_type}"/>
                                </td>
                                <td class="sbold text-center">
                                    <input readonly name="amount[]" class="text-right" value="${arr_selected_nis[i].Amount}"/>
                                </td>
                             </tr>`
                        )
    
                        count += 1
                    }
                }
    
                $('#totalamount').val('Rp ' + Intl.NumberFormat('en').format(totalamount))
            })
        })
    }

    //SUBMIT PREVIEWED CHARGES
    const eventSubmitCharge = () => {
        $('#submit_charge').click(function(){
            //MASTER DATA
            let docno = $('#docno').val()
            let year = $('#year').val()
            let monthstart = $('#monthstart').val()
            let monthfinish = $('#monthfinish').val()
            let submitby = $('#submitby').val()
            let transdate = $('#transdate').val()
            let accno = $('#accno').val()
            let chargetype = $('#chargetype').val()
            let remarks = $('#remarks').val()
            let school = $('#school').val()
            let cls = $('#cls').val()
            let room = $('#room').val()

            //STD DETAILS
            let details = $('#form_details_charge').serialize()

            $.ajax({
                url: `ajax_submit_std_charge?docno=${docno}&year=${year}&monthstart=${monthstart}&monthfinish=${monthfinish}&submitby=${submitby}&transdate=${transdate}&accno=${accno}&chargetype=${chargetype}&remarks=${remarks}&school=${school}&cls=${cls}&room=${room}`,
                method: 'POST',
                data: details,
                success: response => {
                    if(response == 'success'){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'text': 'CHARGE HAS BEEN SUBMITTED'
                        })

                        location.reload()
                    }else if(response == 'DATA_DUPLICATE'){
                        Swal.fire({
                            'type': 'error',
                            'title': 'ABORTED',
                            'text': 'CURRENT CHARGE IS ALREADY ENLISTED'
                        })
                    }else{
                        alert('SERVER PROBLEM')
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
            eventSchoolParameter()
            eventPreviewList()
            eventSubmitCharge()
        }
    }
}

/* INITIALIZE CORE SCRIPT */
(function(){
    fin_new_charge().init()
    fin_new_charge().events()
})()