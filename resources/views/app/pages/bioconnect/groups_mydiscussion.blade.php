@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Bio Connect Group Discussions'}}
@stop
@section('styles')
    @parent
    <link href="{{ \App\Support\VersionedAsset::url('css/app/bioconnect.css') }}" rel="stylesheet">
    <link href="{{ \App\Support\VersionedAsset::url('css/app/bioconnect/groups.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Bio Connect', 'image_url' => '/images/iconimages/share24.png', 'menu' => 'bioconnect'])
    <div class="container main-body" ng-controller="BioConnectDiscussionsCtrl as ctrl" ng-cloak="">
        <h2 id="discussionMode" class="my-4">My Discussions</h2>
        <span id="discussionUserId" style="display: none;" data-value="{{Auth::user()->id}}"></span>
        <div class="row">
            <div class="col-md-8">
                @include('partials.bioconnect.discussions_area')
            </div>
            <div class="col-md-4">
                @include('partials.bioconnect.discussion_types_box')
                @include('partials.bioconnect.discussion_submit_box')
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
