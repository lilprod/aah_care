@extends('pharmacies.layouts.app')

@section('content')
	<!-- Invoice Container -->
	<div class="invoice-container">
	
			
			<div class="row">
				<div class="col-md-6 m-b-20">
					<div class="inv-logo img-fluid">
						<img src="{{asset('assets/img/logo_aah.png') }}" alt="logo">
					</div>
				</div>
				<div class="col-md-6 m-b-20">
					<p class="invoice-details">
						<strong>Order:</strong> #00124 <br>
						<strong>Issued:</strong> 20/07/2019
					</p>
				</div>
			</div>
			
			<!-- Invoice Item -->
			<div class="row">
				<div class="col-sm-6 m-b-20">

					<h6>Prescription From</h6>
					<ul class="list-unstyled mb-0">
						<li><h5 class="mb-0"><strong>Dr. {{$prescription->doctor->name }} {{$prescription->doctor->firstname}}</strong></h5></li>
						<li>{{$prescription->doctor->address }}, {{$prescription->doctor->city }}</li>
						<li>{{$prescription->doctor->country }},</li>
						<li>{{$prescription->doctor->phone_number }}</li>
						<li><a href="#">{{$prescription->doctor->email }}</a></li>
					</ul>
				</div>
				<div class="col-sm-6 m-b-20">

					<h6>Prescription To</h6>
					<ul class="list-unstyled mb-0">
						<li><h5 class="mb-0"><strong>{{$prescription->patient->name }} {{$prescription->patient->firstname}}</strong></h5></li>
						<li>{{$prescription->patient->address }}, {{$prescription->patient->city }}</li>
						<li>{{$prescription->patient->country }},</li>
						<li>{{$prescription->patient->phone_number }}</li>
						<li><a href="#">{{$prescription->patient->email }}</a></li>
					</ul>
				</div>
			</div>
			<!-- /Invoice Item -->
			
			<!-- Invoice Item -->
			<!--<div class="invoice-item">
				<div class="row">
					<div class="col-md-12">
						<div class="invoice-info">
							<strong class="customer-text">Payment Method</strong>
							<p class="invoice-details invoice-details-two">
								Debit Card <br>
								XXXXXXXXXXXX-2541 <br>
								HDFC Bank<br>
							</p>
						</div>
					</div>
				</div>
			</div>-->
			<!-- /Invoice Item -->
			
			<!-- Invoice Item -->
			<br><br>
			<div class="invoice-item invoice-table-wrap">
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="invoice-table table table-bordered">
								<thead>
									<tr>
										<th>Drugs</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Dosage</th>
										<!--<th class="text-right">Total</th>-->
									</tr>
								</thead>
								<tbody>
									@foreach($prescribeddrugs as $prescribeddrug)
									<tr>
										<td>{{$prescribeddrug->drug_name}} {{$prescribeddrug->strengh}}</td>
										<td class="text-center">{{$prescribeddrug->quantity}}</td>
										<td class="text-center">{{$prescribeddrug->duration}} Day(s)</td>
										<!--<td class="text-right">$100</td>-->
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<!--<div class="col-md-6 col-xl-4 ml-auto">
						<div class="table-responsive">
							<table class="invoice-table-two table">
								<tbody>
								<tr>
									<th>Subtotal:</th>
									<td><span>$350</span></td>
								</tr>
								<tr>
									<th>Discount:</th>
									<td><span>-10%</span></td>
								</tr>
								<tr>
									<th>Total Amount:</th>
									<td><span>$315</span></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>-->
				</div>
			</div>
			<!-- /Invoice Item -->

			<br><br>
			<!-- Signature -->
				<div class="row">
					<div class="col-md-12 text-right">
						<div class="signature-wrap">
							<div class="signature">
								<!--Click here to sign-->
								<img class="img-fluid sign" src="{{url('/storage/signatures/'.$prescription->doctor->signature->signature_file ) }}" alt="Signature Image">
							</div>
							<div class="sign-name">
								<p class="mb-0">( Dr. {{$prescription->doctor->name}} {{$prescription->doctor->firstname}} )</p>
								<span class="text-muted">Signature</span>
							</div>
						</div>
					</div>
				</div>
				<!-- /Signature -->
			
			<!-- Invoice Information -->
			<div class="other-info">
				<h4>Note</h4>
				<p class="text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum ligula, cursus blandit risus. Maecenas eget metus non tellus dignissim aliquam ut a ex. Maecenas sed vehicula dui, ac suscipit lacus. Sed finibus leo vitae lorem interdum, eu scelerisque tellus fermentum. Curabitur sit amet lacinia lorem. Nullam finibus pellentesque libero.</p>
			</div>
			<!-- /Invoice Information -->



	</div>

	<div class="col-lg-8 offset-lg-2">
		<a class="btn btn-primary" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i> Back</a>
	</div>
	<!-- /Invoice Container -->
@endsection