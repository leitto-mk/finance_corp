import {
	get_storage,
	create_select2,
	get_customer,
	get_stockcode,
	validation,
	event_validation_check,
	get_bank,
} from "../sales_order/main.js";

$(document).on("ready", function (e) {
	event_validation_check();
	$("#checkbox_ds_no").on("change", function (e) {
		e.preventDefault();

		const selector = $("#ds_no");
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

	get_storage($("#ds_storage"), create_select2, "Select Storage");
	get_customer($("#ds_customer"), create_select2, "Select Customer");
	get_stockcode($("#item_input"), create_select2, "Select Stockcode");

	function hide_no_data() {
		const row = $(".t-row").length;

		if (row > 0) {
			$(".no-data").addClass("hidden");
		} else {
			$(".no-data").removeClass("hidden");
		}
	}

	function calc_sub_total(qty, price, disc) {
		let _qty = parseFloat(qty, 10);
		let _price = parseFloat(price, 10);
		let _discount = parseFloat(disc, 10);
		let _total = 0;
		let _sub_total = 0;

		_qty = isNaN(_qty) ? 0 : _qty;
		_price = isNaN(_price) ? 0 : _price;
		_discount = isNaN(_discount) ? 0 : _discount;
		_total = _qty * _price;
		_sub_total = _total - _total * (_discount / 100);

		return _sub_total;
	}

	function calc_payment_total() {
		let total = 0;
		let grand_total = 0;
		let changes = 0;

		const payment_discount = parseFloat($("#ds_payment_discount").val());
		let _payment_discount = isNaN(payment_discount)
			? 0
			: payment_discount / 100;

		const payment_tax = parseFloat($("#ds_payment_tax").val());
		let _payment_tax = isNaN(payment_tax) ? 0 : payment_tax / 100;

		const total_payment = parseFloat($("#ds_payment_total_paid").val());
		let _total_payment = isNaN(total_payment) ? 0 : total_payment;

		$(".ds-amount").each(function () {
			total += parseFloat($(this).val());
		});

		grand_total = total - total * _payment_discount + total * _payment_tax;
		changes = grand_total - _total_payment;

		$("#ds_payment_sub_total").val(
			new Intl.NumberFormat('en').format(total)
		);

		$("#ds_payment_grand_total").val(
			new Intl.NumberFormat('en').format(grand_total)
		);

		$("#ds_payment_changes").val(
			new Intl.NumberFormat('en').format(changes)
		);
	}

	setTimeout(() => {
		$("#ds_customer").select2("open");
	}, 500);

	$(document).on("select2:close", "#ds_customer", function (e) {
		e.preventDefault();
		const val = $(this).val();
		if (val === null || val === "") {
			$(this).parents(".form-group").addClass("has-error");
		} else {
			$(this).parents(".form-group").removeClass("has-error");
		}
		$("#ds_storage").select2("open");
	});

	$(document).on("select2:close", "#ds_storage", function (e) {
		e.preventDefault();
		const val = $(this).val();
		if (val === null || val === "") {
			$(this).parents(".form-group").addClass("has-error");
		} else {
			$(this).parents(".form-group").removeClass("has-error");
			$("#item_input").select2("open");
		}
	});

	$(document).on("select2:close", "#item_input", function (e) {
		e.preventDefault();

		const stockcode = $(this).val();
		const storage = $("#ds_storage").val();
		const customer = $("#ds_customer").val();

		if (!storage) {
			alert("You need to select Storage");
			return $("#ds_storage").select2("open");
		}

		const check_stockcode = $(document).find(
			`.ds-stockcode[value='${stockcode}']`
		);

		if (check_stockcode.length > 0) {
			check_stockcode.parents("tr").find(".ds-qty").focus().select();
		} else {
			const row = $(".t-row").length;

			if ($(this).val()) {
				$.ajax({
					type: "GET",
					dataType: "JSON",
					url: `${site_url}/abc/sales/direct_sales/stockcode`,
					data: {
						storage: storage,
						stockcode: stockcode,
						customer: customer,
					},
					success: function (result) {
						if (result.success) {
							$("#table-direct-sales tbody").append(function () {
								return `
								<tr class="t-row">
									<td><a href="#" class="btn blue-chambray delete-row" data-row="${
										row + 1
									}">${row + 1}</a></td>
									<td>
										<input type="hidden" value="${
											result.message.Stockcode
										}" name="ds_stockcode[${row}] id="ds_stockcode[${row}]" class="ds-stockcode">
									${result.message.Stockcode}
									</td>
									<td>${result.message.StockDescription}</td>
									<td>
										<div class="form-group">
											<input type="number" name="ds_price[${row}]" id="ds_price[${row}]" class="form-control text-right ds-price" min="0" value="${result.message.Price}">
											<span class="help-block hidden"></span>
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="number" name="ds_qty[${row}]" id="ds_qty[${row}]" class="form-control text-right ds-qty" value="1">
											<span class="help-block hidden"></span>
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="number" name="ds_discount[${row}]" id="ds_discount[${row}]" class="form-control text-right ds-discount" value="0">
											<span class="help-block hidden"></span>
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="number" name="ds_amount[${row}]" id="ds_amount[${row}]" class="form-control text-right ds-amount" readonly value="0">
											<span class="help-block hidden"></span>
										</div>
									</td>
								</tr>
								`;
							});
							hide_no_data();
							setTimeout(() => {
								$(`[name='ds_price[${row}]']`).focus().select();
								$(`[name='ds_price[${row}]']`).trigger("input");
							}, 500);
						} else {
							let text = "";
							switch (result.status) {
								case "insuficient":
									text = `<strong>${result.message}</strong><br> are out of stock`;
									break;

								case "nregistered":
									text = `<strong>You have no <br>${result.message}</strong><br> on this Storage`;
									break;

								case "cprice":
									text = `<strong>${result.message.stockcode}</strong><br>Sale Price not Set for this customer type (${result.message.customertype})`;
									break;
								default:
									break;
							}
							swal({
								type: "warning",
								title: "<strong>Sorry!</strong>",
								text: text,
								html: true,
							});
						}
					},
					error: function (e) {
						swal({
							type: "warning",
							title: "<strong>Oops!</strong>",
							text: "Something went wrong! Please contact Administrator",
							html: true,
						});
					},
				});
			}
		}

		setTimeout(() => {
			$(this).val(null).trigger("change");
		}, 500);
	});

	$(document).on("focusout", ".ds-discount", function (e) {
		$("#item_input").select2("open");
	});

	$(document).on(
		{
			mouseenter: function () {
				$(this).toggleClass("yellow-casablanca blue-chambray");
				$(this).html(`<i class="fa fa-close"></i>`);
			},
			mouseleave: function () {
				const row = $(this).attr("data-row");
				$(this).toggleClass("yellow-casablanca blue-chambray");
				$(this).html(row);
			},
			click: function (e) {
				e.preventDefault();
				$(this).parents("tr").remove();

				hide_no_data();
				calc_payment_total();

				// * Change Number
				$(".delete-row").each(function (key, value) {
					$(this).attr("data-row", key + 1);
					$(this).html(key + 1);
				});

				// * Change Array
				$(".ds-stockcode").each(function (key, value) {
					$(this).attr("name", `ds_stockcode[${key}]`);
					$(this).attr("id", `ds_stockcode[${key}]`);
				});
				$(".ds-price").each(function (key, value) {
					$(this).attr("name", `ds_price[${key}]`);
					$(this).attr("id", `ds_price[${key}]`);
				});
				$(".ds-discount").each(function (key, value) {
					$(this).attr("name", `ds_discount[${key}]`);
					$(this).attr("id", `ds_discount[${key}]`);
				});
				$(".ds-qty").each(function (key, value) {
					$(this).attr("name", `ds_qty[${key}]`);
					$(this).attr("id", `ds_qty[${key}]`);
				});
				$(".ds-amount").each(function (key, value) {
					$(this).attr("name", `ds_amount[${key}]`);
					$(this).attr("id", `ds_amount[${key}]`);
				});
				// * Change Array End
			},
		},
		".delete-row"
	);

	$(document).on("input", ".ds-qty", function (e) {
		const disc = $(this).parents("tr").find(".ds-discount").val();
		const price = $(this).parents("tr").find(".ds-price").val();
		const qty = $(this).val();
		const total = calc_sub_total(qty, price, disc);

		$(this).parents("tr").find(".ds-amount").val(total);
		calc_payment_total();
	});

	$(document).on("input", ".ds-price", function (e) {
		const disc = $(this).parents("tr").find(".ds-discount").val();
		const qty = $(this).parents("tr").find(".ds-qty").val();
		const price = $(this).val();
		const total = calc_sub_total(qty, price, disc);

		$(this).parents("tr").find(".ds-amount").val(total);
		calc_payment_total();
	});

	$(document).on("input", ".ds-discount", function (e) {
		const price = $(this).parents("tr").find(".ds-price").val();
		const qty = $(this).parents("tr").find(".ds-qty").val();
		let disc = $(this).val();

		if (disc > 100) {
			$(this).val(100);
			disc = 100;
		}

		const total = calc_sub_total(qty, price, disc);

		$(this).parents("tr").find(".ds-amount").val(total);
		calc_payment_total();
	});

	$(document).on("input", "#ds_payment_discount", function (e) {
		e.preventDefault();
		let disc = $(this).val();
		if (disc > 100) {
			$(this).val(100);
		}
		calc_payment_total();
	});

	$(document).on("input", "#ds_payment_tax", function (e) {
		e.preventDefault();
		calc_payment_total();
	});

	$(document).on("submit", "#form-direct-sales", function (e) {
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
						$.ajax({
							type: "POST",
							dataType: "JSON",
							data: _formData,
							contentType: false,
							processData: false,
							cache: false,
							url: `${site_url}/abc/sales/direct_sales`,
							beforeSend: function (e) {
								$("#form-direct-sales")
									.find('button[type="submit"]')
									.attr("disabled", true);
							},
							success: function (result) {
								if (result.error) {
									setTimeout(function () {
										swal.close();
										setTimeout(function () {
											if (result.status == "validation_error") {
												swal({
													type: "error",
													title: `Oops!`,
													text: `You forgot to input some data`,
												});
												validation(result.message);
											}
											if (result.status == "insuficient") {
												let message = ``;
												for (const e of result.message) {
													message += `${e}<br>`;
												}
												swal({
													type: "error",
													title: `<strong>Oops!</strong>`,
													text: `<strong>${message}</strong>These Stockcode are <strong>Insufficient.</strong><br> Please Check Again`,
													html: true,
												});
											}
										}, 500);
									}, 500);
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
											location.reload();
										}, 1500);
									}, 1000);
								}
							},
							error: function (e) {
								alert("Something went wrong! Please contact our administrator");
							},
							complete: function (e) {
								$("#form-direct-sales")
									.find('button[type="submit"]')
									.attr("disabled", false);
							},
						});
					}, 500);
					// setTimeout(() => {
					// 	const grand_total = $("#ds_payment_grand_total").val();
					// 	swal(
					// 		{
					// 			title: "",
					// 			text: `Grand Total<br><h1 style="margin-top:5px;"><strong>${grand_total}</strong></h1>`,
					// 			type: "input",
					// 			showCancelButton: true,
					// 			closeOnConfirm: false,
					// 			confirmButtonText: "Pay",
					// 			confirmButtonClass: "yellow-casablanca",
					// 			cancelButtonClass: "blue-chambray btn-outline",
					// 			inputType: "number",
					// 			html: true,
					// 		},
					// 		function (inputValue) {
					// 			if (inputValue === false) return false;
					// 			if (inputValue === "") {
					// 				swal.showInputError("Oops!");
					// 				return false;
					// 			}
					// 			// _formData.append("ds_payment_total_paid", inputValue);

					// 			$.ajax({
					// 				type: "POST",
					// 				dataType: "JSON",
					// 				data: _formData,
					// 				contentType: false,
					// 				processData: false,
					// 				cache: false,
					// 				url: `${site_url}/abc/sales/direct_sales`,
					// 				beforeSend: function (e) {
					// 					$("#form-direct-sales")
					// 						.find('button[type="submit"]')
					// 						.attr("disabled", true);
					// 				},
					// 				success: function (result) {
					// 					if (result.error) {
					// 						setTimeout(function () {
					// 							swal.close();
					// 						}, 500);
					// 						setTimeout(function () {
					// 							if (result.status == "validation_error") {
					// 								swal({
					// 									type: "error",
					// 									title: `Oops!`,
					// 									text: `You forgot to input some data`,
					// 								});
					// 								validation(result.message);
					// 							} else if (result.status == "insuficient") {
					// 								let message = ``;
					// 								for (const e of result.message) {
					// 									message += `${e}<br>`;
					// 								}
					// 								swal({
					// 									type: "error",
					// 									title: `<strong>Oops!</strong>`,
					// 									text: `<strong>${message}</strong>These Stockcode are <strong>Insufficient.</strong><br> Please Check Again`,
					// 									html: true,
					// 								});
					// 							}
					// 						}, 1000);
					// 					} else if (result.success) {
					// 						setTimeout(function () {
					// 							swal.close();
					// 						}, 500);
					// 						setTimeout(function () {
					// 							swal({
					// 								type: "success",
					// 								title: `${result.message}`,
					// 								showConfirmButton: false,
					// 							});
					// 							setTimeout(function () {
					// 								location.reload();
					// 							}, 1500);
					// 						}, 1000);
					// 					}
					// 				},
					// 				error: function (e) {
					// 					alert(
					// 						"Something went wrong! Please contact our administrator"
					// 					);
					// 				},
					// 				complete: function (e) {
					// 					$("#form-direct-sales")
					// 						.find('button[type="submit"]')
					// 						.attr("disabled", false);
					// 				},
					// 			});
					// 		}
					// 	);
					// }, 500);
				} else {
					swal.close();
				}
			}
		);
	});

	$(document).on("change", '[name="ds_payment_type"]', function (e) {
		const value = $(this).val();

		switch (value) {
			case "cash":
				$("#card-payment").addClass("hidden");
				$("#ds_payment_bank").val(null).select2("destroy");
				break;

			default:
				$("#card-payment").removeClass("hidden");
				get_bank("#ds_payment_bank", create_select2, "Select Bank");
				$("#ds_payment_bank").val(null).trigger("change");
				break;
		}
	});

	$(document).on("input", "#ds_payment_total_paid", function (e) {
		e.preventDefault();
		calc_payment_total();
	});
});
