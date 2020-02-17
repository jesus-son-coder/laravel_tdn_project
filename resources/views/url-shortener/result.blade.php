@extends('url-shortener/layout')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            <h1>URL Shortener Application</h1>
        </div>
        <div class="col-12">
            <p class="url-title-level-3">Find your Shortened Url below :</p>
            <span class="url-result"><a href="{{ config('app.url') }}/tdn/url-shortener/{{ $shortened }}">
                {{ config('app.url') }}/tdn/url-shortener/{{ $shortened }}
            </a></span>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <div class="text-center col-xs-12">
        Company Corp - copyright 2020
    </div>
@stop
