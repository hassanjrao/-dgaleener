<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">

        @section('styles')
        @show
    </head>
    <body>
        @yield('content')
    </body>
</html>
