<section class="section-padding2">

    <div class="container">
        <div class="section-linetitle animate-box" data-animate-effect="fade2">
            <div class="title">
                <h6 class="sub-title">{{ __('website.our_gallery') }}</h6>
            </div>
        </div>
        <div class="row ms-4 me-4 animate-box" data-animate-effect="fade2">
            @foreach ($albums as $album)
                <div class="col-md-4 gallery-item">
                    <a href="{{ $album->image_path }}" title="" class="img-zoom">
                        <div class="gallery-box">
                            <div class="gallery-img"> <img src="{{ $album->image_path }}"
                                    class="img-fluid mx-auto d-block" alt="{{ $album->alt_image }}"> </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <div class="durubtn mt-30 mb-30">
                    <a href="{{ route('website.gallery') }}">
                        <span>{{ __('website.view_more') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
