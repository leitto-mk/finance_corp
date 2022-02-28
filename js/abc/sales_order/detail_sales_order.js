$(document).on("ready", function (e) {
	$("#action-create-invoice").on("click", function (e) {
		e.preventDefault();
		$("#so-modal").modal("show");
	});
});
