@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Forgot Password'}}
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
        <form method="POST" action="{{ route('password.email') }}" class="login-form">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><img
                                src="/images/glyphicons/png/glyphicons-social-40-e-mail.png" class="icon-img"></span>
                    </div>
                    <input id="username" type="text"
                            class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" placeholder="Username" required>
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
                            name="email" value="{{ old('email') }}" placeholder="Email" required>
                    @error('email')
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <button type="submit" class="form-control text-center create-button">
                        {{ __('Send Password Reset Link') }}
                    </button>
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
