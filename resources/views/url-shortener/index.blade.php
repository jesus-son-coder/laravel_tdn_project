@extends('url-shortener/layout')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            <h1>URL Shortener Application</h1>
        </div>
        <div class="col-12">
            <form action="" method="POST">
                {{  csrf_field() }}
                {{-- Ou bien la méthode ci-dessous : --}}
                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}

                <input id="input-url" name="url" type="text" placeholder="Enter your original URL here..." value="{{ old('url') }}">
                {!! $errors->first('url','<p class="error-msg">:message</p>') !!}
                <br>
                <input id="input-url-submit" type="submit" value="Shorten URL">
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

