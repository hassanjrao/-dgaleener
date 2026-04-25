@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache'}}
@stop
@section('styles')
    @parent
    <link href="{{ \App\Support\VersionedAsset::url('css/app/data_cache.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Data Cache', 'title_es' => 'Caché de datos'])
    <div class="container data-cache">
        <div class="row justify-content-center text-center" style="margin-bottom: 20px;">
            <div class="row justify-content-center signup-form-row">
                <a href="{{ route('app.bodyscan') }}">
                    <div class="data-cache-section">
                        <img src="{{asset('/images/data_cache/bio.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                        <div class="data-cache-bilingual-label text-center">
                            <span class="data-cache-label-en">Bio</span>
                            <span class="data-cache-label-es">Bio</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center text-center" style="margin-bottom: 20px;">
            <div class="row justify-content-center signup-form-row text-center data-cache-secondary-row">
                <a href="/data_cache/client_info" class="data-cache-link-client">
                    <div class="data-cache-section adjust">
                        <img src="{{asset('/images/data_cache/client.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                        <div class="data-cache-bilingual-label text-center">
                            <span class="data-cache-label-en">Client Info</span>
                            <span class="data-cache-label-es">Información del cliente</span>
                        </div>
                    </div>
                </a>
                <a href="{{ route('app.chakrascan') }}" class="data-cache-link-chakra">
                    <div class="data-cache-section">
                        <img src="{{asset('/images/data_cache/chakra.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                        <div class="data-cache-bilingual-label text-center">
                            <span class="data-cache-label-en">Chakra</span>
                            <span class="data-cache-label-es">Chakra</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center text-center" style="margin-bottom: 50px;">
            <div class="row justify-content-center signup-form-row">
                <div class="data-cache-section" data-toggle="modal" data-target="#preferencesModal">
                    <img src="{{asset('/images/data_cache/preferences.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                    <div class="data-cache-bilingual-label text-center">
                        <span class="data-cache-label-en">Preferences</span>
                        <span class="data-cache-label-es">Preferencias</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="row justify-content-center signup-form-row">
                <a href="{{ url('/data_cache/help') }}">
                    <div class="data-cache-section">
                        <img src="{{asset('/images/data_cache/help.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                        <div class="data-cache-bilingual-label text-center">
                            <span class="data-cache-label-en">Help</span>
                            <span class="data-cache-label-es">Ayuda</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @include('app.pages.data_cache.modals.client_info')
    @include('app.pages.data_cache.modals.preferences')
@endsection
@section('javascripts')
    @parent
    @include('app.pages.data_cache.modals.js.preferences')
@stop
