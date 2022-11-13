<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>
		Hệ Thống Thi Trực Tuyến | <?php echo $title ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<!-- App favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="public/img/favicon/quiz-icon.png">

	<!-- third party css -->
	<link href="public/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
	<!-- third party css end -->

	<!-- App css -->
	<link href="public/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="public/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
	<link href="public/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
	<link href="public/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css">
	<link href="public/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css">
	<script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/vendor/dropify.min.css">
	<script src="public/js/admin_functions.js"></script>
	<script src="vendors/ckeditor/ckeditor.js"></script>
	<script src="vendors/ckeditor/ckfinder/ckfinder.js"></script>
	<script src="vendors/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>

	<style>
		.valid-img {
			position: absolute;
			width: 20px;
			right: 10px;
			top: 38px;
		}

		p {
			margin-top: 4px;
			margin-bottom: 0;
		}

		.flex {
			display: flex;
			align-items: center;
		}

		.relative {
			position: relative;
		}

		.hidden {
			display: none;
		}

		#eye {
			position: absolute;
			width: 20px;
			right: 10px;
			top: 38px;
		}

		#translate_select {
			margin-top: 8px;
			margin-right: 46px;
		}

		.goog-te-banner-frame {
			opacity: 0.8;
		}

		.goog-te-combo {
			display: block;
			width: 100%;
			padding: 0.45rem 0.9rem;
			font-size: 0.9rem;
			font-weight: 400;
			line-height: 1.5;
			color: #6c757d;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #dee2e6;
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			border-radius: 0.25rem;
			-webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
			transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
			transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
			transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
		}

		.goog-te-combo:focus {
			outline: none;
		}

		.custom-panel {
			position: relative;
			border-radius: 15px;
			border: 1px solid #eee;
			opacity: 0.9;
			overflow: hidden;
		}

		.fs-40 {
			font-size: 40px;
		}

		@keyframes rotate {
			100% {
				transform: rotate(1turn);
			}
		}

		.custom-panel::before {
			content: '';
			position: absolute;
			z-index: -2;
			left: -50%;
			top: -50%;
			width: 200%;
			height: 200%;
			background-color: #399953;
			background-repeat: no-repeat;
			background-size: 50% 50%, 50% 50%;
			background-position: 0 0, 100% 0, 100% 100%, 0 100%;
			background-image: linear-gradient(#399953, #399953), linear-gradient(#fbb300, #fbb300), linear-gradient(#d53e33, #d53e33), linear-gradient(#377af5, #377af5);
			animation: rotate 10s linear infinite;
		}

		.custom-panel::after {
			content: '';
			position: absolute;
			z-index: -1;
			left: 6px;
			top: 6px;
			width: calc(100% - 12px);
			height: calc(100% - 12px);
			background: white;
			border-radius: 5px;
		}
	</style>
</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
	<!-- === Preloader start === -->
	<div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
	</div>

	<!-- === Preloader end === -->

	<!-- Begin page -->
	<div class="wrapper">