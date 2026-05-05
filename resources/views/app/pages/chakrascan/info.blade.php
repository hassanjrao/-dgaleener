@extends('layouts.modern')

@section('page-title', 'Chakra Scan Info')

@php
    $activeNav = 'chakra';
@endphp

@section('content')
    <main class="modern-main-content">
        <section class="mb-4">
            <h3 class="eyebrow mb-2">Introduction</h3>
            <h1 class="hero-heading mb-0">
                Chakra <span class="italic-wellness">Body Scan</span>
            </h1>
        </section>

        <div class="row modern-row-gap">
            <div class="col-12 col-lg-4">
                @include('app.pages.chakrascan.partials.info_menu')
            </div>
            <div class="col-12 col-lg-8">
                @include('app.pages.chakrascan.partials.info_main')
            </div>
        </div>
    </main>
@endsection
