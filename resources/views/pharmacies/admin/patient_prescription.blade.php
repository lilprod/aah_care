@extends('pharmacies.layouts.app')

@section('content')

<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Prescriptions</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('pharmacy_dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Prescriptions per Patient</li>
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

 <div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Prescriptions per Patient</h4>
                </div>
            </div>

             <div class="card-body">
                <div class="table-responsive">
            		<table class="table table-striped custom-table mb-0 datatable">
					    <thead>
					        <tr>
					            <th>Date </th>
					            <th>Name</th>                                   
					            <th>Created by </th>
					            <th></th>
					        </tr>     
					    </thead>
					    <tbody>
					        @foreach($prescriptions as $prescription)
					        <tr>
					            <td>{{$prescription->created_at->format('d/m/Y')}}</td>
					            <td>Prescription</td>
					            <td>
					                    Dr. {{$prescription->doctor->name }} {{$prescription->doctor->firstname}} | <span>{{$prescription->doctor->speciality->title}}</span>
					            </td>
					            <td class="text-right">
					                <div class="table-action">
					                    <a href="#" class="btn btn-sm bg-primary-light" >
					                        <i class="fas fa-edit"></i> Edit
					                    </a>
					                    <a href="{{route('pharmacy_prescription_view', $prescription->id)}}" class="btn btn-sm bg-info-light">
					                        <i class="far fa-eye"></i> View
					                    </a>
					                </div>
					            </td>
					        </tr>
					        @endforeach
					    </tbody>    
					</table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection