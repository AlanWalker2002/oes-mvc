<!-- NAVBAR START -->
<nav class="navbar navbar-expand-lg py-lg-3 navbar-dark" style="background: #816DEE;">
    <div class="container">

        <!-- logo -->
        <a href="index.html" class="navbar-brand me-lg-5">
            <img src="public/img/logo.png" alt="" class="logo-dark" height="18">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>

        <!-- menus -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <!-- left menu -->
            <ul class="navbar-nav me-auto align-items-center">
                <li class="nav-item mx-lg-1">
                    <a class="nav-link" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item mx-lg-1">
                    <a class="nav-link active" href="index.php?action=list_test">Danh sách đề</a>
                </li>
                <li class="nav-item mx-lg-1">
                    <a class="nav-link" href="">Trò chuyện</a>
                </li>
                <li class="nav-item mx-lg-1">
                    <a class="nav-link" href="">Xem thông báo</a>
                </li>
                <li class="nav-item mx-lg-1">
                    <a class="nav-link" href="">Liên hệ</a>
                </li>
            </ul>

            <!-- right menu -->
            <div class="dropdown btn-group">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-spin mdi-star me-2"></i> <?php echo $info['name'] ?>
                </button>
                <div class="dropdown-menu dropdown-menu-animated">
                    <!-- <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a> -->
                    <a class="dropdown-item notify-item" data-bs-toggle="modal" id="logout" style="cursor: pointer;" data-bs-target="#logoutModal"><i class="mdi mdi-logout me-1"></i> Đăng xuất</a>
                </div>
            </div>

        </div>
    </div>
</nav>
<!-- NAVBAR END -->

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 mb-2">
                <div class="card ribbon-box">
                    <select name="subject_id" id="subject_id" class="form-control" onchange="filter_test()">
                        <option value="" disabled selected>-- Chọn Môn --</option>
                        <?php
                        for ($i = 0; $i < count($subjects); $i++) {
                        ?>
                            <option value="<?php echo $subjects[$i]->id ?>"><?php echo $subjects[$i]->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-2 mb-2">
                <div class="card ribbon-box">
                    <select name="grade_id" id="grade_id" class="form-control" onchange="filter_test()">
                        <option value="" disabled selected>-- Chọn Khối --</option>
                        <?php
                        for ($i = 0; $i < count($grades); $i++) {
                        ?>
                            <option value="<?php echo $grades[$i]->id ?>"><?php echo $grades[$i]->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-2 mb-2">
                <div class="card ribbon-box">
                    <select name="status_id" id="status_id" class="form-control" onchange="filter_test()">
                        <option value="" disabled selected>-- Chọn Trạng Thái --</option>
                        <?php
                        for ($i = 0; $i < count($statuses); $i++) {
                        ?>
                            <option value="<?php echo $statuses[$i]->id ?>"><?php echo $statuses[$i]->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            for ($i = 0; $i < count($tests); $i++) {
            ?>
                <div class="col-lg-4 mb-1">
                    <div class="card ribbon-box">
                        <div class="card-body">
                            <div class="ribbon ribbon-<?php if ($tests[$i]->status_id == 1) {
                                                            echo 'success';
                                                        } else if ($tests[$i]->status_id == 2) {
                                                            echo 'secondary';
                                                        } ?>
                            float-end"><i class="mdi mdi-access-point me-1"></i> <?= $tests[$i]->status ?></div>
                            <h5 class="float-start mt-0"><?= $tests[$i]->test_name ?></h5>
                            <div class="ribbon-content">
                                <div class="flex mb-2">
                                    <p>
                                        Mã đề: <?= $tests[$i]->test_code ?>
                                    </p>
                                </div>
                                <div class="flex mb-2">
                                    <p>
                                        <i class="uil uil-bag"></i> <?= $tests[$i]->subject_detail ?>
                                    </p>
                                    <p class="me-1 ms-1">-</p>
                                    <p>
                                        <i class="uil-presentation"></i> <?= $tests[$i]->grade ?>
                                    </p>
                                    <p class="me-1 ms-1">-</p>
                                    <p>
                                        <i class="uil uil-clock-eight"></i> <?= $tests[$i]->time_to_do ?> phút
                                    </p>
                                </div>
                                <div class="flex flex-between">
                                    <p>
                                        <i class="mdi mdi-calendar"></i> 02/08/2022
                                    </p>
                                    <p class="simp-custom">
                                        <i class="uil uil-question-circle"></i> <?= $tests[$i]->total_questions ?> câu
                                    </p>
                                    <?php
                                    if ($tests[$i]->status_id != 2) {
                                        $flag = false;
                                        for ($j = 0; $j < count($scores); $j++) {
                                            if ($tests[$i]->test_code == $scores[$j]->test_code) {
                                                $flag = true;
                                                break;
                                            }
                                        }
                                        if ($flag)
                                            echo '<p><a href="index.php?action=show_result&test_code=' . $tests[$i]->test_code . '" class="btn btn-success">Chi Tiết Bài Làm</a></p>';
                                        else {
                                    ?>
                                            <a class="btn btn-primary" data-bs-toggle="modal" id="do_test" style="cursor: pointer;" data-bs-target="#do-test-<?= $tests[$i]->test_code ?>">Làm Bài</a>
                                            <div id="do-test-<?= $tests[$i]->test_code ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form class="form_test" action="" method="POST" role="form" id="form_submit_test_<?= $tests[$i]->test_code ?>">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="standard-modalLabel">Nhập mật khẩu đề: <?= $tests[$i]->test_code ?></h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3 relative">
                                                                            <input type="hidden" value="<?= $tests[$i]->test_code ?>" name="test_code" id="test_code">
                                                                            <label class="form-label" for="password">Mật khẩu</label>
                                                                            <input type="password" name="password" id="password" class="form-control" required>
                                                                            <div id="eye">
                                                                                <i class="mdi mdi-eye"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Không</button>
                                                                <button type="submit" class="btn btn-primary">Có</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    } else {
                                        $flag_2 = false;
                                        for ($j = 0; $j < count($scores); $j++) {
                                            if ($tests[$i]->test_code == $scores[$j]->test_code) {
                                                $flag_2 = true;
                                                break;
                                            }
                                        }
                                        if ($flag_2)
                                            echo '<a href="index.php?action=show_result&test_code=' . $tests[$i]->test_code . '" class="btn full-width">Chi Tiết Bài Làm</a>';
                                        else
                                            echo '<button class="btn btn-light" disabled>Tạm thời chưa mở</button>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php
            $test_count = count($get_all_test);
            $limit = 2;
            $current_page = 1;
            if (isset($_GET['page'])) {
                $current_page = $_GET['page'];
            }
            $next_page = ($current_page - 1) * $limit;
            $number_of_pages = ceil($test_count / $limit);
            ?>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-1">
                <nav>
                    <ul class="pagination pagination-rounded mb-0 justify-center">
                        <?php
                        if ($current_page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="index.php?action=list_test&page=' . ($current_page - 1) . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                        }

                        for ($i = 1; $i <= $number_of_pages; $i++) {
                            echo '<li class="page-item"><a class="page-link" href="index.php?action=list_test&page=' . $i . '">' . $i . '</a></li>';
                        }

                        if ($i > $current_page) {
                            echo '<li class="page-item"><a class="page-link" href="index.php?action=list_test&page=' . ($current_page + 1) . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>