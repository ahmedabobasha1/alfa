<?php

namespace App\Services\Seo\Modules;

use App\Models\Category;

class CategoryDetailsSeoHandler extends BaseDetailSeoHandler
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    protected function getRouteName(): string
    {
        return 'website.categoryDetails';
    }

    protected function getRouteParameterName(): string
    {
        return 'category';
    }
}
