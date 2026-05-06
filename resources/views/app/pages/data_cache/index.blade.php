@extends('layouts.modern')

@section('page-title', 'Data Cache')

@php
    $activeNav = 'data';
    $useAppShell = true;
@endphp

@push('head')
    <link href="{{ \App\Support\VersionedAsset::url('css/app/data_cache.css') }}" rel="stylesheet">
@endpush

@section('content')
    <main class="modern-main-content">
        <header class="modern-page-header">
            <div>
                <h1 class="modern-page-title">Data Cache</h1>
                <p class="modern-page-subtitle">Caché de datos</p>
            </div>
            <a href="{{ url('/data_cache/help') }}" class="modern-btn modern-btn--outline">
                <span aria-hidden="true">?</span> Help / Ayuda
            </a>
        </header>

        <div class="row g-4 modern-data-cache-grid">
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ route('app.bodyscan') }}" class="modern-data-cache-tile">
                    <div class="modern-data-cache-tile__icon">
                        <img src="{{ asset('/images/data_cache/bio.png') }}" alt="Bio">
                    </div>
                    <div class="modern-data-cache-tile__label">
                        <span class="data-cache-label-en">Bio</span>
                        <span class="data-cache-label-es">Bio</span>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ url('/data_cache/client_info') }}" class="modern-data-cache-tile">
                    <div class="modern-data-cache-tile__icon">
                        <img src="{{ asset('/images/data_cache/client.png') }}" alt="Client Info">
                    </div>
                    <div class="modern-data-cache-tile__label">
                        <span class="data-cache-label-en">Client Info</span>
                        <span class="data-cache-label-es">Información del cliente</span>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ route('app.chakrascan') }}" class="modern-data-cache-tile">
                    <div class="modern-data-cache-tile__icon">
                        <img src="{{ asset('/images/data_cache/chakra.png') }}" alt="Chakra">
                    </div>
                    <div class="modern-data-cache-tile__label">
                        <span class="data-cache-label-en">Chakra</span>
                        <span class="data-cache-label-es">Chakra</span>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <button type="button" class="modern-data-cache-tile modern-data-cache-tile--button"
                        data-toggle="modal" data-target="#preferencesModal">
                    <div class="modern-data-cache-tile__icon">
                        <img src="{{ asset('/images/data_cache/preferences.png') }}" alt="Preferences">
                    </div>
                    <div class="modern-data-cache-tile__label">
                        <span class="data-cache-label-en">Preferences</span>
                        <span class="data-cache-label-es">Preferencias</span>
                    </div>
                </button>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ url('/data_cache/help') }}" class="modern-data-cache-tile">
                    <div class="modern-data-cache-tile__icon">
                        <img src="{{ asset('/images/data_cache/help.png') }}" alt="Help">
                    </div>
                    <div class="modern-data-cache-tile__label">
                        <span class="data-cache-label-en">Help</span>
                        <span class="data-cache-label-es">Ayuda</span>
                    </div>
                </a>
            </div>
        </div>
    </main>

    @include('app.pages.data_cache.modals.client_info')
    @include('app.pages.data_cache.modals.preferences')
@endsection

@push('scripts')
    @include('app.pages.data_cache.modals.js.preferences')
@endpush
