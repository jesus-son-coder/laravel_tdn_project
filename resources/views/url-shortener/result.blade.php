@extends('url-shortener/layout')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            <h1>URL Shortener Application</h1>
        </div>
        <div class="col-12">
            {{-- Méthode #1 : en utilisant le helper "env" :--}}
            <span class="url-result"><a href="{{ env('APP_URL') }}/{{ $shortened }}">
                {{ env('APP_URL') }}/{{ $shortened }}
            </a></span>
            <br><br>
            {{-- Méthode #2  en utilisant le helper "config" --}}
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
