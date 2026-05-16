<x-website.layout :seoHandler="$seoHandler ?? ''">

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.gallery')])
    <!-- end banner -->
    <section class="gallery-inner pt-130 pb-130">
        <div class="container container-2">
            <div class="row g-4">
                @foreach ($albums as $album)
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ $album->image_path }}" data-fancybox="gallery"
                        data-caption="{{ $album->name }}">
                        <img src="{{ $album->image_path }}" class="w-100 gallery-img object-fit-cover rounded-5"
                        height="500" loading="lazy" alt="{{ $album->alt_image }}" />
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</x-website.layout>
