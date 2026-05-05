<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"@if (!empty($useAppShell)) ng-app="AnewApp"@endif>
<head>
    @if (!empty($useAppShell))
        @include('partials.shared.meta')
    @else
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endif

    @php
        $siteTitle = config('app.title');
        $pageTitle = trim((string) $__env->yieldContent('page-title'));
    @endphp
    <title>{{ $pageTitle !== '' ? $pageTitle . ' - ' . $siteTitle : $siteTitle }}</title>

    <link href="{{ \App\Support\VersionedAsset::url('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modern/theme.css') }}" rel="stylesheet">

    @stack('head')
</head>
<body class="@yield('body-class', 'modern-theme')">
    @if (!isset($hideBrandBar) || !$hideBrandBar)
        @include('partials.modern.brand_bar')
    @endif

    @yield('content')

    @if (!isset($hideBottomNav) || !$hideBottomNav)
        @include('partials.modern.bottom_nav')
    @endif

    @if (!empty($useAppShell))
        @include('partials.shared.foot')
        <script type="text/javascript">
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endif

    @stack('scripts')
</body>
</html>
