<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Category extends Model implements Sitemapable
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, HasLanguage;

    protected $fillable = [
        'name_en',
        'name_ar',
        'order',
        'parent_id',
        'image',
        'icon',
        'alt_image',
        'alt_icon',
        'short_desc_en',
        'short_desc_ar',
        'long_desc_en',
        'long_desc_ar',
        'status',
        'show_in_home',
        'show_in_header',
        'show_in_footer',
        'meta_title_en',
        'meta_title_ar',
        'meta_desc_en',
        'meta_desc_ar',
        'index',
        'slug_en',
        'slug_ar',
    ];

    public function getRouteKeyName()
    {
        if (! request()->is('*dashboard*')) {
            return 'slug_'.app()->getLocale(); // for frontend
        }

        return 'id'; // for dashboard/admin
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'mediable')->where('file_type', 'image')->orderBy('order');
    }

    public function getImagePathAttribute()
    {
        return $this->image ? asset('storage/categories/'.$this->image) : asset('assets/dashboard/images/noimage.png');
    }

    public function getIconPathAttribute()
    {
        return $this->icon ? asset('storage/categories/'.$this->icon) : asset('assets/dashboard/images/noimage.png');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeHome($query)
    {
        return $query->where('show_in_home', 1);
    }

    public function getNameAttribute()
    {
        return $this->{'name_'.$this->lang};
    }

    public function toSitemapTag(): array
    {

        // English URL with alternates
        $urlEn = Url::create(LaravelLocalization::getLocalizedURL('en', route('website.categoryDetails', $this->slug_en, false)))
            ->addAlternate(LaravelLocalization::getLocalizedURL('en', route('website.categoryDetails', $this->slug_en, false)), 'en')
            ->addAlternate(LaravelLocalization::getLocalizedURL('ar', route('website.categoryDetails', $this->slug_ar, false)), 'ar')
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);

        // Arabic URL with alternates
        $urlAr = Url::create(LaravelLocalization::getLocalizedURL('ar', route('website.categoryDetails', $this->slug_ar, false)))
            ->addAlternate(LaravelLocalization::getLocalizedURL('en', route('website.categoryDetails', $this->slug_en, false)), 'en')
            ->addAlternate(LaravelLocalization::getLocalizedURL('ar', route('website.categoryDetails', $this->slug_ar, false)), 'ar')
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);

        return [$urlEn, $urlAr];
    }
}
