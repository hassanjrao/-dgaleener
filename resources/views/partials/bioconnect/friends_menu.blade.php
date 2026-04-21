<nav class="navbar navbar-default" role="navigation" id="navbarContainer">
    <div id="sidebarWrapper" class="sidebar-toggle">
        <ul class=" row sidebar-nav">
            <li class="col-md-12">
                <a class="{{ (Request::path() == 'bioconnect') || (Request::path() == 'bioconnect/friends') ? 'active' : '' }}" href="{{ url('/bioconnect/friends') }}">
                    <span class="bioconnect-bilingual-label bioconnect-bilingual-label--center">
                        <span class="bioconnect-label-en">All Friends</span>
                        <span class="bioconnect-label-es">Todos los amigos</span>
                    </span>
                </a>
            </li>
            <li class="col-md-12">
                <a class="{{ Request::path() == 'bioconnect/friends/find' ? 'active' : '' }}" href="{{ url('/bioconnect/friends/find') }}">
                    <span class="bioconnect-bilingual-label bioconnect-bilingual-label--center">
                        <span class="bioconnect-label-en">Find Friends</span>
                        <span class="bioconnect-label-es">Buscar amigos</span>
                    </span>
                </a>
            </li>
            <li class="col-md-12">
                <a class="{{ Request::path() == 'bioconnect/friends/request' ? 'active' : '' }}" href="{{ url('/bioconnect/friends/request') }}">
                    <span class="bioconnect-bilingual-label bioconnect-bilingual-label--center">
                        <span class="bioconnect-label-en">Friend Requests</span>
                        <span class="bioconnect-label-es">Solicitudes de amistad</span>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</nav>
