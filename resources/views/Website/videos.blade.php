<x-website.layout :seoHandler="$seoHandler ?? ''">

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.gallery_videos')])
    <!-- end banner -->

    <section class="gallery-inner pt-130 pb-130 videos-embed-section">
        <div class="container container-2">
            <div class="row g-4">
                @foreach ($videos as $video)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class=" rounded-5 overflow-hidden shadow-sm">
                        <iframe class="border-0"
                            src="{{ $video->video_url }}"
                            title="{{ $video->title }}"
                            loading="lazy"
                            height="500px"
                            width="100%"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


</x-website.layout>
