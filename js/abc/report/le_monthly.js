let date_start = moment().startOf("month").format("YYYY-MM-DD 00:00:00");
let date_end = moment().endOf("month").format("YYYY-MM-DD 23:59:59");
let employee = "";

const dt_le = $("#table-sales").DataTable({
	ajax: {
		type: "GET",
		data: {
			date_start: function () {
				return date_start;
			},
			date_end: function () {
				return date_end;
			},
			employee: function () {
				return employee;
			},
		},
		url: `${site_url}/ajax/abc/report/le_sales`,
		dataSrc: "",
	},
	columnDefs: [
		{ targets: 0, orderable: false, defaultContent: "" },
		{ targets: 1, data: "Name" },
		{ targets: 2, data: "ID" },
		{ targets: 3, data: "JobTitle", className: "text-center" },
		{ targets: 4, defaultContent: "Status", className: "text-center" },
		{
			targets: 5,
			data: "401",
			className: "text-right",
			render: function (data, type, row) {
				return new Intl.NumberFormat('en').format(data);
			},
		},
		{
			targets: 6,
			data: "100",
			className: "text-right",
			render: function (data, type, row) {
				return new Intl.NumberFormat('en').format(data);
			},
		},
		{
			targets: 7,
			data: "601",
			className: "text-right",
			render: function (data, type, row) {
				return new Intl.NumberFormat('en').format(data);
			},
		},
		{
			targets: 8,
			data: "Point",
			className: "text-right",
			render: function (data, type, row) {
				return new Intl.NumberFormat('en').format(data);
			},
		},
		{
			targets: 9,
			className: "text-center",
			orderable: false,
			render: function (data, type, row) {
				return `<a href="#" class="btn btn-xs grey-gallery btn-outline " title="Detail">
					<i class="fa fa-search"></i>
				</a>`;
			},
		},
		{ targets: 10, data: "Supervisor", visible: false },
	],
	order: [2, "asc"],
	orderFixed: [10, "asc"],
	autoWidth: false,
	pagingType: "bootstrap_extended",
	rowGroup: {
		endRender: function (rows, group) {
			var intVal = function (i) {
				return typeof i === "string"
					? i.replace(/[\$,]/g, "") * 1
					: typeof i === "number"
					? i
					: 0;
			};

			let totalNetSales = rows
				.data()
				.pluck("401")
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			let totalRetailSales = rows
				.data()
				.pluck("100")
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			let totalTithe = rows
				.data()
				.pluck("601")
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			let totalPoint = rows
				.data()
				.pluck("Point")
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			return $("<tr/>")
				.append(`<td colspan='5' class='text-right'>Total</td>`)
				.append(
					`<td class='text-right'>${new Intl.NumberFormat('en').format(
						totalNetSales
					)}</td>`
				)
				.append(
					`<td class='text-right'>${new Intl.NumberFormat('en').format(
						totalRetailSales
					)}</td>`
				)
				.append(
					`<td class='text-right'>${new Intl.NumberFormat('en').format(
						totalTithe
					)}</td>`
				)
				.append(
					`<td class='text-right'>${new Intl.NumberFormat('en').format(
						totalPoint
					)}</td>`
				)
				.append(`<td></td>`);
		},
		dataSrc: "Supervisor",
	},
	lengthMenu: [
		[10, 25, 100, -1],
		[10, 25, 100, "All"],
	],
});

$(document).on("ready", function (e) {
	const get_assistance = function (element, callback, placeholder) {
		$.ajax({
			type: "GET",
			url: `${site_url}/ajax/select2/abc/assistance`,
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
			allowClear: true,
		});
	}

	get_assistance($("#param-assistance"), create_select2, "Select Employee");

	$("#date-range").daterangepicker(
		{
			startDate: moment().startOf("month"),
			endDate: moment().endOf("month"),
			showDropdowns: true,
			showWeekNumbers: true,
			timePicker: false,
			timePickerIncrement: 1,
			timePicker12Hour: true,
			ranges: {
				Today: [moment(), moment()],
				Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
				"Last 7 Days": [moment().subtract(6, "days"), moment()],
				"Last 30 Days": [moment().subtract(29, "days"), moment()],
				"This Month": [moment().startOf("month"), moment().endOf("month")],
				"Last Month": [
					moment().subtract(1, "month").startOf("month"),
					moment().subtract(1, "month").endOf("month"),
				],
				"This Year": [moment().startOf("year"), moment().endOf("year")],
				"Last Year": [
					moment().subtract(1, "year").startOf("year"),
					moment().subtract(1, "year").endOf("year"),
				],
			},
			buttonClasses: ["btn"],
			applyClass: "blue-chambray",
		},
		function (start, end) {
			date_start = start.format("YYYY-MM-DD");
			date_end = end.format("YYYY-MM-DD");

			dt_le.ajax.reload();
		}
	);

	$("#param-assistance").on("change", function (e) {
		e.preventDefault();
		employee = $(this).val();
		dt_le.ajax.reload();
	});

	dt_le
		.on("order.dt search.dt", function () {
			dt_le
				.column(0, { search: "applied", order: "applied" })
				.nodes()
				.each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
		})
		.draw();
});

export { dt_le };
