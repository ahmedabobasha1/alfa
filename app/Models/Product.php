<?php

namespace App\Models;

use App\Observers\ProductObserver;
use App\Traits\HasLanguage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

#[ObservedBy([ProductObserver::class])]

class Product extends Model implements Sitemapable
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory ,HasLanguage;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'parent_id',
        'name_en',
        'name_ar',
        'short_desc_en',
        'short_desc_ar',
        'long_desc_en',
        'long_desc_ar',
        'image',
        'alt_image',
        'icon',
        'alt_icon',
        'status',
        'show_in_home',
        'show_in_header',
        'show_in_footer',
        'meta_title_ar',
        'meta_title_en',
        'meta_desc_ar',
        'meta_desc_en',
        'index',
        'slug_en',
        'slug_ar',
        'order',
    ];

    public function getRouteKeyName()
    {
        if (! request()->is('*dashboard*')) {
            return 'slug_'.app()->getLocale(); // for frontend
        }

        return 'id'; // for dashboard/admin
    }

    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Product::class, 'parent_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'mediable')->where('file_type', 'image')->orderBy('order');
    }

    public function getImagePathAttribute()
    {
        return $this->image ? asset('storage/products/'.$this->image) : asset('assets/dashboard/images/noimage.png');
    }

    public function getIconPathAttribute()
    {
        return $this->icon ? asset('storage/products/'.$this->icon) : asset('assets/dashboard/images/noimage.png');
    }

    public function getNameAttribute()
    {
        return $this->{'name_'.$this->lang};
    }

    public function getShortDescAttribute()
    {
        return $this->{'short_desc_'.$this->lang};
    }

    public function getLongDescAttribute()
    {
        return $this->{'long_desc_'.$this->lang};
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeHome($query)
    {
        return $query->where('show_in_home', true);
    }

    public function scopeHeader($query)
    {
        return $query->where('show_in_header', true);
    }

    public function scopeFooter($query)
    {
        return $query->where('show_in_footer', true);
    }

    public function scopeDescOrder($query)
    {
        return $query->orderBy('order', 'desc');
    }

    public function getSlugAttribute()
    {
        return $this->{'slug_'.$this->lang};
    }

    public function toSitemapTag(): array
    {

        // English URL with alternates
        $urlEn = Url::create(LaravelLocalization::getLocalizedURL('en', route('website.productDetails', $this->slug_en, false)))
            ->addAlternate(LaravelLocalization::getLocalizedURL('en', route('website.productDetails', $this->slug_en, false)), 'en')
            ->addAlternate(LaravelLocalization::getLocalizedURL('ar', route('website.productDetails', $this->slug_ar, false)), 'ar')
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);

        // Arabic URL with alternates
        $urlAr = Url::create(LaravelLocalization::getLocalizedURL('ar', route('website.productDetails', $this->slug_ar, false)))
            ->addAlternate(LaravelLocalization::getLocalizedURL('en', route('website.productDetails', $this->slug_en, false)), 'en')
            ->addAlternate(LaravelLocalization::getLocalizedURL('ar', route('website.productDetails', $this->slug_ar, false)), 'ar')
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);

        return [$urlEn, $urlAr];
    }
}
