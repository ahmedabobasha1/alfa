<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Menu extends Model
{
    use HasLanguage;

    protected $table = 'menus';

    protected $fillable = ['name_en', 'name_ar', 'parent_id', 'route_name', 'status', 'order'];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function getParentNameAttribute()
    {
        // Check if parent_id exists
        if (! $this->parent_id) {
            return __('dashboard.no_parent');
        }

        // Check if the relationship is already loaded to avoid lazy loading
        if ($this->relationLoaded('parent') && $this->parent) {
            return $this->parent->{'name_'.$this->lang};
        }

        // If relationship is not loaded, fetch parent name directly to avoid lazy loading
        $parent = static::find($this->parent_id);

        return $parent ? $parent->{'name_'.$this->lang} : __('dashboard.no_parent');
    }

    public function getNameAttribute()
    {
        return $this->{'name_'.$this->lang};
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function getLinkAttribute()
    {
        // إذا كان الـ segment هو # فهذا يعني قائمة رئيسية فقط بدون رابط
        if ($this->segment === '#') {
            return '#';
        }

        return $this->segment ? LaravelLocalization::LocalizeUrl($this->segment) : '#';
    }
}
