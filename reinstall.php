<?php

error_reporting(0);
ini_set('display_errors', 0);

class install
{
	private $connect = '';
	private $connect_info = array();

	function step_0()
	{
		$require_check = true;
		echo '<div class="box">';
		echo '<h4><i class="dripicons-checklist"></i> Kiểm Tra Hệ Thống</h4>';
		echo '<div class="content-install">';
		echo '<strong class="mb-1" style="display: block">Trước khi cài đặt, yêu cầu máy chủ cần đáp ứng các điều kiện để tiếp tục cài đặt.</strong>';

		if (version_compare(PHP_VERSION, '7.0.0', '>=')) {
			$php_version = '<span class="pass">ĐẠT</span>';
		} else {
			$php_version = '<span class="failed">KHÔNG ĐẠT</span>';
			$require_check = false;
		}
		if (extension_loaded('xml')) {
			$ext_xml = '<span class="pass">ĐẠT</span>';
		} else {
			$ext_xml = '<span class="failed">KHÔNG ĐẠT</span>';
			$require_check = false;
		}
		if (extension_loaded('xmlwriter')) {
			$ext_xmlwriter = '<span class="pass">ĐẠT</span>';
		} else {
			$ext_xmlwriter = '<span class="failed">KHÔNG ĐẠT</span>';
			$require_check = false;
		}
		if (extension_loaded('mbstring')) {
			$ext_mbstring = '<span class="pass">ĐẠT</span>';
		} else {
			$ext_mbstring = '<span class="failed">KHÔNG ĐẠT</span>';
			$require_check = false;
		}
		if (extension_loaded('zip')) {
			$ext_zip = '<span class="pass">ĐẠT</span>';
		} else {
			$ext_zip = '<span class="failed">KHÔNG ĐẠT</span>';
			$require_check = false;
		}
		$ext_gd = extension_loaded('gd') ? '<span class="pass">ĐẠT</span>' : '<span class="failed">KHÔNG ĐẠT</span>';
		$ext_dom = extension_loaded('dom') ? '<span class="pass">ĐẠT</span>' : '<span class="failed">KHÔNG ĐẠT</span>';

		echo 'PHP 7.0.0: ' . $php_version . '<br />';
		echo 'PHP extension XML: ' . $ext_xml . '<br />';
		echo 'PHP extension xmlwriter: ' . $ext_xmlwriter . '<br />';
		echo 'PHP extension mbstring: ' . $ext_mbstring . '<br />';
		echo 'PHP extension ZipArchive: ' . $ext_zip . '<br />';
		echo 'PHP extension GD (tùy chọn): ' . $ext_gd . '<br />';
		echo 'PHP extension dom (tùy chọn): ' . $ext_dom . '<br />';

		if ($require_check) {
			echo '</div>';
			echo '</div>';
			$this->step_1();
		} else {
			echo '<span class="failed">Máy chủ không đạt đủ yêu cầu, liên hệ nhà cung cấp để biết thêm chi tiết.</span>';
			echo '</div>';
			echo '</div>';
		}
	}

	function step_1()
	{
		echo '<div class="box">';
		echo '<h4><i class="mdi mdi-brightness-7"></i> Tiến hành cài đặt</h4>';
		echo '<div class="content-install">';

		if (isset($_POST['step_1'])) {
			$host = $this->connect_info['host'] = $_POST['host'];
			$user = $this->connect_info['user'] = $_POST['user'];
			$password = $this->connect_info['password'] = $_POST['password'];
			$database_name = $this->connect_info['dbname'] = $_POST['database_name'];

			$this->connect = new mysqli($host, $user, $password, $database_name);
			if ($this->connect->connect_error)
				echo '<span class="failed">Kết nối cơ sở dữ liệu lỗi, vui lòng kiểm tra lại.</span>';
			else {
				$this->import_database();
				$this->connect->query("INSERT INTO admins (name, username, password, email, birthday, gender_id) VALUES ('Admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@gmail.com', '2001-11-13', 2)");
				$this->step_2();
			}
		} else {
			echo '<strong class="mb-1" style="display: block">Nhập các thông số kết nối cơ sở dữ liệu (Hãy chắc chắn bạn đã tạo sẵn 1 database).</strong>';

			echo '<form method="POST">';
			echo '<div class="form-floating mb-3">
			<input id="host" type="text" name="host" value="localhost" class="form-control" required>
			<label for="host">Database Host</label>
			</div>';
			echo '<div class="form-floating mb-3">
			<input id="user" type="text" name="user" class="form-control" required>
			<label for="user">Người dùng</label>
			</div>';
			echo '<div class="form-floating mb-3">
			<input id="password" type="text" name="password" class="form-control">
			<label for="password">Mật Khẩu</label>
			</div>';
			echo '<div class="form-floating mb-3">
			<input id="database_name" type="text" name="database_name" class="form-control" required>
			<label for="database_name">Tên Database</label>
			</div>';
			echo '<div class="form-floating mb-3">
			<button type="submit" name="step_1" class="btn btn-primary">TIẾP TỤC</button>
			</form>
			</div>';
			echo '<div class="form-floating mb-3">
			<a href="install.php?step=0" class="btn btn-danger">QUAY LẠI</a>
			</div>';
		}
		echo '</div></div>';
	}

