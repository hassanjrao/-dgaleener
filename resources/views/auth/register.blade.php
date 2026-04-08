
@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Register'}}
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
        <div class="text-center" style="margin-bottom: 24px;">
            <b><u>15 days Free Trial. No Card Needed. No Risk.</b></u>
        </div>
        <form method="POST" action="{{ route('register') }}" class="login-form">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><img
                                    src="{{asset('/images/glyphicons/png/glyphicons-4-user.png')}}"></div>
                    </div>
                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" placeholder="User Type" required>
                        @foreach(\Spatie\Permission\Models\Role::orderBy('name', 'desc')->whereIn('name', ['practitioner', 'therapist'])->get() as $role)
                            @if ($role->name != 'administrator')
                                <option value="{{$role->name}}">{{ucfirst($role->name)}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('type')
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><img
                                    src="{{asset('/images/glyphicons/png/glyphicons-4-user.png')}}"></div>
                    </div>
                    <input type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" name="name" id="name" placeholder="Name" required
                        autofocus>
                    @error('name')
                        <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><img
                                    src="{{asset('/images/glyphicons/png/glyphicons-social-40-e-mail.png')}}">
                        </div>
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
                        <div class="input-group-text"><img
                                    src="{{asset('/images/glyphicons/png/glyphicons-social-40-e-mail.png')}}">
                        </div>
                    </div>
                    <input type="text"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" name="email" id="email" placeholder="Email" required
                            autofocus>
                    @error('email')
                        <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><img
                                    src="{{asset('/images/glyphicons/png/glyphicons-204-lock.png')}}"></div>
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
                    <div class="input-group-prepend">
                        <div class="input-group-text"><img
                                    src="{{asset('/images/glyphicons/png/glyphicons-204-lock.png')}}"></div>
                    </div>
                    <input type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        value="{{ old('password_confirmation') }}" name="password_confirmation"
                        id="password_confirmation" placeholder="Confirm Password" required autofocus>
                    @error('password_confirmation')
                        <span class="invalid-feedback">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <button type="submit" class="form-control text-center create-button">
                        {{ __('Sign Up') }}
                    </button>
                </div>
                <div class="input-group mb-3">
                    <div class="offset-md-2">
                    <div class="checkbox">
                        <label>
                            Already have an existing account?
                        </label> 
                        <a href="{{ route('login') }}" class="btn btn-link">Sign In here</a>
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
