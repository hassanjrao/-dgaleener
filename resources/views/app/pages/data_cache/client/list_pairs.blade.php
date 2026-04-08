@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache - Client Info - List of Pairs'}}
@stop
@section('styles')
    @parent
    <link href="{{ asset('css/app/data_cache.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => $client->name, 'menu' => 'data_cache', 'section' => 'add_pairs'])
    <div id="content-container" style="margin: 20px; margin-bottom: 110px;" ng-cloak="" ng-controller="DataCacheClientAddPairsCtrl as ctrl">
        <div style="display: none;" id="clientId" data-value="{{$client->id}}"></div>
        <div style="display: none;" id="scanSessionId" data-value="{{$request->ssid}}"></div>
        <div style="display: none;" id="scanType" data-value="{{$request->scan_type}}"></div>
        <div class="loader" style="margin:0 auto; margin-top: 100px;" ng-if="!ctrl.loaded"></div>
        <h1 class="text-center" ng-if="(ctrl.scan_session | valPresent) && ctrl.loaded"><% ctrl.scan_type == 'body_scan' ? 'Bio' : 'Chakra' %></h1>
        <div class="row" style="width: 100%; padding: 10px; display: block;" ng-if="(ctrl.scan_session | valPresent) && ctrl.loaded">
            <a href="/data_cache/clients/{{$client->id}}/bio?ssid=<% ctrl.scan_session.id %>" ng-if="ctrl.scan_type == 'body_scan'"><button class="btn-data-cache">BACK</button></a>
            <a href="/data_cache/clients/{{$client->id}}/chakra?ssid=<% ctrl.scan_session.id %>" ng-if="ctrl.scan_type != 'body_scan'"><button class="btn-data-cache">BACK</button></a>
            <input type="text" ng-model="ctrl.searchText" placeholder="Search" style="width: 30%; height: 40px; margin: 10px 50px;"></input>
            <div class="pull-right">
                <button class="btn-data-cache" ng-click="ctrl.refresh()" style="margin-top: 12px">REFRESH</button>
            </div>
        </div>
        <table border="1" ng-if="(ctrl.scan_session | valPresent) && ctrl.loaded && (ctrl.pairs | where: { scan_type: ctrl.scan_type } | filter: ctrl.searchText).length > 0">
            <thead>
                <tr>
                    <th></th>
                    <th style="max-width: 150px;" ng-click="ctrl.toggleSortBy('name')">Point/Name</th>
                    <th ng-click="ctrl.toggleSortBy('radical')">Radical</th>
                    <th ng-click="ctrl.toggleSortBy('origins')">Start/Origin</th>
                    <th ng-click="ctrl.toggleSortBy('symptoms')">Leads/Symptoms</th>
                    <th ng-click="ctrl.toggleSortBy('paths')">Path/Route/Cause and Effect</th>
                    <th ng-click="ctrl.toggleSortBy('alternative_routes')">Alternative Routes</th>
                <tr>
            </thead>
            <tbody>
                <tr ng-repeat="pair in ctrl.pairs | where: { scan_type: ctrl.scan_type } | filter: ctrl.searchText | orderBy: ctrl.sortBy.column track by pair.id">
                    <td style="padding: 10px;">
                        <i class="fa fa-plus-circle fa-2x" aria-hidden="true" style="cursor: pointer; color: #31b6e8;" ng-click="ctrl.addPair(pair)" ng-if="!pair._delete"></i>
                        <i class="fa fa-minus-circle fa-2x" aria-hidden="true" style="cursor: pointer; color: red;" ng-click="ctrl.removePair(pair)" ng-if="pair._delete"></i>
                    </td>
                    <td style="max-width: 180px; word-wrap: break-word;"><% pair.name %></td>
                    <td><% pair.radical %></td>
                    <td><% pair.origins  || '-' %></td>
                    <td><% pair.symptoms  || '-' %></td>
                    <td><% pair.paths  || '-' %></td>
                    <td><% pair.alternative_routes || '-' %></td>
                </tr>
            </tbody>
        </table>
        <h5 class="text-center" style="margin: 30px 0;" ng-if="ctrl.loaded && (ctrl.scan_session | valPresent) && (ctrl.pairs | where: { scan_type: ctrl.scan_type } | filter: ctrl.searchText).length == 0">No results found.<h5>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
