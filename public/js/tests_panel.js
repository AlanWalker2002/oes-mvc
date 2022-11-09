$(function () {
    get_list_tests();
    select_grade();
    select_subject();
    list_unit();

    $('#add_test_form').on('submit', function () {
        submit_add_test($('#add_test_form').serializeArray());
        $('#add_test_form')[0].reset();
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

function get_list_tests() {
    var url = 'index.php?action=get_list_tests';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_list_tests(json_data);
    };
    $.get(url, success);
}

function show_list_tests(data) {
    var list = $('#list_tests');
    list.empty();
    $stt = 1;
    for (var i = 0; i < data.length; i++) {
        if (data[i].status_id == 1) {
            $color = 'success';
        } else if (data[i].status_id == 2) {
            $color = 'danger';
        } else {
            $color = 'warning';
        }

        var tr = $('<tr class="" id="test-' + data[i].test_code + '"></tr>');
        tr.append('<td class="">' + $stt++ + '</td>');
        tr.append('<td class="">' + data[i].test_name + '</td>');
        tr.append('<td class="">' + data[i].test_code + '</td>');
        tr.append('<td class="">' + data[i].subject_detail + '</td>');
        tr.append('<td class="">' + data[i].grade_detail + '</td>');
        tr.append(
            '<td class="">' +
                data[i].total_questions +
                ' câu hỏi, thời gian ' +
                data[i].time_to_do +
                ' phút <br />Ghi chú: ' +
                data[i].note +
                '</td>'
        );
        tr.append(
            '<td class="">' +
                '<span class="badge bg-' +
                $color +
                '">' +
                data[i].status_detail +
                '</span>' +
                '</td>'
        );
        tr.append(
            '<td class="">' +
                toggle_status_button(data[i]) +
                test_detail_button(data[i]) +
                test_score_button(data[i]) +
                '</td>'
        );
        list.append(tr);
    }
    $('#table_tests').DataTable({
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
        aaSorting: [[1, 'asc']],
    });
    $('form').on('submit', function (event) {
        event.preventDefault();
    });
}

function toggle_status_button(data) {
    return (btn =
        '<button class="btn btn-primary me-1" onclick="toggle_status(' +
        data.test_code +
        ', ' +
        data.status_id +
        ')">' +
        '<i class="mdi mdi-atom-variant"></i>' +
        ' ' +
        'Đóng / Mở' +
        '</button>');
}

function test_detail_button(data) {
    return (btn =
        '<a class="btn btn-info me-1" href="index.php?action=test_detail&test_code=' +
        data.test_code +
        '">' +
        '<i class="mdi mdi-card-bulleted"></i>' +
        ' ' +
        'Chi Tiết Đề' +
        '</a>');
}

function test_score_button(data) {
    return (btn =
        '<a class="btn btn-dark" href="index.php?action=test_score&test_code=' +
        data.test_code +
        '">' +
        '<i class="mdi mdi-eye"></i>' +
        ' ' +
        'Xem Điểm' +
        '</a>');
}

function submit_add_test(data) {
    var url = 'index.php?action=check_add_test';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_tests').DataTable().destroy();
            get_list_tests();

            $('#add_normal').modal('hide');
            toastr.success(json_data.status_value, 'Success');
        }
    };
    $.post(url, data, success);
}

function toggle_status(test_code, status_id) {
    if (status_id == 1)
        var data = {
            test_code: test_code,
            status_id: 2,
        };
    if (status_id == 2)
        var data = {
            test_code: test_code,
            status_id: 1,
        };
    var url = 'index.php?action=check_toggle_test_status';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_tests').DataTable().destroy();
            get_list_tests();
            toastr.success(json_data.status_value, 'Success');
        }
    };
    $.post(url, data, success);
}

function list_unit() {
    var grade_id = $('#grade_id').val();
    if (grade_id == null) grade_id = 1;
    var subject_id = $('#subject_id').val();
    if (subject_id == null) subject_id = 1;
    var data = {
        grade_id: grade_id,
        subject_id: subject_id,
    };
    var div = $('#list_unit');
    var url = 'index.php?action=get_list_units';
    var success = function (result) {
        div.empty();
        var json_data = $.parseJSON(result);
        if (json_data == '')
            div.append(
                '<span class="btn btn-warning text-white title form-control mb-3">Chưa có câu hỏi cho khối và môn đã chọn!</span>'
            );
        else {
            for (var i = 0; i < json_data.length; i++) {
                var ip =
                    '<div class="mb-3">' +
                    '<label class="form-label" for="' +
                    json_data[i].unit +
                    '">Chương ' +
                    json_data[i].unit +
                    ' (tổng số ' +
                    json_data[i].total +
                    ' câu)</label>' +
                    '<input class="unit form-control" type="number" id="' +
                    json_data[i].unit +
                    '" name="' +
                    json_data[i].unit +
                    '" onchange="update_total()" max="' +
                    json_data[i].total +
                    '" min="0">' +
                    '</div>';

                div.append(ip);
            }
        }
    };
    $.post(url, data, success);
}

function update_total() {
    var sum = 0;
    $('.unit').each(function () {
        if (parseInt(this.value) > parseInt(this.getAttribute('max'))) {
            toastr.warning(
                'Nhập quá số câu hỏi đang có, vui lòng kiểm tra lại',
                'Warning'
            );
            this.value = this.getAttribute('max');
            sum += parseInt(this.value);
        } else if (this.value != '') sum += parseInt(this.value);
    });
    $('#total_questions').val(sum);
}
