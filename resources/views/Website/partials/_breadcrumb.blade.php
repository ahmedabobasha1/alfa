<section class="page-header">
    <div class="bg-img" data-background="{{ $image ?? $breadcrumb->image_path }}"></div>
    <div class="overlay"></div>
    <div class="container">
        <div class="page-header-content">
            <h1 class="title">{{ $page_title ?? __('website.home') }}</h1>
            <h4 class="sub-title"><a class='home' href='{{ route('website.home') }}'>{{ __('website.home') }}</a><span class="icon">-</span><a
                    class='inner-page' href='{{ route('website.home') }}'>{{ $page_title ?? __('website.home') }}</a></h4>
        </div>
    </div>
</section>