@if (empty(Auth::user()))
<div class="row row-3 bioconnect-menu">
    <div class="col-md-6 text-center">
        <a href="{{ url('/bioconnect') }}">
            <img src="{{ asset('/images/iconimages/friendicon24.png') }}" class="headerimageicon">
            <div class="headericontext {{ Request::path() == 'bioconnect' ? 'active' : '' }}">Users</div>
        </a>
    </div>
    <div class="col-md-6 text-center">
        <a href="{{ url('/bioconnect/groups') }}">
            <img src="{{ asset('/images/iconimages/groupicon24.png') }}" class="headerimageicon">
            <div class="headericontext {{ Request::path() == 'bioconnect/groups' ? 'active' : '' }}">Discussions</div>
        </a>
    </div>
</div>
@else 
<div class="row row-3 bioconnect-menu">
    <div class="col-md-1"></div>
    <div class="col-md-2 text-center">
        <a href="{{ url('/bioconnect/profile') }}">
            <img src="{{ asset('/images/iconimages/profile24.png') }}" class="headerimageicon" alt="{{ env('APP_TITLE') }}">
            <div class="headericontext {{ Request::path() == 'bioconnect/profile' ? 'active' : '' }}">Profile</div>
        </a>
    </div>
    <div class="col-md-2 text-center">
        <a href="{{ url('/bioconnect/activities') }}">
            <img src="{{ asset('/images/iconimages/activity24.png') }}" class="headerimageicon" alt="{{ env('APP_TITLE') }}">
            <div class="headericontext {{ Request::path() == 'bioconnect/activities' ? 'active' : '' }}">Activities</div>
        </a>
    </div>
    <div class="col-md-2 text-center">
        <a href="{{ url('/bioconnect/friends') }}">
            <img src="{{ asset('/images/iconimages/friendicon24.png') }}" class="headerimageicon" alt="{{ env('APP_TITLE') }}">
            <div class="headericontext {{ Request::path() == 'bioconnect/friends' || Request::path() == 'bioconnect/friends/find' ? 'active' : '' }}">Friends</div>
        </a>
    </div>
    <div class="col-md-2 text-center">
        <a href="{{ url('/bioconnect/groups') }}">
            <img src="{{ asset('/images/iconimages/groupicon24.png') }}" class="headerimageicon" alt="{{ env('APP_TITLE') }}">
            <div class="headericontext {{ Request::path() == 'bioconnect/groups' ? 'active' : '' }}">Groups</div>
        </a>
    </div>
    <div class="col-md-2 text-center"> 		
        <span class="notify-counter" style="display:none;"></span>
        <a id="see_notifi" href="#">
            <img src="{{ asset('/images/iconimages/notification24.png') }}" class="headerimageicon" alt="{{ env('APP_TITLE') }}">
            <div class="headericontext">Notifications</div>
        </a>  
        <ul id="notifi_desc" class="notifi-container"> 
        </ul>		
    </div>
</div>
@endif