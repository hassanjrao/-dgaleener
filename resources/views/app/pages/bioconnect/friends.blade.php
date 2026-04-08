@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Bio Connect Friends'}}
@stop
@section('styles')
    @parent
    <link href="{{ asset('css/app/bioconnect.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Bio Connect', 'image_url' => '/images/iconimages/share24.png', 'menu' => 'bioconnect'])
    @if (!empty(Auth::user()))
    <div class="row main-body" ng-controller="BioConnectFriendsCtrl as ctrl" ng-cloak="">
        <div class="col-md-2 offset-md-1 text-center">
            @include('partials.bioconnect.friends_menu')
        </div>
        <div class="col-md-8 padd-off">
            <div class="loader" style="margin:0 auto;" ng-if="!ctrl.userFriendsLoaded"></div>
            <h6 ng-if="!(ctrl.user_friends | valPresent) && ctrl.userFriendsLoaded">You have no friends yet.</h6>
            <div id="friend_content" class="row friends_content" ng-if="(ctrl.user_friends | valPresent) && ctrl.userFriendsLoaded"> 
                <div class="col-md-3" ng-repeat="user_friend in ctrl.user_friends track by user_friend.id">
                    <div class="row">
                        <div class="col-md-4 avatar" >
                            <a href="">
                                <img ng-src="<% user_friend.friend.profilePictureUrl %>" class="profile-image"></img>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="friendinfo">
                                <span class="name friendinfotext"><% user_friend.friend.name %></span>
                                <span class="location friendinfotext">Location: <% user_friend.friend.location || '-' %></span>
                                <span class="age friendinfotext">Age: <% user_friend.friend.age || '-' %></span>
                                <span class="friendinfotext">Address: <% user_friend.friend.address || '-' %></span>
                            </div>
                            <div class="messages">
                                <a href="" data-chatid="<% user_friend.friend.id %>" data-chatname="<% user_friend.friend.name %>" data-chatprofileimageurl="<% user_friend.friend.profilePictureUrl %>" class="btn btn-primary sidebarSecondary_toggle show-chat-box click_<% user_friend.friend.id %>">Messages</a>
                                <a href="#" class="btn btn-danger" ng-click="ctrl.deleteFriend(user_friend)" style="background: red;">Unfriend</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container main-body" ng-cloak="" style="margin-top: 0;">
        <!-- <div class="col-md-2 offset-md-1 text-center">
        </div> -->
        <div class="col-md-12 padd-off">
            <div id="friend_content" class="row friends_content"> 
                @foreach(\App\Models\User::where('privacy', false)->orderBy('name', 'asc')->get() as $user)
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-4 avatar" >
                            <a href="">
                                <img src="{{ $user->profilePictureUrl }}" class="profile-image" alt="{{ env('APP_TITLE') }}"></img>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="friendinfo">
                                <span class="name friendinfotext">{{ $user->name }}</span>
                                <span class="location friendinfotext">Location: {{ !empty($user->location) ? $user->location : '-' }}</span>
                                <span class="age friendinfotext">Age: {{ !empty($user->age) ? $user->age : '-' }}</span>
                                <span class="friendinfotext">Address: {{ !empty($user->address) ? $user->address : '-' }}</span>
                            </div>
                        </div>
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
