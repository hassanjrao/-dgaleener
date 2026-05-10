@extends('layouts.modern')

@section('page-title', 'Data Cache Info')

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
           
            <div class="col-12 col-lg-12">
                <article class="modern-info-card modern-info-gradient">
                    <h2 class="modern-info-title text-center">Data Cache</h2>

                    {{-- Pair count stats --}}
                    <div class="dc-stats-row">
                        <div class="dc-stat">
                            <span class="dc-stat__number">800+</span>
                            <span class="dc-stat__label">Bio Pairs<br><em>Pares Bio</em></span>
                        </div>
                        <div class="dc-stat-divider"></div>
                        <div class="dc-stat">
                            <span class="dc-stat__number">289</span>
                            <span class="dc-stat__label">Chakra Pairs<br><em>Pares Chakra</em></span>
                        </div>
                    </div>

                    <ul class="modern-copy-list modern-copy-list-centered mt-3">
                        <li>A treasure in itself, packed full of pairs, radicals, origin, detailed descriptions of causes and effects. Plus, alternative routes and complimentary pairs relation. All embedded deep within and locked away, to always be there for you.</li>
                        <li>A stand alone island, just for you, to add your confidential client’s detailed intake information and notes. Your locked away secure data are great tools of resources for your eyes only. Resources enabling you to research by case studies, past sessions, individual client’s log, patterns, symptoms, list by groups, client’s with familiarities.</li>
                        <li>Data Cache is interact based to work with each of the body scan models. Just by tapping the + icon in the body scan, will automatically direct the pair to the client cache. Or the Data Cache can be used as a stand alone database.</li>
                    </ul>

                    {{-- Email highlight --}}
                    <div class="dc-feature-block dc-feature-email mt-3">
                        <div class="dc-feature-icon">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="dc-feature-title">Email to Client / <em>Enviar al Cliente</em></p>
                            <p class="dc-feature-en">Scan session results can be emailed directly to your client from within the Data Cache.</p>
                            <p class="dc-feature-es">Los resultados de la sesión de escaneo se pueden enviar directamente al cliente desde la Caché de Datos.</p>
                        </div>
                    </div>

                    {{-- Print highlight --}}
                    <div class="dc-feature-block dc-feature-print mt-2 mb-0">
                        <div class="dc-feature-icon">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        </div>
                        <div>
                            <p class="dc-feature-title">Print Ready / <em>Listo para Imprimir</em></p>
                            <p class="dc-feature-en">Session records can be printed directly from the Data Cache for your files or your client.</p>
                            <p class="dc-feature-es mb-0">Los registros de sesión se pueden imprimir directamente desde la Caché de Datos para sus archivos o para su cliente.</p>
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </main>
@endsection
