<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= Config::TITLE ?>
	</title>
	<link href="public/css/icons.min.css" rel="stylesheet" type="text/css">
	<link href="public/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
	<link href="public/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">
	<link rel="stylesheet" href="public/css/reset.css">
	<link rel="stylesheet" href="public/css/pages/login.css">
	<script src="public/js/jquery.js"></script>
	<script src="public/js/login.js"></script>
</head>

<body class="bg-login">
	<div id="message" class="message"></div>

	<div id="wrapper">
		<form id="form-login" class="fadeInLogin">
			<h1 class="form-heading">
				<i id="reload" class="dripicons-arrow-thin-left" onclick="reload()" title="Quay lại"></i>
				Đăng nhập
			</h1>
			<div class="form-group" id="field_username">
				<i class="dripicons-user"></i>
				<input type="text" class="form-input" name="username" id="username" placeholder="Tên đăng nhập">
			</div>

			<div id="note-username" style="color: #3c763d;">
				<span>Tài khoản có thể là tên đăng nhập, mã học sinh hoặc email.</span>
			</div>

			<div id="note-password" style="color: #3c763d; display: none;">
				<div id="hi">Xin Chào: <b><span id="hi-text" style="color: blue; font-weight: bold"></span></b>, nhập mật khẩu để tiếp tục.</div>
			</div>

			<div class="form-group hidden" id="field_password">
				<i class="mdi mdi-key"></i>
				<input type="password" class="form-input" name="password" id="password" placeholder="Mật khẩu">
				<div id="eye">
					<i class="mdi mdi-eye"></i>
				</div>
			</div>
			<div class="form-group">
				<input type="submit" value="Đăng nhập" class="form-submit" onclick="submit_login()" id="btn-login">
				<input type="submit" value="Quên mật khẩu" class="form-submit" onclick="submit_forgot_password()" id="btn-fotgot">

			</div>
		</form>
	</div>
</body>

</html>