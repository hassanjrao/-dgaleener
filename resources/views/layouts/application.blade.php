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

            @if(!in_array(Route::getCurrentRoute()->uri(), ['home', 'media', 'playlist']) && Auth::user() && Auth::user()->hasVerifiedEmail() && Auth::user()->hasValidSubscription())
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
                        $.ajax({
                            url: allMediaUrl,
                            dataType: 'json',
                            cache: false
                        }).done(function(data){
                            if (Array.isArray(data) && data.length > 0) {
                                new jPlayerPlaylist({
                                    jPlayer: "#jquery_jplayer_all",
                                    cssSelectorAncestor: "#jp_container_all"
                                }, data, 
                                jPlayerConfig);
                                $('#jp_container_all').show();
                            } else {
                                $('#jp_container_all').hide();
                            }
                        }).fail(function(xhr){
                            $('#jp_container_all').hide();
                            console.error('Unable to load media playlist.', xhr);
                        });
                    });
                </script>
            @endif
        @show
    </body>
</html>
