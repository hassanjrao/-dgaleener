@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache - Client Info'}}
@stop
@section('styles')
    @parent
    <link href="{{ asset('css/app/data_cache.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Data Cache', 'menu' => 'data_cache', 'section' => 'client_info'])
    <div id="content-container" style="margin: 50px;">
        <div class="row col-md-12">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button class="btn btn-lg btn-primary fa fa-plus" data-toggle="modal" data-target="#clientInfoModal" data-title="New Client">&nbsp;&nbsp;{{ __('Create New Client') }}</button>
            </div>
        </div><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-datatable" id="clients">
                <thead>
                    <tr>
                        <th class="align-center">{{ __('ID') }}</th>
                        <th class="align-center">{{ __('First Name') }}</th>
                        <th class="align-center">{{ __('Last Name') }}</th>
                        <th class="align-center">{{ __('Email') }}</th>
                        <th class="align-center">{{ __('Address') }}</th>
                        <th class="align-center">{{ __('Phone No.') }}</th>
                        <th class="align-center">{{ __('Date of Birth') }}</th>
                        <th class="align-center">{{ __('Age') }}</th>
                        <th class="align-center">{{ __('Emergency Details') }}</th>
                        <th class="align-center">{{ __('Session Details') }}</th>
                        <th class="align-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('app.pages.data_cache.modals.client_info')
@endsection
@section('javascripts')
    @parent

    @include('app.pages.data_cache.modals.js.client_info')
@stop
