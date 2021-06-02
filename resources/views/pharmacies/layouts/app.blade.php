<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <!-- CSRF Token -->
    	<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin Pharmacy AAH+ - Dashboard</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png') }}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('admin/assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">

		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{asset('admin/assets/css/feathericon.min.css') }}">
		
		<link rel="stylesheet" href="{{asset('admin/assets/plugins/morris/morris.css') }}">

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('admin/assets/css/select2.min.css') }}">

		<!-- Datatables CSS -->
		<link rel="stylesheet" href="{{asset('admin/assets/plugins/datatables/datatables.min.css') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('admin/assets/css/style.css') }}">

        <link href="{{asset('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
        
		<style type="text/css">
			.sign {
			    max-width: 100%;
                height: 85px;
			}
		</style>
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
                    <a href="{{route('admin.dashboard')}}" class="logo">
						<img src="{{asset('admin/assets/img/logo_aah.png')}}" alt="Logo">
					</a>
					<a href="{{route('admin.dashboard')}}" class="logo logo-small">
						<img src="{{asset('admin/assets/img/logo_small.png')}}" alt="Logo" width="30" height="30">
					</a>
                </div>
				<!-- /Logo -->
				
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fe fe-text-align-left"></i>
				</a>
				
				<div class="top-nav-search">
					<form>
						<input type="text" class="form-control" placeholder="Search here">
						<button class="btn" type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
				
				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fa fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->
				
				<!-- Header Right Menu -->
				<ul class="nav user-menu">

					<!-- Notifications -->
					<li class="nav-item dropdown noti-dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fe fe-bell"></i> <span class="badge badge-pill">3</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<!--<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('admin/assets/img/doctors/doctor-thumb-01.jpg')}}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Dr. Ruby Perrin</span> Schedule <span class="noti-title">her appointment</span></p>
													<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>-->
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="#">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->
					
					<!-- User Menu -->
					<li class="nav-item dropdown has-arrow">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img class="rounded-circle" src="{{url('/storage/profile_images/'.auth('pharmacy')->user()->profile_picture ) }}" width="31" alt="Ryan Taylor"></span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="{{url('/storage/profile_images/'.auth('pharmacy')->user()->profile_picture ) }}" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6>{{Auth('pharmacy')->user()->name}}</h6>
									<p class="text-muted mb-0">Admin Pharmacy</p>
								</div>
							</div>
							<a class="dropdown-item" href="{{route('admin_pharmacy_profile')}}">My Profile</a>
							<!--<a class="dropdown-item" href="#">Settings</a>-->
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
						</div>
					</li>
					<!-- /User Menu -->
					
				</ul>
				<!-- /Header Right Menu -->
				
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
							<li class="active"> 
								<a href="{{route('pharmacy_dashboard')}}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>

							<li> 
								<a href="{{route('home')}}" target="_blank"><i class="fe fe-arrow-left"></i> <span>Back to website</span></a>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-users"></i> <span> Suppliers </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('suppliers.index')}}">List </a></li>
									<li><a href="{{route('suppliers.create')}}">New </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span>Our Drugs </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('pharmacydrugs.index')}}">List </a></li>
									<li><a href="#">Out-stock </a></li>
									<li><a href="{{route('pharmacydrugs.create')}}">New </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-star-o"></i> <span> Orders </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('orders.index')}}">List </a></li>
									<li><a href="{{route('orders.create')}}">New </a></li>
								</ul>
							</li>

							<li class=""> 
								<a href="{{route('pharmacy_prescriptions')}}"><i class="fe fe-document"></i> <span>Prescriptions</span></a>
							</li>

							
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
					
					@yield('content')
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
        <!-- jQuery -->
        <script src="{{asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>

        @stack('admin_pharmacy_profile')
        @stack('dashboard')
        @stack('pharmacydrug')
        @stack('supplier')
        @stack('order')
        @stack('add_order')
        @stack('edit_order')

        <script src="{{ asset('ckeditor/ckeditor.js')}}"></script> 


        <!-- Bootstrap Core JS -->
        <script src="{{asset('admin/assets/js/popper.min.js') }}"></script>

        <script src="{{asset('admin/assets/js/bootstrap.min.js') }}"></script>

        <script src="{{asset('js/star-rating.js') }}" type="text/javascript"></script>
		<!-- /Main Wrapper -->
		
		<!-- Slimscroll JS -->
        <script src="{{asset('admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

        <!-- Select2 JS -->
		<script src="{{asset('admin/assets/js/select2.min.js') }}"></script>

		<!-- Datatables JS -->
		<script src="{{asset('/admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
		<script src="{{asset('/admin/assets/plugins/datatables/datatables.min.js') }}"></script>

		<script>
       	$.extend( true, $.fn.dataTable.defaults, {
            "order" : [[0, "desc"]],
            "language": {
            "search" : "Recherche:",
            "oPaginate":{
              "sFirst":"Premier",
              "sLast":"Dernier",
              "sNext":"Suivant",
              "sPrevious":"Précédent"
            },
            "sInfo" : "Afficher _START_ à _END_ des _TOTAL_ lignes",
            "sInfoEmpty" : "Afficher 0 à 0 des 0 données",
            "sInfoFiltered" : "Trié de _MAX_ lignes totales",
            "sEmptyTable" : "Pas de données disponible dans la table",
            "sLengthMenu" : "Afficher _MENU_ lignes",
            "sZeroRecords" : "Aucune donnée correspondante trouvée"
          }
        });
    </script>
		
		<!-- Custom JS -->
		<script  src="{{asset('admin/assets/js/script.js') }}"></script>
    </body>
</html>