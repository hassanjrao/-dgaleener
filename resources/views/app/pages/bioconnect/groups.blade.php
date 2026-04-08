@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Bio Connect Group Discussions'}}
@stop
@section('styles')
    @parent
    <link href="{{ asset('css/app/bioconnect.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/bioconnect/groups.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Bio Connect', 'image_url' => '/images/iconimages/share24.png', 'menu' => 'bioconnect'])
    @if (!empty(Auth::user()))
    <div class="container main-body" ng-controller="BioConnectDiscussionsCtrl as ctrl" ng-cloak="">
        <h2 id="discussionMode" class="my-4">Recent Discussions</h2>
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
    @else
    <div class="container main-body" ng-cloak="">
        <h2 id="discussionMode" class="my-4">Discussions</h2>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tbody id="postcontentid" class="post_content">
                        @foreach(App\Models\GroupDiscussion::all() as $discussion)
                        <tr>
                            <th>
                                <div class="clearfix post-container">
                                    <img class="img-responsive profile-image" src="{{ $discussion->creator->profilePictureUrl }}" alt="{{ $discussion->creator->name }}"></img>
                                    <p style="text-align: justify; font-weight: 500;">{{ $discussion->discussion }}</p>
                                    <p class="post-name">{{ $discussion->creator->name }}</p>
                                    <span class="post-time" >{{ $discussion->created_at }}</span>
                                    @if ($discussion->comments->count() > 0)
                                    <div class="comment-container" >
                                        @foreach($discussion->comments as $comment)
                                        <div class="comment-content">
                                            <p>
                                                <img class="comment-user-image" ng-src="{{ $comment->creator->profilePictureUrl }}" alt="{{ $comment->creator->name }}"></img>
                                                <strong>{{ $comment->creator->name }}</strong>{{ $comment->content }}<span class="comment-time">{{ $comment->created_at }}</span>
                                            </p>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
    @endif
@endsection
@section('javascripts')
    @parent
@stop
