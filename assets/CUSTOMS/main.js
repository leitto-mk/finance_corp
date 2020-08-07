$(document).ready(function () {

	console.log(`Your screen resolution is:  ${window.screen.width} x ${window.screen.height}`);

	if (window.screen.width <= 1366) {
		document.body.style.zoom = 0.75
	}

	var current = window.location.href
	// if the current path is exactly indentical with href, make the navbar and its subs active
	$('.subnav').each(function () {
		var curpath = $(this).attr('href')
		if (curpath === current) {
			$(this).parents('.main').addClass('active open selected')
			$(this).parent().addClass('active')
		}
	})

	//Destroy Calendar
	//$('#calendar').fullCalendar('destroy')
	//CALENDAR API
	// var date = new Date()
	// var d = date.getDate()
	// var m = date.getMonth()
	// var y = date.getFullYear()
	// var API_KEY = '938b51d56e94fabc3d5d1657257ba638dadf0bfc'
	// $.get(`https://calendarific.com/api/v2/holidays?&api_key=${API_KEY}&country=ID&year=${y}`) //Get JSON
	// 	.then(data => {
	// 		for (let i = 0; i < data.response.holidays.length; i++) {
	// 			//Push Object from retrieved JSON to Array
	// 			if (data.response.holidays[i].type == 'National holiday') {
	// 				holidays.push({
	// 					title: data.response.holidays[i].name,
	// 					start: data.response.holidays[i].date.iso,
	// 					backgroundColor: App.getBrandColor('red')
	// 				})
	// 			}
	// 		}
	// 		$('#calendar').fullCalendar({
	// 			disableDragging: false,
	// 			header: {
	// 				left: 'title',
	// 				center: '',
	// 				right: 'prev,next,today,month'
	// 			},
	// 			editable: true,
	// 			events: holidays, //Set arrray holidays to events
	// 		});
	// 	})

	$('#calendar').fullCalendar()

	$.get('https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json') //Get JSON
		.then(data => {
			let holidays = []
			let parsed = JSON.parse(data)

			for (var key in parsed) {
				holidays.push({
					title: parsed[key].deskripsi,
					start: key.slice(0, 4) + '-' + key.slice(4, 6) + '-' + key.slice(6, 8),
					backgroundColor: '#fd5c63'
				})
			}

			$('#calendar').fullCalendar('destroy')
			$('#calendar').fullCalendar({
				disableDragging: true,
				header: {
					left: 'title',
					center: '',
					right: 'prev,next,today,month'
				},
				contentHeight: 550,
				events: holidays, //Set arrray holidays to events
			})
		})


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
})
