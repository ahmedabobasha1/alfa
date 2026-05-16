<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteAddress extends Model
{
    /** @use HasFactory<\Database\Factories\SiteAddressFactory> */
    use HasFactory ,HasLanguage;

    protected $table = 'site_addresses';

    protected $fillable = ['type', 'title_ar', 'title_en', 'address_ar', 'address_en', 'working_hours_ar', 'working_hours_en', 'email', 'phone', 'phone2', 'map_url', 'map_link', 'order', 'status'];

    public const TYPES = ['head_office', 'branch', 'other'];

    public function getTitleAttribute()
    {
        return $this->{'title_'.$this->lang};
    }

    public function getAddressAttribute()
    {
        return $this->{'address_'.$this->lang};
    }

    public function getWorkingHoursAttribute()
    {
        return $this->{'working_hours_'.$this->lang};
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }
}
