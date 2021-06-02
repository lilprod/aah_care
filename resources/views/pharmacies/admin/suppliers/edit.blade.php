@extends('pharmacies.layouts.app')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Suppliers</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:(0);">Suppliers</a></li>
                <li class="breadcrumb-item active">Edit Supplier</li>
            </ul>
        </div>
    </div>
</div>

<div class="col-md-12">
    @include('inc.messages')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Edit Supplier : {{$supplier->name}}</h4>
            </div>
        </div>
            <form method="POST" action="{{ route('suppliers.update', $supplier->id) }}" enctype="multipart/form-data">
            	{{ csrf_field() }}
                {{ method_field('PATCH') }}

            <div class="card-body">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$supplier->name}}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" value="{{$supplier->email}}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone number <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="phone_number" value="{{$supplier->phone_number}}">
                        </div>
                    </div>

                     <div class="col-sm-6" id="old_country">
                        <div class="form-group">
                            <label class="control-label">Country<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="country"  value="{{$supplier->country}}">
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="city" value="{{$supplier->city}}">
                        </div>
                    </div>


    				<div class="col-sm-6">
    					<div class="form-group">
    						<label>Address <span class="text-danger">*</span></label>
    						<input type="text" class="form-control " name="address" value="{{$supplier->address}}">
    					</div>
    				</div>

                    <div class="col-sm-6">
    					<div class="form-group">
    						<label>Profile Image</label>
    						<input type="file" class="form-control" name="profile_picture" value="{{$supplier->profile_picture}}">
    							
    					</div>
                    </div>

                </div>

    			<div class="form-group">
                    <label>Short Biographiy</label>
                    <textarea class="form-control" rows="3" cols="30" name="biography">{{$supplier->biography}}</textarea>
                </div>

            
                <div class="form-group">
                    <label class="display-block">Status</label>
    				<div class="form-check form-check-inline">
    					<input class="form-check-input" type="radio" name="status" id="supplier_active" value="1" {{  $supplier->status == 1 ? 'checked' : '' }} >
    					<label class="form-check-label" for="supplier_active">
    					Actif
    					</label>
    				</div>
    				<div class="form-check form-check-inline">
    					<input class="form-check-input" type="radio" name="status" id="supplier_inactive" value="0" {{  $supplier->status == 0 ? 'checked' : '' }} >
    					<label class="form-check-label" for="supplier_inactive">
    					Inactif
    					</label>
    				</div>
                </div>

            </div>

                <div class="card-footer">
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Edit Supplier</button>
                    </div>
                </div>
            </form>
    </div>
</div>

@endsection