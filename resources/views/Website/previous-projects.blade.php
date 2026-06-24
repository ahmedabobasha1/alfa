<x-website.layout>

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.previous_projects')])
    <!-- end banner -->

    @if ($categories->isNotEmpty())
    <section class="process-section overflow-hidden fade-wrapper pt-4 pb-130">
        <div class="bg-shape" data-background="{{ Path::imagesPath('blogs/about-shape-1.png') }}"></div>
        <div class="container container-2">
            <div class="process-tabs-wrap fade-top">
                <ul class="nav nav-pills process-tabs" id="pastProjectsTab" role="tablist">
                    @foreach ($categories as $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if ($loop->first) active @endif"
                            id="past-tab-{{ $category->{'slug_' . app()->getLocale()} }}"
                            data-bs-toggle="tab"
                            data-bs-target="#past-pane-{{ $category->{'slug_' . app()->getLocale()} }}"
                            type="button" role="tab"
                            aria-controls="past-pane-{{ $category->{'slug_' . app()->getLocale()} }}"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $category->name }}</button>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-content" id="pastProjectsTabContent">
                @foreach ($categories as $category)
                <div class="tab-pane fade @if ($loop->first) show active @endif"
                    id="past-pane-{{ $category->{'slug_' . app()->getLocale()} }}" role="tabpanel"
                    aria-labelledby="past-tab-{{ $category->{'slug_' . app()->getLocale()} }}" tabindex="0">
                    <div class="row gy-xl-0 gy-4 process-wrap process-wrap--flat fade-wrapper">
                        @foreach ($category->projects as $index => $project)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <a href="{{ route('website.projectDetails', $project->slug) }}"
                                class="process-item fade-top d-block">
                                <div class="process-thumb">
                                    <img src="{{ $project->image_path }}" loading="lazy"
                                        alt="{{ $project->alt_image }}">
                                </div>
                                <div class="process-content">
                                    <h3 class="title"><span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>. {{ $project->name }}</h3>
                                </div>
                                <span class="number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</x-website.layout>
