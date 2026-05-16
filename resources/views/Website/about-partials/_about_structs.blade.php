@foreach ($about_structs as $key => $about_struct)
    @if ($loop->index % 2 == 0)
        <section class="about section-padding">
            <div class="container">
                <div class="section-linetitle">
                    <div class="d-flex align-items-center">
                        <div class="leter">
                            <h4>{{ $key + 1 }}</h4>
                        </div>
                        <div class="line"></div>
                    </div>
                    <div class="title">
                        <h6 class="sub-title">{{ $about_struct->title }}</h6>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6 col-md-12 animate-box" data-animate-effect="fadeInLeft">
                        <div class="image-wrapper" style="position: relative;"> <img class="img"
                                src="{{ $about_struct->icon_path }}" alt="{{ $about_struct->alt_icon }}">
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1 col-md-12 animate-box" data-animate-effect="fadeInRight">
                        <div class="section-title">{{ $about_struct->title }}</div>
                        <p>{!! $about_struct->text !!}</p>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="testimonials2 pt-80 mt-100 mb-0">
            <div class="container">
                <div class="section-linetitle">
                    <div class="d-flex align-items-center">
                        <div class="leter">
                            <h4>{{ $key + 1 }}</h4>
                        </div>
                        <div class="line"></div>
                    </div>
                    <div class="title">
                        <h6 class="sub-title">{{ $about_struct->title }}</h6>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 offset-lg-1 col-md-12 animate-box" data-animate-effect="fadeInRight">
                        <div class="section-title">{{ $about_struct->title }}</div>
                        <p>{!! $about_struct->text !!}</p>
                    </div>
                    <div class="col-lg-6 col-md-12 animate-box" data-animate-effect="fadeInLeft">
                        <div class="image-wrapper" style="position: relative;"> <img class="img"
                                src="{{ $about_struct->icon_path }}" alt="{{ $about_struct->alt_icon }}">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Rofaida text -->
            <div class="ornava-text">{{ $configrations['site_name'] }}</div>
        </section>
    @endif
@endforeach
