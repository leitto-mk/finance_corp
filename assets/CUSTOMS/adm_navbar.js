$(document).ready(function () {
    var sch = $('div').is('.schedule');
    var grade = $('div').is('.grade');
    var absn = $('div').is('.absent');
    var prof = $('div').is('.profiles');
    var enroll = $('div').is('.new_enroll');
    var fnc = $('div').is('.finance');

    if (prof) {
        var prefix_url = window.location.pathname;
        prefix_url = prefix_url.split('/');

        $('.profile').addClass('active open selected');

        if (prefix_url[3] == 'load_prof_tch_add' || prefix_url[3] == 'load_prof_tch' || prefix_url[3] == 'load_prof_tch_update') {
            $('li .main').removeClass('active open selected');
            $('li').children('a .subnav').removeClass('active');

            $('#guru').parent('li').addClass('active');
        } else if (prefix_url[3] == 'load_prof_std_add' || prefix_url[3] == 'load_prof_std' || prefix_url[3] == 'load_prof_std_update') {
            $('li .main').removeClass('active open selected');
            $('li').children('a .subnav').removeClass('active');

            $('#siswa').parent('li').addClass('active');
        } else if (prefix_url[3] == 'load_prof_stf_add' || prefix_url[3] == 'load_prof_stf' || prefix_url[3] == 'load_prof_stf_update') {
            $('li .main').removeClass('active open selected');
            $('li').children('a .subnav').removeClass('active');

            $('#staf').parent('li').addClass('active');
        }

    }
})