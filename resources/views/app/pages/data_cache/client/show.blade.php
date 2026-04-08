@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Data Cache - Client Info'}}
@stop
@section('styles')
    @parent
    <link href="{{ asset('css/app/data_cache.css') }}" rel="stylesheet">
@stop
@section('content')
    @php ($scan_type = request()->scan_type ?? 'body_scan')
    @include('partials.header', ['title' => $client->name, 'menu' => 'data_cache', 'section' => 'client_show'])
    <div id="content-container" style="margin: 20px; margin-bottom: 110px;" ng-cloak="" ng-controller="DataCacheClientShowCtrl as ctrl">
        <div style="display: none;" id="clientId" data-value="{{$client->id}}"></div>
        <div style="display: none;" id="scanType" data-value="{{$scan_type}}"></div>
        <div class="row" style="width: 100%; padding: 10px; display: block;">
            <a href="/data_cache/client_info"><button class="btn-data-cache">BACK</button></a>
            <div class="pull-right">
                <button class="btn-data-cache" data-toggle="modal" data-target="#clientInfoModal" data-title="Edit Client" data-title="Edit Client" data-id="<% ctrl.client.id %>">EDIT</button>
                <button class="btn-data-cache" ng-click="ctrl.refreshClient()">REFRESH</button>
            </div>
        </div>
        <h1 class="text-center" ng-if="ctrl.loaded">Client Information</h1>
        <div class="loader" style="margin:0 auto; margin-top: 100px;" ng-if="!ctrl.loaded"></div>
        <div class="row" style="padding: 20px 100px;" ng-if="ctrl.loaded">
            <div class="col-md" style="color: #31b6e8; border: 1px solid #000; margin: 0 8px; height: 100px; padding: 8px; border-radius: 10px;">
                <b>Name: </b> <% ctrl.client.name %><br>
                <b>Age: </b> <% ctrl.client.age %> (<% ctrl.client.date_of_birth | date: 'MMMM dd, yyyy' %>)<br>
                <b>Gender: </b> <% ctrl.client.gender | capitalize %>
            </div>
            <div class="col-md" style="color: #31b6e8; border: 1px solid #000;  margin: 0 8px; height: 100px; padding: 8px; border-radius: 10px;">
                <b>Address: </b> <% ctrl.client.address %>
            </div>
            <!-- <div class="col-md" style="color: #31b6e8; border: 1px solid #000;  margin: 0 8px; height: 100px; padding: 8px; border-radius: 10px;">
                <% ((ctrl.client.created_at | split: ' ') | first) | date: 'MMMM dd, yyyy' %><br>
                Invoice #<% ctrl.client.id %><br>
                <b>Price: </b> $<% ctrl.client.session_cost %> <% ctrl.client.session_paid ? '(paid)' : '(not paid yet)' %><br>
            </div> -->
        </div>
        <div id="client_show_tabs" ng-hide="!ctrl.loaded">
            <ul>
                <li><a href="#tabs-sessions">Scan Sessions</a></li>
                <li><a href="#tabs-medical-notes">Medical Notes</a></li>
                <li><a href="#tabs-consent-forms">Consent Forms</a></li>
            </ul>
            <div id="tabs-sessions">
                <div style="margin-bottom: 15px;">
                    <input type="date" id="scan_session_date_started" ng-model="ctrl.scan_session.date_started" style="height: 40px;" date-picker-input></input>
                    <select ng-model="ctrl.scan_session.scan_type" style="width: calc(100% - 418px); height: 40px;">
                        <option value="body_scan">Body Scan</option>
                        <option value="chakra_scan">Chakra Scan</option>
                    </select>
                    <input type="number" id="scan_session_cost" ng-model="ctrl.scan_session.cost" style="height: 40px;" placeholder="Cost in Dollars" min="0" ng-value="ctrl.client.session_cost"></input>
                    <button class="btn btn-primary" ng-click="ctrl.addScanSession(ctrl.scan_session)"  ng-disabled="!(ctrl.scan_session.date_started | valPresent) || !(ctrl.scan_session.scan_type | valPresent)" style="margin-right: 0; height: 40px;">ADD</button>
                </div>
                <table border="1">
                    <thead>
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th style="width: 171px;">Date Started</th>
                            <th style="width: 250px;">Scan Type</th>
                            <th style="width: 171px;">Date Ended</th>
                            <th style="width: 150px;"></th>
                        <tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="scan_session in ctrl.scan_sessions | orderBy: ['date_started', 'created_at'] track by scan_session.id">
                            <td style="text-align: center;"><% scan_session.id %></td>
                            <td style="text-align: center;"><% scan_session.date_started | date: 'MMM dd, yyyy' %></td>
                            <td style="padding-left: 20px;"><% scan_session.scan_type == 'body_scan' ? 'Body Scan' : 'Chakra Scan' %></td>
                            <td style="text-align: center;"><% (scan_session.date_ended | date: 'MMM dd, yyyy') || '-' %></td>
                            <td style="text-align: right;">
                                <a href="/data_cache/clients/<% scan_session.client_id %>/<% scan_session.scan_type == 'body_scan' ? 'bio' : 'chakra' %>?ssid=<% scan_session.id %>" target="_blank"><button><i class="fa fa-eye"></i> View Details</button></a>
                                <a href="/<% scan_session.scan_type == 'body_scan' ? 'bodyscan' : 'chakrascan' %>?target=<% scan_session.client.gender %>&ssid=<% scan_session.id %>" target="_blank"><button><i class="fa fa-eye"></i> View thru scan</button></a>
                                <br>
                                <button style="width: 153px;" ng-click="ctrl.markDoneScanSession(scan_session)" ng-if="scan_session.editable && !(scan_session.date_ended | valPresent)"><i class="fa fa-check"></i> Mark As Done</button>
                                <button  style="width: 153px;" ng-click="ctrl.markUndoneScanSession(scan_session)" ng-if="scan_session.editable && (scan_session.date_ended | valPresent)"><i class="fa fa-close"></i> Mark As Undone</button>
                                <button style="color: red;" ng-click="ctrl.deleteScanSession(scan_session)" ng-if="scan_session.deletable"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="text-center" style="margin: 30px 0;" ng-if="!(ctrl.scan_sessions | valPresent)">No records.</h5>
            </div>
            <div id="tabs-medical-notes">
                <div style="margin-bottom: 15px;" ng-if="!(ctrl.medical_note.id | valPresent)">
                    <input type="date" id="medical_note_date_noted" ng-model="ctrl.medical_note.date_noted" style="height: 40px;"></input>
                    <input type="text" placeholder="Description" ng-model="ctrl.medical_note.description" style="width: calc(100% - 241px); height: 40px;">
                    <button class="btn btn-primary" ng-click="ctrl.addMedicalNote(ctrl.medical_note)" ng-disabled="!(ctrl.medical_note.date_noted | valPresent) || !(ctrl.medical_note.description | valPresent)" style="margin-right: 0; height: 40px;">ADD</button>
                </div>
                <div style="margin-bottom: 15px;" ng-if="ctrl.medical_note.id | valPresent">
                    <input type="date" id="medical_note_date_noted" ng-model="ctrl.medical_note.date_noted" style="height: 40px;"></input>
                    <input type="text" placeholder="Description" ng-model="ctrl.medical_note.description" style="width: calc(100% - 343px); height: 40px;">
                    <button class="btn btn-primary" ng-click="ctrl.addMedicalNote(ctrl.medical_note)" ng-disabled="!(ctrl.medical_note.date_noted | valPresent) || !(ctrl.medical_note.description | valPresent)" style="margin-right: 0; height: 40px;">SAVE</button>
                    <button class="btn btn-danger" ng-click="ctrl.cancelMedicalNote(ctrl.medical_note)" ng-disabled="!(ctrl.medical_note.date_noted | valPresent) || !(ctrl.medical_note.description | valPresent)" style="margin-right: 0; height: 40px;">CANCEL</button>
                </div>
                <table border="1">
                    <thead>
                        <tr>
                            <th style="width: 171px;">Date</th>
                            <th>Description</th>
                            <th style="width: 152px;"></th>
                        <tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="medical_note in ctrl.medical_notes | orderBy: ['date_noted', 'created_at'] track by medical_note.id">
                            <td style="text-align: center;"><% medical_note.date_noted | date: 'MMM dd, yyyy' %></td>
                            <td style="padding-left: 20px;"><% medical_note.description %></td>
                            <td style="text-align: right;">
                                <button ng-click="ctrl.editMedicalNote(medical_note)" ng-if="medical_note.editable && !(ctrl.medical_note.id | valPresent)"><i class="fa fa-edit"></i> Edit</button>
                                <button style="color: red;" ng-click="ctrl.deleteMedicalNote(medical_note)" ng-if="medical_note.deletable && !(ctrl.medical_note.id | valPresent)"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="text-center" style="margin: 30px 0;" ng-if="!(ctrl.medical_notes | valPresent)">No records.</h5>
            </div>
            <div id="tabs-consent-forms">
                <form method="POST" enctype="multipart/form-data" id="consentFormInputForm" style="margin-bottom: 15px;" action="{{ url('/data_cache/upload_consent_form') }}">
                    @csrf
                    <input type="hidden" id="client_id" name="client_id" value="<% ctrl.client.id %>" />
                    <div id="form-part">
                        <input type="date" id="consent_form_date_entered" name="date_entered" value="{{Carbon\Carbon::now()->format('Y-m-d')}}"style="margin-right: 10px; height:40px;" required="">
                        <input type="file" id="consent_form_file" name="consent_form_file" accept=".pdf, .doc, .docx" required="">
                        <input type="text" id="description" name="description" placeholder="Description (Optional)" style="margin-right: 10px; height:40px; width: calc(100% - 586px)">
                        <button type="submit" id="contentFormSubmit" class="btn btn-primary">Upload</button>
                    </div>
                    <div id="loader-part" style="display: none;">
                        <br/><br/><div class="loader" style="margin:0 auto;"></div><br/>
                        <p style="text-align:center">{{ __('Please wait... file upload is still being processed...') }}</p><br/>
                    </div>
                </form>
                <table border="1">
                    <thead>
                        <tr>
                            <th style="width: 171px;">Date</th>
                            <th>File Name</th>
                            <th>Description</th>
                            <th style="width: 270px;"></th>
                        <tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="consent_form in ctrl.consent_forms | orderBy: ['date_entered', 'file_name'] track by consent_form.id">
                            <td style="text-align: center;"><% consent_form.date_entered | date: 'MMM dd, yyyy' %></td>
                            <td style="padding-left: 20px;"><% consent_form.file_name %></td>
                            <td style="padding-left: 20px;"><% consent_form.description || '-' %></td>
                            <td style="text-align: right;">
                                <a ng-href="<% consent_form.file_url %>" target="_blank"><button ng-disabled="consent_form.file_ext != 'pdf'"><i class="fa fa-eye"></i> View</button></a>
                                <button><a href="<% consent_form.file_url %>" download><i class="fa fa-download"></i> Download</a></button>
                                <button style="color: red;" ng-click="ctrl.deleteConsentForm(consent_form)" ng-if="consent_form.deletable"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="text-center" style="margin: 30px 0;" ng-if="!(ctrl.consent_forms | valPresent)">No records.</h5>
            </div>
        </div>
    </div>
    @include('app.pages.data_cache.modals.client_info')
@endsection
@section('javascripts')
    @parent
    @include('app.pages.data_cache.modals.js.client_info')

    <script>
        $("#client_show_tabs").tabs();

        $('#contentFormSubmit').click(function(event){
            if ($("#consent_form_file").val() != '' || $("#consent_form_file").val() != null) {
                $('#form-part').hide();
                $('#loader-part').show();
            }
        });
    </script>
@stop
