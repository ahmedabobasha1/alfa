<x-website.layout>

    <!-- start banner -->
    @include('Website.partials._breadcrumb', ['page_title' => __('website.our_projects')])
    <!-- end banner -->

    @if ($projects->isNotEmpty())
        <section class="services2 section-padding">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <p>{!! $projects_page_section->long_desc !!}</p>
                    </div>
                </div>

                <div class="row">
                    @foreach ($projects as $index => $project)
                        <div class="col-md-4">
                            <div class="item mb-45">

                                <!-- main image -->
                                <a href="{{ $project->image_path }}" data-fancybox="project{{ $index }}">
                                    <img src="{{ $project->image_path }}"
                                        alt="{{ $project->name }}" />
                                    <div class="con">
                                        <h5>{{ $project->name }}</h5>
                                        <div class="line"></div>
                                    </div>
                                </a>

                                <!-- hidden album image -->
                                <div style="display:none">
                                    @foreach ($project->images as $image)
                                        <a href="{{ $image->image_path }}"
                                            data-fancybox="project{{ $index }}"></a>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    @endif
</x-website.layout>
