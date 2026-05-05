<aside class="modern-side-card">
    <h4 class="section-eyebrow mb-3">Body Scan Features</h4>

    <ul class="modern-feature-list">
        <li class="modern-feature-item active">Biomagnetism Pair Body Scan</li>
        <li class="modern-feature-item">Guided body scan - simplified path to pairs</li>
        <li class="modern-feature-item">Learn at your own speed</li>
        <li class="modern-feature-item">Male and Female models</li>
        <li class="modern-feature-item">841 pairs</li>
        <li class="modern-feature-item">Pairs, radical and origin</li>
        <li class="modern-feature-item">Search data &amp; points on the body</li>
        <li class="modern-feature-item">+ direct pairs to patient database</li>
        <li class="modern-feature-item">Free Relaxing Music</li>
    </ul>

    <div class="modern-cta-block text-center">
        <p class="modern-cta-text">Start your Balance to Wellness on the surfboard today!</p>
        <a href="{{ empty(Auth::user()) ? '/register' : '/bodyscan' }}">
            <img src="{{ asset('/images/introduction/body_scan/button.png') }}" alt="{{ env('APP_TITLE') }}"
                class="modern-cta-image">
        </a>
    </div>
</aside>
