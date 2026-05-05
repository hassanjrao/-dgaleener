<aside class="modern-side-card">
    <h4 class="section-eyebrow mb-3">Chakra Scan Features</h4>

    <ul class="modern-feature-list">
        <li class="modern-feature-item active">Chakra Body Scan</li>
        <li class="modern-feature-item">Guided body scan - simplified path to pairs</li>
        <li class="modern-feature-item">Learn at your own speed</li>
        <li class="modern-feature-item">Male and Female models</li>
        <li class="modern-feature-item">290 pairs</li>
        <li class="modern-feature-item">Pairs, radical and origin</li>
        <li class="modern-feature-item">Search data &amp; points on the body</li>
        <li class="modern-feature-item">+ direct pairs to patient database</li>
        <li class="modern-feature-item">Free Relaxing Music</li>
    </ul>

    <div class="modern-cta-block text-center">
        <p class="modern-cta-text">Click the pearl now to join!</p>
        <a href="{{ empty(Auth::user()) ? '/register' : '/chakrascan' }}">
            <img src="{{ asset('/images/introduction/chakra_scan/button.png') }}" alt="{{ env('APP_TITLE') }}"
                class="modern-cta-image modern-cta-image-md">
        </a>
    </div>
</aside>
