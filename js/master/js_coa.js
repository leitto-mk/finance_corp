$(document).on("ready", function () {
	function create_select2(element, data, placeholder) {
		$(element).select2({
			placeholder: `${placeholder}`,
			width: "style",
			data: data,
		});
	}

	function create_confirmation() {
		$(document)
			.find("#table-coa>tbody>tr")
			.confirmation({
				title: "Action",
				btnOkLabel: "Edit",
				btnOkIcon: "fa fa-pencil",
				btnCancelLabel: "New Child",
				btnCancelIcon: "fa fa-plus",
				btnOkClass: "btn btn-sm green",
				btnCancelClass: "btn btn-sm blue",
				singleton: true,
				popout: true,
				onConfirm: function () {
					const id = $(this).attr("data-unique");
					const type = "edit";
					const url = $(document).find("#btn-new-heading").attr("data-url");

					get_form(url, type, id);
				},
				onCancel: function () {
					const id = $(this).attr("data-unique");
					const type = "child";
					const url = $(document).find("#btn-new-heading").attr("data-url");

					get_form(url, type, id);
				},
			});
	}

	const get_type = function (element, callback, placeholder, url) {
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: `${url}`,
			success: function (data) {
				callback(element, data, placeholder);
			},
		});
	};

	const get_group = function (element, callback, placeholder, url) {
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: `${url}`,
			success: function (data) {
				callback(element, data, placeholder);
			},
		});
	};

	function get_content(url) {
		$.ajax({
			type: "POST",
			url: `${url}`,
			success: function (data) {
				$("#table-coa").html(data);
				create_confirmation();
			},
			error: function () {
				alert("something went wrong! Please contact our web developer");
			},
		});
	}

	function get_form_insert(url) {
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: `${url}`,
			success: function (data) {
				const element = $("#modal-finance");
				element.find(".modal-title").text("Create New Heading");
				element.find(".modal-body").html(data.body);
				element.find("#action-submit").attr("data-type", "head");
				element.find("#action-submit").attr("data-submit", data.submit_url);
				element.find("#action-submit").attr("data-table-url", data.content_url);
				get_type($("#coa_type"), create_select2, " ", data.type_url);
			},
			error: function () {
				alert("something went wrong! Please contact our web developer");
			},
		});
	}

	function get_form(url, type, id) {
		$.ajax({
			type: "POST",
			dataType: "JSON",
			data: {
				type: type,
				id: id,
			},
			url: `${url}`,
			success: function (data) {
				const element = $("#modal-finance");
				element.find(".modal-title").text(data.title);
				element.find(".modal-body").html(data.body);
				element.find("#action-submit").attr("data-type", type);
				element.find("#action-submit").attr("data-submit", data.submit_url);
				element.find("#action-submit").attr("data-table-url", data.content_url);
				element.find("#action-submit").attr("data-unique", id);
				get_type($("#coa_type"), create_select2, " ", data.type_url);
				$("#modal-finance").modal("show");
			},
			error: function () {
				alert("something went wrong! Please contact our web developer");
			},
		});
	}

	function submit_coa(data, url) {
		const action_submit = $(document).find("#action-submit");
		$.ajax({
			type: "POST",
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			data: data,
			url: `${url}`,
			success: function (result) {
				if (result.result == "success") {
					const alert_component = `
					<div class="alert alert-success" style="margin:14px;">
						<strong>Success!</strong> ${result.message}
					</div>
					`;

					const element = $("#modal-finance");
					element.find(".modal-body").before(alert_component);

					setTimeout(function () {
						$(".alert").remove();
					}, 1500);

					const type = element.find("#action-submit").attr("data-type");
					const id = element.find("#action-submit").attr("data-unique");
					const url = $(document).find("#btn-new-heading").attr("data-url");
					const table_url = element
						.find("#action-submit")
						.attr("data-table-url");

					if (type == "head") {
						get_form_insert(url);
					} else {
						get_form(url, type, id);
					}
					get_content(table_url);
				} else if (result.result == "error") {
					const alert_component = `
					<div class="alert alert-danger" style="margin:14px;">
						<strong>Error!</strong> ${result.message}
					</div>
					`;

					const element = $("#modal-finance");
					element.find(".modal-body").before(alert_component);

					setTimeout(function () {
						$(".alert").remove();
					}, 1500);
				}

				action_submit.prop("disabled", false);
			},
			error: function (result) {
				alert(
					"Something went wrong! Please contact our Administrator or web developer"
				);
				action_submit.prop("disabled", false);
			},
		});
	}

	create_confirmation();

	$("#btn-new-heading").on("click", function (e) {
		e.preventDefault();
		const url = $(this).attr("data-url");
		get_form_insert(url);
	});

	$("#form-finance").on("submit", function (e) {
		e.preventDefault();

		const _formData = new FormData(this);
		const element = $(document).find("#action-submit");
		const type = element.attr("data-type");
		const url = element.attr("data-submit");
		const id = element.attr("data-unique");

		element.prop("disabled", true);

		_formData.append("type", type);
		_formData.append("id", id);

		submit_coa(_formData, url);
		// $("#modal-finance").modal("hide");
	});
});
