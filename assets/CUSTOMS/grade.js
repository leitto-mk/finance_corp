$(document).ready(function () {

	//If current Path is on absent page, load the script
	if ($('div').is('.grade')) {

		displayActiveDegree()

		$('input[class=".weight"]').inputmask('99%', {
			clearMaskOnLostFocus: false
		});

		//DISPLAY TABLE BY SUBJECTS
		$('input[name="display_by"]').change(function () {
			let selected = $(this).val()

			if (selected == 'cls') {
				$('.std_rep').empty()

				displayActiveDegree();
			} else if (selected == 'subject') {
				$('.std_rep').empty()
				$('.nav_degrees').empty()

				$.ajax({
					url: 'get_table_by_subjects',
					method: 'GET',
					success: data => {
						$('.std_rep').append(data)
					}
				})
			}
		})

		//GLOBAL VAR FOR MATERIAL KD
		var cls, subj, type;

		//OPEN MODAL SUBJECT KD DETAIL
		$('.btn_kd').click(function () {
			cls = $('.kd_classes').val();
			if (typeof subj == 'undefined') {
				$('#selected_kd_class').html(`Class: <span style="color: #8E44AD"> ${cls} </span>, Subject: <span style="color: red"> ${subj} <span>`)
			} else {
				$('#selected_kd_class').html(`Class: <span style="color: #8E44AD"> ${cls} </span>, Subject: <span style="color: #4B77BE"> ${subj} <span>`)
			}

			$('.material_mapping').modal('show')
		})

		$('.kd_classes').change(function () {
			cls = $('.kd_classes').val();

			if (typeof subj == 'undefined') {
				$('#selected_kd_class').html(`Class: <span style="color: #8E44AD"> ${cls} </span>, Subject: <span style="color: red"> ${subj} <span>`)
			} else {
				$('#selected_kd_class').html(`Class: <span style="color: #8E44AD"> ${cls} </span>, Subject: <span style="color: #4B77BE"> ${subj} <span>`)
			}

			getKD(type, cls, subj)
		})

		//GET KD DETAIL TABLE FROM SELECTED SUBJECTS/CLASS
		$('.list_subj').click(function () {
			type = 'cognitive'
			cls = $('.kd_classes').val()
			subj = $(this).text()

			console.log({
				type,
				cls,
				subj
			})

			if (typeof subj == 'undefined') {
				$('#selected_kd_class').html(`Class: <span style="color: #8E44AD"> ${cls} </span>, Subject: <span style="color: red"> ${subj} <span>`)
			} else {
				$('#selected_kd_class').html(`Class: <span style="color: #8E44AD"> ${cls} </span>, Subject: <span style="color: #4B77BE"> ${subj} <span>`)
			}

			getKD(type, cls, subj)
		})

		//GET KD DETAIL TABLE FROM SELECTED SUBJECTS/CLASS BY TYPE TAB
		$('[data-toggle="tab"]').click(function () {
			type = $(this).attr('data-type');

			getKD(type, cls, subj)
		})

		function getKD(type, cls, subj) {
			$.ajax({
				url: 'get_kd_by_subject',
				method: 'POST',
				dataType: 'JSON',
				data: {
					type,
					cls,
					subj
				},
				success: data => {
					$('.semester1, .semester2').empty()
					$('.semester1').append(data.Semester1)
					$('.semester2').append(data.Semester2)
					$('.btn_new_kd').attr('data-subj', subj)
				}
			})
		}

		//OPEN MODAL NEW KD FOR SUBJECT
		var semester;
		$('.btn_new_kd').click(function () {
			semester = $(this).attr('data-semester')
			let title = $(this).attr('data-subj')

			$('.new_kd_title').text(`New KD for ${title} (Semester ${semester})`)
			$('.new_kd').modal('show')
		})

		//SAVE NEW SUBJECT'S KD
		$('.save_kd').click(function () {
			let material = $('#material').val()
			let code = $('#code').val()
			let adjust = $('#adjust').val()

			$('.semester_body').css("display", "block")

			$.ajax({
				url: 'save_new_kd',
				method: 'POST',
				data: {
					//Global
					type,
					cls,
					subj,
					semester,

					//Scope
					material,
					code,
					adjust
				},
				success: response => {
					if (response == 'success') {
						Swal.fire({
							type: 'success',
							title: 'New KD Added'
						})

						$('.new_kd').modal('hide')

						$('.semester1, .semester2').empty()

						getKD(type, cls, subj)
					} else {
						Swal.fire({
							type: 'error',
							title: 'Cannot Proceed',
							text: 'make sure to enter the necessary form'
						})
					}
				},
				error: data => {
					alert(data.responseText);
				}
			})
		})

		//EDIT SUBJECT'S KD (ENTER KEY)
		$('.semester1, .semester2').on('keypress', 'td[contenteditable="true"]', function (evt) {
			let field = $(this).attr('data-field')
			let newval = $(this).text();

			let code = $(this).parents('tr').attr('data-code')
			let semester = $(this).parents('tr').attr('data-semester')
			let subj = $(this).parents('tr').attr('data-subj')

			if (field == 'Code') {
				newval = newval.replace(/\s+/g, '')
			}

			let obj = {
				type,
				field,
				newval,
				code,
				semester,
				subj
			}

			if (evt.keyCode == 13) {
				evt.preventDefault()
				//console.table({ field, newval, code, semester, subj })

				editKD(obj)
			}
		})

		function editKD(obj) {
			$.ajax({
				url: 'edit_kd',
				method: 'POST',
				data: obj,
				success: () => {
					$('.semester1, .semester2').empty()

					getKD(type, cls, subj)
				}
			})
		}

		//DELETE SUBJECT'S KD
		$('.table').on('click', '.delete_kd', function () {
			let code = $(this).parents('tr').attr('data-code')
			let semester = $(this).parents('tr').attr('data-semester')
			let subj = $(this).parents('tr').attr('data-subj')

			$.ajax({
				url: 'delete_kd',
				method: 'POST',
				data: {
					type,
					code,
					semester,
					subj
				},
				success: () => {
					$('.semester1, .semester2').empty()

					getKD(type, cls, subj)
				}
			})
		})

		//DISPLAY ROOM WITH ACTIVE DEGREE ONLY
		function displayActiveDegree() {
			$.ajax({
				url: 'get_active_degrees_grade',
				mehod: 'POST',
				success: data => {
					$('.nav_degrees').append(data)

					let index = $('.caption').first().text()
					index = index.replace(/\s/g, '')

					if (index == 'SD') {
						classDetails('I')
					} else if (index == 'SMP') {
						classDetails('VII')
					} else if (index == 'SMA') {
						classDetails('X IPA')
					}

					sidebarDegrees();
				}
			})
		}

		function sidebarDegrees() {
			//Load SD Sidebar
			$.ajax({
				url: "load_classes_sd",
				method: "GET",
				datatype: "JSON",
				success: function (data) {
					$('.sd_classes').append(data);
				},
				error: function () {
					console.log("AJAX Schedule doesn't work properly");
				}
			});

			//Load SMP Sidebar
			$.ajax({
				url: 'load_classes_smp',
				method: 'GET',
				datatype: 'JSON',
				success: function (data) {
					$('.smp_classes').html(data);
				},
				error: function () {
					alert("AJAX Schedule doesn't work properly");
				}
			});

			//Load SMA Sidebar
			$.ajax({
				url: 'load_classes_sma',
				method: 'GET',
				datatype: 'JSON',
				success: function (data) {
					$('.sma_classes').html(data);
				},
				error: function () {
					alert("AJAX Schedule doesn't work properly");
				}
			});

			//Load SMA Sidebar
			$.ajax({
				url: 'load_classes_smk',
				method: 'GET',
				datatype: 'JSON',
				success: function (data) {
					$('.smk_classes').html(data);
				},
				error: function () {
					alert("AJAX Schedule doesn't work properly");
				}
			});
		}

		//Load Class Details
		function classDetails(room) {
			$.ajax({
				url: 'load_spec_class_grade',
				method: 'POST',
				datatye: 'JSON',
				data: {
					cls: room
				},
				success: function (data) {
					$('.std_rep').html(data);
				},
				error: function () {
					alert("Something's Wrong");
				}
			});
		}

		function get_weight(degree) {
			$.ajax({
				url: 'get_grade_weight',
				method: 'POST',
				dataType: 'json',
				data: {
					degree
				},
				success: data => {
					if (data) {
						$('input[data-field="KDWeight"]').val(data.KDWeight)
						$('input[data-field="KDWeight_SK"]').val(data.KDWeight_SK)
						$('input[data-field="MidWeight"]').val(data.MidWeight)
						$('input[data-field="FinalWeight"]').val(data.FinalWeight)
						$('input[data-field="Absent"]').val(data.Absent)
					} else {
						$('.assg_weight').val(0);
						$('.test_weight').val(0);
						$('.mid_weight').val(0);
						$('.final_weight').val(0);
					}
				}
			})
		}

		//GRADE WEIGHT (NATIONAL)
		function get_weight_nat(degree) {
			$.ajax({
				url: 'get_grade_weight_nat',
				method: 'POST',
				dataType: 'JSON',
				data: {
					degree
				},
				success: function (data) {
					$('.tab-content').find('.weight').each(function () {
						let field = $(this).attr('data-field');
						if (field == 'Absent') {
							$(`.weight[data-desc="${data[0]['Type']}"][data-field="${field}"]`).val(data[0][field]);
							$(`.weight[data-desc="${data[1]['Type']}"][data-field="${field}"]`).val(data[1][field]);
						} else if (field == 'Daily') {
							$(`.weight[data-desc="${data[0]['Type']}"][data-field="${field}"]`).val(data[0][field]);
							$(`.weight[data-desc="${data[1]['Type']}"][data-field="${field}"]`).val(data[1][field]);
						} else if (field == 'Mid') {
							$(`.weight[data-desc="${data[0]['Type']}"][data-field="${field}"]`).val(data[0][field]);
							$(`.weight[data-desc="${data[1]['Type']}"][data-field="${field}"]`).val(data[1][field]);
						} else if (field == 'Final') {
							$(`.weight[data-desc="${data[0]['Type']}"][data-field="${field}"]`).val(data[0][field]);
							$(`.weight[data-desc="${data[1]['Type']}"][data-field="${field}"]`).val(data[1][field]);
						}
					})
				}
			})
		}

		function get_kkm(degree) {
			$.ajax({
				url: 'get_kkm',
				method: 'POST',
				data: {
					degree
				},
				success: data => {
					$('.kkm_minimum').val(data)
				},
				error: data => {
					console.log(data)
				}
			})
		}

		function get_predicate() {
			var predicate = $('.edit_predicate');

			$.ajax({
				url: 'load_predicate',
				method: 'POST',
				success: function (data) {
					//Empty the content first to prevent unnecessary stacking
					predicate.empty();

					$(predicate).append(data);
				}
			})
		}

		//OPTION GRADES
		$('.grade_opt').click(function () {
			$('.opt_modal').modal('show')

			let degree = $('.glevel').val()

			//Load Active Days
			get_active_days(degree)

			//Load Weight
			get_weight(degree)
			get_weight_nat(degree)

			//Load KKM
			get_kkm(degree)

			//Load Predicate
			get_predicate()
		})

		var degree = '';
		$('.glevel').change(function () {
			degree = $(this).val();

			get_weight(degree);
			get_weight_nat(degree);
		})

		function get_active_days(degree) {
			$.ajax({
				url: 'get_active_days',
				method: 'POST',
				data: {
					degree
				},
				success: data => {
					$('.active_days').val(data)
				}
			})
		}

		//SAVE NEW ACTIVE DAYS
		$('.active_days').keypress(function (e) {
			if (e.which == 13) {
				let degree = $('.glevel').val()
				let value = $(this).val()

				console.table({
					degree,
					value
				})

				$.ajax({
					url: 'sv_active_days',
					method: 'POST',
					data: {
						degree,
						value
					},
					success: data => {
						if (data == 'success') {
							Swal.fire({
								type: 'success',
								title: 'Saved',
								text: "School Active Days has been updated"
							})

							get_active_days(degree)
						} else {
							Swal.fire({
								type: 'error',
								title: 'Save Failed',
								text: "Failed to update new School Active Days"
							})
						}
					}
				})
			}
		})

		//SAVE GRADE BY COGNITIVE / SKILL
		$('.weight').on('keypress', function (evt) {
			var block = $(this).parent('div');
			let degree = $('.glevel').val();
			let type = $(this).attr('data-desc');
			let field = $(this).attr('data-field');
			let val = $(this).val();

			if (evt.keyCode == 13) {
				evt.preventDefault();

				$.ajax({
					url: 'save_nat_weight',
					method: 'POST',
					data: {
						degree,
						type,
						field,
						val
					},
					success: function () {
						block.addClass('has-success');

						setTimeout(function () {
							block.removeClass('has-success');
						}, 2000)
					}
				})
			}
		})

		//SAVE NEW PREDICATE
		$('.edit_predicate').on('keypress', 'td[contenteditable="true"]', function (evt) {
			if (evt.keyCode == 13) {
				evt.preventDefault();

				let predicate = $(this).parent('tr').attr('data-prd');
				let max = $(`tr[data-prd="${predicate}"]`).children('td[data-prd="max"]').html();
				let min = $(`tr[data-prd="${predicate}"]`).children('td[data-prd="min"]').html();

				//Get String into ASCII Code, decrement the code and convert back to string to get previous Letter
				let charcode = predicate.charCodeAt(0);
				let predicatetop = charcode - 1;
				let predicatebottom = charcode + 1;
				predicatetopmin = String.fromCharCode(predicatetop);
				predicatebottommax = String.fromCharCode(predicatebottom);

				let topmin = $(`tr[data-prd="${predicatetopmin}"]`).children('td[data-prd="min"]').html();
				let buttommax = $(`tr[data-prd="${predicatebottommax}"]`).children('td[data-prd="max"]').html();

				if (predicate != 'A' && predicate != 'D') {
					if (max < topmin && min > buttommax) {
						postPredicate(predicate, max, min);
					} else {
						Swal.fire({
							type: 'warning',
							title: 'Alter Predicate Failed',
							text: 'Make sure Maximum value is below Upper Predicate and Minimum value is higher than Below Predicate'
						});
					}
				} else if (predicate == 'A') {
					if (max <= 100 && min > buttommax) {
						postPredicate(predicate, max, min);
					} else {
						Swal.fire({
							type: 'warning',
							title: 'Alter Predicate Failed',
							text: 'Make sure Maximum value is below Upper Predicate and Minimum value is higher than Below Predicate'
						});
					}
				} else if (predicate == 'D') {
					if (max < topmin && min <= 0) {
						postPredicate(predicate, max, min);
					} else {
						Swal.fire({
							type: 'warning',
							title: 'Alter Predicate Failed',
							text: 'Make sure Maximum value is below Upper Predicate and Minimum value is higher than Below Predicate'
						});
					}
				}
			}
		});

		function postPredicate(predicate, max, min) {
			$.ajax({
				url: 'post_predicate',
				method: 'POST',
				data: {
					predicate,
					max,
					min
				},
				success: function () {
					Swal.fire({
						type: 'success',
						title: 'Success',
						text: 'Predicate has been updated',
						showConfirmButton: false
					});
				},
				error: function () {
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'Something went wrong!',
						showConfirmButton: false
					});
				}
			})
		}

		//SAVE OPTION GRADES
		$('.subject_weight').keypress(function (e) {
			if (e.which == 13) {
				e.preventDefault()

				let grade_level = $('.glevel option:selected').val()

				let field = $(this).attr('data-field')
				let value = $(this).val()

				console.table({
					grade_level,
					field,
					value
				})

				$.ajax({
					url: 'save_grade_weight',
					method: 'POST',
					data: {
						lvl: grade_level,
						field,
						value
					},
					success: data => {
						if (data == 'success') {
							Swal.fire({
								type: 'success',
								title: 'Saved',
								text: "Grade's Weight has been updated"
							})
						} else {
							Swal.fire({
								type: 'error',
								title: 'Save Failed',
								text: "Grade's Weight failed to save into database"
							})
						}
					}
				})
			}
		})

		//SAVE KKM
		$('.kkm_minimum').keypress(function (e) {
			if (e.keyCode == 13) {
				e.preventDefault()

				let grade_level = $('.glevel option:selected').val()
				let kkm = $(this).val()

				console.table({
					grade_level,
					kkm
				})

				$.ajax({
					url: 'save_new_kkm',
					method: 'POST',
					data: {
						lvl: grade_level,
						kkm
					},
					success: data => {
						if (data == 'success') {
							Swal.fire({
								type: 'success',
								title: 'Saved',
								text: "Grade's Weight has been updated"
							})
						} else {
							Swal.fire({
								type: 'error',
								title: 'Save Failed',
								text: "Grade's Weight failed to save into database"
							})
						}
					},
					error: data => {
						console.log(data)
					}
				})
			}
		})

		// LOAD CLASSES WITH THEIR EACH SUB-CLASSES
		$('.nav_degrees').on('click', '.cls_grade', function () {
			const room = $(this).attr('data-room');

			console.log(`DATA TO POST: ${room}`);

			classDetails(room);
		});

		//LOAD STUDENT ON CLICKED SUB-CLASS
		$('.std_rep').on('click', '.sub_class', function () {
			const room = $(this).attr('data-room');

			console.log(`ROOM: ${room}`);

			$.ajax({
				url: 'load_sub_class_grade',
				method: 'POST',
				datatype: 'JSON',
				data: {
					room: room
				},
				success: function (data) {
					//console.log(data);
					$('.portlet_subcls').html(data);
				},
				error: function (data) {
					console.log(`ERROR: ${data}`);
				}
			});
		});

		// LOAD STUDENT'S GRADES IN MODALS
		var grade_subj, grade_type;
		$('.std_rep').on('click', '.btn_grade', function () {
			grade_subj = $(this).attr('data-subject')
			grade_type = $(this).attr('data-type')

			get_grades();
		});

		// LOAD STUDENT'S GRADES FULL TABLE
		var grade_cls = $('.by_cls').val()
		var grade_year = $('.by_year option:selected').val()
		var grade_semester = $('.by_year option:selected').attr('data-semester')

		function get_grades() {
			if (grade_type == 'skills') {
				$('.full_details_skills').modal('show')
			} else if (grade_type == 'cognitive') {
				$('.full_details_cognitive').modal('show')
			} else if (grade_type == 'character') {
				$('.full_details_character').modal('show')
			} else if (grade_type == 'voc') {
				$('.full_details_voc').modal('show')
			}

			get_full_details(grade_cls, grade_year, grade_semester, grade_subj, grade_type)
		}

		function get_full_details(grade_cls, grade_year, grade_semester, grade_subj, grade_type) {

			let controller
			if (grade_type == 'cognitive') {
				controller = 'get_full_table_details_cognitive'
			} else if (grade_type == 'skills') {
				controller = 'get_full_table_details_skills'
			} else if (grade_type == 'character') {
				controller = 'get_full_table_details_character'
			} else if (grade_type == 'voc') {
				controller = 'get_full_table_details_voc'
			}

			$.ajax({
				url: controller,
				method: 'POST',
				dataType: 'JSON',
				data: {
					cls: grade_cls,
					year: grade_year,
					semester: grade_semester,
					subj: grade_subj,
					type: grade_type
				},
				success: data => {
					console.log(grade_type)
					if (grade_type == 'cognitive') {
						$('.tbl_detailed_cognitive').html(data.full)
						$('.tbl_recap_cognitive').html(data.recap)
						$('.tbl_summary_cognitive').html(data.summary)
					} else if (grade_type == 'skills') {
						$('.tbl_detailed_skills').html(data.recap)
						$('.tbl_summary_skills').html(data.summary)
					} else if (grade_type == 'character') {
						$('.tbody_soc').html(data.SOC)
						$('.tbody_spr').html(data.SPR)
					} else if (grade_type == 'voc') {
						$('.tbody_voc').html(data.voc)
					}
				},
				error: data => {
					console.log(data.responseText)
				}
			})
		}

		// LOAD STUDENT'S GRADES FULL TABLE (EVENT LISTENER)
		$('.by_cls').on('change', function () {
			grade_cls = $(this).val();
			grade_year = $(this).parents('.modal-body').find('.by_year').val()
			grade_semester = $(this).parents('.modal-body').find('.by_year option:selected').attr('data-semester')

			get_full_details(grade_cls, grade_year, grade_semester, grade_subj, grade_type)
		});

		$('.by_year').on('change', function () {
			grade_cls = $(this).parents('.modal-body').find('.by_cls').val()
			grade_year = $(this).val();
			grade_semester = $(this).find('option:selected').attr('data-semester');

			get_full_details(grade_cls, grade_year, grade_semester, grade_subj, grade_type)
		})

		$('.radio_semester').click(function () {
			grade_cls = $(this).parents('.modal-body').find('.by_cls').val()
			grade_year = $(this).parents('.modal-body').find('.by_year').val()
			grade_semester = $(this).parents('.modal-body').find('.by_year option:selected').attr('data-semester')

			if ($(this).attr('name') !== 'compact_select_semester') {
				get_full_details(grade_cls, grade_year, grade_semester, grade_subj, grade_type)
			}
		})

		//LOAD STUDENT'S GRADES REPORT FULL / COMPACT
		var full_rep_nis
		var full_rep_cls
		var selected_subj
		var rep_period
		var rep_semester
		$('.std_rep').on('click', '.btn_detail, .btn_detail_compact', function () {

			var clicked
			if ($(this).hasClass('btn_detail')) {
				$('.details_grade').modal('show');

				rep_period = $('#full_select_semester').val()
				rep_semester = $('#full_select_semester option:selected').attr('data-semester')

				clicked = 'full';
			} else {
				$('.details_grade_compact').modal('show');

				rep_period = $('#compact_select_semester').val()
				rep_semester = $('#compact_select_semester').attr('data-semester')

				clicked = 'compact'
			}

			full_rep_nis = $(this).attr('data-nis');
			full_rep_cls = $(this).attr('data-class');

			let dropdown = $('.list_subj_std');

			$.ajax({
				url: 'get_std_subject_list',
				method: 'POST',
				data: {
					nis: full_rep_nis,
					cls: full_rep_cls,
					rep_period,
					rep_semester
				},
				success: data => {
					dropdown.empty()
					dropdown.append(data)

					selected_subj = $('.list_subj_std select').val()

					if (clicked == 'full') {
						fullReport(full_rep_nis, full_rep_cls, selected_subj, rep_period, rep_semester)
					} else if (clicked == 'compact') {
						fullReportCompact(full_rep_nis, full_rep_cls, rep_period, rep_semester)
					}
				}
			})
		})

		$('.list_subj_std').on('change', '.avail_subj', function () {
			selected_subj = $(this).val()

			fullReport(full_rep_nis, full_rep_cls, selected_subj, rep_period, rep_semester)
		})

		$('.details_grade, .details_grade_compact').on('change', '#full_select_semester, #compact_select_semester', function () {
			let dropdown = $('.list_subj_std')

			if ($(this).attr('id') == 'full_select_semester') {

				rep_period = $('#full_select_semester').val()
				rep_semester = $('#full_select_semester option:selected').attr('data-semester')

				$.ajax({
					url: 'get_std_subject_list',
					method: 'POST',
					data: {
						subj: selected_subj,
						nis: full_rep_nis,
						cls: full_rep_cls,
						rep_period,
						rep_semester
					},
					success: data => {
						dropdown.empty()
						dropdown.append(data)
					}
				}).then(() => {
					selected_subj = $('.avail_subj').val()
				}).then(() => fullReport(full_rep_nis, full_rep_cls, selected_subj, rep_period, rep_semester))

			} else if ($(this).attr('id') === 'compact_select_semester') {

				rep_period = $('#compact_select_semester').val()
				rep_semester = $('#compact_select_semester').attr('data-semester')

				fullReportCompact(full_rep_nis, full_rep_cls, rep_period, rep_semester)
			}
		})

		//LOAD FULL REPORT
		function fullReport(full_rep_nis, full_rep_cls, selected_subj, rep_period, rep_semester) {

			$('#rep_full_title').text(`REPORT ${full_rep_nis} - ${full_rep_cls}`)

			let header = `nis=${full_rep_nis}&cls=${full_rep_cls}&subj=${selected_subj}&period=${rep_period}&semester=${rep_semester}`

			//PLACE URL TO PRINT BUTTON
			$('body .print_grade_mid_report').attr('href', `${base_url}Admin/display_report_mid_print?${header}`);
			$('.print_grade_report').attr('href', `${base_url}Admin/display_report_print_a?${header}`);
			$('.print_grade_report_compact').attr('href', `${base_url}Admin/display_report_print_b?${header}`);

			$.ajax({
				url: 'get_grade_report',
				method: 'POST',
				dataType: 'JSON',
				data: {
					nis: full_rep_nis,
					cls: full_rep_cls,
					subj: selected_subj,
					period: rep_period,
					semester: rep_semester
				},
				success: data => {
					$('.kd_cog').html(data['KDCog'])
					$('.kd_sk').html(data['KDSK'])

					$('.exam_cog').html(data['EXM'])
					$('.exam_sk').html(data['EXM'])

					$('.report_voc').html(data.VOC)

					$('.report_cog').html(data['REPCog'])
					$('.report_sk').html(data['REPSK'])

					$('.desc_cog').html(data['DESCCog'])
					$('.desc_sk').html(data['DESCSK'])

					$('.report_soc').html(data.SOC)
					$('.report_spr').html(data.SPR)
				},
				error: data => {
					console.log(data)
				}
			})
		}

		//LOAD COMPACT REPORT 
		function fullReportCompact(full_rep_nis, full_rep_cls, rep_period, rep_semester) {
			var cognitive = $('.grade_report_tbody')
			var skills = $('.skills_report_tbody')
			var spectrum = $('.grade_report_spectrum')
			var absent = $('.absent_report_tbody')

			$('#compact_title').text(`REPORT ${full_rep_nis} - ${full_rep_cls}`)

			$.ajax({
				url: 'get_grade_report_compact',
				method: 'POST',
				dataType: 'JSON',
				data: {
					nis: full_rep_nis,
					cls: full_rep_cls,
					period: rep_period,
					semester: rep_semester
				},
				success: data => {
					cognitive.html(data.COG)
					skills.html(data.SK)
					spectrum.html(data.Spectrum)

					$('.soc_report_tbody').html(data.SOC)
					$('.spr_report_tbody').html(data.SPR)

					$('.voc_report_tbody').html(data.VOC)

					if (data['Absent'] != '') {
						absent.html(data['Absent'])
					} else {
						absent.html(
							`<tr>
                                <td colspan="2" width="2%"> This student has no absent for this semester </td> 
                            </tr>`
						)
					}
				},
				error: data => {
					alert(data)
				}
			})
		}

		//EDIT KD'S WEIGHT + KD's Description (COGNITIVE)
		$('.tbl_detailed_cognitive').on('keypress', 'thead td[contenteditable="true"]', function (e) {
			if (e.keyCode == 13) {
				e.preventDefault();

				let year = $(this).parents('.modal-body').find('.by_year').val()
				let semester = $(this).parents('.modal-body').find('.by_year option:selected').attr('data-semester')
				let type = $(this).attr('data-type')
				let subj = $(this).attr('data-subj')
				let code = $(this).attr('data-code')
				let field = $(this).attr('data-field')
				let value = $(this).text()
				value = value.replace(/\s+/g, '')

				$.ajax({
					url: 'update_kd_weight',
					method: 'POST',
					data: {
						room: grade_cls,
						year,
						semester,
						type,
						subj,
						code,
						field,
						value
					},
					success: data => {
						if (data == 'success') {
							get_full_details(grade_cls, year, semester, grade_subj, grade_type)
						} else if (data == 'INVALID_PERIOD') {
							alert('CANNOT UPDATE OLD PERIOD!')
						} else {
							console.log(data)
						}
					},
					error: data => {
						console.log(data)
					}
				})
			}
		})

		//EDIT KD'S FULL RECAP WEIGHT (SKILLS)
		$('.tbl_detailed_skills').on('keypress', 'thead td[contenteditable="true"]', function (e) {
			if (e.keyCode == 13 && !$(this).is('.kd_desc_sk')) {
				e.preventDefault()

				alert('TEST')

				let year = $(this).parents('.modal-body').find('.by_year').val()
				let semester = $(this).parents('.modal-body').find('.by_year option:selected').attr('data-semester')
				let room = grade_cls
				let subj = $(this).attr('data-subj')
				let field = $(this).attr('data-field')
				let value = $(this).text()
				value = value.replace(/\s+/g, '')

				$.ajax({
					url: 'update_recap_weight',
					method: 'POST',
					data: {
						room,
						year,
						semester,
						subj,
						field,
						value
					},
					success: data => {
						if (data == 'success') {
							get_full_details(grade_cls, year, semester, grade_subj, grade_type)
						} else if (data == 'INVALID_PERIOD') {
							alert('CANNOT UPDATE OLD PERIOD!')
						} else {
							console.log(data)
						}
					},
					error: data => {
						console.log(data.responseText)
					}
				})
			}
		})

		//EDIT KD'S DESCRIPTION (SKILLS)
		$('.tbl_detailed_skills').on('keypress', '.kd_desc_sk', function (e) {
			if (e.keyCode == 13) {
				e.preventDefault();

				let year = $(this).parents('.modal-body').find('.by_year').val()
				let semester = $(this).parents('.modal-body').find('.by_year option:selected').attr('data-semester')
				let type = $(this).attr('data-type')
				let subj = $(this).attr('data-subj')
				let code = $(this).attr('data-code')
				let field = $(this).attr('data-field')
				let value = $(this).text()

				console.table({
					type,
					subj,
					code,
					field,
					value
				})
				console.table({
					grade_cls,
					semester,
					grade_subj,
					grade_type
				})

				$.ajax({
					url: 'update_kd_weight',
					method: 'POST',
					data: {
						room: grade_cls,
						year,
						semester,
						type,
						subj,
						code,
						field,
						value
					},
					success: data => {
						if (data == 'success') {
							get_full_details(grade_cls, year, semester, grade_subj, grade_type)
						} else if (data == 'INVALID_PERIOD') {
							alert('CANNOT UPDATE OLD PERIOD!')
						} else {
							console.log(data)
						}
					}
				})
			}
		})

		//ADD / EDIT FULL GRADES (COGNITIVE & SKILL)
		$('#detailed_cognitive, #detailed_skills').on('keypress', '.table_body', function (e) {
			if (e.keyCode == 13) {
				e.preventDefault()

				//Vars for both KD and Exams
				let row = $(this).attr('data-row')
				let nis = $(this).siblings().eq(1).text()
				nis = nis.replace(/\s+/g, '')
				let year = $(this).parents('.modal-body').find('.by_year').val()
				let semester = $(this).parents('.modal-body').find('.by_year option:selected').attr('data-semester')
				let cls = $(this).parent('tr').attr('data-class')
				let room = $(this).parent('tr').attr('data-room')
				subj = grade_subj //Redeclare GLOBAL VAR
				type = grade_type //Redeclare GLOBAL VAR
				let field = $(this).attr('data-field')
				let val = $(this).text()
				val = val.replace(/\s+/g, '')


				if (row == 'kd') {
					//Declare these vars only when it's saving for KD's Grade
					let fullname = $(this).siblings().eq(2).text()
					let code = $(this).attr('data-code')
					code = code.replace(/\s+/g, '')

					$.ajax({
						url: 'sv_std_kd_grades',
						method: 'POST',
						data: {
							row,
							nis,
							year,
							semester,
							fullname,
							cls,
							room,
							subj,
							type,
							code,
							field,
							val
						},
						success: data => {
							if (data == 'success') {
								get_full_details(grade_cls, year, semester, grade_subj, grade_type)
							} else if (data == 'INVALID_PERIOD') {
								alert('CANNOT UPDATE OLD PERIOD!')
							} else {
								console.log(data)
							}
						},
						error: data => {
							console.log(data)
						}
					})
				} else {

					$.ajax({
						url: 'sv_std_exam_grades',
						method: 'POST',
						data: {
							row,
							cls,
							nis,
							year,
							semester,
							room,
							subj,
							type,
							field,
							val
						},
						success: data => {
							if (data == 'success') {
								get_full_details(grade_cls, year, semester, grade_subj, grade_type)
							} else if (data == 'INVALID_PERIOD') {
								alert('CANNOT UPDATE OLD PERIOD!')
							} else {
								console.log(data)
							}
						},
						error: data => {
							console.log(data)
						}
					})
				}
			}
		})

		//ADD / EDIT CHARACTER GRADES
		$('.tbody_soc, .tbody_spr').on('keypress', '.data_soc_char, .data_spr_char', function (e) {
			if (e.keyCode == 13) {
				e.preventDefault()

				let year = $(this).parents('.modal-body').find('.by_year').val()
				let semester = $(this).parents('.modal-body').find('.by_year option:selected').attr('data-semester')
				let nis = $(this).siblings().eq(1).text()
				nis = nis.replace(/\s+/g, '')
				let name = $(this).siblings().eq(2).text()
				let subj = grade_subj
				let room = $(this).parent('tr').attr('data-room')
				let type = $(this).attr('data-type')
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
							year,
							semester,
							subj,
							room,
							type,
							desc,
							value
						}
					}).then((data) => {
						if (data == 'success') {
							get_full_details(grade_cls, year, semester, grade_subj, grade_type)
						} else if (data == 'INVALID_PERIOD') {
							alert('CANNOT UPDATE OLD PERIOD!')
						} else {
							console.log(data)
						}
					})
				}
			}
		})

		//ADD / EDIT VOC (PRAKERIN/UKK) GRADES
		$('.tbody_voc').on('keypress', '.voc_grade', function (e) {
			if (e.keyCode == 13) {
				e.preventDefault()

				let nis = $(this).attr('data-nis')
				let semester = $(this).attr('data-semester')
				let period = $(this).attr('data-period')
				let room = $(this).attr('data-room')
				let subj = $(this).attr('data-subjname')
				let value = $(this).text()
				value = value.replace(/\s+/g, '')

				$.ajax({
					url: 'sv_std_voc_grades',
					method: 'POST',
					data: {
						nis,
						semester,
						period,
						room,
						subj,
						value
					},
					error: err => console.log(err.responseText)
				}).then(data => {
					if (data == 'success') {
						get_full_details(room, period, semester, subj, 'voc')
					} else if (data == 'INVALID_PERIOD') {
						alert('CANNOT UPDATE OLD PERIOD!')
					} else {
						console.log(data)
					}
				})
			}
		})
	}
});
