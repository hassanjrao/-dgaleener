<section class="header">
    @include('partials.auth')
    @php
        $hasTitleEs = !empty($title_es);
        $hasTitleIcon = !empty($image_url);
        $hasEnhancedTitle = $hasTitleEs || $hasTitleIcon;
    @endphp
    <div class="row row-2 {{ $hasEnhancedTitle ? 'row-2-bilingual' : '' }} {{ $hasTitleIcon && !$hasTitleEs ? 'row-2-title-icon-only' : '' }}">
        <div class="col-md-12 text-center {{ $hasEnhancedTitle ? 'header-title-row' : '' }}">
            @if (!empty($title))
                <h3 class="header-title {{ $hasEnhancedTitle ? 'header-title-bilingual' : '' }}">
                    @if ($hasEnhancedTitle)
                        <span class="header-title-copy">
                            <span class="header-title-en">{{ $title }}</span>
                            @if ($hasTitleEs)
                            <span class="header-title-divider"></span>
                            <span class="header-title-es">{{ $title_es }}</span>
                            @endif
                            @if ($hasTitleIcon)
                                <span class="header-title-icon-wrap">
                                    <img src="{{ \App\Support\VersionedAsset::url($image_url) }}" class="header-title-icon {{ $image_class ?? '' }}" alt="{{ env('APP_TITLE') }}">
                                </span>
                            @endif
                        </span>
                    @else
                        {{ $title }}
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
