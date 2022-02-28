const dt_stock = $("#table-stockcard").DataTable({
	ajax: {
		type: "GET",
		url: `${site_url}/ajax/abc/report/stockcard`,
		dataSrc: "",
	},
	columnDefs: [
		{ targets: 0, data: "Stockcode" },
		{ targets: 1, data: "StockName" },
		{
			targets: 2,
			data: "QtyStart",
			className: "text-right",
			render: function (data, type, row) {
				if (data == 0) {
					return row.BB_SOH;
				} else {
					return data;
				}
			},
		},
		{ targets: 3, data: "QtyIn", className: "text-right" },
		{ targets: 4, data: "QtyOut", className: "text-right" },
		{
			targets: 5,
			className: "text-right",
			render: function (data, type, row) {
				return (
					parseFloat(row.QtyStart) +
					parseFloat(row.QtyIn) -
					parseFloat(row.QtyOut)
				);
			},
		},
		{ targets: 6, defaultContent: "0", className: "text-right" },
		{ targets: 7, defaultContent: "0", className: "text-right" },
		{ targets: 8, data: "QtyIPH", className: "text-right" },
	],
	pagingType: "bootstrap_extended",
	lengthMenu: [
		[10, 25, -1],
		[10, 25, "All"],
	],
});

$(document).on("ready", function () {});

export { dt_stock };
