<x-website.layout :seoHandler="$seoHandler ?? ''">
    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.contact_us')])
    <!-- end banner -->
   
    <section class="contact-section pt-80 pb-150">
        <div class="container container-2">

            <div class="row request-wrap contact-page-area">
                <div class="col-lg-6">
                    <div class="request-content mb-5">
                        <div class="section-heading">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char"
                                data-duration="0.9" data-stagger="0.03">{{ __('website.contact_us') }}</h4>
                            <h2 class="section-title cursor-effect title-2">{{ $contact_us_page->title }}</h2>
                        </div>
                        <div class="request-item-wrap">
                            <div class="request-item ">
                                <span>{{ __('website.address') }}</span>
                                <p>{{ $main_address->address }}</p>
                            </div>
                            <div class="request-item ">
                                <span>{{ __('website.support') }}</span>
                                @foreach ($phones as $phone)
                                <a href="tel:+{{ $phone->code . $phone->phone }}">{{ $phone->code . $phone->phone }}</a>
                                @endforeach
                                <a href="mailto:{{ $settings['site_email'] }}">{{ $settings['site_email'] }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="contact-map-side h-100 d-flex flex-column">

                        <div class="contact-map contact-map--aside flex-grow-1 d-flex flex-column ">
                            <div class="map-container flex-grow-1 h-100">
                                <iframe title="Map — Alfa Real Estate Development, New Cairo area"
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
                        @include('Website.partials._contact-form')
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-website.layout>
