@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Introduction to Chakra Body Scan'}}
@stop
@section('content')
    @include('partials.header', ['title' => 'Chakra Body Scan'])
    <div class="row info-page">
        <div class="col-md-3">
            @include('app.pages.chakrascan.partials.info_menu')
        </div>
        <div class="col-md-9">
            @include('app.pages.chakrascan.partials.info_main')
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
