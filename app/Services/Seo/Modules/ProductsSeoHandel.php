<?php

namespace App\Services\Seo\Modules;

class ProductsSeoHandel extends BaseSeoHandler
{
    protected function getTitle(): string
    {
        return $this->seo->products_meta_title ?? '';
    }

    protected function getDescription(): string
    {
        return $this->seo->products_meta_desc ?? '';
    }

    protected function getCanonicalUrl(): string
    {
        return route('website.products');
    }

    protected function getIndexStatus(): bool
    {
        return $this->seo->products_index ?? true;
    }

    protected function getRouteName(): string
    {
        return 'website.products';
    }
}
