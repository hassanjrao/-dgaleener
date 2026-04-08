@extends('layouts.admin')
@section('page-title')
    {{ __('ANEW - Administrator - Products') }}
@stop
@section('styles')
    @parent
@stop
@section('content')
    @csrf
    <div id="content-container">
        <h2>
            {{ __('Products') }} 
            <button class="editor-new fa fa-plus" data-toggle="modal" data-target="#productModal" data-title="New Product"></button>
        </h2><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="products" >
                <thead>
                    <tr>
                        <th class="align-center">{{ __('ID') }}</th>
                        <th class="align-left">{{ __('Name') }}</th>
                        <th class="align-left">{{ __('Description') }}</th>
                        <th class="align-left">{{ __('Category') }}</th>
                        <th class="align-left">{{ __('Unit Price') }}</th>
                        <th class="align-left">{{ __('Size') }}</th>
                        <th class="align-left">{{ __('Weight') }}</th>
                        <th class="align-left">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
            <div class="modal-body">
                <input type="hidden" id="product_id" name="product_id">
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
                    <label for="unit_price">Unit Price</label>
                    <input type="number" class="form-control" id="unit_price" name="unit_price" placeholder="Unit Price" min="0" required>
                </div>
                <div class="form-group">
                    <label for="size">Size</label>
                    <input type="text" class="form-control" id="size" name="size" placeholder="Size" required>
                </div>
                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight" required>
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
            $('#products').on('click', 'button.editor-new', function (e) {
                e.preventDefault();
            } );

            // Edit record
            $('#productModal').on('show.bs.modal', function (e) {
                var trigger = $(e.relatedTarget)
                $('#productModalTitle').text(trigger.data('title'));

                // Retrieve product 
                $product_id = trigger.data('id')

                if ($product_id != undefined) {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/products/'+$product_id,
                        type: 'GET',
                        success: function(result) {
                            $('#product_id').val(result.id);
                            $('#user_id').val(result.user_id);
                            $('#name').val(result.name);
                            $('#description').val(result.description);
                            $('#category').val(result.category);
                            $('#unit_price').val(result.unit_price);
                            $('#size').val(result.size);
                            $('#weight').val(result.weight);
                        }
                    });
                }
            })

            // Save a record
            $(".save-btn").click(function(e){
                e.preventDefault();

                var $product_id = $('#product_id').val()

                var data = {
                    user_id: $('#user_id').val(),
                    name: $("#name").val(),
                    description: $("#description").val(),
                    category: $("#category").val(),
                    unit_price: $("#unit_price").val(),
                    size: $("#size").val(),
                    weight: $("#weight").val()
                };

                if ($product_id != undefined && $product_id != '') {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/products/'+$product_id,
                        type: 'PUT',
                        data: data,
                        dataType: 'JSON',
                        success: function (data) { 
                            location.reload();
                        }
                    });
                } else {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/products',
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
            $('#products').on('click', 'button.editor-remove', function (e) {
                e.preventDefault();

                $product_id = $(this).attr('data-id')

                var confirmDialog = confirm("Are you sure you wish to delete this product?");
                if (confirmDialog == true) {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/products/'+$product_id,
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                }
            } );

            $('#products').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/products/datatables' },
                columns: [
                    { data: 'id', name: 'id', className: 'dt-body-center' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'category', name: 'category' },
                    { data: 'unit_price', name: 'unit_price' },
                    { data: 'size', name: 'size' },
                    { data: 'weight', name: 'weight' },
                    {
                        data: 'id',
                        className: "dt-body-center",
                        "orderable": false,
                        render: function ( data, type, row, meta ) {
                            return '<button class="editor-remove fa fa-trash-o fa-2x" style="color: red;" data-id="'+data+'"></button><button class="editor-edit fa fa-edit fa-2x" data-toggle="modal" data-target="#productModal" data-title="Edit Product" data-id="'+data+'"></button>';
                        }
                    }
                ]
            });
        });
    </script>
@stop
