import {
	create_select2,
	event_validation_check,
	get_storage,
	validation,
} from "../sales_order/main.js";
$(document).on("ready", function (e) {
	event_validation_check();

	const get_book = function (element, callback, placeholder) {
		$.ajax({
			type: "GET",
			url: `${site_url}/ajax/select2/abc/book`,
			dataType: "JSON",
			success: function (data) {
				callback(element, data, placeholder);
			},
		});
	};

	function get_bo_form() {
		$.ajax({
			type: "GET",
			url: `${site_url}/abc/backorder/new`,
			success: function (result) {
				$("#create-bo-modal").find("#body-content").html(result);
				setTimeout(() => {
					get_book($(".bo-book"), create_select2, "Select Book");
					$("#bo_master_remarks").focus();
				}, 500);
			},
		});
	}

	function get_bo_receive_form(id) {
		$.ajax({
			type: "GET",
			data: {
				id: id,
			},
			url: `${site_url}/abc/backorder/receive`,
			success: function (result) {
				$("#receive-bo-modal").find("#body-content").html(result);
				setTimeout(() => {
					get_storage(
						$("#bo_receive_storage"),
						create_select2,
						"Select Storage"
					);

					setTimeout(() => {
						$("#bo_receive_storage").select2("open");
					}, 500);
				}, 500);
			},
		});
	}

	function get_bo_detail(id) {
		$.ajax({
			type: "GET",
			url: `${site_url}/abc/backorder/detail`,
			data: { id: id },
			success: function (result) {
				$("#view-bo-modal").modal("show");
				$("#view-bo-modal").find("#body-content").html(result);
			},
		});
	}

	$(document).on("click", ".close", function (e) {
		e.preventDefault();
		$(this).parents(".alert").addClass("hidden");
	});

	$(document).on("click", ".add-row", function (e) {
		e.preventDefault();
		const row = $(".t-row").length;

		const row_data = `
			<div class="row t-row">
				<div class="col-xs-6">
					<div class="form-group">
						<label for="bo_book[${row}]" class="control-label">Book</label>
						<div class="input-group">
							<span class="input-group-btn">
								<a href="#" class="btn blue-chambray delete-row"><i class="fa fa-close"></i></a>
							</span>
							<select name="bo_book[${row}]" id="bo_book[${row}]" class="form-control bo-book">
								<option value=""></option>
							</select>
						</div>
						<span class="help-block hidden"></span>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
						<label for="bo_qty[${row}]" class="control-label">Qty</label>
						<input type="number" name="bo_qty[${row}]" id="bo_qty[${row}]" class="form-control text-right bo-qty" value="0">
						<span class="help-block hidden"></span>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label for="bo_remarks[${row}]" class="control-label">Remarks</label>
						<textarea name="bo_remarks[${row}]" id="bo_remarks[${row}]" rows="2" class="form-control"></textarea>
						<span class="help-block hidden"></span>
					</div>
				</div>
			</div>
		`;

		$("#portlet-book").append(row_data);
		get_book($(".bo-book"), create_select2, "Select Book");
		setTimeout(() => {
			$(`[name="bo_book[${row}]"]`).select2("open");
		}, 500);
	});

	$(document).on(
		{
			mouseenter: function () {
				$(this).toggleClass("yellow-casablanca blue-chambray");
			},
			mouseleave: function () {
				$(this).toggleClass("yellow-casablanca blue-chambray");
			},
			click: function (e) {
				e.preventDefault();
				$(this).parents(".t-row").remove();
			},
		},
		".delete-row"
	);

	const dt_book = $("#table-book").DataTable({
		ajax: {
			type: "GET",
			url: `${site_url}/ajax/abc/backorder/book`,
			dataSrc: "",
		},
		columnDefs: [
			{
				targets: 0,
				defaultContent: "",
				className: "text-center",
				orderable: false,
			},
			{ targets: 1, data: "Stockcode", className: "text-left" },
			{ targets: 2, data: "BookName", className: "text-left" },
			{
				targets: 3,
				data: "Qty",
				className: "text-right",
				render: function (data, type, row) {
					const render_data = data ?? 0;
					return new Intl.NumberFormat("id-ID").format(render_data);
				},
			},
			{
				targets: 4,
				data: "Category",
				className: "text-center",
				render: function (data, type, row) {
					let bg = "";
					switch (data) {
						case "Book":
							bg = "bg-yellow-casablanca";
							break;
						case "Magazine":
							bg = "bg-blue-chambray";
							break;
					}
					return `<span class="badge badge-roundless ${bg}">${data}</span>`;
				},
			},
			{
				targets: 5,
				defaultContent: `
					
				`,
				className: "text-center",
				orderable: false,
			},
		],
		initComplete: function () {
			this.api()
				.column(4)
				.every(function () {
					let column = this;
					let select = $(
						`<select class="form-control input-sm"><option value="">All Category</option></select>`
					)
						.appendTo($(column.footer()).empty())
						.on("change", function () {
							let val = $.fn.dataTable.util.escapeRegex($(this).val());
							column.search(val ? `^${val}$` : "", true, false).draw();
						});
					column
						.data()
						.unique()
						.sort()
						.each(function (d, j) {
							select.append(`<option value="${d}">${d}</option>`);
						});
				});
		},
		order: [
			[3, "desc"],
			[1, "asc"],
		],
		pagingType: "bootstrap_extended",
		lengthMenu: [
			[10, 25, 100, -1],
			[10, 25, 100, "All"],
		],
	});

	dt_book
		.on("order.dt search.dt", function () {
			dt_book
				.column(0, { search: "applied", order: "applied" })
				.nodes()
				.each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
		})
		.draw();

	const dt_back_order = $("#table-back-order").DataTable({
		ajax: {
			type: "GET",
			url: `${site_url}/ajax/abc/backorder`,
			dataSrc: "",
		},
		createdRow: function (row, data, dataIndex) {
			$(row).attr("data-id", data.ID);
		},
		columnDefs: [
			{
				targets: 0,
				defaultContent: "",
				className: "text-center",
				orderable: false,
			},
			{ targets: 1, data: "DocNo" },
			{ targets: 2, data: "Description" },
			{ targets: 3, data: "Date", className: "text-center" },
			{
				targets: 4,
				data: "Status",
				className: "text-center",
				render: function (data, type, row) {
					let bg = "";
					switch (data) {
						case "Order":
							bg = "bg-blue-chambray";
							break;
						case "Process":
							bg = "bg-blue";
							break;
						case "Complete":
							bg = "bg-green";
							break;
						case "Cancelled":
							bg = "bg-red";
							break;
					}
					return `<span class="badge badge-roundless ${bg}">${data}</span>`;
				},
			},
			{
				targets: 5,
				defaultContent: `
				<a href="#" data-toggle="modal" class="btn btn-xs grey-gallery btn-outline bo-detail" title="Detail Back Order" >
					<i class="fa fa-search"></i>
				</a>`,
				className: "text-center",
				orderable: false,
			},
		],
		order: [3, "desc"],
		pagingType: "bootstrap_extended",
		lengthMenu: [
			[10, 25, 100, -1],
			[10, 25, 100, "All"],
		],
	});

	dt_back_order
		.on("order.dt search.dt", function () {
			dt_back_order
				.column(0, { search: "applied", order: "applied" })
				.nodes()
				.each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
		})
		.draw();

	$(document).on("click", "#action-new-backorder", function (e) {
		e.preventDefault();
		get_bo_form();
	});

	$(document).on("submit", "#modal-form", function (e) {
		e.preventDefault();

		const _formData = new FormData(this);

		$.ajax({
			type: "POST",
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			data: _formData,
			url: `${site_url}/abc/backorder`,
			beforeSend: function (e) {
				$("#modal-form").find('button[type="submit"]').attr("disabled", true);
			},
			success: function (result) {
				if (result.error) {
					if (result.status == "validation_error") {
						validation(result.message);
					} else if (result.status == "error") {
						$("#modal-form")
							.find(".alert")
							.addClass("alert-danger")
							.removeClass("alert-success hidden")
							.children(".content-message")
							.html(result.message);
					}
				} else if (result.success) {
					$("#modal-form")
						.find(".alert")
						.addClass("alert-success")
						.removeClass("alert-danger hidden")
						.children(".content-message")
						.html(result.message);
					setTimeout(() => {
						get_bo_form();
						dt_back_order.ajax.reload();
						dt_book.ajax.reload();
					}, 500);
				}
			},
			complete: function (e) {
				$("#modal-form").find('button[type="submit"]').attr("disabled", false);
			},
		});
	});

	$(document).on("select2:close", ".bo-book", function (e) {
		e.preventDefault();
		$(this).parents(".t-row").find(".bo-qty").focus().select();
	});

	$(document).on("click", "#action-regenerate-id", function (e) {
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: `${site_url}/abc/backorder/regenerate`,
			success: function (result) {
				$("#bo_doc_no").val(result).trigger("change");
			},
		});
	});

	$(document).on("change", "#bo_doc_no", function () {
		const selector = $(this).parents(".form-group");
		selector.removeClass("has-error");
		selector.find(".help-block").addClass("hidden");
	});

	$(document).on("click", ".bo-detail", function (e) {
		e.preventDefault();
		const id = $(this).parents("tr").attr("data-id");
		get_bo_detail(id);
	});

	$(document).on("click", "#action-receive-bo", function (e) {
		e.preventDefault();
		const id = $(this).attr("data-id");
		get_bo_receive_form(id);
	});

	$(document).on("submit", "#receive-modal-form", function (e) {
		e.preventDefault();

		const _formData = new FormData(this);

		$.ajax({
			type: "POST",
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			data: _formData,
			url: `${site_url}/abc/backorder/receive`,
			beforeSend: function (e) {
				$("#receive-modal-form")
					.find('button[type="submit"]')
					.attr("disabled", true);
			},
			success: function (result) {
				if (result.error) {
					if (result.status == "validation_error") {
						validation(result.message);
					} else if (result.status == "error") {
						$("#receive-modal-form")
							.find(".alert")
							.addClass("alert-danger")
							.removeClass("alert-success hidden")
							.children(".content-message")
							.html(result.message);
					}
				} else if (result.success) {
					$("#receive-modal-form")
						.find(".alert")
						.addClass("alert-success")
						.removeClass("alert-danger hidden")
						.children(".content-message")
						.html(result.message);
					setTimeout(() => {
						const id = $("#receive-modal-form")
							.find('button[type="submit"]')
							.attr("data-id");
						get_bo_receive_form(id);
						get_bo_detail(id);
						dt_back_order.ajax.reload();
						dt_book.ajax.reload();
					}, 500);
				}
			},
			error: function (result) {
				$("#receive-modal-form")
					.find(".alert")
					.addClass("alert-danger")
					.removeClass("alert-success hidden")
					.children(".content-message")
					.html(`Something went wrong! Please contact the administrator.`);
			},
			complete: function (e) {
				$("#receive-modal-form")
					.find('button[type="submit"]')
					.attr("disabled", false);
			},
		});
	});
});
