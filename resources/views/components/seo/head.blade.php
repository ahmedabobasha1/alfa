@if (!empty($metatags))
    {{-- Basic Meta Tags --}}
    <meta charset="{{ $metatags['charset'] ?? 'utf-8' }}">
   
    <meta http-equiv="Content-Language" content="{{ $metatags['language'] ?? 'en' }}">
    <meta name="robots" content="{{ $metatags['robots'] ?? 'index, follow' }}">
    <meta name="description" content="{{ $metatags['description'] ?? '' }}">
    @if (!empty($metatags['keywords']))
        <meta name="keywords" content="{{ $metatags['keywords'] }}">
    @endif
    <meta name="author" content="{{ $metatags['author'] ?? '' }}">
    <title>{{ $metatags['title'] ?? config('settings.site_name') }}</title>

    @if (!empty($metatags['time']))
        <meta name="time" content="{{ $metatags['time'] }}">
    @endif


    {{-- Canonical --}}
    @if (!empty($metatags['canonical']))
        <link rel="canonical" href="{{ $metatags['canonical'] }}">
    @else
        {{-- Generate clean canonical URL without language prefix conflicts --}}
        @php
            $currentUrl = url()->current();
            $canonicalUrl = $currentUrl;

            // Remove language prefix if it exists and we're on a localized route
if (app()->getLocale() !== config('app.fallback_locale')) {
    $localePrefix = '/' . app()->getLocale();
    if (str_starts_with($currentUrl, $localePrefix)) {
        $canonicalUrl = str_replace($localePrefix, '', $currentUrl);
    }
}

