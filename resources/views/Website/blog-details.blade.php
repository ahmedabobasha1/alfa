<x-website.layout :seoHandler="$seoHandler ?? ''">
    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => $blog->name ])
    <!-- end banner -->

    <!-- start blog details -->
    <section class="blog-details pt-150 pb-150 overflow-hidden">
        <div class="container container-2">
            <div class="row gy-5">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-details-wrap">
                        <div class="post-card post-card-2 inner-post">
                            <div class="post-content">
                                <ul class="post-meta">
                                    <li class="category">{{ $blog->category?->name }}</li>
                                    <li>{{ $blog->date }}</li>
                                   
                                </ul>
                                <h3 class="title">{{ $blog->name }}</h3>
                            </div>
                        </div>
                        <div class="blog-details-img mb-30">
                            <img src="{{ $blog->image_path }}" loading="lazy" alt="{{ $blog->alt_image }}">
                        </div>
                        <div class="blog-details-content">
                            <p class="mb-30">{!! $blog->long_desc !!}</p>
                           
                        </div>
                      
                       
                        <!-- ./ form-wrap -->
                    </div>
                </div>
                <!-- Sidebar Widgets -->
                <div class="col-lg-4">
                    <div class="sidebar-widget">
                        <h3 class="widget-title">{{ __('website.recent_articles') }}</h3>
                        @foreach ($related_blogs as $recentBlog)
                        <div class="sidebar-post">
                            <img src="{{ $recentBlog->image_path }}" loading="lazy" alt="{{ $recentBlog->alt_image }}">
                            <div class="post-content">
                                <h3 class="title"><a href="{{ route('website.blogDetails', $recentBlog->slug) }}">{{ $recentBlog->name }}</a></h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="sidebar-widget sticky-widget">
                       
                        <a href="{{ route('website.contact-us') }}" class="tl-primary-btn header-btn d-inline-flex align-items-center">{{ __('website.contact_us') }}<span class="icon ms-2"><i class="fa-regular fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end blog details -->
</x-website.layout>
