<x-website.layout>
    <!-- start banner -->
    @include('Website.partials._banner', ['page_title' => $page->title])
    <!-- end banner -->

    <section id="projects">
        <div class="container py-5">
            <!-- النص -->
            <div class="mt-4">
                <p class="card-text text-muted fs-5 fw-medium mt-4 wow fadeInUp" data-wow-delay="0.6s">
                    {!! $page->long_desc !!} </p>
            </div>
        </div>
</x-website.layout>
