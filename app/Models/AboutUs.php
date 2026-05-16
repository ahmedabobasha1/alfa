<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasLanguage;

    protected $table = 'about';

    protected $fillable = ['title_ar', 'title_en', 'title2_en', 'title2_ar', 'short_desc_ar', 'short_desc_en', 'text_ar', 'text_en', 'image', 'alt_image', 'icon', 'alt_icon', 'icon2', 'alt_icon2', 'banner', 'alt_banner', 'banner2', 'alt_banner2', 'video', 'alt_video', 'video_url'];

    public function getTitleAttribute()
    {
        return $this->{'title_'.$this->lang };
    }

    public function getSubTitleAttribute()
    {
        return $this->{'title2_'.$this->lang };
    }

    public function getShortDescAttribute()
    {
        return $this->{'short_desc_'.$this->lang };
    }

    public function getTextAttribute()
    {
        return $this->{'text_'.$this->lang };
    }

    public function getImagePathAttribute()
    {
        return $this->attributes['image'] ? asset('storage/about/'.$this->attributes['image']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getIconPathAttribute()
    {
        return $this->attributes['icon'] ? asset('storage/about/'.$this->attributes['icon']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getIcon2PathAttribute()
    {
        return $this->attributes['icon2'] ? asset('storage/about/'.$this->attributes['icon2']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getBannerPathAttribute()
    {
        return $this->attributes['banner'] ? asset('storage/about/'.$this->attributes['banner']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getBanner2PathAttribute()
    {
        return $this->attributes['banner2'] ? asset('storage/about/'.$this->attributes['banner2']) : asset('assets/dashboard/images/noimage.png');
    }

    public function getVideoPathAttribute()
    {
        return $this->attributes['video'] ? asset('storage/about/'.$this->attributes['video']) : null;
    }

    public function getVideoEmbedUrlAttribute()
    {
        if (! $this->attributes['video_url']) {
            return null;
        }

        $url = $this->attributes['video_url'];

        // Convert YouTube URLs to embed format
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
            return 'https://www.youtube.com/embed/'.$id[1].'?rel=0&modestbranding=1';
        } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
            return 'https://www.youtube.com/embed/'.$id[1].'?rel=0&modestbranding=1';
        } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
            return 'https://www.youtube.com/embed/'.$id[1].'?rel=0&modestbranding=1';
        }

        return $url;
    }

    public function getYoutubeWatchUrlAttribute()
    {
        if (! $this->attributes['video_url']) {
            return null;
        }

        $url = $this->attributes['video_url'];

        // Convert any YouTube URL format to watch format for popup compatibility
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
            return $url; // Already in correct format
        } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
            return 'https://www.youtube.com/watch?v='.$id[1];
        } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
            return 'https://www.youtube.com/watch?v='.$id[1];
        }

        return $url;
    }
}
