@extends('layouts/app')

@section('content')
<div class="container">

    <h3 align="center">Laravel 5.8 - DataTables Server Side Processing using Ajax</h3>
    <br>

    <div align="right">
        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
    </div>
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

{{-- La Modal de Création ou d'Edition --}}
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une nouvelle entrée</h4>
                <button  type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="POST" id="creation_form" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-6">
                            First Name :
                        </label>
                        <div class="col-md-10">
                            <input type="text" name="first_name" id="first_name" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-6">
                            Last Name :
                        </label>
                        <div class="col-md-10">
                            <input type="text" name="last_name" id="last_name" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-6">
                            Select Profile Image :
                        </label>
                        <div class="col-md-10">
                            <input type="file" name="image" id="image" class="form-control" />
                            <div id="store_image"></div>
                        </div>
                    </div>

                    <div class="form-group" align="center">
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Ajouter" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- La Modal de confirmation de Suppression --}}
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation de suppression</h4>
                <button  type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p align="center" style="margin:0">Êtes-vous sûrs de vouloir supprimer cette fiche ?</p>
            </div>
            <div class="modal-footer">
                <button  type="button" name="ok_button" id="ok_button" class="btn btn-danger" >OK</button>
                <button  type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
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

        $('#create_record').click(function(){
            $('#formModal').modal('show');
        } );

        $('#creation_form').on('submit', function(event) {
            event.preventDefault();
            if($('#action_button').val() == 'Ajouter') {
                $.ajax({
                    url: "{{ route('ajax-datatables.store') }}",
                    method:"POST",
                    data: new FormData(this),
                    contentType: false,
                    cache:false,
                    processData: false,
                    dataType:"json",
                    success:function(data){
                        var html = '';
                        if(data.errors) { // console.log(data.errors);
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#creation_form')[0].reset();
                            $('#user_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                })
            }

            if($('#action_button').val() == 'Modifier') {
                var id = $(this).attr('id');
                $.ajax({
                    url:"/ajax-datatables/" + id + "/update",
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType:"json",
                    success:function(data) {
                        var html = '';
                        if(data.errors) {
                            html = '<div class="alert alert-danger">';
                                for(var count = 0; count < data.errors.length; count++) {
                                    html += '<p>' + data.errors[count] + '</p>';
                                }
                                html += '</div>';
                        }
                        if(data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#creation_form')[0].reset();
                            $('#store_image').html('');
                            $('#user_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                })
            }
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"/ajax-datatables/" + id + "/edit",
                dataType:"json",
                success:function(html) {
                    $('#first_name').val(html.data.first_name);
                    $('#last_name').val(html.data.last_name);

                    $('#store_image').html("<img src={{ URL::to('/') }}/images/" + html.data.image + " width='70' class='img-thumbnail' />");
                    $('#store_image').append("<input type='hidden' name='hidden_image' value='" + html.data.image + "' />");

                    $('#hidden_id').val(html.data.id);

                    $('.modal-title').text("Modifier une Fiche");
                    $('#action_button').val("Modifier");
                    $('#action').val("Modifier");
                    $('#formModal').modal('show');
                }
            })
        });

        var user_id;

        $(document).on('click', '.delete', function() {
            user_id = $(this).attr('id');
            $('#ok_button').text('OK');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(e) {
            e.preventDefault();
            $('#ok_button').text('Deleting...');
            setTimeout(function(){
                $.ajax({
                    url:"/ajax-datatables/delete/" + user_id,
                    /*
                    beforeSend:function(){
                    }, */
                    success:function(data){
                        $('#confirmModal').modal('hide');
                        $('#user_table').DataTable().ajax.reload();
                    }
                });
            }, 3000);
        });

    });

</script>
@endsection
