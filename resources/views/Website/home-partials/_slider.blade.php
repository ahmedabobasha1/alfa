<section class="slider-section overflow-hidden">
    <div class="antra-slider swiper-container">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <div class="slider-item">
                    <div class="bg-img" data-background="{{ $slider->image_path }}"></div>
                    <div class="container slider-container">
                        <div class="slider-content-wrap">
                            <div class="slider-content">
                                <div class="section-heading white-content">
                                    <h4 class="sub-heading" data-animation="antra-fadeInDown"
                                        data-delay="1000ms" data-duration="1400ms">{{ $slider->sub_title }}</h4>
                                    <h2 class="section-title cursor-effect"
                                        data-animation="antra-fadeInDown" data-delay="1200ms"
                                        data-duration="1400ms">{{ $slider->title }}</h2>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>