<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutStruct extends Model
{
    use HasFactory , HasLanguage;

    protected $table = 'about_structs';

    protected $fillable = [
        'title_en',
        'title_ar',
        'text_en',
        'text_ar',
        'icon',
        'alt_icon',
        'order',
        'status',
    ];

    public function getTitleAttribute()
    {
        return $this->{'title_'.$this->lang};
    }

    public function getTextAttribute()
    {
        return $this->{'text_'.$this->lang};
    }

    public function getIconPathAttribute()
    {
        return $this->attributes['icon'] ? asset('storage/about_structs/'.$this->attributes['icon']) : asset('assets/dashboard/images/noimage.png');
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
