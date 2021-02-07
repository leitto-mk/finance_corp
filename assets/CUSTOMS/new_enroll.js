$(document).ready(function () {
    //INPUT MASK FOR FORM
    $('input[name="tgllhr"], input[name="schoolstarts"]').inputmask("9999/99/99", { clearMaskOnLostFocus: false });
    $('input[name="housephone"]').inputmask("(9999) 999-999", { clearMaskOnLostFocus: false });
    $('input[name="handheldnumber"]').inputmask("(+62) 999-9999-9999", { clearMaskOnLostFocus: false });

    if ($('body').is('.new_enroll')) {
        $.ajax({
            url: `${base_url}assets/CUSTOMS/countries.json`,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                for (let i = 0; i < data.length; i++) {
                    if (data[i].name === 'Indonesia') {
                        $('select[name="country"]').append(`<option value="${data[i].name}" selected> ${data[i].name} </option>`);
                    } else {
                        $('select[name="country"]').append(`<option value="${data[i].name}"> ${data[i].name} </option>`);
                    }
                }
            },
            error: function () {
                console.log('ERROR');
            }
        })

        //TAB 1
        var fname; var mname; var lname; var nname; var gender; var nisn; var nik; var kk; var tgllhr; var tmplhr; var akta; var religion;
        var country; var disabled; var address; var rt; var rw; var dusun; var village; var district; var region; var postal;
        var livewith; var transport; var lintang; var bujur; var child; var kip; var keepkip; var refusepip; var housephone; var handheldnumber;
        var email; var father; var fathernik; var fatheryear; var fatherdegree; var fatherjob; var fatherincome; var fatherdisabled; var mother; var mothernik;
        var motheryear; var motherdegree; var motherjob; var motherincome; var motherdisabled; var guardian; var guardiannik; var guardianyear; var guardiandegree; var guardianjob;
        var guardianincome; var guardiandisable;

        //TAB2
        var height; var weight; var headdiameter; var range; var exactrange; var timerange; var siblings; var achievement; var achievementlevel; var ach_name;
        var ach_year; var sponsor; var ach_rank; var scholarship; var scholardesc; var scholarstart; var scholarfinish; var prosperity; var prospernumber; var prospernametag;

        //TAB 3
        var competition; var nis; var applying; var schoolstarts; var previousschool; var unnumber; var diploma; var skhun;
        var diplomafile; var birthcertfile; var kkfile; var photo;

        //FORM VALIDATION SCRIPT
        $('input[type="text"], input[type="date"], input[type="number"], select option:selected').focusout(function () {
            if ($(this).val() == '' || $(this).val() == '-') {
                $(this).parent('.form-group').removeClass('has-success');
                $(this).parent('.form-group').addClass('has-error');

                let info = $(this).closest('.help-block');
                info.addClass('has-error');
                info.css('opacity', '1');
            } else {
                $(this).parent('.form-group').removeClass('has-error');
                $(this).parent('.form-group').addClass('has-success');
            }
        })

        $('input[type="radio"]').click(function () {
            if ($(this).is(':checked')) {
                let name = $(this).attr('name');

                $(`input[name="${name}"]`).closest('.md-radio').removeClass('has-error');
            }
        })

        $('input[name="kip"]').click(function () {
            if ($(this).val() == 'no') {
                $('input[name="keepkip"]').attr('disabled', 'disabled');
            } else {
                $('input[name="keepkip"]').removeAttr('disabled');
            }
        })
        //END FORM VALIDATION SCRIPT

        $('input[name="range"]').on('change', function () {
            if ($(this).val() == "< 1 KM") {
                $('.meters').text('(Meter)');
            } else {
                $('.meters').text('(Kilometer)');
            }
        })

        function get_input() {
            //TAB 1
            fname = $('input[name="fname"]').val();
            mname = $('input[name="mname"]').val();
            lname = $('input[name="lname"]').val();
            nname = $('input[name="nname"]').val();
            gender = $('input[name="gender"]:checked').val();
            nisn = $('input[name="nisn"]').val();
            nik = $('input[name="nik"]').val();
            kk = $('input[name="kk"]').val();
            tgllhr = $('input[name="tgllhr"]').val();
            tmplhr = $('input[name="tmplhr"]').val();
            akta = $('input[name="akta"]').val();
            religion = $('select[name="religion"]').val();
            country = $('select[name="country"]').val();
            disabled = $('input[name="disabled"]').val();
            address = $('input[name="address"]').val();
            rt = $('input[name="rt"]').val();
            rw = $('input[name="rw"]').val();
            dusun = $('input[name="dusun"]').val();
            village = $('input[name="village"]').val();
            district = $('input[name="district"]').val();
            region = $('input[name="region"]').val();
            postal = $('input[name="postal"]').val();
            livewith = $('select[name="livewith"]').val();
            transport = $('select[name="transport"]').val();
            lintang = $('input[name="lintang"]').val();
            bujur = $('input[name="bujur"]').val();
            child = $('input[name="child"]').val();
            kip = $('input[name="kip"]:checked').val();
            keepkip = $('input[name="keepkip"]:checked').val();
            refusepip = $('select[name="refusepip"]').val();
            housephone = $('input[name="housephone"]').val();
            handheldnumber = $('input[name="handheldnumber"]').val();
            email = $('input[name="email"]').val();
            father = $('input[name="father"]').val();
            fathernik = $('input[name="fathernik"]').val();
            fatheryear = $('input[name="fatheryear"]').val();
            fatherdegree = $('select[name="fatherdegree"]').val();
            fatherjob = $('select[name="fatherjob"]').val();
            fatherincome = $('select[name="fatherincome"]').val();
            fatherdisabled = $('input[name="fatherdisabled"]').val();
            mother = $('input[name="mother"]').val();
            mothernik = $('input[name="mothernik"]').val();
            motheryear = $('input[name="motheryear"]').val();
            motherdegree = $('select[name="motherdegree"]').val();
            motherjob = $('select[name="motherjob"]').val();
            motherincome = $('select[name="motherincome"]').val();
            motherdisabled = $('input[name="motherdisabled"]').val();
            guardian = $('input[name="guardian"]').val();
            guardiannik = $('input[name="guardiannik"]').val();
            guardianyear = $('input[name="guardianyear"]').val();
            guardiandegree = $('select[name="guardiandegree"]').val();
            guardianjob = $('select[name="guardianjob"]').val();
            guardianincome = $('select[name="guardianincome"]').val();
            guardiandisable = $('input[name="guardiandisabled"]').val();

            //TAB2
            height = $('input[name="height"]').val();
            weight = $('input[name="weight"]').val();
            headdiameter = $('input[name="headdiameter"]').val();
            range = $('input[name="range"]:checked').val();
            exactrange = $('input[name="exactrange"]').val();
            timerange = $('input[name="timerange"]').val();
            siblings = $('input[name="siblings"]').val();
            achievement = $('input[name="achievement"]:checked').val();
            achievementlevel = $('input[name="achievementlevel"]:checked').val();
            ach_name = $('input[name="ach_name"]').val();
            ach_year = $('input[name="ach_year"]').val();
            sponsor = $('input[name="sponsor"]').val();
            ach_rank = $('input[name="ach_rank"]').val();
            scholarship = $('input[name="scholarship"]:checked').val();
            scholardesc = $('input[name="scholardesc"]').val();
            scholarstart = $('input[name="scholarstart"]').val();
            scholarfinish = $('input[name="scholarfinish"]').val();
            prosperity = $('select[name="prosperity"]').val();
            prospernumber = $('input[name="prospernumber"]').val();
            prospernametag = $('input[name="prospernametag"]').val();

            //TAB 3
            competition = $('input[name="competition"]').val();
            nis = $('input[name="nis"]').val();
            applying = $('[name="applying"]').val();
            schoolstarts = $('input[name="schoolstarts"]').val();
            previousschool = $('input[name="previousschool"]').val();
            unnumber = $('input[name="unnumber"]').val();
            diploma = $('input[name="diploma"]').val();
            skhun = $('input[name="skhun"]').val();
            diplomafile = $('input[name="diplomafile"]').prop('files')
            birthcertfile = $('input[name="birthcertfile"]').prop('files')
            kkfile = $('input[name="kkfile"]').prop('files')
            photo = $('input[name="photo"]').prop('files')
        }

        function post_input() {
            $('input[name="confirm_fname"]').val(`${fname}`);
            $('input[name="confirm_mname"]').val(`${mname}`);
            $('input[name="confirm_lname"]').val(`${lname}`);
            $('input[name="confirm_nname"]').val(`${nname}`);
            $(`input[name="confirm_gender"][value="${gender}"]`).attr('checked', 'checked');
            $('input[name="confirm_nisn"]').val(`${nisn}`);
            $('input[name="confirm_nik"]').val(`${nik}`);
            $('input[name="confirm_kk"]').val(`${kk}`);
            $('input[name="confirm_tgllhr"]').val(`${tgllhr}`);
            $('input[name="confirm_tmplhr"]').val(`${tmplhr}`);
            $('input[name="confirm_akta"]').val(`${akta}`);
            $('input[name="confirm_religion"]').val(`${religion}`);
            $('input[name="confirm_country"]').val(`${country}`);
            $('input[name="confirm_disabled"]').val(`${disabled}`);
            $('input[name="confirm_address"]').val(`${address}`);
            $('input[name="confirm_rt"]').val(`${rt}`);
            $('input[name="confirm_rw"]').val(`${rw}`);
            $('input[name="confirm_dusun"]').val(`${dusun}`);
            $('input[name="confirm_village"]').val(`${village}`);
            $('input[name="confirm_district"]').val(`${district}`);
            $('input[name="confirm_region"]').val(`${region}`);
            $('input[name="confirm_postal"]').val(`${postal}`);
            $('input[name="confirm_livewith"]').val(`${livewith}`);
            $('input[name="confirm_transport"]').val(`${transport}`);
            $('input[name="confirm_lintang"]').val(`${lintang}`);
            $('input[name="confirm_bujur"]').val(`${bujur}`);
            $('input[name="confirm_child"]').val(`${child}`);
            $(`input[name="confirm_kip"][value="${kip}"]`).attr('checked', 'checked');
            $(`input[name="confirm_keepkip"][value="${keepkip}"]`).attr('checked', 'checked');
            $('input[name="confirm_refusepip"]').val(`${refusepip}`);
            $('input[name="confirm_housephone"]').val(`${housephone}`);
            $('input[name="confirm_handheldnumber"]').val(`${handheldnumber}`);
            $('input[name="confirm_email"]').val(`${email}`);
            $('input[name="confirm_father"]').val(`${father}`);
            $('input[name="confirm_fathernik"]').val(`${fathernik}`);
            $('input[name="confirm_fatheryear"]').val(`${fatheryear}`);
            $('input[name="confirm_fatherdegree"]').val(`${fatherdegree}`);
            $('input[name="confirm_fatherjob"]').val(`${fatherjob}`);
            $('input[name="confirm_fatherincome"]').val(`${fatherincome}`);
            $('input[name="confirm_fatherdisabled"]').val(`${fatherdisabled}`);
            $('input[name="confirm_mother"]').val(`${mother}`);
            $('input[name="confirm_mothernik"]').val(`${mothernik}`);
            $('input[name="confirm_motheryear"]').val(`${motheryear}`);
            $('input[name="confirm_motherdegree"]').val(`${motherdegree}`);
            $('input[name="confirm_motherjob"]').val(`${motherjob}`);
            $('input[name="confirm_motherincome"]').val(`${motherincome}`);
            $('input[name="confirm_motherdisabled"]').val(`${motherdisabled}`);
            $('input[name="confirm_guardian"]').val(`${guardian}`);
            $('input[name="confirm_guardiannik"]').val(`${guardiannik}`);
            $('input[name="confirm_guardianyear"]').val(`${guardianyear}`);
            $('input[name="confirm_guardiandegree"]').val(`${guardiandegree}`);
            $('input[name="confirm_guardianjob"]').val(`${guardianjob}`);
            $('input[name="confirm_guardianincome"]').val(`${guardianincome}`);
            $('input[name="confirm_guardiandisabled"]').val(`${guardiandisable}`);

            //TAB 2
            $('input[name="confirm_height"]').val(`${height}`);
            $('input[name="confirm_weight"]').val(`${weight}`);
            $('input[name="confirm_headdiameter"]').val(`${headdiameter}`);
            $(`input[name="confirm_range"][value="${range}"]`).attr('checked', 'checked');
            $('input[name="confirm_exactrange"]').val(`${exactrange}`);
            $('input[name="confirm_timerange"]').val(`${timerange}`);
            $('input[name="confirm_siblings"]').val(`${siblings}`);
            $(`input[name="confirm_achievement"][value="${achievement}"]`).attr('checked', 'checked')
            $(`input[name="confirm_achievementlevel"][value="${achievementlevel}"]`).attr('checked', 'checked')
            $('input[name="confirm_ach_name"]').val(`${ach_name}`);
            $('input[name="confirm_ach_year"]').val(`${ach_year}`);
            $('input[name="confirm_sponsor"]').val(`${sponsor}`);
            $('input[name="confirm_ach_rank"]').val(`${ach_rank}`);
            $(`input[name="confirm_scholarship"][value="${scholarship}"]`).attr('checked', 'checked');
            $('input[name="confirm_scholardesc"]').val(`${scholardesc}`);
            $('input[name="confirm_scholarstart"]').val(`${scholarstart}`);
            $('input[name="confirm_scholarfinish"]').val(`${scholarfinish}`);
            $(`input[name="confirm_prosperity"]`).val(`${prosperity}`);
            $('input[name="confirm_prospernumber"]').val(`${prospernumber}`);
            $('input[name="confirm_prospernametag"]').val(`${prospernametag}`);

            //TAB 3
            $('input[name="confirm_competition"]').val(`${competition}`);
            $('input[name="confirm_nis"]').val(`${nis}`);
            $('input[name="confirm_applying"]').val(`${applying}`);
            $('input[name="confirm_schoolstarts"]').val(`${schoolstarts}`);
            $('input[name="confirm_previousschool"]').val(`${previousschool}`);
            $('input[name="confirm_unnumber"]').val(`${unnumber}`);
            $('input[name="confirm_diploma"]').val(`${diploma}`);
            $('input[name="confirm_skhun"]').val(`${skhun}`);
        }

        $('li').children('a').on('click', function () {
            get_input();

            if ($(this).attr('href') == '#tab4') {
                post_input();
            }
        })

        $('.button-next').on('click', function () {

            let index = $(this).parents('.tab-pane').attr('id');
            let next = $(`#${index}`).next().attr('id');

            get_input();

            var data;

            if (index == 'tab1') {
                $('.step-title').text("STEP 2 OF 4");

                //FOR DEBUGGING PURPOSES
                data = [
                    fname, lname, gender, nisn, nik, kk, tgllhr, tmplhr, akta, religion,
                    country, disabled, address, rt, rw, dusun, village, district, region, postal,
                    livewith, transport, lintang, bujur, child, kip, keepkip, refusepip, housephone, handheldnumber,
                    email, father, fathernik, fatheryear, fatherdegree, fatherjob, fatherincome, fatherdisabled, mother, mothernik,
                    motheryear, motherdegree, motherjob, motherincome, motherdisabled, guardian, guardiannik, guardianyear, guardiandegree, guardianjob,
                    guardianincome, guardiandisable
                ];

            } else if (index == 'tab2') {
                $('.step-title').text("STEP 3 OF 4");

                //FOR DEBUGGING PURPOSES
                data = [
                    height, weight, headdiameter, range, exactrange, timerange, siblings, achievement, achievementlevel, ach_name,
                    ach_year, sponsor, ach_rank, scholarship, scholardesc, scholarstart, scholarfinish, prosperity, prospernumber, prospernametag
                ];

            } else if (index == 'tab3') {
                $('.step-title').text("STEP 4 OF 4");

                //FOR DEBUGGING PURPOSES
                data = [
                    competition, nis, schoolstarts, previousschool, unnumber, diploma, skhun
                ];

                //POST DATA FROM get_input()
                post_input();
            }

            console.dir(data);

            $(`a[href="#${index}"]`).parent('li').removeClass('active');
            $(`a[href="#${index}"]`).parent('li').addClass('done');
            $(`#${index}`).removeClass('active');

            $(`a[href="#${next}"]`).parent('li').addClass('active');
            $(`#${next}`).addClass('active');

            if (next === 'tab4') {
                $('.progress-bar').addClass('progress-bar-success');
            }

            $("html, body").animate({ scrollTop: 0 }, 750);
        })

        $('.button-back').click(function () {

            let index = $(this).parents('.tab-pane').attr('id');
            let before = $(`#${index}`).prev().attr('id');
            let progress = $(`a[href="#${before}"]`).children('.number').text();
            let bar = (progress / 4) * 100;

            console.log(`${index} | ${before} | ${progress}`);

            $(`a[href="#${index}"]`).parent('li').removeClass('active');
            $(`#${index}`).removeClass('active');

            $(`a[href="#${before}"]`).parent('li').addClass('active');
            $(`#${before}`).addClass('active');

            $('.progress-bar .progress-bar-success').css('width', `${bar}% !important`);

            $("html, body").animate({ scrollTop: 0 }, 750);
        })

        $('.button-submit').click(function () {
            Swal.fire({
                title: 'Lanjutkan?',
                text: "Pastikan data telah sesuai dengan form yang diminta sebelum dikirim!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (kip == 'no') {
                    keepkip = '-';
                } else if (typeof kip == 'undefined') {
                    kip = 'None';
                } else {
                    keepkip = '-';
                }

                if (typeof achievement == 'undefined') {
                    achievement = 'None';
                }

                if (typeof achievementlevel == 'undefined') {
                    achievementlevel = 'None';
                }

                if (typeof scholarship == 'undefined') {
                    scholarship = 'None';
                }

                if (result.value) {
                    var form = new FormData($('#submit_form')[0])

                    $.ajax({
                        url: 'Enrollment/enroll_confirmed',
                        method: 'POST',
                        data: form,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if (data == 'success') {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Berhasil',
                                    text: 'Anda telah berhasil mendaftar lewat Sistem sekolah'
                                }).then(result => {
                                    if(result.value){
                                        close()
                                        window.open(BASE_URL + `Student/home`)
                                    }
                                })
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Gagal mendaftarkan Diri Anda',
                                    text: 'Pastikan Data yang anda masukan telah sesuai dengan form yang diminta'
                                })

                                console.log(data)
                            }
                        },
                        error: function (data) {
                            alert("SOMETHING'S WRONG");
                            console.log(data.responseText)
                        }
                    })
                }
            })
        })
    }
});