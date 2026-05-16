<?php

namespace App\Services\Seo\Modules;

class AboutSeoHandel extends BaseSeoHandler
{
    protected function getTitle(): string
    {
        return $this->seo->about_meta_title ?? '';
    }

    protected function getDescription(): string
    {
        return $this->seo->about_meta_desc ?? '';
    }

    protected function getCanonicalUrl(): string
    {
        return route('website.about-us');
    }

    protected function getIndexStatus(): bool
    {
        return $this->seo->about_index ?? true;
    }

    protected function getRouteName(): string
    {
        return 'website.about-us';
    }
}
