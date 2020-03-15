$(document).ready(function () {

	var path = window.location.pathname;

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

		//Pagination
		$('.enroll-list').on('click', '.pagin', function (e) {
			e.preventDefault();
			let index = $(this).attr('data-ci-pagination-page');

			get_table(index);
		});


		var unique;
		//Open Modal Class Apointment
		$('.enroll-list').on('click', '.approve', function () {
			let apply = $(this).attr('data-apply');
			let row = $(this).closest('tr');
			let uniq = row.attr('data-list');

			$('#new-std').modal('show');

			$.ajax({
				url: 'get_dropdown_apply',
				method: 'POST',
				data: {
					apply
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
