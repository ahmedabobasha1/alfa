<section class="about section-padding" data-scroll-index="1">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-5 col-md-12 mb-30">
                <div class="section-title">{{ $about->title }}</div>
                <p>{!! $about->text !!}</p>
            </div>
            <div class="col-lg-5 offset-lg-2 col-md-12">
                <img src="{{ $about->image_path }}" class="img-fluid" alt="{{ $about->alt_image }}">
            </div>
        </div>
    </div>
</section>


<section class="about-section about-page overflow-hidden">
   
    <div class="container">
        <!-- Who We Are -->
        <div class="row align-items-center g-4 g-lg-5 about-page-row">
            <div class="col-lg-6 order-lg-1">
                <div class="about-content slide-anim" data-delay="0.3" data-offset="100"
                    data-direction="left">
                    <div class="section-heading mb-30">
                        <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char"
                            data-duration="0.9" data-stagger="0.03">{{ $about->sub_title }}</h4>
                        <h2 class="section-title cursor-effect">{{ $about->title }}</h2>
                        {{-- <h3 class="sub-heading about-page-lead-name mt-4 mb-0">{{ $about->title }}</h3> --}}
                    </div>
                    <p class="mb-0">{!! $about->text !!}</p>
                </div>
            </div>
            <div class="col-lg-6 order-lg-2">
                <div class="about-img slide-anim" data-delay="0.3" data-offset="100"
                    data-direction="right">
                    <img src="{{ $about->image_path }}" alt="{{ $about->alt_image }}">
                </div>
            </div>
        </div>

     
    </div>
</section>