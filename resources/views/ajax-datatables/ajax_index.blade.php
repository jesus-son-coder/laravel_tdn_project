@extends('layouts/app')

@section('content')
<div class="container">

    <h3 align="center">Laravel 5.8 - DataTables Server Side Processing using Ajax</h3>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="user_table">
            <thead>
                <tr>
                    <th width="10%">Image</th>
                    <th width="35%">First Name</th>
                    <th width="35%">Last Name</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
        </table>
    </div>

</div>


<script type="text/javascript">

    $(document).ready(function() {

        $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('ajax-datatables.index') }}",
            },
            columns: [
                {
                    data: 'image',
                    name: 'image',
                    render: function(data, type, full, meta) {
                        return "<img src={{ URL::to('/') }}/images/" + data + " width='70' class='img-thumbnail' />";
                    },
                    orderable: false
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });

    })

</script>
@endsection
