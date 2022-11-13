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

			<li class="side-nav-item menuitem-active">
				<a href="index.php?action=show_dashboard" class="side-nav-link active">
					<i class="uil-home-alt"></i>
					<span>Trang tổng quan</span>
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
					<span>Quản lý Admin</span>
				</a>
			</li>

			<li class="side-nav-item">
				<a href="index.php?action=show_teachers_panel" class="side-nav-link">
					<i class="mdi mdi-account-star"></i>
					<span>Quản lý Giáo Viên</span>
				</a>
			</li>

			<li class="side-nav-item">
				<a href="index.php?action=show_grades_panel" class="side-nav-link">
					<i class="uil-servers"></i>
					<span>Quản lý Khối</span>
				</a>
			</li>

			<li class="side-nav-item">
				<a href="index.php?action=show_classes_panel" class="side-nav-link">
					<i class="uil-diary"></i>
					<span>Quản lý Lớp</span>
				</a>
			</li>

			<li class="side-nav-item">
				<a href="index.php?action=show_students_panel" class="side-nav-link">
					<i class="mdi mdi-account"></i>
					<span>Quản lý Học Sinh</span>
				</a>
			</li>

			<li class="side-nav-item">
				<a href="index.php?action=show_subjects_panel" class="side-nav-link">
					<i class="uil-subject"></i>
					<span>Quản lý Môn</span>
				</a>
			</li>

			<li class="side-nav-item">
				<a href="index.php?action=show_questions_panel" class="side-nav-link">
					<i class="uil-question-circle"></i>
					<span>Quản lý Câu Hỏi</span>
				</a>
			</li>

			<li class="side-nav-item">
				<a href="index.php?action=show_tests_panel" class="side-nav-link">
					<i class="uil-clipboard-alt"></i>
					<span>Quản lý Đề Thi</span>
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

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

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
								<li class="breadcrumb-item active"><i class="uil-home-alt"></i> Trang tổng quan</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<?php
				for ($i = 0; $i < count($dashboard); $i++) {
				?>
					<div class="col-lg-6 col-xl-3">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-8">
										<h5 class="text-muted fw-normal mt-0 text-truncate"><?= $dashboard[$i]->name ?></h5>
										<h3 class="my-2 py-1 counter" data-target="<?= $dashboard[$i]->count ?>"><?= $dashboard[$i]->count ?></h3>
										<p class="mb-0 text-muted">
											<a href="index.php?action=<?= $dashboard[$i]->actionlink ?>" class="text-muted me-2">
												<i class="mdi mdi-numeric-<?= $i + 1 ?>-box-multiple"></i>
												Click!
											</a>
										</p>
									</div>
									<div class="col-4">
										<div class="text-center custom-panel">
											<!-- <div id="campaign-sent-chart" data-colors="#727cf5"></div> -->
											<i class="mdi <?= $dashboard[$i]->icon ?> fs-40"></i>
										</div>
									</div>
								</div> <!-- end row-->
							</div> <!-- end card-body -->
						</div> <!-- end card -->
					</div> <!-- end col -->
				<?php
				}
				?>
			</div>
			<!-- end row -->

			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="dropdown float-end">
								<a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-dots-vertical"></i>
								</a>
							</div>

							<h4 class="header-title mb-4">Tổng hợp học lực</h4>

							<div class="row text-center mt-2">
								<div class="col-md-6 flex">
									<label for="class_id" class="me-2">Lớp</label>
									<select name="class_id" id="class_id" class="form-control" onchange="list_check()"></select>
								</div>
								<div class="col-md-6 flex">
									<label for="test_code" class="me-2">Mã đề</label>
									<select name="test_code" id="test_code" class="form-control" onchange="list_check()"></select>
								</div>
							</div>

							<div class="row text-center mt-2">
								<div class="col-md-3">
									<i class="mdi mdi-alpha-t-box widget-icon rounded-circle bg-light-lighten text-muted"></i>
									<h3 class="fw-normal mt-3">
										<span id="good_student">0</span>
									</h3>
									<p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> Tốt</p>
								</div>
								<div class="col-md-3">
									<i class="mdi mdi-alpha-k-circle widget-icon rounded-circle bg-light-lighten text-muted"></i>
									<h3 class="fw-normal mt-3">
										<span id="rather_student">0</span>
									</h3>
									<p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Khá</p>
								</div>
								<div class="col-md-3">
									<i class="mdi mdi-alpha-m-box widget-icon rounded-circle bg-light-lighten text-muted"></i>
									<h3 class="fw-normal mt-3">
										<span id="medium_student">0</span>
									</h3>
									<p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Trung bình</p>
								</div>
								<div class="col-md-3">
									<i class="mdi mdi-alpha-l-circle widget-icon rounded-circle bg-light-lighten text-muted"></i>
									<h3 class="fw-normal mt-3">
										<span id="least_student">0</span>
									</h3>
									<p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Yếu</p>
								</div>
							</div>
						</div>
						<!-- end card body-->
					</div>
					<!-- end card -->
				</div>
				<!-- end col-->

				<div class="col-xl-4 col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="dropdown float-end">
								<a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-dots-vertical"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item">Settings</a>
									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item">Action</a>
								</div>
							</div>
							<h4 class="header-title mb-3">Top Performing</h4>

							<div class="table-responsive">
								<table class="table table-striped table-sm table-nowrap table-centered mb-0">
									<thead>
										<tr>
											<th>User</th>
											<th>Leads</th>
											<th>Deals</th>
											<th>Tasks</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<h5 class="font-15 mb-1 fw-normal">Jeremy Young</h5>
												<span class="text-muted font-13">Senior Sales Executive</span>
											</td>
											<td>187</td>
											<td>154</td>
											<td>49</td>
											<td class="table-action">
												<a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
											</td>
										</tr>
										<tr>
											<td>
												<h5 class="font-15 mb-1 fw-normal">Thomas Krueger</h5>
												<span class="text-muted font-13">Senior Sales Executive</span>
											</td>
											<td>235</td>
											<td>127</td>
											<td>83</td>
											<td class="table-action">
												<a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
											</td>
										</tr>
										<tr>
											<td>
												<h5 class="font-15 mb-1 fw-normal">Pete Burdine</h5>
												<span class="text-muted font-13">Senior Sales Executive</span>
											</td>
											<td>365</td>
											<td>148</td>
											<td>62</td>
											<td class="table-action">
												<a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
											</td>
										</tr>
										<tr>
											<td>
												<h5 class="font-15 mb-1 fw-normal">Mary Nelson</h5>
												<span class="text-muted font-13">Senior Sales Executive</span>
											</td>
											<td>753</td>
											<td>159</td>
											<td>258</td>
											<td class="table-action">
												<a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
											</td>
										</tr>
										<tr>
											<td>
												<h5 class="font-15 mb-1 fw-normal">Kevin Grove</h5>
												<span class="text-muted font-13">Senior Sales Executive</span>
											</td>
											<td>458</td>
											<td>126</td>
											<td>73</td>
											<td class="table-action">
												<a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div> <!-- end table-responsive-->

						</div> <!-- end card-body-->
					</div> <!-- end card-->
				</div>
				<!-- end col-->

				<div class="col-xl-4 col-lg-6">
					<div class="card">
						<div class="card-body">
							<div class="dropdown float-end">
								<a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-dots-vertical"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item">Settings</a>
									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item">Action</a>
								</div>
							</div>
							<h4 class="header-title mb-4">Recent Leads</h4>

							<div class="d-flex align-items-start">
								<img class="me-3 rounded-circle" src="public/img/users/avatar-2.jpg" width="40" alt="Generic placeholder image">
								<div class="w-100 overflow-hidden">
									<span class="badge badge-warning-lighten float-end">Cold lead</span>
									<h5 class="mt-0 mb-1">Risa Pearson</h5>
									<span class="font-13">richard.john@mail.com</span>
								</div>
							</div>

							<div class="d-flex align-items-start mt-3">
								<img class="me-3 rounded-circle" src="public/img/users/avatar-3.jpg" width="40" alt="Generic placeholder image">
								<div class="w-100 overflow-hidden">
									<span class="badge badge-danger-lighten float-end">Lost lead</span>
									<h5 class="mt-0 mb-1">Margaret D. Evans</h5>
									<span class="font-13">margaret.evans@rhyta.com</span>
								</div>
							</div>

							<div class="d-flex align-items-start mt-3">
								<img class="me-3 rounded-circle" src="public/img/users/avatar-4.jpg" width="40" alt="Generic placeholder image">
								<div class="w-100 overflow-hidden">
									<span class="badge badge-success-lighten float-end">Won lead</span>
									<h5 class="mt-0 mb-1">Bryan J. Luellen</h5>
									<span class="font-13">bryuellen@dayrep.com</span>
								</div>
							</div>

							<div class="d-flex align-items-start mt-3">
								<img class="me-3 rounded-circle" src="public/img/users/avatar-5.jpg" width="40" alt="Generic placeholder image">
								<div class="w-100 overflow-hidden">
									<span class="badge badge-warning-lighten float-end">Cold lead</span>
									<h5 class="mt-0 mb-1">Kathryn S. Collier</h5>
									<span class="font-13">collier@jourrapide.com</span>
								</div>
							</div>

							<div class="d-flex align-items-start mt-3">
								<img class="me-3 rounded-circle" src="public/img/users/avatar-1.jpg" width="40" alt="Generic placeholder image">
								<div class="w-100 overflow-hidden">
									<span class="badge badge-warning-lighten float-end">Cold lead</span>
									<h5 class="mt-0 mb-1">Timothy Kauper</h5>
									<span class="font-13">thykauper@rhyta.com</span>
								</div>
							</div>

							<div class="d-flex align-items-start mt-3">
								<img class="me-3 rounded-circle" src="public/img/users/avatar-6.jpg" width="40" alt="Generic placeholder image">
								<div class="w-100 overflow-hidden">
									<span class="badge badge-success-lighten float-end">Won lead</span>
									<h5 class="mt-0 mb-1">Zara Raws</h5>
									<span class="font-13">austin@dayrep.com</span>
								</div>
							</div>

						</div>
						<!-- end card-body -->
					</div>
					<!-- end card-->
				</div>
				<!-- end col-->
			</div>
			<!-- end row-->
		</div> <!-- container -->

	</div> <!-- content -->

	<script src="public/js/vendor/Chart.bundle.min.js"></script>
	<script src="public/js/vendor/apexcharts.min.js"></script>
	<!-- Todo js -->
	<!-- <script src="public/js/ui/component.todo.js"></script> -->
	<!-- demo app -->
	<!-- <script src="public/js/pages/demo.dashboard-crm.js"></script> -->
	<!-- end demo js-->

	<script>
		$(document).ready(function() {
			select_class();
			select_test_code();

			colors = ['#727cf5', '#0acf97', '#fa5c7c', '#ffbc00'];
			(dataColors = $('#dash-campaigns-chart').data('colors')) &&
			(colors = dataColors.split(','));

			var options = {
					chart: {
						height: 304,
						type: 'radialBar'
					},
					colors: colors,
					series: [14, 48, 47, 5],
					labels: ['Tốt', 'Khá', 'Trung Bình', 'Yếu'],
					plotOptions: {
						radialBar: {
							track: {
								margin: 8
							}
						}
					},
				},
				chart = new ApexCharts(
					document.querySelector('#dash-campaigns-chart'),
					options
				);

			chart.render();
		});

		function list_check() {
			var class_id = $('#class_id').val();
			var test_code = $('#test_code').val();

			$.ajax({
				url: 'index.php?action=get_charts_by_class_and_test_code',
				data: {
					class_id,
					test_code
				},
				type: 'POST',
				dataType: 'json',
				async: true,
				cache: false,
				success: function(response) {
					var percent_good_student = response[0].count_good_student;
					var percent_rather_student = response[1].count_rather_student;
					var percent_medium_student = response[2].count_medium_student;
					var percent_least_student = response[3].count_least_student;

					$('#good_student').html(percent_good_student);
					$('#rather_student').html(percent_rather_student);
					$('#medium_student').html(percent_medium_student);
					$('#least_student').html(percent_least_student);
				}
			});
		}
	</script>