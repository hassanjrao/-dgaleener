<section class="header">
    @include('partials.auth')
    <div class="row row-2 {{ !empty($title_es) ? 'row-2-bilingual' : '' }}">
        <div class="col-md-12 text-center {{ !empty($title_es) ? 'header-title-row' : '' }}">
            @if (!empty($title))
                <h3 class="header-title {{ !empty($title_es) ? 'header-title-bilingual' : '' }}">
                    @if (!empty($title_es))
                        <span class="header-title-copy">
                            <span class="header-title-en">{{ $title }}</span>
                            <span class="header-title-es">{{ $title_es }}</span>
                        </span>
                    @else
                        {{ $title }}
                    @endif
                    @if (!empty($image_url))
                        <img src="{{asset($image_url)}}" class="header-title-icon" alt="{{ env('APP_TITLE') }}">
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
