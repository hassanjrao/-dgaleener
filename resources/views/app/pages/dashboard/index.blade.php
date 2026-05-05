@extends('layouts.modern')

@section('page-title', 'Anew Avenue Biomagnetism | Dashboard')

@php
    $activeNav = 'home';
@endphp

@section('content')
    <main class="modern-main-content">
        <section class="mb-5">
            <h3 class="eyebrow mb-4">Ion Positive &amp; Negative Alignment</h3>
            <h2 class="hero-heading mb-4">
                A journey to <span class="italic-wellness">wellness</span> through magnetic energy
            </h2>
            <div class="mb-4" style="width:3rem;height:2px;background:#006a63;"></div>
            <p class="mb-0 text-secondary" style="max-width:32rem;">
                Channeling cellular activity with magnetic fields to align electron fields, eradicating toxins, radicals,
                and pH imbalance.
            </p>
        </section>

        <section class="mb-5">
            <h4 class="section-eyebrow mb-4">Core Modules</h4>
            <div class="row modern-row-gap">
                <div class="col-12 col-md-6">
                    <a href="{{ route('app.bodyscan.info') }}" class="module-card p-4 p-lg-5 h-100 d-flex flex-column modern-gap-4 text-decoration-none">
                        <div class="icon-tile icon-tile-body-scan">
                            <svg class="module-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="pill pill-body-scan mb-3"><span class="pill-dot"></span>Body Scan</span>
                            <h5 class="fw-bold text-dark mb-2">Full Body Analysis</h5>
                            <p class="text-secondary mb-0">Detect energy imbalances across all organ systems and tissue fields.</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <a href="{{ route('app.chakrascan.info') }}" class="module-card p-4 p-lg-5 h-100 d-flex flex-column modern-gap-4 text-decoration-none">
                        <div class="icon-tile icon-tile-chakra-scan">
                            <svg class="module-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707m12.728 12.728L5.757 5.757" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="pill pill-chakra-scan mb-3"><span class="pill-dot"></span>Chakra Scan</span>
                            <h5 class="fw-bold text-dark mb-2">Energy Center Map</h5>
                            <p class="text-secondary mb-0">Visualize and assess vibrational alignment across all energy centers.</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <a href="{{ route('app.data_cache.info') }}" class="module-card p-4 p-lg-5 h-100 d-flex flex-column modern-gap-4 text-decoration-none">
                        <div class="icon-tile icon-tile-data-cache">
                            <svg class="module-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="pill pill-data-cache mb-3"><span class="pill-dot"></span>Data Cache</span>
                            <h5 class="fw-bold text-dark mb-2">Session Records</h5>
                            <p class="text-secondary mb-0">Access treatment history, session logs, and tracked progress over time.</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <a href="{{ route('app.bioconnect.info') }}" class="module-card p-4 p-lg-5 h-100 d-flex flex-column modern-gap-4 text-decoration-none">
                        <div class="icon-tile icon-tile-bio-connect">
                            <svg class="module-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="pill pill-bio-connect mb-3"><span class="pill-dot"></span>Bio Connect</span>
                            <h5 class="fw-bold text-dark mb-2">Practitioner Link</h5>
                            <p class="text-secondary mb-0">Connect with certified biomagnetism practitioners for guided sessions.</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section class="mb-4">
            <h4 class="section-eyebrow mb-3">Quick Access</h4>
            <div class="d-flex flex-wrap modern-gap-2">
                <button type="button" class="quick-access-pill border-0 d-inline-flex align-items-center modern-gap-2">
                    <span class="quick-access-dot" style="background:#22c55e;"></span>Dr. Goiz Pairs
                </button>
                <button type="button" class="quick-access-pill border-0 d-inline-flex align-items-center modern-gap-2">
                    <span class="quick-access-dot" style="background:#a78bfa;"></span>pH Balance Guide
                </button>
                <button type="button" class="quick-access-pill border-0 d-inline-flex align-items-center modern-gap-2">
                    <span class="quick-access-dot" style="background:#60a5fa;"></span>Toxin Pathways
                </button>
                <button type="button" class="quick-access-pill border-0 d-inline-flex align-items-center modern-gap-2">
                    <span class="quick-access-dot" style="background:#fb923c;"></span>Emotional Codes
                </button>
                <button type="button" class="quick-access-pill border-0 d-inline-flex align-items-center modern-gap-2">
                    <span class="quick-access-dot" style="background:#0d9488;"></span>Wellness Tracker
                </button>
            </div>
        </section>
    </main>
@endsection
