<section class="projects section-padding">
    <div class="container">
        <div class="section-linetitle animate-box" data-animate-effect="fade2">
            <div class="title">
                <h6 class="sub-title">{{ __('website.our_projects') }}</h6>
            </div>
        </div>
        <div class="row ms-4 me-4">
            <div class="col-md-12">
                @foreach ($projects as $index => $project)
                    @if ($index % 2 == 0)
                        <div class="projects4 animate-box" data-animate-effect="fadeInUp">
                            <figure><img src="{{ $project->image_path }}" alt="{{ $project->alt_image }}"
                                    class="img-fluid"></figure>
                            <div class="caption">
                                <h6>{{ $project->name }}</h6>
                                <h4>{{ $project->name }}</h4>
                            </div>
                        </div>
                    @else
                        <div class="projects4 left animate-box" data-animate-effect="fadeInUp">
                            <figure><img src="{{ $project->image_path }}" alt="{{ $project->alt_image }}"
                                    class="img-fluid"></figure>
                            <div class="caption">
                                <h6>{{ $project->name }}</h6>
                                <h4>{{ $project->name }}</h4>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-12 text-center">
                <div class="durubtn mt-30 mb-30 animate-box" data-animate-effect="fadeInUp">
                    <a href="{{ route('website.projects') }}">
                        <span>{{ __('website.all_projects') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
