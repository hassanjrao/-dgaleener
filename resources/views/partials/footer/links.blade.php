@if(!in_array(Route::getCurrentRoute()->uri(), ['home', 'media', 'playlist']) && Auth::user())
    <div class="col-md-5 text-center jp-player-section">
        @include('partials.footer.player')
    </div>
    <div class="col-md-1 text-center" data-toggle="tooltip" data-placement="top" title="Dashboard / Inicio">
        <a href="{{ route('app.dashboard') }}">
            <img src="{{asset('/images/iconimages/home80.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
    <div class="col-md-1 text-center" data-toggle="tooltip" data-placement="top" title="Body Scan / Escaneo corporal">
        <a href="{{ route('app.bodyscan') }}">
            <img src="{{asset('/images/iconimages/human-180.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
    <div class="col-md-1 text-center" data-toggle="tooltip" data-placement="top" title="Chakra Scan / Escaneo de chakra">
        <a href="{{ route('app.chakrascan') }}">
            <img src="{{asset('/images/iconimages/human80.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
    <div class="col-md-1 text-center" data-toggle="tooltip" data-placement="top" title="Data Cache / Caché de datos">
        <a href="{{ route('app.data_cache') }}">
            <img src="{{asset('/images/iconimages/briefcase80.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
    <div class="col-md-1 text-center" data-toggle="tooltip" data-placement="top" title="Bio Connect / Bio Connect">
        <a href="{{ route('app.bioconnect') }}">
            <img src="{{asset('/images/iconimages/share80.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
    <div class="col-md-1 text-center" data-toggle="tooltip" data-placement="top" title="More / Más">
        <a href="/products">
            <img src="{{asset('/images/iconimages/more80.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
@elseif(in_array(Route::getCurrentRoute()->uri(), ['pricing']))
@else
    <div class="col-md-2 text-center" data-toggle="tooltip" data-placement="top" title="Dashboard / Inicio">
        <a href="{{ route('app.dashboard') }}">
            <img src="{{asset('/images/iconimages/home80.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
    <div class="col-md-2 text-center" data-toggle="tooltip" data-placement="top" title="Body Scan / Escaneo corporal">
        <a href="{{ route('app.bodyscan') }}">
            <img src="{{asset('/images/iconimages/human-180.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
    <div class="col-md-2 text-center" data-toggle="tooltip" data-placement="top" title="Chakra Scan / Escaneo de chakra">
        <a href="{{ route('app.chakrascan') }}">
            <img src="{{asset('/images/iconimages/human80.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
    <div class="col-md-2 text-center" data-toggle="tooltip" data-placement="top" title="Data Cache / Caché de datos">
        <a href="{{ route('app.data_cache') }}">
            <img src="{{asset('/images/iconimages/briefcase80.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
    <div class="col-md-2 text-center" data-toggle="tooltip" data-placement="top" title="Bio Connect / Bio Connect">
        <a href="{{ route('app.bioconnect') }}">
            <img src="{{asset('/images/iconimages/share80.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
    <div class="col-md-2 text-center" data-toggle="tooltip" data-placement="top" title="More / Más">
        <a href="/products">
            <img src="{{asset('/images/iconimages/more80.png')}}" class="footer-images" alt="{{ env('APP_TITLE') }}">
        </a>
    </div>
@endif
