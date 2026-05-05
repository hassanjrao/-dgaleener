@extends('layouts.modern')

@section('page-title', 'Anew Avenue Biomagnetism | Introduction to Bio Connect')

@php
    $activeNav = 'connect';
@endphp

@section('content')
    <main class="modern-main-content">
        <section class="mb-4">
            <h3 class="eyebrow mb-2">Introduction</h3>
            <h1 class="hero-heading mb-0">
                Bio <span class="italic-wellness">Connect</span>
            </h1>
        </section>

        <div class="row modern-row-gap">
            <div class="col-12 col-lg-3">
                <aside class="modern-side-card modern-sticky-cta">
                    <p class="modern-cta-text text-center">Free to all users, Connect now!</p>
                    <p class="text-center mb-0">
                        <a href="{{ empty(Auth::user()) ? '/register' : '/bioconnect' }}">
                            <img src="{{ asset('/images/introduction/bioconnect/button.png') }}" alt="{{ env('APP_TITLE') }}"
                                class="modern-cta-image">
                        </a>
                    </p>
                </aside>
            </div>
            <div class="col-12 col-lg-9">
                <article class="modern-info-card">
                    <p class="text-center mb-4">
                        <img src="{{ asset('/images/introduction/bioconnect/banner.png') }}" alt="{{ env('APP_TITLE') }}"
                            class="img-fluid modern-info-banner">
                    </p>
                    <div class="modern-divider-card mb-4">
                        <h3 class="text-center mb-1">Bio Connect Staying in Tune</h3>
                        <h3 class="text-center mb-0">Listening to what others are chattering about Biomagnetism.</h3>
                    </div>
                    <ul class="modern-copy-list modern-copy-list-centered">
                        <li>Stay perched and on top of what is going on in Biomagnetism.</li>
                        <li>Integrating &amp; Interactive.</li>
                        <li>Crossing paths from far away and connecting, with common interest.</li>
                        <li>You never know who’s ship maybe passing thru full of wisdom and helpful words.</li>
                        <li>Guidance to navigate your direction with Biomagnetism.</li>
                        <li>Start a group, add friends, find friends, messages and notifications altogher in one place.</li>
                        <li>Bio Connect.</li>
                    </ul>
                    <p class="text-center mt-4 mb-0">
                        <img src="{{ asset('/images/introduction/bioconnect/message.gif') }}" alt="{{ env('APP_TITLE') }}"
                            class="img-fluid modern-message-image">
                    </p>
                </article>
            </div>
        </div>
    </main>
@endsection
