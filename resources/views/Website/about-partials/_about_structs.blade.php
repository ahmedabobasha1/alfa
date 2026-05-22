<section class="about-section about-page overflow-hidden">
    <div class="container">
        @foreach ($about_structs as $key => $about_struct)
            @if ($loop->index % 2 == 0)
                <div class="row align-items-center g-4 g-lg-5 about-page-row">
                    <div class="col-lg-6 order-lg-1">
                        <div class="about-img slide-anim" data-delay="0.3" data-offset="100" data-direction="left">
                            <img src="{{ $about_struct->icon_path }}" alt="{{ $about_struct->alt_icon }}" height="520px">
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-2">
                        <div class="about-content slide-anim" data-delay="0.3" data-offset="100" data-direction="right">
                            <div class="section-heading ">
                                <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char"
                                    data-duration="0.9" data-stagger="0.03">{{ $about_struct->title }}</h4>
                                <h2 class="section-title cursor-effect">{{ $about_struct->title }}</h2>
                            </div>
                            <p>{!! $about_struct->text !!}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="row align-items-center g-4 g-lg-5 about-page-row">
                    <div class="col-lg-6 order-lg-1">
                        <div class="about-content slide-anim" data-delay="0.3" data-offset="100" data-direction="left">
                            <div class="section-heading mb-30">
                                <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char"
                                    data-duration="0.9" data-stagger="0.03">{{ $about_struct->title }}</h4>
                                <h2 class="section-title cursor-effect">{{ $about_struct->title }}</h2>
                            </div>
                            <ul class="about-list">
                                {!! $about_struct->text !!}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-2">
                        <div class="about-img slide-anim" data-delay="0.3" data-offset="100" data-direction="right">
                            <img src="{{ $about_struct->icon_path }}" alt="{{ $about_struct->alt_icon }}"
                                height="520px">
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>
