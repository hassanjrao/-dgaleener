@extends('layouts.admin')
@section('page-title')
    {{ __('Anew Avenue Biomagnestim | Administrator - Orders') }}
@stop
@section('styles')
    @parent
@stop
@section('content')
    @csrf
    <div id="content-container">
        <h2>
            {{ __('Orders') }} 
            <button class="editor-new fa fa-plus" data-toggle="modal" data-target="#orderModal" data-title="New Order"></button>
        </h2><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="orders" >
                <thead>
                    <tr>
                        <th class="align-center">{{ __('ID') }}</th>
                        <th class="align-left">{{ __("Buyer's Name") }}</th>
                        <th class="align-left">{{ __('Product Name') }}</th>
                        <th class="align-left">{{ __('Description') }}</th>
                        <th class="align-left">{{ __('Unit Price') }}</th>
                        <th class="align-left">{{ __('Quantity') }}</th>
                        <th class="align-left">{{ __('Cost') }}</th>
                        <th class="align-left">{{ __('Paid') }}</th>
                        <th class="align-left">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            $('#orders').on('click', 'button.editor-remove', function (e) {
                e.preventDefault();

                $order_id = $(this).attr('data-id')

                var confirmDialog = confirm("Are you sure you wish to delete this order?");
                if (confirmDialog == true) {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/orders/'+$order_id,
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                }
            } );

            $('#orders').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/orders/datatables' },
                columns: [
                    { data: 'id', name: 'id', className: 'dt-body-center' },
                    {   data: 'user', name: 'user', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) {
                            return data.name;
                        } 
                    },
                    {   data: 'product', name: 'product', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) {
                            return data.name;
                        } 
                    },
                    { data: 'description', name: 'description' },
                    {   data: 'product', name: 'product', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) {
                            return '$' + data.unit_price;
                        } 
                    },
                    { data: 'quantity', name: 'quantity' },
                    { data: 'cost', name: 'cost', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) {
                            return '$' + data;
                        }
                    },
                    { data: 'paid', name: 'paid', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) {
                            if (data == true) {
                                return 'Yes';
                            } else {
                                return 'No';
                            }
                        }
                    },
                    {
                        data: 'id',
                        className: "dt-body-center",
                        orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) {
                            return '<button class="editor-remove fa fa-trash-o fa-2x" style="color: red;" data-id="'+data+'"></button>';
                        }
                    }
                ]
            });
        });
    </script>
@stop
