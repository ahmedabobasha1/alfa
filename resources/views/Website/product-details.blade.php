<x-website.layout :seoHandler="$seoHandler ?? ''">
    <!-- start banner -->
    @include('Website.partials._banner', ['page_title' => $product->name])
    <!-- end banner -->

    <section class="product-details-area ptb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="products-details-image">
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <div class="owl-thumbs products-details-image-slides-owl-thumbs" data-slider-id="1">
                                    @foreach ($product->images as $image)
                                        <div class="owl-thumb-item">
                                            <img src="{{ $image->image_path('products/', $product->id) }}"
                                                alt="{{ $product->alt_image . '-' . $loop->index }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-9">
                                <ul class="products-details-image-slides owl-theme owl-carousel" data-slider-id="1">
                                    @foreach ($product->images as $image)
                                        <li>
                                            <img src="{{ $image->image_path('products/', $product->id) }}"
                                                alt="{{ $product->alt_image . '-' . $loop->index }}">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="products-details-desc">
                        <h3>{{ $product->name }}</h3>
                        <p>
                            {!! $product->short_desc !!}
                        </p>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="products-details-tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab"
                                    href="#description" role="tab"
                                    aria-controls="description">{{ __('website.description') }}</a></li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel">

                                <p>{!! $product->long_desc !!}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Start Related Products Area -->
    <section class="products-area pb-40">
        <div class="container">
            <div class="section-title">
                <h2>{{ __('website.related_products') }}</h2>
            </div>

            <div class="row">
                @foreach ($related_products as $related_product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-products-box">
                            <div class="image">
                                <a href="{{ route('website.productDetails', $related_product) }}" class="d-block"><img
                                        src="{{ $product->image_path }}" alt="{{ $product->alt_image }}"></a>

                            </div>
                            <div class="content">

                                <h3><a
                                        href="{{ route('website.productDetails', $related_product) }}">{{ $related_product->name }}</a>
                                </h3>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Related Products Area -->

</x-website.layout>
