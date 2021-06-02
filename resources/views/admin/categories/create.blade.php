@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-7 col-auto">
            <h3 class="page-title">Categories</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Add Category</li>
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
        <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
        	@csrf

            <div class="row form-row">
                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                </div>

                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label for="slug">Slug*</label>
                        <input type="text" id="slug" name="slug" class="form-control">
                    </div>
                </div>

                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea cols="30" rows="4" class="form-control" name="description"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>

            <!--<div class="form-group">
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
				</div>--> 
            </form>
        </div>
 </div>

@endsection

@push('scripts')
<script>
  $('#title').change(function(e) {
    $.get('{{ route('category.check_slug') }}', 
      { 'title': $(this).val() }, 
      function( data ) {
        $('#slug').val(data.slug);
      }
    );
  });
</script>
@endpush