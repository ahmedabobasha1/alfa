<x-website.layout :seoHandler="$seoHandler ?? ''">

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.gallery')])
    <!-- end banner -->
    <section class="gallery-image section-padding">
        <div class="container">

            <div class="row gallery-wrap">
                @foreach ($albums as $album)
                    <div class="col-lg-4 col-md-6 gallery-item interior mb-25">
                        <a href="{{ $album->image_path }}" title="" class="img-zoom">
                            <div class="gallery-con">
                                <div class="gallery-img"> <img src="{{ $album->image_path }}"
                                        class="img-fluid mx-auto d-block" alt="{{ $album->alt_image }}"> </div>
                                <div class="gallery-detail">
                                    <h4>{{ $album->name }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-website.layout>
