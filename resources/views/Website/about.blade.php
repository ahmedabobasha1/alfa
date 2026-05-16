<x-website.layout :seoHandler="$seoHandler ?? ''">

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.about_us') ])
    <!-- end banner -->
    <!-- start about section -->
    @include('Website.about-partials._about', ['about' => $about])
    <!-- start about structs section -->
    @if(!empty($about_structs))
        @include('Website.about-partials._about_structs', ['about_structs' => $about_structs])
    @endif
    <!-- end about structs section -->

   
   
</x-website.layout>