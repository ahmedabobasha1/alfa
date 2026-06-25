<section class="request-section pb-130">
    <div class="bg-img" data-background="{{ Path::imagesPath('contact/bg.jpg') }}"></div>
    <div class="container container-2">
        <div class="request-content">
            <div class="section-heading white-content">
                <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char"
                    data-duration="0.9" data-stagger="0.03">{{ __('website.contact_us') }}</h4>
                <h2 class="section-title cursor-effect title-2">
                    {{ $contact_section->title ?? ($contact_us_page->title ?? '') }}
                </h2>
            </div>
            <div class="request-item-wrap">
                <div class="request-item white-content">
                    <span>{{ __('website.address') }}</span>
                    <p>{{ $main_address->address }}</p>
                </div>
                <div class="request-item white-content">
                    <span>{{ __('website.call_us') }}</span>
                    <a href="tel:+{{ $main_address->code . $main_address->phone }}">{{ $main_address->code . $main_address->phone }}</a>
                    <a href="mailto:{{ $settings['site_email'] }}">{{ $settings['site_email'] }}</a>
                </div>
            </div>
        </div>
        <div class="row request-wrap">
            <div class="col-lg-6">
                <div class="contact-map-side h-100 d-flex flex-column">
                    <div class="contact-map contact-map--aside flex-grow-1 d-flex flex-column min-h-0">
                        <div class="map-container flex-grow-1 h-100">
                            <iframe title="Map — {{ $configrations['site_name'] ?? 'Alfa' }}"
                                class="rounded-5"
                                src="{{ $main_address->map_url }}"
                                width="100%" height="100%" style="border: 0; min-height: 380px"
                                allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="request-form-wrap">
                    @include('Website.partials._contact-form', [
                        'buttonClass' => 'white-btn',
                        'formVariant' => 'home',
                    ])
                </div>
            </div>
        </div>
    </div>
</section>
