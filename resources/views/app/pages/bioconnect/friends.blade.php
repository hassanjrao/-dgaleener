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

@if (!empty(Auth::user()))

<div class="row main-body" ng-controller="BioConnectFriendsCtrl as ctrl" ng-cloak>

    <!-- Sidebar (UNCHANGED) -->
    <div class="col-md-2 offset-md-1 text-center">
        @include('partials.bioconnect.friends_menu')
    </div>

    <!-- Friends -->
    <div class="col-md-8 padd-off">

        <div class="friends-container">

            <!-- Loader -->
            <div class="loader" ng-if="!ctrl.userFriendsLoaded"></div>

            <!-- Empty -->
            <h6 ng-if="!(ctrl.user_friends | valPresent) && ctrl.userFriendsLoaded"
                class="text-center mt-4">
                You have no friends yet.
            </h6>

            <!-- Grid -->
            <div class="friends-grid"
                 ng-if="(ctrl.user_friends | valPresent) && ctrl.userFriendsLoaded">

                <div class="friend-item"
                     ng-repeat="user_friend in ctrl.user_friends track by user_friend.id">

                    <div class="friend-card">

                        <!-- Avatar -->
                        <div class="text-center">
                            <img ng-src="<% user_friend.friend.profilePictureUrl %>" class="friend-avatar">
                        </div>

                        <!-- Info -->
                        <div class="friend-info text-center">
                            <h6 class="friend-name"><% user_friend.friend.name %></h6>

                            <p class="text-muted mb-1">
                                <% user_friend.friend.location || 'No location' %>
                            </p>

                            <p class="text-muted mb-1">
                                Age: <% user_friend.friend.age || '-' %>
                            </p>

                            <p class="text-muted">
                                <% user_friend.friend.address || 'No address' %>
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="friend-actions">

                            <button class="btn btn-primary btn-sm w-100 mb-2 sidebarSecondary_toggle show-chat-box"
                                data-chatid="<% user_friend.friend.id %>"
                                data-chatname="<% user_friend.friend.name %>"
                                data-chatprofileimageurl="<% user_friend.friend.profilePictureUrl %>">
                                Message
                            </button>

                            <button class="btn btn-outline-danger btn-sm w-100"
                                ng-click="ctrl.deleteFriend(user_friend)">
                                Unfriend
                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <div class="friends-scroll-status" ng-if="ctrl.userFriendsLoaded && ctrl.userFriendsLoadingMore">
                <div class="loader loader-inline"></div>
            </div>

        </div>

    </div>

</div>

@else

<!-- Public Users -->
<div class="container main-body">

    <div class="friends-container">

        <div class="friends-grid">

            @foreach (\App\Models\User::where('privacy', false)->orderBy('name', 'asc')->get() as $user)

            <div class="friend-item">

                <div class="friend-card text-center">

                    <img src="{{ $user->profilePictureUrl }}" class="friend-avatar">

                    <h6 class="friend-name">{{ $user->name }}</h6>

                    <p class="text-muted mb-1">
                        {{ $user->location ?? 'No location' }}
                    </p>

                    <p class="text-muted mb-1">
                        Age: {{ $user->age ?? '-' }}
                    </p>

                    <p class="text-muted">
                        {{ $user->address ?? 'No address' }}
                    </p>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

@endif

@include('partials.bioconnect.chat_box')

@endsection

@section('javascripts')
    @parent

    @if (!empty(Auth::user()))
        @include('partials.bioconnect.firebase_config')
        @include('partials.bioconnect.friends_chat')
    @endif
@stop
