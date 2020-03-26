@extends('layouts/app')

@section('content')

{{-- Start Add Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Employee file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="{{ action('EmployeeController@store') }}" method="POST" >

            {{ csrf_field() }}
            <div class="modal-body">

                <div class="form-group">
                    <label> First Name </label>
                    <input type="text" name="fname" class="form-control" placeholder="Enter First Name">
                </div>

                <div class="form-group">
                    <label> Last Name </label>
                    <input type="text" name="lname" class="form-control" placeholder="Enter Last Name">
                </div>

                <div class="form-group">
                    <label> Address </label>
                    <input type="text" name="address" class="form-control" placeholder="Enter Address">
                </div>

                <div class="form-group">
                    <label> Mobile </label>
                    <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile Number">
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Data</button>
            </div>

        </form>
        </div> <!-- fin modal-content -->
    </div> <!-- fin modal-dialog -->
</div> <!-- fin Add modal -->



{{-- Start Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Manage Employee file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="/employee" method="POST" id="editForm">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="modal-body">

                <div class="form-group">
                    <label> First Name </label>
                    <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name">
                </div>

                <div class="form-group">
                    <label> Last Name </label>
                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name">
                </div>

                <div class="form-group">
                    <label> Address </label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address">
                </div>

                <div class="form-group">
                    <label> Mobile </label>
                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Mobile Number">
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>

        </form>
        </div> <!-- fin modal-content -->
    </div> <!-- fin modal-dialog -->
</div> <!-- fin Edit modal -->


<div class="container">

    <h1>Laravel CRUD : with Bootstrap Modal [Pop up Modal]</h1>

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(\Session::has('success'))
            <div class="alert alert-success">
                <p class="p-alert-success">{{ \Session::get('success') }}</p>
            </div>
        @endif

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add Data
        </button>

        <br><br>

        <table id="datatable" class="table table-bordered table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Mobile No</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Mobile No</th>
                    <th scope="col">Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($emps as $empdata)
                    <tr>
                        <td>{{ $empdata->id }}</td>
                        <td>{{ $empdata->fname }}</td>
                        <td>{{ $empdata->lname }}</td>
                        <td>{{ $empdata->address }}</td>
                        <td>{{ $empdata->mobile }}</td>
                        <td>
                            <a href="#" class="btn btn-success edit">EDIT</a>
                        <a href="/employee_delete/{{ $empdata->id }}" class="btn btn-danger">DELETE</a>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
</div>



<script type="text/javascript">

    $(document).ready(function() {

        var table = $('#datatable').DataTable();

        // Start Edit Record :
        table.on('click', '.edit', function() {

            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#fname').val(data[1]);
            $('#lname').val(data[2]);
            $('#address').val(data[3]);
            $('#mobile').val(data[4]);

            $('#editForm').attr('action','/employee/'+data[0]);
            $('#editModal').modal('show');

        })
        // end Edit Record

    })

</script>
@endsection
