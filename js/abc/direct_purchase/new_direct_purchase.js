import {
	event_validation_check,
	validation,
	get_bank,
} from "../sales_order/main.js";

import {
	action_delete_row,
	get_supplier,
	get_storage,
	get_stockcode,
	get_currency,
	action_add_row,
	create_select2,
	qty_event,
	price_event,
	discount_event,
	payment_discount_event,
	payment_tax_event,
	freight_event,
	get_doc_no,
	reset_form,
	get_cost_center,
} from "./main.js";

$(document).on("ready", function (e) {
	action_add_row();
	action_delete_row();
	event_validation_check();
	qty_event();
	price_event();
	discount_event();
	payment_discount_event();
	payment_tax_event();
	freight_event();

	get_supplier($("#dp_supplier"), create_select2, "Select Supplier");
	get_storage($("#dp_ship_to"), create_select2, "Select Storage");
	get_stockcode($(".dp-stockcode"), create_select2, "Select Stockcode");
	get_currency($(".dp-currency"), create_select2, "Select Currency");
	get_cost_center($("#dp_cost_center"), create_select2, "Select Cost Center");

	$("#checkbox_dp_no").on("change", function (e) {
		e.preventDefault();

		const selector = $("#dp_no");
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

	$(document).on("submit", "#form-direct-purchase", function (e) {
		e.preventDefault();

		const _formData = new FormData(this);

		swal(
			{
				title: "<strong>Confirmation</strong>",
				text: `<strong>These Data Will be Recorded!</strong> Continue?`,
				type: "warning",
				showCancelButton: true,
				closeOnCancel: false,
				closeOnConfirm: false,
				confirmButtonText: "Continue, Submit",
				cancelButtonText: "No, I Need to Check Again",
				confirmButtonClass: "yellow-casablanca",
				cancelButtonClass: "blue-chambray btn-outline",
				html: true,
				showLoaderOnConfirm: true,
			},
			function (isConfirm) {
				if (isConfirm) {
					swal.close();
					setTimeout(() => {
						const grand_total = $("#dp_payment_grand_total").val();
						const payment_type = $('[name="dp_payment_type"]:checked').val();
						swal(
							{
								title: `<strong>${payment_type.toUpperCase()}</strong>`,
								text: `Grand Total<br><h1 style="margin-top:5px;"><strong>${grand_total}</strong></h1>`,
								type: "input",
								showCancelButton: true,
								closeOnConfirm: false,
								confirmButtonText: "Pay",
								confirmButtonClass: "yellow-casablanca",
								cancelButtonClass: "blue-chambray btn-outline",
								inputType: "number",
								html: true,
							},
							function (inputValue) {
								if (inputValue === false) return false;
								if (inputValue === "") {
									swal.showInputError("Oops!");
									return false;
								}
								_formData.append("dp_payment_total_paid", inputValue);

								$.ajax({
									type: "POST",
									dataType: "JSON",
									contentType: false,
									cache: false,
									processData: false,
									data: _formData,
									url: `${site_url}/purchase/direct_purchase`,
									beforeSend: function (e) {
										$("#form-direct-purchase")
											.find('button[type="submit"]')
											.attr("disabled", true);
									},
									success: function (result) {
										if (result.error) {
											if (result.status == "validation_error") {
												swal.close();
												setTimeout(() => {
													swal({
														type: "error",
														title: `Oops!`,
														text: `You forgot to input some data`,
													});
													validation(result.message);
												}, 500);
											}
										} else if (result.success) {
											setTimeout(function () {
												swal.close();
											}, 500);
											setTimeout(function () {
												swal({
													type: "success",
													title: `${result.message}`,
													showConfirmButton: false,
												});
												setTimeout(function () {
													swal.close();
												}, 1500);
												setTimeout(() => {
													reset_form();
												}, 2000);
											}, 1000);
										}
									},
									error: function (e) {
										alert(
											"Something went wrong! Please contact our administrator"
										);
									},
									complete: function (e) {
										$("#form-direct-purchase")
											.find('button[type="submit"]')
											.attr("disabled", false);
									},
								});
							}
						);
					}, 500);
				} else {
					swal.close();
				}
			}
		);
	});

	$(document).on(
		"click",
		"#form-direct-purchase button[type='reset']",
		function (e) {
			e.preventDefault();
			reset_form();
		}
	);

	$(document).on("change", '[name="dp_payment_type"]', function (e) {
		const value = $(this).val();
		switch (value) {
			case "cash":
				$("#card-payment").addClass("hidden");
				if ($("#dp_payment_bank").hasClass("select2-hidden-accessible")) {
					$("#dp_payment_bank").select2("destroy");
				}
				$("#dp_payment_bank").val(null);
				$("#dp_payment_card_number").val(null);
				break;

			default:
				$("#card-payment").removeClass("hidden");
				get_bank("#dp_payment_bank", create_select2, "Select Bank");
				$("#dp_payment_bank").val(null).trigger("change");
				$("#dp_payment_card_number").val(null);
				break;
		}
	});

	$(document).on("blur", "#dp_invoice", function (e) {
		$("#dp_supplier").select2("open");
	});

	$(document).on("select2:close", "#dp_supplier", function (e) {
		$("#dp_no_ref").focus().select();
	});

	$(document).on("blur", "#dp_bill_to", function (e) {
		$("#dp_ship_to").select2("open");
	});

	$(document).on("select2:close", "#dp_bill_to", function (e) {
		$("#dp_ship_to").focus().select();
	});

	$(document).on("select2:close", "#dp_ship_to", function (e) {
		$("#dp_cost_center").focus().select();
	});

	$(document).on("select2:close", ".dp-stockcode", function (e) {
		e.preventDefault();

		const uom = $(this).select2("data")[0].uom;
		const currency = $(this).parents("tr").find(".dp-currency");
		const stockcode = $(this).val();

		const check_stockcode = $(document).find(
			`._dp_stockcode[value='${stockcode}']`
		);

		if (check_stockcode.length > 0) {
			$(this).val(null).trigger("change");
			check_stockcode.parents("tr").find(".dp-qty").focus().select();
		} else {
			$(this).parents("tr").find(".dp-uom").val(uom);
			$(this).parents("tr").find("._dp_stockcode").val(stockcode);
			if (currency.val()) {
				$(this).parents("tr").find(".dp-qty").focus().select();
			} else {
				currency.select2("open");
			}
		}
	});

	$(document).on("select2:close", ".dp-currency", function (e) {
		e.preventDefault();
		$(this).parents("tr").find(".dp-qty").focus().select();
	});

	$(document).on("click", "#action-regenerate-id", function (e) {
		e.preventDefault();
		get_doc_no();
	});
});
