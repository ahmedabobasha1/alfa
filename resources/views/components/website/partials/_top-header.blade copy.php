<div class="header-top">
    <div class="container">
        <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
            <div class="col-auto d-none d-lg-block">
                <div class="header-links">
                    <ul>
                        <li>
                            <i class="fa-solid fa-envelope"></i>
                            <a href="mailto:{{ config('settings.site_email') }}">{{ config('settings.site_email') }}</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone"></i>
                            <a href="tel:+{{ $fullPhone }}">{{ $phone }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-auto">
                <div class="header-links">
                    <ul>
                        <li>
                            <div class="th-social">
                                @if (config('settings.site_facebook'))
                                    <a href="{{ config('settings.site_facebook') }}" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a>
                                @endif
                                @if (config('settings.site_twitter'))
                                    <a href="{{ config('settings.site_twitter') }}" target="_blank"><i
                                            class="fab fa-twitter"></i></a>
                                @endif
                                @if (config('settings.site_youtube'))
                                    <a href="{{ config('settings.site_youtube') }}" target="_blank"><i
                                            class="fab fa-youtube"></i></a>
                                @endif
                                @if (config('settings.site_whatsapp'))
                                    <a href="https://wa.me/{{ config('settings.site_whatsapp') }}" target="_blank"><i
                                            class="fab fa-whatsapp"></i></a>
                                @endif
                            </div>
                        </li>
                        <li class="lang-wrapper">
                            <div class="lang-menu">

                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @if ($localeCode != app()->getLocale())
                        <li>
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                        @endif
                        @endforeach

                </div>
                </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