	function step_2()
	{
		$this->save_config();
		echo "<span class='pass'>Cài đặt Hệ Thống Trắc Nghiệm Online thành công.</span><br />";
		echo "File install.php sẽ bị xóa sau quá trình cài đặt để đảm bảo vấn đề bảo mật.<br />";
		echo "Tài khoản mặc định: <b>admin</b><br />";
		echo "Mật khẩu: <b>123456</b> <br />";
		echo "Vui lòng đăng nhập và đổi mật khẩu ngay sau khi đăng nhập. <br />";
		echo 'Mọi thông tin chi tiết, hỗ trợ, góp ý, báo lỗi,<br />';
		echo "vui lòng liên hệ <span class='pass'>test@gmail.com</span> hoặc trực tiếp trang chính thức sản phẩm <a href='https://github.com/meesudzu/trac-nghiem-online'>TẠI ĐÂY</a>
		<br /><br />";
		echo '<a href="index.php" class="btn btn-success">KẾT THÚC</a>';
	}

	function import_database()
	{
		//database file
		$filename = 'public/files/oes_db.sql';
		// Temporary variable, used to store current query
		$templine = '';
		// Read in entire file
		$lines = file($filename);
		// Loop through each line
		foreach ($lines as $line) {
			// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')
				continue;

			// Add this line to the current segment
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';') {
				// Perform the query
				$this->connect->query($templine);
				// Reset temp variable to empty
				$templine = '';
			}
		}
		echo "<span class='pass'>Tạo cơ sở dữ liệu xong.</span><hr />";
	}
	function save_config()
	{
		//write config file
		$writer = "<?php
			return (object) array(
				'host' => '" . $this->connect_info['host'] . "',
				'user' => '" . $this->connect_info['user'] . "',
				'password' => '" . $this->connect_info['password'] . "',
				'dbname' => '" . $this->connect_info['dbname'] . "',
				'INSTALL_MODE' => FALSE
			);
		?>";
		$write = fopen('config/connect.php', 'w');
		fwrite($write, $writer);
		fclose($write);
		chmod('install.php', 0777);
		rename('install.php', 'reinstall.php');
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Tabs | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
	<meta content="Coderthemes" name="author">
	<!-- App favicon -->
	<link rel="shortcut icon" href="public/img/favicon.ico">

	<!-- App css -->
	<link href="public/css/icons.min.css" rel="stylesheet" type="text/css">
	<link href="public/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
	<link href="public/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">
	<link href="public/css/config.css" rel="stylesheet" type="text/css">

</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
	<!-- Begin page -->
	<div class="wrapper">
		<!-- ============================================================== -->
		<!-- Start Page Content here -->
		<!-- ============================================================== -->

		<div class="content-page-fluid">
			<div class="content">

				<!-- Start Content-->
				<div class="container-fluid">

					<!-- start page title -->
					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								<h4 class="page-title">Cài Đặt Hệ Thống Trắc Nghiệm Online</h4>
							</div>
						</div>
					</div>
					<!-- end page title -->

					<div class="row">
						<div class="col-xl-12">

							<?php
							$install = new install();
							$install->step_0();
							?>

						</div> <!-- end col -->
					</div>
					<!-- end row -->

				</div> <!-- container -->

			</div> <!-- content -->
		</div>

		<!-- ============================================================== -->
		<!-- End Page content -->
		<!-- ============================================================== -->
	</div>
	<!-- END wrapper -->

	<!-- Right Sidebar -->

	<div class="rightbar-overlay"></div>
	<!-- /End-bar -->

	<!-- bundle -->
	<script src="public/js/vendor.min.js"></script>
	<script src="public/js/app.min.js"></script>

</body>

</html>