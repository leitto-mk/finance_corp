import {
	get_supplier,
	create_select2,
	get_storage,
	get_currency,
	validation,
	event_validation_check,
} from "../sales_order/main.js";

import { get_cost_center, get_stockcode } from "../direct_purchase/main.js";

import {
	action_add_row,
	discount_event,
	freight_event,
	payment_discount_event,
	payment_tax_event,
	price_event,
	qty_event,
	action_delete_row,
	reset_form,
	get_doc_no,
} from "./main.js";

$(document).on("ready", function () {
	event_validation_check();
	action_add_row();
	action_delete_row();
	qty_event();
	price_event();
	discount_event();
	payment_discount_event();
	payment_tax_event();
	freight_event();

	get_supplier($("#po_supplier"), create_select2, "Select Supplier");
	get_storage($("#po_ship_to"), create_select2, "Select Storage");
	get_stockcode($(".po-stockcode"), create_select2, "Select Stockcode");
	get_currency($(".po-currency"), create_select2, "Select Currency");
	get_cost_center($("#po_cost_center"), create_select2, "Select Cost Center");

	$("#checkbox_po_no").on("change", function (e) {
		e.preventDefault();

		const selector = $("#po_no");
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

	$("#po_term_days").on("change", function (e) {
		const raised_date = $("#po_raised_date").val();
		const term = parseInt($("#po_term_days").val());

		if (term) {
			const due_date = new Date(raised_date);
			due_date.setDate(due_date.getDate() + term);

			const string_due_date = `${due_date.getFullYear()}-${(
				"0" +
				(due_date.getMonth() + 1)
			).slice(-2)}-${("0" + due_date.getDate()).slice(-2)}`;

			$("#po_due_date").val(string_due_date);
		} else {
			$("#po_due_date").val(null);
		}
	});

	$(document).on(
		"click",
		'#form-purchase-order button[type="reset"]',
		function (e) {
			e.preventDefault();
			reset_form();
		}
	);

	$(document).on("submit", "#form-purchase-order", function (e) {
		e.preventDefault();

		const _formData = new FormData(this);

		$.ajax({
			type: "POST",
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			data: _formData,
			url: `${site_url}/abc/purchase/purchase_order`,
			beforeSend: function (e) {
				$("#form-purchase-order")
					.find('button[type="submit"]')
					.attr("disabled", true);
			},
			success: function (result) {
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
			complete: function (e) {
				$("#form-purchase-order")
					.find('button[type="submit"]')
					.attr("disabled", false);
			},
		});
	});

	$(document).on("blur", "#po_bill_to", function (e) {
		$("#po_ship_to").select2("open");
	});

	$(document).on("select2:close", "#po_ship_to", function (e) {
		$("#po_freight").focus().select();
	});

	$(document).on("select2:close", "#po_supplier", function (e) {
		$("#po_no_ref").focus().select();
	});

	$(document).on("select2:close", ".po-stockcode", function (e) {
		e.preventDefault();

		const uom = $(this).select2("data")[0].uom;
		const currency = $(this).parents("tr").find(".po-currency");
		const stockcode = $(this).val();

		const check_stockcode = $(document).find(
			`._po_stockcode[value='${stockcode}']`
		);

		if (check_stockcode.length > 0) {
			$(this).val(null).trigger("change");
			check_stockcode.parents("tr").find(".po-qty").focus().select();
		} else {
			$(this).parents("tr").find(".po-uom").val(uom);
			$(this).parents("tr").find("._po_stockcode").val(stockcode);
			if (currency.val()) {
				$(this).parents("tr").find(".po-qty").focus().select();
			} else {
				currency.select2("open");
			}
		}
	});

	$(document).on("select2:close", ".po-currency", function (e) {
		e.preventDefault();
		$(this).parents("tr").find(".po-qty").focus().select();
	});

	$(document).on("click", "#action-regenerate-id", function (e) {
		e.preventDefault();
		get_doc_no();
	});
});
