<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" ng-app="AnewApp">
    <head>
        @include('partials.shared.meta')
        @include('partials.shared.link_fonts')

        @section('styles')
            <!-- Styles -->
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @show

        <title>@yield('page-title')</title>
    </head>
    <body class="main-container {{ in_array(Route::getCurrentRoute()->uri(), ['dashboard', 'introduction', 'data_cache']) ? 'body-inner-brown' : '' }}">
        <div class="gtranslate_wrapper"></div>
        <script>window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper","switcher_vertical_position":"top","float_switcher_open_direction":"bottom","flag_style":"3d"}</script>
<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
        <div id="app">
            @yield('content')
            @if(Route::getCurrentRoute()->uri() !== '/')
                @include('partials.footer')
            @endif
        </div>
        @section('javascripts')
            @include('partials.shared.foot')

            <script type="text/javascript">
                $(document).ready(function() {
                    $('[data-toggle="tooltip"]').tooltip();

                    $('input[type="date"]').addClass('date').attr('type','text');

                    $('input[type="date"]').keydown(function(e) {
                        e.preventDefault();
                    });

                    $datepicker_inputs = $('.date');
                    $.each($datepicker_inputs, function(index, element) {
                        $(element).datepicker({ dateFormat: "yy/mm/dd" });  
                    });
                });
            </script>

            @if(!in_array(Route::getCurrentRoute()->uri(), ['home', 'media', 'playlist']) && Auth::user())
                <script src="{{ asset('js/jquery.jplayer.js') }}" type="text/javascript"></script>
                <script src="{{ asset('js/jplayer.playlist.js') }}" type="text/javascript"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        var jPlayerConfig = {
                            swfPath: "../../dist/jplayer",
                            supplied: "mp3",
                            wmode: "window",
                            useStateClassSkin: true,
                            autoBlur: true,
                            smoothPlayBar: true,
                            keyEnabled: false,
                            playlistOptions: {
                                autoPlay: false,
                                enableRemoveControls: false
                            },
                            loop: true
                        }

                        var allMediaUrl = '{{ url("/media/all")}}';
                        $.get(allMediaUrl, function(data){
                            data = JSON.parse(data);
                            if(data){
                                new jPlayerPlaylist({
                                    jPlayer: "#jquery_jplayer_all",
                                    cssSelectorAncestor: "#jp_container_all"
                                }, data, 
                                jPlayerConfig);
                            }
                            $('#playerModal').modal('show');
                        });
                    });
                </script>
            @endif
        @show
    </body>
</html>
