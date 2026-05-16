<?php

namespace App\Services\Seo\Modules;

class BlogsSeoHandel extends BaseSeoHandler
{
    protected function getTitle(): string
    {
        return $this->seo->blogs_meta_title ?? '';
    }

    protected function getDescription(): string
    {
        return $this->seo->blogs_meta_desc ?? '';
    }

    protected function getCanonicalUrl(): string
    {
        return route('website.blogs');
    }

    protected function getIndexStatus(): bool
    {
        return $this->seo->blogs_index ?? true;
    }

    protected function getRouteName(): string
    {
        return 'website.blogs';
    }
}
