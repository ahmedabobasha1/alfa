<footer id="footer" class="shadow-lg">
    <div class="container">
        <!-- Almira-style: 3 columns — company story | contact | address + embedded map -->
        <div class="footer-top px-md-5">
            <div class="row g-4 g-lg-5 align-items-start">
                <!-- 1) Brand + about (same role as Almira’s first column) -->
                <div class="col-lg-4 col-md-12">
                    <div class="footer-about">
                        <h4 class="footer-title">{{ $configrations['site_name'] }}</h4>
                        <div class="footer-logo mb-4">
                            <img src="{{ Path::FooterLogo() }}" alt="{{ $configrations['site_name'] }}" width="160" />
                        </div>
                        <p class="footer-description">
                            {!! $configrations['site_footer_text'] !!}
                        </p>
                        <div class="footer-social">
                            @if ($settings['site_facebook'])
                                <a href="{{ $settings['site_facebook'] }}" class="social-link"
                                    aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if ($settings['site_instagram'])
                                <a href="{{ $settings['site_instagram'] }}" class="social-link"
                                    aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if ($settings['site_twitter'])
                                <a href="{{ $settings['site_twitter'] }}" class="social-link"
                                    aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if ($settings['site_youtube'])
                                <a href="{{ $settings['site_youtube'] }}" class="social-link"
                                    aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                            @endif

                        </div>
                    </div>
                </div>

                <!-- 2) Contact (same role as Almira’s «تواصل معنا») -->
                <div class="col-lg-4 col-md-6">
                    <h4 class="footer-title">Contact us</h4>
                    <ul class="footer-almira-contact">
                        @foreach ($phones as $phone)
                            <li>
                                <span>{{ $phone->name }}</span>
                                <a href="tel:+{{ $phone->code . $phone->phone }}">{{ $phone->code . $phone->phone }}</a>
                            </li>
                        @endforeach
                        <li>
                            <span>Email</span>
                            <a href="mailto:{{ $settings['site_email'] }}">{{ $settings['site_email'] }}</a>
                        </li>
                        @foreach ($site_addresses as $site_address)
                            <li>
                                <span>{{ $site_address->name }}</span>
                                <a href="{{ $site_address->map_link }}"
                                    target="_blank">{{ $site_address->address }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- 3) Addresses + map in footer (same role as Almira’s «العناوين» + iframe) -->
                <div class="col-lg-4 col-md-6">
                    <h4 class="footer-title">{{ __('website.addresses') }}</h4>
                    <div class="footer-address-intro mb-3">
                        <p class="mb-2">
                            <strong class="d-block text-white mb-1"> {{$main_address->title}}</strong>
                            <a href="{{ $main_address->map_link }}" target="_blank" rel="noopener noreferrer"
                                class="footer-map-link">{{ $main_address->address }}</a>
                        </p>
                    </div>
                    <div class="footer-map-embed">
                        <iframe title="{{ $main_address->title }}" src="{{ $main_address->map_url }}" width="100%"
                            height="400" style="border: 0" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright text-center py-4">
            <p class="mb-0">
                &copy; All Rights Reserved
                <strong class="second-color">{{ $configrations['site_name'] }}</strong>
            </p>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="footer-decoration">
        <div class="decoration-circle circle-1"></div>
        <div class="decoration-circle circle-2"></div>
        <div class="decoration-line line-1"></div>
        <div class="decoration-line line-2"></div>
    </div>

</footer>
