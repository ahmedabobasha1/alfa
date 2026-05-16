<?php

namespace App\Models;

use App\Observers\ServiceObserver;
use App\Traits\HasLanguage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

#[ObservedBy([ServiceObserver::class])]

class Service extends Model implements Sitemapable
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory, HasLanguage;

    protected $table = 'services';

    protected $fillable = ['name_ar', 'name_en', 'parent_id', 'short_desc_ar', 'short_desc_en', 'long_desc_ar', 'long_desc_en', 'image', 'alt_image', 'icon', 'alt_icon', 'status', 'show_in_home', 'show_in_header', 'show_in_footer', 'slug_ar', 'slug_en', 'meta_title_ar', 'meta_title_en', 'meta_desc_ar', 'meta_desc_en', 'index', 'order'];

    public function getRouteKeyName()
    {
        if (! request()->is('*dashboard*')) {
            return 'slug_'.app()->getLocale(); // for frontend
        }

        return 'id'; // for dashboard/admin
    }

    public function children()
    {
        return $this->hasMany(Service::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'mediable')->where('file_type', 'image')->orderBy('order');
    }

    public function tabs()
    {
        return $this->morphMany(Tab::class, 'tabbable')->orderBy('order');
    }

    public function benefits()
    {
        return $this->morphMany(Benefit::class, 'benefitable')->orderBy('order');
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

    public function getImagePathAttribute()
    {
        return $this->image ? asset('storage/services/'.$this->image) : asset('assets/dashboard/images/noimage.png');
    }

    public function getIconPathAttribute()
    {
        return $this->icon ? asset('storage/services/'.$this->icon) : asset('assets/dashboard/images/noIcon.png');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function scopeHome(Builder $query): void
    {
        $query->where('show_in_home', 1);
    }

    public function scopeFooter(Builder $query): void
    {
        $query->where('show_in_footer', 1);
    }

    public function scopeHeader(Builder $query): void
    {
        $query->where('show_in_header', 1);
    }

    public function toSitemapTag(): array
    {

        // English URL with alternates
        $urlEn = Url::create(LaravelLocalization::getLocalizedURL('en', route('website.serviceDetails', $this->slug_en, false)))
            ->addAlternate(LaravelLocalization::getLocalizedURL('en', route('website.serviceDetails', $this->slug_en, false)), 'en')
            ->addAlternate(LaravelLocalization::getLocalizedURL('ar', route('website.serviceDetails', $this->slug_ar, false)), 'ar')
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);

        // Arabic URL with alternates
        $urlAr = Url::create(LaravelLocalization::getLocalizedURL('ar', route('website.serviceDetails', $this->slug_ar, false)))
            ->addAlternate(LaravelLocalization::getLocalizedURL('en', route('website.serviceDetails', $this->slug_en, false)), 'en')
            ->addAlternate(LaravelLocalization::getLocalizedURL('ar', route('website.serviceDetails', $this->slug_ar, false)), 'ar')
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
