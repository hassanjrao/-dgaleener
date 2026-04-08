@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache - Preferences'}}
@stop
@section('content')
    @include('partials.header', ['title' => 'Data Cache', 'menu' => 'data_cache'])
    <div class="container">
    </div>
    @include('app.pages.data_cache.modals.preferences')
@endsection
@section('javascripts')
    @parent
    @include('app.pages.data_cache.modals.js.preferences')
@stop
