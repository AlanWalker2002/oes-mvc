$(function () {
    $('#table_teachers').DataTable().destroy();

    get_list_teachers();

    $('#add_teacher_form').on('submit', function () {
        submit_add_teacher($('#add_teacher_form').serializeArray());
        $('#add_teacher_form')[0].reset();
    });

    $('#add_teacher_via_file').on('submit', function () {
        submit_add_teacher_via_file();
        $('#add_teacher_via_file')[0].reset();
        $('#loader').addClass('hidden');
    });

    $('#select_all').on('change', function () {
        if (this.checked) {
            $('.checkbox').each(function () {
                this.checked = true;
            });
            $('#select_action').removeClass('hidden');
        } else {
            $('.checkbox').each(function () {
                this.checked = false;
            });
            $('#select_action').addClass('hidden');
        }
    });

    $('table').on('click', 'a.modal-trigger', function () {
        select_gender();
    });
});

function check_box() {
    $('#select_action').removeClass('hidden');
    if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('#select_all').prop('checked', true);
    } else {
        $('#select_all').prop('checked', false);
    }
    if ($('.checkbox:checked').length == 0) {
        $('#select_action').addClass('hidden');
    }
}

function delete_select_teacher_check() {
    var _list_check = '';
    $('.checkbox:checked').each(function () {
        _list_check += this.value + ',';
    });
    data = {
        list_check: _list_check,
    };
    var url = 'index.php?action=delete_check_teachers';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#table_teachers').DataTable().destroy();
        get_list_teachers();
        $('#select_all').prop('checked', false);
        $('#select_action').addClass('hidden');
        toastr.success('Xóa chọn lọc thành công', 'Success');
    };
    $.post(url, data, success);
}

function get_list_teachers() {
    var url = 'index.php?action=get_list_teachers';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_list_teachers(json_data);
        select_gender();
    };
    $.get(url, success);
}

function show_list_teachers(data) {
    var list = $('#list_teachers');
    list.empty();
    $stt = 1;
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="fadeIn" id="teacher-' + data[i].id + '"></tr>');
        tr.append(
            '<td class=""><p><label><input type="checkbox" name="checkbox_students" class="checkbox form-check-input" onchange="check_box();" value="' +
                data[i].id +
                '" /><span></span></label></p></td>'
        );
        tr.append('<td class="">' + $stt++ + '</td>');
        tr.append(
            '<td class=""><img src="public/img/avatar/' +
                data[i].avatar +
                '" alt="avatar" class="avatar me-2 rounded-circle" width="50px" height="50px" /></td>'
        );
        tr.append('<td class="">' + data[i].name + '</td>');
        tr.append('<td class="">' + data[i].username + '</td>');
        tr.append('<td class="">' + data[i].email + '</td>');
        tr.append('<td class="">' + data[i].gender_detail + '</td>');
        if (data[i].birthday == '' || data[i].birthday == '0000-00-00')
            data[i].birthday = 'Chưa Xác Định';
        tr.append('<td class="">' + data[i].birthday + '</td>');
        if (
            data[i].last_login == '' ||
            data[i].last_login == '0000-00-00 00:00:00'
        )
            data[i].last_login = 'Chưa Đăng Nhập';
        tr.append('<td class="">' + data[i].last_login + '</td>');
        tr.append(
            '<td class="">' +
                teacher_edit_button(data[i]) +
                teacher_del_button(data[i]) +
                '</td>'
        );
        list.append(tr);
    }

    $('#table_teachers').DataTable({
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
            { bSortable: false, aTargets: [0, 2, 9] }, //hide sort icon on header of column 0, 2, 9
        ],
        aaSorting: [[1, 'asc']], // start to sort data in second column
    });
    $('form').on('submit', function (event) {
        event.preventDefault();
    });
}

