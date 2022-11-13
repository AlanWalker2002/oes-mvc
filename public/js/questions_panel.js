$(function () {
    $('#table_questions').DataTable().destroy();

    get_list_questions();

    $('#add_question').on('click', function () {
        var question_content = CKEDITOR.instances['editor-1'].getData();
        var explanation = CKEDITOR.instances['editor-2'].getData();
        var answer_a = CKEDITOR.instances['editor-3'].getData();
        var answer_b = CKEDITOR.instances['editor-4'].getData();
        var answer_c = CKEDITOR.instances['editor-5'].getData();
        var answer_d = CKEDITOR.instances['editor-6'].getData();
        var correct_answer = $('#correct_answer').val();
        var grade_id = $('#grade_id').val();
        var subject_id = $('#subject_id').val();
        var unit = $('#unit').val();

        $.ajax({
            type: 'POST',
            url: 'index.php?action=check_add_question',
            data: {
                question_content: question_content,
                explanation: explanation,
                answer_a: answer_a,
                answer_b: answer_b,
                answer_c: answer_c,
                answer_d: answer_d,
                correct_answer: correct_answer,
                grade_id: grade_id,
                subject_id: subject_id,
                unit: unit,
            },
            success: function (result) {
                var json_data = $.parseJSON(result);
                show_status(json_data);
                if (json_data.status) {
                    $('#table_questions').DataTable().destroy();
                    get_list_questions();

                    $('#add_normal').modal('hide');
                    toastr.success(json_data.status_value, 'Success');
                }
            },
        });
    });

    $('#add_question_via_file').on('submit', function () {
        $('#preload').removeClass('hidden');
        submit_add_question_via_file();
        $('#add_question_via_file')[0].reset();
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
        select_subject();
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

function delete_select_question_check() {
    var _list_check = '';
    $('.checkbox:checked').each(function () {
        _list_check += this.value + ',';
    });
    data = {
        list_check: _list_check,
    };
    var url = 'index.php?action=delete_check_questions';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        $('#table_questions').DataTable().destroy();
        get_list_questions();
        $('#select_all').prop('checked', false);
        $('#select_action').addClass('hidden');
        toastr.success(json_data.status_value, 'Success');
    };
    $.post(url, data, success);
}

function get_list_questions() {
    var url = 'index.php?action=get_list_questions';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_list_questions(json_data);
        select_grade();
        select_subject();
    };
    $.get(url, success);
}

function show_list_questions(data) {
    var list = $('#list_questions');
    list.empty();
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="fadeIn" id="question-' + data[i].id + '"></tr>');
        tr.append(
            '<td class=""><p><label><input type="checkbox" name="checkbox_students" class="checkbox form-check-input" onchange="check_box();" value="' +
                data[i].id +
                '" /><span></span></label></p></td>'
        );
        tr.append('<td class="">' + data[i].id + '</td>');
        tr.append('<td class="">' + data[i].question_content + '</td>');
        tr.append(
            '<td class="">Môn ' +
                data[i].subject_detail +
                '<br />Chương ' +
                data[i].unit +
                ' ' +
                data[i].grade_detail +
                '</td>'
        );
        tr.append(
            '<td class="">' +
                data[i].answer_a +
                '<br />' +
                data[i].answer_b +
                '<br />' +
                data[i].answer_c +
                '<br />' +
                data[i].answer_d +
                '</td>'
        );
        tr.append('<td class="">' + data[i].correct_answer + '</td>');
        tr.append(
            '<td class="">' +
                question_edit_button(data[i]) +
                question_del_button(data[i]) +
                '</td>'
        );
        list.append(tr);
    }

    $('#table_questions').DataTable({
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
            { bSortable: false, aTargets: [0] }, //hide sort icon on header of column 0, 10
        ],
        aaSorting: [[1, 'asc']], // start to sort data in second column
    });
    $('form').on('submit', function (event) {
        event.preventDefault();
    });
}

