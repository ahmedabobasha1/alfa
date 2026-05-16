<?php

namespace App\Services\Seo\Modules;

use App\Models\Blog;

class BlogDetailsSeoHandler extends BaseDetailSeoHandler
{
    public function __construct(Blog $blog)
    {
        parent::__construct($blog);
    }

    protected function getRouteName(): string
    {
        return 'website.blogDetails';
    }

    protected function getRouteParameterName(): string
    {
        return 'blog';
    }

    protected function buildSchema(): void
    {
        $this->schemaGenerator->websiteSchema(
            $this->model->name,
            route('website.blogDetails', $this->model)
        );

        $this->schemaGenerator->article(
            $this->model->name,
            $this->model->short_desc ?? '',
            url()->current(),
            $this->model->image_path ?? '',
            $this->model->date
                ? $this->model->date
                : $this->model->created_at->toIso8601String()
        );
    }
}
