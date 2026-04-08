<nav class="menu">
  <ul>
    <li><a href="{{ url('/admin') }}">{{ __('ANEW Admin') }}</a></li>
    <li class="sub-menu"><a href="#">{{ __('Pairs') }}</a>
      <ul>
          <li><a href="{{ url('/admin/pairs/bio') }}">{{ __('Bio') }}</a></li>
          <li><a href="{{ url('/admin/pairs/chakra') }}">{{ __('Chakra') }}</a></li>
      </ul>
    </li>
    <li class="sub-menu"><a href="/admin/media">{{ __('Media Files') }}</a>
      <ul>
          <li><a href="{{ url('/admin/media') }}">{{ __('List') }}</a></li>
      </ul>
    </li>
    <li class="sub-menu"><a href="/admin/playlist">{{ __('Playlists') }}</a>
      <ul>
          <li><a href="{{ url('/admin/playlist') }}">{{ __('List') }}</a></li>
      </ul>
    </li>
    <li class="sub-menu"><a href="#">{{ __('Model Labels') }}</a>
      <ul>
          <li><a href="{{ url('/admin/model_labels/body_scan') }}">{{ __('Body Scan') }}</a></li>
          <li><a href="{{ url('/admin/model_labels/chakra_scan') }}">{{ __('Chakra Scan') }}</a></li>
      </ul>
    </li>
    <li class="sub-menu"><a href="#">{{ __('Marketing') }}</a>
      <ul>
          <li><a href="{{ route('admin.orders') }}">{{ __('Orders') }}</a></li>
          <li><a href="{{ route('admin.plans') }}">{{ __('Plans') }}</a></li>
          <li><a href="{{ route('admin.products') }}">{{ __('Products') }}</a></li>
          <li><a href="{{ route('admin.subscriptions') }}">{{ __('Subscriptions') }}</a></li>
      </ul>
    </li>
    <li class="sub-menu"><a href="{{ url('/admin/users') }}">{{ __('Users') }}</a>
      <ul>
          <li><a href="{{ url('/admin/users') }}">{{ __('List') }}</a></li>
      </ul>
    </li>
    <li><a href="{{ url('/admin/email') }}">{{ __('Compose Email') }}</a></li>
    <li>
        <a href="{{ route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
  </ul>
</nav>