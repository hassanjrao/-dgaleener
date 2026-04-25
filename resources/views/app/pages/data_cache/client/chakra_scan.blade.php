@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache - Client Info - Chakra'}}
@stop
@section('styles')
    @parent
    <link href="{{ \App\Support\VersionedAsset::url('css/app/data_cache.css') }}" rel="stylesheet">
@stop
@section('content')
    @php ($scan_session_id = request()->ssid ?? '')
    @php ($scan_type = request()->scan_type ?? 'chakra_scan')
    @include('partials.header', ['title' => $client->name, 'menu' => 'data_cache', 'section' => 'client_show'])
    <div id="content-container" style="margin: 20px; margin-bottom: 110px;" ng-cloak="" ng-controller="DataCacheClientShowChakraCtrl as ctrl">
        <div style="display: none;" id="scanSessionId" data-value="{{$scan_session_id}}"></div>
        <div style="display: none;" id="clientId" data-value="{{$client->id}}"></div>
        <div style="display: none;" id="scanType" data-value="{{$scan_type}}"></div>
        <div class="row" style="width: 100%; padding: 10px; display: block;" ng-if="ctrl.loaded">
            <a href="/data_cache/clients/<% ctrl.client.id %>"><button class="btn-data-cache">BACK</button></a>
            <div class="pull-right">
                <a href="{{ route('app.scanSessions.payment.request', ['id' => $scan_session_id])}}" ng-if="(ctrl.scan_session | valPresent) && !ctrl.scan_session.paid"><button class="btn-data-cache">REQUEST PAYMENT</button></a>
                <button class="btn-data-cache" ng-click="ctrl.markDoneScanSession(ctrl.scan_session)" ng-if="ctrl.scan_session.editable && !(ctrl.scan_session.date_ended | valPresent)">MARK AS DONE</button>
                <button class="btn-data-cache" ng-click="ctrl.markUndoneScanSession(ctrl.scan_session)" ng-if="ctrl.scan_session.editable && (ctrl.scan_session.date_ended | valPresent)">MARK AS UNDONE</button>
                <button class="btn-data-cache" ng-click="ctrl.emailScanSession(ctrl.scan_session)" ng-if="(ctrl.scan_session | valPresent)">EMAIL</button>
                <button class="btn-data-cache" ng-click="ctrl.printScanSession(ctrl.scan_session)" ng-if="(ctrl.scan_session | valPresent)">PRINT</button>
            </div>
        </div>
        <div class="loader" style="margin:0 auto; margin-top: 100px;" ng-if="!ctrl.loaded"></div>
        <div class="row" style="padding: 0 100px;" ng-if="ctrl.loaded">
            <div class="col-md" style="color: #808080; margin: 0 8px; padding: 8px;">
                Anew Beginning<br>
                Biomagnetism
            </div>
            <div class="col-md" style="color: #808080; margin: 0 8px; padding: 8px;">
                5 Bon Air Rd.<br> 
                Suite 127<br>
                Larkspur CA. 94938
            </div>
            <div class="col-md" style="color: #808080; margin: 0 8px; padding: 8px;">
                anew-beginning.com<br>
                415-555-1212
            </div>
        </div>
        <div class="row" style="padding: 20px 100px;" ng-if="ctrl.loaded">
            <div class="col-md" style="color: #31b6e8; border: 1px solid #000; margin: 0 8px; height: 100px; padding: 8px; border-radius: 10px;">
                <b>Name: </b> <% ctrl.client.name %><br>
                <b>Age: </b> <% ctrl.client.age %> (<% ctrl.client.date_of_birth | date: 'MMMM dd, yyyy' %>)<br>
                <b>Gender: </b> <% ctrl.client.gender | capitalize %>
            </div>
            <div class="col-md" style="color: #31b6e8; border: 1px solid #000;  margin: 0 8px; height: 100px; padding: 8px; border-radius: 10px;">
                <b>Address: </b> <% ctrl.client.address %>
            </div>
            <div class="col-md" style="color: #31b6e8; border: 1px solid #000;  margin: 0 8px; height: 100px; padding: 8px; border-radius: 10px;">
                <span><% (ctrl.scan_session.date_started | date: 'MMMM dd, yyyy') || '-' %></span><span ng-if="ctrl.scan_session.date_ended | valPresent"> - <% (ctrl.scan_session.date_ended | date: 'MMMM dd, yyyy') || '-' %></span><br>
                Invoice #<% ctrl.scan_session.id || '-' %><br>
                <b>Price: </b> $<% ctrl.scan_session.cost || '-' %> <% (ctrl.scan_session.paid ? '(paid)' : '(not paid yet)') || '-' %><br>
            </div>
        </div>
        <div class="row" style="width: 100%; padding: 10px; display: block;" ng-if="ctrl.loaded">
            <div class="pull-left" style="width: calc(100% - 661px);">
                <button class="btn btn-primary" ng-click="ctrl.refreshData()" style="margin-bottom: 5px;">REFRESH</button>
                <input type="text" placeholder="Search for pairs or points below" ng-model="ctrl.searchText" style="width: 50%; height: 38px; margin-left: 10px;">
            </div>
            <div class="pull-right" style="margin-bottom: 10px;" ng-if="!(ctrl.scan_session.date_ended | valPresent)">
                <input type="text" placeholder="Filter selection" ng-model="searchTextPair" style="width: 150px; height: 38px; margin-left: 10px;">
                <select ng-model="pair" ng-disabled="!(ctrl.pairs | valPresent)" style="width: 300px; height: 38px; margin-right: 10px;">
                    <option ng-repeat="pair in ctrl.pairs | orderBy: 'name' | filter: { name: searchTextPair } track by pair.id" ng-value="<% pair %>" ng-if="pair._selectable"><% pair.name %></option>
                </select>
                <button class="btn btn-primary" ng-click="ctrl.addPair(pair)" style="margin-bottom: 5px; margin-right: 10px;" ng-disabled="!(pair | valPresent)">ADD</button></a>
                <a href="/data_cache/clients/<% ctrl.client.id %>/add_pairs?ssid=<% ctrl.scan_session.id %>" target="_blank"><button class="btn btn-primary" style="margin-bottom: 5px;">SHOW LIST</button></a>
            </div>
        </div>
        <table border="1" ng-if="(ctrl.displayed_pairs | valPresent) && ctrl.loaded">
            <thead>
                <tr>
                    <th ng-click="ctrl.toggleSortBy('name')">Point/Name</th>
                    <th ng-click="ctrl.toggleSortBy('origins')">Start/Origin</th>
                    <th ng-click="ctrl.toggleSortBy('symptoms')">Leads/Symptoms</th>
                    <th ng-click="ctrl.toggleSortBy('paths')">Path/Route/Cause and Effect</th>
                    <th ng-click="ctrl.toggleSortBy('alternative_routes')">Alternative Routes</th>
                    <th></th>
                <tr>
            </thead>
            <tbody ng-repeat="(radical, pairs) in ctrl.displayed_pairs | where: { scan_type: ctrl.scan_type } | filter: ctrl.searchText | orderBy: 'radical' | groupBy: 'radical'">
                <tr>
                    <td class="header-radical header-radical-<% $index %>" colspan="6"><% radical %></td>
                </tr>
                <tr class="plain" ng-repeat="pair in pairs | where: { scan_type: ctrl.scan_type } | filter: ctrl.searchText | orderBy: ctrl.sortBy.column track by pair.id">
                    <td><% pair.name %></td>
                    <td><% pair.origins  || '-' %></td>
                    <td><% pair.symptoms  || '-' %></td>
                    <td><% pair.paths  || '-' %></td>
                    <td><% pair.alternative_routes || '-' %></td>
                    <td><button class="fa fa-close fa-2x" style="color: red; cursor: pointer;" ng-click="ctrl.removePair(pair)"></button></td>
                </tr>
            </tbody>
        </table>
        <h5 class="text-center" style="margin: 50px 0;" ng-if="ctrl.loaded && (ctrl.displayed_pairs | where: { scan_type: ctrl.scan_type } | filter: ctrl.searchText).length == 0">No records.<h5>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
