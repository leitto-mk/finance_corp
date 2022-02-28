$(document).on("ready", function () {
	const dt_inventory_stock = $("#table-inventory-stock").DataTable({
		ajax: {
			type: "GET",
			url: `${site_url}/ajax/abc/inventory/inventory_stock`,
			dataSrc: "",
		},
		createdRow: function (row, data, dataIndex) {
			$(row).attr("data-docno", data.DocNo);
			$(row).attr("data-id", data.CtrlNo);
		},
		columnDefs: [
			{
				targets: 0,
				className: "text-right",
				orderable: false,
				defaultContent: "",
			},
			{ targets: 1, data: "Stockcode" },
			{ targets: 2, data: "StockDescription" },
			{ targets: 3, data: "UOM", className: "text-center" },
			{
				targets: 4,
				data: "SOH",
				className: "text-right",
				createdCell: function (td, cellData, rowData, row, col) {
					$(td).css({ "background-color": "#E5E5E5" });
				},
			},
			{
				targets: 5,
				data: "SOR",
				className: "text-right",
				createdCell: function (td, cellData, rowData, row, col) {
					$(td).css("background-color", "#FAFAFA");
				},
			},
			{
				targets: 6,
				data: "SAV",
				className: "text-right",
				createdCell: function (td, cellData, rowData, row, col) {
					$(td).css("background-color", "#FAFAFA");
				},
			},
			{
				targets: 7,
				data: "SOO",
				className: "text-right",
				createdCell: function (td, cellData, rowData, row, col) {
					$(td).css("background-color", "#FAFAFA");
				},
			},
			{
				targets: 8,
				data: "CombineStock",
				className: "text-right",
				createdCell: function (td, cellData, rowData, row, col) {
					$(td).css("background-color", "#FAFAFA");
				},
			},
			{
				targets: 9,
				className: "text-center",
				orderable: false,
				defaultContent: `
        <a class="btn btn-xs blue-sharp action-view-detail" data-toggle="modal" href="#stock_modal" title="Detail"><i class="fa fa-search"></i> Detail
        </a>
        `,
			},
		],
		order: [1, "asc"],
		pagingType: "bootstrap_extended",
		lengthMenu: [
			[10, 25, 100, -1],
			[10, 25, 100, "All"],
		],
	});

	dt_inventory_stock
		.on("order.dt search.dt", function () {
			dt_inventory_stock
				.column(0, { search: "applied", order: "applied" })
				.nodes()
				.each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
		})
		.draw();

	$(document).on("click", ".action-view-detail", function (e) {
		e.preventDefault();

		const id = $(this).parents("tr").attr("data-id");

		$.ajax({
			type: "GET",
			data: {
				id: id,
			},
			url: `${site_url}/ajax/abc/inventory/inventory_stock/detail`,
			success: function (data) {
				$("#stock_modal").find(".modal-body").html(data);
			},
		});
	});
});
