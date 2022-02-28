const get_customer = function (element, callback, placeholder) {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/select2/abc/customer`,
		dataType: "JSON",
		success: function (data) {
			callback(element, data, placeholder);
		},
	});
};

const get_storage = function (element, callback, placeholder) {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/select2/abc/storage`,
		dataType: "JSON",
		success: function (data) {
			callback(element, data, placeholder);
		},
	});
};

const get_stockcode = function (element, callback, placeholder) {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/select2/abc/stockcode`,
		dataType: "JSON",
		success: function (data) {
			callback(element, data, placeholder);
		},
	});
};

const get_currency = function (element, callback, placeholder) {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/select2/abc/currency`,
		dataType: "JSON",
		success: function (data) {
			callback(element, data, placeholder);
		},
	});
};

const get_bank = function (element, callback, placeholder) {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/select2/abc/bank`,
		dataType: "JSON",
		success: function (data) {
			callback(element, data, placeholder);
		},
	});
};

const get_supplier = function (element, callback, placeholder) {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/select2/abc/supplier`,
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

const get_account_code = function (element, callback, placeholder) {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/select2/abc/accountcode`,
		dataType: "JSON",
		success: function (data) {
			callback(element, data, placeholder);
		},
	});
};

const get_department = function (element, callback, placeholder) {
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/select2/abc/department`,
		dataType: "JSON",
		success: function (data) {
			callback(element, data, placeholder);
		},
	});
};

function create_select2(element, data, placeholder) {
	$(element).select2({
		placeholder: `${placeholder}`,
		width: "style",
		data: data,
	});
}

