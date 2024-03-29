<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AAH+ - My Pending Posts</title>
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
                                <li class="breadcrumb-item active" aria-current="page">My Pending Posts</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">My Pending Posts</h2>
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

                    <div class="row mb-5">
                        <div class="col">
                            <ul class="nav nav-tabs nav-tabs-solid">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{route('posts.index')}}">Active Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('doctor_pending_posts')}}">Pending Blog</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-primary btn-sm" href="{{route('posts.create')}}"><i class="fas fa-plus mr-1"></i> Add Blog</a>
                        </div>
                    </div>

                    <!-- Blog -->
                    <div class="row blog-grid-row">
                        @foreach ($posts as $post)
                        <div class="col-md-6 col-xl-4 col-sm-12">
                        
                            <!-- Blog Post -->
                            <div class="blog grid-blog">
                                <div class="blog-image">
                                    <a href="#"><img class="img-fluid" src="{{url('/storage/cover_images/'.$post->cover_image ) }}" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <ul class="entry-meta meta-item">
                                        <li>
                                            <div class="post-author">
                                                <a href="#"><img src="{{url('/storage/profile_images/'.auth()->user()->profile_picture ) }}" alt="Post Author"> <span>Dr. Ruby Perrin</span></a>
                                            </div>
                                        </li>
                                        <li><i class="far fa-clock"></i> {{ $post->created_at->format('m/d/Y') }}</li>
                                    </ul>
                                    <h3 class="blog-title"><a href="#">{{$post->title}}</a></h3>
                                    <p class="mb-0">{!! \Illuminate\Support\Str::limit($post->body, 50, '...') !!}</p>
                                </div>
                                <div class="row pt-3">
                                    <div class="col"><a href="{{ URL::to('posts/'.$post->id.'/edit') }}" class="text-success"><i class="far fa-edit"></i> Edit</a></div>
                                </div>
                            </div>
                            <!-- /Blog Post -->
                            
                                </div>
                                @endforeach
                            </div>

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

        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery.min.js') }}"></script>

        @include('inc.scripts')
        
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
