import {
	get_customer,
	get_storage,
	get_stockcode,
	get_currency,
	create_select2,
	action_add_row,
	action_delete_row,
	qty_event,
	price_event,
	discount_event,
	payment_discount_event,
	payment_tax_event,
	freight_event,
	event_validation_check,
	validation,
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

	setTimeout(() => {
		$("#so_customer")
			.val($("#so_customer").attr("data-value"))
			.trigger("change");
		$("#so_storage").val($("#so_storage").attr("data-value")).trigger("change");
		$(".so-stockcode").each(function () {
			const data_value = $(this).attr("data-value");
			$(this).val(data_value).trigger("change");
		});
		$(".so-currency").each(function () {
			const data_value = $(this).attr("data-value");
			$(this).val(data_value).trigger("change");
		});
	}, 500);

	$(document).on("submit", "#form-sales-order", function (e) {
		e.preventDefault();

		const _formData = new FormData(this);
		const id = $(this).attr("data-id");

		$.ajax({
			type: "POST",
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			data: _formData,
			url: `${site_url}/abc/sales/sales_order/update/${id}`,
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
						location.reload();
					}, 2000);
				}
			},
			error: function (e) {
				alert("Something went wrong! Please contact our administrator");
				$("#form-sales-order")
					.find('button[type="submit"]')
					.attr("disabled", false);
			},
		});
	});

	$(document).on("select2:close", ".so-stockcode", function (e) {
		e.preventDefault();

		const uom = $(this).select2("data")[0].uom;
		const currency = $(this).parents("tr").find(".so-currency");

		$(this).parents("tr").find(".so-uom").val(uom);
		if (currency.val()) {
			$(this).parents("tr").find(".so-qty").focus().select();
		} else {
			currency.select2("open");
		}
	});

	$(document).on("select2:close", ".so-currency", function (e) {
		e.preventDefault();
		$(this).parents("tr").find(".so-qty").focus().select();
	});

	$(document).on("select2:close", "#so_customer", function (e) {
		e.preventDefault();
		$("#so_no_ref").focus().select();
	});

	$(document).on("select2:close", "#so_storage", function (e) {
		e.preventDefault();
		$("#so_freight").focus().select();
	});
});
