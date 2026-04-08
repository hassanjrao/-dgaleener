@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Reset Password'}}
@stop
@section('styles')
    @parent
    <link href="{{ asset('css/app/sessions.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="row main-body">
    <div class="col-md-4"></div>
    <div class="col-md-4" id="login-div">
        <span class="text-center logo-img"><img src="/images/iconimages/logo.png" alt="{{ env('APP_TITLE') }}"></span>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.request') }}" class="login-form">
            @csrf
            <input type="hidden" id="token" name="token" value="{{$token}}" />
            <div class="input-group mb-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><img
                                src="/images/glyphicons/png/glyphicons-social-40-e-mail.png" class="icon-img"></span>
                    </div>
                    <input id="username" type="text"
                            class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ $username ?? old('username') }}" placeholder="Username" required autofocus>

                    @error('username')
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><img
                                src="/images/glyphicons/png/glyphicons-social-40-e-mail.png" class="icon-img"></span>
                    </div>
                    <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>

                    @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="/images/glyphicons/png/glyphicons-204-lock.png" class="icon-img" alt="{{ env('APP_TITLE') }}">
                        </span>
                    </div>
                    <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Password" required>

                    @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="/images/glyphicons/png/glyphicons-204-lock.png" class="icon-img" alt="{{ env('APP_TITLE') }}">
                        </span>
                    </div>

                    <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <div class="input-group mb-3">
                    <button type="submit" class="form-control text-center create-button">
                        {{ __('Reset Password') }}
                    </button>
                </div>
                <div class="input-group mb-3">
                    <a href="{{ route('login') }}" class="btn btn-link">Return to Sign In</a>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>
@endsection
@section('javascripts')
    @parent
@stop
