/*
 * CORE SCRIPT
*/

import repository from '../repository/repository.js'
import helper from '../helper.js'

const inv = {
    dashboardPage: {
        generateDataTable: () => {
            $("#table-approval").DataTable({
                destroy: true,
                serverSide: true,
                searching: false,
                info: false,
                lengthMenu: [30, 50, 100, 300],
                pagingType: "bootstrap_extended",
                ajax: {
                    type: "GET",
                    url: `Invoice/get_approval`,
                    dataSrc: ""
                },
                columnDefs: [
                    {
                        targets: 0,
                        className: "text-center",
                        orderable: false,
                        data: "ID",
                        render: function (data, type, row) {
                            return `
                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes" value="${data}" data-type="${row.Type}" />
                                <span></span>
                        </label>
                        `;
                        },
                    },
                    { targets: 1, data: "DocNo" },
                    { targets: 2, data: "Customer" },
                    { targets: 3, data: "InvoiceDate", className: "text-center" },
                    { targets: 4, data: "PaymentDue", className: "text-center" },
                    {
                        targets: 5,
                        data: "Amount",
                        className: "text-right",
                        render: function (data, type, row) {
                            return new Intl.NumberFormat('en', {
                                style: "currency",
                                currency: "USD",
                            }).format(data);
                        },
                    },
                    {
                        targets: 6,
                        data: "Paid",
                        className: "text-right",
                        render: function (data, type, row) {
                            return new Intl.NumberFormat('en', {
                                style: "currency",
                                currency: "USD",
                            }).format(data);
                        },
                    },
                    {
                        targets: 7,
                        data: "Balance",
                        className: "text-right",
                        render: function (data, type, row) {
                            return new Intl.NumberFormat('en', {
                                style: "currency",
                                currency: "USD",
                            }).format(data);
                        },
                    },
                    {
                        targets: 8,
                        orderable: false,
                        className: "text-center",
                        render: function (data, type, row) {
                            return `
                            <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Detail">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Delete">
                                <i class="fa fa-close"></i>
                            </a>`;
                        },
                    },
                    { targets: 9, data: "CustomerGroup", visible: false },
                ]
            });
        }
    },

    formPage: {
        initInputMask: () => {
            //Order List
            let unit = $(document).find('input[name="qty[]"]')
            let amount = $(document).find('input[name="price[]"]')
            let disc = $(document).find('input[name="discount[]"]')
            let total = $(document).find('input[name="total[]"]')
            helper.setInputMask(unit, "currency")
            helper.setInputMask(amount, "currency")
            helper.setInputMask(disc, "currency")
            helper.setInputMask(total, "currency")
            
            //Payment
            let pay_subtotal = $(document).find('#payment_sub_total')
            let pay_disc = $(document).find('#payment_discount')
            let pay_net_subtotal = $(document).find('#payment_net_subtotal')
            let pay_vat = $(document).find('#payment_vat')
            let pay_pph = $(document).find('#payment_pph')
            let pay_freight = $(document).find('#payment_freight')
            let pay_total_amount = $(document).find('#payment_total_amount')
            helper.setInputMask(pay_subtotal, "currency")
            helper.setInputMask(pay_disc, "currency")
            helper.setInputMask(pay_net_subtotal, "currency")
            helper.setInputMask(pay_vat, "currency")
            helper.setInputMask(pay_pph, "currency")
            helper.setInputMask(pay_freight, "currency")
            helper.setInputMask(pay_total_amount, "currency")
        },

        eventGetTermsOfDay: () => {
            $(document).on('change','#raised_date, #due_date', function(){
                let raised_date = $('#raised_date').val()
                let due_date = $('#due_date').val()

                let start = moment(raised_date,'YYYY-MM-DD')
                let end = moment(due_date,'YYYY-MM-DD')

                let duration = moment.duration(end.diff(start)).asDays();

                duration > 0 ? $('#term_days').val(`${duration} Days`) : $('#term_days').val('')
            })
        },
        
        eventAddRow: () => {
            $('#add_row').click(function(){
                let row = $('#tbody_invoice tr:last-child').clone()

                //Set Default Value
                let item_no = +row.find('td:first-child a').text()
                row.find('td:first-child a').text(item_no + 1)
                row.find('[name="stockcode[]"]').val('')
                row.find('[name="uom[]"]').val('')
                row.find('[name="currency[]"]').val('')
                row.find('[name="qty[]"]').val(0)
                row.find('[name="price[]"]').val(0)
                row.find('[name="discount[]"]').val(0)
                row.find('[name="total[]"]').val(0)
                
                $('#tbody_invoice').append(row)

                //Re-Initiated Input Mask
                let unit = $(document).find('input[name="qty[]"]')
                let amount = $(document).find('input[name="price[]"]')
                let disc = $(document).find('input[name="discount[]"]')
                let total = $(document).find('input[name="total[]"]')
                helper.setInputMask(unit, "currency")
                helper.setInputMask(amount, "currency")
                helper.setInputMask(disc, "currency")
                helper.setInputMask(total, "currency")
            })
        },

        eventChagePaymentMethod: () => {
            $('[name="dp_payment_type"]').change(function(){
                if($(this).val() == 'cash'){
                    $('#dp_payment_card_text').prop('disabled', true).val('')
                    $('#dp_payment_bank').prop('disabled', true).val('')
                }else{
                    $('#dp_payment_card_text').prop('disabled', false)
                    $('#dp_payment_bank').prop('disabled', false)
                }
            })
        },

        eventDeleteRow: () => {
            $(document).on('click','[name="item_no"]',function(){
                if(!confirm('Are you sure you want to delete this row ?')){
                    return
                }

                var total = $('#tbody_invoice').children('tr').length
                if(total <= 1){
                    return
                }
    
                $(this).parents('tr').remove()
    
                var index = 0
                $('#tbody_invoice [name="item_no"]').each(function(){
                    $(this).text(index+1)
    
                    ++index
                })
            })
        },

        submitInvoice: () => {
            $('form').submit(function(e){
                e.preventDefault()

                let formData = $(this).serializeArray()

                repository.submitRecord('submit_invoice', formData)
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

export default inv