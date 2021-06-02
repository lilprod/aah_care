@extends('admin.layouts.app')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Pharmacies</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:(0);">Pharmacies</a></li>
                <li class="breadcrumb-item active">Edit Pharmacy</li>
            </ul>
        </div>
    </div>
</div>

<div class="col-md-12">
    @include('inc.messages')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Edit Pharmacy : {{$pharmacy->name}}</h4>
            </div>
        </div>
            <form method="POST" action="{{ route('pharmacies.update', $pharmacy->id) }}" enctype="multipart/form-data">
            	{{ csrf_field() }}
                {{ method_field('PATCH') }}

            <div class="card-body">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Registration N° <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="registration" id="registration" value="{{$pharmacy->registration}}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$pharmacy->name}}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                            <div class="form-group">
                                <label>Director Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="director_name" value="{{$pharmacy->director_name}}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Slogan <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="slogan" value="{{$pharmacy->slogan}}">
                            </div>
                        </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" value="{{$pharmacy->email}}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone number <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="phone_number" value="{{$pharmacy->phone_number}}">
                        </div>
                    </div>

    				<div class="col-sm-6">
                        <div class="form-group">
                            <label>Creation Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="creation_date" value="{{$pharmacy->creation_date}}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group mb-3">
                            <label>Region<span class="text-danger">*</span></label>
                            <select class="form-control" id="region" name="region" required>
                                <option value="1" {{ ($pharmacy->region === 'WEST AFRICA') ? 'selected' : '' }}>WEST AFRICA</option>
                                <option value="2" {{ ($pharmacy->region === 'EAST AFRICA') ? 'selected' : '' }}>EAST AFRICA</option>
                                <option value="3" {{ ($pharmacy->region === 'NORTHEN AFRICA') ? 'selected' : '' }}>NORTHEN AFRICA</option>
                                <option value="4" {{ ($pharmacy->region === 'MIDDLE AFRICA') ? 'selected' : '' }}>MIDDLE AFRICA</option>
                                <option value="5" {{ ($pharmacy->region === 'SOUTHERN AFRICA') ? 'selected' : '' }}>SOUTHERN AFRICA</option>
                            </select>
                        </div>
                    </div>

                     <div class="col-sm-6" id="old_country">
                        <div class="form-group">
                            <label class="control-label">Country<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="old_country"  value="{{$pharmacy->country}}">
                        </div>
                    </div>

                    <div class="col-sm-6" id="country_section" style="display: none;">
                        <div class="form-group mb-3">
                            <label>Country</label>
                            <select class="form-control" name="country" id="country">
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="city" value="{{$pharmacy->city}}">
                        </div>
                    </div>


    				<div class="col-sm-6">
    					<div class="form-group">
    						<label>Address <span class="text-danger">*</span></label>
    						<input type="text" class="form-control " name="address" value="{{$pharmacy->address}}">
    					</div>
    				</div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo">
                        </div>
                    </div>

                    <div class="col-sm-6">
    					<div class="form-group">
    						<label>Profile Image</label>
    						<input type="file" class="form-control" name="profile_picture" value="{{$pharmacy->profile_picture}}">
    							
    					</div>
                    </div>

                </div>

               
    			<div class="form-group">
                    <label>Short Biographiy</label>
                    <textarea class="form-control" rows="3" cols="30" name="biography">{{$pharmacy->biography}}</textarea>
                </div>

            
                <div class="form-group">
                    <label class="display-block">Status</label>
    				<div class="form-check form-check-inline">
    					<input class="form-check-input" type="radio" name="status" id="pharmacy_active" value="1" {{  $pharmacy->status == 1 ? 'checked' : '' }} >
    					<label class="form-check-label" for="pharmacy_active">
    					Actif
    					</label>
    				</div>
    				<div class="form-check form-check-inline">
    					<input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="0" {{  $pharmacy->status == 0 ? 'checked' : '' }} >
    					<label class="form-check-label" for="pharmacy_inactive">
    					Inactif
    					</label>
    				</div>
                </div>
        </div>

                <div class="card-footer">
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Edit Pharmacy</button>
                    </div>
                </div>
            </form>
    </div>
</div>

@endsection

@push('edit_pharmacy')

<!-- jQuery -->
<script src="{{asset('assets/js/jquery.min.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function() {

        $('#name').keyup(function(){
            $(this).val($(this).val().toUpperCase());
        });

        $('#registration').keyup(function(){
            $(this).val($(this).val().toUpperCase());
        });


        $('#region').on('change', function () {

                    var region_id = $(this).val();

                    if(region_id){
                        $.ajax({
                            url: '{!!URL::route('getCountries')!!}',
                            type: 'GET',
                            data : { 'id' : region_id},
                            dataType: 'json',

                            success:function(data){
                                //console.log('data');

                                if(data) {

                                    $('#country_section').attr("style", "display:block");

                                    $('#old_country').attr("style", "display:none");

                                    $('#country').empty();

                                    $('#country').focus;

                                    $('#country').append('<option value = "">--Select Country--</option>');

                                    $.each(data, function(key, value){
                                        $('select[name = "country"]').append('<option value= "'+ value.title +'">' + value.title + '</option>');
                                    });

                                    //$('select[name = "country"]').selectmenu('refresh', true);

                                    //$('select[name = "country"]').refresh();

                                    } else {
                                        $('#country').empty();
                                    } 
                                }
                                });
                            }
                            else{
                                $('#country').empty();
                            }
                        
                 });
            });

</script>

@endpush