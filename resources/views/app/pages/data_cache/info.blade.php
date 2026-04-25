@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Introduction to Data Cache'}}
@stop
@section('styles')
    @parent
    <link href="{{ \App\Support\VersionedAsset::url('css/app/data_cache.css') }}" rel="stylesheet">

    <style>
        .info-page {
            background: #75a9ff; /* Old browsers */
            background: -moz-linear-gradient(top, #75a9ff, #cbe6b5); /* FF3.6-15 */
            background: -webkit-linear-gradient(top, #75a9ff, #cbe6b5); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, #75a9ff, #cbe6b5); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        }
    </style>
@stop
@section('content')
    @include('partials.header', ['title' => 'Data Cache', 'title_es' => 'Caché de datos', 'image_url' => '/images/iconimages/briefcase80.png', 'image_class' => 'header-title-icon-white'])
    <div class="row info-page">
        <div class="col-md-6">
            <p class="text-center" style="margin-bottom: 40px;">
                <img src="{{asset('/images/introduction/data_cache/banner.png')}}" alt="{{ env('APP_TITLE') }}" style="width: 90%;"></img>
            </p>
        </div>
        <div class="col-md-6">
            <h1 class="text-center" style="color: #fbd9a8;">Data Cache</h1>
            <ul style="color: #000; margin-right: 60px; font-size: 17.5px; list-style: none;">
                <li style="text-align: center;">A treasure in itself, packed full of pairs (900 Bio or 387 Chakra), radicals, origin, detailed descriptions of causes and effects.  Plus, alternative routes and complimentary pairs relation. All embedded deep within and locked away, to always be there for you.</li>
                <li style="text-align: center;">A stand alone island, just for you, to add your confidential client’s detailed intake information and notes. Your locked away secure data are great tools of resources for your eyes only. Resources enabling you  to research by case studies, past sessions, individual client’s log, patterns, symptoms, list by groups, client’s with familiarities.</li>
                <li style="text-align: center;">Data Cache is interact based to work with each of the body scan models. Just by tapping the + icon in the body scan, will automatically direct the pair to the client cache. Or the Data Cache can be used as a stand alone database.</li>
                <li style="text-align: center;">Our Data Cache is here to ease your task at hand. Assuring  you more free time and accompany you to use your gifts of healing.</li>
            </ul>
            <p class="text-center" style="margin: 20px 0; margin-top: 50px; color: #72a445; font-size: 24px;">Tap to start your very own Data Cache.</p>
            <p class="text-center">
                <a href="{{ empty(Auth::user()) ? '/register' : '/data_cache' }}">
                    <img src="{{asset('/images/introduction/data_cache/button.png')}}" alt="{{ env('APP_TITLE') }}" style="width: 130px; margin: 0 10px;"></img>
                </a>
            </p>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
