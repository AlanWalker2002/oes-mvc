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

				<li class="side-nav-title side-nav-item">Thông tin</li>

				<li class="side-nav-item">
					<a href="#" class="side-nav-link">
						<i class="mdi mdi-book-education-outline"></i>
						<span> Mã Đề: <?= $test[0]->test_code ?> </span>
					</a>
				</li>

				<li class="side-nav-item">
					<a href="#" class="side-nav-link">
						<i class="mdi mdi-progress-question"></i>
						<span> <?= $test[0]->total_questions ?> Câu Hỏi </span>
					</a>
				</li>
				<li class="side-nav-item">
					<a href="#" class="side-nav-link">
						<i class="mdi mdi-timer"></i>
						<span> <?= $test[0]->time_to_do ?> Phút </span>
					</a>
				</li>

				<li class="side-nav-title side-nav-item">Danh sách câu hỏi</li>

				<?php
				for ($i = 0; $i < count($test); $i++) {
				?>
					<li class="side-nav-item">
						<?php
						if ($test[$i]->student_answer != "") {
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
								<span class="tick" id="tick-<?= ($i + 1) ?>" style="position: relative; right: -30px;"></span>
							</a>
						<?php } ?>
					</li>
				<?php
				}
				?>

				<li class="side-nav-title side-nav-item">Tính năng</li>

				<li class="side-nav-item">
					<a href="#nop-bai" class="side-nav-link">
						<i class="mdi mdi-atom-variant"></i>
						<span> Nộp bài </span>
					</a>
				</li>

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
						<a class="nav-link end-bar-toggle" href="javascript: void(0);">
							<i class="dripicons-gear noti-icon"></i>
						</a>
					</li>

					<li class="dropdown notification-list">
						<a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
							<span class="account-user-avatar">
								<img src="public/img/avatar/<?= $test[0]->avatar ?>" alt="user-image" class="rounded-circle">
							</span>
							<span>
								<span class="account-user-name"><?= $test[0]->student_name ?></span>
								<span class="account-position"><?= $test[0]->class_name ?></span>
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
							<!-- item-->
							<div class=" dropdown-header noti-title">
								<h5 class="text-overflow m-0"><i class="mdi mdi-folder-lock me-1"></i> Đang thi tạm khóa chức năng</h5>
							</div>
						</div>
					</li>

				</ul>
				<button class="button-menu-mobile open-left">
					<i class="mdi mdi-menu"></i>
				</button>

				<div id="time">
					<div class="circle" style="--clr:#ff2972">
						<div class="dots hr_dot"></div>
						<svg>
							<circle cx="30" cy="30" r="20"></circle>
							<circle cx="30" cy="30" r="20" id="hh"></circle>
						</svg>
						<div id="hours">00</div>
					</div>
					<div class="circle" style="--clr:#fee800">
						<div class="dots min_dot"></div>
						<svg>
							<circle cx="30" cy="30" r="20"></circle>
							<circle cx="30" cy="30" r="20" id="mm"></circle>
						</svg>
						<div id="minutes">00</div>
					</div>
					<div class="circle" style="--clr:#04fc43">
						<div class="dots sec_dot"></div>
						<svg>
							<circle cx="30" cy="30" r="20"></circle>
							<circle cx="30" cy="30" r="20" id="ss"></circle>
						</svg>
						<div id="seconds">00</div>
					</div>
				</div>
			</div>
			<!-- end Topbar -->

			<!-- Start Content-->
			<div class="container-fluid">

				<!-- start page title -->
				<div class="row">
					<div class="wrapper mt-4">
						<?php
						for ($i = 0; $i < count($test); $i++) {
						?>
							<div class="accordion" id="accordion-<?= ($i + 1) ?>">
								<div class="col-md-12" id="quest-<?= ($i + 1) ?>">
									<div class="card">
										<div class="card-header flex-full">
											<h5>Câu <?= ($i + 1) ?></h5>
											<a href="#" class="custom-accordion-title d-block pt-2 pb-2 arrow-id-<?= ($i + 1) ?>" onclick="changeIcon(<?= $i + 1 ?>)">
												<i class="mdi mdi-arrow-up-drop-circle fs-18"></i>
											</a>
										</div>
										<div id="slide-<?= ($i + 1) ?>">
											<div class="card-body">
												<h5 class="card-title">
													<?= $test[$i]->question_content ?>
												</h5>
												<div class="quest-content flex">
													<div class="mt-2 me-5 fs-16">
														<div class="form-check flex">
															<?php
															if (trim($test[$i]->student_answer) == trim($test[$i]->answer_a)) {
																echo '<input class="form-check-input me-1" name="' . $test[$i]->question_id . '" data-idquest="' . $test[$i]->question_id . '" type="radio" data-stt="' . ($i + 1) . '" value="' . strip_tags(explode('.', $test[$i]->answer_a)[0]) . '" checked />';
															} else {
																echo '<input class="form-check-input me-1" name="' . $test[$i]->question_id . '" data-idquest="' . $test[$i]->question_id . '" type="radio" data-stt="' . ($i + 1) . '" value="' . strip_tags(explode('.', $test[$i]->answer_a)[0]) . '" />';
															}
															?>

															<label class="form-check-label flex" for="customRadio1">
																<?= $test[$i]->answer_qa ?>
															</label>
														</div>
														<div class="form-check flex">
															<?php
															if (trim($test[$i]->student_answer) == trim($test[$i]->answer_c)) {
																echo '<input class="form-check-input me-1" name="' . $test[$i]->question_id . '" data-idquest="' . $test[$i]->question_id . '" type="radio" data-stt="' . ($i + 1) . '" value="' . strip_tags(explode('.', $test[$i]->answer_c)[0]) . '" checked />';
															} else {
																echo '<input class="form-check-input me-1" name="' . $test[$i]->question_id . '" data-idquest="' . $test[$i]->question_id . '" type="radio" data-stt="' . ($i + 1) . '" value="' . strip_tags(explode('.', $test[$i]->answer_c)[0]) . '" />';
															}
															?>


															<label class="form-check-label flex" for="customRadio2">
																<?= $test[$i]->answer_qc ?>
															</label>
														</div>
													</div>

													<div class="mt-2 fs-16">
														<div class="form-check flex">
															<?php
															if (trim($test[$i]->student_answer) == trim($test[$i]->answer_b)) {
																echo '<input class="form-check-input me-1" name="' . $test[$i]->question_id . '" data-idquest="' . $test[$i]->question_id . '" type="radio" data-stt="' . ($i + 1) . '" value="' . strip_tags(explode('.', $test[$i]->answer_b)[0]) . '" checked />';
															} else {
																echo '<input class="form-check-input me-1" name="' . $test[$i]->question_id . '" data-idquest="' . $test[$i]->question_id . '" type="radio" data-stt="' . ($i + 1) . '" value="' . strip_tags(explode('.', $test[$i]->answer_b)[0]) . '" />';
															}
															?>

															<label class="form-check-label flex" for="customRadio1">
																<?= $test[$i]->answer_qb ?>
															</label>
														</div>
														<div class="form-check flex">
															<?php
															if (trim($test[$i]->student_answer) == trim($test[$i]->answer_d)) {
																echo '<input class="form-check-input me-1" name="' . $test[$i]->question_id . '" data-idquest="' . $test[$i]->question_id . '" type="radio" data-stt="' . ($i + 1) . '" value="' . strip_tags(explode('.', $test[$i]->answer_d)[0]) . '" checked />';
															} else {
																echo '<input class="form-check-input me-1" name="' . $test[$i]->question_id . '" data-idquest="' . $test[$i]->question_id . '" type="radio" data-stt="' . ($i + 1) . '" value="' . strip_tags(explode('.', $test[$i]->answer_d)[0]) . '" />';
															}
															?>

															<label class="form-check-label flex" for="customRadio2">
																<?= $test[$i]->answer_qd ?>
															</label>
														</div>
													</div>
												</div>
											</div> <!-- end card-body-->
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

						<div class="col-md-12 flex flex-end mb-4" id="nop-bai">
							<a href="index.php?action=accept_test" onclick="return confirm('Bạn có chắc chắn nộp bài thi?')" class="btn btn-primary">Nộp bài thi</a>
						</div>
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

<script>
	var min = <?= $min ?>;
	var sec = <?= $sec ?>;

	countdown();

	$('input[type=radio]').on("change", function() {
		var stt = $(this).data("stt");
		var idquest = $(this).data("idquest");
		var value = $(this).val();
		var data = {
			id: idquest,
			answer: value,
			min: min,
			sec: sec
		}
		var url = "index.php?action=update_answer";
		var success = function(result) {
			$('#tick-' + stt).html('<i class="mdi mdi-check-circle"></i>');
		};
		$.post(url, data, success);
	})

	function countdown() {
		var cdID = setInterval(function() {
			if (sec == 0) {
				min--;
				sec = 60;
			}
			sec--;
			if (min < 8) {
				min_text = 0 + min;
				$('#minutes').css('color', 'red');
				$('#seconds').css('color', 'red');
			} else {
				min_text = min;
			}
			if (sec < 10)
				sec_text = 0 + sec;
			else
				sec_text = sec;

			$('#minutes').text(min_text);
			$('#seconds').text(sec_text);

			// $('#hh').css('strokeDashoffset', (125 - (125 * hour_text) / 12));
			$('#mm').css('strokeDashoffset', (125 - (125 * min_text) / 60));
			$('#ss').css('strokeDashoffset', (125 - (125 * sec_text) / 60));

			// $('#hr_dot').css('transform', `rotate(${min_text * 30}deg)`);
			$('.min_dot').css('transform', `rotate(${min_text * 6}deg)`);
			$('.sec_dot').css('transform', `rotate(${sec_text * 6}deg)`);

			if (min < 0) {
				clearInterval(cdID);
				alert('Hết giờ, hệ thống sẽ tự động nộp bài!');
				window.location.replace("index.php?action=accept_test");
			}
		}, 1000);
	}

	window.onbeforeunload = function() {
		var url = "index.php?action=update_timing"
		var data = {
			min: min,
			sec: sec
		}
		var success = function() {

		};
		$.post(url, data, success);
	}
</script>