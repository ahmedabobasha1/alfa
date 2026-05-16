{{-- Basic Meta Tags --}}
   
    {{-- Title --}}
    @if (!empty($metaTags['title']))
        <title>{{ $metaTags['title'] ?? config('settings.site_name') }}</title>
    @endif
    {{-- Meta Title --}}
    @if (!empty($metaTags['title']))
    <meta name="title" content="{{ $metaTags['title'] ?? config('settings.site_name') }}">
    @endif
    {{-- Description --}}
    @if (!empty($metaTags['description']))
        <meta name="description" content="{{ $metaTags['description'] ?? config('settings.site_description') }}">
    @endif
    {{-- Author --}}
    @if (!empty($metaTags['author']))
        <meta name="author" content="{{ $metaTags['author'] ?? ''}}">
    @endif

    {{-- Robots --}}
    @if (!empty($metaTags['robots']))
        <meta name="robots" content="{{ $metaTags['robots'] ?? 'index, follow' }}">
    @endif

    {{-- Canonical --}}
    @if (!empty($metaTags['canonical']))
        <link rel="canonical" href="{{ $metaTags['canonical'] }}">
    @endif

    {{-- Content Type --}}
    @if (!empty($metaTags['content_type']))
        <meta http-equiv="Content-Type" content="{{ $metaTags['content_type'] }}">
    @endif

    {{-- Hreflang Tags --}}
    @foreach($hreflangTags ?? [] as $lang => $url)
        <link rel="alternate" hreflang="{{ $lang }}" href="{{ $url }}">
    @endforeach

    {{-- Open Graph Tags --}}
    @if (isset($openGraph) && is_array($openGraph))
        @foreach ($openGraph as $property => $content)
            @if (!empty($content))
                <meta property="{{ $property }}" content="{{ $content }}">
            @endif
        @endforeach
    @endif

    {{-- Twitter Card Tags --}}
    @if (isset($twitterCard) && is_array($twitterCard))
        @foreach ($twitterCard as $name => $content)
            @if (!empty($content))
                <meta name="{{ $name }}" content="{{ $content }}">
            @endif
        @endforeach
    @endif
    {{-- Character Set --}}
    <meta charset="utf-8">

    {{-- Viewport --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
