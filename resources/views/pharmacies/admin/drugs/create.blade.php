@extends('pharmacies.layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-7 col-auto">
            <h3 class="page-title">Drugs</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Add Drug</li>
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
    <div class="col-lg-6 offset-lg-3">
        <form method="POST" action="{{ route('pharmacydrugs.store') }}" enctype="multipart/form-data">
        	@csrf

            <div class="row form-row">

                    
                    <div class="col-sm-2">
                        <label>Drug Name</label>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <select class="form-control select" name="drug_id">
                                @foreach($drugs as $drug)
                                    <option value="{{$drug->id}}">{{$drug->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#bd-example-modal-lg" data-original-title="" title="">Add</button>
                    </div>
                    <br>


                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label>Minimal Quantity*</label>
                        <input type="number" class="form-control" name="q_minimum" id="q_minimum">
                    </div>
                </div>


                 <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="unit_ht">PU HT</label>
                        <input type="number" id="unit_ht" name="unit_ht" class="form-control">
                    </div>
                </div>


                 <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="unit_tt">PU TT*</label>
                        <input type="number" id="unit_tt" name="unit_tt" class="form-control">
                    </div>
                </div>

                 <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" id="discount" name="discount" class="form-control">
                    </div>
                </div>


                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea cols="30" rows="4" class="form-control" name="description"></textarea>
                    </div>
                </div>

                <div class="col-12 col-sm-12">
                    <div class="form-group">
                    <label class="display-block">Statut </label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="product_active" value="1" checked>
                        <label class="form-check-label" for="product_active">
                        Actif
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="product_inactive" value="0">
                        <label class="form-check-label" for="product_inactive">
                        Inactif
                        </label>
                    </div>
                </div>
                
            </div>

            <button type="submit" class="btn btn-primary btn-block">Add  Changes</button>

            </form>
        </div>
 </div>



    <div class="modal fade bd-example-modal-lg show" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">New Drug</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""><span aria-hidden="true">×</span></button>
                </div>

                <form method="POST" action="{{ route('pharmacy_store_drug') }}" enctype="multipart/form-data">
                        @csrf
                <div class="modal-body">

                        <div class="row form-row">

                            <input type="hidden" class="form-control" name="add" id="add" value="1">

                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Drug Type</label>
                                    <select class="form-control select" name="drug_type_id">
                                        @foreach($drugtypes as $drugtype)
                                            <option value="{{$drugtype->id}}">{{$drugtype->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Drug Name*</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                            </div>

                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label for="generic_name">Generic Name*</label>
                                    <input type="text" id="generic_name" name="generic_name" class="form-control">
                                </div>
                            </div>

                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Short Note</label>
                                    <textarea cols="30" rows="4" class="form-control" name="short_note"></textarea>
                                </div>
                            </div>
                            
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </div>

            </form>
            </div>
        </div>
    </div>

@endsection