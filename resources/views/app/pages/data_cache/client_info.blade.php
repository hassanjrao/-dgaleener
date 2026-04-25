@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache - Client Info'}}
@stop
@section('styles')
    @parent
    <link href="{{ \App\Support\VersionedAsset::url('css/app/data_cache.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Data Cache', 'title_es' => 'Caché de datos', 'image_url' => '/images/iconimages/briefcase80.png', 'image_class' => 'header-title-icon-white', 'menu' => 'data_cache', 'section' => 'client_info'])
    <div id="content-container" class="data-cache-client-page">
        <div class="data-cache-client-panel">
            <div class="data-cache-client-toolbar">
                <div class="data-cache-client-heading">
                    <h2 class="data-cache-bilingual-heading">
                        <span class="data-cache-label-en">{{ __('Client Info') }}</span>
                        <span class="data-cache-label-es">Información del cliente</span>
                    </h2>
                </div>
                <button class="btn data-cache-create-btn" data-toggle="modal" data-target="#clientInfoModal" data-title="New Client">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span class="data-cache-bilingual-button">
                        <span class="data-cache-label-en">{{ __('Create New Client') }}</span>
                        <span class="data-cache-label-es">Crear nuevo cliente</span>
                    </span>
                </button>
            </div>

            <div class="data-cache-client-table-shell">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-datatable" id="clients">
                        <thead>
                            <tr>
                                <th class="align-center">{{ __('ID') }}</th>
                                <th class="align-center">{{ __('First Name') }}</th>
                                <th class="align-center">{{ __('Last Name') }}</th>
                                <th class="align-center">{{ __('Email') }}</th>
                                <th class="align-center">{{ __('Address') }}</th>
                                <th class="align-center">{{ __('Phone No.') }}</th>
                                <th class="align-center">{{ __('Date of Birth') }}</th>
                                <th class="align-center">{{ __('Age') }}</th>
                                <th class="align-center">{{ __('Emergency Details') }}</th>
                                <th class="align-center">{{ __('Session Details') }}</th>
                                <th class="align-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('app.pages.data_cache.modals.client_info')
@endsection
@section('javascripts')
    @parent

    @include('app.pages.data_cache.modals.js.client_info')
@stop
