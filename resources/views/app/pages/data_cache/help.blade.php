@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache - Help'}}
@stop
@section('content')
    @include('partials.header', ['title' => 'Data Cache', 'menu' => 'data_cache'])
    <div class="container">
    </div>
@endsection
@section('javascripts')
    @parent
@stop
