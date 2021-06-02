@extends('pharmacies.layouts.app')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Suppliers</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('pharmacy_dashboard')}}">Suppliers</a></li>
                <li class="breadcrumb-item"><a href="javascript:(0);">Suppliers</a></li>
                <li class="breadcrumb-item active">New Supplier</li>
            </ul>
        </div>
    </div>
</div>


<div class="col-md-12">
    @include('inc.messages')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">New Supplier</h4>
            </div>
        </div>
        <form method="POST" action="{{ route('suppliers.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                	
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" id="name">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone number <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="phone_number">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label>Country<span class="text-danger">*</span></label>
                                <input class="form-control @error('country') is-invalid @enderror" name="country" id="country">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control " name="city">
                            </div>
                        </div>

        				<div class="col-sm-6">
        					<div class="form-group">
        						<label>Address <span class="text-danger">*</span></label>
        						<input type="text" class="form-control " name="address">
        					</div>
        				</div>

                        <div class="col-sm-6">
        					<div class="form-group">
        						<label>Profile Image</label>
        						<input type="file" class="form-control" name="profile_picture">
        					</div>
                        </div>
                        
                    </div>

        			<div class="form-group">
                        <label>Short Biography</label>
                        <textarea class="form-control" rows="3" cols="30" name="biography"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="display-block">Status</label>
        				<div class="form-check form-check-inline">
        					<input class="form-check-input" type="radio" name="status" id="supplier_active" value="1" checked>
        					<label class="form-check-label" for="supplier_active">
        					Actif
        					</label>
        				</div>
        				<div class="form-check form-check-inline">
        					<input class="form-check-input" type="radio" name="status" id="supplier_inactive" value="0">
        					<label class="form-check-label" for="supplier_inactive">
        					Inactif
        					</label>
        				</div>
                    </div>

                </div>

                    <div class="card-footer">
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn">Add Supplier</button>
                        </div>
                    </div>
            </form>
    </div>
</div>

@endsection