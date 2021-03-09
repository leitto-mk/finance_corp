$(document).ready(function () {

	//If current Path is on absent page, load the script
	if ($('div').is('.absent')) {
		//DISPLAY DROPDOWN OPTIONS
		$('select[name="search"]').change(function () {
			if ($(this).val() == 'Class') {
				$('.search-sel').empty();

				$.ajax({
					url: "get_classes",
					method: "GET",
					success: function (data) {
						//console.log(data);
						$('.search-sel').append(data);
					}
				});
			} else if ($(this).val() == 'Personal') {
				$('.search-sel').empty();
				$('.search-sel').append('<input type="text" class="form-control search_person" data-status="student" placeholder="Enter NIS/Name">');
			} else if ($(this).val() == 'Teacher') {
				$('.search-sel').empty();
				$('.search-sel').append('<input type="text" class="form-control search_person" data-status="teacher" placeholder="Enter ID/Name">');
			}
		});

		//DISPLAY DROPDOWN FROM SELECT SEARCH BY CLASS
		var room = '';
		$('.search-sel').on('change', '#class_dd', function () {
			room = $(this).val();

			let button = '<div class="btn-absn" style="margin-top: 20px;"><a href="javascript:;" class="btn btn-circle btn-md red btn_add_absn" data-status="student"><i class="fa fa-plus"></i> Absent </a></div>';

			$.ajax({
				url: "get_tbl_byclass",
				method: "POST",
				data: {
					room
				},
				success: function (data) {
					$('.btn-absn').empty();
					$('.search-result').empty();
					$(button).insertAfter('.tbl_list');
					$('.search-result').append(data);
				}
			});
		});

		//DISPLAY RESULT BY SEARCH BY NAME (STUDENT / TEACHER)
		$('.search-sel').on('keyup', '.search_person', function () {
			let status = '';

			if ($(this).attr('data-status') === 'student') {
				status = 'student';
			} else if ($(this).attr('data-status') === 'teacher') {
				status = 'teacher';
			}

			let search = $(this).val();

			console.log(`SEARCH FOR: ${search} WITH STATUS AS: ${status}`);

			if (search == '') {
				$('.search-result').children().remove();
				$('.btn-absn').remove();
				$('.search-result').append('<tr class="gradeX odd" role="row"><td colspan = "2"> USE THE DROPDOWN / SEARCH BUTTON </td ></tr >');
			} else {
				let button = '<div class="btn-absn" style="margin-top: 20px;"><a href="javascript:;" class="btn btn-circle btn-md red btn_add_absn" data-status="' + status + '"><i class="fa fa-plus"></i> Absent </a></div>';

				$.ajax({
					url: "get_tbl_personal",
					method: "POST",
					data: {
						search: search,
						status: status
					},
					success: function (data) {
						$('.btn-absn').empty();
						$('.search-result').empty();
						$(button).insertAfter('.tbl_list');
						$('.search-result').append(data);
					}
				});
			}
		});

		var selected = [];
		var status;

		//ADD NEW ABSENT TO SELECTED PERSON FOR BOTH STUDENT & TEACHER
		$('#search-absn').on('click', '.btn_add_absn', function () {
			selected = [];
			$('.absn_list_for_submit').empty();

			if ($(this).attr('data-status') === 'student') {
				status = 'student';
			} else if ($(this).attr('data-status') === 'teacher') {
				status = 'teacher';
			}

			$('.form-check-input').each(function () {
				if ($(this).is(':checked')) {
					selected.push($(this).val());

					let id = $(this).val()
					let name = $(this).attr('data-name');
					$('.absn_list_for_submit').append(
						`<tr data-id="${id}"> 
                            <td width="1%" class="sbold"> ${id} </td>
                            <td> ${name} 
                                <a href="javascript:;" class="btn btn-icon-only cancel_list" style="color: #e7505a">
                                    <i class="fa fa-times"></i>
                                </a>
                            <td>
                        </tr>`
					);
				}
			});

			$.ajax({
				url: 'get_ids_cur_subject',
				method: 'POST',
				dataType: 'JSON',
				data: {
					room
				},
				success: data => {
					let render = ''

					data.forEach(row => {
						render += `<option value="${row.SubjName}">${row.SubjName}</option>`
					})

					$('#abs_subj').html(render)
				},
				error: data => {
					console.log(data.responseText)
				}
			})
			// let selects = $('#taginput').tagsinput('items');

			$('.sv_absent_modal').modal('show');

		});

		//Pick specific Date for New Absent Enty
		$('#pick_absent_date').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 2000,
			maxYear: parseInt(moment().format('YYYY'), 10)
		})

		//DISPLAY SPECIFIC FORM 
		$('.sv_absent_modal').on('click', 'input[type="radio"]', function () {
			if (status == 'student' && ($(this).val() == 'Truant' || $(this).val() == 'Late')) {
				$('#absent_misc').show()
			} else {
				$('#absent_misc').hide()
			}
		})

		//Remove People on List as well in the 'selected' array
		$('.absn_list_for_submit').on('click', '.cancel_list', function () {
			let id = $(this).parents('tr').attr('data-id');

			$(`tr[data-id="${id}"]`).remove();
			selected = _.without(selected, id); //Use custom library 'underscore', see CUSTOM PLUGIN for more info
		})

		//SUBMIT NEW ABSENT
		$('.submit_absent').click(function () {

			let type = $('input[name="radio2"]:checked').val();
			let new_date = $('#pick_absent_date').val();
			let subj = '';
			let time = '';

			if (type == 'Truant' || type == 'Late') {
				subj = $('#abs_subj').val();
				time = $('#abs_time').val();
			}

			if (selected.length > 0 && type != '') {
				$.ajax({
					url: 'add_absent_std',
					method: 'POST',
					data: {
						selected,
						type,
						new_date,
						subj,
						time,
						status
					},
					success: () => {
						Swal.fire({
							type: 'success',
							title: 'SUCCESS',
							text: 'ABSENT HAS BEEN ADDED'
						})

						$('.sv_absent_modal').modal('hide');

						get_personal_absent(selected[0], status);
					},
					error: data => {
						console.log(data.responseText)

						console.log(`FAILED TO ADD ABSENT: ${data}`);
						Swal.fire({
							type: 'error',
							title: 'ERROR',
							text: 'ABSENT SUBMITION FAILED DUE TO FALSE INPUT'
						})
					}
				});
			} else {
				if (type == '') {
					alert("Please check the Absent type");
				} else {
					alert("No people listed");
				}
			}
		})

		//DISPLAY FULL ABSENCE DETAILS FOR PORTLET ON CLICKED ID (STUDENT / TEACHER)
		$('.search-result').on('click', '.nis', function (e) {
			e.preventDefault();
			let id = $(this).attr('data-id');
			let status = '';

			if ($(this).attr('data-status') == 'student') {
				status = 'student';
			} else {
				status = 'teacher';
			}

			console.log(`clicked on ${id}, status: ${status}`);

			get_personal_absent(id, status);
		});

		function get_personal_absent(id, status) {
			$.ajax({
				url: "get_absn_det",
				method: "POST",
				data: {
					id,
					status
				},
				success: function (data) {
					$('.tbl_portlet_cls').empty();
					let res = $('.tbl_portlet_cls').append(data);
					res.fadeIn(500);
				}
			});
		}
	}
});
