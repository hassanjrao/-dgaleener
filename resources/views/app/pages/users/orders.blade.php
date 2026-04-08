
@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Magnets'}}
@stop
@section('styles')
    @parent

    <link href="{{ asset('css/app/products.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => ''])

    <div id="content-container" style="margin: 50px;">
        <div class="row col-md-12">
            <div class="col-md-8">
                <h2>{{ __('My Orders') }}</h2>
            </div>
        </div><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="orders">
                <thead>
                    <tr>
                        <th class="align-center">{{ __('Product Name') }}</th>
                        <th class="align-center">{{ __('Description') }}</th>
                        <th class="align-center">{{ __('Unit Price') }}</th>
                        <th class="align-center">{{ __('Quantity') }}</th>
                        <th class="align-center">{{ __('Cost') }}</th>
                        <th class="align-center">{{ __('Paid') }}</th>
                        <th class="align-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent

    <script>
        $(document).ready(function() {
            $('#orders').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/me/orders/datatables' },
                columns: [
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
                    { data: 'id', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) {
                            content = ''

                            $.ajax({
                                url: "{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/orders/"+data,
                                type: 'GET',
                                dataType: 'JSON',
                                async: false,
                                success: function (order) {
                                    if (!order.paid) {
                                        content = '<a href="/orders/'+order.id+'/payment">Pay</a>';
                                    }
                                }
                            });

                            return content;
                        }
                    }
                ]
            });
        });
    </script>
@stop
