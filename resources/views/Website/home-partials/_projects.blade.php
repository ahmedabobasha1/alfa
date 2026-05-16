<section class="process-section overflow-hidden fade-wrapper">
    <div class="bg-shape" data-background="{{ Path::imagesPath('blogs/about-shape-1.png') }}"></div>
    <div class="container container-2">
        <div class="heading-space align-items-end">
            <div class="section-heading mb-0">
                <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9"
                    data-stagger="0.03">{{ $projects_section->second_title }}</h4>
                <h2 class="section-title cursor-effect title-2">{{ $projects_section->title }}</h2>
            </div>
            <div class="process-desc">
                <p class="mb-0">{{ $projects_section->short_desc }}</p>
            </div>
        </div>

        <div class="process-tabs-wrap fade-top">
            <ul class="nav nav-pills process-tabs" id="pastProjectsTab" role="tablist">
                @foreach ($categories as $category)
                    <li class="nav-item" role="presentation">

                        <button class="nav-link @if ($loop->first) active @endif"
                            id="tab-{{ $category->id }}" data-bs-toggle="tab" data-bs-target="#pane-{{ $category->id }}"
                            type="button" role="tab" aria-controls="pane-{{ $category->id }}"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $category->name }}</button>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="tab-content" id="pastProjectsTabContent">
            @foreach ($categories as $category)
                <div class="tab-pane fade @if ($loop->first) show active @endif"
                    id="pane-{{ $category->id }}" role="tabpanel" aria-labelledby="tab-{{ $category->id }}"
                    tabindex="0">
                    <div class="row gy-5 process-wrap process-wrap--flat fade-wrapper">
                        @foreach ($category->projects as $index => $project)
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <a href="{{ route('website.projectDetails', $project->slug) }}"
                                    class="process-item fade-top d-block">
                                    <div class="process-thumb">
                                        <img src="{{ $project->image_path }}" loading="lazy"
                                            alt="{{ $project->alt_image }}">
                                    </div>
                                    <div class="process-content">
                                        <h3 class="title"><span>{{ $index + 1 }}</span>. {{ $project->name }}
                                        </h3>
                                    </div>
                                    <span class="number">{{ $index + 1 }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="project-btn mt-5 fade-top">
            <a href="{{ route('website.projects') }}" class="tl-primary-btn">
                {{ __('website.all_projects') }}
                <span class="icon"><i class="fa-regular fa-arrow-right"></i></span>
            </a>
        </div>
    </div>
</section>
