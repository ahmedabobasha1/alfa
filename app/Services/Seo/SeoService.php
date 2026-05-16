<?php

namespace App\Services\Seo;

use App\Models\SeoAssistant;
use App\Services\Seo\Modules\AboutSeoHandel;
use App\Services\Seo\Modules\BlogDetailsSeoHandler;
use App\Services\Seo\Modules\BlogsSeoHandel;
use App\Services\Seo\Modules\CategoriesSeoHandel;
use App\Services\Seo\Modules\CategoryDetailsSeoHandler;
use App\Services\Seo\Modules\ContactSeoHandel;
use App\Services\Seo\Modules\HomeSeoHandel;
use App\Services\Seo\Modules\ProductDetailsSeoHandler;
use App\Services\Seo\Modules\ProductsSeoHandel;
use App\Services\Seo\Modules\ProjectDetailsSeoHandler;
use App\Services\Seo\Modules\ProjectsSeoHandel;
use App\Services\Seo\Modules\ServiceDetailsSeoHandler;
use App\Services\Seo\Modules\ServicesSeoHandel;
use Illuminate\Database\Eloquent\Model;

class SeoService
{
    private SeoAssistant $seoAssistant;

    public function __construct()
    {
        $this->seoAssistant = SeoAssistant::first() ?? new SeoAssistant;
    }

    /**
     * Get SEO handler for home page
     */
    public function forHome(): HomeSeoHandel
    {
        return new HomeSeoHandel($this->seoAssistant);
    }

    /**
     * Get SEO handler for about page
     */
    public function forAbout(): AboutSeoHandel
    {
        return new AboutSeoHandel($this->seoAssistant);
    }

    /**
     * Get SEO handler for blogs list page
     */
    public function forBlogs(): BlogsSeoHandel
    {
        return new BlogsSeoHandel($this->seoAssistant);
    }

    /**
     * Get SEO handler for categories list page
     */
    public function forCategories(): CategoriesSeoHandel
    {
        return new CategoriesSeoHandel($this->seoAssistant);
    }

    /**
     * Get SEO handler for contact page
     */
    public function forContact(): ContactSeoHandel
    {
        return new ContactSeoHandel($this->seoAssistant);
    }

    /**
     * Get SEO handler for products list page
     */
    public function forProducts(): ProductsSeoHandel
    {
        return new ProductsSeoHandel($this->seoAssistant);
    }

    /**
     * Get SEO handler for services list page
     */
    public function forServices(): ServicesSeoHandel
    {
        return new ServicesSeoHandel($this->seoAssistant);
    }

    /**
     * Get SEO handler for projects list page
     */
    public function forProjects(): ProjectsSeoHandel
    {
        return new ProjectsSeoHandel($this->seoAssistant);
    }

    /**
     * Get SEO handler for blog details page
     */
    public function forBlogDetails(Model $blog): BlogDetailsSeoHandler
    {
        return new BlogDetailsSeoHandler($blog);
    }

    /**
     * Get SEO handler for category details page
     */
    public function forCategoryDetails(Model $category): CategoryDetailsSeoHandler
    {
        return new CategoryDetailsSeoHandler($category);
    }

    /**
     * Get SEO handler for product details page
     */
    public function forProductDetails(Model $product): ProductDetailsSeoHandler
    {
        return new ProductDetailsSeoHandler($product);
    }

    /**
     * Get SEO handler for project details page
     */
    public function forProjectDetails(Model $project): ProjectDetailsSeoHandler
    {
        return new ProjectDetailsSeoHandler($project);
    }

    /**
     * Get SEO handler for service details page
     */
    public function forServiceDetails(Model $service): ServiceDetailsSeoHandler
    {
        return new ServiceDetailsSeoHandler($service);
    }

    /**
     * Get SEO data for API response (any page type)
     */
    public function getApiData(string $pageType, ?Model $model = null): array
    {
        $handler = match ($pageType) {
            'home' => $this->forHome(),
            'about' => $this->forAbout(),
            'blogs' => $this->forBlogs(),
            'categories' => $this->forCategories(),
            'contact' => $this->forContact(),
            'products' => $this->forProducts(),
            'projects' => $this->forProjects(),
            'services' => $this->forServices(),
            'blog-details' => $this->forBlogDetails($model),
            'category-details' => $this->forCategoryDetails($model),
            'product-details' => $this->forProductDetails($model),
            'project-details' => $this->forProjectDetails($model),
            'service-details' => $this->forServiceDetails($model),
            default => throw new \InvalidArgumentException("Invalid page type: {$pageType}")
        };

        return $handler->getSeoDataForApi();
    }
}
