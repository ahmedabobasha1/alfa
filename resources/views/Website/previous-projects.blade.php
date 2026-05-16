<x-website.layout>

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.previous_projects')])
    <!-- end banner -->

    @if ($previous_projects->isNotEmpty())
    <section class="project-section-inner pt-130 pb-130">
        <div class="container container-2">
            <div class="row gy-5">
                @foreach ($previous_projects as $project)
                <div class="col-lg-4 col-md-6">
                    <div class="project-item antra-hover-view">
                        <div class="project-img">
                            <a class="d-block p-relative z-1" href="{{ route('website.projectDetails', $project->slug) }}"><img
                                    src="{{ $project->image_path }}"
                                    alt="{{ $project->alt_image }}" loading="lazy"></a>
                            <ul>
                                <li><a href="{{ route('website.projectDetails', $project->slug) }}">{{ $project->name }}</a></li>
                            </ul>
                        </div>
                        <div class="project-content">
                            <h3 class="title"><a href="{{ route('website.projectDetails', $project->slug) }}">{{ $project->name }}</a></h3>
                            <span>{{ $project->short_desc }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @endif
</x-website.layout>
