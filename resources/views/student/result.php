<!-- Begin page -->
<div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">

        <!-- LOGO -->
        <a href="index.html" class="logo text-center logo-light">
            <span class="logo-lg">
                <img src="public/img/logo.png" alt="" height="16">
            </span>
            <span class="logo-sm">
                <img src="public/img/logo_sm.png" alt="" height="16">
            </span>
        </a>

        <!-- LOGO -->
        <a href="index.html" class="logo text-center logo-dark">
            <span class="logo-lg">
                <img src="public/img/logo-dark.png" alt="" height="16">
            </span>
            <span class="logo-sm">
                <img src="public/img/logo_sm_dark.png" alt="" height="16">
            </span>
        </a>

        <div class="h-100" id="leftside-menu-container" data-simplebar="">

            <!--- Sidemenu -->
            <ul class="side-nav">

                <li class="side-nav-title side-nav-item">Kết quả</li>

                <li class="side-nav-item">
                    <a href="#" class="side-nav-link">
                        <i class="mdi mdi-book-education-outline"></i>
                        <span> Mã Đề: <?= $result[0]->test_code ?> </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="#" class="side-nav-link">
                        <i class="mdi mdi-scoreboard"></i>
                        <span> Số điểm: <?= $score->score_number ?> điểm</span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="#" class="side-nav-link">
                        <i class="mdi mdi-bookmark-check"></i>
                        <span> Đúng <?= $score->score_detail ?> Câu</span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="#" class="side-nav-link">
                        <i class="mdi mdi-bolnisi-cross"></i>
                        <span> Hoàn Thành Lúc:
                            <pre class="ms-4"><?= $score->completion_time ?></pre>
                        </span>
                    </a>
                </li>

                <li class="side-nav-title side-nav-item">Chi tiết bài thi</li>

                <?php
                for ($i = 0; $i < count($result); $i++) {
                ?>
                    <li class="side-nav-item">
                        <?php
                        if ($result[$i]->student_answer == $result[$i]->correct_answer) {
                        ?>
                            <a href="#quest-<?= ($i + 1) ?>" class="side-nav-link">
                                <i class="mdi mdi-format-list-checkbox"></i>
                                <span> Câu <?= ($i + 1) ?> </span>
                                <span class="tick" id="tick-<?= ($i + 1) ?>" style="position: relative; right: -30px;"><i class="mdi mdi-check-circle"></i></span>
                            </a>
                        <?php } else { ?>
                            <a href="#quest-<?= ($i + 1) ?>" class="side-nav-link">
                                <i class="mdi mdi-format-list-checkbox"></i>
                                <span> Câu <?= ($i + 1) ?> </span>
                                <span class="tick" id="tick-<?= ($i + 1) ?>" style="position: relative; right: -30px;"><i class="mdi mdi-xamarin"></i></span>
                            </a>
                        <?php } ?>
                    </li>
                <?php
                }
                ?>
            </ul>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topbar-menu float-end mb-0">
                    <li class="notification-list">
                        <a class="nav-link end-bar-toggle" href="index.php">
                            <i class="dripicons-home noti-icon"></i>
                        </a>
                    </li>

                    <li class="notification-list">
                        <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                            <i class="dripicons-gear noti-icon"></i>
                        </a>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="public/img/avatar/<?= $result[0]->avatar ?>" alt="user-image" class="rounded-circle">
                            </span>
                            <span>
                                <span class="account-user-name"><?= $result[0]->student_name ?></span>
                                <span class="account-position"><?= $result[0]->class_name ?></span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                            <!-- item-->
                            <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="uil-notes font-16 me-1"></i>
                                <span>Analytics Report</span>
                            </a> -->

                            <!-- item-->
                            <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="uil-life-ring font-16 me-1"></i>
                                <span>How can I help you?</span>
                            </a> -->

                            <a class="dropdown-item notify-item" data-bs-toggle="modal" id="logout" style="cursor: pointer;" data-bs-target="#logoutModal">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="button-menu-mobile open-left">
                    <i class="mdi mdi-menu"></i>
                </button>
            </div>
            <!-- end Topbar -->

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="wrapper mt-4">
                        <?php
                        for ($i = 0; $i < count($result); $i++) {
                        ?>
                            <div class="col-md-12" id="quest-<?= ($i + 1) ?>">
                                <div class="accordion" id="accordion-<?= ($i + 1) ?>">
                                    <div class="card">
                                        <div class="card-header flex-full">
                                            <h5>Câu <?= ($i + 1) ?></h5>
                                            <a class="custom-accordion-title flex pt-2 pb-2 arrow-id-<?= ($i + 1) ?>" data-bs-toggle="collapse" onclick="changeIcon(<?= $i + 1 ?>)" href="#collapse-<?= $i + 1 ?>" aria-expanded="true" aria-controls="collapse-<?= $i + 1 ?>">
                                                <h5 class="me-2">Lời giải chi tiết</h5>
                                                <i class="mdi mdi-arrow-up-drop-circle fs-18"></i>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?= $result[$i]->question_content ?>
                                            </h5>
                                            <div class="quest-content flex">
                                                <div class="mt-2 me-5">
                                                    <div class="form-check flex">
                                                        <?php
                                                        if (trim($result[$i]->student_answer) == trim($result[$i]->answer_a) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer)) {
                                                        ?>
                                                            <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />

                                                            <label class="form-check-label flex text-green" for="customRadio1">
                                                                <i class="mdi mdi-alpha-a-circle me-2 fs-24"></i>
                                                                <?= $result[$i]->answer_a ?>
                                                            </label>
                                                        <?php } else { ?>
                                                            <?php
                                                            if (trim($result[$i]->student_answer) == trim($result[$i]->answer_a) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer)) {
                                                            ?>
                                                                <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />

                                                                <label class="form-check-label flex text-red" for="customRadio1">
                                                                    <i class="mdi mdi-alpha-a-circle me-2 fs-24"></i>
                                                                    <?= $result[$i]->answer_a ?>
                                                                </label>
                                                            <?php } else { ?>
                                                                <?php if (trim($result[$i]->answer_a) == trim($result[$i]->correct_answer)) { ?>
                                                                    <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />
                                                                    <label class="form-check-label flex text-green" for="customRadio1">
                                                                        <i class="mdi mdi-alpha-a-circle me-2 fs-24"></i>
                                                                        <?= $result[$i]->answer_a ?>
                                                                    </label>
                                                                <?php } else { ?>
                                                                    <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" disabled />
                                                                    <label class="form-check-label flex" for="customRadio1">
                                                                        <i class="mdi mdi-alpha-a-circle me-2 fs-24"></i>
                                                                        <?= $result[$i]->answer_a ?>
                                                                    </label>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-check flex">
                                                        <?php
                                                        if (trim($result[$i]->student_answer) == trim($result[$i]->answer_c) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer)) {
                                                        ?>
                                                            <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />

                                                            <label class="form-check-label flex text-green" for="customRadio1">
                                                                <i class="mdi mdi-alpha-c-circle me-2 fs-24"></i>
                                                                <?= $result[$i]->answer_c ?>
                                                            </label>
                                                        <?php } else { ?>
                                                            <?php
                                                            if (trim($result[$i]->student_answer) == trim($result[$i]->answer_c) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer)) {
                                                            ?>
                                                                <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />

                                                                <label class="form-check-label flex text-red" for="customRadio1">
                                                                    <i class="mdi mdi-alpha-c-circle me-2 fs-24"></i>
                                                                    <?= $result[$i]->answer_c ?>
                                                                </label>
                                                            <?php } else { ?>
                                                                <?php if (trim($result[$i]->answer_c) == trim($result[$i]->correct_answer)) { ?>
                                                                    <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />
                                                                    <label class="form-check-label flex text-green" for="customRadio1">
                                                                        <i class="mdi mdi-alpha-c-circle me-2 fs-24"></i>
                                                                        <?= $result[$i]->answer_c ?>
                                                                    </label>
                                                                <?php } else { ?>
                                                                    <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" disabled />
                                                                    <label class="form-check-label flex" for="customRadio1">
                                                                        <i class="mdi mdi-alpha-c-circle me-2 fs-24"></i>
                                                                        <?= $result[$i]->answer_c ?>
                                                                    </label>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <div class="mt-2">
                                                    <div class="form-check flex">
                                                        <?php
                                                        if (trim($result[$i]->student_answer) == trim($result[$i]->answer_b) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer)) {
                                                        ?>
                                                            <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />

                                                            <label class="form-check-label flex text-green" for="customRadio1">
                                                                <i class="mdi mdi-alpha-b-circle me-2 fs-24"></i>
                                                                <?= $result[$i]->answer_b ?>
                                                            </label>
                                                        <?php } else { ?>
                                                            <?php
                                                            if (trim($result[$i]->student_answer) == trim($result[$i]->answer_b) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer)) {
                                                            ?>
                                                                <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />

                                                                <label class="form-check-label flex text-red" for="customRadio1">
                                                                    <i class="mdi mdi-alpha-b-circle me-2 fs-24"></i>
                                                                    <?= $result[$i]->answer_b ?>
                                                                </label>
                                                            <?php } else { ?>
                                                                <?php if (trim($result[$i]->answer_b) == trim($result[$i]->correct_answer)) { ?>
                                                                    <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />
                                                                    <label class="form-check-label flex text-green" for="customRadio1">
                                                                        <i class="mdi mdi-alpha-b-circle me-2 fs-24"></i>
                                                                        <?= $result[$i]->answer_b ?>
                                                                    </label>
                                                                <?php } else { ?>
                                                                    <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" disabled />
                                                                    <label class="form-check-label flex" for="customRadio1">
                                                                        <i class="mdi mdi-alpha-b-circle me-2 fs-24"></i>
                                                                        <?= $result[$i]->answer_b ?>
                                                                    </label>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-check flex">
                                                        <?php
                                                        if (trim($result[$i]->student_answer) == trim($result[$i]->answer_d) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer)) {
                                                        ?>
                                                            <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />

                                                            <label class="form-check-label flex text-green" for="customRadio1">
                                                                <i class="mdi mdi-alpha-d-circle me-2 fs-24"></i>
                                                                <?= $result[$i]->answer_d ?>
                                                            </label>
                                                        <?php } else { ?>
                                                            <?php
                                                            if (trim($result[$i]->student_answer) == trim($result[$i]->answer_d) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer)) {
                                                            ?>
                                                                <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />

                                                                <label class="form-check-label flex text-red" for="customRadio1">
                                                                    <i class="mdi mdi-alpha-d-circle me-2 fs-24"></i>
                                                                    <?= $result[$i]->answer_d ?>
                                                                </label>
                                                            <?php } else { ?>
                                                                <?php if (trim($result[$i]->answer_d) == trim($result[$i]->correct_answer)) { ?>
                                                                    <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" checked disabled />
                                                                    <label class="form-check-label flex text-green" for="customRadio1">
                                                                        <i class="mdi mdi-alpha-d-circle me-2 fs-24"></i>
                                                                        <?= $result[$i]->answer_d ?>
                                                                    </label>
                                                                <?php } else { ?>
                                                                    <input class="form-check-input me-1" name="<?= $result[$i]->question_id ?>" type="radio" disabled />
                                                                    <label class="form-check-label flex" for="customRadio1">
                                                                        <i class="mdi mdi-alpha-d-circle me-2 fs-24"></i>
                                                                        <?= $result[$i]->answer_d ?>
                                                                    </label>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card-body-->
                                        <div id="collapse-<?= $i + 1 ?>" class="collapse" aria-labelledby="heading-<?= $i + 1 ?>" data-bs-parent="#accordion-<?= ($i + 1) ?>">
                                            <div class="card-footer">
                                                a
                                            </div>
                                        </div>
                                    </div> <!-- end card-->
                                </div>
                            </div>

                            <script>
                                $('a[href="#quest-<?= $i + 1 ?>"]')
                                    // Remove links that don't actually link to anything
                                    .not('[href="#"]')
                                    .not('[href="#0"]')
                                    .click(function(event) {
                                        // On-page links
                                        if (
                                            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                                            location.hostname == this.hostname
                                        ) {
                                            // Figure out element to scroll to
                                            var target = $(this.hash);
                                            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                                            // Does a scroll target exist?
                                            if (target.length) {
                                                // Only prevent default if animation is actually gonna happen
                                                event.preventDefault();
                                                $('html, body').animate({
                                                    scrollTop: target.offset().top - 90
                                                }, 1000, function() {
                                                    // Callback after animation
                                                    // Must change focus!
                                                    var $target = $(target);
                                                    $target.focus();
                                                    if ($target.is(":focus")) { // Checking if the target was focused
                                                        return false;
                                                    } else {
                                                        $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                                        $target.focus(); // Set focus again
                                                    };
                                                });
                                            }
                                        }
                                    });
                            </script>
                        <?php } ?>
                    </div>
                </div>
                <!-- end page title -->

            </div> <!-- container -->

        </div> <!-- content -->
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->