<x-website.layout :seoHandler="$seoHandler ?? ''">
    
    @if (isset($sliders) && $sliders->isNotEmpty())
        @include('Website.home-partials._slider')
    @endif

    @if (isset($about))
        @include('Website.home-partials._about')
    @endif
    
    {{-- @if (isset($statistics))
        @include('Website.home-partials._statistics')
    @endif --}}
    @if (isset($projects_section))
        @include('Website.home-partials._projects')
    @endif

    @if (isset($previous_projects_section) && $previous_projects->isNotEmpty())
        @include('Website.home-partials._previous-projects')
    @endif

    @if ($blogs->isNotEmpty())
         @include('Website.home-partials._blogs')
    @endif

  

  

   


    {{-- @include('Website.home-partials._contact-us') --}}


</x-website.layout>

