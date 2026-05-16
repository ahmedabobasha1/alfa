<x-website.layout :seoHandler="$seoHandler ?? ''">

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.gallery_videos')])
    <!-- end banner -->

    <section class="gallery-video section-padding">
        <div class="container">
            <div class="row gallery-wrap">

                @foreach ($videos as $video)
                <div class="col-lg-4 col-md-6 gallery-item interior mb-25 mt-1">
                    <a href="{{ $video->video_url }}" class="video-popup">
                        <div class="gallery-con">
                            <div class="gallery-img">
                                <iframe data-target="_blank" src="{{ $video->video_url }}"
                                    title="Video 1" frameborder="0" allowfullscreen></iframe>
                            </div>

                        </div>
                    </a>
                </div>
                @endforeach
              

            </div>
        </div>
    </section>


</x-website.layout>
