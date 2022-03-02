/*
 * Core Script
*/

import helper from '../helper.js'
import repository from '../repository/repository.js';

const bal = {
    indexPage: {
        eventRecalculateBranch: () => {
            $('#calculate_branch').click(function(){
                var branch = $('#param_branch #branch').val()
                var accno_start = +$('#param_branch #accno_start').val()
                var accno_finish = +$('#param_branch #accno_finish').val()
                var date_start = $('#param_branch #date_start').val()
    
                if(!branch || !accno_start || !accno_finish || !date_start){
                    alert("Please select all filter first")
                    return
                }
                
                if(accno_start > accno_finish){
                    alert('Account Number Start must be higher or equal!')
                    return
                }
    
                repository.getRecord('ajax_recalculate_branch', {
                    branch,
                    accno_start,
                    accno_finish,
                    date_start
                })
                .then(response => {
                    helper.unblockUI()

                    if(response.success){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'html': 'Data has been Re-Calcualted'
                        });
                    }else{
                        Swal.fire({
                            'type': 'error',
                            'title': 'ABORTED',
                            'html': response.desc
                        })
                    }
                })
                .fail(err => {
                    helper.unblockUI()

                    Swal.fire({
                            'type': 'error',
                            'title': 'ABORTED',
                            'html': `<h4 class="sbold">${err.desc}</h4>`
                    })
                })
            })
        },

        eventRecalculateEmployee: () => {
            $('#calculate_emp').click(function(){
                var employee = $('#param_emp #employee').val()
                var date_start = $('#param_branch #date_start').val()
    
                if(!employee || !date_start){
                    alert("Please select all filter first")
                    return
                }

                repository.getRecord('ajax_recalculate_employee', {
                    employee,
                    date_start,
                })
                .then(response => {
                    helper.unblockUI()
    
                    if(response.success){
                        Swal.fire({
                            'type': 'success',
                            'title': 'SUCCESS',
                            'html': 'Data has been Re-Calcualted'
                        });
                    }else{
                        Swal.fire({
                            'type': 'error',
                            'title': 'ABORTED',
                            'html': response.desc
                        })
                    }
                })
                .fail(err => {
                    helper.unblockUI()
    
                    Swal.fire({
                            'type': 'error',
                            'title': 'ABORTED',
                            'html': `<h4 class="sbold">${err.desc}</h4>`
                    })
                })
            })
        }
    }
}

export default bal