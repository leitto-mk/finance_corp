$(document).ready(function () {
	//If current Path is on absent page, load the script
	if ($('div').is('.enroll')) {

		//Show New Student Profile Details
		$('.enroll-list').on('click', '.detail', evt => {
			let ctrlno = evt.target.getAttribute('data-id')

			$.ajax({
				url: 'new_student_details',
				method: 'POST',
				dataType: 'JSON',
				data: {
					ctrlno
				},
				success: response => {
					document.getElementById('fullname').innerHTML = `${response.FirstName} ${response.MiddleName} ${response.LastName}`
					document.getElementById('pointofbirth').innerHTML = `${response.PointofBirth}`
					document.getElementById('nickname').innerHTML = `${response.NickName}`
					document.getElementById('religion').innerHTML = `${response.Religion}`
					document.getElementById('nik').innerHTML = `${response.NIK}`
					document.getElementById('height').innerHTML = `${response.Height}`
					document.getElementById('gender').innerHTML = `${response.Gender}`
					document.getElementById('weight').innerHTML = `${response.Weight}`
					document.getElementById('dateofbirth').innerHTML = `${response.DateofBirth}`
					document.getElementById('headsize').innerHTML = `${response.HeadDiameter}`
					document.getElementById('livewith').innerHTML = `${response.LiveWith}`
					document.getElementById('postal').innerHTML = `${response.Postal}`
					document.getElementById('transportation').innerHTML = `${response.Transportation}`
					document.getElementById('houserange').innerHTML = `${response.Range}`
					document.getElementById('address').innerHTML = `${response.Address}`
					document.getElementById('exactrange').innerHTML = `${response.ExactRange}`
					document.getElementById('rt').innerHTML = `${response.RT}`
					document.getElementById('traveltime').innerHTML = `${response.TimeRange}`
					document.getElementById('rw').innerHTML = `${response.RW}`
					document.getElementById('latitude').innerHTML = `${response.Latitude}`
					document.getElementById('village').innerHTML = `${response.Village}`
					document.getElementById('longitude').innerHTML = `${response.Longitude}`
					document.getElementById('district').innerHTML = `${response.District}`
					document.getElementById('email').innerHTML = `${response.Email}`
					document.getElementById('region').innerHTML = `${response.Region}`
					document.getElementById('housenumber').innerHTML = `${response.HousePhone}`
					document.getElementById('country').innerHTML = `${response.Country}`
					document.getElementById('phone').innerHTML = `${response.Phone}`
					document.getElementById('nis').innerHTML = `${response.NIS}`
					document.getElementById('competent').innerHTML = `${response.Competition}`
					document.getElementById('previousschool').innerHTML = `${response.PreviousSchool}`
					document.getElementById('diploma').innerHTML = `${response.Diploma}`
					document.getElementById('achievement').innerHTML = `${response.Achievement}`
					document.getElementById('achievementlevel').innerHTML = `${response.AchievementLVL}`
					document.getElementById('achievementname').innerHTML = `${response.AchievementName}`
					document.getElementById('achievementyear').innerHTML = `${response.AchievementYear}`
					document.getElementById('sponsor').innerHTML = `${response.Sponsor}`
					document.getElementById('achievementrank').innerHTML = `${response.AchievementRank}`
					document.getElementById('scholarship').innerHTML = `${response.Scholarship}`
					document.getElementById('scholardesc').innerHTML = `${response.Scholardesc}`
					document.getElementById('scholarstart').innerHTML = `${response.Scholarstart}`
					document.getElementById('scholarend').innerHTML = `${response.Scholarfinish}`
					document.getElementById('prosper').innerHTML = `${response.Prosperity}`
					document.getElementById('prospernum').innerHTML = `${response.ProsperNumber}`
					document.getElementById('prospername').innerHTML = `${response.ProsperNameTag}`
					document.getElementById('fathername').innerHTML = `${response.Father}`
					document.getElementById('mothername').innerHTML = `${response.Mother}`
					document.getElementById('guardianname').innerHTML = `${response.Guardian}`
					document.getElementById('fatherid').innerHTML = `${response.FatherNIK}`
					document.getElementById('motherid').innerHTML = `${response.MotherNIK}`
					document.getElementById('guardianid').innerHTML = `${response.GuardianNIK}`
					document.getElementById('fatherborn').innerHTML = `${response.FatherBorn}`
					document.getElementById('motherborn').innerHTML = `${response.MotherBorn}`
					document.getElementById('guardianborn').innerHTML = `${response.GuardianBorn}`
					document.getElementById('fatherdegree').innerHTML = `${response.FatherDegree}`
					document.getElementById('motherdegree').innerHTML = `${response.MotherDegree}`
					document.getElementById('guardiandegree').innerHTML = `${response.GuardianDegree}`
					document.getElementById('fatherjob').innerHTML = `${response.FatherJob}`
					document.getElementById('motherjob').innerHTML = `${response.MotherJob}`
					document.getElementById('guardianjob').innerHTML = `${response.GuardianJob}`
					document.getElementById('fatherearn').innerHTML = `${response.FatherIncome}`
					document.getElementById('motherearn').innerHTML = `${response.MotherIncome}`
					document.getElementById('guardianearn').innerHTML = `${response.GuardianIncome}`
					document.getElementById('fatherdisable').innerHTML = `${response.FatherDisability}`
					document.getElementById('motherdisable').innerHTML = `${response.MotherDisability}`
					document.getElementById('guardiandisable').innerHTML = `${response.GuardianDisability}`

					//FILE DOCS
					document.querySelector('img[name=diplomafile]').setAttribute('src', (response.DiplomaFile ? `${base_url}assets/photos/student/${response.DiplomaFile}` : `${base_url}assets/photos/noimage.gif`))
					document.querySelector('img[name=birthcertfile]').setAttribute('src', (response.BirthcertFile ? `${base_url}assets/photos/student/${response.BirthcertFile}` : `${base_url}assets/photos/noimage.gif`))
					document.querySelector('img[name=kkfile]').setAttribute('src', (response.KKFile ? `${base_url}assets/photos/student/${response.KKFile}` : `${base_url}assets/photos/noimage.gif`))
					document.querySelector('img[name=photofile]').setAttribute('src', (response.Photo ? `${base_url}assets/photos/student/${response.Photo}` : `${base_url}assets/photos/noimage.gif`))
					document.querySelector('img[name=sppfile]').setAttribute('src', (response.SPP ? `${base_url}assets/photos/student/${response.SPP}` : `${base_url}assets/photos/noimage.gif`))

					document.querySelector('a[name=diplomafile]').setAttribute('href', (response.DiplomaFile ? `${base_url}assets/photos/student/${response.DiplomaFile}` : `${base_url}assets/photos/noimage.gif`))
					document.querySelector('a[name=birthcertfile]').setAttribute('href', (response.BirthcertFile ? `${base_url}assets/photos/student/${response.BirthcertFile}` : `${base_url}assets/photos/noimage.gif`))
					document.querySelector('a[name=kkfile]').setAttribute('href', (response.KKFile ? `${base_url}assets/photos/student/${response.KKFile}` : `${base_url}assets/photos/noimage.gif`))
					document.querySelector('a[name=photofile]').setAttribute('href', (response.Photo ? `${base_url}assets/photos/student/${response.Photo}` : `${base_url}assets/photos/noimage.gif`))
					document.querySelector('a[name=sppfile]').setAttribute('href', (response.SPP ? `${base_url}assets/photos/student/${response.SPP}` : `${base_url}assets/photos/noimage.gif`))
				},
				error: err => {
					console.log(err.responseText)
				}
			})

			$('#profile_detail').modal('show')
		})

		//Show Table Content
		get_table(1);

		function get_table(index) {
			$.ajax({
				url: 'get_list_enroll/' + index,
				method: "GET",
				datatype: "JSON",
				success: function (response) {
					var data = JSON.parse(response);

					$('.enroll-list').empty();
					$('.enroll-list').append(data.value);
					$('.enroll-list').append(data.page);
				},
				error: function (data) {
					alert(data);
				}
			});
		}

		var unique;

		//Open Modal Evaluation
		$('.enroll-list').on('click', '.approve_enroll', function(){
			$('#evaluate-std').modal('show')

			unique = $(this).attr('data-id');

			$.ajax({
				url: 'ajax_get_target_files',
				method: 'POST',
				dataType: 'JSON',
				data: {
					unique
				},
				success: response => {
					//SET CHECKBOX
					$('#checkdiploma').prop('checked', (response.data.is_approved_diploma == 1 ? true : false))
					$('#checkbirthcert').prop('checked', (response.data.is_approved_birthcert == 1 ? true : false))
					$('#checkkk').prop('checked', (response.data.is_approved_kk == 1 ? true : false))
					$('#checkphoto').prop('checked', (response.data.is_approved_photo == 1 ? true : false))
					$('#checkspp').prop('checked', (response.data.is_approved_spp == 1 ? true : false))
					
					//SET UNAPPROVED NOTE
					$('#notediploma').prop('disabled', (response.data.is_approved_diploma == 1 ? true : false))
					$('#notebirthcert').prop('disabled', (response.data.is_approved_birthcert == 1 ? true : false))
					$('#notekk').prop('disabled', (response.data.is_approved_kk == 1 ? true : false))
					$('#notephoto').prop('disabled', (response.data.is_approved_photo == 1 ? true : false))
					$('#notespp').prop('disabled', (response.data.is_approved_spp == 1 ? true : false))

					$('#notediploma').val(response.data.unapproved_diploma_msg  || '')
					$('#notebirthcert').val(response.data.unapproved_birthcert_msg  || '')
					$('#notekk').val(response.data.unapproved_kk_msg  || '')
					$('#notephoto').val(response.data.unapproved_photo_msg  || '')
					$('#notespp').val(response.data.unapproved_spp_msg || '')

					//DISPLAY FILE
					$('#evaluate_diploma').attr('src', (response.data.DiplomaFile ? `${base_url}/assets/photos/student/${response.data.DiplomaFile}` : `${base_url}/assets/photos/noimage.gif`))
					$('#evaluate_birthcert').attr('src', (response.data.BirthcertFile ? `${base_url}/assets/photos/student/${response.data.BirthcertFile}` : `${base_url}/assets/photos/noimage.gif`))
					$('#evaluate_kk').attr('src', (response.data.KKFile ? `${base_url}/assets/photos/student/${response.data.KKFile}` : `${base_url}/assets/photos/noimage.gif`))
					$('#evaluate_photo').attr('src', (response.data.Photo ? `${base_url}/assets/photos/student/${response.data.Photo}` : `${base_url}/assets/photos/noimage.gif`))
					$('#evaluate_spp').attr('src', (response.data.SPP ? `${base_url}/assets/photos/student/${response.data.SPP}` : `${base_url}/assets/photos/noimage.gif`))
				},
				error: () => alert('NETWORK PROBLEM')
			})
		})

		//Checkbox Evaluation
		$('input[type=checkbox]').click(function(){
			if($(this).is(':checked')){
				$(this).parents('.row').find('input[type=text]').prop('disabled', true)
			}else{
				$(this).parents('.row').find('input[type=text]').prop('disabled', false)
			}
		});

		//Submit Evaluation
		$('.set_approve_evaluation').click(function(e){
			e.preventDefault()

			let obj = $('#form_evaluation').serializeArray()
			let id = unique;

			$.ajax({
				url: `evaluate_data?id=${id}`,
				method: 'POST',
				data: obj,
				success: response => {
					if(response == 'success'){
						Swal.fire({
							'type': 'success',
							'title': 'SUCCESS',
							'text': 'DATA HAS BEEN EVALUATED'
						}).then( value => {
							if(value){
								$('#evaluate-std').modal('hide')
		
								location.reload()
							}
						})

					}
				},
				error: () => alert('NETWORK PROBLEM')
			})
		});

		//Pagination
		$('.enroll-list').on('click', '.pagin', function (e) {
			e.preventDefault();
			let index = $(this).attr('data-ci-pagination-page');

			get_table(index);
		});

		//Open Modal Class Apointment
		$('.enroll-list').on('click', '.approve', function () {
			let apply = $(this).attr('data-apply');
			let row = $(this).closest('tr');
			let uniq = row.attr('data-list');
			let email = $(this).attr('data-email')

			$('#new-std').modal('show');

			$.ajax({
				url: 'get_dropdown_apply',
				method: 'POST',
				data: {
					apply,
					email
				},
				success: data => {
					$('.approve_std').empty();
					$('.approve_std').append(data);
					unique = uniq;
				}
			});
		});

		//Approve New Student
		$('#new-std').on('click', '.set_approve', function () {

			let room = $('select[name="room"]').val();

			$.ajax({
				url: "approve_list",
				method: "POST",
				data: {
					uniq: unique,
					room: room
				},
				success: function (data) {
					Swal.fire({
						type: 'success',
						title: 'Success',
						text: `New Student has been approved and appointed to Class ${room}`
					})

					$('#new-std').modal('hide');

					let row = $(`tr[data-list="${unique}"]`);
					row.remove();
				},
				error: function () {
					alert("SOMETHING'S WRONG");
				}
			});
		});

		//Disapprove Enrolled User
		$('.enroll-list').on('click', '.cancel', function () {
			let row = $(this).closest('tr');
			let unique = row.attr('data-list');

			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'delete'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: "cancel_list",
						method: "POST",
						data: {
							uniq: unique
						},
						success: function (data) {
							row.fadeOut(750, function () {
								row.remove();
								$('.enroll-total').attr('data-value', data);
								$('.enroll-total').text(data);
							});
		
							Swal.fire(
								'Deleted!',
								'Data has been deleted.',
								'success'
							)
						}
					});
				}
			})
		});
	}
});
