import {
	get_customer,
	get_storage,
	get_stockcode,
	get_currency,
	create_select2,
	action_add_row,
	reset_form,
	action_delete_row,
	qty_event,
	price_event,
	discount_event,
	payment_discount_event,
	payment_tax_event,
	freight_event,
	event_validation_check,
	validation,
	get_price,
} from "./main.js";

$(document).on("ready", function () {
	action_add_row();
	action_delete_row();
	qty_event();
	price_event();
	discount_event();
	payment_discount_event();
	payment_tax_event();
	freight_event();
	event_validation_check();
	get_customer($("#so_customer"), create_select2, "Select Customer");
	get_storage($("#so_storage"), create_select2, "Select Storage");
	get_stockcode($(".so-stockcode"), create_select2, "Select Stockcode");
	get_currency($(".so-currency"), create_select2, "Select Currency");
	get_customer($("#so_bill_to"), create_select2, "Select Customer");

	$("#checkbox_so_no").on("change", function (e) {
		e.preventDefault();

		const selector = $("#so_no");
		const docno = selector.attr("data-no");

		selector.prop("readonly", function (i, v) {
			if (v === false) {
				selector.val(docno);
			} else {
				selector.val(null);
			}
			return !v;
		});
	});

	$(document).on("submit", "#form-sales-order", function (e) {
		e.preventDefault();

		const _formData = new FormData(this);

		$.ajax({
			type: "POST",
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			data: _formData,
			url: `${site_url}/abc/sales/sales_order`,
			beforeSend: function (e) {
				$("#form-sales-order")
					.find('button[type="submit"]')
					.attr("disabled", true);
			},
			success: function (result) {
				$("#form-sales-order")
					.find('button[type="submit"]')
					.attr("disabled", false);
				if (result.error) {
					if (result.status == "validation_error") {
						validation(result.message);
					}
				} else if (result.success) {
					swal({
						type: "success",
						title: `${result.message}`,
						showConfirmButton: false,
					});
					setTimeout(function () {
						swal.close();
					}, 1500);
					setTimeout(function () {
						reset_form();
					}, 2000);
				}
			},
			error: function (e) {
				alert("Something went wrong! Please contact our administrator");
			},
		});
	});

	$(document).on("select2:close", ".so-stockcode", function (e) {
		e.preventDefault();

		const uom = $(this).select2("data")[0].uom;
		const currency = $(this).parents("tr").find(".so-currency");
		const stockcode = $(this).val();
		const customer = $("#so_customer").val();
		const storage = $("#so_storage").val();

		$(this).parents("tr").find(".so-uom").val(uom);
		if (currency.val()) {
			$(this).parents("tr").find(".so-qty").focus().select();
		} else {
			currency.select2("open");
		}

		const price = get_price(stockcode, customer, storage);
		$(this).parents("tr").find(".so-price").val(price).trigger("input");
		$(this).parents("tr").find(".so-qty").val(1).trigger("input");
	});

	$(document).on("select2:close", ".so-currency", function (e) {
		e.preventDefault();
		$(this).parents("tr").find(".so-qty").focus().select();
	});

	$(document).on("select2:close", "#so_customer", function (e) {
		e.preventDefault();
		$("#so_no_ref").focus().select();

		const value = $(this).val();
		$("#so_bill_to").val(value).trigger("change");
	});

	$(document).on("select2:close", "#so_storage", function (e) {
		e.preventDefault();
		$("#so_freight").focus().select();
	});

	$(document).on("change", "#so_term_days", function (e) {
		const raised_date = $("#so_raised_date").val();
		const term = parseInt($("#so_term_days").val());

		if (term) {
			const due_date = new Date(raised_date);
			due_date.setDate(due_date.getDate() + term);

			const string_due_date = `${due_date.getFullYear()}-${(
				"0" +
				(due_date.getMonth() + 1)
			).slice(-2)}-${("0" + due_date.getDate()).slice(-2)}`;

			$("#so_due_date").val(string_due_date);
		} else {
			$("#so_due_date").val(null);
		}
	});
});
