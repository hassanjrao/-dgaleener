<header class="modern-brand-bar px-4 px-md-5" style="padding-top:0.75rem;padding-bottom:0.75rem;">
    <div class="d-flex align-items-center justify-content-between gap-3">

        <a href="{{ route('app.home') }}" class="brand-link text-decoration-none flex-shrink-0">
            <div class="d-flex align-items-center gap-2">
                <img src="/images/iconimages/load.png" alt="{{ config('app.name') }}" class="brand-logo-img">
                <span class="brand-title d-none d-sm-inline">{{ config('app.name') }}</span>
            </div>
        </a>

        <div class="d-flex align-items-center gap-2">
            @auth
                <a href="#pricing" class="brand-nav__pill d-none d-md-inline-flex">Pricing</a>
                <a href="#contact" class="brand-nav__pill d-none d-md-inline-flex">Contact Us</a>
                <button class="user-side-menu__trigger" id="userMenuTrigger" type="button" aria-label="Open user menu" aria-controls="userSideMenu">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            @else
                <a href="#pricing" class="brand-nav__pill d-none d-md-inline-flex">Pricing</a>
                <a href="#contact" class="brand-nav__pill d-none d-md-inline-flex">Contact Us</a>
                <a href="{{ route('login') }}" class="btn modern-auth-btn">Login</a>
            @endauth
        </div>

    </div>
</header>
