<section class="about section-padding " data-scroll-index="1">
    <div class="container">

        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-6 col-md-12 mb-10  animate-box" data-animate-effect="fadeInRight">
                <div class="section-linetitle animate-box" data-animate-effect="fade2">
                    <div class="title">
                        <h6 class="sub-title text-start">{{ $about->title }}</h6>
                    </div>
                </div>
                <p>{!! $about->text !!}</p>

                <a href="{{ route('website.about-us') }}" class="durubtn"> <span class="text-wrapper"><span
                            class="text slide-up">{{ __('website.read_more') }}</span><span
                            class="text slide-down">{{ __('website.read_more') }}</span></span></a>
            </div>
            <div class="col-lg-5 col-md-12  animate-box" data-animate-effect="fadeInLeft">
                <img src="{{ $about->image_path }}" class="img-fluid" alt="{{ $about->alt_image }}">
            </div>
        </div>
    </div>
</section>
