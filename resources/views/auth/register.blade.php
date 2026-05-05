@extends('layouts.modern')

@section('page-title', 'Register')

@php
    $hideBottomNav = true;
@endphp

@section('content')
    <main class="modern-main-content">
        <div class="modern-auth-wrap">
            <section class="modern-auth-card">
                <div class="text-center mb-4">
                    <img src="/images/iconimages/logo.png" alt="{{ env('APP_TITLE') }}" class="modern-auth-logo">
                    <h1 class="hero-heading modern-auth-title">Create <span class="italic-wellness">Account</span></h1>
                    <p class="modern-info-highlight mb-0"><strong>15 days Free Trial. No Card Needed. No Risk.</strong></p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if (session('message.success'))
                    <div class="alert alert-success">{{ session('message.success') }}</div>
                @endif
                @if (session('message.fail'))
                    <div class="alert alert-danger">{{ session('message.fail') }}</div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="type" class="modern-auth-label">User Type</label>
                            <select class="form-control modern-auth-input @error('type') is-invalid @enderror" id="type" name="type" required>
                                @foreach (\Spatie\Permission\Models\Role::orderBy('name', 'desc')->whereIn('name', ['practitioner', 'therapist'])->get() as $role)
                                    @if ($role->name != 'administrator')
                                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('type')
                                <span class="invalid-feedback d-block"><strong>{{ $errors->first('type') }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label for="name" class="modern-auth-label">Name</label>
                            <input type="text" class="form-control modern-auth-input @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" name="name" id="name" required>
                            @error('name')
                                <span class="invalid-feedback d-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label for="username" class="modern-auth-label">Username</label>
                            <input type="text" class="form-control modern-auth-input @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" name="username" id="username" required>
                            @error('username')
                                <span class="invalid-feedback d-block"><strong>{{ $errors->first('username') }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="email" class="modern-auth-label">Email</label>
                            <input type="email" class="form-control modern-auth-input @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" id="email" required>
                            @error('email')
                                <span class="invalid-feedback d-block"><strong>{{ $errors->first('email') }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label for="password" class="modern-auth-label">Password</label>
                            <input type="password" class="form-control modern-auth-input @error('password') is-invalid @enderror"
                                name="password" id="password" required>
                            @error('password')
                                <span class="invalid-feedback d-block"><strong>{{ $errors->first('password') }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label for="password_confirmation" class="modern-auth-label">Confirm Password</label>
                            <input type="password"
                                class="form-control modern-auth-input @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="password_confirmation" required>
                            @error('password_confirmation')
                                <span class="invalid-feedback d-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn modern-auth-btn-main btn-block">{{ __('Sign Up') }}</button>
                </form>

                <p class="text-center mt-3 mb-0">
                    Already have an existing account?
                    <a href="{{ route('login') }}" class="btn btn-link p-0 align-baseline">Sign In here</a>
                </p>
            </section>
        </div>
    </main>
@endsection
