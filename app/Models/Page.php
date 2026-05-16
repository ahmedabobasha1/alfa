<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasLanguage;

    protected $table = 'pages';

    protected $fillable = [
        'title_en',
        'title_ar',
        'slug_en',
        'slug_ar',
        'content_en',
        'content_ar',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getTitleAttribute()
    {
        return $this->{'title_'.$this->lang};
    }

    public function getContentAttribute()
    {
        return $this->{'content_'.$this->lang};
    }

    public function getSlugAttribute()
    {
        return $this->{'slug_'.$this->lang};
    }
}
