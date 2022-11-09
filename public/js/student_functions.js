$(document).ready(function () {
    $('#btn-logout').on('click', function () {
        logout();
    });

    $('form').on('submit', function (event) {
        event.preventDefault();
    });

    $('form.form_test').on('submit', function (event) {
        event.preventDefault();
        submit_test(this.id);
        this.reset();
    });

    $('#eye').click(function () {
        $(this).toggleClass('open');
        $(this).children('i').toggleClass('mdi-eye-off mdi-eye');
        if ($(this).hasClass('open')) {
            $(this).prev().attr('type', 'text');
        } else {
            $(this).prev().attr('type', 'password');
        }
    });

    $('#resetFilter').click(function () {
        window.location = 'index.php?action=list_test';
    });
});

function filter_test() {
    var subject_id = $('#subject_id').val();
    var grade_id = $('#grade_id').val();
    var status_id = $('#status_id').val();

    if (subject_id != null && grade_id != null && status_id != null) {
        window.location =
            'index.php?action=list_test_filter&subject_id=' +
            subject_id +
            '&grade_id=' +
            grade_id +
            '&status_id=' +
            status_id;
    }
}

function show_status(json_data) {
    if (json_data.status) {
        $('#status').addClass('success');
        $('#status').removeClass('failed');
    } else {
        $('#status').addClass('failed');
        $('#status').removeClass('success');
    }
    $('#status').html(json_data.status_value);
    $('#status').animate(
        {
            height: '65',
            'line-height': '65px',
            opacity: '1',
        },
        500
    );
    $('#status').delay(1000).animate(
        {
            opacity: '0',
            height: '0',
            'line-height': '0px',
        },
        500
    );
}

function logout() {
    var url = 'index.php?action=logout';
    var data = {
        confirm: true,
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            setTimeout(function () {
                window.location.replace('index.php');
            }, 1500);
        }
    };
    $.post(url, data, success);
}

function valid_email_on_profiles(data) {
    var new_email = $('#profiles-new-email').val();
    var current_email = $('#profiles-current-email').val();
    var url = 'index.php?action=valid_email_on_profiles';
    var data1 = {
        new_email: new_email,
        current_email: current_email,
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        if (json_data.status) {
            $('#valid-email-true').removeClass('hidden');
            $('#valid-email-false').addClass('hidden');
        } else {
            $('#valid-email-false').removeClass('hidden');
            $('#valid-email-true').addClass('hidden');
        }
    };
    $.post(url, data1, success);
}

function submit_test(id) {
    var data = $('#' + id).serialize();
    var url = 'index.php?action=check_password';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status == 0) {
            toastr.warning(json_data.status_value, 'Warning');
        } else if (json_data.status == 1) {
            setTimeout(function () {
                location.reload();
            }, 1500);
            toastr.success(json_data.status_value, 'Success');
        }
    };
    $.post(url, data, success);
}
