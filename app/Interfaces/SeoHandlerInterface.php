<?php

namespace App\Interfaces;

interface SeoHandlerInterface
{
    public function getMetaTags(): array;

    public function getSchema(): array;

    public function getOpenGraph(): array;

    public function getTwitterCard(): array;

    public function getHreflangTags(): array;
}
