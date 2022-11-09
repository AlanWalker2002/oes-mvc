$(document).ready(function () {
    $('form').on('submit', function (event) {
        event.preventDefault();
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
});

function submit_login() {
    $('#loading').css('display', 'inline');
    var url = 'index.php?action=submit_login';
    var data = {
        username: $('#username').val(),
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#field_username').css('display', 'none');
            $('#note-username').css('display', 'none');
            $('#field_password').removeClass('hidden');
            $('#note-password').css('display', 'inline');
            $('#hi-text').text('' + json_data.name + '');
            $('#btn-login')
                .html('Tiếp Tục')
                .css('width', '100%')
                .attr('onclick', 'submit_password()');
            $('#btn-fotgot').css('display', 'none');
            $('#reload').css('display', 'inline');
        }
        $('#loading').css('display', 'none');
    };

    $.post(url, data, success);
}

function reload() {
    $('#reload').css('display', 'none');
    $('#field_username').css('display', 'flex');
    $('#note-username').css('display', 'inline');
    $('#field_password').addClass('hidden');
    $('#note-password').css('display', 'none');
    $('#btn-login')
        .html('Tiếp Tục')
        .css('width', '100%')
        .attr('onclick', 'submit_login()');
    $('#btn-fotgot').css('display', 'inline');
}

function submit_password() {
    $('#loading').css('display', 'inline');
    var url = 'index.php?action=submit_password';
    var data = {
        password: $('#password').val(),
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            setTimeout(function () {
                location.reload('index.php');
            }, 1500);
        }
        $('#loading').css('display', 'none');
    };
    $.post(url, data, success);
}

function submit_forgot_password() {
    $('#loading').css('display', 'inline');
    var url = 'index.php?action=submit_forgot_password';
    var data = {
        username: $('#username').val(),
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#loading').css('display', 'none');
    };
    $.post(url, data, success);
}

function show_status(json_data) {
    if (json_data.status) {
        $('#message').addClass('success');
        $('#message').removeClass('failed');
    } else {
        $('#message').addClass('failed');
        $('#message').removeClass('success');
    }
    $('#message').html(json_data.status_value);
    $('#message').animate(
        {
            height: '50px',
            'line-height': '50px',
            opacity: '1',
        },
        500
    );
    $('#message').delay(1000).animate(
        {
            opacity: '0',
            height: '0',
            'line-height': '0px',
        },
        500
    );
}
