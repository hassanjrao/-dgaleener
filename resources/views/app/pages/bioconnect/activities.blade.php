@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Bio Connect Activities'}}
@stop
@section('styles')
    @parent
    <link href="{{ asset('css/app/bioconnect.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Bio Connect', 'image_url' => '/images/iconimages/share24.png', 'menu' => 'bioconnect'])
    <div class="row main-body" ng-controller="BioConnectActivitiesCtrl as ctrl" ng-cloak="">
        <div class="col-md-3 offset-md-1 text-center">
            @if(Auth::user()->isAdmin())
                <div style="border: 1px solid #808080; padding: 8px; margin-bottom: 20px; border-radius: 5px;">
                    <select placeholder="Category" ng-model="ctrl.activity.category" style="margin-bottom: 8px; width: 100%;">
                        <option ng-repeat="category in ctrl.activity_categories | orderBy: 'name' track by category.id" value="<% category.name %>"><% category.name %></option>
                    </select>
                    <input type="text" placeholder="Title" ng-model="ctrl.activity.title" style="margin-bottom: 8px; width: 100%;"></input>
                    <input type="date" placeholder="Date Published" id="activity_date_published" ng-model="ctrl.activity.date_published" style="margin-bottom: 8px; width: 100%;"></input>
                    <textarea placeholder="Content" rows="3" ng-model="ctrl.activity.content" style="margin-bottom: 8px; width: 100%; resize: vertical;"></textarea>
                    <button class="btn btn-primary" style="width: 100%;" ng-click="ctrl.createActivity(ctrl.activity)" ng-disabled="!(ctrl.activity.category | valPresent) || !(ctrl.activity.title | valPresent) || !(ctrl.activity.content | valPresent) || !(ctrl.activity.date_published | valPresent)"><% ctrl.activity.id == null ? 'Create' : 'Edit' %> Activity</button>
                    <button class="btn btn-danger" style="width: 100%; margin-top: 10px" ng-click="ctrl.cancelActionActivity(ctrl.activity)" ng-if="ctrl.activity.id | valPresent">Cancel</button>
                </div>
            @endif
            <nav class="navbar navbar-default" role="navigation" id="navbarContainer" ng-if="ctrl.activities | valPresent">
                <div id="sidebarWrapper" class="sidebar-toggle">
                    <ul class="row sidebar-nav activitiy">
                        <li class="col-md-12" ng-repeat="activity in ctrl.activities | orderBy: 'category' | unique: 'category' track by activity.id">
                            <a href="" ng-click="ctrl.toggleCategory(activity.category)"><% activity.category %></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-md-7 activity-content-section" ng-if="ctrl.selectedCategory != ''">
            <h3 style="margin-bottom: 20px;"><% ctrl.selectedCategory %></h3>
            <div id="accordion" ng-if="ctrl.selectedCategory | valPresent">
                <div class="card activity-card" ng-repeat="activity in ctrl.activities | orderBy: ['date_published', 'title'] | where: { category: ctrl.selectedCategory } track by activity.id">
                    <div class="card-header" id="heading-<% $index %>">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-<% $index %>"
                                    aria-expanded="false" aria-controls="collapse-<% $index %>" style="font-size: 17px;">
                                <% activity.title %>
                            </button>
                        </h5>
                    </div>
                    <div id="collapse-<% $index %>" class="collapse" aria-labelledby="heading-<% $index %>" data-parent="#accordion">
                        <div class="card-body">
                            <b>Date: <% activity.date_published | date: 'MMM d, yyyy' %></b>
                            <br>
                            <br>
                            <span style="text-align: justify;"><% activity.content %></span>
                            <br>
                            <button class="btn btn-danger pull-right" ng-click="ctrl.deleteActivity(activity)" style="margin: 20px 5px;" ng-disabled="ctrl.activity.id == activity.id" ng-if="activity.deletable">Delete</button>
                            <button class="btn btn-primary pull-right" ng-click="ctrl.editActivity(activity)" style="margin: 20px 5px;" ng-disabled="ctrl.activity.id == activity.id" ng-if="activity.editable">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    @include('partials.bioconnect.firebase_config')
@stop
