@extends('layouts/app')

@section('content')
<div class="container">


        @if(session('errors'))
        <div class="col-md-8 notification-bloc notification-bloc-error">
            <ul>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session('success'))
        <div class="col-md-8 notification-bloc notification-bloc-success">
            {{ session('success') }}
        </div>
        @endif

    <div class="col-md-8 file-upload-wrapper">
        <form action="{{ url('/import') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="intro-message">
                <h2>Select excel file to upload</h2>
            </div>
            <div class="input-group input-group-excel">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFile">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input"  id="file" aria-describedby="inputGroupFile">
                    <label class="custom-file-label btn-import-excelbtn import-excel" for="file">Choisir un fichier</label>
                </div>
            </div>
            <input type="submit" value="Upload Excel File" class="btn btn-primary btn-import-excel">
            <br><br>
        <a href="{{ url('/documents/StudentRegister.xlsx') }}">Download Template Excel</a>
        </form>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function() {



    })

</script>
@endsection
