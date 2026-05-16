<section class="about-section">
    <div class="about-bg" data-background="{{ Path::imagesPath('about/bg.png') }}"></div>
    <!-- <div class="about-text"><span>ALFA</span></div> -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content white-content slide-anim" data-delay="0.15" data-offset="100"
                    data-direction="left">
                    <div class="section-heading white-content mb-30">
                        <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char"
                            data-duration="0.9" data-stagger="0.03">{{ $about->sub_title }}</h4>
                        <h2 class="section-title cursor-effect">{{ $about->title }} </h2>
                    </div>

                    <p>
                        {!! $about->text !!}
                    </p>
                    <div class="about-btn">
                        <a href="{{ route('website.about-us') }}"
                            class="tl-primary-btn white-btn">{{ __('website.about_us') }} <span class="icon"><i
                                    class="fa-regular fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-img slide-anim" data-delay="0.28" data-offset="100" data-direction="right">
                    <img src="{{ $about->image_path }}" alt="{{ $about->alt_image }}">
                </div>
            </div>
        </div>
    </div>
</section>
