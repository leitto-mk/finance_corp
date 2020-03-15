$(document).ready(function () {

	if ($('body').attr('data-status') !== 'student') {

		//EXECUTE LOAD ON START
		get_student($('.compact_rooms').first().val())

		//OPEN PROFILE FROM NAV-BAR
		$('.nav_profile').click(function () {
			$('a[href="#profile"]').trigger('click')
		})

		//CHANGE PASSWORD FROM NAV-BAR
		$('.nav_chg_pass').click(function () {
			$('a[href="#account"]').trigger('click')
		})

		//GET STUDENT LIST ON COMPACT ROOM SELECT OPT
		$('.compact_rooms').change(event => get_student(event.target.value, event.target.getAttribute('id')))

		//COMPACT ATTENDANCE SUBMIT
		$('#attd_submit_compact').click(function () {
			let semester = cur_sem
			let period = cur_per
			let attd_room = $('#attd_rooms_compact').val()
			let checked = []
			checked[0] = $('#attd_student').val()
			let reason = $('[name="absent_reason"]:checked').val()
			let subj = ''
			let time = ''

			if (reason == 'Truant' || reason == 'Late') {
				subj = $('#attd_subj_compact').val()
				time = $('#attd_hour_compact').val()
			}

			let date = $('#attd_absent_compact').val()

			console.table({
				semester,
				period,
				attd_room,
				checked,
				reason,
				subj,
				time,
				date
			})

			submit_attendance(semester, period, attd_room, checked, reason, subj, time, date)
		})

		//GET KD DETAILS ON SUBJECT / KD CHANGES
		$('#grade_subj_compact').change(() => get_kd_details())
		$('#grade_type_compact').change(() => get_cat_details())

		//LOAD STUDENT BASED ON CLASS DROPDOWN ON COMPACT
		function get_student(room, compact) {

			let sel_student = (compact == 'grade_rooms_compact' ? '#grade_student' : '#attd_student')

			$.ajax({
				url: 'get_student_compact',
				method: 'POST',
				dataType: 'JSON',
				data: {
					room
				},
				error: data => {
					console.log(data.responseText)
				}
			}).then(data => {
				let disp = ''

				if (data.length == 0) {
					(compact == undefined ? $('#grade_student, #attd_student').empty() : $(sel_student).empty())
				} else {
					data.forEach(row => {
						disp += `<option value="${row.NIS}">${row.FullName}</option>`
					})
				}

				(compact == undefined ? $('#grade_student, #attd_student').html(disp) : $(sel_student).html(disp))
			}).then(() => {
				(compact == undefined ?
					$('#grade_student, #attd_student').selectpicker('refresh') : $(sel_student).selectpicker('refresh'))
			}).then(() => {
				if (compact != 'attd_rooms_compact') {
					get_kd_details()
				}
			})
		}

		function get_kd_details() {
			let id = $('#grade_student').val()
			let room = $('#grade_rooms_compact').val()
			let subj = $('#grade_subj_compact').val()
			let type = $('#grade_type_compact').val()
			let field = $('#grade_cat_compact').val()

			$.ajax({
				url: 'get_kd_details',
				method: 'POST',
				dataType: 'JSON',
				async: 'FALSE',
				data: {
					id,
					room,
					subj
				},
				error: data => {
					console.log(data.responseText)
				}
			}).then(data => {
				let renderCog = ''
				let renderSK = ''

				data.forEach(row => {
					if (row.Type == 'cognitive') {
						renderCog += `<option data-type="cognitive" value="${row.Code}"><strong>${row.Code}<strong> | ${row.KD} </option>`
					} else {
						renderSK += `<option data-type="skills" value="${row.Code}"><strong>${row.Code}<strong> | ${row.KD} </option>`
					}
				})

				$('#grade_type_compact optgroup[label="Pengetahuan"]').html(renderCog)
				$('#grade_type_compact optgroup[label="Keterampilan"]').html(renderSK)
			}).then(() => {
				get_cat_details()
			})
		}

		function get_cat_details() {
			let id = $('#grade_student').val()
			let room = $('#grade_rooms_compact').val()
			let subj = $('#grade_subj_compact').val()

			$.ajax({
				url: 'get_kd_details',
				method: 'POST',
				dataType: 'JSON',
				async: 'FALSE',
				data: {
					id,
					room,
					subj
				},
				success: data => {
					let sel_kd_type = $('#grade_type_compact option:selected').attr('data-type')
					let sel_kd_code = $('#grade_type_compact').val()
					let renderCat = ''

					data.forEach(row => {
						if (row.Code == sel_kd_code && row.Type == sel_kd_type) {
							renderCat += `<option data-field="Grade1" value="Weight1_Desc"> ${(row.Weight1_Desc == '' ? 'Kat. 1 (No Desc)' : row.Weight1_Desc)} </option>`
							renderCat += `<option data-field="Grade2" value="Weight2_Desc"> ${(row.Weight2_Desc == '' ? 'Kat. 2 (No Desc)' : row.Weight2_Desc)} </option>`
							renderCat += `<option data-field="Grade3" value="Weight3_Desc"> ${(row.Weight3_Desc == '' ? 'Kat. 3 (No Desc)' : row.Weight3_Desc)} </option>`
						}
					})

					$('#grade_cat_compact').html(renderCat)
				},
				error: data => {
					console.log(data.responseText)
				}
			})
		}

		//SUBMIT GRADE COMPACT
		$('#submit_grade_compact').click(function (e) {
			e.preventDefault()

			let obj = {
				nis: $('#grade_student').val(),
				fullname: $('#grade_student option:selected').text(),
				semester: cur_sem,
				cls: $('#grade_rooms_compact option:selected').attr('data-cls'),
				room: $('#grade_rooms_compact').val(),
				subj: $('#grade_subj_compact').val(),
				type: $('#grade_type_compact option:selected').attr('data-type'),
				code: $('#grade_type_compact').val(),
				field: $('#grade_cat_compact option:selected').attr('data-field'),
				val: $('#input_grade_compact').val()
			}

			//console.table(obj)

			let i = 0
			let proceed = true
			for (i in obj) {
				if (obj[i] == '') {
					proceed = false
				}
			}

			if (proceed) {
				$.ajax({
					url: 'sv_std_kd_grades',
					method: 'POST',
					data: obj,
					success: data => {
						if (data == 'success') {
							call_swal('success', 'GRADE SUBMITTED', '')
						} else {
							console.log(data.responseText)
						}
					},
					error: data => {
						console.log(data.responseText)
					}
				})
			} else {
				call_swal('error', 'SUBMIT FAILED', 'make sure to fill all the form and input properly')
			}
		})

		//CALL SWEET ALERT
		function call_swal(type, title, text) {
			Swal.fire({
				type: type,
				title: title,
				text: text
			});
		}

		//GET TABLE STUDENTS GRADE REPORTS
		$('#student_reports').DataTable({
			processing: true,
			serverSide: true,
			length: 10,
			info: false, //Hide bottom left entries' info
			ajax: {
				url: 'ajx_datatable_get_student_reports',
				method: 'GET',
				dataSrc: '',
				error: response => {
					alert("CANNOT RETRIEVE DATA FROM SERVER")
					console.log(response.responseText)
				}	
			},
			columns: [
				{
					data: 'IDNumber',
					orderable: false
				},
				{
					data: 'FullName',
					orderable: false
				},
				{
					data: 'Kelas',
					orderable: false
				},
				{
					data: 'Ruangan',
					orderable: false
				},
				{
					orderable: false,
					data: response => `<div class="btn-group pull-right">
							<button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown" id="btn_report">Reports
								<i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right">
								<li>
									<a href="javascript:;" target="_blank" 
										class="print_mid"
										data-id="${response.IDNumber}"
										data-cls="${response.Kelas}">
										<i class="fa fa-print"></i> Mid Report </a>
								</li>
								<li>
									<a href="javascript:;" target="_blank" 
										class="print_final"
										data-id="${response.IDNumber}"
										data-cls="${response.Kelas}">
										<i class="fa fa-print"></i> Final Report </a>
								</li>
							</ul>
						</div>`
				}
			]
		})

		//DISPLAY PRINT MID SEMESTER RESULT
		$('#student_reports').on('click', '.print_mid', function (e) {
			e.preventDefault()
			let id = $(this).attr('data-id')
			let cls = $(this).attr('data-cls')
			let subj = ''
			let semester = cur_sem

			let header = `nis=${id}&cls=${cls}&subj=${subj}&semester=${semester}`
			let url = `${base_url}Teacher/display_report_mid_print?${header}`
			
			window.open(url)
		})

		//DISPLAY FINAL RESULT
		$('#student_reports').on('click','.print_final', function(e){
			e.preventDefault()

			let id = $(this).attr('data-id')
			let cls = $(this).attr('data-cls')
			let semester = cur_sem
			var cur_subj = $('#grade_subj_compact > option')
			let swal_list = {}

			for(let i = 0; i < cur_subj.length; i++){
				//Push to Object, Output would be => {'Matematika': 'Matematika','Komputer': 'Komputer',....}
				swal_list[cur_subj.eq(i).val()] = cur_subj.eq(i).val() 
			}
			
			Swal.fire({
				title: 'Select Subject',
				input: 'select',
				inputOptions: swal_list,
				showCancelButton: true
			}).then(result => {
				if(result.value) {
					let subj = result.value
					let header = `nis=${id}&cls=${cls}&subj=${subj}&semester=${semester}`
					let url = `${base_url}Teacher/display_report_print?${header}`
					window.open(url)
				}
			})
		})

		//================================================================================================\\
		//										MODAL PROFILE SECTION
		//================================================================================================\\

		//UPDATE NEW PASSWORD
		$('#submit_pass').click(function () {
			let oldpass = $('#oldpass').val()
			let newpass = $('#newpass').val()
			let renewpass = $('#renewpass').val()

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
					alert("SOMETHING'S WRONG")
				}
			});
		})

		//================================================================================================\\
		//										MODAL ACADEMIC SECTION
		//================================================================================================\\

		//GET ACADEMIC DETAILS ON MODAL OPEN
		$('a[href="#full2"]').click(() => get_full_acd_detail())
		$('.full2 .selected_period').change(() => get_full_acd_detail())
		$('.full2 .attd_rooms').change(() => get_full_acd_detail())

		//GET FULL GRADING ONLY
		$('.selected_rooms, .selected_subj').change(() => get_full_grading())
		$('#grades [type="radio"]').click(() => get_full_grading())


		//GET ALL INFO FROM ACADEMIC MODAL
		function get_full_acd_detail() {
			let semester = $('.selected_period option:selected').attr('data-sem')
			let period = $('.selected_period option:selected').attr('data-period')

			let attd_room = $('.attd_rooms').val()

			// console.log(attd_room)
			$('.sch_caption').html(`TIMETABLE - ${fullname}, Semester ${semester} - Period ${period}`)

			//DESTROY PREVIOUS DATATABLE
			$('#abs_table').DataTable().destroy()

			$.ajax({
				url: 'get_full_acd_details',
				method: 'POST',
				dataType: 'JSON',
				data: {
					semester,
					period,
					room: attd_room //FOR ATTENDANCE
				},
				success: data => {
					//SCHEDULE
					$('.sche_tbody').html(data.schedule)

					//STUDENT GRADES
					get_full_grading()

					//Add New Property (Index, Check) to Object 'data.attendance'
					for (let i = 0; i < data.attendance.length; i++) {
						Object.assign(data.attendance[i], {
							'Index': i + 1,
							'Check': `	<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
        						            <input type="checkbox" class="checkboxes" value="${data.attendance[i].NIS}" />
        						            <span></span>
        						        </label>`
						})
					}
				},
				error: data => {
					console.log(data.responseText)
				}
			}).then(data => {
				$('#abs_table').DataTable({
					colReorder: true,
					//responsive: true,
					data: data.attendance,
					columns: [{
							data: 'Check'
						},
						{
							data: 'Index'
						},
						{
							data: 'NIS',
							render: rows => {
								return `<a href="javascript:;" class="fa fa-plus-circle abs_row" data-id="${rows}" style="text-decoration: none">
                                        </a> &nbsp;&nbsp;${rows}`
							}
						},
						{
							data: 'FullName'
						},
						{
							data: 'Total'
						}
					],
					columnDefs: [{
						targets: 0,
						orderable: false
					}]
				})
			})
		}

		/* 
		%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
							GRADING SCRIPT
		%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
		*/

		//LOAD FULL GRADING TABLE
		function get_full_grading() {
			let semester = $('.selected_period option:selected').attr('data-sem')
			let period = $('.selected_period option:selected').attr('data-period')

			let room = $('.selected_rooms').val()
			let subj = $('.selected_subj').val()
			let type = $('input[name="grade_type"]:checked').val()

			let method = '';
			if (type == 'cognitive') {
				method = 'get_full_table_grading_cognitive'
			} else if (type == 'skills') {
				method = 'get_full_table_grading_skills'
			} else if (type == 'character') {
				method = 'get_full_table_grading_character'
			}

			let current_tab = $('#grade_inner_tab .active')

			$.ajax({
				url: method,
				method: 'POST',
				dataType: 'JSON',
				data: {
					semester: semester,
					period,
					cls: room,
					subj: subj,
					type: type
				},
				success: data => {
					if (type == 'cognitive') {
						$('a[href="#grade"]').show()
						$('a[href="#grade"]').text('Grade')
						$('a[href="#recap"]').text('Recap')
						$('a[href="#predicate"]').text('Predicate')

						$('.grade_data').html(data.full)
						$('.recap_data').html(data.recap)
						$('.predicate_data').html(data.summary)
					} else if (type == 'skills') {
						$('a[href="#grade"]').hide()
						$('a[href="#recap"]').text('Grade')
						$('a[href="#predicate"]').text('Predicate')

						$('.recap_data').html(data.recap)
						$('.predicate_data').html(data.summary)
					} else if (type == 'character') {
						$('a[href="#grade"]').hide()
						$('a[href="#recap"]').text('Social')
						$('a[href="#predicate"]').text('Spiritual')

						$('.recap_data').html(
							`<thead>
								<tr>
									<td colspan="2" class="text-center"><b>NOMOR</b></td>
									<td rowspan="2" class="text-center"><b>NAMA</b></td>
									<td colspan="7" class="text-center"><b>REKAP PENILAIAN SIKAP SOSIAL</b></td>
									<td rowspan="2" class="sbold text-center">NILAI</td>
									<td rowspan="2" class="sbold text-center">PREDIKAT</td>
									<td rowspan="2" class="sbold text-center">DESKRIPSI</td>
								</tr>
								<tr>
									<td class="text-center"><b> URT </b></td>
									<td class="text-center"><b> INDUK </b></td>
									<td><b>Jujur</b></td>
									<td><b>Disiplin</b></td>
									<td><b>Tanggung Jawab</b></td>
									<td><b>Toleransi</b></td>
									<td><b>Gotong Royong</b></td>
									<td><b>Santun</b></td>
									<td><b>Percaya Diri</b></td>
								</tr>
							</thead>
							${data.SOC}`)
						$('.predicate_data').html(
							`<thead>
								<tr>
									<td colspan="2" class="text-center"><b>NOMOR</b></td>
									<td rowspan="2" class="text-center"><b>NAMA</b></td>
									<td colspan="5" class="text-center"><b>PENILAIAN SIKAP SPIRITUAL</b></td>
									<td rowspan="2" class="sbold text-center">NILAI</td>
									<td rowspan="2" class="sbold text-center">PREDIKAT</td>
									<td rowspan="2" class="sbold text-center">DESKRIPSI</td>
								</tr>
								<tr>
									<td rowspan="4" class="text-center"><b> URT </b></td>
									<td rowspan="4" class="text-center"><b> INDUK </b></td>
									<td><b>Berdoa sebelum melakukan kegiatan</b></td>
									<td><b>Bersyukur setelah beraktivitas</b></td>
									<td><b>Toleran pada agama yang berbeda</b></td>
									<td><b>Taat beribadah</b></td>
									<td><b>Memberi Salam dan bertegur sapa</b></td>
								</tr>
							</thead>
							${data.SPR}`)
					}
				},
				error: data => {
					console.log(data.responseText)
				}
			}).then(() => {
				if (current_tab.children().is('a[href="#grade"]')) {
					current_tab.removeClass('active')
					current_tab = $('#grade_inner_tab li').eq(1).addClass('active')
					current_tab.trigger('click')
				} else {
					current_tab.trigger('click')
				}
			})
		}

		//EDIT KD'S WEIGHT + KD's Description (COGNITIVE)
		$('#grade').on('keypress', 'thead td[contenteditable="true"]', function (e) {
			if (e.keyCode == 13) {
				e.preventDefault()

				let semester = $('.selected_period option:selected').attr('data-sem')
				let period = $('.selected_period option:selected').attr('data-period')
				let room = $('.selected_rooms').val()
				let subj = $('.selected_subj').val()
				let type = $('input[name="grade_type"]:checked').val()
				let code = $(this).attr('data-code')
				let field = $(this).attr('data-field')
				let value = $(this).text()
				value = value.replace(/\s+/g, '')

				// console.table({semester,period,room,subj,type,code,field,value})

				$.ajax({
					url: 'update_kd_weight',
					method: 'POST',
					data: {
						room,
						semester,
						period,
						type,
						subj,
						code,
						field,
						value
					},
					error: data => {
						console.log(data.responseText)
					}
				}).then(data => {
					if (data == 'success') {
						call_swal('success', 'UPDATED', `Weight for ${code} has been updated`)
					} else {
						call_swal('error', 'FAILED', `Something's Wrong`)
					}
				}).then(() => get_full_grading())
			}
		})

		//EDIT KD'S FULL RECAP WEIGHT (SKILLS)
		$('#recap').on('keypress', 'thead td[contenteditable="true"]', function (e) {
			if (e.keyCode == 13 && !$(this).is('.kd_desc_sk')) {
				e.preventDefault() //Prevent 'enter' button to execute next line

				let semester = $('.selected_period option:selected').attr('data-sem')
				let period = $('.selected_period option:selected').attr('data-period')
				let room = $('.selected_rooms').val()
				let subj = $('.selected_subj').val()
				let field = $(this).attr('data-field')
				let value = $(this).text()
				value = value.replace(/\s+/g, '')

				// console.table({
				// 	semester,
				// 	period,
				// 	room,
				// 	subj,
				// 	field,
				// 	value
				// })

				$.ajax({
					url: 'update_recap_weight',
					method: 'POST',
					data: {
						semester,
						period,
						room,
						subj,
						field,
						value
					},
					error: data => {
						console.log(data.responseText)
					}
				}).then(data => {
					if (data == 'success') {
						call_swal('success', 'UPDATED', `Weight for Skill Recap has been updated`)
					} else {
						call_swal('error', 'FAILED', `Something's Wrong`)
					}
				}).then(() => get_full_grading())
			}
		})

		//EDIT KD'S DESCRIPTION (SKILLS)
		$('#recap').on('keypress', '.kd_desc_sk', function (e) {
			if (e.keyCode == 13) {
				e.preventDefault();

				let semester = $('.selected_period option:selected').attr('data-sem')
				let period = $('.selected_period option:selected').attr('data-period')
				let room = $('.selected_rooms').val()
				let type = $(this).attr('data-type')
				let subj = $(this).attr('data-subj')
				let code = $(this).attr('data-code')
				let field = $(this).attr('data-field')
				let value = $(this).text()

				$.ajax({
					url: 'update_kd_weight',
					method: 'POST',
					data: {
						semester,
						period,
						room,
						type,
						subj,
						code,
						field,
						value
					},
					error: data => {
						console.log(data.responseText)
					}
				}).then(data => {
					if (data == 'success') {
						call_swal('success', 'UPDATED', `KD's Skill Description has been updated`)
					} else {
						call_swal('error', 'FAILED', `Something's Wrong`)
					}
				}).then(() => get_full_grading())
			}
		})

		//ADD / EDIT FULL GRADES (COGNITIVE & SKILL)
		$('#grade, #recap').on('keypress', '.table_body', function (e) {
			if (e.keyCode == 13) {
				e.preventDefault()

				//Vars for both KD and Exams
				let semester = $('.selected_period option:selected').attr('data-sem')
				let period = $('.selected_period option:selected').attr('data-period')
				let room = $('.selected_rooms').val()
				let subj = $('.selected_subj').val()
				let row = $(this).attr('data-row')
				let nis = $(this).siblings().eq(1).text()
				nis = nis.replace(/\s+/g, '')
				let cls = $(this).parent('tr').attr('data-class')
				let type = $('input[name="grade_type"]:checked').val()
				let field = $(this).attr('data-field')
				let val = $(this).text()
				val = val.replace(/\s+/g, '')

				let ctrl
				let obj

				if (row == 'kd') {
					//Declare these vars only when it's saving for KD's Grade
					let fullname = $(this).siblings().eq(2).text()
					let code = $(this).attr('data-code')
					code = code.replace(/\s+/g, '')

					ctrl = 'sv_std_kd_grades'
					obj = {
						row,
						nis,
						semester,
						period,
						fullname,
						cls,
						room,
						subj,
						type,
						code,
						field,
						val
					}
				} else {
					ctrl = 'sv_std_exam_grades'
					obj = {
						row,
						cls,
						nis,
						semester,
						period,
						room,
						subj,
						type,
						field,
						val
					}
				}

				$.ajax({
					url: ctrl,
					method: 'POST',
					data: obj,
					error: data => {
						console.log(data.responseText)
					}
				}).then(data => {
					if (data == 'success') {
						get_full_grading()
					} else {
						call_swal('error', 'FAILED', `Something's Wrong`)
					}
				})
			}
		})

		//ADD / EDIT CHARACTER GRADES
		$('#grades').on('keypress', '.data_soc_char, .data_spr_char', function (e) {
			if (e.keyCode == 13) {
				e.preventDefault()

				let semester = $('.selected_period option:selected').attr('data-sem')
				let period = $('.selected_period option:selected').attr('data-period')
				let room = $('.selected_rooms').val()
				let subj = $('.selected_subj').val()
				let char_type = $(this).attr('data-type')

				let nis = $(this).siblings().eq(1).text()
				nis = nis.replace(/\s+/g, '')
				let name = $(this).siblings().eq(2).text()
				let desc = $(this).attr('data-desc')
				let value = $(this).text()
				value = value.replace(/\s+/g, '')

				if (isNaN(value) || value < 1 || value > 4) {
					alert("only number 1 - 4 is allowed")
				} else {
					$.ajax({
						url: 'sv_std_char_grades',
						method: 'POST',
						data: {
							nis,
							name,
							semester,
							period,
							subj,
							room,
							type: char_type,
							desc,
							value
						},
						error: data => {
							console.log(data.responseText)
						}
					}).then(data => {
						if (data == 'success') {
							get_full_grading()
						} else {
							call_swal('error', 'FAILED', `Something's Wrong`)
						}
					})
				}
			}
		})

		/* 
		%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
							ATTENDANCE SCRIPT
		%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
		*/

		//SHOW ADDITIONAL FORM ON SPECIFIC RADIO SELECTED (COMPACT + FULL)
		$('#absent [name="attendance"], [name="absent_reason"]').click(function () {
			if ($(this).val() == 'Truant' || $(this).val() == 'Late') {
				$('#specific_attd, #specific_attd_compact').show()
			} else {
				$('#specific_attd, #specific_attd_compact').hide()
			}
		})

		function renderAbsentChild(data) {
			let child = ''
			let label = ''

			child += `<ul class="list-group" style="margin: 0px 5px">`
			if (data.length == 0) {
				child += `	<li class="list-group-item" align="left"> 
								This student has perfect attendance!
							</li>`
			} else {
				for (let i = 0; i < data.length; i++) {
					if (data[i].Ket == 'Sick') {
						label = 'badge-warning'
					} else if (data[i].Ket == 'Absent') {
						label = 'badge-danger'
					} else if (data[i].Ket == 'On Permit') {
						label = 'badge-success'
					} else if (data[i].Ket == 'Truant') {
						label = 'badge-primary'
					} else if (data[i].Ket == 'Late') {
						label = 'badge-info'
					}

					child += `	<li class="list-group-item" align="left"> 
										${data[i].Absent} | 
										${(data[i].SubjDesc == undefined) ? '-' : data[i].SubjDesc} | 
										${(data[i].Hour == undefined) ? '-' : data[i].Hour}
									<span class="badge ${label}"> 
										${data[i].Ket} 
										<a href="javascript:;" class="fa fa-times delete_absn" 
										data-id="${data[i].NIS}"
										data-date="${data[i].Absent}" 
										data-reason="${data[i].Ket}"
										data-subj="${data[i].SubjDesc}" 
										data-hour="${data[i].Hour}" 
										style="color: white;text-decoration: none"></a>
									</span>
								</li>`
				}
			}
			child += `</ul>`

			return child
		}

		//SHOW CHILD ROW DATATABLE
		$('#absent').on('click', '.abs_row', function () {
			let id = $(this).attr('data-id')
			let semester = $('.selected_period option:selected').attr('data-sem')
			let period = $('.selected_period option:selected').attr('data-period')
			let attd_room = $('.attd_rooms').val()

			let table = $('#abs_table').DataTable()
			let row = table.row($(this).closest('tr'))

			if (row.child.isShown()) {
				$(this).removeClass('fa-minus-circle red')
				$(this).addClass('fa-plus-circle blue')

				row.child.hide()
				tr.removeClass('shown')
			} else {
				$(this).removeClass('fa-plus-circle blue')
				$(this).addClass('fa-minus-circle red')

				$.ajax({
					url: 'get_absn_det',
					method: 'POST',
					dataType: 'JSON',
					data: {
						id,
						semester,
						period,
						room: attd_room,
					},
					error: data => {
						console.log(data.responseText)
					}
				}).then(data => {
					row.child(renderAbsentChild(data)).show()
				})
			}
		})

		//SUBMIT ABSENT
		$('#absent button[type="submit"]').click(function () {
			let semester = $('.selected_period option:selected').attr('data-sem')
			let period = $('.selected_period option:selected').attr('data-period')
			let attd_room = $('.attd_rooms').val()
			let checked = []
			checked[0] = $('input .checkboxes:checked').val()
			let reason = $('[name="attendance"]:checked').val()
			let subj = ''
			let time = ''

			if (reason == 'Truant' || reason == 'Late') {
				time = $('[name="time_abs"]').val()
				subj = $('.abs_subj').val()
			}

			let date = $('input[name="date_abs"]').val()

			$('.checkboxes:checked').each(function (i) {
				checked[i] = $(this).val()
			})

			console.table({
				semester,
				period,
				attd_room,
				checked,
				reason,
				subj,
				time,
				date
			})

			if (checked.length == 0 || reason == '' || date == '') {
				call_swal('error', 'CANNOT PROCEED', 'Make sure the requested form are filled and have at least 1 student selected from the table')
			} else {
				submit_attendance(semester, period, attd_room, checked, reason, subj, time, date)
			}
		})

		function submit_attendance(semester, period, attd_room, checked, reason, subj, time, date) {
			$.ajax({
				url: 'add_absent_std',
				method: 'POST',
				dataType: 'JSON',
				data: {
					semester,
					period,
					room: attd_room,
					checked,
					reason,
					subj,
					time,
					date
				},
				success: data => {
					console.log(data)
					if (data == 'success') {
						call_swal('success', 'SUBMITED', 'New Absent has been added')
					}
				},
				error: data => {
					console.log(data.responseText)
				}
			}).then(() => get_full_acd_detail())
		}

		//DELETE ABSENT
		$('#absent').on('click', '.delete_absn', function () {
			let result = window.confirm('Confirm deletion ?')

			if (result == true) {
				let id = $(this).attr('data-id')
				let date = $(this).attr('data-date')
				let reason = $(this).attr('data-reason')
				let subj = $(this).attr('data-subj')
				let hour = $(this).attr('data-hour')
				let semester = $('.selected_period option:selected').attr('data-sem')
				let period = $('.selected_period option:selected').attr('data-period')
				let attd_room = $('.attd_rooms').val()

				$.ajax({
					url: 'delete_absn',
					method: 'POST',
					data: {
						id,
						date,
						reason,
						subj,
						hour,
						semester,
						period,
						room: attd_room
					},
					error: data => {
						console.log(data.responseText)
					}
				}).then(data => {
					if (data == 'success') {
						call_swal('success', 'DELETED', 'Delete successfull')
					}
				}).then(() => get_full_acd_detail())
			}
		})
	}
});
