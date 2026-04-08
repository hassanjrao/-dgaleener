@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Introduction to Biomagnetism Body Scan'}}
@stop
@section('content')
    @include('partials.header', ['title' => 'Biomagnetism Body Scan'])
    <div class="row info-page">
        <div class="col-md-3">
            @include('app.pages.bodyscan.partials.info_menu')
        </div>
        <div class="col-md-9">
            @include('app.pages.bodyscan.partials.info_main')
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
