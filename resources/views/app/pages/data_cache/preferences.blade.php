@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache - Preferences'}}
@stop
@section('styles')
    @parent
    <link href="{{ \App\Support\VersionedAsset::url('css/app/data_cache.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Data Cache', 'title_es' => 'Caché de datos', 'menu' => 'data_cache'])
    <div class="container" style="margin-top: 20px; margin-bottom: 110px;">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 style="margin-top: 0;">Preferences</h4>
                        <p style="margin-bottom: 8px;">
                            Update your practice details, billing information, and logos from this page.
                        </p>
                        <p style="margin-bottom: 20px; color: #4a5568;">
                            Actualice desde esta página los datos de su consulta, la información de facturación y los logotipos.
                        </p>
                        @include('app.pages.data_cache.partials.preferences_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    @include('app.pages.data_cache.modals.js.preferences')
@stop
