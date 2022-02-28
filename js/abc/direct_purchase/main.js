import {
	create_select2,
	get_currency,
	get_storage,
	get_supplier,
} from "../sales_order/main.js";

const get_stockcode = function (element, callback, placeholder) {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/select2/abc/purchase/stockcode`,
		dataType: "JSON",
		success: function (data) {
			callback(element, data, placeholder);
		},
	});
};

const get_cost_center = function (element, callback, placeholder) {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/select2/abc/costcenter`,
		dataType: "JSON",
		success: function (data) {
			callback(element, data, placeholder);
		},
	});
};

function add_row() {
	const row = $(".t-row").length;
	return `
    <tr class="t-row n-row">
      <td class="text-center">
        <a href="#" class="btn blue-chambray delete-row" data-row="${row + 1}">
          ${row + 1}
        </a>
        <input type="hidden" id="_dp_stockcode[${row}]" name="_dp_stockcode[${row}]" class="_dp_stockcode">
      </td>
      <td>
        <div class="form-group">
          <select name="dp_stockcode[${row}]" id="dp_stockcode[${row}]" class="form-control dp-stockcode">
            <option value=""></option>
          </select>
          <span class="help-block hidden"></span>
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="text" name="dp_uom[${row}]" id="dp_uom[${row}]" class="form-control dp-uom" readonly>
          <span class="help-block hidden"></span>
        </div>
      </td>
      <td>
        <div class="form-group">
          <select name="dp_currency[${row}]" id="dp_currency[${row}]" class="form-control dp-currency">
            <option value=""></option>
          </select>
          <span class="help-block hidden"></span>
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="number" name="dp_qty[${row}]" id="dp_qty[${row}]" class="form-control text-right dp-qty" min="0" value="0">
          <span class="help-block hidden"></span>
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="number" name="dp_price[${row}]" id="dp_price[${row}]" class="form-control text-right dp-price" min="0" value="0">
          <span class="help-block hidden"></span>
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="number" name="dp_discount[${row}]" id="dp_discount[${row}]" class="form-control text-right dp-discount" min="0" value="0">
          <span class="help-block hidden"></span>
        </div>
      </td>
      <td>
        <div class="form-group">
          <input type="number" name="dp_total[${row}]" id="dp_total[${row}]" class="form-control text-right dp-total" min="0" readonly value="0">
          <span class="help-block hidden"></span>
        </div>
      </td>
    </tr>
  `;
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

				// * Change Number
				$(".delete-row").each(function (key, value) {
					$(this).attr("data-row", key + 2);
					$(this).html(key + 2);
				});

				// * Change Array
				$(".dp-stockcode").each(function (key, value) {
					$(this).attr("name", `dp_stockcode[${key}]`);
					$(this).attr("id", `dp_stockcode[${key}]`);
				});
				$(".dp-uom").each(function (key, value) {
					$(this).attr("name", `dp_uom[${key}]`);
					$(this).attr("id", `dp_uom[${key}]`);
				});
				$(".dp-currency").each(function (key, value) {
					$(this).attr("name", `dp_currency[${key}]`);
					$(this).attr("id", `dp_currency[${key}]`);
				});
				$(".dp-price").each(function (key, value) {
					$(this).attr("name", `dp_price[${key}]`);
					$(this).attr("id", `dp_price[${key}]`);
				});
				$(".dp-discount").each(function (key, value) {
					$(this).attr("name", `dp_discount[${key}]`);
					$(this).attr("id", `dp_discount[${key}]`);
				});
				$(".dp-total").each(function (key, value) {
					$(this).attr("name", `dp_total[${key}]`);
					$(this).attr("id", `dp_total[${key}]`);
				});
				$(".dp-qty").each(function (key, value) {
					$(this).attr("name", `dp_qty[${key}]`);
					$(this).attr("id", `dp_qty[${key}]`);
				});
				// * Change Array End
			},
		},
		".delete-row"
	);
}

function action_add_row() {
	$("#action-add-row").on("click", function (e) {
		e.preventDefault();
		$("#tbody-form-dp").append(add_row());
		get_stockcode($(".dp-stockcode"), create_select2, "Select Stockcode");
		get_currency($(".dp-currency"), create_select2, "Select Currency");
	});
}

