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
                        <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
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
                        <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
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
                        <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707m12.728 12.728L5.757 5.757" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
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
                        <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
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
                        <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
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
