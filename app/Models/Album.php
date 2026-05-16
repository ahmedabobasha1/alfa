<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory , HasLanguage;

    protected $table = 'albums';

    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'image',
        'alt_image',
        'order',
        'status',
        'show_in_home',
        'show_in_header',
        'show_in_footer',
        'slug_en',
        'slug_ar',
        'type',
    ];

    public function getNameAttribute()
    {
        return $this->{'name_'.app()->getLocale()};
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'mediable')->where('file_type', 'image')->orderBy('order');
    }

    public function getImagePathAttribute()
    {
        return $this->image ? asset('storage/albums/'.$this->image) : asset('assets/dashboard/images/noimage.png');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function scopeType(Builder $query, $type): void
    {
        $query->where('type', $type);
    }
}
