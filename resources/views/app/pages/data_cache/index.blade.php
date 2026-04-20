@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache'}}
@stop
@section('styles')
    @parent
    <link href="{{ asset('css/app/data_cache.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Data Cache'])
    <div class="container data-cache">
        <div class="row justify-content-center text-center" style="margin-bottom: 20px;">
            <div class="row justify-content-center signup-form-row">
                <a href="/data_cache/bio">
                    <div class="data-cache-section">
                        <img src="{{asset('/images/data_cache/bio.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                        <h3 class="text-center">BIO</h3>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center text-center" style="margin-bottom: 20px;">
            <div class="row justify-content-center signup-form-row text-center">
                <a href="/data_cache/client_info">
                    <div class="data-cache-section adjust">
                        <img src="{{asset('/images/data_cache/client.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                        <h3 class="text-center">CLIENT INFO</h3>
                    </div>
                </a>
                <a href="/data_cache/chakra">
                    <div class="data-cache-section">
                        <img src="{{asset('/images/data_cache/chakra.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                        <h3 class="text-center">CHAKRA</h3>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center text-center" style="margin-bottom: 50px;">
            <div class="row justify-content-center signup-form-row">
                <div class="data-cache-section" data-toggle="modal" data-target="#preferencesModal">
                    <img src="{{asset('/images/data_cache/preferences.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                    <h3 class="text-center">PREFERENCES</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="row justify-content-center signup-form-row">
                <a href="{{ url('/data_cache/help') }}">
                    <div class="data-cache-section">
                        <img src="{{asset('/images/data_cache/help.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                        <h3 class="text-center">HELP</h3>
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
