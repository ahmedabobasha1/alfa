<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory ,HasLanguage;

    protected $table = 'sliders';

    protected $fillable = ['title_ar', 'title_en', 'title2_ar', 'title2_en', 'second_text_ar', 'second_text_en', 'text_en', 'text_ar', 'image_en', 'image_ar', 'order', 'alt_image_en', 'alt_image_ar', 'mobile_image_en', 'mobile_image_ar', 'mobile_alt_image_en', 'mobile_alt_image_ar', 'status', 'type'];

    public function getTitleAttribute()
    {
        return $this->{'title_'.$this->lang};
    }

    public function getSubTitleAttribute()
    {
        return $this->{'title2_'.$this->lang};
    }

    public function getTextAttribute()
    {
        return $this->{'text_'.$this->lang};
    }

    public function getSecondTextAttribute()
    {
        return $this->{'second_text_'.$this->lang};
    }

    public function getImagePathAttribute()
    {

        return $this->{'image_'.$this->lang} ? asset('storage/sliders/'.$this->{'image_'.$this->lang}) : asset('assets/dashboard/images/noimage.png');
    }

    public function getImageEnPathAttribute()
    {
        return $this->attributes['image_en'] ? asset('storage/sliders/'.$this->attributes['image_en']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getImageArPathAttribute()
    {
        return $this->attributes['image_ar'] ? asset('storage/sliders/'.$this->attributes['image_ar']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getAltImageAttribute()
    {
        return $this->{'alt_image_'.$this->lang};
    }

    public function getMobileImagePathAttribute()
    {
        return $this->{'mobile_image_'.$this->lang} ? asset('storage/sliders/'.$this->{'mobile_image_'.$this->lang}) : asset('assets/dashboard/images/noimage.png');
    }

    public function getMobileImageEnPathAttribute()
    {
        return $this->attributes['mobile_image_en'] ? asset('storage/sliders/'.$this->attributes['mobile_image_en']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getMobileImageArPathAttribute()
    {
        return $this->attributes['mobile_image_ar'] ? asset('storage/sliders/'.$this->attributes['mobile_image_ar']) : asset('assets/dashboard/images/noimage.png');
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
