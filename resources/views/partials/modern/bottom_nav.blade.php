@php
    $routeName = Route::currentRouteName();
    $currentNav = $activeNav ?? null;

    if (!$currentNav) {
        switch ($routeName) {
            case 'app.dashboard':
                $currentNav = 'home';
                break;
            case 'app.bodyscan.info':
                $currentNav = 'body';
                break;
            case 'app.chakrascan.info':
                $currentNav = 'chakra';
                break;
            case 'app.data_cache.info':
                $currentNav = 'data';
                break;
            case 'app.bioconnect.info':
                $currentNav = 'connect';
                break;
            default:
                $currentNav = 'home';
                break;
        }
    }

    $navItems = [
        ['key' => 'home', 'label' => 'Home', 'route' => route('app.dashboard')],
        ['key' => 'body', 'label' => 'Body', 'route' => route('app.bodyscan')],
        ['key' => 'chakra', 'label' => 'Chakra', 'route' => route('app.chakrascan')],
        ['key' => 'data', 'label' => 'Data', 'route' => route('app.data_cache')],
        ['key' => 'connect', 'label' => 'Connect', 'route' => route('app.bioconnect')],
    ];

    $currentRouteUriForNav = optional(Route::getCurrentRoute())->uri() ?? '';
    $authUserForNav = Auth::user();
    $showPlayerInNav = $authUserForNav
        && method_exists($authUserForNav, 'hasVerifiedEmail') && $authUserForNav->hasVerifiedEmail()
        && method_exists($authUserForNav, 'hasValidSubscription') && $authUserForNav->hasValidSubscription()
        && !in_array($currentRouteUriForNav, ['home', 'media', 'playlist'], true)
        && (!isset($hidePlayer) || !$hidePlayer);
@endphp

<nav class="glass-nav fixed-bottom">
    <div class="container-fluid px-3 px-md-4 modern-nav-container">
        <div class="modern-nav-row">
            @if ($showPlayerInNav)
                <div class="modern-nav-player">
                    @include('partials.modern.player')
                </div>
            @endif
            <div class="modern-nav-items">
                @foreach ($navItems as $item)
                    @php($isActive = $currentNav === $item['key'])
                    <a href="{{ $item['route'] }}" class="modern-nav-item {{ $isActive ? 'active' : '' }}">
                        @if ($item['key'] === 'home')
                            <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        @elseif ($item['key'] === 'body')
                            <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        @elseif ($item['key'] === 'chakra')
                            <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 100 100" aria-hidden="true" stroke-width="1.2">
                                <circle cx="50" cy="50" r="32"/>
                                <circle cx="50" cy="50" r="16"/>
                                <circle cx="66" cy="50" r="16"/>
                                <circle cx="58" cy="36.1" r="16"/>
                                <circle cx="42" cy="36.1" r="16"/>
                                <circle cx="34" cy="50" r="16"/>
                                <circle cx="42" cy="63.9" r="16"/>
                                <circle cx="58" cy="63.9" r="16"/>
                            </svg>
                        @elseif ($item['key'] === 'data')
                            <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        @else
                            <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        @endif
                        <span class="modern-nav-label">{{ $item['label'] }}</span>
                        <span class="active-indicator"></span>
                    </a>
                @endforeach
                <button type="button" class="modern-nav-item modern-nav-item--disclaimer" id="disclaimerNavBtn" aria-label="View disclaimer">
                    <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                    <span class="modern-nav-label" style="line-height:1.2;">Disclaimer<br>Descargo</span>
                    <span class="active-indicator"></span>
                </button>
            </div>
        </div>
    </div>
</nav>

{{-- Disclaimer Modal --}}
<div class="disclaimer-modal-backdrop" id="disclaimerBackdrop" aria-hidden="true"></div>
<div class="disclaimer-modal" id="disclaimerModal" role="dialog" aria-modal="true" aria-hidden="true" aria-labelledby="disclaimerModalTitle">
    <div class="disclaimer-modal__header">
        <div class="d-flex align-items-center gap-2">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="color:#f59e0b;flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            <h2 class="disclaimer-modal__title" id="disclaimerModalTitle">Disclaimer</h2>
        </div>
        <button class="disclaimer-modal__close" id="disclaimerModalClose" type="button" aria-label="Close">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <div class="disclaimer-modal__body">
        <p class="disclaimer-modal__text">
            <strong>Disclaimer:</strong> This app is for self-education and research purposes only. Biomagnetic pairs are intended as biofeedback to support normal body function and are not a treatment, diagnosis, or prescription for any medical or psychological condition. These statements have not been evaluated by the FDA, and this tool is not intended to support or sustain human life or prevent health impairment. Users with existing medical conditions use this platform at their own risk.
        </p>
        <hr class="disclaimer-modal__divider">
        <p class="disclaimer-modal__text">
            <strong>Descargo de responsabilidad:</strong> Esta aplicación es solo para fines de autoeducación e investigación. Los pares biomagnéticos están destinados a ser una bioretroalimentación para apoyar el funcionamiento normal del cuerpo y no son un tratamiento, diagnóstico o prescripción para ninguna condición médica o psicológica. Estas declaraciones no han sido evaluadas por la FDA, y esta herramienta no está destinada a apoyar o sostener la vida humana ni a prevenir el deterioro de la salud. Los usuarios con condiciones médicas existentes utilizan esta plataforma bajo su propio riesgo.
        </p>
    </div>
</div>

<script>
(function () {
    var btn      = document.getElementById('disclaimerNavBtn');
    var modal    = document.getElementById('disclaimerModal');
    var backdrop = document.getElementById('disclaimerBackdrop');
    var closeBtn = document.getElementById('disclaimerModalClose');
    if (!btn || !modal) return;

    function open() {
        modal.setAttribute('aria-hidden', 'false');
        backdrop.setAttribute('aria-hidden', 'false');
        document.body.classList.add('disclaimer-modal-open');
        closeBtn.focus();
    }
    function close() {
        modal.setAttribute('aria-hidden', 'true');
        backdrop.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('disclaimer-modal-open');
        btn.focus();
    }

    btn.addEventListener('click', open);
    closeBtn.addEventListener('click', close);
    backdrop.addEventListener('click', close);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.getAttribute('aria-hidden') === 'false') close();
    });
}());
</script>
