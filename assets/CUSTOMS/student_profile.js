$(document).ready(function () {

	if ($('body').attr('data-status') == 'student') {

		//OPEN PROFILE FROM NAV-BAR
		$('.nav_profile').click(function () {
			$('a[href="#profile"]').trigger('click')
		})

		//CHANGE PASSWORD FROM NAV-BAR
		$('.nav_chg_pass').click(function () {
			$('a[href="#account"]').trigger('click')
		})

		//CALL SWEET ALERT
		function call_swal(type, title, text) {
			Swal.fire({
				type: type,
				title: title,
				text: text
			});
		}

		$.ajax({
			url: 'ajax_get_school_event',
			dataType: 'JSON',
			success: response => {
				let obj = []
				for (let key in response) {
					obj.push({
						name: response[key].Title,
						startDate: new Date(response[key].DateStart),
						endDate: new Date(response[key].DateEnd),
						color: response[key].Color
					})
				}

				new Calendar('.calendar', {
					dataSource: obj,
					mouseOnDay: function (e) {
						if (e.events.length > 0) {
							var content = '';

							for (var i in e.events) {
								content += '<div class="event-tooltip-content">' +
									'<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].name + '</div>';
							}

							$(e.element).popover({
								trigger: 'manual',
								container: 'body',
								html: true,
								content: content
							});

							$(e.element).popover('show');
						}
					},
					mouseOutDay: function (e) {
						if (e.events.length > 0) {
							$(e.element).popover('hide');
						}
					},
					style: 'background',
					displayWeekNumber: true
				})
			},
			error: err => console.log(err)
		})

		//SELECT NON REGULAR SUBJECT ON SCHEDULE
		// $('.btn_nonregular').click(function () {
		// 	let nonregular = $(this).attr('data-type')
		// 	let hour = $(this).attr('data-hour')

		// 	$('#modal_select_nonregular .modal-title').html(`SELECT ${nonregular.toUpperCase()}: <strong>${hour}</strong>`)

		// 	fetch(`get_nonregular_subjects/${nonregular}`)
		// 		.then(response => response.json())
		// 		.then(response => {
		// 			let select = $('#select_nonregular')
		// 			select.empty()
		// 			for (var key in response) {
		// 				select.append(`<option value="${response[key].SubjName}"> ${response[key].SubjName} </option>`)
		// 			}
		// 		}).catch(err => {
		// 			console.log(JSON.parse(err))
		// 		})

		// 	$('#modal_select_nonregular').modal('show')
		// })

		//================================================================================================\\
		//										MODAL PROFILE SECTION
		//================================================================================================\\

		//UPDATE NEW PASSWORD
		$('#submit_pass').click(function () {
			let oldpass = $('#oldpass').val()
			let newpass = $('#newpass').val()
			let renewpass = $('#renewpass').val()

			console.table({
				oldpass,
				newpass,
				renewpass
			})

			$.ajax({
				url: "chg_pass",
				method: "POST",
				data: {
					oldpass,
					newpass,
					renewpass
				},
				dataType: "JSON",
				success: data => {
					console.log(data.pwd)

					$('#account').children('.form-group').removeClass('has-error', 'has-success')

					if (data.code == 'empty') {
						$('#account').children('.form-group').addClass('has-error')
					} else if (data.code == 'incorrect') {
						$('#oldpass').parent('.form-group').addClass('has-error')
					} else if (data.code == 'identical') {
						$('#oldpass').parent('.form-group').addClass('has-error')
						$('#newpass').parent('.form-group').addClass('has-error')
					} else if (data.code == 'reconfirm') {
						$('#newpass').parent('.form-group').addClass('has-error')
						$('#renewpass').parent('.form-group').addClass('has-error')
					} else if (data.code == 'success') {
						$('.password').val('')
					}

					call_swal(data.type, data.title, data.text)
				},
				error: () => {
					console.log("AJAX Schedule doesn't work properly");
				}
			});
		})

		//================================================================================================\\
		//										MODAL ACADEMIC SECTION
		//================================================================================================\\

		//GET ACADEMIC DETAILS ON MODAL OPEN
		$('a[href="#full2"]').click(function () {
			let semester = $('#select_period').children('option:selected').attr('data-sem')
			let period = $('#select_period').children('option:selected').attr('data-period')

			get_full_acd_detail(id, semester, period)
		})

		//GET ACADEMIC DETAILS BASED ON SELECTION
		$('#select_period').change(function () {
			let semester = $('#select_period').children('option:selected').attr('data-sem')
			let period = $('#select_period').children('option:selected').attr('data-period')

			get_full_acd_detail(id, semester, period)
		})

		//AJAX GET FULL ACADEMIC DETAILS
		function get_full_acd_detail(id, semester, period) {
			$('.sch_caption').html(`SCHEDULE CLASS "${fullname} | ${id}", Semester ${semester} - Period ${period}`)

			$.ajax({
				url: 'get_full_acd_detail',
				method: 'POST',
				data: {
					id,
					semester,
					period
				},
				dataType: 'JSON',
				success: data => {
					//SCHEDULE
					$('.sch_tbody').html(data.SCH)

					//STUDENT GRADES
					$('.grade_report_tbody').html(data.COG)
					$('.skills_report_tbody').html(data.SK)
					$('.soc_report_tbody').html(data.SOC)
					$('.spr_report_tbody').html(data.SPR)
					$('.voc_report_tbody').html(data.VOC)

					//ABSENCE
					$('.abs_tbody').html(data.ABS)
				},
				error: data => {
					//console.log(data.responseText)
				}
			})
		}

		//================================================================================================\\
		//										UPLOAD TUITION
		//================================================================================================\\
		
		$('#submit_tuition').click(function(){
            var form_data = new FormData()
			
			let id = $('#photo').attr('data-id')
			let fname = $('#photo').attr('data-fname')
			let lname = $('#photo').attr('data-lname')

			var file_data = $('#photo').prop('files')[0];

			form_data.append('id', id)
			form_data.append('fname', fname)
			form_data.append('lname', lname)
			form_data.append('file', file_data)

			$.ajax({
				url: `ajax_submit_tuition?id=${id}&fname=${fname}&lname=${lname}`,
				type: 'POST',
				data: form_data,
				contentType: false,
				processData: false,
				data: form_data,
				success: response => {
					if(response == 'success'){
						alert("UPLOAD SUCCESS")

						location.reload()
					}else{
						alert("SERVER PROBLEM")
					}
				},
				error: () => alert('NETWORK PROBLEM')
			})
        })
	}
});
