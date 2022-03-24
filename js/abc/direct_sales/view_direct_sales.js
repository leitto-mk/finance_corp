$(document).on("ready", function (e) {
	const dt_direct_sales = $("#table-direct-sales").DataTable({
		ajax: {
			type: "GET",
			url: `${site_url}/ajax/abc/sales/direct_sales`,
			dataSrc: "",
		},
		columnDefs: [
			{
				targets: 0,
				defaultContent: "",
				className: "text-center",
				orderable: false,
			},
			{ targets: 1, data: "Date", className: "text-center" },
			{ targets: 2, data: "DocNo", className: "text-center" },
			{ targets: 3, data: "Seller", className: "text-center" },
			{
				targets: 4,
				data: "Amount",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat('en').format(data);
				},
			},
			{
				targets: 5,
				data: "Method",
				className: "text-center",
				render: function (data, type, row) {
					let bg = "";
					switch (data) {
						case "cash":
							bg = "bg-yellow-casablanca";
							break;

						case "credit":
							bg = "bg-blue-chambray";
							break;

						case "debit":
							bg = "bg-purple-studio";
							break;
					}

					return `<span class="badge badge-roundless ${bg}">${data}</span>`;
				},
			},
			{
				targets: 6,
				data: "Status",
				className: "text-center",
				render: function (data, type, row) {
					let bg = "";
					switch (data) {
						case "paid":
							bg = "bg-green";
							break;

						case "due":
							bg = "bg-blue";
							break;
					}

					return `<span class="badge badge-roundless ${bg}">${data}</span>`;
				},
			},
			{
				targets: 7,
				className: "text-center",
				orderable: false,
				render: function (data, type, row) {
					return `<a href="${site_url}/abc/sales/direct_sales/detail/${row.CtrlNo}" data-toggle="modal" class="btn btn-xs grey-gallery btn-outline ds-detail" title="Detail Direct Sales">
										<i class="fa fa-search"></i>
									</a>
									<a href="${site_url}/abc/report/direct_sales/${row.CtrlNo}" data-toggle="modal" class="btn btn-xs grey-gallery btn-outline ds-print" title="Print Direct Sales" >
										<i class="fa fa-print"></i>
									</a>`;
				},
			},
		],
		order: [1, "desc"],
		pagingType: "bootstrap_extended",
		lengthMenu: [
			[5, 10, 25, -1],
			[5, 10, 25, "All"],
		],
	});

	dt_direct_sales
		.on("order.dt search.dt", function () {
			dt_direct_sales
				.column(0, { search: "applied", order: "applied" })
				.nodes()
				.each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
		})
		.draw();
});
