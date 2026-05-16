<x-website.layout :seoHandler="$seoHandler ?? ''">
    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => $blog->name ])
    <!-- end banner -->

    <!-- start blog details -->
    <section class="section-padding2">
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-12"> <img src="{{ $blog->image_path }}" class="mb-30" alt="{{ $blog->alt_image }}">
                    <h2 class="section-title2">{{ $blog->name }}</h2>
                    <p>{!! $blog->long_desc !!}</p>
                </div>
            </div>

        </div>
    </section>
    <!-- end blog details -->
</x-website.layout>
