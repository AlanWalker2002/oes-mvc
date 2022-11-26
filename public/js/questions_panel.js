$(function () {
    for (var i = 1; i <= 100; i++) {
        CKEDITOR.replace('editor-' + i);
    }

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
                    $('#add_normal').modal('hide');
                    toastr.success(json_data.status_value, 'Success');
                    setTimeout(function () {
                        location.reload();
                    }, 700);
                }
            },
        });
    });

    $('#add_question_via_file').on('submit', function () {
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

    select_grade();
    select_subject();
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
        $('#select_all').prop('checked', false);
        $('#select_action').addClass('hidden');
        toastr.success(json_data.status_value, 'Success');
    };
    $.post(url, data, success);
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
                $('#_add_via_file').modal('hide');
                toastr.success(json_data.status_value, 'Success');
                setTimeout(function () {
                    location.reload();
                }, 700);
            },
        });
    } else {
        toastr.errpr(
            'Sai định dạng mẫu, yêu cầu file excel đuôi .xlsx theo mẫu. Nếu file lỗi vui lòng tải lại mẫu và điền lại.',
            'Error'
        );
    }
}

function submit_edit_question(data) {
    form = $('#form_edit_question_' + data);
    data = $('#form_edit_question_' + data).serializeArray();

    var url = 'index.php?action=check_edit_question';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            form[0].reset();
            $('#edit-' + json_data.id).modal('hide');
            toastr.success('Cập nhật thành công', 'Success');
            setTimeout(function () {
                location.reload();
            }, 700);
        }
    };
    $.post(url, data, success);
}

function submit_del_question(data) {
    data = $('#form_del_question_' + data).serializeArray();

    var url = 'index.php?action=check_del_question';
    var success = function (result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);

        $('#del-' + json_data.id).modal('hide');
        toastr.success(json_data.status_value, 'Success');
        setTimeout(function () {
            location.reload();
        }, 700);
    };
    $.post(url, data, success);
}
