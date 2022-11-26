<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Landing Page | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
	<meta content="Coderthemes" name="author">
	<!-- App favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="public/img/favicon/quiz-icon.png">

	<!-- App css -->
	<link href="public/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="public/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
	<link href="public/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
	<script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<script src="public/js/student_functions.js"></script>

	<style>
		.html {
			scroll-behavior: smooth;
		}

		.flex {
			display: flex;
			align-items: center;
			flex-direction: row;
		}

		.flex-between {
			justify-content: space-between;
		}

		.flex-end {
			justify-content: flex-end;
		}

		.flex-full {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.fs-16 {
			font-size: 16px;
		}

		.fs-18 {
			font-size: 18px;
		}

		.fs-24 {
			font-size: 24px;
		}

		.text-green {
			color: green;
		}

		.text-red {
			color: red;
		}

		p {
			margin-top: 6px;
			margin-bottom: 4px;
		}

		.none {
			display: none;
		}

		.simp-custom {
			border: 1px dashed #ddd;
			padding: 5px;
			border-radius: 10px;
		}

		.relative {
			position: relative;
		}

		.underline {
			border-bottom: 1px solid #eef2f7;
		}

		#eye {
			position: absolute;
			width: 20px;
			right: 10px;
			top: 38px;
		}

		.justify-center {
			justify-content: center;
		}

		#time {
			display: flex;
			gap: 14px;
		}

		#time,
		#time .circle,
		#time .circle svg {
			height: 70px;
			line-height: 70px;
		}

		#time .circle {
			position: relative;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		#time .circle svg {
			position: relative;
			width: 70px;
			transform: rotate(270deg);
		}

		#time .circle svg circle {
			width: 100%;
			height: 100%;
			fill: transparent;
			stroke: #191919;
			stroke-width: 3;
			transform: translate(5px, 5px);
		}

		#time .circle svg circle:nth-child(2) {
			stroke: var(--clr);
			stroke-dasharray: 125;
		}

		#time div {
			position: absolute;
			text-align: center;
			font-weight: 500;
		}

		.dots {
			position: absolute;
			width: 100%;
			height: 100%;
			z-index: 10;
			display: flex;
			justify-content: center;
		}

		.dots::before {
			content: '';
			position: absolute;
			top: 10px;
			width: 8px;
			height: 8px;
			background: var(--clr);
			border-radius: 50%;
			box-shadow: 0 0 20px var(--clr), 0 0 60px var(--clr);
		}

		.button-eye-mobile {
			border: none;
			color: currentColor;
			height: 70px;
			line-height: 70px;
			width: 60px;
			background-color: transparent;
			font-size: 24px;
			cursor: pointer;
			float: left;
			z-index: 1;
			position: relative;
			margin-left: -24px;
			opacity: 0.8;
		}

		.button-eye-mobile:hover {
			opacity: 1;
		}
	</style>
</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

	<!--*******************
        Preloader start
    ********************-->
	<div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
	</div>