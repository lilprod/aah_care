@extends('pharmacies.layouts.app')

@section('content')
<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Profile</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('pharmacy_dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Profile</li>
				</ul>
			</div>
		</div>
	</div>
<!-- /Page Header -->

<div class="row">
		<div class="col-md-12">
			@include('inc.messages')
			<div class="profile-header">
				<div class="row align-items-center">
					<div class="col-auto profile-image">
						<a href="#">
							<img class="rounded-circle" alt="User Image" src="{{url('/storage/profile_images/'.auth('pharmacy')->user()->profile_picture ) }}">
						</a>
					</div>
					<div class="col ml-md-n2 profile-user-info">
						<h4 class="user-name mb-0">{{$pharmacy->name}}</h4>
						<h6 class="text-muted">{{$pharmacy->email}}</h6>
						<div class="user-Location"><i class="fas fa-map-marker-alt"></i> {{$pharmacy->country}}, {{$pharmacy->city}}, {{$pharmacy->address}}</div>
						<div class="about-text">{{$pharmacy->biography}}</div>
					</div>
					<div class="col-auto profile-btn">
						
						<a href="#edit_personal_details" data-toggle="modal" class="btn btn-primary">
							Edit
						</a>
					</div>
				</div>
			</div>
			<div class="profile-menu">
				<ul class="nav nav-tabs nav-tabs-solid">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#password_tab">Password</a>
					</li>
				</ul>
			</div>	
			<div class="tab-content profile-tab-cont">
				
				<!-- Personal Details Tab -->
				<div class="tab-pane fade show active" id="per_details_tab">
				
					<!-- Personal Details -->
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title d-flex justify-content-between">
										<span>Pharmacy Details</span> 
										<a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a>
									</h5>
									<div class="row">
										<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
										<p class="col-sm-10">{{$pharmacy->name}}</p>
									</div>
									<div class="row">
										<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Creation Date</p>
										<p class="col-sm-10">{{$pharmacy->creation_date}}</p>
									</div>
									<div class="row">
										<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
										<p class="col-sm-10">{{$pharmacy->email}}</p>
									</div>
									<div class="row">
										<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
										<p class="col-sm-10">{{$pharmacy->phone_number}}</p>
									</div>
									<div class="row">
										<p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
										<p class="col-sm-10 mb-0">{{$pharmacy->address}},<br>
										{{$pharmacy->city}},<br>
										{{$pharmacy->country}}.</p>
									</div>
								</div>
							</div>
							
							<!-- Edit Details Modal -->
							<div class="modal fade bd-example-modal-xl" id="edit_personal_details" aria-hidden="true" role="dialog">
								<div class="modal-dialog modal-dialog-centered modal-xl" role="document" >
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Personal Details</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form method="POST" action="{{route('update_pharmacy_setting', auth('pharmacy')->user()->id)}}" enctype="multipart/form-data">
												{{ csrf_field() }}
                								{{ method_field('PATCH') }}
												<div class="row form-row">

													<div class="col-12 col-sm-12">
														<div class="form-group">
															<label>Registration N°<span class="text-danger">*</span></label>
															<input type="text" class="form-control" value="{{$pharmacy->registration}}" name="registration" id="registration">
														</div>
													</div>


													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label>Name<span class="text-danger">*</span></label>
															<input type="text" class="form-control" value="{{$pharmacy->name}}" name="name" id="name">
														</div>
													</div>

													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label>Director Name<span class="text-danger">*</span></label>
															<input type="text"  class="form-control" value="{{$pharmacy->director_name}}" name="director_name">
														</div>
													</div>

													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label>Slogan<span class="text-danger">*</span></label>
															<input type="text"  class="form-control" value="{{$pharmacy->slogan}}" name="slogan">
														</div>
													</div>


													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label>Creation Date<span class="text-danger">*</span></label>
															<div class="cal-icon">
																<input type="text" class="form-control" value="{{$pharmacy->creation_date}}" name="creation_date">
															</div>
														</div>
													</div>
													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label>Email ID<span class="text-danger">*</span></label>
															<input type="email" class="form-control" value="{{$pharmacy->email}}" name="email">
														</div>
													</div>
													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label>Mobile <span class="text-danger">*</span></label>
															<input type="text" value="{{$pharmacy->phone_number}}" class="form-control" name="phone_number">
														</div>
													</div>

													<div class="col-12">
														<h5 class="form-title"><span>Address</span></h5>
													</div>
													<div class="col-12 col-sm-6">
														<div class="form-group">
														<label>Address<span class="text-danger">*</span></label>
															<input type="text" class="form-control" value="{{$pharmacy->address}}" name="address">
														</div>
													</div>
													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label>City<span class="text-danger">*</span></label>
															<input type="text" class="form-control" value="{{$pharmacy->city}}" name="city">
														</div>
													</div>


													<!--<div class="col-12 col-sm-6">
														<div class="form-group">
															<label>State</label>
															<input type="text" class="form-control" value="Florida">
														</div>
													</div>
													<div class="col-12 col-sm-6">
														<div class="form-group">
															<label>Zip Code</label>
															<input type="text" class="form-control" value="22434">
														</div>
													</div>-->


													<div class="col-12 col-sm-6">
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

								                     <div class="col-12 col-sm-6" id="old_country">
								                        <div class="form-group">
								                            <label class="control-label">Country<span class="text-danger">*</span></label>
								                            <input type="text" class="form-control" name="old_country"  value="{{$pharmacy->country}}">
								                        </div>
								                    </div>

								                    <div class="col-12 col-sm-6" id="country_section" style="display: none;">
								                        <div class="form-group mb-3">
								                            <label>Country</label>
								                            <select class="form-control" name="country" id="country">
								                            </select>
								                        </div>
								                    </div>

								                    <div class="col-12 col-sm-12">
										    			<div class="form-group">
										                    <label>Short Biographiy</label>
										                    <textarea class="form-control" rows="3" cols="30" name="biography">{{$pharmacy->biography}}</textarea>
										                </div>

									            	</div>

													<div class="col-12 col-sm-6">
								                        <div class="form-group">
								                            <label>Logo<span class="text-danger">*</span></label>
								                            <input type="file" class="form-control" name="logo">
								                        </div>
								                    </div>

								                    <div class="col-12 col-sm-6">
								    					<div class="form-group">
								    						<label>Profile Image</label>
								    						<input type="file" class="form-control" name="profile_picture" value="{{$pharmacy->profile_picture}}">
								    							
								    					</div>
								                    </div>

								                    

								                </div>

								                

												<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /Edit Details Modal -->
							
						</div>

					
					</div>
					<!-- /Personal Details -->

				</div>
				<!-- /Personal Details Tab -->
				
				<!-- Change Password Tab -->
				<div id="password_tab" class="tab-pane fade">
				
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Change Password</h5>
							<div class="row">
								<div class="col-md-10 col-lg-6">
									<form method="POST" action="{{route('pharmacy_update_password')}}">

										 @csrf
										<div class="form-group">
											<label>Old Password</label>
											<input type="password" class="form-control" name="old_password" required>
										</div>
										<div class="form-group">
											<label>New Password</label>
											<input type="password" class="form-control" name="new_password" required>
										</div>
										<div class="form-group">
											<label>Confirm Password</label>
											<input type="password" class="form-control" name="confirm_password" required>
										</div>
										<button class="btn btn-primary" type="submit">Save Changes</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Change Password Tab -->
				
			</div>
		</div>
	</div>

@endsection

@push('admin_pharmacy_profile')

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