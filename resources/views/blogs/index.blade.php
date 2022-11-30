@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-2">
        <a class="btn btn-primary" href="{{ route('blogs.create') }}">{{ __('Add blog') }}</a>
    </div>

    <div class="card-columns">
        @foreach($latestBlogs as $id => $latestBlog)
            <div>
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ $latestBlog->get_title() }}</h5>
                        <div class="card-text">{!! $latestBlog->get_content() !!}</div>
                        <hr>
                        <a href="{{ route('blogs.show', ['blog' => $id]) }}">{{ __('More by') }} {{ $blogsNames[$id] }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
