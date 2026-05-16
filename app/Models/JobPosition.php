<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    /** @use HasFactory<\Database\Factories\JobPositionFactory> */
    use HasFactory , HasLanguage;

    protected $table = 'job_positions';

    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'location',
        'image',
        'alt_image',
        'icon',
        'alt_icon',
        'type',
        'status',
    ];

    public static function getTypeSelect()
    {
        return [
            'full-time' => __('dashboard.full_time'),
            'part-time' => __('dashboard.part_time'),
            'contract' => __('dashboard.contract'),
        ];
    }

    public function getImagePathAttribute()
    {
        return $this->attributes['image'] ? asset('storage/job-positions/'.$this->attributes['image']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getIconPathAttribute()
    {
        return $this->attributes['icon'] ? asset('storage/job-positions/'.$this->attributes['icon']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getTitleAttribute()
    {
        return $this->{'title_'.$this->lang};
    }

    public function getDescriptionAttribute()
    {
        return $this->{'description_'.$this->lang};
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
