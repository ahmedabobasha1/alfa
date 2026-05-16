<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
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
            'second_title' => $this->{'second_title_'.app()->getLocale()},
            'short_desc' => $this->{'short_desc_'.app()->getLocale()},
            'long_desc' => $this->{'long_desc_'.app()->getLocale()},
            'image' => $this->image_path,
            'alt_image' => $this->alt_image,
        ];
    }
}