function calculate_amount(qty, price, disc) {
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

function calculate_sub_total() {
	let total = 0;
	let grand_total = 0;

	const payment_discount = parseFloat($("#dp_payment_discount").val());
	let _payment_discount = isNaN(payment_discount) ? 0 : payment_discount / 100;

	const payment_tax = parseFloat($("#dp_payment_tax").val());
	let _payment_tax = isNaN(payment_tax) ? 0 : payment_tax / 100;

	const payment_freight_cost = parseFloat($("#dp_payment_freight_cost").val());
	let _payment_freight_cost = isNaN(payment_freight_cost)
		? 0
		: payment_freight_cost;

	$(".dp-total").each(function () {
		total += parseFloat($(this).val());
	});

	grand_total =
		total -
		total * _payment_discount +
		total * _payment_tax +
		_payment_freight_cost;

	$("#dp_payment_sub_total").val(new Intl.NumberFormat("id-ID").format(total));

	$("#dp_payment_grand_total").val(
		new Intl.NumberFormat("id-ID").format(grand_total)
	);
}

function qty_event() {
	$(document).on("input", ".dp-qty", function (e) {
		const disc = $(this).parents("tr").find(".dp-discount").val();
		const price = $(this).parents("tr").find(".dp-price").val();
		const qty = $(this).val();

		const total = calculate_amount(qty, price, disc);

		$(this).parents("tr").find(".dp-total").val(total);
		calculate_sub_total();
	});
}

function price_event() {
	$(document).on("input", ".dp-price", function (e) {
		const disc = $(this).parents("tr").find(".dp-discount").val();
		const qty = $(this).parents("tr").find(".dp-qty").val();
		const price = $(this).val();

		const total = calculate_amount(qty, price, disc);

		$(this).parents("tr").find(".dp-total").val(total);
		calculate_sub_total();
	});
}

function discount_event() {
	$(document).on("input", ".dp-discount", function (e) {
		const price = $(this).parents("tr").find(".dp-price").val();
		const qty = $(this).parents("tr").find(".dp-qty").val();
		let disc = $(this).val();

		if (disc > 100) {
			$(this).val(100);
			disc = 100;
		}

		const total = calculate_amount(qty, price, disc);

		$(this).parents("tr").find(".dp-total").val(total);
		calculate_sub_total();
	});
}

function payment_discount_event() {
	$(document).on("input", "#dp_payment_discount", function (e) {
		e.preventDefault();

		const disc = $(this).val();

		if (disc > 100) {
			$(this).val(100);
		}

		calculate_sub_total();
	});
}

function payment_tax_event() {
	$(document).on("input", "#dp_payment_tax", function (e) {
		e.preventDefault();

		const tax = $(this).val();

		if (tax > 100) {
			$(this).val(100);
		}

		calculate_sub_total();
	});
}

function freight_event() {
	$(document).on("input", "#dp_payment_freight_cost", function (e) {
		e.preventDefault();
		calculate_sub_total();
	});
}

function get_doc_no() {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/abc/purchase/direct_purchase/doc_no`,
		success: function (result) {
			$("#dp_no").val(result).trigger("change");
			$("#dp_no").attr("data-no", result);
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
	$("#form-direct-purchase").trigger("reset");
	$("#dp_supplier").val(null).trigger("change");
	$("#dp_ship_to").val(null).trigger("change");
	$(".dp-stockcode").val(null).trigger("change");
	$(".dp-currency").val("IDR").trigger("change");
	$("#radio-cash").prop("checked", true).trigger("change");
	$("#card-payment").addClass("hidden");

	get_doc_no();
}

export {
	create_select2,
	get_currency,
	get_storage,
	get_supplier,
	get_stockcode,
	get_cost_center,
	action_add_row,
	action_delete_row,
	qty_event,
	price_event,
	discount_event,
	payment_discount_event,
	payment_tax_event,
	freight_event,
	get_doc_no,
	reset_form,
	calculate_amount,
};
