<?php

namespace App\Services\Seo\Modules;

class CategoriesSeoHandel extends BaseSeoHandler
{
    protected function getTitle(): string
    {
        return $this->seo->categories_meta_title ?? '';
    }

    protected function getDescription(): string
    {
        return $this->seo->categories_meta_desc ?? '';
    }

    protected function getCanonicalUrl(): string
    {
        return route('website.categories');
    }

    protected function getIndexStatus(): bool
    {
        return $this->seo->categories_index ?? true;
    }

    protected function getRouteName(): string
    {
        return 'website.categories';
    }
}
