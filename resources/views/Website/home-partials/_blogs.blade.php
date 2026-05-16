<section class="portfolio4 section-padding">
    <div class="container">
        <div class="section-linetitle animate-box" data-animate-effect="fade2">
            <div class="title">
                <h6 class="sub-title">{{ __('website.our_blogs') }}</h6>
            </div>
        </div>
        <div class="row ms-4 animate-box" data-animate-effect="fadeInUp">
            <div class="col-md-12">
                <div class="portfolio4-container">
                    <div class="owl-carousel owl-theme">
                        @foreach ($blogs as $blog)
                            <div class="item transition-inner-all">
                                <img src="{{ $blog->image_path }}" class="img-fluid" alt="{{ $blog->alt_image }}">
                                <div class="cont hover">
                                    <div class="wrap"> <span class="title">{{ $blog->name }}</span>
                                        <div class="link">
                                            <a href="{{ route('website.blogDetails', $blog) }}">
                                                <div class="category">{{ $blog->category?->name }}</div><i
                                                    class="fa-light fa-arrow-right-long"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
