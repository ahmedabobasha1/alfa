<nav class="navbar navbar-expand-lg ">
    <div class="container">
        <!-- Logo -->
        <div class="logo-wrapper">
            <a class="logo" href="{{ route('website.home') }}"><img src="{{ Path::AppLogo() }}" class="logo-img"
                    alt="{{ $configrations['site_name'] }}"></a>
        </div>
        <!-- Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span
                class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                @foreach ($menus as $menu)
                @if ($menu->children->isNotEmpty())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="galleryDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="rolling-text">{{ $menu->name }}</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="galleryDropdown">
                            @foreach ($menu->children as $child)
                                <li><a class="dropdown-item" href="{{ route('website.' . $child->route_name) }}">{{ $child->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="nav-item"> <a class="nav-link" href="{{ route('website.' . $menu->route_name) }}"
                            role="button" data-bs-auto-close="outside" aria-expanded="false"><span
                                class="rolling-text">{{ $menu->name }}</span></a></li>
                @endif
                @endforeach
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if ($localeCode != app()->getLocale())
                        <li class="nav-item">
                            <a class="durubtn ps-3 pe-3" hreflang="{{ $localeCode }}" href="{{ $altLangLink }}"
                                rel="alternate">{{ $properties['native'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>
