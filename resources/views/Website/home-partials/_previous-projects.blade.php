<section class="project-section py-5 tl-bg-color fade-wrapper">

    <div class="container container-2">
        <div class="row section-heading-wrap fade-top">

            <div class="col-lg-4 col-md-12">
                <div class="section-heading mb-0">
                    <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char"
                        data-duration="0.9" data-stagger="0.03">{{ $previous_projects_section->title }}</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="section-heading section-heading-2 mb-0">
                    <h2 class="section-title cursor-effect title-2">{{ $previous_projects_section->second_title }}</h2>
                    <p class="mb-0">{{ $previous_projects_section->short_desc }}</p>
                </div>
            </div>
        </div>
        <div class="row gy-5 process-wrap process-wrap--flat fade-wrapper">
            @foreach ($previous_projects as $index => $project)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <a href="{{ route('website.projectDetails', $project->slug) }}" class="process-item fade-top d-block">
                        <div class="process-thumb">
                            <img src="{{ $project->image_path }}" loading="lazy" alt="{{ $project->alt_image }}">
                        </div>
                        <div class="process-content">
                            <h3 class="title"><span>{{ $index + 1 }}</span>. {{ $project->name }}</h3>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="project-btn mt-5 fade-top">
            <a href="{{ route('website.previousProjects') }}" class="tl-primary-btn ">{{ __('website.previous_projects') }} <span class="icon"><i
                        class="fa-regular fa-arrow-right"></i></span></a>
        </div>
    </div>

</section>