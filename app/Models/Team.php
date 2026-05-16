<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory, HasLanguage;

    protected $table = 'teams';

    protected $fillable = [
        'name_ar',
        'name_en',
        'position_ar',
        'position_en',
        'text_ar',
        'text_en',
        'bio_ar',
        'bio_en',
        'image',
        'alt_image',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'status',
        'show_in_home',
        'order',
    ];

    public function getNameAttribute()
    {
        return $this->{'name_'.$this->lang};
    }

    public function getPositionAttribute()
    {
        return $this->{'position_'.$this->lang};
    }

    public function getTextAttribute()
    {
        return $this->{'text_'.$this->lang};
    }

    public function getBioAttribute()
    {
        return $this->{'bio_'.$this->lang};
    }

    public function getImagePathAttribute()
    {
        return $this->image ? asset('storage/teams/'.$this->image) : asset('assets/dashboard/images/noimage.png');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function scopeHome(Builder $query): void
    {
        $query->where('show_in_home', 1);
    }
}
