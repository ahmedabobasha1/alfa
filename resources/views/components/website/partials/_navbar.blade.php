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
                                        @endif
                                    @endforeach
                                 
                                </ul>
                            </div>
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
                            <div class="sidebar-icon d-md-none d-block">
                                <button type="button" class="sidebar-trigger open" aria-label="Open info panel">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11 2C11 0.89543 11.8954 0 13 0H14C15.1046 0 16 0.895431 16 2V3C16 4.10457 15.1046 5 14 5H13C11.8954 5 11 4.10457 11 3V2Z"
                                            fill="white" />
                                        <path
                                            d="M0 2C0 0.89543 0.895431 0 2 0H3C4.10457 0 5 0.895431 5 2V3C5 4.10457 4.10457 5 3 5H2C0.89543 5 0 4.10457 0 3V2Z"
                                            fill="white" />
                                        <path
                                            d="M0 13C0 11.8954 0.895431 11 2 11H3C4.10457 11 5 11.8954 5 13V14C5 15.1046 4.10457 16 3 16H2C0.89543 16 0 15.1046 0 14V13Z"
                                            fill="white" />
                                        <path
                                            d="M11 13C11 11.8954 11.8954 11 13 11H14C15.1046 11 16 11.8954 16 13V14C16 15.1046 15.1046 16 14 16H13C11.8954 16 11 15.1046 11 14V13Z"
                                            fill="white" />
                                    </svg>
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
                </div>
                <!-- /.primary-header-inner -->
    
            </div>
    
        </div>
    
    </header>
    
    <div class="mobile-side-menu" id="alfa-mobile-drawer">
        <div class="side-menu-content">
            <div class="side-menu-head">
                <a href="{{ route('website.home') }}"><img src="{{ Path::AppLogo() }}" alt="{{ $configrations['site_name'] }}"></a>
                <button type="button" class="mobile-side-menu-close" aria-label="Close menu"><i class="fa-regular fa-xmark"
                        aria-hidden="true"></i></button>
            </div>
            <div class="side-menu-wrap mobile-nav-mount" id="alfa-mobile-nav-mount"></div>
            
            <div class="side-menu-contact">
                <div class="side-menu-header">
                    <h3>{{ __('website.contact_us') }}</h3>
                </div>
                <ul class="side-menu-list d-grid gap-3">
                    <li class="d-flex align-items-start mb-0 pb-0">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>{{ $main_address->address }}</p>
                    </li>
                    <li class="d-flex align-items-start mb-0 pb-0">
                        <i class="fas fa-phone"></i>
                        <a href="tel:{{ $settings['phone'] }}">{{ $settings['phone'] }}</a>
                    </li>
                    <li class="d-flex align-items-start mb-0 pb-0">
                        <i class="fas fa-envelope-open-text"></i>
                        <a href="mailto:{{ $settings['site_email'] }}">{{ $settings['site_email'] }}</a>
                    </li>
                </ul>
            </div>
    
        </div>
    </div>
    <div class="mobile-side-menu-overlay"></div>
    </div>