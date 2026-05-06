@extends('layouts.modern')

@section('page-title', 'Bio Connect Activities')

@php
    $activeNav = 'connect';
    $useAppShell = true;
@endphp

@push('head')
    <link href="{{ \App\Support\VersionedAsset::url('css/app/bioconnect.css') }}" rel="stylesheet">
@endpush

@section('content')
    <main class="modern-main-content">
        <header class="modern-page-header">
            <div>
                <h1 class="modern-page-title">Activities</h1>
                <p class="modern-page-subtitle">Stay up to date with announcements and updates</p>
            </div>
            <div class="modern-page-header__actions">
                <a href="{{ url('/bioconnect/friends') }}" class="modern-btn modern-btn--outline">
                    <span aria-hidden="true">&larr;</span> Back to Bio Connect
                </a>
            </div>
        </header>

        <div class="row g-4 modern-bioconnect-layout"
             ng-controller="BioConnectActivitiesCtrl as ctrl" ng-cloak>
            <div class="col-12 col-lg-4">
                @if (Auth::user()->isAdmin())
                    <section class="modern-info-card modern-bioconnect-activity-form">
                        <h2 class="modern-bioconnect-activity-form__title">
                            <% ctrl.activity.id == null ? 'Create Activity' : 'Edit Activity' %>
                        </h2>
                        <select ng-model="ctrl.activity.category"
                                class="modern-data-cache-select w-100 mb-2">
                            <option value="" disabled selected>Category</option>
                            <option ng-repeat="category in ctrl.activity_categories | orderBy: 'name' track by category.id"
                                    value="<% category.name %>"><% category.name %></option>
                        </select>
                        <input type="text" placeholder="Title"
                               class="modern-data-cache-input w-100 mb-2"
                               ng-model="ctrl.activity.title">
                        <input type="date" placeholder="Date Published" id="activity_date_published"
                               class="modern-data-cache-input w-100 mb-2"
                               ng-model="ctrl.activity.date_published">
                        <textarea placeholder="Content" rows="4"
                                  class="modern-data-cache-input w-100 mb-3"
                                  style="resize: vertical;"
                                  ng-model="ctrl.activity.content"></textarea>
                        <button class="modern-btn modern-btn--primary w-100"
                                ng-click="ctrl.createActivity(ctrl.activity)"
                                ng-disabled="!(ctrl.activity.category | valPresent) || !(ctrl.activity.title | valPresent) || !(ctrl.activity.content | valPresent) || !(ctrl.activity.date_published | valPresent)">
                            <% ctrl.activity.id == null ? 'Create' : 'Save' %> Activity
                        </button>
                        <button class="modern-btn modern-btn--danger w-100 mt-2"
                                ng-click="ctrl.cancelActionActivity(ctrl.activity)"
                                ng-if="ctrl.activity.id | valPresent">Cancel</button>
                    </section>
                @endif

                <nav class="modern-bioconnect-menu" id="navbarContainer"
                     ng-if="ctrl.activities | valPresent">
                    <div class="modern-bioconnect-menu__header">Categories</div>
                    <ul class="modern-bioconnect-menu__list" id="sidebarWrapper">
                        <li ng-repeat="activity in ctrl.activities | orderBy: 'category' | unique: 'category' track by activity.id">
                            <a href="" class="modern-bioconnect-menu__link"
                               ng-class="{ 'active': ctrl.selectedCategory == activity.category }"
                               ng-click="ctrl.toggleCategory(activity.category)"><% activity.category %></a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="col-12 col-lg-8 activity-content-section"
                 ng-if="ctrl.selectedCategory != ''">
                <section class="modern-info-card">
                    <h2 class="modern-bioconnect-section-title"><% ctrl.selectedCategory %></h2>
                    <div id="accordion" ng-if="ctrl.selectedCategory | valPresent">
                        <div class="card activity-card modern-bioconnect-activity-card"
                             ng-repeat="activity in ctrl.activities | orderBy: ['date_published', 'title'] | where: { category: ctrl.selectedCategory } track by activity.id">
                            <div class="card-header" id="heading-<% $index %>">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed modern-bioconnect-activity-toggle"
                                            data-toggle="collapse" data-target="#collapse-<% $index %>"
                                            aria-expanded="false" aria-controls="collapse-<% $index %>">
                                        <% activity.title %>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse-<% $index %>" class="collapse"
                                 aria-labelledby="heading-<% $index %>" data-parent="#accordion">
                                <div class="card-body">
                                    <strong>Date: <% activity.date_published | date: 'MMM d, yyyy' %></strong>
                                    <p class="mt-3 mb-0" style="text-align: justify;"><% activity.content %></p>
                                    <div class="modern-bioconnect-activity-actions">
                                        <button class="modern-btn modern-btn--small modern-btn--outline"
                                                ng-click="ctrl.editActivity(activity)"
                                                ng-disabled="ctrl.activity.id == activity.id"
                                                ng-if="activity.editable">Edit</button>
                                        <button class="modern-btn modern-btn--small modern-btn--danger"
                                                ng-click="ctrl.deleteActivity(activity)"
                                                ng-disabled="ctrl.activity.id == activity.id"
                                                ng-if="activity.deletable">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    @include('partials.bioconnect.firebase_config')
@endpush
