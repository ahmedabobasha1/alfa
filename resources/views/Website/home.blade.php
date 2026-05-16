<x-website.layout :seoHandler="$seoHandler ?? ''">
    
    @if (isset($sliders) && $sliders->isNotEmpty())
        @include('Website.home-partials._slider')
    @endif

    @if (isset($about))
        @include('Website.home-partials._about')
    @endif

    @if (isset($services) && $services->isNotEmpty())
        @include('Website.home-partials._services')
    @endif

    @if (isset($projects_section))
        @include('Website.home-partials._projects')
    @endif

    @if ($albums->isNotEmpty())
        @include('Website.home-partials._gellery')
    @endif

    @if ($blogs->isNotEmpty())
        @include('Website.home-partials._blogs')
    @endif


    @include('Website.home-partials._contact-us')


</x-website.layout>

