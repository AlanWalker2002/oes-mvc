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
					<a class="nav-link active" href="index.php">Trang chủ</a>
				</li>
				<li class="nav-item mx-lg-1">
					<a class="nav-link" href="index.php?action=list_test">Danh sách đề</a>
				</li>
				<li class="nav-item mx-lg-1">
					<a class="nav-link maintained" href="#">Trò chuyện</a>
				</li>
				<li class="nav-item mx-lg-1">
					<a class="nav-link maintained" href="#">Xem thông báo</a>
				</li>
				<li class="nav-item mx-lg-1">
					<a class="nav-link maintained" href="#">Liên hệ</a>
				</li>
			</ul>

			<!-- right menu -->
			<div class="dropdown btn-group">
				<button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="mdi mdi-spin mdi-star me-2"></i> <?php echo $info['name'] ?>
				</button>
				<div class="dropdown-menu dropdown-menu-animated">
					<a class="dropdown-item" href="#">Action</a>
					<a class="dropdown-item" href="#">Another action</a>
					<a class="dropdown-item notify-item" data-bs-toggle="modal" id="logout" style="cursor: pointer;" data-bs-target="#logoutModal"><i class="mdi mdi-logout me-1"></i> Đăng xuất</a>
				</div>
			</div>

		</div>
	</div>
</nav>
<!-- NAVBAR END -->

<!-- START HERO -->
<section class="hero-section">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-5">
				<div class="mt-md-4">
					<div>
						<span class="badge bg-danger rounded-pill">Mới</span>
						<span class="text-white-50 ms-1">Đa dạng - Thông minh - Chính xác</span>
					</div>
					<h2 class="text-white fw-normal mb-4 mt-3 hero-title">
						Hệ thông trắc nghiệm Online
					</h2>

					<p class="mb-4 font-16 text-white-50">Danh sách bài thi trắc nghiệm</p>

					<a href="" target="_blank" class="btn btn-success">Vào xem <i class="mdi mdi-arrow-right ms-1"></i></a>
				</div>
			</div>
			<div class="col-md-5 offset-md-2">
				<div class="text-md-end mt-3 mt-md-0">
					<img src="public/img/startup.svg" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END HERO -->

<!-- START SERVICES -->
<section class="py-5">
	<div class="container">
		<div class="row py-4">
			<div class="col-lg-12">
				<div class="text-center">
					<h1 class="mt-0"><i class="mdi mdi-infinity"></i></h1>
					<h3>Trải nghiệm hệ thống trắc nghiệm <span class="text-primary">đa dạng</span> và <span class="text-primary">thông minh</span></h3>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4">
				<div class="text-center p-3">
					<div class="avatar-sm m-auto">
						<span class="avatar-title bg-primary-lighten rounded-circle">
							<i class="uil uil-desktop text-primary font-24"></i>
						</span>
					</div>
					<h4 class="mt-3">Đa dạng nội dung</h4>
					<p class="text-muted mt-2 mb-0">Cung cấp đa dạng nội dung các câu hỏi trắc nghiệm thuộc nhiều lĩnh vực khác nhau.
					</p>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="text-center p-3">
					<div class="avatar-sm m-auto">
						<span class="avatar-title bg-primary-lighten rounded-circle">
							<i class="uil uil-vector-square text-primary font-24"></i>
						</span>
					</div>
					<h4 class="mt-3">Ma trận câu hỏi</h4>
					<p class="text-muted mt-2 mb-0">Hệ thống sẽ dựa vào ma trận câu hỏi phong phú để tự tổng hợp thành đề trắc nghiệm.
					</p>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="text-center p-3">
					<div class="avatar-sm m-auto">
						<span class="avatar-title bg-primary-lighten rounded-circle">
							<i class="uil uil-presentation text-primary font-24"></i>
						</span>
					</div>
					<h4 class="mt-3">Đáp án chi tiết</h4>
					<p class="text-muted mt-2 mb-0">Sau khi hoàn thành bài kiểm tra trắc nghiệm hệ thống sẽ thông báo số điểm đạt được kèm lời giải chi tiết.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END SERVICES -->

<!-- START FEATURES 2 -->
<section class="py-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-center">
					<h1 class="mt-0"><i class="mdi mdi-heart-multiple-outline"></i></h1>
					<h3>Các tính năng bạn sẽ <span class="text-danger">thích</span></h3>
					<p class="text-muted mt-2">Hyper đi kèm với thiết kế ui thế hệ tiếp theo và có nhiều lợi ích
					</p>
				</div>
			</div>
		</div>
		<div class="row mt-2 py-5 align-items-center">
			<div class="col-lg-5">
				<img src="public/img/features-1.svg" class="img-fluid" alt="">
			</div>
			<div class="col-lg-6 offset-lg-1">
				<h3 class="fw-normal">Các đề thi học kỳ</h3>
				<p class="text-muted mt-3">Ngân hàng câu hỏi đầy đủ các môn cấp 1,2,3 được trộn để theo cấu trúc phân loại</p>

				<div class="mt-4">
					<p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Giúp dễ dàng ôn tập online</p>
					<p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Phân loại đề thi giữa học kỳ, thi học kỳ</p>
					<p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Phân loại nhiều chủ đề khác nhau</p>
				</div>

				<a href="" class="btn btn-primary btn-rounded mt-3">Làm ngay <i class="mdi mdi-arrow-right ms-1"></i></a>

			</div>
		</div>

		<div class="row pb-3 pt-5 align-items-center">
			<div class="col-lg-6">
				<h3 class="fw-normal">Các đề thi kiểm tra 1 tiết, thi THPT QG</h3>
				<p class="text-muted mt-3">Hệ thống câu hỏi bài kiểm tra 1 tiết, kiểm tra 15 phút, bài thi THPT QG được thiết kế theo hình thức trắc nghiệm online</p>

				<div class="mt-4">
					<p class="text-muted"><i class="mdi mdi-circle-medium text-success"></i> Giúp học sinh tập</p>
					<p class="text-muted"><i class="mdi mdi-circle-medium text-success"></i> Chấm điểm trực tuyến</p>
					<p class="text-muted"><i class="mdi mdi-circle-medium text-success"></i> Đa dạng các môn học</p>
					<p class="text-muted"><i class="mdi mdi-circle-medium text-success"></i> Kèm lời giải chi tiết</p>
				</div>

				<a href="" class="btn btn-success btn-rounded mt-3">Làm ngay <i class="mdi mdi-arrow-right ms-1"></i></a>

			</div>
			<div class="col-lg-5 offset-lg-1">
				<img src="public/img/features-2.svg" class="img-fluid" alt="">
			</div>
		</div>

	</div>
</section>
<!-- END FEATURES 2 -->