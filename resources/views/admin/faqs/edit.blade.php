@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-7 col-auto">
            <h3 class="page-title">Faqs</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Faq</li>
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
    <div class="col-lg-8 offset-lg-2">
        <form method="POST" action="{{ route('faqs.update', $faq->id) }}" enctype="multipart/form-data">
        	{{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="row form-row">
                <div class="col-12 col-sm-12">
        			<div class="form-group">
        				<label>Question </label>
        				<textarea cols="30" rows="4" class="form-control" id="article-ckeditor" name="question">{{$faq->question}}</textarea>
        			</div>
                </div>

            
                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label>Answer</label>
                        <textarea cols="30" rows="4" class="form-control" id="article-ckeditor1" name="answer">{{$faq->answer}}</textarea>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>

        </form>
    </div>
</div>

@endsection