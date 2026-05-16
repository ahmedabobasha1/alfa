<?php

namespace App\Models;

use App\Enums\SectionType;
use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasLanguage;

    protected $table = 'sections';

    protected $fillable = [
        'key',
        'title_en',
        'title_ar',
        'second_title_en',
        'second_title_ar',
        'short_desc_en',
        'short_desc_ar',
        'long_desc_en',
        'long_desc_ar',
        'image',
        'alt_image',
        'icon',
        'alt_icon',
        'status',
    ];

    public function getImagePathAttribute()
    {
        return $this->attributes['image'] ? asset('storage/sections/'.$this->attributes['image']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getIconPathAttribute()
    {
        return $this->attributes['icon'] ? asset('storage/sections/'.$this->attributes['icon']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getTitleAttribute()
    {
        return $this->{'title_'.$this->lang};
    }

    public function getSecondTitleAttribute()
    {
        return $this->{'second_title_'.$this->lang};
    }

    public function getShortDescAttribute()
    {
        return $this->{'short_desc_'.$this->lang};
    }

    public function getLongDescAttribute()
    {
        return $this->{'long_desc_'.$this->lang};
    }

    public function scopeType($query, SectionType $type)
    {
        return $query->where('key', $type->value);
    }
}
