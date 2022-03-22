/*
 *  CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const callable = {
    createModal: (id, type) => {
        $('#modal-finance').modal('show')
        $("#modal-finance").find(".modal-body").empty()

        if(type == 'head'){
            $('#modal-finance').find('#action-delete').hide()
        }else{
            $('#modal-finance').find('#action-delete').show()
        }

        repository.getRecord('C_Finance/get_form', {id, type})
        .then(response => {
            helper.unblockUI()

            if(response.success){
                $("#modal-finance").find(".modal-title").text("Create New Heading")
                $("#modal-finance").find(".modal-body").html(response.result.body)

                $("#modal-finance").find("#action-submit, #action-delete").attr("data-unique", id)
                $("#modal-finance").find("#action-submit").attr("data-type", type)
                $("#modal-finance").find("#action-submit").attr("data-submit", 'C_Finance/submit_coa')
                $("#modal-finance").find("#action-submit").attr("data-table-url", 'C_Finance/get_coa_content')

                let element = $(document).find('#coa_type')
                helper.select2(element, response.result.acc_types, null)
            }else{
                Swal.fire({
                    'type': 'error',
                    'title': 'ERROR',
                    'html': `<h4 class="sbold">${response.desc}</h4>`
                })
            }
        })
        .fail(err => {
            helper.unblockUI()

            Swal.fire({
                'type': 'error',
                'title': 'ERROR',
                'html': `<h4 class="sbold">${err.desc}</h4>`
            })

            return null
        })
    }
}

const mas = {
    operation: () => {},
    supply: () => {},
    finance: {
        coa: {
            eventOpenModalNewHeading: () => {
                $("#btn-new-heading").on("click", function () {
                    callable.createModal(null, 'head')
                });
            },

            eventEditHeading: () => {
                $(document).find("#table-coa>tbody>tr").confirmation({
                    title: "Create Child ?",
                    btnOkLabel: "Edit",
                    btnOkIcon: "fa fa-pencil",
                    btnOkClass: "btn btn-sm green",
                    btnCancelLabel: "New Child",
                    btnCancelIcon: "fa fa-plus",
                    btnCancelClass: "btn btn-sm blue",
                    singleton: true,
                    popout: true,
                    onConfirm: function () {
                        const id = $(this).attr("data-unique")
                        const type = "edit"
                        
                        callable.createModal(id, type)
                    },
                    onCancel: function () {
                        const id = $(this).attr("data-unique")
                        const type = "child"

                        callable.createModal(id, type)
                    },
                })
            },

            eventSubmitNewHeading: () => {
                $("#form-finance").on("submit", function (e) {
                    e.preventDefault();
            
                    const data = $('#form-finance').serializeArray();
                    data.push({name: 'id', value: $(this).find('#action-submit').attr('data-unique')});
                    data.push({name: 'type', value: $(this).find('#action-submit').attr('data-type')});
            
                    repository.submitRecord('C_Finance/submit_coa', data)
                    .then(response => {
                        helper.unblockUI()
                        $('modal-finance').modal('hide')

                        if(response.success) {
                            Swal.fire({
                                'type': 'success',
                                'title': 'SUCCESS',
                                'html': `Heading has been submited`
                            })

                            location.reload()
                        }else{
                            Swal.fire({
                                'type': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${response.desc}</h4>`
                            })
                        }
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'type': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err.desc}</h4>`
                        })
                    })
                })
            },

            eventDeleteHeading: () => {
                $(document).on('click','#action-delete', function(){
                    const unique = $(this).attr('data-unique')

                    repository.deleteRecord('C_Finance/delete_account', {unique})
                    .then(response => {
                        helper.unblockUI()

                        if(response.success){
                            Swal.fire({
                                'type': 'success',
                                'title': 'SUCCESS',
                                'html': 'Heading has been deleted successfully'
                            })
                        }else{
                            Swal.fire({
                                'type': 'error',
                                'title': 'ERROR',
                                'html': `<h4 class="sbold">${response.desc}</h4>`
                            })
                        }
                    })
                    .fail(err => {
                        helper.unblockUI()

                        Swal.fire({
                            'type': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${err.desc}</h4>`
                        })
                    })
                })
            }
        },
    },
}

export default mas