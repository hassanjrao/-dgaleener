<section class="header">
    @include('partials.auth')
    <div class="row row-2">
        <div class="col-md-12 text-center">
            @if (!empty($title))
                <h3>
                    @if (!empty($title_es))
                        <span style="display: inline-flex; flex-direction: column; align-items: center; line-height: 1.15;">
                            <span style="display: block;">{{ $title }}</span>
                            <span style="display: block; color: #ff6b4a; font-size: 0.72em; font-weight: 500;">{{ $title_es }}</span>
                        </span>
                    @else
                        {{ $title }}
                    @endif
                    @if (!empty($image_url))
                        <img src="{{asset($image_url)}}" style="padding-left: 10px; width: 36px; margin-bottom: 5px;" alt="{{ env('APP_TITLE') }}">
                    @endif
                </h3>
            @endif
        </div>
    </div>
    @if (!empty($menu) && $menu == 'bioconnect')
        @include('partials.bioconnect.menu')
    @elseif (!empty($menu) && $menu == 'data_cache')
        @include('partials.data_cache.menu')
    @else
        @include('partials.menu')
    @endif
</section>
@include('partials.flash_messages')
