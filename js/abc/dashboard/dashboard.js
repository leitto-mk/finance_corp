import { dt_stock } from "../report/stockcard.js";
import { dt_le } from "../report/le_monthly.js";
$(document).on("ready", function (e) {
	const dt_approval = $("#table-approval").DataTable({
		ajax: {
			type: "GET",
			url: `${site_url}/ajax/abc/dashboard/approval`,
			dataSrc: "",
		},
		createdRow: function (row, data, dataIndex) {
			$(row).attr("data-docno", data.DocNo);
			$(row).attr("data-id", data.ID);
			$(row).attr("data-type", data.Type);
		},
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
			{
				targets: 1,
				defaultContent: "",
				className: "text-center",
				orderable: false,
			},
			{
				targets: 2,
				data: "Type",
				className: "text-center",
				render: function (data, type, row) {
					let bg = "";
					switch (data) {
						case "SO":
							bg = "bg-yellow-casablanca";
							break;

						case "PO":
							bg = "bg-purple-studio";
							break;

						case "BO":
							bg = "bg-blue-chambray";
							break;
					}

					return `<span class="badge badge-roundless ${bg}">${data}</span>`;
				},
			},
			{ width: "32%", targets: 3, data: "DocNo" },
			{ width: "20%", targets: 4, data: "RaisedBy" },
			{
				width: "20%",
				targets: 5,
				data: "Amount",
				className: "text-right",
				render: function (data, type, row) {
					return new Intl.NumberFormat('en').format(data);
				},
			},
			{
				width: "15%",
				targets: 6,
				className: "text-center",
				orderable: false,
				render: function (data, type, row) {
					let url_detail = "";

					switch (row.Type) {
						case "BO":
							url_detail = `${site_url}/approval/back_order`;
							break;

						case "SO":
							url_detail = `${site_url}/abc/sales/sales_order/detail/${row.ID}`;
							break;

						case "PO":
							url_detail = `${site_url}/abc/purchase/purchase_order/detail/${row.ID}`;
							break;

						default:
							break;
					}

					return `
					<a href="${url_detail}" class="btn btn-xs blue btn-outline " title="Detail">
            <i class="fa fa-search"></i>
          </a>
          <a href="#" class="btn btn-xs green btn-outline action-approve" title="Approve">
            <i class="fa fa-check"></i>
          </a>
          <a href="#" class="btn btn-xs red btn-outline action-reject" title="Reject">
            <i class="fa fa-close"></i>
          </a>`;
				},
			},
		],
		order: [5, "asc"],
		pagingType: "bootstrap_extended",
		lengthMenu: [
			[5, 10, 25, -1],
			[5, 10, 25, "All"],
		],
	});

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

	dt_approval
		.on("order.dt search.dt", function () {
			dt_approval
				.column(1, { search: "applied", order: "applied" })
				.nodes()
				.each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
		})
		.draw();

	const dt_bo = $("#table-stock-on-process").DataTable({
		ajax: {
			type: "GET",
			url: `${site_url}/ajax/abc/backorder/progress`,
			dataSrc: "",
		},
		columnDefs: [
			{ targets: 0, data: "Stockcode" },
			{ targets: 1, data: "StockDescription" },
			{ targets: 2, data: "Ordered", className: "text-right" },
			{ targets: 3, data: "Invoice", className: "text-right" },
			{ targets: 4, data: "Outstanding", className: "text-right" },
			{
				targets: 5,
				data: "ApprovedBy",
				className: "text-center",
				render: function (data, type, row) {
					if (data) {
						return data;
					} else {
						return "Not Approved";
					}
				},
			},
			{ targets: 6, data: "ApprovedDate", className: "text-center" },
			{ targets: 7, data: "Remarks", className: "text-center" },
		],
		pagingType: "bootstrap_extended",
		lengthMenu: [
			[10, 25, -1],
			[10, 25, "All"],
		],
	});

	dt_stock;
	dt_le;

	$(document).on("click", ".action-approve", function (e) {
		e.preventDefault();

		let docno = "";
		const id = [];
		const type = [];

		$("#table-approval")
			.find("tr.active")
			.each(function () {
				docno += `<strong>${$(this).attr("data-docno")}</strong><br>`;
				id.push($(this).attr("data-id"));
				type.push($(this).attr("data-type"));
			});

		if (docno) {
			swal(
				{
					title: "<strong>Confirmation</strong>",
					text: `${docno}<br>These Transaction <strong>Will be Approved!</strong><br><span class="font-red">You can't delete or edit after this</span>. Continue?`,
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
								type: type,
							},
							url: `${site_url}/abc/approval/all`,
							success: function (data) {
								if (data.success) {
									swal({
										type: "success",
										title: `${data.message}`,
										showConfirmButton: false,
									});
									dt_approval.ajax.reload();
									dt_bo.ajax.reload();
									$(".group-checkable").prop("checked", false);
									setTimeout(function () {
										swal.close();
									}, 1500);
								}
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
				text: "You need to choose at least 1 Transaction",
				type: "warning",
				confirmButtonClass: "blue-chambray",
			});
		}
	});

	$(document).on("click", ".action-reject", function (e) {
		e.preventDefault();

		let docno = "";
		const id = [];
		const type = [];

		$("#table-approval")
			.find("tr.active")
			.each(function () {
				docno += `<strong>${$(this).attr("data-docno")}</strong><br>`;
				id.push($(this).attr("data-id"));
				type.push($(this).attr("data-type"));
			});

		if (docno) {
			swal(
				{
					title: "<strong>Confirmation</strong>",
					text: `${docno}<br>These Sales Order <strong>Will be Rejected!</strong><br><span class="font-red">You can't delete or edit after this</span>. Continue?`,
					type: "warning",
					showCancelButton: true,
					closeOnCancel: false,
					closeOnConfirm: false,
					confirmButtonText: "Continue, Reject",
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
								type: type,
							},
							url: `${site_url}/abc/rejection/all`,
							success: function (data) {
								if (data.success) {
									swal({
										type: "success",
										title: `${data.message}`,
										showConfirmButton: false,
									});
									dt_approval.ajax.reload();
									dt_bo.ajax.reload();
									$(".group-checkable").prop("checked", false);
									setTimeout(function () {
										swal.close();
									}, 1500);
								}
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
				text: "You need to choose at least 1 Transaction",
				type: "warning",
				confirmButtonClass: "blue-chambray",
			});
		}
	});
});