function question_edit_button(data) {
    return (btn =
        '<a class="action-icon modal-trigger" data-bs-toggle="modal" data-bs-target="#edit-' +
        data.id +
        '"><i class="mdi mdi-square-edit-outline"></i></a>' +
        '<div id="edit-' +
        data.id +
        '" class="modal fade" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">' +
        '<form action="" method="POST" role="form" id="form_edit_question_' +
        data.id +
        '">' +
        '<input type="hidden" value="' +
        data.id +
        '" name="id"/>' +
        '<div class="modal-dialog modal-full-width">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<h4 class="modal-title" id="standard-modalLabel"> Cập nhật: ' +
        data.question_content +
        '</h4>' +
        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<div class="row">' +
        '<div class="col-lg-6">' +
        '<div class="mb-3">' +
        '<label class="form-label" for="editor-1">Nội Dung Câu Hỏi</label>' +
        '<textarea name="question_content" class="form-control">' +
        data.question_content +
        '</textarea>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label" for="answer_a">Đáp Án A</label>' +
        '<textarea name="answer_a" class="form-control">' +
        data.answer_a +
        '</textarea>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label" for="answer_c">Đáp Án C</label>' +
        '<textarea name="answer_c" class="form-control">' +
        data.answer_c +
        '</textarea>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label" for="grade_id">Khối</label>' +
        '<select name="grade_id" class="form-control">' +
        '</select>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label" for="unit">Chương</label>' +
        '<input type="number" name="unit" value="' +
        data.unit +
        '" class="form-control">' +
        '</input>' +
        '</div>' +
        '</div>' +
        '<div class="col-lg-6">' +
        '<div class="mb-3">' +
        '<label class="form-label" for="correct_answer">Nội Dung Câu Hỏi</label>' +
        '<textarea name="correct_answer" class="form-control">' +
        data.correct_answer +
        '</textarea>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label" for="answer_b">Đáp Án B</label>' +
        '<textarea name="answer_b" class="form-control">' +
        data.answer_b +
        '</textarea>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label" for="answer_d">Đáp Án D</label>' +
        '<textarea name="answer_d" class="form-control">' +
        data.answer_d +
        '</textarea>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label" for="subject_id">Môn</label>' +
        '<select name="subject_id" class="form-control">' +
        '</select>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở lại</button>' +
        '<button type="submit" class="btn btn-secondary" onclick="submit_edit_question(' +
        data.id +
        ')">Đồng Ý</button>' +
        '</div>' +
        '</div></div></form></div>');
}

function question_del_button(data) {
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
        '<p>Xác nhận xóa câu hỏi ' +
        data.question_content +
        '</p>' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<form action="" method="POST" role="form" id="form_del_question_' +
        data.id +
        '">' +
        '<input type="hidden" value="' +
        data.id +
        '" name="id"/>' +
        '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở lại</button>' +
        '<button type="submit" class="btn btn-secondary" onclick="submit_del_question(' +
        data.id +
        ')">Đồng ý</button>' +
        '</form>' +
        '</div>' +
        '</div>' +
        '</div></div></div>');
}

function submit_add_question_via_file() {
    var file_data = $('#input-file-now').prop('files')[0];
    var grade = $('#_question_add_grade_id').val();
    var subject = $('#_question_add_subject_id').val();
    var type = file_data.type;
    var size = file_data.size;
    var match = [
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-excel',
    ];
    if (type == match[0] || type == match[1]) {
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('grade_id', grade);
        form_data.append('subject_id', subject);
        $.ajax({
            url: 'index.php?action=check_add_question_via_file',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (result) {
                var json_data = $.parseJSON(result);
                show_status(json_data);
                $('#table_questions').DataTable().destroy();
                get_list_questions();
                $('#_add_via_file').modal('hide');
                toastr.success(json_data.status_value, 'Success');
            },
        });
    } else {
        toastr.errpr(
            'Sai định dạng mẫu, yêu cầu file excel đuôi .xlsx theo mẫu. Nếu file lỗi vui lòng tải lại mẫu và điền lại.',
            'Error'
        );
    }
}

function submit_del_question(data) {
    data = $('#form_del_question_' + data).serializeArray();
    var url = 'index.php?action=check_del_question';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_questions').DataTable().destroy();
            get_list_questions();
        }

        $('#del-' + json_data.id).modal('hide');
        toastr.success(json_data.status_value, 'Success');
    };
    $.post(url, data, success);
}

function submit_edit_question(data) {
    form = $('#form_edit_question_' + data);
    data = $('#form_edit_question_' + data).serializeArray();

    var url = 'index.php?action=check_edit_question';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#table_questions').DataTable().destroy();
            get_list_questions();
            form[0].reset();

            $('#edit-' + json_data.id).modal('hide');
            toastr.success('Cập nhật thành công', 'Success');
        }
    };
    $.post(url, data, success);
}
