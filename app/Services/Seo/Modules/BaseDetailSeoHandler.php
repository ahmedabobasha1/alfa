<?php

namespace App\Services\Seo\Modules;

use App\Interfaces\SeoHandlerInterface;
use App\Services\Seo\SchemaGenerator;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

abstract class BaseDetailSeoHandler implements SeoHandlerInterface
{
    protected Model $model;

    protected SchemaGenerator $schemaGenerator;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->schemaGenerator = new SchemaGenerator;
    }

    /**
     * Get the route name for canonical URL and hreflang
     */
    abstract protected function getRouteName(): string;

    /**
     * Get the route parameter name (e.g., 'blog', 'product', 'service')
     */
    abstract protected function getRouteParameterName(): string;

    /**
     * Build custom schema (override if needed)
     */
    protected function buildSchema(): void
    {
        $this->schemaGenerator->websiteSchema(
            $this->model->name,
            route($this->getRouteName(), $this->model)
        );
    }

    public function getMetaTags(): array
    {
        return [
            'content_type' => 'text/html; charset=utf-8',
            'title' => $this->model->meta_title ?? '',
            'description' => $this->model->meta_desc ?? '',
            'canonical' => route($this->getRouteName(), $this->model),
            'robots' => ($this->model->index ?? true) ? 'index' : 'noindex',
        ];
    }

    public function getOpenGraph(): array
    {
        return [
            'og:title' => $this->model->meta_title ?? '',
            'og:description' => $this->model->meta_desc ?? '',
            'og:url' => route($this->getRouteName(), $this->model),
            'og:image' => $this->model->image_path ?? '',
            'og:type' => 'article',
        ];
    }

    public function getTwitterCard(): array
    {
        return [
            'twitter:card' => 'summary_large_image',
            'twitter:title' => $this->model->meta_title ?? '',
            'twitter:description' => $this->model->meta_desc ?? '',
            'twitter:image' => $this->model->image_path ?? '',
        ];
    }

    public function getHreflangTags(): array
    {
        $hreflangTags = [];
        $supportedLocales = array_keys(LaravelLocalization::getSupportedLocales());
        $routeName = $this->getRouteName();
        $parameterName = $this->getRouteParameterName();

        foreach ($supportedLocales as $locale) {
            // Use correct slug per locale
            $slugColumn = 'slug_'.$locale;
            $slug = $this->model->$slugColumn;

            $hreflangTags[$locale] = LaravelLocalization::getLocalizedURL(
                $locale,
                route($routeName, [$parameterName => $slug], false)
            );
        }

        // Add x-default
        $defaultLang = config('app.locale');
        $hreflangTags['x-default'] = LaravelLocalization::localizeURL(
            route($routeName, $this->model, false),
            $defaultLang
        );

        return $hreflangTags;
    }

    public function getSchema(): array
    {
        $this->buildSchema();

        return $this->schemaGenerator->generateSchema();
    }

    public function renderMetaTags(): string
    {
        $metaTags = $this->getMetaTags();
        $openGraph = $this->getOpenGraph();
        $twitterCard = $this->getTwitterCard();
        $hreflangTags = $this->getHreflangTags();

        return view('components.seo.meta-tags', compact('metaTags', 'openGraph', 'twitterCard', 'hreflangTags'))->render();
    }

    public function renderSchema(): string
    {
        $schemaArray = $this->getSchema();

        if (empty($schemaArray)) {
            return '';
        }

        $json = json_encode($schemaArray, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        return '<script type="application/ld+json">'.$json.'</script>';
    }

    /**
     * Get all meta tags formatted for API response
     */
    public function getMetaTagsForApi(): array
    {
        return [
            'meta_tags' => $this->getMetaTags(),
            'open_graph' => $this->getOpenGraph(),
            'twitter_card' => $this->getTwitterCard(),
            'hreflang_tags' => $this->getHreflangTags(),
        ];
    }

    /**
     * Get schema formatted for API response
     */
    public function getSchemaForApi(): array
    {
        return $this->getSchema();
    }

    /**
     * Get all SEO data for API response
     */
    public function getSeoDataForApi(): array
    {
        return [
            'meta' => $this->getMetaTagsForApi(),
            'schema' => $this->getSchemaForApi(),
        ];
    }
}
