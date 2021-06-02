<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>AAH+ - FAQ</title>
		
		<!-- Favicons -->
		<link type="image/x-icon" href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<!--<link rel="stylesheet" href="{{asset('css/font-awesome.min.css') }}">-->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css') }}">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

		<style type="text/css">
			.accordion-section .panel-default > .panel-heading {
			    border: 0;
			    background: #f4f4f4;
			    padding: 0;
			}
			.accordion-section .panel-default .panel-title a {
			    display: block;
			    font-style: italic;
			    font-size: 1.5rem;
			}
			.accordion-section .panel-default .panel-title a:after {
			    font-family: 'FontAwesome';
			    font-style: normal;
			    font-size: 3rem;
			    content: "\f106";
			    color: #20c0f3;
			    float: right;
			    margin-top: -50px;
			}
			.accordion-section .panel-default .panel-title a.collapsed:after {
			    content: "\f107";
			}
			.accordion-section .panel-default .panel-body {
			    font-size: 1.2rem;
			}

			a {
			    color: #20c0f3;
			    text-decoration: none;
			    background-color: transparent;
			    -webkit-text-decoration-skip: objects;
			}

			a:hover {
			    color: #00A651;
			    text-decoration: underline;
			}
		</style>
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">

		@include('website.hearder')

		<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">FAQ</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">FAQ <span style="color: #26a9e166">+</span></h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->

			<!-- Page Content -->
			<div class="content">

				<section class="accordion-section clearfix mt-3" aria-label="Question Accordions">
				  <div class="container">
				  
					  <h2>Frequently Asked Questions </h2>

					  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

					  	@foreach($faqs as $key => $faq)

						<div class="panel panel-default">
						  <div class="panel-heading p-3 mb-3" role="tab" id="heading{{$key}}">
							<h3 class="panel-title">
							  <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
								{!! $faq->question!!}
							  </a>
							</h3>
						  </div>
						  <div id="collapse{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$key}}">
							<div class="panel-body px-3 mb-4">
							  {!! $faq->answer!!}
							</div>
						  </div>
						</div>
						
						@endforeach
						
						

					  </div>
				  
				  </div>
				</section>

			</div>		
			<!-- /Page Content -->


		@include('website.footer')

		</div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Slick JS -->
		<script src="{{asset('assets/js/slick.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>