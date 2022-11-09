$(function () {
    $('#table_classes').DataTable().destroy();

    get_list_classes();

    $('#add_class_form').on('submit', function () {
        submit_add_class($('#add_class_form').serializeArray());
        $('#add_class_form')[0].reset();
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
        select_grade();
        select_teacher();
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

function delete_select_class_check() {
    var _list_check = '';
    $('.checkbox:checked').each(function () {
        _list_check += this.value + ',';
    });
    data = {
        list_check: _list_check,
    };

    var url = 'index.php?action=delete_check_classes';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#table_classes').DataTable().destroy();
        get_list_classes();
        $('#select_all').prop('checked', false);
        $('#select_action').addClass('hidden');
    };
    $.post(url, data, success);
}

function get_list_classes() {
    var url = 'index.php?action=get_list_classes';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_list_classes(json_data);
        select_teacher();
        select_grade();
    };
    $.get(url, success);
}

function show_list_classes(data) {
    var list = $('#list_classes');
    list.empty();
    $stt = 1;
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="fadeIn" id="class-' + data[i].id + '"></tr>');
        tr.append(
            '<td class=""><p><label><input type="checkbox" name="checkbox_students" class="checkbox form-check-input" onchange="check_box();" value="' +
                data[i].id +
                '" /><span></span></label></p></td>'
        );
        tr.append('<td class="">' + $stt++ + '</td>');
        tr.append('<td class="">' + data[i].class_name + '</td>');
        tr.append('<td class="">' + data[i].grade_detail + '</td>');
        tr.append('<td class="">' + data[i].teacher_name + '</td>');
        tr.append(
            '<td class="">' +
                class_del_button(data[i]) +
                class_edit_button(data[i]) +
                '</td>'
        );
        list.append(tr);
    }
    $('#table_classes').DataTable({
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
            { bSortable: false, aTargets: [0] }, //hide sort icon on header of column 0, 2, 9
        ],
        aaSorting: [[1, 'asc']], // start to sort data in second column
    });
    $('form').on('submit', function (event) {
        event.preventDefault();
    });
}

function class_edit_button(data) {
    return (btn =
        '<a class="action-icon" data-bs-toggle="modal" data-bs-target="#edit-' +
        data.id +
        '"><i class="mdi mdi-square-edit-outline"></i></a>' +
        '<div id="edit-' +
        data.id +
        '" class="modal fade" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">' +
        '<form action="" method="POST" role="form" id="form_edit_class_' +
        data.id +
        '">' +
        '<input type="hidden" value="' +
        data.id +
        '" name="id"/>' +
        '<div class="modal-dialog">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<h4 class="modal-title" id="standard-modalLabel"> Cập nhật: ' +
        data.class_name +
        '</h4>' +
        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<div class="row">' +
        '<div class="col-lg-12">' +
        '<div class="mb-3">' +
        '<label class="form-label" for="name">Tên</label>' +
        '<input type="text" value="' +
        data.class_name +
        '" name="name" class="form-control" readonly>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label" for="grade_id">Khối</label>' +
        '<select name="grade_id" class="form-control">' +
        '</select>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label" for="teacher_id">Giáo viên</label>' +
        '<select name="teacher_id" class="form-control">' +
        '</select>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở lại</button>' +
        '<button type="submit" class="btn btn-secondary" onclick="submit_edit_class(' +
        data.id +
        ')">Đồng Ý</button>' +
        '</div>' +
        '</div></div></form></div>');
}

function class_del_button(data) {
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
        '<p>Xác nhận xóa ' +
        data.class_name +
        '</p>' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<form action="" method="POST" role="form" id="form_del_class_' +
        data.id +
        '">' +
        '<input type="hidden" value="' +
        data.id +
        '" name="id"/>' +
        '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở lại</button>' +
        '<button type="submit" class="btn btn-secondary" onclick="submit_del_class(' +
        data.id +
        ')">Đồng ý</button>' +
        '</form>' +
        '</div>' +
        '</div>' +
        '</div></div></div>');
}

function submit_add_class(data) {
    var url = 'index.php?action=check_add_class';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_classes').DataTable().destroy();
            get_list_classes();
            $('#add_normal').modal('hide');
            toastr.success(json_data.status_value, 'Success');
        }
    };
    $.post(url, data, success);
}

function submit_del_class(data) {
    data = $('#form_del_class_' + data).serializeArray();
    var url = 'index.php?action=check_del_class';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_classes').DataTable().destroy();
            get_list_classes();
        }

        $('#del-' + json_data.id).modal('hide');
        toastr.success(json_data.status_value, 'Success');
    };
    $.post(url, data, success);
}

function submit_edit_class(data) {
    form = $('#form_edit_class_' + data);
    data = $('#form_edit_class_' + data).serializeArray();
    var url = 'index.php?action=check_edit_class';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_classes').DataTable().destroy();
            get_list_classes();
            form[0].reset();

            $('#edit-' + json_data.id).modal('hide');
            toastr.success(json_data.status_value, 'Success');
        }
    };
    $.post(url, data, success);
}
