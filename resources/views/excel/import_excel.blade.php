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
        <form action="#" method="POST" enctype="multipart/form-data" id="upload-file">
            {{ csrf_field() }}
            <div class="intro-message">
                <h2>Import Excel File in Laravel</h2>
            </div>
            <div class="input-group input-group-excel">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFile">Select Excel File for Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="select_file" class="custom-file-input"  id="file" aria-describedby="inputGroupFile">
                    <label class="custom-file-label btn-import-excelbtn import-excel" for="file">Choisir un fichier</label>
                </div>
            </div>
            <input type="button" name="upload" value="Ajouter de nouvelles données" class="btn btn-primary btn-import-excel" id="upload-button">
            <input type="button" name="regenerate" value="Regénérer les données" class="btn btn-primary btn-import-excel" id="regenerate-button">
        </form>

            <br><br>
        <a href="{{ url('/documents/StudentRegister.xlsx') }}">Download Template Excel</a>

    </div>

    <br>

    <div class="col-md-12 table-wrapper">
        <div class="panelpanel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Customer Data</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Customer Name</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Postal Code</th>
                            <th>Country</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $row->CustomerName }}</td>
                                <td>{{ $row->Gender }}</td>
                                <td>{{ $row->Address }}</td>
                                <td>{{ $row->City }}</td>
                                <td>{{ $row->PostalCode }}</td>
                                <td>{{ $row->Country }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript">

    $(document).ready(function() {

        $('#upload-button').click(function(e) {
            e.preventDefault();
            $('form').attr('action', "{{ url('/import_excel/import') }}");
            $('form').submit();
        });

        $('#regenerate-button').click(function(e) {
            e.preventDefault();
            $('form').attr('action', "{{ url('/import_excel/regenerate') }}");
            $('form').submit();
        });

    })

</script>
@endsection
