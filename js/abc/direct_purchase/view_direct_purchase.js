$(document).on("ready", function () {
	const dt_direct_purchase = $("#table-direct-purchase").DataTable({
		ajax: {
			type: "GET",
			url: `${site_url}/ajax/abc/purchase/direct_purchase`,
			dataSrc: "",
		},
		createdRow: function (row, data, dataIndex) {
			$(row).attr("data-docno", data.DocNo);
			$(row).attr("data-id", data.CtrlNo);
		},
		columnDefs: [
			{
				targets: 0,
				defaultContent: "",
				className: "text-center",
				orderable: false,
			},
			{ targets: 1, data: "DocNo", className: "text-center" },
			{ targets: 2, data: "InvoiceNo", className: "text-center" },
			{ targets: 3, data: "RaiseDate", className: "text-center" },
			{ targets: 4, data: "DueDate", className: "text-center" },
			{ targets: 5, data: "Description", className: "text-center" },
			{ targets: 6, data: "Supplier", className: "text-left" },
			{
				targets: 7,
				data: "Amount",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat('en').format(data);
				},
			},
			{
				targets: 8,
				data: "POStatus",
				className: "text-center",
				render: function (data, type, row) {
					let bg = "";
					switch (data) {
						case "Order":
							bg = "bg-yellow-casablanca";
							break;
						case "OnProcess":
							bg = "bg-blue";
							break;
						case "Completed":
							bg = "bg-green";
							break;
						case "Canceled":
							bg = "bg-red";
							break;
					}

					return `<span class="badge badge-roundless ${bg}">${data}</span>`;
				},
			},
			{
				targets: 9,
				className: "text-center",
				render: function (data, type, row) {
					return `
							<a href="${site_url}/purchase/direct_purchase/detail/${row.CtrlNo}" data-toggle="modal" class="btn btn-xs grey-gallery btn-outline so-detail" title="Detail Purchase Order" >
								<i class="fa fa-search"></i>
							</a>
							<a href="#" data-toggle="modal" class="btn btn-xs grey-gallery btn-outline so-print" title="Print Purchase Order" >
								<i class="fa fa-print"></i>
							</a>`;
				},
			},
		],
		order: [7, "asc"],
		pagingType: "bootstrap_extended",
		lengthMenu: [
			[5, 10, 25, -1],
			[5, 10, 25, "All"],
		],
	});

	dt_direct_purchase
		.on("order.dt search.dt", function () {
			dt_direct_purchase
				.column(0, { search: "applied", order: "applied" })
				.nodes()
				.each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
		})
		.draw();
});
