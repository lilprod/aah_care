<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AAH+ - Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        
        <!-- Favicons -->
        <link href="{{asset('assets/img/favicon.png') }}" rel="icon">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
        
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
        
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css') }}">
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="assets/js/html5shiv.min.js"></script>
            <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    
    </head>
    <body class="account-page">

        <!-- Main Wrapper -->
        <div class="main-wrapper">
        
            <!-- Header -->
            @include('website.hearder')
            <!-- /Header -->

            <!-- Breadcrumb -->
            <div class="breadcrumb-bar">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-12">
                            <nav aria-label="breadcrumb" class="page-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Register</li>
                                </ol>
                            </nav>
                            <h2 class="breadcrumb-title">Register<span style="color: #26a9e166">+</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->
            
            <!-- Page Content -->
            <div class="content">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                              <div class="login-header text-center">
                                <h2 style="text-transform: uppercase;">Please register to <b>AAH+</b></h2>
                            </div>   
                            <!-- Register Content -->
                            <div class="account-content">
                                <div class="row align-items-center justify-content-center">

                                   <!-- <div class="col-md-7 col-lg-6 login-left">
                                        <img src="{{asset('assets/img/login-banner.png') }}" class="img-fluid" alt="TelemedAAH Register">    
                                    </div>-->


                                    <div class="col-md-12 col-lg-6 login-right">

                                        <div class="login-header">
                                            <h3>Patient Register <a href="{{route('register_pharmacy')}}"> Are you Pharmacy?</a> <a href="{{route('register_doctor')}}">{{ isset($url) ? ucwords($url) : ""}} Are you Doctor? &nbsp;&nbsp;</a></h3>

                                        </div>
                                        

                                        <div class="row form-row social-login">
                                            <div class="col-6">
                                                <a href="{{route('socialite.redirect', 'facebook')}}" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f mr-1"></i> </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{route('socialite.redirect', 'google')}}" class="btn btn-google btn-block"><i class="fab fa-google mr-1"></i></a>
                                            </div>

                                           <!-- <div class="col-4">
                                                    <a href="#" class="btn btn-instagram btn-block"><i class="fab fa-instagram mr-1"></i></a>
                                                </div>-->

                                        </div>
                                        <div class="login-or">
                                            <span class="or-line"></span>
                                            <span class="span-or">or</span>
                                        </div>


                                        <!-- Register Form -->

                                        @isset($url)
                                            <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                                        @else
                                            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                                        @endisset
                                        <!--<form action="" method="POST">-->
                                            @csrf

                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" id="name" autofocus>
                                                <label class="focus-label">Nom<span class="text-danger">*</span></label>

                                                 @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating @error('firstname') is-invalid @enderror" name="firstname" id="firstname" value="{{ old('firstname') }}" required autocomplete="firstname">
                                                <label class="focus-label">Prénom(s)<span class="text-danger">*</span></label>

                                                @error('firstname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group form-focus">
                                                <input type="email" class="form-control floating @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                <label class="focus-label">Email<span class="text-danger">*</span></label>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                                                <label class="focus-label">Téléphone<span class="text-danger">*</span></label>

                                                @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group form-focus">
                                                <input type="date" class="form-control floating @error('birth_date') is-invalid @enderror" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required autocomplete="birth_date">
                                                <label class="focus-label">Date de naissance<span class="text-danger">*</span></label>

                                                @error('birth_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                            <!--<div class="form-group form-focus">
                                                <input type="text" class="form-control floating @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                                                <label class="focus-label">Adresse</label>

                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>-->

                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">
                                                <label class="focus-label">Ville de résidence<span class="text-danger">*</span></label>

                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group form-focus">
                                                <input type="password" class="form-control floating @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                <label class="focus-label">Mot de passe<span class="text-danger">*</span></label>

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group form-focus">
                                                <input type="password" class="form-control floating" name="password_confirmation" required autocomplete="new-password">
                                                <label class="focus-label">Confirmation mot de passe<span class="text-danger">*</span></label>
                                            </div>


                                            <div class="row">
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

                                                    <!--<label class="focus-label">Nom</label>-->

                                                    @error('region')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label>Country<span class="text-danger">*</span></label>
                                                    <select class="form-control @error('country') is-invalid @enderror" name="country" id="country">
                                                    </select>


                                                    @error('country')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                            <div class="text-right">
                                                <a class="forgot-link" href="{{ route('login') }}">Already have an account?</a>
                                            </div>
                                            <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Inscription</button>
                                            <!--<div class="login-or">
                                                <span class="or-line"></span>
                                                <span class="span-or">or</span>
                                            </div>
                                            <div class="row form-row social-login">
                                                <div class="col-6">
                                                    <a href="#" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f mr-1"></i> Login</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="#" class="btn btn-google btn-block"><i class="fab fa-google mr-1"></i> Login</a>
                                                </div>
                                            </div>-->
                                        </form>
                                        <!-- /Register Form -->
                                        
                                    </div>

                                    <!-- Download App-->
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                           <section class="section section-features">
                                                <div class="container-fluid">
                                                   <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="section-header">    
                                                               <!-- <h2 class="mt-2">DOWNLOAD <span style="color: #00A651;">AAH+</span> APP NOW!</h2>-->
                                                                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.</p>
                                                            </div>
                                                        </div>
                                                   </div>
                                                </div>
                                            </section>      
                                        </div>
                                    </div>
                                <!-- /Download App -->
                                </div>
                            </div>
                            <!-- /Register Content -->
                                
                        </div>

                        
                    </div>

                </div>

            </div>      
            <!-- /Page Content -->
   
            <!-- Footer -->
            @include('website.footer')
            <!-- /Footer -->
           
        </div>
        <!-- /Main Wrapper -->
      
        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery.min.js') }}"></script>

         <script type="text/javascript">
            $(document).ready(function() {

                $('#name').keyup(function(){
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
        
        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
        
    </body>
</html>