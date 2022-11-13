<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="end-bar">

	<div class="rightbar-title">
		<a href="javascript:void(0);" class="end-bar-toggle float-end">
			<i class="dripicons-cross noti-icon"></i>
		</a>
		<h5 class="m-0">Cấu hình</h5>
	</div>

	<div class="rightbar-content h-100" data-simplebar="">

		<div class="p-3">
			<div class="alert alert-warning" role="alert">
				<strong>Tùy chỉnh </strong> bảng màu tổng thể, menu thanh bên, v.v.
			</div>

			<!-- Settings -->
			<h5 class="mt-3">Bảng màu</h5>
			<hr class="mt-1">

			<div class="form-check form-switch mb-1">
				<input class="form-check-input me-2" type="checkbox" name="color-scheme-mode" value="light" id="light-mode-check" checked="">
				<label class="form-check-label" for="light-mode-check">Chế độ sáng</label>
			</div>

			<div class="form-check form-switch mb-1">
				<input class="form-check-input me-2" type="checkbox" name="color-scheme-mode" value="dark" id="dark-mode-check">
				<label class="form-check-label" for="dark-mode-check">Chế độ tối</label>
			</div>


			<!-- Width -->
			<h5 class="mt-4">Bề rộng</h5>
			<hr class="mt-1">
			<div class="form-check form-switch mb-1">
				<input class="form-check-input me-2" type="checkbox" name="width" value="fluid" id="fluid-check" checked="">
				<label class="form-check-label" for="fluid-check">Toàn màn</label>
			</div>

			<div class="form-check form-switch mb-1">
				<input class="form-check-input me-2" type="checkbox" name="width" value="boxed" id="boxed-check">
				<label class="form-check-label" for="boxed-check">Hình hộp</label>
			</div>


			<!-- Left Sidebar-->
			<h5 class="mt-4">Thanh bên trái</h5>
			<hr class="mt-1">
			<div class="form-check form-switch mb-1">
				<input class="form-check-input me-2" type="checkbox" name="theme" value="default" id="default-check">
				<label class="form-check-label" for="default-check">Mặc định</label>
			</div>

			<div class="form-check form-switch mb-1">
				<input class="form-check-input me-2" type="checkbox" name="theme" value="light" id="light-check" checked="">
				<label class="form-check-label" for="light-check">Sáng</label>
			</div>

			<div class="form-check form-switch mb-3">
				<input class="form-check-input me-2" type="checkbox" name="theme" value="dark" id="dark-check">
				<label class="form-check-label" for="dark-check">Đen</label>
			</div>

			<div class="form-check form-switch mb-1">
				<input class="form-check-input me-2" type="checkbox" name="compact" value="fixed" id="fixed-check" checked="">
				<label class="form-check-label" for="fixed-check">Cố định</label>
			</div>

			<div class="form-check form-switch mb-1">
				<input class="form-check-input me-2" type="checkbox" name="compact" value="condensed" id="condensed-check">
				<label class="form-check-label" for="condensed-check">Cô đặc</label>
			</div>

			<div class="form-check form-switch mb-1">
				<input class="form-check-input me-2" type="checkbox" name="compact" value="scrollable" id="scrollable-check">
				<label class="form-check-label" for="scrollable-check">Có thể cuộn</label>
			</div>

			<div class="d-grid mt-4">
				<button class="btn btn-primary" id="resetBtn">Đặt lại về mặc định</button>
			</div>
		</div> <!-- end padding-->

	</div>
</div>

<div class="rightbar-overlay"></div>
<!-- /End-bar -->

<div id="logoutModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="standard-modalLabel">Đăng Xuất</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				<p>Xác nhận đăng xuất</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Không</button>
				<button type="button" class="btn btn-primary" id="btn-logout">Có</button>
			</div>
		</div>
	</div>
</div>

<!-- /End-bar -->

<!-- bundle -->
<script src="public/js/vendor.min.js"></script>
<script src="public/js/app.min.js"></script>

<script src="vendors/counter/counterUp.js"></script>

<!-- third party js -->
<script src="public/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
<script src="public/js/vendor/jquery-jvectormap-world-mill-en.js"></script>

<script src="public/js/vendor/jquery.dataTables.min.js"></script>
<script src="public/js/vendor/dataTables.bootstrap5.js"></script>
<script src="public/js/vendor/dataTables.responsive.min.js"></script>
<script src="public/js/vendor/responsive.bootstrap5.min.js"></script>
<script src="public/js/vendor/dataTables.checkboxes.min.js"></script>
<!-- third party js ends -->

<script src="public/js/vendor/dropify.min.js"></script>
<script src="public/js/scripts/form-file-uploads.min.js"></script>

<!-- demo app -->
<script src="public/js/pages/demo.products.js"></script>
<!-- end demo js-->

<script>
	$('#questions').DataTable({
		"language": {
			sLengthMenu: 'Hiển thị <select class="form-select form-select-sm ms-1 me-1">' +
				'<option value="10">10</option>' +
				'<option value="20">20</option>' +
				'<option value="30">30</option>' +
				'<option value="40">40</option>' +
				'<option value="50">50</option>' +
				'<option value="-1">Tất cả</option>' +
				'</select> bản ghi',
			"zeroRecords": "Không tìm thấy",
			"info": "Hiển thị trang _PAGE_/_PAGES_",
			"infoEmpty": "Không có dữ liệu",
			"emptyTable": "Không có dữ liệu",
			"infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
			"sSearch": "Tìm kiếm",
			"paginate": {
				"first": "Đầu",
				"last": "Cuối",
				"next": "Sau",
				"previous": "Trước"
			},
		}
	});

	$('#tests').DataTable({
		"language": {
			sLengthMenu: 'Hiển thị <select class="form-select form-select-sm ms-1 me-1">' +
				'<option value="10">10</option>' +
				'<option value="20">20</option>' +
				'<option value="30">30</option>' +
				'<option value="40">40</option>' +
				'<option value="50">50</option>' +
				'<option value="-1">Tất cả</option>' +
				'</select> bản ghi',
			"zeroRecords": "Không tìm thấy",
			"info": "Hiển thị trang _PAGE_/_PAGES_",
			"infoEmpty": "Không có dữ liệu",
			"emptyTable": "Không có dữ liệu",
			"infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
			"sSearch": "Tìm kiếm",
			"paginate": {
				"first": "Đầu",
				"last": "Cuối",
				"next": "Sau",
				"previous": "Trước"
			},
		}
	});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>

<script>
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({
			pageLanguage: 'vi'
		}, 'translate_select');
	}

	function filterSearch() {
		var input, filter, ul, li, a, span, i, txtValue;
		input = document.getElementById("top-search");
		filter = input.value.charAt(0).toUpperCase() + input.value.slice(1)
		ul = document.getElementById("side-nav");
		li = ul.getElementsByTagName("li");

		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			txtValue = a.textContent || a.innerText;
			console.log(txtValue);
			if ((txtValue.charAt(0).toUpperCase() + txtValue.slice(1)).indexOf(filter) > -1) {
				li[i].style.display = "";
			} else {
				li[i].style.display = "none";
			}
		}
	}

	$('.maintained').click(() => {
		toastr.warning('Chức năng đang trong quá trình phát triển');
	});
</script>

</body>

</html>