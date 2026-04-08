@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Introduction to Bio Connect'}}
@stop
@section('styles')
    @parent

    <style>
        @media only screen and (max-width: 768px) {
            .bioconnect-icon {
                position: static !important;
            }
        }
    </style>
@stop
@section('content')
    @include('partials.header', ['title' => 'Bio Connect'])
    <div class="row info-page">
        <div class="col-md-2">
            <div class="bioconnect-icon" style="position: absolute; bottom: 5%;">
            <p class="text-center" style="color: #000; font-size: 24px; margin-bottom: 30px; margin-top: 10px;">Free to all users, Connect now!</p>
            <p class="text-center" style="margin: 10px 0; margin-bottom: 40px;">
                <a href="{{ empty(Auth::user()) ? '/register' : '/bioconnect' }}">
                    <img src="{{asset('/images/introduction/bioconnect/button.png')}}" alt="{{ env('APP_TITLE') }}" style="width: 130px;"></img>
                </a>
            </p>
            </div>
        </div>
        <div class="col-md-8">
            <p class="text-center" style="margin-bottom: 30px;">
                <img src="{{asset('/images/introduction/bioconnect/banner.png')}}" alt="{{ env('APP_TITLE') }}" style="width: 60%;"></img>
            </p>
            <div style="border: 2px solid silver; margin-bottom: 40px;">
                <h3 class="text-center" style="color: #fff;">Bio Connect Staying in Tune</h3>
                <h3 class="text-center" style="color: #fff;">Listening to what others are chattering about Biomagnetism.</h3>
            </div>
            <ul class="text-center" style="color: #000; font-size: 20px; list-style: none;">
                <li>Stay perched and on top of what is going on in Biomagnetism.</li>
                <li>Integrating & Interactive.</li>
                <li>Crossing paths from far away and connecting, with common interest.</li>
                <li>You never know who’s ship maybe passing thru full of wisdom and helpful words.</li>
                <li>Guidance to navigate your direction with Biomagnetism.</li>
                <li>Start a group, add friends, find friends, messages and notifications altogher in one place.</li>
                <li>Bio Connect.</li>
            </ul>
            <img src="{{asset('/images/introduction/bioconnect/message.gif')}}" alt="{{ env('APP_TITLE') }}" style="width: 100%; margin-top: 50px;"></img>
        </div>
        <div class="col-md-2">
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
