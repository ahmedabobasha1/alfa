<x-website.layout>
    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => $project->name ,'image' => $project->image_path])
    <!-- end banner -->
    <section class="portfolio-single section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 mb-30">
                    {{-- <h4>{{ __('website.description') }}</h4> --}}
                    <p class="mb-30">{!! $project->long_desc !!}</p>
                </div>
                {{-- <div class="col-lg-4 offset-lg-1 col-md-12">
                  <div class="cont">
                      <div class="item">
                          <div class="icon"><i class="fa-light fa-calendar-alt"></i></div>
                          <div class="title">Project Date</div>
                          <div class="value">26.05.2026</div>
                      </div>
                      <div class="item">
                          <div class="icon"><i class="fa-light fa-ruler-combined"></i></div>
                          <div class="title">Project Size</div>
                          <div class="value">1,450 m²</div>
                      </div>
                      <div class="item">
                          <div class="icon"><i class="fa-light fa-building"></i></div>
                          <div class="title">Number of Floors</div>
                          <div class="value">10</div>
                      </div>
                      <div class="item">
                          <div class="icon"><i class="fa-light fa-map-marker-alt"></i></div>
                          <div class="title">Location</div>
                          <div class="value">NY, USA</div>
                      </div>
                      <div class="item">
                          <div class="icon status-completed"><i class="fa-light fa-circle-check"></i></div>
                          <div class="title">Status</div>
                          <div class="value status-completed">Completed</div>
                      </div>
                  </div>
              </div> --}}

            </div>
        </div>
    </section>
    @if ($project->images->isNotEmpty())
        <section class="galleryscroll section-padding pt-0">
            <div class="container">
                <div class="section-linetitle">
                    <div class="d-flex align-items-center">
                        <div class="leter">
                            <h4>{{ __('website.gallery') }}</h4>
                        </div>
                        <div class="line"></div>
                    </div>
                    <div class="title">
                        <h6 class="sub-title">{{ __('website.gallery') }}</h6>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-0 box-right-7">
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme">
                            @foreach ($project->images as $image)
                                <div class="item">
                                    <a href="{{ $image->image_path }}" title="" class="img-zoom">
                                        <div class="img"> <img src="{{ $image->image_path }}"
                                                class="img-fluid mx-auto d-block"
                                                alt="{{ $project->alt_image . '-' . $loop->index }}"> </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

</x-website.layout>
