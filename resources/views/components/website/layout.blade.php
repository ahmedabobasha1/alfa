<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <x-website.partials._head :seoHandler="$seoHandler ?? ''" />

    <x-website.partials._gtm-script />
</head>

<body>

    <x-website.partials._preloader />
   

    <x-website.partials._navbar />


    <div id="antra-smooth-wrapper">
        <div id="antra-smooth-content">


        <!-- start Page Content -->
        {{ $slot }}

        <!-- end Page Content -->

        <x-website.partials._footer />
        </div>
    </div>


    {{-- <x-website.partials._mobile_menu /> --}}



    <x-website.partials._social-icon />
    <div id="scroll-percentage"><span id="scroll-percentage-value"></span></div>

    <!-- javascript libraries -->
    <x-website.partials._script />

    <x-website.partials._gtm-noscript />

    @stack('scripts')

</body>

</html>
