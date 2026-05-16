<x-website.layout :seoHandler="$seoHandler ?? ''">

    <!-- start banner -->
    @include('Website.partials._banner', ['page_title' => __('website.products')])
    <!-- end banner -->
    @if ($products->isNotEmpty())
        <section class="products-area ptb-70">
            <div class="container">


                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-products-box">
                                <div class="image">
                                    <a href="{{ route('website.productDetails', $product) }}" class="d-block"><img
                                            src="{{ $product->image_path }}" alt="{{ $product->alt_image }}"></a>

                                    {{-- <ul class="buttons-list">

                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#productsQuickView">
                                            <i class='bx bx-search-alt'></i>
                                            <span class="tooltip-label">Quick View</span>
                                        </a>
                                    </li>
                                </ul> --}}
                                </div>
                                <div class="content">

                                    <h3><a
                                            href="{{ route('website.productDetails', $product) }}">{{ $product->name }}</a>
                                    </h3>

                                </div>
                            </div>
                        </div>
                    @endforeach



                    @if ($products->count() > 0)


                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="pagination-area text-center">
                                @if (!$products->onFirstPage())
                               
                                    <a href="{{ $products->previousPageUrl() }}" class="next page-numbers"><i
                                            class='bx bx-chevron-left'></i></a>
                                @endif

                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    @if ($products->currentPage() == $i)
                                        <span class="page-numbers current" aria-current="page">{{ $i }}</span>
                                    @else
                                        <a href="{{ $products->url($i) }}" class="page-numbers">{{ $i }}</a>
                                    @endif
                                @endfor

                                @if ($products->hasMorePages())
                                
                                    <a href="{{ $products->nextPageUrl() }}" class="next page-numbers"><i
                                            class='bx bx-chevron-right'></i></a>
                                @endif
                               
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
</x-website.layout>
