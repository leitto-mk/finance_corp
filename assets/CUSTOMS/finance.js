$(document).ready(function () {

    if ($('div').is('.finance')) {

        var cat;
        var degree;
        $('.cat_bar').click(function () {
            cat = $(this).attr('data-cat');
            $('.cat_desc').text(`Category ${cat}`);
            $('.cat_opt').modal('show');
        })

        $('select[name="cat_degree"]').change(function () {
            if ($(this).val() != '') {
                degree = $('select[name="cat_degree"]').val();

                $.ajax({
                    url: 'get_cat_tuition',
                    method: 'POST',
                    data: { degree, cat },
                    success: function (data) {
                        $('input[name="cur_tuition"]').val(data);
                    }
                })
            } else {
                $('input[name="cur_tuition"]').val('');
            }
        })

        $('.btn_payment').click(function () {
            $('.payment').modal('show');
            $('.pay_title').text('PAYMENT');

            alert('success');
        })

        $('.sv_cur_tuition').click(function () {
            let newinput = $('input[name="cur_tuition"]').val();

            $.ajax({
                url: 'save_cat_tuition',
                method: 'POST',
                data: {
                    degree,
                    cat,
                    newinput
                },
                success: function () {
                    $('.tuition-input').addClass('has-success').fadeIn(1000);

                    setTimeout(function () {
                        $('.tuition-input').removeClass('has-success');
                    }, 3500)
                }
            })
        })

        $('.proceed_payment').click(function () {
            $('.payment').modal('hide');
            $('.receipt').modal('show');
        })

        $('.btn_print_receipt').click(function () {
            window.print();
        })

        $('input[name="id"]').keyup(function () {
            let id = $(this).val();

            if (id != '') {
                $.ajax({
                    url: 'get_fnc_by_id',
                    method: 'POST',
                    data: { id },
                    success: function (data) {
                        $('.fnc_data').empty();
                        $('.fnc_data').append(data);
                    }
                })
            } else {
                $('.fnc_data').empty();
            }
        })

        $('input[name="fullname"]').keyup(function () {
            let name = $(this).val();

            if (name != '') {
                $.ajax({
                    url: 'get_fnc_by_name',
                    method: 'POST',
                    data: { name },
                    success: function (data) {
                        $('.fnc_data').empty();
                        $('.fnc_data').append(data);
                    }
                })
            } else {
                $('.fnc_data').empty();
            }
        })

        var selected;
        $('select[name="degree"]').on('change', function () {
            selected = $('select[name="degree"] option:selected').val();

            if (selected != '-') {
                $.ajax({
                    url: 'get_fnc_degrees',
                    method: 'POST',
                    data: { selected },
                    success: function (data) {
                        data = $.parseJSON(data);

                        $('select[name="classes"]').empty();
                        $('select[name="classes"]').append(data['classes']);

                        $('.fnc_data').empty();
                        $('.fnc_data').append(data['row']);
                    }
                });
            } else {
                $('.fnc_data').empty();
            }
        })

        $('select[name="classes"]').on('change', function () {
            let cls = $(this).val();

            if (selected != '-') {
                $.ajax({
                    url: 'get_fnc_classes',
                    method: 'POST',
                    data: { cls },
                    success: function (data) {
                        data = $.parseJSON(data);

                        $('select[name="rooms"]').empty();
                        $('select[name="rooms"]').append(data['classes']);

                        $('.fnc_data').empty();
                        $('.fnc_data').append(data['row']);
                    }
                });
            } else {
                $('.fnc_data').empty();
            }
        })

        $('select[name="rooms"]').on('change', function () {
            let room = $(this).val();

            $.ajax({
                url: 'get_fnc_rooms',
                method: 'POST',
                data: { room },
                success: function (data) {
                    $('.fnc_data').empty();
                    $('.fnc_data').append(data);
                }
            })
        })
    }
})