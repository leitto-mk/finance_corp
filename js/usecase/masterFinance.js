/*
 *  CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const _callable = {
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
                $("#modal-finance").find(".modal-title").text(response.result.title)
                $("#modal-finance").find(".modal-body").html(response.result.body)

                let base_url = window.location.origin
                $("#modal-finance").find("#action-submit, #action-delete").attr("data-unique", id)
                $("#modal-finance").find("#action-submit").attr("data-type", type)
                $("#modal-finance").find("#action-submit").attr("data-submit", `${base_url}/C_Finance/submit_coa`)
                $("#modal-finance").find("#action-submit").attr("data-table-url", `${base_url}/C_Finance/get_coa_content`)

                let element = $(document).find('#coa_type')
                helper.setSelect2(element, {width: 'auto'})
            }else{
                Swal.fire({
                    'icon': 'error',
                    'title': 'ERROR',
                    'html': `<h4 class="sbold">${response.desc}</h4>`
                })
            }
        })
        .fail(err => {
            helper.unblockUI()

            Swal.fire({
                'icon': 'error',
                'title': 'ERROR',
                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
            })

            return null
        })
    }
}

const mfin = {
    coa: {
        eventOpenModalNewHeading: () => {
            $("#btn-new-heading").on("click", function () {
                _callable.createModal(null, 'head')
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
                    
                    _callable.createModal(id, type)
                },
                onCancel: function () {
                    const id = $(this).attr("data-unique")
                    const type = "child"

                    _callable.createModal(id, type)
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
                    $('#modal-finance').modal('hide')

                    if(response.success) {
                        Swal.fire({
                            'icon': 'success',
                            'title': 'SUCCESS',
                            'html': `Heading has been submited`
                        })

                        location.reload()
                    }else{
                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${response.desc}</h4>`
                        })
                    }
                })
                .fail(err => {
                    helper.unblockUI()

                    Swal.fire({
                        'icon': 'error',
                        'title': 'ERROR',
                        'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
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
                    $('#modal-finance').modal('hide')

                    if(response.success){
                        Swal.fire({
                            'icon': 'success',
                            'title': 'SUCCESS',
                            'html': 'Heading has been deleted successfully'
                        })

                        location.reload()
                    }else{
                        Swal.fire({
                            'icon': 'error',
                            'title': 'ERROR',
                            'html': `<h4 class="sbold">${response.desc}</h4>`
                        })
                    }
                })
                .fail(err => {
                    helper.unblockUI()

                    Swal.fire({
                        'icon': 'error',
                        'title': 'ERROR',
                        'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
                    })
                })
            })
        }
    },
}

export default mfin