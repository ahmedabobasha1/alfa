<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->{'title_'.app()->getLocale()},
            'title2' => $this->{'title2_'.app()->getLocale()},
            'short_desc' => $this->{'short_desc_'.app()->getLocale()},
            'text' => $this->{'text_'.app()->getLocale()},
            'image' => $this->image_path,
            'alt_image' => $this->alt_image,
            'banner' => $this->banner_path,
            'alt_banner' => $this->alt_banner,
            'banner2' => $this->banner2_path,
            'alt_banner2' => $this->alt_banner2,
        ];
    }
}
