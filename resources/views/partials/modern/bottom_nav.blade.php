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
@endphp

<nav class="glass-nav fixed-bottom">
    <div class="container-fluid px-3 px-md-5">
        <div class="row g-0 justify-content-between">
            @foreach ($navItems as $item)
                @php($isActive = $currentNav === $item['key'])
                <div class="col nav-col">
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
                            <svg class="modern-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707m12.728 12.728L5.757 5.757" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
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
                </div>
            @endforeach
        </div>
    </div>
</nav>
