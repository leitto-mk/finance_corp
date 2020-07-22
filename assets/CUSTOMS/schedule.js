$(document).ready(function () {

	//If current Path is on absent page, load the script
	if ($('div').is('.schedule')) {

		$.ajax({
			url: 'get_degrees',
			method: 'GET',
			success: data => {
				$('.nav_degrees').append(data)

				let index = $('.caption').first().text()
				index = index.replace(/\s/g, '')

				if (index == 'SD') {
					classDetails('I (A)')
				} else if (index == 'SMP') {
					classDetails('VII (A)')
				} else if (index == 'SMA') {
					classDetails('X IPA (A)')
				}

				degreeSide()
			}
		})

		function degreeSide() {
			//Load SD Sidebar
			$.ajax({
				url: "load_classes_sch_sd",
				method: "GET",
				datatype: "JSON",
				success: function (data) {
					console.log(`SD Table Load Succesfully`);
					$('.sch_sd_classes').append(data);
				},
				error: function () {
					console.log("AJAX Schedule doesn't work properly");
				}
			});

			//Load SMP Sidebar
			$.ajax({
				url: 'load_classes_sch_smp',
				method: 'GET',
				datatype: 'JSON',
				success: function (data) {
					console.log(`SMP Table Load Succesfully`);
					$('.sch_smp_classes').html(data);
				},
				error: function () {
					alert("AJAX Schedule doesn't work properly");
				}
			});

			//Load SMA Sidebar
			$.ajax({
				url: 'load_classes_sch_sma',
				method: 'GET',
				datatype: 'JSON',
				success: function (data) {
					console.log(`SMA Table Load Succesfully`);
					$('.sch_sma_classes').html(data);
				},
				error: function () {
					alert("AJAX Schedule doesn't work properly");
				}
			});
		}

		$('[data-toggle="tooltip"]').tooltip();

		$('.bootstrap-switch').click(function () {
			if ($('.make-switch').is(':checked')) {
				$('.additional').css('display', 'block');
			} else {
				$('.additional').css('display', 'none');
			}
		});

		//Show Modal Hour Configuration
		$('.hour_opt').click(function () {

			$('.timepicker').timepicker({
				minuteStep: 5,
				maxHours: 22,
				defaultTime: "06:00",
				showMeridian: false
			});

			if ($('.make-switch').is(':checked')) {
				$('.additional').css('display', 'block');
			} else {
				$('.additional').css('display', 'none');
			}

			$('.opt_title').text("Hour Settings");
			$('.options').modal('show');
		});

		//Show Modal Session Configuration
		$('.sess_opt').click(function () {
			$('.edit_sessions').modal('show');

			get_full_session()
		});

		function get_full_session() {
			$.ajax({
				url: 'get_full_tbl_session',
				method: 'POST',
				dataType: 'JSON',
				success: data => {
					console.log(data)

					$('.sess_list').remove();

					$('.tr_session_reg').html(data.reg)
					$('.tr_session_elc').html(data.elc)
					$('.tr_session_exc').html(data.exc)
					$('.tr_session_non').html(data.non)
				}
			})
		}

		var sess;

		$('select[name="sess_type"]').change(function () {
			if ($(this).val() != '') {
				sess = $(this).val();
			} else {
				sess = '';
			}
		})

		//ADD NEW SESSION
		$('.new_sess').click(function () {
			let sess_type = sess;
			let sess_code = $('.sess_code').val();
			let sess_name = $('.sess_name').val();

			if (sess_type == '' || sess_name == '' || sess_code == '') {
				Swal.fire({
					type: 'error',
					title: "Please fill all the form, before continue",
					showConfirmButton: false,
					timer: 1500
				});

			} else {
				$.ajax({
					url: 'sv_new_session',
					method: 'POST',
					data: {
						type: sess_type,
						code: sess_code,
						name: sess_name
					},
					success: data => {
						if (data == 'is_available') {

							Swal.fire({
								type: 'error',
								title: "Cannot add because session already contains either values or both",
								showConfirmButton: false,
								timer: 1500
							});
						} else if (data == 'success') {
							get_full_session()

							Swal.fire({
								type: 'success',
								title: "New Session has been added",
								showConfirmButton: false,
								timer: 1500
							});
						}
					}
				})
			}
		});

		//EDIT AVAILABLE SESSION
		$('.tr_session_reg, .tr_session_elc, .tr_session_exc, .tr_session_non').on('keypress', 'td[contenteditable="true"]', function (e) {
			if (e.keyCode == 13) {
				e.preventDefault()

				let old

				if ($(this).attr('name') == 'code') {
					old = $(this).attr('data-cur-id')
				} else {
					old = $(this).attr('data-cur-name')
				}

				let field = $(this).attr('data-field')
				let newv = $(this).text()

				console.table({
					field,
					old,
					newv
				})

				$.ajax({
					url: 'edit_session',
					method: 'POST',
					data: {
						field,
						old,
						newv
					},
					success: response => {
						console.log(response)

						if (response == 'success') {
							Swal.fire({
								type: 'success',
								title: 'UPDATE SUCCESS',
								text: `${old} has been updated to ${newv}`
							})

							get_full_session()
						} else if (response == 'is_available') {
							Swal.fire({
								type: 'error',
								title: 'UPDATE FAILED',
								text: `YOU NEW ENTRY IS ALREADY LISTED`
							})

							get_full_session()
						} else if (response == 'is_attached') {
							Swal.fire({
								type: 'error',
								title: 'UPDATE FAILED',
								text: `YOU NEW ENTRY IS ALREADY AFFILIATED WITH ACTIVE SCHEDULE`
							})

							get_full_session()
						}
					},
					error: response => {
						console.log(response)
					}
				})
			}
		})

		//DELETE AVAILABLE SESSION
		$('.tr_session_reg, .tr_session_elc, .tr_session_exc, .tr_session_non').on('click', '.del_sess', function () {
			let subjname = $(this).attr('data-subj')

			$.ajax({
				url: 'det_session',
				method: 'POST',
				data: {
					subjname
				},
				success: data => {
					if (data == 'success') {
						Swal.fire({
							type: 'success',
							title: 'DELETED',
							text: `${subjname} has been deleted from session`
						})

						get_full_session()
					} else if (data == 'is_available') {
						Swal.fire({
							type: 'error',
							title: 'DELETION FAILED',
							text: `SESSION HAS ALREADY TIED WITH ACTIVE SCHEDULE`
						})
					}
				},
				error: data => {
					console.log(data)
				}
			})


		})

		//Save Hour Config
		$('.sv_hcon').click(function () {
			let hlevel = $('.hlevel').val();
			let hourperday = $('.numclass').val();
			let hstart = $('.hstart').val();
			let hinterval = $('.hinterval').val();
			let preset;

			if ($('.make-switch').is(':checked')) {
				preset = 'ON';
			} else {
				preset = 'OFF';
			}

			let break1 = $('.break1').val();
			let break1interval = $('.break1interval').val();
			let caregroup = $('.caregroup').val();
			let caregroupinterval = $('.caregroupinterval').val();
			let break2 = $('.break2').val();
			let break2interval = $('.break2interval').val();
			let exculinterval = $('.exculinterval').val();

			$.ajax({
				url: 'sv_hour_config',
				method: 'POST',
				data: {
					hlevel: hlevel,
					hourperday: hourperday,
					hstart: hstart,
					hinterval: hinterval,
					preset: preset,

					break1: break1,
					break1interval: break1interval,
					caregroup: caregroup,
					caregroupinterval: caregroupinterval,
					break2: break2,
					break2interval: break2interval,
					exculinterval: exculinterval
				},
				success: function (data) {
					if (data != 'false') {
						$('.options').modal('hide');
						console.log("Schedule is already set");
						$('.options').modal('hide');
						Swal.fire(
							'Success!',
							"Schedule's hour has been updated",
							'success'
						)

						if (hlevel == 'SD') {
							classDetails('I (A)');
						} else if (hlevel == 'SMP') {
							classDetails('VII (A)');
						} else if (hlevel == 'SMA') {
							classDetails('X IPA (A)');
						}

					} else {
						console.log(data);
						$('.options').modal('hide');
						Swal.fire({
							type: 'error',
							title: 'Oops...',
							text: 'Hours are already set!'
						})
					}
				}
			});
		});

		//Reset Hour Config
		$('.reset_curhour').click(function () {
			var level = $('.hlevel').val();
			var lvl = '';

			$('.options').modal('hide');

			if (level == 'SD') {
				lvl = 'Elementary School';
			} else if (level == 'SMP') {
				lvl = 'Junior School';
			} else if (level == 'SMP') {
				lvl = 'High School';
			}

			Swal.fire({
				title: 'Reset Hour Preset for this Degree?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: 'reset_hcon',
						method: 'POST',
						data: {
							level: level
						},
						success: function (data) {
							if (data == 'is_used') {
								Swal.fire({
									type: 'error',
									title: 'Reset Failed',
									text: `Hours for ${lvl} is in use. please clear the schedule before reset the hours.`
								})
							} else {
								Swal.fire(
									'Deleted!',
									`${level}'s Hours has been reset`,
									'success'
								)

								if (level == 'SD') {
									classDetails('I (A)');
								} else if (level == 'SMP') {
									classDetails('VII (A)');
								} else if (level == 'SMA') {
									classDetails('X IPA (A)');
								}
							}

						}
					});
				}
			});
		});

		//Show Popup edit specific Hour
		$('.std_rep').on('click', '.btn_edit_hour', function () {
			let current = $(this).attr('data-start');
			let finish = $(this).attr('data-finish');
			let room = $(this).attr('data-room');

			//AJAX for Displaying Decrease Value Dropdown of Finish Hour 
			//not less-to-equals to Start Hour
			$('.type').change(function () {
				if ($(this).val() == 'dec') {
					$.ajax({
						url: 'get_decrease_minute',
						method: 'POST',
						data: {
							current: current,
							finish: finish
						},
						success: function (data) {
							$('.interval').replaceWith(data);
						}
					});
				} else {
					let value = '';

					value += '<select class="form-control edited interval" id="form_control_1">';
					value += '<option value="" selected>by...</option>';
					for (let i = 5; i <= 60; i += 5) {
						value += '<option value=' + i + '> ' + i + ' Minutes </option>';
					}
					value += '</select>';

					$('.interval').replaceWith(value);
				}
			});

			$('.curhour_desc').html(`Hour: <span style="font-size: 40px; font-weight: 350"> ${current}-${finish} </span>`);
			$('.curhour_desc').attr('data-cur-hour', current);
			$('.curhour_desc').attr('data-room', room);
			$('.hour_title').text("Change specific hour");
			$('.edit_hour').modal('show');
		});

		//Save New Current Hour
		$('.edit_hour').on('click', '.sv_curhour', function () {
			let cur = $('.curhour_desc').attr('data-cur-hour');
			var level = $('.caption-subject').attr('data-degree');
			let room = $('.curhour_desc').attr('data-room');

			let lvl = '';

			if (level == 'SD') {
				lvl = 'Elementary School';
			} else if (level == 'SMP') {
				lvl = 'Junior School';
			} else if (level == 'SMA') {
				lvl = 'High School';
			}

			let type = $('.type').val();
			let interval = $('.interval').val();

			$.ajax({
				url: 'sv_new_curhour',
				method: 'POST',
				datatype: 'JSON',
				data: {
					cur: cur,
					room: room,
					type: type,
					interval: interval
				},
				success: function (data) {
					Swal.fire({
						position: 'top-end',
						type: 'success',
						title: `Hour has been updated for ${lvl}`,
						showConfirmButton: false,
						timer: 1500
					});

					console.log(data);
					$('.edit_hour').modal('hide');

					if (level == 'SD') {
						classDetails("I (A)");
					} else if (level == 'SMP') {
						classDetails("VII (A)");
					} else if (level == 'SMA') {
						classDetails("X IPA (A)");
					}
				},
				error: function (data) {
					Swal.fire({
						position: 'top-end',
						type: 'error',
						title: `Hour failed to update for ${lvl}`,
						showConfirmButton: false,
						timer: 1500
					});

					console.log(data);
					$('.edit_hour').modal('hide');

					if (level == 'SD') {
						classDetails("I (A)");
					} else if (level == 'SMP') {
						classDetails("VII (A)");
					} else if (level == 'SMA') {
						classDetails("X IPA (A)");
					}
				}
			});
		});

		function classDetails(room) {
			$.ajax({
				url: "load_sche_details",
				method: "POST",
				data: {
					room: room,
				},
				success: function (response) {
					$('.std_rep').html(response);
				},
				error: function () {
					console.log("SOMETHING'S WRONG");
				}
			});
		}

		// AJAX DETAILS SCHEDULE
		$('.classes').on('click', '.detail_sche', function () {
			var room = $(this).attr('data-room');

			classDetails(room);
		});

		//Show Dropdown of Session's List
		$('.change_type').on('change', 'select[name="type"]', function () {
			let type = $(this).val();

			if (type != 'Regular') {
				$('.teacher').css('display', 'none');
			} else {
				$('.teacher').css('display', 'block');
			}

			$(this).attr('data-type', type);

			$.ajax({
				url: 'get_session_type',
				method: 'POST',
				data: {
					type: type
				},
				success: data => {
					if (type == 'Elective') {
						$('select[name="subj"]').html(`<option value="Elective"> ELECTIVE </option>`)
					} else if (type == 'Excul') {
						$('select[name="subj"]').html(`<option value="Excul"> EXCUL </option>`)
					} else {
						$('select[name="subj"]').replaceWith(data);
					}
				}
			})
		});

		// AJAX SHOW ADD NEW SCHEDULE MODAL
		$('.std_rep').on('click', '.add_sche', function () {
			let room = $(this).attr('data-room');

			$.ajax({
				url: 'load_add_sch',
				method: 'POST',
				datatype: 'JSON',
				data: {
					room: room
				},
				success: function (data) {
					if (data == 'no_students') {
						Swal.fire({
							type: 'error',
							title: 'Add Subject Failed',
							text: `Students must be assigned to this class first`
						})
					} else {
						$('.mdl-add').html(data);
						$('#new-sch').modal('show');
					}
				},
				error: function () {
					alert(`${room} failed to get data`);
				}
			});
		});

		// AJAX SAVE NEW SCHEDULE
		$('.mdl-add').on('click', '.submit_new_sche', function () {
			var new_room = $('select[name="room"]').val();
			var new_day = $('select[name="day"]').val();
			var new_hour = $('select[name="hour"]').val();
			var new_type = $('select[name="type"]').val();
			var new_subj = $('select[name="subj"]').val();
			var new_teacher = $('select[name="teacher"]').val();
			var new_note = $('textarea[name="note"]').val();

			if (new_day != '' && new_hour != '' && new_type != '' && new_subj != '') {
				//CHECK TEACHER AVAILABILITY
				$.ajax({
					url: 'check_teacher_avail',
					method: 'POST',
					data: {
						day: new_day,
						hour: new_hour,
						teacher: new_teacher
					},
					success: function (data) {
						console.log(data);

						if (data == 'proceed') {
							//POST TO DB, WHEN SELECTED TEACHER DOES NOT HAVE COLLLISION

							console.table({
								new_room,
								new_day,
								new_hour,
								new_type,
								new_subj,
								new_teacher,
								new_note
							})

							$.ajax({
								url: 'save_add_sch',
								method: 'POST',
								data: {
									room: new_room,
									day: new_day,
									hour: new_hour,
									type: new_type,
									subj: new_subj,
									teacher: new_teacher,
									note: new_note
								},
								success: data => {
									console.log(data)

									if (data == 'success') {
										Swal.fire({
											type: 'success',
											title: 'Added...',
											text: 'New schedule has been added',
										})

										$('#new-sch').modal('hide');
										classDetails(new_room);
									} else {
										Swal.fire({
											type: 'error',
											title: "Something's wrong...",
											text: 'Failed to add new Schedule',
										})

										$('#new-sch').modal('hide');
										classDetails(new_room);
									}
								},
								error: () => {
									Swal.fire({
										type: 'error',
										title: 'Failed...',
										text: "Error: 500 (Internal Server Error)",
									})

									$('#new-sch').modal('hide');
									classDetails(new_room);
								}
							})
						} else {
							let teachername = $('select[name="teacher"] option:selected').attr('data-name');

							Swal.fire({
								type: 'error',
								title: 'Add Schedule Fails',
								text: `${teachername} has been assigned at another class for the same Day and Hour`,
								showConfirmButton: true
							})

							$('#new-sch').modal('hide');
							classDetails(new_room);
						}
					}
				})
			} else {
				Swal.fire({
					type: 'warning',
					title: 'Submit Denied',
					text: 'Unable to submit new schedule. make sure every form is selected accordingly'

				})
			}
		});

		//AJAX SHOW UNPICKED HOUR FOR SELECTED CLASS
		$('.mdl-add').on('change', 'select[name="day"]', function () {
			if ($(this).val() != '') {
				let room = $('#room').val();
				let day = $(this).val();

				console.table({
					room,
					day
				})

				$.ajax({
					url: "load_unpicked_hour",
					method: "POST",
					data: {
						room,
						day
					},
					success: data => {
						$('select[name="hour"]').replaceWith(data);
					}
				})
			}
		})

		// AJAX SHOW EDIT SCHEDULE MODAL
		$('.std_rep').on('click', '.btn_edit_sch', function () {
			var data_day = $(this).attr('data-day');
			var data_room = $(this).attr('data-room');
			var data_hour = $(this).attr('data-hour');
			var data_subj = $(this).attr('data-subj');

			// console.log(`DAY: ${data_day} | ROOM: ${data_room} | HOUR: ${data_hour} | SUBJ: ${data_subj}`);

			$.ajax({
				url: "load_edit_sch",
				method: "POST",
				data: {
					day: data_day,
					room: data_room,
					hour: data_hour,
					subj: data_subj
				},
				success: function (data) {

					$('.detail-class').modal('hide');
					$('.edit-body').html(data);
					$('.modal-title').text(`Edit Class: ${data_room}`);
					$('.modal-edit').modal('show');

					classDetails(data_room);
				},
				error: function () {
					alert(`${data_room} failed to POST to controller`);
				}
			});
		});

		//AJAX UPDATE NEW SCHEDULE
		$('.sv_upd_sche').click(function () {

			let upd_room = $('select[name="room"] option:selected').val();
			let upd_day = $('select[name="day"] option:selected').val();
			let upd_hour = $('select[name="hour"] option:selected').val();
			let upd_type = $('select[name="type"] option:selected').val();
			let upd_subj = $('select[name="subj"] option:selected').val();
			let upd_teacher = $('select[name="teacher"] option:selected').val();
			let upd_note = $('textarea[name="note"]').val();

			// console.log(`ROOM: ${upd_room} | DAY: ${upd_day} | HOUR: ${upd_hour} | TYPE: ${upd_type} | SUBJ: ${upd_subj} | TEACHER: ${upd_teacher} | NOTE: ${upd_note}`);

			if (upd_type != '' && upd_subj != '' && upd_teacher != '') {
				//POST TO DB
				$.ajax({
					url: 'save_sche_update',
					method: 'POST',
					data: {
						upd_room,
						upd_day,
						upd_hour,
						upd_type,
						upd_subj,
						upd_teacher,
						upd_note
					},
					success: function (data) {
						console.log(data);

						if (data == 'success') {
							Swal.fire({
								type: 'success',
								title: 'Success...',
								text: 'Session has been updated',
							})

							$('.modal-edit').modal('hide');
							classDetails(upd_room);
						} else if (data == 'unproceed') {
							Swal.fire({
								type: 'error',
								title: 'Add Schedule Fails',
								text: `${upd_teacher} has been assigned at another class for the same Day and Hour`,
								showConfirmButton: true
							})

							$('.modal-edit').modal('hide');
							classDetails(upd_room);
						}
					},
					error: function () {
						Swal.fire({
							type: 'error',
							title: 'Failed...',
							text: "Error: 500 (Internal Server Error)",
						})

						$('.modal-edit').modal('hide');
						classDetails(upd_room);
					}
				})
			} else {
				Swal.fire({
					type: 'warning',
					title: 'Submit Denied',
					text: 'Unable to submit new schedule. make sure every form is selected accordingly'

				})
			}
		})

		// AJAX DELETE SCHEDULE RECORD
		$('.std_rep').on('click', '.delete_sche', function () {
			let room = $(this).attr('data-room');

			Swal.fire({
				title: 'Clear schedule for this Class?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: "delete_sche",
						method: "POST",
						datatype: "JSON",
						data: {
							room: room
						},
						success: function () {
							console.log('DELETE SUCCESS');

							Swal.fire({
								type: 'success',
								title: 'Success',
								text: `Schedule for ${room} has been cleared`
							})

							$('.del-confirm').modal('hide');
							classDetails(room);
						},
						error: function () {
							alert("SOMETHING'S WRONG");
							$('.del-confirm').modal('hide');
						}
					});
				}
			});
		});
	}
});
