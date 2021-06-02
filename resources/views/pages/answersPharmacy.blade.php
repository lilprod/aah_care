<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>AAH+ - Result Pharmacy</title>
		
		<!-- Favicons -->
		<link type="image/x-icon" href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css') }}">

		<link rel="stylesheet" type="text/css" href="{{asset('css/btn.css') }}">

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

		@include('website.hearder')

		
			

			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row align-items-center">
						<div class="col-md-8 col-12">
							<h2 class="">{{count($pharmacies)}} matches found for : Pharmacy In {{$location}}</h2>
						</div>

						<div class="col-md-4 col-12 d-md-block d-none">
							<!--<div class="sort-by">
								<span class="sort-title">Sort by</span>
								<span class="sortby-fliter">
									<select class="select">
										<option>Select</option>
										<option class="sorting">Rating</option>
										<option class="sorting">Popular</option>
										<option class="sorting">Latest</option>
										<option class="sorting">Free</option>
									</select>
								</span>
							</div>-->
						</div>
					</div>
			

					<div class="row">

						<div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
						
							<!-- Search Filter -->
							<div class="card search-filter">
								<div class="card-header">
									<h4 class="card-title mb-0">Search Filter</h4>
								</div>

								<form action="{{ route('post_search_pharmacy') }}" method="POST">
								@csrf
								<div class="card-body">
									<div class="filter-widget">
										<label>Location</label>
										<input type="text" class="form-control" placeholder="Select Location" name="location">
									</div>

									<!--<div class="filter-widget">
										<h4>Categories</h4>
										<div>
											<label class="custom_check">
												<input type="checkbox" name="gender_type">
												<span class="checkmark"></span> Popular
											</label>
										</div>
										<div>
											<label class="custom_check">
												<input type="checkbox" name="gender_type">
												<span class="checkmark"></span> Latest
											</label>
										</div>
										<div>
											<label class="custom_check">
												<input type="checkbox" name="gender_type">
												<span class="checkmark"></span> Ratings
											</label>
										</div>
										<div>
											<label class="custom_check">
												<input type="checkbox" name="gender_type">
												<span class="checkmark"></span> Availability
											</label>
										</div>
										<div>
											<label class="custom_check">
												<input type="checkbox" name="gender_type" checked>
												<span class="checkmark"></span> Open 24 Hrs
											</label>
										</div>
										<div>
											<label class="custom_check">
												<input type="checkbox" name="gender_type">
												<span class="checkmark"></span> Home Delivery
											</label>
										</div>
									</div>-->
								
									<div class="btn-search">
										<button type="submit" class="btn btn-block">Search</button>
									</div>	
								</div>
								</form>
							</div>
							<!-- /Search Filter -->
							
						</div>

						<div class="col-md-12 col-lg-8 col-xl-9">

							@if($nb == 0)
								<div class="card">
									<div class="card-body">
										@include('inc.messages')

										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<strong>Error!</strong> No match found for : <a href="#" class="alert-link">Pharmacy</a>  In {{$location}}. Please try to search again! 
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									</div>
								</div>

							@else

							@foreach($pharmacies as $pharmacy)

							<!-- Doctor Widget -->
							<div class="card">
								<div class="card-body">
									<div class="doctor-widget">
										<div class="doc-info-left">
											<div class="doctor-img">
												<a href="{{route('pharmacy.profile', $pharmacy->id)}}">
													<img src="{{url('/storage/pharmacies/logo/'.$pharmacy->logo ) }}" class="img-fluid" alt="User Image">
												</a>
											</div>
											<div class="doc-info-cont">
												<h4 class="doc-name mb-2"><a href="{{route('pharmacy.profile', $pharmacy->id)}}">{{$pharmacy->name}}</a></h4>
												<div class="rating mb-2">
													<span class="badge badge-primary">4.0</span>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star"></i>
													<span class="d-inline-block average-rating">(17)</span>
												</div>
												<div class="clinic-details">
													<div class="clini-infos pt-3">
												
													<p class="doc-location mb-2"><i class="fas fa-phone-volume mr-1"></i> {{$pharmacy->phone_number}}</p>
													<p class="doc-location mb-2 text-ellipse"><i class="fas fa-map-marker-alt mr-1"></i> {{$pharmacy->address}} </p>
													<p class="doc-location mb-2"><i class="fas fa-chevron-right mr-1"></i> Chemists, Surgical Equipment Dealer</p>
													
													<p class="doc-location mb-2"><i class="fas fa-chevron-right mr-1"></i> Opens at 08.00 AM</p>
	
													</div>
												</div>
											</div>
										</div>
										<div class="doc-info-right">
											<div class="clinic-booking">
												<a class="view-pro-btn" href="{{route('pharmacy.profile', $pharmacy->id)}}">View Details</a>
												<!--<a class="apt-btn" href="product-all.html">Browse Products</a>-->
											</div>
										</div>
									</div>
								</div>
							</div>

							@endforeach

							@endif

							<div class="row">
								<div class="col-md-12">
									<a class="btn btn-primary" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i> Back</a>
								</div>
							</div>


							<!--<div class="load-more text-center">
								<a class="btn btn-primary btn-md" href="javascript:void(0);">Load More</a>	
							</div>-->

						</div>



					</div>
				</div>

			</div>		
			<!-- /Page Content -->

		<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
		@include('website.footer')

		</div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>

		<script src="{{asset('js/star-rating.js') }}" type="text/javascript"></script>

		<script type="text/javascript">
			// When the user scrolls down 20px from the top of the document, show the button
			window.onscroll = function() {scrollFunction()};

			function scrollFunction() {
			  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			    document.getElementById("myBtn").style.display = "block";
			  } else {
			    document.getElementById("myBtn").style.display = "none";
			  }
			}

			// When the user clicks on the button, scroll to the top of the document
			function topFunction() {
			  document.body.scrollTop = 0; // For Safari
			  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
			}
		</script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Slick JS -->
		<script src="{{asset('assets/js/slick.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>