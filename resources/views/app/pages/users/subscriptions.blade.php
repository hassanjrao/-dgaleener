@extends('layouts.modern')

@section('page-title', 'My Subscriptions')

@php
    $activeNav = 'home';
    $useAppShell = true;
@endphp

@section('content')
    <main class="modern-main-content modern-main-content--fluid">
        <div class="modern-data-cache-wrap">
            <header class="modern-page-header">
                <div>
                    <h1 class="modern-page-title">{{ __('My Subscriptions') }}</h1>
                    <p class="modern-page-subtitle">Mis suscripciones</p>
                </div>
            </header>

            <section class="data-cache-client-page">
                <div class="modern-info-card data-cache-client-panel">
                    <div class="modern-data-cache-table-shell data-cache-client-table-shell">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-datatable" id="subscriptions">
                                <thead>
                                    <tr>
                                        <th class="align-center">{{ __('Plan') }}</th>
                                        <th class="align-center">{{ __('Starts At') }}</th>
                                        <th class="align-center">{{ __('Ends At') }}</th>
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
            $('#subscriptions').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/me/subscriptions/datatables' },
                columns: [
                    { data: 'plan', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) {
                            return data.name + " ($" + parseFloat(Math.round(data.price * 100) / 100).toFixed(2) + ")";
                        }
                    },
                    { data: 'starts_at',
                        render: function ( data, type, row, meta ) { return new Date(data).toLocaleString(); }
                    },
                    { data: 'ends_at',
                        render: function ( data, type, row, meta ) { return new Date(data).toLocaleString(); }
                    }
                ]
            });
        });
    </script>
@endpush
