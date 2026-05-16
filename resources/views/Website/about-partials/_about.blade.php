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
