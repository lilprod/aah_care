<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AAH+ - My Signature</title>
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
    <body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
    
        <!-- Header -->
            @include('doctors.partials.header')
        <!-- /Header -->

        <!-- Breadcrumb -->
        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Signature</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">My Signature <span style="color: #26a9e166">+</span></h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                @include('doctors.partials.profile_side')
                <div class="col-md-7 col-lg-8 col-xl-9">

                <div class="row">
                    <div class="col-md-12">
                        @include('inc.messages')
                    </div>
                </div>

                <div class="doc-review review-listing">
                    @if($signature == '')
                        <div class="row mb-5">
                            <div class="col">
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary btn-sm" href="{{route('signatures.create')}}"><i class="fa fa-upload mr-1"></i> Upload Signature</a>
                            </div>
                        </div>
                    @endif


                    <!-- Blog -->
                    @if($signature == '')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span>
                                <b> No signature upload!</b> 
                            </span>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                    </div>
                    
                    @elseif(($signature != '') && ($signature->status == 0))
                    <div class="row blog-grid-row">
                        <div class="col-md-6 col-xl-4 col-sm-12">
                        
                            <!-- Blog Post -->
                            <div class="blog grid-blog">
                                <div class="blog-image">
                                    <a href="#"><img class="img-fluid" src="{{url('/storage/signatures/'.$signature->signature_file ) }}" alt="Signature Image"></a>
                                </div>
                                <div class="row pt-3">
                                    <div class="col"><a href="{{ URL::to('signatures/'.$signature->id.'/edit') }}" class="text-success"><i class="far fa-edit"></i> Edit</a></div>

                                    <div class="col text-right"><a data-toggle="modal" href="javascript:void(0);" class="text-danger" data-target="#delete_post" onclick="deleteData({{ $signature->id}})"><i class="far fa-trash-alt"></i> Delete</a></div>   
                       
                                 </div>
                            <!-- /Blog Post -->
                            
                                </div>
                            </div>

                        </div>

                        @endif

                        {{-- @else
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <span>
                                    <b> Your signature is pending approval </b> 
                                </span>
    
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif --}} 

                    </div>

                </div>
            </div>

        </div>
    </div>    
    <!-- Footer -->
        @include('website.footer')
    <!-- /Footer -->

       
    
</div>
<!-- /Main Wrapper -->

        
    <div class="modal fade" id="delete_post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
                <form action="" id="deleteForm" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="acc_title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <p id="acc_msg">Are you really to want to delete this Signature?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" type="submit" class="btn btn-success si_accept_confirm">Yes</a>
                            <button type="button" class="btn btn-danger si_accept_cancel" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      
        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery.min.js') }}"></script>

        @include('inc.scripts')

        <script>
         function deleteData(id)
         {
             var id = id;
             var url = '{{ route("signatures.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteForm").attr('action', url);
         }

         function formSubmit()
         {
             $("#deleteForm").submit();
         }
        </script>
        
        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
        
        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
        
    </body>
</html>


