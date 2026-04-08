<section class="header">
    @include('partials.auth')
    <div class="row row-2">
        <div class="col-md-12 text-center">
            @if (!empty($title))
                <h3>
                    {{$title}}
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
        @include('partials.menu')
    @else
        @include('partials.menu')
    @endif
</section>
@include('partials.flash_messages')
