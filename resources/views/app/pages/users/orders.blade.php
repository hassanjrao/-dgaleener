@extends('layouts.modern')

@section('page-title', 'My Orders')

@php
    $activeNav = 'home';
    $useAppShell = true;
@endphp

@section('content')
    <main class="modern-main-content modern-main-content--fluid">
        <div class="modern-data-cache-wrap">
            <header class="modern-page-header">
                <div>
                    <h1 class="modern-page-title">{{ __('My Orders') }}</h1>
                    <p class="modern-page-subtitle">Mis pedidos</p>
                </div>
            </header>

            <section class="data-cache-client-page">
                <div class="modern-info-card data-cache-client-panel">
                    <div class="modern-data-cache-table-shell data-cache-client-table-shell">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-datatable" id="orders">
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
                </div>
            </section>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#orders').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/me/orders/datatables' },
                columns: [
                    { data: 'product', name: 'product', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) { return data.name; }
                    },
                    { data: 'description', name: 'description' },
                    { data: 'product', name: 'product', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) { return '$' + data.unit_price; }
                    },
                    { data: 'quantity', name: 'quantity' },
                    { data: 'cost', name: 'cost', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) { return '$' + data; }
                    },
                    { data: 'paid', name: 'paid', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) { return data == true ? 'Yes' : 'No'; }
                    },
                    { data: 'id', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) {
                            content = '';
                            $.ajax({
                                url: "{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/orders/"+data,
                                type: 'GET', dataType: 'JSON', async: false,
                                success: function (order) {
                                    if (!order.paid) { content = '<a href="/orders/'+order.id+'/payment">Pay</a>'; }
                                }
                            });
                            return content;
                        }
                    }
                ]
            });
        });
    </script>
@endpush
