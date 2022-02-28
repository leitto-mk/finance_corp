$(document).on("ready", function () {
	const dt_production_cost = $("#table-production").DataTable({
		ajax: {
			type: "GET",
			url: `${site_url}/ajax/abc/production/cost`,
			dataSrc: "",
		},
		columnDefs: [
			{ targets: 0, data: "Stockcode" },
			{ targets: 1, data: "StockDescription" },
			{ targets: 2, data: "UOM" },
			{
				targets: 3,
				data: "100",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 4,
				data: "201",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 5,
				data: "202",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 6,
				data: "203",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 7,
				data: "204",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 8,
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(
						parseFloat(row["201"]) +
							parseFloat(row["202"]) +
							parseFloat(row["203"]) +
							parseFloat(row["204"])
					);
				},
			},
			{
				targets: 9,
				data: "301",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 10,
				data: "302",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 11,
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(
						parseFloat(row["301"]) + parseFloat(row["302"])
					);
				},
			},
			{
				targets: 12,
				data: "401",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 13,
				data: "501",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 14,
				data: "502",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 15,
				data: "503",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 16,
				data: "504",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 17,
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(
						parseFloat(row["501"]) +
							parseFloat(row["502"]) +
							parseFloat(row["503"]) +
							parseFloat(row["504"])
					);
				},
			},
			{
				targets: 18,
				data: "601",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{ targets: 19, defaultContent: ``, className: "text-right" },
		],
		pagingType: "bootstrap_extended",
	});
});
