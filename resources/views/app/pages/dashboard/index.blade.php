@extends('layouts.modern')

@section('page-title', 'Dashboard')

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
                Open Major Chakra Vortexesto Release the Emotional Stress Behind Physical Imbalance, or Optimize Your Bio-Terrian by Balancing pH Radical Through Biomagnetism.
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
                <div class="col-12 col-md-6">
                    <a href="{{ route('app.dr_goiz_pairs') }}" class="module-card module-card--free p-4 p-lg-5 h-100 d-flex flex-column modern-gap-4 text-decoration-none">
                        <div class="module-card__free-badge">FREE</div>
                        <div class="icon-tile icon-tile-bio-connect">
                            <svg class="module-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="pill pill-bio-connect mb-3"><span class="pill-dot"></span>Free Protocol</span>
                            <h5 class="fw-bold text-dark mb-2">Free Protocol Pairs</h5>
                            <p class="text-secondary mb-0">Browse biomagnetism pair protocols for therapeutic reference.</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section id="pricing" class="mb-5">
            <h4 class="section-eyebrow mb-4">Plans &amp; Pricing</h4>
            @include('partials.modern.pricing')
        </section>

        <section class="mb-4">
            <h4 class="section-eyebrow mb-3">Quick Access</h4>
            <div class="d-flex flex-wrap modern-gap-2">
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

    {{-- Contact Us Section --}}
    <section id="contact" class="dashboard-contact">
        <div class="dashboard-contact__inner">
            <h2 class="dashboard-contact__title">Contact Us</h2>
            <p class="dashboard-contact__subtitle">Have a question or need help? We'd love to hear from you.</p>

            <div class="dashboard-contact__grid">
                <div class="dashboard-contact__info">
                    <div class="dashboard-contact__info-item">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ env('MAIL_FROM_ADDRESS', 'info@anewavenue.com') }}">{{ env('MAIL_FROM_ADDRESS', 'info@anewavenue.com') }}</a>
                    </div>
                    <div class="dashboard-contact__info-item">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                        <span>{{ env('APP_URL') }}</span>
                    </div>
                    <div class="dashboard-contact__info-item">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Mon – Fri, 9 AM – 5 PM</span>
                    </div>
                    <p class="dashboard-contact__blurb">
                        Whether you're a practitioner, therapist, or just curious about biomagnetism — reach out and we'll get back to you as soon as possible.
                    </p>
                </div>

                <form class="dashboard-contact__form" action="mailto:{{ env('MAIL_FROM_ADDRESS', 'info@anewavenue.com') }}" method="get" enctype="text/plain">
                    <input type="text"  name="name"    placeholder="Your Name"    class="dashboard-contact__input" required>
                    <input type="email" name="email"   placeholder="Your Email"   class="dashboard-contact__input" required>
                    <input type="text"  name="subject" placeholder="Subject"      class="dashboard-contact__input">
                    <textarea           name="message" placeholder="Your Message" class="dashboard-contact__textarea" rows="5" required></textarea>
                    <button type="submit" class="dashboard-contact__submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>
@endsection
