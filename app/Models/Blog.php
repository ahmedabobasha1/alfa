<?php

namespace App\Models;

use App\Observers\BlogObserver;
use App\Traits\HasLanguage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

#[ObservedBy([BlogObserver::class])]
class Blog extends Model implements Sitemapable
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory, HasLanguage;

    protected $table = 'blogs';

    protected $fillable = [
        'category_id',
        'author_id',
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
        'meta_title_en',
        'meta_title_ar',
        'meta_desc_en',
        'meta_desc_ar',
        'slug_en',
        'slug_ar',
        'status',
        'show_in_home',
        'show_in_header',
        'show_in_footer',
        'index',
        'date',
        'order',

    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        if (! request()->is('*dashboard*')) {
            return 'slug_'.app()->getLocale(); // for frontend
        }

        return 'id'; // for dashboard/admin
    }

    public function getDateAttribute()
    {
        $original = $this->getAttributes()['date'] ?? null;

        return $original ? \Carbon\Carbon::parse($original)->format('Y M d') : '';
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function faqs()
    {
        return $this->morphMany(Faq::class, 'faqable');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'mediable')->where('file_type', 'image')->orderBy('order');
    }

    public function getImagePathAttribute()
    {
        // return $this->image ? asset('storage/blogs/' . $this->image) : asset('assets/dashboard/images/noimage.png');
        return $this->image ? asset('storage/blogs/'.$this->image) : null;
    }

    public function getIconPathAttribute()
    {
        return $this->icon ? asset('storage/blogs/'.$this->icon) : asset('assets/dashboard/images/noimage.png');
    }

    public function getShortDescAttribute()
    {
        return $this->{'short_desc_'.$this->lang};
    }

    public function getLongDescAttribute()
    {
        return $this->{'long_desc_'.$this->lang};
    }

    public function getNameAttribute()
    {
        return $this->{'name_'.$this->lang};
    }

    public function getSlugAttribute()
    {
        return $this->{'slug_'.$this->lang};
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

    public function toSitemapTag(): array
    {

        // English URL with alternates
        $urlEn = Url::create(LaravelLocalization::getLocalizedURL('en', route('website.blogDetails', $this->slug_en, false)))
            ->addAlternate(LaravelLocalization::getLocalizedURL('en', route('website.blogDetails', $this->slug_en, false)), 'en')
            ->addAlternate(LaravelLocalization::getLocalizedURL('ar', route('website.blogDetails', $this->slug_ar, false)), 'ar')
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);

        // Arabic URL with alternates
        $urlAr = Url::create(LaravelLocalization::getLocalizedURL('ar', route('website.blogDetails', $this->slug_ar, false)))
            ->addAlternate(LaravelLocalization::getLocalizedURL('en', route('website.blogDetails', $this->slug_en, false)), 'en')
            ->addAlternate(LaravelLocalization::getLocalizedURL('ar', route('website.blogDetails', $this->slug_ar, false)), 'ar')
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);

        return [$urlEn, $urlAr];
    }

    public function getMetaTitleAttribute()
    {
        return $this->{'meta_title_'.$this->lang};
    }

    public function getMetaDescAttribute()
    {
        return $this->{'meta_desc_'.$this->lang};
    }
}
