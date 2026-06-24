<div id = "header">
    <header class="header sticky-active ">
        <div class="primary-header">
            <div class="container py-2">
                <div class="primary-header-inner">
                    <div class="header-left-wrap">
                        <div class="header-logo d-lg-block">
                            <a href="{{ route('website.home') }}">
                                <img src="{{ Path::AppLogo() }}" alt="{{ $configrations['site_name'] }}">
                            </a>
                        </div>
                        <div class="header-menu-wrap header-desktop-menu">
                            <div class="mobile-menu-items">
                                <ul>
                                    @foreach ($menus as $menu)
                                    @if( $menu->route_name == \App\Enums\MenuRouteName::PROJECTS->value)    
                                    <li class="menu-item-has-children">
                                        <a
                                            href="{{ route('website.' . $menu->route_name) }}">{{ $menu->name }}</a>
                                        <ul>
                                            @foreach ($headerCategories as $category)
                                                <li class="menu-item">
                                                    <a
                                                        href="{{ route('website.categoryDetails', $category) }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul> 
                                    </li>
                                    @elseif( $menu->route_name == \App\Enums\MenuRouteName::PREVIOUS_PROJECTS->value)    
                                    <li class="menu-item-has-children">
                                        <a
                                            href="{{ route('website.' . $menu->route_name) }}">{{ $menu->name }}</a>
                                        <ul>
                                            @foreach ($previousProjects as $project)
                                            <li class="menu-item">
                                                <a
                                                    href="{{ route('website.projectDetails', $project->slug) }}">{{ $project->name }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @elseif ($menu->children->isNotEmpty())
                                            <li class="menu-item-has-children">
                                                <a
                                                    href="#">{{ $menu->name }}</a>
                                                <ul>
                                                    @foreach ($menu->children as $child)
                                                        <li><a
                                                                href="{{ route('website.' . $child->route_name) }}">{{ $child->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li class="menu-item">
                                                <a
                                                    href="{{ route('website.' . $menu->route_name) }}">{{ $menu->name }}</a>
    
                                            </li>
                                        @endforeach
                                    </ul> 
                                </li>
                                @elseif( $menu->route_name == \App\Enums\MenuRouteName::PREVIOUS_PROJECTS->value)    
                                <li class="menu-item-has-children">
                                    <a
                                        href="{{ route('website.' . $menu->route_name) }}">{{ $menu->name }}</a>
                                    <ul>
                                        @foreach ($previousProjectsCategories as $category)
                                        <li class="menu-item">
                                            <a
                                                href="{{ route('website.categoryDetails', $category) }}">{{ $category->name }}</a>
                                            </li>
                                            {{-- @foreach ($category->projects as $project)
                                            <li class="menu-item">
                                                <a
                                                    href="{{ route('website.projectDetails', $project->slug) }}">{{ $project->name }}</a>
                                            </li>
                                            @endforeach --}}
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @elseif ($menu->children->isNotEmpty())
                                        <li class="menu-item-has-children">
                                            <a
                                                href="#">{{ $menu->name }}</a>
                                            <ul>
                                                @foreach ($menu->children as $child)
                                                    <li><a
                                                            href="{{ route('website.' . $child->route_name) }}">{{ $child->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li class="menu-item">
                                            <a
                                                href="{{ route('website.' . $menu->route_name) }}">{{ $menu->name }}</a>

                                        </li>
                                    @endif
                                @endforeach
                             
                            </ul>
                        </div>
                        <!-- /.header-menu-wrap -->
                    </div>
                    <!-- /.header-menu-wrap -->
                </div>
                <div class="header-right-wrap">
                    <div class="header-desktop-extras">
                        <a href="{{ $altLangLink }}" class="header-lang-switch" hreflang="{{ $targetLang }}"
                            rel="alternate"
                            aria-label="{{ $targetLang === 'en' ? 'Switch to English' : 'Switch to Arabic' }}">
                            <i class="fa-solid fa-globe" aria-hidden="true"></i>
                            <span>{{ $targetLang === 'en' ? 'EN' : 'AR' }}</span>
                        </a>
                        <a href="tel:{{ $settings['phone'] }}" class="header-contact">
                            <span class="icon"><i class="fa-regular fa-phone"></i></span>
                            <span class="content">
                                <span class="call-text">{{ __('website.call_us') }}</span>
                                <span class="call-number">{{ $settings['phone'] }}</span>
                            </span>
                        </a>
                        <div class="header-btn-wrap">
                            <a href="{{ route('website.contact-us') }}" class="tl-primary-btn header-btn">{{ __('website.get_in_touch') }}</a>
                        </div>
                        <div class="header-mobile-extras ">
                            <a href="{{ $altLangLink }}" class="header-lang-switch header-lang-switch--mobile"
                                hreflang="{{ $targetLang }}" rel="alternate"
                                aria-label="{{ $targetLang === 'en' ? 'Switch to English' : 'Switch to Arabic' }}">
                                <i class="fa-solid fa-globe" aria-hidden="true"></i>
                                <span>{{ $targetLang === 'en' ? 'EN' : 'AR' }}</span>
                            </a>
                            <a href="tel:{{ $settings['phone'] }}" class="mobile-header-call" aria-label="Call {{ $configrations['site_name'] }}">
                                <i class="fa-regular fa-phone" aria-hidden="true"></i>
                            </a>
                            <button type="button" class="mobile-side-menu-toggle mobile-nav-trigger" aria-label="Open menu"
                                aria-expanded="false" aria-controls="alfa-mobile-drawer">
                                <span class="mobile-nav-trigger__bar" aria-hidden="true"></span>
                                <span class="mobile-nav-trigger__bar" aria-hidden="true"></span>
                                <span class="mobile-nav-trigger__bar" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                    <div class="header-mobile-extras ">
                        <a href="{{ $altLangLink }}" class="header-lang-switch header-lang-switch--mobile"
                            hreflang="{{ $targetLang }}" rel="alternate"
                            aria-label="{{ $targetLang === 'en' ? 'Switch to English' : 'Switch to Arabic' }}">
                            <i class="fa-solid fa-globe" aria-hidden="true"></i>
                            <span>{{ $targetLang === 'en' ? 'EN' : 'AR' }}</span>
                        </a>
                        <a href="tel:{{ $settings['phone'] }}" class="mobile-header-call" aria-label="Call {{ $configrations['site_name'] }}">
                            <i class="fa-regular fa-phone" aria-hidden="true"></i>
                        </a>
                        <button type="button" class="mobile-side-menu-toggle mobile-nav-trigger" aria-label="Open menu"
                            aria-expanded="false" aria-controls="alfa-mobile-drawer">
                            <span class="mobile-nav-trigger__bar" aria-hidden="true"></span>
                            <span class="mobile-nav-trigger__bar" aria-hidden="true"></span>
                            <span class="mobile-nav-trigger__bar" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
                <!-- /.primary-header-inner -->
    
            </div>
    
        </div>
        <div class="side-menu-wrap mobile-nav-mount" id="alfa-mobile-nav-mount"></div>
        <div class="side-menu-lang">
            <a href="{{ $altLangLink }}" class="header-lang-switch header-lang-switch--drawer" hreflang="{{ $targetLang }}"
                rel="alternate"
                aria-label="{{ $targetLang === 'en' ? 'Switch to English' : 'Switch to Arabic' }}">
                <i class="fa-solid fa-globe" aria-hidden="true"></i>
                <span>{{ $targetLang === 'en' ? 'EN' : 'AR' }}</span>
            </a>
        </div>
        <div class="side-menu-contact">
            <div class="side-menu-header">
                <h3>{{ __('website.contact_us') }}</h3>
            </div>
    
        </div>
    </div>
    <div class="mobile-side-menu-overlay"></div>
    </div>