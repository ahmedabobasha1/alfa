<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    /** @use HasFactory<\Database\Factories\TestimonialFactory> */
    use HasFactory , HasLanguage;

    protected $table = 'testimonials';

    protected $fillable = [
        'name_en',
        'name_ar',
        'job_title_en',
        'job_title_ar',
        'description_en',
        'description_ar',
        'image',
        'status',
    ];

    public function getNameAttribute()
    {
        return $this->{'name_'.$this->lang};
    }

    public function getJobTitleAttribute()
    {
        return $this->{'job_title_'.$this->lang};
    }

    public function getDescriptionAttribute()
    {
        return $this->{'description_'.$this->lang};
    }

    public function getImagePathAttribute()
    {
        return $this->image ? asset('storage/testimonials/'.$this->image) : asset('assets/dashboard/images/noimage.png');

    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
