@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Login'}}
@stop
@section('styles')
    @parent
    <link href="{{ asset('css/app/sessions.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="row main-body">
    <div class="col-md-4"></div>
    <div class="col-md-4" id="login-div">
        <span class="text-center logo-img"><img src="/images/iconimages/logo.png"></span>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('message.success'))
            <div class="alert alert-success">
                {{ session('message.success') }}
            </div>
        @endif
        @if (session('message.fail'))
            <div class="alert alert-danger">
                {{ session('message.fail') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><img
                                src="/images/glyphicons/png/glyphicons-social-40-e-mail.png" class="icon-img"></span>
                    </div>
                    <input type="text"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username') }}" name="username" id="username" placeholder="Username" required
                            autofocus>
                    @error('username')
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="/images/glyphicons/png/glyphicons-204-lock.png" class="icon-img" alt="{{ env('APP_TITLE') }}">
                        </span>
                    </div>
                    <input type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            value="{{ old('password') }}" name="password" id="password" placeholder="Password"
                            required autofocus>
                    @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <button type="submit" class="form-control text-center create-button">
                        {{ __('Sign In') }}
                    </button>
                </div>
                <div class="input-group mb-3">
                    <div class="offset-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label> 
                            <a href="/password/reset" class="btn btn-link">Forgot your Password?</a>
                        </div>
                    </div>
                    <div class="offset-md-2">
                        <div class="checkbox">
                            <label>
                                Don't have an account yet? 
                            </label> 
                            <a href="/register" class="btn btn-link">Sign Up now</a>
                        </div>
                    </div>
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
