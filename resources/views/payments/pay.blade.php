<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - Pay appointment fees</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Favicons -->
		<link href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css') }}">

		<link href="{{asset('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
		
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
			@include('website.hearder')
			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Checkout</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Pay appointment <span style="color: #26a9e166">+</span></h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container">

					<div class="row">

						<div class="col-md-6 col-lg-6 theiaStickySidebar">
						
							<!-- Booking Summary -->
							<div class="card booking-card">
								<div class="card-header">
									<h4 class="card-title">Booking Summary</h4>
								</div>
								<div class="card-body">
								
									<!-- Booking Doctor Info -->
									<div class="booking-doc-info">
										<a href="{{route('doctor.profile', $appointment->doctor->id)}}" class="booking-doc-img">
											<img src="{{url('/storage/profile_images/'.$appointment->doctor->profile_picture ) }}" alt="User Image">
										</a>
										<div class="booking-info">
											<h4><a href="{{route('doctor.profile', $appointment->doctor->id)}}">Dr. {{$appointment->doctor->name}} {{$appointment->doctor->firstname}}</a></h4>
											<div class="rating">
												<!--<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star"></i>
												<span class="d-inline-block average-rating">35</span>-->
												<input id="rating-system" type="number" class="rating" min="0" max="5" step="1" name="rating" value="{{ $appointment->doctor->averageRating }}" disabled>
												
											</div>
											<div class="clinic-details">
												@if($appointment->doctor->address != '')
												<p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{$appointment->doctor->address}}</p>
												@endif
											</div>
										</div>
									</div>
									<!-- Booking Doctor Info -->
									
									<div class="booking-summary">
										<div class="booking-item-wrap">
											<ul class="booking-date">
												<li>Date <span>{{$appointment->date_apt }}</span></li>
												<li>Time <span>{{$appointment->begin_time }}</span></li>
											</ul>
											<ul class="booking-fee">
												<li>Consulting Fee <span>${{$appointment->apt_amount }}</span></li>
												<!--<li>Booking Fee <span>$10</span></li>
												<li>Video Call <span>$50</span></li>-->
											</ul>
											<div class="booking-total">
												<ul class="booking-total-list">
													<li>
														<span>Total</span>
														<span class="total-cost">${{$appointment->apt_amount }}</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Booking Summary -->
							
						</div>

						<div class="col-md-6 col-lg-6">
							@include('inc.messages')
							

							<form method="POST" action="{{ route('patient_apt_pay') }}" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="card booking-schedule schedule-widget">

                            	<div class="card-body">

                            		<div class="row form-row">
                            
	                                <div class="col-md-12">
	                                    <div class="form-group">
	                                        <label>Payment Mode</label>
	                                        <select class="form-control select" name="payment_mode">
	                                                <option value="1">Flooz</option>
	                                                <option value="2">T-Money</option>
	                                                <option value="3">Paypal</option>
	                                                <option value="4">Stripe</option>
	                                        </select>
	                                    </div>
	                                </div>

	                                <div class="col-md-12">

		                            	<!-- Submit Section -->
			                            <div class="submit-section proceed-btn text-right">
			                                <button type="submit" id="submit" class="btn btn-primary submit-btn" disabled>Proceed to Pay</button>
			                            </div>
		                        	</div>

		                        </div>

	                 
                            	</div>

                            </div>

                            
                        </form>
						
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
			<!-- Footer -->
			 @include('website.footer')
                
			<!-- /Footer -->
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>

		<script src="{{asset('js/star-rating.js') }}" type="text/javascript"></script>
		
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