<nav class="navbar navbar-default" role="navigation" id="navbarContainer">
    <div id="sidebarWrapper" class="sidebar-toggle">
        <ul class=" row sidebar-nav">
            <li class="col-md-12">
                <a class="{{ (Request::path() == 'bioconnect') || (Request::path() == 'bioconnect/friends') ? 'active' : '' }}" href="{{ url('/bioconnect/friends') }}">All Friends</a>
            </li>
            <li class="col-md-12">
                <a class="{{ Request::path() == 'bioconnect/friends/find' ? 'active' : '' }}" href="{{ url('/bioconnect/friends/find') }}">Find Friends</a>
            </li>
            <li class="col-md-12">
                <a class="{{ Request::path() == 'bioconnect/friends/request' ? 'active' : '' }}" href="{{ url('/bioconnect/friends/request') }}">Friend Requests</a>
            </li>
        </ul>
    </div>
</nav>