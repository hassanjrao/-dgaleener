<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('partials.shared.meta')
    @include('partials.shared.link_fonts')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app/homepage.css') }}" rel="stylesheet">

    <title>{{ env('APP_TITLE') }} | An App for Therapist and Practitioners of Biomagnetism</title>
</head>

<body>
    <div class="main">
        <div class="header">
            <div class="logo-left">
                <img src="{{ asset('images/homepage/flamingo.png') }}" alt="{{ env('APP_TITLE') }}" />
            </div>

            <div class="header-middle">
                <h1>{{ env('APP_TITLE') }}</h1>
                <h4>Discover a natural shift of healing with biomagnetism</h4>
            </div>

            <div class="logo-right">
                <img src="{{ asset('images/homepage/spiral.png') }}" alt="{{ env('APP_TITLE') }}" />
            </div>
        </div>
        <div class="main-menu">
            <ul class="nav">
                <li>
                    <a href="{{ route('app.dashboard') }}" class="active">
                        <img src="{{ asset('images/homepage/learn-more.png') }}"
                            alt="{{ env('APP_TITLE') }} | Learn more about Biomagnetism " />
                        <span>Learn More</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Auth::user() ? route('app.bodyscan') : route('app.bodyscan.info') }}">
                        <img src="{{ asset('images/homepage/bodyscan.png') }}"
                            alt="{{ env('APP_TITLE') }} | Body Scan" />
                        <span>Body Scan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Auth::user() ? route('app.chakrascan') : route('app.chakrascan.info') }}">
                        <img src="{{ asset('images/homepage/chakrascan.png') }}"
                            alt="{{ env('APP_TITLE') }} | Chakra Scan" />
                        <span>Chakra Scan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Auth::user() ? route('app.data_cache') : route('app.data_cache.info') }}">
                        <img src="{{ asset('images/homepage/dashboard.png') }}"
                            alt="{{ env('APP_TITLE') }} | Data Cache" />
                        <span>Data Cache</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Auth::user() ? route('app.bioconnect') : route('app.bioconnect.info') }}">
                        <img src="{{ asset('images/homepage/bioconnect.png') }}"
                            alt="{{ env('APP_TITLE') }} | Bio Connect" />
                        <span>Bio Connect</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('app.dr_goiz_pairs') }}">
                        <img src="{{ asset('images/homepage/more.png') }}"
                            alt="{{ env('APP_TITLE') }} | FREE PROTOCOL PAIRS" />
                        <span>FREE PROTOCOL PAIRS</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @include('partials.shared.foot')
</body>

</html>
