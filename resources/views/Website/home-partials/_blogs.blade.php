<section class="blog-section pb-130  fade-wrapper tl-bg-color">
    <div class="bg-shape" data-background="{{ Path::imagesPath('blogs/project-shape-2.png') }}"></div>
    <div class="container container-2">

        <div class="row section-heading-wrap fade-top">


            <div class="col-lg-4 col-md-12">
                <div class="section-heading mb-0">
                    <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char"
                        data-duration="0.9" data-stagger="0.03">{{ $blogs_section->title }}</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="section-heading section-heading-2 mb-0">
                    <h2 class="section-title cursor-effect title-2">{{ $blogs_section->second_title }}</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 fade-top">
            @foreach ($blogs as $blog)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="post-card h-100">
                    <div class="post-thumb">
                        <img src="{{ $blog->image_path }}" loading="lazy"
                            alt="{{ $blog->alt_image }}">
                        <span class="category">{{ $blog->category?->name }}</span>
                    </div>
                    <div class="post-content">
                        <ul class="post-meta">
                            <li>{{ $blog->date }}</li>
                            <li><span>{{ $blog->category?->name }}</span></li>
                        </ul>
                        <h3 class="title"><a href="{{ route('website.blogDetails', $blog->slug) }}">{{ $blog->name }}</a></h3>
                        <p>{{ $blog->short_desc }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="project-btn mt-5 fade-top">
                <a href="{{ route('website.blogs') }}" class="tl-primary-btn ">{{ __('website.all_blogs') }} <span class="icon"><i
                            class="fa-regular fa-arrow-right"></i></span></a>
            </div>
        </div>
    </div>
</section>