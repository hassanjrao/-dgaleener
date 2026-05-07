<header class="modern-brand-bar px-4 px-md-5 py-4">
    <div class="d-flex align-items-center justify-content-between gap-3">

        <a href="{{ route('app.dashboard') }}" class="brand-link text-decoration-none">
            <div class="d-flex align-items-center gap-2">
                <div class="brand-mark">
                    <svg class="brand-mark-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="brand-title mb-0">Anew Avenue</h1>
                    <p class="brand-subtitle mb-0">Biomagnetism</p>
                </div>
            </div>
        </a>

        @auth
            <button class="user-side-menu__trigger" id="userMenuTrigger" type="button" aria-label="Open user menu" aria-controls="userSideMenu">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        @else
            <a href="{{ route('login') }}" class="btn modern-auth-btn">Login</a>
        @endauth

    </div>
</header>
