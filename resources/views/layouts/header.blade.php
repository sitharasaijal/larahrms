<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="Smarthr - Bootstrap Admin Template">
	<meta name="keywords"
		content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
	<meta name="author" content="Dreamguys - Bootstrap Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<title>Dashboard - HRMS admin template</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script>
		var base_url = '{{ url("/") }}';
	</script>


	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png')}}">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">

	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">

	<!-- Chart CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">

	<link rel="stylesheet" href="{{asset('assets/css/jquery-confirm.min.css')}}">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

	@stack('css')

	@if(!empty($controllerCss))
		@foreach($controllerCss as $css)
			<link rel="stylesheet" href="{{ $css }}">
		@endforeach
	@endif

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>


<body>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<div class="header">

			<!-- Logo -->
			<div class="header-left">
				<a href="{{URL('/dashboard')}}" class="logo">
					<img src="{{asset('assets/img/logo.png')}}" width="40" height="40" alt="">
				</a>
			</div>
			<!-- /Logo -->

			<a id="toggle_btn" href="javascript:void(0);">
				<span class="bar-icon">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</a>

			<!-- Header Title -->
			<div class="page-title-box">
				<h3>HRMS</h3>
			</div>
			<!-- /Header Title -->

			<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

			<!-- Header Menu -->
			<ul class="nav user-menu">
				<li class="nav-item dropdown has-arrow main-drop">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img"><img src="assets/img/profiles/avatar-21.jpg" alt="">
							<span class="status online"></span></span>
						<span>Admin</span>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a>
						<a class="dropdown-item" href="{{URL('/logout')}}">Logout</a>
					</div>
				</li>
			</ul>
			<!-- /Header Menu -->

			<!-- Mobile Menu -->
			<div class="dropdown mobile-user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
						class="fa fa-ellipsis-v"></i></a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="profile.html">My Profile</a>
					<a class="dropdown-item" href="settings.html">Settings</a>
					<a class="dropdown-item" href="login.html">Logout</a>
				</div>
			</div>
			<!-- /Mobile Menu -->

		</div>
		<!-- /Header -->

		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li class="menu-title">
							<span>Main</span>
						</li>
						<li>
							<a href="{{URL('/dashboard')}}"><i class="la la-dashboard"></i> <span> Dashboard</span></a>
						</li>
						<li class="menu-title">
							<span>Employees</span>
						</li>
						<li class="submenu">
							<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
									class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="{{URL('/employees')}}">All Employees</a></li>
								<li><a href="holidays.html">Holidays</a></li>
								<li><a href="leaves.html">Leaves (Admin) <span
											class="badge badge-pill bg-primary float-right">1</span></a></li>
								<li><a href="leaves-employee.html">Leaves (Employee)</a></li>
								<li><a href="attendance-employee.html">Attendance (Employee)</a></li>
								<li><a href="{{URL('/departments')}}">Departments</a></li>
								<li><a href="{{URL('/designations')}}">Designations</a></li>
							</ul>
						</li>
						<li class="menu-title">
							<span>HR</span>
						</li>
						<li>
							<a href="policies.html"><i class="la la-file-pdf-o"></i> <span>Policies</span></a>
						</li>
						<li class="submenu">
							<a href="#"><i class="la la-pie-chart"></i> <span> Reports </span> <span
									class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="expense-reports.html"> Expense Report </a></li>
								<li><a href="invoice-reports.html"> Invoice Report </a></li>
								<li><a href="payments-reports.html"> Payments Report </a></li>
								<li><a href="project-reports.html"> Project Report </a></li>
								<li><a href="task-reports.html"> Task Report </a></li>
								<li><a href="user-reports.html"> User Report </a></li>
								<li><a href="employee-reports.html"> Employee Report </a></li>
								<li><a href="payslip-reports.html"> Payslip Report </a></li>
								<li><a href="attendance-reports.html"> Attendance Report </a></li>
								<li><a href="leave-reports.html"> Leave Report </a></li>
								<li><a href="daily-reports.html"> Daily Report </a></li>
							</ul>
						</li>
						<li>
							<a href="settings.html"><i class="la la-cog"></i> <span>Settings</span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Sidebar -->