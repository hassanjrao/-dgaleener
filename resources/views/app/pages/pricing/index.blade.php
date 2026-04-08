@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Pricing'}}
@stop
@section('styles')
    @parent

    <link rel="stylesheet" href="css/app/pricing.css">
@stop
@section('content')
    @include('partials.header', ['title' => ''])
    <div class="container">
        @include('partials.pricing')
    </div>
@endsection
@section('javascripts')
    @parent
@stop
