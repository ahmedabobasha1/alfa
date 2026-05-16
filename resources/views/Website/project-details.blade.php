<x-website.layout>
    <!-- start banner -->
    @include('Website.partials._breadcrumb', [
        'page_title' => $project->name,
        'image' => $project->image_path,
    ])
    <!-- end banner -->
    <section class="portfolio-details pt-130 pb-130">
        <div class="container container-2">
            <div class="project-details-wrap">
                <h1 class="details-title">{{ $project->name }}</h1>
                {{-- <div class="project-details-meta">
                    <div class="details-meta">
                        <span>Location :</span>
                        <h5>New Narcissus</h5>
                    </div>
                    <div class="details-meta">
                        <span>project type :</span>
                        <h5>Residential</h5>
                    </div>
                    <div class="details-meta">
                        <span>Developer :</span>
                        <h5>Alfa Real Estate</h5>
                    </div>
                    <div class="details-meta">
                        <span>Unit range :</span>
                        <h5>147–294 sqm</h5>
                    </div>
                    <div class="details-meta">
                        <span>Area :</span>
                        <h5>Fifth Settlement</h5>
                    </div>
                    <div class="details-meta">
                        <span>Since :</span>
                        <h5>2005</h5>
                    </div>
                </div> --}}
                <div class="project-details-img project-details-img--media">
                    <div class="row g-4 align-items-stretch">
                        <div class="col-lg-7">
                            <div class="swiper pd-details-gallery">
                                <div class="swiper-wrapper">
                                    @foreach ($project->images as $image)
                                        <div class="swiper-slide">
                                            <a href="{{ $image->image_path }}" data-fancybox="project-gallery"
                                                data-caption="{{ $image->alt_image }}">
                                                <img src="{{ $image->image_path }}" alt="{{ $image->alt_image }}"
                                                    loading="lazy"></a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-prev pd-details-gallery-prev" role="button"
                                    aria-label="Previous slide"></div>
                                <div class="swiper-button-next pd-details-gallery-next" role="button"
                                    aria-label="Next slide"></div>
                                <div class="swiper-pagination pd-details-gallery-pagination"></div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-5">
                            <div class="pd-details-video ratio ratio-16x9 h-100">
                                <iframe class="border-0" src="https://www.youtube-nocookie.com/embed/XGf2EMXAOD0?rel=0"
                                    title="Project E57 — presentation video" loading="lazy"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen referrerpolicy="strict-origin-when-cross-origin"></iframe>
                            </div>
                        </div> --}}
                    </div>
                </div>
              
                <p>{!! $project->long_desc !!}</p>


            </div>
        </div>
    </section>

</x-website.layout>
