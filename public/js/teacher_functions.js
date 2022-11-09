$(document).ready(function () {
    get_list_classes();

    get_class_detail(get_url_parameter('id'));

    $('form').on('submit', function (event) {
        event.preventDefault();
    });

    $('#btn-logout').on('click', function () {
        logout();
    });
});

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

function get_list_classes() {
    var url = 'index.php?action=get_list_classes_by_teacher';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_list_classes(json_data);
    };
    $.get(url, success);
}

function get_url_parameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}

function get_class_detail(id) {
    var url = 'index.php?action=get_class_detail';
    data = {
        id: id,
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        class_list_detail(json_data);
    };
    $.get(url, data, success);
}

function class_list_detail(data) {
    var list = $('#class_detail');

    $('#class_name_detail').text(data[0].class_name);

    $stt = 1;
    $.each(data, function (key, value) {
        var tr = $('<tr id="student-id-' + value.id + '"></tr>');
        tr.append('<td>' + $stt++ + '</td>');
        tr.append(
            '<td><img src="public/img/avatar/' +
                value.avatar +
                '"" alt="avatar" class="avatar me-2 rounded-circle" width="50px" height="50px" /></td>'
        );
        tr.append('<td>' + value.username + '</td>');
        tr.append('<td>' + value.name + '</td>');
        if (value.birthday == '' || value.birthday == '0000-00-00')
            value.birthday = 'Chưa Xác Định';
        tr.append('<td>' + value.birthday + '</td>');
        tr.append('<td>' + value.gender_detail + '</td>');
        if (value.last_login == '' || value.last_login == '0000-00-00 00:00:00')
            value.last_login = 'Chưa Đăng Nhập';
        tr.append('<td>' + value.last_login + '</td>');
        tr.append('<td>' + view_score_btn(value) + '</td>');
        list.append(tr);
    });

    $('#table_classes_detail').DataTable({
        language: {
            sLengthMenu:
                'Hiển thị <select class="form-select form-select-sm ms-1 me-1">' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="30">30</option>' +
                '<option value="40">40</option>' +
                '<option value="50">50</option>' +
                '<option value="-1">Tất cả</option>' +
                '</select> bản ghi',
            zeroRecords: 'Không tìm thấy',
            info: 'Hiển thị trang _PAGE_/_PAGES_',
            infoEmpty: 'Không có dữ liệu',
            emptyTable: 'Không có dữ liệu',
            infoFiltered: '(tìm kiếm trong tất cả _MAX_ mục)',
            sSearch: 'Tìm kiếm',
            paginate: {
                first: 'Đầu',
                last: 'Cuối',
                next: 'Sau',
                previous: 'Trước',
            },
        },
        aoColumnDefs: [
            { bSortable: false, aTargets: [7] }, //hide sort icon on header of column 7
        ],
    });
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

function show_list_classes(data) {
    var sidebar = $('#list_classes_sidebar');
    sidebar.empty();

    // var list = $('#list_classes');
    // list.empty();

    $.each(data, function (key, value) {
        // var tr = $(
        //     '<tr question="fadeIn" id="class-id-' + value.id + '"></tr>'
        // );
        // tr.append('<td>' + value.id + '</td>');
        // tr.append('<td>' + value.name + '</td>');
        // tr.append('<td>' + value.grade + '</td>');
        // tr.append('<td>' + view_btn(value.id) + '</td>');
        // list.append(tr);

        sidebar.append(
            '<li class="class-li">' +
                '<a href="index.php?action=show_class_detail&id=' +
                value.id +
                '">' +
                value.name +
                '</a>' +
                '</li>'
        );
    });
}

// function view_btn(data) {
//     return (
//         '<a href="index.php?action=show_class_detail&class_id=' +
//         data +
//         '" class="btn">Xem</a>'
//     );
// }

function view_score_btn(data) {
    return (btn =
        '<a class="action-icon modal-trigger" data-bs-toggle="modal" data-bs-target="#view_score-' +
        data.id +
        '" onclick="get_score(' +
        data.id +
        ')"><i class="mdi mdi-scoreboard"></i></a>' +
        '<div id="view_score-' +
        data.id +
        '" class="modal fade" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">' +
        '<div class="modal-dialog modal-lg">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<h4 class="modal-title" id="standard-modalLabel"> Chi tiết điểm học sinh: ' +
        data.name +
        '</h4>' +
        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<div class="row" id="_score-' +
        data.id +
        '">' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở lại</button>' +
        '</div>' +
        '</div></div></form></div>');
}

function get_score(id) {
    var url = 'index.php?action=get_score';
    var data = {
        student_id: id,
    };
    var success = function (result) {
        var json_data = $.parseJSON(result);
        var tbody = $('#_score-' + id);
        tbody.empty();
        if (json_data == '')
            var div = $(
                '<div class="col-lg-12">' +
                    '<div class="mb-3">' +
                    '<p style="font-size: 1.3em; font-weight: bold;"><i class="uil-n-a"></i> Hiện tại chưa có bài làm nào</p>' +
                    '</div>' +
                    '</div>'
            );
        tbody.append(div);

        $.each(json_data, function (key, value) {
            var div = $(
                '<div class="col-lg-12">' +
                    '<div class="mb-3">' +
                    '<p style="font-size: 1.3em; font-weight: bold;"><i class="uil uil-dna"></i> Đề Thi: ' +
                    value.test_code +
                    ' - Số điểm: ' +
                    value.score_number +
                    'điểm - ' +
                    'Hoàn thành lúc: ' +
                    value.completion_time +
                    '</p>' +
                    '</div>' +
                    '</div>'
            );
            tbody.append(div);
        });
    };
    $.post(url, data, success);
}
