<?php

namespace App\Services\Seo\Modules;

use App\Models\Product;

class ProductDetailsSeoHandler extends BaseDetailSeoHandler
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    protected function getRouteName(): string
    {
        return 'website.productDetails';
    }

    protected function getRouteParameterName(): string
    {
        return 'product';
    }
}
