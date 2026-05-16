<x-website.layout :seoHandler="$seoHandler ?? ''">

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.our_blogs')])
    <!-- end banner -->
    <section class="portfolio2 section-padding">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                <div class="col-lg-6 col-md-12">
                    <div class="item mb-25">
                        <div class="img"> <img src="{{ $blog->image_path }}" alt="{{ $blog->alt_image }}"> </div>
                        <div class="icon-wrapper"> <i class="ti-arrow-top-right default-icon"></i>
                            <a href="{{ route('website.blogDetails', $blog) }}" class="hover-icon-link" title="View Project"> <i class="ti-arrow-top-right hover-icon"></i> </a>
                        </div>
                        <div class="con">
                            <h5>{{ $blog->name }}</h5>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>
</x-website.layout>
