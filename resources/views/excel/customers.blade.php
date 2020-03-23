@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customers</div>

                <div class="card-body">

                    <a href="{{ route('export') }}" class="btn btn-primary btn-export-excel">Export to Excel</a>
                    <br>
                    <hr>

                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-excel">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="import_file" class="custom-file-input"  id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label
                                btn-import-excelbtn-import-excel" for="inputGroupFile01">Choisir un fichier</label>
                            </div>
                        </div>
                        <input type="submit" value="Import from Excel" class="btn btn-primary btn-import-excel">
                    </form>

                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No user found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
