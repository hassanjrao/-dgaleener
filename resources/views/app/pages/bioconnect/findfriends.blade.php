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
    <div class="row main-body" ng-controller="BioConnectFindFriendsCtrl as ctrl" ng-cloak="">
		<div class="col-md-2 offset-md-1 text-center">
            @include('partials.bioconnect.friends_menu')
        </div>
        <div class="col-md-8 padd-off">
            <div class="row">			
				<div class="col-md-12">
					<form class="searchfriend" id="search_form">
						<button type="submit" id="submitbtn" name="submitbtn"><i class="fa fa-search"></i></button>
						<input type="text" placeholder="Search" id="search" name="search" ng-model="searchText">
					</form>
				</div>
				<div class="loader" style="margin:0 auto;" ng-if="!ctrl.usersLoaded"></div>
				<h6 ng-if="!((ctrl.users | filter: { name: searchText })| valPresent) && ctrl.usersLoaded">No results found.</h6>
				<div class="col-md-3" ng-repeat="user in ctrl.users | orderBy: 'name' | filter: { name: searchText } track by user.id" ng-if="(ctrl.users | valPresent) && ctrl.usersLoaded">
					<div class="row">
						<div class="col-md-4" >
							<a href="">
								<img ng-src="<% user.profilePictureUrl %>" class="profile-image"></img>
							</a>
						</div>
						<div class="col-md-8">
							<div class="friendinfo">
								<span class="name friendinfotext"><% user.name %></span>
								<span class="location friendinfotext">Location: <% user.location || '-' %></span>
								<span class="age friendinfotext">Age: <% user.age || '-' %></span>
								<span class="friendinfotext">Address: <% user.address || '-' %></span>
							</div>
							<div class="messages">
								<a href="" class="btn btn-primary" ng-click="ctrl.addFriend(user)" ng-if="!(ctrl.filterUserIds | contains: user.id)">Invite</a>
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
