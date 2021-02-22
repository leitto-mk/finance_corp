$(document).ready(function () {
	var current = window.location.href
	// if the current path is exactly indentical with href, make the navbar and its subs active
	$('.subnav').each(function () {
		var curpath = $(this).attr('href')
		if (curpath === current) {
			$(this).parents('.main').addClass('active open selected')
			$(this).parent().addClass('active')
		}
	})

	if($('div').is('.dashboard')){

		//SUBMIT NEW EVENT(S) FOR SCHOOL CALENDAR
		$('#submit_calendar').on('click', function (e) {
			e.preventDefault()

			let title = $('#event_title').val()
			let date_start = $('#event_date_start').val()
			let date_end = $('#event_date_end').val()
			let color = $('#event_color').val()

			let begin = new Date(date_start)
			let end = new Date(date_end)

			if (begin > end) {
				alert("START MUST BE HIGHER THAN END")
			} else {
				$.ajax({
					url: 'ajax_sv_school_event',
					method: 'POST',
					data: {
						title,
						date_start,
						date_end,
						color
					},
					success: response => {
						if (response == 'success') {
							alert("NEW EVENT HAS BEEN ADDED !")
							getCalendar()
						} else {
							alert("SOMETHING'S WRONG")
							console.log(response)
						}
					},
					error: err => console.log(err.responseText)
				})
			}
		})

		getCalendar()

		function getCalendar() {
			// $.get('https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json') //Get JSON
			// 	.then(data => {
			// 		let holidays = []
			// 		let parsed = JSON.parse(data)

			// 		for (var key in parsed) {
			// 			holidays.push({
			// 				title: parsed[key].deskripsi,
			// 				start: key.slice(0, 4) + '-' + key.slice(4, 6) + '-' + key.slice(6, 8),
			// 				backgroundColor: '#fd5c63'
			// 			})
			// 		}

			// 		$('#calendar').fullCalendar('destroy')
			// 		$('#calendar').fullCalendar({
			// 			disableDragging: true,
			// 			header: {
			// 				left: 'title',
			// 				center: '',
			// 				right: 'prev,next,today,month'
			// 			},
			// 			contentHeight: 550,
			// 			events: holidays, //Set arrray holidays to events
			// 		})
			// 	})

			$.ajax({
				url: 'ajax_get_school_event',
				dataType: 'JSON',
				success: response => {
					let sch_event = []

					for (var key in response) {
						sch_event.push({
							title: response[key].Title,
							start: response[key].DateStart,
							end: response[key].DateEnd,
							backgroundColor: response[key].Color
						})
					}

					$('#calendar').fullCalendar('destroy')
					$('#calendar').fullCalendar({
						// editable: true,
						header: {
							left: 'month, basicDay, basicWeek, today',
							center: '',
							right: 'title, prev, next',
						},
						contentHeight: 550,
						events: sch_event, //Set arrray sch_event to events
						eventClick: info => {
							let title = info.title
							let start = info.start._i
							let end = (info.end == null ? info.start._i : info.end._i) //Use start value if selected event only a single day
							let color = info.backgroundColor

							$('#calendar_action').modal('show')
							$('#eventchange_title').val(title)
							$('#eventchange_date_start').val(start)
							$('#eventchange_date_end').val(end)
							$('#eventchange_color').val(color)

							submitCalendarChange(title, start, end)
						}
					})
				},
				error: err => console.log(err.responseText)
			})
		}

		//CHANGE/DELETE CALENDAR EVENT
		$('[name="calendarradio"]').change(function () {
			if ($(this).val() == 'delete') {
				$('#eventchange').prop('hidden', true)
			} else {
				$('#eventchange').prop('hidden', false)
			}
		})

		function submitCalendarChange(title, start, end) {
			$('#submitcalendarchange').click(function () {
				let eventchange = $('[name="calendarradio"]:checked').val()

				let newtitle = $('#eventchange_title').val()
				let newstart = $('#eventchange_date_start').val()
				let newend = $('#eventchange_date_end').val()
				let newcolor = $('#eventchange_color').val()

				let newchangestart = new Date(newstart)
				let newchangeend = new Date(newend)

				if (newchangestart > newchangeend) {
					alert("START MUST BE HIGHER THAN END")
				} else {
					$.ajax({
						url: 'ajax_update_school_event',
						method: 'POST',
						data: {
							eventchange,
							title,
							newtitle,
							start,
							newstart,
							end,
							newend,
							newcolor
						},
						success: response => {
							if (response == 'success') {
								getCalendar()
							} else {
								alert("SOMETHING'S WRONG")
								console.log(response)
							}
							$('#calendar_action').modal('hide')
						},
						error: err => console.log(err.responseText)
					})
				}
			})
		}

		$.get('getChart')
			.then(data => {
				data = JSON.parse(data)
				let chartPie = []
				let chartBar = []

				for (let key in data.pie) {
					chartPie.push({
						"rooms": data.pie[key].Ruangan,
						"value": data.pie[key].Total
					})
				}

				for (let key in data.bar) {
					chartBar.push({
						"semester": data.bar[key].Semester,
						"total": data.bar[key].Total,
						"period": data.bar[key].schoolyear
					})
				}

				AmCharts.makeChart('chart_7', {
					"type": "pie",
					"theme": "light",
					"fontFamily": 'Open Sans',
					"color": '#888',
					"valueField": "value",
					"titleField": "rooms",
					"dataProvider": chartPie,
					"outlineAlpha": 0.5,
					"depth3D": 15,
					"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]] students</b> ([[percents]]%)</span>",
					"angle": 30,
					"exportConfig": {
						menuItems: [{
							icon: '/lib/3/images/export.png',
							format: 'png'
						}]
					}
				});

				AmCharts.makeChart("chart_1", {
					"type": "serial",
					"theme": "light",
					"pathToImages": App.getGlobalPluginsPath() + "amcharts/amcharts/images/",
					"autoMargins": true,
					// "marginLeft": 30,
					// "marginRight": 8,
					// "marginTop": 10,
					// "marginBottom": 26,
					"fontFamily": 'Open Sans',
					"color": '#888',
					"dataProvider": chartBar,
					"valueAxes": [{
						"axisAlpha": 0,
						"position": "left"
					}],
					"graphs": [{
						"title": "students",
						"type": "column",
						"valueField": "total",
						"alphaField": "alpha",
						"balloonText": `<span style='font-size:13px;'>[[title]] in semester [[semester]]: <b>[[value]]</b> [[additional]]</span>`,
						"dashLengthField": "dashLengthColumn",
						"fillAlphas": 1
					}, {
						"balloonText": `<span style='font-size:13px;'>[[title]] in semester [[semester]]: <b>[[value]]</b> [[additional]]</span>`,
						"bullet": "round",
						"dashLengthField": "dashLengthLine",
						"lineThickness": 3,
						"bulletSize": 7,
						"bulletBorderAlpha": 1,
						"bulletColor": "#FFFFFF",
						"useLineColorForBulletBorder": true,
						"bulletBorderThickness": 3,
						"fillAlphas": 0,
						"lineAlpha": 1,
						"title": "period",
						"valueField": "semester"
					}],
					"categoryField": "period",
					"categoryAxis": {
						"gridPosition": "start",
						"axisAlpha": 0,
						"tickLength": 0
					}
				});
			})

		//SET DEGREES' CURRENT STATE STYLING
		$.ajax({
			url: 'get_active_degree',
			method: 'GET',
			dataType: 'JSON',
			success: data => {
				if (data.SD == 1) {
					$('.toggle_sd').addClass('sbold').css({
						'opacity': '1',
						'color': 'white',
						'font-size': '150%'
					})
				} else if (data.SD == 0) {
					$('.toggle_sd').removeClass('sbold').css({
						'opacity': '0.6',
						'color': 'black',
						'font-size': '100%'
					})
				}

				if (data.SMP == 1) {
					$('.toggle_smp').addClass('sbold').css({
						'opacity': '1',
						'color': 'white',
						'font-size': '150%'
					})
				} else if (data.SMP == 0) {
					$('.toggle_smp').removeClass('sbold').css({
						'opacity': '0.6',
						'color': 'black',
						'font-size': '100%'
					})
				}

				if (data.SMA == 1) {
					$('.toggle_sma').addClass('sbold').css({
						'opacity': '1',
						'color': 'white',
						'font-size': '150%'
					})
				} else if (data.SMA == 0) {
					$('.toggle_sma').removeClass('sbold').css({
						'opacity': '0.6',
						'color': 'black',
						'font-size': '100%'
					})
				}

				if (data.SMK == 1) {
					$('.toggle_smk').addClass('sbold').css({
						'opacity': '1',
						'color': 'white',
						'font-size': '150%'
					})
				} else if (data.SMK == 0) {
					$('.toggle_smk').removeClass('sbold').css({
						'opacity': '0.6',
						'color': 'black',
						'font-size': '100%'
					})
				}
			}
		})

		//UPLOAD SCHOOL IMAGE
		$('.upload_ico').click(function (evt) {
			evt.preventDefault()

			$('.upload_sch_img').trigger('click')
		})

		//GET CLASS LIST (CALLBACK)
		function classList(degree) {
			$.ajax({
				url: 'get_class_list',
				method: 'POST',
				data: {
					degree
				},
				success: function (data) {
					$('.table').empty()
					$('.table').html(data)
				}
			})
		}

		//SAVE REPORT INPUT
		$('.save_report').click(function () {
			let field = $(this).attr('name')
			let val = $(this).parents().find(`input[name="${field}"]`).val()

			$.ajax({
				url: 'ajax_save_report',
				method: 'POST',
				data: {
					field,
					val
				},
				success: data => {
					if (data == 'success') {
						alert("INFORMATION HAS BEEN UPDATED")
					} else {
						alert("SOMETHING'S WRONG")
						console.log(data)
					}
				},
				error: err => console.log(err.responseText)
			})
		})

		//SHOW FULL MID SEMESTER RECAP
		let mid_recap = async () => {

			let room = $('#recap_rooms_mid').val()
			let head = await fetch(`ajax_get_class_full_mid_recap?room=${room}`)
			let ajx_data = await head.json()

			let dt_column = [{
				data: 'NIS',
			}, {
				data: 'FullName'
			}]

			$('#full_mid_recap tr').empty()
			$('#full_mid_recap tr:last-child').append(
				`<th class="all" width="1%">NIS</th>
				<th class="all" width="35%">Name</th>`
			)

			//Arrange the Columns' name
			for (var row in ajx_data.header) {
				//Append column Name into the view
				$('#full_mid_recap tr:last-child').append(`<th class="desktop"> ${ajx_data.header[row].SubjName} </th>`)

				//Append Columns' Header as object for Datatable
				dt_column.push({
					data: ajx_data.header[row].SubjName.split(' ').join('_'),
					createdCell: response => response.setAttribute('align', 'center')
				})
			}

			// $('#full_mid_recap tr:last-child').append(`<th class="all"> Mid-Grade </th><th class="all"> Peringkat </th>`)

			$('#full_mid_recap').DataTable({
				destroy: true,
				responsive: true,
				processing: true,
				lengthMenu: [30, 50],
				columns: dt_column,
				data: ajx_data.pivot
			})
		}

		//CHANGE ROOM OF MID RECAP
		$('#recap_rooms_mid').change(function(){
			mid_recap()
		})

		//PRINT MID RECAP
		$('#print_recap_mid').click(function(e){
			e.preventDefault()

			let room = $('#recap_rooms_mid').val()

			window.location.replace(`print_recap_mid?room=${room}`)
		})

		//SHOW FULL ATTENDANCE
		let attd_recap = async () => {

			let room = $('#recap_rooms_attd').val()
			let month = $('#attd_month').val()
			let head = await fetch(`ajax_get_class_attendance_recap?room=${room}&month=${month}`)
			let ajx_data = await head.json()

			console.log(ajx_data)

			let dt_column = [{
				data: 'NIS',
			}, {
				data: 'FullName'
			}]

			$('#attd_recap tr').empty()
			$('#attd_recap tr:last-child').append(
				`<th class="all" width="1%">NIS</th>
					<th class="all" width="35%">Name</th>`
			)

			let date_alias = [
				'zero','one','two','three','four','five','six','seven','eight','nine','ten',
				'eleven','twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty',
				'twentyone','twentytwo','twentythree','twentyfour','twentyfive','twentysix','twentyseven','twentyeight','twentynine','thirty','thirtyone'
			];

			//Arrange the Columns' name
			for (let i = 1; i <= +ajx_data.header; i++) {
				//Append column Name into the view
				$('#attd_recap tr:last-child').append(`<th class="desktop"> ${i} </th>`)

				//Append Columns' Header as object for Datatable
				dt_column.push({
					data: date_alias[i],
					createdCell: response => {
						response.setAttribute('align', 'center')
						if($(response).text() == 'Sick'){
							response.classList.add('bg-yellow-saffron')
							$(response).text('S')
						}else if($(response).text() == 'On Permit'){
							response.classList.add('bg-purple')
							$(response).text('I')
						}else if($(response).text() == 'Absent'){
							response.classList.add('bg-red')
							$(response).text('A')
						}else{
							response.classList.add('bg-default')
							$(response).text('-')
						}
					}
				})
			}

			$('#attd_recap').DataTable({
				destroy: true,
				responsive: true,
				processing: true,
				ordering: false,
				lengthMenu: [10, 30, 50],
				columns: dt_column,
				data: ajx_data.pivot,
			})
		}

		//CHANGE SELECT OF ATTENDANCE RECAP
		$('#recap_rooms_attd, #attd_month').change(function(){
			attd_recap()
		})

		//PRINT MONTHLY ATTENDANCE
		$('#print_attd').click(function(e){
			e.preventDefault()

			let room = $('#recap_rooms_attd').val()
			let month = $('#attd_month').val()
			
			window.location.replace(`print_attendance_recap?room=${room}&month=${month}`)
		})

		//EXECUTE mid_recap
		mid_recap()

		//EXECUTE attd_recap
		attd_recap()

		var degree
		//OPEN MODAL SELECTED DEGREE
		$('.toggle_sd, .toggle_smp, .toggle_sma, .toggle_smk').click(function () {
			degree = $(this).attr('data-degree')

			$('.degree_opt').modal('show')

			switch (degree) {
				case 'SD':
					$('.ribbon-shadow').css('background-color', '#e7505a')
					$('.ribbon-shadow').text('Elementary School')
					break
				case 'SMP':
					$('.ribbon-shadow').css('background-color', '#4B77BE')
					$('.ribbon-shadow').text('Junior High School')
					break
				case 'SMA':
					$('.ribbon-shadow').css('background-color', '#95A5A6')
					$('.ribbon-shadow').text('High School')
					break
				case 'SMK':
					$('.ribbon-shadow').css('background-color', '#f36a5a')
					$('.ribbon-shadow').text('Vocational School')
					break
			}

			$.ajax({
				url: 'get_state',
				method: 'POST',
				data: {
					degree
				},
				success: data => {
					if (data == 1) {
						$('#active').prop('checked', true);
						$('#active').parent('.md-radio').addClass('has-success');
					} else {
						$('#deactive').prop('checked', true);
						$('#deactive').parent('.md-radio').addClass('has-error');
					}
				}
			})

			classList(degree)
		})

		//CHANGE STATE OF DEGREE (Activated to Deactivated or Vice Versa)
		$('input[name="toggle_degree"]').change(function () {
			let state = $(this).attr('id')
			let active

			if (state == 'active') {
				$('#deactive').parent('.md-radio').removeClass('has-error')
				$(this).parent('.md-radio').addClass('has-success')

				let btn = $(`button[data-degree="${degree}"]`)
				btn.addClass('sbold')
				btn.css({
					'opacity': '1',
					'color': 'white',
					'font-size': '150%'
				})


				active = 1
			} else {
				$('#active').parent('.md-radio').removeClass('has-success')
				$(this).parent('.md-radio').addClass('has-error')

				let btn = $(`button[data-degree="${degree}"]`)
				btn.removeClass('sbold')
				btn.css({
					'opacity': '0.6',
					'color': 'black',
					'font-size': '100%'
				})

				active = 0
			}

			$.ajax({
				url: 'toggle_degree',
				method: 'POST',
				data: {
					degree,
					active
				}
			})
		})

		//ADD ROOM NON-SMK
		$('.table').on('click', '.new_room', function () {
			let cls = $(this).parents('th').attr('data-class');
			let num = $(this).parents('th').attr('data-class-num');

			console.log(degree, cls, num)

			$.ajax({
				url: 'add_room',
				method: 'POST',
				data: {
					degree,
					cls,
					num
				},
				success: data => {
					console.log(data)
					if (data == 'success') {
						classList(degree)
					}
				},
				error: data => {
					console.log(data)
				}
			})
		})

		//REMOVE ROOM NON-SMK
		$('.table').on('click', '.remove_room', function () {
			var room = $(this).attr('data-room')

			Swal.fire({
				type: 'warning',
				title: 'Are You Sure !?',
				text: `
						Room of $ {
							room
						}
						will be purged `
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: 'delete_room',
						method: 'POST',
						data: {
							room
						},
						success: data => {
							console.log(data)
							if (data == 'success') {
								$(`
						a[data - room = "${room}"]
						`).fadeOut('fast');
							} else if (data == 'abort') {
								Swal.fire({
									type: 'warning',
									title: 'Deletion Failed',
									text: "Only room B to 'N' are capable of purging"
								})
							}
						},
						error: () => {
							Swal.fire({
								type: 'warning',
								title: 'Failed !?',
								text: `
						Room $ {
							room
						}
						is already assigned with Schedule or Homeroom Teacher `
							})
						}
					})
				}
			})
		})

		//ADD ROOM SMK
		$('.table').on('click', '.new_smk_room', function () {
			let cls = $(this).attr('data-class')
			let subprogram = $(this).attr('data-subprogram')
			let cls_numeric = $(this).attr('data-numeric')

			$.ajax({
				url: 'add_smk_room',
				method: 'POST',
				data: {
					cls,
					subprogram,
					cls_numeric
				},
				success: response => {
					if (response == 'success') {
						classList(degree)
					} else {
						alert("SOMETHING'S WRONG")
						console.log(response)
					}
				},
				error: err => console.log(err.responseText)
			})
		})

		//REMOVE ROOM SMK
		$('.table').on('click', '.remove_smk_room', function () {
			let room = $(this).attr('data-room')

			$.ajax({
				url: 'delete_smk_room',
				method: 'POST',
				data: {
					room
				},
				success: response => {
					if (response == 'success') {
						classList(degree)
					} else {
						alert("SOMETHING'S WRONG")
						console.log(response)
					}
				},
				error: err => console.log(err.responseText)
			})
		})
	}
})
