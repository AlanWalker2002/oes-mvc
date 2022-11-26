<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">
    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="public/img/logo.png" alt="" height="16" />
        </span>
        <span class="logo-sm">
            <img src="public/img/logo_sm.png" alt="" height="16" />
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="public/img/logo-dark.png" alt="" height="16" />
        </span>
        <span class="logo-sm">
            <img src="public/img/logo_sm_dark.png" alt="" height="16" />
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">
        <!--- Sidemenu -->
        <ul class="side-nav" id="side-nav">
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <span>Navigation</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="index.php?action=show_dashboard" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <!-- <span class="badge bg-success float-end">4</span> -->
                    <span> Trang tổng quan </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <span>Manages</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="index.php?action=show_admins_panel" class="side-nav-link">
                    <i class="mdi mdi-account-tie"></i>
                    <span> Quản lý Admin </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="index.php?action=show_teachers_panel" class="side-nav-link">
                    <i class="mdi mdi-account-star"></i>
                    <span> Quản lý Giáo viên </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="index.php?action=show_grades_panel" class="side-nav-link">
                    <i class="uil-servers"></i>
                    <span> Quản lý Khối </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="index.php?action=show_classes_panel" class="side-nav-link">
                    <i class="uil-diary"></i>
                    <span> Quản lý Lớp </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="index.php?action=show_students_panel" class="side-nav-link">
                    <i class="mdi mdi-account"></i>
                    <span> Quản lý Học Sinh </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="index.php?action=show_subjects_panel" class="side-nav-link">
                    <i class="uil-subject"></i>
                    <span> Quản lý Môn </span>
                </a>
            </li>

            <li class="side-nav-item menuitem-active">
                <a href="index.php?action=show_questions_panel" class="side-nav-link active">
                    <i class="uil-question-circle"></i>
                    <span> Quản lý Câu Hỏi </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="index.php?action=show_tests_panel" class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span> Quản lý Đề Thi </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <span>Contact</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link maintained">
                    <i class="uil-bell"></i>
                    <span> Thông Báo </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link maintained">
                    <i class="uil-user-square"></i>
                    <span> Liên hệ </span>
                </a>
            </li>
        </ul>

        <!-- Help Box -->
        <div class="help-box text-white text-center">
            <a href="javascript: void(0);" class="float-end close-btn text-white">
                <i class="mdi mdi-close"></i>
            </a>
            <img src="public/img/help-icon.svg" height="90" alt="Helper Icon Image" />
            <h5 class="mt-3">Truy cập vô hạn</h5>
            <p class="mb-3">
                Báo cáo chi tiết đề và các câu hỏi thông qua biểu đồ.
            </p>
            <a href="javascript: void(0);" class="btn btn-outline-light btn-sm">Nâng cấp</a>
        </div>
        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="index.php?action=show_dashboard">
                                        <i class="uil-home-alt"></i>
                                        Trang tổng quan</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Quản lý Câu hỏi
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-4 flex">
                                    <a class="btn btn-primary mb-2 me-1" data-bs-toggle="modal" style="cursor: pointer" data-bs-target="#add_normal"><i class="mdi mdi-plus-circle me-1"></i>
                                        Thêm mới</a>
                                    <div class="action hidden" id="select_action">
                                        <a class="btn btn-danger mb-2" onclick="delete_select_question_check()"><i class="mdi mdi-delete me-1"></i>Xóa chọn lọc
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="text-sm-end">
                                        <a class="btn btn-success mb-2 me-1" data-bs-toggle="modal" style="cursor: pointer" data-bs-target="#_add_via_file">
                                            <i class="mdi mdi-file-excel"></i>
                                            Import
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="add_normal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                <form action="" method="post" role="form">
                                    <div class="modal-dialog modal-full-width">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">
                                                    Thêm Câu Hỏi
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="editor-1">Nội Dung Câu
                                                                Hỏi</label>
                                                            <textarea id="editor-1" name="question_content"></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="editor-3">Đáp Án A</label>
                                                            <textarea name="answer_a" id="editor-3"></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="editor-5">Đáp Án C</label>
                                                            <textarea name="answer_c" id="editor-5"></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="grade_id">Khối</label>
                                                            <select name="grade_id" id="grade_id" class="form-control"></select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="unit">Chương</label>
                                                            <input type="number" name="unit" id="unit" min="1" class="form-control" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="editor-2">Chi Tiết Đáp
                                                                Án</label>
                                                            <textarea name="explanation" id="editor-2"></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="editor-4">Đáp Án B</label>
                                                            <textarea name="answer_b" id="editor-4"></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="editor-6">Đáp Án D</label>
                                                            <textarea name="answer_d" id="editor-6"></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="subject_id">Môn</label>
                                                            <select name="subject_id" id="subject_id" class="form-control"></select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="correct_answer">Đáp án
                                                                đúng</label>
                                                            <select name="correct_answer" id="correct_answer" class="form-control">
                                                                <option selected disabled value="">
                                                                    Chọn đáp án
                                                                </option>
                                                                <option value="A">
                                                                    A
                                                                </option>
                                                                <option value="B">
                                                                    B
                                                                </option>
                                                                <option value="C">
                                                                    C
                                                                </option>
                                                                <option value="D">
                                                                    D
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                    Trở lại
                                                </button>
                                                <button type="submit" class="btn btn-primary" id="add_question" name="add-question">
                                                    Thêm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="_add_via_file" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                <form id="add_question_via_file" enctype="multipart/form-data">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">
                                                    Thêm bằng file
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <span class="title">Tải File Mẫu:
                                                                <a href="public/files/mau-them-danh-sach-cau-hoi.xlsx">TẠI ĐÂY</a></span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <span class="title">Lưu Ý: <br />1,
                                                                Không sửa file
                                                                mẫu tránh gây
                                                                lỗi khi nhập dữ
                                                                liệu.</span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <span class="title">2, Tài khoản và
                                                                email của mỗi
                                                                tài khoản là duy
                                                                nhất, không thể
                                                                trùng
                                                                nhau.</span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <span class="title">3, Ngày sinh
                                                                phải đúng định
                                                                đạnh Y-m-d, ví
                                                                dụ:
                                                                2008-10-29.</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="grade_id">Khối</label>
                                                            <select name="grade_id" class="form-control" id="_question_add_grade_id"></select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="subject_id ">Môn</label>
                                                            <select name="subject_id" class="form-control" id="_question_add_subject_id"></select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <input type="file" id="input-file-now" class="dropify file_data" data-default-file="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                    Trở lại
                                                </button>
                                                <button type="submit" class="btn btn-primary" name="submit">
                                                    Thêm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-striped dt-responsive nowrap w-100" id="table_questions">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="select_all" />
                                                    <label class="form-check-label" for="select_all">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>ID</th>
                                            <th>Câu Hỏi</th>
                                            <th>Thông Tin</th>
                                            <th>Đáp Án</th>
                                            <th>Đáp Án Đúng</th>
                                            <th style="width: 75px">
                                                Hành Động
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $cke = 7;
                                        foreach ($questions as $question) {
                                        ?>
                                            <tr class="fadeIn" id="question-<?= $question->id ?>">
                                                <td class="">
                                                    <p>
                                                        <label>
                                                            <input type="checkbox" name="checkbox_students" class="checkbox form-check-input" onchange="check_box();" value="<?= $question->id ?>" />
                                                        </label>
                                                    </p>
                                                </td>
                                                <td><?= $i++ ?></td>
                                                <td><?= $question->question_content ?></td>
                                                <td class="">
                                                    Môn <?= $question->subject_detail ?> <br /> Chương <?= $question->unit ?> <br /> <?= $question->grade_detail ?>
                                                </td>
                                                <td class="">
                                                    <?= $question->answer_a ?> <br /> <?= $question->answer_b ?> <br /> <?= $question->answer_c ?> <br /> <?= $question->answer_d ?>
                                                </td>
                                                <td class="">
                                                    <?= $question->correct_answer ?>
                                                </td>
                                                <td class="">
                                                    <a class="action-icon modal-trigger" data-bs-toggle="modal" data-bs-target="#edit-<?= $question->id ?>"><i class="mdi mdi-square-edit-outline"></i></a>
                                                    <a class="action-icon" data-bs-toggle="modal" data-bs-target="#del-<?= $question->id ?>"><i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>

                                            <div id="edit-<?= $question->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                                <form action="" method="post" role="form" id="form_edit_question_<?= $question->id ?>">
                                                    <div class="modal-dialog modal-full-width">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4>Cập nhật câu hỏi: <?= $question->question_content ?></h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <input type="hidden" name="id" value="<?= $question->id ?>">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="editor-<?= $cke++ ?>">Nội Dung Câu
                                                                                Hỏi</label>
                                                                            <textarea id="editor-<?= $cke++ ?>" name="question_content"><?= $question->question_content ?></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="editor-<?= $cke++ ?>">Đáp Án A</label>
                                                                            <textarea name="answer_a" id="editor-<?= $cke++ ?>"><?= $question->answer_a ?></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="editor-<?= $cke++ ?>">Đáp Án C</label>
                                                                            <textarea name="answer_c" id="editor-<?= $cke++ ?>"><?= $question->answer_c ?></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="grade_id">Khối</label>
                                                                            <select name="grade_id" id="grade_id" class="form-control"></select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="unit">Chương</label>
                                                                            <input type="number" name="unit" id="unit" min="1" class="form-control" required value="<?= $question->unit ?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="editor-<?= $cke++ ?>">Chi Tiết Đáp
                                                                                Án</label>
                                                                            <textarea name="explanation" id="editor-<?= $cke++ ?>"><?= $question->correct_answer ?></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="editor-<?= $cke++ ?>">Đáp Án B</label>
                                                                            <textarea name="answer_b" id="editor-<?= $cke++ ?>"><?= $question->answer_b ?></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="editor-<?= $cke++ ?>">Đáp Án D</label>
                                                                            <textarea name="answer_d" id="editor-<?= $cke++ ?>"><?= $question->answer_d ?></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="subject_id">Môn</label>
                                                                            <select name="subject_id" id="subject_id" class="form-control"></select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="correct_answer">Đáp án
                                                                                đúng</label>
                                                                            <select name="correct_answer" id="correct_answer" class="form-control">
                                                                                <option selected disabled value="">
                                                                                    Chọn đáp án
                                                                                </option>
                                                                                <option value="A">
                                                                                    A
                                                                                </option>
                                                                                <option value="B">
                                                                                    B
                                                                                </option>
                                                                                <option value="C">
                                                                                    C
                                                                                </option>
                                                                                <option value="D">
                                                                                    D
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở lại</button>
                                                                <button type="submit" class="btn btn-secondary" onclick="submit_edit_question(<?= $question->id ?>)">Đồng Ý</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div id="del-<?= $question->id ?>" class="modal fade" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="standard-modalLabel">Cảnh báo</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    Xác nhận xóa câu hỏi
                                                                    <?= $question->id ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="" method="POST" role="form" id="form_del_question_<?= $question->id ?>">
                                                                <input type="hidden" value="<?= $question->id ?>" name="id" />
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở lại</button>
                                                                <button type="submit" class="btn btn-secondary" onclick="submit_del_question(<?= $question->id ?>)">Đồng ý</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end card-body-->
                    </div>
                    <!-- end card-->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container -->
    </div>
    <!-- content -->
</div>

<script src="public/js/questions_panel.js"></script>