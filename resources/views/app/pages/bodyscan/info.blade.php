@extends('layouts.modern')

@section('page-title', 'Body Scan Info')

@php
    $activeNav = 'body';
@endphp

@section('content')
    <main class="modern-main-content">
        <section class="mb-4">
            <h3 class="eyebrow mb-2">Introduction</h3>
            <h1 class="hero-heading mb-0">
                Biomagnetism <span class="italic-wellness">Body Scan</span>
            </h1>
        </section>

        <div class="row modern-row-gap">
            <div class="col-12 col-lg-4">
                @include('app.pages.bodyscan.partials.info_menu')
            </div>
            <div class="col-12 col-lg-8">
                @include('app.pages.bodyscan.partials.info_main')
            </div>
        </div>
    </main>
@endsection
