<x-website.layout :seoHandler="$seoHandler ?? ''">

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.our_services')])
    <!-- end banner -->

    <!-- start Services Section -->
    @if ($services->isNotEmpty())
        <!--==========================Services==========================-->
        <section class="services section-padding">
            <div class="container">
                <div class="section-linetitle">
                    <div class="title">
                        <h6 class="sub-title">{{ __('website.our_services') }}</h6>
                    </div>
                </div>
                <div class="services4 m-4">
                    <div class="container">
                        <div class="row">
                            
                            @foreach ($services as $service)
                        <div class="col-md-4">
                            <div class="square-flip">
                                <div class="square2">
                                    <div class="square-container2">
                                        <div class="icon"><img src="{{ $service->icon_path }}"
                                                alt="{{ $service->alt_icon }}"></div>
                                        <h4>{{ $service->name }}</h4>
                                        <p>{!! $service->short_desc !!}</p>
                                        <div class="durubtn"><a
                                                href="{{ route('website.serviceDetails', $service) }}">{{ __('website.read_more') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--==========================Services==========================-->
    @endif

    <!-- end Services Section-->


</x-website.layout>