<x-website.layout :seoHandler="$seoHandler ?? ''">

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => $service->name ,'image' => $service->image_path])
    <!-- end banner -->
    <!-- start service details -->
<div class="service-details section-padding pb-0">
    <div class="container">
        <div class="row mb-60 justify-content-center text-center">
            <div class="col-lg-10 col-md-12 mb-30">
                <h4>{{ __('website.description') }}</h4>
                <p class="mb-30">{!! $service->long_desc !!}</p>
            </div>
        </div>
    </div>
</div>

    <!-- end service details -->
</x-website.layout>
