<section class="header">
    @include('partials.auth')
    <div class="row row-2" style="position: relative;">
        <div class="col-md-12 text-center">
            @if (!empty($title))
                <h3>
                    {{ $title }}
                    @if (!empty($image_url))
                        <img src="{{ asset($image_url) }}" style="padding-left: 10px; width: 36px; margin-bottom: 5px;"
                            alt="{{ env('APP_TITLE') }}">
                    @endif
                </h3>
            @endif
        </div>
        @if (!empty($show_how_to_scan))
            <div style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%);">
                <button type="button" data-toggle="modal" data-target="#howToScanModal"
                    style="background: #6a3aab; color: #fff; border: none; border-radius: 8px; padding: 8px 14px; font-size: 13px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 6px; line-height: 1.2;">
                    <img src="{{ asset('/images/iconimages/humanicon48.png') }}" alt=""
                        style="width: 22px; filter: brightness(0) invert(1);">
                    <span>HOW<br>TO<br>SCAN</span>
                </button>
            </div>
        @endif
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
