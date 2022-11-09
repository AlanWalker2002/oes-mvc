$(function () {
    get_list_subjects();

    $('#add_subject_form').on('submit', function () {
        submit_add_subject($('#add_subject_form').serializeArray());
        $('#add_subject_form')[0].reset();
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

function delete_select_subject_check() {
    var _list_check = '';
    $('.checkbox:checked').each(function () {
        _list_check += this.value + ',';
    });
    data = {
        list_check: _list_check,
    };

    var url = 'index.php?action=delete_check_subjects';
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

function get_list_subjects() {
    var url = 'index.php?action=get_list_subjects';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_list_subjects(json_data);
    };
    $.get(url, success);
}

function show_list_subjects(data) {
    var list = $('#list_subjects');
    list.empty();
    $stt = 1;
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="" id="subject-' + data[i].id + '"></tr>');
        tr.append(
            '<td class=""><p><label><input type="checkbox" name="checkbox_students" class="checkbox form-check-input" onchange="check_box();" value="' +
                data[i].id +
                '" /><span></span></label></p></td>'
        );
        tr.append('<td class="">' + $stt++ + '</td>');
        tr.append('<td class="">' + data[i].name + '</td>');
        tr.append(
            '<td class="">' +
                subject_edit_button(data[i]) +
                subject_del_button(data[i]) +
                '</td>'
        );
        list.append(tr);
    }

    $('#table_subjects').DataTable({
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
        aaSorting: [[1, 'asc']],
    });
    $('form').on('submit', function (event) {
        event.preventDefault();
    });
}

function subject_edit_button(data) {
    return (btn =
        '<a class="action-icon" data-bs-toggle="modal" data-bs-target="#edit-' +
        data.id +
        '"><i class="mdi mdi-square-edit-outline"></i></a>' +
        '<div id="edit-' +
        data.id +
        '" class="modal fade" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">' +
        '<form action="" method="POST" role="form" id="form_edit_subject_' +
        data.id +
        '">' +
        '<input type="hidden" value="' +
        data.id +
        '" name="id"/>' +
        '<input type="hidden" value="' +
        data.name +
        '" name="name" />' +
        '<div class="modal-dialog">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<h4 class="modal-title" id="standard-modalLabel"> Cập nhật môn: ' +
        data.name +
        '</h4>' +
        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<div class="row">' +
        '<div class="col-lg-12">' +
        '<div class="mb-3">' +
        '<label class="form-label" for="name">Tên Môn</label>' +
        '<input type="text" value="' +
        data.name +
        '" name="name" class="form-control" required>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở lại</button>' +
        '<button type="submit" class="btn btn-secondary" onclick="submit_edit_subject(' +
        data.id +
        ')">Đồng Ý</button>' +
        '</div>' +
        '</div></div></form></div>');
}

function subject_del_button(data) {
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
        '<p>Xác nhận xóa môn ' +
        data.name +
        '</p>' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<form action="" method="POST" role="form" id="form_del_subject_' +
        data.id +
        '">' +
        '<input type="hidden" value="' +
        data.id +
        '" name="id"/>' +
        '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở lại</button>' +
        '<button type="submit" class="btn btn-secondary" onclick="submit_del_subject(' +
        data.id +
        ')">Đồng ý</button>' +
        '</form>' +
        '</div>' +
        '</div>' +
        '</div></div></div>');
}

function submit_add_subject(data) {
    var url = 'index.php?action=check_add_subject';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_subjects').DataTable().destroy();
            get_list_subjects();

            $('#add_normal').modal('hide');
            toastr.success(json_data.status_value, 'Success');
        }
    };
    $.post(url, data, success);
}

function submit_del_subject(data) {
    data = $('#form_del_subject_' + data).serializeArray();
    var url = 'index.php?action=check_del_subject';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_subjects').DataTable().destroy();
            get_list_subjects();
        }

        $('#del-' + json_data.id).modal('hide');
        toastr.success(json_data.status_value, 'Success');
    };
    $.post(url, data, success);
}

function submit_edit_subject(data) {
    form = $('#form_edit_subject_' + data);
    data = $('#form_edit_subject_' + data).serializeArray();
    var url = 'index.php?action=check_edit_subject';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_subjects').DataTable().destroy();
            get_list_subjects();
            form[0].reset();
            $('#edit-' + json_data.id).modal('hide');
            toastr.success(json_data.status_value, 'Success');
        }
    };
    $.post(url, data, success);
}
