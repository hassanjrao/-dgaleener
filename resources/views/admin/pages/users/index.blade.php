@extends('layouts.admin')
@section('page-title')
    {{ __('Anew Avenue Biomagnestim | Administrator - Users') }}
@stop
@section('styles')
    @parent
@stop
@section('content')
    @csrf
    <div id="content-container">
        <h2>{{ __('Users') }}</h2><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="users" >
                <thead>
                    <tr>
                        <th class="align-center">{{ __('ID') }}</th>
                        <th class="align-left">{{ __('Name') }}</th>
                        <th class="align-left">{{ __('Email') }}</th>
                        <th class="align-left">{{ __('Type') }}</th>
                        <th class="align-left">{{ __('Business') }}</th>
                        <th class="align-left">{{ __('Location') }}</th>
                        <th class="align-left">{{ __('Privacy') }}</th>
                        <th class="align-left">{{ __('Email Verified') }}</th>
                        <th class="align-left">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
            <div class="modal-body">
                <input type="hidden" id="user_id" name="user_id">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" id="type" name="type" required>
                    <option value="null"></option>
                    @foreach(\Spatie\Permission\Models\Role::orderBy('name', 'asc')->get() as $role)
                        <option value="{{$role->name}}">{{ucfirst($role->name)}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="business">Business</label>
                    <input type="text" class="form-control" id="business" name="business" placeholder="Business">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="location" class="form-control" id="location" name="location" placeholder="Location">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="privacy" name="privacy">
                    <label class="form-check-label" for="privacy">Privacy</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-btn">Save</button>
            </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            // New record
            $('#users').on('click', 'button.editor-new', function (e) {
                e.preventDefault();
            } );

            // Edit record
            $('#userModal').on('show.bs.modal', function (e) {
                var trigger = $(e.relatedTarget)
                $('#userModalTitle').text(trigger.data('title'));

                // Retrieve user 
                $user_id = trigger.data('id')
                $.ajax({
                    url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/'+$user_id,
                    type: 'GET',
                    success: function(result) {
                        $('#user_id').val(result.id);
                        $('#name').val(result.name);
                        $('#email').val(result.email);
                        type = null;
                        if (result.type != null) {
                            type = result.type.toLowerCase();
                        }
                        $('#type').val(type);
                        $('#business').val(result.business);
                        $('#location').val(result.location);

                        if (result.privacy == 1) {
                            $('#privacy').prop('checked', true);
                        } else {
                            $('#privacy').prop('checked', false);
                        }
                    }
                });
            })

            // Save a record
            $(".save-btn").click(function(e){
                e.preventDefault();

                var $user_id = $('#user_id').val()

                var privacy;
                if ($('#privacy').is(":checked")){
                    privacy = 1
                } else {
                    privacy = 0
                }

                var data = {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    type: $("#type").val(),
                    business: $("#business").val(),
                    location: $("#location").val(),
                    privacy: privacy
                };
                $.ajax({
                    url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/'+$user_id,
                    type: 'PUT',
                    data: data,
                    dataType: 'JSON',
                    success: function (data) { 
                        location.reload();
                    }
                }); 
            });
        
            // Delete a record
            $('#users').on('click', 'button.editor-remove', function (e) {
                e.preventDefault();

                $user_id = $(this).attr('data-id')

                var confirmDialog = confirm("Are you sure you wish to delete this user?");
                if (confirmDialog == true) {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/'+$user_id,
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                }
            } );

            $('#users').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/datatables' },
                columns: [
                    { data: 'id', name: 'id', className: 'dt-body-center' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'type', name: 'type', orderable: false, searchable: false },
                    { data: 'business', name: 'business' },
                    { data: 'location', name: 'location' },
                    { data: 'privacy', 
                        render: function ( data, type, row, meta ) {
                            if (data == 1) {
                                return 'Yes';
                            } else {
                                return 'No';
                            }
                        }
                    },
                    { data: 'email_verified_at', 
                        render: function ( data, type, row, meta ) {
                            if (data) {
                                return 'Yes';
                            } else {
                                return 'No';
                            }
                        }
                    },
                    {
                        data: 'id',
                        className: "dt-body-center",
                        "orderable": false,
                        render: function ( data, type, row, meta ) {
                            return '<button class="editor-remove fa fa-trash-o fa-2x" style="color: red;" data-id="'+data+'"></button><button class="editor-edit fa fa-edit fa-2x" data-toggle="modal" data-target="#userModal" data-title="Edit User" data-id="'+data+'"></button><a href="/admin/users/'+data+'/subscriptions"><button class="editor-edit fa fa-eye fa-2x"></button></a>';
                        }
                    }
                ]
            });
        });
    </script>
@stop
