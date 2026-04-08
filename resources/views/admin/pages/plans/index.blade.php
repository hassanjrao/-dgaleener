@extends('layouts.admin')
@section('page-title')
    {{ __('Anew Avenue Biomagnestim | Administrator - Plans') }}
@stop
@section('styles')
    @parent
@stop
@section('content')
    @csrf
    <div id="content-container">
        <h2>
            {{ __('Plans') }} 
            <button class="editor-new fa fa-plus" data-toggle="modal" data-target="#planModal" data-title="New Plan"></button>
        </h2><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="plans" >
                <thead>
                    <tr>
                        <th class="align-center">{{ __('ID') }}</th>
                        <th class="align-left">{{ __('Name') }}</th>
                        <th class="align-left">{{ __('Description') }}</th>
                        <th class="align-left">{{ __('Category') }}</th>
                        <th class="align-left">{{ __('Price') }}</th>
                        <th class="align-left">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="planModal" tabindex="-1" role="dialog" aria-labelledby="planModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="planModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
            <div class="modal-body">
                <input type="hidden" id="plan_id" name="plan_id">
                <input type="hidden" id="user_id" name="user_id">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category" name="category" placeholder="Category" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Unit Price" min="0" required>
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
            $('#plans').on('click', 'button.editor-new', function (e) {
                e.preventDefault();
            } );

            // Edit record
            $('#planModal').on('show.bs.modal', function (e) {
                var trigger = $(e.relatedTarget)
                $('#planModalTitle').text(trigger.data('title'));

                // Retrieve plan 
                $plan_id = trigger.data('id')

                if ($plan_id != undefined) {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/plans/'+$plan_id,
                        type: 'GET',
                        success: function(result) {
                            $('#plan_id').val(result.id);
                            $('#name').val(result.name);
                            $('#description').val(result.description);
                            $('#category').val(result.category);
                            $('#price').val(result.price);
                        }
                    });
                }
            })

            // Save a record
            $(".save-btn").click(function(e){
                e.preventDefault();

                var $plan_id = $('#plan_id').val()

                var data = {
                    name: $("#name").val(),
                    description: $("#description").val(),
                    category: $("#category").val(),
                    price: $("#price").val(),
                };

                if ($plan_id != undefined && $plan_id != '') {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/plans/'+$plan_id,
                        type: 'PUT',
                        data: data,
                        dataType: 'JSON',
                        success: function (data) { 
                            location.reload();
                        }
                    });
                } else {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/plans',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                        success: function (data) { 
                            location.reload();
                        }
                    });
                }
            });
        
            // Delete a record
            $('#plans').on('click', 'button.editor-remove', function (e) {
                e.preventDefault();

                $plan_id = $(this).attr('data-id')

                var confirmDialog = confirm("Are you sure you wish to delete this plan?");
                if (confirmDialog == true) {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/plans/'+$plan_id,
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                }
            } );

            $('#plans').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/plans/datatables' },
                columns: [
                    { data: 'id', name: 'id', className: 'dt-body-center' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'category', name: 'category' },
                    { data: 'price', name: 'price' },
                    {
                        data: 'id',
                        className: "dt-body-center",
                        "orderable": false,
                        render: function ( data, type, row, meta ) {
                            return '<button class="editor-remove fa fa-trash-o fa-2x" style="color: red;" data-id="'+data+'"></button><button class="editor-edit fa fa-edit fa-2x" data-toggle="modal" data-target="#planModal" data-title="Edit Plan" data-id="'+data+'"></button><a href="/admin/plans/'+data+'/subscribers"><button class="editor-edit fa fa-eye fa-2x"></button></a>';
                        }
                    }
                ]
            });
        });
    </script>
@stop
