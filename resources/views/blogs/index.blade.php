@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-2">
        <a class="btn btn-primary" href="{{ route('blogs.create') }}">{{ __('Add blog') }}</a>
    </div>

    <div class="row">
        @foreach($latestBlogs as $id => $latestBlog)
            <div class="col-sm-6">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ $latestBlog->get_title() }}</h5>
                        <div class="card-text">{!! $latestBlog->get_content() !!}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
