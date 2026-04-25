@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache - Chakra'}}
@stop
@section('styles')
    @parent
    <link href="{{ \App\Support\VersionedAsset::url('css/app/data_cache.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Data Cache', 'title_es' => 'Caché de datos', 'menu' => 'data_cache'])
    <div style="margin: 20px 50px; margin-bottom: 110px;" ng-cloak="" ng-controller="DataCacheChakraCtrl as ctrl">
        <div class="row" style="width: 100%; padding: 10px 0; display: block; margin-bottom: 20px;">
            <a href="/data_cache"><button class="btn-data-cache">BACK</button></a>
            <a href="/data_cache/clients/<%client.id%>"><button class="btn-data-cache pull-right" style="height: 40px;" ng-disabled="!(client | valPresent)">Create New Scan</button></a>
            <select ng-model="client" ng-disabled="!(ctrl.clients | valPresent)" class="pull-right" style="width: 300px; height: 38px; margin-right: 10px;">
                <option ng-repeat="client in ctrl.clients track by client.id" ng-value="<% client %>" ng-if="client.user_id == {{Auth::user()->id}}"><% client.name %></option>
            </select>
            <b class="pull-right" style="padding: 8px;">Clients:</b>
        </div>
        <div class="loader" style="margin:0 auto; margin-top: 100px;" ng-if="!ctrl.loaded"></div>
        <h5 class="text-center" style="margin: 30px 0; color: #c0392b;" ng-if="ctrl.loaded && ctrl.errorMessage"><% ctrl.errorMessage %></h5>
        <div class="row" style="width: 100%; padding: 10px 0; display: block; margin-bottom: 20px;" ng-if="(ctrl.displayed_pairs | valPresent) && ctrl.loaded">
            <input type="text" placeholder="Search" ng-model="ctrl.searchText" style="width: 30%; height: 40px;" ></input>
            <button class="btn-data-cache pull-right" style="height: 40px;" ng-click="ctrl.refreshScanSession()">Refresh</button>
        </div>
        <table border="1" ng-if="(ctrl.displayed_pairs | valPresent) && ctrl.loaded">
            <thead>
                <tr>
                    <th ng-click="ctrl.toggleSortBy('name')">Point/Name</th>
                    <th ng-click="ctrl.toggleSortBy('origins')">Start/Origin</th>
                    <th ng-click="ctrl.toggleSortBy('symptoms')">Leads/Symptoms</th>
                    <th ng-click="ctrl.toggleSortBy('paths')">Path/Route/Cause and Effect</th>
                    <th ng-click="ctrl.toggleSortBy('alternative_routes')">Alternative Routes</th>
                    <th style="width: 300px;">Clients</th>
                <tr>
            </thead>
            <tbody ng-repeat="(radical, scan_session_pairs) in ctrl.displayed_pairs | unique: 'pair.name' | where: { scan_type: ctrl.scan_type } | filter: ctrl.searchText | orderBy: 'pair.radical' | groupBy: 'pair.radical'">
                <tr>
                    <td class="header-radical header-radical-<% $index %>" colspan="6"><% radical %></td>
                </tr>
                <tr class="plain" ng-repeat="scan_session_pair in scan_session_pairs | where: { scan_type: ctrl.scan_type } | filter: ctrl.searchText | orderBy: 'pair.name'">
                    <td><% scan_session_pair.pair.name || '-' %></td>
                    <td><% scan_session_pair.pair.origins || '-' %></td>
                    <td><% scan_session_pair.pair.symptoms || '-' %></td>
                    <td><% scan_session_pair.pair.paths || '-' %></td>
                    <td><% scan_session_pair.pair.alternative_routes || '-' %></td>
                    <td>
                        <ul>
                            <li ng-repeat="(client_name, scan_session_pairs) in ctrl.displayed_pairs | where: { pair_id: scan_session_pair.pair_id } | orderBy: 'scanSession.client.name' | groupBy: 'scanSession.client.name'">
                                <span><% client_name || '-' %></span>
                                <a ng-repeat="_scan_session_pair in scan_session_pairs | where: { pair_id: scan_session_pair.pair_id }" ng-href="/data_cache/clients/<% _scan_session_pair.scanSession.client.id %>/chakra?ssid=<% _scan_session_pair.scan_session_id %>" target="_blank">
                                    [#<% _scan_session_pair.scan_session_id || '-' %>]
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
        <h5 class="text-center" style="margin: 30px 0;" ng-if="ctrl.loaded && (ctrl.displayed_pairs | where: { scan_type: ctrl.scan_type } | filter: ctrl.searchText).length == 0">No records.<h5>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
