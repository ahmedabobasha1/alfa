<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'text' => $this->{'text_'.app()->getLocale()},
            'second_text' => $this->{'second_text_'.app()->getLocale()},
            'image' => $this->image_path,
            'alt_image' => $this->alt_img,

        ];
    }
}
