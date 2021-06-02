@extends('admin.layouts.app')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Pharmacies</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:(0);">Pharmacies</a></li>
                <li class="breadcrumb-item active">New Pharmacy</li>
            </ul>
        </div>
    </div>
</div>


<div class="col-md-12">
    @include('inc.messages')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">New Pharmacy</h4>
            </div>
        </div>
        <form method="POST" action="{{ route('pharmacies.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                	
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Registration N° <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="registration" id="registration">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" id="name">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Director Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="director_name">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Slogan <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="slogan">
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
                            <div class="form-group">
                                <label>Creation Date  <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="creation_date">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label>Region<span class="text-danger">*</span></label>
                                <select class="form-control" id="region" name="region" required>
                                    <option value = "">--Select Region--</option>
                                    <option value="1">WEST AFRICA</option>
                                    <option value="2">EAST AFRICA</option>
                                    <option value="3">NORTHEN AFRICA</option>
                                    <option value="4">MIDDLE AFRICA</option>
                                    <option value="5">SOUTHERN AFRICA</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label>Country<span class="text-danger">*</span></label>
                                <select class="form-control @error('country') is-invalid @enderror" name="country" id="country">
                                </select>
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
                                <label>Logo <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="logo">
                                  
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
        					<input class="form-check-input" type="radio" name="status" id="pharmacy_active" value="1" checked>
        					<label class="form-check-label" for="pharmacy_active">
        					Actif
        					</label>
        				</div>
        				<div class="form-check form-check-inline">
        					<input class="form-check-input" type="radio" name="status" id="pharmacy_inactive" value="0">
        					<label class="form-check-label" for="pharmacy_inactive">
        					Inactif
        					</label>
        				</div>
                    </div>

                </div>

                    <div class="card-footer">
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn">Add Pharmacy</button>
                        </div>
                    </div>
                </form>
    </div>
</div>

@endsection


@push('create_pharmacy')
 <script type="text/javascript">
    $(document).ready(function() {

        $('#name').keyup(function(){
            $(this).val($(this).val().toUpperCase());
        });

        $('#registration').keyup(function(){
            $(this).val($(this).val().toUpperCase());
        });

        $('#firstname').keyup(function() 
        {
            var str = $('#firstname').val();
           
            
            var spart = str.split(" ");
            for ( var i = 0; i < spart.length; i++ )
            {
                var j = spart[i].charAt(0).toUpperCase();
                spart[i] = j + spart[i].substr(1);
            }

          $('#firstname').val(spart.join(" "));
        
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