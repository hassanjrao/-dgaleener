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
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn modern-auth-btn">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn modern-auth-btn">Login</a>
        @endauth
    </div>
</header>
