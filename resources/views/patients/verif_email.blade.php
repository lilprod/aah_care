<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AAH+ - Email Verification</title>
        
        <!-- Favicons -->
        <link type="image/x-icon" href="{{asset('assets/img/favicon.png') }}" rel="icon">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
        
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
        
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css') }}">
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
            @include('patients.partials.header')
      <!-- /Header -->  

       <!-- Breadcrumb -->
		<div class="breadcrumb-bar">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-md-12 col-12">
						<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Email Verification</li>
							</ol>
						</nav>
						<h2 class="breadcrumb-title">Email Verification <span style="color: #26a9e166">+</span></h2>
					</div>
				</div>
			</div>
		</div>
		<!-- /Breadcrumb -->


			<!-- Page Content -->
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        @include('patients.partials.profile_side')


                        <div class="col-md-7 col-lg-8 col-xl-9">

                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Note!</strong> Before proceeding with the change of password, you must confirm your <a href="#" class="alert-link">email address</a> to verify your account.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            @include('inc.messages')
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-lg-6">
										
											<!-- Change Password Form -->
											<form action="{{route('patient_verif_email')}}" method="POST">
                                                @csrf
												<div class="form-group">
													<label>Enter your email</label>
													<input type="text" class="form-control" name="email" required>
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Submit</button>
												</div>
											</form>
											<!-- /Change Password Form -->
											
										</div>
									</div>
								</div>
							</div>
						</div>

                    </div>

                </div>

            </div>

            <!-- Footer -->
                @include('website.footer')
                
            <!-- /Footer -->
        </div>
        <!-- /Main Wrapper -->
      
        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery.min.js') }}"></script>
        
        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
        
        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
        
    </body>
</html>