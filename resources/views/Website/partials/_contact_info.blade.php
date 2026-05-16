<section class="info-one">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Info Block One -->
            <div class="info-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="info-block_one-inner">
                    <div class="info-block_one-content">
                        <div class="info-block_one-icon fa-solid fa-phone fa-fw"></div>
                        {{ __('website.phone') }}:
                        <div class="d-flex flex-column gap-2">
                            @foreach ($phones as $phone)
                                <a href="tel:+{{ $phone->code . $phone->phone }}">{{ $phone->code . $phone->phone }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Block One -->
            <div class="info-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="info-block_one-inner">
                    <div class="info-block_one-content">
                        <div class="info-block_one-icon fa-solid fa-envelope"></div>
                        {{ __('website.email') }} <br> {{ config('settings.site_email') }}
                    </div>
                </div>
            </div>
            <!-- Info Block One -->
            <div class="info-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="info-block_one-inner">
                    <div class="info-block_one-content">
                        <div class="info-block_one-icon fa-solid fa-map fa-fw"></div>
                        @foreach ($site_addresses as $site_address)
                            <a href="https://www.google.com/maps?q={{ urlencode($site_address->address) }}"
                                target="_blank">{{ $site_address->address }}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