// Ensure we have a clean base URL
$canonicalUrl = rtrim($canonicalUrl, '/');
if (empty($canonicalUrl)) {
    $canonicalUrl = url('/');
            }
        @endphp
        <link rel="canonical" href="{{ $canonicalUrl }}">
    @endif

    {{-- Favicon --}}
    <link rel="icon" href="{{ \App\Helper\Path::FavIcon() }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ \App\Helper\Path::FavIcon() }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $metatags['og_title'] ?? ($metatags['title'] ?? '') }}">
    <meta property="og:description" content="{{ $metatags['og_description'] ?? ($metatags['description'] ?? '') }}">
    @php
        // Use the same canonical URL logic for Open Graph
        $currentUrl = url()->current();
        $ogUrl = $currentUrl;

        // Remove language prefix if it exists
        if (app()->getLocale() !== config('app.fallback_locale')) {
            $localePrefix = '/' . app()->getLocale();
            if (str_starts_with($currentUrl, $localePrefix)) {
                $ogUrl = str_replace($localePrefix, '', $currentUrl);
            }
        }

        $ogUrl = rtrim($ogUrl, '/');
        if (empty($ogUrl)) {
            $ogUrl = url('/');
        }
    @endphp
    <meta property="og:url" content="{{ $metatags['og_url'] ?? $ogUrl }}">
    <meta property="og:image" content="{{ $metatags['og_image'] ?? asset('images/default-og.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $metatags['og_title'] ?? ($metatags['title'] ?? '') }}">
    <meta property="og:type" content="{{ $metatags['og_type'] ?? 'website' }}">
    <meta property="og:site_name" content="{{ $metatags['og_site_name'] ?? config('settings.site_name') }}">
    <meta property="og:locale" content="{{ $metatags['og_locale'] ?? app()->getLocale() }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metatags['twitter_title'] ?? ($metatags['title'] ?? '') }}">
    <meta name="twitter:description"
        content="{{ $metatags['twitter_description'] ?? ($metatags['description'] ?? '') }}">
    <meta name="twitter:image" content="{{ $metatags['twitter_image'] ?? asset('images/default-og.jpg') }}">
    <meta name="twitter:url" content="{{ $metatags['twitter_url'] ?? $ogUrl }}">
    @if (!empty($metatags['twitter_site']))
        <meta name="twitter:site" content="{{ $metatags['twitter_site'] }}">
    @endif
    @if (!empty($metatags['twitter_creator']))
        <meta name="twitter:creator" content="{{ $metatags['twitter_creator'] }}">
    @endif

    {{-- Performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="dns-prefetch" href="//www.googletagmanager.com">
@endif

{{-- Schema JSON-LD --}}
@if (!empty($schema))
    <script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@else
    {{-- Default WebPage Schema (safe encoding) --}}
    @php
        // Use the same canonical URL logic for schema
        $currentUrl = url()->current();
        $schemaUrl = $currentUrl;

        // Remove language prefix if it exists
        if (app()->getLocale() !== config('app.fallback_locale')) {
            $localePrefix = '/' . app()->getLocale();
            if (str_starts_with($currentUrl, $localePrefix)) {
                $schemaUrl = str_replace($localePrefix, '', $currentUrl);
            }
        }

        $schemaUrl = rtrim($schemaUrl, '/');
        if (empty($schemaUrl)) {
            $schemaUrl = url('/');
        }
    @endphp
    <script type="application/ld+json">
{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => $metatags['title'] ?? config('settings.site_name'),
        'url' => $metatags['canonical'] ?? $schemaUrl,
        'description' => $metatags['description'] ?? ''
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif

{{-- FAQ Schema --}}
@if (!empty($faq_schema))
    <script type="application/ld+json">
    {!! json_encode($faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif

{{-- Breadcrumb Schema --}}
@if (!empty($breadcrumb_schema))
    <script type="application/ld+json">
    {!! json_encode($breadcrumb_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif

{{-- Google Tag Manager --}}
@if (config('settings.google_tag_manager_id'))
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', '{{ config('settings.google_tag_manager_id') }}');
    </script>
@endif

{{-- Google Analytics --}}
@if (config('settings.google_analytics_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('settings.google_analytics_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '{{ config('settings.google_analytics_id') }}');
    </script>
@endif

{{-- Security --}}
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta http-equiv="Strict-Transport-Security" content="max-age=31536000; includeSubDomains; preload">
<!-- Google reCAPTCHA -->

<!-- ======== hreflang Tags ============ -->
@php
    $locales = ['ar', 'en'];
    $path = request()->path();
    $path = preg_replace('/^(ar|en)\/?/', '', $path); // إزالة اللغة من بداية المسار
    $path = $path ? '/' . $path : '';
    foreach ($locales as $locale) {
        echo '<link rel="alternate" hreflang="' . $locale . '" href="' . url('/' . $locale . $path) . '" />';
    }
@endphp


<!-- ======== Meta Keywords ============ -->
@if (!empty($metatags['keywords']))
    <meta name="keywords" content="{{ $metatags['keywords'] }}">
@endif

<!-- ======== Structured Data (JSON-LD) ============ -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Tulip",
    "url": "{{ url('/') }}",
    "potentialAction": {
        "@type": "SearchAction",
        "target": "{{ url('/') }}?q={search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Tulip",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('assets/website/images/logo.png') }}"
}
</script>
<!-- يمكن إضافة أنواع أخرى مثل Article وProduct وBreadcrumb حسب الصفحة -->

<!-- ======== PWA Manifest ============ -->
<link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#007bff">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="Tulip">
<link rel="apple-touch-icon" href="/assets/website/images/icon-152x152.png">

<!-- ======== AMP Support ============ -->
@if (request()->is('/'))
    <link rel="amphtml" href="{{ route('amp.home') }}">
@elseif(request()->is('about'))
    <link rel="amphtml" href="{{ route('amp.about') }}">
@elseif(request()->is('services'))
    <link rel="amphtml" href="{{ route('amp.services') }}">
@elseif(request()->is('contact'))
    <link rel="amphtml" href="{{ route('amp.contact') }}">
@endif

<!-- ======== Service Worker ============ -->
<script>
    if ('serviceWorker' in navigator) {
        // Register service worker immediately, don't wait for load
        (async function() {
            try {
                const registration = await navigator.serviceWorker.register('/sw.js', {
                    scope: '/' // Ensure SW controls all pages
                });
                console.log('✅ SW: Registered successfully with scope:', registration.scope);

                // Handle updates
                registration.addEventListener('updatefound', () => {
                    const newWorker = registration.installing;
                    console.log('🔄 SW: New version installing...');

                    newWorker.addEventListener('statechange', () => {
                        if (newWorker.state === 'installed') {
                            if (navigator.serviceWorker.controller) {
                                console.log(
                                    '🔄 SW: New version available, will activate on next load'
                                );
                            } else {
                                console.log('✅ SW: First time installation complete');
                            }
                        }
                    });
                });

                // Wait for service worker to be ready
                await navigator.serviceWorker.ready;
                console.log('🎉 SW: Ready and active');

                // Force claim all clients
                if (registration.active) {
                    registration.active.postMessage({
                        type: 'CLAIM_CLIENTS'
                    });
                }

            } catch (error) {
                console.error('❌ SW: Registration failed:', error);
            }
        })();

        // Handle online/offline status
        window.addEventListener('offline', () => {
            console.log('📱 App is now offline');
            document.body.classList.add('offline');

            // Test service worker response when offline
            fetch('/test-offline-navigation').catch(() => {
                console.log('🧪 SW: Offline navigation test - should show offline page');
            });
        });

        window.addEventListener('online', () => {
            console.log('🌐 App is back online');
            document.body.classList.remove('offline');

            // Refresh service worker cache when back online
            if (navigator.serviceWorker.controller) {
                navigator.serviceWorker.controller.postMessage({
                    type: 'REFRESH_CACHE',
                    url: window.location.href
                });
            }
        });
    } else {
        console.warn('⚠️ Service Worker not supported');
    }
</script>

<!-- Offline indicator styles -->
<style>
    .offline::before {
        content: '📱 غير متصل';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: #dc3545;
        color: white;
        text-align: center;
        padding: 8px;
        font-size: 14px;
        z-index: 9999;
    }
</style>
@php
    // Use the same canonical URL logic for AMP
    $currentUrl = url()->current();
    $ampCanonicalUrl = $currentUrl;

    // Remove language prefix if it exists
    if (app()->getLocale() !== config('app.fallback_locale')) {
        $localePrefix = '/' . app()->getLocale();
        if (str_starts_with($currentUrl, $localePrefix)) {
            $ampCanonicalUrl = str_replace($localePrefix, '', $currentUrl);
        }
    }

    $ampCanonicalUrl = rtrim($ampCanonicalUrl, '/');
    if (empty($ampCanonicalUrl)) {
        $ampCanonicalUrl = url('/');
    }
@endphp
<!-- Canonical URL is already handled in seo/head.blade.php component -->

<!-- ======== Open Graph Tags ============ -->
<meta property="og:title" content="{{ $metatags['title'] ?? 'Tulip - Professional Web Services' }}">
<meta property="og:description"
    content="{{ $metatags['description'] ?? 'Professional web development, SEO, and digital marketing services in Egypt. We help businesses grow online with cutting-edge technology and proven strategies.' }}">
<meta property="og:image" content="{{ asset('assets/website/images/og-image.jpg') }}">
@php
    // Use the same canonical URL logic for Open Graph
    $currentUrl = url()->current();
    $ogUrl = $currentUrl;

    // Remove language prefix if it exists
    if (app()->getLocale() !== config('app.fallback_locale')) {
        $localePrefix = '/' . app()->getLocale();
        if (str_starts_with($currentUrl, $localePrefix)) {
            $ogUrl = str_replace($localePrefix, '', $currentUrl);
        }
    }

    $ogUrl = rtrim($ogUrl, '/');
    if (empty($ogUrl)) {
        $ogUrl = url('/');
    }
@endphp
<meta property="og:url" content="{{ $ogUrl }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Tulip">
<meta property="og:locale" content="{{ app()->getLocale() }}">
<meta property="og:locale:alternate" content="{{ app()->getLocale() == 'en' ? 'ar' : 'en' }}">

<!-- ======== Twitter Card Tags ============ -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metatags['title'] ?? 'Tulip - Professional Web Services' }}">
<meta name="twitter:description"
    content="{{ $metatags['description'] ?? 'Professional web development, SEO, and digital marketing services in Egypt.' }}">
<meta name="twitter:image" content="{{ asset('assets/website/images/twitter-card.jpg') }}">
<meta name="twitter:site" content="@tulip">
<meta name="twitter:creator" content="@tulip">

<!-- ======== Additional Meta Tags ============ -->
<meta name="author" content="Tulip Team">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- ======== Lazy Loading Images ============ -->
<script>
    // Lazy loading for images
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('img').forEach(function(img) {
            img.setAttribute('loading', 'lazy');
        });
    });

    // PWA Install Prompt
    let deferredPrompt;
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;

        // Show install button if you have one
        const installButton = document.getElementById('install-pwa');
        if (installButton) {
            installButton.style.display = 'block';
            installButton.addEventListener('click', () => {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('User accepted the install prompt');
                    } else {
                        console.log('User dismissed the install prompt');
                    }
                    deferredPrompt = null;
                });
            });
        }
    });
</script>

<!-- Custom Error Pages Links (404, 500) -->
<link rel="canonical" href="{{ url()->current() }}" />
<link rel="alternate" type="text/html" href="{{ url('/404') }}" title="404 Not Found" />
<link rel="alternate" type="text/html" href="{{ url('/500') }}" title="500 Server Error" />

<!-- Performance & Web Vitals (for monitoring) -->
<script src="https://unpkg.com/web-vitals@3/dist/web-vitals.umd.js" crossorigin type="text/javascript"></script>
<script>
    window.addEventListener('load', function() {
        // Check if webVitals is loaded
        if (typeof webVitals !== 'undefined') {
            try {
                webVitals.getCLS(function(metric) {
                    console.log('CLS:', metric);
                });
                webVitals.getFID(function(metric) {
                    console.log('FID:', metric);
                });
                webVitals.getLCP(function(metric) {
                    console.log('LCP:', metric);
                });
                webVitals.getFCP(function(metric) {
                    console.log('FCP:', metric);
                });
                webVitals.getTTFB(function(metric) {
                    console.log('TTFB:', metric);
                });
            } catch (error) {
                console.warn('Web Vitals error:', error);
            }
        } else {
            console.warn('Web Vitals library not loaded');
        }
    });
</script>