function teacher_edit_button(data) {
    return (btn =
        '<a class="action-icon modal-trigger" data-bs-toggle="modal" data-bs-target="#edit-' +
        data.id +
        '"><i class="mdi mdi-square-edit-outline"></i></a>' +
        '<div id="edit-' +
        data.id +
        '" class="modal fade" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">' +
        '<form action="" method="POST" role="form" id="form_edit_teacher_' +
        data.id +
        '">' +
        '<input type="hidden" value="' +
        data.id +
        '" name="id"/>' +
        '<input type="hidden" value="' +
        data.username +
        '" name="username" />' +
        '<div class="modal-dialog">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<h4 class="modal-title" id="standard-modalLabel"> Cập nhật: ' +
        data.name +
        '</h4>' +
        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<div class="row">' +
        '<div class="col-lg-6">' +
        '<div class="mb-3">' +
        '<label class="form-label" for="name">Tên</label>' +
        '<input type="text" value="' +
        data.name +
        '" name="name" class="form-control" required>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label" for="password">Mật khẩu</label>' +
        '<input type="password" name="password" class="form-control" required>' +
        '</div>' +
        '</div>' +
        '<div class="col-lg-6">' +
        '<div class="mb-3">' +
        '<label class="form-label" for="gender_id">Giới tính</label>' +
        '<select name="gender_id" class="form-control">' +
        '</select>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label" for="birthday">Ngày Sinh</label>' +
        '<input type="date" value="' +
        data.birthday +
        '" name="birthday" class="form-control">' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở lại</button>' +
        '<button type="submit" class="btn btn-secondary" onclick="submit_edit_teacher(' +
        data.id +
        ')">Đồng Ý</button>' +
        '</div>' +
        '</div></div></form></div>');
}

function teacher_del_button(data) {
    return (btn =
        '<a class="action-icon" data-bs-toggle="modal" data-bs-target="#del-' +
        data.id +
        '"><i class="mdi mdi-delete"></i></a>' +
        '<div id="del-' +
        data.id +
        '" class="modal fade" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">' +
        '<div class="modal-dialog">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<h4 class="modal-title" id="standard-modalLabel">Cảnh báo</h4>' +
        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<div class="row">' +
        '<div class="col-lg-12">' +
        '<p>Xác nhận xóa tài khoản ' +
        data.username +
        '</p>' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<form action="" method="POST" role="form" id="form_del_teacher_' +
        data.id +
        '">' +
        '<input type="hidden" value="' +
        data.id +
        '" name="id"/>' +
        '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở lại</button>' +
        '<button type="submit" class="btn btn-secondary" onclick="submit_del_teacher(' +
        data.id +
        ')">Đồng ý</button>' +
        '</form>' +
        '</div>' +
        '</div>' +
        '</div></div></div>');
}

function submit_add_teacher(data) {
    var url = 'index.php?action=check_add_teacher';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_teachers').DataTable().destroy();
            get_list_teachers();

            $('#add_normal').modal('hide');
            toastr.success('Thêm thành công', 'Success');
        }
    };
    $.post(url, data, success);
}

function submit_add_teacher_via_file() {
    var file_data = $('#input-file-now').prop('files')[0];
    var type = file_data.type;
    var size = file_data.size;
    var match = [
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-excel',
    ];
    if (type == match[0] || type == match[1]) {
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: 'index.php?action=check_add_teacher_via_file',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (result) {
                var json_data = $.parseJSON(result);
                show_status(json_data);
                $('#table_teachers').DataTable().destroy();
                get_list_teachers();
                $('#_add_via_file').modal('hide');
                toastr.success('Thêm thành công', 'Success');
            },
        });
    } else {
        toastr.errpr(
            'Sai định dạng mẫu, yêu cầu file excel đuôi .xlsx theo mẫu. Nếu file lỗi vui lòng tải lại mẫu và điền lại.',
            'Error'
        );
    }
}

function submit_del_teacher(data) {
    data = $('#form_del_teacher_' + data).serializeArray();
    var url = 'index.php?action=check_del_teacher';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_teachers').DataTable().destroy();
            get_list_teachers();
        }

        $('#del-' + json_data.id).modal('hide');
        toastr.success('Xóa thành công', 'Success');
    };
    $.post(url, data, success);
}

function submit_edit_teacher(data) {
    form = $('#form_edit_teacher_' + data);
    data = $('#form_edit_teacher_' + data).serializeArray();
    var url = 'index.php?action=check_edit_teacher';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_teachers').DataTable().destroy();
            get_list_teachers();
            form[0].reset();

            $('#edit-' + json_data.id).modal('hide');
            toastr.success('Cập nhật thành công', 'Success');
        }
    };
    $.post(url, data, success);
}