function create_select2_templating(element, data, placeholder, template) {
	$(element).select2({
		placeholder: `${placeholder}`,
		width: "style",
		data: data,
		templateResult: template,
	});
}

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
                <select name="so_stockcode[${row}]" id="so_stockcode[${row}]" class="form-control so-stockcode">
                  <option value=""></option>
                </select>
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="text" name="so_uom[${row}]" id="so_uom[${row}]" class="form-control so-uom" readonly>
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <select name="so_currency[${row}]" id="so_currency[${row}]" class="form-control so-currency">
                  <option value=""></option>
                </select>
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="number" name="so_qty[${row}]" id="so_qty[${row}]" class="form-control text-right so-qty" min="0" value="0">
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="number" name="so_price[${row}]" id="so_price[${row}]" class="form-control text-right so-price" min="0" value="0">
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="number" name="so_discount[${row}]" id="so_discount[${row}]" class="form-control text-right so-discount" min="0" value="0">
                <span class="help-block hidden"></span>
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="number" name="so_total[${row}]" id="so_total[${row}]" class="form-control text-right so-total" min="0" readonly value="0">
                <span class="help-block hidden"></span>
              </div>
            </td>
          </tr>`;
}

function calculate_sub_total() {
	let total = 0;
	let grand_total = 0;

	const payment_discount = parseFloat($("#so_payment_discount").val());
	let _payment_discount = isNaN(payment_discount) ? 0 : payment_discount / 100;

	const payment_tax = parseFloat($("#so_payment_tax").val());
	let _payment_tax = isNaN(payment_tax) ? 0 : payment_tax / 100;

	const payment_freight_cost = parseFloat($("#so_payment_freight_cost").val());
	let _payment_freight_cost = isNaN(payment_freight_cost)
		? 0
		: payment_freight_cost;

	$(".so-total").each(function () {
		total += parseFloat($(this).val());
	});

	grand_total =
		total -
		total * _payment_discount +
		total * _payment_tax +
		_payment_freight_cost;

	$("#so_payment_sub_total").val(new Intl.NumberFormat("id-ID").format(total));

	$("#so_payment_grand_total").val(
		new Intl.NumberFormat("id-ID").format(grand_total)
	);
}

function reset_form() {
	$(".n-row").remove();
	$(".form-group")
		.removeClass("has-error")
		.find(".help-block")
		.addClass("hidden");
	$("#form-sales-order").trigger("reset");
	$("#so_customer").val(null).trigger("change");
	$("#so_storage").val(null).trigger("change");
	$(".so-stockcode").val(null).trigger("change");
	$(".so-currency").val(null).trigger("change");
	$.ajax({
		type: "GET",
		url: `${site_url}/ajax/abc/sales/doc_no`,
		success: function (result) {
			$("#so_no").val(result).attr("data-no", result);
		},
	});
	$("#so_customer").select2("open");
}

function action_add_row() {
	$("#action-add-row").on("click", function (e) {
		e.preventDefault();
		$("#tbody-form-so").append(add_row());
		get_stockcode($(".so-stockcode"), create_select2, "Select Stockcode");
		get_currency($(".so-currency"), create_select2, "Select Currency");
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

				// * Change Number
				$(".delete-row").each(function (key, value) {
					$(this).attr("data-row", key + 2);
					$(this).html(key + 2);
				});

				// * Change Array
				$(".so-stockcode").each(function (key, value) {
					$(this).attr("name", `so_stockcode[${key}]`);
					$(this).attr("id", `so_stockcode[${key}]`);
				});
				$(".so-uom").each(function (key, value) {
					$(this).attr("name", `so_uom[${key}]`);
					$(this).attr("id", `so_uom[${key}]`);
				});
				$(".so-currency").each(function (key, value) {
					$(this).attr("name", `so_currency[${key}]`);
					$(this).attr("id", `so_currency[${key}]`);
				});
				$(".so-price").each(function (key, value) {
					$(this).attr("name", `so_price[${key}]`);
					$(this).attr("id", `so_price[${key}]`);
				});
				$(".so-discount").each(function (key, value) {
					$(this).attr("name", `so_discount[${key}]`);
					$(this).attr("id", `so_discount[${key}]`);
				});
				$(".so-total").each(function (key, value) {
					$(this).attr("name", `so_total[${key}]`);
					$(this).attr("id", `so_total[${key}]`);
				});
				$(".so-qty").each(function (key, value) {
					$(this).attr("name", `so_qty[${key}]`);
					$(this).attr("id", `so_qty[${key}]`);
				});
				// * Change Array End
			},
		},
		".delete-row"
	);
}

function qty_event() {
	$(document).on("input", ".so-qty", function (e) {
		const disc = $(this).parents("tr").find(".so-discount").val();
		const price = $(this).parents("tr").find(".so-price").val();
		const qty = $(this).val();

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

		$(this).parents("tr").find(".so-total").val(_sub_total);
		calculate_sub_total();
	});
}

function price_event() {
	$(document).on("input", ".so-price", function (e) {
		const disc = $(this).parents("tr").find(".so-discount").val();
		const qty = $(this).parents("tr").find(".so-qty").val();
		const price = $(this).val();

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

		$(this).parents("tr").find(".so-total").val(_sub_total);
		calculate_sub_total();
	});
}

function discount_event() {
	$(document).on("input", ".so-discount", function (e) {
		const price = $(this).parents("tr").find(".so-price").val();
		const qty = $(this).parents("tr").find(".so-qty").val();
		const disc = $(this).val();

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

		$(this).parents("tr").find(".so-total").val(_sub_total);
		calculate_sub_total();
	});
}

function payment_discount_event() {
	$(document).on("input", "#so_payment_discount", function (e) {
		e.preventDefault();
		calculate_sub_total();
	});
}

function payment_tax_event() {
	$(document).on("input", "#so_payment_tax", function (e) {
		e.preventDefault();
		calculate_sub_total();
	});
}

function freight_event() {
	$(document).on("input", "#so_payment_freight_cost", function (e) {
		e.preventDefault();
		calculate_sub_total();
	});
}

function event_validation_check() {
	$(document).on("change", ".form-control", function (e) {
		const selector = $(this).parents(".form-group");
		if ($(this).val()) {
			selector.removeClass("has-error");
			selector.find(".help-block").addClass("hidden");
		}
	});
}

function validation(message) {
	for (const e of message) {
		if (e.error_message) {
			$(document)
				.find(`[name="${e.field}"]`)
				.parents(".form-group")
				.addClass("has-error")
				.find(".help-block")
				.removeClass("hidden")
				.html(e.error_message);
		} else {
			$(document)
				.find(`[name="${e.field}"]`)
				.parents(".form-group")
				.removeClass("has-error")
				.find(".help-block")
				.addClass("hidden");
		}
	}
}

function get_price(stockcode, customer, storage) {
	var price = 0;
	$.ajax({
		async: false,
		type: "GET",
		data: {
			stockcode: stockcode,
			customer: customer,
			storage: storage,
		},
		url: `${site_url}/ajax/abc/get_price`,
		dataType: "JSON",
		success: function (data) {
			price = data.price;
		},
	});

	return price;
}

export {
	get_customer,
	get_storage,
	get_stockcode,
	get_bank,
	get_currency,
	get_supplier,
	create_select2,
	create_select2_templating,
	action_add_row,
	calculate_sub_total,
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
	get_department,
};
