<div class="my-4 dis_menucontainer">
    <h5 class="card-header">Discussions</h5>
    <div class="card-body">
        <ul class="list-unstyled mb-0">
            <li>
                <a class="{{ Request::path() == 'bioconnect/groups' ? 'active' : '' }}" href="{{ url('/bioconnect/groups') }}">Recent Discussions</a>
            </li>
            <li>
                <a class="{{ Request::path() == 'bioconnect/groups/mostcomments' ? 'active' : '' }}" href="{{ url('/bioconnect/groups/mostcomments') }}">Most Comments</a>
            </li>
            <li>
                <a class="{{ Request::path() == 'bioconnect/groups/mydiscussion' ? 'active' : '' }}" href="{{ url('/bioconnect/groups/mydiscussion') }}">My Discussions</a>
            </li>
            <li>
                <a class="{{ Request::path() == 'bioconnect/groups/mycomment' ? 'active' : '' }}" href="{{ url('/bioconnect/groups/mycomment') }}">My Comments</a>
            </li>
        </ul>
    </div>
</div>
