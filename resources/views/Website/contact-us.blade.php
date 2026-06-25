<x-website.layout :seoHandler="$seoHandler ?? ''">
    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.contact_us')])
    <!-- end banner -->
 
  
    <section class="contact-section contact-section--v2 pt-80 pb-150">
        <div class="container container-2">

            <div class="row align-items-end justify-content-center text-center contact-section__header g-4 mb-5">
                <div class="col-lg-7">
                    <div class="section-heading mb-0">
                        <h4 class="sub-heading d-flex justify-content-center " data-text-animation="fade-in-right" data-split="char"
                            data-duration="0.9" data-stagger="0.03">{{ __('website.contact_us') }}</h4>
                            <div class="section-heading section-heading-2 mb-0">
                        <h2 class="section-title cursor-effect title-2 lh-md">{{ $contact_us_page->title }}</h2>
                    </div>
                    </div>
                </div>

            </div>

            <div class="row g-4 contact-info-cards mb-5">
                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="contact-info-card__icon">
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        </div>
                        <div class="request-item-wrap">
                            <div class="request-item ">
                                <span>{{ __('website.address') }}</span>
                                <p>{{ $main_address->address }}</p>
                            </div>
                            <div class="request-item ">
                                <span>{{ __('website.call_us') }}</span>
                                {{-- @foreach ($phones as $phone)
                                <a href="tel:+{{ $phone->code . $phone->phone }}">{{ $phone->code . $phone->phone }}</a>
                                @endforeach --}}
                                <a href="tel:+{{ $main_address->code . $main_address->phone }}">{{ $main_address->code . $main_address->phone }}</a>
                                <a href="mailto:{{ $settings['site_email'] }}">{{ $settings['site_email'] }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="contact-info-card__icon">
                            <i class="fa-regular fa-phone" aria-hidden="true"></i>
                        </div>
                        <div class="contact-info-card__body">
                            <span class="contact-info-card__label">{{ __('website.call_us') }}</span>
                            <a href="tel:+{{ $main_address->code . $main_address->phone }}"
                                class="contact-info-card__value contact-info-card__value--link">
                                {{ $main_address->code . $main_address->phone }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="contact-info-card__icon">
                            <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                        </div>
                        <div class="contact-info-card__body">
                            <span class="contact-info-card__label">{{ __('website.email_address') }}</span>
                            <a href="mailto:{{ $settings['site_email'] }}"
                                class="contact-info-card__value contact-info-card__value--link">
                                {{ $settings['site_email'] }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 g-lg-5 align-items-stretch contact-page-area">
                <div class="col-lg-6">
                    <div class="contact-form-card request-form-wrap">
                        <h3 class="contact-form-card__title">{{ __('website.send_message') }}</h3>
                        @include('Website.partials._contact-form')
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-map-card">
                        <iframe title="Map — {{ $configrations['site_name'] ?? 'Alfa' }}"
                            src="{{ $main_address->map_url }}"
                            width="100%" height="100%" style="border: 0"
                            allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-website.layout>
