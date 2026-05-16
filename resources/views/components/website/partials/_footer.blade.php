<footer class="footer">
    <div class="background banner-img bg-img bg-imgfixed bg-position-top">
        <div class="container">
            <!-- top -->
            <div class="top ms-5 me-5">
                <div class="row align-items-center justify-content-between">

                    <!-- Left column -->
                    <div class="col-md-4">
                        <div class="item">
                            <div class="logo mb-30 w-75">
                                <img src="{{ Path::FooterLogo() }}" alt="{{ $configrations['site_name'] }}">
                            </div>
                            <p class="mb-15">
                                {!! $configrations['site_footer_text'] !!}
                            </p>

                            <div class="social-icons mb-30">
                                <ul class="list-inline">
                                    @if($settings['site_instagram'])
                                        <li><a href="{{ $settings['site_instagram'] }}" target="_blank"><i
                                                    class="fa-brands fa-instagram"></i></a></li>
                                    @endif
                                    @if($settings['site_twitter'])
                                        <li><a href="{{ $settings['site_twitter'] }}" target="_blank"><i
                                                    class="fab fa-x-twitter"></i></a></li>
                                    @endif
                                    @if($settings['site_facebook'])
                                        <li><a href="{{ $settings['site_facebook'] }}" target="_blank"><i
                                                    class="fa-brands fa-facebook-f"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Right column -->
                    <div class="col-md-4">
                        <div class="item">
                            <h3 class="mb-20 fs-4 fw-bold">{{ __('website.get_in_touch') }}</h3>

                            <div class="contact-list d-flex flex-column gap-3 align-items-start">
                                @foreach ($site_addresses as $site_address)
                                    <div class="d-flex align-items-center justify-content-md-end gap-2">
                                        <i class="ti-location-pin fs-5"></i>
                                        <p class="mb-0 fs-6"><a href="{{ $site_address->map_link }}" target="_blank">{{ $site_address->address }}</a></p>
                                    </div>
                                @endforeach

                                @foreach ($phones as $phone)
                                <div class="d-flex align-items-center justify-content-md-end  gap-2">
                                    <i class="ti-mobile fs-5"></i>
                                    <a class="mb-0 fs-6" href="tel:+{{ $phone->code . $phone->phone }}">{{  $phone->phone }}</a>

                                </div>
                                @endforeach

                                <div class="d-flex align-items-center justify-content-md-end  gap-2">
                                    <i class="ti-email  fs-5"></i>
                                    <a class="mb-0 fs-6" href="mailto:{{ $settings['site_email'] }}">{{ $settings['site_email'] }}</a>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- bottom -->
            <div class="bottom ms-5 me-5">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="links">
                            <ul>
                                <li><a href="{{ route('website.home') }}">{{ __('website.home') }}</a></li>
                                <li><a href="{{ route('website.about-us') }}">{{ __('website.about') }}</a></li>
                                <li><a href="{{ route('website.services') }}">{{ __('website.services') }}</a></li>
                                <li><a href="{{ route('website.projects') }}">{{ __('website.projects') }}</a></li>
                                {{-- <li><a href="{{ route('website.gallery') }}">{{ __('website.gallery') }}</a></li> --}}
                                {{-- <li><a href="{{ route('website.blogs') }}">{{ __('website.our_blogs') }}</a></li> --}}
                                <li><a href="{{ route('website.contact-us') }}">{{ __('website.contact') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 text-end">
                        <p>Copyright 2026 by <a href="https://www.be-group.com/" target="_blank">BeGroup</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
