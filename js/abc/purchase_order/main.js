import { get_currency, create_select2 } from "../sales_order/main.js";
import { get_stockcode, calculate_amount } from "../direct_purchase/main.js";

function add_row() {
	const row = $(".t-row").length;
	return `<tr class="t-row n-row">
            <td class="text-center">
              <a href="#" class="btn blue-chambray delete-row" data-row="${
								row + 1
							}">
                ${row + 1}
              </a>
            </td>
            <td>
              <div class="form-group">
                <select name="po_stockcode[${row}]" id="po_stockcode[${row}]" class="form-control po-stockcode">
                  <option value=""></option>
                </select>
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="text" name="po_uom[${row}]" id="po_uom[${row}]" class="form-control po-uom" readonly>
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <select name="po_currency[${row}]" id="po_currency[${row}]" class="form-control po-currency">
                  <option value=""></option>
                </select>
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="number" name="po_qty[${row}]" id="po_qty[${row}]" class="form-control text-right po-qty" min="0" value="0">
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="number" name="po_price[${row}]" id="po_price[${row}]" class="form-control text-right po-price" min="0" value="0">
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="number" name="po_discount[${row}]" id="po_discount[${row}]" class="form-control text-right po-discount" min="0" value="0">
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="number" name="po_total[${row}]" id="po_total[${row}]" class="form-control text-right po-total" min="0" readonly value="0">
                <span class="help-block hidden"></span>
              </div>
            </td>
          </tr>`;
}

function action_add_row() {
	$("#action-add-row").on("click", function (e) {
		e.preventDefault();
		$("#tbody-form-po").append(add_row());
		get_stockcode($(".po-stockcode"), create_select2, "Select Stockcode");
		get_currency($(".po-currency"), create_select2, "Select Currency");
	});
}

function action_delete_row() {
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
				calculate_sub_total();

				// * Change Number
				$(".delete-row").each(function (key, value) {
					$(this).attr("data-row", key + 2);
					$(this).html(key + 2);
				});

				// * Change Array
				$(".po-stockcode").each(function (key, value) {
					$(this).attr("name", `po_stockcode[${key}]`);
					$(this).attr("id", `po_stockcode[${key}]`);
				});
				$(".po-uom").each(function (key, value) {
					$(this).attr("name", `po_uom[${key}]`);
					$(this).attr("id", `po_uom[${key}]`);
				});
				$(".po-currency").each(function (key, value) {
					$(this).attr("name", `po_currency[${key}]`);
					$(this).attr("id", `po_currency[${key}]`);
				});
				$(".po-price").each(function (key, value) {
					$(this).attr("name", `po_price[${key}]`);
					$(this).attr("id", `po_price[${key}]`);
				});
				$(".po-discount").each(function (key, value) {
					$(this).attr("name", `po_discount[${key}]`);
					$(this).attr("id", `po_discount[${key}]`);
				});
				$(".po-total").each(function (key, value) {
					$(this).attr("name", `po_total[${key}]`);
					$(this).attr("id", `po_total[${key}]`);
				});
				$(".po-qty").each(function (key, value) {
					$(this).attr("name", `po_qty[${key}]`);
					$(this).attr("id", `po_qty[${key}]`);
				});
				// * Change Array End
			},
		},
		".delete-row"
	);
}

function calculate_sub_total() {
	let total = 0;
	let grand_total = 0;

	const payment_discount = parseFloat($("#po_payment_discount").val());
	let _payment_discount = isNaN(payment_discount) ? 0 : payment_discount / 100;

	const payment_tax = parseFloat($("#po_payment_tax").val());
	let _payment_tax = isNaN(payment_tax) ? 0 : payment_tax / 100;

	const payment_freight_cost = parseFloat($("#po_payment_freight_cost").val());
	let _payment_freight_cost = isNaN(payment_freight_cost)
		? 0
		: payment_freight_cost;

	$(".po-total").each(function () {
		total += parseFloat($(this).val());
	});

	grand_total =
		total -
		total * _payment_discount +
		total * _payment_tax +
		_payment_freight_cost;

	$("#po_payment_sub_total").val(new Intl.NumberFormat("id-ID").format(total));

	$("#po_payment_grand_total").val(
		new Intl.NumberFormat("id-ID").format(grand_total)
	);
}

function qty_event() {
	$(document).on("input", ".po-qty", function (e) {
		const disc = $(this).parents("tr").find(".po-discount").val();
		const price = $(this).parents("tr").find(".po-price").val();
		const qty = $(this).val();

		const total = calculate_amount(qty, price, disc);

		$(this).parents("tr").find(".po-total").val(total);
		calculate_sub_total();
	});
}

function price_event() {
	$(document).on("input", ".po-price", function (e) {
		const disc = $(this).parents("tr").find(".po-discount").val();
		const qty = $(this).parents("tr").find(".po-qty").val();
		const price = $(this).val();

		const total = calculate_amount(qty, price, disc);

		$(this).parents("tr").find(".po-total").val(total);
		calculate_sub_total();
	});
}

function discount_event() {
	$(document).on("input", ".po-discount", function (e) {
		const price = $(this).parents("tr").find(".po-price").val();
		const qty = $(this).parents("tr").find(".po-qty").val();
		let disc = $(this).val();

		if (disc > 100) {
			$(this).val(100);
			disc = 100;
		}

		const total = calculate_amount(qty, price, disc);

		$(this).parents("tr").find(".po-total").val(total);
		calculate_sub_total();
	});
}

function payment_discount_event() {
	$(document).on("input", "#po_payment_discount", function (e) {
		e.preventDefault();

		const disc = $(this).val();

		if (disc > 100) {
			$(this).val(100);
		}

		calculate_sub_total();
	});
}

function payment_tax_event() {
	$(document).on("input", "#po_payment_tax", function (e) {
		e.preventDefault();

		const tax = $(this).val();

		if (tax > 100) {
			$(this).val(100);
		}

		calculate_sub_total();
	});
}

function freight_event() {
	$(document).on("input", "#po_payment_freight_cost", function (e) {
		e.preventDefault();
		calculate_sub_total();
	});
}

function get_doc_no() {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/abc/purchase/purchase_order/doc_no`,
		success: function (result) {
			$("#po_no").val(result).trigger("change");
			$("#po_no").attr("data-no", result);
		},
	});
}

function reset_form() {
	const new_row = $(".n-row");

	if (new_row.length > 0) {
		new_row.remove();
	}

	$(".form-group")
		.removeClass("has-error")
		.find(".help-block")
		.addClass("hidden");
	$("#form-purchase-order").trigger("reset");
	$("#po_supplier").val(null).trigger("change");
	$("#po_ship_to").val(null).trigger("change");
	$(".po-stockcode").val(null).trigger("change");
	$(".po-currency").val("IDR").trigger("change");

	get_doc_no();
}

export {
	add_row,
	action_add_row,
	qty_event,
	price_event,
	discount_event,
	payment_discount_event,
	payment_tax_event,
	freight_event,
	action_delete_row,
	reset_form,
	get_doc_no,
};
