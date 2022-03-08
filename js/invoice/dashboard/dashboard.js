$(document).on("ready", function () {
	const dt_approval = $("#table-approval").DataTable({
		ajax: {
			type: "GET",
			url: `${site_url}Invoice/get_approval`,
			dataSrc: "",
		},
		createdRow: function (row, data, dataIndex) {},
		columnDefs: [
			{
				targets: 0,
				className: "text-center",
				orderable: false,
				data: "ID",
				render: function (data, type, row) {
					return `
				<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
						<input type="checkbox" class="checkboxes" value="${data}" data-type="${row.Type}" />
						<span></span>
				</label>
				`;
				},
			},
			{ targets: 1, data: "DocNo" },
			{ targets: 2, data: "Customer" },
			{ targets: 3, data: "InvoiceDate", className: "text-center" },
			{ targets: 4, data: "PaymentDue", className: "text-center" },
			{
				targets: 5,
				data: "Amount",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("en-US", {
						style: "currency",
						currency: "USD",
					}).format(data);
				},
			},
			{
				targets: 6,
				data: "Paid",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("en-US", {
						style: "currency",
						currency: "USD",
					}).format(data);
				},
			},
			{
				targets: 7,
				data: "Balance",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("en-US", {
						style: "currency",
						currency: "USD",
					}).format(data);
				},
			},
			{
				targets: 8,
				orderable: false,
				className: "text-center",
				render: function (data, type, row) {
					return `
					<a href="#" class="btn btn-xs grey-gallery btn-outline" title="Detail">
            <i class="fa fa-search"></i>
          </a>
          <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Edit">
            <i class="fa fa-pencil"></i>
          </a>
          <a href="#" class="btn btn-xs grey-gallery btn-outline" title="Delete">
            <i class="fa fa-close"></i>
          </a>`;
				},
			},
			{ targets: 9, data: "CustomerGroup", visible: false },
		],
		orderFixed: [9, "asc"],
		order: [5, "desc"],
		pagingType: "bootstrap_extended",
		lengthMenu: [
			[5, 10, 25, -1],
			[5, 10, 25, "All"],
		],
		rowGroup: {
			dataSrc: "CustomerGroup",
		},
	});

	$(document).on("click", ".widget-status", function (e) {
		$(".widget-thumb-icon")
			.removeClass("bg-yellow-casablanca")
			.addClass("bg-blue-chambray");

		$(this)
			.find(".widget-thumb-icon")
			.removeClass("bg-blue-chambray")
			.addClass("bg-yellow-casablanca");
	});
});
