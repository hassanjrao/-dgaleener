@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache - Help'}}
@stop
@section('styles')
    @parent
    <link href="{{ \App\Support\VersionedAsset::url('css/app/data_cache.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Data Cache', 'title_es' => 'Caché de datos', 'image_url' => '/images/iconimages/briefcase80.png', 'image_class' => 'header-title-icon-white', 'menu' => 'data_cache'])
    <div class="container" style="margin-top: 20px; margin-bottom: 110px;">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                @include('app.pages.data_cache.partials.help_content')
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
