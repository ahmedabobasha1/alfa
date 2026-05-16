<section class="managers-section">
    <div class="container">

        <div class="section-title text-center">
            <h2>{{ __('website.our_managers') }}</h2>
        </div>

        <div class="row gy-4">

            @foreach ($teams as $team)
            <div class="team-block_one col-lg-4 col-md-6 col-sm-12 dark-body">
                <div class="team-block_one-inner">
                    <div class="team-block_one-image">
                        <img src="{{ $team->image_path }}" alt="{{ $team->alt_image }}" />
                        <div class="share-box">
                        </div>
                    </div>
                    <div class="team-block_one-content">
                        <h3 class="team-block_one-heading text-white">{{ $team->name }}</h3>
                        <div class="team-block_one-designation">{{ $team->position }}</div>
                    </div>
                </div>
            </div>
            @endforeach
         


        </div>
    </div>
</section>