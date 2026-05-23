{{-- SEO Meta --}}
@seo($seoHandler)
    {!! $seoHandler->renderMetaTags() !!}
    {!! $seoHandler->renderSchema() !!}
@endseo

<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="index, follow, max-image-preview:large">
<meta name="theme-color" content="#1a1a1a">


<link rel="shortcut icon" type="image/x-icon" href="{{ Path::FavIcon() }}" >

<!-- Links of CSS files -->
<link rel="stylesheet" href="{{ Path::css('bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ Path::css('fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ Path::css('venobox.min.css') }}">
<link rel="stylesheet" href="{{ Path::css('odometer.min.css') }}">
<link rel="stylesheet" href="{{ Path::css('nice-select.css') }}">
<link rel="stylesheet" href="{{ Path::css('carouselTicker.css') }}">
<link rel="stylesheet" href="{{ Path::css('animation.css') }}">
<link rel="stylesheet" href="{{ Path::css('twentytwenty.min.css') }}">
<link rel="stylesheet" href="{{ Path::css('swiper.min.css') }}">
<link rel="stylesheet" href="{{ Path::css('main.css') }}">
<link rel="stylesheet" href="{{ Path::css('all.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox/fancybox.css"
/>