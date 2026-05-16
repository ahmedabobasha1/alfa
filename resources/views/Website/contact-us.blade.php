<x-website.layout :seoHandler="$seoHandler ?? ''">
    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.contact_us')])
    <!-- end banner -->
    <!-- Contact Box -->
    <div class="contact-box">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-lg-4 col-md-6 d-flex animate-box" data-animate-effect="fadeInUp">

                    <div class="item"> <span class="icon fa-thin fa-envelope"></span>
                        <h5>{{ __('website.email') }}</h5>
                        <p><a href="mailto:{{ $settings['site_email'] }}">{{ $settings['site_email'] }}</a></p> <i
                            class="numb fa-solid fa-envelope"></i>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex animate-box" data-animate-effect="fadeInUp">

                    <div class="item"> <span class="icon fa-thin fa-location-dot"></span>
                        <h5>{{ __('website.address') }}</h5>
                        @foreach ($site_addresses as $site_address)
                            <p><a href="{{ $site_address->map_link }}" target="_blank">{{ $site_address->address }}</a>
                            </p>
                        @endforeach
                        <i class="numb fa-solid fa-location-dot"></i>
                    </div>
                </div>
<div class="col-lg-4 col-md-6 d-flex animate-box" data-animate-effect="fadeInUp">

    <div class="item">
        <span class="icon fa-thin fa-phone"></span>
        <h5>{{ __('website.call_us') }}</h5>

        @foreach ($phones as $phone)
            <p>
                <a href="tel:+{{ $phone->code . $phone->phone }}">
                    {{ $phone->phone }}
                </a>
            </p>
        @endforeach

        <!-- الأيقونة الناقصة -->
        <i class="numb fa-solid fa-phone"></i>
    </div>
</div>

            </div>
        </div>
    </div>

    <div class="info-box section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title mb-30 text-center">{{ __('website.get_in_touch') }}</div>
                    <div class="contact-form">
                        @include('Website.partials._contact-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="map">
        <iframe src="{{ $settings['site_map'] }}" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</x-website.layout>
