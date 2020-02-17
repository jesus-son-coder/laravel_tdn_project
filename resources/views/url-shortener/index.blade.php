@extends('url-shortener/layout')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            <h1>URL Shortener Application</h1>
        </div>
        <div class="col-12">
            <form action="/" method="POST">
                {{  csrf_field() }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input id="input-url" type="text" placeholder="Enter your original URL here...">
                <br>
                <input type="submit" value="Shorten URL">
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <div class="text-center col-xs-12">
        Company Corp - copyright 2020
    </div>
@stop

