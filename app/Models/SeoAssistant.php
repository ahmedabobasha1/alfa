<?php

namespace App\Models;

use App\Helper\Path;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SeoAssistant extends Model
{
    protected $fillable = [
        'home_meta_title_en',
        'home_meta_desc_en',
        'home_meta_title_ar',
        'home_meta_desc_ar',
        'home_index',

        'about_meta_title_en',
        'about_meta_desc_en',
        'about_meta_title_ar',
        'about_meta_desc_ar',
        'about_index',

        'contact_meta_title_en',
        'contact_meta_desc_en',
        'contact_meta_title_ar',
        'contact_meta_desc_ar',
        'contact_index',

        'blogs_meta_title_en',
        'blogs_meta_desc_en',
        'blogs_meta_title_ar',
        'blogs_meta_desc_ar',
        'blogs_index',

        'services_meta_title_en',
        'services_meta_desc_en',
        'services_meta_title_ar',
        'services_meta_desc_ar',
        'services_index',

        'products_meta_title_en',
        'products_meta_desc_en',
        'products_meta_title_ar',
        'products_meta_desc_ar',
        'products_index',

        'projects_meta_title_en',
        'projects_meta_desc_en',
        'projects_meta_title_ar',
        'projects_meta_desc_ar',
        'projects_index',

        'categories_meta_title_en',
        'categories_meta_desc_en',
        'categories_meta_title_ar',
        'categories_meta_desc_ar',
        'categories_index',
    ];

    public function getHomeMetaTitleAttribute()
    {
        return $this->{'home_meta_title_'.Path::lang()};
    }

    public function getHomeMetaDescAttribute()
    {
        return $this->{'home_meta_desc_'.Path::lang()};
    }

    public function getAboutMetaTitleAttribute()
    {
        return $this->{'about_meta_title_'.Path::lang()};
    }

    public function getAboutMetaDescAttribute()
    {
        return $this->{'about_meta_desc_'.Path::lang()};
    }

    public function getContactMetaTitleAttribute()
    {
        return $this->{'contact_meta_title_'.Path::lang()};
    }

    public function getContactMetaDescAttribute()
    {
        return $this->{'contact_meta_desc_'.Path::lang()};
    }

    public function getBlogsMetaTitleAttribute()
    {
        return $this->{'blogs_meta_title_'.Path::lang()};
    }

    public function getBlogsMetaDescAttribute()
    {
        return $this->{'blogs_meta_desc_'.Path::lang()};
    }

    public function getServicesMetaTitleAttribute()
    {
        return $this->{'services_meta_title_'.Path::lang()};
    }

    public function getServicesMetaDescAttribute()
    {
        return $this->{'services_meta_desc_'.Path::lang()};
    }

    public function getProductsMetaTitleAttribute()
    {
        return $this->{'products_meta_title_'.Path::lang()};
    }

    public function getProductsMetaDescAttribute()
    {
        return $this->{'products_meta_desc_'.Path::lang()};
    }

    public function getProjectsMetaTitleAttribute()
    {
        return $this->{'projects_meta_title_'.Path::lang()};
    }

    public function getProjectsMetaDescAttribute()
    {
        return $this->{'projects_meta_desc_'.Path::lang()};
    }

    public function getCategoriesMetaTitleAttribute()
    {
        return $this->{'categories_meta_title_'.Path::lang()};
    }

    public function getCategoriesMetaDescAttribute()
    {
        return $this->{'categories_meta_desc_'.Path::lang()};
    }

    public function getImagePathAttribute()
    {
        return Path::AppLogo();
    }

    public function getAuthorAttribute()
    {
        return Setting::where('lang', LaravelLocalization::getCurrentLocale())
            ->where('key', 'site_name')
            ->value('value') ?? 'Be Group';
    }
}
