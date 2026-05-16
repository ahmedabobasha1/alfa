<x-website.layout :seoHandler="$seoHandler ?? ''">

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.our_blogs')])
    <!-- end banner -->
    <section class="blog-section pt-120 pb-120 fade-wrapper">
        <div class="container container-2">
            <div class="row g-4 fade-top">
                @foreach ($blogs as $blog)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="post-card h-100">
                        <div class="post-thumb">
                            <img src="{{ $blog->image_path }}" loading="lazy"
                                alt="{{ $blog->alt_image }}">
                            
                        </div>
                        <div class="post-content">
                            <ul class="post-meta">
                                <li>{{ $blog->date }}</li>
                               
                            </ul>
                            <h3 class="title"><a href="{{ route('website.blogDetails', $blog->slug) }}">{{ $blog->name }}</a></h3>
                            <p>{{ $blog->short_desc }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-website.layout>
