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
    <div class="row main-body" ng-controller="BioConnectFriendsCtrl as ctrl" ng-cloak="">
        <div class="col-md-2 offset-md-1 text-center">
            @include('partials.bioconnect.friends_menu')
        </div>
        <div class="col-md-8 padd-off">
            <div class="row">			
				<div class="col-md-12">
                    <div class="loader" style="margin:0 auto;" ng-if="!ctrl.friendRequestsLoaded"></div>
                    <h6 ng-if="!(ctrl.friend_requests | valPresent) && ctrl.friendRequestsLoaded">You have no friends requests.</h6>
					<div class="row friends_requests_content">
                        <div class="col-md-3" ng-repeat="friend_request in ctrl.friend_requests track by friend_request.id">
                            <div class="row" ng-if="(ctrl.friend_requests | valPresent) && ctrl.friendRequestsLoaded">
                                <div class="col-md-4" >
                                    <a href="">
                                        <img ng-src="<% friend_request.friend.profilePictureUrl %>" class="profile-image"></img>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="friendinfo">
                                        <span class="name friendinfotext"><% friend_request.friend.name %></span>
                                        <span class="location friendinfotext">Location: <% friend_request.friend.location || '-' %></span>
                                        <span class="age friendinfotext">Age: <% friend_request.friend.age || '-' %></span>
                                        <span class="friendinfotext">Address: <% friend_request.friend.address || '-' %></span>
                                    </div>
                                    <div class="messages">
                                        <a href="#" class="btn btn-primary accept_to" data-chatid="<% friend_request.friend.id %>" data-senderid="{{Auth::user()->id}}" ng-click="ctrl.acceptFriendRequest(friend_request)">Accept</a>
                                        <a href="#" class="btn btn-danger" ng-click="ctrl.rejectFriendRequest(friend_request)" style="background: red;">Reject</a>
                                    </div>
                                </div>
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
