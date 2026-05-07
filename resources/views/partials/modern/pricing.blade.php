@php
    $pricingPlans = \App\Models\Plan::orderBy('price', 'asc')->get();
@endphp

<div class="modern-pricing-wrap">
    <div class="row justify-content-center modern-pricing-grid">
        @foreach($pricingPlans as $plan)
            @php $isFeatured = $plan->category === 'yearly'; @endphp
            <div class="col-12 col-sm-6 col-lg-5 mb-4">
                <div class="modern-pricing-card {{ $isFeatured ? 'modern-pricing-card--featured' : '' }}">
                    @if($isFeatured)
                        <div class="modern-pricing-card__badge">Best Value</div>
                    @endif

                    <div class="modern-pricing-card__header">
                        <h3 class="modern-pricing-card__name">{{ $plan->name }}</h3>
                        <div class="modern-pricing-card__price">
                            <span class="modern-pricing-card__currency">$</span>
                            <span class="modern-pricing-card__amount">{{ number_format($plan->price, 2) }}</span>
                        </div>
                        <p class="modern-pricing-card__period">per {{ $plan->category }}</p>
                    </div>

                    @if(!empty($plan->description))
                        <p class="modern-pricing-card__desc">{{ $plan->description }}</p>
                    @endif

                    <div class="modern-pricing-card__footer">
                        @if(!empty(Auth::user()))
                            <form method="POST" action="{{ route('app.plans.subscribe', ['id' => $plan->id]) }}">
                                @csrf
                                <button type="submit" class="modern-btn {{ $isFeatured ? 'modern-btn--primary' : 'modern-btn--outline' }} w-100">
                                    Subscribe
                                </button>
                            </form>
                        @else
                            <a href="{{ route('register') }}" class="modern-btn modern-btn--primary w-100">Get Started</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
