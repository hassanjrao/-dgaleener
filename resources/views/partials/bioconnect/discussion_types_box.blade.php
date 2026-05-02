<div class="my-4 dis_menucontainer">
    <h5 class="card-header">
        <span class="bioconnect-bilingual-label bioconnect-bilingual-label--left">
            <span class="bioconnect-label-en">Discussions</span>
            <span class="bioconnect-label-es">Discusiones</span>
        </span>
    </h5>
    <div class="card-body">
        <ul class="list-unstyled mb-0">
            <li>
                <a class="{{ Request::path() == 'bioconnect/groups' ? 'active' : '' }}" href="{{ url('/bioconnect/groups') }}">
                    <span class="bioconnect-bilingual-label bioconnect-bilingual-label--left">
                        <span class="bioconnect-label-en">Recent Discussions</span>
                        <span class="bioconnect-label-es">Discusiones recientes</span>
                    </span>
                </a>
            </li>
            <li>
                <a class="{{ Request::path() == 'bioconnect/groups/mostcomments' ? 'active' : '' }}" href="{{ url('/bioconnect/groups/mostcomments') }}">
                    <span class="bioconnect-bilingual-label bioconnect-bilingual-label--left">
                        <span class="bioconnect-label-en">Most Comments</span>
                        <span class="bioconnect-label-es">Más comentarios</span>
                    </span>
                </a>
            </li>
            <li>
                <a class="{{ Request::path() == 'bioconnect/groups/mydiscussion' ? 'active' : '' }}" href="{{ url('/bioconnect/groups/mydiscussion') }}">
                    <span class="bioconnect-bilingual-label bioconnect-bilingual-label--left">
                        <span class="bioconnect-label-en">My Discussions</span>
                        <span class="bioconnect-label-es">Mis discusiones</span>
                    </span>
                </a>
            </li>
            <li>
                <a class="{{ Request::path() == 'bioconnect/groups/mycomment' ? 'active' : '' }}" href="{{ url('/bioconnect/groups/mycomment') }}">
                    <span class="bioconnect-bilingual-label bioconnect-bilingual-label--left">
                        <span class="bioconnect-label-en">My Comments</span>
                        <span class="bioconnect-label-es">Mis comentarios</span>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
