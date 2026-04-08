<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" ng-app="AnewApp">
    <head>
        @include('partials.shared.meta')
        @include('partials.shared.link_fonts')

        @section('styles')
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app/admin.css') }}" rel="stylesheet">
        <style>
            .editor-edit,
            .editor-remove {
                font-size: 1.5em !important;
            }
        </style>
        @show
        
        <title>@yield('page-title')</title>
    </head>
    <body class="container-fluid">
        <div class="wrapper" id="app">
            @include('partials.admin.topnav')
            <br clear="all" />
            <div class="content-wrapper bg">
                <section class="content">
                    @include('partials.admin.messages')
                    @yield('content')
                </section>
            </div>
        </div>
        @section('javascripts')
            <!-- Scripts -->
            <script src="{{ asset('js/manifest.js') }}"></script>
            <script src="{{ asset('js/vendor.js') }}"></script>
            <script src="{{ asset('js/app.js') }}"></script>
        @show
    </body>
</html>
