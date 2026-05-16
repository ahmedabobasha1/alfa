<section class="counter-section counter-1 py-5">
    <div class="container container-2">
        <div class="row gy-5 fade-wrapper">
            @foreach ($statistics as $statistic)
            <div class="col-lg-3 col-md-6 fade-top">
                <div class="counter-item">
                    <h3 class="title"><span class="odometer" data-count="{{ $statistic->value }}">0</span><span
                            class="icon">+</span></h3>
                    <h4 class="sub-title">{{ $statistic->title }}</h4>
                    <p>{{ $statistic->text }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>