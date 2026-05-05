@extends('layouts.modern')

@section('page-title', 'Anew Avenue Biomagnetism | Introduction to Data Cache')

@php
    $activeNav = 'data';
@endphp

@section('content')
    <main class="modern-main-content">
        <section class="mb-4">
            <h3 class="eyebrow mb-2">Introduction</h3>
            <h1 class="hero-heading mb-0">
                Data <span class="italic-wellness">Cache</span>
            </h1>
        </section>

        <div class="row modern-row-gap">
            <div class="col-12 col-lg-3">
                <aside class="modern-side-card modern-sticky-cta">
                    <p class="modern-cta-text text-center">Tap to start your very own Data Cache.</p>
                    <p class="text-center mb-0">
                        <a href="{{ empty(Auth::user()) ? '/register' : '/data_cache' }}">
                            <img src="{{ asset('/images/introduction/data_cache/button.png') }}" alt="{{ env('APP_TITLE') }}"
                                class="modern-cta-image">
                        </a>
                    </p>
                </aside>
            </div>
            <div class="col-12 col-lg-9">
                <article class="modern-info-card modern-info-gradient">
                    <p class="text-center mb-4">
                        <img src="{{ asset('/images/introduction/data_cache/banner.png') }}" alt="{{ env('APP_TITLE') }}"
                            class="img-fluid modern-info-banner-wide">
                    </p>
                    <h2 class="modern-info-title text-center">Data Cache</h2>
                    <ul class="modern-copy-list modern-copy-list-centered">
                        <li>A treasure in itself, packed full of pairs (900 Bio or 387 Chakra), radicals, origin, detailed descriptions of causes and effects. Plus, alternative routes and complimentary pairs relation. All embedded deep within and locked away, to always be there for you.</li>
                        <li>A stand alone island, just for you, to add your confidential client’s detailed intake information and notes. Your locked away secure data are great tools of resources for your eyes only. Resources enabling you to research by case studies, past sessions, individual client’s log, patterns, symptoms, list by groups, client’s with familiarities.</li>
                        <li>Data Cache is interact based to work with each of the body scan models. Just by tapping the + icon in the body scan, will automatically direct the pair to the client cache. Or the Data Cache can be used as a stand alone database.</li>
                        <li class="mb-0">Our Data Cache is here to ease your task at hand. Assuring you more free time and accompany you to use your gifts of healing.</li>
                    </ul>
                </article>
            </div>
        </div>
    </main>
@endsection
