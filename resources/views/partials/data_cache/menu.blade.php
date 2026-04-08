<div class="row row-3" style="margin-bottom: 30px;">
    <div class="col-md-2 text-center">
        <a href="{{ url('/data_cache') }}">
            <img src="{{ asset('/images/iconimages/home.png') }}" class="headerimageicon" alt="{{ env('APP_TITLE') }}">
            <div class="headericontext {{ Request::path() == 'data_cache' ? 'active' : '' }}">Home</div>
        </a>
    </div>
    <div class="col-md-2 text-center">
        <a href="{{ url('/data_cache/client_info') }}">
            <img src="{{ asset('/images/iconimages/groupicon24.png') }}" class="headerimageicon" alt="{{ env('APP_TITLE') }}">
            <div class="headericontext {{ Request::path() == 'data_cache/client_info' ? 'active' : '' }}">Client Info</div>
        </a>
    </div>
    <div class="col-md-2 text-center">
        <a href="{{ url('/data_cache/bio') }}">
            <img src="{{ asset('/images/iconimages/activity24.png') }}" class="headerimageicon" alt="{{ env('APP_TITLE') }}">
            <div class="headericontext {{ Request::path() == 'data_cache/bio' ? 'active' : '' }}">Bio</div>
        </a>
    </div>
    <div class="col-md-2 text-center">
        <a href="{{ url('/data_cache/chakra') }}">
            <img src="{{ asset('/images/iconimages/activity24.png') }}" class="headerimageicon" alt="{{ env('APP_TITLE') }}">
            <div class="headericontext {{ Request::path() == 'data_cache/chakra' ? 'active' : '' }}">Chakra</div>
        </a>
    </div>
    <div class="col-md-2 text-center">
        <a href="#" data-toggle="modal" data-target="#preferencesModal">
            <img src="{{ asset('/images/iconimages/friendicon24.png') }}" class="headerimageicon" alt="{{ env('APP_TITLE') }}">
            <div class="headericontext {{ Request::path() == 'data_cache/preferences' ? 'active' : '' }}">Preferences</div>
        </a>
    </div>
    <div class="col-md-2 text-center">
        <a href="{{ url('/data_cache/help') }}">
            <img src="{{ asset('/images/iconimages/notification24.png') }}" class="headerimageicon" alt="{{ env('APP_TITLE') }}">
            <div class="headericontext {{ Request::path() == 'data_cache/help' ? 'active' : '' }}">Help</div>
        </a>    
    </div>
</div>
