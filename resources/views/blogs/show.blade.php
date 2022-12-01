@extends('layouts.app')

@section('content')
    <div class="container">
        <form onsubmit="confirm('{{__('Delete blog?')}}')" class="float-right" method="post" action="{{ route('blogs.destroy', $blog->id) }}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" onclick="">{{ __('Delete') }}</button>
        </form>
        <div class="row mb-3">
            <h3 class="mr-5">{{ $blogTitle }}</h3>
            <a class="btn btn-primary" href="{{ $url }}">{{ __('Go to source') }}</a>
        </div>

        <div class="mb-2">
            @foreach($articles as $article)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->get_title() }}</h5>
                        <div class="card-text">{!! $article->get_content() !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
