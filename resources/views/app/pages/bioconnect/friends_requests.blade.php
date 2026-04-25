@extends('layouts.application')

@section('page-title')
    {{'Anew Avenue Biomagnestim | Bio Connect Friends'}}
@stop

@section('styles')
    @parent
    <link href="{{ \App\Support\VersionedAsset::url('css/app/bioconnect.css') }}" rel="stylesheet">
    <link href="{{ \App\Support\VersionedAsset::url('css/app/bioconnect-card.css') }}" rel="stylesheet">
@stop

@section('content')

@include('partials.header', [
    'title' => 'Bio Connect',
    'image_url' => '/images/iconimages/share24.png',
    'menu' => 'bioconnect'
])

<div class="row main-body" ng-controller="BioConnectFriendRequestsCtrl as ctrl" ng-cloak>

    <!-- Sidebar (UNCHANGED) -->
    <div class="col-md-2 offset-md-1 text-center">
        @include('partials.bioconnect.friends_menu')
    </div>

    <!-- Main -->
    <div class="col-md-8 padd-off">

        <div class="friends-container">

            <!-- Loader -->
            <div class="loader" ng-if="!ctrl.friendRequestsLoaded"></div>

            <!-- Empty -->
            <h6 class="text-center mt-4"
                ng-if="!(ctrl.friend_requests | valPresent) && ctrl.friendRequestsLoaded">
                You have no friend requests.
            </h6>

            <!-- Grid -->
            <div class="friends-grid"
                 ng-if="(ctrl.friend_requests | valPresent) && ctrl.friendRequestsLoaded">

                <div class="friend-item"
                     ng-repeat="friend_request in ctrl.friend_requests track by friend_request.id">

                    <div class="friend-card">

                        <!-- Avatar -->
                        <div class="text-center">
                            <img ng-src="<% friend_request.friend.profilePictureUrl %>" class="friend-avatar">
                        </div>

                        <!-- Info -->
                        <div class="friend-info text-center">
                            <h6 class="friend-name"><% friend_request.friend.name %></h6>

                            <p class="text-muted mb-1">
                                <% friend_request.friend.location || 'No location' %>
                            </p>

                            <p class="text-muted mb-1">
                                Age: <% friend_request.friend.age || '-' %>
                            </p>

                            <p class="text-muted">
                                <% friend_request.friend.address || 'No address' %>
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="friend-actions">

                            <button class="btn btn-success btn-sm w-100 mb-2"
                                ng-click="ctrl.acceptFriendRequest(friend_request)">
                                Accept
                            </button>

                            <button class="btn btn-outline-danger btn-sm w-100"
                                ng-click="ctrl.rejectFriendRequest(friend_request)">
                                Reject
                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <div class="friends-scroll-status" ng-if="ctrl.friendRequestsLoaded && ctrl.friendRequestsLoadingMore">
                <div class="loader loader-inline"></div>
            </div>

        </div>

    </div>

</div>

@include('partials.bioconnect.chat_box')

@endsection

@section('javascripts')
    @parent
@stop
