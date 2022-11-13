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

			<li class="side-nav-item">
				<a href="index.php?action=show_questions_panel" class="side-nav-link">
					<i class="uil-question-circle"></i>
					<span> Quản lý Câu Hỏi </span>
				</a>
			</li>

			<li class="side-nav-item menuitem-active">
				<a href="index.php?action=show_tests_panel" class="side-nav-link active">
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
								<li class="breadcrumb-item">
									<a href="index.php?action=show_tests_panel">
										<i class="uil-clipboard-alt"></i>
										Quản lý Đề Thi</a>
								</li>
								<li class="breadcrumb-item active">
									Chi Tiết Đề Thi
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
							<div class="table-responsive">
								<table class="table table-centered table-striped dt-responsive nowrap w-100" id="questions">
									<thead>
										<tr>
											<th>ID</th>
											<th>Nội Dung Câu Hỏi</th>
											<th>Đáp Án</th>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i = 0; $i < count($questions); $i++) {
										?>
											<tr>
												<td><?= $questions[$i]->question_id ?></td>
												<td><?= $questions[$i]->question_content ?></td>
												<td><?= $questions[$i]->correct_answer ?></td>
											</tr>
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