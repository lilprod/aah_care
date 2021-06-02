@extends('pharmacies.layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
	<div class="row">
		<div class="col">
			<h3 class="page-title">Prescriptions</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('pharmacy_dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item active">Serve Prescription</li>
			</ul>
		</div>
	</div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        @include('inc.messages')
    </div>
</div>


	<div class="card">
		<div class="card-header">
			<h4 class="card-title mb-0">Serve Prescription</h4>
		</div>

		<form method="POST" action="{{ route('prescriptions.store') }}" enctype="multipart/form-data">
			@csrf

			<!-- Prescription Item -->
			<div class="card card-table">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-center" id="dynamic_field">
							<thead>
								<tr>
									<th style="min-width: 200px">Name</th>
									<th style="min-width: 60px;">Quantity</th>
									<th style="min-width: 60px;">Quantity served</th>
									<th style="min-width: 100px;">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($prescribeddrugs as $drug)
								<tr>
									<td>
										<div class="form-group">

											<div class="form-group">
												<input class="form-control" type="text" value="{{ $drug->drug_name }}" disabled>
												<input class="form-control" type="text" name="drug_id[]" value="{{ $drug->id }}" style="display: none;">
											</div>
										</div>
									</td>

									<td>
										<div class="form-group">
											<input class="form-control" type="number" name="quantity[]" value="{{ $drug->quantity }}" disabled>
										</div>
									</td>

									<td>
										<div class="form-group">
											<input class="form-control" type="number" name="quantity_served[]" min="1" value="{{ $drug->quantity }}">
										</div>
									</td>

									<td>
										<div class="form-group">
											<select class="select form-control" name="status[]" required>
												<option value="-1">--Select Option</option>
												<option value="1">Served</option>
												<option value="2">To complete</option>
												<option value="0">Not available</option>
											</select>
										</div>

									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>

				<div class="card-footer ">
					<div class="m-t-20 text-center">
						<button type="submit" class="btn btn-primary submit-btn" >Save</button>
					</div>
				</div>
			</div>
			<!-- /Prescription Item -->

		</form>

	</div>



@endsection