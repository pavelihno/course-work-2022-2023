@extends('layouts.app')

@section('content')

<div class="container">
    <form method="post" action="{{ route('blogs.store') }}">
        @csrf
        <div class="form-group">
            <label for="url">{{ __('URL') }}</label>
            <input class="form-control" type="text" name="url" id="url">

            @error('url')
            <span class="text-danger">{{ __($message) }}</span>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">{{ __('Add') }}</button>
    </form>
</div>

@endsection
