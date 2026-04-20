@extends('layouts.application')

@section('page-title')
    {{ 'Anew Avenue Biomagnestim | Bio Connect Friends' }}
@stop

@section('styles')
    @parent
    <link href="{{ asset('css/app/bioconnect.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/bioconnect-card.css') }}" rel="stylesheet">
@stop

@section('content')

    @include('partials.header', [
        'title' => 'Bio Connect',
        'image_url' => '/images/iconimages/share24.png',
        'menu' => 'bioconnect',
    ])

    <div class="row main-body" ng-controller="BioConnectFindFriendsCtrl as ctrl" ng-cloak>

        <!-- Sidebar (UNCHANGED) -->
        <div class="col-md-2 offset-md-1 text-center">
            @include('partials.bioconnect.friends_menu')
        </div>

        <!-- Main Content -->
        <div class="col-md-8 padd-off">

            <div class="friends-container">

                <!-- Search -->
                <div class="search-container">
					<div class="search-inline">
						<i class="fa fa-search"></i>
						<input type="text"
							placeholder="Search friends..."
							ng-model="searchText">
					</div>
				</div>

                <!-- Loader -->
                <div class="loader" ng-if="!ctrl.usersLoaded"></div>

                <!-- Empty -->
                <h6 class="text-center mt-4"
                    ng-if="!((ctrl.users | filter: { name: searchText })| valPresent) && ctrl.usersLoaded">
                    No results found.
                </h6>

                <!-- Grid -->
                <div class="friends-grid" ng-if="(ctrl.users | valPresent) && ctrl.usersLoaded">

                    <div class="friend-item"
                        ng-repeat="user in ctrl.users | orderBy: 'name' | filter: { name: searchText } track by user.id">

                        <div class="friend-card">

                            <!-- Avatar -->
                            <div class="text-center">
                                <img ng-src="<% user.profilePictureUrl %>" class="friend-avatar">
                            </div>

                            <!-- Info -->
                            <div class="friend-info text-center">
                                <h6 class="friend-name"><% user.name %></h6>

                                <p class="text-muted mb-1">
                                    <% user.location || 'No location' %>
                                </p>

                                <p class="text-muted mb-1">
                                    Age: <% user.age || '-' %>
                                </p>

                                <p class="text-muted">
                                    <% user.address || 'No address' %>
                                </p>
                            </div>

                            <!-- Action -->
                            <div class="friend-actions">

                                <button class="btn btn-primary btn-sm w-100" ng-click="ctrl.addFriend(user)"
                                    ng-if="!(ctrl.filterUserIds | contains: user.id)">
                                    Invite
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @include('partials.bioconnect.chat_box')

@endsection

@section('javascripts')
    @parent
@stop
