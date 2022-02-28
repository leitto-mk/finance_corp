$(document).on("ready", function () {
	let date_start = moment().format("YYYY-MM-DD 00:00:00");
	let date_end = moment().format("YYYY-MM-DD 23:59:59");

	$("#so_rangedate").daterangepicker(
		{
			startDate: moment(),
			endDate: moment(),
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
			date_start = start.format("YYYY-MM-DD HH:mm:ss");
			date_end = end.format("YYYY-MM-DD HH:mm:ss");
		}
	);

	function get_number_so() {
		$.ajax({
			type: "GET",
			dataType: "JSON",
			url: `${site_url}/ajax/abc/sales/number_sales_order`,
			success: function (data) {
				$("#so-order").attr("data-value", data.order).counterUp();
				$("#so-process").attr("data-value", data.process).counterUp();
				$("#so-completed").attr("data-value", data.completed).counterUp();
				$("#so-cancelled").attr("data-value", data.cancelled).counterUp();
			},
		});
	}

	function get_sales_order_by_status(status) {
		$.ajax({
			type: "GET",
			dataType: "JSON",
			url: `${site_url}/ajax/abc/sales/sales_order/${status}`,
			success: function (result) {
				dt_sales_order.clear().draw();
				for (const i of result) {
					dt_sales_order.row
						.add({
							CtrlNo: i.CtrlNo,
							DocNo: i.DocNo,
							RaiseDate: i.RaiseDate,
							DueDate: i.DueDate,
							Description: i.Description,
							Customer: i.Customer,
							Amount: i.Amount,
							SOStatus: i.SOStatus,
							ApprovedStatus: i.ApprovedStatus,
						})
						.draw();
				}
			},
		});
	}

	const dt_sales_order = $("#table-sales").DataTable({
		ajax: {
			type: "GET",
			url: `${site_url}/ajax/abc/sales/sales_order`,
			dataSrc: "",
		},
		createdRow: function (row, data, dataIndex) {
			$(row).attr("data-docno", data.DocNo);
			$(row).attr("data-id", data.CtrlNo);
		},
		columnDefs: [
			{
				targets: 0,
				className: "text-center",
				orderable: false,
				data: "CtrlNo",
				render: function (data, type, row) {
					return `
          <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
              <input type="checkbox" class="checkboxes" value="${data}" />
              <span></span>
          </label>
          `;
				},
			},
			{
				targets: 1,
				defaultContent: "",
				className: "text-center",
				orderable: false,
			},
			{ targets: 2, data: "DocNo", className: "text-center" },
			{ targets: 3, data: "RaiseDate", className: "text-center" },
			{ targets: 4, data: "DueDate", className: "text-center" },
			{ targets: 5, data: "Description", className: "text-center" },
			{ targets: 6, data: "Customer", className: "text-left" },
			{
				targets: 7,
				data: "Amount",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat("id-ID").format(data);
				},
			},
			{
				targets: 8,
				data: "SOStatus",
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
				data: "ApprovedStatus",
				className: "text-center",
				render: function (data, type, row) {
					let bg = "";
					let text = "";
					switch (data) {
						case "Approved":
							bg = "bg-green";
							text = "Approved";
							break;
						case "NotApproved":
							bg = "bg-blue-chambray";
							text = "Not Approved";
							break;
					}

					return `<span class="badge badge-roundless ${bg}">${text}</span>`;
				},
			},
			{
				targets: 10,
				data: "ApprovedStatus",
				className: "text-center",
				render: function (data, type, row) {
					switch (data) {
						case "Approved":
							return `
							<a href="${site_url}/abc/sales/sales_order/detail/${row.CtrlNo}" data-toggle="modal" class="btn btn-xs grey-gallery btn-outline so-detail" title="Detail Sales Order" >
								<i class="fa fa-search"></i>
							</a>
							<a href="#" data-toggle="modal" class="btn btn-xs grey-gallery btn-outline so-print" title="Print Sales Order" >
								<i class="fa fa-print"></i>
							</a>`;
							break;
						case "NotApproved":
							return `
							<a href="${site_url}/abc/sales/sales_order/detail/${row.CtrlNo}" data-toggle="modal" class="btn btn-xs grey-gallery btn-outline so-detail" title="Detail Sales Order" >
								<i class="fa fa-search"></i>
							</a>
							<a href="${site_url}/abc/sales/sales_order/edit/${row.CtrlNo}" data-toggle="modal" class="btn btn-xs grey-gallery btn-outline so-edit" title="Edit Sales Order" >
								<i class="fa fa-pencil"></i>
							</a>
							<a href="#" data-toggle="modal" class="btn btn-xs grey-gallery btn-outline so-delete" title="Delete Sales Order" >
								<i class="fa fa-trash"></i>
							</a>
							<a href="#" data-toggle="modal" class="btn btn-xs grey-gallery btn-outline so-print" title="Print Sales Order" >
								<i class="fa fa-print"></i>
							</a>`;
							break;
					}
				},
			},
		],
		order: [9, "asc"],
		pagingType: "bootstrap_extended",
		lengthMenu: [
			[5, 10, 25, -1],
			[5, 10, 25, "All"],
		],
	});

	dt_sales_order
		.on("order.dt search.dt", function () {
			dt_sales_order
				.column(1, { search: "applied", order: "applied" })
				.nodes()
				.each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
		})
		.draw();

	$(document)
		.find(".group-checkable")
		.change(function () {
			let set = $(this).attr("data-set");
			let checked = $(this).is(":checked");

			$(set).each(function () {
				if (checked) {
					$(this).prop("checked", true);
					$(this).parents("tr").addClass("active");
				} else {
					$(this).prop("checked", false);
					$(this).parents("tr").removeClass("active");
				}
			});
		});

	$(document).on("change", "tbody tr .checkboxes", function () {
		$(this).parents("tr").toggleClass("active");
	});

	$(document).on("click", ".approve-so", function (e) {
		e.preventDefault();
		let docno = "";
		const id = [];
		$("#table-sales")
			.find("tr.active")
			.each(function () {
				docno += `<strong>${$(this).attr("data-docno")}</strong><br>`;
				id.push($(this).attr("data-id"));
			});
		if (docno) {
			swal(
				{
					title: "<strong>Confirmation</strong>",
					text: `${docno}<br>These Sales Order <strong>Will be Approved!</strong><br><span class="font-red">You can't delete or edit after this</span>. Continue?`,
					type: "warning",
					showCancelButton: true,
					closeOnCancel: false,
					closeOnConfirm: false,
					confirmButtonText: "Continue, Approve",
					cancelButtonText: "No, I Need to Check Again",
					confirmButtonClass: "yellow-casablanca",
					cancelButtonClass: "blue-chambray btn-outline",
					html: true,
				},
				function (isConfirm) {
					if (isConfirm) {
						$.ajax({
							type: "POST",
							dataType: "JSON",
							data: {
								id: id,
							},
							url: `${site_url}/abc/sales/sales_order/multi_approve`,
							success: function (data) {
								if (data.success) {
									swal({
										type: "success",
										title: `${data.message}`,
										showConfirmButton: false,
									});
									dt_sales_order.ajax.reload();
									$(".group-checkable").prop("checked", false);
									get_number_so();
									setTimeout(function () {
										swal.close();
									}, 1500);
								}
							},
							error: function (e) {
								alert("Something went wrong. Please contact Administrator");
							},
						});
					} else {
						swal.close();
					}
				}
			);
		} else {
			swal({
				title: "Reminder",
				text: "You need to choose at least 1 Sales Order",
				type: "warning",
				confirmButtonClass: "blue-chambray",
			});
		}
	});

	$(document).on("click", "#widget-so-process", function (e) {
		const status = "process";
		get_sales_order_by_status(status);
		$(".widget-thumb-icon")
			.removeClass("bg-yellow-casablanca")
			.addClass("bg-blue-chambray");

		$(this)
			.find(".widget-thumb-icon")
			.removeClass("bg-blue-chambray")
			.addClass("bg-yellow-casablanca");
	});

	$(document).on("click", "#widget-so-order", function (e) {
		const status = "order";
		get_sales_order_by_status(status);
		$(".widget-thumb-icon")
			.removeClass("bg-yellow-casablanca")
			.addClass("bg-blue-chambray");

		$(this)
			.find(".widget-thumb-icon")
			.removeClass("bg-blue-chambray")
			.addClass("bg-yellow-casablanca");
	});

	$(document).on("click", "#widget-so-completed", function (e) {
		$("#so-modal").modal("show");
	});

	$(document).on("click", "#widget-so-cancelled", function (e) {
		const status = "cancelled";
		get_sales_order_by_status(status);

		$(".widget-thumb-icon")
			.removeClass("bg-yellow-casablanca")
			.addClass("bg-blue-chambray");

		$(this)
			.find(".widget-thumb-icon")
			.removeClass("bg-blue-chambray")
			.addClass("bg-yellow-casablanca");
	});

	$(document).on("submit", "#so-modal-form", function (e) {
		e.preventDefault();
		$.ajax({
			type: "GET",
			dataType: "JSON",
			data: {
				start_date: date_start,
				end_date: date_end,
			},
			url: `${site_url}/ajax/abc/sales/sales_order/completed`,
			success: function (result) {
				dt_sales_order.clear().draw();
				for (const i of result) {
					dt_sales_order.row
						.add({
							CtrlNo: i.CtrlNo,
							DocNo: i.DocNo,
							RaiseDate: i.RaiseDate,
							DueDate: i.DueDate,
							Description: i.Description,
							Customer: i.Customer,
							Amount: i.Amount,
							SOStatus: i.SOStatus,
							ApprovedStatus: i.ApprovedStatus,
						})
						.draw();
				}
				$(".widget-thumb-icon")
					.removeClass("bg-yellow-casablanca")
					.addClass("bg-blue-chambray");

				$("#widget-so-completed")
					.find(".widget-thumb-icon")
					.removeClass("bg-blue-chambray")
					.addClass("bg-yellow-casablanca");

				$("#so-modal").modal("hide");
			},
		});
	});
});
